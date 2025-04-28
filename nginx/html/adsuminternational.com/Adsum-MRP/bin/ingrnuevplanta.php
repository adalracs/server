<?php 
ob_start();
include ( '../src/FunGen/sesion/fncvalses.php'); 
include('../src/FunPerPriNiv/pktblunimedida.php');
include('../src/FunPerPriNiv/pktblciudad.php');
if($accionnuevoplanta)
{
	include ( 'grabaplanta.php');
}
ob_end_flush();
?> 
<html> 
<head> 
<title>Nuevo registro de Planta</title> 
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
<meta http-equiv="expires" content="0"> 
<link rel="stylesheet" type="text/css" href="temas/Noise/Style.css"> 
<SCRIPT LANGUAGE="JavaScript"> 
<!-- Begin 
agree = 0; 
//  End --> 
</script> 
<script language="JavaScript" src="motofech.js"></script> 
<SCRIPT language=JavaScript src="../src/FunGen/jsrsClient.js" type="text/javascript" ></SCRIPT>
<script language=JavaScript src="../src/FunGen/cargarServiciselec.js" type="text/javascript" ></script>
<style type="text/css">
<!--
.style4 {font-family: Tahoma}
-->
</style>
</head> 
<?php 
    if(!$codigo) 
    { echo "<!--";} 
?> 
<body bgcolor="FFFFFF" text="#000000" <?php if(($flagnuevoplanta) && !(empty($arreglo_aux))) echo "onload=\"cargarServiciselec(window.document.form1.arreglo_aux.value);\"";?>> 
<form name="form1" method="post"  enctype="multipart/form-data"> 
<p><font class="NoiseFormHeaderFont">Ubicaci&oacute;n</font></p> 
<table width="500" border="0" align="center" cellpadding="1" cellspacing="2" 
class="NoiseFormTABLE"> 
  <tr> 
    <td width="500" class="NoiseErrorDataTD">&nbsp;</td> 
  </tr> 
  <tr> 
          <td class="NoiseFieldCaptionTD"><span class="style5"><font color="FFFFFF"> 
Ingresar nuevo registro</font></span></td></tr> 
<tr> 
  <td> 
            <table width="98%" border="0" cellspacing="1" cellpadding="0" 
align="center"> 
<tr> 
 <td width="35%" class="NoiseFooterTD"><?php if($campnomb["plantanombre"] == 1){ $plantanombre=null;
echo "*";}
?>&nbsp;C&oacute;digo Inmueble</td> 
  <td colspan="2" class="NoiseDataTD"> 
   <input type="text" name="plantabieninmu"	value="<?php if(!$flagnuevoplanta){ 
echo $sbreg[plantabieninmu];}else {echo $plantabieninmu;}?>">  
<input type="button" value=" Bienes Inmueble " name="radio1" onClick="window.open('maestablbienesinmugen.php?codigo=<?php echo $codigo?>','ventana','status=no,menubar=no,scrollbars=yes,resizable=yes,left=300,width=800,height=600');" width="86" height="18" href="#" target="_parent">
</td> 
 </tr> 
 <td width="35%" class="NoiseFooterTD"><?php if($campnomb["plantanombre"] == 1){ $plantanombre=null;
echo "*";}
?>&nbsp;Nombre</td> 
  <td colspan="2" class="NoiseDataTD"> 
   <input type="text" name="plantanombre"	value="<?php if(!$flagnuevoplanta){ 
echo $sbreg[plantanombre];}else {echo $plantanombre;}?>" size="40">  </td> 
 </tr> 
<tr>
 <td class="NoiseFooterTD"> <?php if($campnomb["plantaencarg"] == 1){ $plantaencarg=null;
echo "*";}
?>&nbsp;Profesional de Operaci&oacute;n</td> 
  <td class="NoiseDataTD"><input type="text" name="plantaencarg"	value="<?php if(!$flagnuevoplanta){ 
echo $sbreg[plantaencarg];}else {echo $plantaencarg;}?>" size="40"></td>
</tr> 
  <tr>
 <td class="NoiseFooterTD"> <?php if($campnomb["plantaencman"] == 1){ $plantaencman=null;
echo "*";}
?>&nbsp;Profesional de Mantenimiento</td> 
  <td class="NoiseDataTD"><input type="text" name="plantaencman"	value="<?php if(!$flagnuevoplanta){ 
echo $sbreg[plantaencman];}else {echo $plantaencman;}?>" size="40"></td>
  </tr> 
 <tr> 
 <td width="35%" class="NoiseFooterTD"> <?php if($campnomb["ciudadcodigo"] == 1){ $ciudadcodigo=null;
echo "*";}
?>&nbsp;Ciudad</td> 
  <td colspan="2" class="NoiseDataTD"> 
   <select name="ciudadcodigo">
   <?php
    	if(!$flagnuevoplanta)
           	echo '<option value = "">Seleccione'; 
        elseif ($accionnuevoplanta)
        {
          	if($ciudadcodigo)
          	{
            	echo '<option value = "'.$ciudadcodigo.'">'; 
                $idcon	= fncconn();
				$arrciudad= loadrecordciudad($ciudadcodigo,$idcon);
				echo $arrciudad[ciudadnombre];
				fncclose($idcon);
         	}else
            	echo '<option value = "">Seleccione'; 
        }
		$idcon = fncconn();
   		include('../src/FunGen/floadciudad.php');
   		floadciudad($idcon);
   		fncclose($idcon);
   ?>
   </select>  </td> 
 </tr>
<tr> 
 <td width="35%" class="NoiseFooterTD"> <?php if($campnomb["plantaubicac"] == 1){ $plantaubicac=null;
echo "*";}
?>&nbsp;Ubicaci&oacute;n</td> 
  <td colspan="2" class="NoiseDataTD"> 
   <input type="text" name="plantaubicac"	value="<?php if(!$flagnuevoplanta){ 
echo $sbreg[plantaubicac];}else {echo $plantaubicac;}?>" size="40">  </td> 
 </tr> 
<tr> 
 <td width="35%" class="NoiseFooterTD"> <?php if($campnomb["plantacapaci"] == 1){ $plantacapaci=null;
echo "*";}
?>&nbsp;Capacidad</td> 
  <td colspan="2" class="NoiseDataTD"> 
   <input type="text" name="plantacapaci"	value="<?php if(!$flagnuevoplanta){ 
echo $sbreg[plantacapaci];}else {echo $plantacapaci;}?>"size="13">&nbsp;&nbsp;
     <select name="unidadcodigo">
   <?php
    	if(!$flagnuevoplanta)
           	echo '<option value = "">Seleccione'; 
        elseif ($accionnuevoplanta)
        {
          	if($unidadcodigo)
          	{
            	echo '<option value = "'.$unidadcodigo.'">'; 
                $idcon	= fncconn();
				$arrunimedida= loadrecordunimedida($unidadcodigo,$idcon);
				echo $arrunimedida[unidadacra];
				fncclose($idcon);
         	}else
            	echo '<option value = "">Seleccione'; 
        }
		$idcon = fncconn();
   		include('../src/FunGen/floadunimedida.php');
   		floadunimedida($idcon);
   		fncclose($idcon);
   ?>
   </select></td> 
 </tr> 
<tr> 
 <td width="35%" class="NoiseFooterTD"> <?php if($campnomb["plantadescri"] == 1){ $plantadescri=null;
echo "*";}
?>&nbsp;Descripci&oacute;n</td> 
  <td colspan="2" class="NoiseDataTD"> 
    <textarea name="plantadescri" cols="34" rows="3" wrap="VIRTUAL"><?php if(!$flagnuevoplanta){ 
echo $sbreg[plantadescri];} else {echo $plantadescri;}?></textarea>  </td> 
 </tr>
<tr>
  <td class="NoiseFooterTD"><input name="opnServicio" type="button" onFocus="cargarServiciselec(document.form1.arreglo_aux.value);" onClick="window.open('consultarservicioplanta.php?codigo=<?php echo $codigo?>','ventana','status=no,menubar=no,scrollbars=yes,resizable=yes,left=300,width=800,height=600');" value="Buscar servicios" <?php if(($flagnuevoplanta) && !(empty($arreglo_aux))) echo "checked"; ?>></td>
  <td class="NoiseDataTD">
  <select name="serviciselec" size="4">
  </select></td>
</tr>  

</table> 
  </td> 
 </tr> 
 <tr> 
<td> 
<div align="center">
  <input type="image" name="aceptar"  src="../img/aceptar.gif" 
onclick="form1.accionnuevoplanta.value =  1;"  width="86" height="18" alt="Aceptar" 
border=0> 
  <input type="image" name="cancelar" src="../img/cancelar.gif" 
onclick="form1.action='maestablplanta.php';"  width="86" height="18" 
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
 <input type="hidden" name="plantacodigo"	value="<?php if(!$flagnuevoplanta){ 
echo $sbreg[plantacodigo];}else{ echo $plantacodigo;} ?>">
<input type="hidden" name="accionnuevoplanta"> 
<input type="hidden" name="flagerror" value="<?php echo $flagerror; ?>"> 
<input type="hidden" name="codigo" value="<?php echo $codigo; ?>">
<!--					-->
<input type="hidden" name="arreglo_aux" value="<?php echo $arreglo_aux?>">
<!--					--> 
</form> 
</body> 
<?php 
    if(!$codigo) 
    { echo " -->"; } 
?> 
</html>
