<?php 
   include ( '../src/FunGen/sesion/fncvalses.php'); 
?> 
<html> 
<head> 
<title>Consultar en Sesion</title> 
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
	function foo(){ form1.accionconsultarsesion.value =  1; } 
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
            <font color="#006699">Consulta 
detallada</font></font></b></font></td> 
          <td background="../img/panel4.gif" 
width="43%">&nbsp;</td> 
        </tr> 
        <tr> 
          <td colspan="2"> 
            <table width="71%" border="0" cellspacing="0" cellpadding="0" 
align="center"> 
              <tr> 
                <td width="41%"><font size="2" face="Arial, Helvetica, 
sans-serif">C�digo Secuencial</font></td> 
                <td width="59%"> 
                  <input type="text" name="sesicose" value="<?php 
if(!$flagconsultarsesion){ echo $sbreg[sesicose];}else{ echo $sesicose; } ?>"> 
                </td> 
              </tr> 
              <tr> 
                <td width="41%"><font size="2" face="Arial, Helvetica, 
sans-serif">C�digo de Sesion</font></td> 
                <td width="59%"> 
                  <textarea name="sesicodi" cols="24" wrap="VIRTUAL" 
rows="3"><?php if($flagconsultarsesion){ echo $sesicodi; } ?></textarea> 
                </td> 
              </tr> 
               <tr> 
                <td width="41%"><font size="2" face="Arial, Helvetica, 
sans-serif">C�digo de Usuario</font></td> 
                <td width="59%"> 
                  <select name="usuacodi" onChange="submit();"></select> 
                </td> 
              </tr> 
               <tr> 
                <td width="41%"><font size="2" face="Arial, Helvetica, 
sans-serif">Fecha inicio</font></td> 
                <td width="59%"> 
                  <input type="text" value="<?php echo $sesifein; ?>" 
name="sesifein" onFocus="if (!agree)this.blur();" > 
                </td> 
                <td width="59%"> 
                 <a href="javascript:show_calendar('form1.sesifein');" 
onmouseover="window.status='Date Picker';return true;" 
onmouseout="window.status='';return true;"><img 
src="../img/boton.gif" width=87 height=19 border=0></a> 
                </td> 
              </tr> 
               <tr> 
                <td width="41%"><font size="2" face="Arial, Helvetica, 
sans-serif">Fecha de inicio</font></td> 
                <td width="59%"> 
                  <input type="text" value="<?php echo $sesifefi; ?>" 
name="sesifefi" onFocus="if (!agree)this.blur();" > 
                </td> 
                <td width="59%"> 
                 <a href="javascript:show_calendar('form1.sesifefi');" 
onmouseover="window.status='Date Picker';return true;" 
onmouseout="window.status='';return true;"><img 
src="/template/imagenes/boton.gif" width=87 height=19 border=0></a> 
                </td> 
              </tr> 
               <tr> 
                <td width="41%"><font size="2" face="Arial, Helvetica, 
sans-serif">Fecha ultima actividad</font></td> 
                <td width="59%"> 
                  <input type="text" value="<?php echo $sesifeua; ?>" 
name="sesifeua" onFocus="if (!agree)this.blur();" > 
                </td> 
                <td width="59%"> 
                 <a href="javascript:show_calendar('form1.sesifeua');" 
onmouseover="window.status='Date Picker';return true;" 
onmouseout="window.status='';return true;"><img 
src="../img/boton.gif" width=87 height=19 border=0></a> 
                </td> 
              </tr> 
               <tr> 
                <td width="41%"><font size="2" face="Arial, Helvetica, 
sans-serif">Activa</font></td> 
                <td width="59%"> 
                  <input type="text" name="sesiacti"	value="<?php 
if(!$flagconsultarsesion){ echo $sbreg[sesiacti];}else{ echo $sesiacti;} ?>"> 
                </td> 
              </tr> 
               <tr> 
                <td width="41%"><font size="2" face="Arial, Helvetica, 
sans-serif">Ip de maquina</font></td> 
                <td width="59%"> 
                  <input type="text" name="sesiip"	value="<?php 
if(!$flagconsultarsesion){ echo $sbreg[sesiip];}else{ echo $sesiip;} ?>"> 
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
onclick="foo();form1.action='maestablsesion.php';submit();"  width="86" 
height="18" align="right" alt="Aceptar" border=0></td> 
          <td width="47%"><input type="image" name="cancelar"  
src="../img/cancelar.gif" 
onclick="form1.action='maestablsesion.php';submit();"  width="86" height="18" 
alt="Cancelar" border=0></td> 
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
<input type="hidden" name="flagconsultarsesion" value="1"> 
<input type="hidden" name="accionconsultarsesion"> 
<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
<input type="hidden" name="nuevo" value="<?php echo $nuevo; ?>"> 
<input type="hidden" name="borrar" value="<?php echo $borrar; ?>"> 
<input type="hidden" name="consultar" value="<?php echo $consultar; ?>"> 
<input type="hidden" name="detallar" value="<?php echo $detallar; ?>"> 
<input type="hidden" name="modificar" value="<?php echo $modificar; ?>"> 
<input type="hidden" name="columnas" value="sesicose, 
sesicodi, 
usuacodi, 
sesifein, 
sesifefi, 
sesifeua, 
sesiacti, 
sesiip 
"> 
<input type="hidden" name="nombtabl" value="sesion"> 
</form> 
</body> 
<?php 
    if(!$codigo) 
    { echo " -->"; } 
?> 
</html> 
