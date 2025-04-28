<?php
	include '../../FunPerSecNiv/fncnumreg.php';
	include '../../FunPerSecNiv/fncfetch.php';
	include '../../FunPerSecNiv/fncconn.php';
	include '../../FunPerSecNiv/fncclose.php';
	include '../../FunPerPriNiv/pktblareafuncio.php';
	
?>
<select name="arefuncodigo" id="arefuncodigo">
	<option value = "">-- <?php if($setShow == '1'): ?>Todos<?php else: ?>Seleccione<?php endif; ?> --</option>
	<?php
		include ('../../FunGen/floadareafuncio.php');
		$idcon = fncconn();									
		floadareafunciodep($idcon, $departcodigo, $arefuncodigo);
		fncclose($idcon);
	?>
</select>