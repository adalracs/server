<?php 
ini_set('display_errors',1);
	include '../../FunPerSecNiv/fncconn.php';
	include '../../FunPerSecNiv/fncclose.php';
	include '../../FunPerSecNiv/fncnumreg.php';
	include '../../FunPerSecNiv/fncfetch.php';
	include '../../FunPerPriNiv/pktblopestado.php';
	include '../../FunPerPriNiv/pktbltiposoliprog.php';
	include '../../FunGen/cargainput.php';

	$idcon = fncconn();
?>
<table border="0" cellspacing="1" cellpadding="0">
	<tr>
		<td class="NoiseFooterTD">&nbsp;Tipo Solicitud</td>
		<td class="NoiseDataTD">
			<select name="tipsolcodigo" id="tipsolcodigo" onchange="ajaxFilterOrdenRequisicion();">
				<option value="">-- Seleccione --</option>
				<?php 
					include '../../FunGen/floadtiposoliprog.php';
					floadtiposoliprog($tipsolcodigo, $idcon);
				?>
			</select>
		</td>
	</tr>	
	<tr>
		<td class="NoiseFooterTD">&nbsp;Estado</td>
		<td class="NoiseDataTD">
			<select name="opestacodigo" id="opestacodigo" onchange="ajaxFilterOrdenRequisicion();">
				<option value="">-- Seleccione --</option>
				<?php 
					include '../../FunGen/floadopestado.php';
					floadopestadogestion($opestacodigo, $idcon);
				?>
			</select>
		</td>
	</tr>
	<tr>
		<td class="NoiseFooterTD">&nbsp;OPP</td>
		<td class="NoiseDataTD">
			<input type="text" name="solprocodigo" id="solprocodigo" onchange="ajaxFilterOrdenRequisicion();">
		</td>
	</tr>		
	<tr>
		<td colspan="2">
			<div id="filterordenrequisicion"><?php include 'jq.vlistordenrequisicion.php'; ?></div>
		</td>
	</tr>	
</table>