<?php 
	include ( '../src/FunGen/sesion/fncvalses.php');
	include('../src/FunPerPriNiv/pktblusuario.php');
	include ( '../src/FunPerPriNiv/pktblplanta.php');
	include ( '../src/FunPerPriNiv/pktblsistema.php');
	include ( '../src/FunPerPriNiv/pktblequipo.php');
	include('../src/FunPerPriNiv/pktbltipofall.php');
	include('../src/FunPerPriNiv/pktbltipotrab.php');
	include('../src/FunPerPriNiv/pktblsoliservestado.php');
?> 
<html> 
	<head> 
		<title>Consultar en soliserv</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0">
		<?php include('../def/jquery.library_maestro.php');?>
		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.function_ot.js"></script>
		<script type="text/javascript">
			$(function(){
				//Botones Visor Tecnicos
				/**
				 * Boton Tecnico Mantenedor
				 */
				$('#enctecnico').button({ icons: { primary: "ui-icon-person" } }).click(function() {
					window.open('consultarusuarioot.php?codigo=' + document.getElementById('codigo').value + '&negocicodigo='  + document.getElementById('negocicodigo').value,'usuarios','status=no,menubar=no,scrollbars=yes,resizable=yes,left=300,width=800,height=600');
					return false;
				});

				// Obj Fechas
				$("#solserfecha").datepicker({changeMonth: true,changeYear: true});
				$("#solserfecha").datepicker('option', {dateFormat: 'yy-mm-dd'});
				$("#solserfecha").datepicker($.datepicker.regional['es']);
				<?php if($solserfecha): ?>$("#solserfecha").datepicker("setDate", '<?php echo $solserfecha; ?>');<?php endif ?>
			});
		</script>
		<script language=JavaScript src="../src/FunGen/jsrsClient.js" type="text/javascript" ></script>
		<script language=JavaScript src="../src/FunGen/cargarSistema.js" type="text/javascript" ></script>
		<script language=JavaScript src="../src/FunGen/cargarEquipos.js" type="text/javascript" ></script>
		<script language=JavaScript src="../src/FunGen/cargarComponen.js" type="text/javascript" ></script>
		<style type="text/css">
			select, #equiponombre {font-size: 12px;}
		</style> 
	</head> 
<?php if(!$codigo){ echo "<!--";} ?> 
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Solicitud de servicio</font></p> 
			<table border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content" width="800">
  				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr>
  				<tr><td class="ui-widget-header"><span class="style5"><font color="FFFFFF">Consultar registro</font></span></td></tr>
  				<tr>
					<td>
       					<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
       						<tr>
          						<td width="20%" class="NoiseFooterTD">&nbsp;Numero de solicitud</td>
          						<td width="80%" class="NoiseDataTD"><input type="text" name="solsercodigo" id="solsercodigo" value="<?php echo $solsercodigo ?>"></td>
          					</tr>
       						<tr>
          						<td class="NoiseFooterTD">&nbsp;Fecha de generaci&oacute;n</td>
          						<td class="NoiseDataTD"><input type="text" name="solserfecha" id="solserfecha" size="8"></td>
          					</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
							<tr>
          						<td width="20%" class="NoiseFooterTD">&nbsp;Ubicaci&oacute;n</td>
          						<td width="80%" class="NoiseDataTD"><select name="plantacodigo" id="plantacodigo" onChange="cargarSistemas(this.value);">
          							<option value = "">-- Seleccione --</option>
									<?php
										include ('../src/FunGen/floadplanta.php');
										$idcon = fncconn();
										floadplanta($plantacodigo,$idcon);
									?>
            					</select></td>
          					</tr>
							<tr>          						
          						<td class="NoiseFooterTD">&nbsp;Proceso</td>
            					<td class="NoiseDataTD"><select name="sistemcodigo" id="sistemcodigo" onChange="cargarEquipos(this.value);">
									<option value = "">-- Seleccione --</option>
									<?php
										include ('../src/FunGen/floadsistemaot.php');
										floadsistemaot($sistemcodigo,$plantacodigo,$idcon);
            						?>
            					</select></td>
							</tr>
							<tr>
            					<td class="NoiseFooterTD">&nbsp;Equipo&nbsp;<img onclick = "viewFilter();" src="../img/icon_filter.png" border=0></td>
            					<td class="NoiseDataTD">
            						<div id="selectlist" style="display: <?php if(!$filterindex): ?>block;<?php else: ?>none;<?php endif; ?>">
	            						<select name="equipocodigo" id="equipocodigo">
										<option value = "">-- Seleccione --</option>
	            						<?php
											include ('../src/FunGen/floadequipoot.php');
											floadequipoot($equipocodigo, $sistemcodigo,$idcon);
			    						?>
										</select>
									</div>
            						<div id="filtrolist" style="display: <?php if($filterindex): ?>block;<?php else: ?>none;<?php endif; ?>">
            							<input type="text" size="112" name="equiponombre" id="equiponombre" value="<?php echo $equiponombre ?>">
            							<input type="hidden" name="equipocodigocmbx" id="equipocodigocmbx" value="<?php echo $equipocodigocmbx ?>">
            							<input type="hidden" name="idusua" id="idusua" value="<?php echo $usuacodi ?>">
            							<input type="hidden" name="filterindex" id="filterindex" value="<?php echo $filterindex ?>">
            						</div>
									<script type="text/javascript">
	            						$("#equiponombre").autocomplete({
	            							source: "../src/FunjQuery/jquery.phpcombobox/jquery.cmbx_equipo.php?id=" + document.getElementById('idusua').value + "&plantacodigo=" + document.getElementById('plantacodigo').value + "&sistemcodigo="  + document.getElementById('sistemcodigo').value,
	            							minLength: 1,
	            							select: function(event, ui) {
	            								ui.item ? document.getElementById('equipocodigocmbx').value = ui.item.id : document.getElementById('equipocodigocmbx').value = "";
	            							}
	            						});
            						</script>
		  						</td>
		  					</tr>
		  				</table>
					</td>
				</tr>
				<tr>
					<td>
						<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
							<tr> 
								<td width="20%" class="NoiseFooterTD"><div class="ui-buttonset"><button id="enctecnico">Solicitante</button></div></td>
								<td width="80%" class="NoiseDataTD"><input name="usuacodigo" id="usuacodigo" type="text" value="<?php echo $usuacodigo; ?>" size="8"><input name="usuanombre" id="usuanombre" type="text" value="<?php echo $usuanombre; ?>" size="50"></td>
							</tr>
        				</table>
					</td>
				</tr>
				<tr>
					<td>
						<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
							<tr>
								<td width="15%" class="NoiseFooterTD">&nbsp;Tipo trabajo</td>
								<td width="85%" class="NoiseDataTD"><select name="tiptracodigo">
									<option value="">-- Seleccione --</option>
									<?php
										include ('../src/FunGen/floadtipotrab.php');
										floadtipotrab($tiptracodigo,$idcon, $usuatipotrab);
									?>
								</select></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
							<tr>
								<td class="NoiseFooterTD">&nbsp;Falla</td>
								<td colspan="3" class="NoiseDataTD"><select name="tipfalcodigo">
									<option value="">-- Seleccione --</option>
									<?php
										include ('../src/FunGen/floadtipofall.php');
										floadtipofall($tipfalcodigo,$idcon);
									?>
								</select></td>
							</tr>
							<tr>
								<td class="NoiseFooterTD">&nbsp;Estado</td>
								<td colspan="3" class="NoiseDataTD"><select name="estsolcodigo">
									<option value="">-- Seleccione --</option>
									<?php
										include ('../src/FunGen/floadsoliservestado.php');
										floadsoliservestado($idcon, $estsolcodigo);
									?>
          						</select></td>
          					</tr>
						</table>
					</td>
				</tr>
				<tr><td>&nbsp;</td></tr>
				<tr>
					<td class="NoiseErrorDataTD" align="center"><?php include '../def/jquery.button_form.php'; ?></td>
				</tr>
				<tr><td>&nbsp;</td></tr> 
				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr>
  			</table>
  			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>">
			<input type="hidden" name="sourceaction" value="consultar"> 
			<input type="hidden" name="flagconsultarsoliserv" value="1"> 
			<input type="hidden" name="accionconsultarsoliserv"> 
			<input type="hidden" id="codigo" name="codigo" value="<?php echo $codigo; ?>">
			<input type="hidden" id="negocicodigo" name="negocicodigo" value="<?php echo $negocicodigo; ?>">
			<input type="hidden" name="columnas" value="solsercodigo,usuacodigo,plantacodigo,sistemcodigo,equipocodigo,tipfalcodigo,estsolcodigo,solsermotivo,solserfecha,tiptracodigo"> 
			<input type="hidden" name="nombtabl" value="soliserv"> 
		</form> 
	</body> 
<?php if(!$codigo){ echo " -->"; } ?> 
</html>