<!--Propiedad intelectual de adsum (c).-->
<!--Funcion         : cargarOtestado-->
<!--Decripcion      : abre un archivo php sin recargar el formulario-->
<!--Parametros      : valor		el valor del atributo del formulario-->
<!--Retorno         : null-->
<!--Autor           : ariascos - lfolaya - jcortes-->
<!--Fecha           : 01-jul-2005-->
function cargarOtestado(valor)
{
    /*
        Esta funcion solo ejecuta jsrsExecute con los siguientes parametros:
        1: Fichero [url] del .php que ofrece el servicio
        2: nombre de la funcion que recibir� el resultado ... recibe siempre un par�metro
        3: nombre de la funcion a ejecutar en el servidor
        4: parametros a enviar al servidor ... en este caso un numero
    
    */
	jsrsExecute("procOtestado.php", cargarOtestadoResultado, "mostrarOtestado", valor );
}

function cargarOtestadoResultado(cadena)
{
	if(cadena != "")
	{
		miArray  = jsrsArrayFromString(cadena, "," );
	    var defaultSelected = true;
	    var selected = true;
	    
	    var namesel;
		for(var i = 0; i < window.document.form1.elements.length; i++)
	    {
	    	if(window.document.form1.elements[i].type == "select-one")
	    	{
	    		namesel = parseInt(window.document.form1.elements[i].name);
	    		alert(namesel);
	    	}
	    }
	    
	    window.document.form1.selecthi.length = 1;
	  	window.document.form1.selecthi.options[0] = new Option("Seleccione","",defaultSelected, selected);
	  	var j = 1;
		for(var i = 0; i < miArray.length -1; i++)
		{
			defaultSelected = false;
			selected = false;
	
			var valor = miArray[i];
			var nombre = miArray[i+1];
			window.document.form1.selecthi1.options[j] = new Option(nombre,valor,defaultSelected, selected);
			j++;
			i += 1;
		}

		
	    /*miArray  = jsrsArrayFromString(cadena, "," );
	    var defaultSelected = true;
	    var selected = true;
		for(var k=0; k < window.document.form1.elements['selecthi'].length; k++)
		{
			window.document.form1.selecthi[k].length = 1;
	  		window.document.form1.selecthi[k].options[0] = new Option("Seleccione","",defaultSelected, selected);
	  		var j = 1;
			for(var i = 0; i < miArray.length -1; i++)
		    {
				defaultSelected = false;
				selected = false;
	
				var valor = miArray[i];
				var nombre = miArray[i+1];
				window.document.form1.selecthi[k].options[j] = new Option(nombre,valor,defaultSelected, selected);
				j++;
				i += 1;
		    }
		}*/
	}
}
