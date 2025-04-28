<?php
	ob_start ();
	session_start ();
	
	include ('../src/FunGen/sesion/fncvalses.php');
	include ('../src/FunPerPriNiv/pktblusuario.php');
	include ('../src/FunPerPriNiv/pktblot.php');
	include ('../src/FunPerPriNiv/pktblplanta.php');
	include ('../src/FunPerPriNiv/pktblequipo.php');
	include ('../src/FunPerPriNiv/pktblsistema.php');
	include ('../src/FunPerPriNiv/pktblcomponen.php');
	include ('../src/FunPerPriNiv/pktbltipomant.php');
	include ('../src/FunPerPriNiv/pktblotestado.php');
	include ('../src/FunPerPriNiv/pktblpriorida.php');
	include ('../src/FunPerPriNiv/pktbltipotrab.php');
	include ('../src/FunPerPriNiv/pktbltipocump.php');
	include ('../src/FunPerPriNiv/pktbltarea.php');
	include ('../src/FunGen/cargainput.php');
	include ('../src/FunGen/floadtimehours.php');
	include ('../src/FunGen/floadtimeminut.php');
	
	if($accioneditartareot)
	{
		if(!$usualider || !$lsttecnicoot)
		{
			echo "<script language='JavaScript'>";
			echo "alert('Error: Debe asignar un encargado a la orden');";
			echo "</script>";
			$flageditartareot = 1;
		}
		else
		{
			$idcon = fncconn();
			$otestacodigo = cargaotestadotipo(7, $idcon);
			
			$lider = $usualider;
			$arreglo_tecnic = $lsttecnicoot;
			
			if(!$tareotnota)
				$tareotnota = '[Orden Reasignada]';
			include ('grabatareot.php');
		}
	}	

	
	
	if($radiobutton)
		$ordtracodigo = str_replace ( "|n,", "", $radiobutton ); //Registro seleccionado

	$idcon = fncconn ();
	$usuacodic = $usuacodi;
	
	if ($ordtracodigo) 
	{
		$sbregot = loadrecordot($ordtracodigo, $idcon);
	
		if ($sbregot < 0)
			$err = "No se encontro la orden de trabajo";
		else 
		{
			include_once ('../src/FunPerPriNiv/pktbltareot.php');
			include_once ('../src/FunPerPriNiv/pktblusuariotareot.php');
			
			$sbregtareot = loadrecordmaxtareot2($sbregot['ordtracodigo'], $idcon);
		
			if ($sbregtareot > 0) 
			{
				$otestacodigo = $sbregtareot["otestacodigo"];
				
				$iRecordusertareot['tareotcodigo'] = $sbregtareot['tareotcodigo'];
				$rs_usuariotareot = dinamicscanusuariotareot($iRecordusertareot, $idcon);
			
				if ($rs_usuariotareot > 0) 
				{
					$nr_usuariotareot = fncnumreg($rs_usuariotareot);
					
					if ($nr_usuariotareot > 0) 
					{
						for($i = 0; $i < $nr_usuariotareot; $i++) 
						{
							$rw_usuariotareot = fncfetch($rs_usuariotareot, $i);
						
							if ($rw_usuariotareot[3] == 't')
							{
								$user_encargado = $rw_usuariotareot[1]." - ".cargausuanombre($rw_usuariotareot[1], $idcon);
								$lider = $rw_usuariotareot[1];
							}
							else 
							{
								$user_aux[] = $rw_usuariotareot[1]." - ".cargausuanombre($rw_usuariotareot[1], $idcon);

								if(!$arreglo_tecnic)
									$arreglo_tecnic = $rw_usuariotareot[1];
								else
									$arreglo_tecnic .= ','.$rw_usuariotareot[1];
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
		<title>Editar registro gestion de orden de trabajo</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0">
		<?php include('../def/jquery.library_maestro.php');?>
		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.ui.ajax_accionextras.js"></script>
		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.function_comun.js"></script>
		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.function_ot.js"></script>
		<style type="text/css">
			select, #equiponombre {font-size: 12px;}
			.style1 {font-size: 12px}
			.dont-line-1 {border-top:0; border-bottom:0; border-left:0;}
			.dont-line-2 {border:0;}
		</style>
	</head>
	
<?php if(!$codigo){ echo "<!--";} ?>
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Gesti&oacute;n orden de trabajo</font></p> 
			<table width="800" border="0" align="center" cellpadding="1" cellspacing="1" class="ui-widget-content">
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
				<tr><td class="ui-widget-header"><span class="style5"><font color="FFFFFF"> Reasignar funcionario</font></span></td></tr>
				<tr>
					<td>
						<table width="98%" border="0" cellspacing="0" cellpadding="0" align="center" class="ui-widget-content">
							<tr class="ui-widget-header">
								<td width="50%" class="cont-title">&nbsp;Orden de trabajo No.&nbsp;<?php if (!$flagnuevotareot){ echo $sbregot [ordtracodigo]; } else{ echo $ordtracodigo; } ?></td>
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
								<td width="30%" class="NoiseErrorDataTD">&nbsp;<b><?php if($sbregot['ordtrafecini'])  echo $sbregot['ordtrafecini'].' '.date("h:i a", strtotime($sbregot['ordtrahorini'])); ?></b></td>
								<td width="20%" class="NoiseFooterTD">&nbsp;Fecha estimada a finalizar</td>
								<td width="30%" class="NoiseErrorDataTD">&nbsp;<b><?php if($sbregot['ordtrafecfin'])  echo $sbregot['ordtrafecfin'].' '.date("h:i a", strtotime($sbregot['ordtrahorfin'])); ?></b></td>
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
				<tr>
					<td>
						<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center">
							<tr>
  								<td align="center">
  									<div style="width:778px; height: 14px; margin:0 auto;" class="ui-state-default">
										<a onClick="return verocultar('involucrados',2);" href="javascript:animatedcollapse.toggle('involucrados');"><img id="row2" align="middle" align="top"  src="temas/Noise/<?php if($arrheots) echo 'AscOn'; else echo 'DescOn'  ?>.gif" border="0">&nbsp;Empleados involucrados en la orden</a>
									</div>
  									<div id="involucrados">
										<?php 
											include_once '../src/FunPerPriNiv/pktblcalendario.php';
											include_once '../src/FunPerPriNiv/pktblcuadrilla.php';
											include_once '../src/FunPerPriNiv/pktblcuadrillausuario.php';
											include_once '../src/FunPerPriNiv/pktblcargo.php';
											include_once '../src/FunPerPriNiv/pktblusuanovedad.php';
											include_once '../src/FunPerPriNiv/pktblestadonoveda.php';
											
											$fecini = $ordtrafecini;
											$fecfin = $ordtrafecfin;
											$iRegArray = $lsttecnicoot;
											$noAjax = true;
											include '../src/FunjQuery/jquery.accionextras/jquery.ajax_loadUsuaOt.php'; 
										?>
									</div>
									<input type="hidden" name="alllsttecnicoottmp" id="alllsttecnicoottmp" value="<?php echo $alllsttecnicoottmp; ?>">
									<input type="hidden" name="lsttecnicoot" id="lsttecnicoot" value="<?php echo $lsttecnicoot; ?>">
									<input type="hidden" name="usualider" id="usualider" value="<?php  echo $usualider;  ?>">
									<input type="hidden" name="typesource" id="typesource" value="<?php  echo $typesource;  ?>">
									<input type="hidden" name="negocicodigo" id="negocicodigo" value="<?php  echo $negocicodigo;  ?>">
								</td>
							</tr>
							<tr><td><div class="ui-buttonset" style="width:770px;">
								<button id="anxottecnico">Agregar t&eacute;cnico a la lista</button>&nbsp;
								<button id="retottecnico">Quitar t&eacute;cnico de la lista</button>
							</div></td></tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
							<tr><td class="NoiseFooterTD"><?php if ($campnomb ["tareotnota"] == 1) { $tareotnota = null; echo "*"; } ?>&nbsp;Motivo</td></tr>
							<tr><td class="NoiseFooterTD"><textarea name="tareotnota" cols="87" rows="3"><?php if (!$flageditartareot){ echo $sbreg['tareotnota']; } else{ echo $tareotnota; } ?></textarea></td></tr>
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
			<input type="hidden" name="tareotcodigo" value="<?php if (! $flageditartareot){ echo $sbreg[tareotcodigo]; } else{ echo $tareotcodigo; } ?>">
			<input type="hidden" name="accioneditartareot">
			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>">
			<input type="hidden" name="sourceaction" value="editar">
			<!-- 	empleados de mantenimiento    -->
			<input type="hidden" name="lider" value="<?php echo $lider; ?>"> 
			<input type="hidden" name="arreglo_tecnic" value="<?php echo $arreglo_tecnic; ?>"> 
			<!--	*	*	*	*	*	--> 
			<input type="hidden" name="arreglo_ite" value="<?php echo $arreglo_ite; ?>"> 
			<input type="hidden" name="arreglo_herr" value="<?php echo $arreglo_herr; ?>"> 
			<!--	*	*	*	*	*	-->
			<input type="hidden" name="ordtracodigo" size="13" value="<?php if (!$flageditartareot) { echo $sbregot [ordtracodigo]; } else { echo $ordtracodigo; } ?>" > 
			<input type="hidden" id="codigo" name="codigo" value="<?php echo $codigo; ?>">
		</form>
		<div id="windowusuanovedad" title="Adsum Kallpa [Novedad]">
			<div id="usuanovmsgs">
				<table width="95%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">						
					<tr>
     					<td class="NoiseFooterTD" width="15%">&nbsp;Fecha inicio</td>
     					<td class="NoiseDataTD" width="35%">
     						<input type="text" name="usunovfecini" id="usunovfecini" size="12">
     						<select name="usunovhorini" id="usunovhorini" onChange="calculeDiff();">
								<?php
									$hora = '00:00';
									for(;;):
										echo '<option value="'.$hora.'">'.date("h:i a", strtotime($hora)).'</option>';
										$hora = date("H:i", strtotime($hora.' + 30 minutes'));
										
										if($hora == '23:30')
											break;
									endfor;
								?>
							</select>	
     					</td>
     					<td class="NoiseFooterTD" width="15%">&nbsp;Fecha fin</td>
     					<td class="NoiseDataTD" width="35%">
     						<input type="text" name="usunovfecfin" id="usunovfecfin" size="12">
     						<select name="usunovhorfin" id="usunovhorfin" onChange="calculeDiff();">
								<?php
									$hora = '00:00';
									for(;;):
										echo '<option value="'.$hora.'">'.date("h:i a", strtotime($hora)).'</option>';
										$hora = date("H:i", strtotime($hora.' + 30 minutes'));
										
										if($hora == '23:30')
											break;
									endfor;
								?>
							</select>
     					</td>
					</tr>
					<tr>
						<td class="NoiseFooterTD">&nbsp;Duraci&oacute;n</td>
						<td class="NoiseDataTD"  colspan="3"><span id="duracionhe"><?php echo $duracion ?></span><input type="hidden" value="<?php echo $duracion ?>" id="duracion" name="duracion"></td>
					</tr>
				</table>
			</div>
			<div id="usuanovmsg"></div>
		</div>
		<div id="msgwindow" title="Adsum Kallpa"><span id="msg"></span></div>
		<div id="msgwindowtecncuadrilla" title="Adsum Kallpa"><span id="msgottecncuadri"></span></div>
	</body> 
<?php if (! $codigo) { echo " -->"; } ?> 
</html>