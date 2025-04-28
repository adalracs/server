<?php
	include ('../src/FunGen/sesion/fncvalses.php');
	include ('../src/FunPerPriNiv/pktblgrupo.php');
//	include ('../src/FunPerPriNiv/pktblcargo.php');
//	include ('../src/FunPerPriNiv/pktbldepartam.php');
//	include ('../src/FunPerPriNiv/pktbltipousuario.php');
	
	if(!$flagdetallarusuario)
	{
		include ( '../src/FunGen/sesion/fnccarga.php');
		$sbreg = fnccarga($nombtabl,$radiobutton);
		if (!$sbreg)
			include( '../src/FunGen/fnccontfron.php');

		$idcon = fncconn();
	
	   	if($sbreg[grupcodi])
			$sbreggrupo = loadrecordgrupo($sbreg[grupcodi],$idcon);
			
		fncclose($idcon);
	}
?>
<!-- C�digo creado por:
Andr�s Riascos
Fecha: 12012002 -->
<html>
	<head>
		<title>Detalle de registro de Contratistas</title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		<meta http-equiv="expires" content="0">
		<?php include('../def/jquery.library_maestro.php');?>
	</head>
<?php if(!$codigo){ echo "<!--";} ?>
	<body bgcolor="#FFFFFF" text="#000000">
		<form name="form1" method="post"  enctype="multipart/form-data">
			<p><font class="NoiseFormHeaderFont">Clientes</font></P> 
			<table border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content" width="650">
    			<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr>
    			<tr><td class="ui-widget-header"><span class="style5"><font color="FFFFFF">Detallar cliente</font></span></td></tr>
       			<?php if($sbreg[usuanomb]): ?>
    			<tr>
					<td>
       					<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center">
      						<tr><td class="ui-state-default">&nbsp;Datos de Logueo</td></tr>
      						<tr>
								<td>
									<table width="100%" border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content">
			      						<tr>
			        						<td width="20%" class="NoiseFooterTD">&nbsp;Login</td>
			        						<td width="30%" class="NoiseDataTD"><?php echo $sbreg[usuanomb]; ?></td>
			        						<td width="20%" class="NoiseFooterTD">&nbsp;Clave</td>
			        						<td width="30%" class="NoiseDataTD"><?php if($sbreg[usuapass]){ echo "**********"; } else{ echo "- - - - - - - -"; } ?></td>
			      						</tr>
			      						<tr><td colspan="4" class="NoiseErrorDataTD"></td></tr>
			       					</table>
			       					<table width="100%" border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content">
			       						<tr><td colspan="4" class="NoiseErrorDataTD"></td></tr>
      		          					<tr>
			            					<td width="20%" class="NoiseFooterTD">&nbsp;Grupo</td>
			            					<td colspan="3" class="NoiseDataTD"><?php echo $sbreggrupo[grupnomb]; ?></td>
			          					</tr>    
			       					</table>
		       					</td>
		       				</tr>
		       			</table>
       				</td>
       			</tr>
       			<?php endif; ?>
				<tr>
					<td>
        				<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center">
        					<tr><td class="ui-state-default">&nbsp;Datos de Contratista</td></tr>
        					<tr>
								<td>
									<table width="100%" border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content">
			        					<!-- <tr class="NoiseErrorDataTD">
			       							<td width="20%">&nbsp;C&oacute;digo</td>
			       							<td colspan="3"><?php echo $sbreg[usuacodi]; ?></td>
			        					</tr> -->
        					
										<tr class="NoiseErrorDataTD">
			           						<td width="20%">&nbsp;NIT</td>
			           						<td colspan="3"><?php echo $sbreg[usuadocume]; ?></td>
			     						</tr>  
			   							<tr>
			           						<td class="NoiseFooterTD" width="20%">&nbsp;Raz&oacute;n solcial</td>
			           						<td class="NoiseDataTD" colspan="3"><?php echo $sbreg[usuanombre]; ?></td>
			      						</tr>
			      						<tr>
			           						<td class="NoiseFooterTD">&nbsp;Tel&eacute;fono</td>
			           						<td class="NoiseDataTD"><?php echo $sbreg[usuatelefo]; ?></td>
			           						<td class="NoiseFooterTD">&nbsp;Fax</td>
			           						<td class="NoiseDataTD"><?php echo $sbreg[usuatelef2]; ?></td>
			         					</tr>
         								<tr><td class="NoiseFooterTD" colspan="4">&nbsp;Direcci&oacute;n</td></tr>
			           					<tr><td colspan="4" class="NoiseDataTD">&nbsp;<?php echo $sbreg[usuadirecc].' '.$ciudad; ?></td></tr>
			           					<tr><td colspan="4" class="NoiseErrorDataTD"></td></tr>
         							</table>
         							<table width="100%" border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content">
         								<tr><td colspan="4" class="NoiseErrorDataTD"></td></tr>
										<tr>
			           						<td class="NoiseFooterTD">&nbsp;Contacto</td>
			           						<td colspan="3" class="NoiseDataTD"><?php echo $sbreg[usuacontac];  ?></td>
			         					</tr>          
										<tr>
			           						<td class="NoiseFooterTD">&nbsp;Cargo</td>
			           						<td colspan="3" class="NoiseDataTD"><?php echo $sbreg[usuaricarcon];  ?></td>
			         					</tr> 
			         					<tr>
			           						<td class="NoiseFooterTD">&nbsp;E-mail</td>
			           						<td class="NoiseDataTD" colspan="3"><?php echo $sbreg[usuaemail]; ?></td>
			         					</tr>        
			         					<tr>
			           						<td class="NoiseFooterTD">&nbsp;Tel&eacute;fono</td>
			           						<td class="NoiseDataTD" colspan="3"><?php echo $sbreg[usuatelcon]; ?></td>
			         					</tr>   
			          					<tr><td colspan="4" class="NoiseErrorDataTD"></td></tr>
			          					<tr>
			           						<td class="NoiseFooterTD">&nbsp;Estado</td>
			            					<td colspan="3" class="NoiseDataTD"><?php if($sbreg[usuaacti] == 1){echo 'Activo';}else{echo 'Inactivo';} ?></td>
			          					</tr>     
      								</table>
      							</td>
    						</tr>
    					</table>
    				</td>
    			</tr>
				<tr><td>&nbsp;</td></tr>
				<tr>
					<td class="NoiseErrorDataTD" align="center"><?php include '../def/jquery.button_formdetall.php'; ?></td>
				</tr>
				<tr><td>&nbsp;</td></tr> 
 				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr>
      		</table>
			<input type="hidden" name="flagdetallarcliente" value="1">
			<input type="hidden" name="acciondetallarcliente">
			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>">
			<input type="hidden" name="sourceaction" value="detallar">			
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
usuaactiot,
grupcodi">
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
			<input type="hidden" name="grupcodi" value="<?php echo $grupcodi; ?>">
			<input type="hidden" name="accionconsultarusuario" value="<?php echo $accionconsultarusuario; ?>">
			<input type="hidden" name="soliserv" value="<?php echo $soliserv;?>">
		</form>
	</body>
<?php
if(!$codigo)
{ echo " -->"; }
?>
</html>
