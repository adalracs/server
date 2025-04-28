<?php 
	ini_set('display_errors',1);
	include ( '../src/FunGen/sesion/fncvalses.php');
	include ('../src/FunGen/cargainput.php');
	include ( '../src/FunPerPriNiv/pktbltipoitemdesa.php');
	
	if(!$flagdetallaritemdesa) 
	{ 
		include ( '../src/FunGen/sesion/fnccarga.php'); 
		$sbreg = fnccarga($nombtabl,$radiobutton);
		
		if (!$sbreg) 
			include( '../src/FunGen/fnccontfron.php');


		$idcon = fncconn();
		if($sbreg[tipitemcodigo]){
			$tipitemcodigo=loadrecordtipoitemdesa($sbreg[tipitemcodigo],$idcon);
		}
		
	} 
?>
<html> 
	<head> 
		<title>Detalle de registro de item</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0"> 
		<?php include('../def/jquery.library_maestro.php');?>
	</head> 
<?php if(!$codigo){ echo "<!--";} ?> 
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">item</font></p> 
			<table border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content" width="650">
  				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr> 
  				<tr><td class="ui-widget-header"><span class="style5"><font color="FFFFFF"> Detallar registro</font></span></td></tr> 
				<tr> 
  					<td> 
            			<table width="95%" border="0" cellspacing="1" cellpadding="1" align="center"> 
							<tr> 
 								<td width="25%" class="NoiseFooterTD">&nbsp;C&oacute;digo</td> 
  								<td width="75%" class="NoiseDataTD"><?php echo $sbreg[itedescodigo]; ?></td> 
 							</tr> 
							<tr> 
 								<td class="NoiseFooterTD">&nbsp;Nombre</td> 
  								<td class="NoiseDataTD"><?php echo $sbreg[itedesnombre]; ?></td> 
 							</tr> 
 							<tr> 
 								<td class="NoiseFooterTD">&nbsp;Linea</td> 
  								<td class="NoiseDataTD"><?php echo $sbreg[itedeslinea]; ?></td> 
 							</tr> 
 							<tr> 
 								<td class="NoiseFooterTD">&nbsp;Fecha Creacion</td> 
  								<td class="NoiseDataTD"><?php echo $sbreg[itedesfecha]; ?></td> 
 							</tr> 
 							<tr> 
 								<td class="NoiseFooterTD">&nbsp;Unidad de Medida</td> 
  								<td class="NoiseDataTD"><?php echo $sbreg[itedesunimed]; ?></td> 
 							</tr> 
 							<tr> 
 								<td class="NoiseFooterTD">&nbsp;Costo</td> 
  								<td class="NoiseDataTD"><?php echo $sbreg[itedescosto]; ?>&nbsp;<b>COP</b></td> 
 							</tr> 
 							<tr> 
 								<td class="NoiseFooterTD">&nbsp;Fecha Actualizacion</td> 
  								<td class="NoiseDataTD"><?php echo $sbreg[fechacarga]; ?></td> 
 							</tr> 
 							<tr> 
 								<td class="NoiseFooterTD">&nbsp;Slip </td> 
  								<td class="NoiseDataTD"><?php echo ($sbreg[itedesslip])? $sbreg[itedesslip] : '-------' ;  ?>&nbsp;(und * mill)</td> 
 							</tr> 
 							<tr> 
 								<td class="NoiseFooterTD">&nbsp;Antiblock </td> 
  								<td class="NoiseDataTD"><?php echo ($sbreg[itedesantibl])? $sbreg[itedesantibl] : '-------' ; ?>&nbsp;(und * mill)</td> 
 							</tr> 
 							 <tr> 
 								<td class="NoiseFooterTD">&nbsp;Tipo de item</td> 
  								<td class="NoiseDataTD"><?php echo $tipitemcodigo[tipitemnombre]; ?></td> 
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
 			<input type="hidden" name="flagdetallaritemdesa" value="1"> 
			<input type="hidden" name="acciondetallaritemdesa">
			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>">
			<input type="hidden" name="sourceaction" value="detallar"> 			
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>">
			<input type="hidden" name="columnas" value="itedescodigo,itedesnombre,itedesdescri">
			<input type="hidden" name="itedescodigo" value="<?php if($accionconsultaritemdesa) echo $itedescodigo; ?>"> 
 			<input type="hidden" name="itedesnombre" value="<?php if($accionconsultaritemdesa) echo $itedesnombre; ?>"> 
 			<input type="hidden" name="itedesdescri" value="<?php if($accionconsultaritemdesa) echo $itedesdescri; ?>"> 
 			<input type="hidden" name="accionconsultaritemdesa" value="<?php echo $accionconsultaritemdesa; ?>">
		</form> 
	</body> 
<?php if(!$codigo){ echo " -->"; } ?> 
</html>