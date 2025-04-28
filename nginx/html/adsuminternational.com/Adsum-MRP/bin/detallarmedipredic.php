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
	include ( '../src/FunPerPriNiv/pktblotestado.php');
	include ( '../src/FunPerPriNiv/pktblot.php');
	include ( '../src/FunPerPriNiv/pktblplanta.php');
	include ( '../src/FunPerPriNiv/pktbltipomant.php');
	include ( '../src/FunPerPriNiv/pktblpriorida.php');
	include ( '../src/FunPerPriNiv/pktbltipocump.php');
	include ( '../src/FunGen/floadtimehours.php');
	include ( '../src/FunGen/floadtimeminut.php');

	if(!$flagdetallarmediprefic)
	{ 
		include ( '../src/FunGen/sesion/fnccarga.php');
		$sbregreport = fnccarga('reportot',$radiobutton,'|n');
		
		$idcon = fncconn();
		$sbregot = loadrecordot($sbregreport[ordtracodigo],$idcon);		
		//Tareot
		include_once ('../src/FunPerPriNiv/pktbltareot.php');
		include_once ('../src/FunPerPriNiv/pktblusuariotareot.php');
			
		$sbregtareot = buscartareotordtracodigo($sbregot['ordtracodigo'], $idcon);
		
		if ($sbregtareot > 0) 
		{
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
							$user_encargado = $rw_usuariotareot[1]." - ".cargausuanombre($rw_usuariotareot[1], $idcon);
						else 
							$user_aux[] = $rw_usuariotareot[1]." - ".cargausuanombre($rw_usuariotareot[1], $idcon);
					}
				}
			}
		}
		
		$dir = '../doc/upload/reportot/repcod'.$sbregreport['reportcodigo'].'/';
		
		if (is_dir( $dir))
		{
			$rf_buff = opendir($dir); 
			while ($archivo = readdir($rf_buff))
			{ 
				if( $archivo !='.' && $archivo !='..' )
				{
					if (!is_dir( $dir.$archivo)) 
						$uploadocumen[] = $archivo;  
				} 
			} 
			closedir($rf_buff);
		} 
	}

?> 
<html> 
	<head> 
		<title>Detalle de registro de Documentos Mediciones predictivas</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0">
		 
		<?php include('../def/jquery.library_maestro.php');?>
		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.function_comun.js"></script> 
		
		<style type="text/css">
			#reportot_file_load a {
			    color: #1372A2;
			    font: 12px Arial;
			    text-decoration: none;
			}
			
			#reportot_file_load a:hover {
				text-decoration: underline;	
			}
		</style>
	</head> 
<?php if(!$codigo){ echo "<!--";} ?> 
  	<body bgcolor="FFFFFF" text="#000000"> 
    	<form name="form1" method="post"  enctype="multipart/form-data"> 
      		<p><font class="NoiseFormHeaderFont">Documentos Mediciones predictivas / Orden de trabajo</font></p> 
  			<table border="0" cellspacing="1" cellpadding="0" align="center"class="ui-widget-content" width="750"> 
				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr> 
				<tr><td class="ui-widget-header"><span class="style5"><font color="FFFFFF">&nbsp;</font></span></td></tr>
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
       					<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center">
      						<tr><td class="ui-state-default">&nbsp;
      							<a onClick="return verocultar('filuploadfile',0);" href="javascript:animatedcollapse.toggle('filuploadfile');" <?php if($flagnuevorefequipo == 1): ?>style="color:red;" <?php endif; ?>><img id="row0" align="middle" align="top"  src="temas/Noise/<?php if($uploadocumen){ echo 'AscOn'; }else{ echo 'DescOn'; } ?>.gif" border="0">&nbsp;Documentos adjuntos - Mediciones predictivas</a>
      						</td></tr>
      						<tr>
								<td>
									<div id="filuploadfile" style="display:<?php if($uploadocumen){ echo 'block'; }else{ echo 'none'; } ?>" >
										<div class="ui-widget-content content">
											<div id="reportot_file_load" class="file-upname">
												<?php 
													if($uploadocumen):
														for($a = 0; $a < count($uploadocumen); $a++):
												?>
												<div class="uploadifyQueueItem completed"><span class="fileName"><a href="<?php echo $dir.$uploadocumen[$a] ?>" target="_blank"><?php echo $uploadocumen[$a].' ('.$uploadocumen[$a].')' ?></a></span></div>
												<?php													
														endfor;
													endif;
												?>
											</div>
										</div>
				       				</div>
		       					</td>
		       				</tr>
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
			<input type="hidden" name="flagdetallarmedipredic" value="1"> 
			<input type="hidden" name="acciondetallarmedipredic">
			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>">
			<input type="hidden" name="sourceaction" value="detallar"> 	
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
			
			<input type="hidden" name="columnas" value="reportcodigo,ordtracodigo,plantacodigo,sistemcodigo,equipocodigo,usuacodigo,reportfecha">
 			<input type="hidden" name="reportcodigo" value="<?php if($accionconsultarmedipredic) echo $ordtracodigo; ?>"> 
 			<input type="hidden" name="ordtracodigo" value="<?php if($accionconsultarmedipredic) echo $ordtracodigo; ?>"> 
 			<input type="hidden" name="reportfecha" value="<?php if($accionconsultarreportot) echo $reportfecha; ?>"> 
 			<input type="hidden" name="usuacodigo" value="<?php if($accionconsultarmedipredic) echo $usuacodigo; ?>">
 			<input type="hidden" name="usuanombre" value="<?php if($accionconsultarmedipredic) echo $usuanombre; ?>">
 			<input type="hidden" name="plantacodigo" value="<?php if($accionconsultarmedipredic) echo $plantacodigo; ?>"> 
 			<input type="hidden" name="sistemcodigo" value="<?php if($accionconsultarmedipredic) echo $sistemcodigo; ?>"> 
 			<input type="hidden" name="equipocodigo" value="<?php if($accionconsultarmedipredic) echo $equipocodigo; ?>">
		</form> 
	</body> 
<?php if(!$codigo){ echo " -->"; } ?> 
</html> 
