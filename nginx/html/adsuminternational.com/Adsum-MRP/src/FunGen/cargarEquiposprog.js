<!--Propiedad intelectual de adsum (c).-->
<!--Funcion         : cargarEquipos-->
<!--Decripcion      : abre un archivo php sin recargar el formulario-->
<!--Parametros      : valor		el valor del atributo del formulario-->
<!--Retorno         : null-->
<!--Autor           : ariascos - lfolaya - jcortes-->
<!--Fecha           : 25-abr-2005-->
//function cargarEquiposprog(valor,num)
function cargarEquiposprog(valor,num)
{
	/*
	Esta funcion solo ejecuta jsrsExecute con los siguientes parametros:
	1: Fichero [url] del .php que ofrece el servicio
	2: nombre de la funcion que recibir� el resultado ... recibe siempre un par�metro
	3: nombre de la funcion a ejecutar en el servidor
	4: parametros a enviar al servidor ... en este caso un numero

	*/
	//if(num != 2)
	 jsrsExecute("procEquipos.php", cargarEquiposResultado1, "mostrarEquipos", valor );
}

function cargarEquiposResultado1(cadena)
{
	if(cadena != "")
	{   
		miArray  = jsrsArrayFromString( cadena  , "," );
		var defaultSelected = true;
		var selected = true;
		window.document.form1.selectequipo1.length = 1;
		// window.document.form1.selectequipo1.options[0] = new Option("Seleccione","",defaultSelected, selected);

		j = 0;
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
			window.document.form1.selectequipo1.options[j] = new Option(nombre,valor,defaultSelected, selected);

			j++;
			i += 1;
		}
	}
	else
	{
		window.document.form1.selectequipo1.length = 0;
		var defaultSelected = true;
		var selected = true;
		// window.document.form1.selectequipo1.options[0] = new Option("Seleccione","",defaultSelected, selected);

		//window.document.form1.componcodigo.length = 0;
		//window.document.form1.componcodigo.options[0] = new Option("Seleccione","",defaultSelected, selected);
	}
}
