<?php
	include ( '../src/FunPerSecNiv/fncconn.php');
	include ( '../src/FunPerSecNiv/fncnumreg.php');
	include ( '../src/FunPerSecNiv/fncfetch.php');
	include ( '../src/FunPerSecNiv/fncclose.php');
//
//	include '../src/FunPerPriNiv/pktblrecaudo.php';
//	include '../src/FunPerPriNiv/pktblrecaudocomerc.php';
//	include '../src/FunPerPriNiv/pktblippipc.php';
//	include '../src/FunPerPriNiv/pktblenergia.php';
//	include '../src/FunPerPriNiv/pktblenergiaexccom.php';
//	include '../src/FunPerPriNiv/pktbldatos.php';
//	include '../src/FunPerPriNiv/pktbldatosentrada.php';
//	include '../src/FunPerPriNiv/pktblexphurtcpl.php';
//	include '../src/FunPerPriNiv/pktblpodaarboles.php';
//	include '../src/FunPerPriNiv/pktblcrecsap.php';
//	//----
//	include '../src/FunPerPriNiv/pktblflujejecdetalle.php'; 
//	include '../src/FunPerPriNiv/pktblhelmtrusttrans.php';
//	include '../src/FunPerPriNiv/pktblhelmtrustcuenta.php';
//	include '../src/FunPerPriNiv/pktblhelmtrustadacta.php';
//	include '../src/FunPerPriNiv/pktblcomercializadores.php';
//	include '../src/FunGen/fncformat.php';
//	include ('../src/FunGen/cargainput.php');
//	
//	$idcon = fncconn();
//	
//	include_once '../src/FunPerPriNiv/pktblflujoejecutado.php';
//	
//	ini_set("display_errors", 1);
//	
//	$sbreg = loadrecordflujoejecutadoacta($number, $idcon);
//	$sbreg2 = loadrecordflujoejecutadoacta(($number - 1), $idcon);
//	
//	$fluejemes = $sbreg['fluejemes'];
//	$fluejeano = $sbreg['fluejeano'];
//	
//	$month = $fluejemes;
//	$year = $fluejeano;
//	
//	$date = (date('Y-m-d', strtotime($fluejeano.'-'.$fluejemes.'-1 - 1 months')));
//	$fields_ = array( 'fluejemes' => date('n', strtotime($date)), 'fluejeano' => date('Y', strtotime($date)) );
//	$fields_atc = array( 'heladames' => $month, 'heladaano' => $year );
//	
//	$rs_flujejecdetalle = loadrecordflujejecdetalle($sbreg['fluejecodigo'], $idcon);
//	$rs_flujejecdetalle2 = loadrecordflujejecdetalle($sbreg2['fluejecodigo'], $idcon);
//	
//	foreach($rs_flujejecdetalle[0] as $key => $value)
//		$$key = $value;
//			
//	include 'detallaimpresionacta.php';
//
//	if(date('n', strtotime('30-'.$fluejemes.'-'.$fluejeano.' + 1 days')) == $fluejemes)
//		$day = 31;
//	else
//		$day = 30;
//	
//	
//	//=== HelmTrust ===//
//	$rs_helmtrust = dinamicscanhelmtrusttrans(array('helmtrmes' => $fluejemes, 'helmtrano' => $fluejeano), $idcon);
//	$nr_helmtrust = fncnumreg($rs_helmtrust);
//	//=== HelmTrust ===//


	include '../src/FunPerPriNiv/pktblareafuncio.php';
	include '../src/FunPerPriNiv/pktblcuadrilla.php';
	include '../src/FunPerPriNiv/pktblcuadrillausuario.php';

	$idcon = fncconn();
	$rs_areafuncio = fullscanareafuncio($idcon);
	$nr_areafuncio = fncnumreg($rs_areafuncio);	


	$maxDay = strftime("%d", mktime(0, 0, 0, 6 + 1, 0, 2011));
	$widthGroup = 950 - ($maxDay * 25);
	
	$arr_mes = array('L','M','Mi','J','V','S','D');
?>
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<title>Acta # <?php echo $number ?></title>
		<style type="text/css">
			<!--
			body { font-family: Arial, Helvetica, sans-serif; font-size: 12px; }
			.text-head-title { font-size: 9px; }
			.Estilo6 {font-size: 11px; }
			.back-sty {background-color: #F2F2F2; }
			.Estilo6 Estilo10 {font-family: Arial, Helvetica, sans-serif; font-size: 11px; font-weight: bold; }
			.Estilo10 {font-family: Arial, Helvetica, sans-serif}
			.borde-tabla {border-right: 1px dotted #2F2F2F; border-bottom: 1px dotted #2F2F2F;}
			.borde-cell {border-top: 1px dotted #2F2F2F; border-left: 1px dotted #2F2F2F;}
			.borde-line {border-top: 1px dotted #2F2F2F;}
 			.Estilo40 { text-align:right; }
			.saltopagina
			{
				PAGE-BREAK-AFTER: always;
			}
			-->
		</style>
	</head>
	<body onLoad="setInterval('window.print();',1000);">
		<table width="950" border="0" cellpadding="0" cellspacing="1" align="center">
 			<tr>
    			<td>
    				<table width="100%" border="0" cellpadding="0" cellspacing="0">
						<tr><td><div align="center" class="Estilo6 Estilo10"><b>PROGRAMACION DE TURNOS</b></div></td></tr>
    				</table>
    			</td>
    		</tr>
    		<tr><td>&nbsp;</td></tr>
    		<tr><td><span class="Estilo6 Estilo10">MAYO 2011</span></td></tr>
  			<tr>
  				<td>
	  				<table width="100%" border="0" cellpadding="1" cellspacing="1">
	  					<tr><td colspan="2"></td></tr>
	  					<tr>
			    			<td width="20%"></td>
			    			<td width="80%"><span class="Estilo6 Estilo10"><?php echo $number ?></span></td>
			    		</tr>
			    		<tr>
			    			<td width="20%"><span class="Estilo6 Estilo10">Mes de:</span></td>
			    			<td width="80%"><span class="Estilo6 Estilo10"><?php echo sprintf('%s de %s', $arr_mes[$sbreg['fluejemes']-1], $sbreg['fluejeano']) ?></span></td>
		    			</tr>
			    		<tr>
			    			<td width="20%"><span class="Estilo6 Estilo10">Fecha:</span></td>
			    			<td width="80%"><span class="Estilo6 Estilo10"><?php echo sprintf('%s de %s de %s', date('d'), $arr_mes[date('n')-1], date('Y')) ?></span></td>
		    			</tr>
		    			<tr><td colspan="2" class="borde-line">&nbsp;</td></tr>
		    		</table>
    			</td>
  			</tr>
  			<tr>
  				<td>
  					<table width="100%" border="0" cellspacing="0" cellpadding="0" class="borde-tabla">
      					<tr>
        					<td width="<?php echo $widthGroup ?>" rowspan="2" class="borde-cell"><span class="Estilo6 Estilo10">&nbsp;GRUPO</span></td>
        					<?php for($a = 0; $a < $maxDay; $a++): ?>
        					<td width="25" class="borde-cell"><span class="text-head-title"><?php echo ($a + 1)?></span></td>
        					<?php endfor; ?>
      					</tr>
      					<tr>
        					<?php for($a = 0; $a < $maxDay; $a++): ?>
        					<td width="25" class="borde-cell"><span class="text-head-title">T1</span></td>
        					<?php endfor; ?>
      					</tr>
		    		</table>
    			</td>
  			</tr>
  			<?php 
  				for($a = 0; $a < $nr_areafuncio; $a++):	
  					$rw_areafuncio = fncfetch($rs_areafuncio, $a);
  					
  					$strSQL = "	SELECT cuadrilla.cuadricodigo, cuadrilla.cuadrinombre, cuadrillausuario.usuacodi 
								FROM cuadrilla LEFT JOIN cuadrillausuario ON cuadrillausuario.cuadricodigo = cuadrilla.cuadricodigo 
								WHERE cuadrilla.arefuncodigo = '{$rw_areafuncio['arefuncodigo']}'";
  				
  					$rs_cuadrilla = pg_exec($idcon, $strSQL); 
					$nr_cuadrilla = fncnumreg($rs_cuadrilla);
  					
					if($nr_cuadrilla):
  			?>
  			<tr>
  				<td>
  					<table width="100%" border="0" cellspacing="0" cellpadding="0" class="borde-tabla">
  			<?php 		
  						for($b = 0; $b < $nr_cuadrilla; $b++): 
  							$rw_cuadrilla = fncfetch($rs_cuadrilla, $b);
  						?>
      					<tr>
        					<td width="<?php echo $widthGroup ?>" class="borde-cell"><span class="Estilo6 Estilo10">&nbsp;<?php echo $rw_cuadrilla['cuadrinombre']  ?></span></td>
        					<?php for($a = 0; $a < $maxDay; $a++): ?>
        					<td width="25" class="borde-cell"><span class="text-head-title">T1</span></td>
        					<?php endfor; ?>
      					</tr>
      		<?php 
      					endfor ?>
		    		</table>
    			</td>
  			</tr>
  			<?php
  					endif;
  				endfor; ?>
	  		<tr><td>&nbsp;</td></tr>
	  		<tr><td>&nbsp;</td></tr>
		</table>
		<script type="text/javascript">window.print();</script>
	</body>
</html>
