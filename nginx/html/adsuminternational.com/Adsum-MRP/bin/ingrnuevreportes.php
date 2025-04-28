<?php 
ob_start();
include ( '../src/FunGen/sesion/fncvalses.php');
include ( '../src/FunPerPriNiv/pktbltabla.php');
include ( '../src/FunGen/floadtabla.php');
if($accionnuevoreportes)
{
	include ( 'grabareportes.php');
}
ob_end_flush();
?> 
<!-- Propiedad intelectual de Adsum SA (c) 
-Todos los derechos reservados- 
Creado con WAG Adsum 
Autor: Andrés A. Riascos D. 
Fecha: 26052004 
GenVers: 3.1 --> 
<html> 
<head> 
<title>Nuevo registro de reportes</title> 
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
<meta http-equiv="expires" content="0"> 
<link rel="stylesheet" type="text/css" href="temas/Noise/Style.css"> 
<SCRIPT LANGUAGE="JavaScript" src="../src/FunGen/fncmoveselections.js"></script>
<script language="JavaScript" src="../src/FunGen/jsrsClient.js" type="text/javascript"></script>
<SCRIPT LANGUAGE="JavaScript" src="../src/FunGen/cargaRepCampos.js"></script>
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
<p><font class="NoiseFormHeaderFont">Reporte</font></p> 
<table border="0" cellspacing="1" cellpadding="2" align="center" 
class="NoiseFormTABLE" width="80%"> 
  <tr> 
    <td class="NoiseErrorDataTD">&nbsp;</td> 
  </tr> 
  <tr> 
          <td class="NoiseFieldCaptionTD"><span class="style5"><font 
color="FFFFFF"> 
Ingresar nuevo reporte</font></span></td></tr> 
<tr> 
  <td> 
            <table width="85%" border="0" cellspacing="0" cellpadding="3" 
align="center"> 
<tr> 
 <td colspan="2"><?php if($campnomb == "reportnombre"){$reportnombre = null; 
echo "*";}?>Nombre&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="text" size="48" name="reportnombre"	value="<?php 
if(!$flagnuevoreportes){ echo $sbreg[reportnombre];}else{ echo
$reportnombre; }?>">
 </td>
 <td>Fecha:&nbsp;&nbsp;<?php echo date("Y-d-m");?></td>
 </tr>
 <tr>
 <td colspan="3"><hr></td>
 </tr> 
 <tr>
 <td colspan="3">Seleccione las tablas sobre las que desee hacer la consulta</td>
 </tr>
<tr>
<td>
	<select name="allTables" size="6" ondblclick="transferTo(window.document.form1.allTables, window.document.form1.selectedTables), cargaRepCampos();">
	<?php
	$idcon = fncconn();
	floadtabla($idcon);
	fncclose($idcon);
	?>
	</select>	
</td>
<td align="center">
	<input type="button" value="  > " name="put1" onclick="transferTo(window.document.form1.allTables, window.document.form1.selectedTables), cargaRepCampos();"><br>
	<input type="button" value="  < " name="throw1" onclick="quitaCampos(window.document.form1.selectedTables), transferTo(window.document.form1.selectedTables, window.document.form1.allTables);">
</td>
<td>
	<select name="selectedTables" size="6" ondblclick="quitaCampos(window.document.form1.selectedTables), transferTo(window.document.form1.selectedTables, window.document.form1.allTables);">
	</select>
</td>
</tr>
<tr>
<td colspan="3">Seleccione el &oacute;rden y la informaci&oacute;n que desea que aparezca en su informe</td>
</tr>
<tr>
<td>
	<select name="allRows" size="6" ondblclick="transferTo(window.document.form1.allRows, window.document.form1.selectedRows), transferCampo(1);">
	</select>	
</td>
<td align="center">
	<input type="button" value="  > " name="put2" onclick="transferTo(window.document.form1.allRows, window.document.form1.selectedRows), transferCampo(1);"><br>
	<input type="button" value="  < " name="throw2" onclick="transferCampo(0), transferTo(window.document.form1.selectedRows, window.document.form1.allRows);">
</td>
<td>
	<select name="selectedRows" size="6" ondblclick="transferCampo(0), transferTo(window.document.form1.selectedRows, window.document.form1.allRows);">
	</select>
</td>
</tr>
<tr>
<td colspan="3">Organize su consulta</td>
</tr>
<?php
if(!$flagnuevoreportes)
{
	include("../src/FunGen/floadrepparams.php");
	floadrepparams();
}
?>
<tr> 
  <td>Ordenar por<br><br>
  <select name="orderBy">
  <option value="">Seleccione</option>
  </select>
  </td> 
  <td>&nbsp;
</td> 
  <td>&nbsp;</td>
  </tr>
<tr> 
  <td colspan="3">&nbsp;</td> 
 </tr> 
</table> 
  </td> 
 </tr> 
 <tr> 
<td> 
<div align="center"> 
  <input type="image" name="aceptar"  src="../img/aceptar.gif" 
onclick="return setString();"  width="86" height="18" 
alt="Aceptar" border=0> 
  <input type="image" name="cancelar" src="../img/cancelar.gif" 
onclick="form1.action='maestablreportes.php';"  width="86" height="18" 
alt="Cancelar" border=0> 
<input type="image" name="cancelar2" src="../img/ayuda.gif" width="86" 
height="18" alt="Cancelar" border=0> 
</div> 
</td> 
 </tr> 
 <tr> 
  <td class="NoiseErrorDataTD">&nbsp;</td> 
 </tr> 
</table> 
<?php 
if($campnomb){echo '<font face = "Verdana" >Corregir los campos marcados con
*</font>';} 
?> 
<input type="hidden" name="departcodigo" value="<?php 
if(!$flagnuevoreportes){ echo $sbreg[departcodigo];}else{ echo
$departcodigo; } ?>"> 
<input type="hidden" name="accionnuevoreportes"> 
<input type="hidden" name="reportdate" value="<?echo date("Y-m-d");?>"> 
<!-- Campos que llevan la informacion de la consulta -->
<input type="hidden" name="total_tables" value=""> 
<input type="text" name="total_column" value=""> 
<input type="hidden" name="total_condic" value="">
<input type="hidden" name="total_orderb" value="">
<input type="hidden" name="total_tablro" value="0">
<input type="text" name="campos" value="">
<!--												 --> 
<input type="hidden" name="reportdate" value="<?php echo date("Y-m-d");?>"> 
<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
</form> 
</body> 
<?php 
if(!$codigo)
{ echo " -->"; }
?> 
</html> 
