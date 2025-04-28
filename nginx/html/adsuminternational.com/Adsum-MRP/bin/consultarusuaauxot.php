<?php 
include ( '../src/FunPerSecNiv/fncconn.php'); 
include ( '../src/FunPerSecNiv/fncclose.php'); 
include ( '../src/FunPerSecNiv/fncfetch.php'); 
include ( '../src/FunPerSecNiv/fncnumreg.php');
include('../src/FunPerPriNiv/pktblcargo.php');
include('../src/FunPerPriNiv/pktbldepartam.php');
include('../src/FunPerPriNiv/pktbltipousuario.php');
?> 
<html> 
<head> 
<title>Consultar empleado</title> 
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
<p><font class="NoiseFormHeaderFont">Empleado</font></p> 
<table border="0" cellspacing="1" cellpadding="2" align="center" 
class="NoiseFormTABLE"> 
  <tr> 
    <td class="NoiseErrorDataTD">&nbsp;</td> 
  </tr> 
  <tr> 
          <td class="NoiseFieldCaptionTD"><span class="style5"><font 
color="FFFFFF"> 
Consultar registro</font></span></td></tr> 
<tr> 
  <td><table width="85%" border="0" cellspacing="0" cellpadding="0" 
align="center">
    <tr>
      <td width="41%">Cargo</td>
      <td width="25%">&nbsp;</td>
      <td colspan="2"><select name="cargocodigo">
          <option value ="">Seleccione</option>
          <?php
	include ('../src/FunGen/floadcargo.php');
	$idcon = fncconn();
	floadcargo($idcon);
	fncclose($idcon);
?>
      </select></td>
    </tr>
    <tr>
      <td colspan="2">Tipo de empleado</td>
      <td colspan="2"><select name="tipusucodigo">
          <option value ="">Seleccione</option>
          <?php
	include ('../src/FunGen/floadtipousuario.php');
	$idcon = fncconn();
	floadtipousuario($idcon);
	fncclose($idcon);
?>
      </select></td>
    </tr>
    <tr>
      <td width="41%">Departamento</td>
      <td width="25%">&nbsp;</td>
      <td colspan="2"><select name="departcodigo">
          <option value ="">Seleccione</option>
          <?php
	include ('../src/FunGen/floaddepartam.php');
	$idcon = fncconn();
	floaddepartam($idcon);
	fncclose($idcon);
?>
      </select></td>
    </tr>
    <tr>
      <td class="NoiseFooterTD">C&eacute;dula</td>
      <td class="NoiseFooterTD"><input name="usuadocume" type="text"	value="<?php if(!$flagconsultarusuario){ 
echo $sbreg[usuadocume];} else {echo $usuadocume;}?>" size="14"></td>
      <td class="NoiseFooterTD">Nombre</td>
      <td class="NoiseFooterTD"><input name="usuanombre" type="text"	value="<?php if(!$flagconsultarusuario){ 
echo $sbreg[usuanombre];} else {echo $usuanombre;}?>" size="17"></td>
    </tr>
    <tr>
      <td width="41%" class="NoiseFooterTD">Apellido</td>
      <td width="25%" class="NoiseFooterTD"><input name="usuapriape" type="text"	value="<?php if(!$flagconsultarusuario){ 
echo $sbreg[usuapriape];} else {echo $usuapriape;}?>" size="14"></td>
      <td width="25%" class="NoiseFooterTD">&nbsp;</td>
      <td width="25%" class="NoiseFooterTD">&nbsp;</td>
    </tr>
    <tr>
      <td width="41%" class="NoiseFooterTD">&nbsp;</td>
      <td width="25%" class="NoiseFooterTD">&nbsp;</td>
      <td width="25%" class="NoiseFooterTD">&nbsp;</td>
      <td width="25%" class="NoiseFooterTD">&nbsp;</td>
    </tr>
  </table></td> 
 </tr> 
 <tr> 
<td> 
<div align="center"> 
  <input type="image" name="aceptar"  src="../img/aceptar.gif" 
onclick="form1.accionconsultarusuario.value =  1; 
form1.action='maestablusuaauxot.php';"  width="86" height="18" alt="Aceptar" 
border=0> 
  <input type="image" name="cancelar" src="../img/cancelar.gif" 
onclick="window.close();"  width="86" height="18" 
alt="Cancelar" border=0> 
  </div> 
</td> 
 </tr> 
 <tr> 
  <td class="NoiseErrorDataTD">&nbsp;</td> 
 </tr> 
</table> 
<input type="hidden" name="flagnuevoot" value="1"> 
<input type="hidden" name="flagconsultarusuario" value="1"> 
<input type="hidden" name="accionconsultarusuario"> 
<input type="hidden" name="empleacod" value="<?php echo $empleacod; ?>"> 
<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
<input type="hidden" name="columnas" value="usuacodi,
cargocodigo,
departcodigo,
tipusucodigo,
usuanomb,
usuapass,
usuaacti,
usuadocume,
usuanombre,
usuapriape,
usuasegape,
usuatelefo,
usuatelef2,
usuacontac,
usuatelcon,
usuadirecc,
usuaemail,
usuavalhor,
usuaactiot"> 
<input type="hidden" name="nombtabl" value="usuario">
</form> 
</body> 
<?php 
    if(!$codigo) 
    { echo " -->"; } 
?> 
</html> 
