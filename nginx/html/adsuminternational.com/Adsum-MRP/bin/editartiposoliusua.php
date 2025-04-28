<?php 
include ('../src/FunGen/sesion/fncvalses.php'); 
if ($accioneditartiposoliusua) { 
	include ('editatiposoliusua.php'); 
	$flageditartiposoliusua = 1; 
} 
if (! $flageditartiposoliusua) { 
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
<title>Editar registro de tiposoliusua</title> 
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
<p><font class="NoiseFormHeaderFont">tiposoliusua</font></p> 
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
				if (! $flageditartiposoliusua) { 
					echo $sbreg [tisouscodigo]; 
				} 
				?></td> 
			<tr> 
				<td width="41%" class="NoiseFooterTD"> 
				<?php if ($campnomb == "tisouscodigo") { $tisouscodigo = null; echo "*";}?>tisouscodigo</td> 
				<td width="59%"> 
				<input type="text" name="tisouscodigo"	value="<?php if(!$flageditartiposoliusua){ echo $sbreg[tisouscodigo];}else{ echo $tisouscodigo; }?>"> 
				</td> 
			</tr> 
			<tr> 
				<td width="41%" class="NoiseFooterTD"> 
				<?php if ($campnomb == "tisousnombre") { $tisousnombre = null; echo "*";}?>tisousnombre</td> 
				<td width="59%"> 
				<input type="text" name="tisousnombre"	value="<?php if(!$flageditartiposoliusua){ echo $sbreg[tisousnombre];}else{ echo $tisousnombre; }?>"> 
				</td> 
			</tr> 
			<tr> 
				<td width="41%" class="NoiseFooterTD"> 
				<?php if ($campnomb == "tisousdesri") { $tisousdesri = null; echo "*";}?>tisousdesri</td> 
				<td width="59%"> 
				<input type="text" name="tisousdesri"	value="<?php if(!$flageditartiposoliusua){ echo $sbreg[tisousdesri];}else{ echo $tisousdesri; }?>"> 
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
<input type="hidden" name="tisouscodigo" value="<?php if(!$flageditartiposoliusua){ echo $sbreg[tisouscodigo];}else{ echo $tisouscodigo; } ?>"> 
<input type="hidden" name="accioneditartiposoliusua"> 
<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
</form> 
</body> 
<?php 
if (! $codigo) { 
    echo " -->"; 
} 
?> 
</html> 
