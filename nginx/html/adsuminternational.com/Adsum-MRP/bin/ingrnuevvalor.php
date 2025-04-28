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
size="3"><b><font color="#006699">Listado de valores </font></b></font></td> 
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
 <td width="41%"><font size="2" face="Arial, Helvetica, sans-serif">Valor</font></td> 
 <td width="59%"> 
  <input type="text" name="valorvalor"	value="<?php if(!$flagnuevovalor){ echo 
$sbreg[valorvalor];}else{ echo $valorvalor;} ?>"> 
 </td> 
 </tr> 
 <tr> 
  <td width="41%">&nbsp;</td> 
 </tr> 
</table> 
  </td> 
 </tr> 
 <tr> 
  <td colspan="2"><div align="center"><input type="image" name="aceptar"  
src="../img/aceptar.gif" onclick="form1.accionnuevovalor.value =  1; 
form1.action='maestablvalor.php';"  width="86" height="18" 
alt="Aceptar" border=0> 
  <input type="image" name="cancelar" src="../img/cancelar.gif" 
onclick="form1.action='maestablvalor.php';submit();"  width="86" height="18" 
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
 <input type="hidden" name="valorcodigo" value="<?php if(!$flagnuevovalor){ echo 
$sbreg[valorcodigo];}else{ echo $valorcodigo; } ?>" onFocus="if 
(!agree)this.blur();" >
 <input type="hidden" name="flagnuevovalor" value="1"> 
<input type="hidden" name="accionnuevovalor"> 
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
