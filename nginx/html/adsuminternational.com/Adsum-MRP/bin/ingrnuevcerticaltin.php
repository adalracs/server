<?php 
ob_start(); 
	include ( '../src/FunGen/sesion/fncvalses.php'); 
	include_once ('../src/FunPerSecNiv/fncconn.php');
	include_once ('../src/FunPerSecNiv/fncclose.php');
	include_once ('../src/FunPerSecNiv/fncsqlrun.php');
	include_once ('../src/FunPerSecNiv/fncfetch.php');
	include_once ('../src/FunPerSecNiv/fncnumreg.php');
	
	if($accionnuevocerticaltin)
		include ( 'grabacerticaltin.php');
		
ob_end_flush(); 
?>
<html> 
	<head> 
		<title>Nuevo registro de certificado calidad/tintas</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0"> 
		<?php include('../def/jquery.library_maestro.php');?>
		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.function_comun.js"></script>
		<script type="text/javascript">
			$(function(){
				//auto completar de itemdesa
				$("#itedesnombre").autocomplete({
					source: function (request, response){
						$.ajax({
								url: "../src/FunjQuery/jquery.phpcombobox/dispensing/jquery.atc_itemcalidad.php",
								dataType: "json" ,
								data: {
									term : request.term,
									linea : document.getElementById('cercatlinea').value
								},
								success: function (data)
								{
									response(data);
								}
						});
					},
					minLengt: 0,
					select: function(event, ui) {
						if(ui.item)
						{
							document.getElementById('itedescodigo').value = ui.item.id;
						}
						else
						{
							document.getElementById('itedescodigo').value = "";
							document.getElementById('itedesnombre').value = ""; 
						}
					}
				});
			});
		</script>
	</head> 
<?php if(!$codigo){ echo "<!--";} ?>
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Certificado calidad/tintas</font></p> 
			<table border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content" width="750">
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
						<table width="95%" border="0" cellspacing="1" cellpadding="0" align="center"> 
							<tr>
								<td colspan="4" class="ui-state-default" align="center"><small>R.DI.02</small></td>
							</tr>
							<tr>
								<td width="20%" class="NoiseFooterTD"><?php if($campnomb["cercatlinea"] == 1){ $cercatlinea = null; echo "*";}?>&nbsp;Componente&nbsp;</td>
								<td colspan="3" class="NoiseDataTD">
									<select name="cercatlinea" id="cercatlinea"> 
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
								<td width="20%" class="NoiseFooterTD"><?php if($campnomb["itedescodigo"] == 1){ $itedescodigo = null; echo "*";}?>&nbsp;Referencia&nbsp;</td>
								<td colspan="3" class="NoiseDataTD"><input type="hidden" name="itedescodigo" id="itedescodigo" value="<?php echo $itedescodigo ?>" /><input type="text" name="itedesnombre" id="itedesnombre" value="<?php echo $itedesnombre ?>" /></td> 
							</tr>
							<tr>
								<td width="20%" class="NoiseFooterTD"><?php if($campnomb["cercattipot"] == 1){ $cercattipot = null; echo "*";}?>&nbsp;Tipo de tinta&nbsp;</td>
								<td width="30%" class="NoiseDataTD">
									<select name="cercattipot"> 
										<option value="">--Seleccione--</option>
										<option value="superficie" <?php if($cercattipot == 'superficie'){echo 'selected';}?> >Superficie</option>
										<option value="laminacion" <?php if($cercattipot == 'laminacion'){echo 'selected';}?> >Laminacion</option>
									</select>
								</td> 
								<td width="20%" class="NoiseFooterTD"><?php if($campnomb["cercatlote"] == 1){ $cercattipot = null; echo "*";}?>&nbsp;Lote&nbsp;</td>
								<td width="30%" class="NoiseDataTD"><input type="text" name="cercatlote" value="<?php echo $cercatlote ?>" /></td> 
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<table width="95%" border="0" cellspacing="1" cellpadding="0" align="center"> 
							<tr>
								<td width="30%" class="ui-state-default" align="center"><small>Analisis</small></td>
								<td width="70%" class="ui-state-default" align="center"><small>Resultados</small></td>
							</tr>
							<tr>
								<td width="30%" class="NoiseFooterTD"><?php if($campnomb["cercatviscos"] == 1){ $cercatviscos = null; echo "*";}?>&nbsp;Viscosidad <b>(cP)</b> &nbsp;</td>
								<td width="70%" class="NoiseDataTD"><input type="text" name="cercatviscos" value="<?php echo $cercatviscos ?>" /></td>
							</tr>
							<tr>
								<td width="30%" class="NoiseFooterTD"><?php if($campnomb["cercatvisco"] == 1){ $cercatvisco = null; echo "*";}?>&nbsp;Viscosidad <b>(seg,zanh # 2 o ford)</b> &nbsp;</td>
								<td width="70%" class="NoiseDataTD"><input type="text" name="cercatvisco" value="<?php echo $cercatvisco ?>" /></td>
							</tr>
							<tr>
								<td width="30%" class="NoiseFooterTD"><?php if($campnomb["cercatcolor"] == 1){ $cercatcolor = null; echo "*";}?>&nbsp;Color <b>(L, C, h y &Delta;cmc)</b>&nbsp;</td>
								<td width="70%" class="NoiseDataTD"><input type="text" name="cercatcolor" value="<?php echo $cercatcolor ?>" /></td>
							</tr>
							<tr>
								<td width="30%" class="NoiseFooterTD"><?php if($campnomb["cercatsolido"] == 1){ $cercatsolido = null; echo "*";}?>&nbsp;Solidos <b>(%)</b>&nbsp;</td>
								<td width="70%" class="NoiseDataTD"><input type="text" name="cercatsolido" value="<?php echo $cercatsolido ?>" /></td>
							</tr>
							<tr>
								<td width="30%" class="NoiseFooterTD"><?php if($campnomb["cercatdensid"] == 1){ $cercatdensid = null; echo "*";}?>&nbsp;Densidad <b>(g/ml)</b>&nbsp;</td>
								<td width="70%" class="NoiseDataTD"><input type="text" name="cercatdensid" value="<?php echo $cercatdensid ?>" /></td>
							</tr>
							<tr>
								<td width="30%" class="NoiseFooterTD"><?php if($campnomb["cercatsecado"] == 1){ $cercatsecado = null; echo "*";}?>&nbsp;Secado <b>(seg)</b>&nbsp;</td>
								<td width="70%" class="NoiseDataTD"><input type="text" name="cercatsecado" value="<?php echo $cercatsecado ?>" /></td>
							</tr>
							<tr>
								<td width="30%" class="NoiseFooterTD"><?php if($campnomb["cercatadhere"] == 1){ $cercatadhere = null; echo "*";}?>&nbsp;Adherencia&nbsp;</td>
								<td width="70%" class="NoiseDataTD"><input type="text" name="cercatadhere" value="<?php echo $cercatadhere ?>" /></td>
							</tr>
							<tr>
								<td width="30%" class="NoiseFooterTD"><?php if($campnomb["cercatrayado"] == 1){ $cercatrayado = null; echo "*";}?>&nbsp;Rayado&nbsp;</td>
								<td width="70%" class="NoiseDataTD"><input type="text" name="cercatrayado" value="<?php echo $cercatrayado ?>" /></td>
							</tr>
							<tr>
								<td colspan="2" class="NoiseFooterTD">&nbsp;Nota : Viscosidad y densidad medida a 25 &deg;C +/-.&nbsp;</td>
							</tr>
							<tr>
								<td colspan="2" class="NoiseFooterTD">&nbsp;La viscosidad medida en con la capa Zahn es hasta 60s por encima de este valor se mide con la capa ford 4.&nbsp;</td>
							</tr>
							<tr><td colspan="2" class="NoiseErrorDataTD"></td></tr>
							<tr><td colspan="2" class="NoiseFooterTD"><?php if($campnomb["cercatdescri"] == 1){$cercatdescri = null; echo "*";}?>&nbsp;Nota</td></tr>
							<tr><td colspan="2" rowspan="2" class="NoiseDataTD"><textarea name="cercatdescri" rows="3" cols="80"><?php echo $cercatdescri ?></textarea>  </td></tr>
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
			<input type="hidden" name="accionnuevocerticaltin">  
			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>">
			<input type="hidden" name="sourceaction" value="nuevo">						
			<input type="hidden" name="cercatfecha" value="<?php echo date("Y-m-d H:i:s"); ?>">						
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
		</form> 	
		<div id="msgwindow" title="Adsum Kallpa"><span id="msg"></span></div>
	</body> 
<?php if(!$codigo){ echo " -->"; } ?> 
</html>