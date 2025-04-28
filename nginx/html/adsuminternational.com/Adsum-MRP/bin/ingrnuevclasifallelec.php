<?php 
ob_start(); 
	include ( '../src/FunGen/sesion/fncvalses.php'); 
	include ( '../src/FunGen/fncformat.php'); 
	
	if($accionnuevoclasifallelec)
		include ( 'grabaclasifallelec.php'); 
ob_end_flush(); 
?>
<html> 
	<head> 
		<title>Nuevo registro de clasificacion fallas electricas</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0"> 
		<?php include('../def/jquery.library_maestro.php');?>
	</head> 
<?php if(!$codigo){ echo "<!--";} ?>
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Clasificaci&oacute;n de fallas el&eacute;ctricas</font></p> 
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
            			<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content"> 
							<tr> 
 								<td width="20%" class="NoiseFooterTD"><?php if($campnomb["cfalelnombre"] == 1){$cfalelnombre = null; echo "*";}?>&nbsp;Nombre</td> 
 								<td width="80%" class="NoiseDataTD"><input type="text" name="cfalelnombre" id="cfalelnombre"  size="50" value="<?php if(!$flagnuevoclasifallelec){echo $sbreg[cfalelnombre];}else{ echo $cfalelnombre; }?>"></td> 
 							</tr> 
							<tr>
     							<td class="NoiseFooterTD"><?php if($campnomb["cfalelhcolor"] == 1){ $cfalelhcolor = null; echo "*";} ?>&nbsp;Color</td>
     							<td class="NoiseDataTD"><select name="cfalelhcolor" id="cfalelhcolor">
     								<option value = "">-- Seleccione --</option>
     								<option value = "40FF00" style="background-color: #40FF00; ">- Verde -</option>
     								<option value = "FFFF00" style="background-color: #FFFF00;">- Amarillo -</option>
     								<option value = "FFBF00" style="background-color: #FFBF00;">- Naranja -</option>
     								<option value = "FF0000" style="background-color: #FF0000;">- Rojo -</option>
    							</select></td>
							</tr>   
 							<tr><td colspan="2" class="NoiseFooterTD"><?php if($campnomb["cfaleldescri"] == 1){ $cfaleldescri=null; echo "*";} ?>&nbsp;Descripci&oacute;n</td></tr>
  							<tr><td colspan="2" class="NoiseFooterTD"><textarea name="cfaleldescri" id="cfaleldescri" rows="3" cols="50" wrap="VIRTUAL"><?php if(!$flagnuevoclasifallelec){echo $sbreg[cfaleldescri];}else {echo $cfaleldescri;}?></textarea></td></tr>
						</table> 
  					</td> 
 				</tr> 
				<tr> 
  					<td> 
            			<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content"> 
							<tr> 
 								<td width="10%" class="NoiseFooterTD">*&nbsp;&Delta;1</td> 
 								<td width="40%" class="NoiseDataTD">
 									<input type="text" class="autoPorccent" name="ranfelvalini1" id="ranfelvalini1" style="font-size: 11px;" size="8" value="<?php if(!$flagnuevoclasifallelec){echo fmtCurrency($rangofallelec[1][ranfelvalini],2);}else{ echo fmtCurrency($ranfelvalini1, 2); }?>">&nbsp;-&nbsp;
 									<input type="text" class="autoPorccent" name="ranfelvalfin1" id="ranfelvalfin1" style="font-size: 11px;" size="8" value="<?php if(!$flagnuevoclasifallelec){echo fmtCurrency($rangofallelec[1][ranfelvalfin],2);}else{ echo fmtCurrency($ranfelvalfin1,2); }?>">
 								</td> 
 								<td width="10%" class="NoiseFooterTD">*&nbsp;&Delta;2</td> 
 								<td width="40%" class="NoiseDataTD">
 									<input type="text" class="autoPorccent" name="ranfelvalini2" id="ranfelvalini2" style="font-size: 11px;" size="8" value="<?php if(!$flagnuevoclasifallelec){echo fmtCurrency($rangofallelec[2][ranfelvalini],2);}else{ echo fmtCurrency($ranfelvalini2, 2); }?>">&nbsp;-&nbsp;
 									<input type="text" class="autoPorccent" name="ranfelvalfin2" id="ranfelvalfin2" style="font-size: 11px;" size="8" value="<?php if(!$flagnuevoclasifallelec){echo fmtCurrency($rangofallelec[2][ranfelvalfin],2);}else{ echo fmtCurrency($ranfelvalfin2,2); }?>">
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
			<input type="hidden" name="cfalelcodigo" value="<?php if(!$flagnuevoclasifallelec){ echo $sbreg[cfalelcodigo];}else{ echo $cfalelcodigo; } ?>"> 
			<input type="hidden" name="accionnuevoclasifallelec">
			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>">
			<input type="hidden" name="sourceaction" value="nuevo"> 	
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
		</form> 
	</body> 
<?php if(!$codigo){ echo " -->"; } ?> 
</html>