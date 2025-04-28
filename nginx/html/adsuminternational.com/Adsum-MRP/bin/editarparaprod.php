<?php
	include ( '../src/FunGen/sesion/fncvalses.php');
	include ( '../src/FunPerPriNiv/pktblplanta.php');
	include ( '../src/FunPerPriNiv/pktblsistema.php');
	include ( '../src/FunPerPriNiv/pktblequipo.php');
	include ( '../src/FunPerPriNiv/pktblcomponen.php');
	include ( '../src/FunPerPriNiv/pktblparte.php');
	
	include ( '../src/FunPerPriNiv/pktblcausafalla.php');
	include ( '../src/FunPerPriNiv/pktbltipotrab.php');
	include ( '../src/FunPerPriNiv/pktbltipofall.php');
	
	include ( '../src/FunPerPriNiv/pktblusuario.php');
	include ( '../src/FunGen/floadtimehours.php');
	include ( '../src/FunGen/floadtimeminut.php');
	
	if($accioneditarparaprod){
		include ( 'editaparaprod.php');
	}
	$idcon = fncconn();
	
	ob_end_flush();
	if(!$flageditarplanta)
	{
		include ( '../src/FunGen/sesion/fnccarga.php');
		$sbreg = fnccarga($nombtabl,$radiobutton);
		if (!$sbreg)
		{
			include( '../src/FunGen/fnccontfron.php');
		}
		
		$idcon = fncconn();
		
		$plantacodigo = $sbreg['plantacodigo'];
		$sistemcodigo = $sbreg['sistemcodigo'];
		$equipocodigo = $sbreg['equipocodigo'];
		$componcodigo = $sbreg['componcodigo'];
		$partecodigo = $sbreg['partecodigo'];
		$caufallcodigo = $sbreg['caufallcodigo'];
		$tipfalcodigo = $sbreg['tipfalcodigo'];
		$parprofecini = $sbreg['parprofecini'];
		
		$parprohorini = explode(":", $sbreg['parprohorini']);

		$horini = $parprohorini[0];
		$minini = $parprohorini[1];
		
		if($horini > 12)
		{
			$horini = $horini - 12;
			$pasadmerini = 1;
		}
		elseif($horini == '00')			 
			$horini = 12;
		
		$parprofecfin = $sbreg['parprofecfin'];
		$parprohorfin = explode(":", $sbreg['parprohorfin']);
		
		$horfin = $parprohorfin[0];
		$minfin = $parprohorfin[1];
		
		if($horfin > 12)
		{
			$horfin = $horfin - 12;
			$pasadmerfin = 1;
		}
		elseif($horfin == '00')			 
			$horfin = 12;
		
		$tiptracodigo = $sbreg['tiptracodigo'];
		
	}
	
?>
<html>
	<head>
		<title>editar registro de Parada de produccion</title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		<meta http-equiv="expires" content="0">
		<link rel="stylesheet" type="text/css" href = "temas/Noise/Style.css">
		<link rel="stylesheet" type="text/css" href="temas/Noise/help.css">	
			
		<script language="JavaScript" src="mparaprodofech.js"></script>
		<SCRIPT language=JavaScript src="../src/FunGen/jsrsClient.js"		type="text/javascript" ></SCRIPT>
		<script language=JavaScript src="../src/FunGen/cargarSistema.js" type="text/javascript" ></script>
		<script language=JavaScript src="../src/FunGen/cargarEquipos.js" type="text/javascript" ></script>
		<script language=JavaScript src="../src/FunGen/cargarComponen.js" type="text/javascript" ></script>
		<script language=JavaScript src="../src/FunGen/cargarParte.js" type="text/javascript" ></script>
		<script language=JavaScript src="../src/FunGen/cargarFallaPlanta.js" type="text/javascript" ></script>
		<script language=JavaScript src="../src/FunGen/fncbparaprodton.js" type="text/javascript" ></script>
		<script language=JavaScript src="../src/FunSpec/fncshowspanparaprod.js" type="text/javascript" ></script>
		<script language=JavaScript src="../src/FunGen/cargarcausasFallas.js" type="text/javascript" ></script>
		<script language=JavaScript src="../src/FunGen/ajaxgenerico.js" type="text/javascript" ></script>
		<style type="text/css">
			<!--
			.style1 {font-size: 12px}
			-->
		</style>
		<SCRIPT LANGUAGE="JavaScript">
			 function verocultar(cual, index) {
				var c=cual.nextSibling;
				if(c.style.display=='none') {
					c.style.display='block';
					document.getElementById("row"+ index).src = "temas/Noise/AscOn.gif";			           
				} else {
					c.style.display='none';
					document.getElementById("row"+ index).src = "temas/Noise/DescOn.gif";			           			           
				}
				return false;
			 }
			 
			 function load_detall(delitem, arr_detall, arr_detalltmp){
				
				var enc = 0;
				 var new_arreglo = "";
				if(delitem == 0){ new_arreglo = arr_detall; }
						
				arreglogen = arr_detall.split(",");
				arreglogentmp = arr_detalltmp.split(",");
				
				if(arreglogen != ""){
					if (arreglogentmp != ""){
						for(var i=0; i < (arreglogentmp.length); i++){
							if(arreglogentmp[i] != ''){
								for(var j = 0; j < (arreglogen.length); j++){
									if (arreglogen[j] == arreglogentmp[i]){
										enc = 1;
									}
								}
								if(enc == 0){
									if(new_arreglo == ''){
										new_arreglo = arreglogentmp[i];
									}else{
										new_arreglo = new_arreglo + ',' + arreglogentmp[i];
									}
								}else{
									enc = 0;
								}
							}
						}
					}
				}
				
				if(new_arreglo != ""){
					window.document.form1.arreglo_tecnic.value = new_arreglo;
				}else{
					window.document.form1.arreglo_tecnic.value = '';
					if(delitem == 0){	window.document.form1.arreglo_tecnic.value = arr_detalltmp;}
					if(delitem == 1 && arr_detall == ""){	window.document.form1.arreglo_tecnic.value = arr_detalltmp;}
				}
				window.document.form1.arreglo_temptecnic.value = '';
				
				document.all("detall").src="detallausuaparaprod.php?arr_detall="+ window.document.form1.arreglo_tecnic.value + "&lider="+ window.document.form1.lider.value;
			} 
			function Changeindc(Index, usuaplanta){
				if(Index == 0){
					LoadDetalleequipo(form1.equipocodigo.value,usuaplanta);
					LoadDetallecomponen(form1.componcodigo.value,usuaplanta);
				}else{
					LoadDetalleequipo(form1.equipocodigo_auto.value,usuaplanta);
					LoadDetallecomponen(form1.componcodigo_auto.value,usuaplanta);
				}
			}
			function LoadDetalleequipo(equipocodigo,usuaplanta){
				document.all("equipodet").src="detallarotequipo.php?equipocodigo="+ equipocodigo + "&usuaplanta=" + usuaplanta;
			}
			function LoadDetallecomponen(componcodigo,usuaplanta){
				var index = form1.equipparaprodexto.value;
				
				if(index == 0){
					document.all("componendet").src="detallarotcomponen.php?componcodigo="+ componcodigo + "&equipocodigo="+ form1.equipocodigo.value + "&usuaplanta=" + usuaplanta;
				}else{
					document.all("componendet").src="detallarotcomponen.php?componcodigo="+ componcodigo + "&equipocodigo="+ form1.equipocodigo_auto.value + "&usuaplanta=" + usuaplanta;
				}
			}
			function hora()
			{
				if(form1.parada[1].checked)
				{
					
					
					document.getElementById('horfin').style.display = 'none';
					document.getElementById('minfin').style.display = 'none';
					
					document.getElementById('horfin').value = '';
					document.getElementById('minfin').value = '';
					document.getElementById('pm').style.display = 'none';
					document.getElementById('pms').style.display = 'none';
					document.getElementById('puntos').style.display = 'none';
				}
				else
				{
					
					document.getElementById('horfin').style.display = '';
					document.getElementById('minfin').style.display = '';
					document.getElementById('pm').style.display = '';
					document.getElementById('puntos').style.display = '';
					document.getElementById('pms').style.display = '';
				}
			}
			function datooculto(planta)
			{
				document.getElementById('departoculto').value=planta;
			}
		</script>
	</head>
<?php if(!$codigo){ echo "<!--";} ?>
	<body bgcolor="FFFFFF" text="#000000">
		<form name="form1" method="post"  enctype="multipart/form-data">
			<p><font class="NoiseFormHeaderFont">Paradas de producci&oacute;n</font></p> 
			<table border="0" cellspacing="1" cellpadding="2" align="center" class="NoiseFormTABLE" width="800">
				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr>
				<tr><td class="NoiseFieldCaptionTD"><span class="style5"><font color="FFFFFF">Editar registro</font></span>	</td></tr>
				<tr>
					<td>
						<table width="95%" border="0" cellspacing="1" cellpadding="0" align="center">
							<tr class="NoiseSeparatorTD"><td colspan="4">&nbsp;Fecha / Hora&nbsp; | &nbsp;<?php $fecha=date("Y-m-d"); $hora = date("h:i a");  echo $fecha." / ".$hora; ?></td></tr>
							<tr>
								<td width="25%" class="NoiseSeparatorTD"><?php if($campnomb["plantacodigo"] == 1) echo '<font face= "Verdana" color="Red">*</font>'; ?>&nbsp;Planta</td>
							  	<td colspan="3" class="NoiseSeparatorTD">
							    	<select name="plantacodigo" onChange="cargarSistemas(this.value);" <?php if($equipparaprodexto){ echo "disabled";} ?>>
							    		<option value = "">Seleccione</option>
                                  		<?php
											include ('../src/FunGen/floadplanta.php');
											floadplanta($plantacodigo,$idcon);
										?>
                                	</select>
								</td>
							</tr>
							<tr>
								<td width="25%" class="NoiseDataTD"><?php if($campnomb["sistemcodigo"] == 1) echo '<font face= "Verdana" color="Red">*</font>'; ?>&nbsp;Sistema</td>
								<td colspan="3" class="NoiseFoparaproderTD">
									<select name="sistemcodigo" onChange="cargarEquipos(this.value);" <?php if($equipparaprodexto){ echo "disabled";} ?>>
										<option value = "">Seleccione</option>
          								<?php
											include ('../src/FunGen/floadsistemaot.php');
											floadsistemaot($sistemcodigo,$plantacodigo,$idcon);
            							?>
									</select>
								</td>
							</tr>
          					<tr>
          						<td class="NoiseDataTD"><?php if($campnomb["equipocodigo"] == 1)echo '<font face= "Verdana" color="Red">*</font>'; ?>&nbsp;Equipo&nbsp;</td>
								<td class="NoiseFoparaproderTD"  colspan="3">
									<select name="equipocodigo"  onChange=" LoadDetalleequipo(this.value,'<?php echo $GLOBALS['usuaplanta']; ?>'); cargarComponen(this.value); ">
										<option value = "">Seleccione</option>
            							<?php
											include ('../src/FunGen/floadequipoot.php');
											floadequipoot($equipocodigo, $sistemcodigo,$idcon);
		    							?>
									</select>
								</td>
							</tr>
							<tr>
								<td class="NoiseDataTD"><?php if($campnomb["componcodigo"] == 1)echo '<font face= "Verdana" color="Red">*</font>'; ?>&nbsp;Componente&nbsp;</td>
								<td class="NoiseFoparaproderTD" colspan="3">
									<select name="componcodigo" onChange="LoadDetallecomponen(this.value,'<?php echo $GLOBALS['usuaplanta']; ?>'); ">
            							<option value = "">Seleccione</option>
		    							<?php
											include ('../src/FunGen/floadcomponenequi.php');
											floadcomponenequi($componcodigo,$equipocodigo,$idcon);
										?>
       								</select>
								</td>
							</tr>
							<tr><td class="NoiseErrorDataTD" colspan="4"></td></tr> 
							<tr><td class="NoiseFieldCaptionTD" colspan="4"></td></tr> 
							<tr><td class="NoiseErrorDataTD" colspan="4"></td></tr>
							<tr class="NoiseFoparaproderTD">
								<td colspan="4" class="NoiseFoparaproderTD" valign="middle">
									<a onClick="return verocultar(this,'0');" href="javascript:void(0);" >Equipo&nbsp;<img id="row0"  align="middle" align="top"  src="temas/Noise/DescOn.gif" border="0"></a><div style="display: none;">
										<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center">               
											<tr><td class="NoiseFieldCaptionTD"></td></tr> 										             
											<tr>
												<td height="110"  class="NoiseFoparaproderTD"><iframe  frameborder="0" name="equipodet"   height="110" width="100%" align="absmiddle" src="detallarotequipo.php?equipocodigo=<?php if($equipparaprodexto){ echo $equipocodigo_auto; }else{  echo $equipocodigo; } ?>&usuaplanta=<?php echo $GLOBALS['usuaplanta'];  ?>"></iframe></td> <!--src="detallarusuaplanta.php?plantall=<?php echo $plantatmp; ?>&arrdata=<?php echo $arrplantas; ?>"-->
											</tr>
										</table>
									</div>								
								</td>
							</tr>
							<tr><td class="NoiseErrorDataTD" colspan="4"></td></tr> 
							<tr><td class="NoiseFieldCaptionTD" colspan="4"></td></tr> 
							<tr><td class="NoiseErrorDataTD" colspan="4"></td></tr>
							<tr><td class="NoiseErrorDataTD" colspan="4"></td></tr>
							<tr class="NoiseFoparaproderTD">
								<td colspan="4" class="NoiseFoparaproderTD" valign="middle">
									<a onClick="return verocultar(this,'1');" href="javascript:void(0);" >Componente&nbsp;<img id="row1"  align="middle" align="top"  src="temas/Noise/DescOn.gif" border="0"></a><div style="display: none;">
										<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center">       
         											<tr><td class="NoiseFieldCaptionTD"></td></tr> 
											<tr>
												<td height="110"  class="NoiseFoparaproderTD"><iframe  frameborder="0" name="componendet"  height="110" width="100%" align="absmiddle" src="detallarotcomponen.php?componcodigo=<?php if($equipparaprodexto){ echo $componcodigo_auto; }else{  echo $componcodigo; } ?>&equipocodigo=<?php if($equipparaprodexto){ echo $equipocodigo_auto; }else{  echo $equipocodigo; } ?>&usuaplanta=<?php echo $GLOBALS['usuaplanta'];  ?>"></iframe></td> <!--src="detallarusuaplanta.php?plantall=<?php echo $plantatmp; ?>&arrdata=<?php echo $arrplantas; ?>"-->
											</tr>
										</table>
									</div>								
								</td>
							</tr>
							<tr><td class="NoiseErrorDataTD" colspan="4"></td></tr> 
							<tr><td class="NoiseFieldCaptionTD" colspan="4"></td></tr> 
							<tr><td class="NoiseErrorDataTD" colspan="4"></td></tr>
							<tr><td class="NoiseErrorDataTD" colspan="4"></td></tr>
							<tr>
								<td class="NoiseDataTD"><?php if($campnomb["caufallcodigo"] == 1){$caufallcodigo = null; echo '<font face= "Verdana" color="Red">*</font>';}?>&nbsp;Causa de Falla</td>
								<td class="NoiseFoparaproderTD" >
									<select name="caufallcodigo">
                                  		<option value = "">Seleccione</option>
										<?php
											include ('../src/FunGen/floadcausafalla.php');
											floadcausafalla($caufallcodigo,$idcon);
										?>
                                	</select>
                                </td>
								<td class="NoiseDataTD"><?php if($campnomb["tipfalcodigo"] == 1){$tipfalcodigo = null; echo '<font face= "Verdana" color="Red">*</font>';}?>&nbsp;Falla</td>
							  	<td class="NoiseFoparaproderTD">
							  		<select name="tipfalcodigo">
							  			<option value="">Seleccione</option>
                                		<?php
						 				 	include ('../src/FunGen/floadtipofall.php');
						 				 	floadtipofall($tipfalcodigo, $idcon);
										?>
                              		</select>
                              	</td>
						  	</tr>
							<tr><td colspan="4" class="NoiseDataTD"><?php if($campnomb["parprodescri"] == 1){$parprodescri = null; echo '<font face= "Verdana" color="Red">*</font>';} ?>&nbsp;Descripci&oacute;n de la parada</td></tr>
							<tr><td colspan="4"  class="NoiseDataTD"><textarea name="parprodescri" cols="60" rows="2" wrap="VIRTUAL"><?php if(!$flageditarparaprod){echo $sbreg["parprodescri"];}else{ echo $parprodescri;}?></textarea></td></tr>
							<tr><td class="NoiseErrorDataTD" colspan="4"></td></tr> 
							<tr><td class="NoiseFieldCaptionTD" colspan="4"></td></tr> 
							<tr><td class="NoiseErrorDataTD" colspan="4"></td></tr>
							<tr><td class="NoiseErrorDataTD" colspan="4"></td></tr>							
							<tr>
								<td colspan="4"  class="NoiseFoparaproderTD"><?php if($campnomb["parprofecini"] == 1){$parprofecini = null; echo '<font face= "Verdana" color="Red">*</font>';}?>Fecha de inicio
									<input type="text" name="parprofecini" size="8" value="<?php if(!$flageditarparaprod){echo $parprofecini;} else {echo $parprofecini;}?>" onFocus="if (!agree)this.blur();">&nbsp;
	              					<img src="../img/cal.gif" align="absmiddle" border="0" onClick="window.open('formcalendario.php?calencodigo=parprofecini','cal1','status=no,menubar=no,scrollbars=yes,resizable=yes,left=600,width=200,height=210');">
									<select name="parprohorini">
	                					<?php
											floadtimehours($horini);
					  					?>
	                				</select>
	            					:
	            					<select name="parprominini">
	                					<?php
											floadtimeminut($minini);
					 					?>
	            					</select>
	            					<input  type="checkbox"  name="pasadmerini" <?php if($flageditarparaprod){if($pasadmerini)echo "CHECKED";}else{if($pasadmerini)echo "CHECKED";}?>>p.m&nbsp;|&nbsp;
	            					<?php if($campnomb["parprofecfin"] == 1){ $parprofecfin = null; echo '<font face= "Verdana" color="Red">*</font>';} ?>Fecha de fin
									<input type="text" name="parprofecfin" size="8" value="<?php if(!$flageditarparaprod){ echo $sbreg[parprofecfin];} else {echo $parprofecfin;}?>" onFocus="if (!agree)this.blur();">
									<img src="../img/cal.gif" align="absmiddle" border="0" onClick="window.open('formcalendario.php?calencodigo=parprofecfin','cal1','status=no,menubar=no,scrollbars=yes,resizable=yes,left=600,width=200,height=210');">
									<select id="horfin" name="parprohorfin" style="visibility:visible;">
										<?php
											floadtimehours($horfin);
										?>
									</select>
									<span id="puntos" style="visibility:visible;">:</span> 
									<select id="minfin" name="parprominfin">
										<?php
											floadtimeminut($minfin);
										?>
									</select>
									<input type="checkbox"  id="pm" style="visibility:visible;" name="pasadmerfin" <?php if($flageditarparaprod){if($pasadmerfin)echo "CHECKED";}else{if($pasadmerfin)echo "CHECKED";}?>> <span id="pm" style="visibility:visible;"> p.m </span>
								</td>
        					</tr>
							<tr><td class="NoiseErrorDataTD" colspan="4"></td></tr>								
							<tr><td class="NoiseErrorDataTD" colspan="4"></td></tr> 
                            <tr>
		  						<td class="NoiseDataTD"><?php if($campnomb["tiptracodigo"] == 1){$tiptracodigo = null; echo '<font face= "Verdana" color="Red">*</font>';}?>&nbsp;Tipo de Trabajo</td>
                                <td colspan="3" class="NoiseFoparaproderTD">
                                	<select name="tiptracodigo">
            							<option value = "">Seleccione</option>
										<?php
											include ('../src/FunGen/floadtipotrab.php');
											floadtipotrab($tiptracodigo,$idcon);
											fncclose($idcon);
										?>
   									</select>
   								</td>
							</tr>
							<tr><td class="NoiseErrorDataTD" colspan="4"></td></tr> 
						</table>
				  	</td>
				</tr>
				<tr>
					<td><div align="center">
						<input type="image" name="aceptar"  src="../img/aceptar.gif" 
						onClick="form1.parprohorini.value = form1.parprohorini.value+':'+form1.parprominini.value;form1.parprohorfin.value = form1.parprohorfin.value+':'+form1.parprominfin.value;form1.accioneditarparaprod.value = 1;" width="86" height="18" alt="Aceptar" border=0>
						<input type="image" name="cancelar" src="../img/cancelar.gif" onClick="form1.action='maestablparaprod.php';"  width="86" height="18" alt="Cancelar" border=0>
					</div></td>
				</tr>
				<tr><td class="NoiseColumnTD">&nbsp;</td></tr>
			</table>
			<?php if($campnomb){ echo '<font face= "Verdana">Corregir los campos marcados con<font face="Verdana" color="Red">*</font></font>';}?>
<!-- Datos de paraprod -->
			<input type="hidden" name="accioneditarparaprod">
			<input type="hidden" name="parprocodigo" value="<?php if(!$flageditarparaprod){echo $sbreg[parprocodigo];}else {echo $parprocodigo;} ?>">
			<input type="hidden" name="parprohorgen" value="<?php if(!$flageditarparaprod){echo $sbreg[parprohorgen];}else {echo $parprohorgen;} ?>">
			<input type="hidden" name="parprofecgen" value="<?php if(!$flageditarparaprod){echo $sbreg[parprofecgen];}else {echo $parprofecgen;} ?>">
			<input type="hidden" name="usuacodigo" value="<?php if(!$flageditarparaprod){echo $sbreg[usuacodi];}else {echo $usuacodigo;} ?>">
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>">
		</form>
	</body>
<?php if(!$codigo){ echo " -->"; } ?>
</html>