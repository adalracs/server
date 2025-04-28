<?php 
	if(!$noAjax):
		include '../../FunPerSecNiv/fncconn.php';
		include '../../FunPerSecNiv/fncclose.php';
		include '../../FunPerSecNiv/fncnumreg.php';
		include '../../FunPerSecNiv/fncfetch.php';
		include '../../FunPerPriNiv/pktblusuanovedad.php';
		include '../../FunPerPriNiv/pktblestadonoveda.php';
	endif;
	
	if($usuacodigo):
		$idcon = fncconn();
		$rs_usuanovedad = dinamicscanusuanovedad(array('usuacodi' => $usuacodigo), $idcon);
		$nr_usuanovedad = fncnumreg($rs_usuanovedad);
	endif;
?>
<table width="100%" border="0" cellspacing="1" cellpadding="1"  align="center">	
	<?php 
		for($a = 0; $a < $nr_usuanovedad; $a++): 
			$rw_usuanovedad = fncfetch($rs_usuanovedad, $a);
			$rs_estadonoveda = loadrecordestadonoveda($rw_usuanovedad['estnovcodigo'], $idcon);
			
			$horini = date("H:i", strtotime($rw_usuanovedad['usunovhorini']));
			$horfin = date("H:i", strtotime($rw_usuanovedad['usunovhorfin']));
			
			if($a % 2)
				$complement = 'class="NoiseDataTD" bgcolor="#E8F0F6" id="fila'.$a.'" onmouseover="setClassHover(this)" onmouseout="setClassIn(this)" onclick="showWindow('."'{$rw_usuanovedad['usunovcodigo']}','{$rw_usuanovedad['usunovfecini']}','{$rw_usuanovedad['usunovfecfin']}','{$horini}','{$horfin}'".');"';
			else
				$complement = 'class="NoiseFooterTD" bgcolor="#f0f6ff" id="fila'.$a.'" onmouseover="setClassHover(this)" onmouseout="setClassOut(this)" onclick="showWindow('."'{$rw_usuanovedad['usunovcodigo']}','{$rw_usuanovedad['usunovfecini']}','{$rw_usuanovedad['usunovfecfin']}','{$horini}','{$horfin}'".');"';
	?>
	<tr <?php echo $complement ?>>
		<td width="180">&nbsp;<?php if(!$noAjax) echo utf8_encode($rs_estadonoveda['estnovnombre']); else echo $rs_estadonoveda['estnovnombre']  ?></td>
		<td width="80">&nbsp;<?php echo $rw_usuanovedad['usunovfecini']  ?></td>
		<td width="80">&nbsp;<?php echo $rw_usuanovedad['usunovfecfin']  ?></td>
		<td width="255">&nbsp;<?php if(!$noAjax){ echo  utf8_encode(substr($rw_usuanovedad['usunovdescri'],0,35)); }else{echo substr($rw_usuanovedad['usunovdescri'],0,35); } if(strlen($rw_usuanovedad['usunovdescri']) > 35) echo '...'; ?></td>
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
		<td width="180">&nbsp;</td>
		<td width="80">&nbsp;</td>
		<td width="80">&nbsp;</td>
		<td width="255">&nbsp;</td>
	</tr>
	<?php
			endfor;
		endif;
	?>
</table>

