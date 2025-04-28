<?php 
include ( '../src/FunGen/sesion/fncvalses.php'); 
include ( '../src/FunPerPriNiv/pktblcurso.php');
include ( '../src/FunPerPriNiv/pktblgrupcapa.php');
include ( '../src/FunPerPriNiv/pktblmateapoy.php');
include ( '../src/FunGen/floadtimehours.php');
include ( '../src/FunGen/floadtimeminut.php');
?> 
<!-- Propiedad intelectual de Adsum SA (c) 
-Todos los derechos reservados- 
Creado con WAG Adsum 
Autor: Andr�s A. Riascos D. 
Fecha: 26052004 
GenVers: 3.1 --> 
<html> 
<head> 
<title>Consultar en cursogrupo</title> 
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
<p><font class="NoiseFormHeaderFont">Capacitaci&oacute;n</font></p> 
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
            <table width="85%" border="0" cellspacing="0" cellpadding="3" 
align="center"> 
<tr> 
 <td width="41%">C&oacute;digo</td> 
 <td width="59%"> 
  <input type="text" name="curgrucodigo"	value="<?php 
if(!$flagconsultarcursogrupo){ echo $sbreg[curgrucodigo];}else{ echo 
$curgrucodigo; }?>" size="15"> 
 </td> 
 <td></td>
 </tr> 
<tr> 
 <td width="41%">Curso</td> 
 <td width="59%"> 
<select name="cursocodigo">
    <option value ="">Seleccione</option>
    <?php
    include ('../src/FunGen/floadcurso.php');
    $idcon = fncconn();
    floadcurso($idcon);
    fncclose($idcon);
?>
  </select>
</td> 
<td></td>
</tr> 
<tr> 
 <td width="41%">Grupo de capacitaci&oacute;n</td> 
 <td width="59%"> 
<select name="grucapcodigo">
    <option value ="">Seleccione</option>
    <?php
    include ('../src/FunGen/floadgrupcapa.php');
    $idcon = fncconn();
    floadgrupcapa($idcon);
    fncclose($idcon);
?>
  </select>
 </td> 
 <td></td>
 </tr> 
<tr> 
 <td width="41%">Material de apoyo</td> 
 <td width="59%"> 
<select name="matapocodigo">
    <option value ="">Seleccione</option>
    <?php
    include ('../src/FunGen/floadmateapoy.php');
    $idcon = fncconn();
    floadmateapoy($idcon);
    fncclose($idcon);
?>
  </select>
 </td> 
 <td></td>
 </tr> 
<tr> 
 <td width="41%">Fecha de inicio</td> 
 <td width="59%"><input type="text" name="curgrufecini" size="13" value="<?php if(!$flagconsultarcursogrupo){ echo $sbreg[curgrufecini];} else {echo $curgrufecini;}?>" onFocus="if (!agree)this.blur();"></td> 
 <td colspan="2"><img src="../img/cal.gif" border="0" onclick="window.open('formcalendario.php?calencodigo=curgrufecini','','status=no,menubar=no,scrollbars=yes,resizable=yes,left=600,width=200,height=210');"></td>
 </tr>
   <tr> 
 <td width="41%">Fecha de fin</td> 
 <td width="59%"><input type="text" name="curgrufecfin" size="13" value="<?php if(!$flagconsultarcursogrupo){ echo $sbreg[curgrufecfin];} else {echo $curgrufecfin;}?>" onFocus="if (!agree)this.blur();"></td>
 <td colspan="2"><img src="../img/cal.gif" border="0" onclick="window.open('formcalendario.php?calencodigo=curgrufecfin','','status=no,menubar=no,scrollbars=yes,resizable=yes,left=600,width=200,height=210');"></td>
 </tr>
  <tr> 
 <td width="41%">Hora de inicio</td> 
 <td width="59%"><input name="curgruhorini" type="text"	value="<?php 
 if(!$flagconsultarcursogrupo)
 { 
 	echo $sbreg[curgruhorini];
 } 
 else 
 {
 	echo $curgruhorini;
 }?>" size="5" maxlength="5">&nbsp;HH:MM</td>
 </tr> 
  <tr> 
 <td width="41%">Hora de fin</td> 
 <td width="59%"><input name="curgruhorfin" type="text"	value="<?php 
 if(!$flagconsultarcursogrupo)
 { 
 	echo $sbreg[curgruhorfin];
 } 
 else 
 {
 	echo $curgruhorfin;
 }?>" size="5" maxlength="5">&nbsp;HH:MM</td>
 </tr> 
 <tr> 
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
onclick="form1.accionconsultarcursogrupo.value = 1;form1.action='maestablcursogrupo.php';
"  width="86" height="18" alt="Aceptar" 
border=0> 
  <input type="image" name="cancelar" src="../img/cancelar.gif" 
onclick="form1.action='maestablcursogrupo.php';"  width="86" height="18" 
alt="Cancelar" border=0> 
</div> 
</td> 
 </tr> 
 <tr> 
  <td class="NoiseErrorDataTD">&nbsp;</td> 
 </tr> 
</table> 
<input type="hidden" name="flagconsultarcursogrupo" value="1"> 
<input type="hidden" name="accionconsultarcursogrupo"> 
<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
<input type="hidden" name="columnas" value="curgrucodigo, 
cursocodigo, 
grucapcodigo, 
matapocodigo,
curgrufecini, 
curgrufecfin, 
curgruhorini, 
curgruhorfin, 
curgruhorari 
"> 
<input type="hidden" name="nombtabl" value="cursogrupo"> 
</form> 
</body> 
<?php 
    if(!$codigo) 
    { echo " -->"; } 
?> 
</html> 
