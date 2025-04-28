<?php 

	ini_set("display_errors", 1);

	include ( '../src/FunPerPriNiv/pktblreporteoppestado.php');
	include ( '../src/FunPerPriNiv/pktbltipoitemdesa.php');
	include ( '../src/FunPerPriNiv/pktblunimedida.php');
	include ( '../src/FunPerPriNiv/pktblitemdesa.php');
	include ( '../src/FunPerPriNiv/pktblbodega.php');
	include ( '../src/FunGen/sesion/fncvalses.php');
	include ( '../src/FunPerPriNiv/pktbllote.php');
	include ( '../src/FunGen/cargainput.php');	
	
	if(!$flagdetallarproveedo)
	{
		include ( '../src/FunGen/sesion/fnccarga.php');
		$sbreg = fnccarga($nombtabl,$radiobutton);
		if (!$sbreg)
			include( '../src/FunGen/fnccontfron.php');
			
		$idcon = fncconn();

		$recmercodigo = $sbreg["recmercodigo"];
		$itedescodigo = $sbreg["itedescodigo"];
		$lotecodigo = $sbreg["lotecodigo"];
		$unidadcodigo = $sbreg["unidadcodigo"];
		$recmercantidad = $sbreg["recmercantidad"];
		$recmerordcomp = $sbreg["recmerordcomp"];
		$recmernoir = $sbreg["recmernoir"];
		$recmernofact = $sbreg["recmernofact"];
		$bodegacodigo = $sbreg["bodegacodigo"];
		$recmercertificado = $sbreg["recmercertificado"];

		fncclose($idcon);
	}

	$idcon = fncconn();
?>
<html> 
	<head> 
		<title>Detalle registro de recepcion de mercancia</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0"> 
		<?php include('../def/jquery.library_maestro.php');?>
	</head> 
<?php if(!$codigo){ echo "<!--";} ?>
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Recepcion de mercancia</font></p> 
			<table border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content" width="650">
				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr>	
  				<tr><td class="ui-widget-header"><span class="style5"><font color="FFFFFF"> Detallar registro</font></span></td></tr> 
				<tr> 
  					<td> 
            			<table width="98%" border="0" cellspacing="1" cellpadding="1" align="center"> 
							<tr>
								<td width="20%" class="NoiseFooterTD">&nbsp;C&oacute;digo</td>
								<td width="80%" class="NoiseDataTD">&nbsp;<?php echo ($recmercodigo)? $recmercodigo : "" ; ?></td> 
 							</tr>
							<tr>
								<td width="20%" class="NoiseFooterTD">&nbsp;Item</td>
								<td width="80%" class="NoiseDataTD">&nbsp;<?php echo ($itedescodigo)? carganombitemdesa1($itedescodigo,$idcon) : "---" ; ?></td> 
 							</tr>
							<tr>
     							<td width="20%" class="NoiseFooterTD">&nbsp;Lote</td>
     							<td width="80%" class="NoiseDataTD">&nbsp;<?php echo ($lotecodigo)? carganumerolote($lotecodigo,$idcon) : "---" ;?></td>
    						</tr>
    						<tr>
								<td width="20%" class="NoiseFooterTD">&nbsp;Cantidad</td>
								<td width="80%" class="NoiseDataTD">&nbsp;<?php echo ($recmercantidad)? $recmercantidad : "---" ; ?></td> 
							</tr>
							<tr>
								<td width="20%" class="NoiseFooterTD">&nbsp;Unidad de Medida</td>
								<td width="80%" class="NoiseDataTD">&nbsp;<?php echo ($unidadcodigo)? $unidadcodigo : "---" ; ?></td> 
 							</tr>
      						<tr>
								<td width="20%" class="NoiseFooterTD">&nbsp;Orden de compra</td>
								<td width="80%" class="NoiseDataTD">&nbsp;<?php echo ($recmerordcomp)? $recmerordcomp : "---" ;?></td> 
							</tr>
      						<tr>
								<td width="20%" class="NoiseFooterTD">&nbsp;IR</td>
								<td width="80%" class="NoiseDataTD">&nbsp;<?php echo ($recmernoir)? $recmernoir : "---" ; ?></td> 
 							</tr>
 							<tr>
								<td width="20%" class="NoiseFooterTD">&nbsp;Factura</td>
								<td width="80%" class="NoiseDataTD">&nbsp;<?php echo ($recmernofact)? $recmernofact : "---" ;?></td> 
 							</tr>
 							<tr>
								<td width="20%" class="NoiseFooterTD">&nbsp;Bodega</td>
								<td width="80%" class="NoiseDataTD">&nbsp;<?php echo ($bodegacodigo)? cargabodenombre($bodegacodigo,$idcon) : "---" ;?></td> 
 							</tr>
 							<tr>
								<td width="20%" class="NoiseFooterTD">&nbsp;Certificado</td>
								<td width="20%" class="NoiseDataTD">&nbsp;<?php echo ($recmercertificado)? $recmercertificado : "---" ; ?></td> 
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
 			<input type="hidden" name="recmercodigo" value="<?php echo $sbreg[recmercodigo]; ?>">
			<input type="hidden" name="acciondetallarrecepcionmercancia">
			<input type="hidden" name="flagdetallarrecepcionmercancia" value="1">
			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>">
			<input type="hidden" name="sourceaction" value="detallar">
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
		</form>
	</body>
<?php if(!$codigo){ echo " -->"; } ?> 
</html>