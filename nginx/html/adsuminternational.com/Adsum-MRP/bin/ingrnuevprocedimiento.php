<?php 
ob_start(); 
	include ( '../src/FunGen/sesion/fncvalses.php');
	include ( '../src/FunPerPriNiv/pktbltiposoliprog.php');
	 
	
	if($accionnuevoprocedimiento)
		include ( 'grabaprocedimiento.php');
	
ob_end_flush(); 
?>
<html> 
	<head> 
		<title>Nuevo registro de procedimiento</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0"> 
		<?php include('../def/jquery.library_maestro.php');?>
	</head> 
<?php if(!$codigo){ echo "<!--";} ?>
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">procedimiento</font></p> 
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
  				<tr><td class="ui-widget-header"><span class="style5"><font color="FFFFFF"> Ingresar nuevo registro</font></span></td></tr> 
				<tr> 
  					<td> 
            			<table width="95%" border="0" cellspacing="1" cellpadding="0" align="center">
 							<tr>
								<td width="10%" class="NoiseFooterTD"><?php if($campnomb["procednombre"] == 1){ $procednombre = null; echo "*";}?>&nbsp;Nombre&nbsp;</td>
								<td width="40%" class="NoiseDataTD"><input type="text" name="procednombre" size="30"	value="<?php if(!$flagnuevoprocedimiento){ echo $sbreg[procednombre];}else {echo $procednombre; }?>"></td>
 							</tr>
 							<tr>
								<td width="10%" class="NoiseFooterTD"><?php if($campnomb["tipsolcodigo"] == 1){ $tipsolcodigo = null; echo "*";}?>&nbsp;Tarea&nbsp;</td>
								<td width="40%" class="NoiseDataTD"><select name="tipsolcodigo" id="tipsolcodigo"> 
								<option value="">--Seleccione--</option>
								<?php 
									$idcon = fncconn();
									include "../src/FunGen/floadtiposoliprog.php";
									floadtiposoliprog($tipsolcodigo,$idcon)
								?>
								</select>
 							</tr>
 							<tr>
 								<td width="10%" class="NoiseFooterTD"></td>
 							</tr>
 							<tr><td colspan="2" class="NoiseErrorDataTD"></td></tr>
							<tr><td colspan="2" class="NoiseFooterTD"><?php if($campnomb["proceddescri"]	 == 1){$proceddescri = null; echo "*";}?>&nbsp;Nota</td></tr>
							<tr><td colspan="2" rowspan="2" class="NoiseDataTD"><textarea name="proceddescri" rows="3" cols="63"><?php if(!$flagnuevoprocedimiento){ echo $sbreg[proceddescri];}else{ echo $proceddescri;} ?></textarea>  </td></tr>
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
			<input type="hidden" name="accionnuevoprocedimiento">  
			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>">
			<input type="hidden" name="sourceaction" value="nuevo">						
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
		</form> 	
	</body> 
<?php if(!$codigo){ echo " -->"; } ?> 
</html>