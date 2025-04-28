<!--Propiedad intelectual de adsum (c).-->
<!--Funcion         : cargarEquipos-->
<!--Decripcion      : abre un archivo php sin recargar el formulario-->
<!--Parametros      : valor		el valor del atributo del formulario-->
<!--Retorno         : null-->
<!--Autor           : ariascos - lfolaya - jcortes-->
<!--Fecha           : 25-abr-2005-->
function cargarEquiposborrar()
{
	/*
	Esta funcion solo ejecuta jsrsExecute con los siguientes parametros:
	1: Fichero [url] del .php que ofrece el servicio
	2: nombre de la funcion que recibir� el resultado ... recibe siempre un par�metro
	3: nombre de la funcion a ejecutar en el servidor
	4: parametros a enviar al servidor ... en este caso un numero

	
	if(num != 2)
	 jsrsExecute("procEquipos.php", cargarEquiposResultado2, "mostrarEquipos", valor );*/
	
	window.document.form1.selectequipo2.length = 0;
	var defaultSelected = true;
	var selected = true;
	window.document.form1.selectequipo1.options[0] = new Option("","",defaultSelected, selected);
    window.document.form1.selectequipo2.options[0] = new Option("","",defaultSelected, selected);  

}

