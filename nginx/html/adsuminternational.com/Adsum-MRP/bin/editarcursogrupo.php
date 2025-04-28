<?php 
ob_start();
include ( '../src/FunGen/sesion/fncvalses.php');
include ( '../src/FunPerPriNiv/pktblcurso.php');
include ( '../src/FunPerPriNiv/pktblgrupcapa.php');
include ( '../src/FunPerPriNiv/pktblmateapoy.php');
include ( '../src/FunGen/floadmateapoy2.php');
include ( '../src/FunGen/fnchourcmp.php');
include( '../src/FunGen/datecmp.php');
include ( '../src/FunGen/floadtimehours.php');
include ( '../src/FunGen/floadtimeminut.php');
if($accioneditarcursogrupo)
{
	include ( 'editacursogrupo.php');
	$flageditarcursogrupo = 1;
}
ob_end_flush();
if(!$flageditarcursogrupo)
{
	$bloqfec = 0;
	include ( '../src/FunGen/sesion/fnccarga.php');
	$sbreg = fnccarga($nombtabl,$radiobutton);
	if (!$sbreg)
	{
		include( '../src/FunGen/fnccontfron.php');
	}
	$idcon = fncconn();
	$varcurso = $sbreg[cursocodigo];
	$arrcurso = loadrecordcurso($varcurso,$idcon);
	$codcurso = $sbreg[cursocodigo];
	$vargrupcapa = $sbreg[grucapcodigo];
	$arrgrupcapa = loadrecordgrupcapa($vargrupcapa,$idcon);
	$codgrupcapa = $sbreg[grucapcodigo];
	$varmateapoy = $sbreg[matapocodigo];
	$arrmateapoy = loadrecordmateapoy($varmateapoy,$idcon);
	$codmateapoy = $sbreg[matapocodigo];
	$arraystr = array($codcurso, $codgrupcapa);
	$str = loadrecordcursogrupo2proc($arraystr,$idcon);

	$foo1 = explode(":",$sbreg[curgruhorini]);
	$horini = $foo1[0];
	if ($horini > 11)
	{
		if($horini != 12)
		$horini = "0".($horini - 12);
		$pasadmerini = 1;

	}
	$minini = $foo1[1];
	$foo2 = explode(":",$sbreg[curgruhorfin]);
	$horfin = $foo2[0];
	if ($horfin > 11)
	{
		if($horfin != 12)
		$horfin = "0".($horfin - 12);
		$pasadmerfin = 1;
	}
	$minfin = $foo2[1];
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
<title>Editar registro de Capacitaci&oacute;n</title> 
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
<meta http-equiv="expires" content="0"> 
<link rel="stylesheet" type="text/css" href="temas/Noise/Style.css"> 
<script language="JavaScript" src="../src/FunGen/fncmoveselectoptions.js" type="text/javascript"></script> 
<script language="JavaScript" src="../src/FunGen/jsrsClient.js" type="text/javascript"></script>
<script language="JavaScript" src="../src/FunGen/cargarMateapoy.js" type="text/javascript"></script>
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
function load_users(cadena)
{
	miArray  = jsrsArrayFromString( cadena  , ",");
	var i,j;
	j=0;
	var defaultSelected = false;
	var selected = false;
	for(i = 0; i < miArray.length -1; i++)
	{
		if(i == 0 )
		{
			defaultSelected = true;
			selected = true;
		}
		valor = miArray[i];
		nombre = miArray[i+1];
		window.document.form1.matadelet.options[j] = new Option(nombre,valor,defaultSelected,selected);
		j++;
		i++;
	}

	for(k=0; k < window.document.form1.matadelet.length; k++)
	{
		for(m= 0; m < window.document.form1.mataselec.length; m++)
		{
			if(window.document.form1.matadelet.options[k].value == window.document.form1.mataselec.options[m].value)
			{
				delete_record(window.document.form1.mataselec,m);
			}
		}
	}
}
</script>
</script> 
</head> 
<?php 
if(!$codigo)
{ echo "<!--";}
?> 
<body bgcolor="FFFFFF" text="#000000" onload="load_users('<?php echo $str;?>');
save_users(window.document.form1.mataselec);"> 
<form name="form1" method="post"  enctype="multipart/form-data"> 
<p><font class="NoiseFormHeaderFont">Capacitaci&oacute;n</font></p> 
<table border="0" cellspacing="1" width="50%" cellpadding="2" align="center" 
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
            <table width="85%" border="0" cellspacing="0" cellpadding="3" 
align="center"> 
<tr> 
<tr> 
 <td width="25%"><?php if($campnomb["cursocodigo"] == 1){$cursocodigo = null; echo 
"*";}?>Curso</td> 
 <td width="25%"><select name="cursocodigo" onchange="window.document.form1.matadelet.length = 0;
cargarMateapoy(this.value);"><?php
if(!$flageditarcursogrupo)
{
	echo '<option value = "'.$codcurso.'">'.$arrcurso[cursonombre];
}
else if ($accioneditarcursogrupo)
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
  <td width="25%"><?php if($campnomb["grucapcodigo"] == 1){$grucapcodigo = null; 
echo "*";}?>Grupo</td> 
 <td width="25%"> 
            <select name="grucapcodigo" onchange="window.document.form1.matadelet.length = 0;
cargarMateapoyCursoGrupo(window.document.form1.cursocodigo.value,this.value);">
            <?php
            if(!$flageditarcursogrupo)
            {
            	echo '<option value = "'.$codgrupcapa.'">'.$arrgrupcapa[grucapnombre];
            }
            else if ($accioneditarcursogrupo)
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
 <td colspan="4"><hr></td>
 </tr> 
<tr> 
<td colspan="4">Materiales de apoyo
  <input name="button1" type="radio" 
onClick="secundaria1=window.open('consultarmatauxapoy.php?codigo=<?php echo $codigo?>','secundaria1','status=no,menubar=no,scrollbars=yes,resizable=yes,left=150,width=800,height=600');" width="86" height="18" alt="Cancelar" border=0 href="#" target="_parent">
</td>
 </tr>
 <tr>
  <td colspan="1">Materiales</td> 
 <td colspan="1"><div align="left"></div></td>
 <td colspan="2">Materiales asignados</td> 
 </tr>
 <tr>
 <td colspan="1" rowspan="2"><select name="mataselec" size="4">
   <?php
   if ($flageditarcursogrupo)
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
   }?></select></td> 
 <td height="38" colspan="1"><div align="center">
   <input type="button" name="deletsele" value=" > " onclick="transferTo(this.form.mataselec,this.form.matadelet);">
 </div></td>
 <td colspan="2" rowspan="2">
 <select name="matadelet" size="4">
   <?php
   if($flageditarcursogrupo)
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
   <td height="33" colspan="1"><div align="center">
     <input type="button" name="deletsele2" value=" < " onclick="transferTo(this.form.matadelet,this.form.mataselec);">
   </div></td>
 </tr> 

<td width="100%" colspan="4"><hr></td>
</tr>
 </tr> 
 <tr> 
 <td width="41%"><?php if($campnomb["curgrufecini"] == 1){$curgrufecini = null;
echo "*";}?>Fecha de inicio</td> 
 <td width="59%"><input type="text" name="curgrufecini" size="13" value="<?php if(!$flageditarcursogrupo){ echo $sbreg[curgrufecini];} else {echo $curgrufecini;}?>" onFocus="if (!agree)this.blur();"></td>
	<td colspan="2"><img src="../img/cal.gif" border="0" onclick="window.open('formcalendario.php?calencodigo=curgrufecini','','status=no,menubar=no,scrollbars=yes,resizable=yes,left=600,width=200,height=210');"></td> 
 </tr>
 <tr> 
 <td width="41%"><?php if($campnomb["curgrufecfin"] == 1){$curgrufecfin = null; 
echo "*";}?>Fecha de fin</td> 
 	<td width="59%"><input type="text" name="curgrufecfin" size="13" value="<?php if(!$flageditarcursogrupo){ echo $sbreg[curgrufecfin];} else {echo $curgrufecfin;}?>" onFocus="if (!agree)this.blur();"></td>
	<td colspan="2"><img src="../img/cal.gif" border="0" onclick="window.open('formcalendario.php?calencodigo=curgrufecfin','','status=no,menubar=no,scrollbars=yes,resizable=yes,left=600,width=200,height=210');"></td> 
 </tr> 
 <tr>
 <td width="41%"><?php if($campnomb["curgruhorini"] == 1){$curgruhorini = null; 
echo "*";}?>Hora de inicio</td> 
 <td width="59%"><select name="horini">
 <?php 
 if(!$flageditarcursogrupo)
 echo '<option value ="'.$horini.'">'.$horini.'</option>'."\n";
 else
 echo '<option value ="'.$horini.'">'.$horini.'</option>'."\n";
 floadtimehours();
  ?></select>
 	<select name="minini">
 <?php 
 if(!$flageditarcursogrupo)
 echo '<option value ="'.$minini.'">'.$minini.'</option>'."\n";
 else
 echo '<option value ="'.$minini.'">'.$minini.'</option>'."\n";
 floadtimeminut();
 ?></select>
 	</td>
 	<td colspan="2"><input type="checkbox" name="pasadmerini" <?php if(!$flageditarcursogrupo){if($pasadmerini)echo "CHECKED";}else{if($pasadmerini)echo "CHECKED";}?>>&nbsp;p.m</td>
 </tr> 
   <tr> 
 <td width="41%"><?php if($campnomb["curgruhorfin"] == 1){$curgruhorfin = null; 
echo "*";}?>Hora de fin</td> 
 <td width="59%"><select name="horfin">
 <?php 
 if(!$flageditarcursogrupo)
 echo '<option value ="'.$horfin.'">'.$horfin.'</option>'."\n";
 else
 echo '<option value ="'.$horfin.'">'.$horfin.'</option>'."\n";
 floadtimehours();
  ?></select>
 	<select name="minfin">
 <?php 
 if(!$flageditarcursogrupo)
 echo '<option value ="'.$minfin.'">'.$minfin.'</option>'."\n";
 else
 echo '<option value ="'.$minfin.'">'.$minfin.'</option>'."\n";
 floadtimeminut();
 ?></select>
  </td>
  <td colspan="2"><input type="checkbox" name="pasadmerfin" <?php if(!$flageditarcursogrupo){if($pasadmerfin)echo "CHECKED";}else{if($pasadmerfin)echo "CHECKED";}?>>&nbsp;p.m</td>
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
onclick="carga(); form1.accioneditarcursogrupo.value =  1;
form1.curgruhorini.value = form1.horini.value+':'+form1.minini.value;
 form1.curgruhorfin.value = form1.horfin.value+':'+form1.minfin.value;
" width="86" height="18" alt="Aceptar" border=0> 
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
<input type="hidden" name="curgrucodigo" value="<?php if(!$flageditarcursogrupo){ echo $sbreg[curgrucodigo];}else{ echo $curgrucodigo; } ?>"> 
<input type="hidden" name="curgruhorini"> 
<input type="hidden" name="curgruhorfin">
<input type="hidden" name="bloqfec" value="<?php echo $bloqfec;?>">
<input type="hidden" name="arreglo1" value="<?php echo $arreglo1;?>">
<input type="hidden" name="arreglo2" value="<?php echo $arreglo2;?>">
<input type="hidden" name="flageditarcursogrupo1" value="<?php echo $flageditarcursogrupo; ?>">
<input type="hidden" name="accioneditarcursogrupo"> 
<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
</form> 
</body> 
<?php 
if(!$codigo)
{ echo " -->"; }
?> 
</html> 
