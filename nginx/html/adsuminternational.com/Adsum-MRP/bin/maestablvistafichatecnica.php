<?php 
ini_set('display_errors',1);
include ('../src/FunPerPriNiv/pktblvistafichatecnica.php'); 
include ('../src/FunPerPriNiv/pktblitemintegracion.php'); 
include ('../src/FunPerPriNiv/pktbltipoproduc.php'); 
include ('../src/FunGen/sesion/fnccantrow1.php'); 
include ('../src/FunGen/sesion/fnccantrow.php'); 
include ('../src/FunGen/sesion/fncvalses.php'); 
include ('../src/FunGen/sesion/fncalmdat.php'); 
include ('../src/FunPerPriNiv/limitscan.php'); 
include ('../src/FunGen/sesion/fnccaf.php'); 
$reccomact = fnccaf ( $GLOBALS ['usuacodi'], $_SERVER ["SCRIPT_FILENAME"] ); 
 
if ($accionborrarvistafichatecnica) { 
	include ('borravistafichatecnica.php'); 
} else { 
	if ($accionconsultarvistafichatecnica) { 
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
			$accionconsultarvistafichatecnica = 0; 
		} 
	} 
} 
include ('../src/FunGen/sesion/fncaumdec.php'); 
include ('../src/FunGen/fncpageposition.php'); 
 
$intervalo = fncaumdec ( 'vistafichatecnica', $inicio, $fin, $mov, $accionconsultarvistafichatecnica, $recarreglo ); 
$cantrow = $intervalo ['total']; 
if ($intervalo ['idtrans']) { 
	$idtrans = $intervalo ['idtrans']; 
} 
?> 
<!-- Propiedad intelectual de Adsum SAS (c) 
-Todos los derechos reservados- 
Creado con WAG Adsum 
Autor: Andr�s A. Riascos D. 
Fecha: 20120110 
GenVers: 4.8 --> 
<!doctype html> 
<html> 
<head> 
<title>Registros de vistafichatecnica</title> 
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
<p><font class="NoiseFormHeaderFont">Listado de &iacute;tem[Ficha Tecnica]</font></p> 
<table width="850px" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content"> 
	<tr> <td class="NoiseErrorDataTD" align="right"> <?php page_position ( $intervalo, 'maestablvistafichatecnica.php', $flagcheck ); ?></td> </tr> 
	<tr> <td>&nbsp;</td> </tr> 
	<tr> <td align="left" class="NoiseErrorDataTD"><?php include ('../def/jquery.maestablbuttons.php'); ?></td> </tr> 
	<tr> <td>&nbsp;</td> </tr> 
	<tr> <td><?php include ('../def/jquery.button_navup.php'); ?></td> </tr> 
	<tr> <td></td> </tr> 
	<tr> <td></td> </tr> 
	<tr> 
		<td> 
		<table width="100%" border="0" align="center" cellspacing="1" 
			cellpadding="1" class="ui-widget-content"> 
			<tr> 
				<td width="3%" class="ui-state-default">Sel.</td> 
				<td width="5%" class="ui-state-default">Codigo</td>
				<td width="10%" class="ui-state-default">Tipo PV</td>  
				<td width="56%" class="ui-state-default">Nombre</td> 
				<td width="10%" class="ui-state-default">Cod CG1</td> 
				<td width="10%" class="ui-state-default">No. PV</td> 
				<td width="6%" class="ui-state-default">Producto</td> 
			</tr> 
				<?php 
				include ('../src/FunGen/sesion/fncvisregvistafichatecnica.php'); 
				$reg [0] = 'produccodigo'; 
				$reg1 [0] = 'n'; 
				$nureturn = fncvisregvistafichatecnica ( 'vistafichatecnica', $reg, $reg1, $idtrans, $arr_borrar, $flagcheck); 
				?> 
		</table> 
		</td> 
	</tr> 
	<tr> <td></td> </tr> 
	<tr> <td></td> </tr> 
	<tr> <td><?php include ('../def/jquery.button_navdown.php'); ?></td> </tr> 
	<tr> <td>&nbsp;</td> </tr> 
	<tr> <td class="NoiseErrorDataTD" align="right"> <?php page_position ( $intervalo, 'maestablvistafichatecnica.php', $flagcheck ); ?></td> </tr> 
</table> 
<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
<input type="hidden" name="inicio" value="<?php echo $intervalo ['inicio'];	?>"> 
<input type="hidden" name="fin"	value="<?php echo $intervalo ['fin'];	?>"> 
<input type="hidden" name="sourcetable" value="vistafichatecnica"> 
<input type="hidden" name="selstar" id="selstar" value="0"> 
<input type="hidden" name="nombtabl" value="vistafichatecnica"> 
<input type="hidden" name="columnas" value="produccodigo, tipprocodigo, proestcodigo, producnombre, produccoduno, producrefcli, producfecha"> 
<input type="hidden" name="produccodigo" value="<?php if ($accionconsultarvistafichatecnica) { echo $produccodigo; } ?>"> 
<input type="hidden" name="tipprocodigo" value="<?php if ($accionconsultarvistafichatecnica) { echo $tipprocodigo; } ?>"> 
<input type="hidden" name="proestcodigo" value="<?php if ($accionconsultarvistafichatecnica) { echo $proestcodigo; } ?>"> 
<input type="hidden" name="producnombre" value="<?php if ($accionconsultarvistafichatecnica) { echo $producnombre; } ?>"> 
<input type="hidden" name="produccoduno" value="<?php if ($accionconsultarvistafichatecnica) { echo $produccoduno; } ?>"> 
<input type="hidden" name="producrefcli" value="<?php if ($accionconsultarvistafichatecnica) { echo $producrefcli; } ?>"> 
<input type="hidden" name="producfecha" value="<?php if ($accionconsultarvistafichatecnica) { echo $producfecha; } ?>"> 
<input type="hidden" name="accionconsultarvistafichatecnica"	value="<?php echo $accionconsultarvistafichatecnica; ?>"> 
<input type="hidden" name="mov"><!-- Permite el cambio de checkbox/radiobuttion --> 
<input type="hidden" name="flagcheck" value="<?php echo $flagcheck; ?>"><!-- Campos a visualizar en maestablborrgen	--> 
<input type="hidden" name="selcampos" value="produccodigo, tipprocodigo, proestcodigo, producnombre, produccoduno, producrefcli, producfecha"><!--					--> 
<input type="hidden" name="arr_borrar" value="<?php echo $arr_borrar; ?>"> 
<input type="hidden" name="arreglo_b">
</form> 
<div id="msgwindow" title="Adsum Kallpa"><span id="msg"></span></div> 
</body> 
<?php if (! $codigo) { echo " -->"; } ?> 
</html> 
