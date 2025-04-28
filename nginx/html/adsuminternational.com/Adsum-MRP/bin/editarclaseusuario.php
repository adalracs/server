<?php 
include ('../src/FunGen/sesion/fncvalses.php'); 
if ($accioneditarclaseusuario) { 
	include ('editaclaseusuario.php'); 
	$flageditarclaseusuario = 1; 
} 
if (! $flageditarclaseusuario) { 
	include ('../src/FunGen/sesion/fnccarga.php'); 
	$sbreg = fnccarga ( $nombtabl, $radiobutton ); 
	if (! $sbreg) { 
		include ('../src/FunGen/fnccontfron.php'); 
	} 
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
<title>Editar registro de claseusuario</title> 
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
<p><font class="NoiseFormHeaderFont">claseusuario</font></p> 
<table border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content" width="80%"> 
	<tr> 
		<td class="NoiseErrorDataTD">&nbsp;</td> 
	</tr> 
	<tr> 
		<td class="ui-widget-header">Editar registro</td></tr> 
	<tr> 
		<td> 
		<table width="95%" border="0" cellspacing="1" cellpadding="1" align="center"> 
				<td width="59%" class="NoiseDataTD"><?php 
				if (! $flageditarclaseusuario) { 
					echo $sbreg [clausucodigo]; 
				} 
				?></td> 
			<tr> 
				<td width="41%" class="NoiseFooterTD"> 
				<?php if ($campnomb == "clausucodigo") { $clausucodigo = null; echo "*";}?>clausucodigo</td> 
				<td width="59%"> 
				<input type="text" name="clausucodigo"	value="<?php if(!$flageditarclaseusuario){ echo $sbreg[clausucodigo];}else{ echo $clausucodigo; }?>"> 
				</td> 
			</tr> 
			<tr> 
				<td width="41%" class="NoiseFooterTD"> 
				<?php if ($campnomb == "clausunombre") { $clausunombre = null; echo "*";}?>clausunombre</td> 
				<td width="59%"> 
				<input type="text" name="clausunombre"	value="<?php if(!$flageditarclaseusuario){ echo $sbreg[clausunombre];}else{ echo $clausunombre; }?>"> 
				</td> 
			</tr> 
			<tr> 
				<td width="41%" class="NoiseFooterTD"> 
				<?php if ($campnomb == "clausudescri") { $clausudescri = null; echo "*";}?>clausudescri</td> 
				<td width="59%"> 
				<input type="text" name="clausudescri"	value="<?php if(!$flageditarclaseusuario){ echo $sbreg[clausudescri];}else{ echo $clausudescri; }?>"> 
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
		<td> 
</table> 
</div> 
</td> 
 </tr> 
 <tr> 
  <td class="NoiseErrorDataTD">&nbsp;</td> 
 </tr> 
</table> 
<?php 
if($campnomb){echo '<font face = "Verdana" >Corregir los capos marcados con *</font>';} 
?> 
<input type="hidden" name="clausucodigo" value="<?php if(!$flageditarclaseusuario){ echo $sbreg[clausucodigo];}else{ echo $clausucodigo; } ?>"> 
<input type="hidden" name="accioneditarclaseusuario"> 
<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
</form> 
</body> 
<?php 
if (! $codigo) { 
    echo " -->"; 
} 
?> 
</html> 
