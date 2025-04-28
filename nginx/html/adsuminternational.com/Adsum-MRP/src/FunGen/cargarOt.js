<!--Propiedad intelectual de adsum (c).-->
<!--Funcion         : cargarOt-->
<!--Decripcion      : abre un archivo php sin recargar el formulario-->
<!--Parametros      : valor	el valor del atributo del formulario-->
<!--Retorno         : null-->
<!--Autor           : jcortes-->
<!--Fecha           : 15-jul-2005-->

function cargarOt(valor)
{
    /*
        Esta funcion solo ejecuta jsrsExecute con los siguientes parametros:
        1: Fichero [url] del .php que ofrece el servicio
        2: nombre de la funcion que recibiria el resultado ... recibe siempre un parametro
        3: nombre de la funcion a ejecutar en el servidor
        4: parametros a enviar al servidor ... en este caso un numero
    */
    
    miArray  = jsrsArrayFromString( valor , "|" );
    jsrsExecute("procOt.php", cargarOtResultado, "mostrarOt", miArray[0] );
}

function cargarOtResultado(cadena)
{
 	window.opener.document.getElementById("divreport").style.visibility="visible";
	window.opener.document.form1.ordtracodigo.value="";
	window.opener.document.form1.ordtrafecgen.value="";
	window.opener.document.form1.ordtrahorgen.value="";
	window.opener.document.form1.plantanombre.value="";
	window.opener.document.form1.sistemnombre.value="";
	window.opener.document.form1.equiponombre.value="";
	window.opener.document.form1.componnombre.value="";
	window.opener.document.form1.tipmannombre.value="";
	window.opener.document.form1.priorinombre.value="";
	window.opener.document.form1.ordtradescri.value="";
	window.opener.document.form1.ordtrafecini.value="";
	window.opener.document.form1.ordtrahorini.value="";
	window.opener.document.form1.ordtrafecfin.value="";
	window.opener.document.form1.ordtrahorfin.value="";
	window.opener.document.form1.empleacod.value="";
	window.opener.document.form1.empleanomb.value="";
	window.opener.document.form1.empleaselec.length=0;
	window.opener.document.form1.tiptranombre.value="";
	window.opener.document.form1.tareanombre.value="";
	window.opener.document.form1.ordtranota.value="";
	window.opener.document.form1.itemcodigo.length=0;
	window.opener.document.form1.itemcodigo1.length=0;
	window.opener.document.form1.tipmancodigo.value="";
	window.opener.document.form1.prioricodigo.value="";
	window.opener.document.form1.tiptracodigo.value="";
	window.opener.document.form1.tareacodigo.value="";
	window.opener.document.form1.reporttiedur.value="";
	window.opener.document.form1.reportdescri.value="";
	window.opener.document.form1.arreglo_aux.value="";
	window.opener.document.form1.loaditem.value="";
	if(cadena != "")
	{
	    miArray  = jsrsArrayFromString(cadena  , "@" );
	    for(var i=0;i<miArray.length;i++)
	    {
		    miArray1  = jsrsArrayFromString(miArray[i],"�");

		    if(window.opener.document.form1.elements[miArray1[0]]==undefined)
		    {
		    }
		    else
		    {
	    		window.opener.document.form1.elements[miArray1[0]].value = miArray1[1];
	    		
	    		if(miArray1[0] == "ordtracodigo")
	    		{
		    		window.opener.document.form1.ordtracodigo1.value = miArray1[1];
	    		}
	    		
	    		if(miArray1[0] == "arreglo_aux")
	    		{
					window.opener.document.form1.arreglo_aux.focus();
	    		}
	    		if(miArray1[0] == "loaditem")
	    		{
					window.opener.document.form1.loaditem.focus();
	    		}	    		
	    		
	    		if(miArray1[0] == "pasadmerini")
	    		{
	    			if(miArray1[1]==1)
	    			{
						window.opener.document.form1.pasadmerini.checked = true;
	    			}
	    			else
	    			{
						window.opener.document.form1.pasadmerini.checked = false;
	    			}
	    		}
	    		
	    		if(miArray1[0] == "pasadmerfin")
	    		{
	    			if(miArray1[1]==1)
	    			{
						window.opener.document.form1.pasadmerfin.checked = true;
	    			}
	    			else
	    			{
						window.opener.document.form1.pasadmerfin.checked = false;
	    			}
	    		}	    		
	    	}
	    }
	}
 	window.opener.document.getElementById("divreport").style.visibility="hidden";
    window.opener.focus();
    window.close();
}