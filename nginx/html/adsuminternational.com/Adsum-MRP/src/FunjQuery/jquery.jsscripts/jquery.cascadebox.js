/**
 * accionLoadSelect
 * Carga el contenido de un select [Para objetos referencia en cascada]
 * @param code
 * @param table
 * @param comboId
 * @return
 */
function accionLoadSelect(code, table, comboId)
{
	$.getJSON("../src/FunjQuery/jquery.phpcombobox/jquery.cascadebox.php",  { id: code, tabla: table }, 
		function(data) {
			var xpos = 0;
		
			document.getElementById(comboId).length = 1;
			document.getElementById(comboId).options[xpos] = new Option(" -- Seleccione --", "", true, true);	
	
			$.each(data, function(key, val) {
				xpos++;
				document.getElementById(comboId).options[xpos] = new Option(val.label, val.id, false, false);
			});
	});
}

/*
 * funcion duplicada por necesidad de avance en el proceso
 */
function accionLoadSelect1(code,equipo_id, table, comboId)
{
	$.getJSON("../src/FunjQuery/jquery.phpcombobox/jquery.cascadebox.php",  { id: code, tabla: table , equipo : equipo_id }, 
		function(data) {
			var xpos = 0;
		
			document.getElementById(comboId).length = 1;
			document.getElementById(comboId).options[xpos] = new Option(" -- Seleccione --", "", true, true);	
	
			$.each(data, function(key, val) {
				xpos++;
				document.getElementById(comboId).options[xpos] = new Option(val.label, val.id, false, false);
			});
	});
}

/**
 * accionLoadSelectOff
 * Descarga el contenido de un select [Para objetos referencia en cascada]
 * @param comboId
 * @return
 */
function accionLoadSelectOff(comboId)
{
	var xpos = 0;
	
	document.getElementById(comboId).length = 1;
	document.getElementById(comboId).options[xpos] = new Option(" -- Seleccione --", "", true, true);	
}