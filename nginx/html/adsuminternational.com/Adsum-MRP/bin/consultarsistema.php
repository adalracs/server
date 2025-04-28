<?php 
	include ( '../src/FunGen/sesion/fncvalses.php'); 
	include ( '../src/FunPerPriNiv/pktblplanta.php');	
?> 
<html> 
	<head> 
		<title>Consultar en Sistema</title> 
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
<?php if(!$codigo){ echo "<!--";} ?> 
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Proceso</font></p> 
			<table border="0" cellspacing="1" cellpadding="2" align="center" class="NoiseFormTABLE"> 
				<tr><td width="276" class="NoiseErrorDataTD">&nbsp;</td>
				</tr> 
				<tr><td class="NoiseFieldCaptionTD"><span class="style5"><font color="FFFFFF">Consultar registro</font></span></td></tr> 
				<tr> 
					<td> 
						<table width="96%" border="0" cellspacing="1" cellpadding="0" align="center"> 
							<tr> 
								<td width="34%" class="NoiseFooterTD">C&oacute;digo</td> 
							  <td width="66%" class="NoiseFooterTD"><input type="text" name="sistemcodigo"	value="<?php if(!$flagconsultarsistema){ echo $sbreg[sistemcodigo];}else{ echo $sistemcodigo;} ?>"></td> 
							</tr> 
							<tr> 
								<td width="34%" class="NoiseFooterTD">Planta</td> 
								<td width="66%" class="NoiseFooterTD"><select name="plantacodigo">
   									<?php
								 		if(!$plantacodigo)
				  							$plantacodigo = $sbreg[plantacodigo];
				
										echo '<option value = "">Seleccione</option>';
										
										include ('../src/FunGen/floadplanta.php');
										$idcon = fncconn();
										floadplanta($plantacodigo,$idcon);
										fncclose($idcon);
									?>
							  </select></td> 
							</tr> 
							<tr> 
								<td width="34%" class="NoiseFooterTD">Nombre</td> 
							  <td width="66%" class="NoiseFooterTD"><input type="text" name="sistemnombre"	value="<?php if(!$flagconsultarsistema){ echo $sbreg[sistemnombre];}else{ echo $sistemnombre;} ?>"></td> 
							</tr> 
							<tr> 
								<td width="34%" class="NoiseFooterTD">Descripci&oacute;n</td> 
							  <td width="66%" rowspan="2" class="NoiseFooterTD"><textarea name="sistemdescri" rows="3" wrap="VIRTUAL"><?php if(!$flagconsultarsistema){ echo $sbreg[sistemdescri];}else{ echo $sistemdescri;} ?></textarea></td>
							</tr>
							<tr><td class="NoiseFooterTD">&nbsp;</td>
							</tr> 

					  </table> 
					</td> 
				</tr> 
				<tr> 
					<td><div align="center"> 
						<input type="image" name="aceptar"  src="../img/aceptar.gif" onClick="form1.accionconsultarsistema.value =  1; form1.action='maestablsistema.php';"  width="86" height="18" alt="Aceptar" border=0> 					
						<input type="image" name="cancelar" src="../img/cancelar.gif" onClick="form1.action='maestablsistema.php';"  width="86" height="18" alt="Cancelar" border=0> 
					</div></td> 
				</tr> 
				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr> 
			</table> 
			<input type="hidden" name="flagconsultarsistema" value="1"> 
			<input type="hidden" name="accionconsultarsistema"> 
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
			<input type="hidden" name="columnas" value="sistemcodigo, 
plantacodigo, 
sistemnombre, 
sistemdescri,
tipsiscodigo 
"> 
			<input type="hidden" name="nombtabl" value="sistema"> 
		</form> 	
	</body> 
<?php if(!$codigo){ echo " -->"; } ?> 
</html> 
