<?php 
	include ('../src/FunGen/sesion/fncvalses.php'); 
	include ('../src/FunPerSecNiv/fncsqlrun.php'); 
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
					
					if(document.getElementById('flagtipoinforme').value == '')
						err = err + '* Debe especificar el tipo de informe (Consolidado/Detallado).';
					
					if(document.getElementById('consulfecfin').value == '' || document.getElementById('consulfecini').value == '')
						(err != '') ? err = err + '<br>* Debe especificar la fecha de inicio y fecha fin.' : err = err + '* Debe especificar la fecha de inicio y fecha fin.' ;
					else if(document.getElementById('consulfecfin').value < document.getElementById('consulfecini').value)
						(err != '') ? err = err + '<br>* La fecha de inicio debe se mayor a la fecha fin.' : err = err + '* La fecha de inicio debe se mayor a la fecha fin.';

					if(err == '')
					{
						document.form1.action = 'detallainfrepottecn.php';
						document.form1.submit();
					}
					else
					{
						document.getElementById('msg').innerHTML = '<font color="red">Error:</font><br>' + err;
						$('#msgwindow').dialog('open');
					}
					return false;
				});


				/**
				 * Boton Anexar Tecnicos
				 */
				$('#anxottecnico').button({ icons: { primary: "ui-icon-plus" } }).click(function() {
					document.getElementById('typesource').value = 'usergen';
					window.open('consultarcuadrillausuario.php?id=' + document.getElementById('lsttecnico').value + '&typesource=usergen&negocicodigo=' + document.getElementById('negocicodigo').value + '&codigo=' + document.getElementById('codigo').value,'','status=no,menubar=no,scrollbars=yes,resizable=yes,left=300,width=800,height=600');
					return false;
				});
				
				/**
				 * Boton Retirar Tecnico
				 */
				$('#retottecnico').button({ icons: { primary: "ui-icon-minus" } }).click(function() {
					loadlist_func(document.getElementById('lsttecnico').value, '');
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
<?php if(!$codigo){ echo "<!--";}?> 
	<body bgcolor="FFFFFF" text="#000000">
		<form name="form1" method="post"  enctype="multipart/form-data">
			<p><font class="NoiseFormHeaderFont">Funcionarios - Total Ordenes por Ejecutados</font></p>
			<table border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content" width="670">
				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr>	
  				<tr><td class="ui-widget-header"><span class="style5"><font color="FFFFFF"> Total Ordenes por Ejecutados</font></span></td></tr>
	  			<tr>
					<td align="center"><div style="width: 98%; text-align:left"><div id="tipoinforme">
						<input type="radio" id="tipoinfo1" name="tipoinfo" value="1" onclick="document.getElementById('flagtipoinforme').value = this.value;" /><label for="tipoinfo1">Consolidado</label>
						<input type="radio" id="tipoinfo2" name="tipoinfo" value="2" onclick="document.getElementById('flagtipoinforme').value = this.value;" /><label for="tipoinfo2">Detallado</label>
					</div></div></td>
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
						<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center">
							<tr>
  								<td>
  									<div style="width:648px; height: 14px; margin:0 auto;" class="ui-state-default">&nbsp;
										<a onClick="return verocultar('involucrados',2);" href="javascript:animatedcollapse.toggle('involucrados');"><img id="row2" align="middle" align="top"  src="temas/Noise/<?php if($arrheots) echo 'AscOn'; else echo 'DescOn'  ?>.gif" border="0">&nbsp;Lista de Funcionarios</a>
									</div>
  									<div id="involucrados">
										<?php 
											include_once '../src/FunPerPriNiv/pktblcargo.php';
											include_once '../src/FunPerPriNiv/pktblusuario.php';
											
											$iRegArray = $lsttecnico;
											$noAjax = true;
											include '../src/FunjQuery/jquery.visors/jquery.grupusuario.php'; 
										?>
									</div>
									<input type="hidden" name="alllsttecnicotmp" id="alllsttecnicotmp" value="<?php echo $alllsttecnicotmp; ?>">
									<input type="hidden" name="lsttecnico" id="lsttecnico" value="<?php echo $lsttecnico; ?>">
									<input type="hidden" name="typesource" id="typesource" value="<?php  echo $typesource;  ?>">
									<input type="hidden" name="negocicodigo" id="negocicodigo" value="<?php  echo $negocicodigo;  ?>">
								</td>
							</tr>
							<tr><td><div class="ui-buttonset" style="width:580px;">
								<button id="anxottecnico">Agregar funcionario a la lista</button>&nbsp;
								<button id="retottecnico">Quitar funcionario de la lista</button>
							</div></td></tr>
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
			<input name="flagtipoinforme" id="flagtipoinforme" type="hidden" value="<?php echo $flagtipoinforme ?>">
			<input name="codigo" id="codigo" type="hidden" value="<?php echo $codigo ?>">
			<input name="negocicodigo" id="negocicodigo" type="hidden" value="<?php echo $negocicodigo ?>">
		</form>
		<div id="msgwindow" title="Adsum Kallpa"><span id="msg"></span></div>
	</body>
<?php if(!$codigo){ echo " -->"; } ?> 
</html>