<?php 
	include ( '../src/FunGen/sesion/fncvalses.php');
	include_once ('../src/FunPerSecNiv/fncconn.php');
	include_once ('../src/FunPerSecNiv/fncclose.php');
	include_once ('../src/FunPerSecNiv/fncsqlrun.php');
	include_once ('../src/FunPerSecNiv/fncfetch.php');
	include_once ('../src/FunPerSecNiv/fncnumreg.php');

?>
<html> 
	<head> 
		<title>Consultar registro de certificado de calidad/tintas</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0"> 
		<?php include('../def/jquery.library_maestro.php');?>
		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.function_comun.js"></script>
		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.desarrollo.js"></script>
		<script language=JavaScript src="../src/FunGen/cargarVistaitemdesa.js" type="text/javascript" ></script>
		<script language=JavaScript src="../src/FunGen/jsrsClient.js"		type="text/javascript" ></script>
		<script type="text/javascript">
		$(function(){
			$("#cercatfecha").datepicker({
				showOn: 'both',
				buttonImageOnly : 'true',
				changeYear : 'true',
				numberOfMonths : 1,
				dateFormat : 'yy-mm-dd'
				});
		});
		</script>
	</head> 
<?php if(!$codigo){ echo "<!--";} ?>
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">certificado de calidad/tintas</font></p> 
			<table border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content" width="550">
				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr>	
  				<tr><td class="ui-widget-header"><span class="style5"><font color="FFFFFF"> Consultar registro</font></span></td></tr> 
				<tr> 
  					<td> 
            			<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center"> 
							<tr>
								<td width="17%" class="NoiseFooterTD">&nbsp;Componente</td>
								<td width="83%" class="NoiseDataTD">
									<select name="cercatlinea" id="cercatlinea" onchange="cargarVistaitemdesa(this.value);"> 
										<option value="">--Seleccione--</option>
											<?php 
												$idcon = fncconn();
												include '../src/FunGen/floadvistaitemdispen.php';
												floadvistaitemdispen($cercatlinea,$idcon);
												fncclose($idcon);
											?>
									</select>
								</td> 
 							</tr>
 							<tr>
								<td width="17%" class="NoiseFooterTD"><?php if($campnomb["itedescodigo"] == 1){ $itedescodigo = null; echo "*";}?>&nbsp;Referencia&nbsp;</td>
								<td width="83%" class="NoiseDataTD">
									<select name="itedescodigo" id="itedescodigo"> 
										<option value="">--Seleccione--</option>
											<?php 
												$idcon = fncconn();
												floadvistaitemdispen1($itedescodigo,$cercatlinea,$idcon);
												fncclose($idcon);
											?>
									</select>
								</td> 
							</tr>
							<tr>
								<tr>
								<td width="17%" class="NoiseFooterTD"><?php if($campnomb["cercattipot"] == 1){ $cercattipot = null; echo "*";}?>&nbsp;Tipo de tinta&nbsp;</td>
								<td width="83%" class="NoiseDataTD">
									<select name="cercattipot"> 
										<option value="">--Seleccione--</option>
										<option value="superficie" <?php if($cercattipot == 'superficie'){echo 'selected';}?> >Superficie</option>
										<option value="laminacion" <?php if($cercattipot == 'laminacion'){echo 'selected';}?> >Laminacion</option>
									</select>
								</td> 
							</tr>
							<tr>
								<td width="17%" class="NoiseFooterTD"><?php if($campnomb["cercatlote"] == 1){ $cercattipot = null; echo "*";}?>&nbsp;Lote&nbsp;</td>
								<td width="83%" class="NoiseDataTD"><input type="text" name="cercatlote" value="<?php echo $cercatlote ?>" /></td> 
							</tr>
							<tr>
								<td width="17%" class="NoiseFooterTD"><?php if($campnomb["cercatfecha"] == 1){ $cercatfecha = null; echo "*";}?>&nbsp;Fecha&nbsp;</td>
								<td width="83%" class="NoiseDataTD"><input type="text" name="cercatfecha" id="cercatfecha" value="<?php echo $cercatfecha ?>" onclick="this.blur();"/></td> 
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
 			<input type="hidden" name="flagconsultarcerticaltin" value="1"> 
			<input type="hidden" name="accionconsultarcerticaltin"> 
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>">
			<input type="hidden" name="sourcetable" value="certicaltin">
			<input type="hidden" name="sourceaction" value="consultar">
			<input type="hidden" name="columnas" value="certicaltin, itedescodigo, cercattipot, cercatlote">
			<input type="hidden" name="nombtabl" value="certicaltin"> 
		</form>
	</body>
<?php if(!$codigo){ echo " -->"; } ?> 
</html>