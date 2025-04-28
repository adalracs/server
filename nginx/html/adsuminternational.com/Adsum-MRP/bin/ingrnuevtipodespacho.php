<?php 
ob_start(); 
	include ( '../src/FunGen/sesion/fncvalses.php'); 
	if($accionnuevotipodespacho){ 
		                      
		include ( 'grabatipodespacho.php'); 
		 
	} 
ob_end_flush(); 
?> 
<!-- Propiedad intelectual de Adsum SA (c) 
-Todos los derechos reservados- 
Creado con WAG Adsum 
Autor: cbedoya 
Fecha: 30-November-2007 
GenVers: 3.1 --> 
<html> 
	<head> 
		<title>Nuevo registro de tipos de despachos</title> 
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
		<form name="form1" method="post"  enctype="multipart/form-data" action="ingrnuevtipodespacho.php"> 
			<p><font class="NoiseFormHeaderFont">Tipo de despacho</font></p> 
			<table width="350" border="0" align="center" cellpadding="2" cellspacing="1" class="NoiseFormTABLE"> 
  				<tr><td width="300" class="NoiseErrorDataTD">&nbsp;</td></tr> 
  				<tr><td class="NoiseFieldCaptionTD"><span class="style5"><font color="FFFFFF">Ingresar nuevo registro</font></span></td></tr> 
				<tr>
					<td> 
            			<table width="85%" border="0" cellspacing="1" cellpadding="0" align="center"> 
 							<tr> 
 								<td width="41%" class="NoiseDataTD"><?php if($campnomb["tipdesnombre"] == 1){$tipdesnombre = null; echo "*";}?>&nbsp;Nombre</td>
 								<td width="59%"><input type="text" name="tipdesnombre" value="<?php if(!$flagnuevotipodespacho){ echo $sbreg[tipdesnombre];}else{ echo $tipdesnombre; }?>"></td> 
 							</tr> 
 							<tr>
 								<td width="41%" class="NoiseDataTD"> <?php if($campnomb["tipdesdescri"] == 1){ $tipdesdescri=null; echo "*";} ?>&nbsp;Descripci&oacute;n</td>
  								<td rowspan="2"><textarea name="tipdesdescri" rows="3" wrap="VIRTUAL"><?php if(!$flagnuevotipodespacho){echo $sbreg[tipdesdescri];}else {echo $tipdesdescri;}?></textarea></td>
 							</tr>
 							<tr class="NoiseDataTD"><td width="41%">&nbsp;</td></tr> 
						</table> 
  					</td> 
 				</tr> 
 				<tr> 
					<td><div align="center"> 
			  			<input type="image" name="aceptar"  src="../img/aceptar.gif" onclick="form1.accionnuevotipodespacho.value=1;"  width="86" height="18" alt="Aceptar" border=0> 
  						<input type="image" name="cancelar" src="../img/cancelar.gif" onclick="form1.action='maestabltipodespacho.php';"  width="86" height="18" alt="Cancelar" border=0> 
  						
					</div></td> 
 				</tr>                                                       
 				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr> 
			</table> 
<?php if($campnomb){echo '<font face = "Verdana" >Corregir los capos marcados con *</font>';} ?> 
			
			<input type="hidden" name="tipdescodigo" value="<?php if(!$flagnuevotipodespacho){ echo $sbreg[tipdescodigo];}else{ echo $tipdescodigo; } ?>"> 
			<input type="hidden" name="accionnuevotipodespacho"> 
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
		</form> 
	</body> 
<?php if(!$codigo){ echo " -->"; } ?> 
</html> 