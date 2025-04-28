<?php 

ob_start(); 
	include ( '../src/FunGen/sesion/fncvalses.php');  
	include ( '../src/FunPerSecNiv//fncsqlrun.php');  
	include ( '../src/FunPerPriNiv/pktblestadosaldo.php');  
	include ( '../src/FunPerPriNiv/pktbltipoestadosaldo.php');  
	if($accionnuevosaldo)
		include ( 'grabasaldo.php');
	
ob_end_flush(); 
$idcon = fncconn();
?>
<html> 
	<head> 
		<title>Nuevo registro saldos de laminas</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0"> 
		<?php include('../def/jquery.library_maestro.php');?>
		<script type="text/javascript">
				
				$(function(){
					$("#material").autocomplete({
						source: "../src/FunjQuery/jquery.phpcombobox/produccion/jquery.atcitemdesa.php",
						minLength: 0,
						select: function(event, ui) {
							if(ui.item){
								document.getElementById('itedescodigo').value = ui.item.id;
								document.getElementById('densidad').value = ui.item.densidad;
								document.getElementById('calibre').value = ui.item.calibre;
								document.getElementById('ancho').value = ui.item.ancho;
								reloadLote( ui.item.id );
							}else{
								document.getElementById('itedescodigo').value = "";
								document.getElementById('densidad').value = "";
								document.getElementById('calibre').value = "";
								document.getElementById('ancho').value = "";
							}
						}
					});

				});

				function reloadLote( itedescodigo )
				{

					$.getJSON("../src/FunjQuery/jquery.phpcombobox/jquery.cascadebox.lote.php",  { itedescodigo: itedescodigo }, 
						function(data) {
						var xpos = 0;
		
						document.getElementById("lotecodigo").length = 1;
						document.getElementById("lotecodigo").options[xpos] = new Option(" -- Seleccione --", "", true, true);	
						document.getElementById("lotecodigo").options[xpos] = new Option("Prueba - Prueba", 1, true, true);	
		
						$.each(data, function(key, val) {
							xpos++;
							document.getElementById("lotecodigo").options[xpos] = new Option(val.label, val.id, false, false);
						});

					});

				}

				function kilostometros(){
					//objetos a usar
					var obj_saldocantkgs = document.getElementById("saldocantkgs");
					var obj_saldocantmts = document.getElementById("saldocantmts");
					var obj_densidad = document.getElementById("densidad");
					var obj_calibre = document.getElementById("calibre");
					var obj_ancho = document.getElementById("ancho");
					//valor de los objetos
					var var_kilos = (obj_saldocantkgs)? obj_saldocantkgs.value : "" ;
					var var_densidad = (obj_densidad)? obj_densidad.value : "" ;
					var var_calibre = (obj_calibre)? obj_calibre.value : "" ;
					var var_ancho = (obj_ancho)? obj_ancho.value : "" ;
					var var_metros = 0;
					//validacion variables
					var kilos = (/^([0-9\,.])*$/.test(var_kilos))? var_kilos : 0 ; 
					var densidad = (/^([0-9\,.])*$/.test(var_densidad))? var_densidad : 0 ; 
					var calibre = (/^([0-9\,.])*$/.test(var_calibre))? var_calibre : 0 ; 
					var ancho = (/^([0-9\,.])*$/.test(var_ancho))? var_ancho : 0 ; 
					//formulacion
					metros = ( kilos / (ancho * (calibre * densidad) ) ) * 1000000; 
					//asignacion de valores
					if(obj_saldocantmts && /^([0-9\,.])*$/.test(metros) ){
						metros=Math.floor(metros*100);
						metros=metros/100;
						obj_saldocantmts.value = metros;
					}
				}

		</script>
	</head> 
<?php if(!$codigo){ echo "<!--";} ?>
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Saldos de laminas</font></p> 
			<table border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content" width="450">
<?php if($campnomb): ?>
				<tr><td><div class="ui-widget">
					<div class="ui-state-error ui-corner-all" style="padding: 0 .7em;"> 
						<p><span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span> 
						<!--<strong>Advertencia:</strong> Corrija los campos marcados con * <br><?php //echo $campnomb[err] ?></p>-->
						<strong>Advertencia:</strong> <?php if($campnomb['err']): echo $campnomb['err']; else: ?> Corrija los campos marcados con *<?php endif; ?></p>
					</div>
				</div></td></tr>
<?php else: ?> 		
				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr>	
<?php endif; ?> 
  				<tr><td class="ui-widget-header"><span class="style5"><font color="FFFFFF"> Ingresar nuevo registro</font></span></td></tr> 
				<tr> 
  					<td> 
            			<table width="95%" border="0" cellspacing="1" cellpadding="0" align="center"> 
 							<tr>
								<td width="25%" class="NoiseFooterTD"><?php if($campnomb["itedescodigo"] == 1){echo "*";}?>&nbsp;Codigo&nbsp;</td>
								<td width="75%" class="NoiseDataTD">
									<input type="text" name="material" id="material" size="60" onkeypress="return event.keyCode!=13" value="<?php echo $material; ?>" />
									<input type="hidden" name="densidad" id="densidad" size="60" onkeypress="return event.keyCode!=13" value="<?php echo $densidad; ?>" />
									<input type="hidden" name="calibre" id="calibre" size="60" onkeypress="return event.keyCode!=13" value="<?php echo $calibre; ?>" />
									<input type="hidden" name="ancho" id="ancho" size="60" onkeypress="return event.keyCode!=13" value="<?php echo $ancho; ?>" />
		  							<input type="hidden" name="itedescodigo" id="itedescodigo" value="<?php echo $itedescodigo ?>">
								</td>
 							</tr>
 							<tr>
								<td width="25%" class="NoiseFooterTD"><?php if($campnomb["estsalcodigo"] == 1){ $estsalcodigo = null; echo "*";}?>&nbsp;Estado&nbsp;</td>
								<td width="75%" class="NoiseDataTD">
									<select name="estsalcodigo" id="estsalcodigo">
										<option value="">--Seleccione--</option>
										<?php
											include('../src/FunGen/floadestadosaldo.php');
											floadestadosaldo1($estsalcodigo,1,$idcon);//1 tipo estado saldo disponible
										?>
									</select>
								</td>
 							</tr>
 							<tr>
								<td width="25%" class="NoiseFooterTD"><?php if($campnomb["saldoubicaci"] == 1){ $saldoubicaci = null; echo "*";}?>&nbsp;Ubicacion&nbsp;</td>
								<td width="75%" class="NoiseDataTD"><input type="text" name="saldoubicaci" size="30"	value="<?php echo $saldoubicaci; ?>"></td>
 							</tr>
 							<tr>
								<td width="25%" class="NoiseFooterTD"><?php if($campnomb["saldoposicio"] == 1){ $saldoposicio = null; echo "*";}?>&nbsp;Posicion&nbsp;</td>
								<td width="75%" class="NoiseDataTD"><input type="text" name="saldoposicio" size="30"	value="<?php echo $saldoposicio; ?>"></td>
 							</tr>
 							<tr>
								<td width="25%" class="NoiseFooterTD"><?php if($campnomb["saldoformula"] == 1){ $saldoformula = null; echo "*";}?>&nbsp;Formula&nbsp;</td>
								<td width="75%" class="NoiseDataTD"><input type="text" name="saldoformula" size="7"	value="<?php echo $saldoformula; ?>"></td>
 							</tr>
 							<tr>
								<td width="25%" class="NoiseFooterTD"><?php if($campnomb["saldocantkgs"] == 1){ $saldocantkgs = null; echo "*";}?>&nbsp;Kilogramos&nbsp;<b>(kg)</b>&nbsp;</td>
								<td width="75%" class="NoiseDataTD"><input type="text" name="saldocantkgs" id="saldocantkgs" size="15"	value="<?php echo $saldocantkgs; ?>" onkeyup="kilostometros();" ></td>
 							</tr>
 							<tr>
								<td width="25%" class="NoiseFooterTD"><?php if($campnomb["saldocantmts"] == 1){ $saldocantmts = null; echo "*";}?>&nbsp;Metros&nbsp;<b>(mts)</b>&nbsp;</td>
								<td width="75%" class="NoiseDataTD"><input type="text" name="saldocantmts" id="saldocantmts" size="15"	value="<?php echo $saldocantmts; ?>" ></td>
 							</tr>
 							<tr>
								<td width="25%" class="NoiseFooterTD"><?php if($campnomb["lotecodigo"] == 1){ $lotecodigo = null; echo "*";}?>&nbsp;No. Lote&nbsp;</td>
								<td width="75%" class="NoiseDataTD">
									<select name="lotecodigo" id="lotecodigo">
									<option value="">--Seleccione</option>
									<option value="1">Prueba - Prueba</option>
										<?php
											include("../src/FunGen/floadlotesaldo.php");
											floadlotesaldo($lotecodigo,$itedescodigo,$idcon);
										?>
									</select>
								</td>
 							</tr>
 							<tr>
 								<td width="10%" class="NoiseFooterTD"></td>
 							</tr>
 							<tr><td colspan="2" class="NoiseErrorDataTD"></td></tr>
							<tr><td colspan="2" class="NoiseFooterTD"><?php if($campnomb["saldodescri"]	 == 1){$saldodescri = null; echo "*";}?>&nbsp;Nota</td></tr>
							<tr><td colspan="2" rowspan="2" class="NoiseDataTD"><textarea name="saldodescri" rows="3" cols="63"><?php echo $saldodescri; ?></textarea></td></tr>
						</table>
  					</td> 
 				</tr> 
				<tr><td>&nbsp;</td></tr>
				<tr><td class="NoiseErrorDataTD" align="center"><?php include '../def/jquery.button_form.php'; ?></td></tr>
				<tr><td>&nbsp;</td></tr>
				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr>
			</table> 
			<input type="hidden" name="accionnuevosaldo">  
			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>">
			<input type="hidden" name="sourceaction" value="nuevo">						
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
		</form> 	
	</body> 
<?php if(!$codigo){ echo " -->"; } ?> 
</html>