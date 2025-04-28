<?php 
ob_start(); 
	include ( '../src/FunGen/sesion/fncvalses.php'); 
	include('../src/FunPerPriNiv/pktblzona.php');
	
	if($accionnuevosubzona)
		include ( 'grabasubzona.php');
ob_end_flush(); 
?>
<html> 
	<head> 
		<title>Nuevo registro de sub zona</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0"> 
		<?php include('../def/jquery.library_maestro.php');?>
	</head> 
<?php if(!$codigo){ echo "<!--";} ?>
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Sub Zona</font></p> 
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
 								<td width="22%" class="NoiseFooterTD"><?php if($campnomb["subzonnombre"] == 1){$subzonnombre = null; echo "*";}?>&nbsp;subzon</td> 
 								<td width="78%" class="NoiseDataTD"><input type="text" name="subzonnombre" id="subzonnombre"  size="50" value="<?php if(!$flagnuevosubzona){echo $sbreg[subzonnombre];}else{ echo $subzonnombre; }?>"></td> 
 							</tr> 
							<tr>
     							<td class="NoiseFooterTD"><?php if($campnomb["zonacodigo"] == 1){ $zonacodigo = null; echo "*";} ?>&nbsp;Zona</td>
     							<td class="NoiseDataTD"><select name="zonacodigo" id="zonacodigo">
     								<option value = "">-- Seleccione --</option>
	     							<?php
										if(!$flagnuevosubzona)
											unset($zonacodigo);
										
										include ('../src/FunGen/floadzona.php');
										$idcon = fncconn();
										floadzona($idcon, $zonacodigo);
										fncclose($idcon);
									?>
    							</select></td>
							</tr>   
 							<tr><td colspan="2" class="NoiseFooterTD"><?php if($campnomb["subzondescri"] == 1){ $subzondescri=null; echo "*";} ?>&nbsp;Descripci&oacute;n</td></tr>
  							<tr><td colspan="2" class="NoiseFooterTD"><textarea name="subzondescri" id="subzondescri" rows="3" cols="50" wrap="VIRTUAL"><?php if(!$flagnuevosubzona){echo $sbreg[subzondescri];}else {echo $subzondescri;}?></textarea></td></tr>
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
			<input type="hidden" name="subzoncodigo" value="<?php if(!$flagnuevosubzona){ echo $sbreg[subzoncodigo];}else{ echo $subzoncodigo; } ?>"> 
			<input type="hidden" name="accionnuevosubzona">
			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>">
			<input type="hidden" name="sourceaction" value="nuevo"> 	
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
		</form> 
	</body> 
<?php if(!$codigo){ echo " -->"; } ?> 
</html>