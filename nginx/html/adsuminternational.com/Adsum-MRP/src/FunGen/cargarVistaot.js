<!--Propiedad intelectual de adsum (c).-->
<!--Funcion         : cargarVistaot-->
<!--Decripcion      : abre un archivo php sin recargar el formulario-->
<!--Parametros      : valor	el valor del atributo del formulario-->
<!--Retorno         : null-->
<!--Autor           : lfolaya-->
<!--Fecha           : 17-Nov-2005-->

function cargarVistaot(valor)
{
	/*
	Esta funcion solo ejecuta jsrsExecute con los siguientes parametros:
	1: Fichero [url] del .php que ofrece el servicio
	2: nombre de la funcion que recibir:: el resultado ... recibe siempre un par::metro
	3: nombre de la funcion a ejecutar en el servidor
	4: parametros a enviar al servidor ... en este caso un numero
	*/
	
	var cadArray = valor.split("|");

	jsrsExecute("procVistaot.php", cargarVistaotResultado, "mostrarOt", cadArray[0]);
}
function cargarVistaotResultado(cadena)
{
	var ref_tipm = window.opener.document.form1.tipmancodigo_h.ownerDocument;
	var ref_tipt = window.opener.document.form1.tiptracodigo_h.ownerDocument;
	var ref_prio = window.opener.document.form1.prioricodigo_h.ownerDocument;
	var ref_tare = window.opener.document.form1.tareacodigo_h.ownerDocument;

	if (!ref_tipm)
	{
		ref_tipm = window.opener.document.form1.tipmancodigo_h.document;
	}

	if (!ref_tipt)
	{
		ref_tipt = window.opener.document.form1.tiptracodigo_h.document;
	}

	if (!ref_prio)
	{
		ref_prio = window.opener.document.form1.prioricodigo_h.document;
	}

	if (!ref_tare)
	{
		ref_tare = window.opener.document.form1.tareacodigo_h.document;
	}

	window.opener.document.form1.ordtracodigo.value="";
	window.opener.document.form1.tipmannombre.value="";
	window.opener.document.form1.priorinombre.value="";
	window.opener.document.form1.tiptranombre.value="";
	window.opener.document.form1.tareanombre.value="";
	window.opener.document.form1.ordtranota.value="";
	window.opener.document.form1.empleanomb.value="";
	window.opener.document.form1.usuarios_aux.value="";
	window.opener.document.form1.items_aux.value="";

	if(cadena != "")
	{
		miArray  = jsrsArrayFromString(cadena,"@");
		//alert(miArray.length);
		for(var i=0;i<miArray.length;i++)
		{
			miArray1  = jsrsArrayFromString(miArray[i],"::");

			switch(miArray1[0])
			{
				case "tipmancodigo":
				var option_tipm = ref_tipm.createElement('OPTION');

				arr_def = miArray1[1].split(",");
				option_tipm.value = arr_def[0];
				option_tipm.text = arr_def[1];
				option_tipm.selected = true;
				window.opener.document.form1.tipmancodigo_h.options.add(option_tipm, 0);
				window.opener.document.form1.tipmancodigo_o.value = arr_def[0];
				break;

				case "tiptracodigo":
				var option_tipt = ref_tipt.createElement('OPTION');

				arr_def = miArray1[1].split(",");
				option_tipt.value = arr_def[0];
				option_tipt.text = arr_def[1];
				option_tipt.selected = true;
				window.opener.document.form1.tiptracodigo_h.options.add(option_tipt, 0);
				window.opener.document.form1.tiptracodigo_o.value = arr_def[0];
				break;

				case "prioricodigo":
				var option_prio = ref_prio.createElement('OPTION');

				arr_def = miArray1[1].split(",");
				option_prio.value = arr_def[0];
				option_prio.text = arr_def[1];
				option_prio.selected = true;
				window.opener.document.form1.prioricodigo_h.options.add(option_prio, 0);
				window.opener.document.form1.prioricodigo_o.value = arr_def[0];
				break;

				case "tareacodigo":
				var option_tare = ref_tare.createElement('OPTION');

				arr_def = miArray1[1].split(",");
				option_tare.value = arr_def[0];
				option_tare.text = arr_def[1];
				option_tare.selected = true;
				window.opener.document.form1.tareacodigo_h.options.add(option_tare, 0);
				window.opener.document.form1.tareacodigo_o.value = arr_def[0];
				break;
			}

			if(!(window.opener.document.form1.elements[miArray1[0]] == undefined))
			{
				window.opener.document.form1.elements[miArray1[0]].value = miArray1[1];
			}
		}
	}
	window.opener.document.form1.delete_options.style.display = 'inline';
	window.opener.document.form1.items_aux.style.display      = 'inline';
	window.opener.document.form1.usuarios_aux.focus();
	window.opener.document.form1.delete_options.focus();
	window.opener.document.form1.items_aux.focus();
}
function cargarVistaotEdit(cadena)
{
	window.document.form1.ordtracodigo.value="";
	window.document.form1.tipmannombre.value="";
	window.document.form1.priorinombre.value="";
	window.document.form1.tiptranombre.value="";
	window.document.form1.tareanombre.value="";
	window.document.form1.ordtranota.value="";
	window.document.form1.empleanomb.value="";
	window.opener.document.form1.usuarios_aux.value="";

	if(cadena != "")
	{
		miArray  = jsrsArrayFromString(cadena,"@");

		for(var i=0;i<miArray.length;i++)
		{
			miArray1  = jsrsArrayFromString(miArray[i],"::");

			if(!(window.document.form1.elements[miArray1[0]] == undefined))
			{
				window.document.form1.elements[miArray1[0]].value = miArray1[1];
			}
		}
	}
	window.focus();
}