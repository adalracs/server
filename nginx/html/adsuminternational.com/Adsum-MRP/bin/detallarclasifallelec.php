<?php 	
	include ( '../src/FunGen/sesion/fncvalses.php'); 
	include ( '../src/FunPerPriNiv/pktblrangofallelec.php');
	
	if(!$flagdetallarclasifallelec)
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
		<title>Detalle de registro de clasificacion fallas electricas</title> 
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
  				<tr><td class="ui-widget-header"><span class="style5"><font color="FFFFFF"> Detallar registro</font></span></td></tr>
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
					<td class="NoiseErrorDataTD" align="center"><?php include '../def/jquery.button_formdetall.php'; ?></td>
				</tr>
				<tr><td>&nbsp;</td></tr> 
 				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr> 
			</table> 
 			<input type="hidden" name="flagdetallarclasifallelec" value="1"> 
			<input type="hidden" name="acciondetallarclasifallelec">
			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>">
			<input type="hidden" name="sourceaction" value="detallar"> 			
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>">
			<input type="hidden" name="columnas" value="cfalelcodigo,cfalelnombre,cfaleldescri,cfalelhcolor"> 
 			<input type="hidden" name="cfalelccodigo" value="<?php if($accionconsultarclasifallelec) echo $cfalelcodigo; ?>"> 
 			<input type="hidden" name="cfalelnombre" value="<?php if($accionconsultarclasifallelec) echo $cfalelnombre; ?>"> 
 			<input type="hidden" name="cfaleldescri" value="<?php if($accionconsultarclasifallelec) echo $cfaleldescri; ?>"> 
 			<input type="hidden" name="cfalelhcolor" value="<?php if($accionconsultarclasifallelec) echo $cfalelhcolor; ?>"> 
 			<input type="hidden" name="accionconsultarclasifallelec" value="<?php echo $accionconsultarclasifallelec; ?>"> 
		</form> 
	</body> 
<?php if(!$codigo){ echo " -->"; } ?> 
</html>