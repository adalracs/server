<?php 
ob_start(); 
include ( '../src/FunGen/sesion/fncvalses.php'); 
include ( '../src/FunPerPriNiv/pktblusuario.php'); 
include ( '../src/FunPerPriNiv/pktblgrupcapa.php');	
include('../src/FunGen/floadusuaselect.php');
//include ( '../src/FunPerPriNiv/pktblempleado.php');	
if($accionnuevousuagrupcapa) 
{
	include ( 'grabausuagrupcapa.php'); 
} 
ob_end_flush(); 
?> 
<!-- Propiedad intelectual de Adsum SA (c) 
-Todos los derechos reservados- 
Creado con WAG Adsum 
Autor: 		Andr�s A. Riascos D. 
Fecha: 		26052004 
Modificado: jcortes
Fecha:		13-jul-2005
GenVers: 3.1 --> 
<html> 
<head> 
<title>Nuevo registro de usuagrupcapa</title> 
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
<meta http-equiv="expires" content="0"> 
<link rel="stylesheet" type="text/css" href="temas/Noise/Style.css"> 
<SCRIPT LANGUAGE="JavaScript"> 
var arreglo1 = new Array;
var arreglo2 = new Array;
function carga()
{
	for(var i=0; i < document.form1.elements['empleaselec'].length; i++)
	{
		arreglo2[i] = document.form1.empleaselec[i].value;
	}
	document.form1.arreglo2.value = arreglo2;

	for(var i=0; i < document.form1.elements['empleadelet'].length; i++)
	{
		arreglo1[i] = document.form1.empleadelet[i].value;
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
<SCRIPT LANGUAGE="JavaScript"> 
<!-- Begin 
agree = 0; 
//  End --> 
</script> 
<script language="JavaScript" src="../src/FunGen/fncmoveselectoptions.js" type="text/javascript"></script>
<script language="JavaScript" src="../src/FunGen/jsrsClient.js" type="text/javascript"></script>
<script language="JavaScript" src="../src/FunGen/cargarUsuagrupcapa.js" type="text/javascript"></script>
</head> 
<?php 
    if(!$codigo) 
    { echo "<!--";} 
?> 
<body onload="save_users(window.document.form1.empleaselec);" bgcolor="FFFFFF" text="#000000"> 
<form name="form1" method="post"  enctype="multipart/form-data"> 
<p><font class="NoiseFormHeaderFont">Grupo de empleados</font></p> 
<table border="0" cellspacing="1" cellpadding="2" align="center" 
class="NoiseFormTABLE"> 
  <tr> 
    <td class="NoiseErrorDataTD">&nbsp;</td> 
  </tr> 
  <tr> 
	<td class="NoiseFieldCaptionTD"><span class="style5">
	<font color="FFFFFF"> 
Ingresar nuevo registro</font></span></td></tr> 
<tr> 
  <td> 
            <table width="450" border="0" cellspacing="1" cellpadding="3" 
align="center"> 
<tr> 
 <td width="10%" class="NoiseFooterTD"><?php if($campnomb == "grucapcodigo"){$grucapcodigo = null; 
echo "*";}?>&nbsp;&nbsp;Grupo</td> 
 <td class="NoiseFooterTD" colspan="7">
 <select onchange="
window.document.form1.empleadelet.length=0;
cargarUsuagrupcapa(this.value);" name="grucapcodigo">
<?php
	if(!$flagnuevousuagrupcapa)
	{
		echo '<option value = "">Seleccione';
	}
	else if ($accionnuevousuagrupcapa)
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
	}
	include ('../src/FunGen/floadgrupcapa.php');
	$idcon = fncconn();
	floadgrupcapa($idcon);
	fncclose($idcon);
?>
 </select></td>
 <td width="51%" colspan="3">&nbsp;</td> 
 </tr> 
 <tr> 
 <td colspan="7" bgcolor="#f0f6ff">&nbsp;&nbsp;Empleado
  <input name="button1" type="radio" 
onClick="secundaria1=window.open('consultarusuarigrupc.php?codigo=<?php echo $codigo?>','secundaria1','status=no,menubar=no,scrollbars=yes,resizable=yes,left=150,width=800,height=600');" width="86" height="18" alt="Cancelar" border=0 href="#" target="_parent">
</td>
  </tr>
<tr> 
 <td colspan="2" class="NoiseFooterTD">&nbsp;&nbsp;Empleados</td> 
 <td colspan="2" class="NoiseFooterTD"><div align="left"></div></td>
 <td colspan="3" class="NoiseFooterTD">&nbsp;&nbsp;Empleados asignados</td> 
 </tr>
 <tr>
 <td colspan="2" rowspan="2" bgcolor="#f0f6ff"><select name="empleaselec" size="4">
   <?php
                       if ($flagnuevousuagrupcapa)
                       {
							$idcon = fncconn();
							floadusuaselect($idcon,$arreglo2); 
							fncclose($idcon);
                       }
					   else
					   {
							include('../src/FunGen/floadusuario.php');
							$idcon = fncconn();
							floadusuario($idcon);
							fncclose($idcon);
					   }
                       ?></select></td> 
 <td height="38" colspan="2" bgcolor="#f0f6ff"><div align="center">
   <input type="button" name="deletsele" value=" > " onclick="transferTo(this.form.empleaselec,this.form.empleadelet);">
 </div></td>
 <td colspan="3" rowspan="2" bgcolor="#f0f6ff">
 <select name="empleadelet" size="4">
   <?php
	if($flagnuevousuagrupcapa)
	{
		$idcon = fncconn();
		floadusuaselect($idcon,$arreglo1);
		fncclose($idcon);
	}?></select>
 </td>
 </tr>
 <tr>
   <td height="33" colspan="2" bgcolor="#f0f6ff"><div align="center">
     <input type="button" name="deletsele2" value=" < " onclick="transferTo(this.form.empleadelet,this.form.empleaselec);">
   </div></td>
 </tr> 

</table> 
  </td> 
 </tr> 
 <tr> 
<td> 
<div align="center"> 
  <input type="image" name="aceptar"  src="../img/aceptar.gif" 
onclick="carga();form1.accionnuevousuagrupcapa.value =  1;form1.action='ingrnuevusuagrupcapa.php';" 
width="86" height="18" alt="Aceptar" border=0> 
  <input type="image" name="cancelar" src="../img/cancelar.gif" 
onclick="form1.action='maestablusuagrupcapa.php';"  width="86" height="18" alt="Cancelar" border=0> 
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
<input type="hidden" name="usugrucodigo" value="<?php if(!$flagnuevousuagrupcapa){echo $sbreg[usugrucodigo];}else{ echo $usugrucodigo; } ?>"> 
<input type="hidden" name="accionnuevousuagrupcapa"> 
<input type="hidden" name="accionnuevoemplgrupo" value="<?php echo $accionnuevoemplgrupo;?>"> 
<input type="hidden" name="accionnuevoempprod"> 
<input type="hidden" name="accionnuevoempmant"> 
<input type="hidden" name="arreglo1" value="<?php echo $arreglo1;?>">
<input type="hidden" name="arreglo2" value="<?php echo $arreglo2;?>">
<input type="hidden" name="arreglo_aux" value="<?php echo $arreglo_aux; ?>">
<input type="hidden" name="codigo" value="<?php echo $codigo; ?>">
</form>
</body>
<?php 
    if(!$codigo) 
    { echo " -->"; } 
?> 
</html> 
