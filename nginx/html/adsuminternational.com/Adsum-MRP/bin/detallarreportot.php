<?php

	include ( '../src/FunGen/sesion/fncvalses.php');	
	include ( '../src/FunGen/cargainput.php');
	include ('../src/FunPerPriNiv/pktbltipomant.php');
	include ('../src/FunPerPriNiv/pktblpriorida.php');
	include ('../src/FunPerPriNiv/pktbltipotrab.php');
	include ('../src/FunPerPriNiv/pktbltarea.php');
	/**/
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

	include ('../src/FunPerPriNiv/pktbldocumenot.php');
	
	if(!$flagdetallarreportot)
	{
		include ('../src/FunGen/sesion/fnccarga.php');
		$sbreg = fnccarga($nombtabl,$radiobutton);
	
		if (!$sbreg)
			include('../src/FunGen/fnccontfron.php');
		
		$idcon = fncconn();
		
		if($sbreg[ordtracodigo])
		{
			$sbregot = loadrecordot($sbreg[ordtracodigo],$idcon);
			$sbregtareot = buscartareotordtracodigo($sbreg[ordtracodigo],$idcon);
			
			$iRecordusertareot[tareotcodigo] = $sbregtareot[tareotcodigo];
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

			$rsDocumentot = dinamicscanopdocumenot(array("ordtracodigo" => $sbregtareot["ordtracodigo"]), array("ordtracodigo" => "="), $idcon);
			$nrDocumentot = fncnumreg($rsDocumentot);

			for($a = 0; $a < $nrDocumentot; $a++){

				$rwDocumentot = fncfetch($rsDocumentot, $a);

				if($rwDocumentot["docuotnombre"] && $rwDocumentot["docuottamano"]){

					$uploadocumen = ($uploadocumen)? $uploadocumen."::".$rwDocumentot["docuotnombre"] : $rwDocumentot["docuotnombre"];
					$uploadocumensize = ($uploadocumensize)? $uploadocumensize."::".$rwDocumentot["docuottamano"] : $rwDocumentot["docuottamano"];
				}

			}

		}

	}
?>
<html> 
	<head> 
		<title>Detalle de registro de reporte de orden de trabajo</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0">
		 
		<?php include('../def/jquery.library_maestro.php');?> 
		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.function_comun.js"></script>
	</head> 
<?php if(!$codigo){ echo "<!--";} ?> 
	<body bgcolor="FFFFFF" text="#000000">
		<form name="form1" method="post"  enctype="multipart/form-data"> 
      		<p><font class="NoiseFormHeaderFont">Reporte de orden de trabajo</font></p> 
  			<table border="0" cellspacing="1" cellpadding="0" align="center"class="ui-widget-content" width="750"> 
				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr> 
				<tr><td class="ui-widget-header"><span class="style5"><font color="FFFFFF">Detallar reporte</font></span></td></tr>
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
						<table width="98%" border="0" cellspacing="0" cellpadding="0" align="center"  class="ui-widget-content">
							<tr class="ui-state-default"><td class="cont-title">
								<a onClick="return verocultar('gestion',1);" href="javascript:animatedcollapse.toggle('gestion');"><img id="row1" align="middle" align="top"  src="temas/Noise/DescOn.gif" border="0">&nbsp;Datos de Gesti&oacute;n</a>
							</td></tr>
						</table>
						<div id="gestion" style="display: none;">
		  					<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content"> 
		    					<tr><td><iframe src="detallahistorialtareot.php?ordtracodigo=<?php echo $sbregot[ordtracodigo]; ?>" frameborder="0" name="detalleprograma" frameborder="0"  height="230" width="100%"></iframe></td></tr>
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
								<td width="50%" class="cont-title">&nbsp;Reporte No.&nbsp;<?php echo $sbreg [reportcodigo]; ?></td>
								<td width="50%" class="cont-title">&nbsp;Fecha.&nbsp;<?php echo $sbreg['reportfecha'] ?></td>
							</tr>
						</table>
	  					<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
							<tr>
								<td class="NoiseFooterTD">&nbsp;Mantenimiento</td>
								<td class="NoiseDataTD"><?php echo cargatipmannombre($sbreg['tipmancodigo'], $idcon); ?></td>
								<td class="NoiseFooterTD">&nbsp;Prioridad</td>
								<td class="NoiseDataTD"><?php echo cargapriorinombre($sbreg['prioricodigo'], $idcon); ?></td>
							</tr>
							<tr>
								<td class="NoiseFooterTD">&nbsp;Componente</td>
								<td class="NoiseDataTD"><?php echo cargadetalleprogtiptrab($sbreg['tiptracodigo'], $idcon); ?></td>
								<td class="NoiseFooterTD">&nbsp;Tarea</td>
								<td class="NoiseDataTD"><?php echo cargatareanombre1($sbreg[tareacodigo], $idcon); ?></td>
							</tr>
							<tr><td class="ui-state-default" colspan="4"></td></tr>
							<tr><td class="NoiseFooterTD" colspan="4">&nbsp;Descripci&oacute;n</td></tr>
							<tr><td colspan="4" class="NoiseDataTD"><?php echo $sbreg['reportdescri']; ?></td></tr>
							<tr><td class="ui-state-default" colspan="4"></td></tr>
						</table>
					</td>
				</tr>
				<tr>
	      			<td>
		      			<div id="filuploadfile">
							<table border="0" cellspacing="1" cellpadding="1" align="center" width="100%">
								<tr><td class="ui-state-default">&nbsp;Documentos </td></tr>					
								<tr>
									<td>
										<div style="height:2px;"></div>
										<div class="ui-widget-content content">
											<div id="reportot_file_load" class="file-upname">
												<?php 
													if($uploadocumen):
														$arrUpload = explode('::', $uploadocumen);
														$arrUploadSize = explode('::', $uploadocumensize);
														
														for($a = 0; $a < count($arrUpload); $a++):
												?>
												<div class="uploadifyQueueItem completed"><div class="cancel"><a href="javascript: void(0);" onclick="window.open('http://75.98.171.118/plasticel/doc/upload/gestionot/<?php echo $arrUpload[$a] ?>','impresion','status=no,menubar=no,scrollbars=yes,resizable=yes,width=880,height=650');">Detallar</a></div><span class="fileName"><?php echo $arrUpload[$a].' ('.$arrUploadSize[$a].')' ?></span></div>
												<?php												
														endfor;
													endif;
												?>
											</div>
											<input type="hidden" name="uploadocumen" id="uploadocumen" value="<?php echo $uploadocumen?>">
											<input type="hidden" name="uploadocumensize" id="uploadocumensize" value="<?php echo $uploadocumensize ?>">
										</div>
									</td>
								</tr>
							</table>
						</div>
					</td>
				</tr>
				<tr><td>&nbsp;</td></tr>
				<tr>
					<td class="NoiseErrorDataTD" align="center"><?php include '../def/jquery.button_formdetall.php'; ?></td>
				</tr>
				<tr><td>&nbsp;</td></tr> 
 				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr> 
			</table> 
 			<input type="hidden" name="flagdetallarreportot" value="1"> 
			<input type="hidden" name="acciondetallarreportot">
			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>">
			<input type="hidden" name="sourceaction" value="detallar"> 
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>">
			<input type="hidden" name="columnas" value="reportcodigo,
ordtracodigo,
tipmancodigo,
prioricodigo,
tiptracodigo,
tareacodigo,
reportfecha,
reporttiedur,
reportdescri,
plantacodigo,
sistemcodigo,
equipocodigo,
componcodigo,
ordtrafecini,
ordtrafecfin,
tipfalcodigo">
 			<input type="hidden" name="reportcodigo" value="<?php if($accionconsultarreportot) echo $reportcodigo; ?>"> 
 			<input type="hidden" name="ordtracodigo" value="<?php if($accionconsultarreportot) echo $ordtracodigo; ?>"> 
 			<input type="hidden" name="tipmancodigo" value="<?php if($accionconsultarreportot) echo $tipmancodigo; ?>"> 
 			<input type="hidden" name="prioricodigo" value="<?php if($accionconsultarreportot) echo $prioricodigo; ?>"> 
 			<input type="hidden" name="tiptracodigo" value="<?php if($accionconsultarreportot) echo $tiptracodigo; ?>"> 
 			<input type="hidden" name="tareacodigo" value="<?php if($accionconsultarreportot) echo $tareacodigo; ?>"> 
 			<input type="hidden" name="reportfecha" value="<?php if($accionconsultarreportot) echo $reportfecha; ?>"> 
 			<input type="hidden" name="reporttiedur" value="<?php if($accionconsultarreportot) echo $reporttiedur; ?>"> 
 			<input type="hidden" name="reportdescri" value="<?php if($accionconsultarreportot) echo $reportdescri; ?>"> 
 			<input type="hidden" name="plantacodigo" value="<?php if($accionconsultarreportot) echo $plantacodigo; ?>"> 
 			<input type="hidden" name="sistemcodigo" value="<?php if($accionconsultarreportot) echo $sistemcodigo; ?>"> 
 			<input type="hidden" name="equipocodigo" value="<?php if($accionconsultarreportot) echo $equipocodigo; ?>"> 
 			<input type="hidden" name="componcodigo" value="<?php if($accionconsultarreportot) echo $componcodigo; ?>"> 
 			<input type="hidden" name="ordtrafecini" value="<?php if($accionconsultarreportot) echo $ordtrafecini; ?>"> 
 			<input type="hidden" name="ordtrafecfin" value="<?php if($accionconsultarreportot) echo $ordtrafecfin; ?>"> 
 			<input type="hidden" name="tipfalcodigo" value="<?php if($accionconsultarreportot) echo $tipfalcodigo; ?>"> 
 			<input type="hidden" name="accionconsultarreportot" value="<?php echo $accionconsultarreportot; ?>">
		</form> 
	</body> 
<?php if(!$codigo){ echo " -->"; } ?> 
</html>