<!--Propiedad intelectual de adsum (c).-->
<!--Funcion         : cargarSubsegmentos-->
<!--Decripcion      : abre un archivo php sin recargar el formulario-->
<!--Parametros      : valor		el valor del atributo del formulario-->
<!--Retorno         : null-->
<!--Autor           : cbedoya-->
<!--Fecha           : 22-Nov-2007-->

function cargarSubsegmentos(valor)
{
    /*
        Esta funcion solo ejecuta jsrsExecute con los siguientes parametros:
        1: Fichero [url] del .php que ofrece el servicio
        2: nombre de la funcion que recibir� el resultado ... recibe siempre un par�metro
        3: nombre de la funcion a ejecutar en el servidor
        4: parametros a enviar al servidor ... en este caso un numero
    
    */
    jsrsExecute("procSubsegmentos.php", cargarSubsegmentosResultado, "mostrarSubsegmentos", valor );
}

function cargarSubsegmentosResultado(cadena)
{
	if(cadena != "")
	{
	    miArray  = jsrsArrayFromString( cadena  , "," );
	    var defaultSelected = true;
	    var selected = true;
	    window.document.form1.subsegcodigo.length = 1;
	    window.document.form1.subsegcodigo.options[0] = new Option("Seleccione","",defaultSelected, selected);		

		j = 1;
	    for(i = 0; i < miArray.length -1; i++)
	    {
			if(i == 0 )
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
			window.document.form1.subsegcodigo.options[j] = new Option(nombre,valor,defaultSelected, selected);
			j++;
			i += 1;
	    }
	}
	else
	{
		window.document.form1.subsegcodigo.length = 0;
		var defaultSelected = true;
	    var selected = true;
	    window.document.form1.subsegcodigo.options[0] = new Option("Seleccione","",defaultSelected, selected);	
	}
}
