<?php 
include ( '../src/FunGen/sesion/fncvalses.php');
include('../src/FunPerPriNiv/pktblcargo.php');
include ( '../src/FunPerPriNiv/pktblgrupo.php');
include('../src/FunPerPriNiv/pktbldepartam.php');
include('../src/FunPerPriNiv/pktbltipousuario.php');

if(!$flagdetallarusuario)
{
	include ( '../src/FunGen/sesion/fnccarga.php');
	$sbreg = fnccarga($nombtabl,$radiobutton);
	if (!$sbreg)
	{
		include( '../src/FunGen/fnccontfron.php');
	}
	$idcon = fncconn();
	if($sbreg[usuacodi])
		include('validausuariopersonal.php');
	if($sbreg[cargocodigo])
		$sbregcargo = loadrecordcargo($sbreg[cargocodigo],$idcon);
		
	if($sbreg[tipusucodigo])
   		$sbregtipousuario = loadrecordtipousuario($sbreg[tipusucodigo],$idcon);
	
   	if($sbreg[departcodigo])
   		$sbregdepartam = loadrecorddepartam($sbreg[departcodigo],$idcon);
}
?> 
<html> 
	<head> 
		<title>Detalle de registro de empleados</title> 
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
			<p><font class="NoiseFormHeaderFont">Empleado</font></p> 
			<table width="60%" border="0" align="center" cellpadding="2" cellspacing="1" class="NoiseFormTABLE"> 
				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr> 
				<tr><td class="NoiseFieldCaptionTD"><span class="style5"><font color="FFFFFF"> Detallar registro</font></span></td></tr> 
				<tr>
    					<td>
      						<table width="95%" border="0" cellspacing="1" cellpadding="0" align="center">
							<tr class="NoiseFooterTD">
            							<td>&nbsp;Registro </td>
            							<td colspan="3"><?php if(!$flagdetallarusuario) echo $sbreg[usuacodi];?></td>
          							</tr>  
							<tr><td class="NoiseErrorDataTD" colspan="4"></td></tr>
          							<tr><td class="NoiseFieldCaptionTD" colspan="4"></td></tr>
        							<tr><td class="NoiseErrorDataTD" colspan="4"></td></tr>
							<tr class="NoiseErrorDataTD">
            							<td>&nbsp;No. de Identidad </td>
            							<td colspan="3"><?php if(!$flagdetallarusuario) echo $sbreg[usuadocume];?></td>
          							</tr>  
          							<tr>
            							<td class="NoiseFooterTD">&nbsp;Nombre</td>
            							<td colspan="3"  bgcolor="#E8F0F6"><?php if(!$flagdetallarusuario) echo $sbreg[usuanombre]." ".$sbreg[usuapriape]." ".$sbreg[usuasegape];?></td>
          							</tr>
          							<tr>
            							<td class="NoiseFooterTD">&nbsp;Tel&eacute;fono</td>
            							<td bgcolor="#E8F0F6"><?php if(!$flagdetallarusuario) echo $sbreg[usuatelefo]; ?></td>
            							<td class="NoiseFooterTD">&nbsp;Seg. Tel&eacute;fono</td>
            							<td bgcolor="#E8F0F6"><?php if(!$flagdetallarusuario) echo $sbreg[usuatelef2]; ?></td>
          							</tr>
          							<tr>
            							<td class="NoiseFooterTD">&nbsp;Direcci&oacute;n</td>
            							<td  bgcolor="#E8F0F6" colspan="3" rowspan="2" valign="top"><?php if(!$flagdetallarusuario) echo $sbreg[usuadirecc]; ?></td>
          							</tr>
          							<tr><td  class="NoiseFooterTD" height="52">&nbsp;</td></tr>
          							<tr>
            							<td class="NoiseFooterTD">&nbsp;E-mail</td>
            							<td colspan="3" bgcolor="#E8F0F6"><?php if(!$flagdetallarusuario) echo $sbreg[usuaemail]; ?></td>
          							</tr>
          							<tr>
            							<td class="NoiseFooterTD">&nbsp;Contacto</td>
            							<td colspan="3" bgcolor="#E8F0F6"><?php if(!$flagdetallarusuario) echo $sbreg[usuacontac]; ?></td>
            						</tr>
            						<tr>
            							<td class="NoiseFooterTD">&nbsp;Tel&eacute;fono</td>
            							<td bgcolor="#E8F0F6"><?php if(!$flagdetallarusuario) echo $sbreg[usuatelcon]; ?></td>
            							<td colspan="2"  bgcolor="#E8F0F6">&nbsp;</td>
          							</tr>          
							<tr><td class="NoiseErrorDataTD" colspan="4"></td></tr>
          							<tr><td class="NoiseFieldCaptionTD" colspan="4"></td></tr>
        							<tr><td class="NoiseErrorDataTD" colspan="4"></td></tr>
          							<tr>
            							<td class="NoiseFooterTD">&nbsp;Cargo</td>
            							<td bgcolor="#E8F0F6"><?php if(!$flagdetallarusuario){echo $sbregcargo[cargonombre];}else{echo $cargocodigo;} ?></td>
            							<td class="NoiseFooterTD">&nbsp;Depart&aacute;mento</td>
            							<td bgcolor="#E8F0F6"><?php if(!$flagdetallarusuario){echo $sbregcargo[cargonombre];}else{echo $cargocodigo;} ?></td>
          							</tr>   			
          							<tr>
            							<td class="NoiseFooterTD">&nbsp;Tipo de usuario</td>
            							<td bgcolor="#E8F0F6"><?php if(!$flagdetallarusuario){echo $sbregtipousuario[tipusunombre];}else{echo $tipusucodigo;} ?></td>
            							<td class="NoiseFooterTD">&nbsp;Valor hora</td>
            							<td bgcolor="#E8F0F6"><?php if(!$flagdetallarusuario) echo $sbreg[usuavalhor]; ?></td>
          							</tr>       
							<tr><td class="NoiseErrorDataTD" colspan="4"></td></tr>
          							<tr><td class="NoiseFieldCaptionTD" colspan="4"></td></tr>
        							<tr><td class="NoiseErrorDataTD" colspan="4"></td></tr>              
       						</table>
       					</td>
    				</tr>
				<tr> 
					<td><div align="center"> 
						<input type="image" name="aceptar"  src="../img/aceptar.gif" onclick="form1.action='maestablusuacolab.php';"  width="86" height="18" alt="Aceptar" border=0> 
					</div></td> 
				</tr> 
				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr> 
			</table> 
			<input type="hidden" name="flagdetallarusuario" value="1"> 
			<input type="hidden" name="acciondetallarusuario"> 
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
		</form> 
	</body> 
<?php if(!$codigo){ echo " -->"; } ?> 
</html> 
