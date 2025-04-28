<?php 
	include ('../src/FunGen/sesion/fncvalses.php'); 
	include ('../src/FunPerSecNiv/fncsqlrun.php'); 
	include ('../src/FunPerPriNiv/pktblnegocio.php');
	$idcon = fncconn();
?> 
<html>
	<head>
		<title>Listado de equipos por Ubicacion/Negocio</title>
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
					
					if(document.getElementById('arrusuaplanta').value == '')
						err = err + '* Debe seleccionar la(s) planta(s) para ver el listado de equipos.';
					
					if(err == '')
					{
						document.form1.action = 'detallainflistequipo.php';
						document.form1.submit();
					}
					else
					{
						document.getElementById('msg').innerHTML = '<font color="red">Error:</font><br>' + err;
						$('#msgwindow').dialog('open');
					}
					return false;
				});
			});

			/**
			 *
			 *
			 */
			function loadPlantasReport(negocicodigo)
			{
				$.ajax({	   
					dataType: "html",
					type: "POST",        
					url: "../src/FunjQuery/jquery.visors/jquery.negocioplanta.php", 	
					data: "negocicodigo1=" + negocicodigo,
					beforeSend: function(data){ },        
					success: function(requestData){
						if(requestData != '')
							document.getElementById('filplantas').innerHTML = requestData;
						document.getElementById('arrusuaplanta').value = '';
						
					},         
					error: function(requestData, strError, strTipoError){   
						alert("Error " + strTipoError +': ' + strError);
					},
					complete: function(requestData, exito){ }                                      
				});
			}

			
			function rldSubfunction(){}
		</script>
	</head>
<?php if(!$codigo){ echo "<!--";}?> 
	<body bgcolor="FFFFFF" text="#000000">
		<form name="form1" method="post"  enctype="multipart/form-data">
			<p><font class="NoiseFormHeaderFont">Listado de Equipos</font></p>
			<table border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content" width="670">
				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr>	
  				<tr><td class="ui-widget-header"><span class="style5"><font color="FFFFFF">&nbsp;</font></span></td></tr>
				<tr>
					<td>
						<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
							<tr>
  								<td class="NoiseFooterTD">&nbsp;Negocio</td>
  								<td class="NoiseDataTD"><select name="negocicodigo1" id="negocicodigo1" onchange="loadPlantasReport(this.value)">
									<option value="">-- Seleccione --</option>
									<?php 
										include '../src/FunGen/floadnegocio.php';
										floadnegocio($negocicodigo1, $idcon);
									?>
								</select></td>
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
											include '../src/FunjQuery/jquery.visors/jquery.negocioplanta.php'; 
										?>
									</div>
									<input type="hidden" name="arrusuaplanta" id="arrusuaplanta" value="<?php echo $arrusuaplanta; ?>">
								</td>
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
			<input name="flagtipoinforme" id="flagtipoinforme" type="hidden" value="<?php echo $flagtipoinforme ?>">
			<input name="codigo" id="codigo" type="hidden" value="<?php echo $codigo ?>">
		</form>
		<div id="msgwindow" title="Adsum Kallpa"><span id="msg"></span></div>
	</body>
<?php if(!$codigo){ echo " -->"; } ?> 
</html>