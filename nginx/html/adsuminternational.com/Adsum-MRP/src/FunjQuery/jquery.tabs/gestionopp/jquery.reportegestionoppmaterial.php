<?php if($rwOpestado['opestatipo'] == 3 || $rwOpestado['opestatipo'] == 4):?>

	<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" class="ui-widget-content">
		<tr class="ui-state-default">
			<td class="cont-title">&nbsp;Reporte de opp</td>
		</tr>
	</table>

	<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" class="ui-widget-content">
		<tr>
			<td width="20%" class="NoiseFooterTD">&nbsp;Material a entregar :</td>
			<td width="80%" class="NoiseDataTD">&nbsp;
				<select name="idmaterial" id="idmaterial">
					<option value="">--Seleccione--</option>
					<?php 
						include ('../src/FunGen/floadgestionopp.php');
						floadgestioopp_reporte($idmaterial, $ordoppcodigo, $idcon);
					?>
				</select>
			</td>
		</tr>
	</table>

	<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" class="ui-widget-content">
		<tr>
			<td class="NoiseFooterTD">
				<div class="ui-buttonset-fe">
					<button id="ingresarbobina">Ingresar rollo</button>
					<button id="quitarbobina">Retirar rollo</button>
				</div>
			</td>
		</tr>
		<tr>
			<td class="NoiseDataTD">
				<div id="listadobobinas">
					<?php
						$noAjax = true;
						include '../src/FunjQuery/jquery.visors/jquery.reporteopp.php';
					?>
				</div>
				<input type="hidden" name="arrbobina" id="arrbobina" value="<?php echo $arrbobina ?>" />
				<input type="hidden" name="arrbobinatmp" id="arrbobinatmp" value="<?php echo $arrbobinatmp ?>" />
			</td>
		</tr>
	</table>

<?php endif; ?>