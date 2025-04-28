<?php
	include ( '../src/FunGen/sesion/fncvalses.php');	
	include ( '../src/FunGen/cargainput.php');
	include ('../src/FunPerPriNiv/pktbltipomant.php');
	include ('../src/FunPerPriNiv/pktblpriorida.php');
	include ('../src/FunPerPriNiv/pktbltipotrab.php');
	include ('../src/FunPerPriNiv/pktbltipocump.php');
	include ('../src/FunPerPriNiv/pktbltarea.php');
	/**/
	include ( '../src/FunPerPriNiv/pktblreportot.php');
	include ( '../src/FunPerPriNiv/pktblot.php');
	include ( '../src/FunPerPriNiv/pktblplanta.php');
	include ( '../src/FunPerPriNiv/pktblsistema.php');
	include ( '../src/FunPerPriNiv/pktblequipo.php');
	include ( '../src/FunPerPriNiv/pktblcomponen.php');
	include ( '../src/FunPerPriNiv/pktblitem.php');
	include ( '../src/FunPerPriNiv/pktbloperacio.php');
//	include ( '../src/FunPerPriNiv/pktblherramie.php');
//	include ( '../src/FunPerPriNiv/pktbltransacherramie.php');
	include ( '../src/FunPerPriNiv/pktbltransacitem.php');
	include ( '../src/FunPerPriNiv/pktbltareot.php');
	include ( '../src/FunPerPriNiv/pktblusuariotareot.php');
	include ( '../src/FunPerPriNiv/pktblusuario.php');
//	include ( '../src/FunPerPriNiv/pktbltareotherramie.php');
	include ( '../src/FunPerPriNiv/pktblitemtareot.php');
	include ( '../src/FunPerPriNiv/pktblreportotitem.php');
	
	if(!$flagdetallarreportcierreot)
	{
		include ('../src/FunGen/sesion/fnccarga.php');
		$sbreg = fnccarga($nombtabl,$radiobutton);
	
		if (!$sbreg)
			include('../src/FunGen/fnccontfron.php');
		
		$idcon = fncconn();
		
		if($sbreg[reportcodigo])
		{
			$sbregreport = loadrecordreportot($sbreg[reportcodigo], $idcon);
			
			
			$sbregot = loadrecordot($sbregreport[ordtracodigo],$idcon);
			$sbregtareot = buscartareotordtracodigo($sbregreport[ordtracodigo],$idcon);
			$sbregtareot1 = loadrecordallmaxtareot($sbregot[ordtracodigo],$idcon);
			
			$iRecordusertareot[tareotcodigo] = $sbregtareot1[tareotcodigo];
			$nuResult = dinamicscanusuariotareot($iRecordusertareot,$idcon);
			
			if($nuResult > 0)
			{
				$nuCantRow = pg_numrows($nuResult);
				$user_aux = array();
				if ($nuCantRow > 0)
				{
					for($i = 0; $i < $nuCantRow; $i++)
					{						
						$sbRow = pg_fetch_row ($nuResult,$i);
						$user_ot = loadrecordusuario($sbRow[1], $idcon);
						$usrname1 = $sbRow[1]." - " .$user_ot["usuanombre"]." ".$user_ot["usuapriape"]." ".$user_ot["usuasegape"];
						if($sbRow[3] == 't')
							$user_encargado = $usrname1;
						else
							$user_aux[] = $usrname1;
					}
				}
			}
			
//			if($sbregot)
//				include('detallareportot.php');
		}
	}
	

?>
<html> 
	<head> 
		<title>Detalle de registro de reporte/cierre de orden de trabajo</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0">
		 
		<?php include('../def/jquery.library_maestro.php');?> 
		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.function_comun.js"></script>
	</head> 
<?php if(!$codigo){ echo "<!--";} ?> 
	<body bgcolor="FFFFFF" text="#000000">
		<form name="form1" method="post"  enctype="multipart/form-data"> 
      		<p><font class="NoiseFormHeaderFont">Reporte/Cierre de orden de trabajo</font></p> 
  			<table border="0" cellspacing="1" cellpadding="0" align="center"class="ui-widget-content" width="750"> 
				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr> 
				<tr><td class="ui-widget-header"><span class="style5"><font color="FFFFFF">Detallar reporte/cierre</font></span></td></tr>
				<tr>
					<td>
						<table width="98%" border="0" cellspacing="0" cellpadding="0" align="center" class="ui-widget-content">
							<tr class="ui-widget-header">
								<td width="50%" class="cont-title">&nbsp;Orden de trabajo No.&nbsp;<?php echo $sbregot [ordtracodigo]; ?></td>
								<td width="50%" class="cont-title">&nbsp;Generado.&nbsp;<?php echo $sbregot['ordtrafecgen']." " .date("h:i a", strtotime($sbregot['ordtrahorgen'])) ?></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<table width="98%" border="0" cellspacing="0" cellpadding="0" align="center"  class="ui-widget-content">
							<tr class="ui-state-default"><td class="cont-title">&nbsp;Datos de la orden</td></tr>
						</table>
						<table width="98%" border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content">
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
							<tr><td class="ui-state-default" colspan="4"></td></tr>
							<tr><td class="NoiseFooterTD" colspan="4">&nbsp;Descripci&oacute;n del Trabajo</td></tr>
							<tr><td colspan="4" class="NoiseDataTD"><?php 
  								$datosdetarea = explode(".", $sbregtareot['tareotnota']);
  								$cantdatos = count($datosdetarea);
  								
  								for ($j = 0; $j < $cantdatos; $j++)
  									if($datosdetarea[$j]) echo "&nbsp;[&nbsp;&nbsp;&nbsp;]".$datosdetarea[$j]."<br>";
  							?></td></tr>
							<tr><td class="ui-state-default" colspan="4"></td></tr>
							<tr>
								<td width="20%" class="NoiseFooterTD">&nbsp;Fecha de inicio</td>
								<td width="30%" class="NoiseErrorDataTD">&nbsp;<b><?php echo $sbregot['ordtrafecini'].' '.date("h:i a", strtotime($sbregot['ordtrahorini'])); ?></b></td>
								<td width="20%" class="NoiseFooterTD">&nbsp;Fecha estimada a finalizar</td>
								<td width="30%" class="NoiseErrorDataTD">&nbsp;<b><?php echo $sbregot['ordtrafecfin'].' '.date("h:i a", strtotime($sbregot['ordtrahorfin'])); ?></b></td>
							</tr>
							<tr>
								<td class="NoiseFooterTD">&nbsp;</td>
								<td class="NoiseFooterTD">&nbsp;aaaa-mm-dd h:mm am/pm</td>
								<td class="NoiseFooterTD">&nbsp;</td>
								<td class="NoiseFooterTD">&nbsp;aaaa-mm-dd h:mm am/pm</td>
							</tr>
							<tr>
								<td class="NoiseFooterTD">&nbsp;Duraci&oacute;n estimada</td>
								<td colspan="3" class="NoiseDataTD"><?php echo $sbregtareot['tareottiedur']; ?> hr.</td>
							</tr>
						</table>
					</td>
				</tr>	
				<tr>
					<td>
						<table width="98%" border="0" cellspacing="0" cellpadding="0" align="center"  class="ui-widget-content">
							<tr class="ui-state-default"><td class="cont-title">&nbsp;Empleado de Mantenimiento</td></tr>
						</table>
						<table width="98%" border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content">
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
						<table width="98%" border="0" cellspacing="0" cellpadding="0" align="center"  class="ui-widget-content">
							<tr class="ui-state-default"><td class="cont-title">
								<a onClick="return verocultar('gestion',1);" href="javascript:animatedcollapse.toggle('gestion');"><img id="row1" align="middle" align="top"  src="temas/Noise/DescOn.gif" border="0">&nbsp;Datos de Gesti&oacute;n</a>
							</td></tr>
						</table>
						<div id="gestion" style="display: none;">
		  					<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content"> 
		    					<tr><td><iframe src="detallahistorialtareot.php?ordtracodigo=<?php echo $sbregot['ordtracodigo']; ?>" frameborder="0" name="detalleprograma" frameborder="0"  height="230" width="100%"></iframe></td></tr>
							</table>
						</div>
					</td>
				</tr>
				<tr>
					<td>
						<table width="98%" border="0" cellspacing="0" cellpadding="0" align="center"  class="ui-widget-content">
							<tr class="ui-state-default"><td class="cont-title">&nbsp;Reporte</td></tr>
						</table>
						<table width="98%" border="0" cellspacing="0" cellpadding="0" align="center" class="ui-widget-content">
							<tr class="ui-widget-header">
								<td width="50%" class="cont-title">&nbsp;Reporte No.&nbsp;<?php echo $sbregreport [reportcodigo]; ?></td>
								<td width="50%" class="cont-title">&nbsp;Fecha.&nbsp;<?php echo $sbregreport['reportfecha'] ?></td>
							</tr>
						</table>
	  					<table width="98%" border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content">
							<tr>
								<td width="20%" class="NoiseFooterTD">&nbsp;Mantenimiento</td>
								<td width="30%" class="NoiseDataTD"><?php echo cargatipmannombre1($sbregreport['tipmancodigo'], $idcon); ?></td>
								<td width="20%" class="NoiseFooterTD">&nbsp;Prioridad</td>
								<td width="30%" class="NoiseDataTD"><?php echo cargapriorinombre($sbregreport['prioricodigo'], $idcon); ?></td>
							</tr>
							<tr>
								<td class="NoiseFooterTD">&nbsp;Tipo trabajo</td>
								<td class="NoiseDataTD"><?php echo cargadetalleprogtiptrab($sbregreport['tiptracodigo'], $idcon); ?></td>
								<td class="NoiseFooterTD">&nbsp;Tarea</td>
								<td class="NoiseDataTD"><?php echo cargatareanombre1($sbregreport[tareacodigo], $idcon); ?></td>
							</tr>
							<tr><td class="ui-state-default" colspan="4"></td></tr>
							<tr><td class="NoiseFooterTD" colspan="4">&nbsp;Descripci&oacute;n</td></tr>
							<tr><td colspan="4" class="NoiseDataTD"><?php echo $sbregreport['reportdescri']; ?></td></tr>
							<tr><td class="ui-state-default" colspan="4"></td></tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<table width="98%" border="0" cellspacing="0" cellpadding="0" align="center"  class="ui-widget-content">
							<tr class="ui-state-default"><td class="cont-title">&nbsp;Cierre</td></tr>
						</table>
						<table width="98%" border="0" cellspacing="0" cellpadding="0" align="center" class="ui-widget-content">
							<tr class="ui-widget-header">
								<td width="50%" class="cont-title">&nbsp;Cierre No.&nbsp;<?php echo $sbreg[cierotcodigo]; ?></td>
								<td width="50%" class="cont-title">&nbsp;Fecha.&nbsp;<?php echo $sbreg['cierotfecfin'] ?></td>
							</tr>
						</table>
	  					<table width="98%" border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content">
							<tr>
								<td width="20%" class="NoiseFooterTD">&nbsp;Tipo cumplimiento</td>
								<td class="NoiseDataTD"><?php echo cargatipcumnombre($sbreg['tipcumcodigo'], $idcon); ?></td>
							</tr>
							<tr><td class="ui-state-default" colspan="2"></td></tr>
							<tr><td class="NoiseFooterTD" colspan="2">&nbsp;Descripci&oacute;n</td></tr>
							<tr><td colspan="2" class="NoiseDataTD"><?php echo $sbreg['cierotdescri']; ?></td></tr>
							<tr><td class="ui-state-default" colspan="2"></td></tr>
						</table>
					</td>
				</tr>
				<tr><td>&nbsp;</td></tr>
				<tr>
					<td class="NoiseErrorDataTD" align="center"><?php include '../def/jquery.button_formdetall.php'; ?></td>
				</tr>
				<tr><td>&nbsp;</td></tr> 
 				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr> 
			</table> 
 			<input type="hidden" name="flagdetallarreportcierreot" value="1"> 
			<input type="hidden" name="acciondetallarreportcierreot">
			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>">
			<input type="hidden" name="sourceaction" value="detallar"> 
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>">
			<input type="hidden" name="columnas" value="cierotcodigo,
ordtracodigo,
plantacodigo,
sistemcodigo,
equipocodigo,
componcodigo,
tipmancodigo,
prioricodigo,
tipfalcodigo,
ordtrafecini,
ordtrafecfin,
tiptracodigo,
tareacodigo,
cierotdescri">
 			<input type="hidden" name="cierotcodigo" value="<?php if($accionconsultarreportcierreot) echo $cierotcodigo; ?>">
 			<input type="hidden" name="ordtracodigo" value="<?php if($accionconsultarreportcierreot) echo $ordtracodigo; ?>">
 			<input type="hidden" name="plantacodigo" value="<?php if($accionconsultarreportcierreot) echo $plantacodigo; ?>">
 			<input type="hidden" name="sistemcodigo" value="<?php if($accionconsultarreportcierreot) echo $sistemcodigo; ?>">
 			<input type="hidden" name="equipocodigo" value="<?php if($accionconsultarreportcierreot) echo $equipocodigo; ?>">
 			<input type="hidden" name="tipmancodigo" value="<?php if($accionconsultarreportcierreot) echo $tipmancodigo; ?>">
 			<input type="hidden" name="componcodigo" value="<?php if($accionconsultarreportcierreot) echo $componcodigo; ?>">
 			<input type="hidden" name="prioricodigo" value="<?php if($accionconsultarreportcierreot) echo $prioricodigo; ?>">
 			<input type="hidden" name="tipfalcodigo" value="<?php if($accionconsultarreportcierreot) echo $tipfalcodigo; ?>">
 			<input type="hidden" name="ordtrafecini" value="<?php if($accionconsultarreportcierreot) echo $ordtrafecini; ?>">
 			<input type="hidden" name="ordtrafecfin" value="<?php if($accionconsultarreportcierreot) echo $ordtrafecfin; ?>">
 			<input type="hidden" name="tiptracodigo" value="<?php if($accionconsultarreportcierreot) echo $tiptracodigo; ?>">
 			<input type="hidden" name="tareacodigo" value="<?php if($accionconsultarreportcierreot) echo $tareacodigo; ?>">
 			<input type="hidden" name="cierotdescri" value="<?php if($accionconsultarreportcierreot) echo $cierotdescri; ?>">
 			<input type="hidden" name="accionconsultarreportcierreot" value="<?php echo $accionconsultarreportcierreot; ?>">
		</form> 
	</body> 
<?php if(!$codigo){ echo " -->"; } ?> 
</html>