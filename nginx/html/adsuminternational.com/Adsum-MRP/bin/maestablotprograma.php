<?php
ob_start();
	include ( '../src/FunGen/sesion/fncvalses.php');
	include ( '../src/FunGen/sesion/fncvarsesion.php');
	
	include ( '../src/FunPerSecNiv/fncsqlrun.php');
	
	include ( '../src/FunPerPriNiv/pktblplanta.php');
	include ( '../src/FunPerPriNiv/pktblsistema.php');
	include ( '../src/FunPerPriNiv/pktblequipo.php');
	include ( '../src/FunPerPriNiv/pktblcomponen.php');
	include ( '../src/FunPerPriNiv/pktblparte.php');
	include ( '../src/FunPerPriNiv/pktbltipotrab.php');
	include ( '../src/FunPerPriNiv/pktblotestado.php');
	include ( '../src/FunPerPriNiv/pktblusuario.php');
	include ( '../src/FunPerPriNiv/pktbltarea.php');
	
	include ( '../src/FunGen/cargainput.php');
	include ( '../src/FunGen/fncnumprox.php');
	include ( '../src/FunGen/fncnumact.php');
	include ( '../src/FunGen/floadtimehours.php');
	include ( '../src/FunGen/floadtimeminut.php');
	include ( '../src/FunGen/fncdatediff.php');

	$idcon = fncconn();
	
	if($usuaareafuncio)
		$arefuncodigo = $usuaareafuncio;
	
ob_end_flush();
?>
<html>
	<head>
		<title>Ordenes de trabajo programadas</title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		<meta http-equiv="expires" content="0">
		<?php include('../def/jquery.library_maestro.php');?>
		
		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.function_comun.js"></script>
		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.ui.ajax_accionextras.js"></script>
		
		<SCRIPT language=JavaScript src="../src/FunGen/jsrsClient.js"		type="text/javascript" ></SCRIPT>
		<script language=JavaScript src="../src/FunGen/cargarSistema.js" type="text/javascript" ></script>
		<script language=JavaScript src="../src/FunGen/cargarEquipos.js" type="text/javascript" ></script>
<!--		<script language=JavaScript src="../src/FunGen/prototype162.js" type="text/javascript" ></script>-->
<!--        <SCRIPT src="../src/FunGen/achelista.js" type="text/javascript"></SCRIPT>-->
        
        <script type="text/javascript">
			$(function(){
				$("#programaciones").tabs({
					ajaxOptions: {
						error: function(xhr, status, index, anchor) {
							$(anchor.hash).html("No se puede cargar esta pesta&ntilde;a. Vamos a tratar de solucionar este problema lo m&aacute;s pronto posible.");
						}
					}
				});

				/**
				 * Boton Aceptar
				 */
				$('#updateprint').button({ icons: { primary: "ui-icon-print" } }).click(function() {
					document.form1.action = 'ingrnuevotprogramacion.php';
					document.form1.submit();
					
					return false;
				});
			});

			/**
			 * Function accionVistaTab
			 * @param paramt
			 * @param content
			 * @param script
			 * @return
	 	 	 */
			function accionVistaTab(paramt, content, script, strarray)
			{
				$.ajax({	   
					dataType: "html",
					type: "POST",        
					url: "../src/FunjQuery/jquery.visors/jquery." + script + ".php", 	
					data: paramt,
					success: function(requestData){
						if(requestData != '')
							document.getElementById(content).innerHTML = requestData;
						document.getElementById('arr' + strarray).value = '';
						
					}   
				});
			}
			
			/**
			 * Function fncRelodListas
			 * @return
	 	 	 */
			function fncRelodListas()
			{
				var paramet = "plantacodigo=" + $('#plantacodigo').val() + "&sistemcodigo=" + $('#sistemcodigo').val() + "&equipocodigo=" + $('#equipocodigo').val() + "&tiptracodigo=" + $('#tiptracodigo').val();
				accionVistaTab(paramet, 'contentprgramacion', 'prografutura', 'otprograma');
			}
		</script>
		<style type="text/css">
			.visor-title-td {
				font-size: 10px;
			}
		</style>
	</head>
<?php if(!$codigo){echo "<!--";} ?>
	<body bgcolor="FFFFFF" text="#000000">
		<form name="form1" method="post"  enctype="multipart/form-data">
			<p><font class="NoiseFormHeaderFont">Programacion de mantenimiento</font></p>
			<table border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content" width="1100">
				<tr><td class="ui-widget-header">&nbsp;</td></tr>
				<tr> 
  					<td>
  						<div style="padding: 6px;">
  							<div style="height: 16px;" class="ui-state-default contenido-general">
								&nbsp;<a onClick="return verocultar('filtraplansistequi',1);" href="javascript:animatedcollapse.toggle('filtraplansistequi');"><img id="row1" align="middle" align="top"  src="temas/Noise/AscOn.gif" border="0">&nbsp;Filtros de Programaciones</a>
							</div>
							<div id="filtraplansistequi" style="height:auto;" class="ui-widget-content contenido-general">
								<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
									<tr>
		          						<td class="NoiseFooterTD cont-label-b"><?php if($campnomb["plantacodigo"] == 1)echo "*"; ?>&nbsp;Planta</td>
		          						<td class="NoiseDataTD cont-field-b"><select name="plantacodigo" id="plantacodigo" onChange="accionLoadSelect(this.value, 'sistema', 'sistemcodigo'); fncRelodListas();">
		          							<option value = "">-- Seleccione --</option>
											<?php
												include ('../src/FunGen/floadplanta.php');
												floadplanta($plantacodigo,$idcon);
											?>
		            					</select></td>
		          					</tr>
									<tr>          						
		          						<td class="NoiseFooterTD cont-label-b"><?php if($campnomb["sistemcodigo"] == 1)echo "*"; ?>&nbsp;Sistema</td>
		            					<td class="NoiseDataTD cont-field-b"><select name="sistemcodigo" id="sistemcodigo" onChange="accionLoadSelect(this.value, 'equipo', 'equipocodigo'); fncRelodListas();">
											<option value = "">-- Seleccione --</option>
											<?php
												include ('../src/FunGen/floadsistemaot.php');
												floadsistemaot($sistemcodigo,$plantacodigo,$idcon);
		            						?>
		            					</select></td>
									</tr>
									<tr>
		            					<td class="NoiseFooterTD cont-label-b"><?php if($campnomb["equipocodigo"] == 1)echo "*"; ?>&nbsp;Equipo</td>
		            					<td class="NoiseDataTD cont-field-b">
	            							<select name="equipocodigo" id="equipocodigo" onChange="<?php if($arrParametros['activa_campo_componen']) { ?>accionLoadSelect(this.value, 'componen', 'componcodigo');<?php } ?> fncRelodListas();">
												<option value = "">-- Seleccione --</option>
			            						<?php
													include ('../src/FunGen/floadequipoot.php');
													floadequipoot($equipocodigo, $sistemcodigo,$idcon);
					    						?>
											</select>
				  						</td>
				  					</tr>
									<?php if($arrParametros['activa_campo_componen']) { ?>
				  					<tr>
				  						<td class="NoiseFooterTD cont-label-b"><?php if($campnomb["componcodigo"] == 1)echo "*"; ?>&nbsp;Componente</td>
				  						<td class="NoiseDataTD cont-field-b"><select name="componcodigo" id="componcodigo" onchange="<?php if($arrParametros['activa_campo_parte']) { ?>accionLoadSelect(this.value, 'parte', 'partecodigo');<?php } ?> fncRelodListas();" >
											<option value = "">-- Seleccione --</option>
		            						<?php
												include ('../src/FunGen/floadcomponenequi.php');
												floadcomponenequi($componcodigo,$equipocodigo,$idcon);
											?>
		          						</select></td>
									</tr>
									<?php } ?>
									<?php if($arrParametros['activa_campo_parte']) { ?>
				  					<tr>
				  						<td class="NoiseFooterTD cont-label-b"><?php if($campnomb["partecodigo"] == 1)echo "*"; ?>&nbsp;Parte</td>
				  						<td class="NoiseDataTD cont-field-b"><select name="partecodigo" id="partecodigo" onchange="fncRelodListas();">
											<option value = "">-- Seleccione --</option>
		            						<?php
												include ('../src/FunGen/floadparte.php');
												floadpartecomp($partecodigo, $componcodigo, $idcon);
											?>
		          						</select></td>
									</tr>
									<?php } ?>
									<tr>
										<td class="NoiseFooterTD cont-label">&nbsp;Tipo de Trabajo</td>
										<td class="NoiseDataTD cont-field"><select name="tiptracodigo" id="tiptracodigo" onChange="fncRelodListas();">
											<option value = "">-- Seleccione --</option>
											<?php
												include ('../src/FunGen/floadtipotrab.php');
												floadtipotrab($tiptracodigo,$idcon, $usuatipotrab);
											?>
										</select></td>
									</tr>
								</table>
							</div>
						</div>
						<div id="programaciones">
							<ul>
								<li><a href="#tabs-1"><small>Programaciones</small></a></li>
							</ul>
							<div id="tabs-1">
								<!-- Contenido de Listado de Ordenes Programacion -->
								<div class="contenido-general">
									<div id="contentprgramacion" style="width: 1099px">
				        				<?php 
				        					$noAjax = true;
				        					include '../src/FunjQuery/jquery.visors/jquery.prografutura.php';
				        				?>
				                   	</div> 
				                   	<input type="hidden" name="arrotprograma" id="arrotprograma" value="<?php echo $arrotprograma ?>">
								</div>
								<!-- Contenido de Listado de Ordenes Programacion -->
							</div>
						</div>
					</td>
				</tr>
				<!--
				<tr>
					<td class="NoiseErrorDataTD" align="center"><div class="console-buttons-float-topright">
						<div class="ui-widget">
							<div class="ui-state-highlight ui-corner-all" style="padding: .5em .5em;"> 
								<div class="ui-buttonset">
									<button id="updateprint">Generar ordenes</button>
								</div>
							</div>
						</div>
					</div></td>
				</tr>
				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr>
				-->
			</table> 
			<input type="hidden" name="tabselected" id="tabselected">
			<input type="hidden" name="arrgenots" id="arrgenots">
			<input type="hidden" name="codigo" id="codigo" value="<?php echo $codigo; ?>">
		</form>
		<div id="msgwindow" title="Adsum Kallpa"><span id="msg"></span></div>
		<div id="windowCierremasivo" title="Adsum Kallpa"><div id="contentcierremasivo"></div></div>
  	</body>
<?php if(!$codigo){ echo " -->"; } ?>
</html>