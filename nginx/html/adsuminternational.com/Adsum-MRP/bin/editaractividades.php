<?php 
ob_start(); 
include ( '../src/FunGen/sesion/fncvalses.php'); 
include ('../src/FunPerPriNiv/pktblclases.php');
include ('../src/FunPerPriNiv/pktblunimedida.php');

if($accioneditaractividades){ 
	include ( 'editaactividades.php'); 
} 
ob_end_flush(); 

if(!$flageditaractividades){ 
	include ( '../src/FunGen/sesion/fnccarga.php'); 
	$sbreg = fnccarga($nombtabl,$radiobutton); 
	
	if (!$sbreg){ 
		include( '../src/FunGen/fnccontfron.php'); 
	} 
} 

?> 
<!-- Propiedad intelectual de Adsum SA (c) 
-Todos los derechos reservados- 
Creado con WAG Adsum 
Autor: Andr�s A. Riascos D. 
Fecha: 26052004 
GenVers: 3.1 --> 
<html> 
	<head> 
		<title>Editar registro de actividades</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0"> 
		<link rel="stylesheet" type="text/css" href="temas/Noise/Style.css"> 
		<SCRIPT LANGUAGE="JavaScript"> 
			<!-- Begin 
			agree = 0; 
			//  End --> 
		</script> 
	</head> 
<?php if(!$codigo){ echo "<!--";} ?> 
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Actividades</font></p> 
			<table width="60%" border="0" align="center" cellpadding="0" cellspacing="0" class="NoiseFormTABLE"> 
  				<tr><td width="400" class="NoiseErrorDataTD">&nbsp;</td></tr> 
  				<tr><td class="NoiseFieldCaptionTD"><span class="style5"><font color="FFFFFF">&nbsp;Editar registro</font></span></td></tr> 
				<tr> 
  					<td> 
            			<table width="85%" border="0" cellspacing="1" cellpadding="0" align="center"> 
            				<tr> 
 								<td width="24%" class="NoiseDataTD"><?php if($campnomb["activicodigo"] == 1){$activicodigo = null; echo "*";}?>&nbsp;C&oacute;digo</td> 
							  <td width="76%"> <input name="activicodigo" type="text"	value="<?php if(!$flageditaractividades){ echo $sbreg[activicodigo];}else{ echo $activicodigo; }?>" size="20"></td> 
 							</tr>
 							<tr>
 								<td width="24%" class="NoiseDataTD"><?php if($flageditaractividades == 1 && !$clasecodigo){ echo "*";}?>&nbsp;Clase</td> 
 					  			<!--Clases-->
 					  			<td class="NoiseDataTD"><select name="clasecodigo">
		  						<?php
									if(!$flageditaractividades)
										$clasecodigo = $sbreg[clasecodigo];
									
			  						$clasecodigo1 = $clasecodigo;
			
									$idcon = fncconn();
									$result = fullscanclases($idcon);
											
									if($result > 0)
										$numReg = fncnumreg($result);
											
									if($numReg){
										for ($i=0;$i<$numReg;$i++){
											$arr=fncfetch($result,$i);

											if($arr[clasecodigo] != 0){
			    								echo '<option value ="'.$arr[clasecodigo].'" ';
			    										
		    									if($clasecodigo1 == $arr[clasecodigo])
		    										echo "selected";
			    									
			    								echo ">".$arr[clasenombre]."</option>"."\n";
											}
										}
									}
								?>
								</select></td>
							</tr>						
 							<tr> 
 								<td width="24%" class="NoiseDataTD"><?php if($campnomb["activinombre"] == 1){$activinombre = null; echo "*";}?>&nbsp;Actividad</td> 
							  <td width="76%"><textarea name="activinombre" cols="40"><?php if(!$flageditaractividades){ echo $sbreg[activinombre];}else{ echo $activinombre; }?></textarea></td> 
 							</tr> 
 							<tr>
 								<td width="24%" class="NoiseDataTD"><?php if($flageditaractividades == 1 && !$unidadcodigo){ echo "*";}?>&nbsp;Unidad</td> 
 					  			<!--unimedida-->
 					  			<td class="NoiseDataTD"><select name="unidadcodigo">
		  						<?php
									if(!$flageditaractividades)
										$unidadcodigo = $sbreg[unidadcodigo];
										
		  							$unidadcodigo1 = $unidadcodigo;
			
									$idcon = fncconn();
									$result = fullscanunimedida($idcon);
											
									if($result > 0)
										$numReg = fncnumreg($result);
											
									if($numReg){
										for ($i=0;$i<$numReg;$i++){
											$arr=fncfetch($result,$i);

											if($arr[unidadcodigo] != 0){
			    								echo '<option value ="'.$arr[unidadcodigo].'" ';
			    											
		    									if($unidadcodigo1 == $arr[unidadcodigo])
		    										echo "selected";
			    									
			    								echo ">".$arr[unidadnombre]."</option>"."\n";
											}
										}
									}
								?>
								</select></td>
							</tr>
 							<tr> 
 								<td width="24%" class="NoiseDataTD"><?php if($campnomb["activivalbar"] == 1){$activivalbar = null; echo "*";}?>&nbsp;Valor varemo</td> 
							  <td width="76%"><input type="text" name="activivalbar"	value="<?php if(!$flageditaractividades){ echo $sbreg[activivalbar];}else{ echo $activivalbar; }?>"></td> 
 							</tr> 
							<tr>
 								<td width="24%" class="NoiseDataTD"> <?php if($campnomb["actividescri"] == 1){ $actividescri=null;echo "*";}?>&nbsp;Descripci&oacute;n</td>
  								<td rowspan="2"><textarea name="actividescri" cols="40" rows="3" wrap="VIRTUAL"><?php if(!$flageditaractividades){echo $sbreg[actividescri];}else {echo $actividescri;}?></textarea></td>
 							</tr>
 							<tr class="NoiseDataTD"><td width="24%">&nbsp;</td>
 							</tr> 
						</table> 
  					</td> 
 				</tr> 
 				<tr> 
					<td> 
						<div align="center"> 
  							<input type="image" name="aceptar"  src="../img/aceptar.gif" onClick="form1.accioneditaractividades.value =  1;"  width="86" height="18" alt="Aceptar" border=0> 
  							<input type="image" name="cancelar" src="../img/cancelar.gif" onClick="form1.action='maestablactividades.php';"  width="86" height="18" alt="Cancelar" border=0> 
						</div> 
					</td> 
 				</tr> 
 				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr> 
		  </table> 
<?php if($campnomb){echo '<font face = "Verdana" >Corregir los campos marcados con *</font>';} ?> 
			<input type="hidden" name="accioneditaractividades"> 
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
			<input type="hidden" name="activicodigo1" value="<?php if(!$flageditaractividades){ echo $sbreg[activicodigo];}else{ echo $activicodigo1; }?>"> 
		</form> 
	</body> 
<?php if(!$codigo){ echo " -->"; } ?> 
</html> 
