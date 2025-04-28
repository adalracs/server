<?php 
include ( '../src/FunGen/sesion/fncvalses.php');

if(!$flagdetallarcurso)
{
	include ( '../src/FunGen/sesion/fnccarga.php');
	$sbreg = fnccarga($nombtabl,$radiobutton);
	if (!$sbreg)
		include( '../src/FunGen/fnccontfron.php');
}
?> 
<html> 
	<head> 
		<title>Nuevo registro de curso</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0"> 
		<?php include('../def/jquery.library_maestro.php');?>
		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.function_comun.js"></script>
	</head> 
<?php if(!$codigo){ echo "<!--";} ?>
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Curso</font></p> 
			<table border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content" width="450">
<?php if($campnomb): ?>
				<tr><td><div class="ui-widget">
					<div class="ui-state-error ui-corner-all" style="padding: 0 .7em;"> 
						<p><span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span> 
						<strong>Advertencia:</strong> Corrija los campos marcados con *</p>
					</div>
				</div></td></tr>
<?php else: ?> 		
				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr>	
<?php endif; ?> 
  				<tr><td class="ui-widget-header"><span class="style5"><font color="FFFFFF"> Detalle registro</font></span></td></tr> 
  				<tr> 
  					<td> 
            			<table width="98%" border="0" cellspacing="1" cellpadding="1" align="center"> 
							<tr> 
 								<td width="22%" class="NoiseFooterTD">&nbsp;C&oacute;digo</td> 
  								<td width="78%" class="NoiseDataTD"><?php echo $sbreg[cursocodigo]; ?></td> 
 							</tr> 
							<tr> 
 								<td class="NoiseFooterTD">&nbsp;Curso</td> 
  								<td class="NoiseDataTD"><?php echo $sbreg[cursonombre]; ?></td> 
 							</tr> 
 							
 							<tr> 
 								<td class="NoiseFooterTD">&nbsp;Instructor</td> 
 								<td class="NoiseDataTD"><?php echo $sbreg[cursoinstru]; ?></td> 
 							</tr>
 							
 							
							<tr> 
 								<td class="NoiseFooterTD">&nbsp;Fecha</td> 
 								<td class="NoiseDataTD"><?php echo $sbreg[cursofecha]; ?></td> 
 							</tr>
 							
 							<tr> 
 								<td class="NoiseFooterTD">&nbsp;Ubicaci&oacute;n</td> 
 								<td class="NoiseDataTD"><?php echo $sbreg[cursoubicac]; ?></td> 
 							</tr>
 							
 							<tr><td colspan="2" class="NoiseErrorDataTD"></td></tr>
							<tr><td colspan="2" class="NoiseFooterTD">&nbsp;Objetivo</td></tr>
							<tr><td colspan="2" rowspan="2" class="NoiseDataTD"><p>&nbsp;<?php echo $sbreg[cursoobjeti]; ?></p></td></tr>
						
							<tr><td colspan="2" class="NoiseErrorDataTD"></td></tr>
							<tr><td colspan="2" class="NoiseFooterTD">&nbsp;Contenido</td></tr>
							<tr><td colspan="2" rowspan="2" class="NoiseDataTD"><p>&nbsp;<?php echo $sbreg[cursoconten]; ?></p></td></tr>
						
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
			<input type="hidden" name="flagdetallarcurso" value="1"> 
			<input type="hidden" name="acciondetallarcurso">
			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>">
			<input type="hidden" name="sourceaction" value="detallar"> 			
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>">
 			<input type="hidden" name="columnas" value="cursocodigo,cursonombre,cursoobjeti"> 
			<input type="hidden" name="cursocodigo" value="<?php if($accionconsultarcurso) echo $cursocodigo; ?>"> 
			<input type="hidden" name="cursonombre" value="<?php if($accionconsultarcurso) echo $cursonombre; ?>"> 
			<input type="hidden" name="cursoobjeti" value="<?php if($accionconsultarcurso) echo $cursoobjeti; ?>"> 
 			<input type="hidden" name="accionconsultarcurso" value="<?php echo $accionconsultarcurso; ?>">
		</form> 	
	</body> 
<?php if(!$codigo){ echo " -->"; } ?> 
</html>