<?php 
	
	include ( '../src/FunGen/sesion/fncvalses.php');

?>
<html> 
	<head> 
		<title>Consultar registro de item</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0"> 
		<?php include('../def/jquery.library_maestro.php');?>
	</head> 
<?php if(!$codigo){ echo "<!--";} ?>
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">tipos de item</font></p> 
			<table border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content" width="550">
				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr>	
  				<tr><td class="ui-widget-header"><span class="style5"><font color="FFFFFF"> Consultar registro</font></span></td></tr> 
				<tr> 
  					<td> 
            			<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center"> 
							<tr>
								<td width="17%" class="NoiseFooterTD">&nbsp;C&oacute;digo</td>
								<td width="83%" class="NoiseDataTD"><input type="text" name="itevencodigo" size="30"	value="<?php echo $itevencodigo; ?>"></td> 
 							</tr>
							<tr>
								<td width="17%" class="NoiseFooterTD">&nbsp;Nombre</td>
								<td width="83%" class="NoiseDataTD"><input type="text" name="itevennombre" size="30"	value="<?php echo $itevennombre; ?>"></td> 
 							</tr>
 							<tr>
								<td width="17%" class="NoiseFooterTD">&nbsp;Extruido</td>
								<td width="83%" class="NoiseDataTD">
								&nbsp;Si<input type="radio" name="itevenextru" value="si" <?php if($itevenextru == 'si'){echo 'selected';}?>/>
								&nbsp;No<input type="radio" name="itevenextru" value="no" <?php if($itevenextru == 'no'){echo 'selected';}?>/>
								</td> 
 							</tr>
 							<tr>
								<td width="17%" class="NoiseFooterTD">&nbsp;Pigmentado</td>
								<td width="83%" class="NoiseDataTD">
								&nbsp;Si<input type="radio" name="itevenpigme" value="si" <?php if($itevenpigme == 'si'){echo 'selected';}?>/>
								&nbsp;No<input type="radio" name="itevenpigme" value="no" <?php if($itevenpigme == 'no'){echo 'selected';}?>/>
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
 			<input type="hidden" name="flagconsultaritemventas" value="1"> 
			<input type="hidden" name="accionconsultaritemventas"> 
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>">
			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>">
			<input type="hidden" name="sourceaction" value="consultar">
			<input type="hidden" name="columnas" value="itevencodigo, itevennombre, itevenextru, itevenpigme">
			<input type="hidden" name="nombtabl" value="itemventas"> 
		</form>
	</body>
<?php if(!$codigo){ echo " -->"; } ?> 
</html>