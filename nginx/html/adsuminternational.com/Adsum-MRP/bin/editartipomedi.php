<?php 
ob_start();
	include ( '../src/FunGen/sesion/fncvalses.php');
	include ( '../src/FunPerPriNiv/pktblusuario.php');
	include ( '../src/FunGen/cargainput.php');
	
	if($accioneditartipomedi) 
	{ 
		include ( 'editatipomedi.php'); 
		$flageditartipomedi = 1;
	}
ob_end_flush();
	if(!$flageditartipomedi)
	{
		include ( '../src/FunGen/sesion/fnccarga.php');
		$sbreg = fnccarga($nombtabl,$radiobutton);
		if (!$sbreg)
			include( '../src/FunGen/fnccontfron.php');
			
		$tipmedtiempo = $sbreg[tipmedtiempo];

	
	}
?>
<html> 
	<head> 
		<title>Editar registro de tipo de medidor</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0"> 
		<?php include('../def/jquery.library_maestro.php');?>
	</head> 
<?php if(!$codigo){ echo "<!--";} ?>
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">tipo de medidor</font></p> 
			<table border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content" width="450">
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
            			<table width="95%" border="0" cellspacing="1" cellpadding="0" align="center"> 
 							<tr>
								<td width="20%" class="NoiseFooterTD"><?php if($campnomb["tipmednombre"] == 1){ $tipmednombre = null; echo "*";}?>&nbsp;Nombre&nbsp;</td>
								<td width="80" class="NoiseDataTD" colspan="2"><input type="text" name="tipmednombre" size="30"	value="<?php if(!$flageditartipomedi){ echo $sbreg[tipmednombre];}else {echo $tipmednombre; }?>"></td>
 							</tr>
 							<tr>
								<td width="20%" class="NoiseFooterTD"><?php if($campnomb["tipmedacra"] == 1){ $tipmedacra = null; echo "*";}?>&nbsp;Acr&oacute;nimo&nbsp;</td>
								<td width="80%" class="NoiseDataTD" colspan="2"><input type="text" name="tipmedacra" size="10"	value="<?php if(!$flageditartipomedi){ echo $sbreg[tipmedacra];}else {echo $tipmedacra; }?>"></td>
 							</tr>
 							<tr>
      							<td width="20%" class="NoiseFooterTD"><?php if($campnomb["tipmedtiempo"] == 1){$tipmeddescri = null;echo "*";}?>Tiempo Medidor</td>
      							<td width="80%" class="NoiseErrorDataTD"><select name="tipmedtiempo">
        							<option value="">Seleccione</option>
        							<option value="1" <?php if($tipmedtiempo == 1) echo 'selected'; ?>>Minuto(s)</option>
        							<option value="2" <?php if($tipmedtiempo == 2) echo 'selected'; ?>>Hora(s)</option>
        							<option value="3" <?php if($tipmedtiempo == 3) echo 'selected'; ?>>Dia(s)</option>
        							<option value="4" <?php if($tipmedtiempo == 4) echo 'selected'; ?>>Mes(es)</option>
          						</select></td>
      						</tr>
 							<tr><td colspan="2" class="NoiseErrorDataTD"></td></tr>
							<tr><td colspan="2" class="NoiseFooterTD"><?php if($campnomb["tipmeddescri"]	 == 1){$tipmeddescri = null; echo "*";}?>&nbsp;Nota</td></tr>
							<tr><td colspan="2" rowspan="2" class="NoiseDataTD"><textarea name="tipmeddescri" rows="3" cols="63"><?php if(!$flageditartipomedi){ echo $sbreg[tipmeddescri];}else{ echo $tipmeddescri;} ?></textarea>  </td></tr>
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
			<input type="hidden" name="accioneditartipomedi">
			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>">
			<input type="hidden" name="tipmedcodigo" value="<?php if(!$flageditartipomedi){echo $sbreg[tipmedcodigo];}else{echo $tipmedcodigo;}?>">
			<input type="hidden" name="sourceaction" value="editar">
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
		</form>
	</body>
<?php if(!$codigo){ echo " -->"; } ?> 
</html>