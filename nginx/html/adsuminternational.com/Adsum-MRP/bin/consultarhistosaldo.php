<?php 	

	include_once ('../src/FunPerPriNiv/pktblestadosaldo.php');
	include_once ( '../src/FunGen/sesion/fncvalses.php');
	include_once ('../src/FunPerSecNiv/fncconn.php');
	include_once ('../src/FunPerSecNiv/fncclose.php');
	include_once ('../src/FunPerSecNiv/fncsqlrun.php');
	include_once ('../src/FunPerSecNiv/fncfetch.php');
	include_once ('../src/FunPerSecNiv/fncnumreg.php');	

	$idcon = fncconn();
?>
<html> 
	<head> 
		<title>Consultar saldos laminas</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0"> 
		<?php include('../def/jquery.library_maestro.php');?>
	</head> 
<?php if(!$codigo){ echo "<!--";} ?>
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Saldos laminas</font></p> 
			<table border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content" width="550">
				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr>	
  				<tr><td class="ui-widget-header"><span class="style5"><font color="FFFFFF"> Consultar registro</font></span></td></tr> 
				<tr> 
  					<td> 
            			<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center"> 
							<tr>
								<td width="17%" class="NoiseFooterTD">&nbsp;Item</td>
								<td width="83%" class="NoiseDataTD"><input type="text" name="itedescodigo" size="30"	value="<?php echo $itedescodigo; ?>"></td> 
 							</tr>
							<tr>
								<td width="17%" class="NoiseFooterTD">&nbsp;Ubicacion</td>
								<td width="83%" class="NoiseDataTD"><input type="text" name="saldoubicaci" size="30"	value="<?php echo $saldoubicaci; ?>"></td> 
 							</tr>
							<tr>
								<td width="17%" class="NoiseFooterTD">&nbsp;Posicion</td>
								<td width="83%" class="NoiseDataTD"><input type="text" name="saldoposicio" size="30"	value="<?php echo $saldoposicio; ?>"></td> 
 							</tr>
							<tr>
								<td width="17%" class="NoiseFooterTD">&nbsp;Formula&nbsp;</td>
								<td width="83%" class="NoiseDataTD"><input type="text" name="saldoformula" size="30"	value="<?php echo $saldoformula; ?>"></td> 
 							</tr>
							<tr>
								<td width="17%" class="NoiseFooterTD">&nbsp;Kilogramos&nbsp;</td>
								<td width="83%" class="NoiseDataTD"><input type="text" name="saldocantkgs" size="30"	value="<?php echo $saldocantkgs; ?>"></td> 
 							</tr>
							<tr>
								<td width="17%" class="NoiseFooterTD">&nbsp;Metros&nbsp;</td>
								<td width="83%" class="NoiseDataTD"><input type="text" name="saldocantmts" size="30"	value="<?php echo $saldocantmts; ?>"></td> 
 							</tr>
 							<tr>
								<td width="17%" class="NoiseFooterTD">&nbsp;Estado&nbsp;</td>
								<td width="83%" class="NoiseDataTD">
									<select name="estsalcodigo" id="estsalcodigo" >
										<option value="">--Seleccione--</option>
										<?php
											include_once( "../src/FunGen/floadestadosaldo.php" );
											floadestadosaldo($estsalcodigo,$idcon);
										?>
									</select>
								</td>
 							</tr>
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
 			<input type="hidden" name="flagconsultarhistosaldo" value="1"> 
			<input type="hidden" name="accionconsultarhistosaldo"> 
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>">
			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>">
			<input type="hidden" name="sourceaction" value="consultar">
			<input type="hidden" name="columnas" value="itedescodigo, saldoubicaci, saldoposicio, saldoformula, saldocantkgs, saldocantmts ">
			<input type="hidden" name="nombtabl" value="saldos"> 
		</form>
	</body>
<?php if(!$codigo){ echo " -->"; } ?> 
</html>