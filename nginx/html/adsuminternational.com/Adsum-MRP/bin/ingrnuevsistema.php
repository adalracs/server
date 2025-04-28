<?php 
ob_start(); 
include ( '../src/FunGen/sesion/fncvalses.php'); 
include ( '../src/FunPerPriNiv/pktblplanta.php');	
if($accionnuevosistema){ 
	include ( 'grabasistema.php'); 
} 
ob_end_flush(); 
?> 
<!-- Propiedad intelectual de Adsum SA (c) 
-Todos los derechos reservados- 
Creado con WAG Adsum 
Autor: Andr�s A. Riascos D. 
Fecha: 26052004 
GenVers: 3.1 --> 
<html> 
	<head> 
		<title>Nuevo registro de Sistema</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0"> 
		<link rel="stylesheet" type="text/css" href="temas/Noise/Style.css"> 
		<!--cbedoya-->
		<script language=JavaScript src="../src/FunGen/cargarNorSegselec.js" type="text/javascript"></script>
		<script language=JavaScript src="../src/FunGen/cargarTiposistema.js" type="text/javascript"></script>
		<script language="Javascript" type="text/javascript">
			function carga(){
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
		<!--cbedoya-->
		<SCRIPT LANGUAGE="JavaScript"> 
			<!-- Begin 
			agree = 0; 
			//  End --> 
		</script> 
	</head> 
<?php if(!$codigo){ echo "<!--";} ?> 

	<body bgcolor="FFFFFF" text="#000000" <?php if(($flagnuevosistema) && !(empty($arreglo_aux))) echo "onload=\"cargarNorSegselec(window.document.form1.arreglo_aux.value);\"";?>> 
  		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Proceso</font></p> 
    			<table border="0" cellspacing="1" cellpadding="1" align="center" class="NoiseFormTABLE" width="65%"> 
				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr> 
				<tr><td class="NoiseFieldCaptionTD"><span class="style5"><font color="FFFFFF">Ingresar nuevo registro</font></span></td></tr> 
	  			<tr>
	    				<td>
	    					<table width="95%" border="0" cellspacing="1" cellpadding="1" align="center">
  		      					<tr>
  		        						<td class="NoiseFooterTD"><input type="button" value=" Buscar tipo de sistema " name="opnTipsis" onClick="window.open('maestabltiposistemaaux.php?codigo=<?php echo $codigo?>','ventana','status=no,menubar=no,scrollbars=yes,resizable=yes,left=300,width=800,height=600');">
			        						<input type="hidden" size="10" name="tipsiscodigo" onBlur="cargarTiposistema(this.value);" value="<?php echo $tipsiscodigo; ?>">
				    					<input type="text" size="10" name="tipsisacroni" onBlur="cargarTiposistema(this.value);" value="<?php echo $tipsisacroni; ?>">
	            						</td>
	          						</tr>
  	        					</table>
  						<span id="formsistema" style="display:<?php if($tipsiscodigo) { echo "inline;"; } else { echo "none;"; }?>">
		  				<table width="95%" border="0" cellspacing="1" cellpadding="0" align="center"> 
			  				<tr> 
 			    					<td width="20%" class="NoiseFooterTD"><?php if($campnomb["sistemnombre"] == 1){ $sistemnombre=null; echo "*";}?>&nbsp;&nbsp;Nombre</td> 
 			    					<td width="80%" class="NoiseFooterTD"><input type="text" name="sistemnombre"	value="<?php if(!$flagnuevosistema){ echo $sbreg[sistemnombre];}else {echo $sistemnombre;}?>"></td> 
 			  				</tr> 
			  				<tr> 
 			    					<td width="20%" class="NoiseFooterTD"><?php if($campnomb["plantacodigo"] == 1){ $plantacodigo=null; echo "*";}?>&nbsp;&nbsp;Planta</td> 
  			    					<td width="80%" class="NoiseFooterTD"><select name="plantacodigo">
								<?php
							 		if(!$flagnuevosistema)
			  							unset($plantacodigo);
	
									echo '<option value = "">Seleccione</option>';
									
									include ('../src/FunGen/floadplanta.php');
									$idcon = fncconn();
									floadplanta($plantacodigo,$idcon);
									fncclose($idcon);
								?>
								</select></td> 
							</tr> 
	               					<tr><td class="NoiseFieldCaptionTD" colspan="2"></td></tr> 
								<!-- ** ** ** -->
							<tr>
								<td colspan="2">
									<table width="100%" border="0" cellspacing="2" cellpadding="0" align="center">
								<?php
									if($tipsiscodigo){
										include('../src/FunGen/floadtiposistcamperequipo.php');
										$idcon = fncconn();
										floadtiposistcamperequipo($tipsiscodigo, $campnomb, $flagnuevosistema, $idcon);
										fncclose($idcon);
									}
								?>
									</table>
								</td>
								<!-- ** ** ** -->
							</tr>
	               					<tr><td class="NoiseFieldCaptionTD" colspan="2"></td></tr> 
							<tr> 
								<td width="20%" class="NoiseFooterTD"><?php if($campnomb["sistemdescri"] == 1){ $sistemdescri=null; echo "*";}?>&nbsp;&nbsp;Descripci&oacute;n</td> 
								<td width="80%" class="NoiseFooterTD"><textarea name="sistemdescri" rows="3" cols="35" wrap="VIRTUAL"><?php if(!$flagnuevosistema){ echo $sbreg[sistemdescri];}else {echo $sistemdescri;}?></textarea></td> 
							</tr>
							<tr><td colspan="5" class="NoiseFooterTD">&nbsp;</td></tr> 
						</table> 
					</td> 
				</tr> 
				<tr> 
					<td><div align="center"> 
						<input type="image" name="aceptar"  src="../img/aceptar.gif" onclick="carga();form1.accionnuevosistema.value =  1;"  width="86" height="18" alt="Aceptar" border=0> 
						<input type="image" name="cancelar" src="../img/cancelar.gif" onclick="form1.action='maestablsistema.php';"  width="86" height="18" alt="Cancelar" border=0> 
					</div></td> 
		 	  	</tr> 
 	  			<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr> 
    			</table> 
<?php if($campnomb){ echo '<font face="Verdana" >Corregir los campos marcados con *</font>';} ?>
			<input type="hidden" name="accionnuevosistema"> 
			<input type="hidden" name="sistemcodigo"	value="<?php if(!$flagnuevosistema){ echo $sbreg[sistemcodigo];}else {echo $sistemcodigo;}?>"> 
			<input type="hidden" name="plantacodigo1" value="<?php echo $plantacodigo; ?>"> 
			
			<input type="hidden" name="arreglo_aux" value="<?php echo $arreglo_aux?>">
			<input type="hidden" name="arreglo_cam" value="<?php echo $arreglo_cam?>">
			
			<!--			Udado para 'disparar' la funcion que carga el formulario			-->
			<input type="text" name="auxtrigger" size="1" style="border:none; color:#FFFFFF;" onFocus="form1.submit(); this.blur();">
			<!--cbedoya-->
			
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
		</form> 
	</body> 
<?php if(!$codigo){ echo " -->"; } ?> 
</html> 
