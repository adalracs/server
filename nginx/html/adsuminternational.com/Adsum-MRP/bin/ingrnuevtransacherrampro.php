<?php  
include('../src/FunPerPriNiv/pktbltipomovi.php');
include('../src/FunPerPriNiv/pktblherramie.php');
include ( '../src/FunPerSecNiv/fncconn.php'); 
include ( '../src/FunPerSecNiv/fncclose.php'); 
include ( '../src/FunPerSecNiv/fncnumreg.php'); 
include ( '../src/FunPerSecNiv/fncfetch.php'); 
include ( '../src/FunGen/sesion/fnccantrow.php'); 
include ( '../src/FunGen/sesion/fnccantrow1.php'); 
include ( '../src/FunPerPriNiv/limitscan.php');
if($accionnuevotransacherramie) 
{ 
	include ( 'grabatransacherramieot.php'); 
	if($flagnuevotransacherramie)
	{
		if($herramcodigo)
		{
			$idcon = fncconn();
			$herrnomb = loadrecordherramie($herramcodigo,$idcon);
  			$herramnombre = $herrnomb[herramnombre];
  			$herramvalor = $herrnomb[herramvalor];
			fncclose($idcon);
		}
	}else 
	{
		$herramcodigo = "";
		$herramnombre = "";
		$herramvalor = "";
		$herramdispon = "";
	}
}
$arrtransachertemp = $_SESSION["arrtransaccod"];
unset($loadherram);
for ($i = 0;$i < count($arrtransachertemp);$i++)
{	
	$loadherram = $loadherram.$arrtransachertemp[$i][0]."-".$arrtransachertemp[$i][1].",";
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
<title>Selecci&oacute;n de Herramienta</title> 
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
.Estilo2 {color: #000000}
.Estilo7 {
	font-size: 14px;
	font-weight: bold;
}
-->
</style></head> 
<?php 
    if(!$codigo) 
    { echo "<!--";} 
?> 
<body bgcolor="FFFFFF" text="#000000"> 
<form name="form1" method="post"  enctype="multipart/form-data"> 
<p><font class="NoiseFormHeaderFont">Selecci&oacute;n de Herramienta</font></p> 
<table border="0" cellspacing="1" cellpadding="2" align="center" 
class="NoiseFormTABLE"> 
  <tr> 
    <td width="599" class="NoiseErrorDataTD">&nbsp;</td> 
  </tr> 
  <tr> 
          <td class="NoiseFieldCaptionTD"><span class="style5"><font 
color="FFFFFF"> 
Ingresar nuevo registro</font></span></td></tr> 
<tr> 
  <td> 
            <table width="83%" border="0" cellspacing="0" cellpadding="3" 
align="center">  
<tr> 
 <td colspan="3" align="left"><?php if($campnomb["herramcodigo"] == 1){$herramcodigo = null; echo "*";}
 ?>Seleccione Herramienta&nbsp;
    <input name="radiobutton" type="radio" onclick="window.open('consultarherramietransac.php?codigo=<?php echo $codigo?>','ventana','status=no,menubar=no,scrollbars=yes,resizable=yes,left=300,width=800,height=600');"></td> 
    <td width="15%" align="left">Cod.&nbsp;
      <input type="text" name="herramcodigo" value="<?php echo $herramcodigo ?>" onFocus="if (!agree)this.blur();" size="5"></td>
 <td colspan="1" align="left">Nombre</td>
 <td colspan="2"><input type="text" name="herramnombre" value="<?php echo $herramnombre;?>" onFocus="if (!agree)this.blur();"></td>
 
 </tr>
<tr>
<td colspan="7">&nbsp;</td>
  </tr>
<tr>
  <td width="20%">Disponible</td>
  <td colspan="3"><input type="text" name="herramdispon" value="<?php echo $herramdispon;?>" size="4" onFocus="if (!agree)this.blur();"></td>
  <td width="11%">Valor $</td>
  <td width="8%"><div align="right"><input type="text" name="herramvalor" value="<?php echo $herramvalor;?>" size="10" onFocus="if (!agree)this.blur();"></div></td>
  <td width="27%">&nbsp;</td>
</tr> 
<tr>
<td colspan="7"><hr></td>
		</tr>
<tr> 
 <td colspan="2"><?php if($campnomb["transhercanti"] == 1){$transhercanti = null; echo "*";}
 ?>Cantidad</td> 
 <td colspan="5"> 
  <input name="transhercanti" type="text"	value="<?php 
if(!$flagnuevotransacherramie){ echo $sbreg[transhercanti];}else{ echo 
$transhercanti; }?>" size="10">
 </td> 
 </tr> 
 <tr> 
  <td colspan="2">&nbsp;</td> 
 </tr> 
</table> 
  </td> 
 </tr> 
<tr> 
	<td align="right"> 
		<input type="image" name="adicionar" src="../img/adicionar.gif" onclick="form1.accionnuevotransacherramie.value =  1;"  width="86" height="18" alt="Nuevo" border=0>
		<input type="image" name="nuevo"  src="../img/cancelar.gif" onclick="window.opener.document.form1.radio3.focus();window.close();"  width="86" height="18" alt="Cancelar" border=0>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<input type="image" name="aplicar a OT"  src="../img/aplicaraOT.gif" onclick="window.opener.document.form1.loadherram.value=window.document.form1.loadherram.value;window.opener.document.form1.radio3.focus();window.close();"  width="86" height="18" alt="aplicar a OT" border=0>
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
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<table width="588" height="48" border="0" align="center" cellpadding="2" cellspacing="1" 
class="NoiseFormTABLE">
  <tr>
    <td height="21" bgcolor="#FFFFFF" class="NoiseErrorDataTD Estilo2"><span class="Estilo7">Nota</span></td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF">Para adicionar una o varias herramientas, presione el bot&oacute;n <em>Adicionar</em>.<br>
	Para adicionarlas y regresar a la OT, presione <em>Aplicar a OT</em></td>
  </tr>
</table>
<p>&nbsp;</p>
<p>
  <input type="hidden" name="transhercodigo" value="<?php if(!$flagnuevotransacherramie){ echo $sbreg[transhercodigo];}else{ echo $transhercodigo; } ?>"> 
  <input type="hidden" name="transhertotal"	value="<?php if(!$flagnuevotransacherramie){ echo $sbreg[transhertotal];}else{ echo $transhertotal; }?>"> 
  <input type="hidden" name="transherfecha" value="<?php $transherfecha = date("Y-m-d"); echo $transherfecha;?>">
  <input type="hidden" name="usuacodi" value="<?php echo $GLOBALS[usuacodi]; ?>">
  <input type="hidden" name="accionnuevotransacherramie"> 
  <input type="hidden" name="codigo" value="<?php echo $codigo; ?>">
   <input type="hidden" name="loadherram" value="<?php echo $loadherram; ?>"> 
   <input type="hidden" name="flagsoliot" value="<?php echo $flagsoliot; ?>"> 
</p>
</form> 
</body> 
<?php 
    if(!$codigo) 
    { echo " -->"; } 
?> 
</html> 
