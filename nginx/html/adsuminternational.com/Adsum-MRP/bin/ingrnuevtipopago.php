<?php 
include ( '../src/FunGen/sesion/fncvalses.php'); 
?> 
<html> 
<head> 
<title>Nuevo registro de Inserte nombre</title> 
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
<meta http-equiv="expires" content="0"> 
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
<body bgcolor="#FFFFFF" text="#000000" leftmargin="50" topmargin="20" 
marginwidth="0" marginheight="0"> 
<form name="form1" method="post"  enctype="multipart/form-data"> 
<table width="500" border="1" cellspacing="0" cellpadding="15" 
bordercolor="#009933" align="center"> 
  <tr> 
    <td> 
      <table width="100%" border="0" cellspacing="0" cellpadding="5" 
align="center"> 
        <tr> 
          <td colspan="2"><font face="Arial, Helvetica, sans-serif" 
size="3"><b><font color="#006699">Ingresar tipos de pago </font></b></font></td> 
        </tr> 
        <tr> 
          <td colspan="2" background="../img/panel.gif"><font 
color="669999"><b><font size="3" face="Arial, Helvetica, sans-serif"> 
<font color="#006699">&nbsp;</font></font></b></font></td> 
</tr> 
<tr> 
<td colspan="2"> 
            <table width="85%" border="0" cellspacing="0" cellpadding="0" 
align="center"> 
<tr> 
 <td width="41%"><font size="2" face="Arial, Helvetica, sans-serif">Nombre</font></td> 
  <td width="59%"> 
   <input type="text" name="tippagnombre"	value="<?php if(!$flagnuevotipopago){ 
echo $sbreg[tippagnombre];}else{ echo $tippagnombre;} ?>"> 
  </td> 
 </tr> 
<tr> 
 <td width="41%"><font size="2" face="Arial, Helvetica, sans-serif">Comisi&oacute;n (%) </font></td> 
  <td width="59%"> 
   <input type="text" name="tippagcomisi"	value="<?php if(!$flagnuevotipopago){ 
echo $sbreg[tippagcomisi];}else{ echo $tippagcomisi;} ?>"> 
  </td> 
 </tr> 
<tr> 
 <td width="41%"><font size="2" face="Arial, Helvetica, sans-serif">C&oacute;digo SIIGO </font></td> 
 <td width="59%"> 
  <input type="text" name="tippagcodigos"	value="<?php if(!$flagnuevotipopago){ 
echo $sbreg[tippagcodigos];}else{ echo $tippagcodigos;} ?>"> 
 </td> 
 </tr> 
<tr> 
 <td width="41%"><font size="2" face="Arial, Helvetica, sans-serif">Cuenta bancaria </font></td> 
 <td width="59%"> 
  <input type="text" name="tippagcuebans"	value="<?php if(!$flagnuevotipopago){ 
echo $sbreg[tippagcuebans];}else{ echo $tippagcuebans;} ?>"> 
 </td> 
 </tr> 
<tr> 
 <td width="41%"><font size="2" face="Arial, Helvetica, sans-serif">Cuenta de gastos </font></td> 
 <td width="59%"> 
  <input type="text" name="tippagcuegast"	value="<?php if(!$flagnuevotipopago){ 
echo $sbreg[tippagcuegast];}else{ echo $tippagcuegast;} ?>"> 
 </td> 
 </tr> 
<tr> 
 <td width="41%"><font size="2" face="Arial, Helvetica, sans-serif">Descripci&oacute;n</font></td> 
 <td width="59%" rowspan="2"> 
  <textarea name="tippagdescri" cols="24" wrap="VIRTUAL" rows="3"><?php 
if(!$flagnuevotipopago){echo $sbreg[tippagdescri];}else{ echo $tippagdescri;} 
?></textarea> 
 </td> 
 </tr>
<tr>
  <td>&nbsp;</td>
</tr> 
 <tr> 
  <td width="41%">&nbsp;</td> 
 </tr> 
</table> 
  </td> 
 </tr> 
 <tr> 
  <td colspan="2"><div align="center"><input type="image" name="aceptar"  
src="../img/aceptar.gif" onclick="form1.accionnuevotipopago.value =  1; 
form1.action='maestabltipopago.php';"  width="86" height="18" 
alt="Aceptar" border=0> 
  <input type="image" name="cancelar" src="../img/cancelar.gif" 
onclick="form1.action='maestabltipopago.php';"  width="86" height="18" 
alt="Cancelar" border=0></div></td> 
 </tr> 
 <tr> 
  <td background="../img/panel2.gif" width="57%">&nbsp;</td> 
  <td background="../img/panel5.gif" width="43%"> 
   <div align="left"></div> 
  </td> 
 </tr> 
</table> 
  </td> 
 </tr> 
</table> 
 <input type="hidden" name="tippagcodigo" value="<?php if(!$flagnuevotipopago){ 
echo $sbreg[tippagcodigo];}else{ echo $tippagcodigo; } ?>" onFocus="if 
(!agree)this.blur();" >
 <input type="hidden" name="flagnuevotipopago" value="1"> 
<input type="hidden" name="accionnuevotipopago"> 
<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
<input type="hidden" name="nuevo" value="<?php echo $nuevo; ?>"> 
<input type="hidden" name="borrar" value="<?php echo $borrar; ?>"> 
<input type="hidden" name="consultar" value="<?php echo $consultar; ?>"> 
<input type="hidden" name="detallar" value="<?php echo $detallar; ?>"> 
<input type="hidden" name="modificar" value="<?php echo $modificar; ?>"> 
</form> 
</body> 
<?php 
    if(!$codigo) 
    { echo " -->"; } 
?> 
</html> 
