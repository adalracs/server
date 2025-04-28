<?php 
   include ( '../src/FunGen/sesion/fncvalses.php'); 
if(!$flageditarcampo) 
{ 
	include ( '../src/FunGen/sesion/fnccarga.php'); 
	$sbreg = fnccarga($nombtabl,$radiobutton); 
} 
?> 
<html> 
<head> 
<title>Editar registro de Campo</title> 
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
	function foo(){ form1.accioneditarcampo.value =  1; } 
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
            <font color="#006699">Editar registro</font></font></b></font></td> 
          <td background="../img/panel4.gif" 
width="43%">&nbsp;</td> 
        </tr> 
        <tr> 
          <td colspan="2"> 
            <table width="71%" border="0" cellspacing="0" cellpadding="0" 
align="center"> 
              <tr> 
                <td width="41%"><font size="2" face="Arial, Helvetica, 
sans-serif">Codigo de la tabla</font></td> 
                <td width="59%"> 
                  <input type="text" name="tablcodi" value="<?php 
if(!$flageditarcampo){ echo $sbreg[tablcodi];}else{ echo $tablcodi; } ?>" 
onFocus="if (!agree)this.blur();" > 
                </td> 
              </tr> 
              <tr> 
                <td width="41%"><font size="2" face="Arial, Helvetica, 
sans-serif">Codigo del campo</font></td> 
                <td width="59%"> 
                  <input type="text" name="campcodi" value="<?php 
if(!$flageditarcampo){ echo $sbreg[campcodi];}else{ echo $campcodi; } ?>" 
onFocus="if (!agree)this.blur();" > 
                </td> 
              </tr> 
               <tr> 
                <td width="41%"><font size="2" face="Arial, Helvetica, 
sans-serif">Nombre del campo</font></td> 
                <td width="59%"> 
                  <input type="text" name="campnomb"	value="<?php 
if(!$flageditarcampo){ echo $sbreg[campnomb];}else{ echo $campnomb;} ?>"> 
                </td> 
              </tr> 
               <tr> 
                <td width="41%"><font size="2" face="Arial, Helvetica, 
sans-serif">Desc del campo</font></td> 
                <td width="59%"> 
                  <input type="text" name="campdesc"	value="<?php 
if(!$flageditarcampo){ echo $sbreg[campdesc];}else{ echo $campdesc;} ?>"> 
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
onclick="foo();form1.action='maestablcampo.php';submit();"  width="86" 
height="18" align="right" alt="Aceptar" border=0></td> 
          <td width="47%"><input type="image" name="cancelar"  
src="../imagenes/cancelar.gif" 
onclick="form1.action='maestablcampo.php';submit();"  width="86" height="18" 
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
<input type="hidden" name="flageditarcampo" value="1"> 
<input type="hidden" name="accioneditarcampo"> 
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
