<?php 
	ini_set("display_errors", 1);
	include ( "../src/FunPerPriNiv/pktbltiposoliprog.php"); 
	include ( "../src/FunPerPriNiv/pktblcentcost.php"); 
	include ('../src/FunPerPriNiv/pktbltarifa.php'); 
	include ('../src/FunPerPriNiv/pktblusuario.php');
	include ('../src/FunGen/sesion/fnccantrow1.php'); 
	include ('../src/FunGen/sesion/fnccantrow.php');
	include ('../src/FunGen/sesion/fncalmdat.php'); 
	include ('../src/FunGen/sesion/fncvalses.php');	
	include ('../src/FunPerPriNiv/limitscan.php'); 
	include ('../src/FunGen/sesion/fnccaf.php'); 

	$reccomact = fnccaf ( $GLOBALS ['usuacodi'], $_SERVER ["SCRIPT_FILENAME"] ); 
 
	if ($accionborrartarifa) { 
		include ("borratarifa.php"); 
	} else { 
		
		if ($accionconsultartarifa) { 	
			$nusw = 0; 
			$nombcamp = strtok ( $columnas, "," ); 

			while ( $nombcamp ) { 

				$nombcamp = trim($nombcamp);
					$nombcampc = trim($nombcamp).'_c';
			
					$recarreglo[$nombcamp] =  $$nombcampc;
					
					if($recarreglo[$nombcamp])
						$nusw =1; 
						$nombcamp = strtok(",");
			} 
			if (! $nusw) { 

				$accionconsultartarifa = 0; 
			} 
		}

	} 
	
	include ("../src/FunGen/sesion/fncaumdec.php"); 
	include ("../src/FunGen/fncpageposition.php"); 
 
	$intervalo = fncaumdec ( "tarifa", $inicio, $fin, $mov, $accionconsultartarifa, $recarreglo ); 
	$cantrow = $intervalo ["total"]; 
	if ($intervalo ["idtrans"]) { 
		$idtrans = $intervalo ["idtrans"]; 
	} 

?> 
<!doctype html> 
<html> 
<head> 
<title>Listado de tarifa</title> 
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
<p><font class="NoiseFormHeaderFont">Listado de Tarifas</font></p> 
<table border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content" width="750"> 
	<tr> <td class="NoiseErrorDataTD" align="right"> <?php page_position ( $intervalo, 'maestabltarifa.php', $flagcheck ); ?></td> </tr> 
	<tr> <td>&nbsp;</td> </tr> 
	<tr> <td align="left" class="NoiseErrorDataTD"><div class="ui-buttonset"><?php include('../def/jquery.maestablbuttons.php');?></div></td></tr> 
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
				<td width="10%" class="ui-state-default tbl-head-font">Codigo</td>
				<td width="35%" class="ui-state-default tbl-head-font">Centro de costo</td>
				<td width="10%" class="ui-state-default tbl-head-font">Proceso</td>				
				<td width="10%" class="ui-state-default tbl-head-font">Mes - Año</td>		
			</tr>
				<?php 
				include ('../src/FunGen/sesion/fncvisregtarifa.php'); 
				$reg [0] = 'tarifacodigo'; 
				$reg1 [0] = 'n'; 
				$nureturn = fncvisregtarifa ('tarifa', $reg, $reg1, $idtrans, $arr_borrar, $flagcheck); 
				?> 
		</table> 
		</td> 
	</tr> 
	<tr> <td></td> </tr> 
	<tr> <td></td> </tr> 
	<tr> <td><?php include ('../def/jquery.button_navdown.php'); ?></td> </tr> 
	<tr> <td>&nbsp;</td> </tr> 
	<tr> <td class="NoiseErrorDataTD" align="right"> <?php page_position ( $intervalo, 'maestabltarifa.php', $flagcheck ); ?></td> 
	</tr> 
</table> 
<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
<input type="hidden" name="inicio" value="<?php echo $intervalo ["inicio"];	?>"> 
<input type="hidden" name="fin"	value="<?php echo $intervalo ["fin"];	?>"> 
<input type="hidden" name="sourcetable" value="tarifa"> 
<input type="hidden" name="selstar" id="selstar" value="0"> 
<input type="hidden" name="nombtabl" value="tarifa"> 
<input type="hidden" name="columnas" value="tarifacodigo,cencoscodigo,tipsolcodigo,tarifames,tarifaano,tarifamod,tarifamoi,tarifacdep,tarifasdep,tarifaman,tarifaotros"> 
<input type="hidden" name="tarifacodigo_c" value="<?php if ($accionconsultartarifa) { echo $tarifacodigo_c; } ?>">  
<input type="hidden" name="cencoscodigo_c" value="<?php if ($accionconsultartarifa) { echo $cencoscodigo_c; } ?>">  
<input type="hidden" name="tipsolcodigo_c" value="<?php if ($accionconsultartarifa) { echo $tipsolcodigo_c; } ?>">  
<input type="hidden" name="tarifames_c" value="<?php if ($accionconsultartarifa) { echo $tarifames_c; } ?>">  
<input type="hidden" name="tarifaano_c" value="<?php if ($accionconsultartarifa) { echo $tarifaano_c; } ?>">  
<input type="hidden" name="tarifamod_c" value="<?php if ($accionconsultartarifa) { echo $tarifamod_c; } ?>">  
<input type="hidden" name="tarifamoi_c" value="<?php if ($accionconsultartarifa) { echo $tarifamoi_c; } ?>">  
<input type="hidden" name="tarifacdep_c" value="<?php if ($accionconsultartarifa) { echo $tarifacdep_c; } ?>">  
<input type="hidden" name="tarifasdep_c" value="<?php if ($accionconsultartarifa) { echo $tarifasdep_c; } ?>"> 
<input type="hidden" name="tarifaene_c" value="<?php if ($accionconsultartarifa) { echo $tarifaene_c; } ?>"> 
<input type="hidden" name="tarifaman_c" value="<?php if ($accionconsultartarifa) { echo $tarifaman_c; } ?>"> 
<input type="hidden" name="tarifaotros_c" value="<?php if ($accionconsultartarifa) { echo $tarifaotros_c; } ?>">  
<input type="hidden" name="accionconsultartarifa"	value="<?php echo $accionconsultartarifa; ?>"> 
<input type="hidden" name="mov"><!-- Permite el cambio de checkbox/radiobuttion --> 
<input type="hidden" name="flagcheck" value="<?php echo $flagcheck; ?>"><!-- Campos a visualizar en maestablborrgen	--> 
<input type="hidden" name="selcampos" value="ordoppcodigo"><!--					--> 
<input type="hidden" name="arr_borrar" value="<?php echo $arr_borrar; ?>"> 
<input type="hidden" name="arreglo_b"> <!--						--></form> 
<div id="msgwindow" title="Adsum Kallpa"><span id="msg"></span></div> 
</body> 
<?php if (! $codigo) { echo " -->"; } ?> 
</html> 
