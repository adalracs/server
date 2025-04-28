<?php 
include ( '../src/FunGen/sesion/fncvalses.php');
if(!$flagdetallarparametr)
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
<title>Detalle de registro de Parametro</title> 
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
function foo(){ form1.acciondetallarparametr.value =  1; }
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
size="3"><b><font color="#006699">Tablas 
            
b&aacute;sicas</font></b></font></td> 
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
sans-serif">Código</font></td> 
                <td width="59%"> 
                  <input type="text" name="moducodi" value="<?php 
if(!$flagdetallarparametr){ echo $sbreg[moducodi];}else{ echo $moducodi; } ?>" 
onFocus="if (!agree)this.blur();" > 
                </td> 
              </tr> 
              <tr> 
                <td width="41%"><font size="2" face="Arial, Helvetica, 
sans-serif">Código de Parametro</font></td> 
                <td width="59%"> 
                  <input type="text" name="paracodi" value="<?php 
if(!$flagdetallarparametr){ echo $sbreg[paracodi];}else{ echo $paracodi; } ?>" 
onFocus="if (!agree)this.blur();" > 
                </td> 
              </tr> 
               <tr> 
                <td width="41%"><font size="2" face="Arial, Helvetica, 
sans-serif">Descripción</font></td> 
                <td width="59%"> 
                  <input type="text" name="paradesc" value="<?php 
if(!$flagdetallarparametr){ echo $sbreg[paradesc];}else{ echo $paradesc;} ?>" 
onFocus="if (!agree)this.blur();" > 
                </td> 
              </tr> 
               <tr> 
                <td width="41%"><font size="2" face="Arial, Helvetica, 
sans-serif">Tipo</font></td> 
                <td width="59%"> 
                  <font size="2" face="Arial, Helvetica,sans-serif" >Si</font> 
                  <input type="radio" name="paratipa" value="1"> 
                  <font size="2" face="Arial, Helvetica,sans-serif">No</font> 
                  <input type="radio" name="paratipa" value="0"> 
                </td> 
              </tr> 
               <tr> 
                <td width="41%"><font size="2" face="Arial, Helvetica, 
sans-serif">Valor</font></td> 
                <td width="59%"> 
                  <input type="text" name="paravalo" value="<?php 
if(!$flagdetallarparametr){ echo $sbreg[paravalo];}else{ echo $paravalo;} ?>" 
onFocus="if (!agree)this.blur();" > 
                </td> 
              </tr> 
               <tr> 
                <td width="41%"><font size="2" face="Arial, Helvetica, 
sans-serif">Presición</font></td> 
                <td width="59%"> 
                  <input type="text" name="parapres" value="<?php 
if(!$flagdetallarparametr){ echo $sbreg[parapres];}else{ echo $parapres;} ?>" 
onFocus="if (!agree)this.blur();" > 
                </td> 
              </tr> 
              <tr> 
                <td width="41%">&nbsp;</td> 
              </tr> 
            </table> 
          </td> 
        </tr> 
        <tr> 
          <td width="53%"><input type="image" name="aceptar"  
src="../img/aceptar.gif" 
onclick="form1.action='maestablparametr.php';submit();"  width="86" height="18" 
align="right" alt="Aceptar" border=0></td> 
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
<input type="hidden" name="flagdetallarparametr" value="1"> 
<input type="hidden" name="acciondetallarparametr"> 
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
