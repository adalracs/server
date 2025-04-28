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
include ( '../src/FunPerPriNiv/pktblotactividad.php');
include ( '../src/FunPerPriNiv/pktblotitem.php');

include ( '../src/FunGen/floadtimehours.php');
include ( '../src/FunGen/floadtimeminut.php');
//include('detallaclienteot.php');
	
if($accionnuevoclienteot){
	include ("editaproyotservicio.php");
}

if(!$flageditarclientot){ 
	include ( '../src/FunGen/sesion/fnccarga.php'); 
	$sbreg = fnccarga($nombtabl,$radiobutton); 
	
	if (!$sbreg){ 
		$nombtabl = "proyotservicio";
		include( '../src/FunGen/fnccontfron.php'); 
	} 
	include('detallaotservicio.php');
	$ordtracodigo = $sbreg[ordtracodigo];
	$idcon = fncconn();
	$sbotactividad = loadrecordototactividad($ordtracodigo,$idcon);
	
	if($sbotactividad > 0){
		for($i = 0; $i < count($sbotactividad); $i++){
			if(!$arr_actividades){
				$arr_actividades = $sbotactividad[$i][activicodigo];
			}else{ 
				$arr_actividades = $arr_actividades.",". $sbotactividad[$i][activicodigo];
			}
			if(!$arreglo_act){
				$arreglo_act = $sbotactividad[$i][activicodigo].":".$sbotactividad[$i][ordactcantid];
			}else{ 
				$arreglo_act = $arreglo_act.";". $sbotactividad[$i][activicodigo].":".$sbotactividad[$i][ordactcantid];
			}	
		}	
	}	
	$sbotitem = loadrecordototitem($ordtracodigo,$idcon);
	if($sbotitem > 0){
		for($i = 0; $i < count($sbotitem); $i++){
			if(!$arr_items){
				$arr_items = $sbotitem[$i][itemcodigo];
			}else{ 
				$arr_items = $arr_items.",". $sbotitem[$i][itemcodigo];
			}
			if(!$arreglo_ite){
				$arreglo_ite = $sbotitem[$i][itemcodigo].":".$sbotitem[$i][orditecantid];
			}else{ 
				$arreglo_ite = $arreglo_ite.";". $sbotitem[$i][itemcodigo].":".$sbotitem[$i][orditecantid];
			}	
		}	
	}	
	
	
} 


ob_end_flush();
?>
<html>
	<head>
		<title>Editar registro de OT Proyecto</title>
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
  				<tr><td class="NoiseFieldCaptionTD"><span class="style5"><font color="FFFFFF">Editar registro</font></span></td></tr>
				<tr>
					<td>
						<table width="99%" border="0" cellspacing="0" cellpadding="0" align="center">
							<tr><td colspan="2">
 								<table width="99%" border="0" cellspacing="1" cellpadding="0" align="center">
 								 	<tr>
										<td width="15%" class="NoiseFieldCaptionTD Estilo1">&nbsp;Numero OT</td>
										<td class="NoiseFieldCaptionTD Estilo1">&nbsp;<?php if(!$flageditarclientot){ echo $sbreg[ordtracodigo];}else{ echo $ordtracodigo; } ?></td>
										<td colspan="2">&nbsp;Fecha de creaci�n:&nbsp;&nbsp;<?php if(!$flageditarclientot){ echo $annogen."-".$mesgen."-".$diagen."  ".$horgen.":".$minutogen; if($horagen > 12){ echo " p.m.";}else{ echo " a.m.";}}else{ echo $ordtrafechorgen; } ?> </td>
						 		  	</tr>
									<tr><td colspan="4" class="NoiseFieldCaptionTD Estilo1">&nbsp;Datos Basicos </td></tr>
							  		<tr>
										<td width="15%" class="NoiseFooterTD">&nbsp;<?php if($flageditarclientot && !$clientsolici){$clientsolici = null; echo "*";}?>Numero solicitud</td>
										<td colspan = "3"><input name="clientsolici" type="text" value="<?php if(!$flageditarclientot){ echo $sbregclienteot[clientsolici];}else{ echo $clientsolici; }?>" size="60"></td>
  									</tr>
  									
									<tr>
									<td colspan="4">
											<table width="100%" align="center" cellspacing="1" cellpadding="0">
												<tr>
										<td width="15%" class="NoiseFooterTD">&nbsp;<?php if($flageditarclientot && !$clientfecsol){$clientfecsol = null; echo "*";}?>Fecha solicitud</td>
										<td>
											<input type="text" name="clientfecsol" size="8" value="<?php if(!$flageditarclientot){ echo $sbregclienteot[clientfecsol];}else{ echo $clientfecsol; }?>" onFocus="if (!agree)this.blur();">
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
								 
										<td width="15%" class="NoiseFooterTD">&nbsp;<?php if($flageditarclientot && !$clientfecco){$clientfecco = null; echo "*";}?>Fecha compromiso</td>
										<td>
											<input type="text" name="clientfecco" size="8" value="<?php if(!$flageditarclientot){ echo $sbregclienteot[clientfecco];}else{ echo $clientfecco; }?>" onFocus="if (!agree)this.blur();">
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
										<td width="15%" class="NoiseFooterTD">&nbsp;<?php if($flageditarclientot && !$ordtrafecini){$ordtrafecini = null; echo "*";}?>Fecha inicio</td>
										<td>
											<input type="text" name="ordtrafecini" size="8" value="<?php if(!$flageditarclientot){ echo $sbreg[tareotfecini];}else{ echo $ordtrafecini; }?>" onclick="window.open('formcalendario.php?calencodigo=ordtrafecini','cal1','status=no,menubar=no,scrollbars=yes,resizable=yes,left=600,width=200,height=210');" onFocus="if (!agree)this.blur();">
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
									
										<td width="15%" class="NoiseFooterTD">&nbsp;<?php if($flagnuevoclienteot && !$ordtrafecini){$ordtrafecini = null; echo "*";}?>Fecha terminaci&oacute;n</td>
										<td>
											<input type="text" name="ordtrafecfin" size="8" value="<?php if(!$flagnuevoclienteot){ echo $sbregtareot[11];}else{ echo $ordtrafecfin; }?>" onClick="window.open('formcalendario.php?calencodigo=ordtrafecter','cal1','status=no,menubar=no,scrollbars=yes,resizable=yes,left=600,width=200,height=210');" onFocus="if (!agree)this.blur();">
										    	<img src="../img/cal.gif" border="0" onClick="window.open('formcalendario.php?calencodigo=ordtrafecfin','cal1','status=no,menubar=no,scrollbars=yes,resizable=yes,left=600,width=200,height=210');">
              										<select name="ordhorter">
                										<?php
                											if(!$ordhorter)
                												echo '<option value ="'.$horaorfin1.'">'.$horaorfin1.'</option>'."\n";                										
				 								if($flagnuevoclienteot)
				 									echo '<option value ="'.$ordhorter.'">'.$ordhorter.'</option>'."\n";
												floadtimehours();
				  							?>
   										  	</select>:<select name="ordminter">
                										<?php
                											if(!$ordminter)
                												echo '<option value ="'.$minutoorfin.'">'.$minutoorfin.'</option>'."\n";                										
												if($flagnuevoclienteot)
											 		echo '<option value ="'.$ordminter.'">'.$ordminter.'</option>'."\n";
				 								floadtimeminut();
					 						?>
            											</select>
            											<input type="checkbox" name="pasordmerter" <?php if($flagnuevoclienteot){if($pasordmerter)echo "CHECKED";}?>>&nbsp;p.m									  	</td>										
									</tr>
									</table>
										</td>
									</tr>
									<tr>
										<td width="15%" class="NoiseFooterTD">&nbsp;<?php if($campnomb["clientvalpro"] == 1){$clientvalpro = null; echo "*";}?>Valor</td>
										<td colspan = "3"><input name="clientvalpro" type="text" value="<?php if(!$flagnuevoclienteot){ echo $sbregclienteot[clientvalpro];}else{ echo $clientvalpro; }?>" size="15"></td>
  									</tr>									
									<tr>
										<td width="15%" class="NoiseFooterTD">&nbsp;<?php if($campnomb["clientnombre"] == 1){$clientnombre = null; echo "*";}?>Nombre proyecto</td>
										<td colspan = "3"><input name="clientnombre" type="text" value="<?php if(!$flageditarclientot){ echo $sbregclienteot[clientnombre];}else{ echo $clientnombre; }?>" size="60"></td>
  									</tr>
									<tr>
										<td width="15%" class="NoiseFooterTD">&nbsp;<?php if($campnomb["clientdirecc"] == 1){$clientdirecc = null; echo "*";}?>Direccion</td>
										<td colspan = "3"><input name="clientdirecc" type="text" value="<?php if(!$flageditarclientot){ echo $sbregclienteot[clientdirecc];}else{ echo $clientdirecc; }?>" size="60"></td>
									</tr>
  									<tr>
  										<td class="NoiseFooterTD" width="15%">&nbsp;<?php if($campnomb["clienttelefo"] == 1){$clienttelefo = null; echo "*";}?>Telefono</td>
									  <td width="19%"><input type="text" name="clienttelefo" value="<?php if(!$flageditarclientot){ echo $sbregclienteot[clienttelefo];}else{ echo $clienttelefo; }?>"></td>
										<td class="NoiseFooterTD" width="12%">&nbsp;<?php if($campnomb["clientmovil"] == 1){$clientmovil = null; echo "*";}?>Movil</td>
									  <td width="54%"><input type="text" name="clientmovil" value="<?php if(!$flageditarclientot){ echo $sbregclienteot[clientmovil];}else{ echo $clientmovil; }?>"></td>
  									</tr>
									<tr>
										<td class="NoiseFooterTD" width="15%">&nbsp;<?php if($campnomb["clientcontac"] == 1){$clientcontac = null; echo "*";}?>Contacto</td>
										<td colspan = "3"><input name="clientcontac" type="text" value="<?php if(!$flageditarclientot){ echo $sbregclienteot[clientcontac];}else{ echo $clientcontac; }?>" size="60"></td> 
									</tr>
  									<tr>
  										<td class="NoiseFooterTD">&nbsp;<?php if($campnomb["clienttelcon"] == 1){$clienttelcon = null; echo "*";}?>Telefono contacto</td>
										<td><input type="text" name="clienttelcon" value="<?php if(!$flageditarclientot){ echo $sbregclienteot[clienttelcon];}else{ echo $clienttelcon; }?>"></td>
										<td class="NoiseFooterTD">&nbsp;<?php if($campnomb["clientcelcon"] == 1){$clientcelcon = null; echo "*";}?>Movil contacto</td>
										<td><input type="text" name="clientcelcon" value="<?php if(!$flageditarclientot){ echo $sbregclienteot[clientcelcon];}else{ echo $clientcelcon; }?>"></td>  									
  									</tr>
									<tr>
										<td class="NoiseFooterTD" width="15%">&nbsp;<?php if($campnomb["clientimplan"] == 1){$clientimplan = null; echo "*";}?>Implantador</td>
										<td colspan = "3"><input name="clientimplan" type="text" value="<?php if(!$flageditarclientot){ echo $sbregclienteot[clientimplan];}else{ echo $clientimplan; }?>" size="60"></td> 
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
								<!--										<tr>
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
									</tr>-->
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
										<td width="22%" class="NoiseFooterTD">&nbsp;<?php if($campnomb["clientdirecb"] == 1){$clientdirecb = null; echo "*";}?>Distrito</td>
										<td colspan = "3"><input name="clientdirecb" type="text" value="<?php if(!$flageditarclientot){ echo $sbregclienteot[clientdirecb];}else{ echo $clientdirecb; }?>" size="60"></td>
									</tr>
									<tr>
										<td width="22%" class="NoiseFooterTD">&nbsp;<?php if($campnomb["clientdireca"] == 1){$clientdireca = null; echo "*";}?>Central</td>
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
  					<input type="image" name="cancelar"  src="../img/cancelar.gif" onClick="form1.action='maestablproyotservicio.php';"  width="86" height="18" alt="Cancelar" border=0>
				</div></td>
 			</tr>
 			<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr>
	  	</table>
		<input type="hidden" name="ordtrafechorgen" value="<?php if(!$flageditarclientot){ echo $annogen."-".$mesgen."-".$diagen."  ".$horgen.":".$minutogen; if($horagen > 12){ echo " p.m.";}else{ echo " a.m.";}}else{ echo $ordtrafechorgen; } ?> ">
		<input type="hidden" name="accionnuevoclienteot">
		<input type="hidden" name="ordtracodigo" value="<?php if(!$flageditarclientot){ echo $sbreg[ordtracodigo];}else{ echo $ordtracodigo; } ?>"> 
		<input type="hidden" name="codigo" value="<?php echo $codigo; ?>">
		
							<input type="hidden" name="arr_actividades" value="<?php echo $arr_actividades; ?>">
			<input type="hidden" name="arr_items" value="<?php echo $arr_items; ?>">
			<input type="hidden" name="arreglo_ite" value="<?php echo $arreglo_ite; ?>">
			<input type="hidden" name="arreglo_act" value="<?php echo $arreglo_act; ?>">
	</form>
</body>
<?php	if(!$codigo){ echo " -->"; } ?>
</html>