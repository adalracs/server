<?php
ob_start();
	include ( '../src/FunGen/sesion/fncvalses.php');
	include ( '../src/FunPerPriNiv/pktblusuario.php');
	include ( '../src/FunPerPriNiv/pktblplanta.php');//New 12-sep-2007 cbedoya
	include ( '../src/FunPerPriNiv/pktblsistema.php');//New 12-sep-2007 cbedoya
	include ( '../src/FunPerPriNiv/pktblequipo.php');
	include ( '../src/FunPerPriNiv/pktbltipofall.php');
	include ( '../src/FunPerPriNiv/pktbltipotrab.php');
	include ( '../src/FunGen/fncstrfecha.php');
	include ( '../src/FunPerPriNiv/pktblsoliservestado.php');

	if($accionnuevosoliserv)
		include ( 'grabasoliserv.php');
ob_end_flush();
?>
<html>
	<head>
  		<title>Nuevo registro de solicitud de servicio</title>
  		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">  
  		<meta http-equiv="expires" content="0">
  		<?php include('../def/jquery.library_maestro.php');?>
  		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.function_comun.js"></script>
  		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.function_ot.js"></script>
		<SCRIPT language=JavaScript src="../src/FunGen/jsrsClient.js" type="text/javascript" ></SCRIPT>
		<script language=JavaScript src="../src/FunGen/cargarSistema.js" type="text/javascript" ></script>
		<script language=JavaScript src="../src/FunGen/cargarEquipos.js" type="text/javascript" ></script>
		<style type="text/css">
			select, #equiponombre {font-size: 12px;}
		</style>
 	</head>
<?php if(!$codigo){ echo "<!--";} ?>
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Solicitud de servicio</font></p> 
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
				<tr><td class="ui-widget-header"><span class="style5"><font color="FFFFFF"> Ingresar nuevo registro</font></span></td></tr>
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
							<tr><td class="ui-state-default" colspan="2"></td></tr>
							<tr>
          						<td class="NoiseFooterTD" width="15%"><?php if($campnomb["plantacodigo"] == 1)echo "*"; ?>&nbsp;Ubicaci&oacute;n</td>
          						<td class="NoiseDataTD" width="85%"><select name="plantacodigo" id="plantacodigo" onChange="cargarSistemas(this.value); setEquCompleteSource();" <?php if($equipotexto){ echo "disabled"; } ?>>
          							<option value = "">-- Seleccione --</option>
									<?php
							 			if(!$flagnuevosoliserv)
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
            							<select name="equipocodigo" id="equipocodigo" onChange="accionLoadTransCont(this.value); LoadDetalleequipo(this.value,'<?php echo $GLOBALS['usuaplanta']; ?>');">
											<option value = "">-- Seleccione --</option>
		            						<?php
												include ('../src/FunGen/floadequipoot.php');
												floadequipoot($equipocodigo, $sistemcodigo,$idcon);
				    						?>
										</select>
            						</div>
            						<div id="filtrolist" style="display: <?php if($filterindex): ?>block;<?php else: ?>none;<?php endif; ?>">
            							<input type="text" size="122" name="equiponombre" id="equiponombre" value="<?php if($flagnuevosoliserv) echo $equiponombre ?>">
            							<input type="hidden" name="equipocodigocmbx" id="equipocodigocmbx" value="<?php if($flagnuevosoliserv) echo $equipocodigocmbx ?>">
            							<input type="hidden" name="idusua" id="idusua" value="<?php echo $usuacodi ?>">
            							<input type="hidden" name="filterindex" id="filterindex" value="<?php echo $filterindex ?>">
            						</div>
            						<script type="text/javascript">
	            						$("#equiponombre").autocomplete({
	            							source: "../src/FunjQuery/jquery.phpcombobox/jquery.cmbx_equipo.php?id=" + document.getElementById('idusua').value + "&plantacodigo=" + document.getElementById('plantacodigo').value + "&sistemcodigo="  + document.getElementById('sistemcodigo').value,
	            							minLength: 1,
	            							select: function(event, ui) {
	            								ui.item ? document.getElementById('equipocodigocmbx').value = ui.item.id : document.getElementById('equipocodigocmbx').value = "";
	            								LoadDetalleequipo(ui.item.id,'<?php echo $GLOBALS['usuaplanta']; ?>')
	            							}
	            						});
            						</script>
		  						</td>
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
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
							<tr>
								<td width="15%" class="NoiseFooterTD"><?php if($campnomb["tiptracodigo"] == 1){$tiptracodigo = null; echo "*";}?>&nbsp;Tipo trabajo</td>
								<td width="85%" class="NoiseDataTD"><select name="tiptracodigo">
									<option value="">-- Seleccione --</option>
									<?php
							 			if(!$flagnuevosoliserv)
			  								unset($tiptracodigo);
									
										include ('../src/FunGen/floadtipotrab.php');
										floadtipotrab($tiptracodigo,$idcon, $usuatipotrab);
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
								<td width="15%" class="NoiseFooterTD"><?php if($campnomb["tipfalcodigo"] == 1){$tipfalcodigo = null; echo "*";}?>&nbsp;Tipo falla</td>
								<td width="85%" class="NoiseDataTD"><select name="tipfalcodigo">
									<option value="">-- Seleccione --</option>
									<?php
							 			if(!$flagnuevosoliserv)
			  								unset($tipfalcodigo);
									
										include ('../src/FunGen/floadtipofall.php');
										floadtipofall($tipfalcodigo,$idcon);
									?>
								</select></td>
							</tr>
							<tr><td class="ui-state-default" colspan="2"></td></tr>
							<tr><td colspan="2" class="NoiseFooterTD"><?php if($campnomb["solsermotivo"] == 1){$solsermotivo = null; echo "*";} ?>&nbsp;Motivo</td></tr>
							<tr><td colspan="2" class="NoiseDataTD"><textarea name="solsermotivo" cols="86" rows="2" wrap="VIRTUAL"><?php if(!$flagnuevosoliserv){echo $sbreg["solsermotivo"];}else{ echo $solsermotivo;}?></textarea></td></tr>
						</table>
					</td>
				</tr>
    			<tr><td>&nbsp;</td></tr>
				<tr>
					<td class="NoiseErrorDataTD" align="center"><?php include '../def/jquery.button_form.php'; ?></td>
				</tr>
				<tr><td>&nbsp;</td></tr>
			</table>
   			<input type="hidden" name="solsercodigo" value="<?php if(!$flagnuevosoliserv) echo $solsercodigo; ?>">
   			<input type="hidden" name="accionnuevosoliserv">
   			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>">
			<input type="hidden" name="sourceaction" value="nuevo"> 
   			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>">
 		</form>
 	</body>
<?php if(!$codigo){ echo " -->"; } ?>
</html>