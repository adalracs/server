<?php 	
	
	include ( '../src/FunGen/sesion/fncvalses.php');
	include ( '../src/FunPerPriNiv/pktblusuario.php');
	include ( '../src/FunPerPriNiv/pktblformula.php');
	include ( '../src/FunPerPriNiv/pktblcertitinrepformul.php');
	include ('../src/FunGen/cargainput.php');
	include_once ('../src/FunPerPriNiv/pktblvistaitemdispe.php');
	
	if(!$flagborrarformul)
	{ 
		include ( '../src/FunGen/sesion/fnccarga.php'); 
		$sbreg = fnccarga($nombtabl,$radiobutton); 
	
		if (!$sbreg)
			include( '../src/FunGen/fnccontfron.php'); 
			
		$idcon = fncconn();
		$certirpeso = $sbreg[certirpeso];
		$nombre = cargausuanombre($sbreg[usuacodi],$idcon);
		$rsItem = loadrecordformula($sbreg[formulcodigo],$idcon);
		
		$rsCertitinrepformul = dinamicscancertitinrepformul(array('certircodigo' => $sbreg[certircodigo]),$idcon);
		$nrCertitinrepformul = fncnumreg($rsCertitinrepformul);
		
		for($a = 0; $a < $nrCertitinrepformul; $a++):
			$rwCertitinrepformul = fncfetch($rsCertitinrepformul, $a);
			
			$newrow = $rwCertitinrepformul[itedescodigo].':-:'.$rwCertitinrepformul[cerforcantid].':-:'.$rwCertitinrepformul[cerforlote];
			
			($arritemdispe)? $arritemdispe = $arritemdispe.':|:'.$newrow : $arritemdispe = $newrow ;
			
		endfor;
	} 
?>
<html> 
	<head> 
		<title>Borrar de registro de certificado calidad/tintas</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0"> 
		<?php include('../def/jquery.library_maestro.php');?>
		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.function_comun.js"></script>
		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.desarrollo.js"></script>
	</head> 
<?php if(!$codigo){ echo "<!--";} ?> 
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">certificado calidad/tintas</font></p> 
			<table border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content" width="750">
  				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr> 
  				<tr><td class="ui-widget-header"><span class="style5"><font color="FFFFFF"> Borrar registro</font></span></td></tr> 
					<tr> 
  					<td> 
            			<table width="95%" border="0" cellspacing="1" cellpadding="1" align="center"> 
            				<tr>
								<td colspan="4" class="ui-state-default" align="center"><small>R.DI.04</small></td>
							</tr>
							<tr>
								<td width="15%" class="NoiseFooterTD">&nbsp;Formula &nbsp;</td>
								<td colspan="3" class="NoiseDataTD">&nbsp;<?php echo $rsItem['formulnumero'].' - '.$rsItem['formulnombre'] ?></td>
							</tr>
							<tr>
								<td width="15%" class="NoiseFooterTD">&nbsp;Responsable &nbsp;</td>
								<td colspan="3" class="NoiseDataTD">&nbsp;<?php echo $nombre ?></td>
							</tr>
							<tr>
								<td width="15%" class="NoiseFooterTD">&nbsp;Peso <b>(kgs)</b> &nbsp;</td>
								<td width="20%" class="NoiseDataTD">&nbsp;<?php echo $sbreg[certirpeso] ?></td>
								<td width="10%" class="NoiseFooterTD">&nbsp;Lote &nbsp;</td>
								<td width="55%" class="NoiseDataTD">&nbsp;<?php echo $sbreg[certirlote] ?></td>
							</tr>
							<tr>
								<td colspan="4">
									<div id="filtrlistavistaitemdispe">
										<?php
											$noAjax = true;
											$flagdetallar = 1;
											include '../src/FunjQuery/jquery.visors/jquery.vistaitemdispe.php';  
										?>
									</div>
								</td>
							</tr>
							<tr><td colspan="4" class="NoiseErrorDataTD"></td></tr>
							<tr><td colspan="4" class="NoiseFooterTD">&nbsp;Nota</td></tr>
							<tr><td colspan="4" rowspan="2" class="NoiseDataTD">&nbsp;<?php echo $sbreg[certirdescri] ?></td></tr>
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
 			<input type="hidden" name="certircodigo1" value="<?php if(!$flagborrarformul){ echo $sbreg[certircodigo];}else{ echo $certircodigo1; } ?>">
			<input type="hidden" name="accionborrarcertitinrep">
			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>">
			<input type="hidden" name="sourceaction" value="borrar"> 			
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>">
 			<input type="hidden" name="accionconsultarformul" value="<?php  echo $accionconsultarformul; ?>">
		</form>
		<script type="text/javascript">validaPorcentaje();</script> 
	</body> 
<?php if(!$codigo){ echo " -->"; } ?> 
</html>