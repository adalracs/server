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
		<td class="NoiseFooterTD">
			<select name="paditecodigo" id="paditecodigo"> 
				<option value="">--Seleccione--</option>-->
				<?php 
					include("../src/FunGen/floadplaneapadreitem.php");
					floadplaneapadreitem($produccodigo, $paditecodigo, $idcon);
				?>
			</select>
			<div class="ui-buttonset-fe">
				<button id="ingresarmat">Agregar material</button>
				<button id="quitarmat">Quitar material</button>
			</div>
		</td>
	</tr>
	<tr>
		<td class="NoiseDataTD">
			<div id="listadoplaneacionopp">
				<?php

					$noAjax = true;
					include '../src/FunjQuery/jquery.visors/jquery.gestionplaneacionopp.php';
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