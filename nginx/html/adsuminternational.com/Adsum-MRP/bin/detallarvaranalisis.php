<?php 
	include ( '../src/FunPerPriNiv/pktbltiposoliprog.php');
	include ( '../src/FunPerPriNiv/pktbltipoitemdesa.php');
	include ( '../src/FunPerPriNiv/pktbltipocalidad.php');
	include ( '../src/FunPerPriNiv/pktblunimedida.php');
	include ( '../src/FunPerPriNiv/pktblusuario.php');
	include ( '../src/FunGen/sesion/fncvalses.php');
	include ( '../src/FunGen/cargainput.php');	
	
	if(!$flagdetallarproveedo)
	{
		include ( '../src/FunGen/sesion/fnccarga.php');
		$sbreg = fnccarga($nombtabl,$radiobutton);
		if (!$sbreg)
			include( '../src/FunGen/fnccontfron.php');
			
		$idcon = fncconn();

		$varanacodigo = $sbreg["varanacodigo"];
		$tipcalcodigo = $sbreg["tipcalcodigo"];
		$tipitemcodigo = $sbreg["tipitemcodigo"];
		$tipsolcodigo = $sbreg["tipsolcodigo"];
		$varananombre = $sbreg["varananombre"];
		$usuacodigo = $sbreg["usuacodi"];
		$varanafecha = $sbreg["varanafecha"];
		$unidadcodigo = $sbreg["unidadcodigo"];
		$varanatipespe = $sbreg["varanatipespe"];
		$varanatolemn = $sbreg["varanatolemn"];
		$varanatolems = $sbreg["varanatolems"];
		$varanadetesp = $sbreg["varanadetesp"];
		$varanadescri = $sbreg["varanadescri"];

		$arrvaranatipespe = array( 1 => "Rango +/-", 2 => "Mayor Igual >=", 3 => "Menor Igual <=", 4 => "Binario 1/0", 5 => "Tolerancia +/- (%)" );

		if( $varanatipespe == 2 ){

			$varanadetespmayor = $varanadetesp;

		}else if( $varanatipespe == 3 ){

			$varanadetespmenor = $varanadetesp;

		}

	}
?>
<html> 
	<head> 
		<title>Detalle registro de variables de analisis</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0"> 
		<?php include('../def/jquery.library_maestro.php');?>
	</head> 
<?php if(!$codigo){ echo "<!--";} ?>
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Variables de analisis</font></p> 
			<table border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content" width="650">
				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr>	
  				<tr><td class="ui-widget-header"><span class="style5"><font color="FFFFFF"> Detallar registro</font></span></td></tr> 
  				<tr> 
  					<td> 
            			<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center"> 
            				<tr>
								<td width="30%" class="NoiseFooterTD">&nbsp;Codigo</td>
								<td width="70%" class="NoiseDataTD"><?php echo ($varanacodigo)? $varanacodigo : "---" ; ?></td> 
 							</tr>
            				<tr>
								<td width="30%" class="NoiseFooterTD">&nbsp;Usuario</td>
								<td width="70%" class="NoiseDataTD"><?php echo ($usuacodigo)? cargausuanombre($usuacodigo,$idcon) : "---" ; ?></td> 
 							</tr>
 							<tr>
								<td width="30%" class="NoiseFooterTD">&nbsp;Fecha</td>
								<td width="70%" class="NoiseDataTD"><?php echo ($varanafecha)? $varanafecha : "---" ; ?></td> 
 							</tr>
 							<tr>
     							<td width="30%" class="NoiseFooterTD">&nbsp;Formato de calidad</td>
     							<td width="70%" class="NoiseDataTD"><?php echo ($tipcalcodigo)? carganombretipocalidad($tipcalcodigo, $idcon) : "---" ; ?></td>
    						</tr>
    						<tr>
    							<td width="30%" class="NoiseFooterTD"><span id="lbltipitemcodigo" style="display:<?php echo ($tipcalcodigo == 1)? "block" : "none" ; ?>">&nbsp;Plan Inspecci&oacute;n</span></td>
				     			<td width="70%" class="NoiseDataTD"><span id="objtipitemcodigo" style="display:<?php echo ($tipcalcodigo == 1)? "block" : "none" ; ?>"><?php echo ($tipitemcodigo)? carganombretipoitemdesa($tipitemcodigo, $idcon) : "---"; ?></span></td>						
		    				</tr>
		    				<tr>
		    					<td width="30%" class="NoiseFooterTD"><span id="lbltipsolcodigo" style="display:<?php echo ($tipcalcodigo == 2)? "block" : "none" ;?>">&nbsp;Plan Inspecci&oacute;n</span></td>
	     						<td width="70%" class="NoiseDataTD"><span id="objtipsolcodigo" style="display:<?php echo ($tipcalcodigo == 2)? "block" : "none" ;?>"><?php echo ($tipsolcodigo)? cargatiposoliprognombre($tipsolcodigo,$idcon) : "---" ; ?></span></td>
    						</tr>
    						<tr>
								<td width="30%" class="NoiseFooterTD">&nbsp;Nombre</td>
								<td width="70%" class="NoiseDataTD"><?php echo ($varananombre)? $varananombre : "---" ; ?></td>
 							</tr>
      						<tr>
     							<td width="30%" class="NoiseFooterTD">&nbsp;Unidad de Medida</td>
     							<td width="70%" class="NoiseDataTD"><?php echo ($unidadcodigo)? $unidadcodigo : "---" ; ?></td>
							</tr>	
							<tr>
								<td width="30%" class="NoiseFooterTD">&nbsp;Tipo especificacion</td>
								<td width="70%" class="NoiseDataTD"><?php echo ($arrvaranatipespe[$varanatipespe])? $arrvaranatipespe[$varanatipespe] : "---" ; ?></td>
 							</tr>
 							<tr>
 								<td width="30%" class="NoiseFooterTD"><span id="lblvaranatole" style="display:<?php echo ($varanatipespe == 1 || $varanatipespe == 5)? "block" : "none" ; ?>">&nbsp;Rango</span></td>
 								<td width="70%" class="NoiseDataTD"><span id="objvaranatole" style="display:<?php echo ($varanatipespe == 1 || $varanatipespe == 5)? "block" : "none" ; ?>">
 									<b>+</b>&nbsp;<?php echo ($varanatolems)? $varanatolems : "0" ; ?>
									<b>-</b>&nbsp;<?php echo ($varanatolemn)? $varanatolemn : "0" ; ?>
 								</span></td>
 							</tr>
 							<tr>
								<td width="30%"  class="NoiseFooterTD"><span id="lblvaranadetespmayor" style="display:<?php echo ($varanatipespe == 2)? "block" : "none" ; ?>">&nbsp;Mayor Igual</span></td>
								<td width="70%" class="NoiseDataTD"><span id="objvaranadetespmayor" style="display:<?php  echo ($varanatipespe == 2)? "block" : "none" ; ?>">
									<b>>=</b>&nbsp;<?php echo ($varanadetespmayor)? $varanadetespmayor : "0" ?>
								</span></td>
 							</tr>
 							<tr>
								<td width="30%" class="NoiseFooterTD"><span id="lblvaranadetespmenor" style="display:<?php echo ($varanatipespe == 3)? "block" : "none" ; ?>"><?php if($campnomb["varanadetespmenor"] == 1){ echo "*";}?>&nbsp;Menor Igual</span></td>
								<td width="70%" class="NoiseDataTD"><span id="objvaranadetespmenor" style="display:<?php  echo ($varanatipespe == 3)? "block" : "none" ; ?>">
									<b><=</b>&nbsp;<?php echo ($varanadetespmenor)? $varanadetespmenor : "0" ?>
								</span></td>
 							</tr>
							<tr><td colspan="2" class="NoiseErrorDataTD"></td></tr>
							<tr><td colspan="2" class="NoiseFooterTD">&nbsp;Descripci&oacute;n</td></tr>
							<tr><td colspan="2" rowspan="2" class="NoiseDataTD"><?php echo $varanadescri; ?></td></tr>
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
 			<input type="hidden" name="varanacodigo" value="<?php echo $varanacodigo; ?>">
			<input type="hidden" name="acciondetallarvaranalisis">
			<input type="hidden" name="flagdetallarvaranalisis" value="1">
			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>">
			<input type="hidden" name="sourceaction" value="detallar">
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
		</form>
	</body>
<?php if(!$codigo){ echo " -->"; } ?> 
<?php fncclose($idcon); ?>
</html>