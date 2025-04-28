<?php 
ob_start(); 
	include ( '../src/FunGen/sesion/fncvalses.php'); 
	include ( '../src/FunPerPriNiv/pktbldepartam.php'); 
	
	if($accionnuevoareafuncio)
		include ( 'grabaareafuncio.php'); 
ob_end_flush(); 
?>
<html> 
	<head> 
		<title>Nuevo registro de Area Funcional</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0"> 
		<?php include('../def/jquery.library_maestro.php');?>
	</head> 
<?php if(!$codigo){ echo "<!--";} ?>
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">&Aacute;rea Funcional</font></p> 
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
 								<td width="22%" class="NoiseFooterTD"><?php if($campnomb["arefunnombre"] == 1){$arefunnombre = null; echo "*";}?>&nbsp;&Aacute;rea</td> 
 								<td width="78%" class="NoiseDataTD"><input type="text" name="arefunnombre" id="arefunnombre"  size="50" value="<?php if(!$flagnuevoareafuncio){echo $sbreg[arefunnombre];}else{ echo $arefunnombre; }?>"></td> 
 							</tr> 
							<tr>
     							<td class="NoiseFooterTD"><?php if($campnomb["departcodigo"] == 1){ $departcodigo = null; echo "*";} ?>&nbsp;Departamento</td>
     							<td class="NoiseDataTD"><select name="departcodigo" id="departcodigo">
									<option value = "">-- Seleccione --</option>
									<?php
										if(!$flagnuevoareafuncio)
											unset($departcodigo);
										
										$idcon = fncconn();
										include ('../src/FunGen/floaddepartam.php');
										floaddepartamnegocio($departcodigo,$negocicodigo, $idcon);
									?>
								</select></td>
							</tr>
							<tr><td class="ui-state-default" colspan="2"></td></tr>							
 							<tr><td colspan="2" class="NoiseFooterTD"><?php if($campnomb["arefundescri"] == 1){ $arefundescri=null; echo "*";} ?>&nbsp;Descripci&oacute;n</td></tr>
  							<tr><td colspan="2" class="NoiseFooterTD"><textarea name="arefundescri" id="arefundescri" rows="3" cols="50" wrap="VIRTUAL"><?php if(!$flagnuevoareafuncio){echo $sbreg[arefundescri];}else {echo $arefundescri;}?></textarea></td></tr>
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
			<input type="hidden" name="arefuncodigo" value="<?php if(!$flagnuevoareafuncio){ echo $sbreg[arefuncodigo];}else{ echo $arefuncodigo; } ?>"> 
			<input type="hidden" name="accionnuevoareafuncio">
			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>">
			<input type="hidden" name="sourceaction" value="nuevo"> 	
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
		</form> 
	</body> 
<?php if(!$codigo){ echo " -->"; } ?> 
</html>