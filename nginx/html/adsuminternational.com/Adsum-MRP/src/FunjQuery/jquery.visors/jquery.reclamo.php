<?php 
	if(!$noAjax):
		include '../../FunPerSecNiv/fncconn.php';
		include '../../FunPerSecNiv/fncclose.php';
		include '../../FunPerSecNiv/fncnumreg.php';
		include '../../FunPerSecNiv/fncfetch.php';
		include '../../FunPerPriNiv/pktblpedidoventa.php';
		include '../../FunPerPriNiv/pktblproducpedido.php';
		include '../../FunPerPriNiv/pktblproducto.php';
		include '../../FunGen/cargainput.php';
	endif;

	$idcon = fncconn();
?>
<style>
	.row-consumo { font-size:11px;}
</style>
<div style="width:950px; height: 14px;" class="ui-state-default">
	<div style="width:100%; height: auto;">
		<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">	
			<tr>
				<td width="30px" class="ui-state-default" style="border-top:0; border-bottom:0; border-left: 1px solid #fff;">&nbsp;Sel.</td>
				<td width="55px" class="ui-state-default" style="border-top:0; border-bottom:0; border-left: 1px solid #fff;">&nbsp;No Pv.</td>
				<td width="55px" class="ui-state-default" style="border-top:0; border-bottom:0; border-left: 1px solid #fff;">&nbsp;Item.</td>
				<td width="210px" class="ui-state-default" style="border-top:0; border-bottom:0; border-left: 1px solid #fff;">&nbsp;Ref.</td>
				<td width="150px" class="ui-state-default" style="border-top:0; border-bottom:0; border-left: 1px solid #fff;">&nbsp;Tipo Reclamo.</td>
				<td width="80px" class="ui-state-default" style="border-top:0; border-bottom:0; border-left: 1px solid #fff;">&nbsp;Devolucion.</td>
				<td width="70px" class="ui-state-default" style="border-top:0; border-bottom:0; border-left: 1px solid #fff;">&nbsp;Cantidad</td>
				<td width="40px" class="ui-state-default" style="border-top:0; border-bottom:0; border-left: 1px solid #fff;">&nbsp;Med.</td>
				<td width="240px" class="ui-state-default" style="border-top:0; border-bottom:0; border-left: 1px solid #fff;">&nbsp;Nota.</td>
				<td width="20px" class="ui-state-default" style="border:0;">&nbsp;</td>
			</tr>
		</table>
	</div>
</div>

<div style="width:950px; height: 80px;overflow:auto;border-top:0;" class="ui-widget-content">
	<div style="width:100%; height: auto;">
		<table width="100%" border="0" cellspacing="0" cellpadding="0"  align="center">
			<?php 
				if($arrpedven) $arrObject = explode(',', $arrpedven);
				for($a = 0; $a < count($arrObject); $a++):	
				
					$rsPedidoVenta = loadrecordpedidoventa($arrObject[$a],$idcon);
					$rsProducPedido = loadrecordproducpedido($arrObject[$a],$idcon);
					$rsProducto = loadrecordproducto($rsProducPedido['produccodigo'],$idcon);
					
					$objRecPR = 'recpectiprecpr_'.$arrObject[$a];
					$objRecAS = 'recpectiprecas_'.$arrObject[$a];
					$objRecEL = 'recpectiprecel_'.$arrObject[$a];
					$objDevolucion = 'recpeddevolu_'.$arrObject[$a];
					$objCantid = 'recpedcantid_'.$arrObject[$a];
					$objDescri = 'recpeddescri_'.$arrObject[$a];
					
					($a % 2) ? $class = "NoiseDataTD" : $class = "NoiseFooterTD";
			?>
			<tr class="<?php echo $class ?>">
				<td width="30px" style=" border-bottom: 1px solid #fff;" align="center">
					<input type="checkbox" name="chkarrpedven" id="chkarrpedven" onclick="setSelectionRow(this.value, document.getElementById('arrpedven').value, ',', 'arrpedven');" value="<?php echo $arrObject[$a] ?>">
				</td>
				<td width="55px" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo $rsPedidoVenta['pedvennumero']; ?></td>
				<td width="55px" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo $rsProducto['produccoduno']?></td>
				<td width="210px" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo $rsProducto['producnombre']?></td>
				<td width="150px" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<b>P</b><input type="checkbox" name="<?php echo $objRecPR ?>" id="<?php echo $objRecPR ?>" <?php if($$objRecPR > 0){echo 'checked';}?> value="1">&nbsp;<b>A/S</b><input type="checkbox" name="<?php echo $objRecAS ?>" id="<?php echo $objRecAS ?>" <?php if($$objRecAS > 0){echo 'checked';}?> value="2">&nbsp;<b>E/L</b><input type="checkbox" name="<?php echo $objRecEL ?>" id="<?php echo $objRecEL ?>" <?php if($$objRecEL > 0){echo 'checked';}?> value="3"></td>
				<td width="80px" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<b>T</b>&nbsp;<input type="radio" name="<?php echo $objDevolucion ?>" id="<?php echo $objDevolucion.'_1' ?>" <?php if($$objDevolucion == '1'){echo 'checked';}?> value="1" />&nbsp;<b>P</b>&nbsp;<input type="radio" name="<?php echo $objDevolucion ?>" id="<?php echo $objDevolucion.'_2' ?>" <?php if($$objDevolucion == '2'){echo 'checked';}?> value="2" />&nbsp;</td>
				<td width="70px" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<input type="text" name="<?php echo $objCantid ?>" id="<?php echo $objCantid ?>" value="<?php echo $$objCantid ?>" size="5" /></td>
				<td width="40px" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo $rsProducPedido['unidadcodigo']?></td>
				<td width="240px" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<input type="text" name="<?php echo $objDescri ?>" id="<?php echo $objDescri ?>" value="<?php echo $$objDescri ?>" size="33" /></td>
			</tr>
			<?php 
				endfor;
				unset($arrObject);

				if($a < 8):
					for($b = $a; $b < 8; $b++):
						($b % 2) ? $class = "NoiseDataTD" : $class = "NoiseFooterTD";
			?>
			<tr class="<?php echo $class ?>">			
				<td width="30px" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="55px" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="55px" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="210px" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="150px" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="80px" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="70px" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="40px" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="240px" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
			</tr>
			<?php
					endfor;
				endif;
			?>		
		</table>
	</div>
		<input name="arrpedven" id="arrpedven" type="hidden" value="<?php echo $arrpedven ?>" />
</div>