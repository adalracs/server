<!--Propiedad intelectual de adsum (c).-->
<!--Funcion         : cargarHerramtransac-->
<!--Decripcion      : abre un archivo php sin recargar el formulario-->
<!--Parametros      : valor		el valor del atributo del formulario-->
<!--Retorno         : null-->
<!--Autor           : lfolaya-->
<!--Fecha           : 10-01-2006-->
function cargarHerramtransac(valor)
{
	/*
	Esta funcion solo ejecuta jsrsExecute con los siguientes parametros:
	1: Fichero [url] del .php que ofrece el servicio
	2: nombre de la funcion que recibir� el resultado ... recibe siempre un par�metro
	3: nombre de la funcion a ejecutar en el servidor
	4: parametros a enviar al servidor ... en este caso un numero

	*/
	if (valor != '')
		jsrsExecute("procHerramtransac.php", cargarTransacherramResultado, "mostrarHerramtransac", valor );
	else
	{
		window.document.form1.herramcodigo.value = "";
		window.document.form1.herramnombre.value = "";
		window.document.form1.herramdispon.value = "";
		window.document.form1.herramvalor.value = "";
		return;
	}
}

function cargarTransacherramResultado(cadena)
{
	var foo = window.document.form1.herramcodigo;
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
				alert("No existe herramienta con el c\u00f3digo " + foo.value);
				foo.value = "";
				window.document.form1.herramnombre.value = "";
				window.document.form1.herramdispon.value = "";
				window.document.form1.herramvalor.value = "";
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
			window.document.form1.herramnombre.value = miArray[0];
			window.document.form1.herramdispon.value = miArray[1];
			window.document.form1.herramvalor.value = miArray[2];
		}
		else
		{
			miArray = jsrsArrayFromString(cadena, ",");
			window.document.form1.herramnombre.value = miArray[0];
		}
	}
}
