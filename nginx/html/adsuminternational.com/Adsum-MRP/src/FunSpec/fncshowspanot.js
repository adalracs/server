/**
* Propiedad intelectual de Adsum (c).
*  Todos los derechos reservados
*
* Funcion: 			fncshowspanot
* Argumentos: 		anchor_id --> Id del link que activa/desactiva los SPAN del formulario de OT
* Descripcion:		Activa/desactiva los SPAN del formulario de OT que son utilizados para la
*					consulta rapida de equipos/componentes.
*
* Fecha: 05-DIC-2006
*
* Historial de modificaciones
* ---------------------------
* Autor     | Fecha		  | Motivo
*/ 

function fncshowspanot(anchor_id)
{
	var plantaSelectId = window.document.form1.plantacodigo;
	var sistemaSelectId = window.document.form1.sistemcodigo;
	var spnSelect = window.document.getElementById("spnSelect_" + anchor_id);
	var spnText = window.document.getElementById("spnText_" + anchor_id);

	
	if (spnText.style.display == "inline")
	{
		spnText.style.display = "none";
		spnSelect.style.display = "inline";
				
		if (anchor_id == "componen")
		{
			window.document.getElementById("spnSelect_equipo").style.display = "inline";
			window.document.getElementById("spnText_equipo").style.display = "none";
		}
		else
		{
			window.document.getElementById("spnSelect_componen").style.display = "inline";
			window.document.getElementById("spnText_componen").style.display = "none";
		}

		plantaSelectId.disabled = false;
		sistemaSelectId.disabled = false;
		window.document.form1.componentetexto.value = "0";
		window.document.form1.equipotexto.value = "0";
	}
	else {
		spnText.style.display = "inline";
		spnSelect.style.display = "none";
		plantaSelectId.disabled = true;
		sistemaSelectId.disabled = true;
		if(anchor_id == "componen")
		{	
			window.document.getElementById("spnSelect_equipo").style.display = "none";
			window.document.getElementById("spnText_equipo").style.display = "inline";
		
			
		}
		else
		{
			window.document.getElementById("spnSelect_componen").style.display = "none";
			window.document.getElementById("spnText_componen").style.display = "inline";
			
		}
		window.document.form1.componentetexto.value = "1";
		window.document.form1.equipotexto.value = "1";
	}
	
}