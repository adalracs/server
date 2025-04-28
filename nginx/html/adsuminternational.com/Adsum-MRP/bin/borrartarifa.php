<?php 
	include ( "../src/FunPerPriNiv/pktbltiposoliprog.php"); 
	include ( "../src/FunPerPriNiv/pktblcentcost.php"); 
	include ( "../src/FunPerPriNiv/pktbltipocuenta.php"); 
	include ( '../src/FunGen/sesion/fncvalses.php');
	include ( '../src/FunGen/cargainput.php');	

	if(!$flagborrartarifa){

		include ( '../src/FunGen/sesion/fnccarga.php');
		$sbreg = fnccarga($nombtabl,$radiobutton);
		if (!$sbreg)
			include( '../src/FunGen/fnccontfron.php');
			
		$idcon = fncconn();
		if($sbreg['tipsolcodigo'])
			$tipsol = loadrecordtiposoliprog($sbreg['tipsolcodigo'],$idcon);

		if($sbreg['cencoscodigo'])
			$cencos = loadrecordcentcost($sbreg['cencoscodigo'],$idcon);



		$tarifacodigo = $sbreg["tarifacodigo"];
		$cencosnombre = $cencos["cencosnombre"];
		$tipsolnombre = $tipsol["tipsoldescri"];
		$tarifames = $sbreg["tarifames"];
		$tarifaano = $sbreg["tarifaano"];
		$tarifamod = $sbreg["tarifamod"];
		$tarifamoi = $sbreg["tarifamoi"];
		$tarifacdep = $sbreg["tarifacdep"];
		$tarifasdep = $sbreg["tarifasdep"];
		$tarifaene = $sbreg["tarifaene"];
		$tarifaman = $sbreg["tarifaman"];
		$tarifaotros = $sbreg["tarifaotros"];

	}

?>
<html> 
	<head> 
		<title>Detalle de registro de cuentas</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0"> 
		<?php include('../def/jquery.library_maestro.php');?>
	</head> 
<?php if(!$codigo){ echo "<!--";} ?> 
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Cuenta</font></p> 
			<table border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content" width="650">
  				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr> 
  				<tr><td class="ui-widget-header"><span class="style5"><font color="FFFFFF"> Borrar registro</font></span></td></tr> 
				<tr> 
  					<td> 
  						<table width="95%" border="0" cellspacing="1" cellpadding="1" align="center"> 
							<tr> 
 								<td width="40%" class="NoiseFooterTD">&nbsp;Codigo&nbsp;</td> 
  								<td width="60%" class="NoiseDataTD"><?php echo ($tarifacodigo)? $tarifacodigo : "---" ; ?></td> 
 							</tr> 
 							<tr> 
 								<td class="NoiseFooterTD">&nbsp;Centro de costos&nbsp;</td> 
  								<td class="NoiseDataTD"><?php echo ($cencosnombre)? $cencosnombre : "---" ; ?></td> 
 							</tr> 
							<tr> 
 								<td class="NoiseFooterTD">&nbsp;Proceso&nbsp;</td> 
  								<td class="NoiseDataTD"><?php echo ($tipsolnombre)? $tipsolnombre : "---" ; ?></td> 
 							</tr> 
 							<tr> 
 								<td class="NoiseFooterTD">&nbsp;Mes - Año&nbsp;</td> 
  								<td class="NoiseDataTD"><?php echo $tarifames." - ".$tarifaano; ?></td> 
 							</tr> 
 							<tr> 
 								<td class="NoiseFooterTD">&nbsp;Mano de obra directa&nbsp;</td> 
  								<td class="NoiseDataTD"><?php echo ($tarifamod)? $tarifamod : "---" ; ?></td> 
 							</tr> 
 							<tr> 
 								<td class="NoiseFooterTD">&nbsp;Mano de obra indirecta&nbsp;</td> 
  								<td class="NoiseDataTD"><?php echo ($tarifamoi)? $tarifamoi : "---" ; ?></td> 
 							</tr> 
 							<tr> 
 								<td class="NoiseFooterTD">&nbsp;Cif con depresiacion&nbsp;</td> 
  								<td class="NoiseDataTD"><?php echo ($tarifacdep)? $tarifacdep : "---" ; ?></td> 
 							</tr> 
 							<tr> 
 								<td class="NoiseFooterTD">&nbsp;Cif sin depresiacion&nbsp;</td> 
  								<td class="NoiseDataTD"><?php echo ($tarifasdep)? $tarifasdep : "---" ; ?></td> 
 							</tr> 
 							<tr> 
 								<td class="NoiseFooterTD">&nbsp;Energia&nbsp;</td> 
  								<td class="NoiseDataTD"><?php echo ($tarifaene)? $tarifaene : "---" ; ?></td> 
 							</tr> 
 							<tr> 
 								<td class="NoiseFooterTD">&nbsp;Mantenimiento&nbsp;</td> 
  								<td class="NoiseDataTD"><?php echo ($tarifaman)? $tarifaman : "---" ; ?></td> 
 							</tr> 
 							<tr> 
 								<td class="NoiseFooterTD">&nbsp;Otros&nbsp;</td> 
  								<td class="NoiseDataTD"><?php echo ($tarifaotros)? $tarifaotros : "---" ; ?></td> 
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
      		<input type="hidden" name="tarifacodigo1" value="<?php echo $tarifacodigo; ?>">
	  		<input type="hidden" name="accionborrartarifa">
	  		<input type="hidden" name="flagborrartarifa" value="1">
	  		<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>">
      		<input type="hidden" name="sourceaction" value="borrar">
	  		<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
		</form>
	</body>
<?php if(!$codigo){ echo " -->"; } ?> 
</html>