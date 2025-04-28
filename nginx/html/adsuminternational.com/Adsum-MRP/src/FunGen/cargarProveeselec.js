<!--Propiedad intelectual de adsum (c).-->
<!--Funcion         : cargarProveeselec -->
<!--Decripcion      : abre un archivo php sin recargar el formulario-->
<!--Parametros      : valor		el valor del atributo del formulario-->
<!--Retorno         : null-->
<!--Autor           : mstroh -->
<!--Fecha           : 23-ENE-2006-->
function cargarProveeselec(valor)
{
    /*
        Esta funcion solo ejecuta jsrsExecute con los siguientes parametros:
        1: Fichero [url] del .php que ofrece el servicio
        2: nombre de la funcion que recibir� el resultado ... recibe siempre un par�metro
        3: nombre de la funcion a ejecutar en el servidor
        4: parametros a enviar al servidor ... en este caso un numero
    */
    jsrsExecute("procProveeselec.php", cargarProveeselecResultado, "mostrarProveeselec", valor);
}

function cargarProveeselecResultado(cadena)
{
	if(cadena != "")
	{
	    var miArray  = jsrsArrayFromString(cadena, ",");
	    var defaultSelected = false;
	    var arr_len = miArray.length;
	    var selected = false;
	    var j = 0;
	    /* * * * * * * * * * */
	    window.document.form1.proveeselec.length = 0;
		
	    for(i = 0; i < (arr_len-1); i++)
	    {
			if(i == 0)
			{
				defaultSelected = false;
				selected = false;
			}
			else
			{
				defaultSelected = false;
				selected = false;
			}
			valor = miArray[i];
			nombre = miArray[i+1];
			window.document.form1.proveeselec.options[j] = new Option(nombre, valor, defaultSelected, selected);
			j++;
			i += 1;
	    }
	}
}