<?php 
	include ( '../src/FunGen/sesion/fncvalses.php'); 
	include ( '../src/FunPerPriNiv/pktblrangofallelec.php');
	
	if(!$flagborrarclasifallelec)
	{ 
		include ( '../src/FunGen/sesion/fnccarga.php'); 
		$sbreg = fnccarga($nombtabl,$radiobutton); 
	
		if (!$sbreg)
			include( '../src/FunGen/fnccontfron.php'); 
		
		$idcon = fncconn();
		$rsRango = loadlistrecordrangofallelec($sbreg['cfalelcodigo'], $idcon);
		$color = array('40FF00' => 'Verde','FFFF00' => 'Amarillo','FFBF00' => 'Naranja','FF0000' => 'Rojo');
		
		$delta[1] = '------';
		$delta[2] = '------';
		
		if(is_array($rsRango)):
			for($a = 1; $a <= 2; $a++):
				if(($rsRango[$a][ranfelvalini] && !$rsRango[$a][ranfelvalfin]) || (!$rsRango[$a][ranfelvalini] && $rsRango[$a][ranfelvalfin]))
					($rsRango[$a][ranfelvalini]) ? $delta[$a] = '<b>&gt; '.$rsRango[$a][ranfelvalini].'&deg;C</b>' : $delta[$a] = '<b>&lt;= '.$rsRango[$a][ranfelvalfin].'&deg;C</b>';
				elseif($rsRango[$a][ranfelvalini] && $rsRango[$a][ranfelvalfin])
					$delta[$a] = '<b>'.$rsRango[$a][ranfelvalini].'&deg;C&nbsp;&nbsp;-&nbsp;&nbsp;'.$rsRango[$a][ranfelvalfin].'&deg;C</b>';
			endfor;
		endif;
	} 
?>
<html> 
	<head> 
		<title>Borrar de registro de clasificacion fallas electricas</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0"> 
		<?php include('../def/jquery.library_maestro.php');?>
	</head> 
<?php if(!$codigo){ echo "<!--";} ?> 
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Clasificaci&oacute;n de fallas el&eacute;ctricas</font></p> 
			<table border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content" width="450">
  				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr> 
  				<tr><td class="ui-widget-header"><span class="style5"><font color="FFFFFF">Borrar registro</font></span></td></tr> 
				<tr> 
  					<td> 
            			<table width="98%" border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content"> 
							<tr> 
 								<td width="20%" class="NoiseFooterTD">&nbsp;C&oacute;digo</td> 
 								<td width="80%" class="NoiseDataTD">&nbsp;<?php echo $sbreg[cfalelcodigo]; ?></td> 
 							</tr> 
							<tr> 
 								<td width="20%" class="NoiseFooterTD">&nbsp;Nombre</td> 
 								<td width="80%" class="NoiseDataTD">&nbsp;<?php echo $sbreg[cfalelnombre]; ?></td> 
 							</tr> 
							<tr>
     							<td class="NoiseFooterTD">&nbsp;Color</td>
     							<td style="background-color: <?php echo '#'.$sbreg['cfalelhcolor'] ?>">&nbsp;<?php echo $color[$sbreg['cfalelhcolor']] ?></td>
							</tr>   
 							<tr><td colspan="2" class="NoiseFooterTD">&nbsp;Descripci&oacute;n</td></tr>
  							<tr><td colspan="2" class="NoiseDataTD"><?php echo $sbreg[cfaleldescri]; ?></td></tr>
						</table> 
  					</td> 
 				</tr> 
				<tr> 
  					<td> 
            			<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content"> 
							<tr> 
 								<td width="10%" class="ui-state-default">&nbsp;&Delta;1</td> 
 								<td width="40%" class="ui-state-default">&nbsp;<?php echo $delta[1] ?></td> 
 								<td width="10%" class="ui-state-default">&nbsp;&Delta;2</td> 
 								<td width="40%" class="ui-state-default">&nbsp;<?php echo $delta[2] ?></td> 
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
			<input type="hidden" name="cfalelcodigo" value="<?php echo $sbreg[cfalelcodigo]; ?>">
 			<input type="hidden" name="flagborrarclasifallelec" value="1"> 
			<input type="hidden" name="accionborrarclasifallelec">
			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>">
			<input type="hidden" name="sourceaction" value="borrar"> 			
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
		</form> 
	</body> 
<?php if(!$codigo){ echo " -->"; } ?> 
</html>