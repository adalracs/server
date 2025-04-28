<?php 
//ob_start(); 
include ( '../src/FunGen/sesion/fncvalses.php'); 
include('../src/FunPerPriNiv/pktbltipomovi.php');
include('../src/FunPerPriNiv/pktblherramie.php');
include('../src/FunPerPriNiv/pktbltransacherramie.php');
if($accioneditartransacherramie) 
{ 
	include ( 'editatransacherramie.php'); 
	$flageditartransacherramie = 1; 
} 
ob_end_flush(); 
if(!$flageditartransacherramie) 
{ 
	$idcon = fncconn();
	$radiobutton = intval($radiobutton);
	$sbreg = loadrecordtransacherramie($radiobutton,$idcon);
	$usuacodic = $GLOBALS[usuacodi];
		
	if (!$sbreg) 
	{ 
		include( '../src/FunGen/fnccontfron.php'); 
	} 
	
	$transhercodigo = $sbreg[transhercodigo];
	$varherramie = $sbreg[herramcodigo];
	$arrherramie = loadrecordherramie($varherramie,$idcon);
	$codherramie = $sbreg[herramcodigo];
	
	$vartipomovi = $sbreg[tipmovcodigo];
	$arrtipomovi = loadrecordtipomovi($vartipomovi,$idcon);
	$codtipomovi = $sbreg[tipmovcodigo];
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
<title>Editar registro de transacherramie</title> 
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
<p><font class="NoiseFormHeaderFont">Entrada/Salida de Herramienta</font></p> 
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
            <table width="97%" border="0" cellspacing="0" cellpadding="3" 
align="center"> 
<tr>
 <td width="23%"><?php if($campnomb == "tipmovcodigo"){ $tipmovcodigo = null;
 echo "*";}
 ?>Tipo de movimiento</td>
 <td colspan="2">
 <select name="tipmovcodigo">
 <?php
 		if(!$flageditartransacherramie)
            {
            	echo '<option value = "'.$codtipomovi.'">'; 
				echo $arrtipomovi[tipmovnombre];
            }
            elseif ($accioneditartransacherramie)
            {
            	if($tipmovcodigo)
            	{
	            	echo '<option value = "'.$tipmovcodigo.'">'; 
	                $idcon	= fncconn();
					$arrtipomovi = loadrecordtipomovi($tipmovcodigo,$idcon);
					echo $arrtipomovi[tipmovnombre];
					fncclose($idcon);
				}
            }
            ?></OPTION>        
 <?php
	include ('../src/FunGen/floadtipomovi.php');
	$idcon = fncconn();
	floadtipomovi($idcon);
	fncclose($idcon);
 ?>
 </select>
 </td>
 <td colspan="3">Fecha:&nbsp;
 <input type="text" onfocus="if(!agree)this.blur();" name="transherfecha" size="10" value="<?php
 if(!$flageditartransacherramie) echo $sbreg[transherfecha]; else echo $transherfecha;?>">
 &nbsp;<img src="../img/cal.gif" border="0" onclick="window.open('formcalendario.php?calencodigo=transherfecha','cal1','status=no,menubar=no,scrollbars=yes,resizable=yes,left=600,width=200,height=210');"></td>
  </tr>
 <tr>
<td colspan="6"><hr></td>
		</tr>
<tr> 
 <td colspan="2">Seleccione Herramienta&nbsp;&nbsp;
   <input name="radiobutton" type="radio" onclick="window.open('consultarherramietransac.php?codigo=<?php echo $codigo?>','ventana','status=no,menubar=no,scrollbars=yes,resizable=yes,left=300,width=800,height=600');" width="86" height="18" border=0 href="#" target="_parent""></td> 
 <td colspan="1"><div align="center">Nombre</div></td>
 <td colspan="3"><input type="text" name="herramnombre" value="<?php if(!$flageditartransacherramie) echo $arrherramie[herramnombre]; else echo $herramnombre;?>" onFocus="if (!agree)this.blur();"></td>
 </tr>
<td>&nbsp;</td>
  <td colspan="5">&nbsp;</td>
<tr>
  <td>Disponible</td>
  <td width="9%"><input type="text" style="border:none;" size="8" name="herramdispon" onfocus="if(!agree)this.blur();" value="
 <?php if(!$flageditartransacherramie) echo $arrherramie[herramdispon]; else echo $herramdispon;?>"></td>
  <td width="23%">&nbsp;</td>
  <td width="10%">&nbsp;</td>
  <td width="23%"><div align="right">Valor $</div></td>
  <td width="15%"><input type="text" style="border:none;" size="8" name="herramvalor" onfocus="if(!agree)this.blur();" value="
 <?php if(!$flageditartransacherramie) echo $arrherramie[herramvalor]; else echo $herramvalor;?>"></td>
</tr> 
<tr>
  
  </tr>
<tr>
<td colspan="6"><hr></td>
		</tr>
<tr> 
 <td width="23%"><?php if($campnomb == "transhercanti"){$transhercanti = null; echo "*";}
 ?>Cantidad</td> 
 <td colspan="5"> 
  <input name="transhercanti" type="text"	value="<?php 
if(!$flageditartransacherramie){ echo $sbreg[transhercanti];}else{ echo $transhercanti; }?>" size="10">
 </td> 
 </tr> 
 <tr> 
  <td width="23%">&nbsp;</td> 
 </tr> 
</table> 
  </td> 
 </tr> 
 <tr> 
<td> 
<div align="center"> 
  <input type="image" name="aceptar"  src="../img/aceptar.gif" 
onclick="form1.accioneditartransacherramie.value =  1;"  width="86" height="18" 
alt="Aceptar" border=0> 
  <input type="image" name="cancelar" src="../img/cancelar.gif" 
onclick="form1.action='maestabltransacherramie.php';"  width="86" height="18" 
alt="Cancelar" border=0> 
  <img src="../img/ayuda.gif" border="0" alt="Ayuda">
</div> 
</td> 
 </tr> 
 <tr> 
  <td class="NoiseErrorDataTD">&nbsp;</td> 
 </tr> 
</table> 
<?php 
if($campnomb){echo '<font face = "Verdana" >Corregir los capos marcados con 
*</font>';} 
?> 
<input type="hidden" name="transhercodigo" value="<?php if(!$flageditartransacherramie){ echo $sbreg[transhercodigo];}else{ echo $transhercodigo; } ?>"> 
<input type="hidden" name="usuacodic" value="<?php echo $usuacodic; ?>"> 
<input type="hidden" name="accioneditartransacherramie"> 
<input type="hidden" name="flageditartransacherramie" value="<?php echo $flageditartransacherramie; ?>"> 
<input type="hidden" name="herramcodigo" value="<?php if(!$flageditartransacherramie){ echo $arrherramie[herramcodigo]; }elseif($accioneditarherramie){echo $herramienomb[herramcodigo];}elseif($accioneditartransacherramie){ echo $herramcodigo;}?>">
<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
</form> 
</body> 
<?php 
    if(!$codigo) 
    { echo " -->"; } 
?> 
</html> 
