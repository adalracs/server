<?php 
ob_start(); 
	include ( '../src/FunGen/sesion/fncvalses.php');
	include ( '../src/FunPerPriNiv/pktblgrupcapa.php');
	include ( '../src/FunPerPriNiv/pktblusuario.php');
	include ( '../src/FunPerPriNiv/pktblcargo.php');
	 
	if($accionnuevogrupcapa)
		include ( 'grabagrupcapa.php');
		
ob_end_flush(); 
?>
<html> 
	<head> 
		<title>Nuevo registro de grupo capacitacion</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0"> 
		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.function_comun.js"></script>
		<?php include('../def/jquery.library_maestro.php');?>
		<script type="text/javascript">
			$(function(){
				$("#usuanombre1").autocomplete({
					source: "../src/FunjQuery/jquery.phpcombobox/jquery.cmbx_usuatecnico.php",
					minLength: 1,
					select: function(event, ui) {
						ui.item ? document.getElementById('usuacodigo').value = ui.item.id : document.getElementById('usuacodigo').value = "";
					}
				});
				
				/**
				 * Boton Ingresar Funcionario
				 */
				$('#anxempleado').button({ icons: { primary: "ui-icon-circle-plus" }, text: false }).click(function(){
					if(document.getElementById('usuacodigo').value != '')
					{
						var lstempleado = document.getElementById('lstempleado');
						var arrTecnicos = lstempleado.value.split(',');
						
						var enc = 0;
							
						for(var a = 0; a < (arrTecnicos.length); a++)
						{
							if(arrTecnicos[a] == document.getElementById('usuacodigo').value)
							{
								enc = 1;
								break;
							}
						}

						if(enc == 0)
						{
							lstempleado.value = ((lstempleado.value != '') ? lstempleado.value + ',' : '') + document.getElementById('usuacodigo').value;
							loadListempleado();
						}
							
						document.getElementById('usuacodigo').value = '';
						document.getElementById('usuanombre1').value = '';
					}						
					return false;
				});
				
				/**
				 * Boton Quitar Tecnico
				 */
				$('#retempleado').button({ icons: { primary: "ui-icon-circle-minus" }, text: false }).click(function() {
					loadListempleado();
					return false;
				});
			});

			function accionLoadlistempleado(objparams)
			{
				$.ajax({	   
					dataType: "html",
					type: "POST",        
					url: "../src/FunjQuery/jquery.visors/jquery.empleado.php",
					data: objparams,
					beforeSend: function(data){},        
					success: function(requestData){
						document.getElementById('emplegrupcapa').innerHTML = requestData;
					},         
					error: function(requestData, strError, strTipoError){ },
					complete: function(requestData, exito){}                                      
				});
				
			}

			function loadListempleado(){
				
				var arrObjItems = document.getElementById('lstempleado').value.split(','); //el comodin ',' es separador de filas
				var objparams = 'lstempleado=' + document.getElementById('lstempleado').value;
				
				accionLoadlistempleado(objparams);
			}
		</script>
		<style type="text/css">
			.ui-button-icon-only .ui-button-text, .ui-button-icons-only .ui-button-text {
			    padding: 1px;
			}
		</style>
	</head> 
<?php if(!$codigo){ echo "<!--";} ?>
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Grupo capacitaci&oacute;n</font></p> 
			<table border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content" width="784">
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
            			<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content"> 
 							<tr>
								<td width="20%" class="NoiseFooterTD"><?php if($campnomb["grucapnombre"] == 1){ $grucapnombre = null; echo "*";}?>&nbsp;Nombre&nbsp;</td>
								<td width="80%" class="NoiseDataTD"><input type="text" name="grucapnombre" size="30"	value="<?php if(!$flagnuevogrupcapa){ echo $sbreg[grucapnombre];}else {echo $grucapnombre; }?>"></td>
 							</tr>
						</table> 
            			<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center"> 
 							<tr>
 								<td>
 									<div style="width:760px; height: 16px; margin:0 auto;" class="ui-state-default">&nbsp;&nbsp;	
 										<a onClick="return verocultar('emplegrupcapa',2);" href="javascript:animatedcollapse.toggle('emplegrupcapa');"><img id="row2" align="middle" align="top"  src="temas/Noise/AscOn.gif" border="0">&nbsp;Integrantes</a>
									</div>
									<div style="width:760px; height: 35px; margin:0 auto;" class="ui-widget-content">
										<table border="0" cellspacing="0" cellpadding="0" align="center" width="100%">
											<tr> 
												<td style="height:35px;">
													&nbsp;Empleados&nbsp;<input name="usuanombre1" id="usuanombre1" type="text" size="95"><input type="hidden" name="usuacodigo" id="usuacodigo">
							            			<button id="anxempleado">Agregar funcionario</button>
							            			<button id="retempleado">Quitar funcionarios</button>
							            		</td>
							            	</tr>
							            </table>
									</div>
						  			<div id="emplegrupcapa">
									<?php 
										$noAjax = true;
										include '../src/FunjQuery/jquery.visors/jquery.empleado.php'; 
									?>
									</div>
									<input type="hidden" name="alllstempleadotmp" id="alllstempleadotmp" value="<?php echo $alllstempleadotmp; ?>">
									<input type="hidden" name="lstempleado" id="lstempleado" value="<?php echo $lstempleado; ?>">
									<input type="hidden" name="negocicodigo" id="negocicodigo" value="<?php  echo $negocicodigo;  ?>">
 								</td>
 							</tr>
						</table> 
            			<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content"> 
							<tr><td class="NoiseFooterTD"><?php if($campnomb["grucapdescri"] == 1){$grucapdescri = null; echo "*";}?>&nbsp;Nota</td></tr>
							<tr><td class="NoiseDataTD"><textarea name="grucapdescri" rows="3" cols="91"><?php if(!$flagnuevogrupcapa){ echo $sbreg[grucapdescri];}else{ echo $grucapdescri;} ?></textarea>  </td></tr>
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
			<input type="hidden" name="accionnuevogrupcapa"> 
			<input type="hidden" name="sourcetable" value="grupcapa">
			<input type="hidden" name="sourceaction" value="nuevo">			
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
		</form> 	
	</body> 
<?php if(!$codigo){ echo " -->"; } ?> 
</html>