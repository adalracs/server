<?php 
include ('../src/FunGen/sesion/fncvalses.php'); 
if($accionnuevotipodocume) { 
	include ( 'grabatipodocume.php'); 
} 
?> 
<!-- Propiedad intelectual de Adsum SAS (c) 
-Todos los derechos reservados- 
Creado con WAG Adsum 
Autor: Andrés A. Riascos D. 
Fecha: 20120110 
GenVers: 4.8 --> 
<!doctype html> 
<html> 
<head> 
<title>Nuevo registro de tipodocume</title> 
<meta http-equiv="Content-Type" content="text/html; charset=UTF8"> 
<meta http-equiv="expires" content="0"> 
<meta http-equiv="X-UA-Compatible" content="IE=9"> 
<?php 
include ('../def/jquery.library_maestro.php'); 
?> 
</head> 
<?php 
if (! $codigo) { 
    echo "<!--"; 
} 
?> 
<body bgcolor="FFFFFF" text="#000000"> 
<form name="form1" method="post" enctype="multipart/form-data"> 
<p><font class="NoiseFormHeaderFont">Tipo de documento</font></p> 
<table border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content" width="60%"> 
	<tr> 
		<td class="NoiseErrorDataTD">&nbsp;</td> 
	</tr> 
	<tr> 
		<td class="ui-widget-header">Ingresar nuevo registro</td></tr> 
	<tr> 
		<td> 
		<table width="95%" border="0" cellspacing="1" cellpadding="1" align="center"> 
			<tr> 
				<td width="41%" class="NoiseFooterTD"> 
				<?php if ($campnomb == "tipdocnombre") { $tipdocnombre = null; echo "*";}?>Nombre</td> 
				<td width="59%"> 
				<input type="text" name="tipdocnombre"	value="<?php if(!$flagnuevotipodocume){ echo $sbreg[tipdocnombre];}else{ echo $tipdocnombre; }?>"> 
				</td> 
			</tr> 
			<tr> 
				<td width="41%" class="NoiseFooterTD"> 
				<?php if ($campnomb == "tipdocdescri") { $tipdocdescri = null; echo "*";}?>Descripci&oacute;n</td> 
				<td width="59%"> 
				<input type="text" name="tipdocdescri"	value="<?php if(!$flagnuevotipodocume){ echo $sbreg[tipdocdescri];}else{ echo $tipdocdescri; }?>"> 
				</td> 
			</tr> 
		</table> 
		</td> 
	</tr> 
	<tr> 
		<td class="NoiseErrorDataTD" align="center"><?php 
		include '../def/jquery.button_form.php'; 
		?></td> 
	</tr> 
	<tr> 
		<td class="NoiseErrorDataTD">&nbsp;</td> 
	</tr> 
</table> 
<?php 
if($campnomb){echo '<font face = "Verdana" >Corregir los capos marcados con *</font>';} 
?> 
<input type="hidden" name="tipdoccodigo" value="<?php if(!$flagnuevotipodocume){ echo $sbreg[tipdoccodigo];}else{ echo $tipdoccodigo; } ?>"> 
<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>"> 
<input type="hidden" name="sourceaction" value="nuevo"> 
<input type="hidden" name="accionnuevotipodocume"> 
<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
</form> 
</body> 
<?php 
if (! $codigo) { 
    echo " -->"; 
} 
?> 
</html> 
