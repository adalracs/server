<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" class="ui-widget-content">
	<tr class="ui-state-default">
		<td class="cont-title">&nbsp;Banderas</td>
	</tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" class="ui-widget-content">
	<tr>
		<td class="NoiseDataTD">
			<div id="listadobanderas">
				<?php
					$noAjax = true;
					include '../src/FunjQuery/jquery.visors/jquery.bandera.php';
				?>
			</div>
			<input type="hidden" name="arrflagproduccion" id="arrflagproduccion" value="<?php echo $arrflagproduccion ?>" /> 
		</td>
	</tr>
</table>
