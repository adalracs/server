<?php 
	ini_set('display_errors', 0);
	include '../../FunPerPriNiv/pktblitem.php';
	include '../../FunPerSecNiv/fncconn.php';
	include '../../FunPerSecNiv/fncclose.php';

	$idcon = fncconn();
	$rs_item = loadrecorditem($id, $idcon);
	fncclose($idcon);
?>
<table width="100%" border="0" cellspacing="0" cellpadding="1" align="center">
      <tr>
		<td width="25%" class="ui-state-default">&nbsp;Cant. M&iacute;nima&nbsp;&nbsp;<?php  echo $rs_item[itemcanmin]; ?></td>
		<td width="25%" class="ui-state-default">&nbsp;Cant. M&aacute;xima&nbsp;&nbsp;<?php  echo $rs_item[itemcanmax]; ?></td>
		<td width="25%" class="ui-state-default">&nbsp;Disponible&nbsp;&nbsp;<?php  echo $rs_item[itemdispon]; ?></td>
		<td width="25%" class="ui-state-default">Valor $&nbsp;&nbsp;<?php echo $rs_item[itemvalor]; ?><input type="hidden" name="itemvalor" value="<?php echo $rs_item[itemvalor] ?>"></td>
	</tr>
</table>