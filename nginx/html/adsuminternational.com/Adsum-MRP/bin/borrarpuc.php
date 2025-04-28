<?php 

	include ( "../src/FunPerPriNiv/pktbltipocuenta.php"); 
	include ( '../src/FunGen/sesion/fncvalses.php');
	include ( '../src/FunGen/cargainput.php');	

	if(!$flagborrarpuc){

		include ( '../src/FunGen/sesion/fnccarga.php');
		$sbreg = fnccarga($nombtabl,$radiobutton);
		if (!$sbreg)
			include( '../src/FunGen/fnccontfron.php');
			
		$puccodigo = $sbreg["puccodigo"];
		$pucnumero = $sbreg["pucnumero"];
		$pucnombre = $sbreg["pucnombre"];
		$pucdescri = $sbreg["pucdescri"];
		$tipcuecodigo = $sbreg["tipcuecodigo"];

	}

?>
<html> 
	<head> 
		<title>Detalle de registro de cuentas</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0"> 
		<?php include('../def/jquery.library_maestro.php');?>
	</head> 
<?php if(!$codigo){ echo "<!--";} ?> 
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Cuenta</font></p> 
			<table border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content" width="650">
  				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr> 
  				<tr><td class="ui-widget-header"><span class="style5"><font color="FFFFFF"> Borrar registro</font></span></td></tr> 
				<tr> 
  					<td> 
            			<table width="95%" border="0" cellspacing="1" cellpadding="1" align="center"> 
							<tr> 
 								<td width="20%" class="NoiseFooterTD">&nbsp;Codigo&nbsp;</td> 
  								<td width="80%" class="NoiseDataTD"><?php echo ($puccodigo)? $puccodigo : "---" ; ?></td> 
 							</tr> 
 							<tr> 
 								<td class="NoiseFooterTD">&nbsp;Numero&nbsp;</td> 
  								<td class="NoiseDataTD"><?php echo ($pucnumero)? $pucnumero : "---" ;?></td> 
 							</tr> 
							<tr> 
 								<td class="NoiseFooterTD">&nbsp;Nombre&nbsp;</td> 
  								<td class="NoiseDataTD"><?php echo ($pucnombre)? $pucnombre : "---" ;?></td> 
 							</tr> 
 							<tr> 
 								<td class="NoiseFooterTD">&nbsp;Tipo Cuenta&nbsp;</td> 
  								<td class="NoiseDataTD"><?php echo ($tipcuecodigo)? strtoupper(carganombretipocuenta($tipcuecodigo,$idcon)) : "---" ;?></td> 
 							</tr> 
 							<tr><td colspan="2" class="NoiseErrorDataTD"></td></tr>
							<tr><td colspan="2" class="NoiseFooterTD">&nbsp;Nota</td></tr>
							<tr><td colspan="2" rowspan="2" class="NoiseDataTD"><?php echo $pucdescri; ?></td></tr>
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
      		<input type="hidden" name="puccodigo1" value="<?php echo $puccodigo; ?>">
	  		<input type="hidden" name="accionborrarpuc">
	  		<input type="hidden" name="flagborrarpuc" value="1">
	  		<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>">
      		<input type="hidden" name="sourceaction" value="borrar">
	  		<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
		</form>
	</body>
<?php if(!$codigo){ echo " -->"; } ?> 
</html>