/**
* Propiedad intelectual de Adsum (c).
*  Todos los derechos reservados
*
* Funcion:			validaformtimedfal
* Argumentos:		void
* Descripcion:		Valida que los campos obligatorios
*					en el formulario, contengan datos validos.
*
* Fecha: 29092006
* Autor: mstroh
*
* Historial de modificaciones
* ---------------------------
* Autor     | Fecha		| Motivo
*
*/

function validaformtimedfal()
{
	var hoursum;
	var flagerror = false;

	for (var i=0; i<window.document.form1.elements.length; i++)
	{
		if (window.document.form1.elements[i].type == "text")
		{
			if (window.document.form1.elements[i].name.indexOf("horasOperac_") != -1)
			{
				if (window.document.form1.elements[i].value == "")
				{
					flagerror = true;
				}
				else if (isNaN(window.document.form1.elements[i].value))
				{
					window.document.form1.elements[i].className = "NoiseErrorDataTD";
					flagerror = true;
				}
				else
				{
					(hoursum == undefined) ? hoursum = window.document.form1.elements[i].value + ',' : hoursum += window.document.form1.elements[i].value + ',';

					if (window.document.form1.elements[i].className == "NoiseErrorDataTD")
						window.document.form1.elements[i].className = "";
				}
			}
			else if (window.document.form1.elements[i].name.indexOf("fec") != -1)
			{
				if (window.document.form1.elements[i].value == "")
					flagerror = true;
			}
		}
	}
	if (!flagerror)
	{
		var iniDate = window.document.form1.fecini.value.split('-');
		var endDate = window.document.form1.fecfin.value.split('-');

		if (endDate[0] <= iniDate[0])
		{
			if (endDate[1] <= iniDate[1])
			{
				if (endDate[2] <= iniDate[2])
				{
					alert("La fecha de fin debe ser mayor o igual a la fecha final");
					return false;
				}
			}
		}
		window.document.form1.strdatahoras.value = hoursum;
		return true;
	}
	alert("Ocurrio algun error al ingresar los datos \n Llenar los campos vacios o no seleccionados");
	return false;
}