<?php $idcon = fncconn(); ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" class="ui-widget-content">
	<tr class="ui-state-default">
		<td class="cont-title">&nbsp;Cierre Solicitud de Programacion</td>
	</tr>
</table>
<table width="100%" border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content">
	<tr>
		<td width="20%" class="NoiseFooterTD"><?php if($campnomb["opestacodigo"] == 1){ $opestacodigo = null;echo "*";}?>&nbsp;Estado Final</td>
		<td colspan="3" class="NoiseDataTD">
			<select name="opestacodigo" id="opestacodigo">
				<option value="">--Seleccione--</option>
					<?php 
						include '../src/FunGen/floadopestado.php';	
						floadopestadocierre($opestacodigo,$idcon);
					?>
			</select>
		</td>
	</tr>
	<tr>
		<td width="20%" class="NoiseFooterTD"><?php if($campnomb["tipcumcodigo"] == 1){ $tipcumcodigo = null;echo "*";}?>&nbsp;Calificacion</td>
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
	<tr><td colspan="4" class="NoiseFooterTD"><?php if($campnomb["ciesoldescri"] == 1){ $ciesoldescri = null;echo "*";}?>&nbsp;Aclaraci&oacute;n</td></tr>
	<tr>
  		<td colspan="4" rowspan="3"><textarea name="ciesoldescri" cols="90" rows="3"><?php echo $ciesoldescri; ?></textarea></td>
 	</tr>
</table>
<?php fncclose($idcon); ?>