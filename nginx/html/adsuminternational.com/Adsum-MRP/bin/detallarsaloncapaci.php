<?php 
include ('../src/FunGen/sesion/fncvalses.php'); 
include '../src/FunPerPriNiv/pktblubicaccapaci.php'; 
if (! $flagdetallarsaloncapaci) { 
	include ('../src/FunGen/sesion/fnccarga.php'); 
	$sbreg = fnccarga ( $nombtabl, $radiobutton ); 
	if (! $sbreg) { 
		include ('../src/FunGen/fnccontfron.php'); 
	} 
	$idcon = fncconn();
	$rsUbicaccapaci = loadrecordubicaccapaci($sbreg[ubicapcodigo], $idcon);
} 
?> 
<!-- Propiedad intelectual de Adsum SAS (c) 
-Todos los derechos reservados- 
Creado con WAG Adsum 
Autor: Andrés A. Riascos D. 
Fecha: 20120110 
GenVers: 4.8 -->
<!doctype html> 
<html> 
	<head> 
		<title>Detalle registro de salon de capacitacion</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=UTF8"> 
		<meta http-equiv="expires" content="0"> 
		<meta http-equiv="X-UA-Compatible" content="IE=9"> 
		<?php include ('../def/jquery.library_maestro.php'); ?> 
	</head> 
<?php if (! $codigo) { echo "<!--"; } ?> 
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post" enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Salon de capacitaci&oacute;n</font></p> 
			<table border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content" width="550"> 
				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr>	
				<tr><td class="ui-widget-header"><span class="style5"><font color="FFFFFF"> Detalle registro</font></span></td></tr>
				<tr>
					<td> 
						<table width="98%" border="0" cellspacing="1" cellpadding="1" align="center"> 
							<tr> 
								<td width="20%" class="NoiseFooterTD">&nbsp;C&oacute;digo</td> 
								<td width="80%" class="NoiseDataTD">&nbsp;<?php echo $sbreg[salcapcodigo]; ?></td> 
							</tr> 
							<tr> 
								<td width="20%" class="NoiseFooterTD">&nbsp;Salon</td> 
								<td width="80%" class="NoiseDataTD">&nbsp;<?php echo $sbreg[salcapnombre]; ?></td> 
							</tr> 
							<tr> 
								<td class="NoiseFooterTD">&nbsp;Ubicaci&oacute;n</td> 
								<td class="NoiseDataTD">&nbsp;<?php echo $rsUbicaccapaci[ubicapnombre] ?></td> 
							</tr> 
							<tr><td class="NoiseFooterTD" colspan="2">&nbsp;Descripci&oacute;n</td></tr> 
							<tr><td class="NoiseDataTD" colspan="2">&nbsp;<?php echo $sbreg[salcapdescri]; ?></td></tr> 
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
			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>"> 
			<input type="hidden" name="sourceaction" value="detallar">
			<input type="hidden" name="columnas" value="salcapcodigo,salcapnombre,ubicapcodigo,salcapdescri">
			<input type="hidden" name="salcapcodigo" value="<?php if ($accionconsultarsaloncapaci) { echo $salcapcodigo; } ?>"> 
			<input type="hidden" name="salcapnombre" value="<?php if ($accionconsultarsaloncapaci) { echo $salcapnombre; } ?>"> 
			<input type="hidden" name="ubicapcodigo" value="<?php if ($accionconsultarsaloncapaci) { echo $ubicapcodigo; } ?>"> 
			<input type="hidden" name="salcapdescri" value="<?php if ($accionconsultarsaloncapaci) { echo $salcapdescri; } ?>"> 
			<input type="hidden" name="accionconsultarsaloncapaci"	value="<?php echo $accionconsultarsaloncapaci; ?>"> 
			
			<input type="hidden" name="flagdetallarsaloncapaci" value="1">
			<input type="hidden" name="acciondetallarsaloncapaci"> 
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
		</form> 
	</body> 
<?php if (! $codigo) { echo " -->"; } ?> 
</html>