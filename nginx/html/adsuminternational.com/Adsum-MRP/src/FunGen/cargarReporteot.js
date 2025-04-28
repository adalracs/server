<!--Propiedad intelectual de adsum (c).-->
<!--Funcion         : cargarReporteot-->
<!--Decripcion      : abre un archivo php sin recargar el formulario-->
<!--Parametros      : valor		el valor del atributo del formulario-->
<!--Retorno         : null-->
<!--Autor           : jcortes-->
<!--Fecha           : 08-ago-2005-->
<!--Modificaciones	:							Autor:			Fecha:		-->
<!--Implementación para la tabla ReporteOt		mstroh			08082005	-->
function cargarReporteot(valor)
{
	/*
	Esta funcion solo ejecuta jsrsExecute con los siguientes parametros:
	1: Fichero [url] del .php que ofrece el servicio
	2: nombre de la funcion que recibirï¿½ el resultado ... recibe siempre un parï¿½metro
	3: nombre de la funcion a ejecutar en el servidor
	4: parametros a enviar al servidor ... en este caso un numero

	*/
	miArray  = jsrsArrayFromString( valor , "|" );

	if(valor.indexOf("x") != -1)
		jsrsExecute("procReporteot.php", cargarReporteotResultadoEdit, "mostrarReporteot", miArray[0]);

	else
		jsrsExecute("procReporteot.php", cargarReporteotResultado, "mostrarReporteot", miArray[0]);
}

function cargarReporteotResultado(cadena)
{
	window.opener.document.form1.reportcodigo.value="";
	window.opener.document.form1.tipmannombre.value="";
	window.opener.document.form1.priorinombre.value="";
	window.opener.document.form1.tiptranombre.value="";
	window.opener.document.form1.tareanombre.value="";
	window.opener.document.form1.reportdescri.value="";

	if(cadena != "")
	{
		miArray  = jsrsArrayFromString(cadena,"@");
		for(var i=0;i<miArray.length;i++)
		{
			miArray1  = jsrsArrayFromString(miArray[i],"Ç");
			if(window.opener.document.form1.elements[miArray1[0]]==undefined)
			{
			}
			else
			{
				window.opener.document.form1.elements[miArray1[0]].value = miArray1[1];
			}
		}
	}
	window.opener.focus();
	window.close();
}
function cargarReporteotResultadoEdit(cadena)
{
	window.document.form1.reportcodigo.value="";
	window.document.form1.tipmannombre.value="";
	window.document.form1.priorinombre.value="";
	window.document.form1.tiptranombre.value="";
	window.document.form1.tareanombre.value="";
	window.document.form1.reportdescri.value="";

	if(cadena != "")
	{
		miArray  = jsrsArrayFromString(cadena,"@");
		for(var i=0;i<miArray.length;i++)
		{
			miArray1  = jsrsArrayFromString(miArray[i],"Ç");
			if(window.document.form1.elements[miArray1[0]]==undefined)
			{
			}
			else
			{
				window.document.form1.elements[miArray1[0]].value = miArray1[1];
			}
		}
	}
	window.focus();
}