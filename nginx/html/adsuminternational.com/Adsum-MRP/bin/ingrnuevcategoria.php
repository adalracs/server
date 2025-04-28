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
size="3"><b><font color="#006699">Ingresar Categoria</font></b></font></td>
        </tr>
          <tr>
            <td background="../img/panel.gif" width="57%">&nbsp;</td>
<td background="../img/panel4.gif" width="43%">&nbsp;</td>
</tr>
<tr>
<td colspan="2">
            <table width="71%" border="0" cellspacing="0" cellpadding="0"
align="center">
                <tr>
                  <td width="41%"><font size="2" face="Arial, Helvetica, sans-serif">Nombre</font></td>
                  <td width="59%"> <input type="text" name="categonombre"	value="<?php
if(!$flagnuevocategoria){ echo $sbreg[categonombre];}else{ echo
$categonombre;} ?>"> </td>
                </tr>
                <tr>
                  <td width="41%"><font size="2" face="Arial, Helvetica, sans-serif">Descripci&oacute;n</font></td>
                  <td width="59%" rowspan="2"> <textarea name="categodescri" cols="24" wrap="VIRTUAL" rows="3"><?php
if(!$flagnuevocategoria){echo $sbreg[categodescri];}else{ echo
$categodescri;} ?></textarea> </td>
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
  <td colspan="2"><div align="center">
        <input type="image" name="aceptar"  src="../img/aceptar.gif"
onclick="form1.accionnuevocategoria.value =  1 ; form1.action='maestablcategoria.php';"  width="86"
height="18" alt="Aceptar" border=0>
        <input type="image" name="cancelar" src="../img/cancelar.gif"
onclick="form1.action='maestablcategoria.php';submit();"  width="86"
height="18" alt="Cancelar" border=0>
  </div></td>
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
 <input type="hidden" name="flagnuevocategoria" value="1">
<input type="hidden" name="accionnuevocategoria">
<input type="hidden" name="codigo" value="<?php echo $codigo; ?>">
<input type="hidden" name="nuevo" value="<?php echo $nuevo; ?>">
<input type="hidden" name="borrar" value="<?php echo $borrar; ?>">
<input type="hidden" name="consultar" value="<?php echo $consultar; ?>">
<input type="hidden" name="detallar" value="<?php echo $detallar; ?>">
<input type="hidden" name="modificar" value="<?php echo $modificar; ?>">
  <input type="hidden" name="categocodigo" value="<?php if(!$flagnuevocategoria){
echo $sbreg[categocodigo];}else{ echo $categocodigo; } ?>" onFocus="if
(!agree)this.blur();" >
</form>
</body>
<?php
    if(!$codigo)
    { echo " -->"; }
?>
</html>
