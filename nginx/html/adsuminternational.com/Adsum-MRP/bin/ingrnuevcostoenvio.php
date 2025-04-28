<?php 
ob_start();
include ( '../src/FunGen/sesion/fncvalses.php');
include ( '../src/FunPerPriNiv/pktblestado.php');
//include ( '../src/FunPerPriNiv/pktblgarantia.php');
if($accionnuevogarantia)
{
	include ( 'grabagarantia.php');
}
ob_end_flush();
?> 
<!-- Propiedad intelectual de Adsum SA (c) 
-Todos los derechos reservados- 
Creado con WAG Adsum 
Autor: Andrés A. Riascos D. 
Fecha: 26052004 
GenVers: 3.1 --> 
<html> 
<head> 
<title>Nuevo registro de garantia</title> 
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
<p><font class="NoiseFormHeaderFont">Garant&iacute;a</font></p> 
<table border="0" cellspacing="1" cellpadding="2" align="center" 
class="NoiseFormTABLE"> 
  <tr> 
    <td class="NoiseErrorDataTD">&nbsp;</td> 
  </tr> 
  <tr> 
          <td class="NoiseFieldCaptionTD"><span class="style5"><font 
color="FFFFFF"> 
Ingresar nuevo registro</font></span></td></tr> 
<tr> 
  <td> 
            <table width="85%" border="0" cellspacing="0" cellpadding="3" 
align="center"> 
<tr> 
  <td width="41%"><?php if($campnomb == "articucodigo"){$articucodigo = null; 
echo "*";}?>Art&iacute;culo</td>
 <td width="59%"> 
  <textarea name="articupadrenombre" cols="24" wrap="VIRTUAL" rows="3" onFocus="if(!agree)this.blur();" ><?php
if(!$flagnuevogarantia){ echo $sbreg[articupadrenombre];}else{ echo $articupadrenombre; }?></textarea>
<input type="Button" name="buscar" value="Buscar"
onclick="window.open('consultararticulo2.php?codigo=<?php echo $codigo?>','ventana1','status=no,menubar=no,scrollbars=yes,resizable=yes,left=300,width=600,height=600');">
 </td> 
 
 </tr> 
<tr> 
 <td width="41%"><?php if($campnomb == "garantnombre"){$garantnombre = null; 
echo "*";}?>Nombre</td> 
 <td width="59%"> 
  <textarea rows="3" cols="24" wrap="VIRTUAL" name="garantnombre"><?php if(!$flagnuevogarantia){ 
echo $sbreg[garantnombre];}else{ echo $garantnombre; }?></textarea> 
 </td> 
 </tr> 
<tr> 
 <td width="41%"><?php if($campnomb == "garantdescri"){$garantdescri = null; echo 
"*";}?>Descripción</td> 
 <td width="59%"> 
  <textarea cols="24" rows="3" wrap="VIRTUAL" name="garantdescri"><?php if(!$flagnuevogarantia){ 
echo $sbreg[garantdescri];}else{ echo $garantdescri; }?></textarea> 
 </td>
 </tr> 
<tr> 
 <td width="41%"><?php if($campnomb == "garantestado"){$garantestado = null; 
echo "*";}?>Estado</td> 
 <td width="59%"> 
  <select name="garantestado">
  <?php 
  if(!$flagnuevogarantia)
  {
  	echo '<option value="">Seleccione';
  	//  	echo $sbreg[garantestado];
  }
  else if($accionnuevogarantia)
  {
  	if($garantestado)
  	{
  		echo '<option value="'.$garantestado.'">';
  		if ($garantestado == 1) 
  			echo "POR DEFECTO";
  		elseif ($garantestado == 2)
  			echo "ADICIONAL";
  	}
  	else
  	{
  		echo '<option value="">Seleccione';
  	}
  }
  else
  {
  	echo $garantestado;
  }
?>
<option value="1">POR DEFECTO
<option value="2">ADICIONAL  
	</select>
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
onclick="form1.articucodigo.value=form1.articupadre.value;
form1.accionnuevogarantia.value =  1;"  width="86" height="18" 
alt="Aceptar" border=0> 
  <input type="image" name="cancelar" src="../img/cancelar.gif" 
onclick="form1.action='maestablgarantia.php';"  width="86" height="18" 
alt="Cancelar" border=0> 
<a href= "javascript:;"><input type="image" name="cancelar2" src="../img/ayuda.gif" width="86" height="18" alt="Ayuda" border=0></a> 
  </div> 
</td> 
 </tr> 
 <tr> 
  <td class="NoiseErrorDataTD">&nbsp;</td> 
 </tr> 
</table> 
<?php 
if($campnomb){echo '<font face = "Verdana" >Corregir los capos marcados con
*</font>';} 
?> 
<input type="hidden" name="garantcodigo" value="<?php if(!$flagnuevogarantia){ 
echo $sbreg[garantcodigo];}else{ echo $garantcodigo; } ?>">
<input type="hidden" name="accionnuevogarantia"> 
<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
<input type="hidden" name="articupadre" value="<?php if(!$flagnuevogarantia){ 
echo $sbreg[articupadre];}else{ echo $articupadre; }?>">
<input type="hidden" name="articucodigo" value="<?php if(!$flagnuevogarantia){ 
echo $sbreg[articupadre];}else{ echo $articupadre; }?>">
</form>
</body> 
<?php 
if(!$codigo)
{ echo " -->"; }
?> 
</html> 
