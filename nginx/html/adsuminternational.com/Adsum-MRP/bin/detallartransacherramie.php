<?php 
	include('../src/FunGen/sesion/fncvalses.php'); 
	include('../src/FunPerPriNiv/pktbltipomovi.php');
	include('../src/FunPerPriNiv/pktblherramie.php');
	include('../src/FunPerPriNiv/pktblbodega.php');
	include('../src/FunPerPriNiv/pktblherramestado.php');
	include('../src/FunPerPriNiv/pktblusuario.php');
	if(!$flagdetallartransacherramie) 
	{ 
		include ( '../src/FunGen/sesion/fnccarga.php'); 
		$sbreg = fnccarga($nombtabl,$radiobutton); 
		if (!$sbreg) 
			include( '../src/FunGen/fnccontfron.php'); 
		
		$idcon = fncconn();
		$sbregtipom = loadrecordtipomovi($sbreg[tipmovcodigo],$idcon);
		$sbregbodega = loadrecordbodega($sbreg[bodegacodigo],$idcon);
		$sbregbodegatec = loadrecordusuario($sbregbodega[usuacodi],$idcon);
		$sbregusuario = loadrecordusuario($sbreg[usuacodi],$idcon);
		$rs_herramie = loadrecordherramie($sbreg[herramcodigo],$idcon);
		$sbregherestado = loadrecordherramestado($sbreg[herestcodigo],$idcon);
		fncclose($idcon);
	} 
?>
<html> 
	<head> 
		<title>Detalle registro de transaccion de herramienta</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0"> 
		<?php include('../def/jquery.library_maestro.php');?>
	</head> 
<?php if(!$codigo){ echo "<!--";} ?>
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Entrada/Salida de herramienta</font></p> 
			<table border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content" width="600">
				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr>	
  				<tr><td class="ui-widget-header"><span class="style5"><font color="FFFFFF"> Detallar registro</font></span></td></tr>
				<tr>
					<td>
       					<table width="98%" border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content">
       						<tr>
       							<td width="20%" class="NoiseFooterTD">&nbsp;C&oacute;digo</td> 
 								<td width="30%" class="NoiseDataTD">&nbsp;<?php echo $sbreg[transhercodigo]; ?></td> 
 								<td width="20%" class="NoiseFooterTD">&nbsp;Fecha</td>
 								<td width="30%" class="NoiseDataTD">&nbsp;<?php echo $sbreg[transherfecha]; ?></td>
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
       					<table width="98%" border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content">
							<tr>
	        					<td width="20%"  class="NoiseFooterTD">&nbsp;Herramienta</td>
	        					<td class="NoiseDataTD">&nbsp;<?php echo $rs_herramie[herramnombre] ?></td>
      						</tr>
      						<tr><td colspan="2" class="ui-state-default"></td></tr>
      						<tr>
      							<td colspan="2">
      								<div id="filtritem">
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
       					<table width="98%" border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content">
       						<tr> 
							 	<td width="20%" class="NoiseFooterTD">&nbsp;Estado</td> 
							 	<td width="30%" class="NoiseDataTD"><?php echo $sbregherestado[herestnombre] ?></td> 
							 	<td width="20%" class="NoiseFooterTD">&nbsp;Cantidad</td>
							 	<td width="30%" class="NoiseDataTD">&nbsp;<?php echo $sbreg[transhercanti]; ?></td>
							</tr>
       						<tr> 
							 	<td width="20%" class="NoiseFooterTD">&nbsp;Total</td> 
							 	<td colspan="3" class="NoiseDataTD"><?php echo $sbreg[transhertotal] ?></td> 
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
			<input type="hidden" name="acciondetallartransacherramie">
			<input type="hidden" name="flagdetallartransacherramie" >
			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>">
			<input type="hidden" name="sourceaction" value="detallar">
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>">
		</form> 
	</body> 
<?php if(!$codigo){ echo " -->"; } ?> 
</html>