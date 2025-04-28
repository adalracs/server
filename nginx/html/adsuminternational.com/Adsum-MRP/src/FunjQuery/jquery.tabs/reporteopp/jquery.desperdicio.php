<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" class="ui-widget-content">
	<tr class="ui-state-default">
		<td class="cont-title">&nbsp;<?php if($campnomb["arrdesperdiciopn"] == 1){ $arrdesperdiciopn = null;echo "*";}?>Desperdicio</td>
	</tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" class="ui-widget-content">
	<tr>
		<td class="NoiseFooterTD">
		<div class="ui-buttonset-fe">
		<button id="ingresardpn">Agregar item</button>
		<button id="quitardpn">Quitar item</button>
		</div>
		</td>
	</tr>
	<tr>
		<td class="NoiseDataTD">
			<div id="listadodesperdicio">
				<?php
					$noAjax = true;
					include '../src/FunjQuery/jquery.visors/jquery.desperdiciopn.php';
				?>
			</div>
			<input type="hidden" name="arrdesperdiciopn" id="arrdesperdiciopn" value="<?php echo $arrdesperdiciopn ?>" /> 
			<input type="hidden" name="arrdesperdiciopntmp" id="arrdesperdiciopntmp" value="<?php echo $arrdesperdiciopntmp ?>" /></td>
	</tr>
</table>