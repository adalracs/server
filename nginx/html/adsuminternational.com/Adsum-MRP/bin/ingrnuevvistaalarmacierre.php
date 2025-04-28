<?php 
ob_start();
	ini_set('display_errors',1);
	include ('../src/FunGen/cargainput.php');
	include ('../src/FunGen/sesion/fncvalses.php'); 
	include ('../src/FunPerPriNiv/pktblalarmamodulo.php');
	include ('../src/FunPerPriNiv/pktblalarmaitem.php');
	include ('../src/FunPerPriNiv/pktblmodulo2.php');
	include ('../src/FunPerPriNiv/pktblalarmagestion.php');
	include ( '../src/FunPerPriNiv/pktblproducto.php');
	include ( '../src/FunPerPriNiv/pktbltipoalarma.php');
	include ('../src/FunPerPriNiv/pktblusuario.php');
	include ( '../src/FunPerPriNiv/pktblestadoalarma.php');
	include ( '../src/FunPerPriNiv/pktblvistaalarmagestion.php');
	include ( '../src/FunPerPriNiv/pktblnivelalarma.php');
	include ( '../src/FunPerPriNiv/pktblalarma.php');
	include ( '../src/FunPerPriNiv/pktblordencompra.php');
	

	if($accionnuevovistaalarmacierre){
		include ( 'grabavistaalarmacierre.php');
	}
		ob_end_flush();
		
		if($alarmacodigo)
		{
			$idcon = fncconn();
			$nombre = cargausuanombre($usuacodi, $idcon);
			//$rsCierreoop = dinamicscanopvistaalarmagestion(array('alarmacodigo' => $alarmacodigo),array('alarmacodigo' => '='),$idcon);
			if($rsCierreoop > 0){
				$err = 'La Alarma se encuentra Reportada';
			}else{
				$rwOpp = loadrecordvistaalarmagestion($alarmacodigo,$idcon);
 
				if($rwOpp < 0){
					$err = 'No se encontro la Alarma';
				}else{
					//VARIABLES DE LA VISTA		
					$alarmacodigo = $rwOpp['alarmacodigo'];
					$usuanombre = $rwOpp['usuanombre'];
					$alarmafecelb = $rwOpp['alarmafecelb'];
					$alarmamensaj = $rwOpp['alarmamensaj'];
					$alarmadescri = $rwOpp['alarmadescri'];
					$tipalanombre = $rwOpp['tipalanombre'];
					$nivalanombre = $rwOpp['nivalanombre'];
					$ordcomcodcli = $rwOpp['ordcomcodcli'];
					$nivalacodigo = $rwOpp['nivalacodigo'];
					$modulos_respo = $rwOpp['modulos_respo'];
					$modulos_dir = $rwOpp['modulos_dir'];
					$tipoalacodigo = $rwOpp['tipoalacodigo'];
					$estalacodigo = $rwOpp['estalacodigo'];
					$estalanombre = $rwOpp['estalanombre'];
					
					$arrmodulocodigo="";
					$idcon = fncconn();
					$rsAlarmamodulo = dinamicscanopalarmamodulo(array('alarmacodigo' => $alarmacodigo, 'alamodirres' => '1'),array('alarmacodigo' => '=','alamodirres' => '='),$idcon);
					$nrAlarmamodulo = fncnumreg($rsAlarmamodulo);
					for($a = 0; $a < $nrAlarmamodulo; $a++):
					$rwAlarmamodulo = fncfetch($rsAlarmamodulo, $a);
					($arrmodulocodigo) ? $arrmodulocodigo .= ','.$rwAlarmamodulo['modulocodigo'] : $arrmodulocodigo = $rwAlarmamodulo['modulocodigo'];
					endfor;
			
					$arrmodulocodigodir="";
					$idcon = fncconn();
					$rsAlarmamodulodir = dinamicscanopalarmamodulo(array('alarmacodigo' => $alarmacodigo, 'alamodirres' => '0'),array('alarmacodigo' => '=','alamodirres' => '='),$idcon);
					$nrAlarmamodulodir = fncnumreg($rsAlarmamodulodir);
					for($a = 0; $a < $nrAlarmamodulodir; $a++):
					$rwAlarmamodulodir = fncfetch($rsAlarmamodulodir, $a);
					($arrmodulocodigodir) ? $arrmodulocodigodir .= ','.$rwAlarmamodulodir['modulocodigo'] : $arrmodulocodigodir = $rwAlarmamodulodir['modulocodigo'];
					endfor;
					
					$arrproduccoduno="";
					$idcon = fncconn();
					$rsProduccoduno = dinamicscanopalarmaitem(array('alarmacodigo' => $alarmacodigo),array('alarmacodigo' => '='),$idcon);
					$nrProduccoduno = fncnumreg($rsProduccoduno);
					for($a = 0; $a < $nrProduccoduno; $a++):
					$rwProduccoduno = fncfetch($rsProduccoduno, $a);
					($arrproduccoduno) ? $arrproduccoduno .= ','.$rwProduccoduno['produccoduno'] : $arrproduccoduno = $rwProduccoduno['produccoduno'];
					endfor;
					
					$rsAlarmagestion =dinamicscanopalarmagestion(array('alarmacodigo' => $alarmacodigo),array('alarmacodigo' => '='),$idcon);
					$nrAlarmagestion = fncnumreg($rsAlarmagestion);
				}
			}
			fncclose($idcon);
		}
		
		$ordcomcodcli = $rwOpp['ordcomcodcli'];
		
		$idcon = fncconn();
		$fecha=date('Y-m-d');
?> 
<html> 
	<head> 
		<title>Nuevo registro</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=UTF8"> 
		<meta http-equiv="expires" content="0"> 
		<meta http-equiv="X-UA-Compatible" content="IE=9"> 
		<?php include ('../def/jquery.library_maestro.php'); ?>
		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.function_comun.js"></script>
		<!--  <script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.function_reporteopp.js"></script>-->
		<style type="text/css">
			.ui-autocomplete-loading { background: white url('../img/ui-anim_basic_16x16.gif') right center no-repeat; }
		</style>
		<script type="text/javascript">
			$(function(){
				
				$('#reloadform').button({ icons: { primary: "ui-icon-refresh" }, text: false }).click(function() {
					document.form1.submit();
					return false;
				});
					//pestanas formulario
				$("#tabs_opp").tabs({});
				

				//Modulos Responsabls
				$('#anxmodulo').button({ icons: { primary: "ui-icon-plus" }, text: false }).click(function() {
					//objetos a utilizar
					var obj_arrmodulocodigo = document.getElementById('arrmodulocodigo');
					var obj_modulocodigo = document.getElementById('modulocodigo');
					var obj_modulonombre = document.getElementById('modulonombre');
					//valor de los objetos
					var modulocodigo = (obj_modulocodigo)? obj_modulocodigo.value : '' ;
					var modulonombre = (obj_modulonombre)? obj_modulonombre.value : '' ;
					var err = '';

					//validaciones de error
					if(modulocodigo == '' || modulonombre == '')
						err = err + 'Advertencia : *** Debe de seleccionar linea.' ;

					//accion del boton
					if(err == ''){
						loadArraylist(modulocodigo, 'arrmodulocodigo', ',');
						accionReloadModulo();
					}
					else{
						document.getElementById('msg').innerHTML = err;
						$('#msgwindow').dialog('open');
					}

					//limpiar objetos
					obj_modulocodigo.value = '' ;
					obj_modulonombre.value = '' ;
				
					return false;
				});
	
				// 		Boton Retirar Mueble
				$('#retmodulo').button({ icons: { primary: "ui-icon-minus" }, text: false }).click(function() {
					loadArraylistdelete('arrmodulocodigo', ',');
					accionReloadModulo();
					return false;
					});

				$("#modulonombre").autocomplete({
					source: "../src/FunjQuery/jquery.phpcombobox/jquery.cmbx_modulo.php",
					minLength: 1,
					select: function(event, ui) {
						ui.item ? document.getElementById('modulocodigo').value = ui.item.id : document.getElementById('modulocodigo').value = "";
					}
				});


				//Modulos a Dirigir
				$('#anxmodulodir').button({ icons: { primary: "ui-icon-plus" }, text: false }).click(function() {
					//objetos a utilizar
					var obj_arrmodulocodigodir = document.getElementById('arrmodulocodigodir');
					var obj_modulocodigodir = document.getElementById('modulocodigodir');
					var obj_modulonombredir = document.getElementById('modulonombredir');
					//valor de los objetos
					var modulocodigodir = (obj_modulocodigodir)? obj_modulocodigodir.value : '' ;
					var modulonombredir = (obj_modulonombredir)? obj_modulonombredir.value : '' ;
					var err = '';

					//validaciones de error
					if(modulocodigodir == '' || modulonombredir == '')
						err = err + 'Advertencia : *** Debe de seleccionar linea.' ;
					//accion del boton
					if(err == ''){
						loadArraylist(modulocodigodir, 'arrmodulocodigodir', ',');
						accionReloadModulodir();
					}
					else{
						document.getElementById('msg').innerHTML = err;
						$('#msgwindow').dialog('open');
					}
					//limpiar objetos
					obj_modulocodigodir.value = '' ;
					obj_modulonombredir.value = '' ;
				
					return false;
				});
	
				// 		Boton Retirar Mueble
				$('#retmodulodir').button({ icons: { primary: "ui-icon-minus" }, text: false }).click(function() {
					loadArraylistdelete('arrmodulocodigodir', ',');
					accionReloadModulodir();
					return false;
					});

				$("#modulonombredir").autocomplete({
					source: "../src/FunjQuery/jquery.phpcombobox/jquery.cmbx_modulo.php",
					minLength: 1,
					select: function(event, ui) {
						ui.item ? document.getElementById('modulocodigodir').value = ui.item.id : document.getElementById('modulocodigodir').value = "";
					}
				});

				//Boton Anexar Item
				$('#anxproduccoduno').button({ icons: { primary: "ui-icon-plus" }, text: false }).click(function() {
					//objetos a utilizar
					var obj_arrproduccoduno = document.getElementById('arrproduccoduno');
					var obj_produccoduno = document.getElementById('produccoduno');
					var obj_producnombre = document.getElementById('producnombre');
					//valor de los objetos
					var produccoduno = (obj_produccoduno)? obj_produccoduno.value : '' ;
					var producnombre = (obj_producnombre)? obj_producnombre.value : '' ;
					var err = '';
					//validaciones de error
					if(produccoduno == '' || producnombre == '')
						err = err + 'Advertencia : *** Debe de seleccionar linea.' ;
					//accion del boton
					if(err == ''){
						loadArraylist(produccoduno, 'arrproduccoduno', ',');
						accionReloadItem();
					}
					else{
						document.getElementById('msg').innerHTML = err;
						$('#msgwindow').dialog('open');
					}
					//limpiar objetos
					obj_produccoduno.value = '' ;
					obj_producnombre.value = '' ;
				
					return false;
				});
	
				// 		Boton Retirar Modulo
				$('#retproduccoduno').button({ icons: { primary: "ui-icon-minus" }, text: false }).click(function() {
					loadArraylistdelete('arrproduccoduno', ',');
					accionReloadItem();
					return false;
					});

				$("#producnombre").autocomplete({
					source: "../src/FunjQuery/jquery.phpcombobox/jquery.cmbx_producto.php",
					minLength: 1,
					select: function(event, ui) {
						ui.item ? document.getElementById('produccoduno').value = ui.item.id : document.getElementById('produccoduno').value = "";
					}
				});
			});
			

			//Carga la tabla de los Modulos a Dirigir
			function accionReloadModulo()
			{
				//objetos a utilizar 
				var obj_arrmodulocodigo = document.getElementById('arrmodulocodigo');
				//valor de los objetos
				var arrmodulocodigo = (obj_arrmodulocodigo)? obj_arrmodulocodigo.value : '' ;
				//evento a usar
				var parameters;
				parameters = 'arrmodulocodigo=' + arrmodulocodigo;
				//evento ajax
				$.ajax({	   
					dataType: "html",
					type: "POST",        
					url: "../src/FunjQuery/jquery.visors/jquery.vistaalarmagestion.php", 	
					data: parameters,
					beforeSend: function(data){ },        
					success: function(requestData){
						if(requestData != '')
							document.getElementById('filtrlistamodulo').innerHTML = requestData;
					},         
					error: function(requestData, strError, strTipoError){   
						alert("Error " + strTipoError +': ' + strError);
					},
					complete: function(requestData, exito){ }                                      
				});
			}
			
			//Carga la tabla de los Modulos a Dirigir
			function accionReloadModulodir(){
				var obj_arrmodulocodigodir = document.getElementById('arrmodulocodigodir');
				//valor de los objetos
				var arrmodulocodigodir = (obj_arrmodulocodigodir)? obj_arrmodulocodigodir.value : '' ;
				//evento a usar
				var parameters;
				parameters = 'arrmodulocodigodir=' + arrmodulocodigodir;
				//evento ajax
				$.ajax({	   
					dataType: "html",
					type: "POST",        
					url: "../src/FunjQuery/jquery.visors/jquery.vistaalarmagestiondir.php", 	
					data: parameters,
					beforeSend: function(data){ },        
					success: function(requestData){
						if(requestData != '')
							document.getElementById('filtrlistamodulodir').innerHTML = requestData;
					},         
					error: function(requestData, strError, strTipoError){   
						alert("Error " + strTipoError +': ' + strError);
					},
					complete: function(requestData, exito){ }                                      
				});
			}


			//Funcion para los Item			
			function accionReloadItem(){
				//objetos a utilizar 
				var obj_arrproduccoduno = document.getElementById('arrproduccoduno');
				//valor de los objetos
				var arrproduccoduno = (obj_arrproduccoduno)? obj_arrproduccoduno.value : '' ;
				//evento a usar
				var parameters;
				parameters = 'arrproduccoduno=' + arrproduccoduno;
				//evento ajax
				$.ajax({	   
					dataType: "html",
					type: "POST",        
					url: "../src/FunjQuery/jquery.visors/jquery.productos.php", 	
					data: parameters,
					beforeSend: function(data){ },        
					success: function(requestData){
						if(requestData != '')
							document.getElementById('filtrlistaproduccoduno').innerHTML = requestData;
					},         
					error: function(requestData, strError, strTipoError){   
						alert("Error " + strTipoError +': ' + strError);
					},
					complete: function(requestData, exito){ }                                      
				});
			}


		</script>
	</head> 
<?php if (! $codigo) echo "<!--"; ?> 
	<body bgcolor="FFFFFF" text="#000000"> 
<form name="form1" method="post" enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Cierre de Alarmas</font></p> 
			<table width="800" border="0" align="center" cellpadding="1" cellspacing="1" class="ui-widget-content">
<?php if($campnomb || $err): ?>
				<tr><td><div class="ui-widget">
					<div class="ui-state-error ui-corner-all" style="padding: 0 .7em;"> 
						<p><span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span> 
						<strong>Advertencia:</strong> <?php if($err): echo $err; else: ?> Corrija los campos marcados con *<?php endif; ?></p>
					</div>
				</div></td></tr>
<?php else: ?> 		
				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr>	
<?php endif; ?>
				<tr>
				  <td class="ui-widget-header"><span class="style5"><font color="FFFFFF"> Nuevo Registro </font></span></td></tr>        		
				<tr>
					<td>
						<table width="98%" border="0" cellspacing="0" cellpadding="0" align="center" class="ui-widget-content">
							<tr class="ui-widget-header">
								<td width="50%" class="cont-title">&nbsp;No Alarma.&nbsp;
								  <input type="text" name="alarmacodigo"  size="13" value="<?php echo $alarmacodigo; ?>" title="Digite el Numero de la Alarma..."><button id="reloadform">Reload</button></td>
								<td width="60%" class="cont-title" >&nbsp;Generado:&nbsp;<?php  echo date('Y-m-d'). " - ".'&nbsp;&nbsp;&nbsp;&nbsp;' .date("h").":".date("i")." ".date("a") ?></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" class="ui-widget-content">
							<tr>
								<td>
									<div id="tabs_opp">
										<ul>
											<li><a href="#tabs_cierre">Cierre Alarma</a></li>
											<li><a href="#tabs_histog">Historial de Gestiones</a></li>
                                            
										</ul>
										
										<div id="tabs_cierre">
											<?php include '../src/FunjQuery/jquery.tabs/cierrealarma/jquery.cierrealarma.php'; ?>
										</div>
										
										<div id="tabs_histog">
											<?php include '../src/FunjQuery/jquery.tabs/cierrealarma/jquery.histogestionalarma.php'; ?>
										</div>
										
									</div>
								</td>
							</tr>
						</table>
					</td>
				</tr>
				
				<tr>
					<td class="NoiseErrorDataTD" align="center"></td>
				</tr>
				<tr><td class="NoiseErrorDataTD" align="center"><?php include '../def/jquery.button_form.php'; ?></td></tr> 
				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr> 
			</table>

			<input type="hidden" name="flagnuevovistaalarmacierre">
			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>"> 
			<input type="hidden" name="sourceaction" id="sourceaction" value="nuevo">
			<input type="hidden" name="accionnuevovistaalarmacierre">  
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
	</form>
		<div id="msgwindow" title="Adsum Kallpa"><span id="msg"></span></div>
	</body> 
<?php if (! $codigo) echo " -->"; ?> 
</html>