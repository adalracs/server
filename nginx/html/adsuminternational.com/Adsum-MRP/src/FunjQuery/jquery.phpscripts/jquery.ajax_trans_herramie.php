<?php 
	ini_set('display_errors', 0);
	include '../../FunPerPriNiv/pktblherramie.php';
	include '../../FunPerSecNiv/fncconn.php';
	include '../../FunPerSecNiv/fncclose.php';

	$idcon = fncconn();
	$rs_herramie = loadrecordherramie($id, $idcon);
	fncclose($idcon);
?>
<table width="100%" border="0" cellspacing="0" cellpadding="1" align="center">
    <tr>
    	<td width="50%" class="ui-state-default">&nbsp;Disponible&nbsp;&nbsp;<?php echo $rs_herramie['herramdispon'] ?></td>
    	<td width="50%" class="ui-state-default">&nbsp;Valor&nbsp;&nbsp;<?php echo $rs_herramie['herramvalor'] ?><input type="hidden" name="herramvalor" value="<?php echo $rs_herramie[herramvalor] ?>"></td>
	</tr>
</table>