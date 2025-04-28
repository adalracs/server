<?php 	
	include ( '../src/FunPerPriNiv/pktbldefectocausa.php'); 
	include ( '../src/FunGen/sesion/fncvalses.php');
	include ( '../src/FunPerPriNiv/pktblcausa.php'); 
	
	if(!$flagborrardefecto)
	{ 
		include ( '../src/FunGen/sesion/fnccarga.php'); 
		$sbreg = fnccarga($nombtabl,$radiobutton); 
	
		if (!$sbreg)
			include( '../src/FunGen/fnccontfron.php'); 

		$idcon = fncconn();

		$defectcodigo = $sbreg["defectcodigo"];
		$defectnombre = $sbreg["defectnombre"];
		$defectdescri = $sbreg["defectdescri"];

		$rsDefectoCausa = dinamicscanopdefectocausa(array( "defectcodigo" => $defectcodigo ), array( "defectcodigo" => "=" ), $idcon);
		$nrDefectoCausa = fncnumreg($rsDefectoCausa);

		for( $a = 0; $a < $nrDefectoCausa; $a++){

			$rwDefectoCausa = fncfetch($rsDefectoCausa,$a);

			$arrcausas = ($arrcausas)? $arrcausas.",".$rwDefectoCausa["causacodigo"] : $rwDefectoCausa["causacodigo"];

		}

	} 
	
?>
<html> 
	<head> 
		<title>Borrar de registro de defecto de calidad</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0"> 
		<?php include('../def/jquery.library_maestro.php');?>
		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.function_comun.js"></script>
	</head> 
<?php if(!$codigo){ echo "<!--";} ?> 
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Defecto de calidad</font></p> 
			<table border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content" width="470">
  				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr> 
  				<tr><td class="ui-widget-header"><span class="style5"><font color="FFFFFF"> Borrar registro</font></span></td></tr> 
				<tr> 
  					<td> 
            			<table width="98%" border="0" cellspacing="1" cellpadding="1" align="center"> 
							<tr> 
 								<td width="22%" class="NoiseFooterTD">&nbsp;C&oacute;digo</td> 
  								<td width="78%" class="NoiseDataTD"><?php echo ($defectcodigo)? $defectcodigo : "---" ;?></td> 
 							</tr> 
							<tr> 
 								<td class="NoiseFooterTD">&nbsp;Nombre</td> 
  								<td class="NoiseDataTD"><?php echo ($defectnombre)? $defectnombre : "---" ; ?></td> 
 							</tr>  
 							<tr>
 								<td colspan="2">
 									<div class="ui-buttonset ui-state-default NoiseDataTD" style="width:550px; padding: 1px;">&nbsp;
										Causas del defecto&nbsp;
									</div>
 									<div id="filtrlistadefecto">
										<?php
											$noAjax = true;
											$flagdetallar = 1;
											include '../src/FunjQuery/jquery.visors/jquery.defecto.php';  
										?>
									</div>
									<input type="hidden" name="arrcausas" id="arrcausas" size="60"value="<?php echo $arrcausas; ?>" />
									<input type="hidden" name="arrcausastmp" id="arrcausastmp" size="60"value="<?php echo $arrcausastmp; ?>" />
 								</td>
 							</tr>    
 							<tr><td colspan="2" class="NoiseErrorDataTD"></td></tr>
							<tr><td colspan="2" class="NoiseFooterTD">&nbsp;Descripci&oacute;n</td></tr>
							<tr><td colspan="2" rowspan="2" class="NoiseDataTD"><?php echo $defectdescri; ?></td></tr>
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
 			<input type="hidden" name="flagborrardefecto" value="1">
 			<input type="hidden" name="defectcodigo1" value="<?php if(!$flagborrardefecto){ echo $sbreg[defectcodigo];}else{ echo $defectcodigo1; } ?>">
			<input type="hidden" name="accionborrardefecto">
			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>">
			<input type="hidden" name="sourceaction" value="borrar"> 			
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>">
			<input type="hidden" name="columnas" value="defectcodigo,defectnombre,defectdescri"> 
			<input type="hidden" name="defectcodigo" value="<?php if($accionconsultardefecto) echo $defectcodigo; ?>"> 
			<input type="hidden" name="defectnombre" value="<?php if($accionconsultardefecto) echo $defectnombre; ?>"> 
			<input type="hidden" name="defectdescri" value="<?php if($accionconsultardefecto) echo $defectdescri; ?>"> 
 			<input type="hidden" name="accionconsultardefecto" value="<?php echo $accionconsultardefecto; ?>">
		</form> 
	</body> 
<?php if(!$codigo){ echo " -->"; } ?> 
</html>