<!--Propiedad intelectual de adsum (c).-->
<!--Funcion         : cargarUsuaGrupCapa-->
<!--Decripcion      : abre un archivo php que consulta trae los usuarios de acuerdo al grupo de capa-->
<!--				  citación escogido sin recargar el formulario-->
<!--Parametros      :-->
<!--valor:	llave primaria del grupo de capacitacion escogido-->
<!--Retorno         : null-->
<!--Autor           : jcortes-->
<!--Fecha           : 21-jun-2005-->

function cargarUsuagrupcapa(valor)
{
    /*
        Esta funcion solo ejecuta jsrsExecute con los siguientes parametros:
        1: Fichero [url] del .php que ofrece el servicio
        2: nombre de la funcion que recibirá el resultado ... recibe siempre un parámetro
        3: nombre de la funcion a ejecutar en el servidor
        4: parametros a enviar al servidor ... en este caso un numero
    
    */
    jsrsExecute("procUsuagrupcapa.php", cargarUsuagrupcapaResultado, "mostrarUsuagrupcapa", valor);
}

function cargarUsuagrupcapaResultado(cadena)
{
    /*
    Llena el select de la izquierda (empleaselec) con los options que tenia al cargar la pantalla inicialmente
    */
	var defaultSelected = true;
    var selected = true;
    //	alert("all_users: " + all_users);
    for(i=0; i<all_users.length; i++)
    {
		window.document.form1.empleaselec.options[i] = new Option(all_users[i][0],all_users[i][1],defaultSelected, selected);
    }
    
	if(cadena != "")
	{
	    miArray  = jsrsArrayFromString( cadena  , "," );
	    var defaultSelected = true;
	    var selected = true;
	    j=0;
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
			window.document.form1.empleadelet.options[j] = new Option(nombre,valor,defaultSelected, selected);
			j++;
			i += 1;
	    }
	    
	    /*
	    Borra del select de la izquierda (empleaselec) los options que coincidan con los options
	    del select de la derecha empleadelet
	    */
	    for(k=0; k < window.document.form1.empleadelet.length; k++)
	    {
		    for(m= 0; m < window.document.form1.empleaselec.length; m++)
		    {
		    	if(window.document.form1.empleadelet.options[k].value == window.document.form1.empleaselec.options[m].value)
		    	{
		    		delete_record(window.document.form1.empleaselec,m);
		    	}
		    }
		}
	}
	else
	{
		window.document.form1.empleadelet.length = 0;
		/*Limpia el select de la izquierda (empleaselec)*/
	    //window.document.form1.empleaselec.length = 0;	    
	}
}