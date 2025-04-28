<?php 
	if(!$noAjax):
		include '../../FunPerSecNiv/fncconn.php';
		include '../../FunPerSecNiv/fncclose.php';
		include '../../FunPerSecNiv/fncnumreg.php';
		include '../../FunPerSecNiv/fncfetch.php';
		
		include '../../FunPerPriNiv/pktblcurso.php';
	endif;
	
	unset($a);
	
	$idcon = fncconn();
	$rsCurso = fullscancurso($idcon);
	$nrCurso = fncnumreg($rsCurso);
?>	
	
<div style="width:648px; height: 20px;" class="ui-state-default">
	<div style="width:100%; height: auto;">
		<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">	
			<tr>
				<td width="50" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Sel<input type="checkbox" onclick="setSelectionAll('lstcursos',',');" value="1" name="alllstcursos" id="alllstcursos" <?php if($alllstcursos) echo 'checked'; ?> ></td>
				<td width="583" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Curso</td>
				<td width="15" class="ui-state-default" style="border:0;">&nbsp;</td>
			</tr>
		</table>
	</div>
</div>
<div style="width:648px; height: 150px; margin: 0 auto; position:absolute;  overflow:auto; border-top:0;" class="ui-widget-content">
	<div style="width:628px; height: auto;  z-index: auto;">
		<table width="100%" border="0" cellspacing="0" cellpadding="0"  align="center">
<?php 
	if($nrCurso)
	{
		if($arrlstcursos)
		{
			$array_tmp = explode(',',$arrlstcursos);
			$array_key = array_flip($array_tmp);
		}
	
		for($a = 0; $a < $nrCurso; $a++)
		{
			$rwCurso = fncfetch($rsCurso, $a);
			$complement = ($a % 2) ? ' class="NoiseDataTD" onmouseover="setClassHover(this)" onmouseout="setClassIn(this)"' : ' class="NoiseFooterTD" onmouseover="setClassHover(this)" onmouseout="setClassOut(this)"';
				
			
				if(is_array($array_key))
				{
					$checked = '';
					if(array_key_exists($rwCurso['cursocodigo'], $array_key) || $alllstcursos)
						$checked = 'checked';
				}	
?>			
			<tr <?php echo $complement ?>">
				<td width="50" style=" border-bottom: 1px solid #fff;"><input type="checkbox" id="chklstcursos" name="chklstcursos" <?php echo $checked ?> onclick="setSelectionRow(this.value, document.getElementById('arrlstcursos').value, ',', 'lstcursos');" value="<?php echo $rwCurso['cursocodigo'] ?>"></td>
				<td width="580" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo $rwCurso['cursonombre'] ?></td>
			</tr>
<?php
		}
	}		
	
	
	if($a < 13)
	{
		for($b = $a; $b < 13; $b++)
		{
			($b % 2) ? $class = "NoiseDataTD": $class = "NoiseFooterTD";
?>
			<tr class="<?php echo $class ?>">
				<td width="50" style=" border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="580" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
			</tr>
<?php
		}
	}
?>
		</table>
	</div>
</div>