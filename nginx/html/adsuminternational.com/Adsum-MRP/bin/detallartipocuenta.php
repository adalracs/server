<?php 

	include ( "../src/FunGen/sesion/fncvalses.php");
	include ( "../src/FunGen/cargainput.php");
	
	if(!$flagdetallartipocuenta) 
	{ 		
		include ( "../src/FunGen/sesion/fnccarga.php"); 
		$sbreg = fnccarga($nombtabl,$radiobutton);
		
		if (!$sbreg){ 
			include( "../src/FunGen/fnccontfron.php");
		}

		$tipcuecodigo = $sbreg["tipcuecodigo"];
		$tipcuenombre = $sbreg["tipcuenombre"];
		$tipcuedescri = $sbreg["tipcuedescri"];

	} 

?>
<html> 
	<head> 
		<title>Detalle de registro de tipo de cuentas</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0"> 
		<?php include('../def/jquery.library_maestro.php');?>
	</head> 
<?php if(!$codigo){ echo "<!--";} ?> 
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Tipo de cuenta</font></p> 
			<table border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content" width="650">
  				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr> 
  				<tr><td class="ui-widget-header"><span class="style5"><font color="FFFFFF"> Detallar registro</font></span></td></tr> 
				<tr> 
  					<td> 
            			<table width="95%" border="0" cellspacing="1" cellpadding="1" align="center"> 
							<tr> 
 								<td width="20%" class="NoiseFooterTD">&nbsp;Codigo&nbsp;</td> 
  								<td width="80%" class="NoiseDataTD"><?php echo ($tipcuecodigo)? $tipcuecodigo : "---" ; ?></td> 
 							</tr> 
							<tr> 
 								<td class="NoiseFooterTD">&nbsp;Nombre&nbsp;</td> 
  								<td class="NoiseDataTD"><?php echo ($tipcuenombre)? $tipcuenombre : "---" ;?></td> 
 							</tr> 
 							<tr><td colspan="2" class="NoiseErrorDataTD"></td></tr>
							<tr><td colspan="2" class="NoiseFooterTD">&nbsp;Nota</td></tr>
							<tr><td colspan="2" rowspan="2" class="NoiseDataTD"><?php echo $tipcuedescri; ?></td></tr>
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
 			<input type="hidden" name="flagdetallartipocuenta" value="1"> 
			<input type="hidden" name="acciondetallartipocuenta">
			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>">
			<input type="hidden" name="sourceaction" value="detallar"> 			
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>">
			<input type="hidden" name="columnas" value="tipcuecodigo, tipcuenombre, tipcuedescri">
			<input type="hidden" name="tipcuecodigo" value="<?php if($accionconsultartipocuenta) echo $tipcuecodigo; ?>"> 
 			<input type="hidden" name="tipcuenombre" value="<?php if($accionconsultartipocuenta) echo $tipcuenombre; ?>"> 
 			<input type="hidden" name="tipcuedescri" value="<?php if($accionconsultartipocuenta) echo $tipcuedescri; ?>"> 
		</form> 
	</body> 
<?php if(!$codigo){ echo " -->"; } ?> 
</html>