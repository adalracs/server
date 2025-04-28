<!--Propiedad intelectual de adsum (c).-->
<!--Funcion         : cargarOtestadoot-->
<!--Decripcion      : abre un archivo php sin recargar el formulario-->
<!--Parametros      : valor		el valor del atributo del formulario-->
<!--Retorno         : null-->
<!--Autor           : ariascos-->
<!--Fecha           : 04-ene-2006-->
function cargarOtestadoot(valor)
{
	/*
	Esta funcion solo ejecuta jsrsExecute con los siguientes parametros:
	1: Fichero [url] del .php que ofrece el servicio
	2: nombre de la funcion que recibir� el resultado ... recibe siempre un par�metro
	3: nombre de la funcion a ejecutar en el servidor
	4: parametros a enviar al servidor ... en este caso un numero

	*/
	var value = valor.split('|');
	jsrsExecute("procOtestadoot.php", cargarOtestadootResultado, "mostrarEstados", value[0]);
}

/**
/*	Funcion: 		cargarOtestadootResultado
/*	Descripcion:	Toma el valor devuelto por procOtestadoot.php y crea opciones en
/*					el formulario de ingrnuevhistoriaot.php, llenando los <select> y
/*					los <input type="text"> pertinentes.
/*	Parametros:		cadena
/*	Retorno:		NULL
/*	Autor:			mstroh
/*	Fecha:			06-ene-2006
/***			***/

function cargarOtestadootResultado(cadena)
{
	var ref = window.opener.document.form1.otestacodigo.ownerDocument;

	if (!ref)
	{
		ref = window.opener.document.form1.otestacodigo.document;
	}

	window.opener.document.form1.otestacodigo.length = 0;
	window.opener.document.form1.flagrport.value = 0;
	window.opener.document.form1.flagcclosed.value = 0;

	if(!((window.opener.document.getElementById('cierre') == undefined) || (window.opener.document.getElementById('reporte') == undefined)))
	{
		if(window.opener.document.getElementById('cierre').style.display == 'inline')
		{
			window.opener.document.getElementById('cierre').style.display = 'none';
		}

		if(window.opener.document.getElementById('reporte').style.display == 'inline')
		{
			window.opener.document.getElementById('reporte').style.display = 'none';
		}

		if(window.opener.document.getElementById('divic').style.display == 'inline')
		{
			window.opener.document.getElementById('divic').style.display = 'none';
		}
	}

	if(cadena != "")
	{
		var def_array = jsrsArrayFromString(cadena, "," );
		var arrNum;

		arrNum = (def_array.length/2);

		for(var i=0; i<arrNum; i++)
		{
			var option = ref.createElement('OPTION');

			if(i==(arrNum-1))
			{
				// --- --- Muestra en el formulario los <SPAN> ocultos --- --- ---
				switch(def_array[2*i])
				{
					case "rport":
					window.opener.document.getElementById('reporte').style.display = 'inline';
					window.opener.document.getElementById('divic').style.display = 'inline';
					window.opener.document.form1.flagrport.value = 1;
					window.opener.document.form1.flagcclosed.value = 0;
					break;

					case "cclosed":
					window.opener.document.getElementById('cierre').style.display = 'inline';
					window.opener.document.getElementById('divic').style.display = 'inline';
					window.opener.document.form1.flagcclosed.value = 1;
					window.opener.document.form1.flagrport.value = 0;
					break;
				}
				break;
			}

			option.value = def_array[2*i];
			option.text =  def_array[(2*i)+1];
			window.opener.document.form1.otestacodigo.options.add(option, i);
		}
		window.opener.document.form1.flagrport.style.display = 'inline';
		window.opener.document.form1.flagrport.focus();
		self.close();
		return;
	}
	// --- --- Crea las opciones en el formulario --- --- ---
	var option = ref.createElement('OPTION');

	option.value = "";
	option.text = "Seleccione";
	window.opener.document.form1.otestacodigo.options.add(option, 0);
	self.close();
}