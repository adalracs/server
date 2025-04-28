<?php
	include ( '../src/FunGen/sesion/fncvalses.php');
	include ('../src/FunPerSecNiv/fncsqlrun.php'); 
	include ( '../src/FunPerPriNiv/pktblplanta.php');
	include ( '../src/FunPerPriNiv/pktblsistema.php');
	include ( '../src/FunGen/sesion/fnccaf.php');
$reccomact = fnccaf($GLOBALS[usuacodi], $_SERVER["SCRIPT_FILENAME"]);
?>
<html>
	<head>
		<title>Duracion de trabajo</title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		<meta http-equiv="expires" content="0">
		<?php include('../def/jquery.library_maestro.php');?>
		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.function_comun.js"></script>
		<script type="text/javascript">
			$(function(){
				/**
				 * Boton aceptar informe
				 */
				$('#aceptarinforme').button({ icons: { primary: "ui-icon-circle-check" } }).click(function() {
					var err = '';
					
					if(document.getElementById('consulfecfin').value == '' || document.getElementById('consulfecini').value == '')
						(err != '') ? err = err + '<br>* Debe especificar la fecha de inicio y fecha fin.' : err = err + '* Debe especificar la fecha de inicio y fecha fin.' ;
					else if(document.getElementById('consulfecfin').value < document.getElementById('consulfecini').value)
						(err != '') ? err = err + '<br>* La fecha de inicio debe se mayor a la fecha fin.' : err = err + '* La fecha de inicio debe se mayor a la fecha fin.';

					if(err == '')
					{
						document.form1.action = 'detallareportdurot.php';
						document.form1.submit();
					}
					else
					{
						document.getElementById('msg').innerHTML = '<font color="red">Error:</font><br>' + err;
						$('#msgwindow').dialog('open');
					}
					return false;
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
<?php if(!$codigo){ echo "<!--";} ?>
	<body bgcolor="FFFFFF" text="#000000">
		<form name="form1" method="post"  enctype="multipart/form-data">
			<p><font class="NoiseFormHeaderFont">Duraci&oacute;n del trabajo</font></p>
			<table border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content" width="670">
				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr>	
  				<tr><td class="ui-widget-header"><span class="style5"><font color="FFFFFF">Duraci&oacute;n de OT</font></span></td></tr>
  				<tr>
					<td>
						<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center">
							<tr>
  								<td>
  									<div style="width:648px; height: 14px; margin:0 auto;" class="ui-state-default">&nbsp;
										<a onClick="return verocultar('filplantas',1);" href="javascript:animatedcollapse.toggle('filplantas');"><img id="row1" align="middle" align="top"  src="temas/Noise/<?php if($arrheots) echo 'AscOn'; else echo 'DescOn'  ?>.gif" border="0">&nbsp;Ubicaci&oacute;n</a>
									</div>
  									<div id="filplantas">
										<?php 
											include_once '../src/FunPerPriNiv/pktblplanta.php';
											$usuaplantareport = 1;
											$noAjax = true;
											include '../src/FunjQuery/jquery.visors/jquery.plantas.php'; 
										?>
									</div>
									<input type="hidden" name="arrusuaplanta" id="arrusuaplanta" value="<?php echo $arrusuaplanta; ?>">
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center">
							<tr>
  								<td>
  									<div style="width:648px; height: 14px; margin:0 auto;" class="ui-state-default">&nbsp;
										<a onClick="return verocultar('filtipotrabajo',2);" href="javascript:animatedcollapse.toggle('filtipotrabajo');"><img id="row2" align="middle" align="top"  src="temas/Noise/<?php if($arrheots) echo 'AscOn'; else echo 'DescOn'  ?>.gif" border="0">&nbsp;Tipo de trabajo</a>
									</div>
  									<div id="filtipotrabajo">
										<?php 
											include_once '../src/FunPerPriNiv/pktbltipotrab.php';
											$usuatipotrabreport = 1;
											$noAjax = true;
											include '../src/FunjQuery/jquery.visors/jquery.tipotrabajo.php'; 
										?>
									</div>
									<input type="hidden" name="arrusuatipotrab" id="arrusuatipotrab" value="<?php echo $arrusuatipotrab; ?>">
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
	    			<td>
	    				<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
							<tr><td colspan="2" class="ui-state-default">*&nbsp;Periodo</td></tr>
							<tr class="NoiseDataTD">
								<td>&nbsp;Desde&nbsp;&nbsp;<input name="consulfecini" id="consulfecini" type="text" size="8"></td>
								<td>&nbsp;Hasta&nbsp;&nbsp;<input name="consulfecfin" id="consulfecfin" type="text" size="8"></td>
							</tr>
						</table>
					</td>
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
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>">
			<input type="hidden" name="arr_tipoequipo" id="arr_tipoequipo" value="<?php echo $arr_tipoequipo; ?>">
		</form>
	</body>
<?php if(!$codigo){ echo " -->"; } ?>
</html>