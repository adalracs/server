<?php
ob_start(); 
	include('../src/FunPerPriNiv/pktblrequeritiempo.php');
	include('../src/FunPerPriNiv/pktblservicio.php');
	include('../src/FunPerPriNiv/pktblsegmentos.php');
	include('../src/FunPerPriNiv/pktblsubsegmentos.php');
	include ( '../src/FunGen/sesion/fncvalses.php'); 
	
	if($accionnuevorequerimiento){ 
		include ( 'grabarequeritiempo.php'); 
	} 
	if($accionborrarequerimiento){ 
		include ( 'borrarequeritiempo.php'); 
	} 
	
	
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
		<script language=JavaScript src="../src/FunGen/cargarSubsegmentos.js" type="text/javascript" ></script>
		<SCRIPT LANGUAGE="JavaScript">
		function load_detalles(){
			document.all("lista_reqtiempo").src="detallarrequeritiempo.php?segmencodigo=" +form1.segmencodigo.value;
			//document.all("lista_OT_despacho").src="detallarotservicioest.php?estado=2,3&depto=" + form1.departamento.value + "&ciudad=" + form1.ciudad.value;
		}

</script>
		
		
		
	</head>
<?php if(!$codigo){ echo "<!--";} ?>
	<body bgcolor="FFFFFF" text="#000000">
		<form name="form1" method="POST"  enctype="multipart/form-data">
			<p><font class="NoiseFormHeaderFont">Listado de requrimiento de tiempos</font><br><br></p>
  			<table width="95%" border="0" align="center" cellpadding="2" cellspacing="0" class="NoiseFormTABLE">
				<tr><td colspan="3" class="NoiseColumnTD">&nbsp;</td></tr>
				<tr><td colspan="3" class="NoiseFieldCaptionTD"><span class="style5"><font color="FFFFFF">&nbsp;</font></span></td></tr>
				<tr>
					<td colspan="3">
						<table width="100%" border="0" cellspacing="2" cellpadding="3" align="center">
					 		<tr>
					 			<td colspan="5">
					 				<table border="0" cellspacing="1" cellpadding="0" align="center" width="100%" >
										<tr>
											<td class="NoiseDataTD"><?php if($flagnuevorequeritiempo == 1 && !$segmencodigo){ echo '<font color="red">*</Font>';}?>&nbsp;Segmento&nbsp;<select name="segmencodigo" onChange="load_detalles();cargarSubsegmentos(this.value);">
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
					    									
					    										if($accionfiltrarotserv){
					    											if($segmencodigo1 == $arr[segmencodigo])
					    												echo "selected";
					    										}	
					    										echo ">".$arr[segmennombre]."</option>"."\n";
														}
													}
												}
												
											?>
											</select></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr><td colspan="5" class="NoiseFooterTD">Listado de Requerimiento de tiempos</td></tr>
			  				<tr>
                        						<td colspan="5" align="center">
                        							<table width="100%" border="1" cellspacing="1" cellpadding="0" align="center" bgcolor="White">                            
                            								<tr>
                              									<td colspan="5" bgcolor="White"><iframe src="detallarrequeritiempo.php?segmencodigo=<?php echo $segmencodigo;  ?>" frameborder="0" name="lista_reqtiempo"  height="150" width="100%" align="absmiddle"></iframe></td>
                            								</tr>
                       							</table>
                       						</td>
			  		  		</tr>
							<tr>
								<td class="NoiseFooterTD"><?php if($flagnuevorequeritiempo == 1 && !$reqtieproceso){ echo '<font color="red">*</Font>';}?>&nbsp;Proceso</td>
								<td class="NoiseFooterTD"><?php if($flagnuevorequeritiempo == 1 && !$servicicodigo){ echo '<font color="red">*</Font>';}?>&nbsp;Servicio</td>
								<td class="NoiseFooterTD"><?php if($flagnuevorequeritiempo == 1 && !$subsegcodigo){ echo '<font color="red">*</Font>';}?>&nbsp;Subsegmento</td>
								<td class="NoiseFooterTD"><?php if($flagnuevorequeritiempo == 1 && !$reqtietipciu){ echo '<font color="red">*</Font>';}?>&nbsp;Tipo Ciudad</td>
								<td class="NoiseFooterTD"><?php if($flagnuevorequeritiempo == 1 && !$reqtievalor){ echo '<font color="red">*</Font>';}?>&nbsp;Plazo de tiempo</td>
							</tr>
							<tr>
								<td class="NoiseFooterTD"><select name="reqtieproceso" onChange="">
												<option value="1">Provisi&oacute;n</option>
												<option value="2">Soporte t&eacute;cnico</option>
											       </select>
								</td>
								<td class="NoiseFooterTD"><select name="servicicodigo">
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
								<td class="NoiseFooterTD"><select name="subsegcodigo">
								<?php
									$subsegcodigo1 = $subsegcodigo;
									echo '<option value = "">Seleccione</option>';
														
									$idcon = fncconn();
									$iregsubsegmentos[subsegmencod] = $segmencodigo1;
									$iregsubsegmentosop[subsegmencod]="=";
									$result = dinamicscanopsubsegmentos($iregsubsegmentos,$iregsubsegmentosop,$idcon);
											
									if($result > 0)
										$numReg = fncnumreg($result);
														
									if($numReg){
										for ($i=0;$i<$numReg;$i++){
											$arr=fncfetch($result,$i);
													
											if($arr[subsegcodigo] != 0){
						    						echo '<option value ="'.$arr[subsegcodigo].'" ';
						    						
						    						if($accionfiltrarotserv){		
													if($subsegcodigo1 == $arr[subsegcodigo])
						    								echo "selected";
						    						}
						    						echo ">".$arr[subsegnombre]."</option>"."\n";
											}
										}
									}
								?>
											</select></td>
								<td class="NoiseFooterTD"><select name="reqtietipciu">
												<option value="1">Ciudad Tipo 1</option>
												<option value="2">Ciudad Tipo 2</option>
												<option value="3">Ciudad Tipo 3</option>
											       </select></td>
								<td class="NoiseFooterTD"><input name="reqtievalor" type="text" width="50%"></td>
							</tr>
													 	
							
							
                        					<tr>
                        						<td colspan="5" align="right"><input type="submit" name="nuevo" onClick="form1.accionnuevorequerimiento.value = 1;" alt="Nuevo Registro" value="Agregar">
                        						&nbsp;<input type="submit" name="borrar" onClick="form1.reqtiecodigo.value = window.frames['lista_reqtiempo'].document.form2.reqtiecodigo.value;form1.accionborrarequerimiento.value = 1;" alt="Nuevo Registro"  value="Quitar"></td>
                        					</tr>

		  		  		</table>
			  		</td>
  		  		</tr>
				<tr><td colspan="3" class="NoiseColumnTD">&nbsp;</td></tr>
  	  		</table>
		
			<label></label>
			<input type="hidden" name="accionnuevorequerimiento">
			<input type="hidden" name="accionborrarequerimiento">
			<input type="hidden" name="flagnuevorequeritiempo">
			<input type="hidden" name="reqtiecodigo">
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>">	
		</form>
	</body>
<?php if($campnomb){echo '<font face = "Verdana" >Corregir los campos marcados con *</font>';} ?> 
<?php if(!$codigo){ echo " -->"; } ?>
</html>