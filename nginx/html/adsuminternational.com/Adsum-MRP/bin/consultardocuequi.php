<?php 
include ( '../src/FunGen/sesion/fncvalses.php'); 
include ( '../src/FunPerPriNiv/pktblplano.php');
include ( '../src/FunPerPriNiv/pktblmanual.php');
if(!$flagconsultardocuequi)
	$equipocodigo = null;
?> 
<html> 
<head> 
<title>Consultar en docuequi</title> 
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
<meta http-equiv="expires" content="0"> 
<link rel="stylesheet" type="text/css" href="temas/Noise/Style.css"> 
<SCRIPT LANGUAGE="JavaScript"> 
<!-- Begin 
agree = 0; 
//  End --> 
</script> 
<script language="JavaScript" src="motofech.js"></script> 
</head> 
<?php 
    if(!$codigo) 
    { echo "<!--";} 
?> 
<body bgcolor="FFFFFF" text="#000000"> 
<form name="form1" method="post"  enctype="multipart/form-data"> 
<p><font class="NoiseFormHeaderFont">Documentaci&oacute;n por equipo</font></p> 
<table border="0" cellspacing="1" cellpadding="2" align="center" 
class="NoiseFormTABLE"> 
  <tr> 
    <td width="454" class="NoiseErrorDataTD">&nbsp;</td> 
  </tr> 
  <tr> 
          <td class="NoiseFieldCaptionTD"><span class="style5"><font 
color="FFFFFF"> 
Consultar registro</font></span></td></tr> 
<tr> 
  <td> 
            <table width="95%" border="0" cellspacing="0" cellpadding="0" 
align="center"> 
              <tr> 
 <td width="25%">C&oacute;digo</td> 
  <td width="25%"> 
   <input type="text" name="docequcodigo"	value="<?php 
if(!$flagconsultardocuequi){ echo $sbreg[docequcodigo];}else{ echo 
$docequcodigo;} ?>" size="14"> 
  </td> 
  <td colspan="2"></td>
  </tr>
<tr>
<td colspan="4"><hr></td>              
</tr>            
<tr> 
 <td width="25%">Equipo
<input name="radio1"  type="radio" onclick="window.open('consultarequipogen.php?codigo=<?php echo $codigo?>','equipogen','status=no,menubar=no,scrollbars=yes,resizable=yes,left=300,width=800,height=600');" width="86" height="18" alt="Cancelar" border=0 href="#" target="_parent"></td>
 <td>Cod.&nbsp;<input name="equipocodigo" type="text"	value="<?php if(!$flagnuevodocuequi){ 
echo $equipocodigo;} else {echo $equipocodigo;} ?>" size="8"></td>
 <td>Nombre</td>
 <td><input name="equiponombre" type="text"	value="<?php if(!$flagnuevodocuequi){ 
echo $equiponombre;} else {echo $equiponombre;} ?>" size="14" onFocus="if (!agree)this.blur();"> </td>
 </tr>
<tr>
<td colspan="4"><hr></td>              
</tr> 
<tr> 
 <td width="25%">Planos</td> 
  <td colspan="3"> 
   <select name="planocodigo">
                      <option value ="">Seleccione</option>
                       <?php
            include ('../src/FunGen/floadplano.php');
			$idcon = fncconn();
			floadplano($idcon); 
			fncclose($idcon);
                
?>
              </select>
  </td> 
   </tr>
<tr>
 <td width="25%">Manuales</td> 
  <td colspan="3"> 
   <select name="manualcodigo">
                      <option value ="">Seleccione</option>
                       <?php
            include ('../src/FunGen/floadmanual.php');
			$idcon = fncconn();
			floadmanual($idcon); 
			fncclose($idcon);
                
?>
              </select></td>
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
onclick="form1.accionconsultardocuequi.value =  1; 
form1.action='maestabldocuequi.php';"  width="86" height="18" alt="Aceptar" 
border=0> 
  <input type="image" name="cancelar" src="../img/cancelar.gif" 
onclick="form1.action='maestabldocuequi.php';"  width="86" height="18" 
alt="Cancelar" border=0> 
  </div> 
</td> 
 </tr> 
 <tr> 
  <td class="NoiseErrorDataTD">&nbsp;</td> 
 </tr> 
</table> 
 <input type="hidden" name="flagconsultardocuequi" value="1"> 
<input type="hidden" name="accionconsultardocuequi"> 
<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
<input type="hidden" name="columnas" value="docequcodigo, 
equipocodigo, 
planocodigo, 
manualcodigo 
"> 
<input type="hidden" name="nombtabl" value="docuequi"> 
</form> 
</body> 
<?php 
    if(!$codigo) 
    { echo " -->"; } 
?> 
</html> 
