<?php 
include ( '../src/FunGen/sesion/fncvalses.php');
include ( '../src/FunPerPriNiv/pktblcurso.php');
include ( '../src/FunPerPriNiv/pktblgrupcapa.php');
include ( '../src/FunPerPriNiv/pktblmateapoy.php');
if(!$flagborrarcursogrupo)
{
	include ( '../src/FunGen/sesion/fnccarga.php');
	$sbreg = fnccarga($nombtabl,$radiobutton);
	if (!$sbreg)
	{
		include( '../src/FunGen/fnccontfron.php');
	}
	$idcon = fncconn();
	$sbregcurso = loadrecordcurso($sbreg[cursocodigo],$idcon);
	$sbreggrupcapa = loadrecordgrupcapa($sbreg[grucapcodigo],$idcon);
	$sbregmateapoy = loadrecordmateapoy($sbreg[matapocodigo],$idcon);
	fncclose($idcon);
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
<title>Borrar registro de cursogrupo</title> 
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
Borrar registro</font></span></td></tr> 
<tr> 
  <td> 
       <table width="95%" border="0" cellspacing="0" cellpadding="3" align="center"> 
<tr> 
 <td width="41%">C&oacute;digo</td> 
 <td width="59%"><input type="text" name="curgrucodigo" value="<?php if(!$flagdetallarcursogrupo){ echo $sbreg[curgrucodigo];}else{ echo $curgrucodigo; } ?>" onFocus="if (!agree)this.blur();" ></td> 
 <td></td>
 </tr> 
<tr> 
 <td width="41%">Curso</td> 
 <td width="59%"><input type="text" name="cursocodigo" value="<?php if(!$flagdetallarcursogrupo){echo $sbregcurso[cursonombre];}else{echo $cursocodigo;} ?>" onFocus="if (!agree)this.blur();" ></td> 
  <td></td>
 </tr> 
<tr> 
 <td width="41%">Grupo de capacitaci&oacute;n</td> 
 <td width="59%"><input type="text" name="grucapcodigo" value="<?php if(!$flagdetallarcursogrupo){echo $sbreggrupcapa[grucapnombre];}else{echo $grucapcodigo;} ?>" onFocus="if (!agree)this.blur();" ></td> 
 <td></td>
 </tr> 
<tr> 
 <td width="41%">Material de apoyo</td> 
 <td width="59%"> 
  <input type="text" name="matapocodigo" value="<?php if(!$flagdetallarcursogrupo){echo $sbregmateapoy[mataponombre];}else{echo $matapocodigo;} ?>" onFocus="if (!agree)this.blur();" ></td> 
 <td></td>
 </tr> 
  <tr> 
 <td width="41%">Fecha de inicio</td> 
 <td width="59%"> <input type="text" name="curgrufecini" value="<?php if(!$flagdetallarcursogrupo){echo $sbreg[curgrufecini];}else{ echo $curgrufecini; }?>"  size="10" onFocus="if (!agree)this.blur();"></td> 
 <td>aaaa-mm-dd</td>
 </tr>
   <tr> 
 <td width="41%">Fecha de fin</td> 
 <td width="59%"> <input type="text" name="curgrufecfin" value="<?php if(!$flagdetallarcursogrupo){ echo $sbreg[curgrufecfin];}else{ echo $curgrufecfin; }?>"  size="10" onFocus="if (!agree)this.blur();"></td> 
 <td>aaaa-mm-dd</td>
 </tr>
    <tr> 
 <td width="41%">Hora de inicio</td> 
 <td width="59%"> <input type="text" name="curgruhorini" value="<?php if(!$flagdetallarcursogrupo){ echo $sbreg[curgruhorini];}else{ echo $curgruhorini; }?>"  size="10" onFocus="if (!agree)this.blur();"></td>
 </tr>
     <tr> 
 <td width="41%">Hora de fin</td> 
 <td width="59%"> <input type="text" name="curgruhorfin" value="<?php if(!$flagdetallarcursogrupo){ echo $sbreg[curgruhorfin];}else{ echo $curgruhorfin; }?>"  size="10" onFocus="if (!agree)this.blur();"></td>
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
onclick="form1.accionborrarcursogrupo.value =  1; 
form1.action='maestablcursogrupo.php';"  width="86" height="18" alt="Aceptar" 
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
 <input type="hidden" name="flagborrarcursogrupo" value="1"> 
<input type="hidden" name="accionborrarcursogrupo"> 
<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
</form> 
</body> 
<?php 
if(!$codigo)
{ echo " -->"; }
?> 
</html> 
