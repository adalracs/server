<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" class="ui-widget-content">
	<tr class="ui-state-default">
		<td class="cont-title">&nbsp;<?php if($campnomb["arrmatsaldo"] == 1){ $arrmatsaldo = null;echo "*";}?>Reporte Saldos</td>
	</tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" class="ui-widget-content">
	<tr>
		<td class="NoiseFooterTD">
		<div class="ui-buttonset-fe">
		<button id="ingresarsaldo">Agregar saldo</button>
		<button id="quitarsaldo">Quitar saldo</button>
		</div>
		</td>
	</tr>
	<tr>
		<td class="NoiseDataTD">
			<div id="listadoreportesaldo">
				<?php
					$noAjax = true;
					include '../src/FunjQuery/jquery.visors/jquery.mtreporteoppsaldo.php';
				?>
			</div>
			<input type="hidden" name="arrmatsaldo" id="arrmatsaldo" value="<?php echo $arrmatsaldo; ?>" /> 
			<input type="hidden" name="arrmatsaldotmp" id="arrmatsaldotmp" value="<?php echo $arrmatsaldotmp; ?>" /></td>
	</tr>
</table>