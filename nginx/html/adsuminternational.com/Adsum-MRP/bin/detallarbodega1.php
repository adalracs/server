<?php 
	include ( '../src/FunGen/sesion/fncvalses.php');
	include ( '../src/FunPerPriNiv/pktblusuario.php');
	include ( '../src/FunPerPriNiv/pktblciudad.php');
	include ( '../src/FunPerPriNiv/pktbldepartamento.php');
	include ( '../src/FunGen/cargainput.php');
	
	if(!$flagdetallarbodega1)
	{
		include ( '../src/FunGen/sesion/fnccarga.php');
		$sbreg = fnccarga($nombtabl,$radiobutton);
		if (!$sbreg)
			include( '../src/FunGen/fnccontfron.php');
		$idcon = fncconn();
		$rs_usuario = cargausuanombre($sbreg[usuacodi],$idcon);
//		$rs_ciudad = cargaciudadnombre2($sbreg[ciudadcodigo], $idcon);
		fncclose($idcon);
	}
?>
<html> 
	<head> 
		<title>Detalle registro de bodega</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0"> 
		<?php include('../def/jquery.library_maestro.php');?>
	</head> 
<?php if(!$codigo){ echo "<!--";} ?>
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Bodega</font></p> 
			<table border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content" width="550">
				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr>	
  				<tr><td class="ui-widget-header"><span class="style5"><font color="FFFFFF"> Detallar registro</font></span></td></tr> 
				<tr> 
  					<td> 
            			<table width="98%" border="0" cellspacing="1" cellpadding="1" align="center"> 
							<tr>
								<td width="20%" class="NoiseFooterTD">&nbsp;C&oacute;digo</td>
								<td width="80%" class="NoiseDataTD">&nbsp;<?php echo $sbreg[bodegacodigo]; ?></td> 
 							</tr>
							<tr>
								<td width="20%" class="NoiseFooterTD">&nbsp;Nombre</td>
								<td width="80%" class="NoiseDataTD">&nbsp;<?php echo $sbreg[bodeganombre]; ?></td> 
 							</tr>
 							<tr>
	        					<td class="NoiseFooterTD">&nbsp;Encargado</td>
	        					<td class="NoiseDataTD">&nbsp;<?php echo $rs_usuario; ?></td>
      						</tr>
      						<!--<tr>
     							<td class="NoiseFooterTD">&nbsp;Ciudad</td>
     							<td class="NoiseDataTD">&nbsp;<?php //echo $rs_ciudad; ?></td>
    						</tr>
      						--><tr>
								<td class="NoiseFooterTD">&nbsp;Ubicaci&oacute;n</td>
								<td class="NoiseDataTD">&nbsp;<?php echo $sbreg[bodegaubicac]; ?></td> 
 							</tr>
      						<tr>
								<td class="NoiseFooterTD">&nbsp;&Aacute;rea</td>
								<td class="NoiseDataTD">&nbsp;<?php echo $sbreg[bodegacapaci]; ?>&nbsp;&nbsp;mts&sup2;</td> 
 							</tr>
 							<tr><td colspan="2" class="NoiseErrorDataTD"></td></tr>
							<tr><td colspan="2" class="NoiseFooterTD">&nbsp;Nota</td></tr>
							<tr><td colspan="2" class="NoiseDataTD">&nbsp;<?php echo $sbreg[bodeganota]; ?></td></tr>
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
 			<input type="hidden" name="bodegacodigo" value="<?php echo $sbreg[bodegacodigo]; ?>">
 			<input type="hidden" name="flagdetallarbodega1" value="1"> 
			<input type="hidden" name="acciondetallarbodega1">
			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>">
			<input type="hidden" name="sourceaction" value="detallar">
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
		</form>
	</body>
<?php if(!$codigo){ echo " -->"; } ?> 
</html>