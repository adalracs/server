<!--Propiedad intelectual de adsum (c).-->
<!--Funcion         : cargarComponen-->
<!--Decripcion      : abre un archivo php sin recargar el formulario-->
<!--Parametros      : valor		el valor del atributo del formulario-->
<!--Retorno         : null-->
<!--Autor           : ariascos - lfolaya - jcortes-->
<!--Fecha           : 11-may-2007-->
function cargarDescripciontarea(valor)
{
    /*
        Esta funcion solo ejecuta jsrsExecute con los siguientes parametros:
        1: Fichero [url] del .php que ofrece el servicio
        2: nombre de la funcion que recibir� el resultado ... recibe siempre un par�metro
        3: nombre de la funcion a ejecutar en el servidor
        4: parametros a enviar al servidor ... en este caso un numero
    
    */

    jsrsExecute("procDescripciontarea.php", cargarTareadescripcionResultado, "mostrarTareadescripcion", valor );
}

function cargarTareadescripcionResultado(cadena)
{
	if(cadena != "")
	{
	    miArray  = jsrsArrayFromString( cadena  , "," );
		nombre = miArray[0];
		window.document.form1.progranota.value = nombre;
			
	}
	else
	{
	    window.document.form1.progranota = "0";		

	}
}
