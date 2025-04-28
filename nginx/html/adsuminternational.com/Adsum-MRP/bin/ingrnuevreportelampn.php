<?php 
ini_set('display_errors',1);
ob_start(); 
	include ( '../src/FunGen/sesion/fncvalses.php');
	include ( '../src/FunPerPriNiv/pktblcamperequipopn.php');
	include ( '../src/FunPerPriNiv/pktblpatronestruc.php');
	include ( '../src/FunPerPriNiv/pktblequipo.php');
	
	if($accionnuevoreportelampn)
		include ( 'grabareportelampn.php');
		
	$idcon = fncconn();
	
ob_end_flush(); 
?>
<html> 
	<head> 
		<title>Nuevo registro de reporte parametros de laminado</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0"> 
		<?php include('../def/jquery.library_maestro.php');?>
		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.function_comun.js"></script>
		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.reportelampn.js"></script>
		<style type="text/css">
			.ui-autocomplete-loading { background: white url('../img/ui-anim_basic_16x16.gif') right center no-repeat; }
		</style>
	</head> 
<?php if(!$codigo){ echo "<!--";} ?>
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Reporte parametros de laminado</font></p> 
			<table border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content" width="750">
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
            			<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center">
 							<tr>
								<td width="30%" class="NoiseFooterTD"><?php if($campnomb["patestcodigo"] == 1){ $patestcodigo = null; echo "*";}?>&nbsp;Patron Estructura&nbsp;</td>
								<td width="70%" class="NoiseDataTD">
									<input type="text" name="patestnombre" id="patestnombre" size="60" onkeypress="return event.keyCode!=13" value="<?php echo $patestnombre ?>"/>
		  							<input type="hidden" name="patestcodigo" id="patestcodigo" value="<?php echo $patestcodigo ?>">
		  						</td>
 							</tr>
 							<tr>
 								<td width="20%" class="NoiseFooterTD"><?php if($campnomb["equipocodigo"] == 1){ $equipocodigo = null; echo "*";}?>&nbsp;Equipo&nbsp;</td>
 								<td width="80%" class="NoiseDataTD">
 									<select name="equipocodigo" id="equipocodigo">
 									 	<option value="">--Seleccione--</option>
 									 	<?php 
 									 		include("../src/FunGen/floadequipoop.php");
 									 		floadequipoop_lmn($equipocodigo,$idcon)
 									 	?>
									</select> 									
 								</td>
 							</tr>
 							<tr><td colspan="2" class="ui-state-default">&nbsp;<small>Parametros Equipo</small></td></tr>
 							<tr>
 								<td colspan="2" class="NoiseDataTD">
 									<?php include '../src/FunjQuery/jquery.phpscripts/jquery.camperequipopn.php' ?> 
 								</td>
 							</tr>
 							<tr>
 								<td width="10%" class="NoiseFooterTD"></td>
 							</tr>
 							<tr><td colspan="2" class="NoiseErrorDataTD"></td></tr>
							<tr><td colspan="2" class="NoiseFooterTD"><?php if($campnomb["relapndescri"]	 == 1){$relapndescri = null; echo "*";}?>&nbsp;Nota</td></tr>
							<tr><td colspan="2" rowspan="2" class="NoiseDataTD"><textarea name="relapndescri" rows="3" cols="63"><?php if(!$flagnuevoreportelampn){ echo $sbreg[relapndescri];}else{ echo $relapndescri;} ?></textarea>  </td></tr>
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
			<input type="hidden" name="accionnuevoreportelampn">  
			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>">
			<input type="hidden" name="sourceaction" value="nuevo">						
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
		</form> 	
	</body> 
<?php if(!$codigo){ echo " -->"; } ?> 
</html>