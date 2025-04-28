<?php 
	include ( "../../FunPerPriNiv/pktblvistaestatusmat.php");
	include ( "../../FunPerSecNiv/fncconn.php");
	include ( "../../FunPerSecNiv/fncclose.php");
	include ( "../../FunPerSecNiv/fncnumreg.php");
	include ( "../../FunPerSecNiv/fncfetch.php");
	include ( "../../FunPerPriNiv/pktblsaldo.php");
	include ( "../../FunPerPriNiv/pktblitemdesa.php");
	include ( "../../FunGen/cargainput.php");

	$idcon = fncconn();
?>
<table border="0" cellspacing="1" cellpadding="0" width="550px">
	<tr>
		<td class="NoiseFooterTD">&nbsp;C&oacute;digo&nbsp;</td>
		<td class="NoiseDataTD"><input type="text" name="itedescodigo" id="itedescodigo" /></td>
	</tr>
	<tr>
		<td class="NoiseFooterTD">&nbsp;Ancho&nbsp;<b>(mm)</b></td>
		<td class="NoiseDataTD">
			<select name="itedesancho" id="itedesancho">
				<option value="">--Seleccione--</option>
				<?php
					include ('../../FunGen/floadestatusmat.php');
					floaditedesancho($idcon);
				?>
			</select>
		</td>
	</tr>
	<tr>
		<td class="NoiseFooterTD">&nbsp;Calibre&nbsp;<b>(&micro;m)</b></td>
		<td class="NoiseDataTD">
			<select name="itedescalib" id="itedescalib">
				<option value="">--Seleccione--</option>
				<?php
					floadcalibre($idcon);
				?>
			</select>
		</td>
	</tr>
	<tr>
		<td colspan="2">
			<div id="filteritemlist"><?php include 'jquery.listaitems.php'; ?></div>
		</td>
	</tr>	
</table>