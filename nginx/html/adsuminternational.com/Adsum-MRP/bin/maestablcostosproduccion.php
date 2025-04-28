<?php 
	include ('../src/FunGen/sesion/fncvalses.php'); 
	include ('../src/FunPerSecNiv/fncsqlrun.php');
	include ('../src/FunPerPriNiv/pktbltipoproduc.php'); 
	$idcon = fncconn();
?> 
<html>
	<head>
		<title>Parametros de Informe - Funcionarios Total Ordenes por Ejecutados</title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		<meta http-equiv="expires" content="0">
		<?php include('../def/jquery.library_maestro.php');?>
		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.function_comun.js"></script>
		<script type="text/javascript">
			$(function(){
				$( "#tipoinforme" ).buttonset();
				
				/**
				 * Boton aceptar informe
				 */
				$('#aceptarinforme').button({ icons: { primary: "ui-icon-circle-check" } }).click(function() {
					var err = '';
					
//					if(document.getElementById('lsttecnico').value == '')
//						err = err + '* Debe especificar el/los funcionario(s).<br>';
					

					
					if(
						document.getElementById('consulfecfin').value =='' && 
						document.getElementById('consulfecini').value =='' &&
						document.getElementById('ordoppcodigo').value =='' &&
						document.getElementById('produccoduno').value =='' &&
						document.getElementById('producnombre').value =='' &&
						document.getElementById('tipprocodigo').value =='' &&
						document.getElementById('ordcomrazsoc').value =='' &&
						document.getElementById('pedvennumero').value =='' 
					)
						err = err + '* Debe especificar como minimo un dato para la consulta.<br>';
						//(err != '') ? err = err + '<br>* Debe especificar la fecha de inicio y fecha fin.' : err = err + '* Debe especificar la fecha de inicio y fecha fin.' ;
					/*else if(document.getElementById('consulfecfin').value < document.getElementById('consulfecini').value)
						(err != '') ? err = err + '<br>* La fecha de inicio debe se mayor a la fecha fin.' : err = err + '* La fecha de inicio debe se mayor a la fecha fin.';*/

					if(err == '')
					{
						document.form1.action = 'detallacostosproduccion.php';
						document.form1.submit();
					}
					else
					{
						document.getElementById('msg').innerHTML = '<font color="red">Error:</font><br>' + err;
						$('#msgwindow').dialog('open');
					}
					return false;
				});
				
				$("#ordcomrazsoc").autocomplete({
					source: "../src/FunjQuery/jquery.phpcombobox/jquery.cmbx_cliente.php",
					minLength: 0,
					select: function(event, ui) {
						if(ui.item)
						{
							document.getElementById('ordcomcodcli').value = ui.item.id;
						}
						else
						{
							document.getElementById('ordcomrazsoc').value = "";
							document.getElementById('ordcomcodcli').value = ""; 
						}
					}
				});

				$("#consulfecini").datepicker({changeMonth: true,changeYear: true});
				$("#consulfecini").datepicker('option', {dateFormat: 'yy-mm-dd'});
				$("#consulfecini").datepicker($.datepicker.regional['es']);
				
				$("#consulfecfin").datepicker({changeMonth: true,changeYear: true});
				$("#consulfecfin").datepicker('option', {dateFormat: 'yy-mm-dd'});
				$("#consulfecfin").datepicker($.datepicker.regional['es']);
			});

			function rldSubfunction(){}
		</script>
	</head>
<?php if(!$codigo){ echo "<!--";}?> 
	<body bgcolor="FFFFFF" text="#000000">
		<form name="form1" method="post"  enctype="multipart/form-data">
			<p><font class="NoiseFormHeaderFont">Costos por produccion</font></p>
			<table border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content" width="670">
				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr>	
  				<tr><td class="ui-widget-header"><span class="style5"><font color="FFFFFF"> Total Ordenes por Ejecutados</font></span></td></tr>
  
				<tr>
	    			<td>
	    				<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
	    					<tr>
								<td colspan="5">
									<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
										<tr><td colspan="2" class="ui-state-default">*&nbsp;Periodo</td></tr>
										<tr class="NoiseDataTD">
											<td width="30%" >&nbsp;Desde&nbsp;&nbsp;<input name="consulfecini" id="consulfecini" type="text" size="12"></td>
											<td width="70%" >&nbsp;Hasta&nbsp;&nbsp;<input name="consulfecfin" id="consulfecfin" type="text" size="12"></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td width="30%" class="NoiseFooterTD">&nbsp;OP</td>
								<td width="70%" class="NoiseDataTD"><input type="text" id="ordoppcodigo" name="ordoppcodigo" size="30"	value="<?php echo $ordoppcodigo;?>"></td> 
 							</tr>
 							<tr>
								<td width="30%" class="NoiseFooterTD">&nbsp;Tipo producto</td>
								<td width="70%" class="NoiseDataTD">
									<select name="tipprocodigo" id="tipprocodigo">
										<option value="">--Seleccione--</option>
										<?php 
											include '../src/FunGen/floadtipoproduc.php';
											floadtipoproduc($tipprocodigo,$idcon);
										 ?>
									</select>
								</td> 
 							</tr>
 							<tr>
								<td width="30%" class="NoiseFooterTD">&nbsp;Presentaci&oacute;n</td>
								<td width="70%" class="NoiseDataTD"><input type="text" name="produccoduno" id="produccoduno" size="30"	value="<?php echo $produccoduno;?>"></td> 
 							</tr>
 							<tr>
								<td width="30%" class="NoiseFooterTD">&nbsp;Item producto terminado</td>
								<td width="70%" class="NoiseDataTD"><input type="text" name="produccoduno" id="produccoduno" size="30"	value="<?php echo $produccoduno;?>"></td> 
 							</tr>
 							<tr>
								<td width="30%" class="NoiseFooterTD">&nbsp;Descripci&oacute;n</td>
								<td width="70%" class="NoiseDataTD"><input type="text" name="producnombre" id="producnombre" size="30"	value="<?php echo $producnombre;?>"></td> 
 							</tr>
	 						<tr>
								<td width="30%" class="NoiseFooterTD">&nbsp;Cliente</td>
								<td width="70%" class="NoiseDataTD"><input type="text" name="ordcomrazsoc" id="ordcomrazsoc" size="30"	value="<?php echo $ordcomrazsoc; ?>">
									<input type="hidden" name="ordcomcodcli" id="ordcomcodcli" size="30"	value="<?php echo $ordcomcodcli; ?>">
								</td> 
 							</tr>
 							<tr>
								<td width="30%" class="NoiseFooterTD">&nbsp;No. PV</td>
								<td width="70%" class="NoiseDataTD"><input type="text" name="pedvennumero" id="pedvennumero" size="30"	value="<?php echo $pedvennumero; ?>"></td> 
 							</tr>			
						</table>
					</td>
				</tr>
				<tr>
					<td colspan="2" class="NoiseErrorDataTD">&nbsp;</td>
					<td class="NoiseErrorDataTD"></td>
				</tr>
				<tr><td>&nbsp;</td></tr>
				<tr>
					<td class="NoiseErrorDataTD" align="center"><div class="ui-buttonset">
						<button id="aceptarinforme">Aceptar</button>&nbsp;
					</div></td>
				</tr>
				<tr><td>&nbsp;</td></tr>
				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr>
			</table> 
			<input name="flagtipoinforme" id="flagtipoinforme" type="hidden" value="<?php echo $flagtipoinforme ?>">
			<input name="codigo" id="codigo" type="hidden" value="<?php echo $codigo ?>">
			<input name="negocicodigo" id="negocicodigo" type="hidden" value="<?php echo $negocicodigo ?>">
		</form>
		<div id="msgwindow" title="Adsum Kallpa"><span id="msg"></span></div>
	</body>
<?php if(!$codigo){ echo " -->"; } ?> 
</html>