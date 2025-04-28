<?php 
include ( '../src/FunGen/sesion/fncvalses.php'); 
include ( '../src/FunPerPriNiv/pktbldepartamento.php');
include ( '../src/FunPerPriNiv/pktblmunicipio.php');
if(!$flagborrarcliente) 
{ 
include ( '../src/FunGen/sesion/fnccarga.php'); 
$sbreg = fnccarga($nombtabl,$radiobutton); 
if (!$sbreg) 
	{ 
		include( '../src/FunGen/fnccontfron.php'); 
	} 
} 
?> 
<!-- Propiedad intelectual de Adsum SA (c) 
-Todos los derechos reservados- 
Creado con WAG Adsum 
Autor: Andrés A. Riascos D. 
Fecha: 26052004 
GenVers: 3.1 --> 
<html> 
<head> 
<title>Borrar registro de cliente</title> 
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
<p><font class="NoiseFormHeaderFont">Cliente</font></p> 
<table border="0" cellspacing="1" cellpadding="2" align="center" 
class="NoiseFormTABLE"> 
  <tr> 
    <td class="NoiseErrorDataTD">&nbsp;</td> 
  </tr> 
  <tr> 
          <td class="NoiseFieldCaptionTD"><span class="style5"><font 
color="FFFFFF"> 
Borrar registro</font></span></td></tr> 
<tr> 
  <td> 
            <table width="85%" border="0" cellspacing="0" cellpadding="3" 
align="center"> 
<tr> 
 <td width="18%">C&oacute;digo</td> 
 <td width="35%"> 
  <input type="text" name="clientcodigo" value="<?php if(!$flagborrarcliente){ 
echo $sbreg[clientcodigo];}else{ echo $clientcodigo; } ?>" onFocus="if 
(!agree)this.blur();" > 
 </td> 
 <td width="18%">Nombre</td> 
 <td width="29%"> 
  <input type="text" name="clientnombre" value="<?php if(!$flagborrarcliente){ 
echo $sbreg[clientnombre];}else{ echo $clientnombre; } ?>" onFocus="if 
(!agree)this.blur();" > 
 </td> 
</tr>
<tr>
 <td width="18%">Primer apellido</td> 
 <td width="35%"> 
  <input type="text" name="clientpriape" value="<?php if(!$flagborrarcliente){ 
echo $sbreg[clientpriape];}else{ echo $clientpriape; } ?>" onFocus="if 
(!agree)this.blur();" > 
 </td> 
 <td width="18%">Segundo apellido</td> 
 <td width="29%"> 
  <input type="text" name="clientsegape" value="<?php if(!$flagborrarcliente){ 
echo $sbreg[clientsegape];}else{ echo $clientsegape; } ?>" onFocus="if 
(!agree)this.blur();" > 
 </td> 
</tr>
<tr>
 <td width="18%">Departamento</td> 
 <td width="35%"> 
  <input type="text" name="departcodigo" value="<?php if(!$flagborrardepartamento)
{
	$idcon = fncconn();
	$sbregnombdepartamento=loadrecorddepartamento($sbreg[departcodigo],$idcon);
	echo $sbregnombdepartamento[departnombre];
	fncclose($idcon);
}else{ echo $departcocodigo;}
?>"
onFocus="if(!agree)this.blur();" >
 </td> 
 <td width="18%">Municipio</td> 
 <td width="29%"> 
  <input type="text" name="municicodigo" value="<?php if(!$flagborrarcliente)
{
	$idcon = fncconn();
	$sbregnombmunicipio=loadrecordmunicipio($sbreg[municicodigo],$idcon);
	echo $sbregnombmunicipio[municinombre];
	fncclose($idcon);
}else{ echo $municicocodigo;}
?>"
onFocus="if(!agree)this.blur();" >
 </td> 
 </tr> 
<tr> 
 <td width="18%">Nombre de la compañia</td> 
 <td width="35%"> 
  <input type="text" name="clicomnombre" value="<?php if(!$flagborrarcliente){ 
echo $sbreg[clicomnombre];}else{ echo $clicomnombre; } ?>" onFocus="if 
(!agree)this.blur();" > 
 </td> 
 <td width="18%">Direcci&oacute;n</td> 
 <td width="29%"> 
  <textarea cols="24" rows="3" name="clientdirecc"><?php if(!$flagborrarcliente){ 
echo $sbreg[clientdirecc];}else{ echo $clientdirecc; } ?></textarea> 
 </td> 
 </tr> 
<tr> 
 <td width="18%">Provincia</td> 
 <td width="35%"> 
  <input type="text" name="clientprovin" value="<?php if(!$flagborrarcliente){ 
echo $sbreg[clientprovin];}else{ echo $clientprovin; } ?>" onFocus="if 
(!agree)this.blur();" > 
 </td> 
 <td width="18%">Tel&eacute;fono de d&iacute;a</td> 
 <td width="29%"> 
<?php
if(!$flagborrarcliente)
{
 $clienttelef1 = $sbreg['clienttelef1'];
}
$codigoareadia = strtok($clienttelef1,"-");
$prefijodia = strtok("-");
$sufijodia = strtok("-");
$extdia = strtok("-");
?>
  (<input type="text" name="codigoareadia" size="3" maxlength="3"  onFocus="if (!agree)this.blur();"
value="<?php if(!$flagborrarcliente){ echo $codigoareadia;}else{ echo $codigoareadia; }?>">)-
<input type="text" name="prefijodia" size="3" maxlength="3"  onFocus="if (!agree)this.blur();" 
value="<?php if(!$flagborrarcliente){ echo $prefijodia;}else{ echo $prefijodia; }?>">-
<input type="text" name="sufijodia" size="4" maxlength="4"  onFocus="if (!agree)this.blur();"
value="<?php if(!$flagborrarcliente){ echo $sufijodia;}else{ echo $sufijodia; }?>">-
 Ext. <input type="text" name="extdia"	size="3"  onFocus="if (!agree)this.blur();"
value="<?php if(!$flagborrarcliente){ echo $extdia;}else{ echo $extdia; }?>"> 
 </td> 
 </tr> 
<tr> 
 <td width="18%">Tel&eacute;fono de noche</td> 
 <td width="35%"> 
<?php
if(!$flagborrarcliente)
{
 $clienttelef2 = $sbreg['clienttelef2'];
}
$codigoareanoche = strtok($clienttelef2,"-");
$prefijonoche = strtok("-");
$sufijonoche = strtok("-");
$extnoche = strtok("-");
?>
  (<input type="text" name="codigoareanoche" size="3" maxlength="3" 
onFocus="if (!agree)this.blur();" value="<?php if(!$flagborrarcliente){ echo 
$codigoareanoche;}else{ echo $codigoareanoche; }?>">)-
<input type="text" name="prefijonoche" size="3" maxlength="3"  onFocus="if (!agree)this.blur();" 
value="<?php if(!$flagborrarcliente){ echo $prefijonoche;}else{ echo $prefijonoche; }?>">-
<input type="text" name="sufijonoche" size="4" maxlength="4"  onFocus="if (!agree)this.blur();"
value="<?php if(!$flagborrarcliente){ echo $sufijonoche;}else{ echo $sufijonoche; }?>">-
 Ext. <input type="text" name="extnoche" size="3" onFocus="if (!agree)this.blur();" 
value="<?php if(!$flagborrarcliente){ echo $extnoche;}else{ echo $extnoche; }?>"> 
 </td> 
 <td width="18%">Correo electr&oacute;nico</td> 
 <td width="29%"> 
  <textarea cols="24" rows="3" name="clientemail" onFocus="if (!agree)this.blur();"><?php 
if(!$flagborrarcliente){ echo $sbreg[clientemail];}else{ echo $clientemail; } ?></textarea> 
 </td> 
 </tr>
   <tr>
 <td width="21%">
 Inscrito al cat&aacute;logo</td> 
 <td width="35%">
  <input type="radio" name="clientcata"	<?php if ($sbreg[clientcata] == 't') echo 'checked'; else echo 'disabled';?>>Sí
 <input type="radio" name="clientcata" <?php if ($sbreg[clientcata] == 'f') echo 'checked'; else echo 'disabled';?>>No
 </td>
 </tr> 
 <tr> 
  <td width="18%">&nbsp;</td> 
 </tr> 
</table> 
  </td> 
 </tr> 
 <tr> 
<td> 
<div align="center"> 
  <input type="image" name="aceptar"  src="../img/aceptar.gif" 
onclick="form1.accionborrarcliente.value =  1; 
form1.action='maestablcliente.php';"  width="86" height="18" alt="Aceptar" 
border=0> 
  <input type="image" name="cancelar" src="../img/cancelar.gif" 
onclick="form1.action='maestablcliente.php';"  width="86" height="18" 
alt="Cancelar" border=0> 
<a href= "javascript:;"><input type="image" name="cancelar2" src="../img/ayuda.gif" width="86" height="18" alt="Cancelar" border=0> </a>
</div> 
</td> 
 </tr> 
 <tr> 
  <td class="NoiseErrorDataTD">&nbsp;</td> 
 </tr> 
</table> 
 <input type="hidden" name="flagborrarcliente" value="1"> 
<input type="hidden" name="accionborrarcliente"> 
<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
<input type="hidden" name="clientpass" value="<?php if(!$flagborrarcliente){ 
echo $sbreg[clientpass];}else{ echo $clientpass; } ?>" onFocus="if 
(!agree)this.blur();" > 
</form> 
</body> 
<?php 
    if(!$codigo) 
    { echo " -->"; } 
?> 
</html> 
