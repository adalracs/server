<?php
ob_start(); 
	include('../src/FunPerPriNiv/pktblservicio.php');
	include('../src/FunPerPriNiv/pktbltarea.php');
	include('../src/FunPerPriNiv/pktblpriorida.php');
	include('../src/FunPerPriNiv/pktbldepartamento.php');
	include('../src/FunPerPriNiv/pktblciudad.php');
	include ( '../src/FunGen/sesion/fncvalses.php'); 
	
	unset($ordtracodigo);
unset($otestacodigo);
ob_end_flush(); 
?>
<html>
	<head>
		<title>Agendamiento - Despacho</title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		<meta http-equiv="expires" content="0">
		<link rel="stylesheet" type="text/css" href = "temas/Noise/Style.css">
		<script language="JavaScript" src="motofech.js"></script>
		<SCRIPT language=JavaScript src="../src/FunGen/jsrsClient.js"		type="text/javascript" ></SCRIPT>
		<script language=JavaScript src="../src/FunGen/cargarCiudades.js" type="text/javascript" ></script>
		<SCRIPT LANGUAGE="JavaScript">
		function load_detalles(){
			document.all("lista_OT_agenda").src="detallarotservicioest.php?estado=1,2,4,7&depto=" +form1.departamento.value + "&ciudad=" + form1.ciudad.value + "&servicicodigo=" + form1.servicicodigo.value;
			document.all("lista_OT_despacho").src="detallarotservicioest.php?estado=2,3&depto=" + form1.departamento.value + "&ciudad=" + form1.ciudad.value + "&servicicodigo=" + form1.servicicodigo.value;
		}

</script>
		
		
		
	</head>
<?php if(!$codigo){ echo "<!--";} ?>
	<body bgcolor="FFFFFF" text="#000000">
		<form name="form1" method="POST"  enctype="multipart/form-data">
			<p><font class="NoiseFormHeaderFont">Listado de ordenes de trabajo</font><br><br></p>
  			<table width="95%" border="0" align="center" cellpadding="2" cellspacing="0" class="NoiseFormTABLE">
				<tr><td colspan="3" class="NoiseColumnTD">&nbsp;</td></tr>
				<tr><td colspan="3" class="NoiseFieldCaptionTD"><span class="style5"><font color="FFFFFF">&nbsp;</font></span></td></tr>
				<tr>
					<td colspan="3">
						<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center">
					 		<tr>
					 			<td colspan="6">
					 				<table border="0" cellspacing="1" cellpadding="0" align="center" width="100%" >
										<tr>
										  <td width="30%" class="NoiseColumnTD">Departamento</td>
									      <td width="30%" class="NoiseColumnTD">Ciudad&nbsp;</td>
									      <td width="30%" class="NoiseColumnTD">Servicio</td>
									  </tr>
										<tr>
											<td class="NoiseDataTD">&nbsp;&nbsp;<select name="departamento" onChange="cargarCiudades(this.value);load_detalles();">
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
					    									
					    										if($accionfiltrarotserv){
					    											if($departamento1 == $arr[deptocodigo])
					    												echo "selected";
					    										}	
					    										echo ">".$arr[deptonombre]."</option>"."\n";
														}
													}
												}
											?>
											</select>&nbsp;&nbsp;</td>
										    <td class="NoiseDataTD"><select name="ciudad" onChange="load_detalles();">
                                              <?php
												$ciudad1 = $ciudad;
												echo '<option value = "">Seleccione</option>';
													
												if($accionfiltrarotserv){	
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
										  <td class="NoiseDataTD"><select name="servicicodigo" onChange="load_detalles();">
							  				  <?php
													$servicicodigo1 = $servicicodigo;
													echo '<option value = "">Seleccione</option>';
									
													$idcon = fncconn();
													$result = fullscanservicio($idcon);
																	
													if($result > 0)
														$numReg = fncnumreg($result);
																	
													if($numReg){
														for ($i=0;$i<$numReg;$i++){
															$arr=fncfetch($result,$i);
						
															if($arr[servicicodigo] != 0){
									    						echo '<option value ="'.$arr[servicicodigo].'" ';
									    									
									    						if($accionfiltrarotserv){
									    							if($servicicodigo1 == $arr[servicicodigo])
									    								echo "selected";
									    						}	
									    						echo ">".$arr[servicinombre]."</option>"."\n";
															}
														}
													}
												?>
										  </select></td>	                                            
                                            
										</tr>
									</table>
								</td>
							</tr>
							<tr><td colspan="4" class="NoiseFooterTD">Orden de trabajo por agendar</td></tr>
			  				<tr>
                        						<td colspan="4" align="center">
                        							<table width="100%" border="1" cellspacing="1" cellpadding="0" align="center" bgcolor="White">                            
                            								<tr>
                              									<td colspan="4" bgcolor="White"><iframe src="detallarotservicioest.php?estado=1,2,4,7" frameborder="0" name="lista_OT_agenda"  height="150" width="100%" align="absmiddle"></iframe></td>
                            								</tr>
                       							</table>
                       						</td>
			  		  		</tr>
                        					<tr>
                        						<td colspan="4" align="right"><input type="submit" name="agendamiento" onClick="form1.ordtracodigo.value = window.frames['lista_OT_agenda'].document.form2.ordtracodigo.value; 
											form1.otestacodigo.value = window.frames['lista_OT_agenda'].document.form2.otestacodigo.value;
											if( form1.ordtracodigo.value != ''){ 
												if(form1.otestacodigo.value != 1){
													form1.action = 'ingrnuevreagendamiento.php?codigo=<?php echo $codigo; ?>&codud=<?php echo $GLOBALS['usuacodi']; ?>';
												}else{	
													form1.action = 'ingrnuevagendamiento.php?codigo=<?php echo $codigo; ?>&codud=<?php echo $GLOBALS['usuacodi']; ?>';
												}
											}else{ alert( 'Debe seleccionar la orden por agendar' ); }" alt="Nuevo Registro"  value="Agendar orden"></td>
                        					</tr>
                        					<tr><td colspan="4" class="NoiseFooterTD">Orden de trabajo por Despachar</td></tr>
							<tr>
                        						<td colspan="4" align="center">
                        							<table width="100%" border="1" cellspacing="1" cellpadding="0" align="center" bgcolor="White">                            
                            								<tr>
                              									<td colspan="4" bgcolor="White"><iframe src="detallarotservicioest.php?estado=2,3" frameborder="0" name="lista_OT_despacho"  height="150" width="100%" align="absmiddle"></iframe></td>
                            								</tr>
                       							</table>
                       						</td>
			  		  		</tr>
                        					<tr>
                        						<td colspan="4" align="right"><input type="submit" name="despacho" onClick="form1.ordtracodigo.value = window.frames['lista_OT_despacho'].document.form2.ordtracodigo.value; if(form1.ordtracodigo.value != ''){form1.action = 'ingrnuevdespacho.php?codigo=<?php echo $codigo; ?>&codud=<?php echo $GLOBALS['usuacodi']; ?>';}else{alert('Debe seleccionar la orden por despachar');}" alt="Nuevo Registro"  value="Despachar orden"></td>
                        					</tr>
		  		  		</table>
			  		</td>
  		  		</tr>
				<tr><td colspan="3" class="NoiseColumnTD">&nbsp;</td></tr>
  	  		</table>
		
			<label></label>
			<input type="hidden" name="accionnuevacarga">
			<input type="hidden" name="ordtracodigo">
			<input type="hidden" name="otestacodigo">
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>">
			<input type="hidden" name="filepath">
	
		</form>
	</body>
<?php if(!$codigo){ echo " -->"; } ?>
</html>