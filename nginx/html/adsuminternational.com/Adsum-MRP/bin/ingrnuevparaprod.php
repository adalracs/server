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
	include ( '../src/FunGen/cargainput.php');
	
	if($accionnuevoparaprod){
		include ( 'grabaparaprod.php');
	}
	
	if(!$flagnuevoparaprod && $radiobutton)
	{
		include ( '../src/FunGen/sesion/fnccarga.php');
		$sbreg = fnccarga('paraprod',$radiobutton);
		
		if(!$sbreg['parprofecfin'])
		{
			$parprocodigo = $sbreg['parprocodigo']; 	
			$plantacodigo = $sbreg['plantacodigo']; 	
			$sistemcodigo = $sbreg['sistemcodigo']; 	
			$equipocodigo = $sbreg['equipocodigo']; 	
			$componcodigo = $sbreg['componcodigo']; 	
			$caufallcodigo = $sbreg['caufallcodigo']; 	
			$tiptracodigo = $sbreg['tiptracodigo']; 	
			$tipfalcodigo = $sbreg['tipfalcodigo'];
			$parprofecini = $sbreg['parprofecini'];
			$parprohorini = explode(':',$sbreg['parprohorini']);
			$minini = $parprohorini[1];
			$horini = $parprohorini[0];
			if($horini > 12)
			{
				$pasadmerini = 1;
				$horini -= 12;
			}
			elseif($horini == '00')
				$horini = 12;
				
		}
		else
			unset($sbreg);
	}
	$idcon = fncconn();
?>
<html>
	<head>
		<title>Nuevo registro de Parada de produccion</title>
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
			function verocultar(cual, index) 
			{
				var c=cual.nextSibling;
				if(c.style.display=='none') 
				{
					c.style.display='block';
					document.getElementById("row"+ index).src = "temas/Noise/AscOn.gif";			           
				} 
				else 
				{
					c.style.display='none';
					document.getElementById("row"+ index).src = "temas/Noise/DescOn.gif";			           			           
				}
				return false;
			}
			 
			function LoadDetalleequipo(equipocodigo,usuaplanta)
			{
				document.getElementById("equipodet").src="detallarotequipo.php?equipocodigo="+ equipocodigo + "&usuaplanta=" + usuaplanta;
			}
			
			function LoadDetallecomponen(componcodigo,usuaplanta)
			{
				document.getElementById("componendet").src="detallarotcomponen.php?componcodigo="+ componcodigo + "&equipocodigo="+ form1.equipocodigo.value + "&usuaplanta=" + usuaplanta;
			}

			 function limpiadata() 
			 {
				 document.form1.parprocodigo.value = ''; 	
				 document.form1.plantacodigo.value = ''; 	
				 document.form1.sistemcodigo.value = ''; 	
				 document.form1.equipocodigo.value = ''; 	
				 document.form1.componcodigo.value = ''; 	
				 document.form1.caufallcodigo.value = ''; 	
				 document.form1.tiptracodigo.value = ''; 	
				 document.form1.tipfalcodigo.value = '';
				 document.form1.parprofecini.value = '';
				 document.form1.parprofecfin.value = '';
			 }
		</script>
	</head>
<?php if(!$codigo){ echo "<!--";} ?>
	<body bgcolor="FFFFFF" text="#000000">
		<form name="form1" method="post"  enctype="multipart/form-data">
			<p><font class="NoiseFormHeaderFont">Paradas de producci&oacute;n</font></p> 
			<table border="0" cellspacing="1" cellpadding="2" align="center" class="NoiseFormTABLE" width="850">
				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr> 
				<?php if($parprocodigo): ?>
				<tr><td class="NoiseFieldCaptionTD"><span class="style5"><font color="FFFFFF">Actualizar nuevo registro</font></span>	</td></tr>
				<tr>
					<td>
						<table width="95%" border="0" cellspacing="1" cellpadding="0" align="center">
							<tr class="NoiseSeparatorTD"><td colspan="4">&nbsp;Fecha / Hora&nbsp; | &nbsp;<?php $fecha=date("Y-m-d"); $hora = date("h:i a");  echo $fecha." / ".$hora; ?></td></tr>
							<tr>
								<td width="20%" class="NoiseFooterTD">&nbsp;Planta</td>
							  	<td colspan="3" class="NoiseDataTD"><?php echo cargaplantanombre($plantacodigo, $idcon) ?><input type="hidden" name="plantacodigo" value="<?php echo $plantacodigo ?>"></td>
						  	</tr>
							<tr>
								<td width="20%" class="NoiseFooterTD">&nbsp;Sistema</td>
								<td colspan="3" class="NoiseDataTD"><?php echo cargasistemnombre($sistemcodigo, $idcon) ?><input type="hidden" name="sistemcodigo" value="<?php echo $sistemcodigo ?>"></td>
							</tr>
          					<tr>
          						<td class="NoiseFooterTD">&nbsp;Equipo&nbsp;</td>
								<td class="NoiseDataTD" colspan="3"><?php echo $equipocodigo.' / '.cargaequiponombre($equipocodigo, $idcon)  ?><input type="hidden" name="equipocodigo" value="<?php echo $equipocodigo ?>"></td>
							</tr>
							<tr>
								<td class="NoiseFooterTD">&nbsp;Componente&nbsp;</td>
								<td class="NoiseDataTD" colspan="3"><?php echo $componcodigo.' / '.cargacomponnombre($componcodigo, $idcon)  ?><input type="hidden" name="componcodigo" value="<?php echo $componcodigo ?>"></td>
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
												<td height="110"  class="NoiseFoparaproderTD"><iframe  frameborder="0" name="equipodet" id="equipodet"  height="110" width="100%" align="absmiddle" src="detallarotequipo.php?equipocodigo=<?php echo $equipocodigo ?>&usuaplanta=<?php echo $GLOBALS['usuaplanta'];  ?>"></iframe></td>
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
												<td height="110"  class="NoiseFoparaproderTD"><iframe  frameborder="0" name="componendet" id="componendet"  height="110" width="100%" align="absmiddle" src="detallarotcomponen.php?componcodigo=<?php echo $componcodigo ?>&equipocodigo=<?php echo $equipocodigo ?>&usuaplanta=<?php echo $GLOBALS['usuaplanta'];  ?>"></iframe></td>
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
								<td class="NoiseFooterTD">&nbsp;Causa de Falla</td>
								<td class="NoiseDataTD" width="30%"><?php echo cargacausafalla($caufallcodigo, $idcon)  ?><input type="hidden" name="caufallcodigo" value="<?php echo $caufallcodigo ?>"></td>
								<td class="NoiseFooterTD" width="20%">&nbsp;Falla</td>
							  	<td class="NoiseDataTD" width="30%"><?php echo cargatipfalnombre($tipfalcodigo, $idcon) ?><input type="hidden" name="tipfalcodigo" value="<?php echo $tipfalcodigo ?>"></td>
						  	</tr>
							<tr><td colspan="4" class="NoiseFooterTD">&nbsp;Descripci&oacute;n de la parada</td></tr>
							<tr><td colspan="4"  class="NoiseDataTD"><?php if(!$flagnuevoparaprod){echo $sbreg["parprodescri"];}else{ echo $parprodescri;}?><input type="hidden" name="parprodescri" value="<?php if(!$flagnuevoparaprod){echo $sbreg["parprodescri"];}else{ echo $parprodescri;} ?>"></td></tr>
							<tr><td class="NoiseErrorDataTD" colspan="4"></td></tr> 
							<tr><td class="NoiseFieldCaptionTD" colspan="4"></td></tr> 
							<tr><td class="NoiseErrorDataTD" colspan="4"></td></tr>
							<tr><td class="NoiseErrorDataTD" colspan="4"></td></tr>
							<tr>
								<td class="NoiseFooterTD">&nbsp;Fecha de inicio</td>
								<td class="NoiseFooterTD"><?php echo $parprofecini.' / '.$horini.':'.$minini.' ';if($pasadmerini){echo 'p.m.';}else{echo 'a.m.';} ?><input type="hidden" name="parprofecini" value="<?php echo $parprofecini ?>"><input type="hidden" name="horini" value="<?php echo $horini ?>"><input type="hidden" name="minini" value="<?php echo $minini ?>"><input type="hidden" name="pasadmerini" value="<?php echo $pasadmerini ?>"></td> 
							  	<td class="NoiseDataTD" colspan="2">
	            					<?php if($campnomb["parprofecfin"] == 1){ $parprofecfin = null; echo '<font face= "Verdana" color="Red">*</font>';} ?>Fecha de fin
									<input type="text" name="parprofecfin" size="8" value="<?php if(!$flagnuevoparaprod){ echo $sbreg[parprofecfin];} else {echo $parprofecfin;}?>" onFocus="if (!agree)this.blur();">
									<img src="../img/cal.gif" align="absmiddle" border="0" onClick="window.open('formcalendario.php?calencodigo=parprofecfin','cal1','status=no,menubar=no,scrollbars=yes,resizable=yes,left=600,width=200,height=210');">
									<select id="horfin" name="horfin" style="visibility:visible;">
										<?php
											//if($flagnuevoparaprod)
											//	echo '<option value ="'.$horfin.'">'.$horfin.'</option>'."\n";
											floadtimehours($horfin);
										?>
									</select>
									<span id="puntos" style="visibility:visible;">:</span> 
									<select id="minfin" name="minfin">
										<?php
											//if($flagnuevoparaprod)
											//	echo '<option value ="'.$minfin.'">'.$minfin.'</option>'."\n";
											floadtimeminut($minfin);
										?>
									</select>
									<input type="checkbox"  id="pm" style="visibility:visible;" name="pasadmerfin" <?php if($flagnuevoparaprod){if($pasadmerfin)echo "CHECKED";}?>> <span id="pms" style="visibility:visible;"> p.m </span>
								</td>
        					</tr>
							<tr><td class="NoiseErrorDataTD" colspan="4"></td></tr>								
							<tr><td class="NoiseErrorDataTD" colspan="4"></td></tr> 
                            <tr>
		  						<td class="NoiseFooterTD">&nbsp;Tipo de Trabajo</td>
                                <td colspan="3" class="NoiseDataTD"><?php echo cargatipotrab($tiptracodigo, $idcon) ?><input type="hidden" name="tiptracodigo" value="<?php echo $tiptracodigo ?>"></td>
							</tr>
							<tr><td class="NoiseErrorDataTD" colspan="4"></td></tr> 
						</table>
				  	</td>
				</tr>
				<?php else: ?>
				<tr><td class="NoiseFieldCaptionTD"><span class="style5"><font color="FFFFFF">Ingresar nuevo registro</font></span>	</td></tr>
				<tr>
					<td>
						<table width="95%" border="0" cellspacing="1" cellpadding="0" align="center">
							<tr class="NoiseSeparatorTD"><td colspan="4">&nbsp;Fecha / Hora&nbsp; | &nbsp;<?php $fecha=date("Y-m-d"); $hora = date("h:i a");  echo $fecha." / ".$hora; ?></td></tr>
							<tr>
								<td width="25%" class="NoiseSeparatorTD"><?php if($campnomb["plantacodigo"] == 1) echo '<font face= "Verdana" color="Red">*</font>'; ?>&nbsp;Planta</td>
							  	<td colspan="3" class="NoiseSeparatorTD">
							    	<select name="plantacodigo" onChange="cargarSistemas(this.value);">
							    		<option value = "">Seleccione</option>
                                  		<?php
								 			if(!$flagnuevoparaprod)
				  								unset($plantacodigo);
		
											include ('../src/FunGen/floadplanta.php');
											floadplanta($plantacodigo,$idcon);
										?>
                                	</select>
								</td>
							</tr>
							<tr>
								<td width="25%" class="NoiseDataTD"><?php if($campnomb["sistemcodigo"] == 1) echo '<font face= "Verdana" color="Red">*</font>'; ?>&nbsp;Sistema</td>
								<td colspan="3" class="NoiseFoparaproderTD">
									<select name="sistemcodigo" onChange="cargarEquipos(this.value);">
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
								<td class="NoiseFoparaproderTD" colspan="3">
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
									<select name="componcodigo" onChange="LoadDetallecomponen(this.value,'<?php echo $GLOBALS['usuaplanta']; ?>');">
            							<option value = "">-- Seleccione --</option>
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
										 	if(!$flagnuevoparaprod)
						  						unset($caufallcodigo);
												
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
							 				if(!$flagnuevoparaprod)
							 					unset($causacodigo);
							 		
						 				 	include ('../src/FunGen/floadtipofall.php');
						 				 	floadtipofall($tipfalcodigo, $idcon);
										?>
                              		</select>
                              	</td>
						  	</tr>
							<tr><td colspan="4" class="NoiseDataTD"><?php if($campnomb["parprodescri"] == 1){$parprodescri = null; echo '<font face= "Verdana" color="Red">*</font>';} ?>&nbsp;Descripci&oacute;n de la parada</td></tr>
							<tr><td colspan="4"  class="NoiseDataTD"><textarea name="parprodescri" cols="60" rows="2" wrap="VIRTUAL"><?php if(!$flagnuevoparaprod){echo $sbreg["parprodescri"];}else{ echo $parprodescri;}?></textarea></td></tr>
							<tr><td class="NoiseErrorDataTD" colspan="4"></td></tr> 
							<tr><td class="NoiseFieldCaptionTD" colspan="4"></td></tr> 
							<tr><td class="NoiseErrorDataTD" colspan="4"></td></tr>
							<tr><td class="NoiseErrorDataTD" colspan="4"></td></tr>							
							<tr>
								<td colspan="4"  class="NoiseFoparaproderTD"><?php if($campnomb["parprofecini"] == 1){$parprofecini = null; echo '<font face= "Verdana" color="Red">*</font>';}?>Fecha de inicio
									<input type="text" name="parprofecini" size="8" value="<?php if(!$flagnuevoparaprod){echo $parprofecini=date("Y-m-d");} else {echo $parprofecini;}?>" onFocus="if (!agree)this.blur();">&nbsp;
	              					<img src="../img/cal.gif" align="absmiddle" border="0" onClick="window.open('formcalendario.php?calencodigo=parprofecini','cal1','status=no,menubar=no,scrollbars=yes,resizable=yes,left=600,width=200,height=210');">
									<select name="horini">
	                					<?php
					 						if(!$flagnuevoparaprod)
					 						{
		  										$horini = date("h");
			  									if(date("a") == 'pm')
		  											$pasadmerini = 1;
					 						}				 		
											floadtimehours($horini);
					  					?>
	                				</select>
	            					:
	            					<select name="minini">
	                					<?php
											if(!$flagnuevoparaprod)
												$minini = date("i");
					 						
											floadtimeminut($minini);
					 					?>
	            					</select>
	            					<input  type="checkbox"  name="pasadmerini" <?php if($flagnuevoparaprod){if($pasadmerini)echo "CHECKED";}else{if($pasadmerini)echo "CHECKED";}?>>p.m&nbsp;|&nbsp;
	            					<?php if($campnomb["parprofecfin"] == 1){ $parprofecfin = null; echo '<font face= "Verdana" color="Red">*</font>';} ?>Fecha de fin
									<input type="text" name="parprofecfin" size="8" value="<?php if(!$flagnuevoparaprod){ echo $sbreg[parprofecfin];} else {echo $parprofecfin;}?>" onFocus="if (!agree)this.blur();">
									<img src="../img/cal.gif" align="absmiddle" border="0" onClick="window.open('formcalendario.php?calencodigo=parprofecfin','cal1','status=no,menubar=no,scrollbars=yes,resizable=yes,left=600,width=200,height=210');">
									<select id="horfin" name="horfin" style="visibility:visible;">
										<?php
											//if($flagnuevoparaprod)
											//	echo '<option value ="'.$horfin.'">'.$horfin.'</option>'."\n";
											floadtimehours($horfin);
										?>
									</select>
									<span id="puntos" style="visibility:visible;">:</span> 
									<select id="minfin" name="minfin">
										<?php
											//if($flagnuevoparaprod)
											//	echo '<option value ="'.$minfin.'">'.$minfin.'</option>'."\n";
											floadtimeminut($minfin);
										?>
									</select>
									<input type="checkbox"  id="pm" style="visibility:visible;" name="pasadmerfin" <?php if($flagnuevoparaprod){if($pasadmerfin)echo "CHECKED";}?>> <span id="pms" style="visibility:visible;"> p.m </span>
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
	            							if(!$flagnuevoparaprod)
												unset($tiptracodigo);
			
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
				<?php endif; ?>
				<tr>
					<td><div align="center">
						<input type="image" name="aceptar"  src="../img/aceptar.gif" onClick="form1.accionnuevoparaprod.value = 1;" width="86" height="18" alt="Aceptar" border=0>
						<input type="image" name="cancelar" src="../img/cancelar.gif" onClick="limpiadata(); form1.action='maestablparaprod.php';"  width="86" height="18" alt="Cancelar" border=0>
					</div></td>
				</tr>
				<tr><td class="NoiseColumnTD">&nbsp;</td></tr>
			</table>
			<?php if($campnomb){ echo '<font face= "Verdana">Corregir los campos marcados con<font face="Verdana" color="Red">*</font></font>';}?>
<!-- Datos de paraprod -->
			<input type="hidden" name="accionnuevoparaprod">
			<input type="hidden" name="parprocodigo" value="<?php if(!$flagnuevoparaprod){echo $sbreg[parprocodigo];}else {echo $parprocodigo;}?>">
			<input type="hidden" name="parprohorgen" value="<?php $parprohorgen= date("H:i"); echo $parprohorgen; ?>">
			<input type="hidden" name="parprofecgen" value="<?php $parprofecgen=date("Y-m-d"); echo $parprofecgen;?>">
			<input type="hidden" name="departoculto" id="departoculto">
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>">
			<input type="hidden" name="valor">
			<input type="hidden" name="flag">
		</form>
	</body>
<?php if(!$codigo){ echo " -->"; } ?>
</html>