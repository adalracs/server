<!--Propiedad intelectual de adsum (c).-->
<!--Funcion         : cargarExammedi-->
<!--Decripcion      : abre un archivo php que consulta trae los exçamenes mçedicos de acuerdo al colaborador seleccionado-->
<!--Parametros      :-->
<!--valor:	llave primaria del colaborador escogido-->
<!--Retorno         : null-->
<!--Autor           : ariascos - lfolaya - jcortes-->
<!--Modificaciones: 					Autor:				Fecha: -->
<!--Implementacion para Exammediusuario	mstroh				03-ago-2005-->
<!--Fecha           : 21-jun-2005-->
function cargarExammediusuario(valor)
{
	/*
	Esta funcion solo ejecuta jsrsExecute con los siguientes parametros:
	1: Fichero [url] del .php que ofrece el servicio
	2: nombre de la funcion que recibirá el resultado ... recibe siempre un parámetro
	3: nombre de la funcion a ejecutar en el servidor
	4: parametros a enviar al servidor ... en este caso un numero

	*/
	jsrsExecute("procExammediusuario.php", cargarExammediusuarioResultado, "mostrarExammediusuario", valor);
}
function cargarExammediusuarioResultado(cadena)
{
	/*
	Llena el select de la izquierda (examselec) con los options que tenia al cargar la pantalla inicialmente
	*/
	var defaultSelected = true;
	var selected = true;
	for(i=0; i<all_users.length; i++)
	{
		window.document.form1.examselec.options[i] = new Option(all_users[i][0],all_users[i][1],defaultSelected, selected);
	}
	if(cadena != "")
	{
		miArray  = jsrsArrayFromString( cadena  , "," );
		var defaultSelected = true;
		var selected = true;
		var auxKey;
		var found = 0;
		j=0;
		for (i=0; i<((miArray.length)/2)-1; i++)
		{
			auxKey = miArray[(2*i)+1];
			for (k=0; k<((miArray.length)/2)-1; k++)
			{
				if (auxKey == miArray[(2*k+1)])
				{
					found+=1;
					if (found > 1)
					{
						deleteElement(miArray,(2*k+1));
						deleteElement(miArray,(2*k));
					}
				}
			}
			found = 0;
		}
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
			window.document.form1.examdelet.options[j] = new Option(nombre,valor,defaultSelected, selected);
			j++;
			i += 1;
		}
		/*
		Borra del select de la izquierda (examselec) los options que coincidan con los options
		del select de la derecha examadelet
		*/
		for(k=0; k < window.document.form1.examdelet.length; k++)
		{
			for(m= 0; m < window.document.form1.examselec.length; m++)
			{
				if(window.document.form1.examdelet.options[k].value == window.document.form1.examselec.options[m].value)
				{
					delete_record(window.document.form1.examselec,m);
				}
			}
		}
	}
	else
	{
		window.document.form1.examdelet.length = 0;
		/*Limpia el select de la izquierda (examselec)*/
		//window.document.form1.examselec.length = 0;
	}
}
function deleteElement(array,index)
{
	size = array.length;
	delindex = parseInt(index);
	inRange = ( (delindex >= 0) && (delindex <= array.length) );
	if (inRange)
	{
		for (var i=0; i<=size; i++)
		array[i] = ((i == delindex) ? "delete" : array[i]);
		for (var j=delindex; j<size-1; j++)
		if (j != size) array[j] = array[j+1];
		array.length = size-1;
	}
}