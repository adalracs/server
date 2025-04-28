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
			
			($arrformula) ? $arrformula .= ':|:'.$rwItemformul['itedescodigo'].':-:'.$rwItemformul['iteforcapa'].':-:'.$rwItemformul['iteforporcen'].':-:'.$rwItemdesa['itedesslip'].':-:'.$rwItemdesa['itedesantibl'].':-:'.$rwItemdesa['itedescosto'] : $arrformula = $rwItemformul['itedescodigo'].':-:'.$rwItemformul['iteforcapa'].':-:'.$rwItemformul['iteforporcen'].':-:'.$rwItemdesa['itedesslip'].':-:'.$rwItemdesa['itedesantibl'].':-:'.$rwItemdesa['itedescosto'];  
		
		endfor;
		
		$nombre = cargausuanombre($sbreg[usuacodi],$idcon);
	} 
?>
<html> 
	<head> 
		<title>Borrar de registro de formula</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0"> 
		<?php include('../def/jquery.library_maestro.php');?>
		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.function_comun.js"></script>
		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.desarrollo.js"></script>
	</head> 
<?php if(!$codigo){ echo "<!--";} ?> 
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Formula</font></p> 
			<table border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content" width="470">
  				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr> 
  				<tr><td class="ui-widget-header"><span class="style5"><font color="FFFFFF"> Borrar registro</font></span></td></tr> 
				<tr> 
  					<td> 
            			<table width="95%" border="0" cellspacing="1" cellpadding="1" align="center"> 
							<tr>
								<td width="25%" class="NoiseFooterTD">&nbsp;Codigo (Formula)&nbsp;</td>
								<td width="75%" class="NoiseDataTD">&nbsp;<?php echo $sbreg[formulnumero]; ?></td>
							</tr>
							<tr>
								<td width="25%" class="NoiseFooterTD">&nbsp;Nombre&nbsp;</td>
								<td width="75%" class="NoiseDataTD">&nbsp;<?php echo $sbreg[formulnombre]; ?></td>
							</tr>
							<tr>
								<td width="25%" class="NoiseFooterTD">&nbsp;Serie&nbsp;</td>
								<td width="75%" class="NoiseDataTD">&nbsp;<?php echo $sbreg[formulserie]; ?></td>
							</tr>
							<tr>
								<td width="25%" class="NoiseFooterTD">&nbsp;Precio&nbsp; <b>COP</b></td>
								<td width="75%" class="NoiseDataTD">&nbsp;<?php echo $sbreg[formulprecio]; ?></td>
							</tr>
							<tr>
								<td width="25%" class="NoiseFooterTD">&nbsp;Solido <b>%</b>&nbsp;</td>
								<td width="75%" class="NoiseDataTD">&nbsp;<?php echo $sbreg[formulsolido]; ?></td>
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
			<input type="hidden" name="accionborrarformula">
			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>">
			<input type="hidden" name="sourceaction" value="borrar"> 			
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>">
			<input type="hidden" name="columnas" value="formulnumero">
			<input type="hidden" name="formulnumero" value="<?php  if($accionconsultarformul) echo $formulnumero; ?>">  
 			<input type="hidden" name="accionconsultarformul" value="<?php  echo $accionconsultarformul; ?>">
		</form>
		<script type="text/javascript">validaPorcentaje();</script> 
	</body> 
<?php if(!$codigo){ echo " -->"; } ?> 
</html>