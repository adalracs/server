<?php 
include ('../src/FunGen/sesion/fnccantrow.php'); 
include ('../src/FunGen/sesion/fnccantrow1.php'); 
include ('../src/FunPerPriNiv/limitscan.php'); 
include ('../src/FunGen/sesion/fncvalses.php'); 
include ('../src/FunPerPriNiv/pktbldevolucion.php'); 
include ('../src/FunPerPriNiv/pktblusuario.php'); 
include ('../src/FunGen/sesion/fncalmdat.php'); 
include ('../src/FunGen/sesion/fnccaf.php'); 
$reccomact = fnccaf ( $GLOBALS [usuacodi], $_SERVER ["SCRIPT_FILENAME"] ); 
 
if ($accionborrardevolucion) { 
	include ('borradevolucion.php'); 
} else { 
	if ($accionconsultardevolucion) { 
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
			$accionconsultardevolucion = 0; 
		} 
	} 
} 
include ('../src/FunGen/sesion/fncaumdec.php'); 
include ('../src/FunGen/fncpageposition.php'); 
 
$intervalo = fncaumdec ( 'devolucion', $inicio, $fin, $mov, $accionconsultardevolucion, $recarreglo ); 
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
<title>Registros de devolucion</title> 
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
<p><font class="NoiseFormHeaderFont">Listado de devolucion</font></p> 
<table border="0" cellspacing="1" cellpadding="0" align="center" 
	class="ui-widget-content"> 
	<tr> 
		<td class="NoiseErrorDataTD" align="right"> 
	<?php 
	page_position ( $intervalo, 'maestabldevolucion.php', $flagcheck ); 
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
				<td width="5%" class="ui-state-default">Sel.</td> 
				<td width="10%" class="ui-state-default">Codigo</td> 
				<td width="10%" class="ui-state-default">Reclamo</td> 
				<td width="15%" class="ui-state-default">Fecha</td> 
				<td width="50%" class="ui-state-default">Vendedor</td> 
			</tr> 
				<?php 
				include ('../src/FunGen/sesion/fncvisregdevolucion.php'); 
				$reg [0] = 'devolucodigo'; 
				$reg1 [0] = 'n'; 
				$nureturn = fncvisregdevolucion ( 'devolucion', $reg, $reg1, $idtrans, $arr_borrar, $flagcheck); 
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
		page_position ( $intervalo, 'maestabldevolucion.php', $flagcheck ); 
		?></td> 
	</tr> 
</table> 
<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
<input type="hidden" name="inicio" value="<?php echo $intervalo [inicio];	?>"> 
<input type="hidden" name="fin"	value="<?php echo $intervalo [fin];	?>"> 
<input type="hidden" name="sourcetable" value="devolucion"> 
<input type="hidden" name="selstar" id="selstar" value="0"> 
<input type="hidden" name="nombtabl" value="devolucion"> 
<input type="hidden" name="columnas" value="devolucodigo, propedcodigo, usuacodi, tipreccodigo, devolunumero, devolufecela, devoluresult"> 
<input type="hidden" name="devolucodigo" value="<?php if ($accionconsultardevolucion) { echo $devolucodigo; } ?>"> 
<input type="hidden" name="propedcodigo" value="<?php if ($accionconsultardevolucion) { echo $propedcodigo; } ?>"> 
<input type="hidden" name="usuacodi" value="<?php if ($accionconsultardevolucion) { echo $usuacodi; } ?>"> 
<input type="hidden" name="tipreccodigo" value="<?php if ($accionconsultardevolucion) { echo $tipreccodigo; } ?>"> 
<input type="hidden" name="devolunumero" value="<?php if ($accionconsultardevolucion) { echo $devolunumero; } ?>"> 
<input type="hidden" name="devolufecela" value="<?php if ($accionconsultardevolucion) { echo $devolufecela; } ?>"> 
<input type="hidden" name="devoluresult" value="<?php if ($accionconsultardevolucion) { echo $devoluresult; } ?>"> 
<input type="hidden" name="accionconsultardevolucion"	value="<?php echo $accionconsultardevolucion; ?>"> 
<input type="hidden" name="mov"><!-- Permite el cambio de checkbox/radiobuttion --> 
<input type="hidden" name="flagcheck" value="<?php echo $flagcheck; ?>"><!-- Campos a visualizar en maestablborrgen	--> 
<input type="hidden" name="selcampos" value="devolucodigo, propedcodigo, usuacodi, tipreccodigo, devolunumero, devolufecela, devoluresult"><!--					--> 
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
