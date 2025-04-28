<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" class="ui-widget-content">
	<tr class="ui-state-default">
		<td class="cont-title">&nbsp;Datos de la OPP</td>
	</tr>
</table>
<table width="100%" border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content">
	<tr>
		<td width="20%" class="NoiseFooterTD">&nbsp;Ubicaci&oacute;n</td>
		<td width="30%" class="NoiseDataTD">&nbsp;<?php echo ($plantanombre)? strtoupper($plantanombre) : '---' ;?></td>
		<td width="20%" class="NoiseFooterTD">&nbsp;Proceso</td>
		<td width="30%" class="NoiseDataTD">&nbsp;<?php echo ($procednombre)? strtoupper($procednombre) : '---' ; ?></td>
	</tr>
	<tr>
		<td width="20%" class="NoiseFooterTD">&nbsp;PV</td>
		<td width="30%" class="NoiseDataTD">&nbsp;<?php echo ($pedvennumero)? strtoupper($pedvennumero) : '---' ;?></td>
		<td width="20%" class="NoiseFooterTD">&nbsp;Tipo PV</td>
		<td width="30%" class="NoiseDataTD">&nbsp;<?php echo ($tipevenombre)? strtoupper($tipevenombre) : '---' ; ?></td>
	</tr>
	<tr>
		<td width="20%" class="NoiseFooterTD">&nbsp;Item</td>
		<td width="30%" class="NoiseDataTD">&nbsp;<?php echo ($produccoduno)? strtoupper($produccoduno) : '---' ;?></td>
		<td width="20%" class="NoiseFooterTD">&nbsp;Orden entrada</td>
		<td width="30%" class="NoiseDataTD">&nbsp;<?php echo ($prograindice)? strtoupper($prograindice) : '---' ; ?></td>
	</tr>
	<tr>
		<td width="20%" class="NoiseFooterTD">&nbsp;Referencia</td>
		<td colspan="3" class="NoiseDataTD">&nbsp;<?php echo ($producnombre)? strtoupper($producnombre) : '---' ;?></td>
	</tr>
	<tr>
		<td width="20%" class="NoiseFooterTD">&nbsp;Cliente</td>
		<td colspan="3" class="NoiseDataTD">&nbsp;<?php echo ($ordcomrazsoc)? strtoupper($ordcomrazsoc) : '---' ; ?></td>
	</tr>
	<tr>
		<td width="20%" class="NoiseFooterTD">&nbsp;Equipo</td>
		<td colspan="3" class="NoiseDataTD">&nbsp;<?php echo ($equiponombre)? strtoupper($equiponombre) : '---' ; ?></td>
	</tr>
	<tr>
		<td width="20%" class="NoiseFooterTD">&nbsp;Ruta Completa</td>
		<td colspan="3" class="NoiseDataTD">&nbsp;<?php echo ($rutaitempv)? strtoupper($rutaitempv) : '---' ; ?></td>
	</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" class="ui-widget-content">
	<tr class="ui-state-default">
		<td class="cont-title">&nbsp;Cierre opp</td>
	</tr>
</table>
<table width="100%" border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content">
	<tr>
		<td width="20%" class="NoiseFooterTD"><?php if($campnomb["opestacodigo"] == 1){ $opestacodigo = null;echo "*";}?>&nbsp;Estado</td>
		<td colspan="3" class="NoiseDataTD">
			<select name="opestacodigo" id="opestacodigo">
				<option value="">--Seleccione--</option>
					<?php 
						include '../src/FunGen/floadopestado.php';	
						floadopestadocierre($opestacodigo, $idcon);
					?>
			</select>
		</td>
	</tr>
	<tr>
		<td width="20%" class="NoiseFooterTD"><?php if($campnomb["tipcumcodigo"] == 1){ $tipcumcodigo = null;echo "*";}?>&nbsp;Cumplimiento</td>
		<td colspan="3" class="NoiseDataTD">
			<select name="tipcumcodigo" id="tipcumcodigo">
				<option value="">--Seleccione--</option>
					<?php 
						include '../src/FunGen/floadtipocump.php';	
						floadtipocump($idcon,$tipcumcodigo);
					?>
			</select>
		</td>
	</tr>
	<tr><td colspan="4" class="NoiseFooterTD"><?php if($campnomb["cieoppdescri"] == 1){ $cieoppdescri = null;echo "*";}?>&nbsp;Aclaraci&oacute;n</td></tr>
	<tr>
  		<td colspan="4" rowspan="3"><textarea name="cieoppdescri" cols="90" rows="3"><?php echo $cieoppdescri; ?></textarea></td>
 	</tr>
</table>