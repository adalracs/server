<?php
	ini_set('display_errors', 0);
	include '../../FunPerPriNiv/pktblciudad.php';
	include '../../FunPerSecNiv/fncnumreg.php';
	include '../../FunPerSecNiv/fncfetch.php';
	include '../../FunPerSecNiv/fncconn.php';
	include '../../FunPerSecNiv/fncclose.php';
?>
<select name="ciudadcodigo" id="ciudadcodigo">
	<option value = "">-- Seleccione --</option>
	<?php
		include ('../../FunGen/floadciudad.php');
		$idcon = fncconn();									
		floadtociudad($id, $father, $idcon);
		fncclose($idcon);
	?>
</select>

