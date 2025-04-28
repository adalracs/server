<?php
	/**
	 * Propiedad intelectual de Adsum (c).
	 * Todos los derechos reservados
	 * 
	 * Nombre: 		detallaotprogramacionprint.php
	 * Fecha: 		20-jun-2008
	 * 
	 */
	include ('../src/FunPerSecNiv/fncconn.php');
	include ('../src/FunPerSecNiv/fncnumreg.php');
	include ('../src/FunPerSecNiv/fncfetch.php');
	include ('../src/FunGen/cargainput.php');
	// Convierte una orden de trabajo en PDF
	require_once('../src/FunPrint/html2fpdf.php');
	include ('../src/FunGen/fnccargapresentac.php');
	include ('../src/FunPerSecNiv/fncsqlrun.php');
	
	include ('../src/FunPerPriNiv/pktblusuario.php');
	include ('../src/FunPerPriNiv/pktblsistema.php');
	include ('../src/FunPerPriNiv/pktblequipo.php');
	include ('../src/FunPerPriNiv/pktblcomponen.php');
	include ('../src/FunPerPriNiv/pktbltipomant.php');
	include ('../src/FunPerPriNiv/pktbltipotrab.php');
	include ('../src/FunPerPriNiv/pktbltarea.php');
	include ('../src/FunPerPriNiv/pktblpriorida.php');
	

	$idcon = fncconn();
	
	
	$sbSql = "	SELECT DISTINCT ot.ordtrafecini, ot.ordtrahorini FROM ot WHERE ot.ordtranumpro = '{$ordtranumpro}'";
	$rsOtone = fncsqlrun($sbSql, $idcon);
	$rwOtone = fncfetch($rsOtone, 0);
	
	$sbSql = "	SELECT DISTINCT planta.*, ot.ordtrafecini, ot.ordtrahorini FROM ot LEFT JOIN planta ON planta.plantacodigo = ot.plantacodigo WHERE ot.ordtranumpro = '{$ordtranumpro}'";
	$rsPlantas = fncsqlrun($sbSql, $idcon);
	$nrPlantas = fncnumreg($rsPlantas);
		
	$sbSqlListOT = "SELECT * FROM ot LEFT JOIN tareot ON tareot.ordtracodigo = ot.ordtracodigo AND tareot.tareotsecuen = '0' WHERE ot.ordtranumpro = '{$ordtranumpro}' AND ot.plantacodigo = '[plantacodigo]'";
	
	$sbSqlUsua = "SELECT DISTINCT usuariotareot.usuacodi, usuariotareot.usutarlider FROM ot LEFT JOIN tareot ON tareot.ordtracodigo = ot.ordtracodigo AND tareot.tareotsecuen = '0' LEFT JOIN usuariotareot ON usuariotareot.tareotcodigo = tareot.tareotcodigo WHERE ot.ordtranumpro = '{$ordtranumpro}'";
	$rsUsua = fncsqlrun($sbSqlUsua, $idcon);
	$nrUsua = fncnumreg($rsUsua);
	$arregloauxusuario = array();
	
	for($i = 0; $i < $nrUsua; $i++):
		$rwUsua = fncfetch($rsUsua, $i);
		
		if($rwUsua['usutarlider'] == 't' || $rwUsua['usutarlider'] == '1' )
			$encargado = cargausuanombre($rwUsua['usuacodi'], $idcon);
		else
			$arregloauxusuario[] = cargausuanombre($rwUsua['usuacodi'], $idcon);
	endfor;	
?>
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<title>Orden de trabajo programada # <?php echo $ordtranumpro ?></title>
		<?php include('../def/jquery.library_maestro.php');?>
		<style type="text/css">
			<!--
			.head-title-report {font-family: Arial, Helvetica, sans-serif; font-size: 12px;}
			.head-title-table {font-family: Arial, Helvetica, sans-serif; font-size: 10px;}
			.tick-title-report, .cont-table-report {font-family: Arial, Helvetica, sans-serif; font-size: 10px;}
			.tick-title-report-alt {font-family: Arial, Helvetica, sans-serif; font-size: 11px;}
			
			
			.borde-tabla {border-right: 1px solid #2F2F2F; border-bottom: 1px solid #2F2F2F;}
			.borde-cell {border-top: 1px solid #2F2F2F; border-left: 1px solid #2F2F2F;}
			.borde-line {border-top: 1px solid #2F2F2F;}
			.borde-down {border-bottom: 1px solid #2F2F2F;}
			.saltopagina{ PAGE-BREAK-AFTER: always; }
			
			.Estilo6 {font-size: 14px; }
			.back-sty {background-color: #F2F2F2; }
			.currency-align { text-align:right; }
			-->
		</style>
	</head>
<!--	--> 
	<body onLoad="window.print()">
		<table width="800" border="0" cellpadding="1" cellspacing="0" align="center">
			<tr>
    			<th scope="col">
    				<table width="100%" border="0" cellpadding="2" cellspacing="0" class="borde-tabla">
      					<tr>
        					<td width="20%" rowspan="2" align="center" class="borde-cell"><img src="../img/adsumcuasipequeno.jpg" ></td>
        					<td width="80%" class="borde-cell head-title-report" align="center"><b>GESTION DE MANTENIMIENTO</b></td>
      					</tr>
      					<tr><td class="borde-cell head-title-report" align="center"><b>ORDEN DE TRABAJO PROGRAMADA</b></td></tr>
    				</table>
    			</th>
  			</tr>
    		<tr><td>&nbsp;</td></tr>
 			<tr>
  				<th scope="col">
	  				<table width="100%" border="0" cellpadding="1" cellspacing="1">
	  					<tr><td colspan="2"></td></tr>
	  					<tr>
			    			<td width="20%"  class="borde-down"><span class="tick-title-report">OTP No.:&nbsp;<b>
			    			<?php 
			              		if(strlen($ordtranumpro)== 1) echo "00000".$ordtranumpro;
			              		if(strlen($ordtranumpro)== 2) echo "0000".$ordtranumpro;
			              		if(strlen($ordtranumpro)== 3) echo "000".$ordtranumpro;
			              		if(strlen($ordtranumpro)== 4) echo "00".$ordtranumpro;
			              		if(strlen($ordtranumpro)>= 5) echo "0".$ordtranumpro; 
			              		if(strlen($ordtranumpro)>= 6) echo $ordtranumpro;
				              ?>
			    			</b></span></td>
			    		</tr>
		    		</table>
    			</th>
  			</tr>    		
    		<tr>
    			<th scope="col">
      				<table width="400" border="0" cellspacing="1" cellpadding="1" align="left">
						<tr>
	  						<td width="100" class="tick-title-report">&nbsp;Fecha de Ejecuci&oacute;n</td>
	  						<td width="300" class="tick-title-report">&nbsp;<?php if ($rwOtone['ordtrafecini']){ echo $rwOtone['ordtrafecini'].' '.date("h:i a",strtotime($rwOtone['ordtrahorini'])); }else {echo "No hay datos";}?> <b class="table-detall">aaaa-mm-dd hh:mm am/pm</b></td>
    					</tr>
					</table>
				</th>
			</tr>
        	<tr>
    			<th scope="col">
      				<table width="650" border="0" cellspacing="1" cellpadding="1" align="left">
    					<tr>
   							<td width="150" class="tick-title-report">&nbsp;Encargado</td>
   							<td width="500" class="tick-title-report">&nbsp;<?php echo $encargado; ?></td>
 						</tr>
 						<?php if($arregloauxusuario): ?>
    					<tr>
      						<td class="tick-title-report" valign="top">&nbsp;Auxiliares de mantenimiento</td>
        					<td class="tick-title-report">&nbsp;<?php
								for($i = 0; $i < count($arregloauxusuario); $i++)
									if($i < (count($arregloauxusuario)-1)) echo $arregloauxusuario[$i]."<br>&nbsp;"; else echo $arregloauxusuario[$i]; 
							?></td>
  						</tr>
  						<?php endif; ?>
					</table>
				</th>
			</tr>
  			<?php 
        		for($a = 0; $a < $nrPlantas; $a++):
        			$rwPlantas = fncfetch($rsPlantas, $a);
        	?>
  			<tr>
  				<th scope="col">
  					<table width="100%" border="0" cellspacing="0" cellpadding="1">
      					<tr><td width="20%" class="borde-line"><span class="cont-table-report">&nbsp;Ubicaci&oacute;n:&nbsp;&nbsp;<?php echo $rwPlantas['plantanombre']; ?></span></td></tr>
		    		</table>
    			</th>
  			</tr>
  			<tr>
	    		<th scope="col">
	      			<table border="0" width="100%" align="center" cellpadding="0" cellspacing="1">
	      				<tr>
	      					<td>
			  					<table width="100%" border="0" cellspacing="0" cellpadding="1" class="borde-tabla">
			      					<tr><td width="20%" class="borde-cell" align="center"><span class="cont-table-report">&nbsp;Lista de Ordenes de Trabajo</span></td></tr>
					    		</table>
		    				</td>
		    			</tr>
		    			<tr>
	      					<td>
			  					<table width="100%" border="0" cellspacing="0" cellpadding="1" class="borde-tabla">
	  								<tr>
				  						<td class="head-title-table borde-cell borde-down">No. OT</td>
						  			  	<td class="head-title-table borde-cell borde-down">Sistema</td>
						  			  	<td class="head-title-table borde-cell borde-down">Equipo</td>
<!--							  			  	<td class="head-title-table borde-cell">Componente</td>-->
						  			  	<td class="head-title-table borde-cell borde-down">Dur. OT</td>
						  			  	<td class="head-title-table borde-cell borde-down">Mantenimiento</td>
						  			  	<td class="head-title-table borde-cell borde-down">Tipo Trabajo</td>
						  			  	<td class="head-title-table borde-cell borde-down">Tarea</td>
						  			  	<td class="head-title-table borde-cell borde-down">Descripci&oacute;n Tarea</td>
						  			  	<td class="head-title-table borde-cell borde-down">Prioridad</td>
					  			    </tr>
									<?php 
										$rsOt = fncsqlrun(str_replace('[plantacodigo]', $rwPlantas['plantacodigo'], $sbSqlListOT), $idcon);
										$nrOt = fncnumreg($rsOt);

										for($b = 0; $b < $nrOt; $b++):
											$rwOt = fncfetch($rsOt, $b);

											if(!$ordtrafecha) $ordtrafecha = date("Y-m-d h:i a",strtotime($rwOt['ordtrafecini'].' '.$rwOt['ordtrahorini'])); 
											($class == "#f0f0f0") ? $class = "#fff" : $class = "#f0f0f0";
											
											$rsEquipo = loadrecordequipo($rwOt['equipocodigo'], $idcon);
											(trim($rsEquipo[equipodescri])) ? $equiponombre = $rsEquipo['equiponombre'].' / '.$rsEquipo['equipodescri'] : $equiponombre = $rsEquipo['equiponombre']; 
											
									?>
									<tr style="background-color: <?php echo $class ?>">
										<td class="cont-table-report borde-cell"><?php echo $rwOt['ordtracodigo'] ?></td>
										<td class="cont-table-report borde-cell"><?php echo cargasistemnombre($rwOt['sistemcodigo'], $idcon) ?></td>
										<td class="cont-table-report borde-cell"><?php echo $equiponombre ?></td>
										<td class="cont-table-report borde-cell"><?php echo $rwOt['tareottiedur'] ?> hr.</td>
										<td class="cont-table-report borde-cell"><?php echo cargatipmannombre1($rwOt['tipmancodigo'], $idcon) ?></td>
										<td class="cont-table-report borde-cell"><?php echo cargatiptrabnombre($rwOt['tiptracodigo'], $idcon) ?></td>
										<td class="cont-table-report borde-cell"><?php echo cargatareanombre1($rwOt['tareacodigo'], $idcon) ?></td>
										<td class="cont-table-report borde-cell"><?php echo $rwOt['tareotnota'] ?></td>
										<td class="cont-table-report borde-cell"><?php echo cargapriorinombre($rwOt['prioricodigo'], $idcon) ?></td>
									</tr>
									<?php endfor ?>											
								</table>			
							</td>
						</tr>
					</table>
        		</th>
        	</tr>
        	<tr><td></td></tr>
        	<?php endfor; ?>
  			<tr>
    			<th scope="col">
      				<table border="0" width="100%" align="center" cellpadding="0" cellspacing="1">
        				<tr><td class="tick-title-report">&nbsp;<b>Comentarios de seguridad</b> Utilizar Todos los elementos de seguridad como casco, guantes, gafas, botas con puntera, cinturon ergonomico, protectores auditivos</td></tr>
        			</table>
        		</th>
        	</tr>
			<tr><th scope="col" align="left"><span class="tick-title-report-alt"><b>Observaciones</b></span></th></tr>
			<tr>
    			<th scope="col">
      				<table width="100%" border="0" cellpadding="4" cellspacing="0" class="borde-tabla">
        				<tr><td class="borde-cell">&nbsp;</td></tr>
        				<tr><td class="borde-cell">&nbsp;</td></tr>
        				<tr><td class="borde-cell">&nbsp;</td></tr>
        				<tr><td class="borde-cell">&nbsp;</td></tr>
        				<tr><td class="borde-cell">&nbsp;</td></tr>
        				<tr><td class="borde-cell">&nbsp;</td></tr>
        				<tr><td class="borde-cell">&nbsp;</td></tr>
        				<tr><td class="borde-cell">&nbsp;</td></tr>
        				<tr><td class="borde-cell">&nbsp;</td></tr>
      				</table>
      			</th>
  			</tr>
  			<tr><th>&nbsp;</th></tr>
  			<tr><th>&nbsp;</th></tr>
    		<tr>
    			<th scope="col">
    				<table width="100%" border="0" cellpadding="0" cellspacing="0">
      					<tr>
        					<td width="15%"><span class="tick-title-report-alt">Firma solicitante:</span></td>
        					<td width="30%" class="borde-down">&nbsp;</td>
        					<td width="10%">&nbsp;</td>
        					<td width="15%"><span class="tick-title-report-alt">Firma trabajador:</span></td>
        					<td width="30%" class="borde-down">&nbsp;</td>
      					</tr>
      					<tr><td colspan="5">&nbsp;</td></tr>
      					<tr><td colspan="5">&nbsp;</td></tr>
      					<tr><td colspan="5">&nbsp;</td></tr>
      					<tr><td colspan="5">&nbsp;</td></tr>
      					<tr>
        					<td><span class="tick-title-report-alt">Recibe ingeniero de mantenimiento:</span></td>
        					<td class="borde-down">&nbsp;</td>
        					<td>&nbsp;</td>
        					<td><span class="tick-title-report-alt">Enterado ingeniero de operaci&oacute;n y/o operador planta:</span></td>
        					<td width="30%" class="borde-down">&nbsp;</td>
      					</tr>
    				</table>
    			</th>
    		</tr>
        </table>
	</body>
</html>