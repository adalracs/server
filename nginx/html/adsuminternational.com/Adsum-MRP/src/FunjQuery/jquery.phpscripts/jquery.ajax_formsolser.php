<?php 
	include '../../FunPerSecNiv/fncconn.php';
	include '../../FunPerSecNiv/fncclose.php';
	include '../../FunPerSecNiv/fncnumreg.php';
	include '../../FunPerSecNiv/fncfetch.php';
	
	//-----
	include ( '../../FunPerPriNiv/pktblot.php');
	include ( '../../FunPerPriNiv/pktblusuario.php');
	include ( '../../FunPerPriNiv/pktblplanta.php');
	include ( '../../FunPerPriNiv/pktblequipo.php');
	include ( '../../FunPerPriNiv/pktblsistema.php');
	include ( '../../FunPerPriNiv/pktblcomponen.php');
	include ( '../../FunPerPriNiv/pktbltipomant.php');
	include ( '../../FunPerPriNiv/pktblotestado.php');
	include ( '../../FunPerPriNiv/pktblpriorida.php');
	include ( '../../FunPerPriNiv/pktbltipotrab.php');
	include ( '../../FunPerPriNiv/pktbltipocump.php');
	include ( '../../FunPerPriNiv/pktbltarea.php');
	include ( '../../FunPerPriNiv/pktblreportot.php');
	include ( '../../FunGen/cargainput.php');
	include ( '../../FunGen/floadtimehours.php');
	include ( '../../FunGen/floadtimeminut.php');
	include ( '../../FunGen/sesion/fnccarga.php');

	if($ordtracodigo):
		$idcon = fncconn();
		$sbregot = loadrecordot($ordtracodigo,$idcon);
	
		if($sbregot < 0):
			echo "No se encontro la orden de trabajo";
		else:
			
			$irecOrden["ordtracodigo"] = $ordtracodigo;
			$sbregReportot = dinamicscanopreportot(array('ordtracodigo' => $ordtracodigo),array('ordtracodigo' => '='),  $idcon);
			
			$rw_reporte = fncfetch($sbregReportot, 0);
		
			include_once( '../../FunPerPriNiv/pktbltareot.php');
			$sbregtareot = buscartareotordtracodigo($sbregot[ordtracodigo],$idcon);

			if($sbregtareot > 0):
				$iRecordusertareot[tareotcodigo] = $sbregtareot[tareotcodigo]; 
				include ( '../../FunPerPriNiv/pktblusuariotareot.php');
				$nuResult = dinamicscanusuariotareot($iRecordusertareot,$idcon);
					
				if($nuResult > 0):
					$nuCantRow = pg_numrows($nuResult);
					
					if ($nuCantRow > 0):
						for($i = 0; $i < $nuCantRow; $i++):
							$sbRow = pg_fetch_row ($nuResult,$i);
								
							$user_ot = loadrecordusuario($sbRow[1], $idcon);
							$usrname1 = $sbRow[1]." - " .$user_ot["usuanombre"]." ".$user_ot["usuapriape"]." ".$user_ot["usuasegape"];
							if($sbRow[3] == 't')
								$user_encargado = $usrname1;
							else
								$user_aux[] = $usrname1;
						endfor;
					endif;
				endif;
			endif;
		endif;
	endif;
?>

<table width="95%" border="0" cellspacing="1" cellpadding="0" align="center">
	<tr>
		<td>
			<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" class="ui-widget-content">
				<tr class="ui-widget-header">
					<td width="50%" class="cont-title">&nbsp;Orden de trabajo No.&nbsp;<?php echo $ordtracodigo; ?></td>
					<td width="50%" class="cont-title">&nbsp;Generado.&nbsp;<?php if($sbregot['ordtrafecgen']) echo $sbregot['ordtrafecgen']." " .date("h:i a", strtotime($sbregot['ordtrahorgen'])) ?></td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td>
			<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center"  class="ui-widget-content">
				<tr class="ui-state-default"><td class="cont-title">&nbsp;Datos de la orden</td></tr>
			</table>
			<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
				<tr>
					<td class="NoiseFooterTD">&nbsp;Ubicaci&oacute;n</td>
					<td colspan="3" class="NoiseDataTD"><?php echo cargaplantanombre($sbregot['plantacodigo'], $idcon); ?></td>
				</tr>
				<tr>
					<td class="NoiseFooterTD">&nbsp;Sistema</td>
					<td colspan="3" class="NoiseDataTD"><?php echo cargasistemnombre($sbregot['sistemcodigo'], $idcon); ?></td>
				</tr>
				<tr>
					<td class="NoiseFooterTD">&nbsp;Equipo</td>
					<td colspan="3" class="NoiseDataTD"><?php echo cargaequiponombre($sbregot['equipocodigo'], $idcon); ?></td>
				</tr>
				<?php if($sbregot['componcodigo']): ?>
				<tr>
					<td class="NoiseFooterTD">&nbsp;Componente</td>
					<td colspan="3" class="NoiseDataTD"><?php echo cargacomponnombre($sbregot['componcodigo'], $idcon); ?></td>
				</tr>
				<?php endif ?>
				<tr><td class="ui-state-default" colspan="4"></td></tr>
				<tr>
					<td class="NoiseFooterTD">&nbsp;Prioridad</td>
					<td colspan="3" class="NoiseDataTD"><?php echo cargapriorinombre($sbregtareot['prioricodigo'], $idcon); ?></td>
				</tr>
				<tr>
					<td class="NoiseFooterTD">&nbsp;Mantenimiento</td>
					<td colspan="3" class="NoiseDataTD"><?php echo cargatipmannombre($sbregot['ordtracodigo'], $idcon); ?></td>
				</tr>
				<tr>
					<td class="NoiseFooterTD">&nbsp;Tarea</td>
					<td colspan="3" class="NoiseDataTD"><?php if ($sbregot['ordtracodigo'] != null) echo cargatareanombre($sbregot[ordtracodigo], $idcon); ?></td>
				</tr>
				<tr>
					<td class="NoiseFooterTD">&nbsp;Tipo de trabajo</td>
					<td colspan="3" class="NoiseDataTD"><?php echo cargadetalleprogtiptrab($sbregtareot['tiptracodigo'], $idcon); ?></td>
				</tr>
				<tr>
					<td class="NoiseFooterTD">&nbsp;Descripcion del Trabajo</td>
					<td colspan="3" class="NoiseDataTD"><?php echo $sbregtareot['ordtradescri']; ?></td>
				</tr>
				<tr><td class="ui-state-default" colspan="4"></td></tr>
				<tr>
					<td width="20%" class="NoiseFooterTD">&nbsp;Fecha de inicio</td>
					<td width="30%" class="NoiseErrorDataTD">&nbsp;<b><?php if($sbregot['ordtrafecini']) echo $sbregot['ordtrafecini'].' '.date("h:i a", strtotime($sbregot['ordtrahorini'])); ?></b></td>
					<td width="20%" class="NoiseFooterTD">&nbsp;Fecha estimada a finalizar</td>
					<td width="30%" class="NoiseErrorDataTD">&nbsp;<b><?php if($sbregot['ordtrafecfin']) echo $sbregot['ordtrafecfin'].' '.date("h:i a", strtotime($sbregot['ordtrahorfin'])); ?></b></td>
				</tr>
				<tr>
					<td class="NoiseFooterTD">&nbsp;</td>
					<td class="NoiseFooterTD">&nbsp;aaaa-mm-dd h:mm am/pm</td>
					<td class="NoiseFooterTD">&nbsp;</td>
					<td class="NoiseFooterTD">&nbsp;aaaa-mm-dd h:mm am/pm</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td>
			<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center"  class="ui-widget-content">
				<tr class="ui-state-default"><td class="cont-title">&nbsp;Empleado de Mantenimiento</td></tr>
			</table>
			<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
				<tr>
					<td width="20%" class="NoiseFooterTD">Encargado</td>
					<td width="80%" class="NoiseErrorDataTD"><?php echo $user_encargado; ?></td>
				</tr>
				<tr><td class="ui-state-default" colspan="2"></td></tr>
				<tr>
					<td class="NoiseFooterTD" rowspan="<?php echo count ( $user_aux ); ?>">Auxiliar</td>
					<td class="NoiseDataTD"> <?php echo $user_aux[0]; ?></td>
				</tr>
				<?php for($i = 1; $i <= count ( $user_aux ); $i ++): ?>
				<tr><td class="NoiseDataTD"> <?php echo $user_aux [$i]; ?></td></tr>
				<?php endfor ?>
			</table>
		</td>
	</tr>
	<tr>
		<td>
			<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center"  class="ui-widget-content">
				<tr class="ui-state-default"><td class="cont-title">&nbsp;Descripcion del Reporte</td></tr>
				<tr><td class="NoiseErrorDataTD"><?php echo $rw_reporte['reportdescri']; ?></td></tr>
			</table>
		</td>
	</tr>
	<tr><td class="ui-state-default"></td></tr>
	<tr> 
 		<td class="NoiseFooterTD">&nbsp;Cumplimiento&nbsp;&nbsp;&nbsp;&nbsp; 
			<select name="tipcumcodigo"  id="tipcumcodigo">
			<?php
				$result = fullscantipocump($idcon);
				$nr_cierreot = fncnumreg($result);
				
				for($i = 0; $i < $nr_cierreot; $i++):
					$rw_cierreot = fncfetch($result, $i);
				
					echo '<option value = "'.$rw_cierreot['tipcumcodigo'].'"';
					
					if($rw_cierreot['tipcumcodigo'] == 4)
						echo ' selected';
					
					echo '">'.$rw_cierreot['tipcumnombre'].'</option>';
				endfor;
			?>
			</select> 
 		</td> 
	</tr> 
	<tr><td class="ui-state-default"></td></tr>
	<tr><td class="NoiseFooterTD">&nbsp;Descripci&oacute;n</td></tr>
	<tr><td class="NoiseErrorDataTD"><textarea name="cierotdescri" id="cierotdescri" cols="90" rows="2"></textarea></td></tr>
</table>
<input type="hidden" name="ordtracodigo" id="ordtracodigo" value="<?php echo $ordtracodigo ?>">