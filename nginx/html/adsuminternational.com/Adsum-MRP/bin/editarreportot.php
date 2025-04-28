<?php
ob_start();
include ( '../src/FunGen/sesion/fncvalses.php');
//--
include ( '../src/FunPerPriNiv/pktblusuario.php');
include ( '../src/FunPerPriNiv/pktblot.php');
include ( '../src/FunPerPriNiv/pktblplanta.php');
include ( '../src/FunPerPriNiv/pktblequipo.php');
include ( '../src/FunPerPriNiv/pktblsistema.php');
include ( '../src/FunPerPriNiv/pktblcomponen.php');
include ( '../src/FunPerPriNiv/pktbltipomant.php');
include ( '../src/FunPerPriNiv/pktblotestado.php');
include ( '../src/FunPerPriNiv/pktblpriorida.php');
include ( '../src/FunPerPriNiv/pktbltipotrab.php');
include ( '../src/FunPerPriNiv/pktbltipocump.php');
include ( '../src/FunPerPriNiv/pktbltarea.php');
include ( '../src/FunGen/cargainput.php');
include ( '../src/FunGen/floadtimehours.php');
include ( '../src/FunGen/floadtimeminut.php');
//--
if($accioneditarreportot)
{ 
	
	include ( 'editareportot.php'); 
	$flageditarreportot = 1; 
}
ob_end_flush(); 

	$idcon = fncconn();
	$arrusr = loadrecordusuario($usuacodi, $idcon);
	$usrname = $arrusr["usuanombre"]." ".$arrusr["usuapriape"]." ".$arrusr["usuasegape"];
	fncclose($idcon);
	
	//if($radiobutton)
	//	$ordtracodigo = (str_replace("|n,","",$radiobutton));	
	
	
	
if(!$flageditarreportot) 
{ 
include ( '../src/FunGen/sesion/fnccarga.php'); 
$sbreg = fnccarga($nombtabl,$radiobutton); 

/*if($ordtracodigo){
	
		$idcon = fncconn();
		
		include_once '../src/FunPerPriNiv/pktblreportot.php';
		$irecOrden["ordtracodigo"] = $ordtracodigo;
		//$sbregReportot = dinamicscanreportot($irecOrden,$idcon);		
		
		if($sbregReportot > 0){
			echo "<script language='JavaScript'>";
			echo "alert('La Orden de trabajo se encuentra reportada');";
			echo "</script>";
		}else{
			$sbregot = loadrecordot($ordtracodigo,$idcon);
	
			if($sbregot < 0){
				echo "<script language='JavaScript'>";
				echo "alert('No se encontro la orden de trabajo');";
				echo "</script>";
			}else{
				include_once( '../src/FunPerPriNiv/pktbltareot.php');
				$sbregtareot =loadrecordmaxtareot2($sbregot[ordtracodigo],$idcon);
				
				if($sbregtareot > 0){
					$iRecordusertareot[tareotcodigo] = $sbregtareot[tareotcodigo]; 
					include ( '../src/FunPerPriNiv/pktblusuariotareot.php');
					$nuResult = dinamicscanusuariotareot($iRecordusertareot,$idcon);
					
					if($nuResult > 0){
						$nuCantRow = pg_numrows($nuResult);
						$j = 0;
						if ($nuCantRow > 0){
							for($i = 0; $i < $nuCantRow; $i++){						
								$sbRow = pg_fetch_row ($nuResult,$i);
								
								$user_ot = loadrecordusuario($sbRow[1], $idcon);
								$usrname1 = $sbRow[1]." - " .$user_ot["usuanombre"]." ".$user_ot["usuapriape"]." ".$user_ot["usuasegape"];
								if($sbRow[3] == 't'){
									$user_encargado = $usrname1;
								}else{
									$user_aux[$j] = $usrname1;
									$j++; 
								}
							}
						}
					}
				}
				$hora = array($sbregot["ordtrahorini"],$sbregot["ordtrahorfin"],$sbregot["ordtrahorgen"]);
				
				for($h = 0; $h < 3; $h++){
					$horgen = explode(":",$hora[$h]);	
					
					if($horgen[0] > 12)
						$horaorden[$h] = ($horgen[0] - 12).":".$horgen[1]." p.m."; 
					elseif($horgen[0] == 12)
						$horaorden[$h] = $horgen[0].":".$horgen[1]." p.m."; 
					elseif($horgen[0] < 12 && $horgen[0] > 0 )
						$horaorden[$h] = ($horgen[0] + 0).":".$horgen[1]." a.m.";
					elseif($horgen[0] == '00' )
						$horaorden[$h] = "12:".$horgen[1]." a.m.";	
				}
			}
		}*/
	}
if (!$sbreg) 
	{ 
		include( '../src/FunGen/fnccontfron.php'); 
	} 
	$idcon = fncconn();
	$vartipomant = $sbreg[tipmancodigo];
	$arrtipomant= loadrecordtipomant($vartipomant,$idcon);
	$codtipomant = $sbreg[tipmancodigo];

	$varpriorida = $sbreg[prioricodigo];
	$arrpriorida= loadrecordpriorida($varpriorida,$idcon);
	$codpriorida = $sbreg[prioricodigo];
	
	$vartipotrab = $sbreg[tiptracodigo];
	$arrtipotrab= loadrecordtipotrab($vartipotrab,$idcon);
	$codtipotrab = $sbreg[tiptracodigo];

	$vartarea = $sbreg[tareacodigo];
	$arrtarea= loadrecordtarea($vartarea,$idcon);
	$codtarea = $sbreg[tareacodigo];
	if ($sbreg["ordtracodigo"] && $ordtracodigo==null) {
		$sbregot = loadrecordot($sbreg["ordtracodigo"],$idcon);
	}
	else {
		$sbregot = loadrecordot($ordtracodigo,$idcon);
	}
	 
	include_once( '../src/FunPerPriNiv/pktbltareot.php');
				//$sbregtareot =loadrecordmaxtareot2($sbregot[ordtracodigo],$idcon);
				
				$sbregtareot =loadrecordtareot2($sbregot[ordtracodigo],$idcon);
				
				if($sbregtareot > 0){
					$iRecordusertareot[tareotcodigo] = $sbregtareot[tareotcodigo]; 
					include ( '../src/FunPerPriNiv/pktblusuariotareot.php');
					$nuResult = dinamicscanusuariotareot($iRecordusertareot,$idcon);
					
					if($nuResult > 0){
						$nuCantRow = pg_numrows($nuResult);
						$j = 0;
						if ($nuCantRow > 0){
							for($i = 0; $i < $nuCantRow; $i++){						
								$sbRow = pg_fetch_row ($nuResult,$i);
								
								$user_ot = loadrecordusuario($sbRow[1], $idcon);
								$usrname1 = $sbRow[1]." - " .$user_ot["usuanombre"]." ".$user_ot["usuapriape"]." ".$user_ot["usuasegape"];
								if($sbRow[3] == 't'){
									$user_encargado = $usrname1;
								}else{
									$user_aux[$j] = $usrname1;
									$j++; 
								}
							}
						}
					}
				}
				$hora = array($sbregot["ordtrahorini"],$sbregot["ordtrahorfin"],$sbregot["ordtrahorgen"]);
				
				for($h = 0; $h < 3; $h++){
					$horgen = explode(":",$hora[$h]);	
					
					if($horgen[0] > 12)
						$horaorden[$h] = ($horgen[0] - 12).":".$horgen[1]." p.m."; 
					elseif($horgen[0] == 12)
						$horaorden[$h] = $horgen[0].":".$horgen[1]." p.m."; 
					elseif($horgen[0] < 12 && $horgen[0] > 0 )
						$horaorden[$h] = ($horgen[0] + 0).":".$horgen[1]." a.m.";
					elseif($horgen[0] == '00' )
						$horaorden[$h] = "12:".$horgen[1]." a.m.";	
				}
	

?> 
<html>
	<head>
		<title>Nuevo registro de reporte de orden de trabajo</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0"> 
		<link rel="stylesheet" type="text/css" href="temas/Noise/Style.css">
		<link rel="stylesheet" type="text/css" href="temas/Noise/help.css"> 
		<script language="JavaScript" src="../src/FunGen/cargarEmpleaselec.js" type="text/javascript" ></script>
		<script language="JavaScript" src="../src/FunGen/jsrsClient.js" type="text/javascript" ></script>
		<script language=JavaScript src="../src/FunGen/ajxGenListas.js" type="text/javascript" ></script>		
		<SCRIPT LANGUAGE="JavaScript"> 
			<!-- Begin 
			agree = 0; 
			//  End --> 
		</script> 
	</head> 
<?php if(!$codigo) { echo "<!--";} ?> 
	<body bgcolor="FFFFFF" text="#000000" onblur = "document.form1.flaglistas.value=1;" onfocus = "loadlist();"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Reporte de ordenes de trabajo</font></p> 
			<table border="0" cellspacing="1" cellpadding="2" align="center" class="NoiseFormTABLE" width="80%"> 
				<tr><td class="NoiseErrorDataTD">&nbsp;</td> </tr> 
  				<tr><td class="NoiseFieldCaptionTD"><span class="style5"><font color="FFFFFF">Ingresar nuevo registro</font></span></td></tr>
				<tr>
 					<td>
						<table width="95%" border="0" cellspacing="1" cellpadding="0" align="center" onmousemove="loadlist();">
    							<tr>
								<td colspan="2"><?php if($campnomb["ordtracodigo"] == 1)echo "*";?>
									<a href="javascript:document.form1.submit();" onclick="document.form1.submit();">No. Orden de trabajo</a> 
									<input type="text" name="ordtracodigo"  size="13" value="<?php if(!$flageditarreportot){ echo $sbregot[ordtracodigo];}else{ echo $ordtracodigo; }?>" >
								</td>	
									<td colspan="2">Fecha | Hora ::&nbsp;<?php echo $sbregot[ordtrafecgen]." | ".$horaorden[2]; ?> </td>	
							</tr>
							<tr><td class="NoiseErrorDataTD" colspan="4"></td></tr> 
							<tr><td class="NoiseFieldCaptionTD" colspan="4"></td></tr> 
							<tr><td class="NoiseErrorDataTD" colspan="4"></td></tr>
							<tr>
								<td width="15%" class="NoiseFooterTD">&nbsp;Planta</td>
								<td colspan="3" class="NoiseErrorDataTD"><?php  echo cargaplantanombre( $sbregot[plantacodigo],$idcon ); ?></td>
							</tr>
							<tr>
								<td width="15%" class="NoiseFooterTD">&nbsp;Sistema</td>
								<td colspan="3" class="NoiseErrorDataTD"><?php  echo cargasistemnombre($sbregot[sistemcodigo],$idcon ); ?></td>
							</tr>
							<tr>
								<td width="15%" class="NoiseFooterTD">&nbsp;Equipo</td>
								<td colspan="3" class="NoiseErrorDataTD"><?php  echo cargaequiponombre($sbregot[equipocodigo],$idcon); ?></td>
							</tr>
							<tr>
								<td width="15%" class="NoiseFooterTD">&nbsp;Componente</td>
								<td colspan="3" class="NoiseErrorDataTD"><?php  echo cargacomponnombre($sbregot[componcodigo],$idcon); ?></td>
							</tr>
							<tr><td class="NoiseErrorDataTD" colspan="4"></td></tr> 
							<tr><td class="NoiseFieldCaptionTD" colspan="4"></td></tr> 
							<tr><td class="NoiseErrorDataTD" colspan="4"></td></tr>
							<tr>
								<td width="15%" class="NoiseFooterTD">&nbsp;Mantenimiento</td>
								<td width="35%" class="NoiseErrorDataTD"><?php  echo cargatipmannombre($sbregot[ordtracodigo],$idcon); ?></td>
								<td width="15%" class="NoiseFooterTD">&nbsp;Prioridad</td>
								<td width="35%" class="NoiseErrorDataTD"><?php  echo cargapriorinombre($sbregtareot[prioricodigo],$idcon); ?></td>
							</tr>	
							<tr>
								<td width="15%" class="NoiseFooterTD">&nbsp;Tarea</td>
								<td colspan="3" class="NoiseErrorDataTD"><?php  if ($sbregot[ordtracodigo]!=null) echo cargatareanombre($sbregot[ordtracodigo],$idcon); ?></td>
							</tr>							
							<tr>
								<td width="15%" class="NoiseFooterTD">&nbsp;Tipo de trabajo</td>
								<td colspan="3" class="NoiseErrorDataTD"><?php echo cargadetalleprogtiptrab($sbregtareot[tiptracodigo],$idcon); ?></td>
							</tr>

							</tr>
							<tr><td class="NoiseErrorDataTD" colspan="4"></td></tr> 
							<tr><td class="NoiseErrorDataTD" colspan="4"></td></tr>
							<tr>
								<td width="15%" class="NoiseFooterTD">&nbsp;Fecha de inicio</td>
								<td width="35%" class="NoiseErrorDataTD"><?php echo $sbregot[ordtrafecini]; ?>&nbsp;aaaa-mm-dd</td>
								<td width="15%" class="NoiseFooterTD">&nbsp;Hora inicio</td>
								<td width="35%" class="NoiseErrorDataTD"><?php echo $horaorden[0]; ?></td>
							</tr>
							<tr>
								<td width="15%" class="NoiseFooterTD">&nbsp;Fecha de fin</td>
								<td width="35%" class="NoiseErrorDataTD"><?php echo $sbregot[ordtrafecfin]; ?>&nbsp;aaaa-mm-dd</td>
								<td width="15%" class="NoiseFooterTD">&nbsp;Hora fin</td>
								<td width="35%" class="NoiseErrorDataTD"><?php  echo $horaorden[1]; ?></td>
							</tr>
							<tr><td class="NoiseErrorDataTD" colspan="4"></td></tr> 
							<tr><td class="NoiseFieldCaptionTD" colspan="4"></td></tr> 
							<tr><td class="NoiseErrorDataTD" colspan="4"></td></tr>
							<tr><td class="NoiseErrorDataTD" colspan="4"></td></tr>
							<tr><td colspan="4" class="NoiseSeparatorTD">Empleado de mantenimiento&nbsp;&nbsp;&nbsp;</td></tr>
							<tr>
								<td width="15%" class="NoiseFooterTD">Encargado</td>
								<td colspan="3" class="NoiseErrorDataTD"><?php echo $user_encargado; ?></td>
							</tr>
							<tr><td class="NoiseErrorDataTD" colspan="4"></td></tr>
							<tr>
								<td width="15%" class="NoiseFooterTD" rowspan="<?php echo count($user_aux); ?>">Auxiliar</td>
								<td colspan="3" class="NoiseDataTD" ><?php echo $user_aux[0]; ?></td>
							</tr>
	    			                                    	<?php
	    			                                    		for($i = 1; $i <= count($user_aux);$i++ ){
										echo '<tr>'."\n";
										echo '<td colspan="3" class="NoiseDataTD" >'.$user_aux[$i].'</td>'."\n";
										echo '</tr>'."\n";
	    			                                    		}
							?>
							<tr><td class="NoiseErrorDataTD" colspan="4"></td></tr> 
							<tr><td class="NoiseFieldCaptionTD" colspan="4"></td></tr> 
							<tr><td class="NoiseFieldCaptionTD" colspan="4"></td></tr> 
							<tr><td class="NoiseErrorDataTD" colspan="4"></td></tr>
							<tr>
								<td colspan="4" class="NoiseFooterTD"><?php if($campnomb["reportfecha"] == 1){$ordtrafecini = null; echo "*";}?>&nbsp;Fecha de reporte&nbsp;&nbsp;
				  					<input type="text" name="reportfecha" size="8" value="<?php if(!$flageditarreportot){echo $reportfecha=date("Y-m-d");} else {echo $reportfecha;}?>" onFocus="if (!agree)this.blur();">&nbsp;
	              							<img src="../img/cal.gif" align="absmiddle" border="0" onClick="window.open('formcalendario.php?calencodigo=reportfecha','cal1','status=no,menubar=no,scrollbars=yes,resizable=yes,left=600,width=200,height=210');">
	              							<select name="horini">
	                							<?php
					 					if(!$flagnuevoot){
	  										$horini = date("h");
		  									if(date("a") == 'pm')
	  											$pasadmerini = 1;
					 						//echo '<option value ="'.$horini.'">'.$horini.'</option>'."\n";
					 					}				 		
										floadtimehours($horini);
					  				?>
	                							</select>
		            							:
		            							<select name="minini">
		                							<?php
											if(!$flagnuevoot){
												$minini = date("i");
						 						//echo '<option value ="'.$minini.'">'.$minini.'</option>'."\n";
											}
						 					floadtimeminut($minini);
						 				?>
		            							</select>
		            							<input type="checkbox" name="pasadmerini" <?php if($flageditarreportot){if($pasadmerini)echo "CHECKED";}else{if($pasadmerini)echo "CHECKED";}?>>p.m
								</td>
							</tr>	
							<tr><td class="NoiseFieldCaptionTD" colspan="4"></td></tr> 
							<tr><td class="NoiseErrorDataTD" colspan="4"></td></tr>
							<tr>
								<td  class="NoiseFooterTD"><?php if($campnomb["tipmancodigo"] == 1){$tipmancodigo = null; echo "*";}?>&nbsp;Mantenimiento</td>
								<td class="NoiseFooterTD"><font id="tipmancodigo"><select name="tipmancodigo">
									<?php
							 		if(!$flageditarreportot)
		  								$tipmancodigo = $sbreg["tipmancodigo"];

			  															
			  						echo '<option value="">-- Seleccione --</option>';
									
									include ('../src/FunGen/floadtipomant.php');
									$idcon = fncconn();
									floadtipomant($tipmancodigo,$idcon);
									fncclose($idcon);
								?>
									</select></font>
								</td>
          						<td class="NoiseFooterTD"><?php if($campnomb["tiptracodigo"] == 1){$tiptracodigo = null; echo "*";}?>&nbsp;Tipo de trabajo</td>
								<td class="NoiseFooterTD"><font id="tiptracodigo"><select name="tiptracodigo">
		            						<?php
	            							if(!$flageditarreportot)
		  								$tiptracodigo = $sbreg[tiptracodigo];

									echo '<option value = "">-- Seleccione --</option>';

									include ('../src/FunGen/floadtipotrab.php');
									$idcon = fncconn();
									floadtipotrab($tiptracodigo,$idcon);
									fncclose($idcon);
								?>
          									</select></font>
          								</td>
							</tr>
							<tr>
		  						<td class="NoiseFooterTD"><?php if($campnomb["tareacodigo"] == 1){ echo $tareacodigo = null; echo "*";}?>&nbsp;Tarea</td>
		  						<td class="NoiseFooterTD"><font id="tareacodigo"><select name="tareacodigo">
									<?php
									if(!$flageditarreportot)
		  								$tareacodigo = $sbreg["tareacodigo"];
								
									echo '<option value = "">-- Seleccione --</option>';
									
									include ('../src/FunGen/floadtarea.php');
									$idcon = fncconn();
									floadtarea($tareacodigo,$idcon);
									fncclose($idcon);
								?>
	          								</select></font>
          								</td>							
  								<td  class="NoiseFooterTD"><?php if($campnomb["prioricodigo"] == 1){$prioricodigo = null; echo "*";}?>&nbsp;Prioridad</td>
  								<td class="NoiseFooterTD"><font id="prioricodigo"><select name="prioricodigo">
									<?php
							 		if(!$flageditarreportot)
		  								$prioricodigo = $sbreg["prioricodigo"];
			  															
			  						echo '<option value="">-- Seleccione --</option>';

									include ('../src/FunGen/floadpriorida.php');
									$idcon = fncconn();
									floadpriorida($prioricodigo, $idcon);
									fncclose($idcon);
								?>
									</select></font>
								</td>
							</tr>
  							<tr>
   								<td class="NoiseFooterTD" valign="top"><?php if($campnomb["reportdescri"] == 1){$reportdescri = null; echo "*";}?>&nbsp;Descripci&oacute;n</td>
								<td colspan="3" class="NoiseFooterTD"><textarea cols="65" rows="3" name="reportdescri"><?php   if($flageditarreportot){ echo $sbreg[reportdescri];   } echo $sbreg[reportdescri];   ?></textarea></td>
  							</tr>
						</table>
					</td>
				</tr> 
				<tr>
					<td><div align="center"> 
  						<input type="image" name="aceptar"  src="../img/aceptar.gif" onclick="form1.accioneditarreportot.value = 1;" width="86" height="18" alt="Aceptar" border=0>
  						<input type="image" name="cancelar" src="../img/cancelar.gif" onclick="form1.action='maestablreportot.php';"  width="86" height="18" alt="Cancelar" border=0>
					</div></td> 
 				</tr> 
 				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr> 
			</table> 
<?php if($campnomb){echo '<font face = "Verdana" >Corregir los campos marcados con *</font>';} ?> 
			<input type="hidden" name="reportcodigo" value="<?php if(!$flageditarreportot){ echo $sbreg[reportcodigo];}else{ echo $reportcodigo; } ?>">
			<input type="hidden" name="accioneditarreportot">
			<input type="hidden" name="flaglistas" value="0">

			<input type="hidden" name="ordtrafecini" value="<?php echo $sbregot["ordtrafecini"];?>">
			<input type="hidden" name="ordtrahorini" value="<?php echo $sbregot["ordtrahorini"];?>">
			
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>">
			<input type="hidden" name="nombtabl" value="<?php echo $nombtabl; ?>"> 
			<input type="hidden" name="radiobutton" value="<?php echo $radiobutton; ?>"> 
			
			<input type="hidden" name="reporttiedur" value="<?php if(!$flageditarreportot){echo $sbreg[reporttiedur];}else{ echo $reporttiedur; }?>">
		</form>
	</body>
<?php if(!$codigo){ echo " -->"; } ?>
</html>