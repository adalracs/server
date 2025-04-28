<?php 

ob_start(); 
	include ( "../src/FunPerPriNiv/pktbltipoestadosaldo.php");  
	include ( "../src/FunPerPriNiv/pktblsaldoreporte.php");  
	include ( "../src/FunPerPriNiv/pktblestadosaldo.php");  
	include ( "../src/FunPerPriNiv/pktblitemdesa.php");  
	include ( "../src/FunGen/sesion/fncvalses.php");  
	include ( "../src/FunPerSecNiv//fncsqlrun.php");  
	include ( "../src/FunPerPriNiv/pktbllote.php");
	include ( "../src/FunGen/cargainput.php");  

	if($accionnuevoreportesaldo){
		include ( "grabareportesaldo.php");
	}

	if(!$flagnuevoreportesaldo){

		$idcon = fncconn();

		include ( "../src/FunGen/sesion/fnccarga.php"); 
		$sbreg = fnccarga($nombtabl,$radiobutton);

		if (!$sbreg) {
			include( "../src/FunGen/fnccontfron.php");
		}

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

		$saldocantkgs = $kgreportesaldo;
		$saldocantmts = $mtreportesaldo;

	}

	if ($id == 2) {
		
		echo '<script language= "javascript">';
		echo '<!--//'."\n";
		echo 'alert("No es posible realizar saldos de material de producto en proceso")';
		echo '//-->'."\n";
		echo '</script>';
		echo '<script language="javascript">';
		echo '<!--//'."\n";
		echo 'location ="maestablreportesaldo.php?codigo='.$codigo.';"';
		echo '//-->'."\n";
		echo '</script>';
	}
	
ob_end_flush(); 

$idcon = fncconn();

?>
<html> 
	<head> 
		<title>Nuevo registro saldos</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0"> 
		<?php include('../def/jquery.library_maestro.php');?>
	</head> 
<?php if(!$codigo){ echo "<!--";} ?>
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Saldos</font></p> 
			<table border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content" width="450">
<?php if($campnomb): ?>
				<tr><td><div class="ui-widget">
					<div class="ui-state-error ui-corner-all" style="padding: 0 .7em;"> 
						<p><span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span> 
						<strong>Advertencia:</strong> <?php if($campnomb['err']): echo $campnomb['err']; else: ?> Corrija los campos marcados con *<?php endif; ?></p>
					</div>
				</div></td></tr>
<?php else: ?> 		
				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr>	
<?php endif; ?> 
  				<tr><td class="ui-widget-header"><span class="style5"><font color="FFFFFF"> Ingresar nuevo registro</font></span></td></tr> 
				<tr> 
  					<td> 
            			<table width="95%" border="0" cellspacing="1" cellpadding="0" align="center"> 
 							<tr>
								<td width="25%" class="NoiseFooterTD"><?php if($campnomb["itedescodigo"] == 1){echo "*";}?>&nbsp;Codigo&nbsp;</td>
								<td width="75%" class="NoiseDataTD"><?php echo ($itreportesaldo)? carganombitemdesa1($itreportesaldo, $idcon) : "---" ; ?></td>
 							</tr>
 							<tr>
								<td width="25%" class="NoiseFooterTD"><?php if($campnomb["estsalcodigo"] == 1){ $estsalcodigo = null; echo "*";}?>&nbsp;Estado&nbsp;</td>
								<td width="75%" class="NoiseDataTD">
									<select name="estsalcodigo" id="estsalcodigo">
										<option value="">--Seleccione--</option>
										<?php
											include('../src/FunGen/floadestadosaldo.php');
											floadestadosaldo1($estsalcodigo,1,$idcon);//1 tipo estado saldo disponible
										?>
									</select>
								</td>
 							</tr>
 							<tr>
								<td width="25%" class="NoiseFooterTD"><?php if($campnomb["saldoubicaci"] == 1){ $saldoubicaci = null; echo "*";}?>&nbsp;Ubicacion&nbsp;</td>
								<td width="75%" class="NoiseDataTD"><input type="text" name="saldoubicaci" size="30"	value="<?php echo $saldoubicaci; ?>"></td>
 							</tr>
 							<tr>
								<td width="25%" class="NoiseFooterTD"><?php if($campnomb["saldoposicio"] == 1){ $saldoposicio = null; echo "*";}?>&nbsp;Posicion&nbsp;</td>
								<td width="75%" class="NoiseDataTD"><input type="text" name="saldoposicio" size="30"	value="<?php echo $saldoposicio; ?>"></td>
 							</tr>
 							<tr>
								<td width="25%" class="NoiseFooterTD"><?php if($campnomb["saldoformula"] == 1){ $saldoformula = null; echo "*";}?>&nbsp;Formula&nbsp;</td>
								<td width="75%" class="NoiseDataTD"><input type="text" name="saldoformula" size="7"	value="<?php echo $saldoformula; ?>"></td>
 							</tr>
 							<tr>
								<td width="25%" class="NoiseFooterTD"><?php if($campnomb["saldocantkgs"] == 1){ $saldocantkgs = null; echo "*";}?>&nbsp;Kilogramos&nbsp;<b>(kg)</b>&nbsp;</td>
								<td width="75%" class="NoiseDataTD"><input type="text" name="saldocantkgs" id="saldocantkgs" size="15"	value="<?php echo $saldocantkgs; ?>" onkeyup="kilostometros();" ></td>
 							</tr>
 							<tr>
								<td width="25%" class="NoiseFooterTD"><?php if($campnomb["saldocantmts"] == 1){ $saldocantmts = null; echo "*";}?>&nbsp;Metros&nbsp;<b>(mts)</b>&nbsp;</td>
								<td width="75%" class="NoiseDataTD"><input type="text" name="saldocantmts" id="saldocantmts" size="15"	value="<?php echo $saldocantmts; ?>" ></td>
 							</tr>
 							<tr>
								<td width="25%" class="NoiseFooterTD"><?php if($campnomb["lotecodigo"] == 1){ $lotecodigo = null; echo "*";}?>&nbsp;No. Lote&nbsp;</td>
								<td width="75%" class="NoiseDataTD"><?php echo ($ltreportesaldo)? carganumerolote($ltreportesaldo, $idcon) : "---" ; ?></td>
 							</tr>
 							<tr>
 								<td width="10%" class="NoiseFooterTD"></td>
 							</tr>
 							<tr><td colspan="2" class="NoiseErrorDataTD"></td></tr>
							<tr><td colspan="2" class="NoiseFooterTD"><?php if($campnomb["saldodescri"]	 == 1){$saldodescri = null; echo "*";}?>&nbsp;Nota</td></tr>
							<tr><td colspan="2" rowspan="2" class="NoiseDataTD"><textarea name="saldodescri" rows="3" cols="63"><?php echo $saldodescri; ?></textarea></td></tr>
						</table>
  					</td> 
 				</tr> 
				<tr><td>&nbsp;</td></tr>
				<tr><td class="NoiseErrorDataTD" align="center"><?php include '../def/jquery.button_form.php'; ?></td></tr>
				<tr><td>&nbsp;</td></tr>
				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr>
			</table>
			<input type="hidden" name="kyreportesaldo" value="<?php echo $kyreportesaldo; ?>">  
			<input type="hidden" name="idreportesaldo" value="<?php echo $idreportesaldo; ?>">  
			<input type="hidden" name="kgreportesaldo" value="<?php echo $kgreportesaldo; ?>">  
			<input type="hidden" name="mtreportesaldo" value="<?php echo $mtreportesaldo; ?>">  
			<input type="hidden" name="esreportesaldo" value="<?php echo $esreportesaldo; ?>">  
			<input type="hidden" name="ltreportesaldo" value="<?php echo $ltreportesaldo; ?>">  
			<input type="hidden" name="inreportesaldo" value="<?php echo $inreportesaldo; ?>">  
			<input type="hidden" name="itreportesaldo" value="<?php echo $itreportesaldo; ?>">  
			<input type="hidden" name="opreportesaldo" value="<?php echo $opreportesaldo; ?>"> 
			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>">
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>">
			<input type="hidden" name="id" value="<?php echo $id; ?>"> 
			<input type="hidden" name="sourceaction" value="nuevo">				
			<input type="hidden" name="accionnuevoreportesaldo">  
		</form> 	
	</body> 
<?php if(!$codigo){ echo " -->"; } ?> 
</html>