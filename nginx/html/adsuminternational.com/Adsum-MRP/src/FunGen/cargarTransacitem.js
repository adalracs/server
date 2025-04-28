<!--Propiedad intelectual de adsum (c).-->
<!--Funcion         : cargarTransacitem-->
<!--Decripcion      : abre un archivo php sin recargar el formulario-->
<!--Parametros      : valor		el valor del atributo del formulario-->
<!--Retorno         : null-->
<!--Autor           : ariascos - lfolaya - jcortes-->
<!--Fecha           : 25-abr-2005-->
function cargarTransacitem(valor)
{
    /*
        Esta funcion solo ejecuta jsrsExecute con los siguientes parametros:
        1: Fichero [url] del .php que ofrece el servicio
        2: nombre de la funcion que recibir� el resultado ... recibe siempre un par�metro
        3: nombre de la funcion a ejecutar en el servidor
        4: parametros a enviar al servidor ... en este caso un numero
    
    */
	jsrsExecute("procTransacitem.php", cargarTransacitemResultado, "mostrarTransacitem", valor);
}

function cargarTransacitemResultado(cadena)
{
	if(cadena != "")
	{
	    miArray  = jsrsArrayFromString( cadena  , "," );
	    var defaultSelected = false;
	    var selected = false;
	    window.document.form1.itemcodigo.length = 0;
	    j = 0;
	    for(i = 0; i < miArray.length -1; i++)
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
			window.document.form1.itemcodigo.options[j] = new Option(nombre,valor,defaultSelected, selected);
			j++;
			i += 1;
	    }
	}
}
