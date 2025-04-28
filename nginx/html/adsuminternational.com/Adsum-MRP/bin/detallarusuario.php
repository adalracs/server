<?php
include ( '../src/FunGen/sesion/fncvalses.php');
include('../src/FunPerPriNiv/pktblgrupo.php');
include ( '../src/FunGen/fncusuagrup.php');
include('../src/FunPerPriNiv/pktblcargo.php');
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
	if($sbreg[cargocodigo])
	{
		$sbregcargo = loadrecordcargo($sbreg[cargocodigo],$idcon);
	   	$cargonomb = $sbregcargo[cargonombre];
	}
	if($sbreg[departcodigo])
	{
		$sbregdepartam = loadrecorddepartam($sbreg[departcodigo],$idcon);
		$departnomb = $sbregdepartam[departnombre];
	}
	
	if($sbreg[tipusucodigo])
	{
   		$sbregtipousuario = loadrecordtipousuario($sbreg[tipusucodigo],$idcon);
   		$tipusunomb = $sbregtipousuario[tipusunombre];
	}
	if($sbreg[usuacodi])
	{
		$nombre2 = fncusuagrup($sbreg[usuacodi],$idcon);
		$nombre3 = loadrecordgrupo($nombre2[grupcodi],$idcon);
		$gruponomb = $nombre3[grupnomb];
	}
	fncclose($idcon);
}
?>
<!-- C�digo creado por:
Andr�s Riascos
Fecha: 12012002 -->
<html>
	<head>
		<title>Detalle de registro de Usuarios</title>
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
	<body bgcolor="#FFFFFF" text="#000000">
		<form name="form1" method="post"  enctype="multipart/form-data">
			<p><font class="NoiseFormHeaderFont">Detalle de usuario</font></P> 
			<table border="0" cellspacing="1" cellpadding="2" align="center" class="NoiseFormTABLE" width="60%">
    				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr>
    				<tr><td class="NoiseFieldCaptionTD"><span class="style5"><font color="FFFFFF">Detallar usuario</font></span></td></tr>
  				<tr>
    					<td>
      						<table width="95%" border="0" cellspacing="1" cellpadding="0" align="center">
        							<tr><td class="NoiseFieldCaptionTD" colspan="4"></td></tr>
        							<tr><td class="NoiseErrorDataTD" colspan="4"></td></tr>
    							<tr>
        								<td width="22%" height="20" class="NoiseFooterTD">&nbsp;Registro</td>
        								<td width="25%" bgcolor="#E8F0F6"><?php if(!$flagdetallarusuario) echo $sbreg[usuacodi];?></td>
        								<td colspan="2" bgcolor="#E8F0F6">&nbsp;</td>
          							</tr>
          							<tr>
            							<td width="22%" class="NoiseFooterTD">&nbsp;Login</td>
            							<td width="25%" bgcolor="#E8F0F6"><?php if(!$flagdetallarusuario) echo $sbreg[usuanomb];?></td>
            							<td width="22%" class="NoiseFooterTD">&nbsp;Clave</td>
            							<td width="25%" bgcolor="#E8F0F6"><?php if(!$flagdetallarusuario){if($sbreg[usuapass]){echo "**********";}else{echo "- - - - - - - -";} } ?></td>
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
            							<td bgcolor="#E8F0F6"><?php if(!$flagdetallarusuario)echo $cargonomb;?></td>
            							<td class="NoiseFooterTD">&nbsp;Depart&aacute;mento</td>
            							<td bgcolor="#E8F0F6"><?php if(!$flagdetallarusuario) echo $departnomb;?></td>
          							</tr>   			
          							<tr>
            							<td class="NoiseFooterTD">&nbsp;Tipo de usuario</td>
            							<td bgcolor="#E8F0F6"><?php if(!$flagdetallarusuario) echo $tipusunomb;?></td>
            							<td class="NoiseFooterTD">&nbsp;Valor hora</td>
            							<td bgcolor="#E8F0F6"><?php if(!$flagdetallarusuario) echo $sbreg[usuavalhor]; ?></td>
          							</tr>                     
							<tr><td class="NoiseErrorDataTD" colspan="4"></td></tr>
          							<tr><td class="NoiseFieldCaptionTD" colspan="4"></td></tr>
        							<tr><td class="NoiseErrorDataTD" colspan="4"></td></tr>	
							<tr>
            							<td class="NoiseFooterTD">&nbsp;Grupo</td>
            							<td bgcolor="#E8F0F6"><?php if(!$flagdetallarusuario) echo $gruponomb; ?></td>
            							<td class="NoiseFooterTD">&nbsp;Estado</td>
            							<td bgcolor="#E8F0F6"><?php if($sbreg[usuaacti] == 1){echo 'Activo';}else{echo 'Inactivo';} ?></td>
          							</tr>    
       						</table>
       					</td>
    				</tr>
        				<tr>
          					<td colspan="2">
              					<div align="center">
                						<input type="image" name="aceptar" src="../img/aceptar.gif" onclick="form1.action='maestablusuario.php';submit();"  width="86" height="18" alt="Aceptar" border=0>
              					</div>
            				</td>
        				</tr>
 				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr> 
      			</table>
			      	
			<input type="hidden" name="flagdetallarusuario" value="1">
			<input type="hidden" name="acciondetallarusuario">
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>">
			<input type="hidden" name="nombtabl" value="vistausuacuadrilla">
			<input type="hidden" name="columnas" value="usuacodi,
cargocodigo,
departcodigo,
tipusucodigo,
usuanomb,
usuapass,
usuaacti,
usuadocume,
usuanombre,
usuapriape,
usuasegape,
usuatelefo,
usuatelef2,
usuacontac,
usuatelcon,
usuadirecc,
usuaemail,
usuavalhor,
usuaactiot">
			<input type="hidden" name="usuacodi" value="<?php echo $usuacodi; ?>">
			<input type="hidden" name="cargocodigo" value="<?php echo $cargocodigo; ?>">
			<input type="hidden" name="departcodigo" value="<?php echo $departcodigo; ?>">
			<input type="hidden" name="tipusucodigo" value="<?php echo $tipusucodigo; ?>">
			<input type="hidden" name="usuanomb" value="<?php echo $usuanomb; ?>">
			<input type="hidden" name="usuapass" value="<?php echo $usuapass; ?>">
			<input type="hidden" name="usuaacti" value="<?php echo $usuaacti; ?>">
			<input type="hidden" name="usuadocume" value="<?php echo $usuadocume; ?>">
			<input type="hidden" name="usuanombre" value="<?php echo $usuanombre; ?>">
			<input type="hidden" name="usuapriape" value="<?php echo $usuapriape; ?>">
			<input type="hidden" name="usuasegape" value="<?php echo $usuasegape; ?>">
			<input type="hidden" name="usuatelefo" value="<?php echo $usuatelefo; ?>">
			<input type="hidden" name="usuatelef2" value="<?php echo $usuatelef2; ?>">
			<input type="hidden" name="usuacontac" value="<?php echo $usuacontac; ?>">
			<input type="hidden" name="usuatelcon" value="<?php echo $usuatelcon; ?>">
			<input type="hidden" name="usuadirecc" value="<?php echo $usuadirecc; ?>">
			<input type="hidden" name="usuaemail" value="<?php echo $usuaemail; ?>">
			<input type="hidden" name="usuavalhor" value="<?php echo $usuavalhor; ?>">
			<input type="hidden" name="usuaactiot" value="<?php echo $usuaactiot; ?>">
			<input type="hidden" name="accionconsultarusuario" value="<?php echo $accionconsultarusuario; ?>">
		</form>
	</body>
<?php
if(!$codigo)
{ echo " -->"; }
?>
</html>
