<?php 
	if(!$noAjax):
		include '../../FunPerSecNiv/fncconn.php';
		include '../../FunPerSecNiv/fncclose.php';
		include '../../FunPerSecNiv/fncnumreg.php';
		include '../../FunPerSecNiv/fncfetch.php';
	endif;
?>
<table width="100%" border="0" cellspacing="1" cellpadding="1"  align="center">
	<tr>
		<td width="10%" class="ui-state-default estilo2">Sel&nbsp;<input type="checkbox" id="allheots" name="allheots" value="1" onclick="setSelectionAll('heots',',');" <?php if($allheots && $flagerr) echo 'checked' ?>></td>
		<td width="40%" class="ui-state-default estilo2">Orden de trabajo</td>
		<td width="50%" class="ui-state-default estilo2">Fecha de ejecuci&oacute;n</td>
	</tr>
	<?php 
		if($usuacodigo):
			$strSQL = "	SELECT DISTINCT ot.ordtracodigo, ordtrafecini
						FROM ot LEFT JOIN tareot ON tareot.ordtracodigo = ot.ordtracodigo 
						LEFT JOIN usuariotareot ON usuariotareot.tareotcodigo = tareot.tareotcodigo
						WHERE 
							usuariotareot.usutarcodigo IS NOT NULL AND 
							tareot.tareotcodigo IS NOT NULL AND 
							usuariotareot.usuacodi = '{$usuacodigo}' AND 
							ot.ordtracodigo NOT IN (SELECT horaextraot.ordtracodigo FROM horasextra LEFT JOIN horaextraot ON horaextraot.horextcodigo = horasextra.horextcodigo WHERE horasextra.usuacodi = '{$usuacodigo}' AND horaextraot.ordtracodigo IS NOT NULL)
						ORDER BY ot.ordtracodigo";
	
			$idcon = fncconn();
			$rs_horaextrot = pg_exec($idcon, $strSQL); 
			$nr_horaextrot = fncnumreg($rs_horaextrot);
			
		elseif($cuadricodigo):
			$strSQL = "	SELECT DISTINCT ot.ordtracodigo, ordtrafecini
						FROM ot LEFT JOIN tareot ON tareot.ordtracodigo = ot.ordtracodigo 
						LEFT JOIN usuariotareot ON usuariotareot.tareotcodigo = tareot.tareotcodigo
						WHERE 
							usuariotareot.usutarcodigo IS NOT NULL AND 
							tareot.tareotcodigo IS NOT NULL AND 
							usuariotareot.cuadricodigo = '{$cuadricodigo}' AND 
							ot.ordtracodigo NOT IN (SELECT horaextraot.ordtracodigo FROM horasextra LEFT JOIN horaextraot ON horaextraot.horextcodigo = horasextra.horextcodigo WHERE horaextraot.ordtracodigo IS NOT NULL)
						ORDER BY ot.ordtracodigo";
	
			$idcon = fncconn();
			$rs_horaextrot = pg_exec($idcon, $strSQL); 
			$nr_horaextrot = fncnumreg($rs_horaextrot);
		endif;
		

		if($arrheots)
		{
			$array_tmp = explode(',',$arrheots);
			$array_key = array_flip($array_tmp);
		}

		for($a = 0; $a < $nr_horaextrot; $a++): 
			$rw_horaextrot = fncfetch($rs_horaextrot, $a);
			$checked = '';
			
			if($allheots)
				$checked = 'checked ';
			else
			{
				if(is_array($array_key))
				{
					if(array_key_exists($rw_horaextrot['ordtracodigo'], $array_key))
						$checked = 'checked ';
				}
			}
			
			if($a % 2)
				$class = "NoiseDataTD";
			else
				$class = "NoiseFooterTD";
	?>
	<tr class="<?php echo $class ?>">
		<td width="10%"><input type="checkbox" id="chkheots" name="chkheots" <?php echo $checked ?>onclick="setSelectionRow(this.value, document.getElementById('arrheots').value, ',', 'heots');" value="<?php echo $rw_horaextrot['ordtracodigo'] ?>"></td>
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

