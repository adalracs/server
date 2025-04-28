<?php 
	if(!$noAjax):
		include '../../FunPerSecNiv/fncconn.php';
		include '../../FunPerSecNiv/fncclose.php';
		include '../../FunPerSecNiv/fncnumreg.php';
		include '../../FunPerSecNiv/fncfetch.php';
		include '../../FunPerPriNiv/pktblusuanovedad.php';
		include '../../FunPerPriNiv/pktblestadonoveda.php';
	endif;
	
	if($usunovcodigo):
		$idcon = fncconn();
		$rs_usuanovedad = loadrecordusuanovedad($usunovcodigo, $idcon);
		
		$estnovcodigo = $rs_usuanovedad['estnovcodigo'];
		
		$strSQL = "	SELECT horasextra.*, horaextraot.hoexotcodigo, horaextraot.ordtracodigo 
					FROM horasextra 
						LEFT JOIN horaextraot ON horaextraot.horextcodigo = horasextra.horextcodigo 
						LEFT JOIN usunovhorext ON usunovhorext.hoexotcodigo = horaextraot.hoexotcodigo 
					WHERE usunovhorext.usunovcodigo = '{$rs_usuanovedad['usunovcodigo']}'";

		$rs_usunovhorext = pg_exec($idcon, $strSQL); 
		$nr_usunovhorext = fncnumreg($rs_usunovhorext);
		
		for($a = 0; $a < $nr_usunovhorext; $a++):
			$rw_usunovhorext = fncfetch($rs_usunovhorext, $a);
			$arrhecodegen[$rw_usunovhorext['hoexotcodigo']] = 1;
			
			if($arrhecode)
				$arrhecode .= ','.$rw_usunovhorext['hoexotcodigo'];
			else
				$arrhecode = $rw_usunovhorext['hoexotcodigo'];
		endfor;
	endif;
?>

<table width="95%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">						
	<tr>
     	<td class="NoiseFooterTD" width="20%"><?php if($campnomb["usunovhorini"] == 1){ echo "*";} ?>&nbsp;Novedad</td>
     	<td class="NoiseDataTD"  colspan="3"><select name="estnovcodigo" id="estnovcodigo">
			<?php
				include '../../FunGen/floadestadonoveda.php';
				floadestadonovedautf8($estnovcodigo, $idcon);
			?>
		</select></td>
	</tr>
	<tr><td class="ui-state-default" colspan="4"></td></tr>							
 	<tr><td colspan="4" class="NoiseFooterTD">&nbsp;Descripci&oacute;n</td></tr>
  	<tr><td colspan="4" class="NoiseFooterTD"><textarea name="usunovdescri" id="usunovdescri" rows="3" cols="79" wrap="VIRTUAL"><?php echo $rs_usuanovedad[usunovdescri]; ?></textarea></td></tr>
</table>

<?php 
	if($usuacodigo):
		$idcon = fncconn();
	
		$strSQL = "	SELECT DISTINCT horasextra.horextcodigo
					FROM horasextra 
						LEFT JOIN horaextraot ON horaextraot.horextcodigo = horasextra.horextcodigo 
						LEFT JOIN usunovhorext ON usunovhorext.hoexotcodigo = horaextraot.hoexotcodigo 
					WHERE horasextra.usuacodi = '{$usuacodigo}' AND (usunovhorext.usnohecodigo IS NULL OR usunovhorext.hoexotcodigo IN ({$arrhecode}))";
	
		$rs_horaextrot = pg_exec($idcon, $strSQL); 
		$nr_horaextrot = fncnumreg($rs_horaextrot);
	endif;
?>

<table width="95%" border="0" cellspacing="1" cellpadding="0" align="center">
	<tr><td class="ui-state-default"></td></tr>
	<tr> 
		<td>
			<div style="width:612px; height: 18px; margin:0 auto;" class="ui-state-default">
				&nbsp;<a onClick="return verocultar('filtrahoraextraot',1);" href="javascript:animatedcollapse.toggle('filtrahoraextraot');"><img id="row1" align="middle" align="top"  src="temas/Noise/AscOn.gif" border="0">&nbsp;Listado de Ordenes asiganadas al empleado [Horas Extras]</a>
			</div>
			<div id="filtrahoraextraot">
				<div style="width:612px; height: 18px; margin:0 auto;" class="ui-state-default">
					<div style="width:100%; height: auto;">
						<table width="100%" border="0" cellspacing="0" cellpadding="1" align="center">	
							<tr>
								<td width="5" class="ui-state-default estilo2">&nbsp;</td>
								<td width="30" class="ui-state-default estilo2">Sel</td>
								<td width="80" class="ui-state-default estilo2">Fecha</td>
								<td width="80" class="ui-state-default estilo2">Desde</td>
								<td width="80" class="ui-state-default estilo2">Hasta</td>
								<td width="70" class="ui-state-default estilo2">Orden #</td>
								<td width="255" class="ui-state-default estilo2">Descripci&oacute;n</td>
								<td width="10" class="ui-state-default estilo2">&nbsp;</td>
							</tr>
						</table>
					</div>
				</div>
				<div style="width:612px; height: 150px; margin:0 auto; overflow:auto;" class="ui-widget-content">
					<div style="width:595px; height: auto;" id="listahoraextraot">
						<table width="100%" border="0" cellspacing="1" cellpadding="1"  align="center">	
						<?php 
							for($a = 0; $a < $nr_horaextrot; $a++): 
								$rw_horaextrot = fncfetch($rs_horaextrot, $a);
								
								$strSQL = "	SELECT horasextra.*, horaextraot.hoexotcodigo, horaextraot.ordtracodigo 
										FROM horasextra 
											LEFT JOIN horaextraot ON horaextraot.horextcodigo = horasextra.horextcodigo 
											LEFT JOIN usunovhorext ON usunovhorext.hoexotcodigo = horaextraot.hoexotcodigo 
										WHERE horasextra.usuacodi = '{$usuacodigo}' AND horasextra.horextcodigo = '{$rw_horaextrot['horextcodigo']}' AND (usunovhorext.usnohecodigo IS NULL OR usunovhorext.hoexotcodigo IN ({$arrhecode}))";
										
								$rs_dethoraextrot = pg_exec($idcon, $strSQL); 
								$nr_dethoraextrot = fncnumreg($rs_dethoraextrot);
			
								if($a % 2)
									$classrow = 'class="NoiseDataTD"';
								else
									$classrow = 'class="NoiseFooterTD"';

			
								for($b = 0; $b < $nr_dethoraextrot; $b++): 
									$checked = '';
									$rw_dethoraextrot = fncfetch($rs_dethoraextrot, $b);
									
									if(is_array($arrhecodegen))
									{
										if(array_key_exists($rw_dethoraextrot['hoexotcodigo'], $arrhecodegen))
											$checked = 'checked ';
									}
									
									if($c % 2)
										$complement = 'class="NoiseDataTD"';
									else
										$complement = 'class="NoiseFooterTD"';
						?>
							<tr <?php echo $complement ?>>
								<?php if($b < 1): ?><td width="5" rowspan="<?php echo $nr_dethoraextrot ?>" <?php echo $classrow ?> >&nbsp;</td><?php endif ?>
								<td width="30"><input type="checkbox" id="chkhecode" name="chkhecode" <?php echo $checked ?> onclick="setSelectionRow(this.value, document.getElementById('arrhecode').value, ',', 'hecode');" value="<?php echo $rw_dethoraextrot['hoexotcodigo'] ?>"></td>
								<td width="80">&nbsp;<?php echo $rw_dethoraextrot['horextfecha']  ?></td>
								<td width="80">&nbsp;<?php echo date("h:i a", strtotime($rw_dethoraextrot['horextfecha'].' '.$rw_dethoraextrot['horexthorini'])) ?></td>
								<td width="80">&nbsp;<?php echo date("h:i a", strtotime($rw_dethoraextrot['horextfecha'].' '.$rw_dethoraextrot['horexthorfin'])) ?></td>
								<td width="70">&nbsp;<?php if($rw_dethoraextrot['ordtracodigo']) echo $rw_dethoraextrot['ordtracodigo']; else echo '------' ?></td>
								<td width="245">&nbsp;<?php echo  utf8_encode(substr($rw_dethoraextrot['horextdescri'],0,40)); if(strlen($rw_dethoraextrot['horextdescri']) > 40) echo '...'; ?></td>
							</tr>
						<?php 
									$c++;
								endfor;
							endfor; 
		
							if($a < 9):
								for($b = $a; $b < 9; $b++):
								
									if($b % 2)
										$class = "NoiseDataTD";
									else
										$class = "NoiseFooterTD";
						?>
						<tr class="<?php echo $class ?>">
							<td width="6">&nbsp;</td>
							<td width="30">&nbsp;</td>
							<td width="80">&nbsp;</td>
							<td width="80">&nbsp;</td>
							<td width="80">&nbsp;</td>
							<td width="70">&nbsp;</td>
							<td width="245">&nbsp;</td>
						</tr>
						<?php
								endfor;
							endif;
						?>
						</table>
						<input type="hidden" name="arrhecode" id="arrhecode" value="<?php echo $arrhecode ?>">
					</div>
				</div>
			</div>
		</td>
	</tr>
</table>
<input type="hidden" name="usunovcodigo" id="usunovcodigo" value="<?php echo $usunovcodigo ?>">