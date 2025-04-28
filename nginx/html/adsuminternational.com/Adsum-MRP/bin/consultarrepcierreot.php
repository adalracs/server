<?php
session_start();
include('../src/FunPerSecNiv/fncconn.php');
include('../src/FunPerSecNiv/fncclose.php');
include('../src/FunPerSecNiv/fncfetch.php');
include('../src/FunPerSecNiv/fncnumreg.php');
include ( '../src/FunPerPriNiv/pktbltipomant.php');	
include ( '../src/FunPerPriNiv/pktblpriorida.php');	
include ( '../src/FunPerPriNiv/pktbltipotrab.php');	
include ( '../src/FunPerPriNiv/pktbltarea.php');	
$GLOBALS['usuaplanta']=$usuaplanta;
?> 
<!-- Propiedad intelectual de Adsum SA (c) 
-Todos los derechos reservados- 
Creado con WAG Adsum 
Autor: Andr�s A. Riascos D. 
Fecha: 26052004 
GenVers: 3.1 --> 
<html> 
<head> 
<title>Consultar en reporte de orden de trabajo</title> 
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
<p><font class="NoiseFormHeaderFont">Reporte de orden de trabajo</font></p> 
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
 <td width="41%">Orden de trabajo</td> 
 <td width="59%">
  <input type="text" name="ordtracodigo"	value="<?php 
if(!$flagconsultarreportot){ echo $sbreg[ordtracodigo];}else{ echo 
$ordtracodigo; }?>">
 </td>
  <td width="41%"><!-- Numero de reporte --></td> 
 <td width="59%"><!-- <input type="text" name="reportcodigo"	value="<?php 
if(!$flagconsultarreportot){ echo $sbreg[reportcodigo];}else{ echo 
$reportcodigo; }?>"> --></td>
 </tr>
 <tr>
 <td>&nbsp;</td>
 <td>&nbsp;</td>
 <td>&nbsp;</td>
 <!--<td width="41%"><?php /*if($campnomb == "reporttiedur"){$reporttiedur = null; 
echo "*";}*/?>Duraci&oacute;n</td>-->
 </tr>
<tr> 
 <td width="41%">Tipo de mantenimiento</td> 
 <td width="59%"> 
   <select name="tipmancodigo">
                      <option value ="">Seleccione</option>
                       <?php
            include ('../src/FunGen/floadtipomant.php');
			$idcon = fncconn();
			floadtipomant($sbreg['tipmancodigo'],$idcon); 
			fncclose($idcon);
                
?>
	</select>
 </td> 
 <td width="41%">Prioridad</td>
 <td width="59%"> 
   <select name="prioricodigo">
                      <option value ="">Seleccione</option>
                       <?php
            include ('../src/FunGen/floadpriorida.php');
			$idcon = fncconn();
			floadpriorida($sbreg['prioricodigo'],$idcon);
			fncclose($idcon);
                
?>
	</select>
 </td> 
 </tr> 
<tr> 
 <td width="41%">Tipo de trabajo</td> 
 <td width="59%"> 
   <select name="tiptracodigo">
                      <option value ="">Seleccione</option>
                       <?php
            include ('../src/FunGen/floadtipotrab.php');
			$idcon = fncconn();
			floadtipotrab($sbreg['tiptracodigo'],$idcon); 
			fncclose($idcon);
                
?>
	</select>
 </td> 
 <td width="41%">Tarea</td> 
 <td width="59%"> 
   <select name="tareacodigo">
                      <option value ="">Seleccione</option>
                       <?php
            include ('../src/FunGen/floadtarea.php');
			$idcon = fncconn();
			floadtarea($sbreg['tareacodigo'],$idcon); 
			fncclose($idcon);
                
?>
	</select>
 </td> 
 </tr> 
<tr> 
 <td width="41%">Fecha del reporte</td>
 	<td><input type="text" name="reportfecha" size="13" value="<?php if(!$flagconsultarreportot){ echo $sbreg[reportfecha];} else {echo $reportfecha;}?>" onFocus="if (!agree)this.blur();">
&nbsp;&nbsp;&nbsp;<img src="../img/cal.gif" border="0" onclick="window.open('formcalendario.php?calencodigo=reportfecha','cal1','status=no,menubar=no,scrollbars=yes,resizable=yes,left=600,width=200,height=210');"></td> 
 <td width="41%">Duraci&oacute;n</td>
 <td width="59%"> 
  <input type="text" name="reporttiedur"	value="<?php 
if(!$flagconsultarreportot){ echo $sbreg[reporttiedur];}else{ echo 
$reporttiedur; }?>"> 
 </td> 
 </tr> 
 <tr> 
 <td width="41%">Descripci&oacute;n</td> 
 <td width="59%"> 
  <textarea name="reportdescri"	cols="24" wrap="VIRTUAL" rows="3"><?php if(!$flagconsultarreportot){
echo $sbreg[reportdescri];}else{ echo $reportdescri; }?></textarea>
 </td> 
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
onclick="form1.accionconsultarreportot.value =  1;form1.action='maestablrepcierreot.php';" width="86" height="18" 
alt="Aceptar" border=0>
  <input type="image" name="cancelar" src="../img/cancelar.gif" 
onclick="window.close();"  width="86" height="18" 
alt="Cancelar" border=0> 
<img name="ayuda" src="../img/ayuda.gif" width="86" 
height="18" alt="Ayuda" border=0> 
</div> 
</td> 
 </tr> 
 <tr> 
  <td class="NoiseErrorDataTD">&nbsp;</td> 
 </tr> 
</table> 
<input type="hidden" name="flagconsultarreportot" value="1"> 
<input type="hidden" name="accionconsultarreportot"> 
<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
<input type="hidden" name="columnas" value="reportcodigo, 
ordtracodigo, 
tipmancodigo, 
prioricodigo, 
tiptracodigo, 
tareacodigo, 
reportfecha, 
reporttiedur 
"> 
<input type="hidden" name="nombtabl" value="reportot"> 
</form> 
</body> 
<?php 
    if(!$codigo) 
    { echo " -->"; } 
?> 
</html>