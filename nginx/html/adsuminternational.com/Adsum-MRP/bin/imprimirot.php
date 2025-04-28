<?php
include ( '../src/FunPerSecNiv/fncnumreg.php');
include ( '../src/FunPerSecNiv/fncfetch.php');
include ( '../src/FunPerPriNiv/pktblot.php');
include ( '../src/FunPerPriNiv/pktblsoliserv.php');
include ( '../src/FunPerPriNiv/pktblusuario.php');
include ( '../src/FunPerPriNiv/pktblequipo.php');
include ( '../src/FunPerPriNiv/pktblcomponen.php');
include ( '../src/FunPerPriNiv/pktbltipofall.php');
include ( '../src/FunPerPriNiv/pktbltipotrab.php');
include ( '../src/FunPerPriNiv/pktblusuariotareot.php');
include ( '../src/FunPerPriNiv/pktbltareot.php');
include ( '../src/FunPerPriNiv/pktblsoliservestado.php');
include ( '../src/FunPerPriNiv/pktblplanta.php');
include ( '../src/FunPerPriNiv/pktblsistema.php');
include ( '../src/FunPerPriNiv/pktblpriorida.php');
include ( '../src/FunPerPriNiv/pktbltipomant.php');
include ( '../src/FunPerSecNiv/fncconn.php');
include ( '../src/FunPerSecNiv/fncclose.php');

$idcon = fncconn();

$ordetrab = loadrecordot($codigo,$idcon);

$sbregtareot1 = loadrecordtareot2($ordetrab[ordtracodigo],$idcon);
$sbregtareot = loadrecordmaxtareot2($ordetrab[ordtracodigo],$idcon);
if($ordetrab[solsercodigo]) $soliserv = loadrecordsoliserv($ordetrab[solsercodigo],$idcon);
$tareot = buscartareotordtracodigo($ordetrab[ordtracodigo],$idcon);
$usuario = loadrecordusuario($tareot[usuacodi],$idcon);
$tipofalla = loadrecordtipofall($ordetrab[tipfalcodigo],$idcon);
if($ordetrab[estsolcodigo])  $estado = loadrecordsoliservestado($ordetrab[estsolcodigo],$idcon);
$planta = loadrecordplanta($ordetrab[plantacodigo],$idcon);
$sistema = loadrecordsistema($ordetrab[sistemcodigo],$idcon);
$equipo = loadrecordequipo($ordetrab[equipocodigo],$idcon);
$componente = loadrecordcomponen($ordetrab[componcodigo],$idcon);
$ircrecord[equipocodigo]=$ordetrab[equipocodigo];
$componentes = dinamicscanopcomponen($ircrecord,'=',$idcon);
$componentes = pg_fetch_all($componentes);
$usuariotareot = loadrecordusuariotareot($sbregtareot[tareotcodigo],$idcon);
$usuarioot = loadrecordusuario($tareot[usuacodi],$idcon);
$tipomant = loadrecordtipomant($ordetrab[tipmancodigo],$idcon);
$prioridad = loadrecordpriorida($tareot[prioricodigo],$idcon);
$tipotrabaj = loadrecordtipotrab($tareot[tiptracodigo],$idcon);
$encargado = loadrecordusuariotareot2($sbregtareot[tareotcodigo],$idcon);
$encargado = loadrecordusuario($encargado[usuacodi],$idcon);
//Hallamos el codigo de tareot

//Hallamos el codigo de usuariotareot
$sbregustareottmp = loadrecordusuariotareot1($sbregtareot1[tareotcodigo], $idcon);
$codusuariotareot = $sbregustareottmp[usutarcodigo];
//Armamos el arreglo para buscar en usuariotareot por el codigo de tareot
$sbregusuariotareot[usutarcodigo] = "";
$sbregusuariotareot[usuacodi] = "";
$sbregusuariotareot[tareotcodigo] = $sbregtareot[tareotcodigo];
$sbregusuariotareot[usutarlider] = "";
$idusutareot = dinamicscanusuariotareot($sbregusuariotareot,$idcon);

$t = 0;

if($idusutareot){
	$nuCantrow = fncnumreg($idusutareot );
	//recorremos el arreglo para determinar los usuarios de la ot
	
	for($i = 0;$i < $nuCantrow; $i++){
		$sbregusua = fncfetch($idusutareot,$i);
		
	
		if($sbregusua[usutarlider] == "t"){
			$lider = $sbregusua[usuacodi];
			$sbregusuario = loadrecordusuario($sbregusua[usuacodi],$idcon);
			
			$usuacodigo = $sbregusua[usuacodi];
			
			$sbregusuanom = $sbregusuario[usuanombre]." ".$sbregusuario[usuapriape]." ".$sbregusuario[usuasegape];
			
		}else{
			$sbregusuaselec[] = $sbregusua[usuacodi];
			
			$sbregustarcoditmp = ($t == 0) ? $sbregusua[usutarcodigo] : $sbregustarcoditmp.",".$sbregusua[usutarcodigo];
			$t++;
		}
		if(!$arreglo_tecnic)
			$arreglo_tecnic = $sbregusua[usuacodi];
		else
			$arreglo_tecnic = $arreglo_tecnic.",".$sbregusua[usuacodi];
		
	}
}
 
?>
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<title>Orden de Trabajo No. <?php echo $ordetrab["ordtracodigo"]; ?></title>
		<style type="text/css">
			<!--
			.head-title-report {font-family: Arial, Helvetica, sans-serif; font-size: 10px; text-align:center;}
			.head-title-table {font-family: Arial, Helvetica, sans-serif; font-size: 10px;}
			.tick-title-report, .cont-table-report {font-family: Arial, Helvetica, sans-serif; font-size: 10px;}
			.text-firma {font-family: Arial, Helvetica, sans-serif; font-size: 11px; font-weight: bold; border-top: 0.12em solid #2F2F2F;}
			
			
			.borde-tabla {border-right: 1px solid #2F2F2F; border-bottom: 1px solid #2F2F2F;}
			.borde-cell {border-top: 1px solid #2F2F2F; border-left: 1px solid #2F2F2F;}
			.borde-line {border-bottom: 0.12em dotted #2F2F2F;}
			.saltopagina{ PAGE-BREAK-AFTER: always; }
			
			.back-sty {background-color: #F2F2F2; }
			.currency-align { text-align:right; }
			p { margin-bottom: 5px; margin-top: 5px;}
			-->
		</style>
	</head>
	<body onLoad="window.print()">
		<table width="800" border="0" cellpadding="0" cellspacing="0" align="center">
			<tr>
	    		<td>
	    			<table width="100%" border="0" cellpadding="0" cellspacing="0" class="borde-tabla">
						<tr>
							<td rowspan="2" align="center" width="40%" class="borde-cell"><p><img src="../img/adsumcuasipequeno.jpg"></p></td>
							<td width="60%" class="head-title-report borde-cell"><b>GESTION DE MANTENIMIENTO</b></td>
						</tr>
						<tr><td class="head-title-report borde-cell"><b>ORDEN DE TRABAJO No. <?php echo $ordetrab["ordtracodigo"]; ?></b></td></tr>
	    			</table>
	    		</td>
	    	</tr>
	    	<tr><td style="height: 10px;"></td></tr>
			<tr>
	    		<td class="borde-line">
	    			<table width="100%" border="0" cellpadding="0" cellspacing="1">
						<tr>
			    			<td width="15%"><span class="head-title-table">Fecha de Generaci&oacute;n</span></td>
			    			<td width="25%"><span class="cont-table-report"><?php echo date("Y-m-d h:i a",strtotime($ordetrab["ordtrafecgen"]." ".$ordetrab["ordtrahorgen"])); ?></span></td>
			    			<td width="10%"><span class="head-title-table">Ubicaci&oacute;n</span></td>
			    			<td width="50%"><span class="cont-table-report"><?php echo $planta[plantanombre]; ?></span></td>
			    		</tr>
			    		<tr><td style="height: 3px;" colspan="4"></td></tr>
						<tr>
			    			<td><span class="head-title-table">Proceso</span></td>
			    			<td><span class="cont-table-report"><?php echo $sistema[sistemnombre]; ?></span></td>
			    			<td><span class="head-title-table">Equipo</span></td>
			    			<td><span class="cont-table-report"><?php echo $equipo[equipocodigo].' / '.$equipo[equiponombre]; ?></span></td>
			    		</tr>
			    		<?php if($componente[componcodigo]):?>
						<tr>
			    			<td><span class="head-title-table">Componente</span></td>
			    			<td><span class="cont-table-report"><?php echo $componente[componcodigo]; ?></span></td>
			    		</tr>
			    		<?php endif; ?>
			    		<tr><td style="height: 6px;" colspan="4"></td></tr>
	    			</table>
	    		</td>
	    	</tr>
	    	<tr><td style="height: 6px;"></td></tr>
			<tr>
	    		<td class="borde-line">
	    			<table width="100%" border="0" cellpadding="0" cellspacing="1">
	    			<?php	if ($soliserv[solsercodigo] != null): ?>
						<tr>
			    			<td width="60%"><span class="head-title-table">Descripci&oacute;n de la solicitud</span></td>
			    			<td width="40%"><span class="head-title-table">Fecha / Hora de la solucitud</span></td>
			    		</tr>
			    	<?php 
	      						$texto = split("::", $soliserv[solsermotivo]);
								$contador = count($texto);
								
								for ($i = 0; $i < $contador; $i++):
			      					$texto1 = split("--", $texto[$i]);
			    	?>
			    		<tr>
			    			<td><span class="cont-table-report"><?php echo $texto1[3] ?></span></td>
			    			<td><span class="cont-table-report"><?php echo $texto1[1].' '.$texto1[2] ?></span></td>
			    		</tr>
			    	<?php 		endfor; ?>
			    	<?php 	else: ?>
			    		<tr><td colspan="2"><span class="head-title-table">La orden de trabajo no se gener&oacute; a partir de una Solicitud de Servicio</span></td></tr>
			    	<?php 	endif; ?>
			    		<tr><td style="height: 6px;" colspan="2"></td></tr>
	    			</table>
	    		</td>
	    	</tr>
	    	<tr><td style="height: 6px;"></td></tr>
			<tr>
	    		<td class="borde-line">
	    			<table width="100%" border="0" cellpadding="0" cellspacing="1">
						<tr>
			    			<td width="28%"><span class="head-title-table">Fecha de Ejecuci&oacute;n</span>&nbsp;&nbsp;<span class="cont-table-report"><?php echo date("Y-m-d h:i a",strtotime($ordetrab[ordtrafecini]." ".$ordetrab[ordtrahorini]));?></span></td>
			    			<td width="35%"><span class="head-title-table">Fecha estimada a finalizar</span>&nbsp;&nbsp;<span class="cont-table-report"><?php echo date("Y-m-d h:i a",strtotime($ordetrab[ordtrafecfin]." ".$ordetrab[ordtrahorfin]));?></span></td>
			    			<td width="37%"><span class="head-title-table">Fecha/hora de Terminaci&oacute;n</span>____________________</td>
			    		</tr>
			    		<tr><td style="height: 6px;" colspan="3"></td></tr>
	    			</table>
	    		</td>
	    	</tr>
	    	<tr><td style="height: 6px;"></td></tr>
			<tr>
	    		<td class="borde-line">
	    			<table width="100%" border="0" cellpadding="0" cellspacing="1">
						<tr>
			    			<td width="20%"><span class="head-title-table">Encargado</span></td>
			    			<td width="80%"><span class="cont-table-report"><?php echo $encargado[usuanombre]."&nbsp;".$encargado[usuapriape]."&nbsp;".$encargado[usuasegape]; ?></span></td>
			    		</tr>
			    		<tr><td style="height: 6px;" colspan="2"></td></tr>
	    			</table>
	    		</td>
	    	</tr>
	    	<tr><td style="height: 6px;"></td></tr>
			<tr>
	    		<td class="borde-line">
	    			<table width="100%" border="0" cellpadding="0" cellspacing="1">
						<tr>
			    			<td width="20%"><span class="head-title-table">Auxiliares de Mantenimiento</span></td>
			    			<td width="80%"><span class="cont-table-report"><?php
						      	include('../src/FunGen/floadusuaaux.php');
						      	$idcon = fncconn();
						      	floadusuaaux($sbregusuaselec,$idcon);
						      	fncclose($idcon);
						   ?></span></td>
			    		</tr>
			    		<tr><td style="height: 6px;" colspan="2"></td></tr>
	    			</table>
	    		</td>
	    	</tr>
	    	<tr><td style="height: 6px;"></td></tr>
			<tr>
	    		<td class="borde-line">
	    			<table width="100%" border="0" cellpadding="0" cellspacing="1">
						<tr>
			    			<td width="15%"><span class="head-title-table">Solicitante</span></td>
			    			<td width="25%"><span class="cont-table-report">Jefe  Mantenimiento</span></td>
			    			<td width="10%"><span class="head-title-table">Generada por</span></td>
			    			<td width="50%"><span class="cont-table-report"><?php echo $usuario[usuanombre]."&nbsp;".$usuario[usuapriape]."&nbsp;".$usuario[usuasegape]; ?></span></td>
			    		</tr>
			    		<tr><td style="height: 6px;" colspan="4"></td></tr>
	    			</table>
	    		</td>
	    	</tr>
	    	<tr><td style="height: 6px;"></td></tr>
			<tr>
	    		<td class="borde-line">
	    			<table width="100%" border="0" cellpadding="0" cellspacing="1">
						<tr>
				    		<td width="15%"><span class="head-title-table">Tipo de Mantenimiento</span></td>
						    <td width="15%"><span class="cont-table-report"><?php echo $tipomant[tipmannombre] ?></span></td>
						    <td width="10%"><span class="head-title-table">Prioridad</span></td>
						    <td width="15%"><span class="cont-table-report"><?php echo $prioridad[priorinombre] ?></span></td>
						    <td width="10%"><span class="head-title-table">Tipo de Falla</span></td>
						    <td width="35%"><span class="cont-table-report"><?php echo $tipofalla[tipfalnombre] ?></span></td>
						</tr>
	  				</table>
	    		</td>
	    	</tr>
	    	<tr><td style="height: 6px;"></td></tr>
			<tr>
	    		<td class="borde-line">
	    			<table width="100%" border="0" cellpadding="0" cellspacing="1">
						<tr>
							<td width="13%"><span class="head-title-table">Tipo de Trabajo</span></td>
						    <td width="22%"><span class="cont-table-report"><?php echo $tipotrabaj[tiptranombre] ?></span></td>
						    <td width="15%"><span class="head-title-table">Descripci&oacute;n del Trabajo a Realizar</span></td>
						    <td width="50%"><span class="cont-table-report"><?php 
					      		if($tareot["tareotnota"])
								{ 
									$datostarea = $sbregtareot1["tareotnota"];
									$datosdetarea = explode(".", $datostarea);
								    $cantdatos = count($datosdetarea);
									
								    for ($j=0; $j < $cantdatos; $j++)
									{
									  	echo "[&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;]&nbsp;".$datosdetarea[$j]."<br>";
									}
								}
								else
								{ 
									echo $sbregtarnota;
								}
						 ?></span></td>
						</tr>
	  				</table>
	    		</td>
	    	</tr>
	    	<tr><td style="height: 12px;"></td></tr>
	    	<tr>
	    		<td>
	    			<table width="100%" border="0" cellpadding="0" cellspacing="1">
						<tr>
							<td width="18%" valign="top"><span class="head-title-table"><strong>Comentarios de Seguridad</strong></span></td>
							<td><span class="cont-table-report">* Utilizar todos los elementos de seguridad como casco, guantes, gafas, botas, cintur&oacute;n ergon&oacute;mico y protectores auditivos de acuerdo a los manuales de procedimientos seguros establecidos por Ela empresa</span></td>
						</tr>
	    			</table>
	    		</td>
	    	</tr>
	    	<tr><td style="height: 10px;"></td></tr>
	    	<tr><td><span class="head-title-table"><strong>Observaciones</strong></span></td></tr>
	    	<tr>
	    		<td>
	    			<table width="100%" border="0" cellpadding="1" cellspacing="0" class="borde-tabla">
						<tr><td class="borde-cell">&nbsp;</td></tr>
						<tr><td class="borde-cell">&nbsp;</td></tr>
						<tr><td class="borde-cell">&nbsp;</td></tr>
						<tr><td class="borde-cell">&nbsp;</td></tr>
						<tr><td class="borde-cell">&nbsp;</td></tr>
						<tr><td class="borde-cell">&nbsp;</td></tr>
						<tr><td class="borde-cell">&nbsp;</td></tr>
						<tr><td class="borde-cell">&nbsp;</td></tr>
						<tr><td class="borde-cell">&nbsp;</td></tr>
						<tr><td class="borde-cell">&nbsp;</td></tr>
	    			</table>
	    		</td>
	    	</tr>
	    	<tr><td style="height: 100px;"></td></tr>
	    	<tr>
	    		<td>
	    			<table width="100%" border="0" cellpadding="1" cellspacing="0">
						<tr>
							<td width="45%" class="text-firma">Firma solicitante</td>
							<td width="10%">&nbsp;</td>
							<td width="45%" class="text-firma">Firma trabajador</td>
						</tr>
						<tr><td style="height: 100px;" colspan="3"></td></tr>
						<tr>
							<td class="text-firma">Recibe ingeniero de mantenimiento</td>
							<td >&nbsp;</td>
							<?php 
								if($tipotrabaj[tiptracodigo] == 27 || $tipotrabaj[tiptracodigo] == 19 || $tipotrabaj[tiptracodigo] == 28 || $tipotrabaj[tiptracodigo] == 29 || $tipotrabaj[tiptracodigo] == 30) $pasa = 1; 
							?>
							<?php if(!$ordetrab[ordtranumpro] || $pasa): ?><td class="text-firma">Enterado ingeniero de operaci&oacute;n y/o operador planta</td><?php endif ?>
						</tr>
	    			</table>
	    		</td>
	    	</tr>
		</table>
	</body>
</html>
