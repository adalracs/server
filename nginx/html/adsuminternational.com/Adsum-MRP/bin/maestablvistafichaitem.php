<?php 
ini_set('display_errors',1);
include ('../src/FunGen/sesion/fnccantrow.php'); 
include ('../src/FunGen/sesion/fnccantrow1.php'); 
include ('../src/FunPerPriNiv/limitscan.php'); 
include ('../src/FunGen/sesion/fncvalses.php'); 
include ('../src/FunPerPriNiv/pktblvistafichaitem.php'); 
include ('../src/FunPerPriNiv/pktbltipoproduc.php'); 
include ('../src/FunGen/sesion/fncalmdat.php'); 
include ('../src/FunGen/sesion/fnccaf.php'); 
$reccomact = fnccaf ( $GLOBALS ["usuacodi"], $_SERVER ["SCRIPT_FILENAME"] ); 
 
if ($accionborrarvistafichaitem) { 
	include ('borravistafichaitem.php'); 
} else { 
	if ($accionconsultarvistafichaitem) { 
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
			$accionconsultarvistafichaitem = 0; 
		} 
	} 
} 
include ('../src/FunGen/sesion/fncaumdec.php'); 
include ('../src/FunGen/fncpageposition.php'); 
 
$intervalo = fncaumdec ( 'vistafichaitem', $inicio, $fin, $mov, $accionconsultarvistafichaitem, $recarreglo ); 
$cantrow = $intervalo ["total"]; 
if ($intervalo ["idtrans"]) { 
	$idtrans = $intervalo ["idtrans"]; 
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
<title>Registros de ficha tecnica</title> 
<meta http-equiv="Content-Type" content="text/html; charset=UTF8"> 
<meta http-equiv="expires" content="0"> 
<meta http-equiv="X-UA-Compatible" content="IE=9"> 
<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.ui.ajax_comun.js"></script>
<script language=JavaScript src="../src/FunGen/starPage_position.js" type="text/javascript"></script> 
<script language="JavaScript" type="text/javascript" src="../src/FunGen/fncsetcheck.js"></script> 
<script language="javascript" type="text/javascript" src="../src/FunGen/fncremembercheck.js"></script> 
<script language=JavaScript src="../src/FunGen/colorfooter.js" type="text/javascript"></script> 
<?php include ('../def/jquery.library_maestro.php'); ?> 

<script type="text/javascript">

	$(function(){

		$('#exportarexcel1').button({ icons: { primary: "ui-icon-calculator" } }).click(function() {
			$.ajax({	   
				dataType: "html",
				type: "POST",
				url: "../src/FunPHPExcel/listfichatecnica.phpexcel.php",
				data: {"vvv" : "1"},
				beforeSend: function(data){ 

					$("#msgwindow").dialog("open");
					$("#msg").html("<img src='../img/loading.gif'>&nbsp;Espere mientras se genera el archivo xls...<br><font color='red'>Nota:&nbsp;Este proceso puede tardar hasta 5 minutos.</font>");
				},
				success: function(requestData){

					$("#msgwindow").dialog("close");
					window.open('../temp/ADM_Listfichatecnica.xls','Fichas Técnicas');
				},         
				error: function(requestData, strError, strTipoError){},
				complete: function(requestData, exito){ }                                      
			});
			return false;
		});

		$('#exportarexcel2').button({ icons: { primary: "ui-icon-calculator" } }).click(function() {
			
			$.ajax({	   
				dataType: "html",
				type: "POST",
				url: "../src/FunPHPExcel/listestructura.phpexcel.php",
				data: {"vvv" : "1"},
				beforeSend: function(data){ 

					$("#msgwindow").dialog("open");
					$("#msg").html("<img src='../img/loading.gif'>&nbsp;Espere mientras se genera el archivo xls...<br><font color='red'>Nota:&nbsp;Este proceso puede tardar hasta 5 minutos.</font>");
				},
				success: function(requestData){

					$("#msgwindow").dialog("close");
					window.open('../temp/ADM_Listestructura.xls','Estructuras');
				},         
				error: function(requestData, strError, strTipoError){},
				complete: function(requestData, exito){ }                                      
			});
			return false;
		});

		$('#exportarexcel3').button({ icons: { primary: "ui-icon-calculator" } }).click(function() {
			
			$.ajax({	   
				dataType: "html",
				type: "POST",
				url: "../src/FunPHPExcel/listtinta.phpexcel.php",
				data: {"vvv" : "1"},
				beforeSend: function(data){ 

					$("#msgwindow").dialog("open");
					$("#msg").html("<img src='../img/loading.gif'>&nbsp;Espere mientras se genera el archivo xls...<br><font color='red'>Nota:&nbsp;Este proceso puede tardar hasta 5 minutos.</font>");
				},
				success: function(requestData){

					$("#msgwindow").dialog("close");
					window.open('../temp/ADM_Listtinta.xls','Tintas');
				},         
				error: function(requestData, strError, strTipoError){},
				complete: function(requestData, exito){ }                                      
			});
			return false;
		});
	});
</script>
</head> 
<?php if (! $codigo) { echo "<!--"; } ?> 
<body bgcolor="FFFFFF" class="NoisePageBODY"> 
<form name="form1" method="post" enctype="multipart/form-data"> 
<p><font class="NoiseFormHeaderFont">Listado de pedidos [ficha t&eacute;cnica]</font></p> 
<table width="850px" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content"> 
	<tr> <td class="NoiseErrorDataTD" align="right"> <?php page_position ( $intervalo, 'maestablvistafichaitem.php', $flagcheck ); ?></td> </tr> 
	<tr> <td>&nbsp;</td> </tr> 
	<tr> <td align="left" class="NoiseErrorDataTD"><?php $optgestion=1;include("../def/jquery.maestablbuttons.php"); ?></td></tr> 
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
				<td width="5%" class="ui-state-default">C&oacute;digo</td>
				<td width="10%" class="ui-state-default">Cod CG1</td> 
				<td width="46%" class="ui-state-default">Nombre</td> 
				<td width="10%" class="ui-state-default">Producto</td> 
				<td width="30%" class="ui-state-default">Cliente</td> 
			</tr> 
				<?php 
				include ('../src/FunGen/sesion/fncvisregvistafichaitem.php'); 
				$reg [0] = 'produccodigo'; 
				$reg1 [0] = 'n'; 
				$nureturn = fncvisregvistafichaitem ( 'vistafichaitem', $reg, $reg1, $idtrans, $arr_borrar, $flagcheck); 
				?> 
		</table> 
		</td> 
	</tr> 
	<tr> <td></td> </tr> 
	<tr> <td></td> </tr> 
	<tr> <td><?php include ('../def/jquery.button_navdown.php'); ?></td> </tr> 
	<tr> <td>&nbsp;</td> </tr> 
	<tr> <td class="NoiseErrorDataTD" align="right"> <?php page_position ( $intervalo, 'maestablvistafichaitem.php', $flagcheck ); ?></td> </tr> 
</table> 
<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
<input type="hidden" name="inicio" value="<?php echo $intervalo ["inicio"];	?>"> 
<input type="hidden" name="fin"	value="<?php echo $intervalo ["fin"];	?>"> 
<input type="hidden" name="sourcetable" value="vistafichaitem"> 
<input type="hidden" name="selstar" id="selstar" value="0"> 
<input type="hidden" name="nombtabl" value="vistafichaitem"> 
<input type="hidden" name="columnas" value="produccodigo, produccoduno, tippronombre, producnombre, ordcomcodcli, ordcomrazsoc"> 
<input type="hidden" name="produccodigo" value="<?php if ($accionconsultarvistafichaitem) { echo $produccodigo; } ?>"> 
<input type="hidden" name="produccoduno" value="<?php if ($accionconsultarvistafichaitem) { echo $produccoduno; } ?>"> 
<input type="hidden" name="tippronombre" value="<?php if ($accionconsultarvistafichaitem) { echo $tippronombre; } ?>"> 
<input type="hidden" name="producnombre" value="<?php if ($accionconsultarvistafichaitem) { echo $producnombre; } ?>"> 
<input type="hidden" name="ordcomcodcli" value="<?php if ($accionconsultarvistafichaitem) { echo $ordcomcodcli; } ?>"> 
<input type="hidden" name="ordcomrazsoc" value="<?php if ($accionconsultarvistafichaitem) { echo $ordcomrazsoc; } ?>"> 
<input type="hidden" name="accionconsultarvistafichaitem"	value="<?php echo $accionconsultarvistafichaitem; ?>"> 
<input type="hidden" name="mov"><!-- Permite el cambio de checkbox/radiobuttion --> 
<input type="hidden" name="flagcheck" value="<?php echo $flagcheck; ?>"><!-- Campos a visualizar en maestablborrgen	--> 
<input type="hidden" name="selcampos" value="produccodigo, tipprocodigo, proestcodigo, producnombre, produccoduno, producrefcli, producfecha"><!--					--> 
<input type="hidden" name="arr_borrar" value="<?php echo $arr_borrar; ?>"> 
<input type="hidden" name="arreglo_b">
<<input type="hidden" name="usuacodi" id="usuacodi" value="<?php echo $usuacodi; ?>"> 
<input type="hidden" name="modulocodigo" id="modulocodigo" value="7">
</form> 
<div id="msgwindow" title="Adsum Kallpa"><span id="msg"></span></div> 
<div id="msgwindowdevolver" title="Adsum Kallpa"><span id="msg1"></span></div>
<div id="windowdevolver" title="Adsum Kallpa [Devolucion PV]"><span id="msg2"></span></div>
</body> 
<?php 
if (! $codigo) { 
	echo " -->"; 
} 
?> 
</html> 
