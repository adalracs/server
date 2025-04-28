<?php
	ini_set("display_errors", 1);

	include_once ( '../src/FunPerPriNiv/pktblparametro.php');
	include ( '../src/FunPHPMailer/fncmailconfig.php');
	include ( '../src/FunPerPriNiv/pktbltipocump.php');
	include ( '../src/FunPerPriNiv/pktblnegocio.php');
	include ( '../src/FunGen/sesion/fncvalses.php'); 

	include ( '../src/FunPerSecNiv/fncsqlrun.php');
	include ( '../src/FunGen/cargainput.php');

	if($saveconfig){
		include('grabaparametro.php');
	}
	
	$idcon = fncconn();

	if(!$flagformularioconfig){

		$rsParametro = dinamicscanopparametro(array('paramegrupo' => 'formulario', 'negocicodigo' => 'NULL'),
												array('paramegrupo' => '=', 'negocicodigo' => 'IS_NULL'), $idcon);
		$nrParametro = fncnumreg($rsParametro);	
	
		for($a = 0; $a < $nrParametro; $a++){

			$rwParametro = fncfetch($rsParametro, $a);
			$objCampo = $rwParametro['paramecampo'];
			$$objCampo = str_replace("<br>", "\n", $rwParametro['paramevalor']);
		}
		
		if($negocicodigo1){

			$rsParametro = dinamicscanparametro(array('paramegrupo' => 'formulario', 'negocicodigo' => $negocicodigo1), $idcon);
			$nrParametro = fncnumreg($rsParametro);	
		
			for($a = 0; $a < $nrParametro; $a++){

				$rwParametro = fncfetch($rsParametro, $a);
				$objCampo = $rwParametro['paramecampo'];
				$$objCampo = str_replace("<br>", "\n", $rwParametro['paramevalor']);
			}
		}
	}

	//Meses
	$arrRango1 = explode(",", $prev_rango_nivel_1);
	$visitas_2a = $arrRango1[0];
	$visitas_2b = $arrRango1[1];

	$arrRango2 = explode(",", $prev_rango_nivel_2);
	$visitas_3a = $arrRango2[0];
	$visitas_3b = $arrRango2[1];
	$visitas_3c = $arrRango2[2];

	$arrRango3 = explode(",", $prev_rango_nivel_3);
	$visitas_4a = $arrRango3[0];
	$visitas_4b = $arrRango3[1];
	$visitas_4c = $arrRango3[2];
	$visitas_4d = $arrRango3[3];
	//Meses
?>
<html>
	<head>
    	<title>Parametros Generales</title>
    	<meta http-equiv="Content-Type" content="text/html; charset=UTF8">
    	<meta http-equiv="expires" content="0">
		<link rel="stylesheet" type="text/css" href="temas/Noise/Style.css">
		
		<?php include('../def/jquery.library_maestro.php');?>
		<script type="text/javascript" src="../src/FunjQuery/ui/jquery.ui.accordion.js"></script>
		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.function_comun.js"></script>
		<script type="text/javascript" src="../src/FunjQuery/js/jq.evenajax.js"></script>

		<script type="text/javascript">
			$(function(){
				$("#tabgeneral").tabs({
					ajaxOptions: {
						error: function(xhr, status, index, anchor) {
							$(anchor.hash).html("No se puede cargar esta pesta&ntilde;a. Vamos a tratar de solucionar este problema lo m&aacute;s pronto posible.");
						}
					}
				});
				

				$('#grabarpargen').button({ icons: { primary: "ui-icon-disk" } }).click(function() {
					document.getElementById('saveconfig').value = 1;
					form1.submit();
					return false;
				});

				$('#salirpargen').button({ icons: { primary: "ui-icon-circlesmall-close" } }).click(function() {
					document.location = 'main.php';
					return false;
				});
			});
		</script>
		<script type="text/javascript">
			$(function(){

				$('#grabar').click(function(){
					document.form1.submit();
				});

			});
		</script>

		<script type="text/javascript">
			function dinamContent(objContent, objDetont){
				if($("#" + objDetont).is(":checked"))
					$("#" + objContent).css("display", "block");
				else
					$("#" + objContent).css("display", "none");
			}

		</script>
		<style type="text/css">
			.estilo1 {font-size: 85%; font-family : Arial } 
			.estilo2 {font-size: 95%; font-family : Arial }
		
			#filtrarlistas {padding: .4em 1em .4em 20px;text-decoration: none;position: relative;}
			#filtrarlistas span.ui-icon {margin: 0 5px 0 0;position: absolute;left: .2em;top: 50%;margin-top: -8px;}
			#filtrarclearlistas {padding: .4em 1em .4em 20px;text-decoration: none;position: relative;}
			#filtrarclearlistas span.ui-icon {margin: 0 5px 0 0;position: absolute;left: .2em;top: 50%;margin-top: -8px;}
		</style>
  	</head>
<?php if(!$codigo){ echo "<!--";} ?>
	<body bgcolor="FFFFFF" class="NoisePageBODY">
		<form name="form1" method="post"  enctype="multipart/form-data">
      		<p><font class="NoiseFormHeaderFont">Parametros generales</font><br><br></p>
      		<table border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content" width="650">
      			<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr>
      			<tr><td class="ui-widget-header"><span class="style5"><font color="FFFFFF"> &nbsp;</font></span></td></tr>      			
				<tr>
      				<td>
						<div id="tabgeneral">
							<ul>
								<li><a href="#tabs-2"><small>Parametros</small></a></li>
							</ul>

							<!-- Session 2 -->
							<div id="tabs-2">

								<div style="height: 14px; font-size: 11px; margin: 0px; valign: middle;" class="ui-state-default contenido-general">&nbsp;Calificacion Automatica Solicitud de Servicio</div>
								<div class="ui-widget-content contenido-general">
									<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center">
										<tr>
											<td width="30%" class="NoiseFooterTD">&nbsp;Cumplimiento</td>
											<td width="70%" class="NoiseDataTD"><select name="valor_tipo_cump" id="valor_tipo_cump">
												<option value="">-- Seleccione --</option>	
												<?php
													include_once("../src/FunGen/floadtipocump.php");
													floadtipocump($idcon, $valor_tipo_cump);

												?>											
											</select></td>
										</tr>
										<tr>
											<td class="NoiseFooterTD">&nbsp;Tiempo m&aacute;x. de vigencia</td>
											<td class="NoiseDataTD"><input type="text" name="valor_calificacion_auto" id="valor_calificacion_auto" value="<?php echo $valor_calificacion_auto; ?>" size="8">&nbsp;dia(s)</td>
										</tr>
									</table>
								</div>
							
							</div>

      					</div>
      				</td>
      			</tr>
				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr>
				<tr>
					<td class="NoiseErrorDataTD" align="center">
						<div class="ui-buttonset">
							<button id="grabarpargen">Guardar cambios</button>&nbsp;&nbsp;&nbsp;&nbsp;
							<button id="salirpargen">Salir</button>
						</div>
					</td>
				</tr> 
			</table>
			<input type="hidden" name="saveconfig" id="saveconfig">
			<input type="hidden" name="paramegrupo" id="paramegrupo" value="formulario">
 		</form>
 		<div id="msgwindow" title="Adsum Kallpa"><span id="msg"></span></div>
 	</body>
<?php if(!$codigo) { echo " -->"; } ?>
</html>
