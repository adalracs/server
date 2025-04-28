<?php
ob_start(); 

include ( '../src/FunGen/sesion/fncvalses.php');
include ( '../src/FunPerPriNiv/pktblvistaotservicioest.php');
include ( '../src/FunPerPriNiv/pktblclienteot.php');
include ( '../src/FunPerPriNiv/pktbltareot.php');
include ( '../src/FunPerPriNiv/pktblusuario.php');
include ( '../src/FunPerPriNiv/pktbltipocump.php');


include ( '../src/FunPerPriNiv/pktbldepartamento.php');
include ( '../src/FunPerPriNiv/pktblciudad.php');
include ( '../src/FunPerPriNiv/pktbltarea.php');
include ( '../src/FunPerPriNiv/pktblservicio.php');
include ( '../src/FunPerPriNiv/pktblpriorida.php');

include ( '../src/FunGen/floadtimehours.php');
include ( '../src/FunGen/floadtimeminut.php');

$ordtracodigo = str_replace("|n","",$ordtracodigo);

if ($ordtracodigo) 
	include('detallaclienteot.php');
$ordtrafecgen = $sbreg[ordtrafecgen];
$ordtrahorgen = $sbreg[ordtrahorgen];

	
if($accionnuevotareot){
	include ("grabacierreotserv.php");
}

ob_end_flush();
?>
<html>
	<head>
		<title>Cierre OS</title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		<meta http-equiv="expires" content="0">
		<link rel="stylesheet" type="text/css" href="temas/Noise/Style.css">
		<SCRIPT LANGUAGE="JavaScript">
			<!-- Begin
			agree = 0;
			//  End -->
		</script>
		<SCRIPT LANGUAGE="JavaScript">
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
			function carga_arreglo(index){
				if(index == 0){
					
				}else{
					
				}
			}
		</script>
		<script language="JavaScript" src="motofech.js"></script>
		<SCRIPT language=JavaScript src="../src/FunGen/jsrsClient.js"		type="text/javascript" ></SCRIPT>
		<style type="text/css">
			<!--
			.Estilo1 {
				color: #FFFFFF;
				font-weight: bold;
			}
			-->
		</style>
	</head>
<?php	 if(!$codigo){ echo "<!--";}	?>
	<body bgcolor="FFFFFF" text="#000000">
		<form name="form1" method="post"  enctype="multipart/form-data">
			<p><font class="NoiseFormHeaderFont">Orden de trabajo</font></p>
			<table width="708" border="0" align="center" cellpadding="2" cellspacing="1" class="NoiseFormTABLE">
				<tr><td width="872" class="NoiseErrorDataTD">&nbsp;</td></tr>
  				<tr><td class="NoiseFieldCaptionTD"><span class="style5"><font color="FFFFFF">Ingresar nuevo registro</font></span></td></tr>
				<tr>
					<td height="214">
						<table width="97%" border="0" cellspacing="0" cellpadding="0" align="center">
 							<tr><td colspan="5">
 								<table width="97%" border="0" cellspacing="1" cellpadding="0" align="center">
 									<tr>
										<!--<td class="NoiseFieldCaptionTD"><span class="Estilo1"><a href="ingrnuevcierreotserv.php?codigo=<?php echo $codigo; ?>" onClick="window.open('consultarotsercierre.php?codigo=<?php echo $codigo?>','secundaria1','status=no,menubar=no,scrollbars=yes,resizable=yes,left=300,width=800,height=600');">&nbsp;N&uacute;mero de OT </a></span></td>-->
										<td class="NoiseFieldCaptionTD"><span class="Estilo1"><input type="button" value="Numero de OT" onClick="window.open('consultarotsercierre.php?codigo=<?php echo $codigo?>','secundaria1','status=no,menubar=no,scrollbars=yes,resizable=yes,left=300,width=800,height=600');"></td>
	  									<td class="NoiseFieldCaptionTD"><span class="Estilo1">&nbsp;<?php if(!$flagdetallarclienteot){ echo $sbreg[ordtracodigo];}else{ echo $ordtracodigo;} ?></span></td>
	  									<td colspan="3"><div align="right">Fecha de carga:&nbsp;&nbsp;<?php if(!$flagdetallarclienteot){echo $annogen."-".$mesgen."-".$diagen;}else{ echo $annogen;}?>&nbsp;<span class="style1" onFocus="if (!agree)this.blur();"></span>- <?php if(!$flagdetallarclienteot){echo $horcarg.":".$minutogen; if($inPm==true){echo " p.m.";}else{echo " a.m.";}}else{ echo $horagen.":".$minutogen;}?></div> </td>
  									</tr>
							  		<tr>
										<td width="17%" class="NoiseFooterTD">&nbsp;ODS</td>
										<td width="35%" class="NoiseDataTD">&nbsp;<?php echo $sbregclienteot[clientsolici]; ?></td>
										<td width="15%" class="NoiseFooterTD">&nbsp;Fecha solicitud</td> 
										<td width="33%" class="NoiseDataTD">&nbsp;<?php echo $sbregclienteot[clientfecsol]; ?></td>
  									</tr>
								</table>
 							</td></tr>
 							<tr><td>
								<table width="97%" border="0" cellspacing="1" cellpadding="0" align="center">
									<tr class="NoiseFooterTD">
										<td>&nbsp;Tipo de orden</td>
										<td>&nbsp;Servicio</td>
  										<td width="13%">&nbsp;Prioridad</td>
										<td width="12%">&nbsp;Departamento</td>
  										<td width="20%">&nbsp;Ciudad</td>
  									</tr>
									<tr class="NoiseDataTD">
										<td >&nbsp;<?php if(!$flagdetallarclienteot){ echo $sbregtarea;}else{ echo $sbregtarea;} ?></td>
										<td>&nbsp;<?php if(!$flagdetallarclienteot){ echo $sbregservicio;}else{ echo $sbregservicio;} ?></td>
										<td>&nbsp;<?php if(!$flagdetallarclienteot){ echo $sbregpriorida;}else{ echo $sbregpriorida;} ?></td>
										<td>&nbsp;<?php if(!$flagdetallarclienteot){ echo $sbregdepto;}else{ echo $sbregdepto;} ?></td>
										<td>&nbsp;<?php if(!$flagdetallarclienteot){ echo $sbregciudad;}else{ echo $sbregciudad;} ?></td>
									</tr>
							  	</table>
							</td></tr>
 							<tr><td colspan="5">&nbsp;</td></tr>
 							<tr>
						  		<td colspan="5">
			    						<table width="97%" border="0" cellspacing="1" cellpadding="0" align="center">
					  					<?php
					  						include('../src/FunGen/floadusuariotareot.php');
					  						floadusuariocierreot($sbreg[ordtracodigo]);
										?>  
	 									<tr><td colspan="5"><hr></td></tr>
	 									<tr>
	 										<td class="NoiseFooterTD"><?php if($flagnuevocierreot && !$clientfecsol){ echo '<font color="Red"> *</font>';} ?>&nbsp;Fecha / Hora</td>
	 										<td colspan="2">
												<input type="text" name="clientfecsol" size="12" value="<?php if(!$flagnuevocierreot){ echo $sbreg[fecha_agen];}else{ echo $clientfecsol; }?>" onFocus="if (!agree)this.blur();">
											    	<img src="../img/cal.gif" border="0" onClick="window.open('formcalendario.php?calencodigo=clientfecsol','cal1','status=no,menubar=no,scrollbars=yes,resizable=yes,left=600,width=200,height=210');">
	              										<select name="horini">
	                										<?php
					 								if($flagnuevocierreot)
					 									echo '<option value ="'.$horini.'">'.$horini.'</option>'."\n";
													floadtimehours();
					  							?>
	   										  	</select>:<select name="minini">
	                										<?php
													if($flagnuevocierreot)
												 		echo '<option value ="'.$minini.'">'.$minini.'</option>'."\n";
					 								floadtimeminut();
						 						?>
	            											</select>
	            											<input type="checkbox" name="pasadmerini" <?php if($flagnuevocierreot){if($pasadmerini)echo "CHECKED";}?>>&nbsp;p.m									  </td>
										  </tr>
										  <tr>
										  	<td class="NoiseFooterTD"><?php if($flagnuevocierreot && !$tipo_despacho){ echo '<font color="Red"> *</font>';} ?>&nbsp;Tipo cumplimiento</td>
		 									<td ><select name="tipcumcodigo">
			  							 	<?php
												$tipcumcodigo1 = $tipcumcodigo;
												echo '<option value = "">Seleccione</option>';
				
												$idcon = fncconn();
												$result = fullscantipocump($idcon);
												
												if($result > 0)
													$numReg = fncnumreg($result);
												
												if($numReg){
													for ($i=0;$i<$numReg;$i++){
														$arr=fncfetch($result,$i);
		
														if($arr[tipcumcodigo] != 0){
				    											echo '<option value ="'.$arr[tipcumcodigo].'" ';
				    										
				    											if($flagnuevotareot){
				    												if($tipcumcodigo1 == $arr[tipcumcodigo])
				    													echo "selected";
				    											}	
				    											echo ">".$arr[tipcumnombre]."</option>"."\n";
														}
													}
												}
											?>
											</select></td>
										</tr>
										<tr>
		 									<td rowspan="3" valign="top" class="NoiseFooterTD"><?php if($flagnuevocierreot && !$nota){ echo '<font color="Red"> *</font>';} ?>&nbsp;Nota</td>
		 									<td colspan="3" rowspan="3"><textarea name="nota" cols="50"><?php echo $nota; ?></textarea></td>
		 								</tr>	
                       							</table>                       						</td>
			  				</tr>
			  				<tr><td>&nbsp;</td></tr>
					  		<tr>
					  			<td colspan="4" align="center"><table width="97%" border="1" cellspacing="1" cellpadding="0" align="center" bgcolor="White">                            
	                            						<tr><td class="NoiseFieldCaptionTD">
	                            							<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" >
	                            								<tr>
	                            									<td align="left"><span class="style5"><font color="FFFFFF">&nbsp;Actividades</font></span></td>
	                            									<td align="right"><input name="masact" type="button" id="button" value="+"  onClick="window.open('consultaractividadcierre.php?codigo=<?php echo $codigo; ?>&servicicodigo=<?php echo $sbreg[servicicodigo]; ?>&arr_actividades='+ form1.arr_actividades.value,'secundaria1','status=no,menubar=no,scrollbars=yes,resizable=yes,left=300,width=700,height=500');" <?php if (!$ordtracodigo){echo "disabled";} ?>>
                                                        										     <input type="button" name="menosact" value="-" <?php if (!$ordtracodigo){echo "disabled";} ?> onclick="load_detall(0,window.frames['lista_actividades'].document.form2.arr_delitem.value);" ></td>
	                            								</tr>	
	                            							</table>
       						  			</td></tr> 
	                        						<tr>
	                              							<td height="152" colspan="4" bgcolor="White"><iframe src="detallaractividadcierre.php?arr_actividades=<?php echo $arr_actividades; ?>&arreglo_act=<?php echo $arreglo_act; ?>" frameborder="0" name="lista_actividades"  height="150" width="100%" align="absmiddle"></iframe></td>
	                            						</tr>
	                            					</table></td>
		                            			</tr>
		 					<tr><td height="16"><label></label></td>
		 					</tr>
							<tr>
								<td colspan="4" align="center">
		                        					<table width="97%" border="1" cellspacing="1" cellpadding="0" align="center" bgcolor="White">        
		                        						<tr><td class="NoiseFieldCaptionTD">
		                            							<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" >
		                            								<tr>
		                            									<td align="left"><span class="style5"><font color="FFFFFF">&nbsp;Item's</font></span></td>
		                            									<td align="right"><input name="masitem" type="button" id="button" value="+" onClick="window.open('consultaritemcierre.php?codigo=<?php echo $codigo?>&servicicodigo=<?php echo $sbreg[servicicodigo]; ?>&arr_items='+ form1.arr_items.value,'secundaria1','status=no,menubar=no,scrollbars=yes,resizable=yes,left=300,width=700,height=500');" <?php if (!$ordtracodigo){echo "disabled";} ?>>
	                                                        										     <input type="button" name="menositem" value="-" <?php if (!$ordtracodigo){echo "disabled";} ?> onclick=" load_detall(1,window.frames['lista_items'].document.form2.arr_delitem.value);" ></td>
		                            								</tr>	
		                            							</table>
       						  				</td></tr>                     
		                        						<tr>
		                              							<td colspan="4" bgcolor="White"><iframe src="detallaritemcierre.php?arr_items=<?php echo $arr_items; ?>&arreglo_ite=<?php echo $arreglo_ite; ?>" frameborder="0" name="lista_items"  height="150" width="100%" align="absmiddle"></iframe></td>
		                            						</tr>	
								    	</table>								</td>
		 					</tr>
		 				</table>
		 			</td>
		 		</tr>
				<tr>
					<td><div align="center">
						<input type="image" name="aceptar"  src="../img/aceptar.gif" onClick="form1.accionnuevotareot.value=1;"  width="86" height="18" alt="Aceptar" border=0>
						<input type="image" name="cancelar"  src="../img/cancelar.gif" onClick="form1.action='maestablcierreotserv.php';"  width="86" height="18" alt="Cancelar" border=0>
					</div></td>
				</tr>
 				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr>
	  		</table>
			<input type="hidden" name="flagnuevocierreot">
			<input type="hidden" name="accionnuevotareot">
			<input type="hidden" name="ordtracodigo" value="<?php echo $ordtracodigo; ?>">
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>">
			
			<input type="hidden" name="arr_actividades" value="<?php echo $arr_actividades; ?>">
			<input type="hidden" name="arr_items" value="<?php echo $arr_items; ?>">
			<input type="hidden" name="arreglo_ite" value="<?php echo $arreglo_ite; ?>">
			<input type="hidden" name="arreglo_act" value="<?php echo $arreglo_act; ?>">
			<input type="hidden" name="clientvalpro" value="<?php echo $clientvalpro; ?>">

		</form>
	</body>
<?php	if(!$codigo){ echo " -->"; } ?>
</html>

