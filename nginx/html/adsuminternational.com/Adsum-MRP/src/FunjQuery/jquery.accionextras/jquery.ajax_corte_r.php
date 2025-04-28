<?php 

	include '../../FunPerPriNiv/pktblvistaitemplaneacion.php';
	include '../../FunPerPriNiv/pktblitemdesa.php';
	include '../../FunPerSecNiv/fncconn.php';
	include '../../FunPerSecNiv/fncclose.php';
	include '../../FunPerSecNiv/fncnumreg.php';
	include '../../FunPerSecNiv/fncfetch.php';
	include '../../FunPerSecNiv/fncsqlrun.php';
	
	if($material)
	{
		$rowMaterial = explode(':-:', $material);
		$idcon = fncconn();
		$obj_ancho = 'ancho_';
		$obj_anchoc = 'anchoc_';
		$obj_destino = 'destino_';
		$obj_diferencia_mm = 'diferencia_mm_';
		$obj_diferencia_kg = 'diferencia_kg_';
		$lb_diferencia_mm = 'lb_diferencia_mm_';
		$lb_diferencia_kg = 'lb_diferencia_kg_';
		$rwitem = loadrecorditemdesa($rowMaterial[0],$idcon);
		$$obj_ancho = $rwitem['itedesancho'];
	}

?>
<div style="width:500px">
	<span id="mensaje"></span>
	<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center">	
		<tr>
			<td width="30%" class="NoiseFooterTD">&nbsp;Material</td>
			  <td width="70%" class="NoiseDataTD">&nbsp;<?php echo $rwitem['itedesnombre'] ?></td>
		</tr>
		<tr>
			<td width="30%" class="NoiseFooterTD">&nbsp;Ancho (mm)/td>
			  <td width="70%" class="NoiseDataTD">&nbsp;<input type="hidden" name="<?php echo $obj_ancho ?>" id="<?php echo $obj_ancho ?>" size="60" value="<?php echo $$obj_ancho ?>" /><?php echo $$obj_ancho ?> (mm)</td>
		</tr>
		<tr>
			<td width="30%" class="NoiseFooterTD">&nbsp;Ancho Corte (mm)</td>
			  <td width="70%" class="NoiseDataTD"><input type="text" name="<?php echo $obj_anchoc ?>" id="<?php echo $obj_anchoc ?>" value="<?php echo $$obj_anchoc ?>" onkeyup="eventAnchoc(this,'<?php echo $material?>');" /></td>
		</tr>
		<tr>
			<td width="30%" class="NoiseFooterTD">&nbsp;Diferencia (mm)</td>
			  <td width="70%" class="NoiseDataTD"><input type="hidden" name="<?php echo $obj_diferencia_mm ?>" id="<?php echo $obj_diferencia_mm ?>" value="<?php echo $$obj_diferencia_mm ?>" /><span id="<?php echo $lb_diferencia_mm ?>"> 0.0 </span></td>
		</tr>
		<tr>
			<td width="30%" class="NoiseFooterTD">&nbsp;Diferencia (kg)</td>
			  <td width="70%" class="NoiseDataTD"><input type="hidden" name="<?php echo $obj_diferencia_kg ?>" id="<?php echo $obj_diferencia_kg ?>" value="<?php echo $$obj_diferencia_kg ?>" /><span id="<?php echo $lb_diferencia_kg ?>"> 0.0 </span></td>
		</tr>
		<tr>
			<td width="30%" class="NoiseFooterTD">&nbsp;Destino</td>
			  <td width="70%" class="NoiseDataTD">
			  	<select name="<?php echo $obj_destino ?>" id="<?php echo $obj_destino ?>"> 
			  		<option value="">--Seleccione--</option>
			  		<option value="tirilla">Tirilla</option>
			  		<option value="extra_ancho">Extra-ancho</option>
			  		<option value="item">Item</option>
			  	</select>
			  </td>
		</tr>
	</table>
</div>
<input type="hidden" name="newRow" id="newRow" size="60" value="<?php echo $newRow ?>" />
<input type="hidden" name="evento_ventana" id="evento_ventana" size="60" value="corte_r" />