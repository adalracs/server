<?php 
ini_set("display_errors", 1);

	include ( '../src/FunGen/sesion/fncvalses.php');
	include ( '../src/FunGen/cargainput.php');	

	if(!$flagborrarcentcost){

		include ( '../src/FunGen/sesion/fnccarga.php');
		$sbreg = fnccarga($nombtabl,$radiobutton);
		if (!$sbreg)
			include( '../src/FunGen/fnccontfron.php');
			
		$cencoscodigo = $sbreg["cencoscodigo"];
		$cencosnumero = $sbreg["cencosnumero"];
		$cencosnombre = $sbreg["cencosnombre"];
		$cencosdescri = $sbreg["cencosdescri"];
		$cencosclasif = $sbreg["cencosclasif"];

		$cencosclasif_ = "Sin Clasificaci&oacute;n";

		if( $cencosclasif == "1" ) $cencosclasif_ = "Mano obra directa";
		if( $cencosclasif == "0" ) $cencosclasif_ = "Mano obra indirecta";

	}
?>
<html> 
	<head> 
		<title>Detalle de registro de centro de costos</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0"> 
		<?php include('../def/jquery.library_maestro.php');?>
	</head> 
<?php if(!$codigo){ echo "<!--";} ?> 
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Centro de costo</font></p> 
			<table border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content" width="650">
  				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr> 
  				<tr><td class="ui-widget-header"><span class="style5"><font color="FFFFFF"> Borrar registro</font></span></td></tr> 
				<tr> 
  					<td> 
            			<table width="95%" border="0" cellspacing="1" cellpadding="1" align="center"> 
							<tr> 
 								<td width="20%" class="NoiseFooterTD">&nbsp;Codigo&nbsp;</td> 
  								<td width="80%" class="NoiseDataTD"><?php echo ($cencoscodigo)? $cencoscodigo : "---" ; ?></td> 
 							</tr> 
 							<tr> 
 								<td width="20%" class="NoiseFooterTD">&nbsp;Numero&nbsp;</td> 
  								<td width="80%" class="NoiseDataTD"><?php echo ($cencosnumero)? $cencosnumero : "---" ; ?></td> 
 							</tr> 
 							<tr> 
 								<td width="20%" class="NoiseFooterTD">&nbsp;Clasificacion&nbsp;</td> 
  								<td width="80%" class="NoiseDataTD"><?php echo ($cencosclasif_)? $cencosclasif_ : "---" ; ?></td> 
 							</tr> 
							<tr> 
 								<td class="NoiseFooterTD">&nbsp;Nombre&nbsp;</td> 
  								<td class="NoiseDataTD"><?php echo ($cencosnombre)? $cencosnombre : "---" ;?></td> 
 							</tr> 
 							<tr><td colspan="2" class="NoiseErrorDataTD"></td></tr>
							<tr><td colspan="2" class="NoiseFooterTD">&nbsp;Nota</td></tr>
							<tr><td colspan="2" rowspan="2" class="NoiseDataTD"><?php echo $cencosdescri; ?></td></tr>
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
      		<input type="hidden" name="cencoscodigo1" value="<?php echo $cencoscodigo; ?>">
	  		<input type="hidden" name="accionborrarcentcost">
	  		<input type="hidden" name="flagborrarcentcost" value="1">
	  		<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>">
      		<input type="hidden" name="sourceaction" value="borrar">
	  		<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
		</form>
	</body>
<?php if(!$codigo){ echo " -->"; }?> 
</html>