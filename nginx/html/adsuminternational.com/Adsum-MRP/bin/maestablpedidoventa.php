<?php 
include ('../src/FunGen/sesion/fnccantrow.php'); 
include ('../src/FunGen/sesion/fnccantrow1.php'); 
include ('../src/FunPerPriNiv/limitscan.php'); 
include ('../src/FunGen/sesion/fncvalses.php'); 
include ('../src/FunPerPriNiv/pktblpedidoventa.php'); 
include ('../src/FunGen/sesion/fncalmdat.php'); 
include ('../src/FunGen/sesion/fnccaf.php'); 
$reccomact = fnccaf ( $GLOBALS [usuacodi], $_SERVER ["SCRIPT_FILENAME"] ); 
 
if ($accionborrarpedidoventa) { 
	include ('borrapedidoventa.php'); 
} else { 
	if ($accionconsultarpedidoventa) { 
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
			$accionconsultarpedidoventa = 0; 
		} 
	} 
} 
include ('../src/FunGen/sesion/fncaumdec.php'); 
include ('../src/FunGen/fncpageposition.php'); 
 
$intervalo = fncaumdec ( 'pedidoventa', $inicio, $fin, $mov, $accionconsultarpedidoventa, $recarreglo ); 
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
<title>Registros de pedidoventa</title> 
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
<p><font class="NoiseFormHeaderFont">Listado de pedidoventa</font></p> 
<table border="0" cellspacing="1" cellpadding="0" align="center" 
	class="ui-widget-content"> 
	<tr> 
		<td class="NoiseErrorDataTD" align="right"> 
	<?php 
	page_position ( $intervalo, 'maestablpedidoventa.php', $flagcheck ); 
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
				<td width="45%" class="ui-state-default">Codigo</td> 
				<td width="45%" class="ui-state-default">Nombre</td> 
			</tr> 
				<?php 
				include ('../src/FunGen/sesion/fncvisreg.php'); 
				$reg [0] = 'pedvencodigo'; 
				$reg1 [0] = 'n'; 
				$nureturn = fncvisreg ( 'pedidoventa', $reg, $reg1, $idtrans, $arr_borrar, $flagcheck); 
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
		page_position ( $intervalo, 'maestablpedidoventa.php', $flagcheck ); 
		?></td> 
	</tr> 
</table> 
<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
<input type="hidden" name="inicio" value="<?php echo $intervalo [inicio];	?>"> 
<input type="hidden" name="fin"	value="<?php echo $intervalo [fin];	?>"> 
<input type="hidden" name="sourcetable" value="pedidoventa"> 
<input type="hidden" name="selstar" id="selstar" value="0"> 
<input type="hidden" name="nombtabl" value="pedidoventa"> 
<input type="hidden" name="columnas" value="pedvencodigo, tipevecodigo, ordcomcodigo, usuacodi, pedvennumero, pedvenfecent, pedvenfecrec, pedvendiapac, 
pedvenobserv, pedvenconsec, pedvenmotmue, pedvennompro"> 
<input type="hidden" name="pedvencodigo" value="<?php if ($accionconsultarpedidoventa) { echo $pedvencodigo; } ?>"> 
<input type="hidden" name="tipevecodigo" value="<?php if ($accionconsultarpedidoventa) { echo $tipevecodigo; } ?>"> 
<input type="hidden" name="ordcomcodigo" value="<?php if ($accionconsultarpedidoventa) { echo $ordcomcodigo; } ?>"> 
<input type="hidden" name="usuacodi" value="<?php if ($accionconsultarpedidoventa) { echo $usuacodi; } ?>"> 
<input type="hidden" name="pedvennumero" value="<?php if ($accionconsultarpedidoventa) { echo $pedvennumero; } ?>"> 
<input type="hidden" name="pedvenfecent" value="<?php if ($accionconsultarpedidoventa) { echo $pedvenfecent; } ?>"> 
<input type="hidden" name="pedvenfecrec" value="<?php if ($accionconsultarpedidoventa) { echo $pedvenfecrec; } ?>"> 
<input type="hidden" name="pedvendiapac" value="<?php if ($accionconsultarpedidoventa) { echo $pedvendiapac; } ?>"> 
<input type="hidden" name="pedvenobserv" value="<?php if ($accionconsultarpedidoventa) { echo $pedvenobserv; } ?>"> 
<input type="hidden" name="pedvenconsec" value="<?php if ($accionconsultarpedidoventa) { echo $pedvenconsec; } ?>"> 
<input type="hidden" name="pedvenmotmue" value="<?php if ($accionconsultarpedidoventa) { echo $pedvenmotmue; } ?>"> 
<input type="hidden" name="pedvennompro" value="<?php if ($accionconsultarpedidoventa) { echo $pedvennompro; } ?>"> 
<input type="hidden" name="accionconsultarpedidoventa"	value="<?php echo $accionconsultarpedidoventa; ?>"> 
<input type="hidden" name="mov"><!-- Permite el cambio de checkbox/radiobuttion --> 
<input type="hidden" name="flagcheck" value="<?php echo $flagcheck; ?>"><!-- Campos a visualizar en maestablborrgen	--> 
<input type="hidden" name="selcampos" value="pedvencodigo, tipevecodigo, ordcomcodigo, usuacodi, pedvennumero, pedvenfecent, pedvenfecrec, pedvendiapac, 
pedvenobserv, pedvenconsec, pedvenmotmue, pedvennompro"><!--					--> 
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
