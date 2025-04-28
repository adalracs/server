<?php 
include ( '../src/FunGen/sesion/fncvalses.php'); 
include ('../src/FunPerPriNiv/pktblclases.php');
include ('../src/FunPerPriNiv/pktblunimedida.php');

if(!$flagborraractividades){ 
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
		<title>Borrar registro de actividades</title> 
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
			<p><font class="NoiseFormHeaderFont">Actividades</font></p> 
			<table width="400" border="0" align="center" cellpadding="0" cellspacing="0" class="NoiseFormTABLE"> 
  				<tr><td width="400" class="NoiseErrorDataTD">&nbsp;</td></tr> 
  				<tr><td class="NoiseFieldCaptionTD"><span class="style5"><font color="FFFFFF"> Borrar registro</font></span></td></tr> 
	  			<tr>
	  				<td> 
            			<table width="85%" border="0" cellspacing="1" cellpadding="2" align="center">
							<tr> 
								<td width="20%" class="NoiseDataTD">&nbsp;C&oacute;digo</td> 
								<td width="80%"><?php echo $sbreg[activicodigo];?></td> 
							</tr>
							<tr>
								<td width="20%" class="NoiseDataTD">&nbsp;Clase</td> 
								<td width="80%"><?php echo $sbclases[clasenombre];?></td>	  			
							</tr>						
							<tr> 
								<td width="20%" class="NoiseDataTD">&nbsp;Actividad</td> 
								<td width="80%"><?php echo $sbreg[activinombre]; ?></td> 
							</tr> 
							<tr>
								<td width="20%" class="NoiseDataTD">&nbsp;Unidad</td> 
								<td width="59%"><?php echo $sbunidad[unidadnombre];?></td> 
							</tr>
							<tr> 
								<td width="20%" class="NoiseDataTD">&nbsp;Valor varemo</td> 
								<td width="59%"><?php echo $sbreg[activivalbar]; ?></td> 
							</tr> 
							<tr>
								<td width="20%" class="NoiseDataTD">&nbsp;Descripci&oacute;n</td>
								<td rowspan="2" valign="top"><?php echo $sbreg[actividescri]; ?></td>
							</tr>
							<tr class="NoiseDataTD"><td width="41%">&nbsp;</td></tr> 
						</table> 
  					</td> 
 				</tr>  
 				<tr> 
					<td> 
						<div align="center"> 
  							<input type="image" name="aceptar"  src="../img/aceptar.gif" onclick="form1.accionborraractividades.value = 1; form1.action='maestablactividades.php';"  width="86" height="18" alt="Aceptar" border=0> 
  							<input type="image" name="cancelar" src="../img/cancelar.gif" onclick="form1.action='maestablactividades.php';"  width="86" height="18" alt="Cancelar" border=0> 
						</div> 
					</td> 
 				</tr> 
 				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr> 
			</table> 
 			<input type="hidden" name="flagborrarciudad" value="1"> 
			<input type="hidden" name="accionborraractividades"> 
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
			<input type="hidden" name="activicodigo" value="<?php echo $sbreg[activicodigo]; ?>"> 
		</form> 
	</body> 
<?php if(!$codigo){ echo " -->"; } ?> 
</html> 
