<!--Propiedad intelectual de adsum (c).-->
<!--Funcion         : cargarExammediusuarioBusqueda-->
<!--Decripcion      : abre un archivo php que consulta los examenes de acuerdo a los parametros -->
<!--				  ingresados por el usuario, sin recargar el formulario-->
<!--Parametros      :							-->
<!--valor:			:							-->
<!--Retorno         : null-->
<!--Autor           : jcortes-->
<!--Fecha           : 21-jun-2005-->
function cargarExammediusuarioBusqueda(nombtabl,accionconsultarexammedi,recarreglo)
{
    /*
        Esta funcion solo ejecuta jsrsExecute con los siguientes parametros:
        1: Fichero [url] del .php que ofrece el servicio
        2: nombre de la funcion que recibirá el resultado ... recibe siempre un parámetro
        3: nombre de la funcion a ejecutar en el servidor
        4: parametros a enviar al servidor ... en este caso un numero
    
    */
	var valor = nombtabl + "." + accionconsultarexammedi + "." + recarreglo;
    jsrsExecute("procExammediusuario.php", cargarExammediusuarioBusquedaResultado, "mostrarExammediusuarioBusqueda", valor);
}

function cargarExammediusuarioBusquedaResultado(cadena)
{
	window.opener.document.form1.examselec.length = 0;
	if(cadena != "")
	{
		miArray = new Array;
	    miArray  = jsrsArrayFromString( cadena  , "," );
	    var defaultSelected = true;
	    var selected = true;
	    for(i = 0; i < miArray.length -1; i++)
	    {
			defaultSelected = false;
			selected = false;
			if(i == 0 )
			{
				defaultSelected = true;
				selected = true;
			}
			//
			var doc = window.opener.document.form1.examselec.ownerDocument;
			if (!doc)
				doc = window.opener.document.form1.examselec.document;
			var opt = doc.createElement('OPTION');
			opt.value = miArray[i];
			opt.text =  miArray[i+1];
			window.opener.document.form1.examselec.options.add(opt, i);
			//
			i++;
	    }
	    
	    /*
	    Borra del select de la izquierda (examselec) los options que coincidan con los options
	    del select de la derecha examdelet
	    */
	    for(k=0; k < window.opener.document.form1.examdelet.length; k++)
	    {
		    for(m= 0; m < window.opener.document.form1.examselec.length; m++)
		    {
		    	if(window.opener.document.form1.examdelet.options[k].value == window.opener.document.form1.examselec.options[m].value)
		    	{
		    		window.opener.document.form1.examselec.options[m] = null;
		    	}
		    }
		}
	}
	window.close();
}