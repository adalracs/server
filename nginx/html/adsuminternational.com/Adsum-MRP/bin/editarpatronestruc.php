<?php 
ob_start();
	include ( '../src/FunGen/sesion/fncvalses.php');
	include ( '../src/FunPerPriNiv/pktblpadreitem.php');
	include ( '../src/FunPerPriNiv/pktblpatronestrucpadreitem.php');
	include ( '../src/FunGen/cargainput.php');
	
	if($accioneditarpatronestruc) 
	{ 
		include ( 'editapatronestruc.php'); 
		$flageditarpatronestruc = 1;
	}
ob_end_flush();
	if(!$flageditarpatronestruc)
	{
		include ( '../src/FunGen/sesion/fnccarga.php');
		$sbreg = fnccarga($nombtabl,$radiobutton);
		if (!$sbreg)
			include( '../src/FunGen/fnccontfron.php');

		$patestcodigo= $sbreg[patestcodigo];
		$patestnombre= $sbreg[patestnombre];
		$patestanchoi= $sbreg[patestanchoi];
		$patestanchof= $sbreg[patestanchof];
		$patestcalibi= $sbreg[patestcalibi];
		$patestcalibf= $sbreg[patestcalibf];
		$patestdescri= $sbreg[patestdescri];

		$idcon = fncconn();
		$rsPatronestrucpadreitem = dinamicscanpatronestrucpadreitem(array('patestcodigo' => $sbreg['patestcodigo']),$idcon);		
		$nrPatronestrucpadreitem = fncnumreg($rsPatronestrucpadreitem);
		for( $a = 0; $a < $nrPatronestrucpadreitem; $a++)
		{
			$rwPatronestrucpadreitem = fncfetch($rsPatronestrucpadreitem,$a);
			$arrpatronestruc = ($arrpatronestruc)? $arrpatronestruc.':|:'.$rwPatronestrucpadreitem['paetpaindice'].':-:'.$rwPatronestrucpadreitem['paditecodigo'] : $rwPatronestrucpadreitem['paetpaindice'].':-:'.$rwPatronestrucpadreitem['paditecodigo'] ;
		}
	}
	
?>
<html> 
	<head> 
		<title>Editar registro de patron estructura</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0"> 
		<?php include('../def/jquery.library_maestro.php');?>
		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.function_comun.js"></script>
		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.patronestruc.js"></script>
		<style type="text/css">
			.ui-autocomplete-loading { background: white url('../img/ui-anim_basic_16x16.gif') right center no-repeat; }
		</style>
	</head> 
<?php if(!$codigo){ echo "<!--";} ?>
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Patron estructura</font></p> 
			<table border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content" width="450">
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
								<td width="25%" class="NoiseFooterTD"><?php if($campnomb["patestnombre"] == 1){ $patestnombre = null; echo "*";}?>&nbsp;Nombre&nbsp;</td>
								<td width="75%" class="NoiseDataTD"><input type="text" name="patestnombre" value="<?php echo $patestnombre ?>" size="10" /></td>
 							</tr>
 							<tr>
								<td width="25%" class="NoiseFooterTD"><?php if($campnomb["patestanchoi"] == 1){ $patestanchoi = null; echo "*";}?>&nbsp;Ancho inicial&nbsp;<b>(mm)</b></td>
								<td width="75%" class="NoiseDataTD"><input type="text" name="patestanchoi" value="<?php echo $patestanchoi ?>" size="5" /></td>
 							</tr>
 							<tr>
								<td width="25%" class="NoiseFooterTD"><?php if($campnomb["patestanchof"] == 1){ $patestanchof = null; echo "*";}?>&nbsp;Ancho final&nbsp;<b>(mm)</b></td>
								<td width="75%" class="NoiseDataTD"><input type="text" name="patestanchof" value="<?php echo $patestanchof;?>" size="5" /></td>
 							</tr>
 							<tr>
								<td width="25%" class="NoiseFooterTD"><?php if($campnomb["patestcalibi"] == 1){ $patestcalibi = null; echo "*";}?>&nbsp;Calibre inicial&nbsp;<b>(&micro;m)</b></td>
								<td width="75%" class="NoiseDataTD"><input type="text" name="patestcalibi" value="<?php echo $patestcalibi; ?>" size="5" /></td>
 							</tr>
 							<tr>
								<td width="25%" class="NoiseFooterTD"><?php if($campnomb["patestcalibf"] == 1){ $patestcalibf = null; echo "*";}?>&nbsp;Calibre final&nbsp;<b>(&micro;m)</b></td>
								<td width="75%" class="NoiseDataTD"><input type="text" name="patestcalibf" value="<?php echo $patestcalibf; ?>" size="5" /></td>
 							</tr>
 							<tr>
		  						<td width="25%" class="NoiseFooterTD "><?php if($campnomb["arrpatronestruc"] == 1){ $arrpatronestruc = null; echo "*";}?>&nbsp;Material</td>
		  						<td width="75%" class="NoiseDataTD" rowspan="2">
		  							<div class="ui-buttonset" align="right">
										<button id="ingresarpadreitem">Agregar</button>&nbsp;&nbsp;
		            					<button id="quitarpadreitem">Quitar</button>
									</div>
		  						</td>
		  					</tr>
							<tr>
		  						<td class="NoiseDataTD" colspan="2">
		  							<input type="text" name="material" id="material" size="60" onkeypress="return event.keyCode!=13"/>
		  							<input type="hidden" name="idmaterial" id="idmaterial">
		  						</td>
		  					</tr>
 							<tr>
 								<td colspan="2">
 									<div id="listapatronestruc">
 										<?php 
 											$noAjax = true;
 											include "../src/FunjQuery/jquery.visors/jquery.patronestruc.php";
 										?>
 									</div>
 									<input type="hidden" name="arrpatronestruc" id="arrpatronestruc" size="60"value="<?php echo $arrpatronestruc ?>" />
									<input type="hidden" name="arrpatronestructmp" id="arrpatronestructmp" size="60"value="<?php echo $arrpatronestructmp ?>" />
 								</td>
 							</tr>
 							<tr><td colspan="2" class="NoiseErrorDataTD"></td></tr>
							<tr><td colspan="2" class="NoiseFooterTD"><?php if($campnomb["patestdescri"]	 == 1){$patestdescri = null; echo "*";}?>&nbsp;Nota</td></tr>
							<tr><td colspan="2" rowspan="2" class="NoiseDataTD"><textarea name="patestdescri" rows="3" cols="63"><?php echo $patestdescri; ?></textarea>  </td></tr>
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
			<input type="hidden" name="accioneditarpatronestruc">
			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>">
			<input type="hidden" name="patestcodigo" value="<?php echo $patestcodigo; ?>">
			<input type="hidden" name="sourceaction" value="editar">
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
		</form>
	</body>
<?php if(!$codigo){ echo " -->"; } ?> 
</html>