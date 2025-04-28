<?php 
	include '../../FunPerSecNiv/fncconn.php';
	include '../../FunPerSecNiv/fncclose.php';
	include '../../FunPerSecNiv/fncnumreg.php';
	include '../../FunPerSecNiv/fncfetch.php';
	include '../../FunGen/cargainput.php';

	$idcon = fncconn();
?>
<table border="0" cellspacing="1" cellpadding="0">
	<tr>
		<td>
			<div id="filteritemlist"><?php include 'jquery.listamateapoy.php'; ?></div>
		</td>
	</tr>	
</table>