<!--Propiedad intelectual de adsum (c).-->
<!--Funcion         : cargarEquipotimedrep-->
<!--Decripcion      : abre un archivo php sin recargar el formulario-->
<!--Parametros      : valor		el valor del atributo del formulario-->
<!--Retorno         : null-->
<!--Autor           : jcortes-->
<!--Fecha           : 15-sep-2005-->

function cargarEquipo(valor)
{
    /*
        Esta funcion solo ejecuta jsrsExecute con los siguientes parametros:
        1: Fichero [url] del .php que ofrece el servicio
        2: nombre de la funcion que recibirá el resultado ... recibe siempre un parámetro
        3: nombre de la funcion a ejecutar en el servidor
        4: parametros a enviar al servidor ... en este caso un numero
    
    */
   	jsrsExecute("procEquipo.php", cargarEquipoResultado, "mostrarEquipo", valor );
}

function cargarEquipoResultado(cadena)
{
    respuesta  = jsrsArrayFromString(cadena,",");
	if(respuesta[0] == "-1")
	{
		alert("No existe el equipo con el codigo: "+respuesta[1]);
	    miArray = jsrsArrayFromString(respuesta[2],"@");
	    for(var i=0;i<miArray.length;i++)
	    {
		    miArray1  = jsrsArrayFromString(miArray[i],"Ç");
		    if(window.document.form1.elements[miArray1[0]]==undefined)
		    {
		    }
		    else
		    {
	    		window.document.form1.elements[miArray1[0]].value = "";
		    }
	    }
	    window.document.form1.equipocodigo.focus();
	}
	else
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
	    window.document.form1.equipocodigo.focus();	    
	}
}
