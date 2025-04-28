<?php 

	if($tipsolcodigo != 1){
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" class="ui-widget-content">
	<tr class="ui-state-default">
		<td class="cont-title">&nbsp;
			<?php if($campnomb["arrplaneacionopp"] == 1){ $arrplaneacionopp = null;echo "*";}?>Asignacion de Material
		</td>
	</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" class="ui-widget-content">
	<tr>
		<td class="NoiseDataTD">
			<div id="listadoplaneacionopp">
				<?php
					$flagdetallar = 1;
					$noAjax = true;
					include '../src/FunjQuery/jquery.visors/jquery.gestionplaneacionopp.php';
					unset($flagdetallar);
				?>
			</div>
			<input type="hidden" name="arrplaneacionopp" id="arrplaneacionopp" value="<?php echo $arrplaneacionopp; ?>" />
			<input type="hidden" name="arrplaneacionopptmp" id="arrplaneacionopptmp" value="<?php echo $arrplaneacionopptmp; ?>" />
		</td>
	</tr>
</table>
<?php 

	}
?>