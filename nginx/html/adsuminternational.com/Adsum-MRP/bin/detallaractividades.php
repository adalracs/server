<?php 
include ( '../src/FunGen/sesion/fncvalses.php'); 
include ('../src/FunPerPriNiv/pktblclases.php');
include ('../src/FunPerPriNiv/pktblunimedida.php');

if(!$flagdetallaractividades){ 
	include ( '../src/FunGen/sesion/fnccarga.php'); 
	$sbreg = fnccarga($nombtabl,$radiobutton); 
	
	if (!$sbreg){ 
		include( '../src/FunGen/fnccontfron.php'); 
	} 
	
	$idconn = fncconn();
	$sbclases = loadrecordclases($sbreg[clasecodigo],$idconn);
	$sbunidad = loadrecordunimedida($sbreg[unidadcodigo],$idconn);
} 
?> 
<!-- Propiedad intelectual de Adsum SA (c) 
-Todos los derechos reservados- 
Creado con WAG Adsum 
Autor: Andr�s A. Riascos D. 
Fecha: 26052004 
GenVers: 3.1 --> 
<html> 
	<head> 
		<title>Detalle de registro de actividades</title> 
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
			<p><font class="NoiseFormHeaderFont">Actividad</font></p> 
			<table width="60%" border="0" align="center" cellpadding="0" cellspacing="0" class="NoiseFormTABLE"> 
				<tr><td width="400" class="NoiseErrorDataTD">&nbsp;</td></tr> 
				<tr>
				  <td class="NoiseFieldCaptionTD"><span class="style5"><font color="FFFFFF">&nbsp;Detallar registro</font></span></td>
				</tr> 
								<tr><td width="400" >&nbsp;</td></tr> 
	  			<tr>
	  				<td> 
            			<table width="85%" border="0" cellspacing="1" cellpadding="2" align="center">
							<tr> 
								<td width="25%" class="NoiseFooterTD">&nbsp;C&oacute;digo</td> 
								<td width="75%" class="NoiseDataTD"><?php echo $sbreg[activicodigo];?></td> 
							</tr>
							<tr>
								<td width="25%" class="NoiseFooterTD">&nbsp;Clase</td> 
								<td width="75%" class="NoiseDataTD"><?php echo $sbclases[clasenombre];?></td>	  			
							</tr>						
							<tr>
							  <td class="NoiseFooterTD">&nbsp;Actividad</td>
							  <td width="75%" rowspan="2" valign="top" class="NoiseDataTD"><?php echo $sbreg[activinombre]; ?></td>
						  </tr>
							<tr class="NoiseFooterTD"> 
								<td width="25%" class="NoiseFooterTD">&nbsp;</td> 
							</tr> 
							<tr>
								<td width="25%" class="NoiseFooterTD">&nbsp;Unidad</td> 
								<td width="75%" class="NoiseDataTD"><?php echo $sbunidad[unidadnombre];?></td> 
							</tr>
							<tr> 
								<td width="25%" class="NoiseFooterTD">&nbsp;Valor varemo</td> 
								<td width="75%" class="NoiseDataTD"><?php echo $sbreg[activivalbar]; ?></td> 
							</tr> 
							<tr>
								<td width="25%" class="NoiseFooterTD">&nbsp;Descripci&oacute;n</td>
								<td rowspan="2" valign="top" class="NoiseDataTD"><?php echo $sbreg[actividescri]; ?></td>
							</tr>
							<tr class="NoiseFooterTD"><td width="25%">&nbsp;</td></tr> 
						</table> 
  					</td> 
 				</tr> 
				<tr ><td width="25%">&nbsp;</td></tr>
 				<tr> 	
					<td> 
						<div align="center"> 
  							<input type="image" name="aceptar"  src="../img/aceptar.gif" onClick="form1.action='maestablactividades.php';"  width="86" height="18" alt="Aceptar" border=0> 
						</div> 
					</td> 
 				</tr> 
 				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr> 
		  </table> 
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
		</form> 
	</body> 
<?php if(!$codigo){ echo " -->"; } ?> 
</html> 