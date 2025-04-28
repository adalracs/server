<?php 
	include ( '../src/FunGen/sesion/fncvalses.php'); 
	include('../src/FunPerPriNiv/pktbltipomovi.php');
	include('../src/FunPerPriNiv/pktblitem.php');
	include('../src/FunPerPriNiv/pktblunimedida.php');
	include('../src/FunPerPriNiv/pktblusuario.php');
	include('../src/FunPerPriNiv/pktblitemestado.php');
	include('../src/FunPerPriNiv/pktblbodega.php');
	
	if(!$flagdetallartransacitem) 
	{ 
		include ( '../src/FunGen/sesion/fnccarga.php'); 
		$sbreg = fnccarga($nombtabl,$radiobutton); 
		if (!$sbreg) 
			include( '../src/FunGen/fnccontfron.php');

		$idcon = fncconn();
		
		$sbregbodega = loadrecordbodega($sbreg[bodegacodigo],$idcon);
		$sbregbodegatec = loadrecordusuario($sbregbodega[usuacodi],$idcon);
		$sbregusuario = loadrecordusuario($sbreg[usuacodi],$idcon);
		$sbregtipom = loadrecordtipomovi($sbreg[tipmovcodigo],$idcon);
		$rs_item = loadrecorditem($sbreg[itemcodigo],$idcon);
		$sbregitemestado = loadrecorditemestado($sbreg[itestacodigo],$idcon);
		
		fncclose($idcon);
	} 

?>
<html> 
	<head> 
		<title>Detalle registro de transaccion de item</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0"> 
		<?php include('../def/jquery.library_maestro.php');?>
	</head> 
<?php if(!$codigo){ echo "<!--";} ?>
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Entrada/Salida de item</font></p> 
			<table border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content" width="600">
				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr>	
  				<tr><td class="ui-widget-header"><span class="style5"><font color="FFFFFF"> Detallar registro</font></span></td></tr>
				<tr>
					<td>
       					<table width="98%" border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content">
       						<tr>
       							<td width="20%" class="NoiseFooterTD">&nbsp;C&oacute;digo</td> 
 								<td width="30%" class="NoiseDataTD">&nbsp;<?php echo $sbreg[transitecodigo]; ?></td> 
 								<td width="20%" class="NoiseFooterTD">&nbsp;Fecha</td>
 								<td width="30%" class="NoiseDataTD">&nbsp;<?php echo $sbreg[transitefecha]; ?></td>
 							</tr>
 							<tr>
								<td class="NoiseFooterTD">&nbsp;Usuario</td>
								<td colspan="3" class="NoiseDataTD">&nbsp;<?php echo $sbregusuario[usuanombre]." ".$sbregusuario[usuapriape]." ".$sbregusuario[usuasegape]; ?></td>
							</tr>
 							<tr>
								<td class="NoiseFooterTD">&nbsp;Tipo de movimiento</td>
								<td colspan="3" class="NoiseDataTD">&nbsp;<?php echo $sbregtipom[tipmovnombre] ?></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>
       					<table width="98%" border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content">
							<?php if($sbregbodega['bodegatipo'] == 1): ?>
       						<tr>
       							<td width="20%" class="NoiseFooterTD">&nbsp;Bodega</td> 
 								<td width="80%" class="NoiseDataTD">&nbsp;<?php echo $sbregbodega[bodeganombre]; ?></td> 
 							</tr>
 							<?php else: ?>
 							<tr><td colspan="2" class="ui-state-default">&nbsp;<?php echo $sbregbodega[bodeganombre]; ?></td></tr>
 							<tr>
								<td width="20%" class="NoiseFooterTD">&nbsp;T&eacute;nico</td>
								<td width="80%" class="NoiseDataTD">&nbsp;<?php echo $sbregbodegatec[usuacodi].' - '.$sbregbodegatec['usuanombre'].' '.$sbregbodegatec['usuapriape'].' '.$sbregbodegatec['usuasegape'] ?></td>
							</tr>
							<?php endif; ?>
						</table>
					</td>
				</tr>
				<tr>
					<td>
       					<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
							<tr>
	        					<td width="20%"  class="NoiseFooterTD">&nbsp;Item</td>
	        					<td class="NoiseDataTD">&nbsp;<?php echo $rs_item[itemnombre] ?></td>
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
       					<table width="98%" border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content">
       						<tr> 
							 	<td width="20%" class="NoiseFooterTD">&nbsp;Estado</td> 
							 	<td width="30%" class="NoiseDataTD"><?php echo $sbregitemestado[itestanombre] ?></td> 
							 	<td width="20%" class="NoiseFooterTD">&nbsp;Cantidad</td>
							 	<td width="30%" class="NoiseDataTD">&nbsp;<?php echo $sbreg[transitecantid]; ?>&nbsp;<span id="acronimo"><?php echo $rs_unidad[unidadacra]; ?></span></td>
							</tr>
       						<tr> 
							 	<td width="20%" class="NoiseFooterTD">&nbsp;Total</td> 
							 	<td colspan="3" class="NoiseDataTD"><?php echo $sbreg[transitetotal] ?></td> 
							</tr>
      					</table>
					</td>
				</tr>
				<tr><td>&nbsp;</td></tr>
				<tr>
					<td class="NoiseErrorDataTD" align="center"><?php include '../def/jquery.button_formdetall.php'; ?></td>
				</tr>
				<tr><td>&nbsp;</td></tr>
				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr>
			</table>
			<input type="hidden" name="transitecodigo" value="<?php echo $sbreg[transitecodigo]; ?>">
			<input type="hidden" name="acciondetallartransacitem">
			<input type="hidden" name="flagdetallartransacitem" >
			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>">
			<input type="hidden" name="sourceaction" value="detallar">
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>">
		</form> 
	</body> 
<?php if(!$codigo){ echo " -->"; } ?> 
</html>