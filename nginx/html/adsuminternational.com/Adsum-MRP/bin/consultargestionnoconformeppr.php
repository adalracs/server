<?php 
	include ( '../src/FunGen/sesion/fncvalses.php');
	include ( '../src/FunPerPriNiv/pktbllote.php');
	include ( '../src/FunPerPriNiv/pktbldefecto.php');
	include ( '../src/FunPerPriNiv/pktblproveedo.php');
	include ( '../src/FunPerPriNiv/pktblestadoanalisis.php');
	include ( '../src/FunPerPriNiv/pktblcausa.php');
	include ( '../src/FunPerPriNiv/pktblitemdesa.php');
	include ( '../src/FunPerPriNiv/pktbltipoitemdesa.php');
	include ( '../src/FunPerPriNiv/pktblprvaranalisis.php');
	include ( '../src/FunPerPriNiv/pktblvaranalisis.php');
?>
<html> 
	<head> 
		<title>Consultar registro de no comformes</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0"> 
		<?php include('../def/jquery.library_maestro.php');?>
	</head> 
<?php if(!$codigo){ echo "<!--";} ?>
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">No comformes</font></p> 
			<table border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content" width="550">
				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr>	
  				<tr><td class="ui-widget-header"><span class="style5"><font color="FFFFFF"> Consultar registro</font></span></td></tr> 
				<tr> 
  					<td> 
            			<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center"> 
            				<tr>
								<td class="NoiseFooterTD"><?php if($campnomb["nocomcodigo"] == 1){ $nocomcodigo = null; echo "*";}?>&nbsp;C&oacute;digo</td>
								<td colspan="3" class="NoiseDataTD"><input type="text" name="nocomcodigo" size="20" value="<?php echo $nocomcodigo; ?>"></td> 
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
 			<input type="hidden" name="flagconsultargestionnocomformeppr" value="1"> 
			<input type="hidden" name="accionconsultargestionnoconformeppr"> 
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>">
			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>">
			<input type="hidden" name="sourceaction" value="consultar">
			<input type="hidden" name="columnas" value="nocomcodigo,analiscodigo,usuacodi1,usuacodi2,nocomfecha,nocomhora,nocomdescri">
			<input type="hidden" name="nombtabl" value="vistagestionnoconformeppr"> 
		</form>
	</body>
<?php if(!$codigo){ echo " -->"; } ?> 
</html>