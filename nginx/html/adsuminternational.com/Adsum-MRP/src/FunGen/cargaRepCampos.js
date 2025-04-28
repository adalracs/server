<!--Propiedad intelectual de adsum (c). -->
<!--Funcion         : cargarRepCampos 	-->
<!--				  Conjunto de funciones que permiten el correcto funcionamiento del generador -->
<!--				  de reportes       -->
<!--Decripcion      : Trae de la DB los datos necesarios y llama a cargaCampos que llena los respectivos selects-->
<!--Autor           : mstroh -->
<!--Fecha           : 21-jun-2005-->
function cargaRepCampos(valor)
{
	/*
	Esta funcion solo ejecuta jsrsExecute con los siguientes parametros:
	1: Fichero [url] del .php que ofrece el servicio
	2: nombre de la funcion que recibirá el resultado ... recibe siempre un parámetro
	3: nombre de la funcion a ejecutar en el servidor
	4: parametros a enviar al servidor ...

	*/
	valor = lastOption();
	jsrsExecute("procReportes.php", cargaCampos, "mostrarCampos", valor);

}

function lastOption()
{
	var optRef = window.document.form1.selectedTables;

	return optRef[optRef.length-1].value;
}

function cargaCampos(cadena)
{
	var myString = cadena.substr(0, cadena.lastIndexOf("ç"));
	var myArray = jsrsArrayFromString(myString, "ç");
	var totLoop = myArray.length;
	var auxLoop = totLoop;
	var auxArray;
	var inptName;
	var j = 0;
	var x = 0;

	var a = 0;
	var b = 0;

	if (window.document.form1.allRows.length != 0)
	{
		j = window.document.form1.allRows.length;
		totLoop += j;
	}

	if (window.document.form1.campo1_1.length != 0)
	{
		b = window.document.form1.campo1_1.length;
		auxLoop += b;
	}

	for (var i = j; i < totLoop; i++)
	{
		auxArray = myArray[a].split(",");

		window.document.form1.allRows[i] = new Option(auxArray[0], auxArray[1], true, false);
		a++;
	}

	for (var k = 0; k < window.document.form1.elements.length; k++)
	{
		if (window.document.form1.elements[k].type == "select-one")
		{
			inptName = window.document.form1.elements[k].name;

			if (inptName.indexOf("campo") != -1)
			{
				for (var z = b; z < auxLoop; z++)
				{
					auxArray = myArray[x].split(",");

					window.document.form1.elements[k].options[z] = new Option(auxArray[0], auxArray[1], true, false);
					x++;
				}
				x = 0;
			}
		}
	}
}

function quitaCampos(tablcodi)
{
	var count = 0;
	var tablValue;
	var foo;
	var bar;

	if(tablcodi.options.selectedIndex == -1)
	return;

	for (var k = 0; k < tablcodi.length; k++)
	{
		if (tablcodi.options[k].selected)
			tablValue = tablcodi.options[k].value;
	}

	for (var i = 0; i < window.document.form1.elements.length; i++)
	{
		if (window.document.form1.elements[i].type == "select-one")
		{
			inptName = window.document.form1.elements[i].name;

			if ((inptName.indexOf("Rows") != -1) || (inptName.indexOf("campo") != -1) || (inptName.indexOf("orderBy") != -1))
			{
				for (var j = window.document.form1.elements[i].options.length; j > 0; j--)
				{
					if (window.document.form1.elements[i].options[j-1].value != "")
					{
						foo = window.document.form1.elements[i].options[j-1].value.split("|");
						bar = tablValue.split("|");

						if (foo[1] == bar[0])
							window.document.form1.elements[i].options[j-1] = null;
					}
				}
			}
		}
	}
}

function transferCampo(flag)
{
	var optRef
	var count = window.document.form1.orderBy.options.length;
	var countAux = window.document.form1.selectedRows.options.length;
	var tmpValue;
	var tmpText;

	if (countAux != 0)
		optRef = window.document.form1.selectedRows.options[window.document.form1.selectedRows.options.length-1];

	else
		return;

	if (flag)
	window.document.form1.orderBy.options[count] = new Option(optRef.text, optRef.value, false, false);
	else
	{
		if (window.document.form1.selectedRows.options.selectedIndex == -1)
		{
			return;
		}
		else
		{
			tmpValue = window.document.form1.selectedRows.options[window.document.form1.selectedRows.options.selectedIndex].value;
			tmpText = window.document.form1.selectedRows.options[window.document.form1.selectedRows.options.selectedIndex].text;

			for (var j = window.document.form1.orderBy.options.length; j > 0; j--)
			{
				if (window.document.form1.orderBy.options[j-1].value == tmpValue)
					window.document.form1.orderBy.options[j-1] = null;
			}
		}
	}
}

function setString()
{
	// @ Separa un bloque de condiciones
	// ç Separa una tabla y/o un campo del otro
	// - Separa AND y/o OR
	// | Separa el código del nombre de la tabla y/o la/el campo
	
	var totElements = window.document.form1.elements.length;
	var tablValues;
	var count = 0;
	var objRef;
	var bigStr = "@";
	
	if (window.document.form1.reportnombre.value == "")
	{
		alert("Debe especificar un nombre v\u00E1lido al reporte");
		
		return false;
	}

	for (var i = 0; i < totElements; i++)
	{
		if ((window.document.form1.elements[i].type == "select-one") || (window.document.form1.elements[i].type == "text"))
		{
			if (window.document.form1.elements[i].name == "selectedTables")
			{
				count = window.document.form1.elements[i].options.length;
				
				if (count > 0)
					for (var a = 0; a < count; a++)
						window.document.form1.total_tables.value += "ç" + window.document.form1.elements[i].options[a].value;
				
				else
				{
					alert("Debe escojer al menos una tabla");
					
					return false;
				}
			}
			else if(window.document.form1.elements[i].name == "selectedRows")
			{
				count = window.document.form1.elements[i].options.length;
				
				if (count > 0)
				{
					window.document.form1.total_tablro.value = count;
				
					for (var b = 0; b < count; b++)
						window.document.form1.total_column.value += "ç" + window.document.form1.elements[i].options[b].value;
				}
				else
				{
					alert("Debe escoger al menos un campo a mostrar");
					
					return false;
				}
			}
			else if (window.document.form1.elements[i].name == "orderBy")
				window.document.form1.total_orderb.value = window.document.form1.elements[i].options[window.document.form1.elements[i].options.selectedIndex].value;

			else
			{
				objRef = window.document.form1.elements[i];

				if (objRef.name.indexOf("campo1") != -1)
				{				
					bigStr += objRef.options[objRef.options.selectedIndex].value;
					window.document.form1.total_condic.value = bigStr;
				}

				else if (objRef.name.indexOf("condic_") != -1)
				{			
					if (objRef.options[objRef.options.selectedIndex].value != "")
					{
						bigStr += "((" + objRef.options[objRef.options.selectedIndex].value + "))";
						window.document.form1.total_condic.value = bigStr;
					}
				}

				else if (objRef.name.indexOf("campo2") != -1)
				{
					if (objRef.options[objRef.options.selectedIndex].value != "")
					{
						bigStr += objRef.options[objRef.options.selectedIndex].value + "-";
						window.document.form1.total_condic.value = bigStr;
					}
				}
				
				else if (objRef.name.indexOf("val_") != -1)
				{
					if (objRef.value != "")
					{
						bigStr += objRef.value + "-";
						window.document.form1.total_condic.value = bigStr;
					}
				}
				
				else if (objRef.name.indexOf("andOr_") != -1)
				{
					if (objRef.options[objRef.options.selectedIndex].value != "")
					{
						bigStr += objRef.options[objRef.options.selectedIndex].value + "@";
						window.document.form1.total_condic.value = bigStr;
					}
				}
			}
		}
	}
	var strCodi;
	
	for (var x = 0; x < window.document.form1.selectedRows.options.length; x++)
	{
		(x == 0) ? 	strCodi = window.document.form1.selectedRows.options[x].value + "," : 	strCodi = strCodi + window.document.form1.selectedRows.options[x].value + ",";
	}
	
	window.document.form1.campos.value = strCodi;	
	window.document.form1.accionnuevoreportes.value = 1;
	
	return true;
}
