<?php 
ob_start(); 
include ( '../src/FunGen/sesion/fncvalses.php'); 
include('../src/FunPerPriNiv/pktblsegmentos.php');

if($accioneditarsubsegmentos) 
{ 
	include ( 'editasubsegmentos.php'); 
	$flageditarsubsegmentos = 1; 
} 
ob_end_flush(); 
if(!$flageditarsubsegmentos) 
{ 
include ( '../src/FunGen/sesion/fnccarga.php'); 
$sbreg = fnccarga($nombtabl,$radiobutton); 
if (!$sbreg) 
	{ 
		include( '../src/FunGen/fnccontfron.php'); 
	} 
} 

?> 
<!-- Propiedad intelectual de Adsum SA (c) 
-Todos los derechos reservados- 
Creado con WAG Adsum 
Autor: Andr�s A. Riascos D. 
Fecha: 26052004 
GenVers: 3.1 --> 
<html> 
<head> 
<title>Editar registro de subsegmentos</title> 
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
<meta http-equiv="expires" content="0"> 
<link rel="stylesheet" type="text/css" href="temas/Noise/Style.css"> 
<SCRIPT LANGUAGE="JavaScript"> 
<!-- Begin 
agree = 0; 
//  End --> 
</script> 
</head> 
<?php 
    if(!$codigo) 
    { echo "<!--";} 
?> 
<body bgcolor="FFFFFF" text="#000000"> 
<form name="form1" method="post"  enctype="multipart/form-data"> 
<p><font class="NoiseFormHeaderFont">Subsegmento</font></p> 
<table width="350" border="0" align="center" cellpadding="0" cellspacing="0" 
class="NoiseFormTABLE"> 
  <tr> 
    <td width="300" class="NoiseErrorDataTD">&nbsp;</td> 
  </tr> 
  <tr> 
          <td class="NoiseFieldCaptionTD"><span class="style5"><font 
color="FFFFFF"> 
Editar registro</font></span></td></tr> 
<tr> 
  <td> 
            <table width="85%" border="0" cellspacing="1" cellpadding="0" 
align="center"> 
            <tr> 
 <td width="41%" class="NoiseDataTD"><?php if($campnomb["subsegcodigo"] == 1){$subsegcodigo = null; 
echo "*";}?>&nbsp;C&oacute;digo</td> 
 <td width="59%"> 
 <?php if(!$flageditarsubsegmentos){ 
echo $sbreg[subsegcodigo];}else{ echo $subsegcodigo; }?> 
 </td> 
 </tr>
<tr> 
 <td width="41%" class="NoiseDataTD"><?php if($campnomb["subsegnombre"] == 1){$subsegnombre  = null; 
echo "*";}?>&nbsp;Nombre</td> 
 <td width="59%"> 
  <input type="text" name="subsegnombre"	value="<?php if(!$flageditarsubsegmentos){ 
echo $sbreg[subsegnombre];}else{ echo $subsegnombre; }?>"> 
 </td> 
 </tr> 
  <tr>
 	<td width="41%" class="NoiseDataTD"><?php if($flageditarsubsegmentos == 1 && !$segmencodigo){ echo "*";}?>&nbsp;Segmento</td> 
 					  <!--Departamento-->
 					  <td class="NoiseDataTD"><select name="subsegmencod">
		  							 	<?php
		  							 		if(!$segmencodigo)
		  							 			$segmencodigo = $sbreg[subsegmencod];
											$subsegmencod1 = $segmencodigo;
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
			    										
			    											//if($flageditarciudad){
			    												if($subsegmencod1 == $arr[segmencodigo])
			    													echo "selected";
			    											//}	
			    											echo ">".$arr[segmennombre]."</option>"."\n";
													}
												}
											}
										?>
										</select></td>

 </tr>
 
  <tr>
 <td width="41%" class="NoiseDataTD"> <?php if($campnomb["subsegdescri"] == 1){ $subsegdescri=null;
echo "*";}
?>&nbsp;Descripci&oacute;n</td>
  <td rowspan="2">
    <textarea name="subsegdescri" rows="3" wrap="VIRTUAL"><?php if(!$flageditarsubsegmentos){echo $sbreg[subsegdescri];}else {echo $subsegdescri;}?></textarea>
  </td>
 </tr>
 <tr class="NoiseDataTD"> 
  <td width="41%">&nbsp;</td> 
 </tr>  
</table> 
  </td> 
 </tr> 
 <tr> 
<td> 
<div align="center"> 
  <input type="image" name="aceptar"  src="../img/aceptar.gif" 
onclick="form1.accioneditarsubsegmentos.value =  1;"  width="86" height="18" 
alt="Aceptar" border=0> 
  <input type="image" name="cancelar" src="../img/cancelar.gif" 
onclick="form1.action='maestablsubsegmentos.php';"  width="86" height="18" 
alt="Cancelar" border=0> 
</div> 
</td> 
 </tr> 
 <tr> 
  <td class="NoiseErrorDataTD">&nbsp;</td> 
 </tr> 
</table> 
<?php if($campnomb){echo '<font face = "Verdana" >Corregir los capos marcados con *</font>';} ?> 
<input type="hidden" name="subsegcodigo" value="<?php if(!$flageditarsubsegmentos){ echo $sbreg[subsegcodigo];}else{ echo $subsegcodigo; } ?>">
<input type="hidden" name="accioneditarsubsegmentos"> 
<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
</form> 
</body> 
<?php 
    if(!$codigo) 
    { echo " -->"; } 
?> 
</html> 