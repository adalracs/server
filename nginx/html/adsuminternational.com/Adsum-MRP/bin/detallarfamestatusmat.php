<?php 

	include ("../src/FunPerPriNiv/pktblitemdesa.php");
	include ( "../src/FunGen/sesion/fncvalses.php");
	include ("../src/FunGen/cargainput.php");
	
	if(!$flagdetallarfamestatusmat) { 		

		include ( "../src/FunGen/sesion/fnccarga.php"); 
		$sbreg = fnccarga($nombtabl,$radiobutton);
		
		if (!$sbreg){ 
			include( "../src/FunGen/fnccontfron.php");
		}

		$famestcodigo = $sbreg["famestcodigo"];
		$famestnombre = $sbreg["famestnombre"];
		$famestdescri = $sbreg["famestdescri"];
		$famestestado = $sbreg["famestestado"];
		$famesttipo = $sbreg["famesttipo"];

	} 

	$idcon = fncconn();
?>
<html> 
	<head> 
		<title>Detalle de registro de familias x estatus</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0"> 
		<?php include('../def/jquery.library_maestro.php');?>
		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.function_comun.js"></script>
	</head> 
<?php if(!$codigo){ echo "<!--";} ?> 
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Familias x estatus</font></p> 
			<table border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content" width="650">
  				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr> 
  				<tr><td class="ui-widget-header"><span class="style5"><font color="FFFFFF"> Detallar registro</font></span></td></tr> 
				<tr> 
  					<td> 
            			<table width="95%" border="0" cellspacing="1" cellpadding="1" align="center"> 
							<tr> 
 								<td width="25%" class="NoiseFooterTD">&nbsp;C&oacute;digo&nbsp;</td> 
  								<td width="75%" class="NoiseDataTD"><?php echo $famestcodigo; ?></td> 
 							</tr> 
							<tr> 
 								<td class="NoiseFooterTD">&nbsp;Nombre&nbsp;</td> 
  								<td class="NoiseDataTD"><?php echo $famestnombre; ?></td> 
 							</tr> 
 							<tr> 
 								<td class="NoiseFooterTD">&nbsp;Estado&nbsp;</td> 
  								<td class="NoiseDataTD"><?php echo ($famestestado == 1)? "In-Activo" : "Activo" ; ?></td> 
 							</tr>
 							<tr> 
 								<td class="NoiseFooterTD">&nbsp;Tipo&nbsp;</td> 
  								<td class="NoiseDataTD"><?php echo ($famesttipo == 1)? "Importados" : "Manufacturados" ; ?></td> 
 							</tr>  
 							<tr><td colspan="2" class="NoiseErrorDataTD"></td></tr>
							<tr><td colspan="2" class="NoiseFooterTD">&nbsp;Nota</td></tr>
							<tr><td colspan="2" rowspan="2" class="NoiseDataTD"><?php echo $famestdescri; ?></td></tr>
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
 			<input type="hidden" name="flagdetallarfamestatusmat" value="1"> 
			<input type="hidden" name="acciondetallarfamestatusmat">
			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>">
			<input type="hidden" name="sourceaction" value="detallar"> 			
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>">			
		</form> 
	</body> 
<?php if(!$codigo){ echo " -->"; } ?> 
</html>