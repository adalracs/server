<?php 
ob_start();
	include ( '../src/FunGen/sesion/fncvalses.php');
	include ( '../src/FunGen/fncnumprox.php');
	include ( '../src/FunGen/cargainput.php');
	include ( '../src/FunGen/fncnumact.php');
	include ( '../src/FunGen/floadtimehours.php');
	include ( '../src/FunGen/floadtimeminut.php');
	include ( '../src/FunPerSecNiv/fncsqlrun.php');
	include ( '../src/FunPerPriNiv/pktblop.php');
	include ( '../src/FunPerPriNiv/pktblopp.php');
	include ( '../src/FunPerPriNiv/pktblplanta.php');
	include ( '../src/FunPerPriNiv/pktblequipo.php');
	include ( '../src/FunPerPriNiv/pktblusuario.php');
	include ( '../src/FunPerPriNiv/pktblopflexo.php');
	include ( '../src/FunPerPriNiv/pktblopcorte.php');
	include ( '../src/FunPerPriNiv/pktblitemdesa.php');
	include ( '../src/FunPerPriNiv/pktblopestado.php');
	include ( '../src/FunPerPriNiv/pktblproducto.php');
	include ( '../src/FunPerPriNiv/pktblpadreitem.php');
	include ( '../src/FunPerPriNiv/pktbloplaminado.php');	
	include ( '../src/FunPerPriNiv/pktblformulacion.php');
	include ( '../src/FunPerPriNiv/pktblopextrusion.php');
	include ( '../src/FunPerPriNiv/pktbloppitemdesa.php');
	include ( '../src/FunPerPriNiv/pktblprocedimiento.php');
	include ( '../src/FunPerPriNiv/pktblprogramaflexo.php');
	include ( '../src/FunPerPriNiv/pktblprogramacorte.php');
	include ( '../src/FunPerPriNiv/pktblprogramalaminado.php');
	include ( '../src/FunPerPriNiv/pktblprogramaextrusion.php');	
	
	
	include ( '../src/FunGen/sesion/fnccaf.php');
	
	$idcon = fncconn();
	$reccomact =  fnccaf($GLOBALS[usuacodi],$_SERVER["SCRIPT_FILENAME"]);
ob_end_flush();
?>
<html>
	<head>
		<title>Informe de materiales </title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		<meta http-equiv="expires" content="0">
		<?php include('../def/jquery.library_maestro.php');?>
		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.function_comun.js"></script>
		<script type="text/javascript">
			$(function(){

				$('#aceptarinforme').button({ icons: { primary: "ui-icon-circle-check" } }).click(function() {
					$( "#aceptarinforme" ).button( "option", "disabled", true );
					//objetos a utilzar
					var obj_arrusuaplanta = document.getElementById('arrusuaplanta');
					var obj_arrsistema = document.getElementById('arrsistema');
					var obj_paditecodigo = document.getElementById('paditecodigo');
					var obj_opestacodigo = document.getElementById('opestacodigo');
					var obj_ordprofecini = document.getElementById('ordprofecini');
					var obj_ordprofecfin = document.getElementById('ordprofecfin');
					//valor de los objetos
					var arrusuaplanta = (obj_arrusuaplanta)? obj_arrusuaplanta.value : '' ; 
					var arrsistema = (obj_arrsistema)? obj_arrsistema.value : '' ; 
					var paditecodigo = (obj_paditecodigo)? obj_paditecodigo.value : '' ; 
					var opestacodigo = (obj_opestacodigo)? obj_opestacodigo.value : '' ; 					
					var ordprofecini = (obj_ordprofecini)? obj_ordprofecini.value : '' ; 					
					var ordprofecfin = (obj_ordprofecfin)? obj_ordprofecfin.value : '' ;
					//validacion de error
					var err = '';
					if(arrusuaplanta == '')					
						err = err + 'Advertencia : *** Debe seleccionar almenos una planta.<br>';

					if(arrsistema == '')					
						err = err + 'Advertencia : *** Debe seleccionar almenos una sistema.<br>';

					if( (ordprofecini != '' && ordprofecfin == '') || (ordprofecini == '' && ordprofecfin != '') )
						err = err + 'Advertencia : *** Debe seleccionar ambas fechas.<br>'; 

					if(err == '')
					{
						document.form1.action = 'detallainformemateriales.php';
						document.form1.submit();
					}
					else
					{
						$( "#aceptarinforme" ).button( "option", "disabled", false );
						document.getElementById('msg').innerHTML = err;
						$('#msgwindow').dialog('open');
					}
					return false;
				});
				
				var dates = $('#ordprofecini,#ordprofecfin').datepicker({
			        dateFormat : 'yy-mm-dd',
			        changeMonth : true,
			        changeYear : true,
			        onSelect: function(selectedDate) {
			            var option = this.id == "ordprofecini" ? "minDate" : "maxDate";
			            var instance = $(this).data("datepicker");
			            var date = $.datepicker.parseDate(instance.settings.dateFormat || $.datepicker._defaults.dateFormat, selectedDate, instance.settings);
			            dates.not(this).datepicker("option", option, date);
			        }
			    });
			    
			});
		    	
			function reloadSistema()
			{
				$.ajax({	   
					dataType: "html",
					type: "POST",        
					url: "../src/FunjQuery/jquery.visors/jquery.sistema.php", 	
					data: 'arrusuaplanta=' + document.getElementById('arrusuaplanta').value + '&usuaplantareportop=1',
					beforeSend: function(data){ },        
					success: function(requestData){
						if(requestData != '')
							document.getElementById('listsistema').innerHTML = requestData;
					},         
					error: function(requestData, strError, strTipoError){ },
					complete: function(requestData, exito){ }                                      
				});
			}
		</script>
	</head>
<?php if(!$codigo){ echo "<!--";}?> 
	<body bgcolor="FFFFFF" text="#000000">
		<form name="form1" method="post"  enctype="multipart/form-data">
			<p><font class="NoiseFormHeaderFont">Informe de materiales</font></p>
			<table border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content" width="670">
				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr>	
  				<tr><td class="ui-widget-header"><span class="style5"><font color="FFFFFF"> Informe de materiales</font></span></td></tr>
				<tr>
	    			<td>
	    				<div style="padding: 6px;">
	    			
	    					<!-- CONTENIDO PLANTAS / UBICACION --> 
							<div class="contenido-general">
								<div style="width:648px; height: 14px;padding: 1px;" class="ui-state-default">&nbsp;Plantas / Ubicacion</div>
  								<div id="listplanta" style="width:648px;">
									<?php 
										include_once '../src/FunPerPriNiv/pktblplanta.php';
										$noAjax = true;
										$usuaplantareportop = 1;
										include '../src/FunjQuery/jquery.visors/jquery.plantas.php'; 
									?>
								</div>
								<input type="hidden" name="arrusuaplanta" id="arrusuaplanta" value="<?php echo $arrusuaplanta; ?>">
							</div>
	    					<!-- FIN CONTENIDO PLANTAS / UBICACION -->
	    					  			
	    					<!-- CONTENIDO SISTEMAS / SECCION--> 
							<div class="contenido-general">
								<div style="width:648px; height: 14px;padding: 1px;" class="ui-state-default">&nbsp;Sistemas / Seccion</div>
  								<div id="listsistema" style="width:648px;">
									<?php 
										include_once '../src/FunPerPriNiv/pktblsistema.php';
										$noAjax = true;
										$usuaplantareportop = 1;
										include '../src/FunjQuery/jquery.visors/jquery.sistema.php'; 
									?>
								</div>
								<input type="hidden" name="arrsistema" id="arrsistema" value="<?php echo $arrsistema; ?>">
							</div>
	    					<!-- FIN CONTENIDO SISTEMAS / SECCION-->
	    				</div>
					</td>
				</tr>
				<tr> 
  					<td> 
            			<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center"> 
							<tr> 
								<td width="15%" class="NoiseFooterTD"><?php if($campnomb["paditecodigo"] == 1){ $paditecodigo = null; echo "*";}?>&nbsp;Material</td> 
 								<td width="45%" class="NoiseDataTD">&nbsp;
 									<select name="paditecodigo" id="paditecodigo">
 										<option value="">--Seleccione--</option>
 										<?php 
											include '../src/FunGen/floadpadreitem.php';	
											floadpadreitem($paditecodigo,$idcon);
										?>
 									</select>
 								</td> 
 								<td width="15%" class="NoiseFooterTD"><?php if($campnomb["opestacodigo"] == 1){ $opestacodigo = null; echo "*";}?>&nbsp;Estado</td> 
 								<td width="25%" class="NoiseDataTD">&nbsp;
 									<select name="opestacodigo" id="opestacodigo">
 										<option value="">--Seleccione--</option>
 										<?php 
											include '../src/FunGen/floadopestado.php';	
											floadopestadogestion($opestacodigo,$idcon);
										?>
 									</select>
 								</td> 
 							</tr>
 							<tr>
 								<td width="15%" class="NoiseFooterTD"><?php if($campnomb["ordprofecini"] == 1){ $ordprofecini = null; echo "*";}?>&nbsp;Desde</td> 
 								<td width="45%" class="NoiseDataTD">&nbsp;<input type="text" name="ordprofecini" id="ordprofecini" value="<?php echo $ordprofecini; ?>" /></td>
 								<td width="15%" class="NoiseFooterTD"><?php if($campnomb["ordprofecfin"] == 1){ $ordprofecfin = null; echo "*";}?>&nbsp;Hasta</td> 
 								<td width="25%" class="NoiseDataTD">&nbsp;<input type="text" name="ordprofecfin" id="ordprofecfin" value="<?php echo $ordprofecfin; ?>" /></td>
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
			<input name="codigo" id="codigo" type="hidden" value="<?php echo $codigo ?>">
			<input name="negocicodigo" id="negocicodigo" type="hidden" value="<?php echo $negocicodigo ?>">
		</form>
		<div id="msgwindow" title="Adsum Kallpa"><span id="msg"></span></div>
	</body>
<?php if(!$codigo){ echo " -->"; } ?> 
</html>