<!--Propiedad intelectual de adsum (c).-->
<!--Funcion         : cargarTipomedi-->
<!--Decripcion      : abre un archivo php sin recargar el formulario-->
<!--Parametros      : valor		el valor del atributo del formulario-->
<!--Retorno         : null-->
<!--Autor           : lfolaya-->
<!--Fecha           : 13-Dic-2005-->
function cargarTipomedi(valor)
{
    /*
        Esta funcion solo ejecuta jsrsExecute con los siguientes parametros:
        1: Fichero [url] del .php que ofrece el servicio
        2: nombre de la funcion que recibir� el resultado ... recibe siempre un par�metro
        3: nombre de la funcion a ejecutar en el servidor
        4: parametros a enviar al servidor ... en este caso un numero
    
    */

    jsrsExecute("procTipomedi.php", cargarTipomediResultado, "mostrarTipomedi", valor );
}

function cargarTipomediResultado(cadena)
{
	if(cadena != "")
	{
	    window.document.form1.tipmedacra.value = cadena;
	}
}
