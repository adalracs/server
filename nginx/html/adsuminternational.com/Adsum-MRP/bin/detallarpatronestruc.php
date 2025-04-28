<?php 
	include ( '../src/FunGen/sesion/fncvalses.php');
	include ( '../src/FunPerPriNiv/pktblpadreitem.php');
	include ( '../src/FunPerPriNiv/pktblpatronestrucpadreitem.php');
	include ( '../src/FunGen/cargainput.php');
	
	if(!$flagdetallarpatronestruc) 
	{ 
		include ( '../src/FunGen/sesion/fnccarga.php'); 
		$sbreg = fnccarga($nombtabl,$radiobutton);
		
		if (!$sbreg) 
			include( '../src/FunGen/fnccontfron.php');
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
		<title>Detalle de registro de patron estructuras</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0"> 
		<?php include('../def/jquery.library_maestro.php');?>
	</head> 
<?php if(!$codigo){ echo "<!--";} ?> 
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Patron estructuras</font></p> 
			<table border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content" width="450">
  				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr> 
  				<tr><td class="ui-widget-header"><span class="style5"><font color="FFFFFF"> Detallar registro</font></span></td></tr> 
				<tr> 
  					<td> 
            			<table width="95%" border="0" cellspacing="1" cellpadding="1" align="center"> 
							<tr> 
 								<td width="22%" class="NoiseFooterTD">&nbsp;C&oacute;digo</td> 
  								<td width="78%" class="NoiseDataTD"><?php echo $sbreg[patestcodigo]; ?></td> 
 							</tr> 
							<tr> 
 								<td class="NoiseFooterTD">&nbsp;Nombre</td> 
  								<td class="NoiseDataTD"><?php echo $sbreg[patestnombre]; ?></td> 
 							</tr>  
 							<tr> 
 								<td class="NoiseFooterTD">&nbsp;Ancho inicial</td> 
  								<td class="NoiseDataTD"><?php echo $sbreg[patestanchoi]; ?></td> 
 							</tr> 
 							<tr> 
 								<td class="NoiseFooterTD">&nbsp;Ancho final</td> 
  								<td class="NoiseDataTD"><?php echo $sbreg[patestanchof]; ?></td> 
 							</tr> 
 							<tr> 
 								<td class="NoiseFooterTD">&nbsp;Calibre inicial</td> 
  								<td class="NoiseDataTD"><?php echo $sbreg[patestcalibi]; ?></td> 
 							</tr> 
 							<tr> 
 								<td class="NoiseFooterTD">&nbsp;Calibre final</td> 
  								<td class="NoiseDataTD"><?php echo $sbreg[patestcalibf]; ?></td> 
 							</tr>
 							<tr>
 								<td colspan="2">
 									<div >
										<?php
											$noAjax = true;
											$flagdetallar = 1;
											include '../src/FunjQuery/jquery.visors/jquery.patronestruc.php';  
										?>
									</div>
 								</td>
 							</tr>
 							<tr><td colspan="2" class="NoiseErrorDataTD"></td></tr>
							<tr><td colspan="2" class="NoiseFooterTD">&nbsp;Descripci&oacute;n</td></tr>
							<tr><td colspan="2" rowspan="2" class="NoiseDataTD"><?php echo $sbreg[patestdescri]; ?></td></tr>
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
 			<input type="hidden" name="flagdetallarpatronestruc" value="1"> 
			<input type="hidden" name="acciondetallarpatronestruc">
			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>">
			<input type="hidden" name="sourceaction" value="detallar"> 			
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>">
			<input type="hidden" name="columnas" value="patestcodigo,patestnombre,patestdescri">
			<input type="hidden" name="patestcodigo" value="<?php if($accionconsultarpatronestruc) echo $patestcodigo; ?>"> 
 			<input type="hidden" name="patestnombre" value="<?php if($accionconsultarpatronestruc) echo $patestnombre; ?>"> 
 			<input type="hidden" name="patestdescri" value="<?php if($accionconsultarpatronestruc) echo $patestdescri; ?>"> 
 			<input type="hidden" name="accionconsultarpatronestruc" value="<?php echo $accionconsultarpatronestruc; ?>">
		</form> 
	</body> 
<?php if(!$codigo){ echo " -->"; } ?> 
</html>