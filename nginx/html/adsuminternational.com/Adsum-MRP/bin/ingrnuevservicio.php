<?php 
ob_start(); 
include ( '../src/FunGen/sesion/fncvalses.php'); 
include ( '../src/FunPerPriNiv/pktblnegocio.php'); 
if($accionnuevoservicio){ 
	include ( 'grabaservicio.php'); 
} 
ob_end_flush(); 
?> 
<!-- Propiedad intelectual de Adsum SA (c) 
-Todos los derechos reservados- 
Creado con WAG Adsum 
Autor: Andrés A. Riascos D. 
Fecha: 26052004 
GenVers: 3.1 --> 
<html> 
	<head> 
		<title>Nuevo registro de servicio</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0"> 
		<link rel="stylesheet" type="text/css" href="temas/Noise/Style.css"> 
		<SCRIPT LANGUAGE="JavaScript"> 
			<!-- Begin 
			agree = 0; 
			//  End --> 
		</script> 
	</head> 
<?php if(!$codigo){ echo "<!--";} ?> 
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Servicio</font></p> 
			<table width="450" border="0" align="center" cellpadding="0" cellspacing="0" class="NoiseFormTABLE"> 
				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr> 
				<tr><td class="NoiseFieldCaptionTD"><span class="style5"><font color="FFFFFF">Ingresar nuevo registro</font></span></td></tr> 
				<tr>
					<td> 
						<table width="85%" border="0" cellspacing="1" cellpadding="0" align="center"> 
							<tr> 
								<td width="29%" valign="top" class="NoiseFooterTD"><?php if($campnomb["negocicodigo"] == 1){$negocicodigo = null; echo "*";}?>&nbsp;Negocio</td>
            							<td  class="NoiseFooterTD"><select name="negocicodigo">
              							<?php
							 		if(!$negocicodigo)
			  							$negocicodigo = $sbreg[negocicodigo];
									$negocicodigo1 = $negocicodigo;
			  							
									echo '<option value = "">Seleccione</option>';
									
									$idcon = fncconn();
									$result = fullscannegocio($idcon);
	
									if($result > 0)
										$numReg = fncnumreg($result);
									
									if($numReg){
										for ($i = 0; $i < $numReg; $i++){
											$arr = fncfetch($result,$i);
									
											if($arr[negocicodigo] != 0){
												echo '<option value ="'.$arr[negocicodigo].'" ';
									
												//if($flageditarciudad){
												if($negocicodigo1 == $arr[negocicodigo])
													echo "selected";
												//}
												echo ">".$arr[negocinombre]."</option>"."\n";
											}
										}
									}									
								?>
            							</select></td>
							</tr>
							<tr> 
								<td valign="top" class="NoiseFooterTD"><?php if($campnomb["servicinombre"] == 1){$servicinombre = null; echo "*";}?>&nbsp;Nombre</td>
							  <td width="71%" class="NoiseFooterTD"><input type="text" name="servicinombre"	value="<?php if(!$flagnuevoservicio){ echo $sbreg[servicinombre];}else{ echo $servicinombre;} ?>"></td> 
							</tr> 
							<tr> 
								<td valign="top" class="NoiseFooterTD"><?php if($campnomb["servicidescri"] == 1){$servicidescri = null; echo "*";}?>&nbsp;Descripci&oacute;n</td>
								<td  rowspan="2" class="NoiseFooterTD"><textarea name="servicidescri" cols="34" rows="3"><?php if(!$flagnuevoservicio){ echo $sbreg[servicidescri];}else{ echo $servicidescri;}?></textarea></td>
							</tr>
							<tr valign="top" class="NoiseDataTD"><td class="NoiseFooterTD">&nbsp;</td></tr> 
						</table> 
					</td> 
				</tr> 
				<tr> 
					<td><div align="center"> 
						<input type="image" name="aceptar"  src="../img/aceptar.gif" onClick="form1.accionnuevoservicio.value =  1;"  width="86" height="18" alt="Aceptar" border=0> 
						<input type="image" name="cancelar" src="../img/cancelar.gif" onClick="form1.action='maestablservicio.php';"  width="86" height="18" alt="Cancelar" border=0> 
					</div></td> 
				</tr> 
				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr> 
			</table> 
<?php if($campnomb){echo '<font face = "Verdana" >Corregir los campos marcados con *</font>';} ?> 
			<input type="hidden" name="servicicodigo" value="<?php if(!$flagnuevoservicio){ echo $sbreg[servicicodigo];}else{ echo $servicicodigo; } ?>"> 
			<input type="hidden" name="accionnuevoservicio"> 
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
		</form> 
	</body> 
<?php if(!$codigo){ echo " -->"; } ?> 
</html> 
