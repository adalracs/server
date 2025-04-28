<div id="opt-tab1">
		<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
			<tr>
  				<td width="20%" class="NoiseFooterTD">&nbsp;Tipo De Pedido</td>
  				<td colspan="3" class="NoiseDataTD">&nbsp;<input type="hidden" name="tipopedido" value="<?php echo $tipopedido ?>" /><?php echo $tipopedido ?></td>
  			</tr>
  			<?php if($tipevecodigo != 4): ?>
  			<tr>
  				<td width="20%" class="NoiseFooterTD">&nbsp;No. Pedido Venta</td>
  				<td width="40%" class="NoiseDataTD">&nbsp;<input type="hidden" name="pedvennumero" value="<?php echo $pedvennumero ?>" /><?php echo $pedvennumero ?></td>
  				<td width="20%" class="NoiseFooterTD">&nbsp;Fecha Entrega</td>
  				<td width="20%" class="NoiseDataTD">&nbsp;<input type="hidden" name="pedvenfecent" value="<?php echo $pedvenfecent ?>" /><?php echo $pedvenfecent ?></td>
  			</tr>
  			<tr>
  				<td width="20%" class="NoiseFooterTD">&nbsp;ITEM PV</td>
  				<td width="40%" class="NoiseDataTD">&nbsp;<input type="hidden" name="produccoduno" value="<?php echo $produccoduno ?>" /><?php echo $produccoduno ?></td>
  				<td width="20%" class="NoiseFooterTD">&nbsp;<input type="hidden" name="unimedi" value="<?php echo $unimedi?>" />Cantidad</td>
  				<td width="20%" class="NoiseDataTD">&nbsp;<input type="hidden" name="cantsol" value="<?php echo $cantsol ?>" /><?php echo $cantsol ?>(<?php echo $unimedi ?>)</td>
  			</tr>
  			<tr>
  				<td width="20%" class="NoiseFooterTD">&nbsp;Cliente</td>
  				<td width="40%" class="NoiseDataTD">&nbsp;<input type="hidden" name="clientnombre" value="<?php echo $clientnombre ?>"/><?php echo $clientnombre ?> </td>
  				<td width="20%" class="NoiseFooterTD">&nbsp;Fecha de Elaboracion</td>
  				<td width="20%" class="NoiseDataTD">&nbsp;<input type="hidden" name="pedvenfecrec" value="<?php echo $pedvenfecrec ?>"/><?php echo $pedvenfecrec ?></td>
  			</tr>
  			<tr>
  				
  				<td width="20%" class="NoiseFooterTD">&nbsp;Referencia</td>
  				<td colspan="3" class="NoiseDataTD">&nbsp;<input type="hidden" name="producnombre" value="<?php echo $producnombre ?>" /><?php echo $producnombre ?></td>
  			</tr>
  			<?php else:?>
  			<tr>
  				<td width="20%" class="NoiseFooterTD">&nbsp;No. Muestra</td>
  				<td width="40%" class="NoiseDataTD">&nbsp;<input type="hidden" name="pedvenconsec" value="<?php echo $pedvenconsec ?>" /><?php echo $pedvenconsec ?></td>
  				<td width="20%" class="NoiseFooterTD">&nbsp;Fecha de Elaboracion</td>
  				<td width="20%" class="NoiseDataTD">&nbsp;<input type="hidden" name="pedvenfecrec" value="<?php echo $pedvenfecrec ?>"/><?php echo $pedvenfecrec ?></td>
  			</tr>
  			<tr>
  				<td width="20%" class="NoiseFooterTD">&nbsp;ITEM MV</td>
  				<td width="40%" class="NoiseDataTD">&nbsp;<input type="hidden" name="produccodigo" value="<?php echo $produccodigo ?>" /><?php echo $produccodigo ?></td>
  				<td width="20%" class="NoiseFooterTD">&nbsp;<input type="hidden" name="unimedi" value="<?php echo $unimedi?>" />Cantidad Solicitada</td>
  				<td width="20%" class="NoiseDataTD">&nbsp;<input type="hidden" name="cantsol" id="cantsol" value="<?php echo $cantsol ?>" /><?php echo $cantsol ?>(<?php echo $unimedi ?>) </td>
  			</tr>
  			<tr>
  				<td width="20%" class="NoiseFooterTD">&nbsp;Nombre Proyecto</td>
  				<td colspan="3" class="NoiseDataTD">&nbsp;<input type="hidden" name="pedvennompro" value="<?php echo $pedvennompro ?>" /><?php echo $pedvennompro ?></td>
  			</tr>
  			<tr>
  				<td width="20%" class="NoiseFooterTD">&nbsp;Motivo Muestra</td>
  				<td colspan="3" class="NoiseDataTD">&nbsp;<input type="hidden" name="pedvenmotmue" value="<?php echo $pedvenmotmue ?>"/><?php echo $pedvenmotmue ?></td>
  			</tr>
  			<?php endif;?>
		</table>	
</div>