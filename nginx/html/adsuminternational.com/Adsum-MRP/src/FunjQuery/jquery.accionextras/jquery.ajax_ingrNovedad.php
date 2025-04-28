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
     	<td class="NoiseFooterTD" width="15%"><?php if($campnomb["usunovhorini"] == 1){ echo "*";} ?>&nbsp;Novedad</td>
     	<td class="NoiseDataTD"><select name="estnovcodigo" id="estnovcodigo">
     		<option value="">-- Seleccione --</option>
			<?php
				$idcon = fncconn();
				include '../../FunGen/floadestadonoveda.php';
				floadestadonovedautf8($estnovcodigo, $idcon);
			?>
		</select></td>
	</tr>
	<tr><td class="ui-state-default" colspan="2"></td></tr>							
 	<tr><td colspan="2" class="NoiseFooterTD">&nbsp;Descripci&oacute;n</td></tr>
  	<tr><td colspan="2" class="NoiseFooterTD"><textarea name="usunovdescri" id="usunovdescri" rows="3" cols="79" wrap="VIRTUAL"><?php echo $rs_usuanovedad[usunovdescri]; ?></textarea></td></tr>
</table>
<input type="hidden" name="usuacodigo" id="usuacodigo" value="<?php echo $usuacodigo ?>">