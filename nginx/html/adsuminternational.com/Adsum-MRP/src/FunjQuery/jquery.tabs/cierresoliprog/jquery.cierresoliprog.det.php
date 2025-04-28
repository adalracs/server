<?php $idcon = fncconn(); ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" class="ui-widget-content">
	<tr class="ui-state-default">
		<td class="cont-title">&nbsp;Cierre Solicitud de Programacion</td>
	</tr>
</table>
<table width="100%" border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content">
	<tr>
		<td width="20%" class="NoiseFooterTD">&nbsp;Estado Final</td>
		<td colspan="3" class="NoiseDataTD">&nbsp;<?php echo ($opestacodigo)? cargaopestanombre($opestacodigo,$idcon) : '---' ;?></td>
	</tr>
	<tr>
		<td width="20%" class="NoiseFooterTD">&nbsp;Calificacion</td>
		<td colspan="3" class="NoiseDataTD">&nbsp;<?php echo ($tipcumcodigo)? cargatipcumnombre($tipcumcodigo,$idcon) : '---' ;?></td>
	</tr>
	<tr><td colspan="4" class="NoiseFooterTD">&nbsp;Aclaraci&oacute;n</td></tr>
	<tr>
  		<td colspan="4" rowspan="3" class="NoiseDataTD">&nbsp;<?php echo $cieoppdescri; ?></td>
 	</tr>
</table>
<?php fncclose($idcon); ?>