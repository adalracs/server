<?php 
	ini_set('display_errors',1);
	include ( '../src/FunGen/sesion/fncvalses.php');
	include ('../src/FunGen/cargainput.php');
	include ('../src/FunPerPriNiv/pktblcomplejidadpn.php');
	include ('../src/FunPerPriNiv/pktbltiposoliprog.php');
	include ('../src/FunPerPriNiv/pktblequipo.php');
	
	if(!$flagdetallarajustepn) 
	{ 		
		include ( '../src/FunGen/sesion/fnccarga.php'); 
		$sbreg = fnccarga($nombtabl,$radiobutton);
		
		if (!$sbreg) 
			include( '../src/FunGen/fnccontfron.php');
		
		$idcon = fncconn();
		$rwComplejidadpn = loadrecordcomplejidadpn($sbreg['complecodigo'],$idcon);
		$rwTiposoliprog = loadrecordtiposoliprog($sbreg['tipsolcodigo'],$idcon);
		$rwEquipo = loadrecordequipo($sbreg['equipocodigo'],$idcon);
		$tipsolcodigo = $sbreg['tipsolcodigo'];
	} 
	
	
?>
<html> 
	<head> 
		<title>Detalle de ajuste y/o cambios en produccion</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0"> 
		<?php include('../def/jquery.library_maestro.php');?>
	</head> 
<?php if(!$codigo){ echo "<!--";} ?> 
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Ajustes y/o cambios en produccion</font></p> 
			<table border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content" width="650">
  				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr> 
  				<tr><td class="ui-widget-header"><span class="style5"><font color="FFFFFF"> Detallar registro</font></span></td></tr> 
				<tr> 
  					<td> 
            			<table width="95%" border="0" cellspacing="1" cellpadding="1" align="center"> 
							<tr> 
 								<td width="20%" class="NoiseFooterTD">&nbsp;Codigo&nbsp;</td> 
  								<td width="80%" class="NoiseDataTD"><?php echo $sbreg[ajustecodigo]; ?></td> 
 							</tr> 
 							<tr> 
 								<td width="20%" class="NoiseFooterTD">&nbsp;Nombre&nbsp;</td> 
  								<td width="80%" class="NoiseDataTD"><?php echo $sbreg[ajustenombre]; ?></td> 
 							</tr> 
 							<tr> 
 								<td width="20%" class="NoiseFooterTD">&nbsp;Nivel&nbsp;</td> 
  								<td width="80%" class="NoiseDataTD"><?php echo $rwComplejidadpn[complenombre] ?></td> 
 							</tr> 
 							<tr> 
 								<td width="20%" class="NoiseFooterTD">&nbsp;Tipo&nbsp;</td> 
  								<td width="80%" class="NoiseDataTD"><?php echo $rwTiposoliprog[tipsoldescri] ?></td>
 							</tr> 
 							<tr> 
 								<td width="20%" class="NoiseFooterTD">&nbsp;Equipo&nbsp;</td> 
  								<td width="80%" class="NoiseDataTD"><?php echo $rwEquipo[equiponombre] ?></td> 
 							</tr> 
 							<tr> 
 								<td width="20%" class="NoiseFooterTD">&nbsp;Minutos</td> 
  								<td width="80%" class="NoiseDataTD"><?php echo $sbreg[ajustevalora]; ?></td> 
 							</tr> 
 							<tr><td colspan="2" class="NoiseErrorDataTD"></td></tr>
							<tr><td colspan="2" class="NoiseFooterTD">&nbsp;Nota</td></tr>
							<tr><td colspan="2" rowspan="2" class="NoiseDataTD"><?php echo $sbreg[ajustedescri]; ?></td></tr>
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
 			<input type="hidden" name="flagdetallarajustepn" value="1"> 
			<input type="hidden" name="acciondetallarajustepn">
			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>">
			<input type="hidden" name="sourceaction" value="detallar"> 			
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>">
			<input type="hidden" name="columnas" value="ajustecodigo,ajustenombre,complecodigo">
			<input type="hidden" name="ajustecodigo" value="<?php if($accionconsultarajustepn) echo $ajustecodigo; ?>"> 
 			<input type="hidden" name="ajustenombre" value="<?php if($accionconsultarajustepn) echo $ajustenombre; ?>"> 
 			<input type="hidden" name="complecodigo" value="<?php if($accionconsultarajustepn) echo $complecodigo; ?>"> 
 			<input type="hidden" name="accionconsultarajustepn" value="<?php echo $accionconsultarajustepn; ?>">
		</form> 
	</body> 
<?php if(!$codigo){ echo " -->"; } ?> 
</html>