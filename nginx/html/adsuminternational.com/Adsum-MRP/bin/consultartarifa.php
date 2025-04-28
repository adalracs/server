<?php 	

	include ( "../src/FunPerPriNiv/pktbltiposoliprog.php"); 
	include ( "../src/FunPerPriNiv/pktblcentcost.php"); 
	include_once ( '../src/FunGen/sesion/fncvalses.php');
	include_once ('../src/FunPerSecNiv/fncconn.php');
	include_once ('../src/FunPerSecNiv/fncclose.php');
	include_once ('../src/FunPerSecNiv/fncsqlrun.php');
	include_once ('../src/FunPerSecNiv/fncfetch.php');
	include_once ('../src/FunPerSecNiv/fncnumreg.php');	

	$idcon = fncconn();
	$meses = array(
"ENERO",
"FEBRERO",
"MARZO",
"ABRIL",
"MAYO",
"JUNIO",
"JULIO",
"AGOSTO",
"SEPTIEMBRE",
"OCTRUBRE",
"NOVEIMBRE",
"DICIEMBRE",
);
?>
<html> 
	<head> 
		<title>Consultar cuenta</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0"> 
		<?php include('../def/jquery.library_maestro.php');?>
	</head> 
<?php if(!$codigo){ echo "<!--";} ?>
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Cuenta</font></p> 
			<table border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content" width="550">
				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr>	
  				<tr><td class="ui-widget-header"><span class="style5"><font color="FFFFFF"> Consultar registro</font></span></td></tr> 
				<tr> 
  					<td> 
             			<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center"> 
            				 <tr>
								<td width="35%" class="NoiseFooterTD"><?php if($campnomb["cencoscodigo"] == 1){ $cencoscodigo = null; echo "*";}?>&nbsp;Centro de costo&nbsp;</td>
								<td colspan="3" width="55%" class="NoiseDataTD">
									<select name="cencoscodigo_c" id="cencoscodigo">
										<option value="">--Seleccione--</option>
										<?php
											include("../src/FunGen/floadcentcost.php");
											floadcentcost($cencoscodigo,$idcon);
										?>
									</select>
								</td>
 							</tr>
 							<tr>
								<td width="35%" class="NoiseFooterTD"><?php if($campnomb["tipsolcodigo"] == 1){ $tipsolcodigo = null; echo "*";}?>&nbsp;Proceso&nbsp;</td>
								<td colspan="3" width="55%" class="NoiseDataTD">
									<select name="tipsolcodigo_c" id="tipsolcodigo">
										<option value="">--Seleccione--</option>
										<?php
											include("../src/FunGen/floadtiposoliprog.php");
											floadtiposoliprog($tipsolcodigo,$idcon);
										?>
									</select>
								</td>
 							</tr>
            				<tr>
								<td width="10%" class="NoiseFooterTD"><?php if($campnomb["tarifames"] == 1){ $tarifames = null; echo "*";}?>&nbsp;Mes&nbsp;</td>
								<td width="10%" class="NoiseDataTD">
									<select name="tarifames_c" id="tarifames">
										<option value="">--Seleccione--</option>
										<?php for ($i=0; $i < 12 ; $i++) { ?>
											<option value="<?php echo (($i>9)?$i+1:"0".($i+1)); ?>"><?php echo $meses[$i]; ?></option>
										<?php } ?>
									</select>
								</td>
								<td width="10%" class="NoiseFooterTD"><?php if($campnomb["tarifaano"] == 1){ $tarifaano = null; echo "*";}?>&nbsp;Año&nbsp;</td>
								<td width="10%" class="NoiseDataTD">
									<select name="tarifaano_c" id="tarifaano">
										<option value="">--Seleccione--</option>
										<?php for ($i=2012; $i < 3000 ; $i++) { ?>
											<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
										<?php } ?>
									</select>
								</td>
 							</tr>
 							<tr>
								<td width="35%" class="NoiseFooterTD"><?php if($campnomb["tarifamod"] == 1){ $tarifamod = null; echo "*";}?>&nbsp;Mano de obra directa&nbsp;</td>
								<td colspan="3" width="55%" class="NoiseDataTD"><input type="text" name="tarifamod_c" size="20" value="<?php echo $tarifamod; ?>" /></td>
 							</tr>
 							<tr>
								<td width="35%" class="NoiseFooterTD"><?php if($campnomb["tarifamoi"] == 1){ $tarifamoi = null; echo "*";}?>&nbsp;Mano de obra indirecta&nbsp;</td>
								<td colspan="3" width="55%" class="NoiseDataTD"><input type="text" name="tarifamoi_c" size="20" value="<?php echo $tarifamoi; ?>" /></td>
 							</tr>
 							<tr>
								<td width="35%" class="NoiseFooterTD"><?php if($campnomb["tarifacdep"] == 1){ $tarifacdep = null; echo "*";}?>&nbsp;Cif con depresiacion&nbsp;</td>
								<td colspan="3" width="55%" class="NoiseDataTD"><input type="text" name="tarifacdep_c" size="20" value="<?php echo $tarifacdep; ?>" /></td>
 							</tr>
 							  				<tr>
								<td width="35%" class="NoiseFooterTD"><?php if($campnomb["tarifasdep"] == 1){ $tarifasdep = null; echo "*";}?>&nbsp;Cif sin depresiacion&nbsp;</td>
								<td colspan="3" width="55%" class="NoiseDataTD"><input type="text" name="tarifasdep_c" size="20" value="<?php echo $tarifasdep; ?>" /></td>
 							</tr>
 							<tr>
								<td width="35%" class="NoiseFooterTD"><?php if($campnomb["tarifaene"] == 1){ $tarifaene = null; echo "*";}?>&nbsp;Energia&nbsp;</td>
								<td colspan="3" width="55%" class="NoiseDataTD"><input type="text" name="tarifaene_c" size="20" value="<?php echo $tarifaene; ?>" /></td>
 							</tr>
 							<tr>
								<td width="35%" class="NoiseFooterTD"><?php if($campnomb["tarifaman"] == 1){ $tarifaman = null; echo "*";}?>&nbsp;Mantenimiento&nbsp;</td>
								<td colspan="3" width="55%" class="NoiseDataTD"><input type="text" name="tarifaman_c" size="20" value="<?php echo $tarifaman; ?>" /></td>
 							</tr>
 							<tr>
								<td width="35%" class="NoiseFooterTD"><?php if($campnomb["tarifaotros"] == 1){ $tarifaotros = null; echo "*";}?>&nbsp;Otros&nbsp;</td>
								<td colspan="3" width="55%" class="NoiseDataTD"><input type="text" name="tarifaotros_c" size="20" value="<?php echo $tarifaotros; ?>" /></td>
 							</tr>
 							<tr>
 								<td width="10%" class="NoiseFooterTD"></td>
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
 			<input type="hidden" name="flagconsultartarifa" value="1"> 
			<input type="hidden" name="accionconsultartarifa"> 
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>">
			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>">
			<input type="hidden" name="sourceaction" value="consultar">
			<input type="hidden" name="columnas" value="tarifacodigo,cencoscodigo,tipsolcodigo,tarifames,tarifaano,tarifamod,tarifamoi,tarifacdep,tarifasdep,tarifaman,tarifaotros"> 
			<input type="hidden" name="nombtabl" value="tarifa"> 
		</form>
	</body>
<?php if(!$codigo){ echo " -->"; } ?> 
</html>