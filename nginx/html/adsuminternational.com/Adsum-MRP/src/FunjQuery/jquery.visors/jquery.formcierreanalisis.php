<?php 
include '../../FunPerSecNiv/fncnumreg.php';
include '../../FunPerSecNiv/fncfetch.php';
include '../../FunPerSecNiv/fncconn.php';
include '../../FunPerSecNiv/fncclose.php';
include '../../FunPerPriNiv/pktbltipocump.php';
?>
<table width="100%" border="0" cellspacing="1" cellpadding="0" align="left" class="ui-widget-content">
    <tr>
    	<td colspan="2" class="NoiseFooterTD"><div id="erredit" style="display:none;"><div class="ui-widget">
			<div class="ui-state-error ui-corner-all" style="padding: 0 .7em;"> 
				<p><span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span> 
				<strong>Advertencia:</strong> Especifique descripcion del cumplimiento.</p>
			</div>
		</div></div></td>
	</tr>
   	<tr><td colspan="2" class="NoiseFooterTD">&nbsp;Descripci&oacute;n</td></tr>
	<tr><td colspan="2" rowspan="2" class="NoiseDataTD"><input type="hidden" name="idcodigo" id="idcodigo" value="<?php echo $id ?>"><textarea name="cierredescri" id="cierredescri" rows="4" cols="56">Gestion de cierre [Ok]</textarea></td></tr>
</table>
<input type="hidden" name="idcierre" id="idcierre" value="<?php echo $idcierre; ?>" />