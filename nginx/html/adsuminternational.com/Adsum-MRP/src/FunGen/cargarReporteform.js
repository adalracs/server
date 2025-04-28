/**
* Propiedad intelectual de Adsum (c).
*  Todos los derechos reservados
*
* Funcion: 			cargaReporteform
* Descripcion:		Genera dinamicamente opciones para realizar una consulta
*					en el Generador de Reportes.
* Argumentos:		startP -> Punto en el formulario en donde se crearan los objetos
*							  dinamicos.
*
* Autor: mstroh
* Fecha: 12-JUN-2006
*/

function cargaReporteform(startP)
{
	// Contador
	var i=0;
	// Consecutivo de los nuevos elementos
	var counter = window.document.form1.counter.value;

	counter = parseInt(counter) + 1;
	//
	var tabla 	= document.createElement("TABLE");
	var tblBody = document.createElement("TBODY");
	var tblRow 	= document.createElement("TR");
	//- -
	var tblCell_1 = document.createElement("TD");
	var tblCell_2 = document.createElement("TD");
	var tblCell_3 = document.createElement("TD");
	var tblCell_4 = document.createElement("TD");
	var tblCell_5 = document.createElement("TD");
	//- -

	// Propiedades de la tabla
	tabla.width = "100%";
	tabla.border = "0";
	tabla.id = "tbl_" + counter;
	//

	// Capas usadas para mostrar/ocultar opciones/texto
	var span_text = document.createElement('SPAN');
	var span_select = document.createElement('SPAN');

	span_text.id = "spanText_" + counter;
	span_select.id = "spanSelect_" + counter;
	span_text.style.display = "inline";
	span_select.style.display = "none";
	//--

	// Pirmer SELECT - Precondicion
	var select_pre = document.createElement("SELECT");
	var selectPre_length = window.document.form1.elements['pre_' + (counter-1)].options.length;

	select_pre.name = "pre_" + counter;
	//--

	// Segundo SELECT - Condicion
	var select_cond = document.createElement("SELECT");
	var selectCond_length = window.document.form1.elements['cond_1'].options.length;

	select_cond.name = "cond_" + counter;
	//--

	// Segundo SELECT - Postcondicion
	var select_post = document.createElement("SELECT");

	select_post.name = "post_" + counter;
	//--

	// TEXT - Postcondicion (valor ingresado por el usuario)
	var text_post = document.createElement("INPUT");

	text_post.type = "TEXT";
	text_post.size = "18";
	text_post.name = "postt_" + counter;
	//--


	//--
	var href_change = document.createElement("A");

	href_change.href = "javascript:;";
	href_change.innerHTML = "Opciones";
	href_change.id = counter;
	href_change.onclick = function () {
								cambiaCondic(href_change);
							}
	//--

	//-- AND/OR
	var select_connector = document.createElement("SELECT");
	var selectConn_length = window.document.form1.elements['connector_1'].options.length;

	select_connector.name = "connector_" + counter;
	//--

	// Llenado de cada elemento del formulario

	for(i=0; i<selectPre_length; i++)
		select_pre.options[i] = new Option(window.document.form1.elements['pre_' + (counter-1)].options[i].text, window.document.form1.elements['pre_' + (counter-1)].options[i].value, false, false);

	for(i=0; i<selectPre_length; i++)
		select_post.options[i] = new Option(window.document.form1.elements['post_' + (counter-1)].options[i].text, window.document.form1.elements['post_' + (counter-1)].options[i].value, false, false);

	for(i=0; i<selectCond_length; i++)
		select_cond.options[i] = new Option(window.document.form1.cond_1.options[i].text, window.document.form1.cond_1.options[i].value, false, false);

	for(i=0; i<selectConn_length; i++)
		select_connector.options[i] = new Option(window.document.form1.connector_1.options[i].text, window.document.form1.connector_1.options[i].value, false, false);

	tabla.appendChild(tblBody);
	tblBody.appendChild(tblRow);
	tblRow.appendChild(tblCell_1);
	tblRow.appendChild(tblCell_2);
	tblRow.appendChild(tblCell_3);
	tblRow.appendChild(tblCell_4);
	tblRow.appendChild(tblCell_5);
	tblCell_1.appendChild(select_pre);
	tblCell_2.appendChild(select_cond);
	tblCell_3.appendChild(span_text);
	tblCell_3.appendChild(span_select);
	tblCell_4.appendChild(select_connector);
	tblCell_5.appendChild(href_change);
	span_select.appendChild(select_post);
	span_text.appendChild(text_post);
	document.getElementById(startP).appendChild(tabla);

	window.document.form1.counter.value = counter;
}

function remove()
{
//	var me = document.getElementById('tbl_2');
//
//	me.parentNode.removeChild('tbl_2');
}