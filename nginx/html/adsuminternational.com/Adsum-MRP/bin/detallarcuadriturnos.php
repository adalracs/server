<?php 	
	include ( '../src/FunPerSecNiv/fncconn.php');
	include ( '../src/FunPerSecNiv/fncnumreg.php');
	include ( '../src/FunPerSecNiv/fncfetch.php');
	include ( '../src/FunPerSecNiv/fncclose.php');
	
	$arrFecha = explode("-", $d);
	$arrFiltro = explode("e", $ID);
	
	$maxDay = strftime("%d", mktime(0, 0, 0, $arrFecha[0] + 1, 0, $arrFecha[1]));
	$dateFecini = date("Y-m-d", strtotime($arrFecha[1].'-'.$arrFecha[0].'-1'));
	$dateFecfin = date("Y-m-d", strtotime($arrFecha[1].'-'.$arrFecha[0].'-'.$maxDay));
	
	
	$arrDay = array('D','L','M','Mi','J','V','S');
	$idcon = fncconn();
	
	//====
	$strSql = "	SELECT * 
  				FROM calendario 
  					LEFT JOIN turno ON turno.turnocodigo = calendario.turnocodigo
  				WHERE calendario.calendfecini BETWEEN '{$dateFecini}' AND '{$dateFecfin}' ORDER BY calendfecini";
  							
  	$rs_turnos = pg_exec($idcon, $strSql); 
	$nr_turnos = fncnumreg($rs_turnos);
	
	
	for($a = 0; $a < $nr_turnos; $a++):
		$rw_turnos = fncfetch($rs_turnos, $a);
		
		if($rw_turnos['calenddescan']):
			$arrTurnos[$rw_turnos['cuadricodigo']][date("j", strtotime($rw_turnos['calendfecini']))] = "D";
		else:
			$arrTurnos[$rw_turnos['cuadricodigo']][date("j", strtotime($rw_turnos['calendfecini']))] = $rw_turnos['turnoacroni'];
			$arrDetallTurno[$rw_turnos['turnoacroni']] = date("h:i a", strtotime($rw_turnos['turnohorini'])).' a '.date("h:i a", strtotime($rw_turnos['turnohorfin']));
		endif;
	endfor;
	
	$arrDetallTurno["D"] = 'DESCANSO';
	//====
	
	
	include '../src/FunPerPriNiv/pktblareafuncio.php';
	include '../src/FunPerPriNiv/pktblcalendario.php';
	include '../src/FunPerPriNiv/pktblusuanovedad.php';
	include '../src/FunPerPriNiv/pktblcuadrilla.php';
	include '../src/FunPerPriNiv/pktblcuadrillausuario.php';
	include '../src/FunPerPriNiv/pktblfestivo.php';
	include '../src/FunPerPriNiv/pktblusuario.php';
	include '../src/FunGen/fnccalendario.php';
	include '../src/FunGen/cargainput.php';
	
	
	if($arrFiltro[3]):
		$rs_areafuncio = dinamicscanareafuncio(array('arefuncodigo' => $arrFiltro[3]), $idcon);
	elseif($arrFiltro[2]):
		$rs_areafuncio = dinamicscanareafuncio(array('departcodigo' => $arrFiltro[2]), $idcon);
	elseif($arrFiltro[1]):
		//====
		$strSql = "	SELECT areafuncio.* 
	  				FROM areafuncio 
	  					LEFT JOIN departam ON departam.departcodigo = areafuncio.departcodigo
	  				WHERE departam.negocicodigo = '{$arrFiltro[1]}'";
	  							
  		$rs_areafuncio = pg_exec($idcon, $strSql);
  	else:
		$rs_areafuncio = fullscanareafuncio($idcon);
	endif;
		
	$nr_areafuncio = fncnumreg($rs_areafuncio);
	$arrFestivo = getArrFestivo();
?>
<html> 
	<head> 
		<title>Detalle de registro de turnos cuadrilla</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0"> 
		<?php include('../def/jquery.library_maestro.php');?>
		<link rel="stylesheet" type="text/css" href="temas/themes/fullcalendar.css">
		<style type="text/css">
			<!--
			body { font-family: Arial, Helvetica, sans-serif; font-size: 12px; }
			.text-head-title { font-size: 9px; font-weight: bold; text-align:center; }
			.text-content-title { font-size: 9px; font-weight: normal; text-align:center; }
			.text-label-title { font-size: 11px; font-weight: normal; }
			.text-label-resum { font-size: 9px; font-weight: normal; }
			.saltopagina { PAGE-BREAK-AFTER: always; }
			.fc-festiv { border: 1px solid #FFC0C0; border-top: none; border-left: none; }
			.ui-state-default { border-top: none; border-left: none; }
			.fc-content { border-left: 1px solid #C5DBEC; }
			.border-up { border-top: 1px solid #C5DBEC; }
			-->
		</style>
	</head> 
	<body bgcolor="FFFFFF" text="#000000">
		<table width="1250" border="0" cellpadding="0" cellspacing="1" align="center">
 			<tr>
    			<td>
    				<table  width="100%" border="0" cellpadding="0" cellspacing="0">
						<tr><td><div align="center" class="Estilo6 Estilo10"><b>PROGRAMACION DE TURNOS</b></div></td></tr>
						<?php $mes = explode('-', $dateFecini); $meses = array("ENERO","FEBRERO","MARZO","ABRIL","MAYO","JUNIO","JULIO","AGOSTO","SEPTIEMBRE","OCTUBRE","NOVIEMBRE","DICIEMBRE");?>
						<tr><td><div align="center" class="Estilo6 Estilo10"><b><?php echo $meses[$mes[1]-1]; ?></b></div></td></tr>
    				</table>
    			</td>
    		</tr>
    		<tr><td>&nbsp;</td></tr>
    		<tr>
  				<td>
  					<table border="0" cellspacing="0" cellpadding="0" class="fc-content border-up">
      					<tr>
        					<td width="400" rowspan="2" class="ui-state-default"><span class="Estilo6 Estilo10">&nbsp;GRUPO</span></td>
        					<?php 
        						for($a = 0; $a < $maxDay; $a++):
        							$day[$a] = date("w", strtotime($arrFecha[1].'-'.$arrFecha[0].'-'.($a + 1)));
        							
        							if($arrDay[$day[$a]] == 'D' || $arrFestivo[$arrFecha[0]][($a + 1)])
        								$class = 'fc-festiv';
        							elseif($arrDay[$day[$a]] == 'S')
        								$class = 'ui-state-default';
        							else
        								$class = 'ui-state-default fc-not-today';
        					 ?>
        					<td width="26" class="<?php echo $class ?> text-head-title"><?php echo $arrDay[$day[$a]]?></td>
        					<?php endfor; ?>
      					</tr>
      					<tr>
        					<?php 
        						for($a = 0; $a < $maxDay; $a++): 
        							if($arrDay[$day[$a]] == 'D' || $arrFestivo[$arrFecha[0]][($a + 1)])
        								$class = 'fc-festiv';
        							elseif($arrDay[$day[$a]] == 'S')
        								$class = 'ui-state-default';
        							else
        								$class = 'ui-state-default fc-not-today';
        					?>
        					<td width="26" class="<?php echo $class ?> text-head-title"><?php echo ($a + 1) ?></td>
        					<?php endfor; ?>
      					</tr>
		    		</table>
    			</td>
  			</tr>
  			<?php 
  				for($a = 0; $a < $nr_areafuncio; $a++):	
  					$rw_areafuncio = fncfetch($rs_areafuncio, $a);
  					
  					$rs_cuadrilla = dinamicscancuadrilla(array('arefuncodigo' => $rw_areafuncio['arefuncodigo']), $idcon);
					$nr_cuadrilla = fncnumreg($rs_cuadrilla);
  					
					if($nr_cuadrilla):
  			?>
  			<tr>
  				<td>
  					<table border="0" cellspacing="0" cellpadding="0" class="fc-content">
  						<tr><td colspan="2" class="border-up ui-state-default">&nbsp;<?php echo $rw_areafuncio['arefunnombre'] ?></td></tr>
  			<?php 		
  						for($b = 0; $b < $nr_cuadrilla; $b++): 
  							$rw_cuadrilla = fncfetch($rs_cuadrilla, $b);
  							$rs_cuadriusua = loadrecordcuadrillausuariousuario($rw_cuadrilla['cuadricodigo'], $idcon);
  							
  							
  							
  			?>
      					<tr>
        					<td width="100" class="ui-state-default fc-not-today text-label-title"  rowspan="<?php echo count($rs_cuadriusua) ?>">&nbsp;<?php echo $rw_cuadrilla['cuadrinombre']  ?></td>
        					
        	<?php 
        					for($d = 0; $d < count($rs_cuadriusua); $d++):
        						if($d > 0)
        							echo '<tr>';
        	?>
        					<td width="299" class="ui-state-default fc-not-today text-label-title">&nbsp;<?php echo $rs_cuadriusua[$d]['usuacodi'].' - '.cargausuanombre($rs_cuadriusua[$d]['usuacodi'], $idcon)  ?></td>
        	<?php 
        						for($c = 0; $c < $maxDay; $c++):
        							unset($class);
        							$dateNow = date("Y-m-d",strtotime($arrFecha[1].'-'.$arrFecha[0].'-'.($c + 1)));
        							
        							//====
									$strSql = "	SELECT * 
								  				FROM usuanovedad 
								  					LEFT JOIN estadonoveda ON estadonoveda.estnovcodigo = usuanovedad.estnovcodigo
								  				WHERE usuanovedad.usuacodi = '{$rs_cuadriusua[$d]['usuacodi']}' AND ( usunovfecini <= '{$dateNow}' AND usunovfecfin >= '{$dateNow}')";
								  	
								  	$rs_usuanovedad = pg_exec($idcon, $strSql); 
									$nr_usuanovedad = fncnumreg($rs_usuanovedad);
									//====
        							
        							if($nr_usuanovedad > 0):
        								$rw_usuanovedad = fncfetch($rs_usuanovedad, 0);
        							
//        								if($arrDay[$day[$c]] == 'D' || $arrFestivo[$arrFecha[0]][($c + 1)] || $arrDay[$day[$c]] == 'S')
//        									$turno = 'D';
//        								else
        									$turno = $rw_usuanovedad['estnovacroni'];
        									
        								$arrDetallTurno[$rw_usuanovedad['estnovacroni']] = $rw_usuanovedad['estnovnombre'];
        							else:
										if($arrTurnos[$rw_cuadrilla['cuadricodigo']][($c + 1)]) 
											$turno = $arrTurnos[$rw_cuadrilla['cuadricodigo']][($c + 1)]; 
										else 
											$turno = '&nbsp;';	
									endif;        							 
        								
        							
        							if($b < 1 && $d < 1)
        								$class = 'border-up ';
        						
        							if($arrDay[$day[$c]] == 'D' || $arrFestivo[$arrFecha[0]][($c + 1)])
        								$class .= 'fc-festiv';
        							elseif($arrDay[$day[$c]] == 'S')
        								$class .= 'ui-state-default';
        							else
        								$class .= 'ui-state-default fc-not-today';
        					?>
        					<td width="26" class="<?php echo $class ?> text-content-title"><?php echo $turno ?></td>
        					<?php endfor; ?>
      					</tr>
      		<?php 
      						endfor;
      					endfor ?>
		    		</table>
    			</td>
  			</tr>
  			<?php
  					endif;
  				endfor; ?> 
  			<tr><td>&nbsp;</td></tr>
  			<?php if(is_array($arrDetallTurno)): ?>
  			<tr>
  				<td>
  					<table width="200" border="0" cellspacing="0" cellpadding="0" class="fc-content border-up">
						<?php foreach($arrDetallTurno as $key => $value): ?>
      					<tr>
        					<td width="50" class="ui-state-default text-label-resum">&nbsp;<b><?php echo $key ?></b></td>
        					<td width="150" class="ui-state-default fc-not-today text-label-resum">&nbsp;<b><?php echo $value ?></b></td>
      					</tr>
      					<?php endforeach; ?>
		    		</table>
    			</td>
  			</tr>
  			<?php endif ?>
    	</table>
	</body> 
</html>
