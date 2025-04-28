<?php 
	ini_set('display_errors', 0);
	include_once '../../FunPerPriNiv/pktblusuario.php';
	include_once '../../FunPerSecNiv/fncconn.php';
	include_once '../../FunPerSecNiv/fncclose.php';

	$idcon = fncconn();
	$iRegusuario = loadrecordusuario($usuacodigo, $idcon);
?>	
<table width="100%" border="0" cellspacing="1" cellpadding="1"  align="center">
	<tr>
  		<td class="NoiseFooterTD" width="30%">&nbsp;Usuario</td>
  		<td class="NoiseDataTD" width="70%">&nbsp;<?php echo $iRegusuario[usuanomb]; ?></td>
  	</tr>
  	<tr>
  		<td class="NoiseFooterTD"><span id="errorp"></span>&nbsp;Clave</td>
  		<td class="NoiseDataTD"><input name="usuapass" id="pass1" type="password" value="" size="17"></td>
	</tr>
	<tr>	
		<td class="NoiseFooterTD"><span id="errorp1"></span>&nbsp;Confirmar</td>
  		<td class="NoiseDataTD"><input name="usuapass1" id="pass2" type="password" value="" size="17"></td>
	</tr>
	<tr><td colspan="2"><span id="msgerror" style="display: none"><font color="red">- Claves no coinciden</font></span></td></tr>
	<input type="hidden" id="codigousuario" name="codigousuario" value="<?php echo $usuacodigo; ?>">
</table>