<?php 
	if(!$noAjax):
		include '../../FunPerSecNiv/fncconn.php';
		include '../../FunPerSecNiv/fncclose.php';
		include '../../FunPerSecNiv/fncnumreg.php';
		include '../../FunPerSecNiv/fncfetch.php';
		
		include '../../FunPerPriNiv/pktblcausa.php';
	endif;
	
	$idcon = fncconn();

	$rsCausa = fullscancausa($idcon);
	//$rsCausa = dinamicscanopcausa(array( "causacodigo" => $causacodigo ),array( "causacodigo" => $causacodigo ),$idcon);
	$nrCausa = fncnumreg($rsCausa);
?>	
	
<div style="width:798px; height: 20px;" class="ui-state-default">
	<div style="width:100%; height: auto;">
		<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">	
			<tr>
				<td width="50" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Sel</td>
				<td width="583" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Causa</td>
				<td width="15" class="ui-state-default" style="border:0;">&nbsp;</td>
			</tr>
		</table>
	</div>
</div>
<div style="width:798px; height: 150px; margin: 0 auto;overflow:auto; border-top:0;" class="ui-widget-content">
	<div style="width:778px; height: auto;  z-index: auto;">
		<table width="100%" border="0" cellspacing="0" cellpadding="0"  align="center">
<?php 
	if($nrCausa){

		if($arrcausa){
			$array_tmp = explode(',',$arrcausa);
			$array_key = array_flip($array_tmp);
		}
	
		for($a = 0; $a < $nrCausa; $a++){
			$rwCausa = fncfetch($rsCausa, $a);
		
			if($a % 2){
				$complement = ' class="NoiseDataTD" onmouseover="setClassHover(this)" onmouseout="setClassIn(this)"';
			}else{
				$complement = ' class="NoiseFooterTD" onmouseover="setClassHover(this)" onmouseout="setClassOut(this)"';
			}
			
			if(is_array($array_key)){
				$checked = '';
				if( array_key_exists($rwCausa["causacodigo"], $array_key) )
					$checked = 'checked';
			}	
?>			
			<tr <?php echo $complement ?> >
				<td width="50" style=" border-bottom: 1px solid #fff;">
					<?php if(!$flagDetallar){ ?>
						<input type="checkbox" id="chkcausa" name="chkcausa" <?php echo $checked ?> onclick="setSelectionRow(this.value, document.getElementById('arrcausa').value, ',', 'arrcausa');" value="<?php echo $rwCausa['causacodigo'] ?>">
					<?php }else{
						echo ($checked)? '<span class="ui-icon ui-icon-check"></span>' : '<span class="ui-icon ui-icon-close"></span>' ;
					} ?>
				</td>
				<td width="580" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo $rwCausa["causanombre"]; ?></td>
			</tr>
<?php
		}
	}
	
	if($a < 13){

		for($b = $a; $b < 13; $b++){

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