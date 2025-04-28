<?php
ob_start();
	ini_set('display_errors',1);
	include ( '../src/FunGen/sesion/fncvalses.php');
	include ( '../src/FunGen/sesion/fncvarsesion.php');
	include ( '../src/FunPerPriNiv/pktblplanta.php');
	include ( '../src/FunPerPriNiv/pktblsistema.php');
	include ( '../src/FunPerPriNiv/pktblequipo.php');
	include ( '../src/FunPerPriNiv/pktblcomponen.php');
	include ( '../src/FunPerPriNiv/pktbltipocomponen.php');
	include ( '../src/FunPerPriNiv/pktbltipomedi.php');
	include ( '../src/FunPerPriNiv/pktbltipomant.php');
	include ( '../src/FunPerPriNiv/pktbltarea.php');
	include ( '../src/FunPerPriNiv/pktbltipotrab.php');
	include ( '../src/FunPerPriNiv/pktblusuario.php');
	include ( '../src/FunPerPriNiv/pktblpriorida.php');
	include ( '../src/FunPerPriNiv/pktblotestado.php');
	include ( '../src/FunGen/floadtimehours.php');
	include ( '../src/FunGen/floadtimeminut.php');
	include ( '../src/FunGen/fncstrfecha.php');

	if($accionnuevoprogramacionequipos)
		include ( 'grabaprogramacion.php');
ob_end_flush();
?>
<html> 
	<head> 
		<title>Nuevo registro de programacion</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0">
		<?php include('../def/jquery.library_maestro.php');?>
		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.function_comun.js"></script>
		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.function_ot.js"></script>
		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.cascadebox.js"></script>

		<SCRIPT language=JavaScript src="../src/FunGen/jsrsClient.js" type="text/javascript"></SCRIPT>
		<script language=JavaScript src="../src/FunGen/cargarSistema.js" type="text/javascript"></script>
		<script language=JavaScript src="../src/FunGen/cargarEquipos.js" type="text/javascript"></script>
		<script language=JavaScript src="../src/FunGen/cargarComponen.js" type="text/javascript"></script>
		<script language=JavaScript src="../src/FunGen/cargarDescripciontareap.js" type="text/javascript"></script>
		<script type="text/javascript">
			$(function(){
				$("#prografecini").datepicker({changeMonth: true,changeYear: true});
				$("#prografecini").datepicker('option', {dateFormat: 'yy-mm-dd'});
				$("#prografecini").datepicker($.datepicker.regional['es']);
				<?php if($prografecini && $flagnuevoprogramacion): ?>$("#prografecini").datepicker("setDate", '<?php echo $prografecini; ?>');<?php endif ?>
			});
		</script>
		<style type="text/css">
			select,	 #equiponombre {font-size: 12px;}
			.style1 {font-size: 12px}
			.dont-line-1 {border-top:0; border-bottom:0; border-left:0;}
			.dont-line-2 {border:0;}
		</style>
	</head>
<?php if(!$codigo){ echo "<!--";} ?>
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Programaci&oacute;n de mantenimiento</font></p> 
			<table width="850" border="0" align="center" cellpadding="1" cellspacing="1" class="ui-widget-content">
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
						<strong>Advertencia:</strong> El equipo seleccionado se encuentra '<span id="equipoestado"></span>' por esta raz&oacute;n  no se generara ninguna de las rutinas programadas a este equipo.</p>
					</div>
				</div></td></tr>
				<tr><td class="ui-widget-header"><span class="style5"><font color="FFFFFF"> Rutina de mantenimiento</font></span></td></tr>
				<tr>
					<td>
						<table width="98%" border="0" cellspacing="0" cellpadding="0" align="center">
							<tr><td class="ui-state-default">&nbsp;<small><?php echo strfecha(date("Y-m-d"))  ?></small></td></tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
							<tr>
          						<td class="NoiseFooterTD" width="15%"><?php if($campnomb["plantacodigo"] == 1)echo "*"; ?>&nbsp;Ubicaci&oacute;n</td>
          						<td class="NoiseDataTD" width="85%"><select name="plantacodigo" id="plantacodigo" onChange="cargarSistemas(this.value); setEquCompleteSource();" <?php if($equipotexto){ echo "disabled"; } ?>>
          							<option value = "">-- Seleccione --</option>
									<?php
							 			if(!$flagnuevoprogramacion)
			  								unset($plantacodigo);
			  								
										$idcon = fncconn();
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
            							<select name="equipocodigo" id="equipocodigo" onChange="accionLoadTransCont(this.value);accionLoadSelect(this.value, 'componen_', 'tipcomcodigo');"> <!-- LoadDetalleequipo(this.value,'<?php echo $GLOBALS['usuaplanta']; ?>'); -->
											<option value = "">-- Seleccione --</option>
		            						<?php
												include ('../src/FunGen/floadequipoot.php');
												floadequipoot($equipocodigo, $sistemcodigo,$idcon);
				    						?>
										</select>
            						</div>
            						<div id="filtrolist" style="display: <?php if($filterindex): ?>block;<?php else: ?>none;<?php endif; ?>">
            							<input type="text" size="122" name="equiponombre" id="equiponombre" value="<?php if($flagnuevoprogramacion) echo $equiponombre ?>">
            							<input type="hidden" name="equipocodigocmbx" id="equipocodigocmbx" value="<?php if($flagnuevoprogramacion) echo $equipocodigocmbx ?>">
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
//	            								LoadDetalleequipo(ui.item.id,'<?php echo $GLOBALS['usuaplanta']; ?>')
	            								accionLoadTransCont(ui.item.id);
	            							}
	            						});
            						</script>
		  						</td>
		  					</tr>
							<tr>
		  						<td class="NoiseFooterTD"><?php if($campnomb["	tipcomcodigo"] == 1)echo "*"; ?>&nbsp;Tipo de Componente</td>
		  						<td class="NoiseDataTD"><select name="	tipcomcodigo" id="tipcomcodigo"> <!-- onchange="LoadDetallecomponen(this.value,'<?php echo $GLOBALS['usuaplanta']; ?>');"  -->
									<option value = "">-- Seleccione --</option>
            						<?php
										//include ('../src/FunGen/floadtipocompon.php');
										//floadtipocomponequipo($tipcomcodigo,$equipocodigo,$idcon);
									?>
          						</select></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
							<tr>
								<td width="15%" class="NoiseFooterTD"><?php if($campnomb["tipmancodigo"] == 1){$tipmancodigo = null; echo "*";}?>&nbsp;Mantenimiento</td>
								<td width="35%" class="NoiseDataTD"><select name="tipmancodigo">
									<option value="">-- Seleccione --</option>
									<?php
								 		if(!$flagnuevoprogramacion)
				  							unset($tipmancodigo);
				  															
										include ('../src/FunGen/floadtipomant.php');
										floadtipomant($tipmancodigo,$idcon);
									?>
									</select>
								</td>
								<td width="15%" class="NoiseFooterTD"><?php if($campnomb["prioricodigo"] == 1){$prioricodigo = null; echo "*";}?>&nbsp;Prioridad</td>
								<td width="35%" class="NoiseDataTD"><select name="prioricodigo">
									<option value="">-- Seleccione --</option>
									<?php
							 			if(!$flagnuevoprogramacion)
			  								unset($prioricodigo);
										
			  							include ('../src/FunGen/floadpriorida.php');
										floadpriorida($prioricodigo, $idcon);
									?>
								</select></td>
							</tr>
							<tr>
								<td class="NoiseFooterTD"><?php if($campnomb["tareacodigo"] == 1){ echo $tareacodigo = null; echo "*";}?>&nbsp;Tarea</td>
								<td colspan="3" class="NoiseDataTD"><select name="tareacodigo" onChange="cargarDescripciontarea(this.value);">
									<option value="">-- Seleccione --</option>
									<?php
										if(!$flagnuevoprogramacion)
											unset($tareacodigo);
								
										include ('../src/FunGen/floadtarea.php');
										floadtarea($tareacodigo,$idcon);
									?>
          						</select></td>
          					</tr>
          					<tr>
          						<td class="NoiseFooterTD"><?php if($campnomb["tiptracodigo"] == 1){$tiptracodigo = null; echo "*";}?>&nbsp;Tipo de trabajo</td>
								<td colspan="3" class="NoiseDataTD"><select name="tiptracodigo">
									<option value="">-- Seleccione --</option>
            						<?php
            							if(!$flagnuevoprogramacion)
											unset($tareacodigo);

										include ('../src/FunGen/floadtipotrab.php');
										floadtipotrab($tiptracodigo,$idcon, $usuatipotrab);
									?>
          						</select></td>
		  					</tr>
		  					<tr><td class="ui-state-default" colspan="4"></td></tr>
							<tr><td class="NoiseFooterTD" colspan="4"><?php if($campnomb["progranota"] == 1){echo $progranota = null; echo "*";}?>&nbsp;Descripci&oacute;n del Trabajo a Realizar</td></tr>
		  					<tr><td colspan="4" class="NoiseDataTD"><textarea name="progranota" cols="86" rows="3" wrap="VIRTUAL"><?php if(!$flagnuevoprogramacion){ echo $sbreg["progranota"];}else{ echo $progranota;}?></textarea></td></tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
							<tr>
								<td class="NoiseFooterTD" width="20%"><?php if($campnomb["prografecini"] == 1){$prografecini = null; echo "*";}?>&nbsp;Fecha inicio de contador</td>
								<td class="NoiseDataTD" colspan="3"><input type="text" name="prografecini" id="prografecini" size="12"></td>
        					</tr>
        					<tr>
								<td width="20%" class="NoiseFooterTD"><?php if($campnomb["otestacodigo"] == 1)echo "*"; ?>&nbsp;Estado de creaci&oacute;n OT</td>
								<td colspan="3" class="NoiseDataTD"><select name="otestacodigo" id="otestacodigo">
									<?php
										include('../src/FunGen/floadotestadoot.php');
										floadotestadoot($otestacodigo,$idcon);
									?>
								</select></td>
							</tr>
							<tr>
								<td width="20%" class="NoiseFooterTD"><?php if($campnomb["progratiedur"] == 1){$progratiedur = null; echo "*";}?>&nbsp;Duraci&oacute;n de la OT</td>
								<td width="25%" class="NoiseDataTD">
									<input type="text" name="progratiedur" value="<?php if(!$flagnuevoprogramacion){ echo $sbreg[progratiedur]; }else{ echo $progratiedur; } ?>" size="10">
									<select name="optiedur">
										<option value="1" <?php if($optiedur == 1) echo 'selected' ?>>hora(s).</option>
										<option value="2" <?php if($optiedur == 2) echo 'selected' ?>>minuto(s).</option>
									</select>
								</td>
								<td width="10%" class="NoiseFooterTD"><?php if($campnomb["prografrecue"] == 1){$prografrecue = null; echo "*";}?>&nbsp;Periodo</td>
								<td width="45%" class="NoiseDataTD">
									<input type="text" name="prografrecue" value="<?php if(!$flagnuevoprogramacion){ echo $sbreg[prografrecue];}else{echo $prografrecue;}?>" size="10">
									<select name="tipmedcodigo">
										<option value="">-- Seleccione --</option>
										<?php
								 			if(!$flagnuevoprogramacion)
				  								unset($tipmedcodigo);
											
				  							include ('../src/FunGen/floadtipomediprg.php');
											floadtipomedi($tipmedcodigo, $idcon);
										?>
									</select>
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
				<tr><td class="NoiseErrorDataTD" colspan="2">&nbsp;</td></tr>
			</table>
			<input type="hidden" name="accionnuevoprogramacionequipos">
			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>">
			<input type="hidden" name="sourceaction" value="nuevo"> 

			<input type="hidden" name="progracodigo" value="<?php if(!$flagnuevoprogramacion){ echo $sbreg[progracodigo];}else{ echo $progracodigo; } ?>">
			<input type="hidden" name="repetirot" value="0"> 
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
		</form>
	</body>
<?php if(!$codigo){ echo " -->"; } ?>
</html>
