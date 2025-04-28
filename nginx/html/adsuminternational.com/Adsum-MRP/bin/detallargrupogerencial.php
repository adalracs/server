<?php 

	include ( "../src/FunPerPriNiv//pktbltipomaterial.php"); 
	include ( "../src/FunGen/sesion/fncvalses.php");
	include ( "../src/FunGen/cargainput.php");
	
	if(!$flagdetallargrupogerencial) 
	{ 		
		include ( "../src/FunGen/sesion/fnccarga.php"); 
		$sbreg = fnccarga($nombtabl,$radiobutton);
		
		if (!$sbreg){ 
			include( "../src/FunGen/fnccontfron.php");
		}

		$grugercodigo = $sbreg["grugercodigo"];
		$grugernombre = $sbreg["grugernombre"];
		$grugerdescri = $sbreg["grugerdescri"];
		$tipmatcodigo = $sbreg["tipmatcodigo"];

	} 

?>
<html> 
	<head> 
		<title>Detalle de registro de grupo gerencial</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0"> 
		<?php include('../def/jquery.library_maestro.php');?>
	</head> 
<?php if(!$codigo){ echo "<!--";} ?> 
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Grupo gerencial</font></p> 
			<table border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content" width="650">
  				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr> 
  				<tr><td class="ui-widget-header"><span class="style5"><font color="FFFFFF"> Detallar registro</font></span></td></tr> 
				<tr> 
  					<td> 
            			<table width="95%" border="0" cellspacing="1" cellpadding="1" align="center"> 
							<tr> 
 								<td width="20%" class="NoiseFooterTD">&nbsp;Codigo&nbsp;</td> 
  								<td width="80%" class="NoiseDataTD"><?php echo ($grugercodigo)? $grugercodigo : "---" ; ?></td> 
 							</tr> 
							<tr> 
 								<td class="NoiseFooterTD">&nbsp;Nombre&nbsp;</td> 
  								<td class="NoiseDataTD"><?php echo ($grugernombre)? $grugernombre : "---" ;?></td> 
 							</tr> 
 							<tr> 
 								<td class="NoiseFooterTD">&nbsp;Tipo material&nbsp;</td> 
  								<td class="NoiseDataTD"><?php echo ($tipmatcodigo)? carganombretipomaterial($tipmatcodigo, $idcon)  : "---" ;?></td> 
 							</tr> 
 							<tr><td colspan="2" class="NoiseErrorDataTD"></td></tr>
							<tr><td colspan="2" class="NoiseFooterTD">&nbsp;Nota</td></tr>
							<tr><td colspan="2" rowspan="2" class="NoiseDataTD"><?php echo $grugerdescri; ?></td></tr>
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
 			<input type="hidden" name="flagdetallargrupogerencial" value="1"> 
			<input type="hidden" name="acciondetallargrupogerencial">
			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>">
			<input type="hidden" name="sourceaction" value="detallar"> 			
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>">
			<input type="hidden" name="columnas" value="grugercodigo, grugernombre, grugerdescri, tipmatcodigo">
			<input type="hidden" name="grugercodigo" value="<?php if($accionconsultargrupogerencial) echo $grugercodigo; ?>"> 
 			<input type="hidden" name="grugernombre" value="<?php if($accionconsultargrupogerencial) echo $grugernombre; ?>"> 
 			<input type="hidden" name="grugerdescri" value="<?php if($accionconsultargrupogerencial) echo $grugerdescri; ?>"> 
 			<input type="hidden" name="tipmatcodigo" value="<?php if($accionconsultargrupogerencial) echo $tipmatcodigo; ?>"> 
		</form> 
	</body> 
<?php if(!$codigo){ echo " -->"; } ?> 
</html>