<?php 
include ('../src/FunGen/sesion/fnccantrow.php'); 
include ('../src/FunGen/sesion/fnccantrow1.php'); 
include ('../src/FunPerPriNiv/limitscan.php'); 
include ('../src/FunGen/sesion/fncvalses.php'); 
include ('../src/FunPerPriNiv/pktbldocumereclam.php'); 
include ('../src/FunGen/sesion/fncalmdat.php'); 
include ('../src/FunGen/sesion/fnccaf.php'); 
$reccomact = fnccaf ( $GLOBALS [usuacodi], $_SERVER ["SCRIPT_FILENAME"] ); 
 
if ($accionborrardocumereclam) { 
	include ('borradocumereclam.php'); 
} else { 
	if ($accionconsultardocumereclam) { 
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
			$accionconsultardocumereclam = 0; 
		} 
	} 
} 
include ('../src/FunGen/sesion/fncaumdec.php'); 
include ('../src/FunGen/fncpageposition.php'); 
 
$intervalo = fncaumdec ( 'documereclam', $inicio, $fin, $mov, $accionconsultardocumereclam, $recarreglo ); 
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
<title>Registros de documereclam</title> 
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
<p><font class="NoiseFormHeaderFont">Listado de documereclam</font></p> 
<table border="0" cellspacing="1" cellpadding="0" align="center" 
	class="ui-widget-content"> 
	<tr> 
		<td class="NoiseErrorDataTD" align="right"> 
	<?php 
	page_position ( $intervalo, 'maestabldocumereclam.php', $flagcheck ); 
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
				$reg [0] = 'docreccodigo'; 
				$reg1 [0] = 'n'; 
				$nureturn = fncvisreg ( 'documereclam', $reg, $reg1, $idtrans, $arr_borrar, $flagcheck); 
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
		page_position ( $intervalo, 'maestabldocumereclam.php', $flagcheck ); 
		?></td> 
	</tr> 
</table> 
<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
<input type="hidden" name="inicio" value="<?php echo $intervalo [inicio];	?>"> 
<input type="hidden" name="fin"	value="<?php echo $intervalo [fin];	?>"> 
<input type="hidden" name="sourcetable" value="documereclam"> 
<input type="hidden" name="selstar" id="selstar" value="0"> 
<input type="hidden" name="nombtabl" value="documereclam"> 
<input type="hidden" name="columnas" value="docreccodigo, reclamcodigo, docrecnombre, docrecdescri, docrecruta"> 
<input type="hidden" name="docreccodigo" value="<?php if ($accionconsultardocumereclam) { echo $docreccodigo; } ?>"> 
<input type="hidden" name="reclamcodigo" value="<?php if ($accionconsultardocumereclam) { echo $reclamcodigo; } ?>"> 
<input type="hidden" name="docrecnombre" value="<?php if ($accionconsultardocumereclam) { echo $docrecnombre; } ?>"> 
<input type="hidden" name="docrecdescri" value="<?php if ($accionconsultardocumereclam) { echo $docrecdescri; } ?>"> 
<input type="hidden" name="docrecruta" value="<?php if ($accionconsultardocumereclam) { echo $docrecruta; } ?>"> 
<input type="hidden" name="accionconsultardocumereclam"	value="<?php echo $accionconsultardocumereclam; ?>"> 
<input type="hidden" name="mov"><!-- Permite el cambio de checkbox/radiobuttion --> 
<input type="hidden" name="flagcheck" value="<?php echo $flagcheck; ?>"><!-- Campos a visualizar en maestablborrgen	--> 
<input type="hidden" name="selcampos" value="docreccodigo, reclamcodigo, docrecnombre, docrecdescri, docrecruta"><!--					--> 
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
