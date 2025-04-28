<?php 
	include ( '../src/FunGen/sesion/fncvalses.php');
	include ( '../src/FunPerPriNiv/pktbltipoestadosolitran.php');
	
	
	if(!$flagdetallarestadosolitran) 
	{ 
		include ( '../src/FunGen/sesion/fnccarga.php'); 
		$sbreg = fnccarga($nombtabl,$radiobutton);
		
		if (!$sbreg) 
			include( '../src/FunGen/fnccontfron.php');

		$idcon = fncconn();

		
		$rwtipestsal = loadrecordtipoestadosolitran($sbreg[tipestcodigo],$idcon);
	} 
	
?>
<html> 
	<head> 
		<title>Detalle de registro de estados de saldos</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0"> 
		<?php include('../def/jquery.library_maestro.php');?>
	</head> 
<?php if(!$codigo){ echo "<!--";} ?> 
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Estados de saldos</font></p> 
			<table border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content" width="450">
  				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr> 
  				<tr><td class="ui-widget-header"><span class="style5"><font color="FFFFFF"> Detallar registro</font></span></td></tr> 
				<tr> 
  					<td> 
            			<table width="95%" border="0" cellspacing="1" cellpadding="1" align="center"> 
							<tr> 
 								<td width="22%" class="NoiseFooterTD">&nbsp;C&oacute;digo</td> 
  								<td width="78%" class="NoiseDataTD"><?php echo $sbreg[estsolcodigo]; ?></td> 
 							</tr> 
							<tr> 
 								<td class="NoiseFooterTD">&nbsp;Nombre</td> 
  								<td class="NoiseDataTD"><?php echo $sbreg[estsolnombre]; ?></td> 
 							</tr>  
 							<tr> 
 								<td class="NoiseFooterTD">&nbsp;Tipo</td> 
  								<td class="NoiseDataTD"><?php echo $sbreg[tipestcodigo]; ?></td> 
 							</tr>  
 							<tr><td colspan="2" class="NoiseErrorDataTD"></td></tr>
							<tr><td colspan="2" class="NoiseFooterTD">&nbsp;Descripci&oacute;n</td></tr>
							<tr><td colspan="2" rowspan="2" class="NoiseDataTD"><?php echo $sbreg[estsoldescri]; ?></td></tr>
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
 			<input type="hidden" name="flagdetallarestadosolitran" value="1"> 
			<input type="hidden" name="acciondetallarestadosolitran">
			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>">
			<input type="hidden" name="sourceaction" value="detallar"> 			
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>">
			<input type="hidden" name="columnas" value="estsolcodigo,estsolnombre,estsoldescri,tipestcodigo"> 
			<input type="hidden" name="estsolcodigo" value="<?php if($accionconsultarestadosolitran) echo $estsolcodigo; ?>"> 
			<input type="hidden" name="tipestcodigo" value="<?php if($accionconsultarestadosolitran) echo $tipestcodigo; ?>"> 
			<input type="hidden" name="estsolnombre" value="<?php if($accionconsultarestadosolitran) echo $estsolnombre; ?>"> 
			<input type="hidden" name="estsoldescri" value="<?php if($accionconsultarestadosolitran) echo $estsoldescri; ?>"> 
 			<input type="hidden" name="accionconsultarestadosolitran" value="<?php echo $accionconsultarestadosolitran; ?>">
		</form> 
	</body> 
<?php if(!$codigo){ echo " -->"; } ?> 
</html>