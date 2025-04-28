<?php 
ob_start();
	include ( '../src/FunGen/sesion/fncvalses.php');
	include ( '../src/FunPerPriNiv/pktblequipo.php');
	
	if($accionnuevocomponen){
		include ( 'grabacomponen.php');
	}
ob_end_flush();
?> 

<html> 
	<head> 
		<title>Nuevo registro de componen</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0"> 
		<link rel="stylesheet" type="text/css" href="temas/Noise/Style.css"> 
		<script language="JavaScript" src="../src/FunGen/jsrsClient.js" type="text/javascript" ></script>
		<script language=JavaScript src="../src/FunGen/cargarEquipo.js" type="text/javascript" ></script>
		<!--cbedoya Tipo-->
		<script language=JavaScript src="../src/FunGen/cargarTipocomponen.js" type="text/javascript"></script>
		<script language="Javascript" type="text/javascript">
			function carga(){
				var campo_string;
				var form_ref = window.document.forms[0];
				var c = 0;
			
				for(var i=0; i<form_ref.elements.length; i++){
					if(form_ref.elements[i].type == "text"){
						if(form_ref.elements[i].name > 0){
							if (c == 0){
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
		<script language="JavaScript" src="motofech.js"></script> 
	</head> 
<?php if(!$codigo){  echo "<!--";} ?> 
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Componente</font></p> 
			<table border="0" cellspacing="1" cellpadding="2" align="center" class="NoiseFormTABLE" width="70%"> 
				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr> 
				<tr><td class="NoiseFieldCaptionTD"><span class="style5"><font color="FFFFFF">Ingresar nuevo registro</font></span></td></tr> 
				<tr>
					<td>
						<table width="95%" border="0" cellspacing="0" cellpadding="3" align="center">
							<tr>
								<td class="NoiseFooterTD"><input type="button" value="   Buscar tipo de componente    " name="opnTipcom" onClick="window.open('maestabltipocomponenaux.php?codigo=<?php echo $codigo?>','ventana','status=no,menubar=no,scrollbars=yes,resizable=yes,left=300,width=800,height=600');">
									<input type="hidden" size="10" name="tipcomcodigo" onBlur="cargarTipocomponen(this.value);" value="<?php echo $tipcomcodigo; ?>">
									<input type="text" size="10" name="tipcomacroni" onBlur="cargarTipocomponen(this.value);" value="<?php echo $tipcomacroni; ?>">
								</td>
							</tr>
						</table>
  						<span id="formcomponen" style="display:<?php if($tipcomcodigo) { echo "inline;"; } else { echo "none;"; }?>">
            					<table width="95%" border="0" cellspacing="1" cellpadding="0" align="center"> 
							<tr><td class="NoiseErrorDataTD" colspan="4"></td></tr> 
	               					<tr><td class="NoiseFieldCaptionTD" colspan="4"></td></tr> 
							<tr><td class="NoiseErrorDataTD" colspan="4"></td></tr> 
							<tr class="NoiseFooterTD">
								<td width="20%"  class=""><?php if($campnomb["componcodigo"] == 1){ $componcodigo=null;echo "*";}?>&nbsp;Codigo</td>
								<td width="30%" class=""><input name="componcodigo" type="text"	value="<?php if(!$flagnuevocomponen){ echo $sbreg[componcodigo];} else {echo $componcodigo;}?>" size="20"></td>
								<td colspan="2">&nbsp;</td>
							</tr>
              						<tr class="NoiseFooterTD"> 
	            						<td width="20%"> <?php if($campnomb["componnombre"] == 1){ $componnombre=null;echo "*";}?>&nbsp;Nombre</td> 
	            						<td colspan="3"><input name="componnombre" type="text"	value="<?php if(!$flagnuevocomponen){ echo $sbreg[componnombre];}else {echo $componnombre;}?>" size="50"></td> 
 							</tr> 
							<tr><td class="NoiseErrorDataTD" colspan="4"></td></tr> 
	               					<tr><td class="NoiseFieldCaptionTD" colspan="4"></td></tr> 
							<tr><td class="NoiseErrorDataTD" colspan="4"></td></tr> 
              						<tr class="NoiseErrorDataTD"> 
								<td width="20%"><?php if($campnomb["equipocodigo"] == 1){ $equipocodigo=null;echo "*";}?>
									<input name="radio1"  type="button"  value="Equipo" onClick="window.open('maestablequipogen.php?codigo=<?php echo $codigo?>&codigo2=<?php echo $GLOBALS[usuaplanta]; ?>','equipogen','status=no,menubar=no,scrollbars=yes,resizable=yes,left=300,width=800,height=600');" width="86" height="18" alt="Cancelar" border=0 href="#" target="_parent"></td>
								<td colspan="3"><input name="equiponombre" type="text"	value="<?php if(!$flagnuevocomponen){ echo $equiponombre;} else {echo $equiponombre;} ?>" size="50" onFocus="if (!agree)this.blur();"> </td>
              						</tr>
							<tr><td class="NoiseErrorDataTD" colspan="4"></td></tr> 
	               					<tr><td class="NoiseFieldCaptionTD" colspan="4"></td></tr> 
							<tr><td class="NoiseErrorDataTD" colspan="4"></td></tr>              						
							<tr  class="NoiseFooterTD">
								<td width="20%"> <?php if($campnomb["componfabric"] == 1){ $componfabric=null;echo "*";}?>&nbsp;Fabricante</td> 
								<td width="30%" class="NoiseFooterTD"><input name="componfabric" type="text"	value="<?php if(!$flagnuevocomponen){ echo $sbreg[componfabric];} else {echo $componfabric;} ?>" size="20"></td> 
								<td width="20%"><?php if($campnomb["componmarca"] == 1){ $componmarca=null;echo "*";}?>&nbsp;Marca</td> 
							  	<td width="30%"><input name="componmarca" type="text"	value="<?php if(!$flagnuevocomponen){ echo $sbreg[componmarca];}else {echo $componmarca;}?>" size="20"></td> 
							</tr> 
							<tr class="NoiseFooterTD"> 
								<td width="20%"> <?php if($campnomb["componmodelo"] == 1){ $componmodelo=null;echo "*";}?>&nbsp;Modelo</td> 
							  	<td width="30%"><input name="componmodelo" type="text"	value="<?php if(!$flagnuevocomponen){ echo $sbreg[componmodelo];} else {echo $componmodelo;} ?>" size="20"></td> 
								<td> <?php if($campnomb["componserie"] == 1){ $componserie=null;echo "*";}?>&nbsp;No. serie </td>
								<td><input name="componserie" type="text"	value="<?php if(!$flagnuevocomponen){ echo $sbreg[componserie];} else {echo $componserie;}?>" size="20"></td>
							</tr> 
							<tr class="NoiseFooterTD">
								<td> <?php if($campnomb["componcinv"] == 1){ $componcinv=null;echo "*";}?>&nbsp;No. inventario</td>
								<td><input name="componcinv" type="text"	value="<?php if(!$flagnuevocomponen){ echo $sbreg[componcinv];} else {echo $componcinv;}?>" size="20"></td>
								<td> <?php if($campnomb["componubicac"] == 1){ $componubicac=null;echo "*";}?>&nbsp;Ubicaci&oacute;n</td>
								<td><input name="componubicac" type="text"	value="<?php if(!$flagnuevocomponen){ echo $sbreg[componubicac];} else {echo $componubicac;}?>" size="20"></td>
							</tr>
							<tr class="NoiseFooterTD">
								<td> <?php if($campnomb["componviduti"] == 1){ $componviduti=null;echo "*";}?>&nbsp;Vida &uacute;til </td>
								<td><input name="componviduti" type="text"	value="<?php if(!$flagnuevocomponen){ echo $sbreg[componviduti];}else {echo $componviduti;}?>" size="14"></td>
								<td> <?php if($campnomb["componfeccom"] == 1){ $componfeccom=null;echo "*";}?>&nbsp;Fecha compra </td>
								<td><input name="componfeccom" type="text"	value="<?php if(!$flagnuevocomponen){ echo $sbreg[componfeccom];} else {echo $componfeccom;}?>" size="14" onFocus="if(!agree) this.blur();">
									<img src="../img/cal.gif" border="0" onClick="window.open('formcalendario.php?calencodigo=componfeccom','cal1','status=no,menubar=no,scrollbars=yes,resizable=yes,left=600,width=200,height=210');"></td>
							</tr>
							<tr class="NoiseFooterTD"> 
								<td><?php if($campnomb["componfecins"] == 1){ $componfecins=null;echo "*";}?>&nbsp;Fec. instalaci&oacute;n</td> 
								<td><input name="componfecins" type="text"	value="<?php if(!$flagnuevocomponen){ echo $sbreg[componfecins];} else {echo $componfecins;}?>" size="14" onFocus="if(!agree)this.blur();">
								       <img src="../img/cal.gif" border="0" onClick="window.open('formcalendario.php?calencodigo=componfecins','cal1','status=no,menubar=no,scrollbars=yes,resizable=yes,left=600,width=200,height=210');"></td> 
								<td><?php if($campnomb["componvengar"] == 1){ $componvengar=null;echo "*";}?>&nbsp;Venc. garantia</td>
								<td><input name="componvengar" type="text"	value="<?php if(!$flagnuevocomponen){ echo $sbreg[componvengar];} else {echo $componvengar;}?>" size="14" onFocus="if(!agree)this.blur();">
								       <img src="../img/cal.gif" border="0" onClick="window.open('formcalendario.php?calencodigo=componvengar','cal1','status=no,menubar=no,scrollbars=yes,resizable=yes,left=600,width=200,height=210');"></td> 
							</tr>
							<tr class="NoiseFooterTD">
								<td><?php if($campnomb["componalto"] == 1){ $componalto=null;echo "*";}?>&nbsp;Alto</td>
								<td><input name="componalto" type="text"	value="<?php if(!$flagnuevocomponen){ echo $sbreg[componalto];}else {echo $componalto;}?>" size="17"></td>
								<td> <?php if($campnomb["componlargo"] == 1){ $componlargo=null;echo "*";}?>&nbsp;Largo</td> 
								<td><input name="componlargo" type="text"	value="<?php if(!$flagnuevocomponen){ echo $sbreg[componlargo];}else {echo $componlargo;}?>" size="17"></td>
							</tr>
							<tr class="NoiseFooterTD">
								<td> <?php if($campnomb["componancho"] == 1){ $componancho=null; echo "*";}?>&nbsp;Ancho</td>
								<td><input name="componancho" type="text"	value="<?php if(!$flagnuevocomponen){ echo $sbreg[componancho];}else {echo $componancho;}?>" size="17"></td>
								<td> <?php if($campnomb["componpeso"] == 1){ $componpeso=null;echo "*";}?>&nbsp;Peso</td>
								<td><input name="componpeso" type="text"	value="<?php if(!$flagnuevocomponen){ echo $sbreg[componpeso];} else {echo $componpeso;}?>" size="17"></td>
							</tr>
							<!-- ** ** ** -->
							<?php
								if($tipcomcodigo){
									include('../src/FunGen/floadtipocompcamperequipo.php');
									$idcon = fncconn();
									floadtipocompcamperequipo($tipcomcodigo, $campnomb, $flagnuevocomponen, $idcon);
									fncclose($idcon);
								}
							?>
							<!-- ** ** ** -->
							<tr>
								<td class="NoiseFooterTD"> <?php if($campnomb["compondescri"] == 1){ $compondescri=null;echo "*";}?>&nbsp;Descripci&oacute;n</td>
								<td colspan="3" class="NoiseFooterTD"><textarea name="compondescri" cols="34" rows="3" wrap="VIRTUAL"><?php if(!$flagnuevocomponen){ echo $sbreg[compondescri];} else {echo $compondescri;}?></textarea></td>
							</tr>
							<tr><td class="NoiseFooterTD" colspan="5">&nbsp;</td></tr>
						</table> 
					</td> 
				</tr> 
				<tr> 
					<td><div align="center"> 
						<input type="image" name="aceptar"  src="../img/aceptar.gif" onClick="carga();form1.accionnuevocomponen.value =  1;"  width="86" height="18" alt="Aceptar" border=0> 
						<input type="image" name="cancelar" src="../img/cancelar.gif" onClick="form1.action='maestablcomponen.php';"  width="86" height="18" alt="Cancelar" border=0> 
					</div></td> 
				</tr> 
				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr> 
			</table> 
<?php if($campnomb){ echo '<font face="Verdana" >Corregir los campos marcados con *</font>';} ?>

			<input type="hidden" name="fecactual"	value="<?php $cad = getdate(); $fecactual= $cad[year]."-".$cad[mon]."-".$cad[mday]; echo $fecactual;?>">
			<input name="equipocodigo" type="hidden"	value="<?php if(!$flagnuevocomponen){ echo $equipocodigo;} else {echo $equipocodigo;} ?>">
			<input type="hidden" name="accionnuevocomponen"> 
			<input type="hidden" name="arreglo_aux" value="<?php echo $arreglo_aux?>">
			<input type="hidden" name="arreglo_cam" value="<?php echo $arreglo_cam?>">
			
			<!--	<input type="hidden" name="componcodigo"	value="<?php if(!$flagnuevocomponen){ echo $sbreg[componcodigo];}else{ echo $componcodigo;} ?>">		Udado para 'disparar' la funcion que carga el formulario			-->
			<input type="text" name="auxtrigger" size="1" style="border:none; color:#FFFFFF;" onFocus="form1.submit(); this.blur();">
			<!--cbedoya-->
			
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
		</form> 
	</body> 
<?php if(!$codigo){ echo " -->"; } ?> 
</html> 
