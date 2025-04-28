<?php 
include ( '../src/FunGen/sesion/fncvalses.php');
include ( '../src/FunGen/fncvalses.php');
include( '../src/FunGen/fncvalidadevoluciitems.php');
$itemnombre = strtok($texto,"-");
$cantidad = strtok("-");
$itemnombre = strtok($texto,"-");
$cantidad = strtok("-");
$cantidad = trim($cantidad);
?>
<html> 
<head> 
<title>Devolver item</title> 
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
<meta http-equiv="expires" content="0"> 
<link rel="stylesheet" type="text/css" href="temas/Noise/Style.css"> 
<SCRIPT LANGUAGE="JavaScript"> 
<!-- Begin
agree = 0;
//  End -->
function add_record(lista, new_name, new_value)
{
	var dummy = new Array;
	var i=0;
	var doc = lista.ownerDocument;
	if (!doc)
	doc = lista.document;
	var opt = doc.createElement('OPTION');
	for(i=0;i<lista.length;i++)
	{
		if (lista.options[i].value == new_value)
			lista.options[i] = null;
	}
	opt.value = new_value;
	opt.text = new_name;
	lista.options.add(opt, i);
}

function retunResults(nuResult)
{
	if(nuResult==1)
	{
		var itemcodigo = window.document.form1.itemcodigo.value;
		var itemnombre = window.document.form1.itemnombre.value+'-'+window.document.form1.nuevacantidad.value;
		add_record(window.opener.document.form1.itemcodigo1,itemnombre,itemcodigo);
		window.opener.focus();
		window.close();
	}
}
</script>
<script language="JavaScript" src="motofech.js"></script>
<?php
if($acciondevolveritem)
{
	$nuResult=fncvalidadevoluciitems($cantidad,$nuevacantidad);
}
?>
</head>
<?php
if(!$codigo)
{ echo "<!--";}
?> 
<body onload="
retunResults(window.document.form1.nuResult.value);
this.focus();
window.document.form1.nuevacantidad.focus();" bgcolor="FFFFFF" text="#000000"> 
<form name="form1" method="post"  enctype="multipart/form-data"> 
<p><font class="NoiseFormHeaderFont">Reporte de orden de trabajo</font></p> 
<table border="0" cellspacing="1" cellpadding="2" align="center" 
class="NoiseFormTABLE"> 
  <tr> 
    <td class="NoiseErrorDataTD">&nbsp;</td> 
  </tr> 
  <tr> 
          <td class="NoiseFieldCaptionTD"><span class="style5"><font 
color="FFFFFF"> 
Devolver item</font></span></td></tr> 
<tr> 
  <td> 
            <table width="85%" border="0" cellspacing="0" cellpadding="3" 
align="center"> 
<tr> 
 <td width="41%">C&oacute;digo</td> 
  <td width="59%">
   <input type="text" name="itemcodigo" value="<?php echo $itemcodigo?>" onFocus="if (!agree)this.blur();" > 
  </td> 
 </tr> 
<tr> 
 <td width="41%">Nombre</td>
  <td width="59%"> 
   <input type="text" name="itemnombre" value="<?php echo $itemnombre?>" onFocus="if (!agree)this.blur();">
  </td>
 </tr>
<tr> 
 <td width="41%">Cantidad</td>
  <td width="59%"> 
   <input type="text" name="cantidad" value="<?php echo $cantidad; ?>" onFocus="if (!agree)this.blur();" >
  </td> 
 </tr> 
<tr>
 <td width="41%">Cantidad a devolver</td>
  <td width="59%"> 
   <input type="text" name="nuevacantidad" value="<?php echo $nuevacantidad; ?>">
  </td> 
 </tr> 
<tr>
  <td>&nbsp;</td>
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
<input type="hidden" name="nuResult" value="<?php echo $nuResult;?>">
<input type="image" value="Aceptar" name="aceptar"  src="../img/aceptar.gif" width="86" height="18" alt="Aceptar" 
border=0 onclick="form1.acciondevolveritem.value=1;">
  <input type="image" name="cancelar" src="../img/cancelar.gif" 
onclick="window.close();"  width="86" height="18" alt="Cancelar" border=0>
<img src="../img/ayuda.gif" border="0" alt="Ayuda">
</div> 
</td> 
 </tr> 
 <tr> 
  <td class="NoiseErrorDataTD">&nbsp;</td> 
 </tr> 
</table>
<input type="hidden" name="texto" value="<?php echo $texto;?>">
<input type="hidden" name="flagdetallarcargo" value="1"> 
<input type="hidden" name="acciondevolveritem"> 
<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
</form> 
</body> 
<?php 
if(!$codigo)
{ echo " -->"; }
?> 
</html>