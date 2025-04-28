<?php 
ob_start();
	include ( '../src/FunGen/sesion/fncvalses.php');
	include ( '../src/FunPerPriNiv/pktblusuario.php');
	include ( '../src/FunPerPriNiv/pktblcampertippro.php');
	include ( '../src/FunPerPriNiv/pktblcamperdesarr.php');
	include ( '../src/FunPerPriNiv/pktblcamperplanea.php');
	include ( '../src/FunPerPriNiv/pktblcptpdetope.php');
	include ( '../src/FunPerPriNiv/pktblcpdesadetope.php');
	include ( '../src/FunPerPriNiv/pktblcpplandetope.php');
	include ( '../src/FunPerPriNiv/pktblproducformula.php');
	include ( '../src/FunPerPriNiv/pktblproducpadreitem.php');
	include ( '../src/FunPerPriNiv/pktblproducpedido.php');
	include ( '../src/FunPerPriNiv/pktblplanta.php');
	include ( '../src/FunPerPriNiv/pktbltiposoliprog.php');
	include ( '../src/FunPerPriNiv/pktblpadreitem.php');
	include ( '../src/FunPerPriNiv/pktblitemdesa.php');
	include ( '../src/FunPerPriNiv/pktblplaneapadreitem.php');
	include ( '../src/FunPerPriNiv/pktblplaneaitemdesa.php');
	include ( '../src/FunPerPriNiv/pktblformulacion.php');
	include ( '../src/FunGen/cargainput.php');
	
	if($accioneditarvistasoliextru) 
		include ( 'editavistasoliextru.php');

ob_end_flush();

	if(!$flageditarvistasoliextru)
	{
		include ( '../src/FunGen/sesion/fnccarga.php');
		$sbreg = fnccarga($nombtabl,$radiobutton);
		if (!$sbreg)
			include( '../src/FunGen/fnccontfron.php');
		//regriso de vistasoliextru
		$idcon = fncconn();
		$solprocodigo = $sbreg['solprocodigo'];
		$estsolcodigo = $sbreg['estsolcodigo']; 
		$usuacodigo = $sbreg['usuacodi']; 
		$produccodigo = $sbreg['produccodigo'];
		$produccoduno = $sbreg['produccoduno'];
		$tipevecodigo = $sbreg['tipevecodigo'];
		$pedvennumero = $sbreg['pedvennumero'];
		$solprofecha = $sbreg['solprofecha']; 
		$solprohora = $sbreg['solprohora']; 
		$plantacodigo = $sbreg['plantacodigo'];
		$procedcodigo = $sbreg['procedcodigo'];  
		$procednombre = $sbreg['procednombre'];  
		$plarutcodigo = $sbreg['plarutcodigo']; 
		$producto = $produccodigo;		
		include 'cargarcampertippro.php';
		$producto = $produccodigo;
		include 'cargarcamperdesarr.php';
		$producto = $produccodigo;
		include 'cargarcamperplanea.php';
		fncconn($idcon);
	}
		$idcon = fncconn();
		//escaneo a la tabla planea padreitem
		$nr_op = 0;
		$rsPlaneapadreitem = dinamicscanplaneapadreitem(array("produccodigo" => $produccodigo),$idcon);
		//consulta numero de materiales planeados
		$nrPlaneapadreitem = fncnumreg($rsPlaneapadreitem);
		//recorre consulta
		for($i=0;$i<$nrPlaneapadreitem;$i++)
		{
			//trae registo de padre item dependiendo de su indice
			$rwPlaneapadreitem = fncfetch($rsPlaneapadreitem,$i);
			$rwpadreitem = loadrecordpadreitem($rwPlaneapadreitem['paditecodigo'],$idcon);
			//consulta su el material es extruido
			if($rwpadreitem['paditeextrui'] == 't' && $rwPlaneapadreitem['plapadcantkg'] && $rwPlaneapadreitem['plapadcantmt'])
			{
				$obj_material = 'material_'.$nr_op;
				$obj_calibre = 'calibre_'.$nr_op;
				$obj_cant_kg = 'cant_kg_'.$nr_op;
				$obj_cant_mt = 'cant_mt_'.$nr_op;
				$obj_ancho = 'ancho_'.$nr_op;
				$obj_formulacion = 'formulacion_'.$nr_op;
				$$obj_material = $rwpadreitem['paditecodigo'];
				$$obj_calibre = $rwPlaneapadreitem['plapadcalib'];
				$$obj_cant_kg = $rwPlaneapadreitem['plapadcantkg'];
				$$obj_cant_mt = $rwPlaneapadreitem['plapadcantmt'];
				$$obj_ancho = $rwPlaneapadreitem['plapadanchoi'];
				$$obj_formulacion = $rwPlaneapadreitem['formulcodigo'];
				$nr_op++;
			}
		}
		
	if($nr_op <= 0)
	{
		echo '<script language="javascript">';
		echo '<!--//'."\n";
		echo 'alert("ocurrio un error inesperado")';
		echo '//-->'."\n";
		echo '</script>';
		echo '<script language="javascript">';
		echo '<!--//'."\n";
		echo 'location ="maestablvistasoliextru.php?codigo='.$codigo.';"';
		echo '//-->'."\n";
		echo '</script>';
	}
?> 
<html> 
	<head> 
    	<title>Editar registro de solicitud de programacion de extrusion</title> 
    	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
    	<meta http-equiv="expires" content="0">
    	<?php include('../def/jquery.library_maestro.php');?>
    	<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.function_comun.js"></script>
		<script type="text/javascript">
			$(function(){
				$('#gen_gestion').button({ icons: { primary: "ui-icon-gear" } }).click(function() {
					//objetos a utilzar
					var obj_ges_material = document.getElementById('ges_material');
					//valores 
					var ges_material = (obj_ges_material)? obj_ges_material.value : '' ;
					var err = '';
					
					//validaciones 
					if(ges_material == '')
						err = err + 'Advertencia : *** Debe seleccionar material.';
					
					//evento del boton
					if(err == '')
					{
						openPlaneacion(ges_material);
					}
					else
					{
						document.getElementById('msg').innerHTML = err;
						$("#msgwindow").dialog("open");
					}
					//limpiar objetos
					if(obj_ges_material)
						obj_ges_material.value = '';
					return false;
				});

				$('#ret_gestion').button().click(function() {
					loadArraylistdelete('arrmatsoliextru', ',');
					accionReloadListMat_Soliextru();
					loadArraylistdelete('arrtarsoliextru', ',');
					accionReloadListTar_Soliextru();
					return false;
				});

				$('#gen_op').button({ icons: { primary: "ui-icon-gear" } }).click(function() {
					//objetos a utilzar
					var obj_arropsoliext = document.getElementById('arropsoliext');
					var obsj_arropsoliext = (obj_arropsoliext)? obj_arropsoliext.value.split(":|:") : '' ; 
					var obj_ges_material = document.getElementById('ges_material');
					var ind_ges_material = (obj_ges_material)? obj_ges_material.selectedIndex : 0 ;
					//varible a utilizar
					var objs_ancho = 'ancho_' + (ind_ges_material - 1);
					var obj_ancho = document.getElementById(objs_ancho);
					var ancho = (obj_ancho)? obj_ancho.value : '' ;
					//valores 
					var arropsoliext = (obj_arropsoliext)? obj_arropsoliext.value : '' ;
					var ges_material = (obj_ges_material)? obj_ges_material.value : '' ;
					var err = '';
					
					//validaciones 
					if(ges_material == '')
						err = err + 'Advertencia : *** Debe seleccionar material.';
					
					//evento del boton
					if(err == '')
					{
						var indice = 0;
						if(arropsoliext == '')
						{
							indice = 1;
						}else{
							indice = obsj_arropsoliext.length;
							indice++;
						}
						
						var new_row = (indice)  + ':-:' + ges_material + ':-:' + (ind_ges_material - 1) + ':-:' + ancho;
						loadArraylist(new_row, 'arropsoliext', ':|:');
						accionReloadListOpSoliextru();
					}
					else
					{
						document.getElementById('msg').innerHTML = err;
						$("#msgwindow").dialog("open");
					}
					//limpiar objetos
					if(obj_ges_material)
						obj_ges_material.value = '';
					return false;
				});

				$('#ret_op').button().click(function() {
					loadArraylistdelete('arropsoliext', ':|:');
					accionReloadListOpSoliextru();
					return false;
				});

				$('#gen_ta').button({ icons: { primary: "ui-icon-gear" } }).click(function() {
					//objetos a utilzar
					var obj_tar_material = document.getElementById('tar_material');
					//valores 
					var tar_material = (obj_tar_material)? obj_tar_material.value : '' ;
					var err = '';
					
					//validaciones 
					if(tar_material == '')
						err = err + 'Advertencia : *** Debe seleccionar material.';
					
					//evento del boton
					if(err == '')
					{
						var new_row = tar_material;
						loadArraylist(new_row, 'arrtarsoliextru', ',');
						accionReloadListTar_Soliextru();
					}
					else
					{
						document.getElementById('msg').innerHTML = err;
						$("#msgwindow").dialog("open");
					}
					//limpiar objetos
					if(obj_tar_material)
						obj_tar_material.value = '';
					return false;
				});

				$('#ret_ta').button().click(function() {
					loadArraylistdelete('arrtarsoliextru', ',');
					accionReloadListTar_Soliextru();
					return false;
				});

				function openPlaneacion(data)
				{
					ajaxItemsPlaneacion(data);
					$("#msgwindowform").dialog("open");
					return false;
				}

				function ajaxItemsPlaneacion(data)
				{
					//objetos a utilizar
					var obj_arrmatsoliextru = document.getElementById('arrmatsoliextru');
					//valor de los objetos
					var arrmatsoliextru = (obj_arrmatsoliextru)? obj_arrmatsoliextru.value : '' ;
					//parametros
					var parameters;
					parameters = (data != '')? 'paditecodigo=' + data : 'paditecodigo=';
					parameters += (arrmatsoliextru != '')? '&arrplan=' + arrmatsoliextru : '&arrplan=';
					
					$.ajax({	   
						dataType: "html",
						type: "POST",        
						url: "../src/FunjQuery/jquery.visors/jquery.planeacion.php",
						data: parameters,
						beforeSend: function(data){
						document.getElementById('msgform').innerHTML = '<img src="../img/loading.gif">&nbsp;Espere mientras se carga los items.</img>';
						},        
						success: function(requestData){
							document.getElementById('msgform').innerHTML = requestData;
						},         
						error: function(requestData, strError, strTipoError){ },
						complete: function(requestData, exito){ }                                      
					});
					
				}

				$("#msgwindowform").dialog({
					autoOpen: false,
					width: 'auto',
					modal: true,
					hide: "explode",
					buttons: {
						"Ok": function() {
									//objetos a utilizar
									var obj_evento_ventana = document.getElementById('evento_ventana');
									//valor del objeto
									var evento_ventana = (obj_evento_ventana)? obj_evento_ventana.value : '' ;
									if(evento_ventana == 'planeacion')
									{
										accionReloadListMatSoliextru();
										//se borra el contenido del mensaje de dialogo
										document.getElementById('msgform').innerHTML = '' ;
										//se cierra el mensaje de dialogo
										$("#msgwindowform").dialog("close");
									}
							}
					},
					position: [50,50],
					draggable: false,
					resizable: false
				});

				function accionReloadListMatSoliextru()
				{
					//objetos a utilizar
					var obj_arrplan = document.getElementById('arrplan');
					var objs_arrplan = (obj_arrplan)? obj_arrplan.value.split(",") : '' ;
					//valor de los objetos
					var arrplan = (obj_arrplan)? obj_arrplan.value : '' ;
					//parametros
					var parameters;
					parameters = (arrplan != '')? 'arrmatsoliextru=' + arrplan : 'arrmatsoliextru=';
					
					//parametros de objetos adicionales
					for(i=0;i<objs_arrplan.length;i++)
					{
						//objeto adicional
						var objs_consumo = 'consumo_' + objs_arrplan[i];
						//objetos a utilizar
						var obj_consumo = document.getElementById(objs_consumo);
						//valor de los objetos
						var consumo = (obj_consumo)? obj_consumo.value : '' ;
						//parametros adicionales
						(consumo != '')? parameters += '&' + objs_consumo + '=' + consumo : parameters += '&' + objs_consumo + '=';
					}
					
					$.ajax({	   
						dataType: "html",
						type: "POST",        
						url: "../src/FunjQuery/jquery.visors/jquery.mat_soliextru.php", 	
						data: parameters,
						beforeSend: function(data){ },        
						success: function(requestData){
							if(requestData != '')
								document.getElementById('gestion_materiales').innerHTML = requestData;
						},         
						error: function(requestData, strError, strTipoError){ },
						complete: function(requestData, exito){accionReloadSelect_();}                                      
					});
				}

				function accionReloadListMat_Soliextru()
				{
					//objetos a utilizar
					var obj_arrmatsoliextru = document.getElementById('arrmatsoliextru');
					var objs_arrmatsoliextru = (obj_arrmatsoliextru)? obj_arrmatsoliextru.value.split(",") : '' ;
					//valor de los objetos
					var arrmatsoliextru = (obj_arrmatsoliextru)? obj_arrmatsoliextru.value : '' ;
					//parametros
					var parameters;
					parameters = (arrmatsoliextru != '')? 'arrmatsoliextru=' + arrmatsoliextru : 'arrmatsoliextru=';
					
					//parametros de objetos adicionales
					for(i=0;i<objs_arrmatsoliextru.length;i++)
					{
						//objeto adicional
						var objs_consumo = 'consumo_' + objs_arrmatsoliextru[i];
						//objetos a utilizar
						var obj_consumo = document.getElementById(objs_consumo);
						//valor de los objetos
						var consumo = (obj_consumo)? obj_consumo.value : '' ;
						//parametros adicionales
						(consumo != '')? parameters += '&' + objs_consumo + '=' + consumo : parameters += '&' + objs_consumo + '=';
					}
					
					$.ajax({	   
						dataType: "html",
						type: "POST",        
						url: "../src/FunjQuery/jquery.visors/jquery.mat_soliextru.php", 	
						data: parameters,
						beforeSend: function(data){ },        
						success: function(requestData){
							if(requestData != '')
								document.getElementById('gestion_materiales').innerHTML = requestData;
						},         
						error: function(requestData, strError, strTipoError){ },
						complete: function(requestData, exito){accionReloadSelect_();}                                      
					});
				}

				function accionReloadListOpSoliextru()
				{
					//objetos a utilizar
					var obj_arropsoliext = document.getElementById('arropsoliext');
					var objs_arropsoliext = (obj_arropsoliext)? obj_arropsoliext.value.split(":|:") : '' ;
					//valor de los objetos
					var arropsoliext = (obj_arropsoliext)? obj_arropsoliext.value : '' ;
					//parametros
					var parameters;
					parameters = (arropsoliext != '')? 'arropsoliext=' + arropsoliext : 'arropsoliext=';
					
					//parametros de objetos adicionales
					for(i=0;i<objs_arropsoliext.length;i++)
					{
						var arr = objs_arropsoliext[i].split(":-:");
						//objeto adicional
						var objs_cantidad = 'cantidad_' + arr[1] + '_' + i;
						var objs_ancho = 'ancho_' + arr[1] + '_' + i;
						var objs_refile = 'refile_' + arr[1] + '_' + i;
						//objetos a utilizar
						var obj_cantidad = document.getElementById(objs_cantidad);
						var obj_ancho = document.getElementById(objs_ancho);
						var obj_refile = document.getElementById(objs_refile);
						//valor de los objetos
						var cantidad = (obj_cantidad)? obj_cantidad.value : '' ;
						var ancho = (obj_ancho)? obj_ancho.value : '' ;
						var refile = (obj_refile)? obj_refile.value : '' ;
						//parametros adicionales
						(cantidad != '')? parameters += '&' + objs_cantidad + '=' + cantidad : parameters += '&' + objs_cantidad + '=';
						(ancho != '')? parameters += '&' + objs_ancho + '=' + ancho : parameters += '&' + objs_ancho + '=';
						(refile != '')? parameters += '&' + objs_refile + '=' + refile : parameters += '&' + objs_refile + '=';
					}
					
					$.ajax({	   
						dataType: "html",
						type: "POST",        
						url: "../src/FunjQuery/jquery.visors/jquery.op_soliextru.php", 	
						data: parameters,
						beforeSend: function(data){ },        
						success: function(requestData){
							if(requestData != '')
								document.getElementById('gestion_op').innerHTML = requestData;
						},         
						error: function(requestData, strError, strTipoError){ },
						complete: function(requestData, exito){ }                                      
					});
				}

				function accionReloadListTar_Soliextru()
				{
					//objetos a utilizar
					var obj_arrtarsoliextru = document.getElementById('arrtarsoliextru');
					var objs_arrtarsoliextru = (obj_arrtarsoliextru)? obj_arrtarsoliextru.value.split(",") : '' ;
					//valor de los objetos
					var arrtarsoliextru = (obj_arrtarsoliextru)? obj_arrtarsoliextru.value : '' ;
					//parametros
					var parameters;
					parameters = (arrtarsoliextru != '')? 'arrtarsoliextru=' + arrtarsoliextru : 'arrtarsoliextru=';
					
					//parametros de objetos adicionales
					for(i=0;i<objs_arrtarsoliextru.length;i++)
					{
						//objeto adicional
						var objs_ancho_corte = 'ancho_corte_' + objs_arrtarsoliextru[i];
						var objs_dif_mm = 'dif_mm_' + objs_arrtarsoliextru[i];
						var objs_dif_kg = 'dif_kg_' + objs_arrtarsoliextru[i];
						var objs_destino = 'destino_' + objs_arrtarsoliextru[i];
						//objetos a utilizar
						var obj_ancho_corte = document.getElementById(objs_ancho_corte);
						var obj_dif_mm = document.getElementById(objs_dif_mm);
						var obj_dif_kg = document.getElementById(objs_dif_kg);
						var obj_destino = document.getElementById(objs_destino);
						//valor de los objetos
						var ancho_corte = (obj_ancho_corte)? obj_ancho_corte.value : '' ;
						var dif_mm = (obj_dif_mm)? obj_dif_mm.value : '' ;
						var dif_kg = (obj_dif_kg)? obj_dif_kg.value : '' ;
						var destino = (obj_destino)? obj_destino.value : '' ;
						//parametros adicionales
						(ancho_corte != '')? parameters += '&' + objs_ancho_corte + '=' + ancho_corte : parameters += '&' + objs_ancho_corte + '=';
						(dif_mm != '')? parameters += '&' + objs_dif_mm + '=' + dif_mm : parameters += '&' + objs_dif_mm + '=';
						(dif_kg != '')? parameters += '&' + objs_dif_kg + '=' + dif_kg : parameters += '&' + objs_dif_kg + '=';
						(destino != '')? parameters += '&' + objs_destino + '=' + destino : parameters += '&' + objs_destino + '=';
					}
					
					$.ajax({	   
						dataType: "html",
						type: "POST",        
						url: "../src/FunjQuery/jquery.visors/jquery.tar_soliextru.php", 	
						data: parameters,
						beforeSend: function(data){ },        
						success: function(requestData){
							if(requestData != '')
								document.getElementById('gestion_tarea').innerHTML = requestData;
						},         
						error: function(requestData, strError, strTipoError){ },
						complete: function(requestData, exito){ }                                      
					});
				}

				function accionReloadSelect_()
				{
					//objetos a utilizar
					var obj_arrmatsoliextru = document.getElementById('arrmatsoliextru');
					//valor de los objetos
					var arrmatsoliextru = (obj_arrmatsoliextru)? obj_arrmatsoliextru.value : '' ;
					//parametros
					var parameters;
					parameters = (arrmatsoliextru != '')? 'arrmatplan=' + arrmatsoliextru : 'arrmatplan=';
					
					$.ajax({	   
						dataType: "html",
						type: "POST",        
						url: "../src/FunjQuery/jquery.accionextras/jquery.ajax_selectruta.php", 	
						data: parameters,
						beforeSend: function(data){ },        
						success: function(requestData){
							if(requestData != '')
								document.getElementById('tar_material').innerHTML = requestData;
						},         
						error: function(requestData, strError, strTipoError){ },
						complete: function(requestData, exito){ }                                      
					});
				}
				
			});

			function eventAnchoc(ancho_c,indice)
			{	
				//objetos a utilizar
				var obj_ancho_corte = document.getElementById('ancho_corte_' + indice);
				var obj_dif_mm = document.getElementById('dif_mm_' + indice);
				var obj_dif_kg = document.getElementById('dif_kg_' + indice);
				var obj_ancho = document.getElementById('ancho_' + indice);
				var obj_consumo = document.getElementById('consumo_' + indice);
				//objetos label a utilizar
				var obj_lb_dif_mm = document.getElementById('lb_dif_mm_' + indice);
				var obj_lb_dif_kg = document.getElementById('lb_dif_kg_' + indice);
				//validacion de error de digitacion
				if(!/^([0-9\.])*$/.test(ancho_c))
				{
					if(obj_ancho_corte)
						obj_ancho_corte.value = '';
					document.getElementById('msg').innerHTML = 'Advertencia: *** Debe ingresar valor numerico en campo(Ancho de corte).';
					$("#msgwindow").dialog("open");
					return false;
				}
				//valor de los objetos
				var ancho_corte = ancho_c; 
				var dif_mm = (obj_dif_mm)? obj_dif_mm.value : '' ;
				var dif_kg = (obj_dif_kg)? obj_dif_kg.value : '' ; 
				var ancho = (obj_ancho)? obj_ancho.value : '' ;
				var consumo = (obj_consumo)? obj_consumo.value : '' ; 
				//diferencia en milimetros (mm) = ancho material - ancho corte
				var dif_mm = Number(ancho) - Number(ancho_corte);
				//diferencia en kilogramos (kgs) = (diferencia en milimetros / ancho material) * cantidad asignada
				var dif_kg = Number(dif_mm / Number(ancho)) * Number(consumo);
				if(isNaN(dif_kg) === true)
					dif_kg = 0;
				if(dif_kg == -Infinity)
					dif_kg = 0;
				console.log(dif_kg);
				//asignacion de valores
				if(obj_dif_mm) obj_dif_mm.value = dif_mm;
				if(obj_lb_dif_mm) obj_lb_dif_mm.innerHTML = Math.round(dif_mm * 100) / 100;
				if(obj_dif_kg) obj_dif_kg.value = dif_kg;
				if(obj_lb_dif_kg) obj_lb_dif_kg.innerHTML = Math.round(dif_kg * 100) / 100;
				return false;
			}

			function eventRefile(indice1,indice2,anchop)
			{
				var ancho = (obj_ancho)? obj_ancho.value : '' ;
				//variables de objetos a usuar
				var objs_ancho = 'ancho_' + indice1 + '_' + indice2;
				var objs_refile = 'refile_' + indice1 + '_' + indice2;
				var objs_ancho_lb = 'ancho_lb_' + indice1 + '_' + indice2;
				//objetos segun variables adicionales
				var obj_ancho = document.getElementById(objs_ancho);
				var obj_refile = document.getElementById(objs_refile);
				var obj_ancho_lb = document.getElementById(objs_ancho_lb);
				//valor del objetos
				var refile_ = (obj_refile)? obj_refile.value : '' ;
				//validacion de numero entero
				var refile = (/^([0-9\,.])*$/.test(refile_))? refile_ : '' ; 
				//accion del evento
				var anchoc = Number(anchop) + Number(refile);
				if(obj_ancho) obj_ancho.value = anchoc;
				if(obj_ancho_lb) obj_ancho_lb.innerHTML = anchoc;
				if(refile == '')
				{
					if(obj_refile) obj_refile.value = 0;
				}
			}

		</script>
  </head> 
<?php if(!$codigo){ echo "<!--";} ?>
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Solicitud de programacion extrusion</font></p> 
			<table width="800" border="0" align="center" cellpadding="1" cellspacing="1" class="ui-widget-content">
<?php if($campnomb): ?>
				<tr><td><div class="ui-widget">
					<div class="ui-state-error ui-corner-all" style="padding: 0 .7em;"> 
						<p><span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span> 
						<strong>Advertencia:</strong> Corrija los campos marcados con *</p>
					</div>
				</div></td></tr>
<?php else: ?> 		
				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr>	
<?php endif; ?>
        		<tr><td class="ui-widget-header"><span class="style5"><font color="FFFFFF"> Editar registro</font></span></td></tr>
        		<tr>
					<td>
						<table width="98%" border="0" cellspacing="0" cellpadding="0" align="center" class="ui-widget-content">
							<tr class="ui-widget-header">
								<td width="50%" class="cont-title">&nbsp;Solicitud de programacion extrusi&oacute;n No.&nbsp;{<?php echo $solprocodigo; ?>}</td>
								<td width="50%" class="cont-title">&nbsp;Fecha.&nbsp;<?php echo $solprofecha ?></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<table width="98%" border="0" cellspacing="0" cellpadding="0" align="center"  class="ui-widget-content">
							<tr class="ui-state-default"><td class="cont-title">&nbsp;Datos de la solicitud</td></tr>
						</table>
						<table width="98%" border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content">
							<tr>
								<td class="NoiseFooterTD" width="20%">&nbsp;Ubicaci&oacute;n</td>
								<td class="NoiseDataTD">&nbsp;<?php echo cargaplantanombre($plantacodigo, $idcon); ?></td>
							</tr>
							<tr>
								<td class="NoiseFooterTD">&nbsp;Proceso</td>
								<td class="NoiseDataTD">&nbsp;<?php echo strtoupper($procednombre) ?></td>
							</tr>
							<tr>
								<td class="NoiseFooterTD">&nbsp;PV</td>
								<td class="NoiseDataTD">&nbsp;<?php echo  $pedvennumero ?></td>
							</tr>
							<tr>
								<td class="NoiseFooterTD">&nbsp;Item</td>
								<td class="NoiseDataTD">&nbsp;<?php echo  $produccoduno ?></td>
							</tr>
							<tr>
								<td class="NoiseFooterTD">&nbsp;Solicitante</td>
								<td class="NoiseDataTD">&nbsp;<?php echo cargausuanombre($usuacodigo, $idcon); ?></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<table width="98%" border="0" cellspacing="0" cellpadding="0" align="center"  class="ui-widget-content">
							<tr class="ui-state-default"><td class="cont-title">&nbsp;Necesidad de producci&oacute;n </td></tr>
						</table>
						<?php 
							for($a = 0;$a < $nr_op;$a++){
								$obj_material = 'material_'.$a;
								$obj_calibre = 'calibre_'.$a;
								$obj_cant_kg = 'cant_kg_'.$a;
								$obj_cant_mt = 'cant_mt_'.$a;
								$obj_ancho = 'ancho_'.$a;
								$obj_formulacion = 'formulacion_'.$a;
						?>
						<table width="98%" border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content">
							<tr>
								<td class="NoiseFooterTD" width="20%">&nbsp;Material</td>
								<td class="NoiseDataTD">&nbsp;<?php echo cargapadreitemnombre($$obj_material,$idcon); ?></td>
							</tr>
							<tr>
								<td class="NoiseFooterTD">&nbsp;Calibre</td>
								<td class="NoiseDataTD">&nbsp;<?php echo $$obj_calibre ?>&nbsp;<b>&micro;m</b></td>
							</tr>
							<tr>
								<td class="NoiseFooterTD">&nbsp;Cantidad</td>
								<td class="NoiseDataTD">&nbsp;<?php echo  number_format($$obj_cant_kg, 2, ',', '.') ?>&nbsp;<b>kgs</b>&nbsp;-&nbsp;<?php echo  number_format($$obj_cant_mt, 2, ',', '.') ?>&nbsp;<b>mts</b></td>
							</tr>
							<tr>
								<td class="NoiseFooterTD">&nbsp;Ancho x Pistas</td>
								<td class="NoiseDataTD">&nbsp;<?php echo  number_format($anchoproceso, 2, ',', '.') ?>&nbsp;<b>mm</b>&nbsp;x&nbsp;<?php echo number_format($nropistas, 2, ',','.') ?>&nbsp;</td>
							</tr>							
							<tr>
								<td class="NoiseFooterTD">&nbsp;Ancho planeado</td>
								<td class="NoiseDataTD">&nbsp;<input type="hidden" name="<?php echo $obj_ancho ?>" id="<?php echo $obj_ancho ?>" value="<?php echo $$obj_ancho ?>" /><?php echo  $$obj_ancho ?>&nbsp;<b>mm</b></td>
							</tr>
							<tr>
								<td class="NoiseFooterTD">&nbsp;Formula</td>
								<td class="NoiseDataTD">&nbsp;<?php echo  cargaformulacionnombre($$obj_formulacion,$idcon); ?></td>
							</tr>
							<tr>
		  						<td class="NoiseFooterTD">&nbsp;Version del arte / fecha</td>
		  						<td class="NoiseDataTD">&nbsp;<?php echo ($version_arte)? $version_arte : '---' ; ?></td>
		  					</tr>
						</table>
						<?php }?>
					</td>
				</tr>
				<tr>
					<td>
						<table width="98%" border="0" cellspacing="0" cellpadding="0" align="center"  class="ui-widget-content">
							<tr class="ui-state-default"><td class="cont-title">&nbsp;Documentos Adjuntos</td></tr>
						</table>      			
						<table width="98%" border="0" cellspacing="0" cellpadding="0" align="center"  class="ui-widget-content">
							<tr>
								<td>
									<div style="height:2px;"></div>
									<div class="ui-widget-content content">
										<div id="reportot_file_load" class="file-upname">
											<?php 
												if($uploadocumen):
													$arrUpload = explode('::', $uploadocumen);
													$arrUploadSize = explode('::', $uploadocumensize);
													
													for($a = 0; $a < count($arrUpload); $a++):
											?>
											<div class="uploadifyQueueItem completed"><div class="cancel"><a href="javascript: void(0);" onclick="window.open('http://75.98.171.118/plasticel/doc/upload/documentos/<?php echo $arrUpload[$a] ?>','impresion','status=no,menubar=no,scrollbars=yes,resizable=yes,width=880,height=650');">Detallar</a></div><span class="fileName"><?php echo $arrUpload[$a].' ('.$arrUploadSize[$a].')' ?></span></div>
											<?php												
													endfor;
												endif;
											?>
										</div>
										<input type="hidden" name="uploadocumen" id="uploadocumen" value="<?php echo $uploadocumen?>">
										<input type="hidden" name="uploadocumensize" id="uploadocumensize" value="<?php echo $uploadocumensize ?>">
									</div>
								</td>
							</tr>
						</table>
					</td>							
				</tr>
				<tr>
					<td>
						<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
							<tr>
								<td colspan="3" class="ui-state-default">&nbsp;Gestion de la producci&oacute;n</td>
							</tr>
						</table>
						<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
							<tr>
								<td class="NoiseFooterTD" width="15%">&nbsp;Material</td>
								<td class="NoiseDataTD"><div class="ui-buttonset">
									<select name="ges_material" id="ges_material">
										<option value="">--Seleccione--</option>
										<?php 
											for ($a=0;$a<$nr_op;$a++){
												$obj_material = 'material_'.$a;
												echo "<option value ='".$$obj_material."' ";
												echo ">".cargapadreitemnombre($$obj_material,$idcon)."</option>"."\n";
											}
										?>
									</select>
									<button id="gen_op">Generar op</button>&nbsp;
									<button id="ret_op">Retirar op</button>&nbsp;
									<button id="gen_gestion">Gestionar</button>&nbsp;
									<button id="ret_gestion">Retirar material</button>&nbsp;									
									</div>
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
							<tr>
								<td colspan="3" class="ui-state-default">&nbsp;<?php if ($campnomb["arropsoliext"] == 1) {echo "<b style='font-size:15px; color:red;'>*</b>";}?>Ordenes de producci&oacute;n</td>
							</tr>
						</table>
						<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
							<tr>
								<td>
									<div id="gestion_op">
										<?php
											$noAjax = true;
											include '../src/FunjQuery/jquery.visors/jquery.op_soliextru.php';  
										?>
									</div>
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
							<tr>
								<td colspan="3" class="ui-state-default">&nbsp;<?php if ($campnomb["arrmatsoliextru"] == 1) {echo "<b style='font-size:15px; color:red;'>*</b>";}?>Materiales Asignados</td>
							</tr>
						</table>
						<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
							<tr>
								<td>
									<div id="gestion_materiales">
										<?php
											$noAjax = true;
											include '../src/FunjQuery/jquery.visors/jquery.mat_soliextru.php';  
										?>
									</div>
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
							<tr>
								<td colspan="3" class="ui-state-default">&nbsp;Tareas </td>
							</tr>
						</table>
						<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
							<tr>
								<td class="NoiseFooterTD" width="15%">&nbsp;Material</td>
								<td class="NoiseDataTD"><div class="ui-buttonset">
									<select name="tar_material" id="tar_material">
										<option value="">--Seleccione--</option>
										<?php 
											if($arrmatsoliextru) $arrObject = explode(',',$arrmatsoliextru);
											for($a = 0;$a< count($arrObject);$a++){
												$rwItemdesa = loadrecorditemdesa($arrObject[$a],$idcon);
												echo '<option value="'.$arrObject[$a].'">'.$rwItemdesa['itedesnombre'].'</option>';
											}
										?>
									</select>
									<button id="gen_ta">Generar tarea</button>&nbsp;
									<button id="ret_ta">Retirar tarea</button>&nbsp;
									</div>
								</td>
							</tr>
							<tr>
								<td colspan="2">
									<div id="gestion_tarea">
										<?php
											$noAjax = true;
											include '../src/FunjQuery/jquery.visors/jquery.tar_soliextru.php';  
										?>
									</div>
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
							<tr>
								<td colspan="3" class="ui-state-default">&nbsp;Observaciones </td>
							</tr>
						</table>
						<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
							<tr>
								<td>
									<textarea name="solprodescri" cols="92" rows="3"><?php echo $solprodescri; ?></textarea>
								</td>
							</tr>
						</table>
					</td>
				</tr>
    			<tr><td>&nbsp;</td></tr>
    			<tr>
					<td class="NoiseErrorDataTD" align="center"><div class="ui-buttonset">
						<button id="aceptar">Aceptar</button>&nbsp;&nbsp;&nbsp;&nbsp;
						<button id="cancelar">Cancelar</button>
					</div></td>
				</tr>
				<tr><td>&nbsp;</td></tr>
     		</table> 
     		<input type="hidden" name="accionnuevosoliot">
     		<input type="hidden" name="accioneditarvistasoliextru">
   			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>">
			<input type="hidden" name="sourceaction" value="editar">
     		<input type="hidden" name="solprocodigo" value="<?php echo $solprocodigo; ?>"> 
     		<input type="hidden" name="estsolcodigo" value="<?php echo $estsolcodigo; ?>"> 
     		<input type="hidden" name="produccodigo" value="<?php echo $produccodigo; ?>"> 
     		<input type="hidden" name="produccoduno" value="<?php echo $produccoduno; ?>"> 
     		<input type="hidden" name="tipevecodigo" value="<?php echo $tipevecodigo; ?>">
     		<input type="hidden" name="pedvennumero" value="<?php echo $pedvennumero; ?>">
     		<input type="hidden" name="solprofecha" value="<?php echo $solprofecha; ?>">
     		<input type="hidden" name="solprohora" value="<?php echo $solprohora; ?>">
     		<input type="hidden" name="plantacodigo" value="<?php echo $plantacodigo; ?>">
     		<input type="hidden" name="procedcodigo" value="<?php echo $procedcodigo; ?>">
     		<input type="hidden" name="procednombre" value="<?php echo $procednombre; ?>">
     		<input type="hidden" name="plarutcodigo" value="<?php echo $plarutcodigo; ?>">
     		<input type="hidden" name="usuacodigo" value="<?php echo $usuacodigo; ?>">
     		<input type="hidden" name="nropistas" value="<?php echo $nropistas; ?>">
     		<input type="hidden" name="ancho" value="<?php echo $ancho; ?>">
     		<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
   		</form> 
   		<div id="msgwindow" title="Adsum Kallpa"><span id="msg"></span></div>
   		<div id="msgwindowform" title="Adsum Kallpa[Gestion MP]"><span id="msgform"></span></div>
 	</body> 
<?php if(!$codigo){ echo " -->"; } ?> 
</html>