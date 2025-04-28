<?php 
include ( '../src/FunGen/sesion/fncvalses.php'); 
include('../src/FunPerPriNiv/pktblcargo.php');
include('../src/FunPerPriNiv/pktbldepartam.php');
include('../src/FunPerPriNiv/pktbltipousuario.php');
?> 
<html> 
<head> 
<title>Consultar Empleado</title> 
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
<body onload="this.focus();" bgcolor="FFFFFF" text="#000000"> 
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
  <td> 
            <table width="85%" border="0" cellspacing="0" cellpadding="0" 
align="center"> 
              <tr> 
 <td width="25%">C&oacute;digo</td> 
  <td width="25%"><input type="text" name="usuacodigo" value="<?php 
   if(!$flagconsultarusuario){ echo $sbreg[usuacodigo];}else{ echo $usuacodigo;}
?>" size="14"> 
  </td> 
    <td></td>
	  <td></td>
 </tr> 
              <tr> 
 <td width="25%">Cargo</td> 
  <td width="25%"> 
   <select name="cargocodigo">
     <option value ="">Seleccione</option>
     <?php
	include ('../src/FunGen/floadcargo.php');
	$idcon = fncconn();
	floadcargo($idcon);
	fncclose($idcon);
?>
   </select> 
  </td> 
  <td>Tipo de empleado</td>
    <td><select name="tipusucodigo">
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
 <td width="25%">Departamento</td> 
  <td width="25%"><select name="departcodigo">
    <option value ="">Seleccione</option>
    <?php
	include ('../src/FunGen/floaddepartam.php');
	$idcon = fncconn();
	floaddepartam($idcon);
	fncclose($idcon);
?>
  </select> 
  </td> 
 <td width="25%">C&eacute;dula</td> 
  <td width="25%"><input name="usuadocume" type="text"	value="<?php if(!$flagconsultarusuario){ 
echo $sbreg[usuadocume];} else {echo $usuadocume;}?>" size="17"> 
  </td> 
 </tr> 
<tr> 
 <td width="25%">Nombre</td> 
  <td width="25%"> 
   <input name="usuanombre" type="text"	value="<?php if(!$flagconsultarusuario){ 
echo $sbreg[usuanombre];} else {echo $usuanombre;}?>" size="14"> 
  </td> 
 <td width="25%">Primer apellido</td> 
  <td width="25%"> 
   <input name="usuapriape" type="text"	value="<?php if(!$flagconsultarusuario){ 
echo $sbreg[usuapriape];} else {echo $usuapriape;}?>" size="17"> 
  </td> 
 </tr> 
<tr> 
 <td width="25%">Segundo apellido </td> 
  <td width="25%"> 
   <input name="usuasegape" type="text"	value="<?php if(!$flagconsultarusuario){ 
echo $sbreg[usuasegape];} else {echo $usuasegape;}?>" size="14"> 
  </td> 
 <td width="25%">Valor hora </td> 
  <td width="25%"> 
   <input name="usuavalhor" type="text"	value="<?php if(!$flagconsultarusuario){ 
echo $sbreg[usuavalhor];} else {echo $usuavalhor;}?>" size="17"> 
  </td> 
 </tr> 
<tr> 
 <td width="25%">Tel&eacute;fono</td> 
  <td width="25%"> 
   <input name="usuatelefo" type="text"	value="<?php if(!$flagconsultarusuario){ 
echo $sbreg[usuatelefo];} else {echo $usuatelefo;}?>" size="14"> 
  </td> 
 <td width="25%">Tel&eacute;fono 2 </td> 
  <td width="25%"> 
   <input name="usuatelef2" type="text"	value="<?php if(!$flagconsultarusuario){ 
echo $sbreg[usuatelef2];} else {echo $usuatelef2;}?>" size="17"> 
  </td> 
 </tr> 
<tr> 
 <td width="25%">Contacto</td> 
  <td width="25%"> 
   <input name="usuacontac" type="text"	value="<?php if(!$flagconsultarusuario){ 
echo $sbreg[usuacontac];} else {echo $usuacontac;}?>" size="14"> 
  </td> 
 <td width="25%">Tel. contacto </td> 
  <td width="25%"> 
   <input name="usuatelcon" type="text"	value="<?php if(!$flagconsultarusuario){ 
echo $sbreg[usuatelcon];} else {echo $usuatelcon;}?>" size="17"> 
  </td> 
 </tr> 
<tr> 
 <td width="25%">Direcci&oacute;n</td> 
  <td colspan="3"> 
   <input name="usuadirecc" type="text"	value="<?php if(!$flagconsultarusuario){ 
echo $sbreg[usuadirecc];} else {echo $usuadirecc;}?>" size="34"> 
  </td> 
 </tr> 
<tr> 
 <td width="25%">E-mail</td> 
  <td colspan="3"> 
   <input name="usuaemail" type="text"	value="<?php if(!$flagconsultarusuario){ 
echo $sbreg[usuaemail];} else {echo $usuaemail;}?>" size="34"> 
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
onclick="form1.accionconsultarusuario.value =  1; 
form1.action='maestablusuarigrupc.php';"  width="86" height="18" alt="Aceptar" 
border=0> 
  <input type="image" name="cancelar" src="../img/cancelar.gif" 
onclick="window.close();"  width="86" height="18" 
alt="Cancelar" border=0> 
  <img src="../img/ayuda.gif" border="0" alt="Ayuda">
</div> 
</td> 
 </tr> 
 <tr> 
  <td class="NoiseErrorDataTD">&nbsp;</td> 
 </tr> 
</table> 
 <input type="hidden" name="flagconsultarusuario" value="1"> 
<input type="hidden" name="accionconsultarusuario"> 
<input type="hidden" name="grucapcodigo" value="<?php echo $grucapcodigo; ?>"> 
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
