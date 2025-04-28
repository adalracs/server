<?php
ob_start(); 

include ( '../src/FunGen/sesion/fncvalses.php');
include ( '../src/FunPerPriNiv/pktbltareot.php');
include ( '../src/FunPerPriNiv/pktblusuario.php');
include('../src/FunPerPriNiv/pktbldepartamento.php');
include('../src/FunPerPriNiv/pktblciudad.php');
include ( '../src/FunPerPriNiv/pktbltarea.php');
include ( '../src/FunPerPriNiv/pktblservicio.php');
include ( '../src/FunPerPriNiv/pktblpriorida.php');
include ( '../src/FunPerPriNiv/pktblsegmentos.php');
include ( '../src/FunPerPriNiv/pktblsubsegmentos.php');

include ( '../src/FunGen/floadtimehours.php');
include ( '../src/FunGen/floadtimeminut.php');
//include('detallaclienteot.php');

if($accionnuevoclienteot){
	include ("grabaproyotservicio.php");
}

ob_end_flush();
?>
<html>
	<head>
		<title>Nuevo registro de OT Proyecto</title>
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
		<script language=JavaScript src="../src/FunGen/cargarCiudad.js" type="text/javascript" ></script>
		<script language=JavaScript src="../src/FunGen/cargarSubsegmentos.js" type="text/javascript" ></script>
		<script type='text/JavaScript'>
			 function verocultar(cual) {
			      var c=cual.nextSibling;
			      if(c.style.display=='none') {
			           c.style.display='block';
			      } else {
			           c.style.display='none';
			      }
			      return false;
			 }
			     
		     
		     	function load_datalistact(){
				document.all("lista_actividades").src="detallaractividadcierre.php?arr_actividades="+ form1.arr_actividades.value + "&arreglo_act=" + window.document.form1.arreglo_act.value;
			}
			function load_datalistitem(){
				document.all("lista_items").src="detallaritemcierre.php?arr_items="+ form1.arr_items.value + "&arreglo_ite=" + window.document.form1.arreglo_ite.value;
			}
			function load_detall( index, arr_detall){
				if(index == 0){
					window.document.form1.arr_actividades.value = arr_detall;
					document.all("lista_actividades").src="detallaractividadcierre.php?arr_actividades="+ window.document.form1.arr_actividades.value + "&arreglo_act=" + window.document.form1.arreglo_act.value;
				}else{
					window.document.form1.arr_items.value = arr_detall;
					document.all("lista_items").src="detallaritemcierre.php?arr_items="+ window.document.form1.arr_items.value + "&arreglo_ite=" + window.document.form1.arreglo_ite.value;
				}
			}
		</script>
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
			<p><font class="NoiseFormHeaderFont">Orden de Proyecto</font></p>
			<table width="810"  border="0" align="center" cellpadding="2" cellspacing="1" class="NoiseFormTABLE">
				<tr><td width="802" class="NoiseErrorDataTD">&nbsp;</td>
				</tr>
  				<tr><td class="NoiseFieldCaptionTD"><span class="style5"><font color="FFFFFF">Ingresar nuevo registro</font></span></td></tr>
				<tr>
					<td>
						<table width="99%" border="0" cellspacing="0" cellpadding="0" align="center">
 							<tr>
								  <td width="22%" class="NoiseSeparatorTD">&nbsp;Fecha / Hora</td>
	  								<td width="50%" class="NoiseSeparatorTD" align="left"><?php $fecha=date("Y-m-d");echo $fecha; ?> / <?php $horainicial= date("H:i"); echo $horainicial; ?></td>
	  								<!--<td width="28%" class="NoiseSeparatorTD" align="right"><A HREF="ingrnuevotservicio.php?codigo=<?php echo $codigo; ?>"  onclick="window.open('maestablcargadatos.php?codigo=<?php echo $codigo;?>','','status=no,menubar=no,scrollbars=yes,resizable=yes,left=300,width=700,height=300');" >Cargar orden de trabajo</A></td>-->
				 		  	</tr>
							<tr><td colspan="3">
 								<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center">
									<tr><td colspan="4" class="NoiseFieldCaptionTD Estilo1">&nbsp;Datos Basicos </td></tr>
							  		<tr>
										<td width="15%" class="NoiseFooterTD">&nbsp;<?php if($flagnuevoclienteot && !$clientsolici){$clientsolici = null; echo "*";}?>Numero solicitud</td>
										<td colspan = "3"><input name="clientsolici" type="text" value="<?php if(!$flagnuevoclienteot){ echo $sbreg[clientsolici];}else{ echo $clientsolici; }?>" size="60" ></td>
  									</tr>
									<tr>
										<td colspan="4">
											<table width="100%" align="center" cellspacing="1" cellpadding="0">
												<tr>
													<td width="15%" class="NoiseFooterTD">&nbsp;<?php if($flagnuevoclienteot && !$clientfecsol){$clientfecsol = null; echo "*";}?>Fecha solicitud</td>
													<td>
														<input type="text" name="clientfecsol" size="8" value="<?php if(!$flagnuevoclienteot){ echo $sbreg[clientfecsol];}else{ echo $clientfecsol; }?>" onClick="window.open('formcalendario.php?calencodigo=clientfecsol','cal1','status=no,menubar=no,scrollbars=yes,resizable=yes,left=600,width=200,height=210');"" onFocus="if (!agree)this.blur();">
										    				<img src="../img/cal.gif" border="0" onClick="window.open('formcalendario.php?calencodigo=clientfecsol','cal1','status=no,menubar=no,scrollbars=yes,resizable=yes,left=600,width=200,height=210');">
			              										<select name="horini">
			                										<?php
							 								if($flagnuevoclienteot)
							 									echo '<option value ="'.$horini.'">'.$horini.'</option>'."\n";
															floadtimehours();
							  							?>
			   										  	</select>:<select name="minini">
			                										<?php
															if($flagnuevoclienteot)
														 		echo '<option value ="'.$minini.'">'.$minini.'</option>'."\n";
							 								floadtimeminut();
								 						?>
			            										</select>
			            										<input type="checkbox" name="pasadmerini" <?php if($flagnuevoclienteot){if($pasadmerini)echo "CHECKED";}?>>&nbsp;p.m									  
            									  </td>
													<td width="15%" class="NoiseFooterTD">&nbsp;<?php if($flagnuevoclienteot && !$clientfecco){$clientfecco = null; echo "*";}?>Fecha compromiso</td>
													<td>
															<input type="text" name="clientfecco" size="8" value="<?php if(!$flagnuevoclienteot){ echo $sbreg[clientfecco];}else{ echo $clientfecco; }?>" onClick="window.open('formcalendario.php?calencodigo=clientfecco','cal1','status=no,menubar=no,scrollbars=yes,resizable=yes,left=600,width=200,height=210');"" onFocus="if (!agree)this.blur();">
										    					<img src="../img/cal.gif" border="0" onClick="window.open('formcalendario.php?calencodigo=clientfecco','cal1','status=no,menubar=no,scrollbars=yes,resizable=yes,left=600,width=200,height=210');">
              														<select name="horfin">
				                										<?php
								 								if($flagnuevoclienteot)
								 									echo '<option value ="'.$horfin.'">'.$horfin.'</option>'."\n";
																floadtimehours();
								  							?>
				   										  	</select>:<select name="minfin">
				                										<?php
																if($flagnuevoclienteot)
															 		echo '<option value ="'.$minfin.'">'.$minfin.'</option>'."\n";
								 								floadtimeminut();
									 						?>
            														</select>
            														<input type="checkbox" name="pasadmerfin" <?php if($flagnuevoclienteot){if($pasadmerfin)echo "CHECKED";}?>>&nbsp;p.m									  	
   												  </td>										
												</tr>
												<tr>
													<td width="15%" class="NoiseFooterTD">&nbsp;<?php if($flagnuevoclienteot && !$ordtrafecini){$ordtrafecini = null; echo "*";}?>Fecha inicio</td>
													<td>
														<input type="text" name="ordtrafecini" size="8" value="<?php if(!$flagnuevoclienteot){ echo $sbreg[ordtrafecini];}else{ echo $ordtrafecini; }?>" onClick="window.open('formcalendario.php?calencodigo=ordtrafecini','cal1','status=no,menubar=no,scrollbars=yes,resizable=yes,left=600,width=200,height=210');" onFocus="if (!agree)this.blur();">
									    					<img src="../img/cal.gif" border="0" onClick="window.open('formcalendario.php?calencodigo=ordtrafecini','cal1','status=no,menubar=no,scrollbars=yes,resizable=yes,left=600,width=200,height=210');">
			              										<select name="ordhorini">
			                										<?php
							 								if($flagnuevoclienteot)
							 									echo '<option value ="'.$ordhorini.'">'.$ordhorini.'</option>'."\n";
															floadtimehours();
							  							?>
			   										  	</select>:<select name="ordminini">
			                										<?php
															if($flagnuevoclienteot)
														 		echo '<option value ="'.$ordminini.'">'.$ordminini.'</option>'."\n";
							 								floadtimeminut();
								 						?>
		            											</select>
		            											<input type="checkbox" name="pasordmerini" <?php if($flagnuevoclienteot){if($pasordmerini)echo "CHECKED";}?>>&nbsp;p.m									  	
           										  </td>										
												
													<td width="15%" class="NoiseFooterTD">&nbsp;<?php if($flagnuevoclienteot && !$ordtrafecini){$ordtrafecini = null; echo "*";}?>Fecha terminaci&oacute;n</td>
													<td>
														<input type="text" name="ordtrafecter" size="8" value="<?php if(!$flagnuevoclienteot){ echo $sbreg[ordtrafecter];}else{ echo $ordtrafecter; }?>" onClick="window.open('formcalendario.php?calencodigo=ordtrafecter','cal1','status=no,menubar=no,scrollbars=yes,resizable=yes,left=600,width=200,height=210');" onFocus="if (!agree)this.blur();">
													    	<img src="../img/cal.gif" border="0" onClick="window.open('formcalendario.php?calencodigo=ordtrafecter','cal1','status=no,menubar=no,scrollbars=yes,resizable=yes,left=600,width=200,height=210');">
			              										<select name="ordhorter">
			                										<?php
							 								if($flagnuevoclienteot)
							 									echo '<option value ="'.$ordhorter.'">'.$ordhorter.'</option>'."\n";
															floadtimehours();
							  							?>
			   										  	</select>:<select name="ordminter">
			                										<?php
															if($flagnuevoclienteot)
														 		echo '<option value ="'.$ordminter.'">'.$ordminter.'</option>'."\n";
							 								floadtimeminut();
								 						?>
		            											</select>
		            											<input type="checkbox" name="pasordmerter" <?php if($flagnuevoclienteot){if($pasordmerter)echo "CHECKED";}?>>&nbsp;p.m									  	
           										  </td>										
												</tr>
											</table>
										</td>
									</tr>
									<tr>
										<td width="15%" class="NoiseFooterTD">&nbsp;<?php if($campnomb["clientvalpro"] == 1){$clientvalpro = null; echo "*";}?>Valor</td>
										<td colspan = "3"><input name="clientvalpro" type="text" value="<?php if(!$flagnuevoclienteot){ echo $sbreg[clientvalpro];}else{ echo $clientvalpro; }?>" size="15" onFocus="if (!agree)this.blur();"></td>
  									</tr>									
									<tr>
										<td width="15%" class="NoiseFooterTD">&nbsp;<?php if($campnomb["clientnombre"] == 1){$clientnombre = null; echo "*";}?>Nombre Proyecto</td>
										<td colspan = "3"><input name="clientnombre" type="text" value="<?php if(!$flagnuevoclienteot){ echo $sbreg[clientnombre];}else{ echo $clientnombre; }?>" size="60"></td>
  									</tr>
									<tr>
										<td width="15%" class="NoiseFooterTD">&nbsp;<?php if($campnomb["clientdirecc"] == 1){$clientdirecc = null; echo "*";}?>Direccion</td>
										<td colspan = "3"><input name="clientdirecc" type="text" value="<?php if(!$flagnuevoclienteot){ echo $sbreg[clientdirecc];}else{ echo $clientdirecc; }?>" size="60"></td>
									</tr>
  									<tr>
  										<td class="NoiseFooterTD" width="15%">&nbsp;<?php if($campnomb["clienttelefo"] == 1){$clienttelefo = null; echo "*";}?>Telefono</td>
									  <td width="19%"><input type="text" name="clienttelefo" value="<?php if(!$flagnuevoclienteot){ echo $sbreg[clienttelefo];}else{ echo $clienttelefo; }?>"></td>
										<td class="NoiseFooterTD" width="12%">&nbsp;<?php if($campnomb["clientmovil"] == 1){$clientmovil = null; echo "*";}?>Movil</td>
									  <td width="54%"><input type="text" name="clientmovil" value="<?php if(!$flagnuevoclienteot){ echo $sbreg[clientmovil];}else{ echo $clientmovil; }?>"></td>
  									</tr>
									<tr>
										<td class="NoiseFooterTD" width="15%">&nbsp;<?php if($campnomb["clientcontac"] == 1){$clientcontac = null; echo "*";}?>Contacto</td>
										<td colspan = "3"><input name="clientcontac" type="text" value="<?php if(!$flagnuevoclienteot){ echo $sbreg[clientcontac];}else{ echo $clientcontac; }?>" size="60"></td> 
									</tr>
  									<tr>
  										<td class="NoiseFooterTD">&nbsp;<?php if($campnomb["clienttelcon"] == 1){$clienttelcon = null; echo "*";}?>Telefono contacto</td>
										<td><input type="text" name="clienttelcon" value="<?php if(!$flagnuevoclienteot){ echo $sbreg[clienttelcon];}else{ echo $clienttelcon; }?>"></td>
										<td class="NoiseFooterTD">&nbsp;<?php if($campnomb["clientcelcon"] == 1){$clientcelcon = null; echo "*";}?>Movil contacto</td>
										<td><input type="text" name="clientcelcon" value="<?php if(!$flagnuevoclienteot){ echo $sbreg[clientcelcon];}else{ echo $clientcelcon; }?>"></td>  									
  									</tr>
									<tr>
										<td class="NoiseFooterTD" width="15%">&nbsp;<?php if($campnomb["clientimplan"] == 1){$clientimplan = null; echo "*";}?>Responsable gestion</td>
										<td colspan = "3"><input name="clientimplan" type="text" value="<?php if(!$flagnuevoclienteot){ echo $sbreg[clientimplan];}else{ echo $clientimplan; }?>" size="60"></td> 
									</tr>
 						 			<tr>
					  					<td colspan="4" class="NoiseFooterTD">&nbsp;Actividades&nbsp;
					  						<a onClick="return verocultar(this);" href="javascript:void(0);">[+/-]</a><div style="display: none;">
					  						<table width="100%" border="1" cellspacing="1" cellpadding="0" align="center" bgcolor="White">                            
	                            				<tr><td class="NoiseFieldCaptionTD">
	                            						<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" >
	                            							<tr>
	                            								<td align="left"><span class="style5"><font color="FFFFFF">&nbsp;Actividades</td>
	                            								<td align="right"><input name="masact" type="button" id="button" value="+"  onClick="window.open('consultaractividadcierre.php?codigo=<?php echo $codigo; ?>&arr_actividades='+ form1.arr_actividades.value,'secundaria1','status=no,menubar=no,scrollbars=yes,resizable=yes,left=300,width=700,height=500');" <?php if (!$ordtracodigo){echo "";} ?>>
                                                        			     		  <input type="button" name="menosact" value="-" <?php if (!$ordtracodigo){echo "";} ?> onClick="load_detall(0,window.frames['lista_actividades'].document.form2.arr_delitem.value);" ></td>
	                            							</tr>	
	                            						</table>
       						  					</td></tr> 
	                        					<tr>
	                              					<td height="152" colspan="4" bgcolor="White"><iframe src="detallaractividadcierre.php?arr_actividades=<?php echo $arr_actividades; ?>&arreglo_act=<?php echo $arreglo_act; ?>" frameborder="0" name="lista_actividades" id = "act12"  height="150" width="100%" align="absmiddle"></iframe></td>
	                            				</tr>
	                            			</table></div>
	                            		</td>
		                            </tr>
									<tr>
										<td colspan="4" class="NoiseFooterTD">&nbsp;Item&nbsp;
											<a onClick="return verocultar(this);" href="javascript:void(0);">[+/-]</a><div style="display: none;">
		                        			<table width="100%" border="1" cellspacing="1" cellpadding="0" align="center" bgcolor="White">        
		                        				<tr><td class="NoiseFieldCaptionTD">
		                            					<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" >
		                            						<tr>
		                            							<td align="left"><span class="style5"><font color="FFFFFF">&nbsp;Item's</font></span></td>
		                            							<td align="right"><input name="masitem" type="button" id="button" value="+" onClick="window.open('consultaritemcierre.php?codigo=<?php echo $codigo?>&arr_items='+ form1.arr_items.value,'secundaria1','status=no,menubar=no,scrollbars=yes,resizable=yes,left=300,width=700,height=500');" <?php if (!$ordtracodigo){echo "";} ?>>
																				  <input type="button" name="menositem" value="-" <?php if (!$ordtracodigo){echo "";} ?> onClick=" load_detall(1,window.frames['lista_items'].document.form2.arr_delitem.value);" ></td>
		                            						</tr>	
		                            					</table>
       						  					</td></tr>                     
		                        				<tr>
		                              				<td colspan="4" bgcolor="White"><iframe src="detallaritemcierre.php?arr_items=<?php echo $arr_items; ?>&arreglo_ite=<?php echo $arreglo_ite; ?>" frameborder="0" name="lista_items"  height="150" width="100%" align="absmiddle"></iframe></td>
		                            			</tr>	
								    		</table></div>
								    	</td>
		 							</tr>
  									 <tr class="NoiseFooterTD"><td colspan="4">&nbsp;<?php if($campnomb["clientdatcon"] == 1){$clientdatcon = null; echo "*";}?>Datos adicionales</td></tr>
  									 <tr>
  										<td colspan="4"><textarea name="clientdatcon" cols="70"><?php if(!$flagnuevoclienteot){ echo $sbreg[clientdatcon];}else{ echo $clientdatcon; }?></textarea></td>
  									</tr>
						  		</table>
 							</td>
 						</tr>
 						<tr>
							<td colspan="3">
								<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center">
									
									<tr>
										<td width="22%" class="NoiseFooterTD">&nbsp;<?php if($campnomb["departamento"] == 1){$departamento = null; echo "*";}?>Departamento</td>
										<td width="35%"><select name="departamento" onChange="cargarCiudad(this.value);">
								              <?php
								          			$departamento1 = $deptocodigo;
													echo '<option value = "">Seleccione</option>';
												
													$idcon = fncconn();
													$result = fullscandepartamento($idcon);
																		
													if($result > 0)
													 $numReg = fncnumreg($result);
																				
													 if($numReg){
													   for ($i=0;$i<$numReg;$i++){
													   $arr=fncfetch($result,$i);
											
													   if($arr[deptocodigo] != 0){
												    	echo '<option value ="'.$arr[deptocodigo].'" ';
												    										
												    	if($flagnuevoclienteot){
												    	  if($departamento1 == $arr[deptocodigo])
												    		echo "selected";
												    	  }	
												    	  echo ">".$arr[deptonombre]."</option>"."\n";
														}
													   }
													 }
											?>
								            </select></td>
								
								 <td class="NoiseDataTD"><?php if($campnomb["ciudadcodigo"] == 1){ $ciudadcodigo=null;
								echo "*";}?>&nbsp;Ciudad</td> 
								            <td><select name="ciudadcodigo">
								              <?php
								                   $ciudad1 = $ciudadcodigo;
													echo '<option value = "">Seleccione</option>';
																				
											        if($flagnuevoclienteot){	
													  $idcon = fncconn();
												  	  $iregCiudad[deptocodigo] = $departamento1;
													  $iregCiudaddop[deptocodigo]="=";
													  
													  $result = dinamicscanopciudad($iregCiudad,$iregCiudaddop,$idcon);
																					
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
											         }	
											?>
								            </select></td>
										</tr>
												<!--						<tr>
										<td width="22%" class="NoiseFooterTD">&nbsp;<?php if($campnomb["segmencodigo"] == 1){$segmencodigo = null; echo "*";}?>Segmento</td>
										<td width="35%"><select name="segmencodigo" onChange="cargarSubsegmentos(this.value);"> 
										<?php
											$segmencodigo1 = $segmencodigo;
											echo '<option value = "">Seleccione</option>';
			
											$idcon = fncconn();
											$result = fullscansegmentos($idcon);
																
											if($result > 0)
												$numReg = fncnumreg($result);
																
											if($numReg){
												for ($i=0;$i<$numReg;$i++){
													$arr=fncfetch($result,$i);
					
													if($arr[segmencodigo] != 0){
								    						echo '<option value ="'.$arr[segmencodigo].'" ';
								    						
								    						if($flagnuevoclienteot){			
									    						if($segmencodigo1 == $arr[segmencodigo])
									    							echo "selected";
								    						}
								    					}	
								    					echo ">".$arr[segmennombre]."</option>"."\n";
												}
											}
										?>
					      	  		  </select></td>
  										<td width="14%" class="NoiseFooterTD">&nbsp;<?php if($flagnuevoclienteot && !$subsegcodigo){$subsegcodigo = null; echo "*";}?>Subsegmento</td>
										<td width="29%"><select name="subsegcodigo">
										<?php
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
									</tr>-->
 									<tr>
										<td class="NoiseFooterTD">&nbsp;<?php if($flagnuevoclienteot && !$tareacodigo){$tareacodigo = null; echo "*";}?>Tipo de orden</td>
										<td ><select name="tareacodigo">
										<?php
											$tipo_orden1 = $tareacodigo;
											echo '<option value = "">Seleccione</option>';

											$idcon = fncconn();			
											$result = fullscantarea($idcon);
											
											if($result > 0)
												$numReg = fncnumreg($result);
																
											if($numReg){
	        											for ($i=0;$i<$numReg;$i++){
                												$arr=fncfetch($result,$i);
                									
                												if($arr[tareacodigo] != 0){
                    													echo '<option value ="'.$arr[tareacodigo].'"';
                    									
                    													if($flagnuevoclienteot){
			    												if($tipo_orden1 == $arr[tareacodigo])
			    													echo "selected";
			    											}
                													echo ">".$arr[tareanombre]."</option>"."\n";		
													}
												}
											}
										?>
									      	</select></td>
										<td class="NoiseFooterTD">&nbsp;<?php if($flagnuevoclienteot && !$servicicodigo){$servicicodigo = null; echo "*";}?>Servicio</td>
										<td><select name="servicicodigo">
									      	<?php
											$servicio1 = $servicicodigo;
                                            								echo '<option value = "">Seleccione</option>';

											$idcon = fncconn();
											$result = fullscanservicio($idcon);
											
											if($result > 0)
												$numReg = fncnumreg($result);
												
											if($numReg){
        												for ($i=0;$i<$numReg;$i++){
                												$arr=fncfetch($result,$i);

                												if($arr[servicicodigo] != 0){
                													echo '<option value ="'.$arr[servicicodigo].'"';
                    									
                													if($flagnuevoclienteot){
			    												if($servicio1 == $arr[servicicodigo])
			    													echo "selected";
			    											}
           													echo ">".$arr[servicinombre]."</option>"."\n";                												
													}
												}
											}
										?>
										</select></td>
  									</tr>
									<tr>
										<td class="NoiseFooterTD">&nbsp;<?php if($flagnuevoclienteot && !$prioricodigo){$prioricodigo = null; echo "*";}?>Prioridad</td>
										<td><select name="prioricodigo">
										<?php
                                            								$prioridad1 = $prioricodigo;
											echo '<option value = "">Seleccione</option>';

											$idcon = fncconn();														
											$result = fullscanpriorida($idcon);
											
											if($result > 0)
												$numReg = fncnumreg($result);											
																
											if($numReg){
        												for ($i=0;$i<$numReg;$i++){
                												$arr=fncfetch($result,$i);
                									
                												if($arr[prioricodigo] != 0){
                    													echo '<option value ="'.$arr[prioricodigo].'"';
                    									
                    													if($flagnuevoclienteot){
                    														if($prioridad1 == $arr[prioricodigo])
			    													echo "selected";
			    											}
			    											echo ">".$arr[priorinombre]."</option>"."\n";
                												}		
												}
											}
										?>
									      	</select></td>
									</tr>
									<tr>
										<td width="22%" class="NoiseFooterTD">&nbsp;<?php if($campnomb["clientdirecb"] == 1){$clientdirecb = null; echo "*";}?>Distrito</td>
										<td colspan = "3"><input name="clientdirecb" type="text" value="<?php if(!$flagnuevoclienteot){ echo $sbreg[clientdirecb];}else{ echo $clientdirecb; }?>" size="60"></td>
									</tr>
									<tr>
										<td width="22%" class="NoiseFooterTD">&nbsp;<?php if($campnomb["clientdireca"] == 1){$clientdireca = null; echo "*";}?>Central</td>
										<td colspan = "3"><input name="clientdireca" type="text" value="<?php if(!$flagnuevoclienteot){ echo $sbreg[clientdireca];}else{ echo $clientdireca; }?>" size="60"></td>
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
  					<input type="image" name="cancelar"  src="../img/cancelar.gif" onClick="form1.action='maestablproyotservicio.php';"  width="86" height="18" alt="Cancelar" border=0>
				</div></td>
 			</tr>
 			<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr>
	  	</table>
		<input type="hidden" name="clienthorsol">
		<input type="hidden" name="clienthorco">
		<input type="hidden" name="clientvalpro1" value="<?php echo $clientvalpro ?>">
		<input type="hidden" name="accionnuevoclienteot">
		<input type="hidden" name="flagnuevoclientot">
		<input type="hidden" name="ordtracodigo" value="<?php if(!$flagnuevoclienteot){ echo $sbreg[ordtracodigo];}else{ echo $ordtracodigo; } ?>"> 
		<input type="hidden" name="codigo" value="<?php echo $codigo; ?>">
		
		
					<input type="hidden" name="arr_actividades" value="<?php echo $arr_actividades; ?>">
			<input type="hidden" name="arr_items" value="<?php echo $arr_items; ?>">
			<input type="hidden" name="arreglo_ite" value="<?php echo $arreglo_ite; ?>">
			<input type="hidden" name="arreglo_act" value="<?php echo $arreglo_act; ?>">
	</form>
</body>
<?php	if(!$codigo){ echo " -->"; } ?>
</html>