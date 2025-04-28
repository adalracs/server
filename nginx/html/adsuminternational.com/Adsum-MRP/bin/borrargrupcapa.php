<?php 
	include ( '../src/FunGen/sesion/fncvalses.php');
	include ( '../src/FunPerPriNiv/pktblusuario.php');
	include ( '../src/FunPerPriNiv/pktblcargo.php');
	include ( '../src/FunPerPriNiv/pktbldepartam.php');
	include ( '../src/FunPerPriNiv/pktblinsgrupcapa.php');
	include ( '../src/FunGen/cargainput.php');
	
	if(!$flagborrargrupcapa) 
	{ 
		include ( '../src/FunGen/sesion/fnccarga.php'); 
		$sbreg = fnccarga($nombtabl,$radiobutton);
		
		if (!$sbreg) 
			include( '../src/FunGen/fnccontfron.php');

		$idcon = fncconn();
		$rsInsgrupcapa = dinamicscaninsgrupcapa(array("grucapcodigo" => $sbreg[grucapcodigo]), $idcon);
		$nrInsgrupcapa = fncnumreg($rsInsgrupcapa);
	} 
?>
<html> 
	<head> 
		<title>Borrar de registro de grupo de capacitacion</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0"> 
		<?php include('../def/jquery.library_maestro.php');?>
	</head> 
<?php if(!$codigo){ echo "<!--";} ?> 
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Grupos de capacitaci&oacute;n</font></p> 
			<table border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content" width="700">
  				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr> 
  				<tr><td class="ui-widget-header"><span class="style5"><font color="FFFFFF"> Borrar registro</font></span></td></tr> 
				<tr> 
  					<td> 
            			<table width="98%" border="0" cellspacing="1" cellpadding="1" align="center"> 
							<tr> 
 								<td width="22%" class="NoiseFooterTD">&nbsp;C&oacute;digo</td> 
  								<td width="78%" class="NoiseDataTD"><?php echo $sbreg[grucapcodigo]; ?></td> 
 							</tr> 
							<tr> 
 								<td class="NoiseFooterTD">&nbsp;Nombre</td> 
  								<td class="NoiseDataTD"><?php echo $sbreg[grucapnombre]; ?></td> 
 							</tr>  
						</table> 
					</td>
				</tr>
				<tr>
					<td>
						<table border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content" width="98%">
  							<tr><td class="ui-widget-header"><span class="style5"><font color="FFFFFF">Empleados</font></span></td></tr> 
							<tr> 
  								<td> 
            						<table width="100%" border="0" cellspacing="1" cellpadding="1" align="center" > 
										<tr>
       										<td width="10%" class="NoiseFooterTD">&nbsp;Id</td> 
 											<td width="40%" class="NoiseFooterTD">&nbsp;Nombre</td> 
 											<td width="25%" class="NoiseFooterTD">&nbsp;Cargo</td>
 											<td width="25%" class="NoiseFooterTD">&nbsp;Departamento</td>
 										</tr>
 										<?php 
 											if($nrInsgrupcapa > 0)
 											{
 												for($a = 0; $a < $nrInsgrupcapa; $a++)
 												{
 													$rwInsgrupcapa = fncfetch($rsInsgrupcapa, $a);
 													$rsUsuario = loadrecordusuario($rwInsgrupcapa['usuacodi'], $idcon);
 										?>
 										<tr>
 											<td class="NoiseDataTD"><?php echo $rsUsuario['usuacodi'];?></td> 
											<td class="NoiseDataTD"><?php echo $rsUsuario['usuanombre'].' '.$rsUsuario['usuapriape'].' '.$rsUsuario['usuasegape'];?></td> 
											<td class="NoiseDataTD"><?php echo cargacargonombre($rsUsuario['cargocodigo'], $idcon) ?></td> 
											<td class="NoiseDataTD"><?php echo cargadepartnombre($rsUsuario['departcodigo'], $idcon) ?></td> 
						 				</tr>
 										<?php
 												}
 											}
 											else
 											{
										?>
										<tr>
 											<td class="NoiseDataTD" colspan="4" align="center">Sin integrantes</td> 
						 				</tr>
						 				<?php 
 											}
 										?>
									</table>
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr> 
  					<td> 
            			<table width="98%" border="0" cellspacing="1" cellpadding="1" align="center"> 
							<tr><td class="NoiseFooterTD">&nbsp;Nota</td></tr>
							<tr><td class="NoiseDataTD"><p>&nbsp;<?php echo $sbreg[grucapdescri]; ?></p></td></tr>
						</table> 
					</td>
				</tr>
				<tr><td>&nbsp;</td></tr>
				<tr>
					<td class="NoiseErrorDataTD" align="center"><?php include '../def/jquery.button_form.php'; ?></td>
				</tr>
				<tr><td>&nbsp;</td></tr> 
 				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr> 
			</table> 
			<input type="hidden" name="accionborrargrupcapa">
			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>">
			<input type="hidden" name="sourceaction" value="borrar"> 			
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>">
			<input type="hidden" name="grucapcodigo" value="<?php echo $sbreg[grucapcodigo]; ?>"> 
		</form> 
	</body> 
<?php if(!$codigo){ echo " -->"; } ?> 
</html>