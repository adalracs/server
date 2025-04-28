<?php 
	
	include ( "../src/FunPerPriNiv/pktblproveedo.php");
	include ( "../src/FunPerPriNiv/pktblitemdesa.php");
	include ( "../src/FunGen/sesion/fncvalses.php");
	include ( "../src/FunPerPriNiv/pktbllote.php");
	include ( "../src/FunGen/cargainput.php");
	
	if(!$flagdetallarhistosaldoresina) 
	{ 		
		include ( "../src/FunGen/sesion/fnccarga.php"); 
		$sbreg = fnccarga($nombtabl,$radiobutton);
		
		if (!$sbreg){ 
			include( "../src/FunGen/fnccontfron.php");
		}

	} 

	$idcon = fncconn();
	$rwSaldo = loadrecordsaldo($sbreg["saldocodigo"],$idcon);
	$rwItemdesa = loadrecorditemdesa($rwSaldo["itedescodigo"],$idcon);
	$rwLote = loadrecordlote($rwSaldo["lotecodigo"],$idcon);
	$rwProveedo = loadrecordproveedo($rwLote["proveecodigo"],$idcon);
?>
<html> 
	<head> 
		<title>Detalle de registro de saldos</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0"> 
		<?php include('../def/jquery.library_maestro.php');?>
	</head> 
<?php if(!$codigo){ echo "<!--";} ?> 
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Saldos</font></p> 
			<table border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content" width="650">
  				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr> 
  				<tr><td class="ui-widget-header"><span class="style5"><font color="FFFFFF"> Detallar registro</font></span></td></tr> 
				<tr> 
  					<td> 
            			<table width="95%" border="0" cellspacing="1" cellpadding="1" align="center"> 
							<tr> 
 								<td width="25%" class="NoiseFooterTD">&nbsp;Item&nbsp;</td> 
  								<td width="75%" class="NoiseDataTD"><?php echo $rwSaldo['itedescodigo']; ?></td> 
 							</tr> 
							<tr> 
 								<td class="NoiseFooterTD">&nbsp;Material&nbsp;</td> 
  								<td class="NoiseDataTD"><?php echo $rwItemdesa['itedesnombre']; ?></td> 
 							</tr> 
 							<tr> 
 								<td class="NoiseFooterTD">&nbsp;Kilogramos&nbsp;</td> 
  								<td class="NoiseDataTD"><?php echo $rwSaldo['saldocantkgs'] ;  ?></td> 
 							</tr> 
 							<tr> 
 								<td class="NoiseFooterTD">&nbsp;No.Lote&nbsp;</td> 
  								<td class="NoiseDataTD"><?php echo $rwLote['lotenumero']." - ".$rwProveedo["proveenombre"]; ?></td> 
 							</tr> 
 							<tr><td colspan="2" class="NoiseErrorDataTD"></td></tr>
							<tr><td colspan="2" class="NoiseFooterTD">&nbsp;Nota</td></tr>
							<tr><td colspan="2" rowspan="2" class="NoiseDataTD"><?php echo $rwSaldo['saldodescri']; ?></td></tr>
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
 			<input type="hidden" name="flagdetallarhistosaldoresina" value="1"> 
			<input type="hidden" name="acciondetallarhistosaldoresina">
			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>">
			<input type="hidden" name="sourceaction" value="detallar"> 			
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>">
			<input type="hidden" name="columnas" value="itedescodigo, saldocantkgs">
 			<input type="hidden" name="accionconsultarhistosaldo" value="<?php echo $accionconsultarhistosaldo; ?>">
		</form> 
	</body> 
<?php if(!$codigo){ echo " -->"; } ?> 
</html>