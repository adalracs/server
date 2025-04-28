<?php 
include ( '../src/FunGen/sesion/fncvalses.php'); 
?> 
<!-- Propiedad intelectual de Adsum SA (c) 
-Todos los derechos reservados- 
Creado con WAG Adsum 
Autor: Andr�s A. Riascos D. 
Fecha: 26052004 
GenVers: 3.1 --> 
<html> 
<head> 
<title>Consultar en exammediusuario</title> 
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
<meta http-equiv="expires" content="0"> 
<link rel="stylesheet" type="text/css" href="temas/Noise/Style.css"> 
<SCRIPT LANGUAGE="JavaScript"> 
<!-- Begin 
agree = 0; 
//  End --> 
</script> 
</head> 
<?php 
    if(!$codigo) 
    { echo "<!--";} 
?> 
<body bgcolor="FFFFFF" text="#000000"> 
<form name="form1" method="post"  enctype="multipart/form-data"> 
<p><font class="NoiseFormHeaderFont">Ex&aacute;men M&eacute;dico</font></p> 
<table border="0" cellspacing="1" cellpadding="2" align="center" 
class="NoiseFormTABLE"> 
  <tr> 
    <td class="NoiseErrorDataTD">&nbsp;</td> 
  </tr> 
  <tr> 
          <td class="NoiseFieldCaptionTD"><span class="style5"><font 
color="FFFFFF"> 
Consultar registro</font></span></td></tr> 
<tr> 
  <td> 
            <table width="85%" border="0" cellspacing="0" cellpadding="3" 
align="center"> 
              <tr> 
                <td width="41%">C&oacute;digo</td> 
<td width="59%"> 
<input type="text" name="exmusucodigo" value="<?php 
if(!$flagconsultarexammediusuario){ echo $sbreg[exmusucodigo];}else{ echo 
$exmusucodigo; } ?>"> 
</td> 
</tr> 
<tr>
 <td width="50%"><?php if($campnomb == "examedcodigo"){$examedcodigo = null; $examednombre=null; echo 
"*";}?>Ex&aacute;men<input name="radio1"  type="radio" onclick="window.open('consultarexammediusuarioaux.php?codigo=<?php echo $codigo?>','ventana','status=no,menubar=no,scrollbars=yes,resizable=yes,left=300,width=800,height=600');" width="86" height="18" alt="Cancelar" border=0 href="#" target="_parent"></td> 
 <td width="25%">&nbsp;Cod. 
  <input type="text" name="examedcodigo" size="4" onfocus="if (!agree) this.blur();" value="<?php 
if(!$flagconsultarexammediusuario){ echo $sbreg[usuacodi];}else{ echo $usuacodigo; 
}?>"> 
 </td><td width="25%">Nombre&nbsp;<input name="examednombre" size="18" onfocus="if(!agree) this.blur();" type="text" size="13" value="<?php 
if(!$flagconsultarexammediusuario){ echo $tmp; }else{ echo $examednombre; 
}?>"></td>
 </tr>
 <tr><td colspan="3"><hr></td></tr> 
<tr>
 <td width="50%"><?php if($campnomb == "usuacodi"){$usuacodigo = null; $usuanombre=null; echo 
"*";}?>Empleado<input name="radio2"  type="radio" onclick="window.open('consultarusuaexammed.php?codigo=<?php echo $codigo?>','ventana','status=no,menubar=no,scrollbars=yes,resizable=yes,left=300,width=800,height=600');" width="86" height="18" alt="Cancelar" border=0 href="#" target="_parent"></td> 
 <td width="25%">&nbsp;Cod. 
  <input type="text" name="usuacodigo" size="4" onfocus="if (!agree) this.blur();" value="<?php 
if(!$flagconsultarexammediusuario){ echo $sbreg[usuacodi];}else{ echo $usuacodigo; 
}?>"> 
 </td><td width="25%">Nombre&nbsp;<input name="usuanombre" size="18" onfocus="if(!agree) this.blur();" type="text" size="13" value="<?php 
if(!$flagconsultarexammediusuario){ echo $tmp; }else{ echo $usuanombre; 
}?>"></td>
 </tr>
 <tr><td colspan="3"><hr></td></tr> 
<tr> 
 <td width="41%">Fecha</td> 
 <td width="59%"> 
  <input type="text" name="exmusupinifec" size="14" onfocus="if(!agree) this.blur();" value="<?php 
if(!$flagconsultarexammediusuario){ echo $sbreg[exmusupinifec];}else{ echo 
$exmusupinifec; }?>"><td colspan="2"><img src="../img/cal.gif" border="0" onclick="window.open('formcalendario.php?calencodigo=exmusupinifec','cal1','status=no,menubar=no,scrollbars=yes,resizable=yes,left=600,width=200,height=210');"></td> 
 </td> 
 </tr> 
 <tr> 
  <td width="41%">&nbsp;</td> 
 </tr> 
</table> 
  </td> 
 </tr> 
 <tr> 
<td> 
<div align="center"> 
  <input type="image" name="aceptar"  src="../img/aceptar.gif" 
onclick="form1.accionconsultarexammediusuario.value = 1;
form1.action='maestablexammediusuario.php';"  width="86" height="18" 
alt="Aceptar" border=0> 
  <input type="image" name="cancelar" src="../img/cancelar.gif" 
onclick="form1.action='maestablexammediusuario.php';"  width="86" height="18" 
alt="Cancelar" border=0> 
</div> 
</td> 
 </tr> 
 <tr> 
  <td class="NoiseErrorDataTD">&nbsp;</td> 
 </tr> 
</table> 
 <input type="hidden" name="flagconsultarexammediusuario" value="1"> 
<input type="hidden" name="accionconsultarexammediusuario"> 
<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
<input type="hidden" name="usuacodigo1" value=""> 
<input type="hidden" name="columnas" value="exmusucodigo, 
examedcodigo, 
usuacodi, 
exmusupinifec 
"> 
<input type="hidden" name="nombtabl" value="exammediusuario"> 
</form> 
</body> 
<?php 
    if(!$codigo) 
    { echo " -->"; } 
?> 
</html> 
