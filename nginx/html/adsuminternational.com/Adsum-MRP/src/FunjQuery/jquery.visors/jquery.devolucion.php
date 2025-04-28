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
				<td width="55px" class="ui-state-default" style="border-top:0; border-bottom:0; border-left: 1px solid #fff;">&nbsp;No Pv.</td>
				<td width="55px" class="ui-state-default" style="border-top:0; border-bottom:0; border-left: 1px solid #fff;">&nbsp;Item</td>
				<td width="220px" class="ui-state-default" style="border-top:0; border-bottom:0; border-left: 1px solid #fff;">&nbsp;Referencia</td>
				<td width="90px" class="ui-state-default" style="border-top:0; border-bottom:0; border-left: 1px solid #fff;">&nbsp;Tipo Reclamo</td>
				<td width="70px" class="ui-state-default" style="border-top:0; border-bottom:0; border-left: 1px solid #fff;">&nbsp;No Fac.</td>
				<td width="80px" class="ui-state-default" style="border-top:0; border-bottom:0; border-left: 1px solid #fff;">&nbsp;Fecha Fac.</td>
				<td width="45px" class="ui-state-default" style="border-top:0; border-bottom:0; border-left: 1px solid #fff;">&nbsp;Cant.</td>
				<td width="35px" class="ui-state-default" style="border-top:0; border-bottom:0; border-left: 1px solid #fff;">&nbsp;Med.</td>
				<td width="180px" class="ui-state-default" style="border-top:0; border-bottom:0; border-left: 1px solid #fff;">&nbsp;Nota.</td>
				<td width="100px" class="ui-state-default" style="border-top:0; border-bottom:0; border-left: 1px solid #fff;">&nbsp;Autorizado.</td>
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
					
					if($$objRecPR > 0){$tipoReclamo = '<b>P</b>&nbsp;';}
					if($$objRecAS > 0){$tipoReclamo = ($tipoReclamo)? $tipoReclamo .'- <b>A/S</b>&nbsp;' : '&nbsp;<b>A/S</b>&nbsp;';}
					if($$objRecEL > 0){$tipoReclamo = ($tipoReclamo)? $tipoReclamo.'- <b>E/S</b>&nbsp;' : '&nbsp;<b>E/S</b>&nbsp;';}
					
					$objNumfac = 'devpednumfac_'.$arrObject[$a];
					$objFecfac = 'devpedfecfac_'.$arrObject[$a];
					$objDesc = 'devpeddescri_'.$arrObject[$a];
					$objAutori = 'devpedautori_'.$arrObject[$a];
					
					
					($a % 2) ? $class = "NoiseDataTD" : $class = "NoiseFooterTD";
			?>
			<tr class="<?php echo $class ?>">
				<td width="55px" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo $rsPedidoVenta['pedvennumero'] ?></td>
				<td width="55px" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo $rsProducto['produccoduno'] ?></td>
				<td width="220px" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo $rsProducto['producnombre'] ?></td>
				<td width="90px" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo $tipoReclamo ?></td>
				<td width="70px" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<input type="text" name="<?php echo $objNumfac ?>" id="<?php echo $objNumfac ?>" value="<?php echo $$objNumfac ?>" size="5"/></td>
				<td width="80px" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<input type="text" name="<?php echo $objFecfac ?>" id="<?php echo $objFecfac ?>" value="<?php echo $$objFecfac ?>" size="7" onfocus="this.blur();"/><?php if(!$flagdet):?><script type="text/javascript">$(function(){$('#<?php echo $objFecfac ?>').datepicker({buttonImageOnly : 'false',changeYear : 'true',numberOfMonths : 1,dateFormat : 'yy-mm-dd'});});</script><?php endif ?></td>
				<td width="45px" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo $$objCantid ?></td>
				<td width="35px" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<?php echo $rsProducPedido['unidadcodigo'] ?></td>
				<td width="180px" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<input type="text" name="<?php echo $objDesc ?>" id="<?php echo $objDesc ?>" value="<?php echo $$objDesc ?>" size="23"/></td>
				<td width="103px" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;Si<input type="radio" name="<?php echo $objAutori ?>" id="<?php echo $objAutori ?>" value="t" <?php if($$objAutori == 't'){echo 'checked';}?>>&nbsp;No<input type="radio" name="<?php echo $objAutori ?>" id="<?php echo $objAutori ?>" value="f" <?php if($$objAutori == 'f'){echo 'checked';}?>></td>
			</tr>
			<?php 
				endfor;
				unset($arrObject);

				if($a < 13):
					for($b = $a; $b < 13; $b++):
						($b % 2) ? $class = "NoiseDataTD" : $class = "NoiseFooterTD";
			?>
			<tr class="<?php echo $class ?>">			
				<td width="55px" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="55px" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="220px" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="90px" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="70px" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="80px" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="45px" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="35px" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="180px" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="103px" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
			</tr>
			<?php
					endfor;
				endif;
			?>		
		</table>
	</div>
		<input name="arrpedven" id="arrpedven" type="hidden" value="<?php echo $arrpedven ?>" />
</div>