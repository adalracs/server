<?php 
ob_start();
	include ( '../src/FunGen/sesion/fncvalses.php');
	include ( '../src/FunPerPriNiv/pktblusuario.php');
	include ( '../src/FunGen/cargainput.php');
	
	if($accioneditaritemventas) 
	{ 
		include ( 'editaitemventas.php'); 
		$flageditaritemventas = 1;
	}
ob_end_flush();
	if(!$flageditaritemventas)
	{
		include ( '../src/FunGen/sesion/fnccarga.php');
		$sbreg = fnccarga($nombtabl,$radiobutton);
		if (!$sbreg)
			include( '../src/FunGen/fnccontfron.php');

	
	}
?>
<html> 
	<head> 
		<title>Editar registro de item</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0"> 
		<?php include('../def/jquery.library_maestro.php');?>
	</head> 
<?php if(!$codigo){ echo "<!--";} ?>
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">item</font></p> 
			<table border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content" width="700">
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
            			<table width="98%" border="0" cellspacing="1" cellpadding="1" align="center" > 
							<tr>
								<td width="25%" class="NoiseFooterTD"><?php if($campnomb["itevencodigo"] == 1){ $itevencodigo = null; echo "*";}?>&nbsp;Codigo&nbsp;</td>
								<td width="50%" class="NoiseDataTD"><?php if(!$flageditaritemventas){echo $sbreg[itevencodigo];}else{echo $itevencodigo;}?></td> 
 							</tr> 
 							<tr>
								<td width="25%" class="NoiseFooterTD"><?php if($campnomb["itevennombre"] == 1){ $itevennombre = null; echo "*";}?>&nbsp;Nombre&nbsp;</td>
								<td width="50%" class="NoiseDataTD" colspan="2"><input type="text" name="itevennombre" size="30"	value="<?php if(!$flageditaritemventas){ echo $sbreg[itevennombre];}else {echo $itevennombre; }?>"></td>
 							</tr>
 							<tr>
								<td width="25%" class="NoiseFooterTD"><?php if($campnomb["itevendensid"] == 1){ $itevendensid = null; echo "*";}?>&nbsp;Densidad&nbsp;</td>
								<td width="50%" class="NoiseDataTD"><input type="text" name="itevendensid" size="30"	value="<?php if(!$flageditaritemventas){ echo $sbreg[itevendensid];}else {echo $itevendensid; }?>"></td>
 							</tr>
 							<tr>
								<td width="25%" class="NoiseFooterTD"><?php if($campnomb["itevenextru"] == 1){ $itevenextru = null; echo "*";}?>&nbsp;Extruido&nbsp;</td>
								<td width="50%" class="NoiseDataTD"><?php $itevenextru = (!$flageditaritemventas)? $sbreg[itevenextru] : $itevenextru ;?>
								&nbsp;Si<input type="radio" name="itevenextru" value="t" <?php if($itevenextru == 't'){echo 'checked';}?>/>
								&nbsp;No<input type="radio" name="itevenextru" value="f" <?php if($itevenextru == 'f'){echo 'checked';}?> />
								</td>
							</tr>
							<tr>
								<td width="25%" class="NoiseFooterTD"><?php if($campnomb["itevenpigme"] == 1){ $itevenpigme = null; echo "*";}?>&nbsp;Pigmentado&nbsp;</td>
								<td width="50%" class="NoiseDataTD"><?php $itevenpigme = (!$flageditaritemventas)? $sbreg[itevenpigme] : $itevenpigme ;?>
								&nbsp;Si<input type="radio" name="itevenpigme" value="t" <?php if($itevenpigme == 't'){echo 'checked';}?>/>
								&nbsp;No<input type="radio" name="itevenpigme" value="f" <?php if($itevenpigme == 'f'){echo 'checked';}?> />
								</td>
 							</tr>
 							<tr><td colspan="2" class="NoiseErrorDataTD"></td></tr>
							<tr><td colspan="2" class="NoiseFooterTD"><?php if($campnomb["itevendescri"]	 == 1){$itevendescri = null; echo "*";}?>&nbsp;Nota</td></tr>
							<tr><td colspan="2" rowspan="2" class="NoiseDataTD"><textarea name="itevendescri" rows="3" cols="80"><?php if(!$flageditaritemventas){ echo $sbreg[itevendescri];}else{ echo $itevendescri;} ?></textarea>  </td></tr>																	
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
			<input type="hidden" name="accioneditaritemventas">
			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>">
			<input type="hidden" name="itevencodigo" value="<?php if(!$flageditaritemventas){echo $sbreg[itevencodigo];}else{echo $itevencodigo;}?>">
			<input type="hidden" name="sourceaction" value="editar">
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
		</form>
	</body>
<?php if(!$codigo){ echo " -->"; } ?> 
</html>