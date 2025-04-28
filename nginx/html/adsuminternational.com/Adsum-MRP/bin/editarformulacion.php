<?php 
ob_start();
	include ( '../src/FunGen/sesion/fncvalses.php');
	include ( '../src/FunPerPriNiv/pktblusuario.php');
	include ( '../src/FunPerPriNiv/pktblitemformul.php');
	include ( '../src/FunPerPriNiv/pktblitemdesa.php');
	include ( '../src/FunGen/cargainput.php');
	
	if($accioneditarformulacion) 
	{ 
		include ( 'editaformulacion.php'); 
		$flageditarformulacion = 1;
	}
ob_end_flush();

	if(!$flageditarformulacion)
	{
		include ( '../src/FunGen/sesion/fnccarga.php');
		$sbreg = fnccarga($nombtabl,$radiobutton);
		if (!$sbreg)
			include( '../src/FunGen/fnccontfron.php');
			
		$idcon = fncconn();
		$fecha = $sbreg[formulfecha];
		$omologacion = ($sbreg[formulorden] > 0)? $sbreg[formulorden] + 1 : 1 ;
		$rsItemformul = dinamicscanitemformul(array('formulcodigo' => $sbreg[formulcodigo]),$idcon);
		$nrItemformul = fncnumreg($rsItemformul);
		
		for($a = 0; $a < $nrItemformul; $a++):
			$rwItemformul = fncfetch($rsItemformul, $a);
			
			$rwItemdesa = loadrecorditemdesa($rwItemformul['itedescodigo'],$idcon);
			
			($arrformulacion) ? $arrformulacion .= ':|:'.$rwItemformul['itedescodigo'].':-:'.$rwItemformul['iteforcapa'].':-:'.$rwItemformul['iteforporcen'].':-:'.$rwItemdesa['itedesslip'].':-:'.$rwItemdesa['itedesantibl'].':-:'.$rwItemdesa['itedescosto'] : $arrformulacion = $rwItemformul['itedescodigo'].':-:'.$rwItemformul['iteforcapa'].':-:'.$rwItemformul['iteforporcen'].':-:'.$rwItemdesa['itedesslip'].':-:'.$rwItemdesa['itedesantibl'].':-:'.$rwItemdesa['itedescosto'];  
		
		endfor;
		
	
	}
	
?>
<html> 
	<head> 
		<title>Editar registro de formulacion</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0"> 
		<?php include('../def/jquery.library_maestro.php');?>
		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.function_comun.js"></script>
		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.desarrollo.js"></script>
		<style type="text/css">
			.ui-autocomplete-loading { background: white url('../img/ui-anim_basic_16x16.gif') right center no-repeat; }
		</style>
	</head> 
<?php if(!$codigo){ echo "<!--";} ?>
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Formulaci&oacute;n</font></p> 
			<table border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content" width="700">
<?php if($campnomb): ?>
				<tr><td><div class="ui-widget">
					<div class="ui-state-error ui-corner-all" style="padding: 0 .7em;"> 
						<p><span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span> 
						<strong>Advertencia:</strong> Corrija los campos marcados con *</p>
					</div>
				</div></td></tr>
<?php else: ?> 		
				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr>	
<?php endif; ?>
  				<tr><td class="ui-widget-header"><span class="style5"><font color="FFFFFF"> Editar registro</font></span></td></tr> 
				<tr>
					<td>
						<table width="95%" border="0" cellspacing="1" cellpadding="0" align="center"> 
							<tr>
								<td width="15%" class="NoiseFooterTD"><?php if($campnomb["formulnumero"] == 1){ $formulnumero = null; echo "*";}?>&nbsp;Codigo (Mezcla)&nbsp;</td>
								<td class="NoiseDataTD"><input type="text" name="formulnumero" size="30"	value="<?php if(!$flageditarformulacion){ echo $sbreg[formulnumero];}else {echo $formulnumero; }?>"></td>
								<td class="NoiseFooterTD">&nbsp;Homologacion</td>
								<td class="NoiseDataTD" colspan="6">&nbsp;<b>#</b>&nbsp;<?php echo $omologacion ?></td>
							</tr>
							<tr>
								<td width="15%" class="NoiseFooterTD"><?php if($campnomb["formulcapaa"] == 1){ $formulcapaa = null; echo "*";}?>&nbsp;Capa A &nbsp;</td>
								<td width="10%" class="NoiseDataTD"><input type="text" name="formulcapaa" id="formulcapaa" size="3" value="<?php if(!$flageditarformulacion){echo $sbreg[formulcapaa];}else{echo $formulcapaa;} ?>" onkeyup="eventFormulacion();" />&nbsp;<b>%</b></td>
								<td width="10%" class="NoiseFooterTD">&nbsp;Formulado &nbsp;</td>
								<td width="10%" class="NoiseDataTD">&nbsp;<span id="capaa">0.0</span>&nbsp;<b>%</b></td>
								<td width="5%" class="NoiseFooterTD">&nbsp;Slip &nbsp;</td>
								<td width="10%" class="NoiseDataTD">&nbsp;<span id="slip_capaa">0.0</span></td>
								<td width="10%" class="NoiseFooterTD">&nbsp;Antiblock &nbsp;</td>
								<td width="10%" class="NoiseDataTD">&nbsp;<span id="antiblock_capaa">0.0</span></td>
								<td width="10%" class="NoiseDataTD">&nbsp;</td>
							</tr>
							<tr>
								<td width="15%" class="NoiseFooterTD"><?php if($campnomb["formulcapab"] == 1){ $formulcapab = null; echo "*";}?>&nbsp;Capa B &nbsp;</td>
								<td width="10%" class="NoiseDataTD"><input type="text" name="formulcapab" id="formulcapab" size="3" value="<?php if(!$flageditarformulacion){echo $sbreg[formulcapab];}else{echo $formulcapab;} ?>" onkeyup="eventFormulacion();" />&nbsp;<b>%</b></td>
								<td width="10%" class="NoiseFooterTD">&nbsp;Formulado  &nbsp;</td>
								<td width="10%" class="NoiseDataTD">&nbsp;<span id="capab">0.0</span>&nbsp;<b>%</b></td>
								<td width="5%" class="NoiseFooterTD">&nbsp;Slip &nbsp;</td>
								<td width="10%" class="NoiseDataTD">&nbsp;<span id="slip_capab">0.0</span></td>
								<td width="10%" class="NoiseFooterTD">&nbsp;Antiblock &nbsp;</td>
								<td width="10%" class="NoiseDataTD">&nbsp;<span id="antiblock_capab">0.0</span></td>
								<td width="10%" class="NoiseDataTD">&nbsp;</td>
							</tr>
							<tr>
								<td width="15%" class="NoiseFooterTD"><?php if($campnomb["formulcapac"] == 1){ $formulcapac = null; echo "*";}?>&nbsp;Capa C &nbsp;</td>
								<td width="10%" class="NoiseDataTD"><input type="text" name="formulcapac" id="formulcapac" size="3" value="<?php if(!$flageditarformulacion){echo $sbreg[formulcapac];}else{echo $formulcapac;} ?>" onkeyup="eventFormulacion();" />&nbsp;<b>%</b></td>
								<td width="10%" class="NoiseFooterTD">&nbsp;Formulado  &nbsp;</td>
								<td width="10%" class="NoiseDataTD">&nbsp;<span id="capac">0.0</span>&nbsp;<b>%</b></td>
								<td width="5%" class="NoiseFooterTD">&nbsp;Slip &nbsp;</td>
								<td width="10%" class="NoiseDataTD">&nbsp;<span id="slip_capac">0.0</span></td>
								<td width="10%" class="NoiseFooterTD">&nbsp;Antiblock &nbsp;</td>
								<td width="10%" class="NoiseDataTD">&nbsp;<span id="antiblock_capac">0.0</span></td>
								<td width="10%" class="NoiseDataTD">&nbsp;</td>
							</tr>
							<tr>
								<td colspan="1" class="NoiseDataTD">&nbsp;Costo</td>
								<td colspan="3" class="NoiseDataTD">&nbsp;<span id="costo">0.0</span>&nbsp;<b>COP</b></td>
								<td colspan="1" class="NoiseDataTD">&nbsp;<b>Total</b></td>
								<td colspan="1" class="NoiseDataTD">&nbsp;<span id="slip">0.0</span></td>
								<td colspan="1" class="NoiseDataTD">&nbsp;<b>Total</b></td>
								<td colspan="1" class="NoiseDataTD">&nbsp;<span id="antiblock">0.0</span></td>
								<td width="10%" class="NoiseDataTD">&nbsp;</td>
							</tr>
							<tr>
								<td width="15%" class="NoiseFooterTD">&nbsp;Capa &nbsp;</td>
								<td width="15%" class="NoiseDataTD"><select name="capa" id="capa">
								<option value="">--Seleccione--</option>
								<option value="A" <?php if($capa == 'A'){echo 'selected';}?>>A</option>
								<option value="B" <?php if($capa == 'B'){echo 'selected';}?>>B</option>
								<option value="C" <?php if($capa == 'C'){echo 'selected';}?>>C</option>
								</select></td>
								<td width="10%"class="NoiseFooterTD">&nbsp;Item&nbsp;</td>
								<td colspan="5" class="NoiseDataTD"><input type="hidden" name="itedescodigo" id="itedescodigo" value="<?php echo $itedescodigo ?>" /><input type="hidden" name="itedesslip" id="itedesslip"size="30" value="<?php echo $itedesslip ?>"><input type="hidden" name="itedesantibl" id="itedesantibl"size="30" value="<?php echo $itedesantibl ?>"><input type="hidden" name="itedescosto" id="itedescosto"size="30" value="<?php echo $itedescosto ?>">
								<input type="text" name="itedesnombre" id="itedesnombre"size="30" value="<?php echo $itedesnombre ?>">&nbsp;
								<input type="text" size="3" name="itempor" id="itempor" value="<?php $itempor ?>"/><b>&nbsp;%</b></td>
								<td class="NoiseDataTD"><div class="ui-buttonset-fe">
								<button id="ingresaritem">Agregar item</button>
								<button id="quitaritem">Quitar item</button>
							</div></td>
							</tr>
							<tr> 
  								<td colspan="9"> 
            						<table width="95%" border="0" cellspacing="1" cellpadding="0" align="center"> 
 										<tr>
 											<td>
												<div id="filtrlistaformulacion">
												<?php
													$noAjax = true;
													include '../src/FunjQuery/jquery.visors/jquery.formulacion.php';  
												?>
												</div>
 											</td>
 										</tr>
									</table> 
  								</td> 
 							</tr> 
 						</table>
 					</td>
 				</tr>
				<tr><td>&nbsp;</td></tr>
				<tr>
					<td class="NoiseErrorDataTD" align="center"><?php include '../def/jquery.button_form.php'; ?></td>
				</tr>
				<tr><td>&nbsp;</td></tr>
				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr>
			</table> 
			<input type="hidden" name="accioneditarformulacion">
			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>">
			<input type="hidden" name="sourceaction" value="editar">
			<input type="hidden" name="formulfecha" value="<?php if(!$flageditarformulacion){echo $fecha;}else{ echo $formulfecha;} ?>">
			<input type="hidden" name="formulpadre" value="<?php if(!$flageditarformulacion){echo $sbreg[formulpadre];}else{ echo $formulpadre;} ?>">
			<input type="hidden" name="formulorden" value="<?php if(!$flageditarformulacion){echo $sbreg[formulorden];}else{ echo $formulorden;} ?>">
			<input type="hidden" name="formulcodigo" value="<?php if(!$flageditarformulacion){echo $sbreg[formulcodigo];}else{echo $formulcodigo;}?>">
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
			<script type="text/javascript">validaPorcentaje();</script>
		</form>
		<div id="msgwindow" title="Adsum Kallpa"><span id="msg"></span></div>
	</body>
<?php if(!$codigo){ echo " -->"; } ?> 
</html>