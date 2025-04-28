<?php 

	include ( '../src/FunGen/sesion/fncvalses.php');
	include ( '../src/FunGen/cargainput.php');
	include ( '../src/FunPerPriNiv/pktblsistema.php');
	include ( '../src/FunPerPriNiv/pktbltiposistema.php');
	include ( '../src/FunPerPriNiv/pktblcomponen.php');
	include ( '../src/FunPerPriNiv/pktblequipo.php');
	include ( '../src/FunPerPriNiv/pktbltipotrab.php');
	include ( '../src/FunPerPriNiv/pktblusuario.php');
	include ( '../src/FunPerPriNiv/pktbltarea.php');
	include ('../src/FunPerPriNiv/pktbldocumenot.php');
	include ( '../src/FunPerPriNiv/pktblotestado.php');
	include ( '../src/FunPerPriNiv/pktblot.php');
	include ( '../src/FunPerPriNiv/pktblplanta.php');
	include ( '../src/FunPerPriNiv/pktbltipomant.php');
	include ( '../src/FunPerPriNiv/pktblpriorida.php');
	include ( '../src/FunPerPriNiv/pktbltipocump.php');
	include ( '../src/FunGen/floadtimehours.php');
	include ( '../src/FunGen/floadtimeminut.php');

	if(!$flagdetallartareot)
	{ 
		include ( '../src/FunGen/sesion/fnccarga.php');
		include ( '../src/FunPerPriNiv/pktbltareot2.php');

		$nuConn = fncconn();
		$codtareot = loadcodigotareot($radiobutton,$nuConn);
		$sbregtareot = fnccarga($nombtabl,$codtareot.'|n,');
		
		if (!$sbregtareot)
			include( '../src/FunGen/fnccontfron.php');
		else
		{
			$idcon = fncconn();
			$sbregot = loadrecordot($sbregtareot[ordtracodigo],$idcon);		
	      
			$iRecordusertareot[tareotcodigo] = $sbregtareot[tareotcodigo];
			
			include ( '../src/FunPerPriNiv/pktblusuariotareot.php');
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
?> 
<html> 
	<head> 
		<title>Detalle de registro de Gestion de orden de trabajo</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0">
		 
		<?php include('../def/jquery.library_maestro.php');?> 
	</head> 
<?php if(!$codigo){ echo "<!--";} ?> 
  	<body bgcolor="FFFFFF" text="#000000"> 
    	<form name="form1" method="post"  enctype="multipart/form-data"> 
      		<p><font class="NoiseFormHeaderFont">Gesti&oacute;n de orden de trabajo</font></p> 
  			<table border="0" cellspacing="1" cellpadding="0" align="center"class="ui-widget-content" width="750"> 
				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr> 
				<tr><td class="ui-widget-header"><span class="style5"><font color="FFFFFF">Detallar gesti&oacute;n</font></span></td></tr>
				<tr>
					<td>
						<table width="98%" border="0" cellspacing="0" cellpadding="0" align="center" class="ui-widget-content">
							<tr class="ui-widget-header">
								<td width="50%" class="cont-title">&nbsp;Orden de trabajo No.&nbsp;<?php if (!$flagnuevotareot){ echo $sbregot [ordtracodigo]; } else{ echo $ordtracodigo; } ?></td>
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
							<tr class="ui-state-default"><td class="cont-title">&nbsp;Gesti&oacute;n</td></tr>
						</table>
	  					<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content"> 
	    					<tr><td><iframe src="detallahistorialtareot.php?ordtracodigo=<?php echo $sbregot[ordtracodigo]; ?>" frameborder="0" name="detalleprograma" frameborder="0"  height="230" width="100%"></iframe></td></tr>
						</table>
					</td>
				</tr>
				<tr>
					<td class="ui-state-default" colspan="4">&nbsp;
      					<a onClick="return verocultar('uploadfile',1);" href="javascript:animatedcollapse.toggle('filuploadfile');"><img id="row0" align="middle" align="top"  src="temas/Noise/DescOn.gif" border="0">&nbsp;Adjuntar documentos</a>
      					<input name="uploadfile" id="uploadfile" type="hidden" value="<?php echo $uploadfile; ?>">
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
			<input type="hidden" name="flagdetallartareot" value="1"> 
			<input type="hidden" name="acciondetallartareot">
			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>">
			<input type="hidden" name="sourceaction" value="detallar"> 	
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
			
			<input type="hidden" name="columnas" value="ordtracodigo,otestacodigo,plantacodigo,sistemcodigo,equipocodigo,componcodigo,tipmancodigo,tipfalcodigo,prioricodigo,tipfalcodigo,prioricodigo,ordtrafecini,ordtrafecfin,ordtrahorfin,usuacodigo,tiptracodigo,tareacodigo">
			<input type="hidden" name="tareotcodigo" value="<?php if($accionconsultartareot) echo $tareotcodigo; ?>"> 
  			<input type="hidden" name="ordtracodigo" value="<?php if($accionconsultartareot) echo $ordtracodigo; ?>"> 
 			<input type="hidden" name="tareacodigo" value="<?php if($accionconsultartareot) echo $tareacodigo; ?>"> 
 			<input type="hidden" name="tiptracodigo" value="<?php if($accionconsultartareot) echo $tiptracodigo; ?>"> 
 			<input type="hidden" name="operaccodigo" value="<?php if($accionconsultartareot) echo $operaccodigo; ?>">
 			<input type="hidden" name="tareottiedur" value="<?php if($accionconsultartareot) echo $tareottiedur; ?>"> 
 			<input type="hidden" name="tareotnota" value="<?php if($accionconsultartareot) echo $tareotnota; ?>">
 			<input type="hidden" name="progracodigo" value="<?php if($accionconsultartareot) echo $progracodigo; ?>"> 
 			<input type="hidden" name="tareothorini" value="<?php if($accionconsultartareot) echo $tareothorini; ?>"> 
 			<input type="hidden" name="tareotfecini" value="<?php if($accionconsultartareot) echo $tareotfecini; ?>"> 
 			<input type="hidden" name="tareothorfin" value="<?php if($accionconsultartareot) echo $tareothorfin; ?>"> 
 			<input type="hidden" name="tareotfecfin" value="<?php if($accionconsultartareot) echo $tareotfecfin; ?>"> 
 			<input type="hidden" name="tareotsecuen" value="<?php if($accionconsultartareot) echo $tareotsecuen; ?>"> 
 			<input type="hidden" name="tareotfin" value="<?php if($accionconsultartareot) echo $tareotfin; ?>"> 
 			<input type="hidden" name="usuacodigo" value="<?php if($accionconsultartareot) echo $usuacodigo; ?>"> 
 			<input type="hidden" name="usuanombre" value="<?php if($accionconsultartareot) echo $usuanombre; ?>"> 
 			<input type="hidden" name="otestacodigo" value="<?php if($accionconsultartareot) echo $otestacodigo; ?>"> 
 			<input type="hidden" name="prioricodigo" value="<?php if($accionconsultartareot) echo $prioricodigo; ?>"> 
 			<input type="hidden" name="tipcumcodigo" value="<?php if($accionconsultartareot) echo $tipcumcodigo; ?>"> 
 			<input type="hidden" name="otestacodigo" value="<?php if($accionconsultartareot) echo $otestacodigo; ?>"> 
 			<input type="hidden" name="plantacodigo" value="<?php if($accionconsultartareot) echo $plantacodigo; ?>"> 
 			<input type="hidden" name="sistemcodigo" value="<?php if($accionconsultartareot) echo $sistemcodigo; ?>"> 
 			<input type="hidden" name="equipocodigo" value="<?php if($accionconsultartareot) echo $equipocodigo; ?>"> 
 			<input type="hidden" name="ordtrafecgen" value="<?php if($accionconsultartareot) echo $ordtrafecgen; ?>">
 			<input type="hidden" name="tipmancodigo" value="<?php if($accionconsultartareot) echo $tipmancodigo; ?>">
 			<input type="hidden" name="tipfalcodigo" value="<?php if($accionconsultartareot) echo $tipfalcodigo; ?>">
 			<input type="hidden" name="partecodigo" value="<?php if($accionconsultartareot) echo $partecodigo; ?>">
 			<input type="hidden" name="tiptracodigo" value="<?php if($accionconsultartareot) echo $tiptracodigo; ?>">
 			<input type="hidden" name="tareacodigo" value="<?php if($accionconsultarot) echo $tareacodigo; ?>">
 			<input type="hidden" name="accionconsultartareot" value="<?php echo $_POST['accionconsultartareot']; ?>">
		</form> 
	</body> 
<?php if(!$codigo){ echo " -->"; } ?> 
</html> 
