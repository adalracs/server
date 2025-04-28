<?php 
ob_start();
include ( '../src/FunGen/sesion/fncvalses.php');
include ( '../src/FunPerPriNiv/pktblcurso.php');
include ( '../src/FunPerPriNiv/pktblgrupcapa.php');
include ( '../src/FunPerPriNiv/pktblmateapoy.php');
include ( '../src/FunGen/floadmateapoy2.php');
include ( '../src/FunGen/floadtimehours.php');
include ( '../src/FunGen/floadtimeminut.php');
if($accionnuevocursogrupo)
{
	include ( 'grabacursogrupo.php');
}
ob_end_flush();
?> 
<!-- Propiedad intelectual de Adsum SA (c) 
-Todos los derechos reservados- 
Creado con WAG Adsum 
Autor: Andr�s A. Riascos D. 
Fecha: 26052004 
GenVers: 3.1 --> 
<html> 
<head> 
<title>Capacitaci&oacute;n</title> 
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
<meta http-equiv="expires" content="0"> 
<link rel="stylesheet" type="text/css" href="temas/Noise/Style.css"> 
<SCRIPT LANGUAGE="JavaScript"> 
<!-- Begin
agree = 0;
//  End -->
</script>
<SCRIPT LANGUAGE="JavaScript"> 
var arreglo1 = new Array;
var arreglo2 = new Array;
function carga()
{
	for(var i=0; i < document.form1.elements['mataselec'].length; i++)
	{
		arreglo2[i] = document.form1.mataselec[i].value;
	}
	document.form1.arreglo2.value = arreglo2;

	for(var i=0; i < document.form1.elements['matadelet'].length; i++)
	{
		arreglo1[i] = document.form1.matadelet[i].value;
	}
	document.form1.arreglo1.value = arreglo1;
}
var all_users = new Array;

function save_users(lista)
{
	for(var i=0; i < lista.length; i++)
	{
		all_users[i] = new Array;
		all_users[i][0] = lista.options[i].text;
		all_users[i][1] = lista.options[i].value;
	}
}
</script>
<script language="JavaScript" src="../src/FunGen/fncmoveselectoptions.js" type="text/javascript"></script> 
<script language="JavaScript" src="../src/FunGen/jsrsClient.js" type="text/javascript"></script>
<script language="JavaScript" src="../src/FunGen/cargarMateapoy.js" type="text/javascript"></script>
</head> 
<?php 
if(!$codigo)
{ echo "<!--";}
?> 
<body onload="save_users(window.document.form1.mataselec);" bgcolor="FFFFFF" text="#000000"> 
<form name="form1" method="post"  enctype="multipart/form-data"> 
<p><font class="NoiseFormHeaderFont">Capacitaci&oacute;n</font></p> 
<table width="55%" border="0" cellspacing="1" cellpadding="2" align="center" 
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
            <table width="85%" border="0" cellspacing="1" cellpadding="3" 
align="center"> 
<tr> 
 <td width="25%" class="NoiseFooterTD"><?php if($campnomb["cursocodigo"] == 1){$cursocodigo = null; echo 
"*";}?>Curso</td> 
 <td width="25%" bgcolor="#f0f6ff"><select name="cursocodigo" onchange="window.document.form1.matadelet.length = 0;
cargarMateapoy(this.value);"><?php
            if(!$flagnuevocursogrupo)
            {
            	echo '<option value = "">Seleccione';
            }
            else if ($accionnuevocursogrupo)
            {
            	if($cursocodigo)
            	{
            		echo '<option value = "'.$cursocodigo.'">';
            		$idcon	= fncconn();
            		$arrcurso = loadrecordcurso($cursocodigo,$idcon);
            		echo $arrcurso[cursonombre];
            		fncclose($idcon);
            	}
            	else
            	{
            		echo '<option value = "">Seleccione';
            	}
            }?></OPTION>
            <?php
            include ('../src/FunGen/floadcurso.php');
            $idcon = fncconn();
            floadcurso($idcon);
            fncclose($idcon);
			?></select>
 </td> 
  <td width="25%" class="NoiseFooterTD"><?php if($campnomb["grucapcodigo"] == 1){$grucapcodigo = null; 
echo "*";}?>Grupo</td> 
 <td width="25%" bgcolor="#f0f6ff"> 
            <select name="grucapcodigo" onchange="window.document.form1.matadelet.length = 0;
cargarMateapoyCursoGrupo(window.document.form1.cursocodigo.value,this.value);">
            <?php
            if(!$flagnuevocursogrupo)
            {
            	echo '<option value = "">Seleccione';
            }
            else if ($accionnuevocursogrupo)
            {
            	if($grucapcodigo)
            	{
            		echo '<option value = "'.$grucapcodigo.'">';
            		$idcon	= fncconn();
            		$arrgrupcapa = loadrecordgrupcapa($grucapcodigo,$idcon);
            		echo $arrgrupcapa[grucapnombre];
            		fncclose($idcon);
            	}
            	else
            	{
            		echo '<option value = "">Seleccione';
            	}
            }?></OPTION>
            <?php
            include ('../src/FunGen/floadgrupcapa.php');
            $idcon = fncconn();
            floadgrupcapa($idcon);
            fncclose($idcon);
			?></select></td> 
</tr>
<tr>
<td width="100%" colspan="4"><hr></td>
</tr> 
 </tr>
 <tr> 
 <td colspan="4" bgcolor="#f0f6ff">Materiales de apoyo
  <input name="button1" type="radio" 
onClick="secundaria1=window.open('consultarmatauxapoy.php?codigo=<?php echo $codigo?>','secundaria1','status=no,menubar=no,scrollbars=yes,resizable=yes,left=150,width=600,height=500');" width="86" height="18" alt="Cancelar" border=0 href="#" target="_parent">
</td>
  </tr>
<tr> 
 <td colspan="1" class="NoiseFooterTD">Materiales</td> 
 <td colspan="1" class="NoiseFooterTD"><div align="left"></div></td>
 <td colspan="2" class="NoiseFooterTD">Materiales asignados</td> 
 </tr>
 <tr>
 <td colspan="1" rowspan="2" bgcolor="#f0f6ff"><select name="mataselec" size="4">
   <?php
   if ($flagnuevocursogrupo)
   {
   	$idcon = fncconn();
   	floadmateapoy2($idcon,$arreglo2);
   	fncclose($idcon);
   }
   else
   {
   	include('../src/FunGen/floadmateapoy.php');
   	$idcon = fncconn();
   	floadmateapoy($idcon);
   	fncclose($idcon);
   }
                       ?></select></td> 
 <td height="38" colspan="1" bgcolor="#f0f6ff"><div align="center">
   <input type="button" name="deletsele" value=" > " onclick="transferTo(this.form.mataselec,this.form.matadelet);">
 </div></td>
 <td colspan="2" rowspan="2" bgcolor="#f0f6ff">
 <select name="matadelet" size="4">
   <?php
   if($flagnuevocursogrupo)
   {
   	if ($arreglo1 != null)
   	{
   		$idcon = fncconn();
   		floadmateapoy2($idcon,$arreglo1);
   		fncclose($idcon);
   	}
}?></select>
 </td>
 </tr>
 <tr>
   <td height="33" colspan="1" bgcolor="#f0f6ff"><div align="center">
     <input type="button" name="deletsele2" value=" < " onclick="transferTo(this.form.matadelet,this.form.mataselec);">
   </div></td>
 </tr> 

<td width="100%" colspan="4"><hr></td>
</tr>
<tr> 
 <td width="41%" class="NoiseFooterTD"><?php if($campnomb["curgrufecini"] == 1){$curgrufecini = null; 
echo "*";}?>Fecha de inicio</td> 
 	<td width="59%" bgcolor="#f0f6ff"><input type="text" name="curgrufecini" size="13" value="<?php if(!$flagnuevocursogrupo){ echo $curgrufecini = date("Y-m-d");} else {echo $curgrufecini;}?>" onFocus="if (!agree)this.blur();"></td>
	<td colspan="2" bgcolor="#f0f6ff"><img src="../img/cal.gif" border="0" onclick="window.open('formcalendario.php?calencodigo=curgrufecini','cal1','status=no,menubar=no,scrollbars=yes,resizable=yes,left=600,width=200,height=210');"></td> 
 </tr>
 <tr> 
 <td width="41%" class="NoiseFooterTD"><?php if($campnomb["curgrufecfin"] == 1){$curgrufecfin = null; 
echo "*";}?>Fecha de fin</td> 
 	<td width="59%" bgcolor="#f0f6ff"><input type="text" name="curgrufecfin" size="13" value="<?php if(!$flagnuevocursogrupo){ echo $sbreg[curgrufecfin];} else {echo $curgrufecfin;}?>" onFocus="if (!agree)this.blur();"></td>
	<td colspan="2" bgcolor="#f0f6ff"><img src="../img/cal.gif" border="0" onclick="window.open('formcalendario.php?calencodigo=curgrufecfin','cal2','status=no,menubar=no,scrollbars=yes,resizable=yes,left=600,width=200,height=210');"></td> 
 </tr>
   <tr> 
 <td width="41%" class="NoiseFooterTD"><?php if($campnomb["curgruhorini"] == 1){$curgruhorini = null; 
echo "*";}?>Hora de inicio</td> 
 <td width="59%" bgcolor="#f0f6ff"><select name="horini">
 <?php 
 	if($flagnuevocursogrupo)
 		echo '<option value ="'.$horini.'">'.$horini.'</option>'."\n";
	floadtimehours();
  ?></select>
 	<select name="minini">
 <?php 
	if($flagnuevocursogrupo)
 		echo '<option value ="'.$minini.'">'.$minini.'</option>'."\n";
 	floadtimeminut();
 ?></select>
 	</td>
 	<td colspan="2" bgcolor="#f0f6ff"><input type="checkbox" name="pasadmerini" <?php if($flagnuevocursogrupo){if($pasadmerini)echo "CHECKED";}?>>&nbsp;p.m</td>
 </tr> 
   <tr> 
 <td width="41%" class="NoiseFooterTD"><?php if($campnomb["curgruhorfin"] == 1){$curgruhorfin = null; 
echo "*";}?>Hora de fin</td> 
 <td width="59%" bgcolor="#f0f6ff"><select name="horfin">
 <?php 
 	if($flagnuevocursogrupo)
 		echo '<option value ="'.$horfin.'">'.$horfin.'</option>'."\n";
	floadtimehours();
  ?></select>
 	<select name="minfin">
 <?php 
	if($flagnuevocursogrupo)
 		echo '<option value ="'.$minfin.'">'.$minfin.'</option>'."\n";
 	floadtimeminut();
 ?></select>
  </td>
  <td colspan="2" bgcolor="#f0f6ff"><input type="checkbox" name="pasadmerfin" <?php if($flagnuevocursogrupo){if($pasadmerfin)echo "CHECKED";}?>>&nbsp;p.m</td>
 </tr> 
</table> 
  </td> 
 </tr> 
 <tr> 
<td> 
<div align="center"> 
  <input type="image" name="aceptar"  src="../img/aceptar.gif" onclick="carga();
 form1.curgruhorini.value = form1.horini.value+':'+form1.minini.value;
 form1.curgruhorfin.value = form1.horfin.value+':'+form1.minfin.value;
 form1.accionnuevocursogrupo.value =  1;"  width="86" height="18" 
alt="Aceptar" border=0> 
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
<?php 
if($campnomb){echo '<font face = "Verdana" >Corregir los capos marcados con
*</font>';} 
?> 
<input type="hidden" name="curgrucodigo" value="<?php if(!$flagnuevocursogrupo){ echo $sbreg[curgrucodigo];}else{ echo $curgrucodigo; } ?>"> 
<input type="hidden" name="arreglo1" value="<?php echo $arreglo1;?>">
<input type="hidden" name="arreglo2" value="<?php echo $arreglo2;?>">
<input type="hidden" name="accionnuevocursogrupo"> 
<input type="hidden" name="curgruhorini"> 
<input type="hidden" name="curgruhorfin"> 
<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
</form> 
</body> 
<?php 
if(!$codigo)
{ echo " -->"; }
?> 
</html> 
