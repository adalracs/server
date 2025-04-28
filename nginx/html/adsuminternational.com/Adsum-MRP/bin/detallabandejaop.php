<?php	

if(!$noAjax)
{
	include ( '../src/FunPerPriNiv/pktblvistabandejaop.php');
	include ( '../src/FunPerPriNiv/pktblplanta.php');
	include ( '../src/FunPerSecNiv/fncfetch.php');
	include ( '../src/FunPerSecNiv/fncnumreg.php');
	include ( '../src/FunGen/cargainput.php');
}

	$idcon = fncconn();
	
	if($gruingcodigo || $subingcodigo)
	{
		$record['gruingcodigo'] = $gruingcodigo;
		$recordop['gruingcodigo'] = '=';
		$record['subingcodigo'] = $subingcodigo;
		$recordop['subingcodigo'] = '=';
		if($ingrednombre)
		{	
			$record['ingrednombre'] = $ingrednombre;
			$recordop['ingrednombre'] = 'like';
		}
		$rsItem = dinamicscanopingredienteauto($record, $recordop, $idcon);
	}
	else if($ingrednombre)
	{
		$record['ingrednombre'] = $ingrednombre;
		$recordop['ingrednombre'] = 'like';
		$rsItem = dinamicscanopingredienteauto($record, $recordop, $idcon);
	}
	
	
	
	if($rsItem)
		$nrItem = 50;	

?>
<div style="width:1005px; height: 20px;" class="ui-state-default">
	<div style="width:100%; height: auto;">
		<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">	
			<tr>
				<td width="50px" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Sel<input type="checkbox" onclick="setSelectionlistsAll('ingred',',',document.getElementById('arringred').value);" value="1" name="allitem" id="allitem" <?php if($allitem) echo 'checked'; ?> ></td>
				<td width="50px" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;OP</td>
				<td width="70px" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;PV</td>
				<td width="250px" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Cliente</td>
				<td width="70px" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Item</td>
				<td width="250px" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Referencia</td>
				<td width="70px" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Mezcla</td>
				<td width="50px" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Cal.</td>
				<td width="50px" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Ancho</td>
				<td width="80px" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Cant.<b>(kgs)</b></td>
				<td width="15" class="ui-state-default" style="border:0;">&nbsp;</td>
			</tr>
		</table>
	</div>
</div>
<div style="width:1005px; height: 350px;overflow:auto;" class="ui-widget-content">
	<div style="width:100%; height: auto;">
		<table width="100%" border="0" cellspacing="0" cellpadding="0"  align="center">
<?php 
	if($nrItem):
		if($arringred)
		{
			$array_tmp = explode(',',$arringred);
			$array_key = array_flip($array_tmp);
		}
	
		for($a = 0; $a < $nrItem; $a++):
			$rwItem = fncfetch($rsItem, $a);
		
			($a % 2) ? $complement = ' class="NoiseDataTD" onmouseover="setClassHover(this)" onmouseout="setClassIn(this)"' : $complement = ' class="NoiseFooterTD" onmouseover="setClassHover(this)" onmouseout="setClassOut(this)"';
				
			if(is_array($array_key))
			{
				$checked = '';
				if(array_key_exists($rwItem['ingrednumero'], $array_key) || $allitem)
					$checked = 'checked';
			}	
?>			
			<tr <?php echo $complement ?>">
				<td width="50px" style=" border-bottom: 1px solid #fff;"><input type="checkbox" id="chkitem" name="chkitem" <?php echo $checked ?> onclick="setSelectionRow(this.value, document.getElementById('arringred').value, ',', 'arringred');" value="<?php echo $rwItem['ingrednumero'] ?>"></td>
				<td width="50px" style=" border-bottom: 1px solid #fff;"><input type="checkbox" id="chkitem" name="chkitem" <?php echo $checked ?> onclick="setSelectionRow(this.value, document.getElementById('arringred').value, ',', 'arringred');" value="<?php echo $rwItem['ingrednumero'] ?>"></td>
				<td width="70px" style=" border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="250px" style=" border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="70px" style=" border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="250px" style=" border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="70px" style=" border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="50px" style=" border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="50px" style=" border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="80px" style=" border-bottom: 1px solid #fff;">&nbsp;</td>
			</tr>
<?php
		endfor;
	endif;
	
	if($a < 13):
		for($b = $a; $b < 35; $b++):
			($b % 2) ? $class = "NoiseDataTD": $class = "NoiseFooterTD";
?>
			<tr class="<?php echo $class ?>">
				<td width="50px" style="border-bottom: 1px solid #fff;">&nbsp;</td>				
				<td width="50px" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;"">&nbsp;</td>				
				<td width="70px" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;"">&nbsp;</td>	
				<td width="250px" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;"">&nbsp;</td>				
				<td width="70px" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;"">&nbsp;</td>	
				<td width="250px" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;"">&nbsp;</td>				
				<td width="70px" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;"">&nbsp;</td>				
				<td width="50px" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;"">&nbsp;</td>				
				<td width="50px" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;"">&nbsp;</td>				
				<td width="80px" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;"">&nbsp;</td>				
			</tr>
<?php
			endfor;
		endif;	
?>
		</table>
	</div>
</div>