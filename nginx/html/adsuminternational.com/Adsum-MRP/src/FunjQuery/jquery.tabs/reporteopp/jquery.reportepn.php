<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" class="ui-widget-content">
	<tr class="ui-state-default">
		<td class="cont-title">&nbsp;Reporte Pn&nbsp;|&nbsp;Desea usted reportar producci&oacute;n&nbsp;Si&nbsp;<input type="radio" name="reportepnval" id="reportepnval" value="si" <?php if($reportepnval == 'si'){echo 'checked';}?> onclick="eventreportepnval(this.value);" />&nbsp;No&nbsp;<input type="radio" name="reportepnval" id="reportepnval" value="no" <?php if($reportepnval == 'no'){echo 'checked';}?> onclick="eventreportepnval(this.value);" /></td>
	</tr>
</table>

<div id="sesion_reporteopp" style="display : <?php echo ($reportepnval == "si")? "block" : "none" ; ?>">
	<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" class="ui-widget-content">
		<tr class="ui-state-default">
			<td class="cont-title">&nbsp;<?php if($campnomb["arrmatrep"] == 1){ $arrmatrep = null;echo "*";}?>Reporte
			Material Implicado</td>
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
				<div id="listadoreportematerial">
					<?php
						$noAjax = true;
						include '../src/FunjQuery/jquery.visors/jquery.mtreporteopp.php';
					?>
				</div>
				<input type="hidden" name="arrmatrep" id="arrmatrep" value="<?php echo $arrmatrep ?>" /> 
				<input type="hidden" name="arrmatreptmp" id="arrmatreptmp" value="<?php echo $arrmatreptmp ?>" /></td>
		</tr>
	</table>
	
	<table width="100%" border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content">

	<?php //if($tipsolcodigo != 5 && $tipsolcodigo != 6 && $tipsolcodigo != 7 && $tipsolcodigo != 12){?>
		<tr>
			<td width="20%" class="NoiseFooterTD"><?php if($campnomb["reoppncantkg"] == 1){ $reoppncantkg = null;echo "*";}?>&nbsp;Kilos&nbsp;<b>(kgs)</b></td>
			<td width="30%" class="NoiseDataTD">&nbsp;<input type="text" name="reoppncantkg" id="reoppncantkg" value="<?php echo $reoppncantkg ?>" size="15" /></td>
			<td width="20%" class="NoiseFooterTD"><?php if($campnomb["reoppncantmt"] == 1){ $reoppncantmt = null;echo "*";}?>&nbsp;Metros&nbsp;<b>(mts)</b></td>
			<td width="30%" class="NoiseDataTD">&nbsp;<input type="text" name="reoppncantmt" id="reoppncantmt" value="<?php echo $reoppncantmt ?>" size="15" /></td>
		</tr>
	<?php //}else{?>
		<tr>
			<td width="20%" class="NoiseFooterTD"><?php if($campnomb["reoppncantun"] == 1){ $reoppncantun = null;echo "*";}?>&nbsp;Unidades&nbsp;<b>(und)</b></td>
			<td colspan="3" class="NoiseDataTD">&nbsp;<input type="text" name="reoppncantun" id="reoppncantun" value="<?php echo $reoppncantun ?>" size="15" /></td>
		</tr>
	<?php //}?>
	</table>
	<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" class="ui-widget-content">
		<tr class="ui-state-default">
			<td class="cont-title">&nbsp;Observaciones</td>
		</tr>
	</table>
	<table width="100%" border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content">
		<tr>
			<td colspan="4" rowspan="2" class="NoiseDataTD"><textarea name="reoppndescri" id="reoppndescri" rows="3" cols="95"><?php echo $reoppndescri ?></textarea></td>
		</tr>
	</table>
</div>