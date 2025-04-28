<?php
include ( '../src/FunGen/sesion/fncvalses.php');
if(!$flageditarusuagrup)
{
	include ( '../src/FunGen/sesion/fnccarga.php');
	$sbreg = fnccarga($nombtabl,$radiobutton);
	if (!$sbreg)
	{
		include( '../src/FunGen/fnccontfron.php');
	}
}
?> 
<html> 
<head> 
<title>Editar registro de Usuario-Grupo</title> 
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
<meta http-equiv="expires" content="0"> 
<link rel="stylesheet" type="text/css" href="temas/Noise/Style.css"> 
<SCRIPT LANGUAGE="JavaScript"> 
<!-- Begin
agree = 0;  // 0 means 'no', 1 means 'yes'
//  End -->
</script> 
<script language="JavaScript" src="motofech.js"></script> 
<script language="JavaScript"> 
<!-- Begin
function foo(){ form1.accioneditarusuagrup.value =  1; }
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
  <table width="100%" border="0" cellspacing="0" cellpadding="5" 
align="center">
    <tr>
      <td><font face="Arial, Helvetica, sans-serif" 
size="3"><b><font color="#006699">Tablas b&aacute;sicas</font></b></font></td>
    </tr>
    <tr>
      <td><font 
color="669999"><b><font size="3" face="Arial, Helvetica, sans-serif"> <font color="#006699">Editar registro</font></font></b></font></td>
    </tr>
    <tr>
      <td>
        <table width="71%" border="0" cellspacing="0" cellpadding="0" 
align="center">
          <tr>
            <td width="41%"><font size="2" face="Arial, Helvetica, 
sans-serif">C&oacute;digo de grupo</font></td>
            <td width="59%">
              <input type="text" name="grupcodi" value="<?php 
if(!$flageditarusuagrup){ echo $sbreg[grupcodi];}else{ echo $grupcodi; } ?>" 
onFocus="if (!agree)this.blur();" >
            </td>
          </tr>
          <tr>
            <td width="41%"><font size="2" face="Arial, Helvetica, 
sans-serif">C&oacute;digo de Usuario</font></td>
            <td width="59%">
              <input type="text" name="usuacodi" value="<?php 
if(!$flageditarusuagrup){ echo $sbreg[usuacodi];}else{ echo $usuacodi; } ?>" 
onFocus="if (!agree)this.blur();" >
            </td>
          </tr>
          <tr>
            <td width="41%">&nbsp;</td>
          </tr>
      </table></td>
    </tr>
    <tr>
      <td><div align="center">
          <input type="image" name="aceptar"  
src="../img/aceptar.gif" 
onclick="foo();form1.action='maestablusuagrup.php';"  width="86" 
height="18" alt="Aceptar" border=0>        
          <input type="image" name="cancelar"  
src="../img/cancelar.gif" 
onclick="form1.action='maestablusuagrup.php';"  width="86" height="18" 
alt="Cancelar" border=0>
      </div></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
  </table>
  <input type="hidden" name="flageditarusuagrup" value="1"> 
<input type="hidden" name="accioneditarusuagrup"> 
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
