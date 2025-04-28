<?php 
	include ( '../src/FunGen/sesion/fncvalses.php');
	include ( '../src/FunPerPriNiv/pktblplanta.php');
	include ( '../src/FunPerPriNiv/pktblsistema.php');
	include ( '../src/FunPerPriNiv/pktblequipo.php');
	include ( '../src/FunPerPriNiv/pktblcomponen.php');
	include ( '../src/FunPerPriNiv/pktblparte.php');
	include ( '../src/FunPerPriNiv/pktblcausafalla.php');
	include ( '../src/FunPerPriNiv/pktbltipofall.php');
	include ( '../src/FunPerPriNiv/pktbltipotrab.php');
	include ( '../src/FunGen/cargainput.php');
	
	if(!$flagborrarparaprod)
	{
		include ( '../src/FunGen/sesion/fnccarga.php');
		$sbreg = fnccarga($nombtabl,$radiobutton);
		if (!$sbreg)
		{
			include( '../src/FunGen/fnccontfron.php');
		}
		$idcon = fncconn();
	}
?> 
<html> 
	<head> 
		<title>Borrar registro de Parada de produccion</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0"> 
		<link rel="stylesheet" type="text/css" href="temas/Noise/Style.css"> 
		<script language="JavaScript" src="motofech.js"></script> 
	</head> 
<?php if(!$codigo){ echo "<!--";} ?> 
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Parada de producci&oacute;n</font></p> 
			<table border="0" cellspacing="1" cellpadding="1" align="center" class="NoiseFormTABLE" width="800"> 
  				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr> 
  				<tr><td class="NoiseFieldCaptionTD"><span class="style5"><font color="FFFFFF"> Borrar registro</font></span></td></tr> 
				<tr> 
  					<td> 
              			<table width="95%" border="0" cellspacing="1" cellpadding="1" align="center"> 
							<tr> 
 								<td width="25%" class="NoiseFooterTD">&nbsp;N&uacute;mero parada</td> 
  								<td colspan="3" class="NoiseFooterTD"><?php echo $sbreg[parprocodigo]; ?></td> 
 							</tr> 
 							<tr>
								<td width="25%" class="NoiseFooterTD">&nbsp;Planta</td>
							  	<td colspan="3" class="NoiseFooterTD"><?php echo cargaplantanombre($sbreg[plantacodigo], $idcon) ?></td>
							</tr> 
 							<tr>
								<td width="25%" class="NoiseFooterTD">&nbsp;Sistema</td>
								<td colspan="3" class="NoiseDataTD"><?php echo cargasistemnombre($sbreg[sistemcodigo], $idcon) ?></td>
							</tr>
          					<tr>
          						<td class="NoiseFooterTD">&nbsp;Equipo&nbsp;</td>
								<td colspan="3" class="NoiseDataTD"><?php echo $sbreg[equipocodigo].' / '.cargaequiponombre($sbreg[equipocodigo], $idcon) ?></td>
							</tr> 
 							<tr>
								<td class="NoiseFooterTD">&nbsp;Componente&nbsp;</td>
								<td colspan="3" class="NoiseDataTD"><?php echo $sbreg[componcodigo].' / '.cargacomponnombre($sbreg[componcodigo], $idcon) ?></td>
							</tr>
							<tr>
								<td class="NoiseFooterTD">&nbsp;Causa de Falla</td>
								<td class="NoiseDataTD"><?php echo cargacausafalla($sbreg[caufallcodigo], $idcon) ?></td> 
								<td class="NoiseFooterTD">&nbsp;Falla</td>
							  	<td class="NoiseDataTD"><?php echo cargatipfalnombre($sbreg[tipfalcodigo], $idcon) ?></td>
						  	</tr>
							<tr><td class="NoiseFooterTD" colspan="4">&nbsp;Descripci&oacute;n de la parada</td></tr>
							<tr><td class="NoiseDataTD" colspan="4" ><?php echo $sbreg[parprodescri] ?></td>
							<tr>
								<td class="NoiseFooterTD">&nbsp;Fecha inicio</td>
								<td class="NoiseDataTD"><?php echo $sbreg[parprofecini].' / '.$sbreg[parprohorini] ?></td> 
								<td class="NoiseFooterTD">&nbsp;Fecha fin</td>
							  	<td class="NoiseDataTD"><?php echo $sbreg[parprofecfin].' / '.$sbreg[parprohorfin] ?></td>
						  	</tr> 
							<tr>
								<td class="NoiseFooterTD">&nbsp;Tipo de Trabajo</td>
								<td class="NoiseDataTD" colspan="3"><?php echo cargatipotrab($sbreg[tiptracodigo], $idcon) ?></td> 
						  	</tr> 
						</table> 
  					</td> 
 				</tr> 
 				<tr> 
					<td><div align="center"> 
  						<input type="image" name="aceptar"  src="../img/aceptar.gif" onclick="form1.accionborrarparaprod.value =  1; form1.action='maestablparaprod.php';"  width="86" height="18" alt="Aceptar" border=0> 
  						<input type="image" name="cancelar" src="../img/cancelar.gif" onclick="form1.action='maestablparaprod.php';"  width="86" height="18" alt="Cancelar" border=0> 
					</div></td> 
 				</tr> 
 				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr> 
			</table> 
 			<input type="hidden" name="flagborrarparaprod" value="1"> 
			<input type="hidden" name="accionborrarparaprod"> 
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
			<input type="hidden" name="parprocodigo" value="<?php echo $sbreg[parprocodigo]; ?>"> 
		</form> 
	</body> 
<?php if(!$codigo){ echo " -->"; } ?> 
</html> 
