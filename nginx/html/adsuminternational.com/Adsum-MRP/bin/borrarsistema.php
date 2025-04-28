<?php 
	include ( '../src/FunGen/sesion/fncvalses.php');
	include ( '../src/FunPerPriNiv/pktblplanta.php');	
	include ( '../src/FunPerPriNiv/pktbltiposistema.php');	
	if(!$flagborrarsistema){
		include ( '../src/FunGen/sesion/fnccarga.php');
		$sbreg = fnccarga($nombtabl,$radiobutton);
		if (!$sbreg){
			include( '../src/FunGen/fnccontfron.php');
		}
		$idcon = fncconn();
		if($sbreg[plantacodigo])
			$sbregplanta = loadrecordplanta($sbreg[plantacodigo],$idcon);
		if($sbreg[tipsiscodigo])
			$sbregtiposistema = loadrecordtiposistema($sbreg[tipsiscodigo],$idcon);
	
		fncclose($idcon);
	}
?> 
<html> 
	<head> 
		<title>Borrar registro de sistema</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0"> 
		<link rel="stylesheet" type="text/css" href="temas/Noise/Style.css"> 
		<SCRIPT LANGUAGE="JavaScript"> 
			<!-- Begin
			agree = 0;
			//  End -->
		</script> 
		<script language="JavaScript" src="motofech.js"></script> 
	</head> 
<?php if(!$codigo){ echo "<!--";}?> 
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Sistema</font></p> 
				<table border="0" cellspacing="1" cellpadding="1" align="center" class="NoiseFormTABLE" width="70%"> 
					<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr> 
					<tr><td class="NoiseFieldCaptionTD"><span class="style5"><font color="FFFFFF">Borrar registro</font></span></td></tr> 
					<tr> 
  					<td> 
						<table width="95%" border="0" cellspacing="1" cellpadding="0" align="center"> 
							<tr> 
								<td  class="NoiseFooterTD">Tipo de Sistema</td> 
								<td  class="NoiseDataTD"><?php if(!$flagdetallarsistema){ echo $sbregtiposistema[tipsisnombre];}else{ echo $tipsiscodigo;} ?></td>
							</tr> 
							<tr><td class="NoiseFieldCaptionTD" colspan="2"></td></tr>	
							<tr> 
								<td width="20%" class="NoiseFooterTD">C&oacute;digo</td> 
								<td width="80%" class="NoiseDataTD"><?php if(!$flagdetallarsistema){ echo $sbreg[sistemcodigo];}else{ echo $sistemcodigo;} ?></td> 
							</tr>
							<tr> 
								<td width="20%" class="NoiseFooterTD">Nombre</td> 
								<td class="NoiseDataTD"><?php if(!$flagdetallarsistema){ echo $sbreg[sistemnombre];}else{ echo $sistemnombre;} ?></td> 
							</tr> 
							<tr>
								<td width="20%" class="NoiseFooterTD">Planta</td>
								<td width="80%" class="NoiseDataTD"><?php if(!$flagdetallarsistema){ echo $sbregplanta[plantanombre]; }else{ echo $plantacodigo;} ?></td>
							</tr> 
							<tr><td class="NoiseFieldCaptionTD" colspan="2"></td></tr>								
			 				<tr>
						           <!-- * *Campos personalizados* * -->
								<td colspan="2">
									<table width="100%" border="0" cellspacing="2" cellpadding="0" align="center">
										<?php
											include('../src/FunGen/floadsistemcamperequipo.php');
											// 'true' indica que es un detallar/borrar
											$idcon = fncconn();
											floadsistemcamperequipo($sbreg['sistemcodigo'], null, null, $idcon);
											fncclose($idcon);
										?>
									</table>
								</td>
						          <!-- * * * -->
						          </tr>
          							<tr><td class="NoiseFieldCaptionTD" colspan="2"></td></tr>	
							<tr> 
								<td width="20%" class="NoiseFooterTD">Descripci&oacute;n</td> 
								<td width="80%"  rowspan="2" valign="top" class="NoiseDataTD"><?php if(!$flagdetallarsistema){ echo $sbreg[sistemdescri];}else{ echo $sistemdescri;} ?></td> 
							</tr>
							<tr><td class="NoiseFooterTD">&nbsp;</td></tr> 
						</table> 
					</td> 
				</tr> 
				<tr> 
					<td><div align="center"> 
						<input type="image" name="aceptar"  src="../img/aceptar.gif" onclick="form1.accionborrarsistema.value =  1; form1.action='maestablsistema.php';"  width="86" height="18" alt="Aceptar" border=0> 
						<input type="image" name="cancelar" src="../img/cancelar.gif" onclick="form1.action='maestablsistema.php';"  width="86" height="18" alt="Cancelar" border=0> 
					</div></td> 
				</tr> 
				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr> 
			</table> 
			 <input type="hidden" name="flagborrarsistema" value="1"> 
			<input type="hidden" name="accionborrarsistema"> 
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
			<input type="hidden" name="sistemcodigo" value="<?php if(!$flagdetallarsistema){ echo $sbreg[sistemcodigo];}else{ echo $sistemcodigo;} ?>"> 
 <input type="hidden" name="plantacodigo" value="<?php echo $plantacodigo; ?>">
 <input type="hidden" name="accionconsultarsistema" value="<?php echo $accionconsultarsistema; ?>">
	
	</form> 
	</body> 
<?php if(!$codigo){ echo " -->"; }?> 
</html> 
