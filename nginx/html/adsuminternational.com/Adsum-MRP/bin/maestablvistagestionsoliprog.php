<?php 
ini_set('display_errors',1);
include ('../src/FunGen/sesion/fnccantrow.php'); 
include ('../src/FunGen/sesion/fnccantrow1.php'); 
include ('../src/FunPerPriNiv/limitscan.php'); 
include ('../src/FunGen/sesion/fncvalses.php'); 
include ('../src/FunPerPriNiv/pktblvistagestionsoliprog.php');
include ('../src/FunPerPriNiv/pktblsoliprogestado.php');
include ('../src/FunPerPriNiv/pktblusuario.php');
include ('../src/FunPerPriNiv/pktblplanta.php');    
include ('../src/FunGen/sesion/fncalmdat.php'); 
include ('../src/FunGen/sesion/fnccaf.php'); 
$reccomact = fnccaf ( $GLOBALS ["usuacodi"], $_SERVER ["SCRIPT_FILENAME"] ); 
 
if ($accionborrarvistagestionsoliprog) { 
	include ('borravistagestionsoliprog.php'); 
} else { 
	if ($accionconsultarvistagestionsoliprog) { 
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
			$accionconsultarvistagestionsoliprog = 0; 
		} 
	} 
} 
include ('../src/FunGen/sesion/fncaumdec.php'); 
include ('../src/FunGen/fncpageposition.php'); 

$intervalo = fncaumdec ( 'vistagestionsoliprog', $inicio, $fin, $mov, $accionconsultarvistagestionsoliprog, $recarreglo ); 
$cantrow = $intervalo ['total']; 
if ($intervalo ['idtrans']) { 
	$idtrans = $intervalo ['idtrans']; 
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
<title>Registros de solicitud de programacion de programacion<?php var_dump($usuacodi); ?></title> 
<meta http-equiv="Content-Type" content="text/html; charset=UTF8"> 
<meta http-equiv="expires" content="0"> 
<meta http-equiv="X-UA-Compatible" content="IE=9"> 
<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.ui.ajax_comun.js"></script>
<script language=JavaScript src="../src/FunGen/starPage_position.js" type="text/javascript"></script> 
<script language="JavaScript" type="text/javascript" src="../src/FunGen/fncsetcheck.js"></script> 
<script language="javascript" type="text/javascript" src="../src/FunGen/fncremembercheck.js"></script> 
<script language=JavaScript src="../src/FunGen/colorfooter.js" type="text/javascript"></script> 
<?php include ('../def/jquery.library_maestro.php'); ?> 
</head> 
<?php if (! $codigo) { echo "<!--"; } ?> 
<body bgcolor="FFFFFF" class="NoisePageBODY"> 
<form name="form1" method="post" enctype="multipart/form-data"> 
<p><font class="NoiseFormHeaderFont">Listado de Gestion de Solicitudes de programacion </font></p> 
<table width="850px" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content"> 
	<tr> <td class="NoiseErrorDataTD" align="right"> <?php page_position ( $intervalo, 'maestablvistagestionsoliprog.php', $flagcheck ); ?></td> </tr> 
	<tr> <td>&nbsp;</td> </tr> 
	<tr> <td align="left" class="NoiseErrorDataTD"><?php $optgestion=1;include ('../def/jquery.maestablbuttons.php'); ?></td> </tr>  
	<tr> <td>&nbsp;</td> </tr> 
	<tr> <td><?php include ('../def/jquery.button_navup.php'); ?></td> </tr> 
	<tr> <td></td> </tr> 
	<tr> <td></td> </tr> 
	<tr> 
		<td> 
		<table width="100%" border="0" align="center" cellspacing="1" 
			cellpadding="1" class="ui-widget-content"> 
			<tr> 
				<td class="ui-state-default tbl-head-font">Sel.</td>
				<td width="5%" class="ui-state-default tbl-head-font">C&oacute;digo</td>
				<td width="5%" class="ui-state-default tbl-head-font">PV</td> 
				<td width="5%" class="ui-state-default tbl-head-font">Item</td>
				<td width="30%" class="ui-state-default tbl-head-font">Referencia</td>
				<td width="25%" class="ui-state-default tbl-head-font">Cliente</td>
				<td width="5%" class="ui-state-default tbl-head-font">PRD.</td>
				<td width="10%" class="ui-state-default tbl-head-font">Fecha</td> 
				<td width="10%" class="ui-state-default tbl-head-font">Estado</td> 
			</tr>
				<?php 
				include ('../src/FunGen/sesion/fncvisregvistagestionsoliprog.php'); 
				$reg [0] = 'solprocodigo'; 
				$reg1 [0] = 'n'; 
				$nureturn = fncvisregvistagestionsoliprog ( 'vistagestionsoliprog', $reg, $reg1, $idtrans, $arr_borrar, $flagcheck); 
				?> 
		</table> 
		</td> 
	</tr> 
	<tr> <td></td> </tr> 
	<tr> <td></td> </tr> 
	<tr> <td><?php include ('../def/jquery.button_navdown.php'); ?></td> </tr> 
	<tr> <td>&nbsp;</td> </tr> 
	<tr> <td class="NoiseErrorDataTD" align="right"> <?php page_position ( $intervalo, 'maestablvistagestionsoliprog.php', $flagcheck ); ?></td> </tr> 
</table> 
<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
<input type="hidden" name="inicio" value="<?php echo $intervalo ['inicio'];	?>"> 
<input type="hidden" name="fin"	value="<?php echo $intervalo ['fin'];	?>"> 
<input type="hidden" name="sourcetable" value="vistagestionsoliprog"> 
<input type="hidden" name="selstar" id="selstar" value="0">
<input type="hidden" name="nombtabl" value="vistagestionsoliprog"> 
<input type="hidden" name="columnas" value="solprocodigo"> 
<input type="hidden" name="solprocodigo" value="<?php if ($accionconsultarvistagestionsoliprog) { echo $solprocodigo; } ?>">  
<input type="hidden" name="accionconsultarvistagestionsoliprog"	value="<?php echo $accionconsultarvistagestionsoliprog; ?>"> 
<input type="hidden" name="mov"><!-- Permite el cambio de checkbox/radiobuttion --> 
<input type="hidden" name="flagcheck" value="<?php echo $flagcheck; ?>"><!-- Campos a visualizar en maestablborrgen	--> 
<input type="hidden" name="selcampos" value="solprocodigo"><!--					--> 
<input type="hidden" name="arr_borrar" value="<?php echo $arr_borrar; ?>"> 
<input type="hidden" name="arreglo_b"> 
<input type="hidden" name="usuacodi" id="usuacodi" value="<?php echo $usuacodi; ?>"> 
<input type="hidden" name="modulocodigo" id="modulocodigo" value="6">
</form> 
<div id="msgwindow" title="Adsum Kallpa"><span id="msg"></span></div> 
<div id="msgwindowdevolver" title="Adsum Kallpa"><span id="msg1"></span></div>
<div id="windowdevolver" title="Adsum Kallpa [Devolucion PV]"><span id="msg2"></span></div>
</body> 
<?php if (! $codigo) { echo " -->"; } ?> 
</html> 
