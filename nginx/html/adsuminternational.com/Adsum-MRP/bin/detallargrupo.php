<?php 
include ( '../src/FunGen/sesion/fncvalses.php');
if(!$flagdetallargrupo)
{
	include ( '../src/FunGen/sesion/fnccarga.php');
	$sbreg = fnccarga($nombtabl,$radiobutton);
	if (!$sbreg)
	{
		include( '../src/FunGen/fnccontfron.php');
	}
}
?> 
<!-- C�digo creado por:
Andr�s Riascos
Fecha: 12012002 -->
<html> 
<head> 
<title>Detalle de registro de Grupo</title> 
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
function foo(){ form1.acciondetallargrupo.value =  1; }
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
size="3"><b><font color="#006699">Grupos</font></b></font></td> 
        </tr> 
        <tr> 
          <td background="../img/panel.gif" width="57%"><font 
color="669999"><b><font size="3" face="Arial, Helvetica, sans-serif"> 
            <font color="#006699">Detalle del 
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
sans-serif">C�digo</font></td> 
                <td width="59%"> 
                  <input type="text" name="grupcodi" value="<?php 
if(!$flagdetallargrupo){ echo $sbreg[grupcodi];}else{ echo $grupcodi; } ?>" 
onFocus="if (!agree)this.blur();" > 
                </td> 
              </tr> 
               <tr> 
                <td width="41%"><font size="2" face="Arial, Helvetica, 
sans-serif">Nombre</font></td> 
                <td width="59%"> 
                  <input type="text" name="grupnomb" value="<?php 
if(!$flagdetallargrupo){ echo $sbreg[grupnomb];}else{ echo $grupnomb;} ?>" 
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
onclick="form1.action='maestablgrupo.php';submit();"  width="86" height="18" 
alt="Aceptar" border=0>
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
<input type="hidden" name="flagdetallargrupo" value="1"> 
<input type="hidden" name="acciondetallargrupo"> 
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
