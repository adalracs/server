<!-- 	DATOS SOLICITUD -->
<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" class="ui-widget-content">
	<tr class="ui-state-default">
		<td class="cont-title">&nbsp;Datos de la solicitud</td>
		<td class="cont-title">&nbsp;Ruta : <?php echo ($rutaitempv)? strtoupper($rutaitempv) : '---' ; ?></td>
	</tr>
</table>
<table width="100%" border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content">
	<tr>
		<td width="20%" class="NoiseFooterTD">&nbsp;Ubicaci&oacute;n</td>
		<td width="30%" class="NoiseDataTD">&nbsp;<?php echo cargaplantanombre($plantacodigo, $idcon); ?>&nbsp;</td>
		<td width="20%" class="NoiseFooterTD">&nbsp;Solicitante</td>
		<td width="30%" class="NoiseDataTD">&nbsp;<?php echo ($usuacodigo)? cargausuanombre($usuacodigo, $idcon) : '---' ; ?>&nbsp;</td>
	</tr>
	<tr>
		<td width="20%" class="NoiseFooterTD">&nbsp;PV</td>
		<td width="30%" class="NoiseDataTD">&nbsp;<?php echo  ($pedvennumero)? $pedvennumero : '---' ;  ?>&nbsp;</td>
		<td width="20%" class="NoiseFooterTD">&nbsp;Item</td>
		<td width="30%" class="NoiseDataTD">&nbsp;<?php echo  ($produccoduno)? $produccoduno : '---' ; ?>&nbsp;</td>
	</tr>
	<tr>
		<td width="20%" class="NoiseFooterTD">&nbsp;Ref.</td>
		<td colspan="3" class="NoiseDataTD">&nbsp;<?php echo  ($producnombre)? $producnombre : '---' ; ?>&nbsp;</td>
	</tr>
	<tr>
		<td width="20%" class="NoiseFooterTD">&nbsp;Cantidad Solicitada</td>
		<td width="30%" class="NoiseDataTD">&nbsp;<?php echo  ($propedcansol)? $propedcansol : '---' ;  ?>&nbsp;</td>
		<td width="20%" class="NoiseFooterTD">&nbsp;Unidad</td>
		<td width="30%" class="NoiseDataTD">&nbsp;<?php echo  ($unidadcodigo)? $unidadcodigo : '---' ; ?>&nbsp;</td>
	</tr>
	<tr>
		<td width="20%" class="NoiseFooterTD">&nbsp;NIT</td>
		<td colspan="3" class="NoiseDataTD">&nbsp;<?php echo  ($ordcomcodcli)? $ordcomcodcli : '---' ; ?>&nbsp;</td>
	</tr>
	<tr>
		<td width="20%" class="NoiseFooterTD">&nbsp;Razon Social</td>
		<td colspan="3" class="NoiseDataTD">&nbsp;<?php echo  ($ordcomrazsoc)? $ordcomrazsoc : '---' ; ?>&nbsp;</td>
	</tr>
	<tr>
		<td width="20%" class="NoiseFooterTD">&nbsp;Fecha de recepcion oc</td>
		<td width="30%" class="NoiseDataTD">&nbsp;<?php echo ($pedvenfecrec)? $pedvenfecrec : '---' ; ?>&nbsp;</td>
		<td width="20%" class="NoiseFooterTD">&nbsp;Fecha de elaboracion</td>
		<td width="30%" class="NoiseDataTD">&nbsp;<?php echo ($pedvenfecelb)? $pedvenfecelb : '---' ; ?>&nbsp;</td>
	</tr>
	<tr>
		<td width="20%" class="NoiseFooterTD">&nbsp;Fecha de entrega</td>
		<td width="30%" class="NoiseDataTD">&nbsp;<?php echo ($pedvenfecent)? $pedvenfecent : '---' ; ?>&nbsp;</td>
		<td width="20%" class="NoiseFooterTD">&nbsp;Fecha estimada</td>
		<td width="30%" class="NoiseDataTD">&nbsp;<?php echo ($solprofecest)? $solprofecest : '---' ; ?>&nbsp;</td>
	</tr>
</table>

