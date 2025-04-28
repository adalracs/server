/**
* Propiedad intelectual de Adsum (c).
*  Todos los derechos reservados
*
* Funcion:			cargarReportConsulta
* Argumentos:		void
* Descripcion:		Genera una cadena a partir de los datos seleccionados en el formulario
*					para crear una consulta SQL
*
* Autor: mstroh
*
* Historial de modificaciones
* ---------------------------
* Autor     | Fecha		| Motivo
*
*/

function cargarReportConsulta()
{
	var n=1;
	var strSelectedTables = "";
	var strSelectedFields = "";
	var strSelectedPrecon = "";
	var strSelectedCondit = "";
	var strSelectedPoscon = "";
	var strSelectedConnec = "";

	// Tablas
	if (window.document.form1.seltable.options.length != 0)
		for (var i=0; i<window.document.form1.seltable.options.length; i++)
			strSelectedTables = strSelectedTables + window.document.form1.seltable.options[i].value + ",";

	// Conectores
	if (window.document.form1.selfield.options.length != 0)
		for (var i=0; i<window.document.form1.selfield.options.length; i++)
			strSelectedFields = strSelectedFields + window.document.form1.selfield.options[i].value + ",";

	// Precondiciones
	for (var i=0; i<window.document.form1.elements.length; i++)
		if(window.document.form1.elements[i].name.indexOf('pre_') != -1)
			if(window.document.form1.elements[i].options[window.document.form1.elements[i].selectedIndex].value != "")
				strSelectedPrecon = strSelectedPrecon + window.document.form1.elements[i].options[window.document.form1.elements[i].selectedIndex].value + ",";

	// Condiciones
	for (var i=0; i<window.document.form1.elements.length; i++)
		if(window.document.form1.elements[i].name.indexOf('cond_') != -1)
			if(window.document.form1.elements[i].options[window.document.form1.elements[i].selectedIndex].value != "")
				strSelectedCondit = strSelectedCondit + window.document.form1.elements[i].options[window.document.form1.elements[i].selectedIndex].value + ",";

	// Postcondiciones
	while (document.getElementById('spanText_' + n) != undefined)
	{
		if(document.getElementById('spanText_' + n).style.display == "inline")
		{
			strSelectedPoscon = strSelectedPoscon + window.document.form1.elements['postt_' + n].value + "|,";
			n++;
		}
		else {
			strSelectedPoscon = strSelectedPoscon + window.document.form1.elements['post_' + n].options[window.document.form1.elements['post_' + n].selectedIndex].value + ",";
			n++;
		}
	}

	// Conectores
	for (var i=0; i<window.document.form1.elements.length; i++)
		if(window.document.form1.elements[i].name.indexOf('connector_') != -1)
			if(window.document.form1.elements[i].options[window.document.form1.elements[i].selectedIndex].value != "")
				strSelectedConnec = strSelectedConnec + window.document.form1.elements[i].options[window.document.form1.elements[i].selectedIndex].value + ",";

	window.document.form1.strSelectedTables.value = strSelectedTables.substr(0, strSelectedTables.length-1);
	window.document.form1.strSelectedFields.value = strSelectedFields.substr(0, strSelectedFields.length-1);
	window.document.form1.strSelectedPrecon.value = strSelectedPrecon.substr(0, strSelectedPrecon.length-1);
	window.document.form1.strSelectedCondit.value = strSelectedCondit.substr(0, strSelectedCondit.length-1);
	window.document.form1.strSelectedPoscon.value = strSelectedPoscon.substr(0, strSelectedPoscon.length-1);
	window.document.form1.strSelectedConnec.value = strSelectedConnec.substr(0, strSelectedConnec.length-1);
}