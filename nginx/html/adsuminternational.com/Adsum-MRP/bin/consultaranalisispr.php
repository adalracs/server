<?php 
	include ( '../src/FunGen/sesion/fncvalses.php');
	include ( '../src/FunPerPriNiv/pktblusuario.php');
	include ( '../src/FunPerPriNiv/pktbltiposoliprog.php');
	include ( '../src/FunPerPriNiv/pktblestadoanalisis.php');
	include ( '../src/FunPerPriNiv/pktblopp.php');
	include ( '../src/FunPerPriNiv/pktblanalisispr.php');
?>
<html> 
	<head> 
		<title>Consultar registro de recepcion de analisis de producto en proceso</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0"> 
		<?php include('../def/jquery.library_maestro.php');?>
		<script type='text/javascript'>
			$(function(){
			$("#analisfecha").datepicker({changeMonth:true,changeYear:true});
			$("#analisfecha").datepicker('option',{dateFormat:'yy-mm-dd'});
			$("#analisfecha").datepicker($.datepicker.regional['es']);
			<?php if($flagconsultaranalisispr && $analisfecha): ?>$('#analisfecha').datepicker('setDate':'<?php echo $analisfecha ?>');<?php endif; ?>

			});
		</script>
	</head> 
<?php if(!$codigo){ echo "<!--";} ?>
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Analisis de producto en proceso</font></p> 
			<table border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content" width="550">
				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr>	
  				<tr><td class="ui-widget-header"><span class="style5"><font color="FFFFFF"> Consultar registro</font></span></td></tr> 
				<tr> 
  					<td> 
            			<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center"> 
            				<tr>
								<td class="NoiseFooterTD"><?php if($campnomb["analiscodigo"] == 1){ $analiscodigo = null; echo "*";}?>&nbsp;C&oacute;digo</td>
								<td colspan="3" class="NoiseDataTD"><input type="text" name="analiscodigo" size="20" value="<?php if(!$flagconsultaranalisispr){ echo $sbreg[analiscodigo];}else {echo $analiscodigo; }?>"></td> 
 							</tr>
 							<tr>
								<td class="NoiseFooterTD"><?php if($campnomb["ordoppcodigo"] == 1){ $ordoppcodigo = null; echo "*";}?>&nbsp;OPP</td>
								<td colspan="3" class="NoiseDataTD"><input type="text" name="ordoppcodigo" size="20" value="<?php if(!$flagconsultaranalisispr){ echo $sbreg[ordoppcodigo];}else {echo $ordoppcodigo; }?>"></td> 
 							</tr>
      						<tr>
     							<td class="NoiseFooterTD"><?php if($campnomb["estanacodigo"] == 1): $estanacodigo = null; ?><span style="color:black;">*</span><?php endif; ?>&nbsp;Estado</td>
     							<td class="NoiseDataTD"><select name="estanacodigo">
     								<option value = "">-- Seleccione --</option>
	     							<?php
										if(!$flagconsultaranalisispr)
											unset($estanacodigo);
											
										include ('../src/FunGen/floadestadoanalisis.php');
										$idcon = fncconn();
										floadestadoanalisis($estanacodigo,$idcon);
										fncclose($idcon);
									?>
    							</select></td>
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
 			<input type="hidden" name="flagconsultaranalisispr" value="1"> 
			<input type="hidden" name="accionconsultaranalisispr"> 
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>">
			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>">
			<input type="hidden" name="sourceaction" value="consultar">
			<input type="hidden" name="columnas" value="analiscodigo,ordoppcodigo,usuacodi,analisfecha,estanacodigo,analisdescri">
			<input type="hidden" name="nombtabl" value="analisispr"> 
		</form>
	</body>
<?php if(!$codigo){ echo " -->"; } ?> 
</html>