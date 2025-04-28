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
	
	$nuConn = fncconn();

	$idcon = fncconn();
	$sbSql = "	SELECT DISTINCT planta.* FROM ot LEFT JOIN planta ON planta.plantacodigo = ot.plantacodigo WHERE ot.ordtranumpro = '{$ordtranumpro}'";
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
//	
//	$sbSql = "	SELECT 
//					herramie.herramnombre, transacherramie.transhercanti 
//				FROM (tareotherramie INNER JOIN transacherramie ON tareotherramie.transhercodigo = transacherramie.transhercodigo) INNER JOIN herramie ON transacherramie.herramcodigo = herramie.herramcodigo 
//				WHERE tareotherramie.tareotcodigo = "."'".$sbListaprogram[0]["tareotcodigo"]."'";
//
//	$nuResult = pg_exec($nuConn,$sbSql);
//	unset($sbSql);
//	
//	if ($nuResult)
//	{   
//		$k=0;
//		while ($row = pg_fetch_array($nuResult)) 
//		{
//			$arregloherr[$k]= $row["herramnombre"]." ".$row["transhercanti"];
//			$k++;
//		}
//	}
//
//	$sbSql = "	SELECT 
//					item.itemnombre, transacitem.transitecantid 
//				FROM (itemtareot INNER JOIN transacitem ON itemtareot.transitecodigo = transacitem.transitecodigo) INNER JOIN item ON transacitem.itemcodigo = item.itemcodigo 
//				WHERE itemtareot.tareotcodigo = "."'".$sbListaprogram[0]["tareotcodigo"]."'";
//
//	$nuResult = pg_exec($nuConn,$sbSql);
//	unset($sbSql);
//	
//	if ($nuResult)
//	{ 
//		$l=0;
//		while ($row = pg_fetch_array($nuResult)) 
//		{
//			$arregloitem[$l]= $row["itemnombre"]." ".$row["transitecantid"];
//			$l++;
//		}
//	}
?>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<title>Ordenes Programadas</title>
		<meta http-equiv="expires" content="0">
		<?php include('../def/jquery.library_maestro.php');?>
		<script type="text/javascript">
			$(function(){
				$('#imprimirotp').button({icons: { primary: "ui-icon-print" }}).click(function(){
					document.form1.action = "imprimirotp.php";
					document.form1.submit();
					return false;
				});
			});
		
		</script>
		<style type="text/css">
			<!--
			.head-table-detall {font-size:90%;}
			.table-detall {font-size:11px;}
			.Estilo1 {font-family: Arial, Helvetica, sans-serif}
			.Estilo4 {font-family: Tahoma}
			.Estilo7 {font-size: 12px}
			.Estilo8 {
				font-family: Tahoma;
				font-size: 12px;
				font-weight: bold;
			}
			.Estilo9 {font-family: Tahoma; font-size: 12px; }
			.Estilo11 {font-size: 12}
			.Estilo12 {font-family: Tahoma; font-size: 12; }
			-->
		</style>
	</head>
	<body bgcolor="FFFFFF" text="#000000">
		<form name="form1" method="post"  enctype="multipart/form-data">
			<table border="0" align="center" cellpadding="1" cellspacing="1" width="98%">
  				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr>
  				<tr><th scope="col"><img src="../img/adsumcuasipequeno.jpg" alt="Adsum" align="left"></th></tr>
  				<tr>
    				<th scope="col">
      					<table border="0" width="100%" align="center" cellpadding="1" cellspacing="1">
        					<tr><td height="5" class="ui-state-default"></td></tr>
        				</table>
        			</th>
        		</tr>
        		<tr>
    				<th scope="col">
      					<table border="0" width="100%" align="center" cellpadding="1" cellspacing="1">
        					<tr><td class="ui-widget-header" colspan="2">&nbsp;Orden Programada</td></tr>
        					<tr>
		  						<td class="ui-widget-header" colspan="2">&nbsp;OTP -&nbsp;<b>
								<?php 
				              		if(strlen($ordtranumpro)== 1) echo "00000".$ordtranumpro;
				              		if(strlen($ordtranumpro)== 2) echo "0000".$ordtranumpro;
				              		if(strlen($ordtranumpro)== 3) echo "000".$ordtranumpro;
				              		if(strlen($ordtranumpro)== 4) echo "00".$ordtranumpro;
				              		if(strlen($ordtranumpro)>= 5) echo "0".$ordtranumpro; 
				              		if(strlen($ordtranumpro)>= 6) echo $ordtranumpro;
					              ?>
								</b></td>
  							</tr>
 						</table>
        			</th>
        		</tr>
        		<?php 
        			for($a = 0; $a < $nrPlantas; $a++):
        				$rwPlantas = fncfetch($rsPlantas, $a);
        		?>
        		<tr>
    				<th scope="col">
      					<table border="0" width="100%" align="center" cellpadding="0" cellspacing="1">
      						<tr>
 								<td class="ui-widget-header" width="15%">&nbsp;Ubicaci&oacute;n</td>
 								<td class="NoiseDataTD" width="85%">&nbsp;<?php echo $rwPlantas['plantanombre']; ?></td>
 							</tr>
 							<tr><td colspan="2"></td></tr>
							<tr><td colspan="2" class="ui-state-default" align="center">Lista de Ordenes de Trabajo</td></tr>
							<tr>		  
								<td colspan="2">
									<table width="100%" border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content">
		  								<tr>
					  						<td class="ui-state-default head-table-detall">No. OT</td>
							  			  	<td class="ui-state-default head-table-detall">Sistema</td>
							  			  	<td class="ui-state-default head-table-detall">Equipo</td>
<!--							  			  	<td class="ui-state-default head-table-detall">Componente</td>-->
							  			  	<td class="ui-state-default head-table-detall">Dur. OT</td>
							  			  	<td class="ui-state-default head-table-detall">Mantenimiento</td>
							  			  	<td class="ui-state-default head-table-detall">Tipo Trabajo</td>
							  			  	<td class="ui-state-default head-table-detall">Tarea</td>
							  			  	<td class="ui-state-default head-table-detall">Descripci&oacute;n Tarea</td>
							  			  	<td class="ui-state-default head-table-detall">Prioridad</td>
							  			  	<td class="ui-state-default head-table-detall">Imprimir OT</td>
						  			    </tr>
										<?php 
											$rsOt = fncsqlrun(str_replace('[plantacodigo]', $rwPlantas['plantacodigo'], $sbSqlListOT), $idcon);
											$nrOt = fncnumreg($rsOt);

											for($b = 0; $b < $nrOt; $b++):
												$rwOt = fncfetch($rsOt, $b);

												if(!$ordtrafecha) $ordtrafecha = date("Y-m-d h:i a",strtotime($rwOt['ordtrafecini'].' '.$rwOt['ordtrahorini'])); 
												($class == "NoiseFooterTD") ? $class = "NoiseDataTD" : $class = "NoiseFooterTD";
												
												$rsEquipo = loadrecordequipo($rwOt['equipocodigo'], $idcon);
												(trim($rsEquipo[equipodescri])) ? $equiponombre = $rsEquipo['equiponombre'].' / '.$rsEquipo['equipodescri'] : $equiponombre = $rsEquipo['equiponombre']; 
												
										?>
										<tr class="<?php echo $class ?>">
											<td class="table-detall"><?php echo $rwOt['ordtracodigo'] ?></td>
											<td class="table-detall"><?php echo cargasistemnombre($rwOt['sistemcodigo'], $idcon) ?></td>
											<td class="table-detall"><?php echo $equiponombre ?></td>
											<td class="table-detall"><?php echo $rwOt['tareottiedur'] ?> hr.</td>
											<td class="table-detall"><?php echo cargatipmannombre1($rwOt['tipmancodigo'], $idcon) ?></td>
											<td class="table-detall"><?php echo cargatiptrabnombre($rwOt['tiptracodigo'], $idcon) ?></td>
											<td class="table-detall"><?php echo cargatareanombre1($rwOt['tareacodigo'], $idcon) ?></td>
											<td class="table-detall"><?php echo $rwOt['tareotnota'] ?></td>
											<td class="table-detall"><?php echo cargapriorinombre($rwOt['prioricodigo'], $idcon) ?></td>
											<td class="table-detall"><a href="javascript: void(0);" onclick="window.open('imprimirot.php?codigo=<?php echo $rwOt['ordtracodigo'] ?>','impresion','width=800, height=650, scrollbars=yes');"><b>Imprimir</b></a></td>
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
      					<table width="100%" border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content">
							<tr>
		  						<td width="15%" class="NoiseFooterTD">&nbsp;Fecha de Ejecuci&oacute;n</td>
		  						<td width="85%" class="NoiseDataTD">&nbsp;<?php if ($ordtrafecha){ echo $ordtrafecha; }else {echo "No hay datos";}?> <b class="table-detall">aaaa-mm-dd hh:mm am/pm</b></td>
	    					</tr>
						</table>
					</th>
				</tr>
        		<tr>
    				<th scope="col">
      					<table width="100%" border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content">
    						<tr>
 	  							<td width="15%" class="ui-state-default">&nbsp;Encargado</td>
 	  							<td width="85%" class="NoiseDataTD">&nbsp;<?php echo $encargado; ?></td>
 							</tr>
    						<tr>
      							<td class="ui-state-default">&nbsp;Auxiliares de mantenimiento</td>
        						<td class="NoiseDataTD">&nbsp;
          						<?php
									for($i = 0; $i < count($arregloauxusuario); $i++)
										if($i < (count($arregloauxusuario)-1)) echo $arregloauxusuario[$i]."<br>&nbsp;"; else echo $arregloauxusuario[$i]; 
								?>
        						</td>
  							</tr>
						</table>
					</th>
				</tr>
        		<tr>
    				<th scope="col">
      					<table border="0" width="100%" align="center" cellpadding="0" cellspacing="1">
        					<tr><td class="NoiseDataTD table-detall">&nbsp;<b>Comentarios de seguridad</b> Utilizar Todos los elementos de seguridad como casco, guantes, gafas, botas con puntera, cinturon ergonomico, protectores auditivos</td></tr>
        				</table>
        			</th>
        		</tr>
        		<tr>
    				<th scope="col">
      					<table border="0" width="100%" align="center" cellpadding="0" cellspacing="1">
							<tr>
	  							<td width="50%" class="ui-state-default">&nbsp;Herramientas</td>
	  							<td width="50%" class="ui-state-default">&nbsp;Item</td>
							</tr>
							<tr>
	  							<td class="NoiseDataTD">&nbsp;
	  							<?php
								  	if ($arregloherr){
								  		for ($j=0; $j < count($arregloherr); $j++){
											echo $arregloherr[$j]."<br>";
										}
									}else{ echo "No hay datos";} 
							  	?>
							  	</td>
	  							<td class="NoiseDataTD">&nbsp;
	  							<?php
								    if ($arregloitem){
								  		for ($j=0; $j < count($arregloitem); $j++){
											echo $arregloitem[$j]."<br>";
										}
									}else{ echo "No hay datos";} 
      							?>
      							</td>
							</tr>
  						</table>
  					</th>
    			</tr>
    			<tr><td>&nbsp;</td></tr>
				<tr>
					<td class="NoiseErrorDataTD" align="center">
						<div class="ui-buttonset">
							<button id="imprimirotp">Imprimir</button>
						</div>
					</td>
				</tr>
				<tr><td>&nbsp;</td></tr> 
				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr>
  			</table>
  			<input name="ordtranumpro" id="ordtranumpro" value="<?php echo $ordtranumpro ?>" type="hidden">
		</form>
	</body>
</html>
