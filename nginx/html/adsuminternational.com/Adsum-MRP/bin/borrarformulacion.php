<?php 	
	include ( '../src/FunGen/sesion/fncvalses.php');
	include ( '../src/FunPerPriNiv/pktblitemformul.php');
	include ( '../src/FunPerPriNiv/pktblitemdesa.php');
	include ( '../src/FunPerPriNiv/pktblusuario.php');
	include ('../src/FunGen/cargainput.php');
	
	if(!$flagborrarformul)
	{ 
		include ( '../src/FunGen/sesion/fnccarga.php'); 
		$sbreg = fnccarga($nombtabl,$radiobutton); 
	
		if (!$sbreg)
			include( '../src/FunGen/fnccontfron.php'); 
			
		$idcon = fncconn();
		$fecha = $sbreg[formulfecha];
		$rsItemformul = dinamicscanitemformul(array('formulcodigo' => $sbreg[formulcodigo]),$idcon);
		$nrItemformul = fncnumreg($rsItemformul);
		
		for($a = 0; $a < $nrItemformul; $a++):
			$rwItemformul = fncfetch($rsItemformul, $a);
			
			$rwItemdesa = loadrecorditemdesa($rwItemformul['itedescodigo'],$idcon);
			
			($arrformulacion) ? $arrformulacion .= ':|:'.$rwItemformul['itedescodigo'].':-:'.$rwItemformul['iteforcapa'].':-:'.$rwItemformul['iteforporcen'].':-:'.$rwItemdesa['itedesslip'].':-:'.$rwItemdesa['itedesantibl'].':-:'.$rwItemdesa['itedescosto'] : $arrformulacion = $rwItemformul['itedescodigo'].':-:'.$rwItemformul['iteforcapa'].':-:'.$rwItemformul['iteforporcen'].':-:'.$rwItemdesa['itedesslip'].':-:'.$rwItemdesa['itedesantibl'].':-:'.$rwItemdesa['itedescosto'];  
		
		endfor;
		
		$nombre = cargausuanombre($sbreg[usuacodi],$idcon);
	} 
?>
<html> 
	<head> 
		<title>Borrar de registro de formulacion</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0"> 
		<?php include('../def/jquery.library_maestro.php');?>
		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.function_comun.js"></script>
		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.desarrollo.js"></script>
	</head> 
<?php if(!$codigo){ echo "<!--";} ?> 
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Formulaci&oacute;n</font></p> 
			<table border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content" width="470">
  				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr> 
  				<tr><td class="ui-widget-header"><span class="style5"><font color="FFFFFF"> Borrar registro</font></span></td></tr> 
				<tr> 
  					<td> 
            			<table width="95%" border="0" cellspacing="1" cellpadding="1" align="center"> 
							<tr> 
 								<td class="NoiseFooterTD">&nbsp;C&oacute;digo</td> 
  								<td class="NoiseDataTD"><?php echo $sbreg[formulnumero]; ?></td> 
  								<td class="NoiseFooterTD">&nbsp;Fecha</td> 
  								<td class="NoiseDataTD"><?php echo $sbreg[formulfecha]; ?></td>
  								<td class="NoiseFooterTD">&nbsp;<b>Resposable</b></td>
  								<td class="NoiseDataTD" colspan="4">&nbsp;<?php echo $nombre ?></td>   
 							</tr> 
 							<tr> 
 								<td width="15%" class="NoiseFooterTD">&nbsp;Capa A</td> 
  								<td width="10%"  class="NoiseDataTD"><input type="hidden" name="formulcapaa" id="formulcapaa" value="<?php echo $sbreg[formulcapaa]?>" /><?php echo $sbreg[formulcapaa]; ?> <b>%</b></td> 
  								<td width="10%" class="NoiseFooterTD">&nbsp;Formulado &nbsp;</td>
								<td width="10%" class="NoiseDataTD">&nbsp;<span id="capaa">0.0</span>&nbsp;<b>%</b></td>
								<td width="5%" class="NoiseFooterTD">&nbsp;Slip &nbsp;</td>
								<td width="10%" class="NoiseDataTD">&nbsp;<span id="slip_capaa">0.0</span></td>
								<td width="10%" class="NoiseFooterTD">&nbsp;Antiblock &nbsp;</td>
								<td width="10%" class="NoiseDataTD">&nbsp;<span id="antiblock_capaa">0.0</span></td>
								<td width="10%" class="NoiseDataTD">&nbsp;</td>
 							</tr> 
 							<tr> 
 								<td width="15%" class="NoiseFooterTD">&nbsp;Capa B</td> 
  								<td width="10%" class="NoiseDataTD"><input type="hidden" name="formulcapab" id="formulcapab" value="<?php echo $sbreg[formulcapab] ?>"/><?php echo $sbreg[formulcapab]; ?> <b>%</b></td>
  								<td width="10%" class="NoiseFooterTD">&nbsp;Formulado  &nbsp;</td>
								<td width="10%" class="NoiseDataTD">&nbsp;<span id="capab">0.0</span>&nbsp;<b>%</b></td>
								<td width="5%" class="NoiseFooterTD">&nbsp;Slip &nbsp;</td>
								<td width="10%" class="NoiseDataTD">&nbsp;<span id="slip_capab">0.0</span></td>
								<td width="10%" class="NoiseFooterTD">&nbsp;Antiblock &nbsp;</td>
								<td width="10%" class="NoiseDataTD">&nbsp;<span id="antiblock_capab">0.0</span></td>
								<td width="10%" class="NoiseDataTD">&nbsp;</td> 
 							</tr> 
 							<tr>
 								<td width="15%" class="NoiseFooterTD">&nbsp;Capa C</td> 
  								<td width="10%" class="NoiseDataTD"><input type="hidden" name="formulcapac" id="formulcapac" value="<?php echo $sbreg[formulcapac] ?>" /><?php echo $sbreg[formulcapac]; ?> <b>%</b></td> 
  								<td width="10%" class="NoiseFooterTD">&nbsp;Formulado  &nbsp;</td>
								<td width="10%" class="NoiseDataTD">&nbsp;<span id="capac">0.0</span>&nbsp;<b>%</b></td>
								<td width="5%" class="NoiseFooterTD">&nbsp;Slip &nbsp;</td>
								<td width="10%" class="NoiseDataTD">&nbsp;<span id="slip_capac">0.0</span></td>
								<td width="10%" class="NoiseFooterTD">&nbsp;Antiblock &nbsp;</td>
								<td width="10%" class="NoiseDataTD">&nbsp;<span id="antiblock_capac">0.0</span></td>
								<td width="10%" class="NoiseDataTD">&nbsp;</td>
 							</tr> 
 							<tr>
								<td colspan="1" class="NoiseDataTD">&nbsp;Costo</td>
								<td colspan="3" class="NoiseDataTD"><span id="costo">0.0</span>&nbsp;<b>COP</b></td>
								<td colspan="1" class="NoiseDataTD">&nbsp;<b>Total</b></td>
								<td colspan="1" class="NoiseDataTD">&nbsp;<span id="slip">0.0</span></td>
								<td colspan="1" class="NoiseDataTD">&nbsp;<b>Total</b></td>
								<td colspan="1" class="NoiseDataTD">&nbsp;<span id="antiblock">0.0</span></td>
								<td width="10%" class="NoiseDataTD">&nbsp;</td>
							</tr>
 							<tr> 
  								<td colspan="9"> 
            						<table width="95%" border="0" cellspacing="1" cellpadding="0" align="center"> 
 										<tr>
 											<td>
												<div id="filtrlistaformulacion">
												<?php
													$noAjax = true;
													$fladetallar = 1;
													include '../src/FunjQuery/jquery.visors/jquery.formulacion.php';  
												?>
												</div>
 											</td>
 										</tr>
									</table> 
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
 			<input type="hidden" name="flagborrarformul" value="1">
 			<input type="hidden" name="formulcodigo1" value="<?php if(!$flagborrarformul){ echo $sbreg[formulcodigo];}else{ echo $formulcodigo1; } ?>">
			<input type="hidden" name="accionborrarformulacion">
			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>">
			<input type="hidden" name="sourceaction" value="borrar"> 			
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>">
			<input type="hidden" name="columnas" value="formulnumero, formulfecha">
			<input type="hidden" name="formulnumero" value="<?php  if($accionconsultarformul) echo $formulnumero; ?>">  
 			<input type="hidden" name="accionconsultarformul" value="<?php  echo $accionconsultarformul; ?>">
		</form>
		<script type="text/javascript">validaPorcentaje();</script> 
	</body> 
<?php if(!$codigo){ echo " -->"; } ?> 
</html>