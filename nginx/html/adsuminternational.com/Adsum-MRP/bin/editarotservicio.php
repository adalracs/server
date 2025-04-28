<?php
ob_start(); 

include ( '../src/FunGen/sesion/fncvalses.php');
include ( '../src/FunPerPriNiv/pktbltareot.php');
include ( '../src/FunPerPriNiv/pktblusuario.php');
include ( '../src/FunPerPriNiv/pktblclienteot.php');

include ( '../src/FunPerPriNiv/pktbldepartamento.php');
include ( '../src/FunPerPriNiv/pktblciudad.php');
include ( '../src/FunPerPriNiv/pktbltarea.php');
include ( '../src/FunPerPriNiv/pktblservicio.php');
include ( '../src/FunPerPriNiv/pktblotestado.php');
include ( '../src/FunPerPriNiv/pktblpriorida.php');
include ( '../src/FunPerPriNiv/pktblsegmentos.php');
include ( '../src/FunPerPriNiv/pktblsubsegmentos.php');

include ( '../src/FunGen/floadtimehours.php');
include ( '../src/FunGen/floadtimeminut.php');
//include('detallaclienteot.php');
	
if($accionnuevoclienteot){
	include ("editaotservicio.php");
}

if(!$flageditarclientot){ 
	include ( '../src/FunGen/sesion/fnccarga.php'); 
	$sbreg = fnccarga($nombtabl,$radiobutton); 
	
	if (!$sbreg){ 
		$nombtabl = "otservicio";
		include( '../src/FunGen/fnccontfron.php'); 
	} 
	include('detallaotservicio.php');
	$ordtracodigo = $sbreg[ordtracodigo];
	
} 


ob_end_flush();
?>
<html>
	<head>
		<title>Editar registro de ot servicio</title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		<meta http-equiv="expires" content="0">
		<link rel="stylesheet" type="text/css" href="temas/Noise/Style.css">
		<SCRIPT LANGUAGE="JavaScript">
			<!-- Begin
			agree = 0;
			//  End -->
		</script>
		<script language="JavaScript" src="motofech.js"></script>
		<SCRIPT language=JavaScript src="../src/FunGen/jsrsClient.js"		type="text/javascript" ></SCRIPT>
		<script language=JavaScript src="../src/FunGen/cargarCiudades.js" type="text/javascript" ></script>
		<script language=JavaScript src="../src/FunGen/cargarSubsegmentos.js" type="text/javascript" ></script>
		<style type="text/css">
		<!--
		.Estilo1 {
			color: #FFFFFF;
			font-weight: bold;
		}
		-->
		</style>
	</head>
<?php if(!$codigo){ echo "<!--";} ?>
	<body bgcolor="FFFFFF" text="#000000">
		<form name="form1" method="post"  enctype="multipart/form-data">
			<p><font class="NoiseFormHeaderFont">Orden de trabajo</font></p>
			<table width="565"  border="0" align="center" cellpadding="2" cellspacing="1" class="NoiseFormTABLE">
				<tr><td width="546" class="NoiseErrorDataTD">&nbsp;</td>
				</tr>
  				<tr><td class="NoiseFieldCaptionTD"><span class="style5"><font color="FFFFFF">Editar registro</font></span></td></tr>
				<tr>
					<td>
						<table width="99%" border="0" cellspacing="0" cellpadding="0" align="center">
							<tr><td colspan="2">
 								<table width="99%" border="0" cellspacing="1" cellpadding="0" align="center">
 								 	<tr>
										<td width="20%" class="NoiseFieldCaptionTD Estilo1">&nbsp;Numero OT</td>
										<td class="NoiseFieldCaptionTD Estilo1">&nbsp;<?php if(!$flageditarclientot){ echo $sbreg[ordtracodigo];}else{ echo $ordtracodigo; } ?></td>
										<td colspan="2">&nbsp;Fecha de creación:&nbsp;&nbsp;<?php if(!$flageditarclientot){ echo $annogen."-".$mesgen."-".$diagen."  ".$horgen.":".$minutogen; if($horagen > 12){ echo " p.m.";}else{ echo " a.m.";}}else{ echo $ordtrafechorgen; } ?> </td>
						 		  	</tr>
									<tr><td colspan="4" class="NoiseFieldCaptionTD Estilo1">&nbsp;Datos Basicos </td></tr>
							  		<tr>
										<td width="26%" class="NoiseFooterTD">&nbsp;<?php if($flageditarclientot && !$clientsolici){$clientsolici = null; echo "*";}?>Numero solicitud</td>
										<td colspan = "3"><input name="clientsolici" type="text" value="<?php if(!$flageditarclientot){ echo $sbregclienteot[clientsolici];}else{ echo $clientsolici; }?>" size="60"></td>
  									</tr>
									<tr>
										<td width="26%" class="NoiseFooterTD">&nbsp;<?php if($flageditarclientot && !$clientfecsol){$clientfecsol = null; echo "*";}?>Fecha solicitud</td>
										<td colspan="3">
											<input type="text" name="clientfecsol" size="12" value="<?php if(!$flageditarclientot){ echo $sbregclienteot[clientfecsol];}else{ echo $clientfecsol; }?>" onFocus="if (!agree)this.blur();">
										    	<img src="../img/cal.gif" border="0" onClick="window.open('formcalendario.php?calencodigo=clientfecsol','cal1','status=no,menubar=no,scrollbars=yes,resizable=yes,left=600,width=200,height=210');">
              										<select name="horini">
                										<?php
                											if(!$horini)
                												echo '<option value ="'.$horsol.'">'.$horsol.'</option>'."\n";
                												                											
				 								if($flageditarclientot)
				 									echo '<option value ="'.$horini.'">'.$horini.'</option>'."\n";
												floadtimehours();
				  							?>
   										  	</select>:<select name="minini">
                										<?php
                											if(!$minini)
                												echo '<option value ="'.$minuto.'">'.$minuto.'</option>'."\n";
                												
												if($flageditarclientot)
											 		echo '<option value ="'.$minini.'">'.$minini.'</option>'."\n";
				 								floadtimeminut();
					 						?>
            											</select>
            											<input type="checkbox" name="pasadmerini" <?php if($flageditarclientot){if($pasadmerini)echo "CHECKED";}else{if($hora > 11){echo "CHECKED";} }  ?>>&nbsp;p.m									  </td>
								  </tr>
            									<tr>
										<td width="26%" class="NoiseFooterTD">&nbsp;<?php if($flageditarclientot && !$clientfecco){$clientfecco = null; echo "*";}?>Fecha compromiso</td>
										<td colspan="3">
											<input type="text" name="clientfecco" size="12" value="<?php if(!$flageditarclientot){ echo $sbregclienteot[clientfecco];}else{ echo $clientfecco; }?>" onFocus="if (!agree)this.blur();">
										    	<img src="../img/cal.gif" border="0" onClick="window.open('formcalendario.php?calencodigo=clientfecco','cal1','status=no,menubar=no,scrollbars=yes,resizable=yes,left=600,width=200,height=210');">
              										<select name="horfin">
                										<?php
                											if(!$horfin)
                												echo '<option value ="'.$horco.'">'.$horco.'</option>'."\n";
                										
				 								if($flageditarclientot)
				 									echo '<option value ="'.$horfin.'">'.$horfin.'</option>'."\n";
												floadtimehours();
				  							?>
   										  	</select>:<select name="minfin">
                										<?php
                											if(!$minfin)
                												echo '<option value ="'.$minuto1.'">'.$minuto1.'</option>'."\n";
                												
												if($flageditarclientot)
											 		echo '<option value ="'.$minfin.'">'.$minfin.'</option>'."\n";
				 								floadtimeminut();
					 						?>
            											</select>
            											<input type="checkbox" name="pasadmerfin" <?php if($flageditarclientot){if($pasadmerfin)echo "CHECKED";}else{if($hora1 > 11){echo "CHECKED";} } ?>>&nbsp;p.m									  	</td>										
									</tr>
																		<tr>
										<td width="26%" class="NoiseFooterTD">&nbsp;<?php if($flageditarclientot && !$ordtrafecini){$ordtrafecini = null; echo "*";}?>Fecha inicio</td>
										<td colspan="3">
											<input type="text" name="ordtrafecini" size="12" value="<?php if(!$flageditarclientot){ echo $sbreg[tareotfecini];}else{ echo $ordtrafecini; }?>" onclick="window.open('formcalendario.php?calencodigo=ordtrafecini','cal1','status=no,menubar=no,scrollbars=yes,resizable=yes,left=600,width=200,height=210');" onFocus="if (!agree)this.blur();">
										    	<img src="../img/cal.gif" border="0" onClick="window.open('formcalendario.php?calencodigo=ordtrafecini','cal1','status=no,menubar=no,scrollbars=yes,resizable=yes,left=600,width=200,height=210');">
              										<select name="ordhorini">
                										<?php
                											if(!$ordhorini)
                												echo '<option value ="'.$horaordini.'">'.$horaordini.'</option>'."\n";
                										
				 								if($flageditarclientot)
				 									echo '<option value ="'.$ordhorini.'">'.$ordhorini.'</option>'."\n";
												floadtimehours();
				  							?>
   										  	</select>:<select name="ordminini">
                										<?php
                											if(!$ordminini)
                												echo '<option value ="'.$minutoini.'">'.$minutoini.'</option>'."\n";
												if($flageditarclientot)
											 		echo '<option value ="'.$ordminini.'">'.$ordminini.'</option>'."\n";
				 								floadtimeminut();
					 						?>
            											</select>
            											<input type="checkbox" name="pasordmerini" <?php if($flageditarclientot){if($pasordmerini)echo "CHECKED";}else{if($horaini > 11){echo "CHECKED";} } ?>>&nbsp;p.m									  	</td>										
									</tr>
									<tr>
										<td width="26%" class="NoiseFooterTD">&nbsp;<?php if($campnomb["clientnombre"] == 1){$clientnombre = null; echo "*";}?>Nombre cliente</td>
										<td colspan = "3"><input name="clientnombre" type="text" value="<?php if(!$flageditarclientot){ echo $sbregclienteot[clientnombre];}else{ echo $clientnombre; }?>" size="60"></td>
  									</tr>
									<tr>
										<td width="26%" class="NoiseFooterTD">&nbsp;<?php if($campnomb["clientdirecc"] == 1){$clientdirecc = null; echo "*";}?>Direccion</td>
										<td colspan = "3"><input name="clientdirecc" type="text" value="<?php if(!$flageditarclientot){ echo $sbregclienteot[clientdirecc];}else{ echo $clientdirecc; }?>" size="60"></td>
									</tr>
  									<tr>
  										<td class="NoiseFooterTD" width="26%">&nbsp;<?php if($campnomb["clienttelefo"] == 1){$clienttelefo = null; echo "*";}?>Telefono</td>
									  <td width="28%"><input type="text" name="clienttelefo" value="<?php if(!$flageditarclientot){ echo $sbregclienteot[clienttelefo];}else{ echo $clienttelefo; }?>"></td>
										<td class="NoiseFooterTD" width="19%">&nbsp;<?php if($campnomb["clientmovil"] == 1){$clientmovil = null; echo "*";}?>Movil</td>
									  <td width="27%"><input type="text" name="clientmovil" value="<?php if(!$flageditarclientot){ echo $sbregclienteot[clientmovil];}else{ echo $clientmovil; }?>"></td>
  									</tr>
									<tr>
										<td class="NoiseFooterTD" width="26%">&nbsp;<?php if($campnomb["clientcontac"] == 1){$clientcontac = null; echo "*";}?>Contacto</td>
										<td colspan = "3"><input name="clientcontac" type="text" value="<?php if(!$flageditarclientot){ echo $sbregclienteot[clientcontac];}else{ echo $clientcontac; }?>" size="60"></td> 
									</tr>
  									<tr>
  										<td class="NoiseFooterTD">&nbsp;<?php if($campnomb["clienttelcon"] == 1){$clienttelcon = null; echo "*";}?>Telefono contacto</td>
										<td><input type="text" name="clienttelcon" value="<?php if(!$flageditarclientot){ echo $sbregclienteot[clienttelcon];}else{ echo $clienttelcon; }?>"></td>
										<td class="NoiseFooterTD">&nbsp;<?php if($campnomb["clientcelcon"] == 1){$clientcelcon = null; echo "*";}?>Movil contacto</td>
										<td><input type="text" name="clientcelcon" value="<?php if(!$flageditarclientot){ echo $sbregclienteot[clientcelcon];}else{ echo $clientcelcon; }?>"></td>  									
  									</tr>
									<tr>
										<td class="NoiseFooterTD" width="26%">&nbsp;<?php if($campnomb["clientimplan"] == 1){$clientimplan = null; echo "*";}?>Implantador</td>
										<td colspan = "3"><input name="clientimplan" type="text" value="<?php if(!$flageditarclientot){ echo $sbregclienteot[clientimplan];}else{ echo $clientimplan; }?>" size="60"></td> 
									</tr>
  									 <tr class="NoiseFooterTD"><td colspan="4">&nbsp;<?php if($campnomb["clientdatcon"] == 1){$clientdatcon = null; echo "*";}?>Datos adicionales</td></tr>
  									 <tr>
  										<td colspan="4"><textarea name="clientdatcon" cols="70"><?php if(!$flageditarclientot){ echo $sbregclienteot[clientdatcon];}else{ echo $clientdatcon; }?></textarea></td>
  									</tr>
						  		</table>
 							</td>
 						</tr>
 						<tr>
							<td colspan="2">
								<table width="99%" border="0" cellspacing="1" cellpadding="0" align="center">
									
									<tr>
										<td width="22%" class="NoiseFooterTD">&nbsp;<?php if($campnomb["departamento"] == 1){$departamento = null; echo "*";}?>Departamento</td>
										<td width="35%"><select name="departamento" onChange="cargarCiudades(this.value);">
										<?php
											if(!$departamento)
												$departamento = $sbregclienteot[deptocodigo];
										
											$departamento1 = $departamento;
			
											$idcon = fncconn();
											$result = fullscandepartamento($idcon);
																
											if($result > 0)
												$numReg = fncnumreg($result);
																
											if($numReg){
												for ($i=0;$i<$numReg;$i++){
													$arr=fncfetch($result,$i);
					
													if($arr[deptocodigo] != 0){
								    						echo '<option value ="'.$arr[deptocodigo].'" ';
								    						
									    						if($departamento1 == $arr[deptocodigo])
									    							echo "selected";

								    					}	
								    					echo ">".$arr[deptonombre]."</option>"."\n";
												}
											}
										?>
					      	  		  </select></td>
  										<td width="14%" class="NoiseFooterTD">&nbsp;<?php if($flageditarclientot && !$ciudad){$ciudad = null; echo "*";}?>Ciudad</td>
										<td width="29%"><select name="ciudad">
										<?php
											if(!$ciudad)
												$ciudad = $sbregclienteot[ciudadcodigo];

											$ciudad1 = $ciudad;
																
											$idcon = fncconn();
											$iregCiudad[deptocodigo] = $departamento1;
											$iregCiudadop[deptocodigo] = "=";
											$result = dinamicscanopciudad($iregCiudad,$iregCiudadop,$idcon);
														
											if($result > 0)
												$numReg = fncnumreg($result);
																
											if($numReg){
												for ($i=0;$i<$numReg;$i++){
													$arr=fncfetch($result,$i);
															
													if($arr[ciudadcodigo] != 0){
								    						echo '<option value ="'.$arr[ciudadcodigo].'" ';

															if($ciudad1 == $arr[ciudadcodigo])
								    								echo "selected";

								    						echo ">".$arr[ciudadnombre]."</option>"."\n";
													}
												}
											}
										?>
									  </select></td>
									</tr>
																		</tr>
																		<tr>
										<td width="22%" class="NoiseFooterTD">&nbsp;<?php if($campnomb["segmencodigo"] == 1){$segmencodigo = null; echo "*";}?>Segmento</td>
										<td width="35%"><select name="segmencodigo" onChange="cargarSubsegmentos(this.value);"> 
										<?php
											if(!$segmencodigo)
												$ciudad = $sbregclienteot[segmencodigo];
											
											$segmencodigo1 = $segmencodigo;
											
			
											$idcon = fncconn();
											$result = fullscansegmentos($idcon);
																
											if($result > 0)
												$numReg = fncnumreg($result);
																
											if($numReg){
												for ($i=0;$i<$numReg;$i++){
													$arr=fncfetch($result,$i);
					
													if($arr[segmencodigo] != 0){
								    						echo '<option value ="'.$arr[segmencodigo].'" ';
								    						
								    								
									    						if($segmencodigo1 == $arr[segmencodigo])
									    							echo "selected";
								    						
								    					}	
								    					echo ">".$arr[segmennombre]."</option>"."\n";
												}
											}
										?>
					      	  		  </select></td>
  										<td width="14%" class="NoiseFooterTD">&nbsp;<?php if($flagnuevoclienteot && !$subsegcodigo){$subsegcodigo = null; echo "*";}?>Subsegmento</td>
										<td width="29%"><select name="subsegcodigo">
										<?php
											if(!$subsegcodigo)
												$ciudad = $sbregclienteot[segmencodigo];
										
										
											$subsegcodigo1 = $subsegcodigo;
											echo '<option value = "">Seleccione</option>';
																
											$idcon = fncconn();
											$iregsubsegmento[segmencodigo] = $segmencodigo1;
											$iregsubsegmentoop[segmencodigo] = "=";
											$result = dinamicscanopsubsegmentos($iregsubsegmento,$iregsubsegmentoop,$idcon);
														
											if($result > 0) 
												$numReg = fncnumreg($result);
																
											if($numReg){
												for ($i=0;$i<$numReg;$i++){
													$arr=fncfetch($result,$i);
															
													if($arr[subsegcodigo] != 0){
								    						echo '<option value ="'.$arr[subsegcodigo].'" ';
								    						if($flagnuevoclienteot){
															if($subsegcodigo1 == $arr[subsegcodigo])
								    								echo "selected";
								    						}
								    						echo ">".$arr[subsegnombre]."</option>"."\n";
													}
												}
											}
										?>
									  </select></td>
									</tr>
 									<tr >
										<td class="NoiseFooterTD">&nbsp;<?php if($flageditarclientot && !$tareacodigo){$tareacodigo = null; echo "*";}?>Tipo de orden</td>
										<td ><select name="tareacodigo">
										<?php
											if(!$tareacodigo)
												$tareacodigo = $sbreg[tareacodigo];
										
											$tipo_orden1 = $tareacodigo;

											$idcon = fncconn();			
											$result = fullscantarea($idcon);
											
											if($result > 0)
												$numReg = fncnumreg($result);
																
											if($numReg){
	        											for ($i=0;$i<$numReg;$i++){
                												$arr=fncfetch($result,$i);
                									
                												if($arr[tareacodigo] != 0){
                    													echo '<option value ="'.$arr[tareacodigo].'"';
                    									
			    												if($tipo_orden1 == $arr[tareacodigo])
			    													echo "selected";

                													echo ">".$arr[tareanombre]."</option>"."\n";		
													}
												}
											}
										?>
									      	</select></td>
										<td class="NoiseFooterTD">&nbsp;<?php if($flageditarclientot && !$servicicodigo){$servicicodigo = null; echo "*";}?>Servicio</td>
										<td><select name="servicicodigo">
									      	<?php
									      		if(!$servicicodigo)
												$servicicodigo = $sbreg[servicicodigo];
											
											$servicio1 = $servicicodigo;
                                            								
											$idcon = fncconn();
											$result = fullscanservicio($idcon);
											
											if($result > 0)
												$numReg = fncnumreg($result);
												
											if($numReg){
        												for ($i=0;$i<$numReg;$i++){
                												$arr=fncfetch($result,$i);

                												if($arr[servicicodigo] != 0){
                													echo '<option value ="'.$arr[servicicodigo].'"';
                    									
			    												if($servicio1 == $arr[servicicodigo])
			    													echo "selected";
			    													
           													echo ">".$arr[servicinombre]."</option>"."\n";                												
													}
												}
											}
										?>
										</select></td>
  									</tr>
									<tr>
										<td class="NoiseFooterTD">&nbsp;<?php if($flageditarclientot && !$prioricodigo){$prioricodigo = null; echo "*";}?>Prioridad</td>
										<td><select name="prioricodigo">
										<?php
											if(!$prioricodigo)
												$prioricodigo = $sbreg[prioricodigo];
										
                                            								$prioridad1 = $prioricodigo;

											$idcon = fncconn();														
											$result = fullscanpriorida($idcon);
											
											if($result > 0)
												$numReg = fncnumreg($result);											
																
											if($numReg){
        												for ($i=0;$i<$numReg;$i++){
                												$arr=fncfetch($result,$i);
                									
                												if($arr[prioricodigo] != 0){
                    													echo '<option value ="'.$arr[prioricodigo].'"';
                    									
            														if($prioridad1 == $arr[prioricodigo])
	    														echo "selected";
			    											
			    											echo ">".$arr[priorinombre]."</option>"."\n";
                												}		
												}
											}
										?>
									      	</select></td>
									</tr>
									<tr>
										<td width="22%" class="NoiseFooterTD">&nbsp;<?php if($campnomb["clientdirecb"] == 1){$clientdirecb = null; echo "*";}?>Direccion baja</td>
										<td colspan = "3"><input name="clientdirecb" type="text" value="<?php if(!$flageditarclientot){ echo $sbregclienteot[clientdirecb];}else{ echo $clientdirecb; }?>" size="60"></td>
									</tr>
									<tr>
										<td width="22%" class="NoiseFooterTD">&nbsp;<?php if($campnomb["clientdireca"] == 1){$clientdireca = null; echo "*";}?>Direccion alta</td>
										<td colspan = "3"><input name="clientdireca" type="text" value="<?php if(!$flageditarclientot){ echo $sbregclienteot[clientdireca];}else{ echo $clientdireca; }?>" size="60"></td>
									</tr>
							  	</table>
							</td>
						</tr>
						<tr><td colspan="5"><hr noshade></td></tr>
			 		</table> 	
			 	</td>
			</tr>
 			<tr>
				<td><div align="center">
  					<input type="image" name="aceptar"  src="../img/aceptar.gif" onClick="form1.accionnuevoclienteot.value=1;"  width="86" height="18" alt="Aceptar" border=0>
  					<input type="image" name="cancelar"  src="../img/cancelar.gif" onClick="form1.action='maestablotservicio.php';"  width="86" height="18" alt="Cancelar" border=0>
				</div></td>
 			</tr>
 			<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr>
	  	</table>
		<input type="hidden" name="ordtrafechorgen" value="<?php if(!$flageditarclientot){ echo $annogen."-".$mesgen."-".$diagen."  ".$horgen.":".$minutogen; if($horagen > 12){ echo " p.m.";}else{ echo " a.m.";}}else{ echo $ordtrafechorgen; } ?> ">
		<input type="hidden" name="accionnuevoclienteot">
		<input type="hidden" name="ordtracodigo" value="<?php if(!$flageditarclientot){ echo $sbreg[ordtracodigo];}else{ echo $ordtracodigo; } ?>"> 
		<input type="hidden" name="codigo" value="<?php echo $codigo; ?>">
	</form>
</body>
<?php	if(!$codigo){ echo " -->"; } ?>
</html>