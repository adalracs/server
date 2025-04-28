<?php 
ob_start(); 
	//include ( '../src/FunGen/sesion/fncvalses.php'); 
	include('../src/FunPerPriNiv/pktblservicio.php');
	include('../src/FunPerPriNiv/pktbldepartamento.php');
	include('../src/FunPerPriNiv/pktblciudad.php');
	
	include('../src/FunPerPriNiv/pktblsubzona.php');
	include('../src/FunPerPriNiv/pktblcuadrillausuario.php');
	
	include('../src/FunPerSecNiv/fncconn.php');
	include('../src/FunPerSecNiv/fncclose.php');
	include('../src/FunPerSecNiv/fncnumreg.php');
	include('../src/FunPerSecNiv/fncfetch.php');
	

	$idcon = fncconn();
	$sbdepto = loadrecorddepartamento($dcod,$idcon);
	$deptonombre = $sbdepto[deptonombre];
	$sbciudad = loadrecordciudad($ccod,$idcon);
	$ciudadnombre = $sbciudad[ciudadnombre];
	$ciudadcodigo = $sbciudad[ciudadcodigo];
	$sbservicio = loadrecordservicio($cserv,$idcon);
	$servicinombre = $sbservicio[servicinombre];
	$servicicodigo = $sbservicio[servicicodigo];
	

?> 
<!-- Propiedad intelectual de Adsum SA (c) 
-Todos los derechos reservados- 
Creado con WAG Adsum 
Autor: cbedoya
Fecha: 30-Noviembre-2007
GenVers: 3.1 --> 
<html> 
	<head> 
		<title>Consultar agenda de cuadrilla</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0"> 
		<link rel="stylesheet" type="text/css" href="temas/Noise/Style.css"> 
		<script language="JavaScript" src="../src/FunGen/jsrsClient.js"		type="text/javascript" ></SCRIPT>
		<script language="JavaScript" src="../src/FunGen/cargarSubzonas.js" type="text/javascript" ></script>
		<SCRIPT LANGUAGE="JavaScript"> 
			<!-- Begin 
			agree = 0; 
			//  End --> 
		</script> 
		<SCRIPT LANGUAGE="JavaScript"> 
			function loadtable(){
				document.all("detall").src="detallaagendacuadrilla.php?servicio="+ document.form1.servicicodigo.value + "&zona="+ document.form1.zona.value + "&subzona="+ document.form1.subzoncodigo.value +"&fecreg=" + document.form1.fechfilter.value;
			}
			function unload_window(ccuadrilla, cjornada){
				window.opener.document.form1.ccuadrilla.value =ccuadrilla;
				window.opener.document.form1.fecha_agen.value = form1.fechfilter.value;
				window.opener.document.form1.rango.options[cjornada].selected = true;
				window.opener.document.form1.asig_tec.focus();
				window.close();
			}
		</script> 
	</head> 
<?php // if(!$codigo){ echo "<!--";} ?> 
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Cuadrillas</font></p> 
			<table width="100%" border="0" align="center" cellpadding="2" cellspacing="0" class="NoiseFormTABLE">
				<tr><td width="95%" class="NoiseColumnTD">&nbsp;</td>
				</tr>
				<tr>
					<td colspan="6"><table border="0" cellspacing="1" cellpadding="1" align="center" width="98%">
						<tr>
							<td width="20%" class="NoiseFooterTD" align="center">Departamento</td>	
							<td width="20%" class="NoiseFooterTD" align="center">Ciudad</td>	
							<td width="20%" class="NoiseFooterTD" align="center">Zona</td>	
						    	<td width="20%" class="NoiseFooterTD" align="center">Sub Zona</td>
						    	<td align="center">&nbsp;</td>
						</tr>
						<tr>
							<td width="20%" class="NoiseDataTD">&nbsp;<?php echo $deptonombre;  ?></td>	
							<td width="20%" class="NoiseDataTD">&nbsp;<?php echo $ciudadnombre;  ?></td>	
							<td class="NoiseDataTD"><select name="zona" onChange="cargarSubzonas(this.value);">
						    	<?php
						    		include('../src/FunPerPriNiv/pktblzona.php');
								$zona1 = $zona;
								echo '<option value = "">Seleccione</option>';
													
								$idcon = fncconn();
								$iregZona[ciudadcodigo] = $ciudadcodigo;
								$iregZonaop[ciudadcodigo]="=";
								$result = dinamicscanopzona($iregZona,$iregZonaop,$idcon);
											
								if($result > 0)
									$numReg = fncnumreg($result);
													
								if($numReg){
									for ($i=0;$i<$numReg;$i++){
										$arr=fncfetch($result,$i);
											
										if($arr[zonacodigo] != 0){
					    						echo '<option value ="'.$arr[zonacodigo].'" ';
					    									
											if($zona1 == $arr[zonacodigo])
					    							echo "selected";
					    						echo ">".$arr[zonanombre]."</option>"."\n";
										}
									}
								}
							?>
							
							</select></td>
							<td class="NoiseDataTD"><select name="subzoncodigo">
							<?php
								$subzoncodigo1 = $subzoncodigo;
								echo '<option value = "">Seleccione</option>';
													
								$idcon = fncconn();
								$iregsubZona[zonacodigo] = $zona1;
								$iregsubZonaop[zonacodigo]="=";
								$result = dinamicscanopsubzona($iregsubZona,$iregsubZonaop,$idcon);
										
								if($result > 0)
									$numReg = fncnumreg($result);
													
								if($numReg){
									for ($i=0;$i<$numReg;$i++){
										$arr=fncfetch($result,$i);
												
										if($arr[subzoncodigo] != 0){
					    						echo '<option value ="'.$arr[subzoncodigo].'" ';
					    						
					    						if($flagnuevocuadrilla){		
												if($subzoncodigo1 == $arr[subzoncodigo])
					    								echo "selected";
					    						}
					    						echo ">".$arr[subzonnombre]."</option>"."\n";
										}
									}
								}
		                        					
							?>
							</select></td>
							<td>&nbsp;</td>
						</tr>
					</table></td>
				</tr>		
				<tr>
					<td>
						<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center">
							<tr>
	                         						<td colspan="4"><table width="100%" border="0" cellspacing="2" cellpadding="0" align="center">
									<tr>
										<td width="11%" class="NoiseFooterTD">&nbsp;Servicio</td>
										<td width="22%" >&nbsp;<?php echo $servicinombre; ?></td>
	                           							<td width="15%" class="NoiseDataTD" >Fecha</td>
	                           							<td width="17%"  valign="baseline" ><input type="text" name="fechfilter" size="12" value="<?php $fechfilter=date("Y-m-d"); echo $fechfilter;?>" onFocus="if (!agree)this.blur();">
							    	  <img src="../img/cal.gif" border="0" onClick="window.open('formcalendario.php?calencodigo=fechfilter','cal1','status=no,menubar=no,scrollbars=yes,resizable=yes,left=600,width=200,height=210');"></td>
									                    <td width="35%"  valign="baseline" ><input name="filtrar" type="button" value="Filtrar" onClick="loadtable();"></td>
									</tr>
	                            						<tr><td colspan="5"><div align="right"></div></td></tr>	  
	                           					</table></td>
							</tr>
				  			<tr>
	                        						<td colspan="4" align="center">
	                        							<table width="100%" border="1" cellspacing="1" cellpadding="0" align="center" bgcolor="White">                            
	                            							<tr>
	                              								<td colspan="4" bgcolor="White"><iframe src="detallaagendacuadrilla.php?servicio=<?php echo $servicicodigo; ?>&zona=<?php echo $zona;?>&subzoncodigo=<?php echo $subzoncodigo;?>&fecreg=<?php echo date("Y-m-d");?>&ciudadcodigo=<?php echo $ciudadcodigo;?>" frameborder="0" name="detall"  height="285" width="100%" align="absmiddle"></iframe></td>
	                            							</tr>
	                       							</table>
	                       						</td>
				  			  </tr>
	                        					
			  			  </table>
	  				</td> 
	 			</tr> 
	 			<!--<tr> 
					<td><div align="center"> 
	  					<input type="image" name="aceptar"  src="../img/aceptar.gif" onClick="form1.accioneditarcuadrilla.value =  1;"  width="86" height="18" alt="Aceptar" border=0>
					</div></td> 
	 			</tr> -->
	 			<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr> 
			  </table> 
<?php if($campnomb){echo '<font face = "Verdana" >Corregir los campos marcados con *</font>';} ?> 



			<input type="hidden" name="cuadricodigo" value="<?php if(!$flageditarcuadrilla){ echo $sbreg[cuadricodigo];}else{ echo $cuadricodigo; } ?>"> 
			<input type="hidden" name="accioneditarcuadrilla"> 
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
			
			<input type="hidden" name="deptonombre" value="<?php echo $deptonombre;  ?>">
			<input type="hidden" name="ciudadnombre" value="<?php echo $ciudadnombre;  ?>">
			<input type="hidden" name="ciudadcodigo" value="<?php echo $ciudadcodigo;  ?>">
			<input type="hidden" name="servicicodigo" value="<?php echo $servicicodigo;  ?>">
			<input type="hidden" name="zonanombre" value="<?php echo $zonanombre;  ?>">
			<input type="hidden" name="zonacodigo" value="<?php echo $zonacodigo;  ?>">
			
			<input type="hidden" name="arreglo_tecnic" value="<?php echo $arreglo_tecnic;  ?>">
			<input type="hidden" name="arreglo_temptecnic" value="<?php echo $arreglo_temptecnic;  ?>">
			<input type="hidden" name="lider" value="<?php echo $lider;  ?>">
		</form> 
	</body> 
<?php // if(!$codigo){ echo " -->"; } ?> 
</html> 
