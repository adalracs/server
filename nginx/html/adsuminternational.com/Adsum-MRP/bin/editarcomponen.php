<?php 
ob_start();
	include ( '../src/FunGen/sesion/fncvalses.php');
	include ( '../src/FunPerPriNiv/pktbltipocomponen.php');
	include ( '../src/FunPerPriNiv/pktblequipo.php');
	if($accioneditarcomponen){
			include ( 'editacomponen.php'); 
			$flageditarcomponen = 1;
	}
ob_end_flush();
	if(!$flageditarcomponen){
		include ( '../src/FunGen/sesion/fnccarga.php');
		$sbreg = fnccarga($nombtabl,$radiobutton);
		if (!$sbreg){
			include( '../src/FunGen/fnccontfron.php');
		}
		$idcon = fncconn();
		$varequipo = $sbreg[equipocodigo];
		$arrequipo = loadrecordequipo($varequipo,$idcon);
		$codequipo = $sbreg[equipocodigo];
		
		$sbregequip = loadrecordequipo($sbreg[equipocodigo],$idcon);
		$equiponombre = $sbregequip[equiponombre];
		$equipocodigo = $sbreg[equipocodigo];
		
		if($sbreg['tipcomcodigo']){
			$sbregtipocomponen = loadrecordtipocomponen($sbreg['tipcomcodigo'], $idcon);
			$acronitipocomponen = $sbregtipocomponen['tipcomacroni'];
			$codigotipocomponen = $sbregtipocomponen['tipcomcodigo'];
		}
		fncclose($idcon);
	}
?> 
<html> 
<head> 
<title>Editar registro de componen</title> 
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
<meta http-equiv="expires" content="0"> 
<link rel="stylesheet" type="text/css" href="temas/Noise/Style.css"> 
<script language="JavaScript" src="../src/FunGen/jsrsClient.js" type="text/javascript" ></script>
<script language=JavaScript src="../src/FunGen/cargarEquipo.js" type="text/javascript" ></script>
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
</script> 
<script language="JavaScript" src="motofech.js"></script> 
<script language=JavaScript src="../src/FunGen/cargarTipocomponen.js" type="text/javascript"></script>
</head> 
<?php 
if(!$codigo)
{ echo "<!--";}
?> 
<body bgcolor="FFFFFF" text="#000000"> 
<form name="form1" method="post"  enctype="multipart/form-data"> 
<p><font class="NoiseFormHeaderFont">Componentes</font></p> 
<table width="70%" border="0" align="center" cellpadding="2" cellspacing="1" class="NoiseFormTABLE"> 
  <tr> 
    <td class="NoiseErrorDataTD">&nbsp;</td> 
  </tr> 
  <tr> 
          <td class="NoiseFieldCaptionTD"><span class="style5"><font 
color="FFFFFF"> 
Editar registro</font></span></td></tr> 
<tr> 
  <td> 
  						<table width="95%" border="0" cellspacing="0" cellpadding="3" align="center">
							<tr>
								<td><input type="button" value="   Tipo de componente    " name="opnTipcom" onClick="window.open('maestabltipocomponenaux.php?codigo=<?php echo $codigo?>','ventana','status=no,menubar=no,scrollbars=yes,resizable=yes,left=300,width=800,height=600');">
									<input type="hidden" size="10" name="tipcomcodigo" onBlur="cargarTipocomponen(this.value);" value="<?php if(!$flageditarcomponen){ echo $codigotipocomponen;} else {echo $tipcomcodigo;} ?>">
									<input type="text" size="10" name="tipcomacroni" onBlur="cargarTipocomponen(this.value);" value="<?php
if(!$flageditarcomponen){ echo $acronitipocomponen;} else {echo $tipcomacroni;}?>">
								</td>
							</tr>
						</table>
            <table width="95%" border="0" cellspacing="1" cellpadding="0" align="center">

                           					              <tr class="NoiseFooterTD">
						              	<td width="20%" class=""><?php if($campnomb["componcodigo1"] == 1){ $componcodigo1=null;echo "*";}?>&nbsp;Codigo</td>
						                	<td width="30%" class=""><input name="componcodigo1" type="text" disabled	value="<?php if(!$flageditarcomponen){ echo $sbreg[componcodigo];} else {echo $componcodigo;}?>" size="20" onFocus="if(!agree) this.blur();"></td>
											<td colspan="2">&nbsp;</td>
						              </tr>
              <tr class="NoiseFooterTD"> 
 <td width="20%"> <?php if($campnomb["componnombre"] == 1){ $componnombre=null;
echo "*";}
?>
   &nbsp;Nombre</td> 
  <td colspan="3"><input name="componnombre" type="text"	value="<?php if(!$flageditarcomponen){ 
echo $sbreg[componnombre];}else {echo $componnombre;}?>" size="50">  </td> 
 </tr> 
							<tr><td class="NoiseErrorDataTD" colspan="4"></td></tr> 
	               					<tr><td class="NoiseFieldCaptionTD" colspan="4"></td></tr> 
							<tr><td class="NoiseErrorDataTD" colspan="4"></td></tr> 
<tr> 
 <td width="20%" class="NoiseErrorDataTD"> <?php if($campnomb["equipocodigo"] == 1){ $equipocodigo=null;
echo "*";}
?>
   <input name="radio1"  type="button" value="Equipo" onClick="window.open('maestablequipogen.php?codigo=<?php echo $codigo?>','equipogen','status=no,menubar=no,scrollbars=yes,resizable=yes,left=300,width=800,height=600');" width="86" height="18" alt="Cancelar" border=0 href="#" target="_parent"></td>
 <td colspan="3" class="NoiseErrorDataTD"><input name="equiponombre" type="text"	value="<?php if(!$flageditarcomponen){ 
echo $equiponombre;} else {echo $equiponombre;} ?>" size="50" onFocus="if (!agree)this.blur();"> </td>
 </tr>
							<tr><td class="NoiseErrorDataTD" colspan="4"></td></tr> 
	               					<tr><td class="NoiseFieldCaptionTD" colspan="4"></td></tr> 
							<tr><td class="NoiseErrorDataTD" colspan="4"></td></tr> 
 <tr class="NoiseFooterTD">
  <td width="20%"> <?php if($campnomb["componfabric"] == 1){ $componfabric=null;
echo "*";}
?>
    &nbsp;Fabricante</td> 
  <td width="30%"><input name="componfabric" type="text"	value="<?php if(!$flageditarcomponen){ 
echo $sbreg[componfabric];} else {echo $componfabric;} ?>" size="20">  </td> 
<td><?php if($campnomb["componmarca"] == 1){ $componmarca=null;
echo "*";}
?>
  &nbsp;Marca</td>  
 <td><input name="componmarca" type="text"	value="<?php if(!$flageditarcomponen){ 
echo $sbreg[componmarca];}else {echo $componmarca;}?>" size="20"></td>
 </tr> 
<tr class="NoiseFooterTD"> 
 <td width="20%"><?php if($campnomb["componmodelo"] == 1){ $componmodelo=null;
echo "*";}
?>
   &nbsp;Modelo</td> 
  <td width="30%"><input name="componmodelo" type="text"	value="<?php if(!$flageditarcomponen){ 
echo $sbreg[componmodelo];} else {echo $componmodelo;} ?>" size="20"></td> 
 <td width="20%"><?php if($campnomb["componserie"] == 1){ $componserie=null;
echo "*";}
?>
   No. serie </td> 
  <td width="30%"><input name="componserie" type="text"	value="<?php if(!$flageditarcomponen){ 
echo $sbreg[componserie];} else {echo $componserie;}?>" size="20"></td> 
 </tr> 
<tr class="NoiseFooterTD">
  <td><?php if($campnomb["componcinv"] == 1){ $componcinv=null;
echo "*";}
?>
    &nbsp;No. inventario </td>
  <td><input name="componcinv" type="text"	value="<?php if(!$flageditarcomponen){ 
echo $sbreg[componcinv];} else {echo $componcinv;}?>" size="20"></td>
  <td><?php if($campnomb["componubicac"] == 1){ $componubicac=null;
echo "*";}
?>
    &nbsp;Ubicaci&oacute;n</td>
  <td><input name="componubicac" type="text"	value="<?php if(!$flageditarcomponen){ 
echo $sbreg[componubicac];} else {echo $componubicac;}?>" size="20"></td>
</tr>
<tr class="NoiseFooterTD">
  <td><?php if($campnomb["componviduti"] == 1){ $componviduti=null;
echo "*";}
?>
    &nbsp;Vida &uacute;til </td>
  <td><input name="componviduti" type="text"	value="<?php if(!$flageditarcomponen){ 
echo $sbreg[componviduti];}else {echo $componviduti;}?>" size="14"></td>
  <td><?php if($campnomb["componfeccom"] == 1){ $componfeccom=null;
echo "*";}
?>
    &nbsp;Fecha compra </td>
  <td><input name="componfeccom" type="text"	value="<?php if(!$flageditarcomponen){ 
echo $sbreg[componfeccom];} else {echo $componfeccom;}?>" size="14" onFocus="if(!agree) this.blur();">
    <img src="../img/cal.gif" border="0" onClick="window.open('formcalendario.php?calencodigo=componfeccom','cal1','status=no,menubar=no,scrollbars=yes,resizable=yes,left=600,width=200,height=210');"></td>
</tr>
<tr class="NoiseFooterTD">
  <td><?php if($campnomb["componfecins"] == 1){ $componfecins=null;
echo "*";}
?>
    &nbsp;Fec. instalaci&oacute;n</td>
  <td><input name="componfecins" type="text"	value="<?php if(!$flageditarcomponen){ 
echo $sbreg[componfecins];} else {echo $componfecins;}?>" size="14" onFocus="if(!agree)this.blur();">
    <img src="../img/cal.gif" border="0" onClick="window.open('formcalendario.php?calencodigo=componfecins','cal1','status=no,menubar=no,scrollbars=yes,resizable=yes,left=600,width=200,height=210');"></td>
  <td><?php if($campnomb["componvengar"] == 1){ $componvengar=null;
echo "*";}
?>
    &nbsp;Venc. garantia</td>
  <td><input name="componvengar" type="text"	value="<?php if(!$flageditarcomponen){ 
echo $sbreg[componvengar];} else {echo $componvengar;}?>" size="14" onFocus="if(!agree)this.blur();">
    <img src="../img/cal.gif" border="0" onClick="window.open('formcalendario.php?calencodigo=componvengar','cal1','status=no,menubar=no,scrollbars=yes,resizable=yes,left=600,width=200,height=210');"></td>
</tr>
<tr class="NoiseFooterTD">
  <td><?php if($campnomb["componalto"] == 1){ $componalto=null;
echo "*";}
?>
    &nbsp;Alto</td>
  <td><input name="componalto" type="text"	value="<?php if(!$flageditarcomponen){ 
echo $sbreg[componalto];}else {echo $componalto;}?>" size="17"></td>
  <td> <?php if($campnomb["componlargo"] == 1){ $componlargo=null;
echo "*";}
?>
    &nbsp;Largo</td> 
  <td><input name="componlargo" type="text"	value="<?php if(!$flageditarcomponen){ 
echo $sbreg[componlargo];}else {echo $componlargo;}?>" size="17"></td>
</tr>
<tr class="NoiseFooterTD">
  <td> <?php if($campnomb["componancho"] == 1){ $componancho=null;
echo "*";}
?>
    &nbsp;Ancho</td>
  <td><input name="componancho" type="text"	value="<?php if(!$flageditarcomponen){ 
echo $sbreg[componancho];}else {echo $componancho;}?>" size="17"></td>
  <td> <?php if($campnomb["componpeso"] == 1){ $componpeso=null;
echo "*";}
?>
    &nbsp;Peso</td>
  <td><input name="componpeso" type="text"	value="<?php if(!$flageditarcomponen){ 
echo $sbreg[componpeso];} else {echo $componpeso;}?>" size="17"></td>
</tr> 
 <!-- * *Campos personalizados* * -->
          <?php
          	if(!$flageditarcomponen)
			{
				include('../src/FunGen/floadcomponcamperequipo.php');
				$_POST[edicion] = 1;
				// 'true' indica que es un detallar/borrar
				$idcon = fncconn();
				floadcomponcamperequipo($sbreg['componcodigo'], null, null, $idcon);
				fncclose($idcon);
			}else
			{
				include('../src/FunGen/floadtipocompcamperequipo.php');
				$idcon = fncconn();
				floadtipocompcamperequipo($tipcomcodigo, $campnomb, $flageditarcomponen, $idcon);
				fncclose($idcon);
			}
		?>
          <!-- * * * -->
 <tr class="NoiseFooterTD">
   <td> <?php if($campnomb["compondescri"] == 1){ $compondescri=null;
echo "*";}
?>
     &nbsp;Descripci&oacute;n</td>
   <td colspan="3" rowspan="2"><textarea name="compondescri" cols="34" rows="3" wrap="VIRTUAL"><?php if(!$flageditarcomponen){ 
echo $sbreg[compondescri];} else {echo $compondescri;}?></textarea></td>
   </tr>
 <tr class="NoiseFooterTD">
   <td>&nbsp;</td>
 </tr>
 <tr> 
  <td width="20%">&nbsp;</td> 
 </tr> 
</table> 
  </td> 
 </tr> 
 <tr> 
<td> 
<div align="center"> 
  <input type="image" name="aceptar"  src="../img/aceptar.gif" 
onclick="carga();form1.accioneditarcomponen.value =  1;">
  <input type="image" name="cancelar" src="../img/cancelar.gif" 
onclick="form1.action='maestablcomponen.php';"  width="86" height="18" 
alt="Cancelar" border=0> 
</div> 
</td> 
 </tr> 
 <tr> 
  <td class="NoiseErrorDataTD">&nbsp;</td> 
 </tr> 
</table> 
<?php 
if($campnomb){ echo '<font face="Verdana" >Corregir los campos marcados con *</font>';} 
?>
<input type="hidden" name="componcodigo"	value="<?php if(!$flageditarcomponen){ echo $sbreg[componcodigo];}else{ echo $componcodigo;} ?>">
<input type="hidden" name="fecactual"	value="<?php $cad = getdate(); $fecactual= $cad[year]."-".$cad[mon]."-".$cad[mday]; echo $fecactual;?>">
<input type="hidden" name="componactivo"	value="<?php $componcodigo = 1; echo $componactivo;?>">
<input type="hidden" name="componestado1" value="<?php echo $componestado;?>"> 
<input type="hidden" name="codequipo" value="<?php echo $codequipo;?>"> 
<input type="hidden" name="accioneditarcomponen"> 
<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
<input type="hidden" name="flageditarcomponen" value="<?php echo $flageditarcomponen; ?>">  
<input name="equipocodigo" type="hidden"	value="<?php if(!$flagnuevocomponen){ echo $equipocodigo;} else {echo $equipocodigo;} ?>">
<!--		??			-->
<input type="hidden" name="arreglo_aux" value="<?php echo $arreglo_aux?>">
<input type="hidden" name="arreglo_cam" value="<?php echo $arreglo_cam?>">
<!--		??			-->
<!--			Udado para 'disparar' la funcion que carga el formulario			-->
<input type="text" name="auxtrigger" size="1" style="border:none; color:#FFFFFF;" onFocus="form1.flageditarcomponen.value=1; form1.submit(); this.blur();">
<!--		??						-->

</form> 
</body> 
<?php 
if(!$codigo)
{ echo " -->"; }
?> 
</html> 
