<?php 
ob_start(); 
include ( '../src/FunGen/sesion/fncvalses.php'); 
include ( '../src/FunGen/floadexammediusuario2.php');
include ( '../src/FunPerPriNiv/pktblexammedi.php'); 
include ( '../src/FunPerPriNiv/pktblusuario.php'); 
if($accioneditarexammediusuario) 
{ 
	include ( 'editaexammediusuario.php'); 
	$flageditarexammediusuario = 1; 
} 
ob_end_flush(); 
if(!$flageditarexammediusuario) 
{ 
include ( '../src/FunGen/sesion/fnccarga.php'); 
$sbreg = fnccarga($nombtabl,$radiobutton); 
if (!$sbreg) 
	{ 
		include( '../src/FunGen/fnccontfron.php'); 
	}
	$idcon = fncconn();
	
	$usr = $sbreg[usuacodi];
	$arrusr = loadrecordusuario($usr,$idcon);
	$usrname = $arrusr[usuanombre]." ".$arrusr[usuapriape]." ".$arrusr[usuasegape];
	$str = loadrecordexammediproc($usr,$idcon);
	
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
<title>Editar registro de exammediusuario</title> 
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
<meta http-equiv="expires" content="0"> 
<link rel="stylesheet" type="text/css" href="temas/Noise/Style.css">
<script language="JavaScript" src="../src/FunGen/fncmoveselectoptions.js" type="text/javascript"></script>
<script language="JavaScript" src="../src/FunGen/cargarExammedi.js" type="text/javascript"></script>
<script language="JavaScript" src="../src/FunGen/jsrsClient.js" type="text/javascript"></script>
<SCRIPT LANGUAGE="JavaScript">
var arreglo1 = new Array;
var arreglo2 = new Array;
function carga()
{
	for(var i=0; i < document.form1.elements['examselec'].length; i++)
	{
		arreglo2[i] = document.form1.examselec[i].value;
	}
	document.form1.arreglo2.value = arreglo2;
	for(var i=0; i < document.form1.elements['examdelet'].length; i++)
	{
		arreglo1[i] = document.form1.examdelet[i].value;
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
		window.document.form1.examdelet.options[j] = new Option(nombre,valor,defaultSelected,selected);
		j++;
		i++;
    }
    
    for(k=0; k < window.document.form1.examdelet.length; k++)
    {
	    for(m= 0; m < window.document.form1.examselec.length; m++)
	    {
	    	if(window.document.form1.examdelet.options[k].value == window.document.form1.examselec.options[m].value)
	    	{
	    		delete_record(window.document.form1.examselec,m);
	    	}
	    }
	}
}
</script> 
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
<body bgcolor="FFFFFF" text="#000000" onload="save_users(window.document.form1.examselec);load_users('<?php echo $str;?>');"> 
<form name="form1" method="post"  enctype="multipart/form-data"> 
<p><font class="NoiseFormHeaderFont">Ex&aacute;menes M&eacute;dicos</font></p> 
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
            <table width="85%" border="0" cellspacing="0" cellpadding="3" 
align="center"> 
<tr>
 <td width="50%"><?php if($campnomb["usuacodi"] == 1){$usuacodigo = null; echo 
"*";}?>Empleado<input name="radio2"  type="radio" onclick="window.open('consultarusuaexammed.php?codigo=<?php echo $codigo?>','ventana','status=no,menubar=no,scrollbars=yes,resizable=yes,left=300,width=800,height=600');" width="86" height="18" alt="Cancelar" border=0 href="#" target="_parent"></td> 
 <td width="25%">&nbsp;Cod. 
  <input type="text" name="usuacodigo1" size="4" onfocus="if (!agree) this.blur();" value="<?php 
if(!$flageditarexammediusuario){ echo $sbreg[usuacodi];}else{ echo $usuacodigo; 
}?>"> 
 </td><td width="25%">Nombre&nbsp;<input name="usuanombre" size="18" onfocus="if(!agree) this.blur();" type="text" value="<?php 
if(!$flageditarexammediusuario){ echo $usrname; }else{ echo $usrname; 
}?>"></td>
 </tr>
 <tr><td colspan="3"><hr></td></tr>
            <tr> 
 <td width="50%"><?php if($campnomb["examedcodigo"] == 1){$examedcodigo = null; 
echo "*";}?>Ex&aacute;men m&eacute;dico<input name="radio1"  type="radio" onclick="window.open('consultarexammediaux.php?codigo=<?php echo $codigo?>','ventana','status=no,menubar=no,scrollbars=yes,resizable=yes,left=300,width=800,height=600');" width="86" height="18" alt="Cancelar" border=0 href="#" target="_parent"></td> 
 </tr>
 <tr> 
 <td colspan="1">Examenes</td> 
 <td colspan="1"><div align="left"></div></td>
 <td colspan="2">Examenes asignados</td> 
 </tr>
 <tr>
 <td colspan="1" rowspan="2"><select name="examselec" size="4">
   <?php
   if ($flageditarexammediusuario)
   {
   	$idcon = fncconn();
   	floadexammediusuario2($idcon,$arreglo2);
   	fncclose($idcon);
   }
   else
   {
   	include('../src/FunGen/floadexammediusuario.php');
   	$idcon = fncconn();
   	floadexammediusuario($idcon);
   	fncclose($idcon);
   }
   ?></select></td> 
 <td height="38" colspan="1"><div align="center">
   <input type="button" name="deletsele" value=" > " onclick="transferTo(this.form.examselec,this.form.examdelet);">
 </div></td>
 <td colspan="2" rowspan="2">
 <select name="examdelet" size="4">
   <?php
   if($flageditarexammediusuario)
   {
   	if ($arreglo1 != null)
   	{
   		$idcon = fncconn();
   		floadexammediusuario2($idcon,$arreglo1);
   		fncclose($idcon);
   	}
}?></select>
 </td>
 </tr>
 <tr>
   <td height="33" colspan="1"><div align="center">
     <input type="button" name="deletsele2" value=" < " onclick="transferTo(this.form.examdelet,this.form.examselec);">
   </div></td>
</tr>
 <tr><td colspan="3"><hr></td></tr>
 
<tr> 
 <td width="50%"><?php if($campnomb["exmusupinifec"] == 1){$exmusupinifec = null; 
echo "*";}?>Fecha&nbsp;<input type="text" name="exmusupinifec" onfocus="if(!agree) this.blur();" size="14" value="<?php 
if(!$flageditarexammediusuario){ echo $sbreg[exmusupinifec];}else{ echo 
$exmusupinifec; }?>"> 
 </td><td colspan="2"><img src="../img/cal.gif" border="0" onclick="window.open('formcalendario.php?calencodigo=exmusupinifec','cal1','status=no,menubar=no,scrollbars=yes,resizable=yes,left=600,width=200,height=210');"></td>
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
onclick="carga(); form1.accioneditarexammediusuario.value =  1;"  width="86" height="18" 
alt="Aceptar" border=0> 
  <input type="image" name="cancelar" src="../img/cancelar.gif" 
onclick="form1.action='maestablexammediusuario.php';"  width="86" height="18" 
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
*</font>}';} 
?> 
<input type="hidden" name="exmusucodigo" value="<?php 
if(!$flageditarexammediusuario){ echo $sbreg[exmusucodigo];}else{ echo 
$exmusucodigo; } ?>"> 
<input type="hidden" name="accioneditarexammediusuario">
<input type="hidden" name="arreglo1" value="<?php echo $arreglo1;?>">
<input type="hidden" name="arreglo2" value="<?php echo $arreglo2;?>"> 
<input type="hidden" name="codigo" value="<?php echo $codigo; ?>">
<input type="text" style="border:none; color:#ffffff;" size="1"  name="usuacodigo" onfocus="if (!agree) {this.blur();} window.document.form1.examdelet.length = 0; cargarExammediusuario(this.value);" value="<?php 
if(!$flageditarexammediusuario){ echo $sbreg[usuacodi];}else{ echo $usuacodigo;}?>">
</form> 
</body> 
<?php 
    if(!$codigo) 
    { echo " -->"; } 
?> 
</html> 
