<?php 
   include ( '../src/FunGen/sesion/fncvalses.php'); 
if(!$flageditarmenucomp) 
{ 
	include ( '../src/FunGen/sesion/fnccarga.php'); 
	$sbreg = fnccarga($nombtabl,$radiobutton); 
} 
?> 
<!-- C�digo creado por:
Andr�s Riascos
Fecha: 11012002 -->
<html> 
<head> 
<title>Editar registro de Menu Comp</title> 
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
<meta http-equiv="expires" content="0"> 
<SCRIPT LANGUAGE="JavaScript"> 
<!-- Begin 
agree = 0; 
//  End --> 
</script> 
<script language="JavaScript" src="motofech.js"></script> 
<script language="JavaScript"> 
<!-- Begin 
	function foo(){ form1.accioneditarmenucomp.value =  1; } 
//  End --> 
</script> 
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
size="3"><b><font color="#006699">Componentes del men&uacute;</font></b></font></td>
          </tr>
          <tr> 
            <td background="../img/panel.gif" width="57%"><font 
color="669999"><b><font size="3" face="Arial, Helvetica, sans-serif"> <font color="#006699">Editar 
              registro</font></font></b></font></td>
            <td background="../img/panel4.gif" 
width="43%">&nbsp;</td>
          </tr>
          <tr> 
            <td colspan="2"> 
              <table width="71%" border="0" cellspacing="0" cellpadding="0" 
align="center">
                <tr> 
                  <td width="41%"><font size="2" face="Arial, Helvetica, 
sans-serif">c�digo</font></td>
                  <td width="59%"> 
                    <input type="text" name="mecocodi" value="<?php 
if(!$flageditarmenucomp){ echo $sbreg[mecocodi];}else{ echo $mecocodi; } ?>" 
onFocus="if (!agree)this.blur();" >
                  </td>
                </tr>
                <tr> 
                  <td width="41%"><font size="2" face="Arial, Helvetica, 
sans-serif">C�digo Padre</font></td>
                  <td width="59%"> 
                    <input type="text" name="mecocopa"	value="<?php 
if(!$flageditarmenucomp){ echo $sbreg[mecocopa];}else{ echo $mecocopa;} ?>">
                  </td>
                </tr>
                <tr> 
                  <td width="41%"><font size="2" face="Arial, Helvetica, 
sans-serif">Orden</font></td>
                  <td width="59%"> 
                    <input type="text" name="mecoorde"	value="<?php 
if(!$flageditarmenucomp){ echo $sbreg[mecoorde];}else{ echo $mecoorde;} ?>">
                  </td>
                </tr>
                <tr> 
                  <td width="41%"><font size="2" face="Arial, Helvetica, 
sans-serif">C�digo tipo de comp</font></td>
                  <td width="59%"> 
                    <input type="text" name="timecodi"    value="<?php if(!$flageditarmenucomp){ echo $sbreg[timecodi];}else{ echo $timecodi;} ?>">
                  </td>
                </tr>
                <tr> 
                  <td width="41%"><font size="2" face="Arial, Helvetica, 
sans-serif">Nombre</font></td>
                  <td width="59%"> 
                    <input type="text" name="meconomb"	value="<?php 
if(!$flageditarmenucomp){ echo $sbreg[meconomb];}else{ echo $meconomb;} ?>">
                  </td>
                </tr>
                <tr> 
                  <td width="41%"><font size="2" face="Arial, Helvetica, 
sans-serif">Ruta scrip</font></td>
                  <td width="59%" rowspan="2"> 
                    <textarea name="mecoscri" cols="24" wrap="VIRTUAL" 
rows="3"><?php if(!$flageditarmenucomp){echo $sbreg[mecoscri];}else{ echo 
$mecoscri;} ?></textarea>
                  </td>
                </tr>
                <tr> 
                  <td width="41%">&nbsp;</td>
                </tr>
                <tr> 
                  <td width="41%"><font size="2" face="Arial, Helvetica, 
sans-serif">Acceso rapido</font></td>
                  <td width="59%"> 
                    <input type="text" name="mecoacra"	value="<?php 
if(!$flageditarmenucomp){ echo $sbreg[mecoacra];}else{ echo $mecoacra;} ?>">
                  </td>
                </tr>
              </table>
            </td>
          </tr>
          <tr> 
            <td colspan="2"> 
              <div align="center">
                <input type="image" name="aceptar"  
src="../img/aceptar.gif" 
onclick="foo();form1.action='maestablmenucomp.php';submit();"  width="86" 
height="18" alt="Aceptar" border=0>
                <input type="image" name="cancelar"  
src="../img/cancelar.gif" 
onclick="form1.action='maestablmenucomp.php';submit();"  width="86" height="18" 
alt="Cancelar" border=0>
              </div>
            </td>
          </tr>
          <tr> 
            <td background="../img/panel2.gif" 
width="57%">&nbsp;</td>
            <td background="../img/panel5.gif" width="43%"> 
              <div align="left"></div>
            </td>
          </tr>
        </table> 
      </td> 
  </tr> 
</table> 
<input type="hidden" name="flageditarmenucomp" value="1"> 
<input type="hidden" name="accioneditarmenucomp"> 
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
