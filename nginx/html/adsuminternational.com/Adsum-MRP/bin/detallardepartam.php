<?php 
include ( '../src/FunGen/sesion/fncvalses.php');
if(!$flagdetallardepartam){
	include ( '../src/FunGen/sesion/fnccarga.php');
	$sbreg = fnccarga($nombtabl,$radiobutton);
	if (!$sbreg)
		include( '../src/FunGen/fnccontfron.php');
		
	include ('../src/FunPerPriNiv/pktblnegocio.php');
	$idcon = fncconn();
	$rs_negocio = loadrecordnegocio($sbreg[negocicodigo], $idcon);
}
?> 
<html> 
	<head> 
		<title>Detalle de registro de departamento</title> 
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
			<p><font class="NoiseFormHeaderFont">Departamento</font></p> 
			<table width="40%" border="0" align="center" cellpadding="2" cellspacing="1" class="NoiseFormTABLE"> 
				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr> 
				<tr><td class="NoiseFieldCaptionTD"><span class="style5"><font color="FFFFFF">Detallar registro</font></span></td></tr> 
				<tr> 
					<td> 
						<table width="85%" border="0" cellspacing="1" cellpadding="3" align="center"> 
							<tr> 
								<td width="33%" valign="top" class="NoiseFooterTD">&nbsp;C&oacute;digo</td>
								<td width="67%" class="NoiseDataTD"><?php if(!$flagdetallardepartam){ echo $sbreg[departcodigo];}else{ echo $departcodigo;} ?></td> 
							</tr> 
							<tr> 
								<td width="33%" valign="top" class="NoiseFooterTD">&nbsp;Nombre</td> 
								<td width="67%" class="NoiseDataTD"><?php if(!$flagdetallardepartam){ echo $sbreg[departnombre];}else{ echo $departnombre;} ?></td> 
							</tr> 
							<tr> 
								<td width="33%" valign="top" class="NoiseFooterTD">&nbsp;Negocio</td> 
								<td width="67%" class="NoiseDataTD"><?php if(!$flagdetallardepartam){ echo $rs_negocio[negocinombre];}else{ echo $rs_negocio[negocinombre];} ?></td> 
							</tr> 
							<tr> 
								<td width="33%" valign="top" class="NoiseFooterTD">&nbsp;Descripci&oacute;n</td> 
								<td width="67%" rowspan="2" class="NoiseDataTD"><?php if(!$flagdetallardepartam){ echo $sbreg[departdescri];}else{ echo $departdescri;} ?></td> 
							</tr>
							<tr valign="top" class="NoiseFooterTD"><td>&nbsp;</td>
							</tr> 
					  </table> 
					</td> 
				</tr> 
				<tr> 
					<td> 
						<div align="center"> 
							<input type="image" name="aceptar"  src="../img/aceptar.gif" onClick="form1.action='maestabldepartam.php';"  width="86" height="18" alt="Aceptar" border=0> 
						</div> 
					</td> 
				</tr> 
				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr> 
			</table> 
			<input type="hidden" name="flagdetallardepartam" value="1"> 
			<input type="hidden" name="acciondetallardepartam"> 
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
		</form> 
	</body> 
<?php if(!$codigo){ echo " -->"; }?> 
</html> 
