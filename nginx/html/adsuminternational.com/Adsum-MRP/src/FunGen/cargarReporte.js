/**
* Propiedad intelectual de Adsum (c).
*  Todos los derechos reservados
* Funciones:		cargarReporte
* 					cargaSelect
*					eliminaSelect
*					lastOption
* Descripcion:		Conjunto de funciones que permiten el correcto funcionamiento del formulario
*					del GENERADOR DE REPORTES.
* Autor: mstroh
* Fecha: 05-ABR-2006
*/

function cargarReporte(valor, flagElimina)
{
	/** flagElimina:	cuando es verdadero, se llama la funcion que elimina las opciones
	*					de los combo-box, de lo contrario, los llenara con las opciones pertinentes
	*/
	if(flagElimina)
	{
		var objRef = window.document.form1.seltable;

		if (objRef.options.selectedIndex != -1)
		{
			valor = objRef.options[objRef.options.selectedIndex].value;
			jsrsExecute("procReporte.php", eliminaSelect, "mostrarCampos", valor);
		}
	}
	else
	{
	if(valor == null)
			valor = lastOption();

		jsrsExecute("procReporte.php", cargaSelect, "mostrarCampos", valor);
	}
}

function cargaSelect(cadena)
{
	if(cadena != "")
	{
		var array_str = cadena.split("||");
		var allcamporef = window.document.form1.allfield;
		var selcamporef = window.document.form1.selfield;
		var flag_lastOpt = (allcamporef.length == 0) ? 0: 1;

		for(var i=0; i<array_str.length; i++)
		{
			data_array = array_str[i].split(',');

			if(flag_lastOpt)
			{
				var tmpLength = allcamporef.length;

				allcamporef[tmpLength] = new Option(data_array[1], data_array[0], true, false);
				tmpLength++;
			}
			else
				allcamporef[i] = new Option(data_array[1], data_array[0], true, false);
			// ---------------
			for(var j=0; j<window.document.form1.elements.length; j++)
			{
				if(window.document.form1.elements[j].type == "select-one")
				{
					if((window.document.form1.elements[j].name.indexOf("pre_") != -1) || (window.document.form1.elements[j].name.indexOf("post_") != -1) || (window.document.form1.elements[j].name == "orderby"))
					{
						var tmpLength_pre = window.document.form1.elements[j].length;

						window.document.form1.elements[j].options[tmpLength_pre] = new Option(data_array[1], data_array[0], false, false);
						tmpLength_pre++;
					}
				}
			}
		}
	}
}

function eliminaSelect(cadena)
{
	if(cadena != "")
	{
		var array_str = cadena.split("||");
		var elemRef = window.document.form1.elements;

		for(var i=0; i<array_str.length; i++)
		{
			data_array = array_str[i].split(',');

			for(var j=0; j<elemRef.length; j++)
			{
				if(elemRef[j].type == "select-one")
				{
					if((elemRef[j].name == "allfield") || (elemRef[j].name == "selfield") || (elemRef[j].name == "orderby") || (elemRef[j].name.indexOf('pre_') != -1) || (elemRef[j].name.indexOf("post_") != -1))
					{
						for(var k=0; k<elemRef[j].options.length; k++)
						{
							if(elemRef[j].options[k].value == data_array[0])
								elemRef[j].options[k] = null;
						}
					}
				}
			}
		}
	}
}

function lastOption()
{
	var optRef = window.document.form1.seltable;

	return optRef[optRef.length-1].value;
}