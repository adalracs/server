<?php
include ( '../src/FunGen/sesion/fncvalses.php');
if(!$flagborrargrupo)
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
<title>Borrar registro de Grupo</title> 
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
<meta http-equiv="expires" content="0"> 
<link rel="stylesheet" type="text/css" href="temas/Noise/Style.css">
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
<p><font class="NoiseFormHeaderFont">Borrar grupo</font></p>
<table border="0" cellspacing="1" cellpadding="2" align="center" class="NoiseFormTABLE">
  <tr> 
    <td width="414" height="153"> 
        <table width="100%" border="0" cellspacing="0" cellpadding="5" 
align="center">
          
    <tr>
      <td colspan="2" class="NoiseFieldCaptionTD"><span class="style5"><font color="#FFFFFF">Borrar grupo</font></span></td>
    </tr>
          <tr> 
            <td colspan="2"> 
              <table width="71%" border="0" cellspacing="0" cellpadding="3" 
align="center">
                <tr> 
                  <td width="59%">
                    <input type="hidden" name="grupcodi" value="<?php
if(!$flagborrargrupo){ echo $sbreg[grupcodi];}else{ echo $grupcodi; } ?>" 
onFocus="if (!agree)this.blur();" >
                  </td>
                </tr>
                <tr> 
                  <td width="41%"><div align="center"><font size="2" face="Arial, Helvetica, 
sans-serif">Nombre</font></div></td>
                  <td width="59%"> 
                    <input type="text" name="grupnomb" value="<?php 
if(!$flagborrargrupo){ echo $sbreg[grupnomb];}else{ echo $grupnomb;} ?>" 
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
onclick="form1.accionborrargrupo.value =  1;form1.action='maestablgrupo.php';"  width="86" 
height="18" alt="Aceptar" border=0>
                <input type="image" name="cancelar"  
src="../img/cancelar.gif" 
onclick="form1.action='maestablgrupo.php';submit();"  width="86" height="18" 
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
        </table>      </td> 
  </tr> 
</table> 
<input type="hidden" name="flagborrargrupo" value="1"> 
<input type="hidden" name="accionborrargrupo"> 
<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
</form>
</body> 
<?php 
if(!$codigo)
{ echo " -->"; }
?> 
</html> 
