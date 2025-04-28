<?php
ob_start();
	include ( '../src/FunGen/sesion/fncvalses.php');
	//--
	include ( '../src/FunPerPriNiv/pktblusuario.php');
	include ( '../src/FunPerPriNiv/pktblot.php');
	include ( '../src/FunPerPriNiv/pktblplanta.php');
	include ( '../src/FunPerPriNiv/pktblequipo.php');
	include ( '../src/FunPerPriNiv/pktblsistema.php');
	include ( '../src/FunPerPriNiv/pktblcomponen.php');
	include ( '../src/FunPerPriNiv/pktbltipomant.php');
	include ( '../src/FunPerPriNiv/pktblotestado.php');
	include ( '../src/FunPerPriNiv/pktblpriorida.php');
	include ( '../src/FunPerPriNiv/pktbltipotrab.php');
	include ( '../src/FunPerPriNiv/pktbltipocump.php');
	include ( '../src/FunPerPriNiv/pktbltarea.php');
	include ( '../src/FunGen/cargainput.php');
	include ( '../src/FunGen/floadtimehours.php');
	include ( '../src/FunGen/floadtimeminut.php');
	//--
	if($accionnuevoreportcierreot)
		$reloadot ? include ( 'grabareportcierreot.php') : '';

ob_end_flush(); 

	if($ordtracodigo)
	{
		include_once '../src/FunPerPriNiv/pktblreportot.php';
		
		$idcon = fncconn();
		$irecOrden["ordtracodigo"] = $ordtracodigo;
		
		$sbregReportot = dinamicscanreportot($irecOrden,$idcon);
		
		if($sbregReportot > 0)
			$err = 'La Orden de Trabajo se encuentra Reportada';
		else
		{ 
			$sbregot = loadrecordot($ordtracodigo,$idcon);
			
			if($sbregot < 0)
				$err = 'No se encontro la orden de trabajo';
			else
			{
				$ordtraparada1 = $sbregot['ordtraparada'];
				$reloadot = 1;
				
				include_once( '../src/FunPerPriNiv/pktbltareot.php');
				$sbregtareot =loadrecordmaxtareot2($sbregot[ordtracodigo],$idcon);
				
				if(!$flagnuevoreportot)
				{
					$tiptracodigo = $sbregtareot[tiptracodigo];
					$prioricodigo = $sbregtareot[prioricodigo];
					$tareacodigo = $sbregtareot[tareacodigo];
					$tipmancodigo = $sbregot[tipmancodigo];
				}
				
				if($sbregtareot > 0)
				{
					$iRecordusertareot[tareotcodigo] = $sbregtareot[tareotcodigo]; 
					include_once ( '../src/FunPerPriNiv/pktblusuariotareot.php');
					$nuResult = dinamicscanusuariotareot($iRecordusertareot,$idcon);
					
					if($nuResult > 0){
						$nuCantRow = pg_numrows($nuResult);
						$j = 0;
						if ($nuCantRow > 0){
							for($i = 0; $i < $nuCantRow; $i++){						
								$sbRow = pg_fetch_row ($nuResult,$i);
								
								$user_ot = loadrecordusuario($sbRow[1], $idcon);
								$usrname1 = $sbRow[1]." - " .$user_ot["usuanombre"]." ".$user_ot["usuapriape"]." ".$user_ot["usuasegape"];
								if($sbRow[3] == 't'){
									$user_encargado = $usrname1;
								}else{
									$user_aux[$j] = $usrname1;
									$j++; 
								}
							}
						}
					}
				}
			}
		}
	}
?> 
<html>
	<head>
		<title>Nuevo registro de reporte/cierre de orden de trabajo</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0"> 
		<script language="JavaScript" src="../src/FunGen/cargarEmpleaselec.js" type="text/javascript" ></script>
		<script language="JavaScript" src="../src/FunGen/jsrsClient.js" type="text/javascript" ></script>
		<script language=JavaScript src="../src/FunGen/ajxGenListas.js" type="text/javascript" ></script>		
		
		<?php include('../def/jquery.library_maestro.php');?>	
		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.function_comun.js"></script>
		<script type="text/javascript">
			$(function(){
				$('#reloadform').button({ icons: { primary: "ui-icon-refresh" }, text: false }).click(function() {
					document.form1.submit();
					return false;
				});
			});
		</script>
		<script type="text/javascript">
			$(function(){

				$("#reportfecha").datepicker({changeMonth: true,changeYear: true});
				$("#reportfecha").datepicker('option', {dateFormat: 'yy-mm-dd'});
				$("#reportfecha").datepicker($.datepicker.regional['es']);
				<?php if(!$reportfecha) $reportfecha = date("Y-m-d"); ?>$("#reportfecha").datepicker("setDate", '<?php echo $reportfecha; ?>');
				
				$("#parprofecfin").datepicker({changeMonth: true,changeYear: true});
				$("#parprofecfin").datepicker('option', {dateFormat: 'yy-mm-dd'});
				$("#parprofecfin").datepicker($.datepicker.regional['es']);
				<?php if($parprofecfin) $parprofecfin = date("Y-m-d"); ?>$("#parprofecfin").datepicker("setDate", '<?php echo $parprofecfin; ?>');
			});
		</script>
		<style type="text/css">
			#reloadform.ui-button-icon-only .ui-button-text, #reloadform.ui-button-icons-only .ui-button-text  {
    			padding: 1px;
			}
		
		</style>
	</head> 
<?php if(!$codigo) { echo "<!--";} ?> 
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Reporte/Cierre de ordenes de trabajo</font></p> 
			<table width="750" border="0" align="center" cellpadding="1" cellspacing="1" class="ui-widget-content">
<?php if($campnomb || $err): ?>
				<tr><td><div class="ui-widget">
					<div class="ui-state-error ui-corner-all" style="padding: 0 .7em;"> 
						<p><span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span> 
						<strong>Advertencia:</strong> <?php if($err): echo $err; else: ?> Corrija los campos marcados con *<?php endif; ?></p>
					</div>
				</div></td></tr>
<?php else: ?> 		
				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr>	
<?php endif; ?>
				<tr><td class="ui-widget-header"><span class="style5"><font color="FFFFFF">Nuevo reporte/cierre</font></span></td></tr>
				<tr>
					<td>
						<table width="98%" border="0" cellspacing="0" cellpadding="0" align="center" class="ui-widget-content">
							<tr class="ui-widget-header">
								<td width="50%" class="cont-title">&nbsp;Orden de trabajo No.&nbsp;<input type="text" name="ordtracodigo"  size="13" value="<?php echo $ordtracodigo; ?>" title="Digite el Numero de la Orden de Trabajo..."><button id="reloadform">Reload</button></td>
								<td width="50%" class="cont-title">&nbsp;Generado.&nbsp;<?php if($sbregot['ordtrafecgen']) echo $sbregot['ordtrafecgen']." " .date("h:i a", strtotime($sbregot['ordtrahorgen'])) ?></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<table width="98%" border="0" cellspacing="0" cellpadding="0" align="center"  class="ui-widget-content">
							<tr class="ui-state-default"><td class="cont-title">&nbsp;Datos de la orden</td></tr>
						</table>
						<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
							<tr>
								<td class="NoiseFooterTD">&nbsp;Ubicaci&oacute;n</td>
								<td colspan="3" class="NoiseDataTD"><?php echo cargaplantanombre($sbregot['plantacodigo'], $idcon); ?></td>
							</tr>
							<tr>
								<td class="NoiseFooterTD">&nbsp;Sistema</td>
								<td colspan="3" class="NoiseDataTD"><?php echo cargasistemnombre($sbregot['sistemcodigo'], $idcon); ?></td>
							</tr>
							<tr>
								<td class="NoiseFooterTD">&nbsp;Equipo</td>
								<td colspan="3" class="NoiseDataTD"><?php echo cargaequiponombre($sbregot['equipocodigo'], $idcon); ?></td>
							</tr>
							<?php if($sbregot['componcodigo']): ?>
							<tr>
								<td class="NoiseFooterTD">&nbsp;Componente</td>
								<td colspan="3" class="NoiseDataTD"><?php echo cargacomponnombre($sbregot['componcodigo'], $idcon); ?></td>
							</tr>
							<?php endif ?>
							<tr><td class="ui-state-default" colspan="4"></td></tr>
							<tr>
								<td class="NoiseFooterTD">&nbsp;Prioridad</td>
								<td colspan="3" class="NoiseDataTD"><?php echo cargapriorinombre($sbregtareot['prioricodigo'], $idcon); ?></td>
							</tr>
							<tr>
								<td class="NoiseFooterTD">&nbsp;Mantenimiento</td>
								<td colspan="3" class="NoiseDataTD"><?php echo cargatipmannombre($sbregot['ordtracodigo'], $idcon); ?></td>
							</tr>
							<tr>
								<td class="NoiseFooterTD">&nbsp;Tarea</td>
								<td colspan="3" class="NoiseDataTD"><?php if ($sbregot['ordtracodigo'] != null) echo cargatareanombre($sbregot[ordtracodigo], $idcon); ?></td>
							</tr>
							<tr>
								<td class="NoiseFooterTD">&nbsp;Tipo de trabajo</td>
								<td colspan="3" class="NoiseDataTD"><?php echo cargadetalleprogtiptrab($sbregtareot['tiptracodigo'], $idcon); ?></td>
							</tr>
							<tr>
								<td class="NoiseFooterTD">&nbsp;Descripcion del Trabajo</td>
								<td colspan="3" class="NoiseDataTD"><?php echo $sbregtareot['ordtradescri']; ?></td>
							</tr>
							<tr><td class="ui-state-default" colspan="4"></td></tr>
							<tr>
								<td width="20%" class="NoiseFooterTD">&nbsp;Fecha de inicio</td>
								<td width="30%" class="NoiseErrorDataTD">&nbsp;<b><?php if($sbregot['ordtrafecini']) echo $sbregot['ordtrafecini'].' '.date("h:i a", strtotime($sbregot['ordtrahorini'])); ?></b></td>
								<td width="20%" class="NoiseFooterTD">&nbsp;Fecha estimada a finalizar</td>
								<td width="30%" class="NoiseErrorDataTD">&nbsp;<b><?php if($sbregot['ordtrafecfin']) echo $sbregot['ordtrafecfin'].' '.date("h:i a", strtotime($sbregot['ordtrahorfin'])); ?></b></td>
							</tr>
							<tr>
								<td class="NoiseFooterTD">&nbsp;</td>
								<td class="NoiseFooterTD">&nbsp;aaaa-mm-dd h:mm am/pm</td>
								<td class="NoiseFooterTD">&nbsp;</td>
								<td class="NoiseFooterTD">&nbsp;aaaa-mm-dd h:mm am/pm</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<table width="98%" border="0" cellspacing="0" cellpadding="0" align="center"  class="ui-widget-content">
							<tr class="ui-state-default"><td class="cont-title">&nbsp;Empleado de Mantenimiento</td></tr>
						</table>
						<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
							<tr>
								<td width="20%" class="NoiseFooterTD">Encargado</td>
								<td width="80%" class="NoiseErrorDataTD"><?php echo $user_encargado; ?></td>
							</tr>
							<tr><td class="ui-state-default" colspan="2"></td></tr>
							<tr>
								<td class="NoiseFooterTD" rowspan="<?php echo count ( $user_aux ); ?>">Auxiliar</td>
								<td class="NoiseDataTD"> <?php echo $user_aux[0]; ?></td>
							</tr>
							<?php for($i = 1; $i <= count ( $user_aux ); $i ++): ?>
							<tr><td class="NoiseDataTD"> <?php echo $user_aux [$i]; ?></td></tr>
							<?php endfor ?>
						</table>
					</td>
				</tr>
				<?php if($ordtraparada1 == 't'): ?>
				<tr>
 					<td>
 						<table width="98%" border="0" cellspacing="0" cellpadding="0" align="center"  class="ui-widget-content">
							<tr class="ui-state-default"><td class="cont-title">&nbsp;Parada de equipo&nbsp;&nbsp;<input type="checkbox" name="ordtraparada" id="ordtraparada" checked disabled></td></tr>
						</table>
						<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
							<tr>
								<td width="20%" class="NoiseFooterTD">Fecha/Hora fin de parada</td>
								<td width="80%" class="NoiseErrorDataTD">
									<input type="text" name="parprofecfin" id="parprofecfin" size="8">&nbsp;
              						<select name="horprofin">
                					<?php
		 								if(!$flagnuevoreportcierreot)
		 								{
  											$horprofin = date("h");
  											if(date("a") == 'pm')
  												$pasadpromerfin = 1;
		 								}				 		
										floadtimehours($horprofin);
		  							?>
                					</select>
            						:
            						<select name="minprofin">
                					<?php
										if(!$flagnuevoreportcierreot)
											$minprofin = date("i");
	 									floadtimeminut($minprofin);
	 								?>
            						</select>
            						<input type="checkbox" name="pasadpromerfin" <?php if($flagnuevoreportcierreot){ if($pasadpromerfin)echo "CHECKED";}else{if($pasadpromerfin)echo "CHECKED";}?>>p.m
            					</td>
							</tr>
						</table>
					</td>
				</tr>
				<?php endif; ?>
				<?php if($sbregot['ordtrafecfin']): ?>
				<tr>
					<td>
						<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
							<tr class="NoiseErrorDataTD">
								<td width="20%">&nbsp;<?php if($campnomb["reportfecha"] == 1){$ordtrafecini = null; echo "*";}?>Fecha/Hora de Reporte</td>
								<td colspan="3">
									<input type="text" name="reportfecha" size="8" value="<?php if(!$flagnuevoreportcierreot){echo $reportfecha=date("Y-m-d");} else {echo $reportfecha;}?>" onFocus="this.blur();">
									<select name="horini">
                						<?php
						 					if(!$flagnuevoreportcierreot){
		  										$horini = date("h");
			  									if(date("a") == 'pm')
		  											$pasadmerini = 1;
						 						//echo '<option value ="'.$horini.'">'.$horini.'</option>'."\n";
						 					}				 		
											floadtimehours($horini);
						  				?>
                					</select>:<select name="minini">
		                				<?php
											if(!$flagnuevoreportcierreot){
												$minini = date("i");
						 						//echo '<option value ="'.$minini.'">'.$minini.'</option>'."\n";
											}
						 					floadtimeminut($minini);
						 				?>
	            					</select>
	            					<input type="checkbox" name="pasadmerini" <?php if($flagnuevoreportcierreot){if($pasadmerini)echo "CHECKED";}else{if($pasadmerini)echo "CHECKED";}?>>p.m
								</td>
							</tr>
							<tr><td class="ui-state-default" colspan="4"></td></tr>
							<tr>
								<td width="20%" class="NoiseFooterTD"><?php if($campnomb["tipmancodigo"] == 1){$tipmancodigo = null; echo "*";}?>&nbsp;Mantenimiento</td>
								<td width="30%" class="NoiseFooterTD"><select name="tipmancodigo">
<!--									<option value="">-- Seleccione --</option>-->
									<?php
//								 		if(!$flagnuevoreportcierreot)
//				  							unset($tipmancodigo);
				  															
										$idcon = fncconn();
				  						include ('../src/FunGen/floadtipomant.php');
										floadtipomant($tipmancodigo,$idcon);
									?>
								</select></td>
								<td width="20%" class="NoiseFooterTD"><?php if($campnomb["prioricodigo"] == 1){$prioricodigo = null; echo "*";}?>&nbsp;Prioridad</td>
								<td width="30%" class="NoiseFooterTD"><select name="prioricodigo">
									<option value="">-- Seleccione --</option>
									<?php
//								 		if(!$flagnuevoreportcierreot)
//				  							unset($prioricodigo);
				  															
										include ('../src/FunGen/floadpriorida.php');
										floadpriorida($prioricodigo, $idcon);
									?>
								</select></td>
          					</tr>
          					<tr>
          						<td class="NoiseFooterTD"><?php if($campnomb["tiptracodigo"] == 1){$tiptracodigo = null; echo "*";}?>&nbsp;Tipo de trabajo</td>
								<td colspan="3" class="NoiseFooterTD"><select name="tiptracodigo">
<!--									<option value="">-- Seleccione --</option>-->
            						<?php
//		            					if(!$flagnuevoreportcierreot)
//											unset($tiptracodigo);
	
										include ('../src/FunGen/floadtipotrab.php');
										floadtipotrab($tiptracodigo,$idcon);
									?>
          						</select></td>
          					</tr>
          					<tr>
          						<td class="NoiseFooterTD"><?php if($campnomb["tareacodigo"] == 1){ echo $tareacodigo = null; echo "*";}?>&nbsp;Tarea</td>
		  						<td colspan="3" class="NoiseFooterTD"><select name="tareacodigo">
<!--		  							<option value="">-- Seleccione --</option>-->
									<?php
//										if(!$flagnuevoreportcierreot)
//											unset($tareacodigo);
										
										include ('../src/FunGen/floadtarea.php');
										floadtarea($tareacodigo,$idcon);
									?>
          						</select></td>
          					</tr>
          					<tr class="NoiseErrorDataTD">
 								<td><?php if($campnomb["tipcumcodigo"] == 1){$tipcumcodigo = null; echo "*";}?>&nbsp;Tipo de cumplimiento</td>
 								<td colspan="3"><select name="tipcumcodigo">
									<?php
								 		if(!$flagnuevoreportcierreot)
				  							unset($tipmancodigo);
				  															
										$idcon = fncconn();
				  						include ('../src/FunGen/floadtipocump.php');
										floadtipocump($idcon, $tipmancodigo);
									?>
								</select></td>
							</tr>
          					<tr><td class="ui-state-default" colspan="4"></td></tr>
          					<tr><td colspan="4" class="NoiseFooterTD"><?php if($campnomb["reportdescri"] == 1){$reportdescri = null; echo "*";}?>&nbsp;Descripci&oacute;n</td></tr>
							<tr><td colspan="4" class="NoiseFooterTD"><textarea cols="87" rows="3" name="reportdescri"><?php echo $sbregtareot[tareotnota]; ?></textarea></td></tr>
						</table>
					</td>
				</tr>
       			<?php endif ?>
				<tr><td>&nbsp;</td></tr>
				<tr>
					<td class="NoiseErrorDataTD" align="center"><?php include '../def/jquery.button_form.php'; ?></td>
				</tr>
				<tr><td>&nbsp;</td></tr> 
				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr>
			</table> 
			<input type="hidden" name="reportcodigo" value="<?php if(!$flagnuevoreportcierreot){ echo $sbreg[reportcodigo];}else{ echo $reportcodigo; } ?>">
			<input type="hidden" name="accionnuevoreportcierreot">
			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>">
			<input type="hidden" name="sourceaction" value="nuevo">
			<input type="hidden" id="reloadot" name="reloadot" value="<?php echo $reloadot ?>">
			
			<input type="hidden" name="flaglistas" value="0">
			<input type="hidden" name="ordtraparada1" value="<?php echo $ordtraparada1 ?>">

			<input type="hidden" name="ordtrafecini" value="<?php echo $sbregot["ordtrafecini"];?>">
			<input type="hidden" name="ordtrahorini" value="<?php echo $sbregot["ordtrahorini"];?>">
			
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>">
			<input type="hidden" name="reporttiedur" value="<?php if(!$flagnuevoreportcierreot){echo $sbreg[reporttiedur];}else{ echo $reporttiedur; }?>">
		</form>
	</body>
<?php if(!$codigo){ echo " -->"; } ?>
</html>