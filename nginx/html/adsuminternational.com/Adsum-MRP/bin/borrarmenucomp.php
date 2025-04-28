<?php 
   include ( '../src/FunGen/sesion/fncvalses.php'); 
if(!$flagborrarmenucomp) 
{ 
	include ( '../src/FunGen/sesion/fnccarga.php'); 
	$sbreg = fnccarga($nombtabl,$radiobutton); 
} 
?> 
<!-- Código creado por:
Andrés Riascos
Fecha: 12012002 -->
<html> 
<head> 
<title>Borrar registro de Menu Comp</title> 
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
	function foo(){ form1.accionborrarmenucomp.value =  1; } 
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
  <table width="75%" border="1" cellspacing="0" cellpadding="15" 
bordercolor="#009933" align="center">
    <tr> 
    <td> 
        <table width="100%" border="0" cellspacing="0" cellpadding="5" 
align="center">
          <tr> 
            <td colspan="2"><font face="Arial, Helvetica, sans-serif" 
size="3"><b><font color="#006699">Configuraci&oacute;n del men&uacute;</font></b></font></td>
          </tr>
          <tr> 
            <td background="../img/panel.gif" width="57%"><font 
color="669999"><b><font size="3" face="Arial, Helvetica, sans-serif"> <font color="#006699">Borrar 
              item</font></font></b></font></td>
            <td background="../img/panel4.gif" 
width="43%">&nbsp;</td>
          </tr>
          <tr> 
            <td colspan="2"> 
              <table width="83%" border="0" cellspacing="0" cellpadding="0" 
align="center">
                <tr> 
                  <td width="41%"><font size="2" face="Arial, Helvetica, 
sans-serif">código</font></td>
                  <td width="59%"> 
                    <input type="text" name="mecocodi" value="<?php 
if(!$flagborrarmenucomp){ echo $sbreg[mecocodi];}else{ echo $mecocodi; } ?>" 
onFocus="if (!agree)this.blur();" >
                  </td>
                </tr>
                <tr> 
                  <td width="41%"><font size="2" face="Arial, Helvetica, 
sans-serif">Código Padre</font></td>
                  <td width="59%"> 
                    <input type="text" name="mecocopa" value="<?php 
if(!$flagborrarmenucomp){ echo $sbreg[mecocopa];}else{ echo $mecocopa; } ?>" 
onFocus="if (!agree)this.blur();" >
                  </td>
                </tr>
                <tr> 
                  <td width="41%"><font size="2" face="Arial, Helvetica, 
sans-serif">Orden</font></td>
                  <td width="59%"> 
                    <input type="text" name="mecoorde" value="<?php 
if(!$flagborrarmenucomp){ echo $sbreg[mecoorde];}else{ echo $mecoorde; } ?>" 
onFocus="if (!agree)this.blur();" >
                  </td>
                </tr>
                <tr> 
                  <td width="41%"><font size="2" face="Arial, Helvetica, 
sans-serif">Código tipo componente</font></td>
                  <td width="59%"> 
                    <input type="text" name="timecodi" value="<?php 
if(!$flagborrarmenucomp){ echo $sbreg[timecodi];}else{ echo $timecodi;} ?>" 
onFocus="if (!agree)this.blur();" >
                  </td>
                </tr>
                <tr> 
                  <td width="41%"><font size="2" face="Arial, Helvetica, 
sans-serif">Nombre</font></td>
                  <td width="59%"> 
                    <input type="text" name="meconomb" value="<?php 
if(!$flagborrarmenucomp){ echo $sbreg[meconomb];}else{ echo $meconomb;} ?>" 
onFocus="if (!agree)this.blur();" >
                  </td>
                </tr>
                <tr> 
                  <td width="41%"><font size="2" face="Arial, Helvetica, 
sans-serif">Ruta scrip</font></td>
                  <td width="59%"> 
                    <input type="text" name="mecoscri" size="24" onFocus="if (!agree)this.blur();" value="<?php if(!$flagborrarmenucomp){ echo 
$sbreg[mecoscri];}else{ echo $mecoscri;} ?>">
                  </td>
                </tr>
                <tr> 
                  <td width="41%"><font size="2" face="Arial, Helvetica, 
sans-serif">Acceso rapido</font></td>
                  <td width="59%"> 
                    <input type="text" name="mecoacra" value="<?php 
if(!$flagborrarmenucomp){ echo $sbreg[mecoacra];}else{ echo $mecoacra;} ?>" 
onFocus="if (!agree)this.blur();" >
                  </td>
                </tr>
              </table>
            </td>
          </tr>
          <tr> 
            <td colspan="2">
              <div align="center"><input type="image" src="../img/aceptar.gif" 
onclick="foo();form1.action='maestablmenucomp.php';submit();"  width="86" 
height="18" alt="Aceptar" border=0><input type="image" src="../img/cancelar.gif" 
onclick="form1.action='maestablmenucomp.php';submit();"  width="86" height="18" 
alt="Cancelar" border=0></div>
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
<input type="hidden" name="flagborrarmenucomp" value="1"> 
<input type="hidden" name="mecocodi" value="<?php echo $sbreg[mecocodi]; ?>">
<input type="hidden" name="accionborrarmenucomp"> 
<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
</form> 
</body> 
<?php 
    if(!$codigo) 
    { echo " -->"; } 
?> 
</html> 
