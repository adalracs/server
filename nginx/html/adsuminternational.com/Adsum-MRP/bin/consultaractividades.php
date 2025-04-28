<?php 
include ( '../src/FunGen/sesion/fncvalses.php'); 
include ('../src/FunPerPriNiv/pktblclases.php');
include ('../src/FunPerPriNiv/pktblunimedida.php');
?> 
<!-- Propiedad intelectual de Adsum SA (c) 
-Todos los derechos reservados- 
Creado con WAG Adsum 
Autor: Andr�s A. Riascos D. 
Fecha: 26052004 
GenVers: 3.1 --> 
<html> 
	<head> 
		<title>Consultar actividad</title> 
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
			<table width="350" border="0" align="center" cellpadding="0" cellspacing="0" class="NoiseFormTABLE"> 
  			<tr><td width="300" class="NoiseErrorDataTD">&nbsp;</td></tr> 
  			<tr><td class="NoiseFieldCaptionTD"><span class="style5"><font color="FFFFFF"> Consultar registro</font></span></td></tr> 
			<tr> 
  				<td> 
            		<table width="85%" border="0" cellspacing="1" cellpadding="0" align="center"> 
            			<tr> 
 							<td width="41%" class="NoiseDataTD">&nbsp;C&oacute;digo</td> 
 							<td width="59%"> <input type="text" name="activicodigo"	value="<?php if(!$flagnuevoactividades){ echo $sbreg[activicodigo];}else{ echo $activicodigo; }?>"></td> 
 						</tr>
						<tr>
 							<td width="41%" class="NoiseDataTD">&nbsp;Clase</td> 
 					  		<!--Clases-->
 					  		<td class="NoiseDataTD"><select name="clasecodigo">
		  					<?php
								$clasecodigo1 = $clasecodigo;
								echo '<option value = "">Seleccione</option>';

								$idcon = fncconn();
								$result = fullscanclases($idcon);
											
								if($result > 0)
									$numReg = fncnumreg($result);
											
								if($numReg){
									for ($i=0;$i<$numReg;$i++){
										$arr=fncfetch($result,$i);

										if($arr[clasecodigo] != 0){
			    							echo '<option value ="'.$arr[clasecodigo].'" ';
			    									
			    							if($flagnuevoactividades){
			    								if($clasecodigo1 == $arr[clasecodigo])
			    									echo "selected";
			    							}	
			    							echo ">".$arr[clasenombre]."</option>"."\n";
										}
									}
								}
								?>
								</select></td>
							</tr>
							<tr> 
 								<td width="41%" class="NoiseDataTD">&nbsp;Actividad</td> 
 								<td width="59%"><input type="text" name="activinombre"	value="<?php if(!$flagnuevoactividades){ echo $sbreg[activinombre];}else{ echo $activinombre; }?>"></td> 
 							</tr> 
							<tr>
 								<td width="41%" class="NoiseDataTD">&nbsp;Unidad</td> 
 					  			<!--unimedida-->
 					  			<td class="NoiseDataTD"><select name="unidadcodigo">
		  						<?php
									$unidadcodigo1 = $unidadcodigo;
									echo '<option value = "">Seleccione</option>';
			
									$idcon = fncconn();
									$result = fullscanunimedida($idcon);
											
									if($result > 0)
										$numReg = fncnumreg($result);
											
									if($numReg){
										for ($i=0;$i<$numReg;$i++){
											$arr=fncfetch($result,$i);

											if($arr[unidadcodigo] != 0){
			    								echo '<option value ="'.$arr[unidadcodigo].'" ';
			    										
			    								if($flagnuevoactividades){
			    									if($unidadcodigo1 == $arr[unidadcodigo])
			    										echo "selected";
			    								}	
			    								echo ">".$arr[unidadnombre]."</option>"."\n";
											}
										}
									}
								?>
								</select></td>
							</tr>
							<tr> 
 								<td width="41%" class="NoiseDataTD">&nbsp;Valor varemo</td> 
 								<td width="59%"><input type="text" name="activivalbar"	value="<?php if(!$flagnuevoactividades){ echo $sbreg[activivalbar];}else{ echo $activivalbar; }?>"></td> 
 							</tr> 
							<tr>
 								<td width="41%" class="NoiseDataTD">&nbsp;Descripci&oacute;n</td>
  								<td rowspan="2"><textarea name="actividescri" rows="3" wrap="VIRTUAL"><?php if(!$flagnuevoactividades){echo $sbreg[actividescri];}else {echo $actividescri;}?></textarea></td>
 							</tr>
 							<tr class="NoiseDataTD"><td width="41%">&nbsp;</td></tr> 
						</table> 
  					</td> 
 				</tr> 
 				<tr> 
					<td> 
						<div align="center"> 
  							<input type="image" name="aceptar"  src="../img/aceptar.gif" onclick="form1.accionconsultaractividades.value = 1;form1.action='maestablactividades.php';"  width="86" height="18" alt="Aceptar" border=0> 
  							<input type="image" name="cancelar" src="../img/cancelar.gif" onclick="form1.action='maestablactividades.php';"  width="86" height="18" alt="Cancelar" border=0> 
						</div> 
					</td> 
 				</tr> 
 				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr> 
			</table> 
 			<input type="hidden" name="flagconsultaractividades" value="1"> 
			<input type="hidden" name="accionconsultaractividades"> 
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
			<input type="hidden" name="columnas" value="activicodigo, 
activinombre,
actividescri,
activivalbar,
clasecodigo,
unidadcodigo
"> 
			<input type="hidden" name="nombtabl" value="actividades"> 
		</form> 
	</body> 
<?php if(!$codigo){ echo " -->"; } ?> 
</html> 
