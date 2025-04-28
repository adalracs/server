<?php 
ob_start(); 
	include ( '../src/FunGen/sesion/fncvalses.php'); 
	include ( '../src/FunPerPriNiv/pktblusuario.php'); 
	include ( '../src/FunPerPriNiv/pktblequipo.php'); 
	include ( '../src/FunPerPriNiv/pktbltipomedi.php'); 
	include ( '../src/FunPerPriNiv/pktblmedidoequipo.php'); 
	include ( '../src/FunGen/cargainput.php'); 
	
	$idcon = fncconn();
	$usuario = cargausuanombre($usuacodi,$idcon);
	fncclose($idcon);
	
	if($accionnuevomedicion)
		include ( 'grabamedicion.php');
	
ob_end_flush(); 
?>
<html> 
	<head> 
		<title>Nuevo registro de mediciones</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0"> 
		<?php include('../def/jquery.library_maestro.php');?>
		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.function_comun.js"></script>
		<script type="text/javascript">
			$(function(){

				$('#ingresarequipo').button({ icons: { primary: "ui-icon-circle-plus" }, text: false }).click(function() {
					var equipo = document.getElementById('medequcodigo');
					var lectura = document.getElementById('medicicantid');
					var arrmedicion = document.getElementById('arrmedicion');
					var arr = document.getElementById('arrmedicion').value.split(':|:');
					var err = '';
					
					if(Number(equipo.value) <= 0)
						err = err + 'Advertencia: Debe seleccionar equipo <br>';
					
					if(Number(lectura.value) <= 0)
						err = err + 'Advertencia: Debe ingresar lectura <br>';
					
					
					if(err == '')
					{
						var newRow = equipo.value + ':-:' + lectura.value;
						var enc = reemplazaEquipo(newRow,equipo.value);

						if(enc == false)
							(arrmedicion.value) ? arrmedicion.value = arrmedicion.value + ':|:' +  newRow : arrmedicion.value = newRow; 
						
						accionReloadListMedicion();
					}
					else
					{
						document.getElementById('msg').innerHTML = err;
						$("#msgwindow").dialog("open");
					}
					
					equipo.value = '';
					lectura.value = '';
					return false;
				});
				
				$('#quitarequipo').button({ icons: { primary: "ui-icon-circle-minus" }, text: false }).click(function() {
					accionReloadListMedicion();
					return false;
				});

			});

			function reemplazaEquipo(newRow,equipo)
			{
				var arrObjs = document.getElementById('arrmedicion').value.split(':|:');
				var arrmedicion = document.getElementById('arrmedicion');
				var arrtabla;
				var enc = false;
				for(var i=0;i < arrObjs.length;i++)
				{
					var arr = arrObjs[i].split(':-:');
					if(arr[0] == equipo)
					{
						arrtabla = (arrtabla)? arrtabla + ':|:' + newRow : newRow;
						enc = true;
					}
					else
					{
						arrtabla = (arrtabla)? arrtabla + ':|:' + arrObjs[i] : arrObjs[i];
					}
				}
				
				arrmedicion.value = arrtabla;
				return enc;
			}

			function accionReloadListMedicion()
			{	
				$.ajax({	   
					dataType: "html",
					type: "POST",        
					url: "../src/FunjQuery/jquery.visors/jquery.medicion.php", 	
					data: 'arrmedicion=' + document.getElementById('arrmedicion').value ,
					beforeSend: function(data){ },        
					success: function(requestData){
						if(requestData != '')
						{
							document.getElementById('filtrlistamedicion').innerHTML = requestData;
						}
					},         
					error: function(requestData, strError, strTipoError){ },
					complete: function(requestData, exito){ }                                      
				});
			}
		</script>
	</head> 
<?php if(!$codigo){ echo "<!--";} ?>
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Mediciones</font></p> 
			<table border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content" width="450">
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
								<td width="20%" class="NoiseFooterTD">&nbsp;Encargado&nbsp;</td>
								<td colspan="4" class="NoiseDataTD" colspan="2"><b><?php echo $usuario ?></b></td>
 							</tr>
 							<tr>
								<td width="20%" class="NoiseFooterTD"><?php if($campnomb["medequcodigo"] == 1){ $medequcodigo = null; echo "*";}?>&nbsp;Equipo / Medidor &nbsp;</td>
								<td width="30%" class="NoiseDataTD"><select name="medequcodigo" id="medequcodigo">
								<option value="">--Seleccione--</option>
								<?php 
								include '../src/FunGen/floadmedicion.php';
								$idcon = fncconn();
								floadmedicion($medequcodigo,$idcon);
								?>
								</select></td>
								<td width="20%" class="NoiseFooterTD">&nbsp;Lectura &nbsp;</td>
								<td width="15%" class="NoiseDataTD"><input type="text" name="medicicantid" id="medicicantid" value="<?php echo $medicicantid ?>" /></td>
 								<td width="15%" class="NoiseDataTD"><div class="ui-buttonset-fe">
								<button id="ingresarequipo">Agregar item</button>
								<button id="quitarequipo">Quitar item</button>
							</div></td>
 							</tr>
 							<tr> 
  								<td colspan="5"> 
            						<table width="95%" border="0" cellspacing="1" cellpadding="0" align="center"> 
 										<tr>
 											<td>
												<div id="filtrlistamedicion">
												<?php
													$noAjax = true;
													include '../src/FunjQuery/jquery.visors/jquery.medicion.php';  
												?>
												</div>
 											</td>
 										</tr>
									</table> 
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
			<input type="hidden" name="accionnuevomedicion">  
			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>">
			<input type="hidden" name="sourceaction" value="nuevo">						
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
		</form> 	
		<div id="msgwindow" title="Adsum Kallpa"><span id="msg"></span></div>
	</body> 
<?php if(!$codigo){ echo " -->"; } ?> 
</html>