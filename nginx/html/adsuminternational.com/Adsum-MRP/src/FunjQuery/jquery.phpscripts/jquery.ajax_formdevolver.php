<?php 
include_once 'jquery.array_json.php';
include_once '../../FunPerPriNiv/pktblmodulo.php';
include_once '../../FunPerPriNiv/pktblusuario.php';
include_once '../../FunPerSecNiv/fncnumreg.php';
include_once '../../FunPerSecNiv/fncfetch.php';
include_once '../../FunPerSecNiv/fncconn.php';
include_once '../../FunPerSecNiv/fncclose.php';

$idcon = fncconn();

?>
<table width="100%" border="0" cellspacing="1" cellpadding="0" align="left" class="ui-widget-content">
    <tr>
    	<td class="NoiseFooterTD"><div id="erredit" style="display:none;"><div class="ui-widget">
			<div class="ui-state-error ui-corner-all" style="padding: 0 .7em;"> 
				<p><span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span> 
				<strong>Advertencia:</strong> Especifique el motivo de devolucion y departamento.</p>
			</div>
		</div></div></td>
	</tr>
	<tr><td class="NoiseFooterTD"><span style="color:red;">*</span>&nbsp;Departamento</td></tr>
	<tr>
		<td class="NoiseDataTD">
			<input type="hidden" name="modulocodigoorg" id="modulocodigoorg" value="<?php echo $modulocodigoorg; ?>">
			<select id="modulocodigodes" name="modulocodigodes">
				<option value="">--Seleccione--</option>
				<?php 
					include_once ('../../FunGen/floadmodulo.php');
					floadmodulo1($modulocodigodes, $modulocodigoorg, $idcon);
				?>
			</select>
		</td>
	</tr>
   	<tr><td class="NoiseFooterTD"><span style="color:red;">*</span>&nbsp;Motivo</td></tr>
	<tr>
		<td rowspan="2" class="NoiseDataTD">
			<input type="hidden" name="idusuario" id="idusuario" value="<?php echo $idusuario; ?>">
			<textarea name="textmotivo" id="textmotivo" rows="4" cols="56"></textarea>
		</td>
	</tr>
</table>
<?php fncclose($idcon); ?>