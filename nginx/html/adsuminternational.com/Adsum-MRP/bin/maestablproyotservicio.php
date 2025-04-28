<?php 
ob_start();
	include ( '../src/FunGen/sesion/fnccantrow.php');
	include ( '../src/FunGen/sesion/fnccantrow1.php');
	include ( '../src/FunPerPriNiv/limitscan.php');
	include ( '../src/FunGen/sesion/fncvalses.php');
	include ( '../src/FunPerPriNiv/pktblvistaotservicioest.php');
	include ( '../src/FunPerPriNiv/pktblservicio.php');
	include ( '../src/FunPerPriNiv/pktbltarea.php');
	include ( '../src/FunPerPriNiv/pktblpriorida.php');
	include ( '../src/FunPerPriNiv/pktbldepartamento.php');
	include ( '../src/FunPerPriNiv/pktblciudad.php');
	include ( '../src/FunPerPriNiv/pktblotestado.php');
	include ( '../src/FunPerPriNiv/pktblot.php');
	
	
	include ( '../src/FunGen/sesion/fncalmdat.php');
	include ( '../src/FunGen/sesion/fnccaf.php');
	$reccomact =  fnccaf($GLOBALS[usuacodi],$_SERVER["SCRIPT_FILENAME"]);

	if($accionborrarotservicio){
		include ( 'borraotservicio.php');
	}else{
		
		if($accionconsultarvistaotservicio){
			$nusw = 0;
			$nombcamp = strtok ($columnas,",");
		
			while ($nombcamp){
				$nombcamp = trim($nombcamp);
				$recarreglo[$nombcamp] = $$nombcamp;
				if($recarreglo[$nombcamp]){ $nusw =1;}
				$nombcamp = strtok(",");
			}
			if(!$nusw){
				$accionconsultarvistaotservicio = 0;
			}
		}
		if($accionfiltrarotserv){
			unset($inicio);
			unset($fin);
			unset($recarreglo);
			
			if($departamento){
				$recarreglo[deptocodigo] = $departamento;
				if($ciudad)
					$recarreglo[ciudadcodigo] = $ciudad;
			}
			if($servicicodigo)
				$recarreglo[servicicodigo] = $servicicodigo;
				
			if(!$recarreglo)
				$accionconsultarvistaotservicio = 0;
			else 
				$accionconsultarvistaotservicio = 1;
		}
	}
	include ( '../src/FunGen/sesion/fncaumdec.php');
ob_end_flush();
?> 
<!-- Propiedad intelectual de Adsum SA (c) 
-Todos los derechos reservados- 
Creado con WAG Adsum 
Autor: cabedoya
Fecha: 29-November-2007 
GenVers: 3.1 --> 
<html> 
	<head> 
		<title>Registros de OT Proyecto</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0"> 
		<link rel="stylesheet" type="text/css" href="temas/Noise/Style.css"> 
		<script language="JavaScript" type="text/javascript" src="../src/FunGen/fncsetcheck.js"></script>
		<script language="javascript" type="text/javascript" src="../src/FunGen/fncremembercheck.js"></script>
		<script language="JavaScript" src="../src/FunGen/jsrsClient.js"		type="text/javascript" ></SCRIPT>
		<script language="JavaScript" src="../src/FunGen/cargarCiudades.js" type="text/javascript" ></script>
	</head>
<?php if(!$codigo){ echo "<!--";} ?> 
	<body bgcolor="FFFFFF" class="NoisePageBODY"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Listado de ordenes de proyecto</font><br><br></p> 
			<table border="0" cellspacing="1" cellpadding="2" align="center" class="NoiseFormTABLE" width="95%"> 
 				<tr><td colspan="6" class="NoiseErrorDataTD">&nbsp;</td></tr> 
 				<tr>
					<td colspan="6"><table border="0" cellspacing="1" cellpadding="0" align="center" width="100%">
						<tr>
						  <td class="NoiseColumnTD">Departamento</td>
						  <td class="NoiseColumnTD">Ciudad</td>
						  <td class="NoiseColumnTD">Servicio</td>
					  <tr>
						  <td class="NoiseDataTD" width="30%"><select name="departamento" onChange="cargarCiudades(this.value); form1.accionfiltrarotserv.value=1;form1.submit();">
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
						  </select></td>
						  <td class="NoiseDataTD" width="30%"><select name="ciudad" onChange="form1.accionfiltrarotserv.value=1;form1.submit();">
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
						  <td class="NoiseDataTD" width="30%"><select name="servicicodigo" onChange="form1.accionfiltrarotserv.value=1;form1.submit();">
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
					  </table></td>
				</tr>
  				<tr> 
  					<td> 
  					<?php 
  						if($reccomact[nuevo]){
  							echo '<input type="image" name="nuevo"  src="../img/nuevo.gif" onclick="form1.action='."'".'ingrnuevproyotservicio.php'."'".';"  width="86" 
								 height="18" alt="Nuevo Registro" border=0 ';
  							
  							if($flagcheck)
  								echo "disabled";
  							echo '>';
  						}
  						if($reccomact[consultar]){
  							echo '<input type="image" name="consultar"  src="../img/consulta.gif" onclick="form1.action='."'".'consultarproyotservicio.php'."'".';"  width="86" 
								 height="18" alt="Consultar" border=0 ';
  							
  							if($flagcheck)
  								echo "disabled";
  							echo '>';
  						}
					?> 
 					</td> 
 					<td width="42"><input type="image" name="adelanta"  src="../img/adelanta.gif" onClick="<?php if($flagcheck) echo 'cargarcheck(this.form); '; ?>form1.mov.value = 'menos';form1.action='maestablproyotservicio.php';" alt="Anterior"></td> 
 					<td width="46"><font size="2" color="#CC9900">Anterior</font></td> 
 					<td width="50"> 
  					<?php 
  						$intervalo = fncaumdec('vistaotservicioest',$inicio,$fin,$mov,$accionconsultarvistaotservicio,$recarreglo);
  						$cantrow = $intervalo[total];
  						if($intervalo[idtrans]){ $idtrans = $intervalo[idtrans]; }
					?> 
 					</td> 
 					<td width="53"><div align="right"><font color="#CC9900">Siguiente</font></div></td> 
 					<td width="53"><input type="image" name="atras"  src="../img/atrasa.gif" onClick="<?php if($flagcheck) echo 'cargarcheck(this.form); '; ?>form1.mov.value = 'mas';form1.action='maestablproyotservicio.php';" alt="Siguiente"></td> 
 				</tr> 
 				<tr> 
  					<td colspan="6"><div align="right"> 
   					<?php 
   						if($reccomact[detallar]){
   							echo '<b><input type="image" name="detallar" src="../img/verdetal.gif" onclick="form1.action='."'".'detallarproyotservicio.php'."'".';"  width="87" 
   								 height="19"  alt="Ver detalle" border=0 ';
   							
   							if($flagcheck)
   								echo "disabled";
   							echo '></b>';
   						}
   						if($reccomact[borrar]){
   							echo  '<b><input type="image" name="borrar"  src="../img/borrar.gif" onclick="';
   					
   							if($flagcheck){
   								echo 'cargarcheck(this.form); ';
   								echo 'form1.action='."'".'maestablborrgen.php';
   							}
   							else echo 'form1.action='."'".'borrarproyotservicio.php';

   							echo "'".';"  width="87" height="19" alt="Borrar Registro" border=0></b>'; 
   						}
   						if($reccomact[modificar]){
   							echo '<b><input type="image" name="modificar"  src="../img/modifica.gif" onclick="form1.action='."'".'editarproyotservicio.php'."'".';"  width="87" height="19"  
								 alt="Modificar Registro" border=0 ';
   						
   							if($flagcheck)
   								echo "disabled";
   							echo '></b>';
   						}
					?>
 					</div></td> 
 				</tr> 
 				<tr> 
  					<td colspan="6"> 
  						<table width="100%" border="0" align="center" cellspacing="2" cellpadding="1"> 
							<tr> 
								<td width="7%" class="NoiseFieldCaptionTD"><span class="style5"><font color="#FFFFFF"><a href="#" onClick="setForm('<?php echo $inicio;?>', '<?php echo $fin;?>', '<?php echo $mov;?>');" style="text-decoration:none; color:#FFFFFF;">Sel.&nbsp;<input type="<?php if($flagcheck) echo "radio"; else echo "checkbox"; ?>"></a></font></span></td> 
								  <td class="NoiseFieldCaptionTD" width="8%"><font color="#FFFFFF">&nbsp;No. Orden</font></td>
								  <td class="NoiseFieldCaptionTD" width="15%"><font color="#FFFFFF">&nbsp;ODS</font></td>
								  <td class="NoiseFieldCaptionTD" width="15%"><font color="#FFFFFF">&nbsp;Departamento</font></td>
								  <td class="NoiseFieldCaptionTD" width="15%"><font color="#FFFFFF">&nbsp;Ciudad</font></td>
								  <td class="NoiseFieldCaptionTD" width="15%"><font color="#FFFFFF">&nbsp;Servicio</font></td>
								  <td class="NoiseFieldCaptionTD" width="10%"><font color="#FFFFFF">&nbsp;Tipo orden</font></td>
								<!--  <td class="NoiseFieldCaptionTD" width="10%"><font color="#FFFFFF">&nbsp;Prioridad</font></td>-->
								  <td class="NoiseFieldCaptionTD" width="10%"><font color="#FFFFFF">&nbsp;Estado</font></td>
	
							</tr> 
							<?php 
								include ( '../src/FunGen/sesion/fncvisregvistaotservicio.php');
								$reg[0] = 'ordtracodigo';
								$reg1[0] = 'n';
								$nureturn = fncvisreg('vistaotservicioest', $reg, $reg1, $idtrans, $arr_borrar, $flagcheck);
							?>
   						</table> 
   					</td> 
  				</tr> 
  				<tr>
  					<td colspan="6"> <div align="right"></div><div align="right"> 
						<?php 
							if($reccomact[detallar]){
								echo  '<b><input type="image" name="detallar"  src="../img/verdetal.gif" onclick="form1.action='."'".'detallarproyotservicio.php'."'".';"  width="87" 
									  height="19" alt="Ver detalle" border=0 ';
						
								if($flagcheck)
									echo "disabled";
								echo '></b>';
							}
							if($reccomact[borrar]){
								echo  '<b><input type="image" name="borrar"  src="../img/borrar.gif" onclick="';
								
								if($flagcheck){
									echo 'cargarcheck(this.form); ';
									echo 'form1.action='."'".'maestablborrgen.php';
								}
								else echo 'form1.action='."'".'borrarproyotservicio.php';
								echo "'".';"  width="87" height="19" alt="Borrar Registro" border=0></b>'; 
							}
							if($reccomact[modificar]){
								echo  '<b><input type="image" name="modificar"  src="../img/modifica.gif" onclick="form1.action='."'".'editarproyotservicio.php'."'".';"  width="87" height="19" 
									  alt="Modificar Registro" border=0 ';	
								
								if($flagcheck)
									echo "disabled";
								echo '></b>';
							}
						?> 
  					</div></td> 
  				</tr> 
  				<tr> 
   					<td><a href="javascript:;" ><img type="image" src="../img/ayuda.gif" name="Ayuda" onClick="window.open('navegacion.htm','ambinave','status=no,menubar=no,scrollbars=yes,resizable=yes,left=300,width=800,height=600');" width="86" height="18" alt="Ayuda" border=0 ></a></td> 
   					<td width="42"><input type="image" name="primero"  src="../img/primero.gif" onClick="<?php if($flagcheck) echo 'cargarcheck(this.form); '; ?>form1.mov.value = 'primero';form1.action='maestablproyotservicio.php';" alt="Primero"></td> 
   					<td width="46"><input type="image" name="adelanta"  src="../img/adelanta.gif" onClick="<?php if($flagcheck) echo 'cargarcheck(this.form); '; ?>form1.mov.value = 'menos';form1.action='maestablproyotservicio.php';" alt="Anterior"></td> 
   					<td width="50"> 
					<?php 
						echo '<font color="#006699" size="2" face="Arial, Helvetica, sans-serif">'.$intervalo[inicio].'-'.$intervalo[fin].' de '.$intervalo[total].'</font>'; 
					?> 
   					</td> 
   					<td width="53"><input type="image" name="atras2"  src="../img/atrasa.gif" onClick="<?php if($flagcheck) echo 'cargarcheck(this.form); '; ?>form1.mov.value = 'mas';form1.action='maestablproyotservicio.php';" alt="Siguiente"></td> 
   					<td width="53"><input type="image" name="ultimo"  src="../img/ultimo.gif" onClick="<?php if($flagcheck) echo 'cargarcheck(this.form); '; ?>form1.mov.value = 'ultimo';form1.action='maestablproyotservicio.php';" alt="Ultimo"></td> 
  				</tr> 
  				<tr><td colspan="6" class="NoiseErrorDataTD">&nbsp;</td></tr> 
 			</table> 
 			
 			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
 			<input type="hidden" name="inicio" value="<?php echo $intervalo[inicio]; ?>"> 
 			<input type="hidden" name="fin" value="<?php echo $intervalo[fin]; ?>"> 
 			<input type="hidden" name="nombtabl" value="vistaotservicioest"> 
			<input type="hidden" name="columnas" value="ordtracodigo, 
	clientsolici, 
	deptocodigo,
	ciudadcodigo,
	servicicodigo, 
	tareacodigo, 
	prioricodigo, 
	usuacodi,
	otestacodigo
	"> 
			<input type="hidden" name="departamento1" value="<?php echo $departamento; ?>"> 
			<input type="hidden" name="ciudad1" value="<?php echo $ciudad; ?>"> 
			<input type="hidden" name="servicicodigo1" value="<?php echo $servicicodigo; ?>"> 
 			<input type="hidden" name="accionconsultarvistaotservicio" value="<?php echo $accionconsultarvistaotservicio; ?>"> 
 			<input type="hidden" name="accionfiltrarotserv" value="<?php echo $accionfiltrarotserv; ?>"> 
 			
 			<input type="hidden" name="mov"> 
  			<!-- Permite el cambio de checkbox/radiobuttion --> 
			<input type="hidden" name="flagcheck" value="<?php echo $flagcheck;?>">
			<!-- Campos a visualizar en maestablborrgen		-->
			<!--											-->
			<input type="hidden" name="arr_borrar" value="<?php echo $arr_borrar;?>">
			<input type="hidden" name="arreglo_b">
			<!--											-->
 		</form> 
 	</body> 
<?php if(!$codigo){ echo " -->"; } ?> 
</html> 
