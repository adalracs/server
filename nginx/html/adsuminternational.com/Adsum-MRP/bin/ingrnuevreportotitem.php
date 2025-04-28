<?php
include('../src/FunPerSecNiv/fncconn.php');
include('../src/FunPerSecNiv/fncclose.php');
include('../src/FunPerSecNiv/fncfetch.php');
include('../src/FunPerSecNiv/fncnumreg.php');
//------------------------------------------
include('../src/FunPerPriNiv/pktbltareot.php');
include('../src/FunPerPriNiv/pktblitem.php');
include('../src/FunPerPriNiv/pktblitemtareot.php');
include('../src/FunPerPriNiv/pktbltransacitem.php');
include('../src/FunPerPriNiv/pktblunimedida.php');
include('../src/FunPerPriNiv/pktblitemestado.php');
include('../src/FunPerPriNiv/pktbltipomovi.php');
ob_start();
if($accionnuevoreportotitem)
{
	include ( 'grabatransacitemot.php');
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
<title>Nuevo registro de reportotitem</title> 
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
<meta http-equiv="expires" content="0"> 
<link rel="stylesheet" type="text/css" href="temas/Noise/Style.css">
<SCRIPT LANGUAGE="Javascript">
function carga()
{
	var str_value = new String();
	var arr_item  = new String();
	var c_form = window.document.form1.elements.length;
	var ref_form = window.document.form1;
	var i = 0;

	for(i=0; i<c_form; i++)
	{
		if(ref_form.elements[i].type == "select-one")
		{
			if(ref_form.elements[i].name.indexOf("itestacodigo") != -1)
			{
				if(ref_form.elements[i].options[ref_form.elements[i].options.selectedIndex].value != "")
				{
					str_value = str_value + ref_form.elements[i].options[ref_form.elements[i].options.selectedIndex].value + "||";
				}
			}
		}

		if(ref_form.elements[i].type == "text")
		{
			if(ref_form.elements[i].name.indexOf("itemcodigo") != -1)
			{
				str_value = str_value + ref_form.elements[i].value + ",";
				arr_item = arr_item + ref_form.elements[i].value + ",";
			}

			if(ref_form.elements[i].name.indexOf("transitecantid") != -1)
			{
				str_value = str_value + ref_form.elements[i].value + ",";
			}
		}
	}
	str_value = str_value.substr(0, str_value.lastIndexOf('||'));
	arr_item = arr_item.substr(0, arr_item.lastIndexOf(','));
	window.opener.document.form1.arreglo_ite.value = arr_item;
	window.document.form1.arreglo_aux.value = str_value;
}
</SCRIPT> 
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
<body bgcolor="FFFFFF" text="#000000" onload="this.focus();"> 
<form name="form1" method="post"  enctype="multipart/form-data"> 
<p><font class="NoiseFormHeaderFont">Devoluci&oacute;n de items</font></p> 
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
            <table width="85%" border="0" cellspacing="0" cellpadding="0" 
align="center">
<tr> 
<TABLE width='93%' border='0' cellspacing='0' cellpadding='3' align='center'>            
<?php
include('../src/FunGen/fnccargareportotitem.php');
$idcon = fncconn();
fnccargareportotitem($ordtracodigo, $idcon);
fncclose($idcon);
?>
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
onclick="carga(); form1.accionnuevoreportotitem.value=1;"  width="86" height="18" 
alt="Aceptar" border=0> 
  <input type="image" name="cancelar" src="../img/cancelar.gif" 
onclick="self.close();"  width="86" height="18" 
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
*</font>'; } 
?> 
<input type="hidden" name="repitemcodigo" value="<?php 
if(!$flagnuevoreportotitem){ echo $sbreg[repitemcodigo];}else{ echo
$repitemcodigo; } ?>"> 
<input type="hidden" name="accionnuevoreportotitem"> 
<input type="hidden" name="transitefecha" value="<?echo date('Y-m-d');?>"> 
<input type="hidden" name="tipmovcodigo" value="1">
<!-- * * Bandera usada en grabatransacitemot * * --> 
<input type="hidden" name="flagreportotitem" value="1"> 
<!-- * * arreglo_aux contiene codigo del item/cantidad a devolver/estado * * -->
<input type="hidden" name="arreglo_aux">
<!-- 		   -->
<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
</form> 
</body> 
<?php 
if(!$codigo)
{ echo " -->"; }
?> 
</html>
