<?php
include ( '../src/FunGen/sesion/fncvalses.php');

if(!$flagborrarusuario)
{
	include ( '../src/FunGen/sesion/fnccarga.php');
	$sbreg = fnccarga($nombtabl,$radiobutton);
	if (!$sbreg)
	{
		include( '../src/FunGen/fnccontfron.php');
	}
}
?>
<!-- Código creado por:
Andrés Riascos
Fecha: 12012002 -->
<html>
<head>
<title>Actividad de Usuarios</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta http-equiv="expires" content="0">
<SCRIPT LANGUAGE="JavaScript">
<!-- Begin
agree = 0;  // 0 means 'no', 1 means 'yes'
//  End -->
</script>
<script language="JavaScript" src="motofech.js"></script>
<script language="JavaScript">
<!-- Begin
function foo(){ form1.accionborrarusuario.value =  1; }
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
size="3"><b><font color="#006699">Usuarios</font></b></font></td>
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
              <table width="71%" border="0" cellspacing="0" cellpadding="0"
align="center">
                <tr>
                  <td width="41%"><font size="2" face="Arial, Helvetica, 
sans-serif">Nombre</font></td>
                  <td width="59%"> 
                    <input type="text" name="usuanomb" value="<?php 
if(!$flagborrarusuario){ echo $sbreg[usuanomb];}else{ echo $usuanomb;} ?>" 
onFocus="if (!agree)this.blur();" >
                  </td>
                </tr>
                <tr>
                  <td width="41%"><font size="2" face="Arial, Helvetica,
sans-serif">Estado</font></td>
				 <td width="59%">
                  <input type="text" name="usuaact" value="<?php
if($sbreg[usuaacti]==1){ echo 'Activo';}else{ echo 'inactivo';} ?>"
onFocus="if (!agree)this.blur();" >
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
onclick="foo();form1.action='maestablusuario.php';submit();"  width="86" 
height="18" alt="Aceptar" border=0>
                <input type="image" name="cancelar"  
src="../img/cancelar.gif" 
onclick="form1.action='maestablusuario.php';submit();"  width="86" height="18" 
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
<input type="hidden" name="flagborrarusuario" value="1"> 
<input type="hidden" name="accionborrarusuario"> 
<input type="hidden" name="codigo" value="<?php echo $codigo; ?>">
</form>
</body>
<?php 
if(!$codigo)
{ echo " -->"; }
?> 
</html> 
