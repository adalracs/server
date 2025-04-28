<<!-- Hidden SPAN -->
<SPAN id="printFrame" style="display:none;">
<CENTER>
<?php
// Output buffering

ob_start();
?>
<table width="100%" border="0">
<tr>
 <td bgcolor="#5961A0" colspan="2"><FONT face="Verdana" color="White">Solicitud de servicio</FONT></td>
</tr>
 <tr bgcolor="#F2F3F8">
  <td><B>Fecha:</B>&nbsp;<?= $solserfecha; ?></td>
  <td><B>C&oacute;digo:</B>&nbsp;<?= $solsercodigo; ?></td>
</tr>
<tr>
 <td bgcolor="#E8F0F6" colspan="2"><B>Encargado</B></td>
</tr>
<tr bgcolor="#F8FAFB">
 <td><B>C&oacute;digo:</B>&nbsp;<?= $sbregusuario['usuacodi']; ?></td>
 <td><B>Nombre:</B>&nbsp;<?= $sbregusuario['usuanomb']; ?></td>
</tr><tr>
 <td bgcolor="#E8F0F6" colspan="2"><B>Equipo</B></td>
</tr>
<tr bgcolor="#F8FAFB">
 <td><B>C&oacute;digo:</B>&nbsp;<?= $equipocodigo; ?></td>
 <td><B>Nombre:</B>&nbsp;<?= $equiponombre; ?></td>
</tr>
<tr>
 <td bgcolor="#E8F0F6" colspan="2"><B>Descripci&oacute;n</B></td>
</tr>
<tr bgcolor="#F8FAFB">
 <td colspan="2"><B>Tipo de falla:</B>&nbsp;<?= $sbregtipofall[tipfalnombre]; ?></td>
</tr>
<tr bgcolor="#F8FAFB">
 <td colspan="2"><B>Motivo:</B><BR /><?= $sbreg[solsermotivo]; ?></td>
</tr>
</table>
</CENTER>
<?php $_SESSION['htmlreport'] = ob_get_contents(); ?>
</SPAN>
<!-- End of hidden SPAN -->