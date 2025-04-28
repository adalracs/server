<?php 
include ('../src/FunGen/sesion/fncvalses.php'); 
if (! $flagdetallartiposoliusua) { 
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
<title>Detalle de registro de tiposoliusua</title> 
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
		<td class="ui-widget-header">Detallar registro</td></tr> 
	<tr> 
		<td> 
		<table width="95%" border="0" cellspacing="1" cellpadding="1" align="center"> 
			<tr> 
				<td width="41%" class="NoiseFooterTD">tisouscodigo</td> 
				<td width="59%" class="NoiseDataTD"><?php 
				if ($sbreg) { 
					echo $sbreg [tisouscodigo]; 
				} 
				?></td> 
			</tr> 
			<tr> 
				<td width="59%" class="NoiseDataTD"><?php 
				if (! $flagdetallartiposoliusua) { 
					echo $sbreg [tisouscodigo]; 
				} 
				?></td> 
			<tr> 
				<td width="41%" class="NoiseFooterTD">tisouscodigo</td> 
				<td width="59%" class="NoiseDataTD"><?php 
				if (! $flagdetallartiposoliusua) { 
					echo $sbreg [tisouscodigo]; 
				} 
				?> 
				</td> 
			</tr> 
			<tr> 
				<td width="41%" class="NoiseFooterTD">tisousnombre</td> 
				<td width="59%" class="NoiseDataTD"><?php 
				if (! $flagdetallartiposoliusua) { 
					echo $sbreg [tisousnombre]; 
				} 
				?> 
				</td> 
			</tr> 
			<tr> 
				<td width="41%" class="NoiseFooterTD">tisousdesri</td> 
				<td width="59%" class="NoiseDataTD"><?php 
				if (! $flagdetallartiposoliusua) { 
					echo $sbreg [tisousdesri]; 
				} 
				?> 
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
 <input type="hidden" name="flagdetallartiposoliusua" value="1"> 
<input type="hidden" name="sourcetable" value="<?php echo $sourcetable;	?>"> 
<input type="hidden" name="sourceaction" value="detallar"> 
<input type="hidden" name="acciondetallartiposoliusua"> 
<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
<input type="hidden" name="columnas" value="tisouscodigo, 
tisousnombre, 
tisousdesri 
<input type="hidden" name="tisouscodigo" value="<?php if ($accionconsultartiposoliusua) echo $tisouscodigo; ?>"> 
<input type="hidden" name="tisousnombre" value="<?php if ($accionconsultartiposoliusua) echo $tisousnombre; ?>"> 
<input type="hidden" name="tisousdesri" value="<?php if ($accionconsultartiposoliusua) echo $tisousdesri; ?>"> 
<input type="hidden" name="accionconsultar" value="<?php echo $accionconsultar;	?>"> 
</form> 
</body> 
<?php 
if (! $codigo) { 
    echo " -->"; 
} 
?> 
</html> 
