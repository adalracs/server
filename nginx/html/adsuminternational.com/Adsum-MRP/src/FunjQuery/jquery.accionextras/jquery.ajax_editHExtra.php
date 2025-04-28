<?php 
	if(!$noAjax):
		include '../../FunPerSecNiv/fncconn.php';
		include '../../FunPerSecNiv/fncclose.php';
		include '../../FunPerSecNiv/fncnumreg.php';
		include '../../FunPerSecNiv/fncfetch.php';
		include '../../FunPerPriNiv/pktblhorasextra.php';
		include '../../FunPerPriNiv/pktblhoraextraot.php';
	endif;
	
	if($horextcodigo):
		$idcon = fncconn();
		$rs_horasextra = loadrecordhorasextra($horextcodigo, $idcon);

		if($rs_horasextra['horextcodigo']):
			$rs_horaextraott = loadrecordhoraextraot($horextcodigo, $idcon);
			
			$strSQL = "	SELECT DISTINCT ot.ordtracodigo, ordtrafecini
						FROM ot LEFT JOIN tareot ON tareot.ordtracodigo = ot.ordtracodigo 
						LEFT JOIN usuariotareot ON usuariotareot.tareotcodigo = tareot.tareotcodigo
						WHERE 
							usuariotareot.usutarcodigo IS NOT NULL AND 
							tareot.tareotcodigo IS NOT NULL AND 
							usuariotareot.usuacodi = '{$rs_horasextra['usuacodi']}' AND 
							ot.ordtracodigo NOT IN (SELECT horaextraot.ordtracodigo FROM horasextra LEFT JOIN horaextraot ON horaextraot.horextcodigo = horasextra.horextcodigo WHERE horasextra.usuacodi = '{$rs_horasextra['usuacodi']}' AND horaextraot.ordtracodigo IS NOT NULL)
						ORDER BY ot.ordtracodigo";
	
			$rs_horaextrot = pg_exec($idcon, $strSQL); 
			$nr_horaextrot = fncnumreg($rs_horaextrot);
		endif;
	endif;
?>

<table width="95%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">						
	<tr>
     	<td class="NoiseFooterTD" width="20%">&nbsp;Hora inicio</td>
     	<td class="NoiseDataTD"  width="30%"><select name="horexthorini" id="horexthorini" onChange="resetHour(); calculeDiff();">
			<?php
				$hora = '00:00';
				for(;;):
					echo '<option value="'.$hora.'"';
					if($hora == date("H:i", strtotime($rs_horasextra['horexthorini'])))
						echo ' selected';
					echo '>'.date("h:i a", strtotime($hora)).'</option>';
					
					$hora = date("H:i", strtotime($hora.' + 30 minutes'));
					
					if($hora == '23:30')
						break;
				endfor;
			?>
		</select></td>
		<td class="NoiseFooterTD" width="20%">&nbsp;Hora fin</td>
     	<td class="NoiseDataTD" width="30%"><select name="horexthorfin" id="horexthorfin" onChange="calculeDiff();">
			<?php
				$hora = '00:00';
				for(;;):
					echo '<option value="'.$hora.'"';
					if($hora < date("H:i", strtotime($rs_horasextra['horexthorini'])))
						echo ' disabled';
					
					if($hora == date("H:i", strtotime($rs_horasextra['horexthorfin'])))
						echo ' selected';
					echo '>'.date("h:i a", strtotime($hora)).'</option>';
					
					$hora = date("H:i", strtotime($hora.' + 30 minutes'));
					
					if($hora == '00:00')
						break;
				endfor;
			?>
		</select></td>
	</tr>
	<tr>
		<td class="NoiseFooterTD" width="20%">&nbsp;Duraci&oacute;n</td>
		<td class="NoiseDataTD"  colspan="3"><span id="duracionhe"><?php echo $duracion ?></span><input type="hidden" value="<?php echo $duracion ?>" id="duracion" name="duracion"></td>
	</tr>
	<tr><td class="ui-state-default" colspan="4"></td></tr>							
 	<tr><td colspan="4" class="NoiseFooterTD">&nbsp;Descripci&oacute;n</td></tr>
  	<tr><td colspan="4" class="NoiseFooterTD"><textarea name="horextdescri" id="horextdescri" rows="3" cols="79" wrap="VIRTUAL"><?php echo $rs_horasextra[horextdescri]; ?></textarea></td></tr>
</table>

<table width="95%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">						
	<tr><td class="ui-state-default"></td></tr>
	<tr> 
		<td>
			<div>
				<div style="width:506px; height: 14px; padding: 3px; margin:0 auto;" class="ui-state-default">
					Listado de Ordenes asiganadas al empleado
				</div>
				<div style="width:512px; height: 150px; margin:0 auto; overflow:auto;" class="ui-widget-content">
					<div style="width:495px; height: auto;">
						<table width="100%" border="0" cellspacing="1" cellpadding="1"  align="center">
							<tr>
								<td width="10%" class="ui-state-default estilo2">Sel&nbsp;<input type="checkbox" id="allheots" name="allheots" value="1" onclick="setSelectionAll('heots',',');"></td>
								<td width="40%" class="ui-state-default estilo2">Orden de trabajo</td>
								<td width="50%" class="ui-state-default estilo2">Fecha de ejecuci&oacute;n</td>
							</tr>
							<?php 
								include '../../FunPerPriNiv/pktblot.php';
							
								for($a = 0; $a < count($rs_horaextraott); $a++):
									$rs_ot = loadrecordot($rs_horaextraott[$a]['ordtracodigo'], $idcon);
									
									if($arrheots)
										$arrheots .= ','.$rs_horaextraott[$a]['ordtracodigo'];
									else
										$arrheots = $rs_horaextraott[$a]['ordtracodigo'];
									
									if($a % 2)
										$class = "NoiseDataTD";
									else
										$class = "NoiseFooterTD";
							?>
							<tr class="<?php echo $class ?>">
								<td width="10%"><input type="checkbox" id="chkheots" name="chkheots" checked onclick="setSelectionRow(this.value, document.getElementById('arrheots').value, ',', 'heots');" value="<?php echo $rs_horaextraott[$a]['ordtracodigo'] ?>"></td>
								<td width="40%">&nbsp;Orden # <?php echo $rs_horaextraott[$a]['ordtracodigo'] ?></td>
								<td width="50%">&nbsp;<?php echo $rs_ot['ordtrafecini'] ?></td>
							</tr>
							<?php 
								endfor; 
								
								for($b = 0; $b < $nr_horaextrot; $b++): 
									$rw_horaextrot = fncfetch($rs_horaextrot, $b);
									$a++;
									
									if($a % 2)
										$class = "NoiseDataTD";
									else
										$class = "NoiseFooterTD";
							?>
							<tr class="<?php echo $class ?>">
								<td width="10%"><input type="checkbox" id="chkheots" name="chkheots" onclick="setSelectionRow(this.value, document.getElementById('arrheots').value, ',', 'heots');" value="<?php echo $rw_horaextrot['ordtracodigo'] ?>"></td>
								<td width="40%">&nbsp;Orden # <?php echo $rw_horaextrot['ordtracodigo'] ?></td>
								<td width="50%">&nbsp;<?php echo $rw_horaextrot['ordtrafecini'] ?></td>
							</tr>
							<?php 
								endfor; 
							
								if($a < 9):
									for($b = $a; $b < 9; $b++):
									
										if($b % 2)
											$class = "NoiseDataTD";
										else
											$class = "NoiseFooterTD";
							?>
							<tr class="<?php echo $class ?>">
								<td width="10%">&nbsp;</td>
								<td width="40%">&nbsp;</td>
								<td width="50%">&nbsp;</td>
							</tr>
							<?php
									endfor;
								endif;
							?>
						</table>
					</div>
				</div>
			</div>
		</td>
	</tr>
</table>
<input type="hidden" name="arrheots" id="arrheots" value="<?php echo $arrheots ?>">
<input type="hidden" name="horextcodigo" id="horextcodigo" value="<?php echo $horextcodigo ?>">