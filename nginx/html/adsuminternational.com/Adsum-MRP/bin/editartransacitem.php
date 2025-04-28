<?php 
ob_start(); 
include ( '../src/FunGen/sesion/fncvalses.php'); 
include('../src/FunPerPriNiv/pktbltransacitem.php');
include('../src/FunPerPriNiv/pktbltipomovi.php');
include('../src/FunPerPriNiv/pktblitem.php');
include('../src/FunPerPriNiv/pktblunimedida.php');
include ( '../src/FunPerPriNiv/pktblusuario.php');
include ( '../src/FunPerPriNiv/pktblbodega.php');
include ( '../src/FunPerPriNiv/pktblitemestado.php');
if($accioneditartransacitem) 
{ 
	include ( 'editatransacitem.php'); 
	$flageditartransacitem = 1; 
} 
ob_end_flush(); 
if(!$flageditartransacitem)
{
	$idcon = fncconn();
	$radiobutton = intval($radiobutton);
	$sbreg = loadrecordtransacitem($radiobutton,$idcon);
	$usuacodic = $GLOBALS[usuacodi];
			
	if (!$sbreg)
	{
		include( '../src/FunGen/fnccontfron.php');
	}
	
	$transitecodigo = $sbreg[transitecodigo];
	$varitem = $sbreg[itemcodigo];
	$arritem = loadrecorditem($varitem,$idcon);
	$coditem = $sbreg[itemcodigo];

	$varbod = $sbreg[bodegacodigo];
	$arrbod = loadrecordbodega($varbod,$idcon);
	$codbod = $sbreg[bodegacodigo];
	
	$vartipomovi = $sbreg[tipmovcodigo];
	$arrtipomovi = loadrecordtipomovi($vartipomovi,$idcon);
	$codtipomovi = $sbreg[tipmovcodigo];
	
	$varitemestado = $sbreg[itestacodigo];
	$arritemest = loadrecorditemestado($varitemestado,$idcon);
	$itestcod = $sbreg[itestacodigo];
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
<title>Editar registro de transacitem</title> 
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
<meta http-equiv="expires" content="0"> 
<link rel="stylesheet" type="text/css" href="temas/Noise/Style.css">
<SCRIPT LANGUAGE="JavaScript" type="text/javascript" src="../src/FunGen/cargarItemtransac.js"></script> 
<SCRIPT LANGUAGE="JavaScript" type="text/javascript" src="../src/FunGen/jsrsClient.js"></script> 
<SCRIPT LANGUAGE="JavaScript" type="text/javascript" src="motofetch.js"></script> 
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
<p><font class="NoiseFormHeaderFont">Entrada/Salida de Item</font></p> 
<table border="0" cellspacing="1" cellpadding="2" align="center" 
class="NoiseFormTABLE"> 
  <tr> 
    <td width="467" class="NoiseErrorDataTD">&nbsp;</td> 
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
 <td width="23%"><?php if($campnomb["tipmovcodigo"] == 1){ $tipmovcodigo = null;
 echo "*";}
 ?>Tipo de movimiento</td>
 <td colspan="2">
 <select name="tipmovcodigo">
 <?php
 		if(!$flageditartransacitem)
            {
            	echo '<option value = "'.$codtipomovi.'">'; 
				echo $arrtipomovi[tipmovnombre];
            }
            elseif ($accioneditartransacitem)
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
 <td><?php if($campnomb["transitefecha"] == 1){ $transitefecha = null;
 echo "*";}
 ?>Fecha:</td>
 <td colspan="2"><input type="text" name="transitefecha" size="13" value="<?php if(!$flageditartransacitem){ echo $sbreg[transitefecha]; } else {echo $transitefecha;}?>" onFocus="if (!agree)this.blur();">
 &nbsp;<img src="../img/cal.gif" border="0" onclick="window.open('formcalendario.php?calencodigo=transitefecha','cal1','status=no,menubar=no,scrollbars=yes,resizable=yes,left=600,width=200,height=210');"></td>
  </tr>  
<tr>
<td><?php if($campnomb["bodegacodigo"] == 1){ $bodegacodigo = null;
 echo "*";}
 ?>Bodega</td>
<td colspan="5">
<select name="bodegacodigo">
<?php 
if(!$flageditartransacitem)
{
 echo '<option value="'.$sbreg[bodegacodigo].'">';
 echo $arrbod[bodeganombre];
}
elseif ($accioneditartransacitem)
{
	if($bodegacodigo)
	{
		echo '<option value="'.$bodegacodigo.'">';
		$idcon = fncconn();
		$arrbodega = loadrecordbodega($bodegacodigo, $idcon);
		echo $arrbodega[bodeganombre];
		fncclose($idcon);	
	}
	else 	
		echo '<option value="">Seleccione';
} echo "</option>";
include ('../src/FunGen/floadbodega.php');
$idcon = fncconn();
floadbodega($idcon);
fncclose($idcon);
?></select>
</td>
</tr>
 <tr>
<td colspan="6"><hr></td>
</tr>
<tr> 
 <td colspan="2">Seleccione Item&nbsp;&nbsp;
   <input name="radiobutton" type="radio" onclick="window.open('consultaritemtransac.php?codigo=<?php echo $codigo?>','ventana','status=no,menubar=no,scrollbars=yes,resizable=yes,left=300,width=800,height=600');" width="86" height="18" alt="Cancelar" border=0 href="#" target="_parent"></td> 
 <td colspan="1"><div align="center">Nombre</div></td>
 <td colspan="3"><input type="text" name="itemnomb" value="<?php if(!$flageditartransacitem){ echo $arritem[itemnombre]; }elseif($accioneditaritem){ echo $itemnomb[itemnombre];}elseif($accioneditartransacitem){ echo $itemnomb;} ?>" onFocus="if (!agree)this.blur();"></td>
 </tr>
 <td colspan="2">&nbsp;</td>
  <td align="center">C&oacute;digo</td>
  <td colspan="3"><input type="text" size="8" onblur="cargarItemtransac(this.value);" name="itemcodigo" value="<?php 
  if(!$flageditartransacitem) echo $sbreg[itemcodigo]; else echo $itemcodigo;?>"></td>
  </tr>
<td>&nbsp;</td>
  <td colspan="5">&nbsp;</td>
<tr>
  <td>Cant. M&iacute;nima</td>
  <td width="9%"><input type="text" size="3" name="itemcanmin" style="border:none;" onfocus="if(!agree)this.blur();" value="<?php 
  if(!$flageditartransacitem) echo $arritem[itemcanmin]; else echo $itemcanmin;?>"></td>
  <td width="23%">Cant. M&aacute;xima</td>
  <td width="10%"><input type="text" size="3" name="itemcanmax" style="border:none;" onfocus="if(!agree)this.blur();" value="<?php 
  if(!$flageditartransacitem) echo $arritem[itemcanmax]; else echo $itemcanmax;?>"></td>
  <td width="23%"><div align="right">Disponible</div></td>
  <td width="15%"><input type="text" size="3" name="itemdispon" style="border:none;" onfocus="if(!agree)this.blur();" value="<?php 
  if(!$flageditartransacitem) echo $arritem[itemdispon]; else echo $itemdispon;?>"></td>
</tr> 
<tr>
<td colspan="6"><?php if($campnomb["itestacodigo"] == 1){ $itestacodigo = null;
 echo "*";}
 ?>Estado<br>
<select name="itestacodigo">
<?php 
if(!$flageditartransacitem)
{
 echo '<option value="'.$itestcod.'">';
 echo $arritemest[itestanombre];
}
elseif ($accioneditartransacitem)
{
	if($itestacodigo)
	{
		echo '<option value="'.$itestacodigo.'">';
		$idcon = fncconn();
		$arritemestado = loadrecorditemestado($itestacodigo, $idcon);
		echo $arritemestado[itestanombre];
		fncclose($idcon);	
	}
	else 	
		echo '<option value="">Seleccione';
} echo "</option>";
include ('../src/FunGen/floaditemestado.php');
$idcon = fncconn();
floaditemestado($idcon);
fncclose($idcon);
?></select>
</td>
</td>
<tr>
<td colspan="6"><hr></td>
		</tr>
		
<tr> 
 <td width="23%">Valor $</td> 
 <td colspan="5"><input type="text" name="itemvalor" style="border:none;" onFocus="if(!agree)this.blur();" value="<?php 
 if (!$flageditartransacitem) echo $arritem[itemvalor]; else echo $itemvalor;?>"
 size="10"></td> 
 </tr> 
<tr> 
 <td width="23%"><?php if($campnomb["transitecantid"] == 1){$transitecantid = null; echo "*";}
 ?>Cantidad</td> 
 <td colspan="5"> 
  <input name="transitecantid" type="text"	value="<?php 
if(!$flageditartransacitem){ echo $sbreg[transitecantid];}else{ echo 
$transitecantid; }?>" size="10">&nbsp;<?php if($accioneditaritem){ echo $nombunim[unidadacra];} ?>
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
onclick="form1.accioneditartransacitem.value =  1;"  width="86" height="18" 
alt="Aceptar" border=0> 
  <input type="image" name="cancelar" src="../img/cancelar.gif" 
onclick="form1.action='maestabltransacitem.php';"  width="86" height="18" 
alt="Cancelar" border=0> 
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
<input type="hidden" name="transitecodigo" value="<?php if(!$flageditartransacitem){ echo $sbreg[transitecodigo];}else{ echo $transitecodigo; } ?>"> 
<input type="hidden" name="usuacodic" value="<?php echo $usuacodic; ?>"> 
<input type="hidden" name="accioneditartransacitem"> 
<input type="hidden" name="flagconsultar" value="0"> 
<input type="hidden" name="flageditartransacitem" value="<?php echo $flageditartransacitem; ?>"> 
<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
</form> 
</body> 
<?php 
    if(!$codigo) 
    { echo " -->"; } 
?> 
</html> 
