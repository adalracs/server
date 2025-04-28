<?php 
	include ( '../src/FunGen/sesion/fncvalses.php');
	include ( '../src/FunPerPriNiv/pktblplanta.php');
	include ( '../src/FunPerPriNiv/pktblsistema.php');
	include ( '../src/FunPerPriNiv/pktblequipo.php');
	include ( '../src/FunPerPriNiv/pktblcomponen.php');
	include ( '../src/FunPerPriNiv/pktblitem.php');
	include ( '../src/FunPerPriNiv/pktbloperacio.php');
	include ( '../src/FunPerPriNiv/pktbltipomant.php');
	include ( '../src/FunPerPriNiv/pktbltipofall.php');
	include ( '../src/FunPerPriNiv/pktblpriorida.php');
	include ( '../src/FunPerPriNiv/pktbltarea.php');
	include ( '../src/FunPerPriNiv/pktblherramie.php');
	include ( '../src/FunPerPriNiv/pktbltransacherramie.php');
	include ( '../src/FunPerPriNiv/pktbltipotrab.php');
	include ( '../src/FunPerPriNiv/pktblusuario.php');
?>
<html> 
	<head> 
		<title>Consultar registro en ordenes de trabajo</title> 
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

				<?php if($ordtrafecgen): ?>$("#ordtrafecgen").datepicker("setDate", '<?php echo $ordtrafecgen; ?>');<?php endif ?>
				<?php if($ordtrafecini): ?>$("#ordtrafecini").datepicker("setDate", '<?php echo $ordtrafecini; ?>');<?php endif; ?>
				<?php if($ordtrafecfin): ?>$("#ordtrafecfin").datepicker("setDate", '<?php echo $ordtrafecfin; ?>');<?php endif ?>
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
	<body bgcolor="#FFFFFF" class="NoisePageBODY">
		<form name="form1" method="post"  enctype="multipart/form-data">
			<p><font class="NoiseFormHeaderFont">Orden de trabajo</font></p> 
			<table border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content" width="800">
  				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr>
  				<tr><td class="ui-widget-header"><span class="style5"><font color="FFFFFF">Consultar registro</font></span></td></tr>
  				<tr>
					<td>
       					<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
       						<tr>
          						<td width="20%" class="NoiseFooterTD">&nbsp;Numero de OT</td>
          						<td width="80%" class="NoiseDataTD"><input type="text" name="ordtracodigo" id="ordtracodigo" value="<?php echo $ordtracodigo ?>"></td>
          					</tr>
       						<tr>
          						<td class="NoiseFooterTD">&nbsp;Fecha de generaci&oacute;n</td>
          						<td class="NoiseDataTD"><input type="text" name="ordtrafecgen" id="ordtrafecgen" size="8"></td>
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
	            						<select name="equipocodigo" id="equipocodigo" onChange="cargarComponen(this.value);">
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
	            								cargarComponen(ui.item.id);
	            							}
	            						});
            						</script>
		  						</td>
		  					</tr>
		  					<!-- <tr>
		  						<td class="NoiseFooterTD">&nbsp;Componente</td>
		  						<td class="NoiseDataTD"><select name="componcodigo" id="componcodigo" >
									<option value = "">-- Seleccione --</option>
            						<?php
										include ('../src/FunGen/floadcomponenequi.php');
										floadcomponenequi($componcodigo,$equipocodigo,$idcon);
									?>
          						</select></td>
							</tr> -->
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
							<tr>
								<td class="NoiseFooterTD" width="20%"><?php if($campnomb["ordtrafecini"] == 1){$ordtrafecini = null; echo "*";}?>&nbsp;Fecha de inicio</td>
								<td class="NoiseDataTD" width="30%"><input type="text" name="ordtrafecini" id="ordtrafecini" size="8"></td>
								<td class="NoiseFooterTD" width="24%"><?php if($campnomb["ordtrafecfin"] == 1){ $ordtrafecfin = null; echo "*";} ?>&nbsp;Fecha estimada a finalizar</td>
								<td class="NoiseDataTD" width="26%"><input type="text" name="ordtrafecfin" id="ordtrafecfin" size="8"></td>
        					</tr>
        				</table>
					</td>
				</tr>
				<tr>
					<td>
						<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
							<tr> 
								<td width="20%" class="NoiseFooterTD"><div class="ui-buttonset"><button id="enctecnico">Encargado</button></div></td>
								<td width="80%" class="NoiseDataTD"><input name="usuacodigo" id="usuacodigo" type="text" value="<?php echo $usuacodigo; ?>" size="8"><input name="usuanombre" id="usuanombre" type="text" value="<?php echo $usuanombre; ?>" size="50"></td>
							</tr>
        				</table>
					</td>
				</tr>
				<tr>
					<td>
						<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
							<tr>								
								<td width="20%" class="NoiseFooterTD">&nbsp;Mantenimiento</td>
								<td width="30%" class="NoiseDataTD"><select name="tipmancodigo">
									<option value="">-- Seleccione --</option>
									<?php
										include ('../src/FunGen/floadtipomant.php');
										floadtipomant($tipmancodigo,$idcon);
									?>
									</select>
								</td>
								<td width="20%" class="NoiseFooterTD">&nbsp;Prioridad</td>
								<td width="30%" class="NoiseDataTD"><select name="prioricodigo">
									<option value="">-- Seleccione --</option>
									<?php
			  							include ('../src/FunGen/floadpriorida.php');
										floadpriorida($prioricodigo, $idcon);
									?>
								</select></td>
							</tr>
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
								<td class="NoiseFooterTD">&nbsp;Tarea</td>
								<td colspan="3" class="NoiseDataTD"><select name="tareacodigo" onChange="cargarDescripciontarea(this.value);">
									<option value="">-- Seleccione --</option>
									<?php
										include ('../src/FunGen/floadtarea.php');
										floadtarea($tareacodigo,$idcon);
									?>
          						</select></td>
          					</tr>
          					<tr>
          						<td class="NoiseFooterTD">&nbsp;Tipo de trabajo</td>
								<td colspan="3" class="NoiseDataTD"><select name="tiptracodigo">
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
				<tr><td>&nbsp;</td></tr>
				<tr>
					<td class="NoiseErrorDataTD" align="center"><?php include '../def/jquery.button_form.php'; ?></td>
				</tr>
				<tr><td>&nbsp;</td></tr> 
				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr>
  			</table>
  			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>">
			<input type="hidden" name="sourceaction" value="consultar"> 			
	 		<input type="hidden" name="flagconsultarot" value="1"> 
			<input type="hidden" name="accionconsultarot"> 
			<input type="hidden" id="codigo" name="codigo" value="<?php echo $codigo; ?>"> 
			<input type="hidden" id="negocicodigo" name="negocicodigo" value="<?php echo $negocicodigo; ?>"> 
			<input type="hidden" name="columnas" value="ordtracodigo,
ordtrafecgen,
plantacodigo,
sistemcodigo,
equipocodigo,
componcodigo,
tipmancodigo,
ordtranota,
ordtrafecini,
ordtrahorini,
ordtrafecfin,
ordtrahorfin,
usuacodi,
tiptracodigo,
tareacodigo,
prioricodigo,
tipfallcodigo"> 
			<input type="hidden" name="nombtabl" value="ot"> 
			<input type="hidden" name="usutarcodigo" value="<?php echo $usutarcodigo; ?>"> 
		</form> 
	</body> 
<?php if(!$codigo){ echo " -->"; } ?> 
</html>