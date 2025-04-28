<?php
//by ralvear
ob_start();
	include ( '../src/FunGen/sesion/fncvalses.php');
	include ( '../src/FunGen/fncnumprox.php');
	include ( '../src/FunGen/cargainput.php');
	include ( '../src/FunGen/fncnumact.php');
	include ( '../src/FunGen/floadtimehours.php');
	include ( '../src/FunGen/floadtimeminut.php');
	include ( '../src/FunPerSecNiv/fncsqlrun.php');
	include ( '../src/FunPerPriNiv/pktbltiposoliprog.php');
	include ( '../src/FunPerPriNiv/pktblequipo.php');
	include ( '../src/FunPerPriNiv/pktbloppvelocidadpn.php');
	include ( '../src/FunPerPriNiv/pktbloppajustepn.php');
	include ( '../src/FunPerPriNiv/pktblajustepn.php');
	include ( '../src/FunPerPriNiv/pktblvelocidadpn.php');
	include ( '../src/FunPerPriNiv/pktblop.php');
	include ( '../src/FunPerPriNiv/pktblreporteoppreportepn.php');
	include ( '../src/FunPerPriNiv/pktblitemdesa.php');
	include ( '../src/FunPerPriNiv/pktbloppitemdesa.php');
	include ( '../src/FunPerPriNiv/pktblopextrusion.php');
	include ( '../src/FunPerPriNiv/pktblopcorteextrusion.php');
	include ( '../src/FunPerPriNiv/pktblopflexo.php');
	include ( '../src/FunPerPriNiv/pktbloplaminado.php');
	include ( '../src/FunPerPriNiv/pktblopcorte.php');
	include ( '../src/FunPerPriNiv/pktblopsellado.php');
	include ( '../src/FunPerPriNiv/pktblopdoblado.php');
	include ( '../src/FunPerPriNiv/pktbloppauchado.php');
	include ( '../src/FunPerPriNiv/pktbloptroquelado.php');
	include ( '../src/FunPerPriNiv/pktblopmicroperforado.php');
	include ( '../src/FunPerPriNiv/pktblopvalvulado.php');
	include ( '../src/FunPerPriNiv/pktblsoliprog.php');
	include ( '../src/FunPerPriNiv/pktblformula.php');
	include ('../src/FunGen/sesion/fnccaf.php');
	include ( '../src/FunPerPriNiv/pktblreporteopp.php');
$reccomact = fnccaf ( $GLOBALS ["usuacodi"], $_SERVER ["SCRIPT_FILENAME"] ); 

	/*$arrconf = array(
		'1' => 'programaextrusion',
		'2' => 'programalaminado',
		'3' => 'programaflexo',
		'4' => 'programacorte',
		'5' => 'programasellado',
		'6' => 'programatroquelado',
		'7' => 'programapauchado',
		'8' => 'programadoblado',
		'9' => 'programamicroperforado',
		'10' => 'programacorte',
		'12' => 'programavalvulado',
		'13' => 'programacorteextrusion'
		);*/

	$idcon = fncconn();

	$rsTiposoliprog = fullscantiposoliprog($idcon);
	$nrTiposoliprog = fncnumreg($rsTiposoliprog);

	for( $a = 0; $a < ($nrTiposoliprog); $a++ ){
		$rwTiposoliprog = fncfetch( $rsTiposoliprog, $a );
		$arrTiposoliprog = ($arrTiposoliprog)? $arrTiposoliprog.','.$rwTiposoliprog['tipsolcodigo'] : $rwTiposoliprog['tipsolcodigo']  ;
	}
ob_end_flush();
?>
<html>
	<head>
		<title>Reporte ordenes de produccion</title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		<meta http-equiv="expires" content="0">
		<?php include('../def/jquery.library_maestro.php');?>
		<script type="text/javascript" src="../src/FunGen/starPage_position.js"></script>		
		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.function_comun.js"></script>
		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.ui.ajax_accionextras.js"></script>
		<!--<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jq.fncreporteopp.js"></script>-->
		 <style>
			label {display: inline-block;width: 5em;}
			#materiaprima{
				border:solid 5px #62b1ed;
				-moz-border-radius: 14px;
				-webkit-border-radius: 14px;
				border-radius: 14px;
				padding: 5px;
				/*float: left;*/
				width: 95%;
				height: 300px;
				margin-right: 5px;
			}
			#desperdicio{
				border:solid 5px #62b1ed;
				-moz-border-radius: 14px;
				-webkit-border-radius: 14px;
				border-radius: 14px;
				padding: 5px;	
				height: 170px;
				width: 100%;
			}
			#tiempo{	
				border:solid 5px #62b1ed;
				-moz-border-radius: 14px;
				-webkit-border-radius: 14px;
				border-radius: 14px;
				padding: 5px;
				height: 200px;
				width: 100%;
			}
			#tiempodesperdicio{
				width: 95%;
				/*float: left;*/
				height: 500px;
			}
			.consli{
				border:solid 5px #62b1ed;
				-moz-border-radius: 14px;
				-webkit-border-radius: 14px;
				border-radius: 14px;
				float: left;
				width: 500px;
			}
			#manoobra{
				border:solid 5px #62b1ed;
				-moz-border-radius: 14px;
				-webkit-border-radius: 14px;
				border-radius: 14px;
				padding: 5px;
				/*float: left;*/
				width: 100%;
				height: 300px;
				margin-right: 5px;
			}
			#totales{
				border:solid 5px #62b1ed;
				-moz-border-radius: 14px;
				-webkit-border-radius: 14px;
				border-radius: 14px;
				padding: 5px;
				float: left;
				width: 100%;
				height: 100px;
				margin-right: 5px;
			}
			#fabricacion{
				border:solid 5px #62b1ed;
				-moz-border-radius: 14px;
				-webkit-border-radius: 14px;
				border-radius: 14px;
				padding: 5px;
				float: left;
				width: 100%;
				height: 200px;
				margin-right: 5px;
			}
		</style>
		<script type="text/javascript" src="../src/FunChart/js/json/json2.js"></script>
		<script type="text/javascript" src="../src/FunChart/js/swfobject.js"></script>
		<script type="text/javascript">
			
		</script>
		<script>
			$(function(){
				$('#exportexcel').button({ icons: { primary: "ui-icon-circle-check" } }).click(function() {
					$.ajax({	   
						dataType: "html",
						type: "POST",        
						url: "../src/FunPHPExcel/infrecostoproceso.php", 	
						data: 'ordcomcodcli='+document.getElementById('tipsolcodigo').value,
						beforeSend: function(data){
							document.getElementById('excel').innerHTML = '<img src="../img/loading.gif">&nbsp;Espere mientras carga la informacion.</img>';		
						},                  
						success: function(requestData){
							if(requestData != '')
							{
								document.getElementById('excel').innerHTML = requestData;
							}
						},         
						error: function(requestData, strError, strTipoError){ },
						complete: function(requestData, exito)
						{}                                      
					});
				});

				$('#detallecostos').tabs({
					ajaxOptions: {
						error: function(xhr, status, index, anchor) {
						$(anchor.hash).html("No se puede cargar esta pesta&ntilde;a. Vamos a tratar de solucionar este problema lo m&aacute;s pronto posible.");
						}
					}
				});

				$("#cliente").autocomplete({
					source: "../src/FunjQuery/jquery.phpcombobox/jquery.cmbx_ordcomcliente.php",
					minLength: 0,
					select: function(event, ui) {
						if(ui.item)
						{
							document.getElementById('ordcomcodcli').value = ui.item.id;
							cargarOpp(ui.item.id);

						}
						else
						{
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

				$("#tipsolcodigo").change(function(){
					var err = '';

					if(document.getElementById('consulfecfin').value == '' || document.getElementById('consulfecini').value == '')
						(err != '') ? err = err + '<br>* Debe especificar la fecha de inicio y fecha fin.' : err = err + '* Debe especificar la fecha de inicio y fecha fin.' ;
					else if(document.getElementById('consulfecfin').value < document.getElementById('consulfecini').value)
						(err != '') ? err = err + '<br>* La fecha de inicio debe se mayor a la fecha fin.' : err = err + '* La fecha de inicio debe se mayor a la fecha fin.';

					if(err == '')
					{
						cargarOpp(this.value,document.getElementById('consulfecini').value,document.getElementById('consulfecfin').value);					
					}else{
						document.getElementById('msg1').innerHTML = '<font color="red">Error:</font><br>' + err;
						$('#msgwindow').dialog('open');
					}
					return false;
				});
			});

			function cargarOpp(ordcomcodcli,consulfecini,consulfecfin)
			{
				var err = '';
	
				
				if(!ordcomcodcli)
					err = err + 'Advertencia : Error inesperado.';
				
				if(err == '')
				{
					$.ajax({	   
						dataType: "html",
						type: "POST",        
						url: "../src/FunjQuery/jquery.visors/costos/jquery.listamateriales.php", 	
						data: 'ordcomcodcli='+ordcomcodcli+'&consulfecini='+consulfecini+'&consulfecfin='+consulfecfin,
						beforeSend: function(data){
							document.getElementById('materiaprima').innerHTML = '<img src="../img/loading.gif">&nbsp;Espere mientras carga la informacion.</img>';		
						},          
						success: function(requestData){
							if(requestData != '')
							{
								document.getElementById('materiaprima').innerHTML = requestData;
							}
						},         
						error: function(requestData, strError, strTipoError){ },
						complete: function(requestData, exito)
						{

							document.getElementById('cosmanomp').innerHTML=formatNumber.new(Math.round(document.getElementById('consolcostmp').value,2),'$');
							MP=document.getElementById('consolcostmp').value;
							$('#consmateriaprima').val(document.getElementById('consolcostmp').value);
							doblecarga();
							$.ajax({	   
									dataType: "html",
									type: "POST",        
									url: "../src/FunjQuery/jquery.visors/costos/jquery.manoobra.php", 	
									data: 'ordcomcodcli='+ordcomcodcli+'&consulfecini='+consulfecini+'&consulfecfin='+consulfecfin,
									beforeSend: function(data){
										document.getElementById('manoobra').innerHTML = '<img src="../img/loading.gif">&nbsp;Espere mientras carga la informacion.</img>';		
									},          
									success: function(requestData){
										if(requestData != '')
										{
											document.getElementById('manoobra').innerHTML = requestData;
										}
									},         
									error: function(requestData, strError, strTipoError){ },
									complete: function(requestData, exito)
									{
										document.getElementById('cosmanoobra').innerHTML=formatNumber.new(document.getElementById('consolcostmo').value,"$");
										$('#consmanoobra').val(document.getElementById('consolcostmo').value);
										doblecarga();
									}                                      
							});

						}                                      
					});

					$.ajax({	   
						dataType: "html",
						type: "POST",        
						url: "../src/FunjQuery/jquery.visors/costos/jquery.listadesperdicio.php", 	
						data: 'ordcomcodcli='+ordcomcodcli+'&consulfecini='+consulfecini+'&consulfecfin='+consulfecfin,
						beforeSend: function(data){
							document.getElementById('desperdicio').innerHTML = '<img src="../img/loading.gif">&nbsp;Espere mientras carga la informacion.</img>';		
						},          
						success: function(requestData){
							if(requestData != '')
							{
								document.getElementById('desperdicio').innerHTML = requestData;
							}
						},         
						error: function(requestData, strError, strTipoError){ },
						complete: function(requestData, exito)
						{
							doblecarga();
						}                                      
					});

				/*	$.ajax({	   
						dataType: "html",
						type: "POST",        
						url: "../src/FunjQuery/jquery.visors/costos/jquery.listatiempos.php", 	
						data: 'ordcomcodcli='+ordcomcodcli+'&consulfecini='+consulfecini+'&consulfecfin='+consulfecfin,
						beforeSend: function(data){
							document.getElementById('tiempo').innerHTML = '<img src="../img/loading.gif">&nbsp;Espere mientras carga la informacion.</img>';		
						},          
						success: function(requestData){
							if(requestData != '')
							{
								document.getElementById('tiempo').innerHTML = requestData;
							}
						},         
						error: function(requestData, strError, strTipoError){ },
						complete: function(requestData, exito)
						{
							doblecarga();
						}                                      
					});*/

					$.ajax({	   
						dataType: "html",
						type: "POST",        
						url: "../src/FunjQuery/jquery.visors/costos/jquery.gastofabrica.php", 	
						data: 'ordcomcodcli='+ordcomcodcli+'&consulfecini='+consulfecini+'&consulfecfin='+consulfecfin,
						beforeSend: function(data){

							document.getElementById('fabricacion').innerHTML = '<img src="../img/loading.gif">&nbsp;Espere mientras carga la informacion.</img>';		
						},          
						success: function(requestData){
							if(requestData != '')
							{

								document.getElementById('fabricacion').innerHTML = requestData;
							}
						},         
						error: function(requestData, strError, strTipoError){ },
						complete: function(requestData, exito)
						{
							doblecarga();
							document.getElementById('cosfabrica').innerHTML=formatNumber.new(document.getElementById('totalcostofab').value,"$");
						}                                      
					});
				}
				else
				{
					document.getElementById('msg1').innerHTML = err;
					$("#msgwindowup").dialog("open");
				}
			}
			function calculototal(mp,mo,fb){
				if(!mp){mp=0;}
				if(!mo){mo=0;}
				if(!fb){fb=0;}
				return parseInt(mp)+parseInt(mo)+parseInt(fb);
			}
			function doblecarga(){
				var TPRO=calculototal((parseInt($('#consmateriaprima').val())+parseInt($('#costodesperdicio').val())),$('#consmanoobra').val(),$('#totalcostofab').val());
				document.getElementById('totalporceso').innerHTML=formatNumber.new(calculototal((parseInt($('#consmateriaprima').val())+parseInt($('#costodesperdicio').val())),$('#consmanoobra').val(),$('#totalcostofab').val()),"$");
				//swfobject.embedSWF("../src/FunChart/open-flash-chart.swf", "graph_data", "700", "270", "9.0.0", "expressInstall.swf", {"data-file":"../src/FunChart/ofc.graph.charts/ofc.costoproceso.php?parameter="+$('#consmateriaprima').val()+"[::]"+$('#consmanoobra').val()+"[::]"+$('#totalcostofab').val()+"[::]"+TPRO,"loading":"Escribiendo la grafica..."},false);
			}
			var formatNumber = {
			 separador: ".", // separador para los miles
			 sepDecimal: ',', // separador para los decimales
			 formatear:function (num){
			  num +='';
			  var splitStr = num.split('.');
			  var splitLeft = splitStr[0];
			  var splitRight = splitStr.length > 2 ? this.sepDecimal + splitStr[1] : '';
			  var regx = /(\d+)(\d{3})/;
			  while (regx.test(splitLeft)) {
			  splitLeft = splitLeft.replace(regx, '$1' + this.separador + '$2');
			  }
			  return this.simbol + splitLeft  +splitRight;
			 },
			 new:function(num, simbol){
			  this.simbol = simbol ||'';
			  return this.formatear(num);
			 }
			}
		</script> 
	</head>

	<body bgcolor="FFFFFF" text="#000000">
		<form name="form1" method="post" enctype="multipart/form-data">
			<div id="detallaprog" style="height: 500px;" class="ui-state-default">
				<div id="detallecostos">
					<div>
						<table width="100%">
							<tr>
								<td colspan="5">
									<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
										<tr><td colspan="2" class="ui-state-default">*&nbsp;Periodo</td></tr>
										<tr class="NoiseDataTD">
											<td width="20%" >&nbsp;Desde&nbsp;&nbsp;<input name="consulfecini" id="consulfecini" type="text" size="12"></td>
											<td width="80%" >&nbsp;Hasta&nbsp;&nbsp;<input name="consulfecfin" id="consulfecfin" type="text" size="12"></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td class="NoiseFooterTD">Proceso</td>
								<td class="NoiseDataTD">
								<select name="tipsolcodigo" id="tipsolcodigo">
									<option value="">--Seleccione--</option>
									<?php 
										include ('../src/FunGen/floadtiposoliprog.php');
										floadtiposoliprog1($tipsolcodigo, $idcon);
									?>
								</select>
								</td>
								<td><div id="excel"></div></td>
							</tr>
						</table>

					</div>
					<!--<ul>
						<li><a href="#tab_1">Materia prima</a></li>
						<li><a href="#tab_2">Mano de obra</a></li>
						<li><a href="#tab_3">Fabricacion</a></li>
						<li><a href="#tab_4">Total</a></li>
					</ul>-->

					<div id="tab_1" style="height: 400px; margin:0 auto; overflow:auto; width:100%;">
						<div id="materiaprima" >
							<div class="ui-widget">
	 							<div style="margin-top: 20px; padding: 0 .7em;" class="ui-state-highlight ui-corner-all"> 
	  							<p><span style="float: left; margin-right: .3em;" class="ui-icon ui-icon-info"></span>
	  							<b>No se encontraron materias primas para este proceso .</b></p>
	 							</div>
							</div>
						</div>
						<div id="tiempodesperdicio">
							<div id="desperdicio">
								<div class="ui-widget">
		 							<div style="margin-top: 20px; padding: 0 .7em;" class="ui-state-highlight ui-corner-all"> 
		  							<p><span style="float: left; margin-right: .3em;" class="ui-icon ui-icon-info"></span>
		  							<b>No se encontraron desperdicios para este proceso .</b></p>
		 							</div>
								</div>
							</div>
							<!--<div id="tiempo">
								<div class="ui-widget">
		 							<div style="margin-top: 20px; padding: 0 .7em;" class="ui-state-highlight ui-corner-all"> 
		  							<p><span style="float: left; margin-right: .3em;" class="ui-icon ui-icon-info"></span>
		  							<b>No se encontraron OPP {Ordenes de produccion programadas} asociadas a algun equipo.</b></p>
		 							</div>
								</div>
							</div>-->
							<div id="manoobra" >
								<div class="ui-widget">
		 							<div style="margin-top: 20px; padding: 0 .7em;" class="ui-state-highlight ui-corner-all"> 
		  							<p><span style="float: left; margin-right: .3em;" class="ui-icon ui-icon-info"></span>
		  							<b>No se encontraron tiempos para este proceso .</b></p>
		 							</div>
								</div>
						    </div>
						    <div id="fabricacion" >
						    	<div class="ui-widget">
		 							<div style="margin-top: 20px; padding: 0 .7em;" class="ui-state-highlight ui-corner-all"> 
		  							<p><span style="float: left; margin-right: .3em;" class="ui-icon ui-icon-info"></span>
		  							<b>No se encontraron datos para este proceso .</b></p>
		 							</div>
								</div>
						    </div>
						    <div id="totales">
								<div class="ui-widget">
									<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
										<tr>
											<td  width="100" class="NoiseFooterTD" style="border-top:0; border-bottom:0; border-left:0;">Mano de obra</td>
											<td  width="80" class="NoiseDataTD" ><div id="cosmanoobra"></div></td>
										</tr>
										<tr>
											<td width="100" class="NoiseFooterTD" style="border-top:0; border-bottom:0; border-left:0;">Materia prima</td>
											<td width="80" class="NoiseDataTD"><div id="cosmanomp"></div></td>
										</tr>	
										<tr>
											<td width="100" class="NoiseFooterTD" style="border-top:0; border-bottom:0; border-left:0;">Costos Fabrica</td>
											<td width="80" class="NoiseDataTD"><div id="cosfabrica"></div></td>
										</tr>
										<tr>
											<td width="100" class="NoiseFooterTD" style="border-top:0; border-bottom:0; border-left:0;">Total</td>
											<td width="80" class="NoiseDataTD"><div id="totalporceso"></div></td>
										</tr>
									</table>
								</div>
						    </div>
					</div>
				</div>
				<table border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content" width="100%">
				<tr><td>&nbsp;</td></tr>
					<tr>
						<td class="NoiseErrorDataTD" align="center"><div class="ui-buttonset">
							<button id="exportexcel" type="button">Exportar Excel</button>&nbsp;
						</div></td>
					</tr>
				<tr><td>&nbsp;</td></tr>
			</table>
			</div>
			<input type="hidden" name="consmanoobra" id="consmanoobra">
			<input type="hidden" name="consmateriaprima" id="consmateriaprima" >
			<input type="hidden" name="consfabrica" id="consfabrica" >
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
			<input type="hidden" name="sourcetable" id="sourcetable" value="reporteopp"> 
			<input type="hidden" name="selstar" id="selstar" value="0"> 
			<input type="hidden" name="nombtabl" value="vistareporteopp"> 
			<input type="hidden" name="columnas" value="ordoppcodigo"> 
			<input type="hidden" name="ordoppcodigo" id="ordoppcodigo"> 
			<input type="hidden" name="nombtabl" value="vistareporteopp"> 
			<input type="hidden" name="vistares" id="vistares" value="1"> 
			<div id="msgwindow" title="Adsum Kallpa"><span id="msg1"></span></div> 
		</form>
	</body>

</html>

