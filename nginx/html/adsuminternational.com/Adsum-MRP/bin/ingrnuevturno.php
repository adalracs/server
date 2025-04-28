<?php 
ob_start(); 
	include ( '../src/FunGen/sesion/fncvalses.php'); 
	
	if($accionnuevoturno)
		include ( 'grabaturno.php'); 
ob_end_flush(); 
?>
<html> 
	<head> 
		<title>Nuevo registro de turno</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0"> 
		<?php include('../def/jquery.library_maestro.php');?>
	</head> 
<?php if(!$codigo){ echo "<!--";} ?>
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Turno</font></p> 
			<table width="450" border="0" align="center" cellpadding="1" cellspacing="1" class="ui-widget-content">
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
				<tr><td class="ui-widget-header"><span class="style5"><font color="FFFFFF">Ingresar nuevo registro</font></span></td></tr>
				<tr> 
  					<td> 
            			<table width="95%" border="0" cellspacing="1" cellpadding="0" align="center"> 
							<tr> 
 								<td width="22%" class="NoiseFooterTD"><?php if($campnomb["turnonombre"] == 1){$turnonombre = null; echo "*";}?>&nbsp;Turno</td> 
 								<td width="78%" class="NoiseDataTD"><input type="text" name="turnonombre" id="turnonombre"  size="50" value="<?php if(!$flagnuevoturno){echo $sbreg[turnonombre];}else{ echo $turnonombre; }?>"></td> 
 							</tr> 
 							<tr> 
 								<td width="22%" class="NoiseFooterTD"><?php if($campnomb["turnoacroni"] == 1){$turnoacroni = null; echo "*";}?>&nbsp;Acr&oacute;nimo</td> 
 								<td width="78%" class="NoiseDataTD"><input type="text" name="turnoacroni" id="turnoacroni"  size="10" value="<?php if(!$flagnuevoturno){echo $sbreg[turnoacroni];}else{ echo $turnoacroni; }?>"></td> 
 							</tr> 
							<tr><td class="ui-state-default" colspan="2"></td></tr>
							<tr>
     							<td class="NoiseFooterTD" colspan="2"><?php if($campnomb["turnohorini"] == 1 || $campnomb["turnohorfin"] == 1){ echo "*";} ?>&nbsp;
									De&nbsp;<select name="turnohorini" id="turnohorini">
										<!--<option value = "">-- --</option>-->
										<?php
											if(!$flagnuevoturno)
												unset($turnohorini);
											include ('../src/FunGen/floadhoraturno.php');
											floadhoraturno($turnohorini);
										?>
									</select>
									&nbsp;a&nbsp;<select name="turnohorfin" id="turnohorfin">
										<!--<option value = "">-- --</option>-->
										<?php
											if(!$flagnuevoturno)
												unset($turnohorfin);
											floadhoraturno($turnohorfin);
										?>
									</select>
								</td>
							</tr>
						</table> 
  					</td> 
 				</tr> 
 				<tr><td>&nbsp;</td></tr>
				<tr>
					<td class="NoiseErrorDataTD" align="center"><?php include '../def/jquery.button_form.php'; ?></td>
				</tr>
				<tr><td>&nbsp;</td></tr> 
 				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr>
			</table> 
			<input type="hidden" name="turnocodigo" value="<?php if(!$flagnuevoturno){ echo $sbreg[turnocodigo];}else{ echo $turnocodigo; } ?>"> 
			<input type="hidden" name="accionnuevoturno">
			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>">
			<input type="hidden" name="sourceaction" value="nuevo"> 	
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
		</form> 
	</body> 
<?php if(!$codigo){ echo " -->"; } ?> 
</html>