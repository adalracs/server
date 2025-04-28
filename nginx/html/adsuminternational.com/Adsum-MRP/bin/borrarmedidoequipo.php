<?php 	
	include ( '../src/FunGen/sesion/fncvalses.php'); 
	include ( '../src/FunPerPriNiv/pktblequipo.php');
	include ( '../src/FunPerPriNiv/pktbltipomedi.php');
	
	if(!$flagborrarmedidoequipo)
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
		<title>Borrar de registro de Medidores por Equipo</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0"> 
		<?php include('../def/jquery.library_maestro.php');?>
	</head> 
<?php if(!$codigo){ echo "<!--";} ?> 
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Medidores por Equipo</font></p> 
			<table border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content" width="470">
  				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr> 
  				<tr><td class="ui-widget-header"><span class="style5"><font color="FFFFFF"> Borrar registro</font></span></td></tr> 
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
					<td class="NoiseErrorDataTD" align="center"><?php include '../def/jquery.button_form.php'; ?></td>
				</tr>
				<tr><td>&nbsp;</td></tr> 
 				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr> 
			</table> 
 			<input type="hidden" name="flagborrarmedidoequipo" value="1">
 			<input type="hidden" name="medequcodigo1" value="<?php if(!$flagborrarmedidoequipo){ echo $sbreg[medequcodigo];}else{ echo $medequcodigo1; } ?>">
			<input type="hidden" name="accionborrarmedidoequipo">
			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>">
			<input type="hidden" name="sourceaction" value="borrar"> 			
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>">
			<input type="hidden" name="columnas" value="medequcodigo, medequnombre, medequdescri">
			<input type="hidden" name="medequcodigo" value="<?php  if($accionconsultarmedidoequipo) echo $medequcodigo; ?>"> 
 			<input type="hidden" name="equipocodigo" value="<?php  if($accionconsultarmedidoequipo) echo $equipocodigo; ?>"> 
 			<input type="hidden" name="tipmedcodigo" value="<?php  if($accionconsultarmedidoequipo) echo $tipmedcodigo; ?>"> 
 			<input type="hidden" name="accionconsultarmedidoequipo" value="<?php  echo $accionconsultarmedidoequipo; ?>">
		</form> 
	</body> 
<?php if(!$codigo){ echo " -->"; } ?> 
</html>