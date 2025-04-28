<?php 
	ini_set('display_errors',1);
	if(!$noAjax)
	{
		include '../../FunPerSecNiv/fncconn.php';
		include '../../FunPerSecNiv/fncclose.php';
		include '../../FunPerSecNiv/fncnumreg.php';
		include '../../FunPerSecNiv/fncfetch.php';
		include '../../FunPerSecNiv/fncsqlrun.php';
		include '../../FunPerPriNiv/pktblitemdesa.php';
		include '../../FunPerPriNiv/pktblvistaitemplaneacion.php';
		include '../../FunPerPriNiv/pktblpadreitem.php';
		include '../../FunPerPriNiv/pktblprocedimiento.php';
		include '../../FunGen/cargainput.php';
	}

?>
<div style="width:100%; height: 20px;" class="ui-state-default">
	<div style="width:100%; height: auto;">
		<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">	
			<tr>
				<td width="3%" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Sel</td>
				<td width="83%" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Ruta</td>
				<td width="2%" class="ui-state-default" style="border:0;">&nbsp;</td>
			</tr>
		</table>
	</div>
</div>

<div style="width:100%; height: 170px;  overflow:auto; border-left:0; border-right:0; border-bottom:0;" class="ui-widget-content">
	<div style="width:100%; height: auto;  z-index: auto;">
		<table width="100%" border="0" cellspacing="0" cellpadding="0"  align="center">
<?php 
	$idcon = fncconn();
	unset($arrObject,$a);
	if($arrrutaitem) $arrObject = explode(':|:',$arrrutaitem);
		for($a = 0;$a< count($arrObject);$a++){
			$rwObject = explode(':-:',$arrObject[$a]);
			$rwProcedimiento = loadrecordprocedimiento($rwObject[0],$idcon);
			unset($str_tool_tip);
			if($rwProcedimiento['tipsolcodigo'] == '10')
			{
				$rwItemdesa = loadrecordvistaitemplaneacion($rwObject[1],$idcon);
				$cod = $rwItemdesa[itedescodigo];
				$nombre = $rwItemdesa[itedesnombre];
				$ancho = $rwItemdesa[itedesancho];
				if($rwItemdesa <= 0)
				{	
					$rwPadreitem = loadrecordpadreitem($rwObject[1],$idcon);
					unset($cod);
					$nombre = $rwPadreitem[paditenombre];
					unset($ancho);
				}
				 $rwDetal = explode(',',$rwObject[3]);
				 $str_tool_tip = $cod.' '.$nombre.'[ancho(mm):'.$rwDetal[0].',destino: '.$rwDetal[1].',restante(mm):'.$rwDetal[2].',restante(kgs):'.(round($rwDetal[3] * 100) / 100).']';
			}
			//objetos
			$obj_ancho = 'ancho_'.$rwObject[0];
			$obj_destino = 'destino_'.$rwObject[0];
			($a % 2) ? $complement = ' class="NoiseDataTD" onmouseover="setClassHover(this)" onmouseout="setClassIn(this)"' : $complement = ' class="NoiseFooterTD" onmouseover="setClassHover(this)" onmouseout="setClassOut(this)"';
?>		
			<tr <?php echo $complement ?>">
				<td width="3%" style=" border-bottom: 1px solid #fff;"><?php if(!$flagdetallar){?><input type="checkbox" id="chkrutaitem" name="chkrutaitem" <?php echo $checked ?> onclick="setSelectionRow(this.value, document.getElementById('arrrutaitemtmp').value, ':|:', 'rutaitemtmp');" value="<?php echo $arrObject[$a] ?>"><?php }else{?>&nbsp;&nbsp;&nbsp;<b>X</b><?php }?></td>
				<td width="83%" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo ($rwProcedimiento['procednombre'])? strtoupper($rwProcedimiento['procednombre']) : '---' ; ?> <?php echo ($str_tool_tip)? ' - '.$str_tool_tip : '' ; ?></td>
			</tr>
<?php 
	}
	
	if($a < 20){
		for($b = $a; $b < 20; $b++){
			($b % 2) ? $class = "NoiseDataTD": $class = "NoiseFooterTD";
?>
			<tr class="<?php echo $class ?>">
				<td width="3%" style=" border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="83%" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
			</tr>
<?php
			}
		}
?>
		</table>
	</div>
</div>