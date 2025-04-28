<?php 
	include ( '../src/FunGen/sesion/fncvalses.php');
	include ( '../src/FunPerPriNiv/pktblequipo.php');
	include ( '../src/FunPerPriNiv/pktbltipomedi.php');
	
	if(!$flagdetallarmedidoequipo) 
	{ 
		include ( '../src/FunGen/sesion/fnccarga.php'); 
		$sbreg = fnccarga($nombtabl,$radiobutton);
		
		if (!$sbreg) 
			include( '../src/FunGen/fnccontfron.php');
			
		$idcon = fncconn();
			
		$rsEquipo = loadrecordequipo($sbreg[equipocodigo],$idcon);
		$rsTipomedidor = loadrecordtipomedi($sbreg[tipmedcodigo],$idcon);
		$equipo = ($rsEquipo > 0)? $rsEquipo[equiponombre] : 'DESCONOCIDO';
		$tipomedidor = ($rsTipomedidor > 0)? $rsTipomedidor[tipmednombre] : 'DESCONOCIDO';
			
	} 
?>
<html> 
	<head> 
		<title>Detalle de registro de Medidores por Equipo</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0"> 
		<?php include('../def/jquery.library_maestro.php');?>
	</head> 
<?php if(!$codigo){ echo "<!--";} ?> 
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Medidores por Equipo</font></p> 
			<table border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content" width="450">
  				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr> 
  				<tr><td class="ui-widget-header"><span class="style5"><font color="FFFFFF"> Detallar registro</font></span></td></tr> 
				<tr> 
  					<td> 
            			<table width="95%" border="0" cellspacing="1" cellpadding="1" align="center"> 
							<tr> 
 								<td width="30%" class="NoiseFooterTD">&nbsp;C&oacute;digo</td> 
  								<td width="70%" class="NoiseDataTD"><?php echo $sbreg[medequcodigo]; ?></td> 
 							</tr> 
 							<tr> 
 								<td class="NoiseFooterTD">&nbsp;Tipo Medidor</td> 
  								<td class="NoiseDataTD"><?php echo $tipomedidor ?></td> 
 							</tr>  
							<tr> 
 								<td class="NoiseFooterTD">&nbsp;Equipo</td> 
  								<td class="NoiseDataTD"><?php echo $equipo ?></td> 
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
 			<input type="hidden" name="flagdetallarmedidoequipo" value="1"> 
			<input type="hidden" name="acciondetallarmedidoequipo">
			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>">
			<input type="hidden" name="sourceaction" value="detallar"> 			
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>">
			<input type="hidden" name="columnas" value="medequcodigo,medequnombre,medequdescri">
			<input type="hidden" name="medequcodigo" value="<?php if($accionconsultarmedidoequipo) echo $medequcodigo; ?>"> 
 			<input type="hidden" name="medequnombre" value="<?php if($accionconsultarmedidoequipo) echo $medequnombre; ?>"> 
 			<input type="hidden" name="medequdescri" value="<?php if($accionconsultarmedidoequipo) echo $medequdescri; ?>"> 
 			<input type="hidden" name="accionconsultarmedidoequipo" value="<?php echo $accionconsultarmedidoequipo; ?>">
		</form> 
	</body> 
<?php if(!$codigo){ echo " -->"; } ?> 
</html>