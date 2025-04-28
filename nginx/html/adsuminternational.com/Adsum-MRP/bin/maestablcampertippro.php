<?php 
include ('../src/FunGen/sesion/fnccantrow.php'); 
include ('../src/FunGen/sesion/fnccantrow1.php'); 
include ('../src/FunPerPriNiv/limitscan.php'); 
include ('../src/FunGen/sesion/fncvalses.php'); 
include ('../src/FunPerPriNiv/pktblcampertippro.php'); 
include ('../src/FunGen/sesion/fncalmdat.php'); 
include ('../src/FunGen/sesion/fnccaf.php'); 
$reccomact = fnccaf ( $GLOBALS [usuacodi], $_SERVER ["SCRIPT_FILENAME"] ); 
 
if ($accionborrarcampertippro) { 
	include ('borracampertippro.php'); 
} else { 
	if ($accionconsultarcampertippro) { 
		$nusw = 0; 
		$nombcamp = strtok ( $columnas, "," ); 
		while ( $nombcamp ) { 
			$nombcamp = trim ( $nombcamp ); 
			$recarreglo [$nombcamp] = $$nombcamp; 
			if ($recarreglo [$nombcamp]) { 
				$nusw = 1; 
			} 
			$nombcamp = strtok ( "," ); 
		} 
		if (! $nusw) { 
			$accionconsultarcampertippro = 0; 
		} 
	} 
} 
include ('../src/FunGen/sesion/fncaumdec.php'); 
include ('../src/FunGen/fncpageposition.php'); 
 
$intervalo = fncaumdec ( 'campertippro', $inicio, $fin, $mov, $accionconsultarcampertippro, $recarreglo ); 
$cantrow = $intervalo [total]; 
if ($intervalo [idtrans]) { 
	$idtrans = $intervalo [idtrans]; 
} 
?> 
<!-- Propiedad intelectual de Adsum SAS (c) 
-Todos los derechos reservados- 
Creado con WAG Adsum 
Autor: Andrés A. Riascos D. 
Fecha: 20111229 
GenVers: 4.0 --> 
<html> 
<head> 
<title>Registros de campertippro</title> 
<meta http-equiv="Content-Type" content="text/html; charset=UTF8"> 
<meta http-equiv="expires" content="0"> 
<script language=JavaScript src="../src/FunGen/starPage_position.js" 
	type="text/javascript"></script> 
<script language="JavaScript" type="text/javascript" 
	src="../src/FunGen/fncsetcheck.js"></script> 
<script language="javascript" type="text/javascript" 
	src="../src/FunGen/fncremembercheck.js"></script> 
<script language=JavaScript src="../src/FunGen/colorfooter.js" 
	type="text/javascript"></script> 
 
<?php 
include ('../def/jquery.library_maestro.php'); 
?> 
</head> 
<?php 
if (! $codigo) { 
	echo "<!--"; 
} 
?> 
<body bgcolor="FFFFFF" class="NoisePageBODY"> 
<form name="form1" method="post" enctype="multipart/form-data"> 
<p><font class="NoiseFormHeaderFont">Listado de campertippro</font></p> 
<table border="0" cellspacing="1" cellpadding="0" align="center" 
	class="ui-widget-content"> 
	<tr> 
		<td class="NoiseErrorDataTD" align="right"> 
	<?php 
	page_position ( $intervalo, 'maestablcampertippro.php', $flagcheck ); 
	?></td> 
	</tr> 
	<tr> 
		<td>&nbsp;</td> 
	</tr> 
	<tr> 
		<td align="left" class="NoiseErrorDataTD"><?php 
		include ('../def/jquery.maestablbuttons.php')?></td> 
	</tr> 
	<tr> 
		<td>&nbsp;</td> 
	</tr> 
	<tr> 
		<td><?php 
		include ('../def/jquery.button_navup.php')?></td> 
	</tr> 
	<tr> 
		<td></td> 
	</tr> 
	<tr> 
		<td></td> 
	</tr> 
	<tr> 
		<td> 
		<table width="100%" border="0" align="center" cellspacing="1" 
			cellpadding="1" class="ui-widget-content"> 
			<tr> 
				<td width="5%" class="ui-state-default">Selec.</td> 
				<td width="90%" class="ui-state-default">C&oacute;digo</td> 
				<td width="90%" class="ui-state-default">Descripci&oacute;n</td> 
			</tr> 
				<?php 
				include ('../src/FunGen/sesion/fncvisreg.php'); 
				$reg [0] = 'cptprocodigo'; 
				$reg1 [0] = 'n'; 
				$nureturn = fncvisreg ( 'campertippro', $reg, $reg1, $idtrans, $arr_borrar, $flagcheck); 
				?> 
		</table> 
		</td> 
	</tr> 
	<tr> 
		<td></td> 
	</tr> 
	<tr> 
		<td></td> 
	</tr> 
	<tr> 
		<td><?php 
		include ('../def/jquery.button_navdown.php')?></td> 
	</tr> 
	<tr> 
		<td>&nbsp;</td> 
	</tr> 
	<tr> 
		<td class="NoiseErrorDataTD" align="right"> <?php 
		page_position ( $intervalo, 'maestablcampertippro.php', $flagcheck ); 
		?></td> 
	</tr> 
</table> 
<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
<input type="hidden" name="inicio" value="<?php echo $intervalo [inicio];	?>"> 
<input type="hidden" name="fin"	value="<?php echo $intervalo [fin];	?>"> 
<input type="hidden" name="sourcetable" value="campertippro"> 
<input type="hidden" name="selstar" id="selstar" value="0"> 
<input type="hidden" name="nombtabl" value="campertippro"> 
<input type="hidden" name="columnas" value="cptprocodigo, campercodigo, tipprocodigo, cptproorden, cptprocodpad, cptprotipo, cptproformul, cptproforcam, 
cptprotipope, cptprooculto, cptprorequer, cptproformat"> 
<input type="hidden" name="cptprocodigo" value="<?php if ($accionconsultarcampertippro) { echo $cptprocodigo; } ?>"> 
<input type="hidden" name="campercodigo" value="<?php if ($accionconsultarcampertippro) { echo $campercodigo; } ?>"> 
<input type="hidden" name="tipprocodigo" value="<?php if ($accionconsultarcampertippro) { echo $tipprocodigo; } ?>"> 
<input type="hidden" name="cptproorden" value="<?php if ($accionconsultarcampertippro) { echo $cptproorden; } ?>"> 
<input type="hidden" name="cptprocodpad" value="<?php if ($accionconsultarcampertippro) { echo $cptprocodpad; } ?>"> 
<input type="hidden" name="cptprotipo" value="<?php if ($accionconsultarcampertippro) { echo $cptprotipo; } ?>"> 
<input type="hidden" name="cptproformul" value="<?php if ($accionconsultarcampertippro) { echo $cptproformul; } ?>"> 
<input type="hidden" name="cptproforcam" value="<?php if ($accionconsultarcampertippro) { echo $cptproforcam; } ?>"> 
<input type="hidden" name="cptprotipope" value="<?php if ($accionconsultarcampertippro) { echo $cptprotipope; } ?>"> 
<input type="hidden" name="cptprooculto" value="<?php if ($accionconsultarcampertippro) { echo $cptprooculto; } ?>"> 
<input type="hidden" name="cptprorequer" value="<?php if ($accionconsultarcampertippro) { echo $cptprorequer; } ?>"> 
<input type="hidden" name="cptproformat" value="<?php if ($accionconsultarcampertippro) { echo $cptproformat; } ?>"> 
<input type="hidden" name="accionconsultarcampertippro"	value="<?php echo $accionconsultarcampertippro; ?>"> 
<input type="hidden" name="mov"><!-- Permite el cambio de checkbox/radiobuttion --> 
<input type="hidden" name="flagcheck" value="<?php echo $flagcheck; ?>"><!-- Campos a visualizar en maestablborrgen	--> 
<input type="hidden" name="selcampos" value="cptprocodigo, campercodigo, tipprocodigo, cptproorden, cptprocodpad, cptprotipo, cptproformul, cptproforcam, 
cptprotipope, cptprooculto, cptprorequer, cptproformat"><!--					--> 
<input type="hidden" name="arr_borrar" value="<?php echo $arr_borrar; ?>"> 
<input type="hidden" name="arreglo_b"> <!--						--></form> 
<div id="msgwindow" title="Adsum Kallpa"><span id="msg"></span></div> 
</body> 
<?php 
if (! $codigo) { 
	echo " -->"; 
} 
?> 
</html> 
