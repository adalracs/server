<?php
	include ( '../src/FunPerPriNiv/pktblrequisicionopp.php');
	include ( '../src/FunGen/sesion/fncvalses.php');
	include ( '../src/FunPerPriNiv/pktblequipo.php');
	include ( '../src/FunPerPriNiv/pktblopp.php');
	include ( '../src/FunPerPriNiv/pktblopextrusion.php');
	include ( '../src/FunPerPriNiv/pktblitemformul.php');
	include ( '../src/FunPerPriNiv/pktblvistaformulacion.php');
	include ( '../src/FunPerPriNiv/pktblvistagestionopp.php');
	include ( '../src/FunPerPriNiv/pktblvistareporteopp.php');
	include ( '../src/FunPerPriNiv/pktblvistacierreopp.php');
	include ( '../src/FunPerPriNiv/pktbloppitemdesa.php');
	include ( '../src/FunPerPriNiv/pktblitemdesa.php');
	include ( '../src/FunGen/cargainput.php');
	
	if(!$flagborrarrequisicion) 
	{ 
		include ( '../src/FunGen/sesion/fnccarga.php'); 
		$sbreg = fnccarga($nombtabl,$radiobutton);
		
		if (!$sbreg) 
			include( '../src/FunGen/fnccontfron.php');
			
		$idcon = fncconn();
				
		$rsRequisicionopp = dinamicscanrequisicionopp(array('requiscodigo' => $sbreg['requiscodigo']),$idcon);		
		$nrRequisicionopp = fncnumreg($rsRequisicionopp);
		for( $a = 0; $a < $nrRequisicionopp; $a++)
		{
			$rwRequisicionopp = fncfetch($rsRequisicionopp,$a);
			$arrrequisicionopp = ($arrrequisicionopp)? $arrrequisicionopp.','.$rwRequisicionopp['ordoppcodigo'] : $rwRequisicionopp['ordoppcodigo'] ;
		}
		
	} 
?>
<html> 
	<head> 
		<title>Borrar de registro de requisicion</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0"> 
		<?php include('../def/jquery.library_maestro.php');?>
		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.function_comun.js"></script>
	</head> 
<?php if(!$codigo){ echo "<!--";} ?> 
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Borrar Requisicion</font></p> 
			<table border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content" width="450">
  				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr> 
  				<tr><td class="ui-widget-header"><span class="style5"><font color="FFFFFF"> Detallar registro</font></span></td></tr> 
				<tr> 
  					<td> 
            			<table width="95%" border="0" cellspacing="1" cellpadding="0" align="center"> 
 							<tr>
								<td width="25%" class="NoiseFooterTD">&nbsp;Fecha&nbsp;</td>
								<td width="75%" class="NoiseDataTD">&nbsp;<?php echo ($sbreg['requisfecha'])? $sbreg['requisfecha'] : '---' ; ?></td>
 							</tr>
 							<tr>
								<td width="25%" class="NoiseFooterTD">&nbsp;Numero RI&nbsp;</td>
								<td width="75%" class="NoiseDataTD">&nbsp;<?php echo ($sbreg['requisnumero'])? $sbreg['requisnumero'] : '' ;?></td>
 							</tr>
 							<tr>
		  						<td colspan="2" class="NoiseFooterTD ">&nbsp;Ordenes Programadas</td>
		  					</tr>
 							<tr>
 								<td colspan="2">
 									<div id="listaordenproduccion">
 										<?php 
 											$noAjax = true;
 											$flagdetallar = 1;
 											include "../src/FunjQuery/jquery.visors/jq.vrequisicionopp.php";
 										?>
 									</div>
 									<input type="hidden" name="arrrequisicionopp" id="arrrequisicionopp" size="60"value="<?php echo $arrrequisicionopp ?>" />
									<input type="hidden" name="arrrequisicionopptmp" id="arrrequisicionopptmp" size="60"value="<?php echo $arrrequisicionopptmp ?>" />
 								</td>
 							</tr>
 							<tr>
 								<td width="10%" class="NoiseFooterTD"></td>
 							</tr>
 							<tr><td colspan="2" class="NoiseErrorDataTD"></td></tr>
							<tr><td colspan="2" class="NoiseFooterTD">&nbsp;Nota / Gestion Requisicion Internta</td></tr>
							<tr><td colspan="2" rowspan="2" class="NoiseDataTD">&nbsp;<?php echo $sbreg['requisdescri'] ?></td></tr>
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
 			<input type="hidden" name="flagborrarrequisicion" value="1"> 
			<input type="hidden" name="accionborrarrequisicion">
			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>">
			<input type="hidden" name="sourceaction" value="borrar"> 			
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>">
			<input type="hidden" name="requiscodigo1" value="<?php if(!$flagborrarrequisicion){ echo $sbreg[requiscodigo];}else{ echo $requiscodigo1; } ?>">
			<input type="hidden" name="usuacodi1" value="<?php echo $usuacodi; ?>" >
		</form> 
	</body> 
<?php if(!$codigo){ echo " -->"; } ?> 
</html>