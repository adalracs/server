<!--Propiedad intelectual de adsum (c).-->
<!--Funcion         : cargarTransacitem-->
<!--Decripcion      : abre un archivo php sin recargar el formulario-->
<!--Parametros      : valor		el valor del atributo del formulario-->
<!--Retorno         : null-->
<!--Autor           : mstroh-->
<!--Fecha           : 21-09-2005-->
function cargarItemtransac(valor)
{
	/*
	Esta funcion solo ejecuta jsrsExecute con los siguientes parametros:
	1: Fichero [url] del .php que ofrece el servicio
	2: nombre de la funcion que recibir� el resultado ... recibe siempre un par�metro
	3: nombre de la funcion a ejecutar en el servidor
	4: parametros a enviar al servidor ... en este caso un numero

	*/
	if (valor != '')
		jsrsExecute("procItemtransac.php", cargarTransacitemResultado, "mostrarItemtransac", valor );
	else
	{
		window.document.form1.itemcodigo.value = "";
		window.document.form1.itemnomb.value = "";
		window.document.form1.itemcanmin.value = "";
		window.document.form1.itemcanmax.value = "";
		window.document.form1.itemdispon.value = "";
		window.document.form1.itemvalor.value = "";
		return;
	}
}

function cargarTransacitemResultado(cadena)
{
	var foo = window.document.form1.itemcodigo;
	var flagConsultar = window.document.form1.flag;
	if(cadena != "")
	{
		if(cadena < 0) 
		{
			switch(cadena)
			{
				case '-1':
				alert("Error de conexi\u00f3n");
				foo.value = "";
				foo.focus();
				break;
				case '-2':
				case '-3':
				alert("No existe item con el c\u00f3digo " + foo.value);
				foo.value = "";
				window.document.form1.itemnomb.value = "";
				window.document.form1.itemcanmin.value = "";
				window.document.form1.itemcanmax.value = "";
				window.document.form1.itemdispon.value = "";
				window.document.form1.itemvalor.value = "";
				foo.focus();
				break;
				default:
				alert("Error desconocido");
				foo.value = "";
				foo.focus();
				break;
			}
		}
		else if(flagConsultar != 1)
		{
			miArray  = jsrsArrayFromString( cadena  , "," );
			window.document.form1.itemnomb.value = miArray[0];
			window.document.form1.itemcanmin.value = miArray[1];
			window.document.form1.itemcanmax.value = miArray[2];
			window.document.form1.itemdispon.value = miArray[3];
			window.document.form1.itemvalor.value = miArray[4];
		}
		else
		{
			miArray = jsrsArrayFromString(cadena, ",");
			window.document.form1.itemnomb.value = miArray[0];
		}
	}
}
