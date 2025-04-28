<?php
ob_start();
	include ( '../src/FunGen/sesion/fncvalses.php');
	include ( '../src/FunPerPriNiv/pktblsoliserv.php');
	include ( '../src/FunPerPriNiv/pktblplanta.php');
	include ( '../src/FunPerPriNiv/pktblsistema.php');
	include ( '../src/FunPerPriNiv/pktblequipo.php');
	include ( '../src/FunPerPriNiv/pktblcomponen.php');
	include ( '../src/FunPerPriNiv/pktblitem.php');
	include ( '../src/FunPerPriNiv/pktbloperacio.php');
	include ( '../src/FunPerPriNiv/pktblotestado.php');
	include ( '../src/FunPerPriNiv/pktbltipomant.php');
	include ( '../src/FunPerPriNiv/pktblpriorida.php');
	include ( '../src/FunPerPriNiv/pktbltarea.php');
	include ( '../src/FunPerPriNiv/pktblherramie.php');
	include ( '../src/FunPerPriNiv/pktbltransacherramie.php');
	include ( '../src/FunPerPriNiv/pktbltransacitem.php');
	include ( '../src/FunPerPriNiv/pktbltipotrab.php');
	include ( '../src/FunPerPriNiv/pktbltipofall.php');
	include ( '../src/FunPerPriNiv/pktblusuario.php');
	include ( '../src/FunPerPriNiv/pktbltransaction.php');
	include ( '../src/FunGen/sesion/fncvarsesion.php');
	include ( '../src/FunGen/floadtimehours.php');
	include ( '../src/FunGen/floadtimeminut.php');
	include ( '../src/FunPerPriNiv/pktbltareot.php');
	include ( '../src/FunPerPriNiv/pktblusuariotareot.php');
	include ( '../src/FunPerPriNiv/pktblitemtareot.php');
	include ( '../src/FunGen/floadusuaselect.php');
	include ( '../src/FunPerPriNiv/pktbltareotherramie.php');
	include ( '../src/FunPerPriNiv/pktbldepartam.php');
	include ( '../src/FunGen/fncstrfecha.php');
	include ( '../src/FunGen/fncseeknegocio.php');
	
	
	$flagsoliot = 1;
	session_register("flaginside_edit");
	$_SESSION["flaginside_edit"] = true;
	$idcon = fncconn();
	
	if($accioneditarot){
		include ( 'editaot.php');
		$flageditarot = 1;
	}
ob_end_flush();

	if(!$flageditarot)
	{
		include ( '../src/FunGen/sesion/fnccarga.php');
		$sbreg = fnccarga($nombtabl,$radiobutton);
		if (!$sbreg)
			include( '../src/FunGen/fnccontfron.php');
			
		$ordtrafecgen = $sbreg['ordtrafecgen'];	
		$ordtrahorgen = $sbreg['ordtrahorgen'];	
		$plantacodigo = $sbreg["plantacodigo"];
		$sistemcodigo = $sbreg["sistemcodigo"];
		$equipocodigo = $sbreg["equipocodigo"];
		$componcodigo = $sbreg["componcodigo"];
		$ordtrafecini = $sbreg["ordtrafecini"];
		$ordtrafecfin = $sbreg["ordtrafecfin"];
		$tipfalcodigo = $sbreg["tipfalcodigo"];
		
		include('detallaot.php');

		$otestacodigo = $sbregtareot1[otestacodigo];
		$tiptracodigo = $sbregtareot1[tiptracodigo];
		$tareacodigo = $sbregtareot1[tareacodigo];
		$prioricodigo = $sbregtareot1[prioricodigo];
	}
?>
<html>
	<head>
		<title>editar registro de ot</title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		<meta http-equiv="expires" content="0">
		<?php include('../def/jquery.library_maestro.php');?>
		
		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.ui.ajax_accionextras.js"></script>
		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.function_comun.js"></script>
		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.function_ot.js"></script>
		
		<script language="JavaScript" src="motofech.js"></script>
		<SCRIPT language=JavaScript src="../src/FunGen/jsrsClient.js"		type="text/javascript" ></SCRIPT>
		<script language=JavaScript src="../src/FunGen/cargarSistema.js" type="text/javascript" ></script>
		<script language=JavaScript src="../src/FunGen/cargarEquipos.js" type="text/javascript" ></script>
		<script language=JavaScript src="../src/FunGen/cargarComponen.js" type="text/javascript" ></script>
		<script language=JavaScript src="../src/FunGen/cargarEmpleaselec.js" type="text/javascript" ></script>
		<script language=JavaScript src="../src/FunGen/cargarTransacherram.js" type="text/javascript" ></script>
		<script language=JavaScript src="../src/FunGen/cargarTransacitem.js" type="text/javascript" ></script>
		<script language=JavaScript src="../src/FunGen/fncbotton.js" type="text/javascript" ></script>
		<script language=JavaScript src="../src/FunGen/fncverificarlider.js" type="text/javascript" ></script>
        <SCRIPT src="../src/FunGen/achess.js" type="text/javascript"></SCRIPT>


		<SCRIPT LANGUAGE="JavaScript">
			var arreglo_auxtmp = new Array;
			var arreglo_auxdef = new Array;
			var arreglo_ite = new Array;
			var arreglo_herr = new Array;
			
			function carga()
			{
				for(var k=0; k < document.form1.elements['itemcodigo'].length; k++)
					arreglo_ite[k] = document.form1.itemcodigo[k].value;

				document.form1.arreglo_ite.value = arreglo_ite;
				
				for(var k=0; k < document.form1.elements['herramcodigo'].length; k++)
					arreglo_herr[k] = document.form1.herramcodigo[k].value;
				
				document.form1.arreglo_herr.value = arreglo_herr;
			}

			function Changeindc(Index, usuaplanta)
			{
				if(Index == 0)
				{
					LoadDetalleequipo(form1.equipocodigo.value,usuaplanta);
					LoadDetallecomponen(form1.componcodigo.value,usuaplanta);
				}
				else
				{
					LoadDetalleequipo(form1.equipocodigo_auto.value,usuaplanta);
					LoadDetallecomponen(form1.componcodigo_auto.value,usuaplanta);
				}
			}

			$(function(){
				<?php if($sbreg['ordtranumpro']): ?>$( "#aceptarot" ).button({ disabled: true });<?php endif ?>
				<?php if($typesource == 'cuadrilla'): ?>$( "#retottecnico" ).button({ disabled: true });<?php endif ?>
				$("#ordtrafecini").datepicker("setDate", '<?php echo $ordtrafecini; ?>');
				$("#ordtrafecfin").datepicker("setDate", '<?php echo $ordtrafecfin; ?>');
			});
		</script> 
		<style type="text/css">
			select, #equiponombre {font-size: 12px;}
			.style1 {font-size: 12px}
			.dont-line-1 {border-top:0; border-bottom:0; border-left:0;}
			.dont-line-2 {border:0;}
		</style>
	</head>
<?php if(!$codigo){ echo "<!--";} ?>
	<body bgcolor="FFFFFF" text="#000000">
		<form name="form1" method="post"  enctype="multipart/form-data">
			<p><font class="NoiseFormHeaderFont">Ordenes de trabajo</font></p>
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
				<tr><td><div class="ui-widget" id="equipoerror" style="display:none;">
					<div class="ui-state-error ui-corner-all" style="padding: 0 .7em;"> 
						<p><span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span> 
						<strong>Advertencia:</strong> El equipo seleccionado se encuentra '<span id="equipoestado"></span>' y no es posible generar una Orden.</p>
					</div>
				</div></td></tr>
				<tr><td><div class="ui-widget" id="equipoerror" style="display:<?php if($sbreg['ordtranumpro']): echo "block"; else: echo "none"; endif; ?>;">
					<div class="ui-state-error ui-corner-all" style="padding: 0 .7em;"> 
						<p><span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span> 
						<strong>Advertencia:</strong> La orden # <b><?php echo $sbreg['ordtracodigo'] ?></b> no se puede modificar ya que proviene de una programaci&oacute;n</p>
					</div>
				</div></td></tr>
				<tr><td class="ui-widget-header"><span class="style5"><font color="FFFFFF">Editar registro</font></span>	</td></tr>
				<tr>
					<td>
						<table width="98%" border="0" cellspacing="0" cellpadding="0" align="center">
							<tr><td class="ui-state-default">&nbsp;<small><?php echo strfecha(date("Y-m-d", strtotime($ordtrafecgen)))  ?></small></td></tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
							<tr>
								<td width="15%" class="NoiseFooterTD"><?php if($campnomb["otestacodigo"] == 1)echo "*"; ?>&nbsp;Estado de creaci&oacute;n</td>
								<td width="85%" class="NoiseDataTD"><select name="otestacodigo" id="otestacodigo">
									<?php
										include('../src/FunGen/floadotestadoot.php');
										$idcon = fncconn();
										floadotestadoot($otestacodigo,$idcon);
									?>
								</select></td>
							</tr>
							<tr><td class="ui-state-default" colspan="2"></td></tr>
							<tr>
          						<td class="NoiseFooterTD"><?php if($campnomb["plantacodigo"] == 1)echo "*"; ?>&nbsp;Ubicaci&oacute;n</td>
          						<td class="NoiseDataTD"><select name="plantacodigo" id="plantacodigo" onChange="cargarSistemas(this.value); setEquCompleteSource();" <?php if($equipotexto){ echo "disabled"; } ?>>
									<?php
										include ('../src/FunGen/floadplanta.php');
										floadplanta($plantacodigo,$idcon);
									?>
            					</select></td>
          					</tr>
							<tr>          						
          						<td class="NoiseFooterTD"><?php if($campnomb["sistemcodigo"] == 1)echo "*"; ?>&nbsp;Proceso</td>
            					<td class="NoiseDataTD"><select name="sistemcodigo" id="sistemcodigo" onChange="cargarEquipos(this.value); setEquCompleteSource();" <?php if($equipotexto){ echo "disabled";} ?>>
									<option value = "">-- Seleccione --</option>
									<?php
										include ('../src/FunGen/floadsistemaot.php');
										floadsistemaot($sistemcodigo,$plantacodigo,$idcon);
            						?>
            					</select></td>
							</tr>
							<tr>
            					<td class="NoiseFooterTD"><?php if($campnomb["equipocodigo"] == 1)echo "*"; ?>&nbsp;Equipo&nbsp;<img onclick = "viewFilter();" src="../img/icon_filter.png" border=0></td>
            					<td class="NoiseDataTD">
            						<div id="selectlist" style="display: <?php if(!$filterindex): ?>block;<?php else: ?>none;<?php endif; ?>">
            							<select name="equipocodigo" id="equipocodigo" onChange="accionLoadTransCont(this.value); LoadDetalleequipo(this.value,'<?php echo $GLOBALS['usuaplanta']; ?>'); cargarComponen(this.value);">
											<option value = "">-- Seleccione --</option>
		            						<?php
												include ('../src/FunGen/floadequipoot.php');
												floadequipoot($equipocodigo, $sistemcodigo,$idcon);
				    						?>
										</select>
            						</div>
            						<div id="filtrolist" style="display: <?php if($filterindex): ?>block;<?php else: ?>none;<?php endif; ?>">
            							<input type="text" size="122" name="equiponombre" id="equiponombre" value="<?php echo $equiponombre ?>">
            							<input type="hidden" name="equipocodigocmbx" id="equipocodigocmbx" value="<?php echo $equipocodigocmbx ?>">
            							<input type="hidden" name="idusua" id="idusua" value="<?php echo $usuacodi ?>">
            							<input type="hidden" name="filterindex" id="filterindex" value="<?php echo $filterindex ?>">
            						</div>
            						<script type="text/javascript">
	            						$("#equiponombre").autocomplete({
	            							source: "../src/FunjQuery/jquery.phpcombobox/jquery.cmbx_equipo.php?id=" + document.getElementById('idusua').value + "&plantacodigo=" + document.getElementById('plantacodigo').value + "&sistemcodigo="  + document.getElementById('sistemcodigo').value,
	            							minLength: 1,
	            							select: function(event, ui) {
	            								ui.item ? document.getElementById('equipocodigocmbx').value = ui.item.id : document.getElementById('equipocodigocmbx').value = "";
	            								cargarComponen(ui.item.id);
	            								LoadDetalleequipo(ui.item.id,'<?php echo $GLOBALS['usuaplanta']; ?>');
	            								accionLoadTransCont(ui.item.id);
	            							}
	            						});
            						</script>
<!--      								<SCRIPT type=text/javascript>Event.observe($('equipocodigo'),'keyup', function(f){ if (f.keyCode==113)filtradorselect('equipocodigo')} );</SCRIPT>	-->
		  						</td>
		  					</tr>
		  							  					<tr>
		  						<td class="NoiseFooterTD"><?php if($campnomb["tipcomcodigo"] == 1)echo "*"; ?>&nbsp;Sistema</td>
		  						<td class="NoiseDataTD"><select name="tipcomcodigo" id="tipcomcodigo" onchange="LoadDetalletipocomponen(this.value,'<?php echo $GLOBALS['usuaplanta']; ?>');" >
									<option value = "">-- Seleccione --</option>
            						<?php
										include ('../src/FunGen/floadtipocompon.php');
										floadtipocompon($componcodigo,$equipocodigo,$idcon);
									?>
          						</select></td>
							</tr>
		  					
		  					<tr>
		  						<td class="NoiseFooterTD"><?php if($campnomb["componcodigo"] == 1)echo "*"; ?>&nbsp;Componente</td>
		  						<td class="NoiseDataTD"><select name="componcodigo" id="componcodigo" onchange="LoadDetallecomponen(this.value,'<?php echo $GLOBALS['usuaplanta']; ?>');" >
									<option value = "">-- Seleccione --</option>
            						<?php
										include ('../src/FunGen/floadcomponenequi.php');
										floadcomponenequi($componcodigo,$equipocodigo,$idcon);
									?>
          						</select></td>
							</tr>
      						<tr>
  								<td class="ui-state-default" colspan="2">&nbsp;<a onClick="return verocultar('filtrdatosequipo',0);" href="javascript:animatedcollapse.toggle('filtrdatosequipo');"><img id="row0" align="middle" align="top"  src="temas/Noise/DescOn.gif" border="0">&nbsp;Datos del equipo</a>
									<div id="filtrdatosequipo" style="padding: 2px 2px 2px 2px; display:none" >
				        				<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center">
				                   			<tr>
			                   					<td height="190"  class="ui-widget-content"><iframe  frameborder="0" name="detalleotequipo" id="detalleotequipo"  height="190" width="100%" align="absmiddle" src="detallarotequipo.php?equipocodigo=<?php if($equipotexto){ echo $equipocodigo_auto; }else{  echo $equipocodigo; } ?>&usuaplanta=<?php echo $GLOBALS['usuaplanta'];  ?>"></iframe></td>
				                   			</tr>
				                   		</table>
				                   	</div> 
								</td>
							</tr>
							<tr><td class="ui-state-default" colspan="2"></td></tr>
							<tr>
  								<td class="ui-state-default" colspan="2">&nbsp;<a onClick="return verocultar('filtrdatoscomponen',1);" href="javascript:animatedcollapse.toggle('filtrdatoscomponen');"><img id="row1" align="middle" align="top"  src="temas/Noise/DescOn.gif" border="0">&nbsp;Datos del componente</a>
									<div id="filtrdatoscomponen" style="padding: 2px 2px 2px 2px; display:none" >
				        				<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center">
				                   			<tr>
			                   					<td height="190"  class="ui-widget-content"><iframe  frameborder="0" name="detalleotcomponen" id="detalleotcomponen"  height="190" width="100%" align="absmiddle" src="detallarotcomponen.php?componcodigo=<?php if($equipotexto){ echo $componcodigo_auto; }else{  echo $componcodigo; } ?>&equipocodigo=<?php if($equipotexto){ echo $equipocodigo_auto; }else{  echo $equipocodigo; } ?>&usuaplanta=<?php echo $GLOBALS['usuaplanta'];  ?>"></iframe></td>
				                   			</tr>
				                   		</table>
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
								<td class="NoiseFooterTD" width="15%"><?php if($campnomb["ordtrafecini"] == 1){$ordtrafecini = null; echo "*";}?>&nbsp;Fecha de inicio</td>
								<td class="NoiseDataTD" width="32%">
									<input type="text" name="ordtrafecini" id="ordtrafecini" size="8">&nbsp;
	              					<select name="horini"><?php floadtimehours($horini); ?></select>:<select name="minini"><?php floadtimeminut($minini); ?></select>
	            					<input type="checkbox" name="pasadmerini" <?php if($flagnuevoot){if($pasadmerini)echo "CHECKED";}else{if($pasadmerini)echo "CHECKED";}?>>&nbsp;p.m.
								</td>
								<td class="NoiseFooterTD" width="22%"><?php if($campnomb["ordtrafecfin"] == 1){ $ordtrafecfin = null; echo "*";} ?>&nbsp;Fecha estimada a finalizar</td>
								<td class="NoiseDataTD" width="31%">
									<input type="text" name="ordtrafecfin" id="ordtrafecfin" size="8">&nbsp;
									<select name="horfin"><?php floadtimehours($horfin); ?></select>:<select name="minfin"><?php floadtimeminut($minfin); ?></select>
									<input type="checkbox" name="pasadmerfin" <?php if($flagnuevoot){if($pasadmerfin)echo "CHECKED";}?>>p.m
								</td>
        					</tr>
        				</table>
					</td>
				</tr>
				<tr>
					<td>
						<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
							<tr>
								<td width="20%" class="NoiseFooterTD"><?php if($campnomb["tipfalcodigo"] == 1){$tipfalcodigo = null; echo "*";}?>&nbsp;Falla</td>
								<td width="80%" class="NoiseDataTD"><select name="tipfalcodigo">
									<option value="">-- Seleccione --</option>
									<?php
										include ('../src/FunGen/floadtipofall.php');
										floadtipofall($tipfalcodigo,$idcon);
									?>
								</select></td>
							</tr>
							<tr><td class="ui-state-default" colspan="2"></td></tr>
							<tr><td colspan="2" class="NoiseFooterTD"><?php if($campnomb["ordtradescri"] == 1){$ordtradescri = null; echo "*";} ?>&nbsp;Descripci&oacute;n de la falla</td></tr>
							<tr><td colspan="2" class="NoiseDataTD"><textarea name="ordtradescri" cols="86" rows="2" wrap="VIRTUAL"><?php echo $sbreg["ordtradescri"]; ?></textarea></td></tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
							<tr>
								<td width="20%" class="NoiseFooterTD"><?php if($campnomb["tipmancodigo"] == 1){$tipmancodigo = null; echo "*";}?>&nbsp;Mantenimiento</td>
								<td width="30%" class="NoiseDataTD"><select name="tipmancodigo">
									<?php
										include ('../src/FunGen/floadtipomant.php');
										floadtipomant($tipmancodigo,$idcon);
									?>
									</select>
								</td>
								<td width="20%" class="NoiseFooterTD"><?php if($campnomb["prioricodigo"] == 1){$prioricodigo = null; echo "*";}?>&nbsp;Prioridad</td>
								<td width="30%" class="NoiseDataTD"><select name="prioricodigo">
									<?php
			  							include ('../src/FunGen/floadpriorida.php');
										floadpriorida($prioricodigo, $idcon);
									?>
								</select></td>
							</tr>
							<tr>
								<td class="NoiseFooterTD"><?php if($campnomb["tareacodigo"] == 1){ echo $tareacodigo = null; echo "*";}?>&nbsp;Tarea</td>
								<td colspan="3" class="NoiseDataTD"><select name="tareacodigo" onChange="cargarDescripciontarea(this.value);">
									<?php
										include ('../src/FunGen/floadtarea.php');
										floadtarea($tareacodigo,$idcon);
									?>
          						</select></td>
          					</tr>
          					<tr>
          						<td class="NoiseFooterTD"><?php if($campnomb["tiptracodigo"] == 1){$tiptracodigo = null; echo "*";}?>&nbsp;Tipo de trabajo</td>
								<td colspan="3" class="NoiseDataTD"><select name="tiptracodigo">
            						<?php
										include ('../src/FunGen/floadtipotrab.php');
										floadtipotrab($tiptracodigo,$idcon, $usuatipotrab);
									?>
          						</select></td>
		  					</tr>
		  					<tr><td class="ui-state-default" colspan="4"></td></tr>
							<tr><td class="NoiseFooterTD" colspan="4"><?php if($campnomb["tareotnota"] == 1){echo $tareotnota = null; echo "*";}?>&nbsp;Descripci&oacute;n del Trabajo a Realizar</td></tr>
		  					<tr><td colspan="4" class="NoiseDataTD"><textarea name="tareotnota" cols="86" rows="3" wrap="VIRTUAL"><?php if(!$flageditarot){ echo $sbregtarnota;}else{ echo $tareotnota;} ?></textarea></td></tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center">
							<tr>
  								<td align="center">
  									<div style="width:778px; height: 14px; margin:0 auto;" class="ui-state-default">
										<a onClick="return verocultar('involucrados',2);" href="javascript:animatedcollapse.toggle('involucrados');"><img id="row2" align="middle" align="top"  src="temas/Noise/<?php if($arrheots) echo 'AscOn'; else echo 'DescOn'  ?>.gif" border="0">&nbsp;Empleados involucrados en la orden</a>
									</div>
  									<div id="involucrados">
										<?php 
											include_once '../src/FunPerPriNiv/pktblcalendario.php';
											include_once '../src/FunPerPriNiv/pktblcuadrilla.php';
											include_once '../src/FunPerPriNiv/pktblcuadrillausuario.php';
											include_once '../src/FunPerPriNiv/pktblcargo.php';
											include_once '../src/FunPerPriNiv/pktblusuanovedad.php';
											include_once '../src/FunPerPriNiv/pktblestadonoveda.php';
											
											$fecini = $ordtrafecini;
											$fecfin = $ordtrafecfin;
											$iRegArray = $lsttecnicoot;
											$noAjax = true;
											include '../src/FunjQuery/jquery.accionextras/jquery.ajax_loadUsuaOt.php'; 
										?>
									</div>
									<input type="hidden" name="alllsttecnicoottmp" id="alllsttecnicoottmp" value="<?php echo $alllsttecnicoottmp; ?>">
									<input type="hidden" name="lsttecnicoot" id="lsttecnicoot" value="<?php echo $lsttecnicoot; ?>">
									<input type="hidden" name="usualider" id="usualider" value="<?php  echo $usualider;  ?>">
									<input type="hidden" name="typesource" id="typesource" value="<?php  echo $typesource;  ?>">
									<input type="hidden" name="negocicodigo" id="negocicodigo" value="<?php  echo $negocicodigo;  ?>">
								</td>
							</tr>
							<tr><td><div class="ui-buttonset" style="width:770px;">
								<button id="anxotcuadrilla">Agregar cuadrilla</button>&nbsp;&nbsp;&nbsp;
								<button id="anxottecnico">Agregar t&eacute;cnico a la lista</button>&nbsp;
								<button id="retottecnico">Quitar t&eacute;cnico de la lista</button>
							</div></td></tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
							<tr class="NoiseFooterTD">
								<td width="50%">Herramientas</td>
								<td width="50%">Item</td>
							</tr>
							<tr class="NoiseDataTD">
    							<td rowspan="2"><select name="herramcodigo" size="3">
								<?php
									if (!$flageditarot){
										if(!empty($sbregtransher)){
											include("../src/FunGen/floadtransacherramie.php");
											$idcon = fncconn();
											floadtransacherramie($idcon, $herrseleccodi, $herrseleccant);
											fncclose($idcon);
										}
									}
								?>
            					</select></td>
      							<td rowspan="2"><select name="itemcodigo" size="3">
								<?php
									if (!$flageditarot){
										if (!empty($sbregtransite)){
											include("../src/FunGen/floadtransacitem.php");
											$idcon = fncconn();
											floadtransacitem($idcon, $itemseleccodi, $itemseleccant);
											fncclose($idcon);
										}
									}
								?>
								</select></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr><td>&nbsp;</td></tr>
				<tr>
					<td class="NoiseErrorDataTD" align="center"><div class="ui-buttonset">
						<button id="aceptarot">Aceptar</button>&nbsp;&nbsp;&nbsp;&nbsp;
						<button id="cancelar">Cancelar</button>
					</div></td>
				</tr>
				<tr><td>&nbsp;</td></tr> 
				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr>
			</table>
<?php if($campnomb){ echo '<font face= "Verdana" >Corregir los campos marcados con *</font>';}?>
<!-- Datos de ot -->
			<input type="hidden" name="accioneditarot">
			<input type="hidden" name="ordtracodigo" value="<?php if(!$flageditarot){echo $sbreg[ordtracodigo];}else {echo $ordtracodigo;}?>">
			<input type="hidden" name="ordtrahorgen" value="<?php echo $ordtrahorgen; ?>">
			<input type="hidden" name="ordtrafecgen" value="<?php echo $ordtrafecgen;?>">
			<input type="hidden" name="solsercodigo" value="<?php echo $solsercodigo;?>">
			<input type="hidden" name="progracodigo" value="<?php echo $progracodigo;?>">
			<input type="hidden" name="ordtranumpro" value="<?php if(!$flageditarot){echo $sbreg[ordtranumpro];}else {echo $ordtranumpro;};?>">
			<input type="hidden" name="ordtraprogen" value="<?php if(!$flageditarot){echo $sbreg[ordtraprogen];}else {echo $ordtraprogen;}?>">
			<input type="hidden" name="ordtratipo" value="1">
			<input type="hidden" name="otcantid">

			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>">
			<input type="hidden" name="sourceaction" value="editar"> 
			<!-- Datos de usuariotareot -->
			<input type="hidden" name="arreglo_tecnic" value="<?php  echo $arreglo_tecnic;  ?>">
			<input type="hidden" name="arreglo_temptecnic" value="<?php  echo $arreglo_temptecnic;  ?>">
			<input type="hidden" name="lider"  value="<?php   echo $lider;  ?>">

			<!-- Datos de item -->
			<input type="hidden" name="arreglo_ite" value="<?php echo $arreglo_ite; ?>"> 
			<input type="hidden" name="loaditem" value="<?php echo $loaditem; ?>"> 

			<!-- Datos de herramienta -->
			<input type="hidden" name="arreglo_herr" value="<?php echo $arreglo_herr; ?>"> 
			<input type="hidden" name="loadherram" value="<?php $loadherram; ?>"> 
			<input type="hidden" name="flagsoliot" value="<?php echo $flagsoliot; ?>">

			<!-- Datos de tareot -->
			<input type="hidden" name="tareaotcodigo" value="<?php  if (!$flageditarot) {echo $sbregtareot1["tareotcodigo"];} else {echo $tareaotcodigo;}?>">
			<input type="hidden" name="flagsoliotitem" value="<?php echo $flagsoliotitem; ?>"> 
			
			<input type="hidden" name="codigo" id="codigo" value="<?php echo $codigo; ?>">
			<input type="hidden" name="valor">
			<input type="hidden" name="flag">
		</form>
		<div id="windowusuanovedad" title="Adsum Kallpa [Novedad]">
			<div id="usuanovmsgs">
				<table width="95%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">						
					<tr>
     					<td class="NoiseFooterTD" width="15%">&nbsp;Fecha inicio</td>
     					<td class="NoiseDataTD" width="35%">
     						<input type="text" name="usunovfecini" id="usunovfecini" size="12">
     						<select name="usunovhorini" id="usunovhorini" onChange="calculeDiff();">
								<?php
									$hora = '00:00';
									for(;;):
										echo '<option value="'.$hora.'">'.date("h:i a", strtotime($hora)).'</option>';
										$hora = date("H:i", strtotime($hora.' + 30 minutes'));
										
										if($hora == '23:30')
											break;
									endfor;
								?>
							</select>	
     					</td>
     					<td class="NoiseFooterTD" width="15%">&nbsp;Fecha fin</td>
     					<td class="NoiseDataTD" width="35%">
     						<input type="text" name="usunovfecfin" id="usunovfecfin" size="12">
     						<select name="usunovhorfin" id="usunovhorfin" onChange="calculeDiff();">
								<?php
									$hora = '00:00';
									for(;;):
										echo '<option value="'.$hora.'">'.date("h:i a", strtotime($hora)).'</option>';
										$hora = date("H:i", strtotime($hora.' + 30 minutes'));
										
										if($hora == '23:30')
											break;
									endfor;
								?>
							</select>
     					</td>
					</tr>
					<tr>
						<td class="NoiseFooterTD">&nbsp;Duraci&oacute;n</td>
						<td class="NoiseDataTD"  colspan="3"><span id="duracionhe"><?php echo $duracion ?></span><input type="hidden" value="<?php echo $duracion ?>" id="duracion" name="duracion"></td>
					</tr>
				</table>
			</div>
			<div id="usuanovmsg"></div>
		</div>
		<div id="msgwindow" title="Adsum Kallpa"><span id="msg"></span></div>
		<div id="msgwindowtecncuadrilla" title="Adsum Kallpa"><span id="msgottecncuadri"></span></div>
	</body>
<?php if(!$codigo){ echo " -->"; } ?>
</html>