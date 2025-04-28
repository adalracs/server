<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" class="ui-widget-content">
	<tr class="ui-state-default">
		<td class="cont-title">&nbsp;<?php if($campnomb["arrtiempopn"] == 1){ $arrtiempopn = null;echo "*";}?>Tiempos produccion</td>
	</tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" class="ui-widget-content">
	<tr>
		<td class="NoiseFooterTD">
		<div class="ui-buttonset-fe">
		<button id="ingresartpn">Agregar item</button>
		<button id="quitartpn">Quitar item</button>
		</div>
		</td>
	</tr>
	<tr>
		<td class="NoiseDataTD">
			<div id="listadotiempopn">
				<?php
					$noAjax = true;
					include '../src/FunjQuery/jquery.visors/jquery.tiempopn.php';
				?>
			</div>
			<input type="hidden" name="arrtiempopn" id="arrtiempopn" value="<?php echo $arrtiempopn ?>" /> 
			<input type="hidden" name="arrtiempopntmp" id="arrtiempopntmp" value="<?php echo $arrtiempopntmp ?>" /></td>
	</tr>
</table>