<?php 

include ("../src/FunPerPriNiv/pktblfamestatusmat.php");
include ("../src/FunGen/sesion/fnccantrow1.php"); 
include ("../src/FunGen/sesion/fnccantrow.php");
include ("../src/FunGen/sesion/fncalmdat.php"); 
include ("../src/FunGen/sesion/fncvalses.php");
include ("../src/FunPerPriNiv/limitscan.php"); 
include ("../src/FunGen/sesion/fnccaf.php"); 

$reccomact = fnccaf ( $GLOBALS ['usuacodi'], $_SERVER ["SCRIPT_FILENAME"] ); 
 
if ($accionborrarfamestatusmat) { 
	include ('borrafamestatusmat.php'); 
} else { 
	if ($accionconsultarfamestatusmat) { 
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
			$accionconsultarfamestatusmat = 0; 
		} 
	} 
} 
include ('../src/FunGen/sesion/fncaumdec.php'); 
include ('../src/FunGen/fncpageposition.php'); 
 
$intervalo = fncaumdec ( 'famestatusmat', $inicio, $fin, $mov, $accionconsultarfamestatusmat, $recarreglo ); 
$cantrow = $intervalo ['total']; 
if ($intervalo ['idtrans']) { 
	$idtrans = $intervalo ['idtrans']; 
} 
?> 
<!doctype html> 
<html> 
<head> 
<title>Gestion de familias x estatus</title> 
<meta http-equiv="Content-Type" content="text/html; charset=UTF8"> 
<meta http-equiv="expires" content="0"> 
<meta http-equiv="X-UA-Compatible" content="IE=9"> 
<script language=JavaScript src="../src/FunGen/starPage_position.js" type="text/javascript"></script> 
<script language="JavaScript" type="text/javascript" src="../src/FunGen/fncsetcheck.js"></script> 
<script language="javascript" type="text/javascript" src="../src/FunGen/fncremembercheck.js"></script> 
<script language=JavaScript src="../src/FunGen/colorfooter.js" type="text/javascript"></script> 
<?php include ('../def/jquery.library_maestro.php'); ?> 
</head> 
<?php if (! $codigo) { echo "<!--"; } ?> 
<body bgcolor="FFFFFF" class="NoisePageBODY"> 
<form name="form1" method="post" enctype="multipart/form-data"> 
<p><font class="NoiseFormHeaderFont">Listado de familias x estatus</font></p> 
<table border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content" width="500"> 
	<tr> <td class="NoiseErrorDataTD" align="right"> <?php page_position ( $intervalo, "maestablfamestatusmat.php", $flagcheck ); ?></td> </tr> 
	<tr> <td>&nbsp;</td> </tr> 
	<tr> <td align="left" class="NoiseErrorDataTD"><div class="ui-buttonset"><?php include("../def/jquery.maestablbuttons.php");?></div></td></tr> 
	<tr> <td>&nbsp;</td> </tr> 
	<tr> <td><?php include ('../def/jquery.button_navup.php'); ?></td></tr> 
	<tr> <td></td> </tr> 
	<tr> <td></td> </tr> 
	<tr> 
		<td> 
		<table width="100%" border="0" align="center" cellspacing="1" 
			cellpadding="1" class="ui-widget-content"> 
			<tr> 
				<td width="5%"class="ui-state-default tbl-head-font">Sel.</td>
				<td width="15%" class="ui-state-default tbl-head-font">C&oacute;digo</td>
				<td width="80%" class="ui-state-default tbl-head-font">Nombre</td>
			</tr>
				<?php 
				include ("../src/FunGen/sesion/fncvisreg.php"); 
				$reg [0] = "famestcodigo"; 
				$reg1 [0] = "n"; 
				$nureturn = fncvisreg( "famestatusmat", $reg, $reg1, $idtrans, $arr_borrar, $flagcheck); 
				?> 
		</table> 
		</td> 
	</tr> 
	<tr> <td></td> </tr> 
	<tr> <td></td> </tr> 
	<tr> <td><?php include ("../def/jquery.button_navdown.php"); ?></td> </tr> 
	<tr> <td>&nbsp;</td> </tr> 
	<tr> <td class="NoiseErrorDataTD" align="right"> <?php page_position ( $intervalo, "maestablfamestatusmat.php", $flagcheck ); ?></td> 
	</tr> 
</table> 
<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
<input type="hidden" name="inicio" value="<?php echo $intervalo ['inicio'];	?>"> 
<input type="hidden" name="fin"	value="<?php echo $intervalo ['fin'];	?>"> 
<input type="hidden" name="sourcetable" value="famestatusmat"> 
<input type="hidden" name="selstar" id="selstar" value="0"> 
<input type="hidden" name="nombtabl" value="famestatusmat"> 
<input type="hidden" name="columnas" value="famestcodigo,famestnombre,famestdescri,famestestado"> 
<input type="hidden" name="famestcodigo" value="<?php if ($accionconsultarfamestatusmat) { echo $famestcodigo; } ?>">  
<input type="hidden" name="famestnombre" value="<?php if ($accionconsultarfamestatusmat) { echo $famestnombre; } ?>">  
<input type="hidden" name="famestdescri" value="<?php if ($accionconsultarfamestatusmat) { echo $famestdescri; } ?>">  
<input type="hidden" name="famestestado" value="<?php if ($accionconsultarfamestatusmat) { echo $famestestado; } ?>">  
<input type="hidden" name="accionconsultarfamestatusmat"	value="<?php echo $accionconsultarfamestatusmat; ?>"> 
<input type="hidden" name="mov"><!-- Permite el cambio de checkbox/radiobuttion --> 
<input type="hidden" name="flagcheck" value="<?php echo $flagcheck; ?>"><!-- Campos a visualizar en maestablborrgen	--> 
<input type="hidden" name="selcampos" value="famestcodigo"><!--					--> 
<input type="hidden" name="arr_borrar" value="<?php echo $arr_borrar; ?>"> 
<input type="hidden" name="arreglo_b"> <!--						--></form> 
<div id="msgwindow" title="Adsum Kallpa"><span id="msg"></span></div> 
</body> 
<?php if (! $codigo) { echo " -->"; } ?> 
</html> 
