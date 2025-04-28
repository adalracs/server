<?php
ob_start(); 
	include('../src/FunPerPriNiv/pktblservicio.php');
	include('../src/FunPerPriNiv/pktbltarea.php');
	include('../src/FunPerPriNiv/pktblpriorida.php');
	include('../src/FunPerPriNiv/pktbldepartamento.php');
	include('../src/FunPerPriNiv/pktblciudad.php');
	include ( '../src/FunPerPriNiv/pktblsegmentos.php');
	include ( '../src/FunPerPriNiv/pktblsubsegmentos.php');
	
	include ( '../src/FunGen/floadtimehours.php');
	include ( '../src/FunGen/floadtimeminut.php');

	include('../src/FunPerSecNiv/fncclose.php');
	include('../src/FunPerSecNiv/fncconn.php');
	include('../src/FunPerSecNiv/fncnumreg.php');
	include('../src/FunPerSecNiv/fncfetch.php');

	
	if($accionnuevacarga){
		include('cargaitem.php');
	}
ob_end_flush(); 
?>
<html>
<head>
<title>Carga de Datos</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta http-equiv="expires" content="0">
<link rel="stylesheet" type="text/css" href = "temas/Noise/Style.css">
<script language="JavaScript" src="motofech.js"></script>
<SCRIPT language=JavaScript src="../src/FunGen/jsrsClient.js"		type="text/javascript" ></SCRIPT>
<script language=JavaScript src="../src/FunGen/cargarCiudades.js" type="text/javascript" ></script>
<script language=JavaScript src="../src/FunGen/cargarSubsegmentos.js" type="text/javascript" ></script>

<SCRIPT LANGUAGE="JavaScript">
function load_tipo(index_sel){
	if (index_sel == 0 || index_sel == 1){
		window.document.form1.tipo.length = 0;
		window.document.form1.tipo.disabled = true;
		window.document.form1.ciudad.disabled = true;
		window.document.form1.departamento.disabled =true;
	}if(index_sel == 2){
		window.document.form1.tipo.length = 0;
		window.document.form1.tipo.disabled = false;
		window.document.form1.tipo.options[0]=new Option('Instalación',0,true,true);
		window.document.form1.tipo.options[1]=new Option('Mantenimiento',1,false,false);
		window.document.form1.tipo.options[2]=new Option('Cancelacion V1',2,false,false);
		window.document.form1.tipo.options[3]=new Option('Deco Adicional',3,false,false);
		window.document.form1.tipo.options[4]=new Option('Retiro',4,false,false);
		window.document.form1.tipo.options[5]=new Option('Traslado',5,false,false);
	}if(index_sel == 3){
		window.document.form1.tipo.length = 0;
		window.document.form1.tipo.disabled = false;
		window.document.form1.ciudad.disabled = false;
		window.document.form1.departamento.disabled = false;
		window.document.form1.tipo.options[0]=new Option('Tickect',1,false,false);
		window.document.form1.tipo.options[1]=new Option('Solicitud',0,false,false);
	}	
}

function open_window(index_sel){
	if(form1.procedencia.value==0){
		alert('Debe seleccionar una procedencia');
	}else{ 
		if (index_sel == 1){//Esta es ruta @tiempo
			window.open('http://tramitador.telecom.net.co:9080/bandejaweb/login.html','','status=no,menubar=yes,scrollbars=yes,resizable=yes,left=300,width=700,height=500');	
		}else if(index_sel == 2){//Esta es ruta HC
			window.open('http://hc.telecom.net.co/internetMasivo/login.jsp','','status=no,menubar=yes,scrollbars=yes,resizable=yes,left=300,width=700,height=500');	
		}else{//Esta es Ruta SISGOT
			window.open('http://contratistas.telecom.com.co','','status=no,menubar=yes,scrollbars=yes,resizable=yes,left=300,width=700,height=500');	
		}
		
	}
}

</script>

</head>
<?php 
if(!$codigo)
{ echo "<!--";}
?>
<body bgcolor="FFFFFF" text="#000000">
	<form name="form1" method="POST"  enctype="multipart/form-data">
  		<table width="681" border="0" align="center" cellpadding="2" cellspacing="0" class="NoiseFormTABLE">
			<tr><td colspan="3" class="NoiseColumnTD">Ordenes de trabajo</td></tr>
			<tr><td colspan="3" class="NoiseFieldCaptionTD"><span class="style5"><font color="FFFFFF">Carga de Ordenes Telecom</font></span></td></tr>
			<tr>
				<td width="89" class="NoiseSeparatorTD">Fecha / <span class="NoiseSeparatorTD">Hora:</span></td>
				<td width="169" class="NoiseSeparatorTD"><?php $fecha=date("Y-m-d");echo $fecha; ?> / <?php $horainicial= date("H:i"); echo $horainicial; ?></td>
				<td width="409" class="NoiseSeparatorTD"><?php if($flagnuevoclienteot && !$procedencia){echo '<font color="Red"> *</font>';} ?> Procedencia 
		        	    		<select name="procedencia"  onchange="load_tipo(this.value);">
		                			<option value="0">Seleccione</option>
		                			<option <?php if($flagnuevoclienteot && $oprocedencia == 1){echo 'selected';} ?> value="1">@ Tiempo</option>
		                			<!--<option <?php if($flagnuevoclienteot && $oprocedencia == 2){echo 'selected';} ?> value="2">HC Telecom</option>-->
 		                			<option <?php if($flagnuevoclienteot && $oprocedencia == 3){echo 'selected';} ?> value="3">SISGOT Telecom</option>
       		  			</select>
		        		<label>
    		 			<select name="tipo" id="tipo" disabled></select>
    		  			<input type="button" name="ir2" onClick="open_window(form1.procedencia.value);" value="Ir">
	  		  </label></td>
  		  </tr>
			<tr>
				<td colspan="3">
					<table width="96%" border="0" cellspacing="1" cellpadding="0" align="center">
						<tr>
							<td colspan="4" class="NoiseFooterTD">Orden de trabajo</td>
							</tr>
						<tr>
							<td colspan="4"><input type="file" name="file" size="78" accept="text/html"  value="<?php if($flagnuevoot){ echo $filepath;} ?>"></td>
	  		  		  </tr>
                        				<tr>
                         					<td colspan="4">
                            						<table width="100%" border="0" cellspacing="2" cellpadding="0" align="center">
                            							<tr>
                            								<td width="30%" class="NoiseFooterTD">Servicio<?php if($flagnuevoclienteot && !$servicio){echo '<font color="Red"> *</font>';} ?></td>
      	    									<td width="30%" class="NoiseFooterTD">Tipo de orden<?php if($flagnuevoclienteot && !$tipo_orden){echo '<font color="Red"> *</font>';} ?></td>
      	    									<td width="30%" class="NoiseFooterTD">Prioridad<?php if($flagnuevoclienteot && !$prioridad){echo '<font color="Red"> *</font>';} ?></td>
   	    						  		</tr>
									<tr>
										<td class="NoiseDataTD"><select name="servicio">
                                    							<?php
											$servicio1 = $servicio;
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
										<td class="NoiseDataTD"><select name="tipo_orden">
                                        							<?php
											$tipo_orden1 = $tipo_orden;
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
                                        							<td class="NoiseDataTD"><select name="prioridad">
                                        							<?php
                                            							$prioridad1 = $prioridad;
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
	                              							<td class="NoiseFooterTD">Departamento<?php if($flagnuevoclienteot && !$departamento){echo '<font color="Red"> *</font>';} ?></td>
          										<td class="NoiseFooterTD">Ciudad<?php if($flagnuevoclienteot && !$ciudad){echo '<font color="Red"> *</font>';} ?></td>
          										<td class="NoiseFooterTD">&nbsp;</td>
          									</tr>
          									<tr>
		  								<td class="NoiseDataTD"><select name="departamento" onChange="cargarCiudades(this.value);">
		  							 	<?php
											$departamento1 = $departamento;
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
                              								<td class="NoiseDataTD"><select name="ciudad">
                                        							<?php
                                        								$ciudad1 = $ciudad;
												echo '<option value = "">Seleccione</option>';
											
                                            							if($flagnuevoclienteot){	
												$idcon = fncconn();
												$iregCiudad[deptocodigo] = $departamento1;
												$iregCiudadop[deptocodigo]="=";
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
                                            							}
										?>
										</select></td>
                                        							<td class="NoiseDataTD">&nbsp;</td>
                           							  </tr>
                           							  						<tr>
	                              							<td class="NoiseFooterTD">Segmento<?php if($flagnuevoclienteot && !$segmencodigo){echo '<font color="Red"> *</font>';} ?></td>
          										<td class="NoiseFooterTD">Subsegmento<?php if($flagnuevoclienteot && !$subsegcodigo){echo '<font color="Red"> *</font>';} ?></td>
          										<td class="NoiseFooterTD">&nbsp;</td>
          									</tr>
          									<tr>
		
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
  										
										<td width="29%"><select name="subsegcodigo">
										<?php
											$subsegcodigo1 = $subsegcodigo;
											echo '<option value = "">Seleccione</option>';
											
											if($flagnuevoclienteot){
																
											$idcon = fncconn();
											$iregsubsegmento[subsegmencod] = $segmencodigo1;
											$iregsubsegmentoop[subsegmencod] = "=";
											$result = dinamicscanopsubsegmentos($iregsubsegmento,$iregsubsegmentoop,$idcon);
														
											if($result > 0) 
												$numReg = fncnumreg($result);
																
											if($numReg){
												for ($i=0;$i<$numReg;$i++){
													$arr=fncfetch($result,$i);
															
													if($arr[subsegcodigo] != 0){
								    						echo '<option value ="'.$arr[subsegcodigo].'" ';
								    						
															if($subsegcodigo1 == $arr[subsegcodigo])
								    								echo "selected";
								    						
								    						echo ">".$arr[subsegnombre]."</option>"."\n";
													}
												}
											}
											}
										?>
									  </select></td>
									</tr>
									<tr class="NoiseFooterTD">
										<td colspan="3" >&nbsp;<?php if($flagnuevoclienteot && !$ordtrafecini){$ordtrafecini = null; echo "*";}?>Fecha inicio&nbsp;&nbsp;
											<input type="text" name="ordtrafecini" size="12" value="<?php if(!$flagnuevoclienteot){ echo $sbreg[ordtrafecini];}else{ echo $ordtrafecini; }?>" onFocus="if (!agree)this.blur();">
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
            											<input type="checkbox" name="pasordmerini" <?php if($flagnuevoclienteot){if($pasordmerini)echo "CHECKED";}?>>&nbsp;p.m									  	</td>										
									</tr>
                            							<tr>
                              								<td colspan="3"><div align="right"><input type="submit" name="carga" onClick="form1.accionnuevacarga.value=1; form1.filepath.value = form1.file.value;" value="Cargar Orden"></div></td>
                            							</tr>	  
                           						</table>
                       					  </td>
                      				</tr><!--
			  			<tr>
                        					<td colspan="4" align="center">
                        						<table width="99%" border="1" cellspacing="1" cellpadding="0" align="center" bgcolor="White">                            
                            							<tr>
                              								<td colspan="4" bgcolor="White"><iframe src="detallarotcargado.php" frameborder="0" name="lista_OT"  height="200" width="100%" align="absmiddle"></iframe></td>
                            							</tr>
                       						</table>
                       					</td>
			  		  </tr>
                        				<tr>
                        					<td colspan="4" align="right"><input type="submit" name="nuevo" onClick="form1.ordtracodigo.value = window.frames['lista_OT'].document.form2.ordtracodigo.value; form1.action = 'detallarclienteot.php';" alt="Nuevo Registro"  value="Agendar orden"></td>
                        				</tr>-->
		  		  </table>
			  </td>
  		  </tr>
			<tr></tr>
			<tr>
				<td colspan="3"><div align="center">
						<input type="image" name="aceptar"  src="../img/aceptar.gif" onClick="window.close();" width="86" height="18" alt="Aceptar" border=0>
				</div></td>
			</tr>
			<tr><td colspan="3" class="NoiseColumnTD">&nbsp;</td></tr>
  	  </table>
		
		<label></label>
		<input type="hidden" name="accionnuevacarga">
		<input type="hidden" name="ordtracodigo">
		<input type="hidden" name="codigo" value="<?php echo $codigo; ?>">
		<input type="hidden" name="filepath">
		
	</form>
</body>
<?php 
if(!$codigo)
{ echo " -->"; }
?>
</html>