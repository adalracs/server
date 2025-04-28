<?php 
ob_start(); 
	include ( '../src/FunGen/sesion/fncvalses.php');
	include ( '../src/FunPerPriNiv/pktblpadreitem.php');    
	if($accionnuevopatronestruc)
		include ( 'grabapatronestruc.php');
	
ob_end_flush(); 
?>
<html> 
	<head> 
		<title>Nuevo registro de patron estructura</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0"> 
		<?php include('../def/jquery.library_maestro.php');?>
		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.function_comun.js"></script>
		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.patronestruc.js"></script>
		<style type="text/css">
			.ui-autocomplete-loading { background: white url('../img/ui-anim_basic_16x16.gif') right center no-repeat; }
		</style>
	</head> 
<?php if(!$codigo){ echo "<!--";} ?>
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">patron estructura</font></p> 
			<table border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content" width="450">
<?php if($campnomb): ?>
				<tr><td><div class="ui-widget">
					<div class="ui-state-error ui-corner-all" style="padding: 0 .7em;"> 
						<p><span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span> 
						<strong>Advertencia:</strong> Corrija los campos marcados con * <br><?php echo $campnomb[err] ?></p>
					</div>
				</div></td></tr>
<?php else: ?> 		
				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr>	
<?php endif; ?> 
  				<tr><td class="ui-widget-header"><span class="style5"><font color="FFFFFF"> Ingresar nuevo registro</font></span></td></tr> 
				<tr> 
  					<td> 
            			<table width="95%" border="0" cellspacing="1" cellpadding="0" align="center"> 
 							<tr>
								<td width="25%" class="NoiseFooterTD"><?php if($campnomb["patestnombre"] == 1){ $patestnombre = null; echo "*";}?>&nbsp;Nombre&nbsp;</td>
								<td width="75%" class="NoiseDataTD"><input type="text" name="patestnombre" value="<?php if(!$flagnuevopatronestruc){ echo $sbreg[patestnombre];}else {echo $patestnombre; }?>" size="10" /></td>
 							</tr>
 							<tr>
								<td width="25%" class="NoiseFooterTD"><?php if($campnomb["patestanchoi"] == 1){ $patestanchoi = null; echo "*";}?>&nbsp;Ancho inicial&nbsp;<b>(mm)</b></td>
								<td width="75%" class="NoiseDataTD"><input type="text" name="patestanchoi" value="<?php if(!$flagnuevopatronestruc){ echo $sbreg[patestanchoi];}else {echo $patestanchoi; }?>" size="5" /></td>
 							</tr>
 							<tr>
								<td width="25%" class="NoiseFooterTD"><?php if($campnomb["patestanchof"] == 1){ $patestanchof = null; echo "*";}?>&nbsp;Ancho final&nbsp;<b>(mm)</b></td>
								<td width="75%" class="NoiseDataTD"><input type="text" name="patestanchof" value="<?php if(!$flagnuevopatronestruc){ echo $sbreg[patestanchof];}else {echo $patestanchof; }?>" size="5" /></td>
 							</tr>
 							<tr>
								<td width="25%" class="NoiseFooterTD"><?php if($campnomb["patestcalibi"] == 1){ $patestcalibi = null; echo "*";}?>&nbsp;Calibre inicial&nbsp;<b>(&micro;m)</b></td>
								<td width="75%" class="NoiseDataTD"><input type="text" name="patestcalibi" value="<?php if(!$flagnuevopatronestruc){ echo $sbreg[patestcalibi];}else {echo $patestcalibi; }?>" size="5" /></td>
 							</tr>
 							<tr>
								<td width="25%" class="NoiseFooterTD"><?php if($campnomb["patestcalibf"] == 1){ $patestcalibf = null; echo "*";}?>&nbsp;Calibre final&nbsp;<b>(&micro;m)</b></td>
								<td width="75%" class="NoiseDataTD"><input type="text" name="patestcalibf" value="<?php if(!$flagnuevopatronestruc){ echo $sbreg[patestcalibf];}else {echo $patestcalibf; }?>" size="5" /></td>
 							</tr>
 							<tr>
		  						<td width="25%" class="NoiseFooterTD "><?php if($campnomb["arrpatronestruc"] == 1){ $arrpatronestruc = null; echo "*";}?>&nbsp;Material</td>
		  						<td width="75%" class="NoiseDataTD" rowspan="2">
		  							<div class="ui-buttonset" align="right">
										<button id="ingresarpadreitem">Agregar</button>&nbsp;&nbsp;
		            					<button id="quitarpadreitem">Quitar</button>
									</div>
		  						</td>
		  					</tr>
							<tr>
		  						<td class="NoiseDataTD" colspan="2">
		  							<input type="text" name="material" id="material" size="60" onkeypress="return event.keyCode!=13"/>
		  							<input type="hidden" name="idmaterial" id="idmaterial">
		  						</td>
		  					</tr>
 							<tr>
 								<td colspan="2">
 									<div id="listapatronestruc">
 										<?php 
 											$noAjax = true;
 											include "../src/FunjQuery/jquery.visors/jquery.patronestruc.php";
 										?>
 									</div>
 									<input type="hidden" name="arrpatronestruc" id="arrpatronestruc" size="60"value="<?php echo $arrpatronestruc ?>" />
									<input type="hidden" name="arrpatronestructmp" id="arrpatronestructmp" size="60"value="<?php echo $arrpatronestructmp ?>" />
 								</td>
 							</tr>
 							<tr>
 								<td width="10%" class="NoiseFooterTD"></td>
 							</tr>
 							<tr><td colspan="2" class="NoiseErrorDataTD"></td></tr>
							<tr><td colspan="2" class="NoiseFooterTD"><?php if($campnomb["patestdescri"]	 == 1){$patestdescri = null; echo "*";}?>&nbsp;Nota</td></tr>
							<tr><td colspan="2" rowspan="2" class="NoiseDataTD"><textarea name="patestdescri" rows="3" cols="63"><?php if(!$flagnuevopatronestruc){ echo $sbreg[patestdescri];}else{ echo $patestdescri;} ?></textarea>  </td></tr>
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
			<input type="hidden" name="accionnuevopatronestruc">  
			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>">
			<input type="hidden" name="sourceaction" value="nuevo">						
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
		</form> 	
	</body> 
<?php if(!$codigo){ echo " -->"; } ?> 
</html>