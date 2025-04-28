<?php 

	ob_start();

		include ( "../src/FunGen/cargainput.php");
		include ( "../src/FunGen/sesion/fncvalses.php");
		include ( "../src/FunPerSecNiv//fncsqlrun.php");  
	
	ob_end_flush();

	if($accioneditargrupogerencial) { 
		include ( "editagrupogerencial.php"); 
	}

	if(!$flageditargrupogerencial){

		include ( "../src/FunGen/sesion/fnccarga.php");
		$sbreg = fnccarga($nombtabl,$radiobutton);
		if (!$sbreg)
			include( "../src/FunGen/fnccontfron.php");

		$grugercodigo = $sbreg["grugercodigo"];
		$grugernombre = $sbreg["grugernombre"];
		$grugerdescri = $sbreg["grugerdescri"];
		$tipmatcodigo = $sbreg["tipmatcodigo"];
			
	}

	$idcon = fncconn();
?>
<html> 
	<head> 
		<title>Editar registro de grupo gerencial</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0"> 
		<?php include("../def/jquery.library_maestro.php");?>
	</head> 
<?php if(!$codigo){ echo "<!--";} ?>
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Grupo gerencial</font></p> 
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
            			<table width="95%" border="0" cellspacing="1" cellpadding="0" align="center"> 
 							<tr>
								<td width="25%" class="NoiseFooterTD"><?php if($campnomb["grugernombre"] == 1){ $grugernombre = null; echo "*";}?>&nbsp;Nombre&nbsp;</td>
								<td width="75%" class="NoiseDataTD"><input type="text" name="grugernombre" size="30" value="<?php echo $grugernombre; ?>" /></td>
 							</tr>
 							<tr>
								<td width="25%" class="NoiseFooterTD"><?php if($campnomb["tipmatcodigo"] == 1){ $tipmatcodigo = null; echo "*";}?>&nbsp;Tipo material&nbsp;</td>
								<td width="75%" class="NoiseDataTD">
									<select name="tipmatcodigo" id="tipmatcodigo">
										<option value="">--Seleccione--</option>
										<?php
											include("../src/FunGen/floadtipomaterial.php");
											floadtipomaterial($tipmatcodigo, $idcon);
										?>	
									</select>
								</td>
 							</tr>
 							<tr>
 								<td width="10%" class="NoiseFooterTD"></td>
 							</tr>
 							<tr><td colspan="2" class="NoiseErrorDataTD"></td></tr>
							<tr><td colspan="2" class="NoiseFooterTD"><?php if($campnomb["grugerdescri"] == 1){$grugerdescri = null; echo "*";}?>&nbsp;Nota</td></tr>
							<tr><td colspan="2" rowspan="2" class="NoiseDataTD"><textarea name="grugerdescri" rows="3" cols="63"><?php echo $grugerdescri; ?></textarea></td></tr>
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
			<input type="hidden" name="accioneditargrupogerencial">
			<input type="hidden" name="sourceaction" value="editar">
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>">
			<input type="hidden" name="grugercodigo" value="<?php echo $grugercodigo; ?>">
		</form>
	</body>
<?php if(!$codigo){ echo " -->"; } ?> 
</html>