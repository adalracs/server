<!--Propiedad intelectual de adsum (c).-->
<!--Funcion         : cargarEquipotimedrep-->
<!--Decripcion      : abre un archivo php sin recargar el formulario-->
<!--Parametros      : valor		el valor del atributo del formulario-->
<!--Retorno         : null-->
<!--Autor           : jcortes-->
<!--Fecha           : 15-sep-2005-->

function cargarEquiposis(valor)
{
    /*
        Esta funcion solo ejecuta jsrsExecute con los siguientes parametros:
        1: Fichero [url] del .php que ofrece el servicio
        2: nombre de la funcion que recibir� el resultado ... recibe siempre un par�metro
        3: nombre de la funcion a ejecutar en el servidor
        4: parametros a enviar al servidor ... en este caso un numero
    
    */
   	jsrsExecute("procSistemas.php", cargarEquipoResultado, "mostrarEquipo", valor );
}

function cargarEquipoResultado(cadena){
	
	respuesta  = jsrsArrayFromString(cadena,",");
	
	if(respuesta[0] == "-1"){
		alert("No existe el equipo con el codigo: "+respuesta[1]);
	    window.document.form1.equiponombre.value = "";
	    window.document.form1.sistemcodigo.focus();
	}
	else{
		window.document.form1.equiponombre.value = cadena;     
		window.document.form1.sistemcodigo.focus();
	}
}
