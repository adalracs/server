<?php 
	include('../src/FunGen/sesion/fncvalses.php'); 
	include('../src/FunPerPriNiv/pktbltipomovi.php');
	include('../src/FunPerPriNiv/pktblherramie.php');
	include('../src/FunPerPriNiv/pktblbodega.php');
	include('../src/FunPerPriNiv/pktblherramestado.php');
	
	if($herramcodigo):
		$idcon = fncconn();
		$rs_herramie = loadrecordherramie($herramcodigo, $idcon);
	endif;
?>
<html> 
	<head> 
		<title>Consultar registro de transaccion de herramienta</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0"> 
		<?php include('../def/jquery.library_maestro.php');?>
		
		<script type="text/javascript">
			$(function(){
				$("#transherfecha").datepicker({changeMonth: true,changeYear: true});
				$("#transherfecha").datepicker('option', {dateFormat: 'yy-mm-dd'});
				$("#transherfecha").datepicker($.datepicker.regional['es']);
				<?php if($transherfecha): ?>$("#transherfecha").datepicker("setDate", '<?php echo $transherfecha ?>');<?php endif; ?>
			});
		</script>
		
	</head> 
<?php if(!$codigo){ echo "<!--";} ?>
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Entrada/Salida de herramienta</font></p> 
			<table border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content" width="600">
				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr>	
  				<tr><td class="ui-widget-header"><span class="style5"><font color="FFFFFF"> Consultar registro</font></span></td></tr>
				<tr>
					<td>
       					<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
       						 <tr>
            					<td width="20%" class="NoiseFooterTD">&nbsp;C&oacute;digo</td> 
								<td width="30%" class="NoiseDataTD"><input name="transhercodigo" type="text"	value="<?php echo $transhercodigo; ?>" size="10"></td>
								<td width="20%" class="NoiseFooterTD">&nbsp;Fecha</td>
								<td width="30%" class="NoiseDataTD"><input type="text" name="transherfecha" id="transherfecha" size="8" value="<?php echo $transherfecha; ?>"></td>
							</tr>
							<tr><td colspan="4" class="ui-state-default"></td></tr>
 							<tr>
								<td width="20%" class="NoiseFooterTD">&nbsp;Tipo de movimiento</td>
								<td colspan="3" class="NoiseDataTD"><select name="tipmovcodigo">
									<option value="">-- Seleccione --</option>
									<?php
										include ('../src/FunGen/floadtipomovi.php');
										$idcon = fncconn();
										floadtipomovisel($tipmovcodigo, $idcon);
									?>
								</select></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>
       					<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
							<tr>
	        					<td width="20%"  class="NoiseFooterTD">&nbsp;Herramienta</td>
	        					<td class="NoiseDataTD">
	        						<input type="hidden" name="herramcodigo" id="herramcodigo" value="<?php echo $herramcodigo; ?>">
	        						<input type="text" name="herramnombre" id="herramnombre" value="<?php echo $herramnombre; ?>" size="50" >
	        					</td>
      						</tr>
      						<tr><td colspan="2" class="ui-state-default"></td></tr>
      						<tr>
      							<td colspan="2">
      								<div id="filtrherramie">
	       								<table width="100%" border="0" cellspacing="0" cellpadding="1" align="center">
										    <tr>
										    	<td width="50%" class="ui-state-default">&nbsp;Disponible&nbsp;&nbsp;<?php echo $rs_herramie['herramdispon'] ?></td>
										    	<td width="50%" class="ui-state-default">&nbsp;Valor&nbsp;&nbsp;<?php echo $rs_herramie['herramvalor'] ?></td>
											</tr>
										</table>
									</div>
								</td>
      						</tr>
      					</table>
					</td>
				</tr>
				<tr><td></td></tr>
				<tr>
					<td>
       					<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
       						<tr> 
							 	<td width="20%" class="NoiseFooterTD">&nbsp;Estado</td> 
							 	<td width="30%" class="NoiseDataTD"><select name="herestcodigo">
							    <option value="">-- Seleccione --</option>
									<?php
										include ('../src/FunGen/floadherramestado.php');
										floadherramestadosel($herestcodigo, $idcon);
										fncclose($idcon);
								?>
								</select></td> 
							 	<td width="20%" class="NoiseFooterTD">&nbsp;Cantidad</td>
							 	<td width="30%" class="NoiseDataTD"><input name="transhercanti" type="text"	value="<?php echo $transhercanti; ?>" size="10"></span></td>
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
			<input type="hidden" name="flagconsultartransacherramie" value="1">			
			<input type="hidden" name="accionconsultartransacherramie">
			<input type="hidden" name="columnas" value="transhercodigo,tipmovcodigo,herramcodigo,transherfecha,transhercanti,transhertotal,usuacodigo"> 
			<input type="hidden" name="nombtabl" value="transacherramie">
			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>">
			<input type="hidden" name="sourceaction" value="consultar">
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>">
		</form> 
	</body> 
<?php if(!$codigo){ echo " -->"; } ?> 
</html>