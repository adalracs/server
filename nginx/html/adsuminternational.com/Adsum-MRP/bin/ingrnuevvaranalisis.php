<?php 
ob_start();
	include ( '../src/FunPerPriNiv/pktbltipoitemdesa.php');
	include ( '../src/FunPerPriNiv/pktbltiposoliprog.php');
	include ( '../src/FunPerPriNiv/pktblvaranalisis.php');
	include ( '../src/FunPerPriNiv/pktbltipocalidad.php');
	include ( '../src/FunPerPriNiv/pktblunimedida.php');
	include ( '../src/FunPerPriNiv/pktblusuario.php');
	include ( '../src/FunGen/sesion/fncvalses.php'); 
	include ( '../src/FunGen/cargainput.php');

	if($accionnuevovaranalisis)
		include ( 'grabavaranalisis.php');

ob_end_flush();

$idcon = fncconn();

?>
<html> 
	<head> 
		<title>Nuevo registro de variables de analisis</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0"> 
		<?php include('../def/jquery.library_maestro.php');?>
		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jq.varanalisis.js"></script>
	</head> 
<?php if(!$codigo){ echo "<!--";} ?>
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Variables de analisis</font></p> 
			<table border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content" width="650">
<?php if($campnomb): ?>
				<tr><td><div class="ui-widget">
					<div class="ui-state-error ui-corner-all" style="padding: 0 .7em;"> 
						<p><span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span> 
						<strong>Advertencia:</strong> Corrija los campos marcados con *</p>
					</div>
				</div></td></tr>
<?php else: ?> 		
				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr>	
<?php endif; ?>
  				<tr><td class="ui-widget-header"><span class="style5"><font color="FFFFFF"> Ingresar nuevo registro</font></span></td></tr> 
				<tr> 
  					<td> 
            			<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center"> 
            				<tr>
								<td width="30%" class="NoiseFooterTD">&nbsp;Usuario</td>
								<td width="70%" class="NoiseDataTD"><?php echo ($usuacodi)? cargausuanombre($usuacodi,$idcon) : "---" ; ?></td> 
 							</tr>
 							<tr>
								<td width="30%" class="NoiseFooterTD"><?php if($campnomb["varanafecha"] == 1){ $varanafecha = null; echo "*";} ?>&nbsp;Fecha</td>
								<td width="70%" class="NoiseDataTD"><?php echo date("Y-m-d"); ?></td> 
 							</tr>
 							<tr>
     							<td width="30%" class="NoiseFooterTD"><?php if($campnomb["tipcalcodigo"] == 1){ $tipcalcodigo = null; echo "*";} ?>&nbsp;Formato de calidad</td>
     							<td width="70%" class="NoiseDataTD">
     								<select name="tipcalcodigo" id="tipcalcodigo">
     									<option value = "">--Seleccione--</option>
	     								<?php
											include ('../src/FunGen/floadtipocalidad.php');
											floadtipocalidad($tipcalcodigo,$idcon);
										?>
    								</select>
    							</td>
    						</tr>
    						<tr>
    							<td width="30%" class="NoiseFooterTD"><span id="lbltipitemcodigo" style="display:<?php echo ($tipcalcodigo == 1)? "block" : "none" ; ?>"><?php if($campnomb["tipitemcodigo"] == 1){ $tipitemcodigo = null; echo "*";}?>&nbsp;Plan Inspecci&oacute;n</span></td>
				     			<td width="70%" class="NoiseDataTD"><span id="objtipitemcodigo" style="display:<?php echo ($tipcalcodigo == 1)? "block" : "none" ; ?>">
				     				<select name="tipitemcodigo" id="tipitemcodigo">
										<option value = "">--Seleccione--</option>
					     				<?php
											include ('../src/FunGen/floadtipoitemdesa.php');
											floadtipoitemdesa($tipitemcodigo,$idcon);
										?>
				    				</select></span>
				    			</td>						
		    				</tr>							
		    				<tr>
		    					<td width="30%" class="NoiseFooterTD"><span id="lbltipsolcodigo" style="display:<?php echo ($tipcalcodigo == 2)? "block" : "none" ;?>"><?php if($campnomb["tipsolcodigo"] == 1){ $tipsolcodigo = null; echo "*";}?>&nbsp;Plan Inspecci&oacute;n</span></td>
	     						<td width="70%" class="NoiseDataTD"><span id="objtipsolcodigo" style="display:<?php echo ($tipcalcodigo == 2)? "block" : "none" ;?>">
	     							<select name="tipsolcodigo" id="tipsolcodigo">
										<option value = "">-- Seleccione --</option>
				     					<?php
											include ('../src/FunGen/floadtiposoliprog.php');
											floadtiposoliprog($tipsolcodigo,$idcon);
										?>
	    							</select></span>
    							</td>
    						</tr>							
							<tr>
								<td width="30%" class="NoiseFooterTD"><?php if($campnomb["varananombre"] == 1){ $varananombre = null; echo "*";}?>&nbsp;Nombre</td>
								<td width="70%" class="NoiseDataTD"><input type="text" name="varananombre" size="20" value="<?php echo $varananombre; ?>"></td> 
 							</tr>
      						<tr>
     							<td width="30%" class="NoiseFooterTD"><?php if($campnomb["unidadcodigo"] == 1){ $unidadcodigo = null; echo "*";}?>&nbsp;Unidad de Medida</td>
     							<td width="70%" class="NoiseDataTD">
     								<select name="unidadcodigo" id="unidadcodigo">
     									<option value = "">--Seleccione--</option>
	     								<?php
											include ('../src/FunGen/floadunimedida.php');
											floadunimedidasel($unidadcodigo,$idcon);
										?>
    								</select>
    							</td>
							</tr>
      						<tr>
								<td width="30%" class="NoiseFooterTD"><?php if($campnomb["varanatipespe"] == 1){echo "*";}?>&nbsp;Tipo especificacion</td>
								<td width="70%" class="NoiseDataTD">
									<select name="varanatipespe" id="varanatipespe">
										<option value = "">--Seleccione--</option>
										<option value = "1" <?php if($varanatipespe == 1){ echo "selected"; } ?> >Rango +/-</option>
										<option value = "2" <?php if($varanatipespe == 2){ echo "selected"; } ?> >Mayor Igual >=</option>
										<option value = "3" <?php if($varanatipespe == 3){ echo "selected"; } ?> >Menor Igual <=</option>
										<option value = "4" <?php if($varanatipespe == 4){ echo "selected"; } ?> >Binario 1/0</option>
										<option value = "5" <?php if($varanatipespe == 5){ echo "selected"; } ?> >Tolerancia +/- (%)</option>
    								</select>
    							</td>
 							</tr>
 							<tr>
 								<td width="30%" class="NoiseFooterTD"><span id="lblvaranatole" style="display:<?php echo ($varanatipespe == 1 || $varanatipespe == 5)? "block" : "none" ; ?>"><?php if($campnomb["varanatolems"] == 1 || $campnomb["varanatolemn"] == 1){ echo "*";}?>&nbsp;Especificacion</span></td>
 								<td width="70%" class="NoiseDataTD"><span id="objvaranatole" style="display:<?php echo ($varanatipespe == 1 || $varanatipespe == 5)? "block" : "none" ; ?>">
 									<b>+</b>&nbsp;<input type="text" name="varanatolems" id="varanatolems" value="<?php echo $varanatolems; ?>" size="2" />
									<b>-</b>&nbsp;<input type="text" name="varanatolemn" id="varanatolemn" value="<?php echo $varanatolemn; ?>" size="2" />
 								</span></td>
 							</tr>
 							<tr>
								<td width="30%"  class="NoiseFooterTD"><span id="lblvaranadetespmayor" style="display:<?php echo ($varanatipespe == 2)? "block" : "none" ; ?>"><?php if($campnomb["varanadetespmayor"] == 1){ echo "*";}?>&nbsp;Mayor Igual</span></td>
								<td width="70%" class="NoiseDataTD"><span id="objvaranadetespmayor" style="display:<?php  echo ($varanatipespe == 2)? "block" : "none" ; ?>">
									<b>>=</b><input type="text" name="varanadetespmayor" id="varanadetespmayor" value="<?php echo $varanadetespmayor; ?>" size="4"/>
								</span></td>
 							</tr>
 							<tr>
								<td width="30%" class="NoiseFooterTD"><span id="lblvaranadetespmenor" style="display:<?php echo ($varanatipespe == 3)? "block" : "none" ; ?>"><?php if($campnomb["varanadetespmenor"] == 1){ echo "*";}?>&nbsp;Menor Igual</span></td>
								<td width="70%" class="NoiseDataTD"><span id="objvaranadetespmenor" style="display:<?php  echo ($varanatipespe == 3)? "block" : "none" ; ?>">
									<b><=</b><input type="text" name="varanadetespmenor" id="varanadetespmenor" value="<?php echo $varanadetespmenor; ?>" size="4"/>
								</span></td>
 							</tr>
							<tr><td colspan="2" class="NoiseErrorDataTD"></td></tr>
							<tr><td colspan="2" class="NoiseFooterTD"><?php if($campnomb["varanadescri"]== 1){$varanadescri = null; echo "*";}?>&nbsp;Descripci&oacute;n</td></tr>
							<tr><td colspan="2" rowspan="2" class="NoiseDataTD"><textarea name="varanadescri" rows="3" cols="75"><?php echo $varanadescri; ?></textarea>  </td></tr>
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
			<input type="hidden" name="accionnuevovaranalisis">
			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>">
			<input type="hidden" name="sourceaction" value="nuevo">
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
		</form>
	</body>
<?php if(!$codigo){ echo " -->"; } ?> 
</html>
