<?php 
	ini_set('display_errors',1);
	include ( '../src/FunGen/sesion/fncvalses.php');
?>
<html> 
	<head> 
		<title>Consultar registro de requisicion</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0"> 
		<?php include('../def/jquery.library_maestro.php');?>
		<script type="text/javascript">
			$(function(){
				//ObjDatepicker
				$("#requisfecha").datepicker({changeMonth: true,changeYear: true});
				$("#requisfecha").datepicker('option', {dateFormat: 'yy-mm-dd'});
				$("#requisfecha").datepicker($.datepicker.regional['es']);
				
		 });
		</script>
	</head> 
<?php if(!$codigo){ echo "<!--";} ?>
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Requisicion</font></p> 
			<table border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content" width="550">
				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr>	
  				<tr><td class="ui-widget-header"><span class="style5"><font color="FFFFFF"> Consultar registro</font></span></td></tr> 
				<tr> 
  					<td> 
            			<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center"> 
							<tr>
								<td width="17%" class="NoiseFooterTD">&nbsp;C&oacute;digo</td>
								<td width="83%" class="NoiseDataTD"><input type="text" name="requiscodigo" size="30"	value="<?php echo $requiscodigo; ?>"></td> 
 							</tr>
							<tr>
								<td width="17%" class="NoiseFooterTD">&nbsp;Fecha</td>
								<td width="83%" class="NoiseDataTD"><input type="text" name="requisfecha" id="requisfecha" size="30"	value="<?php echo $requisfecha; ?>"></td> 
 							</tr>
							<tr>
								<td width="17%" class="NoiseFooterTD">&nbsp;RI Numero</td>
								<td width="83%" class="NoiseDataTD"><input type="text" name="requisnumero" size="30"	value="<?php echo $requisnumero; ?>"></td> 
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
 			<input type="hidden" name="flagconsultarhistoequisicion" value="1"> 
			<input type="hidden" name="accionconsultarhistorequisicion"> 
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>">
			<input type="hidden" name="sourcetable" value="historequisicion">
			<input type="hidden" name="sourceaction" value="consultar">
			<input type="hidden" name="columnas" value="requiscodigo, requisfecha,requisnumero">
			<input type="hidden" name="nombtabl" value="requisicion"> 
		</form>
	</body>
<?php if(!$codigo){ echo " -->"; } ?> 
</html>