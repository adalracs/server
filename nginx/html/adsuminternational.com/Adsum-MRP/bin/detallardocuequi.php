<?php 
include ( '../src/FunGen/sesion/fncvalses.php');
include ( '../src/FunPerPriNiv/pktblplano.php');
include ( '../src/FunPerPriNiv/pktblmanual.php');
include ( '../src/FunPerPriNiv/pktblequipo.php');
if(!$flagdetallardocuequi)
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
	}
	if($sbreg[manualcodigo])
	{
		$sbregmanual = loadrecordmanual($sbreg[manualcodigo],$idcon);
		$manualnombre = $sbregmanual[manualnombre];	
		$imgmanual = $sbregmanual[manualruta];	
		
	}
	if($sbreg[planocodigo])
	{
		$sbregplano = loadrecordplano($sbreg[planocodigo],$idcon);
		$planonombre = $sbregplano[planonombre];	
		$imgplano = $sbregplano[planoruta];
	}
	fncclose($idcon);
	
}
?> 
<html> 
<head> 
<title>Detalle de registro de docuequi</title> 
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
<p><font class="NoiseFormHeaderFont">Documentaci&oacute;n de equipo</font></p> 
<table border="0" cellspacing="1" cellpadding="2" align="center" 
class="NoiseFormTABLE"> 
  <tr> 
    <td width="454" class="NoiseErrorDataTD">&nbsp;</td> 
  </tr> 
  <tr> 
          <td class="NoiseFieldCaptionTD"><span class="style5"><font 
color="FFFFFF"> 
Detallar registro</font></span></td></tr> 
<tr> 
  <td> 
            <table width="95%" border="0" cellspacing="0" cellpadding="0" 
align="center"> 
              <tr> 
 <td width="25%">C&oacute;digo</td> 
  <td width="25%"> 
   <input type="text" name="docequcodigo" value="<?php 
   if(!$flagdetallardocuequi){ echo $sbreg[docequcodigo];}else{ echo
$docequcodigo;} ?>" onFocus="if (!agree)this.blur();" size="14"> 
  </td> 
  <td width="2"></td>
  <tr>
<td colspan="4"><hr></td>              
</tr>   
  </tr>
  <tr>
 <td width="25%">Equipo</td> 
  <td>Cod.&nbsp;<input name="equipocodigo" type="text"	value="<?php if(!$flagdetallardocuequi){ echo $sbreg[equipocodigo]; }else{
echo $equipocodigo;} ?>" size="8" onFocus="if (!agree)this.blur();"></td>
 <td>Nombre</td>
 <td><input name="equiponombre" type="text"	value="<?php if(!$flagdetallardocuequi){ 
echo $equiponombre;}else {echo $equiponombre;} ?>" size="14" onFocus="if (!agree)this.blur();"> </td>
 </tr> 
 <tr>
<td colspan="4"><hr></td>              
</tr>   
<tr> 
 <td width="25%">Plano</td> 
  <td colspan="2"> 
   <input type="text" name="planonombre" value="<?php 
   if(!$flagdetallardocuequi){ echo $planonombre;}else{echo $planonombre;}?>" size="25" onFocus="if (!agree)this.blur();" size="30"> 
  </td> 
  <td> <input type="image" src="../img/aceptar.gif" onclick="window.open('detallaplano.php?imgplano=<?php echo $imgplano;?>','','status=no,menubar=no,scrollbars=yes,resizable=yes,left=300,width=800,height=600');" width="86" height="18" alt="Aceptar" border=0></td>
  </tr>
  <tr>
 <td width="25%">Manual</td> 
  <td colspan="2"> 
   <input type="text" name="manualnombre" value="<?php 
   if(!$flagdetallardocuequi){ echo $manualnombre;}else{echo $manualnombre;}?>" size="25" onFocus="if (!agree)this.blur();" size="30"> 
  </td> 
  <td><input type="image" src="../img/aceptar.gif" onclick="window.open('detallamanual.php?imgmanual=<?php echo $imgmanual;?>','','status=no,menubar=no,scrollbars=yes,resizable=yes,left=300,width=800,height=600');" width="86" height="18" alt="Aceptar" border=0></td>
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
onclick="form1.action='maestabldocuequi.php';"  width="86" height="18" 
alt="Aceptar" border=0> 
  </div> 
</td> 
 </tr> 
 <tr> 
  <td class="NoiseErrorDataTD">&nbsp;</td> 
 </tr> 
</table> 
 <input type="hidden" name="flagdetallardocuequi" value="1"> 
<input type="hidden" name="acciondetallardocuequi"> 
<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
<input type="hidden" name="imgmanual" value="<?php echo $imgmanual; ?>"> 
<input type="hidden" name="imgplano" value="<?php echo $imgplano; ?>"> 

</form> 
</body> 
<?php 
if(!$codigo)
{ echo " -->"; }
?> 
</html> 
