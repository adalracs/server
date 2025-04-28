<?php 
	include ( '../src/FunGen/sesion/fncvalses.php');
	include ( '../src/FunPerPriNiv/pktblusuario.php');
	include ( '../src/FunPerPriNiv/pktblproveedo.php');
	include ( '../src/FunPerPriNiv/pktblestadoanalisis.php');
	include ( '../src/FunPerPriNiv/pktblitemdesa.php');
	include ( '../src/FunPerPriNiv/pktbltipoitemdesa.php');
	include ( '../src/FunPerPriNiv/pktblanalisismp.php');
?>
<html> 
	<head> 
		<title>Consultar registro de recepcion de analisis de materias primas</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0"> 
		<?php include('../def/jquery.library_maestro.php');?>
		<script type='text/javascript'>
			$(function(){
			$("#analisfecha").datepicker({changeMonth:true,changeYear:true});
			$("#analisfecha").datepicker('option',{dateFormat:'yy-mm-dd'});
			$("#analisfecha").datepicker($.datepicker.regional['es']);
			<?php if($flagconsultaranalisismp && $analisfecha): ?>$('#analisfecha').datepicker('setDate':'<?php echo $analisfecha ?>');<?php endif; ?>

			});
		</script>
	</head> 
<?php if(!$codigo){ echo "<!--";} ?>
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Analisis de materias primas</font></p> 
			<table border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content" width="550">
				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr>	
  				<tr><td class="ui-widget-header"><span class="style5"><font color="FFFFFF"> Consultar registro</font></span></td></tr> 
				<tr> 
  					<td> 
            			<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center"> 
            				<tr>
								<td class="NoiseFooterTD"><?php if($campnomb["analiscodigo"] == 1){ $analiscodigo = null; echo "*";}?>&nbsp;C&oacute;digo</td>
								<td colspan="3" class="NoiseDataTD"><input type="text" name="analiscodigo" size="20" value="<?php echo $analiscodigo; ?>"></td> 
 							</tr>
 							  <tr>
     							<td class="NoiseFooterTD"><?php if($campnomb["tipitemcodigo"] == 1): $tipitemcodigo = null; ?><span style="color:black;">*</span><?php endif; ?>&nbsp;Inspeccion</td>
     							<td class="NoiseDataTD"><select name="tipitemcodigo">
     								<option value = "">-- Seleccione --</option>
	     							<?php
										if(!$flagconsultarhistorialamp)
											unset($tipitemcodigo);
											
										include ('../src/FunGen/floadtipoitemdesa.php');
										$idcon = fncconn();
										floadtipoitemdesa($tipitemcodigo,$idcon);
										fncclose($idcon);
									?>
    							</select></td>
							</tr>
 							<tr>
								<td class="NoiseFooterTD"><?php if($campnomb["lotecodigo"] == 1){ $lotecodigo = null; echo "*";}?>&nbsp;Lote</td>
								<td colspan="3" class="NoiseDataTD"><input type="text" name="lotecodigo" size="20"	value="<?php echo $lotecodigo; ?>"></td> 
 							</tr>
      						<tr>
     							<td class="NoiseFooterTD"><?php if($campnomb["estanacodigo"] == 1): $estanacodigo = null; ?><span style="color:black;">*</span><?php endif; ?>&nbsp;Estado</td>
     							<td class="NoiseDataTD"><select name="estanacodigo">
     								<option value = "">-- Seleccione --</option>
	     							<?php
										if(!$flagconsultarhistorialamp)
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
 			<input type="hidden" name="flagconsultaranalisismp" value="1"> 
			<input type="hidden" name="accionconsultaranalisismp"> 
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>">
			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>">
			<input type="hidden" name="sourceaction" value="consultar">
			<input type="hidden" name="columnas" value="analiscodigo,proveecodigo,analisnolote,itedescodigo,usuacodi,analisfecha,estanacodigo,analisdescri">
			<input type="hidden" name="nombtabl" value="analisismp"> 
		</form>
	</body>
<?php if(!$codigo){ echo " -->"; } ?> 
</html>