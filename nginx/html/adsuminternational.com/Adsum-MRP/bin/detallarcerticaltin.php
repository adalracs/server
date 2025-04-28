<?php 
	include ( '../src/FunGen/sesion/fncvalses.php');
	include ( '../src/FunPerPriNiv/pktblusuario.php');
	include ( '../src/FunPerPriNiv/pktblvistaitemdispe.php');
	include ('../src/FunGen/cargainput.php');
	
	if(!$flagdetallarcerticaltin) 
	{ 
		include ( '../src/FunGen/sesion/fnccarga.php'); 
		$sbreg = fnccarga($nombtabl,$radiobutton);
		
		if (!$sbreg) 
			include( '../src/FunGen/fnccontfron.php');
			
		$idcon = fncconn();
		$nombre = cargausuanombre($sbreg[usuacodi],$idcon);
		$rsItem = loadrecordvistaitemdispe($sbreg[itedescodigo],$idcon);
	} 
?>
<html> 
	<head> 
		<title>Detalle de registro de certificado calidad/tintas</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0"> 
		<?php include('../def/jquery.library_maestro.php');?>
		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.function_comun.js"></script>
	</head> 
<?php if(!$codigo){ echo "<!--";} ?> 
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Formulaci&oacute;n</font></p> 
			<table border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content" width="750">
  				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr> 
  				<tr><td class="ui-widget-header"><span class="style5"><font color="FFFFFF"> Detallar registro</font></span></td></tr> 
				<tr> 
  					<td> 
            			<table width="95%" border="0" cellspacing="1" cellpadding="1" align="center"> 
            				<tr>
								<td colspan="4" class="ui-state-default" align="center"><small>R.DI.02  Responsable : <?php echo $nombre ?> Fecha : <?php echo $sbreg[cercatfecha] ?></small></td>
							</tr>
							<tr>
								<td width="20%" class="NoiseFooterTD">&nbsp;Codigo&nbsp;</td>
								<td colspan="3" class="NoiseDataTD">&nbsp;<?php echo $sbreg[cercatcodigo] ?></td>
							</tr>
							<tr>
								<td width="20%" class="NoiseFooterTD">&nbsp;Componente&nbsp;</td>
								<td colspan="3" class="NoiseDataTD">&nbsp;<?php echo $rsItem[keylinea]." - ".$rsItem[itedeslinea] ?></td>
							</tr>
							<tr>
								<td width="20%" class="NoiseFooterTD">&nbsp;Referencia&nbsp;</td>
								<td colspan="3" class="NoiseDataTD">&nbsp;<?php echo $rsItem[itedescodigo]." - ".$rsItem[itedesnombre] ?></td> 
							</tr>
							<tr>
								<td width="20%" class="NoiseFooterTD">&nbsp;Tipo de tinta&nbsp;</td>
								<td width="30%" class="NoiseDataTD">&nbsp;<?php echo strtoupper($sbreg[cercattipot]) ?></td> 
								<td width="20%" class="NoiseFooterTD">&nbsp;Lote&nbsp;</td>
								<td width="30%" class="NoiseDataTD">&nbsp;<?php echo $sbreg[cercatlote] ?></td> 
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<table width="95%" border="0" cellspacing="1" cellpadding="0" align="center"> 
							<tr>
								<td width="30%" class="ui-state-default" align="center"><small>Analisis</small></td>
								<td width="70%" class="ui-state-default" align="center"><small>Resultados</small></td>
							</tr>
							<tr>
								<td width="30%" class="NoiseFooterTD">&nbsp;Viscosidad <b>(cP)</b> &nbsp;</td>
								<td width="70%" class="NoiseDataTD">&nbsp;<?php echo $sbreg[cercatviscos] ?></td>
							</tr>
							<tr>
								<td width="30%" class="NoiseFooterTD">&nbsp;Viscosidad <b>(seg,zanh # 2 o ford)</b> &nbsp;</td>
								<td width="70%" class="NoiseDataTD">&nbsp;<?php echo $sbreg[cercatvisco] ?></td>
							</tr>
							<tr>
								<td width="30%" class="NoiseFooterTD">&nbsp;Color <b>(L, C, h y &Delta;cmc)</b>&nbsp;</td>
								<td width="70%" class="NoiseDataTD">&nbsp;<?php echo $sbreg[cercatcolor] ?></td>
							</tr>
							<tr>
								<td width="30%" class="NoiseFooterTD">&nbsp;Solidos <b>(%)</b>&nbsp;</td>
								<td width="70%" class="NoiseDataTD">&nbsp;<?php echo $sbreg[cercatsolido] ?></td>
							</tr>
							<tr>
								<td width="30%" class="NoiseFooterTD">&nbsp;Densidad <b>(g/ml)</b>&nbsp;</td>
								<td width="70%" class="NoiseDataTD">&nbsp;<?php echo $sbreg[cercatdensid] ?></td>
							</tr>
							<tr>
								<td width="30%" class="NoiseFooterTD">&nbsp;Secado <b>(seg)</b>&nbsp;</td>
								<td width="70%" class="NoiseDataTD">&nbsp;<?php echo $sbreg[cercatsecado] ?></td>
							</tr>
							<tr>
								<td width="30%" class="NoiseFooterTD">&nbsp;Adherencia&nbsp;</td>
								<td width="70%" class="NoiseDataTD">&nbsp;<?php echo $sbreg[cercatadhere] ?></td>
							</tr>
							<tr>
								<td width="30%" class="NoiseFooterTD">&nbsp;Rayado&nbsp;</td>
								<td width="70%" class="NoiseDataTD">&nbsp;<?php echo $sbreg[cercatrayado] ?></td>
							</tr>
							<tr>
								<td colspan="2" class="NoiseFooterTD">&nbsp;Nota : Viscosidad y densidad medida a 25 &deg;C +/-.&nbsp;</td>
							</tr>
							<tr>
								<td colspan="2" class="NoiseFooterTD">&nbsp;La viscosidad medida en con la capa Zahn es hasta 60s por encima de este valor se mide con la capa ford 4.&nbsp;</td>
							</tr>
							<tr><td colspan="2" class="NoiseErrorDataTD"></td></tr>
							<tr><td colspan="2" class="NoiseFooterTD">&nbsp;Nota</td></tr>
							<tr><td colspan="2" rowspan="2" class="NoiseDataTD">&nbsp;<?php echo $sbreg[cercatdescri] ?></td></tr>
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
 			<input type="hidden" name="flagdetallarcerticaltin" value="1"> 
			<input type="hidden" name="acciondetallarcerticaltin">
			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>">
			<input type="hidden" name="sourceaction" value="detallar"> 			
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>">
 			<input type="hidden" name="accionconsultarcerticaltin" value="<?php echo $accionconsultarcerticaltin; ?>">
		</form> 
		<div id="msgwindow-formu" title="Adsum Kallpa"><div id="msg-formu"></div></div> 
		<script type="text/javascript">validaPorcentaje();</script>
	</body> 
<?php if(!$codigo){ echo " -->"; } ?> 
</html>