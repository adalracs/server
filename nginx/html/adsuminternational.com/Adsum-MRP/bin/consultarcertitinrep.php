<?php 
	include ( '../src/FunGen/sesion/fncvalses.php');
	include_once ('../src/FunPerSecNiv/fncconn.php');
	include_once ('../src/FunPerSecNiv/fncclose.php');
	include_once ('../src/FunPerSecNiv/fncsqlrun.php');
	include_once ('../src/FunPerSecNiv/fncfetch.php');
	include_once ('../src/FunPerSecNiv/fncnumreg.php');

?>
<html> 
	<head> 
		<title>Consultar registro de informe tinta/reproceso</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0"> 
		<?php include('../def/jquery.library_maestro.php');?>
		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.function_comun.js"></script>
		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.dispensing.js"></script>
		<script type="text/javascript">
		$(function(){
			$("#certirfecha").datepicker({
				showOn: 'both',
				buttonImageOnly : 'true',
				changeYear : 'true',
				numberOfMonths : 1,
				dateFormat : 'yy-mm-dd'
				});
		});
		</script>
	</head> 
<?php if(!$codigo){ echo "<!--";} ?>
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Informe tinta/reproceso</font></p> 
			<table border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content" width="550">
				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr>	
  				<tr><td class="ui-widget-header"><span class="style5"><font color="FFFFFF"> Consultar registro</font></span></td></tr> 
				<tr> 
  					<td> 
            			<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center"> 
							<tr>
								<td width="17%" class="NoiseFooterTD"><?php if($campnomb["formulcodigo"] == 1){ $formulcodigo = null; echo "*";}?>&nbsp;Formula &nbsp;</td>
								<td width="83%" class="NoiseDataTD"><input type="hidden" name="formulcodigo" id="formulcodigo" value="<?php echo $formulcodigo ?>" /><input type="text" name="formulnumero" id="formulnumero" value="<?php echo $formulnumero ?>" /></td>
							</tr>
							<tr>
								<td width="17%" class="NoiseFooterTD"><?php if($campnomb["certirlote"] == 1){ $certirlote = null; echo "*";}?>&nbsp;Lote &nbsp;</td>
								<td width="83%" class="NoiseDataTD"><input type="text" name="certirlote" id="certirlote" value="<?php echo $certirlote ?>" size="10" /></td>
							</tr>
							<tr>
								<td width="17%" class="NoiseFooterTD"><?php if($campnomb["certirfecha"] == 1){ $certirfecha = null; echo "*";}?>&nbsp;Fecha&nbsp;</td>
								<td width="83%" class="NoiseDataTD"><input type="text" name="certirfecha" id="certirfecha" value="<?php echo $certirfecha ?>" onclick="this.blur();"/></td> 
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
 			<input type="hidden" name="flagconsultarcertitinrep" value="1"> 
			<input type="hidden" name="accionconsultarcertitinrep"> 
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>">
			<input type="hidden" name="sourcetable" value="certitinrep">
			<input type="hidden" name="sourceaction" value="consultar">
			<input type="hidden" name="columnas" value="formulcodigo, certirlote, certirfecha">
			<input type="hidden" name="nombtabl" value="certitinrep"> 
		</form>
	</body>
<?php if(!$codigo){ echo " -->"; } ?> 
</html>