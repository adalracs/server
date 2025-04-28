<?php 

	include( "../src/FunPerPriNiv/pktblreporteoppmaterialpndev.php");
	include( "../src/FunPerPriNiv/pktblreporteoppmaterialdev.php");
	include( "../src/FunPerPriNiv/pktblreporteoppsaldodev.php");
	include( "../src/FunPerPriNiv/pktblreporteopp.php");
	include( "../src/FunPerPriNiv/pktblopestado.php");
	include( "../src/FunPerPriNiv/pktblproveedo.php");
	include( "../src/FunPerPriNiv/pktblitemdesa.php");
	include( "../src/FunPerPriNiv/pktblsoliprog.php");
	include( "../src/FunPerPriNiv/pktblusuario.php");
	include( "../src/FunPerPriNiv/pktblequipo.php");
	include( "../src/FunGen/sesion/fncvalses.php");
	include( "../src/FunPerPriNiv/pktbllote.php");
	include( "../src/FunPerPriNiv/pktblop.php");
	include( "../src/FunGen/cargainput.php");
	
	if(!$flagdetallarreportesaldo) { 		

		include ( "../src/FunGen/sesion/fnccarga.php"); 
		$sbreg = fnccarga($nombtabl,$radiobutton);

		if (!$sbreg) {
			include( "../src/FunGen/fnccontfron.php");
		}

		$idcon = fncconn();

		$kyreportesaldo = $sbreg["kyreportesaldo"];
		$idreportesaldo = $sbreg["idreportesaldo"];
		$kgreportesaldo = $sbreg["kgreportesaldo"];
		$mtreportesaldo = $sbreg["mtreportesaldo"];
		$esreportesaldo = $sbreg["esreportesaldo"];
		$ltreportesaldo = $sbreg["ltreportesaldo"];
		$inreportesaldo = $sbreg["inreportesaldo"];
		$itreportesaldo = $sbreg["itreportesaldo"];
		$opreportesaldo = $sbreg["opreportesaldo"];
		$id = $sbreg["id"];

		switch ($id) {

			case 1:
				$rwReporteoppsaldodev = loadrecordreporteoppsaldodev($kyreportesaldo, $idcon);
				$rwReporteopp = loadrecordreporteopp($rwReporteoppsaldodev["repoppcodigo"], $idcon);
				break;
			case 2:
				$rwReporteoppmaterialpndev = loadrecordreporteoppmaterialpndev($kyreportesaldo, $idcon);
				$rwReporteopp = loadrecordreporteopp($rwReporteoppmaterialpndev["repoppcodigo"], $idcon);
				break;
			case 3:
				$rwReporteoppmaterialdev = loadrecordreporteoppmaterialdev($kyreportesaldo, $idcon);
				$rwReporteopp = loadrecordreporteopp($rwReporteoppmaterialdev["repoppcodigo"], $idcon);
				break;
		}

		$rwOp = loadrecordop1($rwReporteopp["ordoppcodigo"] ,$idcon);
		$rwSoliProg = loadrecordsoliprog($rwOp["solprocodigo"] ,$idcon);

		$repoppcodigo = $rwReporteopp["repoppcodigo"];
		$ordoppcodigo = $rwReporteopp["ordoppcodigo"];
		$opestacodigo = $rwReporteopp["opestacodigo"];
		$repoppfecha = $rwReporteopp["repoppfecha"];
		$repopphora = $rwReporteopp["repopphora"];
		$usuacodigo = $rwReporteopp["usuacodi"];
		$repoppdescri = $rwReporteopp["repoppdescri"];
		$repopptipo = $rwReporteopp["repopptipo"];

		$equipocodigo = $rwOp["equipocodigo"];
		$solprocodigo = $rwSoliProg["solprocodigo"];		
	} 

	$idcon = fncconn();
?>
<html> 
	<head> 
		<title>Detalle de registro de reporte de saldos</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0"> 
		<?php include('../def/jquery.library_maestro.php');?>
	</head> 
<?php if(!$codigo){ echo "<!--";} ?> 
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Saldos</font></p> 
			<table border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content" width="650">
  				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr> 
  				<tr><td class="ui-widget-header"><span class="style5"><font color="FFFFFF"> Detallar registro</font></span></td></tr> 
				<tr> 
  					<td> 
            			<table width="98%" border="0" cellspacing="1" cellpadding="1" align="center"> 
							<tr> 
 								<td width="25%" class="NoiseFooterTD">&nbsp;Item&nbsp;</td> 
  								<td width="75%" class="NoiseDataTD"><?php echo ($itreportesaldo)? carganombitemdesa1($itreportesaldo, $idcon) : "---" ; ?></td>
 							</tr> 							
 							<tr>
								<td width="25%" class="NoiseFooterTD">&nbsp;Kilogramos&nbsp;<b>(kg)</b>&nbsp;</td>
								<td width="75%" class="NoiseDataTD"><?php echo number_format($kgreportesaldo, 2, ",", "."); ?></td>
 							</tr>
 							<tr>
								<td width="25%" class="NoiseFooterTD">&nbsp;Metros&nbsp;<b>(mts)</b>&nbsp;</td>
								<td width="75%" class="NoiseDataTD"><?php echo number_format($mtreportesaldo, 2, ",", "."); ?></td>
 							</tr>
 							<tr>
								<td width="25%" class="NoiseFooterTD">&nbsp;No. Lote&nbsp;</td>
								<td width="75%" class="NoiseDataTD"><?php echo ($ltreportesaldo)? carganumerolote($ltreportesaldo, $idcon) : "---" ; ?></td>
 							</tr>
						</table> 
					</td>
				</tr>
				<tr><td class="ui-widget-header"><span class="style5"><font color="FFFFFF"> Informacion del reporte</font></span></td></tr> 
				<tr> 
  					<td> 
            			<table width="98%" border="0" cellspacing="1" cellpadding="1" align="center"> 
							<tr> 
 								<td width="25%" class="NoiseFooterTD">&nbsp;C&oacute;digo</td> 
  								<td width="75%" class="NoiseDataTD"><?php echo $repoppcodigo; ?></td>
 							</tr>
 							<tr> 
 								<td width="25%" class="NoiseFooterTD">&nbsp;OPP</td> 
  								<td width="75%" class="NoiseDataTD"><?php echo $solprocodigo; ?></td>
 							</tr>
 							<tr> 
 								<td width="25%" class="NoiseFooterTD">&nbsp;Equipo</td> 
  								<td width="75%" class="NoiseDataTD"><b><?php echo ($equipocodigo)? cargaequiponombre($equipocodigo, $idcon) : "---" ; ?><b></td>
 							</tr>
 							<tr> 
 								<td width="25%" class="NoiseFooterTD">&nbsp;Estado</td> 
  								<td width="75%" class="NoiseDataTD"><?php echo ($opestacodigo)? cargaopestanombre($opestacodigo ,$idcon) : "---" ; ?></td>
 							</tr>
 							<tr> 
 								<td width="25%" class="NoiseFooterTD">&nbsp;Fecha</td> 
  								<td width="75%" class="NoiseDataTD"><?php echo ($repoppfecha)? $repoppfecha : "---" ; ?></td>
 							</tr>
 							<tr> 
 								<td width="25%" class="NoiseFooterTD">&nbsp;Hora</td> 
  								<td width="75%" class="NoiseDataTD"><?php echo ($repopphora)? $repopphora : "---" ; ?></td>
 							</tr>
 							<tr> 
 								<td width="25%" class="NoiseFooterTD">&nbsp;Usuario</td> 
  								<td width="75%" class="NoiseDataTD"><?php echo ($usuacodigo)? cargausuanombre($usuacodigo, $idcon) : "---" ; ?></td>
 							</tr>
 							<tr><td colspan="2" class="NoiseErrorDataTD"></td></tr>
							<tr><td colspan="2" class="NoiseFooterTD">&nbsp;Descripci&oacute;n</td></tr>
							<tr><td colspan="2" rowspan="2" class="NoiseDataTD"><?php echo $repoppdescri; ?></td></tr>
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
 			<input type="hidden" name="flagdetallarreportesaldo" value="1"> 
			<input type="hidden" name="acciondetallarreportesaldo">
			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>">
			<input type="hidden" name="sourceaction" value="detallar"> 			
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>">
		</form> 
	</body> 
<?php if(!$codigo){ echo " -->"; } ?> 
</html>