<?php 
ob_start(); 
include ( '../src/FunGen/sesion/fncvalses.php'); 
if($accionnuevootestado) 
{ 
	include ( 'grabaotestado.php'); 
} 
ob_end_flush(); 
?> 
<!-- Propiedad intelectual de Adsum SA (c) 
-Todos los derechos reservados- 
Creado con WAG Adsum 
Autor: Andr�s A. Riascos D. 
Fecha: 26052004 
GenVers: 3.1 --> 
<html> 
	<head> 
		<title>Nuevo registro de estado ot</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0"> 
		<link rel="stylesheet" type="text/css" href="temas/Noise/Style.css"> 
	</head> 
<?php  if(!$codigo){ echo "<!--";} ?> 
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Estados de OT</font></p> 
			<table border="0" cellspacing="1" cellpadding="2" align="center" class="NoiseFormTABLE"> 
  				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr> 
  				<tr><td class="NoiseFieldCaptionTD"><span class="style5"><font color="FFFFFF">Ingresar nuevo registro</font></span></td></tr> 
				<tr> 
  					<td>
  						<table width="98%" border="0" cellspacing="1" cellpadding="1" align="center"> 
							<tr> 
			 					<td width="30%" class="NoiseFooterTD"><?php if($campnomb["otestanombre"] == 1){ $otestanombre = null;echo "*";}?>&nbsp;Nombre</td> 
								<td width="70%" class="NoiseErrorDataTD"><input type="text" name="otestanombre"	value="<?php if(!$flagnuevootestado){$sbreg[otestanombre];}else{echo($otestanombre);}?>"></td>
			 				</tr> 
							<tr> 
			 					<td width="30%" class="NoiseFooterTD"><?php if($campnomb["otestatipo"] == 1){ $otestatipo = null;echo "*";}?>&nbsp;Tipo</td> 
								<td width="70%" class="NoiseErrorDataTD"><select name="otestatipo" id="otestatipo">
									<option value="">Seleccione</option>
									<option value="1" <?php if($otestatipo == 1) echo 'selected'; ?> >Tiempo de Creado</option>
									<option value="2" <?php if($otestatipo == 2) echo 'selected'; ?> >Tiempo de Ejecutado</option>
									<option value="3" <?php if($otestatipo == 3) echo 'selected'; ?> >Tiempo de Espera</option>
									<option value="4" <?php if($otestatipo == 4) echo 'selected'; ?> >Tiempo de Reporte</option>
									<option value="5" <?php if($otestatipo == 5) echo 'selected'; ?> >Tiempo de Cierre</option>
									<option value="6" <?php if($otestatipo == 6) echo 'selected'; ?> >Tiempo de Anulado</option>
									<option value="7" <?php if($otestatipo == 7) echo 'selected'; ?> >Tiempo de Funcionario Reasignado</option>
								</select></td>
			 				</tr> 
							<tr><td colspan="2" class="NoiseFooterTD"><?php if($campnomb["otestadescri"] == 1){ $otestadescri = null;echo "*";}?>&nbsp;Descripci&oacute;n</td></tr>
							<tr><td colspan="2" class="NoiseErrorDataTD"><textarea name="otestadescri" rows="2" cols="35" wrap="VIRTUAL"><?php if(!$flagnuevootestado){$sbreg[otestadescri];}else {echo $otestadescri;}?></textarea></td></tr>
			 			</table> 
		  			</td> 
		 		</tr> 
		  		<tr> 
					<td> 
						<div align="center"> 
			  			<input type="image" name="aceptar"  src="../img/aceptar.gif" onclick="form1.accionnuevootestado.value =  1;"  width="86" height="18" alt="Aceptar" border=0> 
			  			<input type="image" name="cancelar" src="../img/cancelar.gif" onclick="form1.action='maestablotestado.php';"  width="86" height="18" alt="Cancelar" border=0> 
			  			</div> 
					</td> 
		 		</tr> 
		 		<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr> 
			</table> 
<?php if($campnomb){echo '<font face = "Verdana" >Corregir los campos marcados con *</font>';} ?> 
			<input type="hidden" name="otestacodigo" value="<?php if(!$flagnuevootestado){ echo $sbreg[otestacodigo];}else{ echo $otestacodigo; } ?>"> 
			<input type="hidden" name="accionnuevootestado"> 
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
		</form> 
	</body> 
<?php if(!$codigo){ echo " -->"; } ?> 
</html>