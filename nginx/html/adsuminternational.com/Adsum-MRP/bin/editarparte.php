<?php 
ob_start();
include ( '../src/FunGen/sesion/fncvalses.php');
include ( '../src/FunPerPriNiv/pktblcomponen.php'); 
if($accioneditarparte) 
{ 
		include ( 'editaparte.php'); 
		$flageditarparte = 1;
}
ob_end_flush();
if(!$flageditarparte)
{
	include ( '../src/FunGen/sesion/fnccarga.php');
	$sbreg = fnccarga($nombtabl,$radiobutton);
	if (!$sbreg)
	{
		include( '../src/FunGen/fnccontfron.php');
	}
	$idcon = fncconn();
	$varcomponen = $sbreg[componcodigo];
	$arrcomponen = loadrecordcomponen($varcomponen,$idcon);
	$codcomponen = $sbreg[componcodigo];
		
	$sbregcompon = loadrecordcomponen($sbreg[componcodigo],$idcon);
	$componnombre = $sbregcompon[componnombre];
	$componcodigo = $sbreg[componcodigo];
	fncclose($idcon);
}
?> 
<html> 
<head> 
<title>Editar registro de parte</title> 
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
<p><font class="NoiseFormHeaderFont">Parte</font></p> 
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
            <table width="85%" border="0" cellspacing="0" cellpadding="1" 
align="center"> 
<tr> 
 <td width="41%"><?php if($campnomb["partenombre"] == 1){ $partenombre=null;
echo "*";}
?>Nombre</td> 
  <td colspan="2"><input name="partenombre" type="text"	value="<?php if(!$flageditarparte){ 
echo $sbreg[partenombre];} else {echo $partenombre;}?>" size="14"> 
  </td> 
   <td>&nbsp;</td>
              </tr> 
 <tr>
<td colspan="4"><hr></td>              
</tr>
<tr>
 <td width="41%"><?php if($campnomb["componcodigo"] == 1){ $componcodigo=null;
echo "*";}
?>Componente
<input name="radio1"  type="radio" onclick="window.open('consultarcomponengen.php?codigo=<?php echo $codigo?>','componengen','status=no,menubar=no,scrollbars=yes,resizable=yes,left=300,width=800,height=600');" width="86" height="18" alt="Cancelar" border=0 href="#" target="_parent"></td>
 <td>Cod.&nbsp;<input name="componcodigo" type="text"	value="<?php if(!$flageditarparte){ 
echo $componcodigo;} else {echo $componcodigo;} ?>" size="8"></td>
 <td>Nombre</td>
 <td><input name="componnombre" type="text"	value="<?php if(!$flageditarparte){ 
echo $componnombre;} else {echo $componnombre;} ?>" size="14" onFocus="if (!agree)this.blur();"></td>
 </tr>
 <tr>
<td colspan="4"><hr></td>               
</tr>
<tr> 
 <td width="41%"><?php if($campnomb["partefabric"] == 1){ $partefabric=null;
echo "*";}
?>Fabricante</td> 
  <td width="25%"><input name="partefabric" type="text"	value="<?php if(!$flageditarparte){ 
echo $sbreg[partefabric];}else {echo $partefabric;}?>" size="14"> 
  </td> 
 <td width="25%"><?php if($campnomb["partemarca"] == 1){ $partemarca=null;
echo "*";}
?>Marca</td> 
  <td width="25%"><input name="partemarca" type="text"	value="<?php if(!$flageditarparte){ echo 
$sbreg[partemarca];} else {echo $partemarca;}?>" size="17">
  </td> 
 </tr> 
<tr> 
 <td width="41%"><?php if($campnomb["partemodelo"] == 1){ $partemodelo=null;
echo "*";}
?>Modelo</td> 
  <td width="25%"> 
   <input name="partemodelo" type="text"	value="<?php if(!$flageditarparte){ 
echo $sbreg[partemodelo];} else {echo $partemodelo;}?>" size="14"> 
  </td> 
 <td width="25%"><?php if($campnomb["parteserie"] == 1){ $parteserie=null;
echo "*";}
?>No. serie </td> 
  <td width="25%">
   <input name="parteserie" type="text"	value="<?php if(!$flageditarparte){ echo 
$sbreg[parteserie];}else {echo $parteserie;}?>" size="17"> 
  </td> 
 </tr>
<tr>
 <td width="41%"><?php if($campnomb["partefeccom"] == 1){ $partefeccom=null;
echo "*";}
?>Fecha de compra </td> 
<td><input name="partefeccom" type="text" value="<?php if(!$flageditarparte){ 
echo $sbreg[partefeccom];} else {echo $partefeccom;}?>" size="14" onfocus="if(!agree) this.blur();"></td>
<td colspan = "2"><img src="../img/cal.gif" border="0" onclick="window.open('formcalendario.php?calencodigo=partefeccom','','status=no,menubar=no,scrollbars=yes,resizable=yes,left=600,width=200,height=210');"></td>
</tr> 
<tr>
  <td><?php if($campnomb["partefecins"] == 1){ $partefecins=null;
echo "*";}
?>Fecha de instalaci&oacute;n </td>
<td><input name="partefecins" type="text" value="<?php if(!$flageditarparte){ 
echo $sbreg[partefecins];} else {echo $partefecins;}?>" size="14" onfocus="if(!agree) this.blur();"></td>
<td colspan = "2"><img src="../img/cal.gif" border="0" onclick="window.open('formcalendario.php?calencodigo=partefecins','','status=no,menubar=no,scrollbars=yes,resizable=yes,left=600,width=200,height=210');"></td>
</tr>
<tr>
  <td><?php if($campnomb["partevengar"] == 1){ $partevengar=null;
echo "*";}
?>Vencimiento de garant&iacute;a</td>
<td><input name="partevengar" type="text"	value="<?php if(!$flageditarparte){ 
echo $sbreg[partevengar];} else {echo $partevengar;}?>" size="14" onfocus="if(!agree) this.blur();"></td>
<td colspan = "2"><img src="../img/cal.gif" border="0" onclick="window.open('formcalendario.php?calencodigo=partevengar','','status=no,menubar=no,scrollbars=yes,resizable=yes,left=600,width=200,height=210');"></td>
</tr>
<tr> 
 <td width="41%"><?php if($campnomb["partecinv"] == 1){ $partecinv=null;
echo "*";}
?>Costo de la inversi&oacute;n </td> 
  <td colspan="3"> 
   <input name="partecinv" type="text"	value="<?php if(!$flageditarparte){ echo 
$sbreg[partecinv];}else {echo $partecinv;}?>" size="14"> 
  </td> 
 </tr> 
<tr> 
 <td width="41%"><?php if($campnomb["parteviduti"] == 1){ $parteviduti=null;
echo "*";}
?>Vida &uacute;til </td> 
  <td colspan="3"> 
   <input name="parteviduti" type="text"	value="<?php if(!$flageditarparte){ 
echo $sbreg[parteviduti];}else {echo $parteviduti;}?>" size="14"> 
  </td> 
 </tr> 
 <tr>
   <td><?php if($campnomb["partedescri"] == 1){ $partedescri=null;
echo "*";}
?>Descripci&oacute;n </td>
   <td colspan="3" rowspan="2"><textarea name="partedescri" cols="34" rows="3" wrap="VIRTUAL"><?php if(!$flageditarparte){ 
echo $sbreg[partedescri];}else {echo $partedescri;}?></textarea></td>
   </tr>
 <tr>
   <td>&nbsp;</td>
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
onclick="form1.accioneditarparte.value =  1;" width="86" height="18" alt="Aceptar" border=0> 
<input type="image" name="cancelar" src="../img/cancelar.gif" 
onclick="form1.action='maestablparte.php';"  width="86" height="18" 
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
<input type="hidden" name="partecodigo"	value="<?php if(!$flageditarparte){ echo $sbreg[partecodigo];}else{ echo $partecodigo;} ?>">
<input type="hidden" name="fecactual"	value="<?php $cad = getdate(); $fecactual= $cad[year]."-".$cad[mon]."-".$cad[mday]; echo $fecactual;?>">
<input type="hidden" name="accioneditarparte">
<input type="hidden" name="componcodigo1" value="<?php echo $componcodigo;?>">
<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
</form> 
</body> 
<?php 
if(!$codigo)
{ echo " -->"; }
?> 
</html> 
