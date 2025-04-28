<!--Propiedad intelectual de adsum (c).-->
<!--Funcion         : cargarVistaotaux-->
<!--Decripcion      : abre un archivo php sin recargar el formulario-->
<!--Parametros      : valor		el valor del atributo del formulario-->
<!--Retorno         : null-->
<!--Autor           : mstroh-->
<!--Fecha           : 17-Nov-2005-->

function cargarVistaotaux(valor)
{
	/*
	Esta funcion solo ejecuta jsrsExecute con los siguientes parametros:
	1: Fichero [url] del .php que ofrece el servicio
	2: nombre de la funcion que recibir:: el resultado ... recibe siempre un par::metro
	3: nombre de la funcion a ejecutar en el servidor
	4: parametros a enviar al servidor ... en este caso un numero
	*/
	var cad_array = valor.split("|");

	jsrsExecute("procVistaot.php", cargarVistaotAuxResult, "mostrarOt", cad_array[0]);
}
function cargarVistaotAuxResult(cadena)
{	
	/* LIMPIA LOS CAMPOS DEL FORMULARIO DE OT */
	window.opener.document.form1.ordtracodigo.value = "";
	window.opener.document.form1.ordtrafecgen.value = "";
	window.opener.document.form1.ordtrahorgen.value = "";
	window.opener.document.form1.plantanombre.value	= "";
	window.opener.document.form1.equiponombre.value	= "";
	window.opener.document.form1.sistemnombre.value	= "";
	window.opener.document.form1.componnombre.value	= "";
	window.opener.document.form1.tipmannombre.value	= "";
	window.opener.document.form1.priorinombre.value	= "";
	window.opener.document.form1.ordtrafecini.value	= "";
	window.opener.document.form1.ordtrahorini.value	= "";
	window.opener.document.form1.ordtrafecfin.value	= "";
	window.opener.document.form1.ordtrahorfin.value	= "";
	window.opener.document.form1.empleacod.value	= "";
	window.opener.document.form1.empleanomb.value	= "";
	window.opener.document.form1.usuarios_aux.value	= "";
	/* END */
	if(cadena != "")
	{
		miArray  = jsrsArrayFromString(cadena,"@");
		
		for(var i=0;i<miArray.length;i++)
		{
			var miArray_aux = miArray[i].split("::");

			if(!(window.opener.document.form1.elements[miArray_aux[0]] == undefined))
			{
				window.opener.document.form1.elements[miArray_aux[0]].value = miArray_aux[1];
			}
		}
	}
	/* Carga los auxiliares de mantenimiento */
	window.opener.document.form1.usuarios_aux.style.display = 'inline';

	if(window.opener.document.form1.usuarios_aux.value != "")
	{
		window.opener.document.getElementById('usuariosAux').style.display = 'inline';
	}
	else
	{
		window.opener.document.getElementById('usuariosAux').style.display = 'none';
	}
	window.opener.document.form1.usuarios_aux.focus();
	window.opener.focus();
	self.close();
}