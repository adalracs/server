<?php 
ob_start();
include ( '../src/FunPerSecNiv/fncconn.php'); 
include ( '../src/FunPerSecNiv/fncclose.php'); 
include ( '../src/FunPerSecNiv/fncnumreg.php'); 
include ( '../src/FunPerSecNiv/fncfetch.php'); 
include ( '../src/FunGen/sesion/fnccantrow.php'); 
include ( '../src/FunGen/sesion/fnccantrow1.php'); 
include ( '../src/FunPerPriNiv/limitscan.php'); 
include('../src/FunPerPriNiv/pktbltipomovi.php');
include('../src/FunPerPriNiv/pktblitem.php');
include('../src/FunPerPriNiv/pktblunimedida.php');
if($accionnuevotransacitem) 
{ 
	include ( 'grabatransacitemot.php');
	if(!$flagnuevotransacitem)
	{
		$itemcodigo = "";
		$itemnombre = "";
		$itemvalor = "";
		$itemcanmin = "";
		$itemcanmax = "";
		$itemdispon = "";
	}
}
ob_end_flush();
$arrtransacitetemp = $_SESSION["arrtransaccoditem"];
unset($loaditem);
for ($i = 0;$i < count($arrtransacitetemp);$i++)
{	
	$loaditem = $loaditem.$arrtransacitetemp[$i][0]."-".$arrtransacitetemp[$i][1].",";
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
<title>Nuevo registro de transacitem</title> 
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
<meta http-equiv="expires" content="0"> 
<link rel="stylesheet" type="text/css" href="temas/Noise/Style.css"> 
<SCRIPT LANGUAGE="JavaScript"> 
<!-- Begin 
agree = 0; 
//  End --> 
</script> 
<style type="text/css">
<!--
.Estilo7 {
	font-size: 14px;
	font-weight: bold;
	color: #000000;
}
-->
</style>
</head> 
<?php 
    if(!$codigo) 
    { echo "<!--";} 
?> 
<body bgcolor="FFFFFF" text="#000000"> 
<form name="form1" method="post"  enctype="multipart/form-data"> 
<p><font class="NoiseFormHeaderFont">Selecci&oacute;n de Item</font></p> 
<table border="0" cellspacing="1" cellpadding="2" align="center" 
class="NoiseFormTABLE"> 
  <tr> 
    <td width="467" class="NoiseErrorDataTD">&nbsp;</td> 
  </tr> 
  <tr> 
          <td class="NoiseFieldCaptionTD"><span class="style5"><font 
color="FFFFFF"> 
Selecci&oacute;n de Item</font></span></td></tr> 
<tr> 
  <td> 
            <table width="97%" border="0" cellspacing="0" cellpadding="3" 
align="center"> 
<tr> 
 <td colspan="2"><?php if($campnomb["itemcodigo"] == 1){ $itemcodigo = null;
 echo "*";}
 ?>Seleccione Item&nbsp;&nbsp;
   <input name="radiobutton" type="radio" onclick="window.open('consultaritemtransac.php?codigo=<?php echo $codigo?>','ventana','status=no,menubar=no,scrollbars=yes,resizable=yes,left=300,width=800,height=600');"></td> 
   <td>Cod.&nbsp;<input type="text" name="itemcodigo" onblur=" if(this.value != '') {cargarItemtransac(this.value); }" value="<?php echo $itemcodigo ?>" size="5"></td>
 <td colspan="1">Nombre</td>
 <td colspan="2"><input type="text" name="itemnomb" value="<?php echo $itemnomb;?>" onFocus="if (!agree)this.blur();"></td>
 </tr>
 <tr>
<td>&nbsp;</td>
  <td colspan="5">&nbsp;</td></tr>
<tr>
  <td>Cant. M&iacute;nima</td>
  <td width="9%"><input type="text" name="itemcanmin" style="border:none" value="<?php echo $itemcanmin;?>" size="4" onFocus="if (!agree)this.blur();"></td>
  <td width="23%">Cant. M&aacute;xima</td>
  <td width="10%"><input type="text" name="itemcanmax" style="border:none" value="<?php echo $itemcanmax;?>" size="4" onFocus="if (!agree)this.blur();"></td>
  <td width="23%"><div align="right">Disponible</div></td>
  <td width="15%"><input type="text" name="itemdispon" style="border:none" value="<?php echo $itemdispon;?>" size="4" onFocus="if (!agree)this.blur();"></td>
</tr> 
<tr>
  
  </tr>
<tr>
<td colspan="6"><hr></td>
		</tr>
		
<tr> 
 <td width="23%">Valor $</td> 
 <td colspan="5"><input type="text" name="itemvalor" value="<?php echo $itemvalor;?>" size="10" onFocus="if (!agree)this.blur();"></td> 
 </tr> 
<tr> 
 <td width="23%"><?php if($campnomb["transitecantid"] == 1){$transitecantid = null; echo "*";}
 ?>Cantidad</td> 
 <td colspan="5"><input name="transitecantid" type="text"	value="<?php if(!$flagnuevotransacitem){ echo $sbreg[transitecantid];}else{ echo $transitecantid; }?>" size="10"></td> 
 </tr> 
 <tr> 
  <td width="23%">&nbsp;</td> 
 </tr> 
</table> 
  </td> 
 </tr> 
 <tr> 
<td align="right"> 
	<input type="image" name="Adicionar" src="../img/adicionar.gif" onclick="form1.accionnuevotransacitem.value =  1;"  width="86" height="18" alt="Adicionar" border=0>
	<input type="image" name="nuevo"  src="../img/cancelar.gif" onclick="window.opener.document.form1.radio4.focus();window.close();"  width="86" height="18" alt="Cancelar" border=0>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<input type="image" name="Aplicar a OT"  src="../img/aplicaraOT.gif" onclick="window.opener.document.form1.loaditem.value=window.document.form1.loaditem.value;window.opener.document.form1.radio4.focus();window.close();"  width="86" height="18" alt="Aplicar a OT" border=0>
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
<p>
  <input type="hidden" name="transitecodigo" value="<?php if(!$flagnuevotransacitem){ echo $sbreg[transitecodigo];}else{ echo $transitecodigo; } ?>"> 
  <input type="hidden" name="transitetotal"	value="<?php if(!$flagnuevotransacitem){ echo $sbreg[transitetotal];}else{ echo $transitetotal; }?>"> 
  <input type="hidden" name="transitefecha" value="<?php $transitefecha = date("Y-m-d"); echo $transitefecha;?>">
  <input type="hidden" name="usuacodi" value="<?php echo $GLOBALS[usuacodi]; ?>">
  <input type="hidden" name="accionnuevotransacitem"> 
  <input type="hidden" name="tipmovcodigo" value="2"> 
  <input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
  <input type="hidden" name="flagsoliotitem" value="<?php echo $flagsoliotitem; ?>"> 
  <input type="hidden" name="loaditem" value="<?php echo $loaditem; ?>"> 
</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<table width="588" height="48" border="0" align="center" cellpadding="2" cellspacing="1" 
class="NoiseFormTABLE">
  <tr>
    <td height="21" bgcolor="#FFFFFF" class="NoiseErrorDataTD Estilo2"><span class="Estilo7">Nota</span></td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF">Para adicionar uno o varios items, presione el bot&oacute;n <em>Adicionar</em>.<br>
      Para adicionarlos y regresar a la OT, presione <em>Aplicar a OT</em></td>
  </tr>
</table>
<p>&nbsp; </p>
</form> 
</body> 
<?php 
    if(!$codigo) 
    { echo " -->"; } 
?> 
</html>