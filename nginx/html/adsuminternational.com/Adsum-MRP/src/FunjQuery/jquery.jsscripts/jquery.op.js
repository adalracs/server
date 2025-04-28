$(function(){
	
	$("#bandejaotgeneral").tabs({
		ajaxOptions: {
			error: function(xhr, status, index, anchor) {
				$(anchor.hash).html("No se puede cargar esta pesta&ntilde;a. Vamos a tratar de solucionar este problema lo m&aacute;s pronto posible.");
			}
		}
	});

	$('#generar_opp').button({ icons: { primary: "ui-icon-gear" } }).click(function() {
		//objetos a utilizar
		var obj_arrop = document.getElementById('arrop');
		//valor de los objetos
		var arrop = (obj_arrop)? obj_arrop.value : '' ; 
		//acccion del boton
		document.form1.action='ingrnuevopp.php';
		document.form1.submit();
		return false;
	});

	$('#simular_opp').button({ icons: { primary: "ui-icon-gear" } }).click(function() {
		//objetos a utilizar
		var obj_arrop = document.getElementById('arrop');
		//valor de los objetos
		var arrop = (obj_arrop)? obj_arrop.value : '' ; 
		//validacion de error
		var err = '' ;
		if(arrop == '')
			err = err + 'Advertencia : *** Debe seleccionar una o varias op.' ;
		
		if(err == '')
		{
			//acccion del boton
			document.form1.action='simularopp.php';
			document.form1.submit();
		}
		else
		{
			//mensaje de error
			document.getElementById('msg').innerHTML = err;
			$("#msgwindow").dialog("open");
		}
		return false;
	});
		
	$('#editar_programa').button({ icons: { primary: "ui-icon-gear" } }).click(function() {
		//acccion del boton		
		document.form1.action='_editarprogramaextrusion.php';
		document.form1.submit();
		return false;
	});
	
});


function number_format( number, decimals, dec_point, thousands_sep ) {
    // http://kevin.vanzonneveld.net
    // + original by: Jonas Raoni Soares Silva (http://www.jsfromhell.com)
    // + improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // + bugfix by: Michael White (http://crestidg.com)
    // + bugfix by: Benjamin Lupton
    // + bugfix by: Allan Jensen (http://www.winternet.no)
    // + revised by: Jonas Raoni Soares Silva (http://www.jsfromhell.com)
    // * example 1: number_format(1234.5678, 2, '.', '');
    // * returns 1: 1234.57
     
    var n = number, c = isNaN(decimals = Math.abs(decimals)) ? 2 : decimals;
    var d = dec_point == undefined ? "," : dec_point;
    var t = thousands_sep == undefined ? "." : thousands_sep, s = n < 0 ? "-" : "";
    var i = parseInt(n = Math.abs(+n || 0).toFixed(c)) + "", j = (j = i.length) > 3 ? j % 3 : 0;
     
    return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
}

function eventAnchoBobina()
{
	//objetos a utilizar
	var obj_nrop = document.getElementById('nr_op');
	var obj_ordoppanchoe = document.getElementById('ordoppanchoe');
	var obj_ordopprefile = document.getElementById('ordopprefile');
	//valor de los objetos
	var ordopprefile = (obj_ordopprefile)? obj_ordopprefile.value : '' ;
	var nrop = (obj_nrop)? obj_nrop.value : '' ;
	var ordoppanchoe = 0;
	//objetos de etiquetas a usar
	var lbl_ordoppanchoe = document.getElementById('ordoppanchoe_lb'); 
	//accion de la funcion
	for(i = 0;i < nrop;i++)
	{
		//objetos label {span}
		var lbls_anchot = 'lb_anchot_' + i;
		var lbl_anchot = document.getElementById(lbls_anchot);
		//variables a utilizar
		var objs_pista = 'pista_' + i;		
		var objs_ancho = 'ancho_' + i;
		var objs_anchot = 'anchot_' + i;
		//objetos a utilizar	 
		var obj_pista = document.getElementById(objs_pista);
		var obj_ancho = document.getElementById(objs_ancho);
		var obj_anchot = document.getElementById(objs_anchot);
		//valor de los objetos
		var pista = (obj_pista)? obj_pista.value : '' ;
		var ancho = (obj_ancho)? obj_ancho.value : '' ;
		var anchot = (obj_anchot)? obj_anchot.value : '' ;
		//validacion adiconal de enteros
		if(!/^([0-9])*$/.test(pista))
			pista = 1;
		//accion del ciclo
		anchot = (Number(ancho) * Number(pista));
		ordoppanchoe = ordoppanchoe + anchot;
		//asignar valores a ancho total
		if(obj_anchot)
			obj_anchot.value = anchot;
		if(lbl_anchot)
			lbl_anchot.innerHTML = anchot;
	}
	ordoppanchoe = ordoppanchoe + Number(ordopprefile);
	//asignar valores a objetos y labels
	if(obj_ordoppanchoe) obj_ordoppanchoe.value = ordoppanchoe;
	if(lbl_ordoppanchoe) lbl_ordoppanchoe.innerHTML = ordoppanchoe;
	eventPorcen();
}

function eventPorcen()
{
	//objetos a utilizar
	var obj_nrop = document.getElementById('nr_op');
	var obj_ordoppanchoe = document.getElementById('ordoppanchoe');
	var obj_ordoppcantid = document.getElementById('ordoppcantid');
	//valor de los objetos
	var nrop = (obj_nrop)? obj_nrop.value : '' ;
	var ordoppanchoe = (obj_ordoppanchoe)? obj_ordoppanchoe.value : '' ;
	var ordoppcantid = (obj_ordoppcantid)? obj_ordoppcantid.value : '' ;
	//accion de la funcion
	for(i = 0;i < nrop;i++)
	{
		//objetos label {span}
		var lbls_porcen = 'lb_porcen_' + i;
		var lbls_cantid = 'lb_cantid_' + i;
		var lbl_porcen = document.getElementById(lbls_porcen);
		var lbl_cantid = document.getElementById(lbls_cantid);
		//variables a utilizar
		var objs_porcen = 'porcen_' + i;	
		var objs_anchot = 'anchot_' + i;
		var objs_cantid = 'cantid_' + i;
		//objetos a utilizar	 
		var obj_porcen = document.getElementById(objs_porcen);
		var obj_anchot = document.getElementById(objs_anchot);
		var obj_cantid = document.getElementById(objs_cantid);
		//valor de los objetos
		var porcen = (obj_porcen)? obj_porcen.value : '' ;
		var anchot = (obj_anchot)? obj_anchot.value : '' ;
		var cantid = (obj_cantid)? obj_cantid.value : '' ;
		//accion del ciclo		
		porcen = (Number(anchot) / Number(ordoppanchoe));		
		cantid = (Number(porcen) * Number(ordoppcantid));		
		//asignar valores a porcentahe y cantidad
		if(obj_porcen) obj_porcen.value = porcen;
		if(obj_cantid) obj_cantid.value = cantid;
		if(lbl_porcen) lbl_porcen.innerHTML = number_format((porcen * 100), 2, ',', '.');
		if(lbl_cantid) lbl_cantid.innerHTML = number_format(cantid, 2, ',', '.');
	}
}

function ajax_filtro()
{
	//objetos a utilizar
	var obj_plantacodigo = document.getElementById('plantacodigo');
	var obj_formulnumero = document.getElementById('formulnumero');
	var obj_ordprocalib = document.getElementById('ordprocalib');
	var obj_arrop = document.getElementById('arrop');
	//valor de los objetos
	var plantacodigo = (obj_plantacodigo)? obj_plantacodigo.value : '' ; 
	var formulnumero = (obj_formulnumero)? obj_formulnumero.value : '' ; 
	var ordprocalib = (obj_ordprocalib)? obj_ordprocalib.value : '' ; 
	var arrop = (obj_arrop)? obj_arrop.value : '' ; 
	//parametros de envio
	var parameters = '' ;
	parameters = (plantacodigo != '')? parameters + 'plantacodigo=' + plantacodigo : parameters + 'plantacodigo=' ;
	parameters = (formulnumero != '')? parameters + '&formulnumero=' + formulnumero : parameters + '&formulnumero=' ;
	parameters = (ordprocalib != '')? parameters + '&ordprocalib=' + ordprocalib : parameters + '&ordprocalib=' ;
	parameters = (arrop != '')? parameters + '&arrop=' + arrop : parameters + '&arrop=' ;
	$.ajax({	   
		dataType: "html",
		type: "POST",        
		url: "detallabandejaextrusion.php",
		data: parameters,
		success: function(requestData){
			document.getElementById('detallebandejaextrusion').innerHTML = requestData;
		}
	});
}