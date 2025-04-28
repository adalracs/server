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
	include ( '../src/FunPerPriNiv/pktblotestado.php');
?> 
<html> 
	<head> 
		<title>Consultar en Documentos Mediciones predictivas</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0"> 

		<?php include('../def/jquery.library_maestro.php');?>
		<script type="text/javascript">
			$(function(){
				//Botones Visor Tecnicos
				/**
				 * Boton Tecnico Mantenedor
				 */
				$('#enctecnico').button({ icons: { primary: "ui-icon-person" } }).click(function() {
					window.open('maestablusuarioot.php?codigo=<?php echo $codigo?>&negocicodigo=<?php echo $negocicodigo ?>','usuarios','status=no,menubar=no,scrollbars=yes,resizable=yes,left=300,width=800,height=600');
					return false;
				});

				// Obj Fechas

				$("#reportfecha").datepicker({changeMonth: true,changeYear: true});
				$("#reportfecha").datepicker('option', {dateFormat: 'yy-mm-dd'});
				$("#reportfecha").datepicker($.datepicker.regional['es']);
				<?php if($reportfecha): ?>$("#reportfecha").datepicker("setDate", '<?php echo $reportfecha; ?>');<?php endif ?>
			});
		</script>
		<script language=JavaScript src="../src/FunGen/jsrsClient.js" type="text/javascript" ></script>
		<script language=JavaScript src="../src/FunGen/cargarSistema.js" type="text/javascript" ></script>
		<script language=JavaScript src="../src/FunGen/cargarEquipos.js" type="text/javascript" ></script>
		<script language=JavaScript src="../src/FunGen/cargarComponen.js" type="text/javascript" ></script>
	</head> 
<?php if(!$codigo){ echo "<!--";} ?> 
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Orden de trabajo</font></p>
			<table border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content" width="650">
  				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr>
  				<tr><td class="ui-widget-header"><span class="style5"><font color="FFFFFF">Consultar usuario</font></span></td></tr>
  				<tr>
					<td>
       					<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
       						<tr>
          						<td width="20%" class="NoiseFooterTD">&nbsp;Numero de OT</td>
          						<td width="80%" class="NoiseDataTD"><input type="text" name="ordtracodigo" id="ordtracodigo" value="<?php echo $ordtracodigo ?>"></td>
          					</tr>
       						<tr>
          						<td class="NoiseFooterTD">&nbsp;Fecha de reporte</td>
          						<td class="NoiseDataTD"><input type="text" name="reportfecha" id="reportfecha" size="8"></td>
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
            					<td class="NoiseFooterTD">&nbsp;Equipo</td>
            					<td class="NoiseDataTD">
            						<select name="equipocodigo" id="equipocodigo" onChange="cargarComponen(this.value);">
									<option value = "">-- Seleccione --</option>
            						<?php
										include ('../src/FunGen/floadequipoot.php');
										floadequipoot($equipocodigo, $sistemcodigo,$idcon);
		    						?>
									</select>
		  						</td>
		  					</tr>
		  					<!--<tr>
		  						<td class="NoiseFooterTD">&nbsp;Componente</td>
		  						<td class="NoiseDataTD"><select name="componcodigo" id="componcodigo" >
									<option value = "">-- Seleccione --</option>
            						<?php
//										include ('../src/FunGen/floadcomponenequi.php');
//										floadcomponenequi($componcodigo,$equipocodigo,$idcon);
									?>
          						</select></td>
							</tr>-->
						</table>
					</td>
				</tr>
				<!-- <tr>
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
				</tr> -->
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
				<!-- <tr>
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
										floadtipotrab($tiptracodigo,$idcon);
									?>
          						</select></td>
		  					</tr>
						</table>
					</td>
				</tr>-->
				<tr><td>&nbsp;</td></tr>
				<tr>
					<td class="NoiseErrorDataTD" align="center"><?php include '../def/jquery.button_form.php'; ?></td>
				</tr>
				<tr><td>&nbsp;</td></tr> 
				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr>
  			</table>
  			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>">
			<input type="hidden" name="sourceaction" value="consultar">   			
			<input type="hidden" name="flagconsultarmedipredic" value="1"> 
			<input type="hidden" name="accionconsultarmedipredic"> 
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
			<input type="hidden" name="columnas" value="ordtracodigo,reportfecha,plantacodigo,sistemcodigo,equipocodigo,usuacodigo"> 
			<input type="hidden" name="nombtabl" value="medipredic"> 
		</form> 
	</body> 
<?php if(!$codigo){ echo " -->"; } ?> 
</html> 
