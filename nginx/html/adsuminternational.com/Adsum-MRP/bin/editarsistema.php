<?php 
ob_start();
include ( '../src/FunGen/sesion/fncvalses.php');
include ( '../src/FunPerPriNiv/pktbltiposistema.php');
include ( '../src/FunPerPriNiv/pktblplanta.php');	

if($accioneditarsistema){ 
		include ( 'editasistema.php'); 
		$flageditarsistema = 1;
}
ob_end_flush();
if(!$flageditarsistema){
	include ( '../src/FunGen/sesion/fnccarga.php');
	$sbreg = fnccarga($nombtabl,$radiobutton);
	if (!$sbreg){
		include( '../src/FunGen/fnccontfron.php');
	}
	$idcon = fncconn();
	$varplanta = $sbreg[plantacodigo];
	$arrplanta= loadrecordplanta($varplanta,$idcon);
	$codplanta = $sbreg[plantacodigo];
	
	if($sbreg['tipsiscodigo']){
		$sbregtiposistema = loadrecordtiposistema($sbreg['tipsiscodigo'], $idcon);
		$acronitiposistema = $sbregtiposistema['tipsisacroni'];
		$codigotiposistema = $sbregtiposistema['tipsiscodigo'];
	}
}
?> 
<html> 
	<head> 
		<title>Editar registro de sistema</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0"> 
		<link rel="stylesheet" type="text/css" href="temas/Noise/Style.css"> 
		<script language="Javascript" type="text/javascript">
			function carga()
			{
				var campo_string;
				var form_ref = window.document.forms[0];
				var c = 0;
			
				for(var i=0; i<form_ref.elements.length; i++)
				{
					if(form_ref.elements[i].type == "text")
					{
						if(form_ref.elements[i].name > 0)
						{
							if (c == 0)
							{
								campo_string = form_ref.elements[i].name + ":" + form_ref.elements[i].value;
								c++;
							}else
								campo_string = campo_string + ";" + form_ref.elements[i].name + ":" + form_ref.elements[i].value;
						}
							
					}
				}
				if(campo_string == undefined)
					campo_string = "";
			
				window.document.form1.arreglo_cam.value = campo_string;
			}
		</script>
		<SCRIPT LANGUAGE="JavaScript"> 
			<!-- Begin
			agree = 0;
			//  End -->
			function deldata(){
				form1.sistemcodigo.value = '';
				form1.plantacodigo.value = '';
				form1.sistemnombre.value = '';
				form1.sistemdescri.value = '';
			}
		</script> 
		<script language="JavaScript" src="motofech.js"></script> 
		<SCRIPT language=JavaScript src="../src/FunGen/jsrsClient.js" type="text/javascript" ></SCRIPT>
		<script language=JavaScript src="../src/FunGen/cargarTiposistema.js" type="text/javascript"></script>
	</head> 
<?php if(!$codigo){ echo "<!--";}	?> 
	<body bgcolor="FFFFFF" text="#000000">  
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Sistema</font></p> 
			<table border="0" cellspacing="1" cellpadding="1" align="center" class="NoiseFormTABLE" width="70%"> 
				<tr><td class="NoiseErrorDataTD">&nbsp;</td>	</tr> 
	  			<tr><td class="NoiseFieldCaptionTD"><span class="style5"><font color="FFFFFF"> Editar registro</font></span></td></tr> 
				<tr> 
	  				<td> 
	            				<table width="85%" border="0" cellspacing="1" cellpadding="1" align="center"> 
	                     					<tr> 
	            						<td><input type="button" value="Tipo de sistemas" name="opnTipsis" onClick="window.open('maestabltiposistemaaux.php?codigo=<?php echo $codigo?>','ventana','status=no,menubar=no,scrollbars=yes,resizable=yes,left=300,width=800,height=600');"></td>
	            						<td><?php if($campnomb["tipsiscodigo"] == 1){ $tipsiscodigo = null; echo "*";} ?>
	              							C&oacute;digo&nbsp;&nbsp;<input type="text" size="10" name="tipsiscodigo" onBlur="form1.flageditarsistema.value=1; cargarTiposistema(this.value);" value="<?php if(!$flageditarsistema) echo $codigotiposistema; else echo $tipsiscodigo; ?>">
	              						</td>
	            						<td colspan="2">Acr&oacute;nimo&nbsp;&nbsp;
	              							<input type="text" size="10" name="tipsisacroni" onBlur="form1.flageditarsistema.value=1; cargarTiposistema(this.value);" value="<?php if(!$flageditarsistema) echo $acronitiposistema; else echo $tipsisacroni; ?>">
	              						</td>
	              					</tr>
	              				</table>
	              			</td>
	              		</tr>
	              		<tr>
					<td>
	              				<table width="95%" border="0" cellspacing="1" cellpadding="0" align="center"> 
							<tr>
								<td width="20%" class="NoiseFooterTD"><?php if($campnomb["sistemnombre"] == 1){ $sistemnombre = null;	echo "*";}	?>Nombre</td>
								<td width="80%" class="NoiseFooterTD"><input type="text" name="sistemnombre"	value="<?php if(!$flageditarsistema){ 	echo $sbreg[sistemnombre];}else{ echo $sistemnombre;} ?>"></td> 
			 				</tr> 
							<tr>
				              			<td width="20%" class="NoiseFooterTD"><?php if($campnomb["plantacodigo"] == 1){ $plantacodigo = null;	echo "*";}	?>Planta</td>
				 				<td width="80%" class="NoiseFooterTD"> <select name="plantacodigo">
								<?php
							 		if(!$plantacodigo)
			  							$plantacodigo = $sbreg[plantacodigo];
			
									echo '<option value = "">Seleccione</option>';
									
									include ('../src/FunGen/floadplanta.php');
									$idcon = fncconn();
									floadplanta($plantacodigo,$idcon);
									fncclose($idcon);
								?>
				      				</select></td> 
			 				</tr> 
		              				<tr><td class="NoiseFieldCaptionTD" colspan="2"></td></tr>		
			 				<tr>
						           <!-- * *Campos personalizados* * -->
								<td colspan="2">
									<table width="100%" border="0" cellspacing="2" cellpadding="0" align="center">
								          <?php
										if(!$flageditarsistema){
											include('../src/FunGen/floadsistemcamperequipo.php');
											// 'true' indica que es un detallar/borrar
											$idcon = fncconn();
											floadsistemcamperequipo($sbreg['sistemcodigo'], null, null, $idcon);
											fncclose($idcon);
										}else{
											include('../src/FunGen/floadtiposistcamperequipo.php');
											$idcon = fncconn();
											floadtiposistcamperequipo($tipsiscodigo, $campnomb, $flageditarsistema, $idcon);
											fncclose($idcon);
										}
									?>
									</table>
								</td>
						          <!-- * * * -->
						          </tr>
          		              				<tr><td class="NoiseFieldCaptionTD" colspan="2"></td></tr>		
							<tr> 
			 					<td width="20%" class="NoiseFooterTD"><?php if($campnomb["sistemdescri"] == 1){ $sistemdescri = null;	echo "*";}	?>Descripci&oacute;n</td> 
			 					<td width="80%" rowspan="2" class="NoiseFooterTD"><textarea name="sistemdescri" rows="3" wrap="VIRTUAL" cols="35"><?php if(!$flageditarsistema){ 	echo $sbreg[sistemdescri];}else{ echo $sistemdescri;} ?></textarea></td>  
			 				</tr>
			 				<tr><td width="20%" class="NoiseFooterTD">&nbsp;</td></tr> 
						</table> 
					</td>
				</tr>
	 			<tr> 
					<td><div align="center"> 
	  					<input type="image" name="aceptar"  src="../img/aceptar.gif" 	onclick="carga();form1.accioneditarsistema.value =  1; "  width="86" height="18" alt="Aceptar" border=0> 
	  					<input type="image" name="cancelar" src="../img/cancelar.gif" 	onclick="form1.accioneditar.value =  1;form1.action='maestablsistema.php';deldata();"  width="86" height="18" 	alt="Cancelar" border=0> 
					</div></td> 
	 			</tr> 
	 			<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr> 
			</table> 
<?php if($campnomb){ echo '<font face="Verdana" >Corregir los campos marcados con *</font>';} ?>
			<input type="hidden" name="sistemcodigo"	value="<?php if(!$flageditarsistema){ 	echo $sbreg[sistemcodigo];}else{ echo $sistemcodigo;} ?>" onFocus="if (!agree)this.blur();"> 
			<input type="hidden" name="accioneditarsistema"> 
			<input type="hidden" name="accioneditar">
			<input type="hidden" name="plantacodigo1" value="<?php echo $plantacodigo; ?>"> 
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
			<input type="hidden" name="flageditarsistema" value="<?php echo $flageditarsistema; ?>">
			<!--					-->
			<input type="hidden" name="arreglo_aux" value="<?php echo $arreglo_aux?>">
			<input type="hidden" name="arreglo_cam" value="<?php echo $arreglo_cam?>">
			<!--					-->
			<!--			Udado para 'disparar' la funcion que carga el formulario			-->
			<input type="text" name="auxtrigger" size="1" style="border:none; color:#FFFFFF;" onFocus="form1.flageditarsistema.value=1; form1.submit(); this.blur();">
			<!--								-->
		</form> 
	</body> 
<?php if(!$codigo){ echo " -->"; } ?> 
</html> 
