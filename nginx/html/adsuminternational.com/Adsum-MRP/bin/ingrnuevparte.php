<?php 
ob_start();
include ( '../src/FunGen/sesion/fncvalses.php');
include ( '../src/FunPerPriNiv/pktblcomponen.php'); 
if($accionnuevoparte)
{
	include ( 'grabaparte.php');
}
ob_end_flush();
?> 
<html> 
<head> 
<title>Nuevo registro de parte</title> 
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
Ingresar nuevo registro</font></span></td></tr> 
<tr> 
  <td> 
            <table width="90%" border="0" cellspacing="1" cellpadding="1" 
align="center"> 
<tr> 
 <td width="41%" class="NoiseFooterTD"><?php if($campnomb["partenombre"] == 1){ $partenombre=null;
echo "*";}
?>Nombre</td> 
  <td colspan="2" class="NoiseErrorDataTD"><input name="partenombre" type="text"	value="<?php if(!$flagnuevoparte){ 
echo $sbreg[partenombre];} else {echo $partenombre;}?>" size="14"> 
  </td> 
   <td class="NoiseErrorDataTD">&nbsp;</td>
              </tr> 
 <tr>
<td colspan="4" bgcolor="#f0f6ff"><hr></td>              
</tr>

<tr>
 <td width="41%" class="NoiseFooterTD"><?php if($campnomb["componcodigo"] == 1){ $componcodigo=null;
echo "*";}
?>Componente
<input name="radio1"  type="radio" onclick="window.open('consultarcomponengen.php?codigo=<?php echo $codigo?>','componengen','status=no,menubar=no,scrollbars=yes,resizable=yes,left=300,width=800,height=600');" width="86" height="18" alt="Cancelar" border=0 href="#" target="_parent"></td>
 <td class="NoiseErrorDataTD">Cod.&nbsp;<input name="componcodigo" type="text"	value="<?php if(!$flagnuevocomponen){ 
echo $componcodigo;} else {echo $componcodigo;} ?>" size="8"></td>
 <td class="NoiseErrorDataTD">Nombre</td>
 <td class="NoiseErrorDataTD"><input name="componnombre" type="text"	value="<?php if(!$flagnuevocomponen){ 
echo $componnombre;} else {echo $componnombre;} ?>" size="14" onFocus="if (!agree)this.blur();"></td>
 </tr>
 <tr>
<td colspan="4" bgcolor="#f0f6ff"><hr></td>               
</tr>
<tr> 
 <td width="41%" class="NoiseFooterTD"><?php if($campnomb["partefabric"] == 1){ $partefabric=null;
echo "*";}
?>Fabricante</td> 
  <td width="25%" class="NoiseErrorDataTD"><input name="partefabric" type="text"	value="<?php if(!$flagnuevoparte){ 
echo $sbreg[partefabric];}else {echo $partefabric;}?>" size="14"> 
  </td> 
 <td width="25%" class="NoiseFooterTD"><?php if($campnomb["partemarca"] == 1){ $partemarca=null;
echo "*";}
?>Marca</td> 
  <td width="25%" class="NoiseErrorDataTD"><input name="partemarca" type="text"	value="<?php if(!$flagnuevoparte){ echo 
$sbreg[partemarca];} else {echo $partemarca;}?>" size="17">
  </td> 
 </tr> 
<tr> 
 <td width="41%" class="NoiseFooterTD"><?php if($campnomb["partemodelo"] == 1){ $partemodelo=null;
echo "*";}
?>Modelo</td> 
  <td width="25%" class="NoiseErrorDataTD"> 
   <input name="partemodelo" type="text"value="<?php if(!$flagnuevoparte){ 
echo $sbreg[partemodelo];} else {echo $partemodelo;}?>" size="14"> 
  </td> 
 <td width="25%" class="NoiseFooterTD"><?php if($campnomb["parteserie"] == 1){ $parteserie=null;
echo "*";}
?>No. serie</td> 
  <td width="25%" class="NoiseErrorDataTD">
   <input name="parteserie" type="text"	value="<?php if(!$flagnuevoparte){ echo 
$sbreg[parteserie];}else {echo $parteserie;}?>" size="17"> 
  </td> 
 </tr>
<tr>
 <td width="41%" class="NoiseFooterTD"><?php if($campnomb["partefeccom"] == 1){ $partefeccom=null;
echo "*";}
?>Fecha de compra</td> 
<td class="NoiseErrorDataTD"><input name="partefeccom" type="text" value="<?php if(!$flagnuevoparte){ 
echo $sbreg[partefeccom];} else {echo $partefeccom;}?>" size="14" onfocus="if(!agree) this.blur();"></td>
<td colspan = "2" class="NoiseErrorDataTD"><img src="../img/cal.gif" border="0" onclick="window.open('formcalendario.php?calencodigo=partefeccom','','status=no,menubar=no,scrollbars=yes,resizable=yes,left=600,width=200,height=210');"></td>
</tr> 
<tr>
  <td class="NoiseFooterTD"><?php if($campnomb["partefecins"] == 1){ $partefecins=null;
echo "*";}
?>Fecha de instalaci&oacute;n </td>
<td class="NoiseErrorDataTD"><input name="partefecins" type="text" value="<?php if(!$flagnuevoparte){ 
echo $sbreg[partefecins];} else {echo $partefecins;}?>" size="14" onfocus="if(!agree) this.blur();"></td>
<td colspan = "2" class="NoiseErrorDataTD"><img src="../img/cal.gif" border="0" onclick="window.open('formcalendario.php?calencodigo=partefecins','','status=no,menubar=no,scrollbars=yes,resizable=yes,left=600,width=200,height=210');"></td>
</tr>
<tr>
  <td class="NoiseFooterTD"><?php if($campnomb["partevengar"] == 1){ $partevengar=null;
echo "*";}
?>Vencimiento de garant&iacute;a</td>
<td class="NoiseErrorDataTD"><input name="partevengar" type="text"	value="<?php if(!$flagnuevoparte){ 
echo $sbreg[partevengar];} else {echo $partevengar;}?>" size="14" onfocus="if(!agree) this.blur();"></td>
<td colspan = "2" class="NoiseErrorDataTD"><img src="../img/cal.gif" border="0" onclick="window.open('formcalendario.php?calencodigo=partevengar','','status=no,menubar=no,scrollbars=yes,resizable=yes,left=600,width=200,height=210');"></td>
</tr>
<tr> 
 <td width="41%" class="NoiseFooterTD"><?php if($campnomb["partecinv"] == 1){ $partecinv=null;
echo "*";}
?>Costo de la inversi&oacute;n </td> 
  <td colspan="3" class="NoiseErrorDataTD"> 
   <input name="partecinv" type="text"	value="<?php if(!$flagnuevoparte){ echo 
$sbreg[partecinv];}else {echo $partecinv;}?>" size="14"> 
  </td> 
 </tr> 
<tr> 
 <td width="41%" class="NoiseFooterTD"><?php if($campnomb["parteviduti"] == 1){ $parteviduti=null;
echo "*";}
?>Vida &uacute;til</td> 
  <td colspan="3" class="NoiseErrorDataTD"> 
   <input name="parteviduti" type="text"	value="<?php if(!$flagnuevoparte){ 
echo $sbreg[parteviduti];}else {echo $parteviduti;}?>" size="14"> 
  </td> 
 </tr> 
 <tr>
   <td class="NoiseFooterTD"><?php if($campnomb["partedescri"] == 1){ $partedescri=null;
echo "*";}
?>Descripci&oacute;n </td>
   <td colspan="3" class="NoiseErrorDataTD"><textarea name="partedescri" cols="34" rows="3" wrap="VIRTUAL"><?php if(!$flagnuevoparte){ 
echo $sbreg[partedescri];}else {echo $partedescri;}?></textarea></td>
   </tr>
</table> 
  </td> 
 </tr> 
 <tr> 
<td> 
<div align="center"> 
  <input type="image" name="aceptar"  src="../img/aceptar.gif" 
onclick="form1.accionnuevoparte.value =  1;" 
width="86" height="18" alt="Aceptar" border=0> 
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
 <input type="hidden" name="fecactual"	value="<?php $cad = getdate(); $fecactual= $cad[year]."-".$cad[mon]."-".$cad[mday]; echo $fecactual;?>">
 <input type="hidden" name="partecodigo"	value="<?php if(!$flagnuevoparte){ echo $sbreg[partecodigo];}else{ echo $partecodigo;} ?>">
<input type="hidden" name="accionnuevoparte"> 
<input type="hidden" name="componcodigo1" value="<?php echo $componcodigo; ?>"> 
<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 

</form> 
</body> 
<?php 
    if(!$codigo) 
    { echo " -->"; } 
?> 
</html> 
