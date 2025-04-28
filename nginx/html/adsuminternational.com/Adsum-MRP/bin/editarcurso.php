<?php 
ob_start();
	include ( '../src/FunGen/sesion/fncvalses.php');
	if($accioneditarcurso) 
	{ 
		include ( 'editacurso.php'); 
		$flageditarcurso = 1;
	}
	ob_end_flush();
	
	if(!$flageditarcurso)
	{
		include ( '../src/FunGen/sesion/fnccarga.php');
		$sbreg = fnccarga($nombtabl,$radiobutton);
		if (!$sbreg)
			include( '../src/FunGen/fnccontfron.php');
	}
?>
<html> 
	<head> 
		<title>Editar registro de curso</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0"> 
		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.function_comun.js"></script>
		<?php include('../def/jquery.library_maestro.php');?>
		<script type="text/javascript">
			$(function(){
				$("#cursofecha").datepicker({changeMonth: true,changeYear: true});
				$("#cursofecha").datepicker('option', {dateFormat: 'yy-mm-dd'});
				$("#cursofecha").datepicker($.datepicker.regional['es']);
		 	});
		</script>
	</head> 
<?php if(!$codigo){ echo "<!--";} ?>
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Curso</font></p> 
			<table width="450" border="0" align="center" cellpadding="1" cellspacing="1" class="ui-widget-content">
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
				<tr><td class="ui-widget-header"><span class="style5"><font color="FFFFFF">Editar registro</font></span></td></tr>
				<tr> 
  					<td>
						<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center"> 
							<tr> 
 								<td width="22%" class="NoiseFooterTD"><?php if($campnomb["cursonombre"] == 1){$cursonombre = null; echo "*";}?>&nbsp;Curso</td> 
 								<td width="78%" class="NoiseDataTD"><input type="text" name="cursonombre" id="cursonombre"  size="50" value="<?php if(!$flagnuevocurso){echo $sbreg[cursonombre];}else{ echo $cursonombre; }?>"></td> 
 							</tr>
 							
							<tr> 
 								<td width="22%" class="NoiseFooterTD"><?php if($campnomb["cursoinstru"] == 1){$cursoinstru = null; echo "*";}?>&nbsp;Instructor</td> 
 								<td width="78%" class="NoiseDataTD"><input type="text" name="cursoinstru" id="cursoinstru"  size="50" value="<?php if(!$flagnuevocurso){echo $sbreg[cursoinstru];}else{ echo $cursoinstru; }?>"></td> 
 							</tr>
 							
 							<tr><td class="ui-state-default" colspan="2"></td></tr>							
 							<tr><td colspan="2" class="NoiseFooterTD"><?php if($campnomb["cursoobjeti"] == 1){ $cursoobjeti=null; echo "*";} ?>&nbsp;Objetivo</td></tr>
  							<tr><td colspan="2" class="NoiseFooterTD"><textarea name="cursoobjeti" id="cursoobjeti" rows="3" cols="50" wrap="VIRTUAL"><?php if(!$flagnuevocurso){echo $sbreg[cursoobjeti];}else {echo $cursoobjeti;}?></textarea></td></tr>
  							
  							<tr><td colspan="2" class="NoiseFooterTD"><?php if($campnomb["cursoconten"] == 1){ $cursoconten=null; echo "*";} ?>&nbsp;Contenido</td></tr>
  							<tr><td colspan="2" class="NoiseFooterTD"><textarea name="cursoconten" id="cursoconten" rows="3" cols="50" wrap="VIRTUAL"><?php if(!$flagnuevocurso){echo $sbreg[cursoconten];}else {echo $cursoconten;}?></textarea></td></tr>
  								
  							<tr> 
 								<td width="22%" class="NoiseFooterTD"><?php if($campnomb["cursofecha"] == 1){$cursofecha = null; echo "*";}?>&nbsp;Fecha</td> 
 								<td width="78%" class="NoiseDataTD"><input type="text" name="cursofecha" id="cursofecha"  size="50" value="<?php if(!$flagnuevocurso){echo $sbreg[cursofecha];}else{ echo $cursofecha; }?>" onclick="this.blur();"></td> 
 							</tr>
 							
 							<tr> 
 								<td width="22%" class="NoiseFooterTD"><?php if($campnomb["cursoubicac"] == 1){$cursoubicac = null; echo "*";}?>&nbsp;Ubicaci&oacute;n</td> 
 								<td width="78%" class="NoiseDataTD"><input type="text" name="cursoubicac" id="cursoubicac"  size="50" value="<?php if(!$flagnuevocurso){echo $sbreg[cursoubicac];}else{ echo $cursoubicac; }?>"></td> 
 							</tr>
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
			<input type="hidden" name="cursocodigo" value="<?php if(!$flageditarcurso){ echo $sbreg[cursocodigo];}else{ echo $cursocodigo; } ?>"> 
			<input type="hidden" name="accioneditarcurso"> 
			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>">
			<input type="hidden" name="sourceaction" value="editar"> 
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
		</form> 
	</body> 
<?php if(!$codigo){ echo " -->"; } ?> 
</html>