<?php 
   include ( '../src/FunGen/sesion/fncvalses.php'); 
?> 
<!-- Código creado por:
Andrés Riascos
Fecha: 12012002 -->
<html> 
<head> 
<title>Consultar en Grupo</title> 
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
<meta http-equiv="expires" content="0"> 
<link rel="stylesheet" type="text/css" href="temas/Noise/Style.css">
<SCRIPT LANGUAGE="JavaScript"> 
<!-- Begin 
agree = 0; 
//  End --> 
</script> 
<script language="JavaScript" src="motofech.js"></script> 
<script language="JavaScript"> 
<!-- Begin 
	function foo(){ form1.accionconsultargrupo.value =  1; } 
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
<p><font class="NoiseFormHeaderFont">Consulta de grupo</font></p>
  <table border="0" cellspacing="1" cellpadding="2" align="center" class="NoiseFormTABLE">
  <tr> 
    <td width="414" height="153"> 
        <table width="100%" border="0" cellspacing="0" cellpadding="5" 
align="center">
          
    <tr>
      <td colspan="2" class="NoiseFieldCaptionTD"><span class="style5"><font color="#FFFFFF">Consultar grupo</font></span></td>
    </tr>
          <tr> 
            <td colspan="2"> 
              <table width="71%" border="0" cellspacing="0" cellpadding="0" 
align="center">
                <tr> 
                  <td width="41%"><div align="center"><font size="2" face="Arial, Helvetica, 
sans-serif">Nombre</font></td>
                  <td width="59%"> 
                    <input type="text" name="grupnomb"	value="<?php 
if(!$flagconsultargrupo){ echo $sbreg[grupnomb];}else{ echo $grupnomb;} ?>">
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
onclick="foo();form1.action='maestablgrupo.php';submit();"  width="86" 
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
        </table> 
      </td> 
  </tr> 
</table> 
<input type="hidden" name="grupcodi" value="<?php echo $sbreg[grupcodi]; ?>">
<input type="hidden" name="flagconsultargrupo" value="1"> 
<input type="hidden" name="accionconsultargrupo"> 
<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
<input type="hidden" name="columnas" value="grupcodi, 
grupnomb 
"> 
<input type="hidden" name="nombtabl" value="grupo"> 
</form> 
</body> 
<?php 
    if(!$codigo) 
    { echo " -->"; } 
?> 
</html> 
