<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" class="ui-widget-content">
	<tr class="ui-state-default">
		<td class="cont-title">&nbsp;<?php if($campnomb["arritem"] == 1){ $arritem = null;echo "*";}?>Asignacion material</td>
	</tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" class="ui-widget-content">
	<tr>
		<td class="NoiseFooterTD">
			<div class="ui-buttonset-fe">
				<button id="ingresaritem">Agregar item</button>
				<button id="quitaritem">Quitar item</button>
			</div>
		</td>
	</tr>
	<tr>
		<td class="NoiseDataTD">
			<div id="listadoitems">
				<?php
					$noAjax = true;
					include '../src/FunjQuery/jquery.visors/jquery.gestionopp.php';
				?>
			</div>
			<input type="hidden" name="arritem" id="arritem" value="<?php echo $arritem ?>" />
			<input type="hidden" name="arritemtmp" id="arritemtmp" value="<?php echo $arritemtmp ?>" />
		</td>
	</tr>
</table>