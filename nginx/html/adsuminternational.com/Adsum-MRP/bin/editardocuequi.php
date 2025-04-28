<?php 
ob_start();
include ( '../src/FunGen/sesion/fncvalses.php');
include ( '../src/FunPerPriNiv/pktblplano.php');
include ( '../src/FunPerPriNiv/pktblmanual.php');
include ( '../src/FunPerPriNiv/pktblequipo.php');
if($accioneditardocuequi) 
{ 
		include ( 'editadocuequi.php'); 
		$flageditardocuequi = 1;
}
ob_end_flush();
if(!$flageditardocuequi)
{
	include ( '../src/FunGen/sesion/fnccarga.php');
	$sbreg = fnccarga($nombtabl,$radiobutton);
	if (!$sbreg)
	{
		include( '../src/FunGen/fnccontfron.php');
	}
	
	$idcon = fncconn();
	if($sbreg[equipocodigo])
	{
		$sbregequip = loadrecordequipo($sbreg[equipocodigo],$idcon);
		$equiponombre = $sbregequip[equiponombre];
		$equipocodigo = $sbreg[equipocodigo];
	}
	if($sbreg[manualcodigo])
	{
		$varmanual = $sbreg[manualcodigo];
		$arrmanual = loadrecordmanual($varmanual,$idcon);
		$codmanual = $sbreg[manualcodigo];
	}
	if($sbreg[planocodigo])
	{
		$varplano = $sbreg[planocodigo];
		$arrplano = loadrecordplano($varplano,$idcon);
		$codplano = $sbreg[planocodigo];
	}
	fncclose($idcon);
}
?> 
<html> 
<head> 
<title>Editar registro de docuequi</title> 
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
<meta http-equiv="expires" content="0"> 
<link rel="stylesheet" type="text/css" href="temas/Noise/Style.css"> 
<SCRIPT LANGUAGE="JavaScript"> 
<!-- Begin
agree = 0;
//  End -->
</script> 
<script language="JavaScript" src="motofech.js"></script> 
</head> 
<?php 
if(!$codigo)
{ echo "<!--";}
?> 
<body bgcolor="FFFFFF" text="#000000"> 
<form name="form1" method="post"  enctype="multipart/form-data"> 
<p><font class="NoiseFormHeaderFont">Documentaci&oacute;n por equipo</font></p> 
<table border="0" cellspacing="1" cellpadding="2" align="center" 
class="NoiseFormTABLE"> 
  <tr> 
    <td width="454" class="NoiseErrorDataTD">&nbsp;</td> 
  </tr> 
  <tr> 
          <td class="NoiseFieldCaptionTD"><span class="style5"><font 
color="FFFFFF"> 
Editar registro</font></span></td></tr> 
<tr> 
  <td> 
            <table width="95%" border="0" cellspacing="0" cellpadding="0" align="center"> 
  <tr>
<td colspan="4"><hr></td>               
</tr>
<tr> 
 <td width="25%"><?php if($campnomb["equipocodigo"] == 1){ $equipocodigo=null;
echo "*";}
?>Equipo
<input name="radio1"  type="radio" onclick="window.open('consultarequipogen.php?codigo=<?php echo $codigo?>','equipogen','status=no,menubar=no,scrollbars=yes,resizable=yes,left=300,width=800,height=600');" width="86" height="18" alt="Cancelar" border=0 href="#" target="_parent"></td>
 <td>Cod.&nbsp;<input name="equipocodigo" type="text"	value="<?php if(!$flageditardocuequi){ 
echo $equipocodigo;} else {echo $equipocodigo;} ?>" size="8"></td>
 <td>Nombre</td>
 <td><input name="equiponombre" type="text"	value="<?php if(!$flageditardocuequi){ 
echo $equiponombre;} else {echo $equiponombre;} ?>" size="14" onFocus="if (!agree)this.blur();"> </td>
 </tr>
 <tr>
<td colspan="4"><hr></td>               
</tr>
<tr> 
 <td width="25%"><?php if($campnomb["planocodigo"] == 1){ $planocodigo=null;
echo "*";}
?>Plano</td> 
  <td colspan="3"> <select name="planocodigo">
        <?php
    		if(!$flageditardocuequi)
			{ 	
				echo '<option value="'.$codplano.'">';
				echo $arrplano[planonombre];}
			if($accioneditardocuequi)
			{
				echo '<option value="'.$planocodigo.'">';
				$idcon = fncconn();
				if($planocodigo)
					$arrplano = loadrecordplano($planocodigo,$idcon);
				echo $arrplano[planonombre];} ?></OPTION>
	<?php
	include ('../src/FunGen/floadplano.php');
	$idcon = fncconn();
	floadplano($idcon);
	fncclose($idcon);
?>
      </select>
  </td> 
  </tr>
  <tr>
 <td width="25%"><?php if($campnomb["manualcodigo"] == 1){ $manualcodigo=null;
echo "*";}
?>Manual</td> 
    <td colspan="3"> <select name="manualcodigo">
        <?php
    		if(!$flageditardocuequi)
			{ 	
				echo '<option value="'.$codmanual.'">';
				echo $arrmanual[manualnombre];}
			if($accioneditardocuequi)
			{
				echo '<option value="'.$manualcodigo.'">';
				$idcon = fncconn();
				if($manualcodigo)
					$arrmanual = loadrecordmanual($manualcodigo,$idcon);
				echo $arrmanual[manualnombre];} ?></OPTION>
	<?php
	include ('../src/FunGen/floadmanual.php');
	$idcon = fncconn();
	floadmanual($idcon);
	fncclose($idcon);
?>
      </select>
  </td> 
 </tr> 
 <tr> 
  <td width="41%">&nbsp;</td> 
 </tr> 
</table> 
  </td> 
 </tr> 
 <tr> 
<td> 
<div align="center"> 
  <input type="image" name="aceptar"  src="../img/aceptar.gif" 
onclick="form1.accioneditardocuequi.value =  1;"  width="86" height="18" alt="Aceptar" 
border=0> 
  <input type="image" name="cancelar" src="../img/cancelar.gif" 
onclick="form1.action='maestabldocuequi.php';"  width="86" height="18" 
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
 <input type="hidden" name="flageditardocuequi" value="1"> 
<input type="hidden" name="accioneditardocuequi"> 
<input type="hidden" name="docequcodigo"	value="<?php if(!$flageditardocuequi){ echo $sbreg[docequcodigo];}else { echo $docequcodigo;}?>">
<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
<input type="hidden" name="planocodigo1" value="<?php echo $planocodigo; ?>"> 
<input type="hidden" name="manualcodigo1" value="<?php echo $manualcodigo; ?>"> 
</form> 
</body> 
<?php 
if(!$codigo)
{ echo " -->"; }
?> 
</html> 
