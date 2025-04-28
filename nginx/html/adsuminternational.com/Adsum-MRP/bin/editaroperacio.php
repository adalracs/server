<?php 
ob_start();
include ( '../src/FunGen/sesion/fncvalses.php'); 
include('../src/FunPerPriNiv/pktbltipooper.php');
if($accioneditaroperacio) 
{ 
		include ( 'editaoperacio.php'); 
		$flageditaroperacio = 1;
}
ob_end_flush();
if(!$flageditaroperacio)
{
	include ( '../src/FunGen/sesion/fnccarga.php');
	$sbreg = fnccarga($nombtabl,$radiobutton);
	if (!$sbreg)
	{
		include( '../src/FunGen/fnccontfron.php');
	}
	$idcon = fncconn();
		
	$vartipooper = $sbreg[tipopecodigo];
	$arrtipooper= loadrecordtipooper($vartipooper,$idcon);
	$codtipooper = $sbreg[tipopecodigo];
	
	$anno = strtok($sbreg[operacfecha],"-");
	$mes = strtok("-");
	$dia = strtok("-");
	
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
<title>Editar registro de operacio</title> 
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
<p><font class="NoiseFormHeaderFont">Operaciones</font></p> 
<table border="0" cellspacing="1" cellpadding="2" align="center" 
class="NoiseFormTABLE"> 
  <tr> 
    <td class="NoiseErrorDataTD">&nbsp;</td> 
  </tr> 
  <tr> 
          <td class="NoiseFieldCaptionTD"><span class="style5"><font 
color="FFFFFF"> 
Editar registro</font></span></td></tr> 
<tr> 
  <td> 
            <table width="85%" border="0" cellspacing="0" cellpadding="0" 
align="center"> 
<tr> 
 <td width="35%"><?php if($campnomb["tipopecodigo"] == 1){ $tipopecodigo=null;
 echo "*";}
 ?>Tipo de operaci&oacute;n</td> 
  <td width="65%"> <select name="tipopecodigo">
  	 <?php
    	if(!$flageditaroperacio)
            {
            	echo '<option value="'.$codtipooper.'">';
            	echo $arrtipooper[tipopenombre];
            }
            elseif ($accioneditaroperacio)
            {
            	if($tipopecodigo)
            	{
	            	echo '<option value = "'.$tipopecodigo.'">'; 
	                $idcon	= fncconn();
					$arrtipooper = loadrecordtipooper($tipopecodigo,$idcon);
					echo $arrtipooper[tipopenombre];
					fncclose($idcon);
            	}
            }?></OPTION>
	<?php
	include ('../src/FunGen/floadtipooperac.php');
	$idcon = fncconn();
	floadtipooperac($idcon);
	fncclose($idcon);
?>
      </select> 
  </td></tr> 
<tr>
  <td width="35%"><?php if($campnomb["operacvalor"] == 1){ $operacvalor=null;
 echo "*";}
 ?>Valor</td>
  <td width="65%"><input type="text" name="operacvalor"	value="<?php if(!$flageditaroperacio){ 
echo $sbreg[operacvalor];}else {echo $operacvalor;}?>" size="10"></td>
  </tr>
<tr> 
 <td width="41%"><?php if($campnomb["operacfecha"] == 1){$operacfecha = null; 
echo "*";}?>Fecha de inicio</td> 
 	<td width="59%"><input type="text" name="operacfecha" size="13" value="<?php if(!$flageditaroperacio){ echo $sbreg["operacfecha"]; } else {echo $operacfecha;}?>" onFocus="if (!agree)this.blur();">&nbsp;<img src="../img/cal.gif" border="0" onclick="window.open('formcalendario.php?calencodigo=operacfecha','cal1','status=no,menubar=no,scrollbars=yes,resizable=yes,left=600,width=200,height=210');"></td> 
 </tr> 
 <tr> 
  <td width="35%">&nbsp;</td> 
 </tr>
</table> 
  </td> 
 </tr> 
 <tr> 
<td> 
<div align="center"> 
  <input type="image" name="aceptar"  src="../img/aceptar.gif" 
onclick="form1.accioneditaroperacio.value =  1;"  width="86" height="18" alt="Aceptar" border=0> 
  <input type="image" name="cancelar" src="../img/cancelar.gif" 
onclick="form1.action='maestabloperacio.php';"  width="86" height="18" 
alt="Cancelar" border=0> 
</div> 
</td> 
 </tr> 
 <tr> 
  <td class="NoiseErrorDataTD">&nbsp;</td> 
 </tr> 
</table> 
<?php 
if($campnomb){ echo '<font face= "Verdana" >Corregir los campos marcados con *</font>';}
?>
 <input type="hidden" name="operaccodigo"	value="<?php if(!$flageditaroperacio){ 
echo $sbreg[operaccodigo];}else{ echo $operaccodigo;} ?>">
<input type="hidden" name="accioneditaroperacio"> 
<input type="hidden" name="tipopecodigo1" value="<?php echo $tipopecodigo; ?>"> 

<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
</form> 
</body> 
<?php 
    if(!$codigo) 
    { echo " -->"; } 
?> 
</html> 
