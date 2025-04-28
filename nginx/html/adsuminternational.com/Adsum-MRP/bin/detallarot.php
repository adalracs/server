<?php
	include ( '../src/FunGen/sesion/fncvalses.php');
	include ( '../src/FunPerPriNiv/pktblplanta.php');
	include ( '../src/FunPerPriNiv/pktblsistema.php');
	include ( '../src/FunPerPriNiv/pktblequipo.php');
	include ( '../src/FunPerPriNiv/pktblitem.php');
	include ( '../src/FunPerPriNiv/pktbloperacio.php');
	include ( '../src/FunPerPriNiv/pktbltipomant.php');
	include ( '../src/FunPerPriNiv/pktbltipofall.php');
	include ( '../src/FunPerPriNiv/pktblpriorida.php');
	include ( '../src/FunPerPriNiv/pktbltarea.php');
	include ( '../src/FunPerPriNiv/pktblvistamaxtareot.php');
	include ( '../src/FunPerPriNiv/pktblherramie.php');
	include ( '../src/FunPerPriNiv/pktbltransacherramie.php');
	include ( '../src/FunPerPriNiv/pktbltransacitem.php');
	include ( '../src/FunPerPriNiv/pktbltipotrab.php');
	include ( '../src/FunPerPriNiv/pktbltareot.php');
	include ( '../src/FunPerPriNiv/pktblcomponen.php');
	include ( '../src/FunPerPriNiv/pktblsoliserv.php');
	include ( '../src/FunPerPriNiv/pktblusuariotareot.php');
	include ( '../src/FunPerPriNiv/pktblusuario.php');
	include ( '../src/FunPerPriNiv/pktbltareotherramie.php');
	include ( '../src/FunPerPriNiv/pktblotestado.php');
	include ( '../src/FunPerPriNiv/pktblitemtareot.php');
	include ( '../src/FunGen/fncstrfecha.php');

	if(!$flagdetallarot)
	{
		include ( '../src/FunGen/sesion/fnccarga.php');
		$sbreg = fnccarga($nombtabl,$radiobutton);
		
		if (!$sbreg)
			include( '../src/FunGen/fnccontfron.php');
		include('detallaot.php');
		
		$idcon = fncconn();
		$rsMaxTareot = loadrecordvistamaxtareot($sbreg['ordtracodigo'], $idcon);
		$rsOtestado = loadrecordotestado($rsMaxTareot['otestacodigo'], $idcon);
	}
?>
<html> 
	<head> 
		<title>Detalle de registro de orden de trabajo</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0"> 
		<?php include('../def/jquery.library_maestro.php');?>
		<script type="text/javascript">
			$(function(){
				/**
				 * Boton Impresion de Orden
				 */
				$('#imprimirot').button({ icons: { primary: "ui-icon-print" } }).click(function() {
					window.open("imprimirot.php?codigo=<?php echo $sbreg[ordtracodigo]; ?>","impresion","width=800, height=650, scrollbars=yes");
					return false;
				});
			});
		</script>
	</head>
<?php if(!$codigo){ echo "<!--";} ?>
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Orden de trabajo</font></p> 
			<table border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content" width="700">
  				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr> 
  				<tr><td class="ui-widget-header"><span class="style5"><font color="FFFFFF"> Detallar registro</font></span></td></tr>
  				<tr>
					<td>
						<table width="98%" border="0" cellspacing="0" cellpadding="0" align="center">
							<tr><td class="ui-state-default"><small><strong>&nbsp;Generada por:</strong>&nbsp;<?php echo $usuariogen[usuanombre]."&nbsp;".$usuariogen[usuapriape]."&nbsp;".$usuariogen[usuasegape] ?>&nbsp;---&nbsp;<?php echo strfecha(date("Y-m-d", strtotime($sbreg['ordtrafecgen'])))  ?></small></td></tr>
						</table>
					</td>
				</tr> 
  				<tr>
					<td>
						<table width="98%" border="0" cellspacing="0" cellpadding="0" align="center">
							<tr>
								<td class="ui-state-default" width="15%">&nbsp;<small>Estado inicial</small></td>
								<td class="ui-state-default" width="20%">&nbsp;<small><?php echo $sbregotestadonom ?></small></td>
								<td width="30%">&nbsp;</td>
								<td class="ui-state-default" width="15%">&nbsp;<small>Estado actual</small></td>
								<td class="ui-state-default" width="20%">&nbsp;<small style="color:red;"><?php echo $rsOtestado['otestanombre'] ?></small></td>
							</tr>
						</table>
					</td>
				</tr> 
				<tr>
  					<td>
  						<table width="98%" border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content">
						  	<tr>
						  		<td class="NoiseFooterTD" width="20%">&nbsp;Orden No.</td>
						  		<td class="NoiseDataTD" width="30%">&nbsp;<b><?php echo $sbreg[ordtracodigo]; ?></b></td>
								<td class="NoiseFooterTD" width="20%">&nbsp;Ubicaci&oacute;n</td>
								<td class="NoiseDataTD" width="30%">&nbsp;<?php echo $sbregplannom; ?></td>
							</tr>
							<tr>
  								<td class="NoiseFooterTD">&nbsp;Proceso</td>
								<td class="NoiseDataTD">&nbsp;<?php echo $sbregsistnom; ?></td>
								<td class="NoiseFooterTD">&nbsp;Equipo</td>
								<td class="NoiseDataTD">&nbsp;<?php echo $sbregequinom; ?></td>
							</tr>
							<tr>
								<td class="NoiseFooterTD">&nbsp;Sistema</td>
								<td class="NoiseDataTD">&nbsp;<?php echo "-"; ?></td>
								<td class="NoiseFooterTD">&nbsp;Componente</td>
								<td class="NoiseDataTD">&nbsp;<?php echo $sbregcompnomb; ?></td>
							</tr>
						</table>
					</td>
				</tr>
				<?php if($sbregsolserco): ?>
				<tr>
					<td>
						<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
							<tr><td class="ui-state-default" colspan="3">&nbsp;Datos de la Solicitud</td></tr>
							<?php 
      							$texto = split("::", $sbregsolsermo);
      							$contador = count($texto);
      							
      							for ($i = 0; $i < $contador; $i++):
		      						if($texto[$i]):
										$texto1 = split("--",$texto[$i] );
      						?>
							<tr>
								<td width="20%" class="NoiseFooterTD">&nbsp;Usuario</td>
								<td colspan="2" class="NoiseDataTD">&nbsp;<?php echo $texto1[0] ?></td>
							</tr>
							<tr>
								<td class="ui-state-default" width="15%"><small>Fecha</small></td>
								<td class="ui-state-default" width="10%"><small>Hora</small></td>
								<td class="ui-state-default" width="75%"><small>Descripci&oacute;n</small></td>
							</tr>
							<tr>
								<td class="NoiseDataTD">&nbsp;<?php echo $texto1[1] ?></td>
								<td class="NoiseDataTD">&nbsp;<?php echo $texto1[2] ?></td>
								<td class="NoiseDataTD">&nbsp;<?php echo $texto1[3] ?></td>
							</tr>
							<tr><td class="ui-state-default" colspan="3"></td></tr>
							<?php	endif; 
								endfor ?>
						</table>
					</td>
				</tr>
				<?php endif ?>
				<tr>
  					<td>
  						<table width="98%" border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content">
 							<tr>
 								<td class="NoiseFooterTD" width="20%" >&nbsp;Fecha de Ejecuci&oacute;n</td>
 								<td class="NoiseDataTD" width="30%">&nbsp;<?php echo date("Y-m-d h:i a", strtotime($sbreg['ordtrafecini'].' '.$sbreg['ordtrahorini'])) ?> A-M-D</td>
 								<td class="NoiseFooterTD" width="20%" >&nbsp;Estimado a finalizar</td>
 								<td class="NoiseDataTD" width="30%">&nbsp;<?php echo date("Y-m-d h:i a", strtotime($sbreg['ordtrafecfin'].' '.$sbreg['ordtrahorfin'])) ?></td>
 							</tr>
 						</table>
 					</td>
 				</tr>
				<tr>
  					<td>
  						<table width="98%" border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content">
 							<tr>
 								<td class="NoiseFooterTD" width="20%" >&nbsp;Tipo de Falla </td>
 								<td class="NoiseDataTD" width="80%">&nbsp;<?php echo $sbregtipfalnombre; ?></td>
 							</tr>
 							<tr><td class="ui-state-default" colspan="2"></td></tr>
 							<tr><td class="NoiseFooterTD" colspan="2">&nbsp;Descripci&oacute;n</td></tr>
 							<tr><td class="NoiseDataTD" colspan="2">&nbsp;<?php echo $sbreg[ordtradescri]; ?></td></tr>
 						</table>
 					</td>
 				</tr>
 				<tr>
  					<td>
  						<table width="98%" border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content">
 							<tr>
 								<td class="NoiseFooterTD" width="20%">&nbsp;Mantenimiento</td>
 								<td class="NoiseDataTD" width="30%">&nbsp;<?php echo $sbregtipmanom; ?></td>
 								<td class="NoiseFooterTD" width="20%">&nbsp;Prioridad</td>
 								<td class="NoiseDataTD" width="30%">&nbsp;<?php echo $sbregpriornom; ?></td>
 							</tr>
 							<tr>
 								<td class="NoiseFooterTD">&nbsp;Tipo de Trabajo</td>
  								<td class="NoiseDataTD">&nbsp;<?php echo $sbregtipotnom; ?></td>
  								<td class="NoiseFooterTD">&nbsp;Tarea</td>
  								<td class="NoiseDataTD">&nbsp;<?php echo $sbregtareanom; ?></td>
  							</tr>
  							<tr><td class="ui-state-default" colspan="4"></td></tr>
  							<tr><td class="NoiseFooterTD" colspan="4">&nbsp;Descripci&oacute;n del Trabajo a Realizar</td></tr>
  							<tr><td class="NoiseDataTD" colspan="4">
  							<?php 
  								$datosdetarea = explode(".", $sbregtarnota);
  								$cantdatos = count($datosdetarea);
  								
  								for ($j = 0; $j < $cantdatos; $j++)
  									echo "&nbsp;[&nbsp;&nbsp;&nbsp;]".$datosdetarea[$j]."<br>";
  							?>
  							</td></tr>
 						</table>
 					</td>
				</tr>
				<tr>
  					<td>
  						<table width="98%" border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content">
  							<tr><td class="ui-state-default" colspan="2">&nbsp;Funcionarios involucrados</td></tr>
							<tr>
 								<td class="NoiseFooterTD" width="20%">&nbsp;Encargado</td>
 								<td class="NoiseErrorDataTD" width="80%">&nbsp;<?php echo $sbregusuanom; ?></td>
 							</tr>
    						<tr>
      							<td class="NoiseFooterTD">&nbsp;Auxiliares de Mantenimiento </td>
      							<td class="NoiseDataTD">&nbsp;
      							<?php
	      							if (!$flagdetallarot)
	      							{
	      								include('../src/FunGen/floadusuaaux.php');
	      								$idcon = fncconn();
	      								floadusuaaux($sbregusuaselec,$idcon);
	      								fncclose($idcon);
	      							}
	   							?>
	  							</td>
    						</tr>
						</table>
					</td>
				</tr>
				<tr>
  					<td>
  						<table width="98%" border="0" cellspacing="1" cellpadding="1" align="center">
  							<tr>
  								<td class="ui-state-default" width="45%">&nbsp;Herramientas</td>
  								<td width="10%">&nbsp;</td>
  								<td class="ui-state-default" width="45%">&nbsp;Item's</td>
  							</tr>
							<tr>
		    					<td class="NoiseDataTD"><?php
		    						if (!$flagdetallarot)
		    						{
							    		include('../src/FunGen/floadtransacherramie.php');
							    		$idcon = fncconn();
							    		floadtransacherramie($idcon,$herrseleccodi,$herrseleccant);
							    		fncclose($idcon);
							    	}
	    						?></td>
	    						<td>&nbsp;</td>
		    					<td class="NoiseDataTD"><?php
		    						if (!$flagdetallarot)
							    	{
							    		include('../src/FunGen/floadtransacitem.php');
							    		$idcon = fncconn();
							    		floadtransacitem($idcon,$itemseleccodi,$itemseleccant);
							    		fncclose($idcon);
							    	}
	    						?></td>
		    				</tr>
		    			</table>
		    		</td>
			  	</tr>
			  	<tr><td>&nbsp;</td></tr>
				<tr>
					<td class="NoiseErrorDataTD" align="center"><div class="ui-buttonset">
						<button id="aceptar">Aceptar</button>&nbsp;&nbsp;&nbsp;&nbsp;
						<button id="imprimirot">Imprimir Orden</button>
					</div></td>
				</tr>
				<tr><td>&nbsp;</td></tr> 
				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr> 
 				<tr>
			</table>
 			<input type="hidden" name="flagdetallarot" value="1">
			<input type="hidden" name="acciondetallarot">
			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>">
			<input type="hidden" name="sourceaction" value="detallar">
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>">
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
			<input type="hidden" name="ordtracodigo" value="<?php if($accionconsultarot) echo $ordtracodigo; ?>">
			<input type="hidden" name="plantacodigo" value="<?php if($accionconsultarot) echo $plantacodigo; ?>">
			<input type="hidden" name="sistemcodigo" value="<?php if($accionconsultarot) echo $sistemcodigo; ?>">
			<input type="hidden" name="equipocodigo" value="<?php if($accionconsultarot) echo $equipocodigo; ?>">
			<input type="hidden" name="tipmancodigo" value="<?php if($accionconsultarot) echo $tipmancodigo; ?>">
			<input type="hidden" name="ordtrafecini" value="<?php if($accionconsultarot) echo $ordtrafecini; ?>">
			<input type="hidden" name="ordtrahorini" value="<?php if($accionconsultarot) echo $ordtrahorini; ?>">
			<input type="hidden" name="ordtrafecfin" value="<?php if($accionconsultarot) echo $ordtrafecfin; ?>">
			<input type="hidden" name="ordtrahorfin" value="<?php if($accionconsultarot) echo $ordtrahorfin; ?>">
			<input type="hidden" name="tiptracodigo" value="<?php if($accionconsultarot) echo $tiptracodigo; ?>">
			<input type="hidden" name="tareacodigo" value="<?php if($accionconsultarot) echo $tareacodigo; ?>">
			<input type="hidden" name="usutarcodigo" value="<?php if($accionconsultarot) echo $usutarcodigo; ?>">
			<input type="hidden" name="usuacodigo" value="<?php if($accionconsultarot) echo $usuacodigo; ?>">
			<input type="hidden" name="usuanombre" value="<?php if($accionconsultarot) echo $usuanombre; ?>">
			<input type="hidden" name="equiponombre" value="<?php if($accionconsultarot) echo $equiponombre; ?>">
			<input type="hidden" name="equipocodigocmbx" value="<?php if($accionconsultarot) echo $equipocodigocmbx; ?>">
			<input type="hidden" name="filterindex" value="<?php if($accionconsultarot) echo $filterindex; ?>">
			<input type="hidden" name="tipfallcodigo" value="<?php if($accionconsultarot) echo $tipfallcodigo; ?>">
			<input type="hidden" name="prioricodigo" value="<?php if($accionconsultarot) echo $prioricodigo; ?>">
			<input type="hidden" name="accionconsultarot"	value="<?php  echo $accionconsultarot; ?>">
		</form>
	</body>
<?php if(!$codigo){ echo " -->"; } ?>
</html>
