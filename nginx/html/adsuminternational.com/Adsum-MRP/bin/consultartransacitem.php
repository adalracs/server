<?php 
	include ( '../src/FunGen/sesion/fncvalses.php'); 
	include('../src/FunPerPriNiv/pktbltipomovi.php');
	include('../src/FunPerPriNiv/pktblitem.php');
	include('../src/FunPerPriNiv/pktblunimedida.php'); 
	include('../src/FunPerPriNiv/pktblbodega.php'); 
	include('../src/FunPerPriNiv/pktblitemestado.php');
	
	if($itemcodigo):
		$idcon = fncconn();
		$rs_item = loadrecorditem($itemcodigo, $idcon);
	endif;
?>
<html> 
	<head> 
		<title>Consultar registro de transaccion de item</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0"> 
		<?php include('../def/jquery.library_maestro.php');?>
		
		<script type="text/javascript">
			$(function(){
				$("#transitefecha").datepicker({changeMonth: true,changeYear: true});
				$("#transitefecha").datepicker('option', {dateFormat: 'yy-mm-dd'});
				$("#transitefecha").datepicker($.datepicker.regional['es']);
				<?php if($transitefecha): ?>$("#transitefecha").datepicker("setDate", '<?php echo $transitefecha ?>');<?php endif; ?>
			});
		</script>
		
	</head> 
<?php if(!$codigo){ echo "<!--";} ?>
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Entrada/Salida de item</font></p> 
			<table border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content" width="600">
				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr>	
  				<tr><td class="ui-widget-header"><span class="style5"><font color="FFFFFF"> Consultar registro</font></span></td></tr>
				<tr>
					<td>
       					<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
       						 <tr>
            					<td width="20%" class="NoiseFooterTD">&nbsp;C&oacute;digo</td> 
								<td width="30%" class="NoiseDataTD"><input name="transitecodigo" type="text"	value="<?php echo $transitecodigo; ?>" size="10"></td>
								<td width="20%" class="NoiseFooterTD">&nbsp;Fecha</td>
								<td width="30%" class="NoiseDataTD"><input type="text" name="transitefecha" id="transitefecha" size="8" value="<?php echo $transitefecha; ?>"></td>
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
	        					<td width="20%"  class="NoiseFooterTD">&nbsp;Item</td>
	        					<td class="NoiseDataTD">
	        						<input type="hidden" name="itemcodigo" id="itemcodigo" value="<?php echo $itemcodigo; ?>">
	        						<input type="text" name="itemnombre" id="itemnombre" value="<?php echo $itemnombre; ?>" size="65" >
	        					</td>
      						</tr>
      						<tr><td colspan="2" class="ui-state-default"></td></tr>
      						<tr>
      							<td colspan="2">
      								<div id="filtritem">
	       								<table width="100%" border="0" cellspacing="0" cellpadding="1" align="center">
	      									<tr>
												<td width="25%" class="ui-state-default">&nbsp;Cant. M&iacute;nima&nbsp;&nbsp;<?php  echo $rs_item[itemcanmin]; ?></td>
												<td width="25%" class="ui-state-default">&nbsp;Cant. M&aacute;xima&nbsp;&nbsp;<?php  echo $rs_item[itemcanmax]; ?></td>
												<td width="25%" class="ui-state-default">&nbsp;Disponible&nbsp;&nbsp;<?php  echo $rs_item[itemdispon]; ?></td>
												<td width="25%" class="ui-state-default">Valor $&nbsp;&nbsp;<?php echo $rs_item[itemvalor]; ?></td>
											</tr>
										</table>
									</div>
								</td>
      						</tr>
      					</table>
					</td>
				</tr>
				<tr>
					<td>
       					<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
       						<tr> 
							 	<td width="20%" class="NoiseFooterTD">&nbsp;Estado</td> 
							 	<td width="30%" class="NoiseDataTD"><select name="herestcodigo">
							    <option value="">-- Seleccione --</option>
									<?php
										include ('../src/FunGen/floaditemestado.php');
										floaditemestadosel($itestacodigo, $idcon);
										fncclose($idcon);
									?>
								</select></td> 
							 	<td width="20%" class="NoiseFooterTD">&nbsp;Cantidad</td>
							 	<td width="30%" class="NoiseDataTD"><input name="transitecantid" type="text"	value="<?php echo $transitecantid; ?>" size="10"></span></td>
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
			<input type="hidden" name="flagconsultartransacitem" value="1">			
			<input type="hidden" name="accionconsultartransacitem">
			<input type="hidden" name="columnas" value="transitecodigo,tipmovcodigo,itemcodigo,transitefecha,transitecantid,transitetotal,usuacodigo,bodegacodigo,pedidocodigo,itestacodigo"> 
			<input type="hidden" name="nombtabl" value="transacitem">
			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>">
			<input type="hidden" name="sourceaction" value="consultar">
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>">
		</form> 
	</body> 
<?php if(!$codigo){ echo " -->"; } ?> 
</html>