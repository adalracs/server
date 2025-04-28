<?php

ini_set("display_errors", 1);
ob_start();
	include ( "../src/FunPerPriNiv/pktblvistaestatusmat.php");
	include ( "../src/FunPerPriNiv/pktblfamestatusmat.php");
	include ( "../src/FunPerPriNiv/pktblitemdesa.php");
	include ( "../src/FunPerPriNiv/pktblusuario.php");
	include ( "../src/FunGen/sesion/fncvalses.php");
	include ( "../src/FunPerSecNiv/fncsqlrun.php");	
	include ( "../src/FunGen/floadtimehours.php");
	include ( "../src/FunGen/fncnumprox.php");
	include ( "../src/FunGen/cargainput.php");
	include ( "../src/FunGen/fncnumact.php");		

ob_end_flush();

$idcon = fncconn();

$rsFamEstatusMat = dinamicscanopfamestatusmat(array("famestestado" => "0"), array("famestestado" => "="), $idcon);
$nrFamEstatusMat = fncnumreg($rsFamEstatusMat);

?>
<html>
	<head>
		<title>Estatus Materiales</title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		<meta http-equiv="expires" content="0">
		<?php include('../def/jquery.library_maestro.php');?>
		<script type="text/javascript" src="../src/FunGen/starPage_position.js"></script>		
		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.function_comun.js"></script>
		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.ui.ajax_accionextras.js"></script>
		<script type="text/javascript">
			
			function filtroEstatus( cant ){

				var arrfamestatusmat = $("#arrfamestatusmat").val();
				var itedesancho = $("#itedesancho").val();
				var itedescalib = $("#itedescalib").val();
				var itedesformul = $("#itedesformul").val();

				var parameters = "";

				parameters = (arrfamestatusmat)? parameters + "&arrfamestatusmat=" + arrfamestatusmat : parameters + "&arrfamestatusmat=";
				parameters = (itedesancho)? parameters + "&itedesancho=" + itedesancho : parameters + "&itedesancho=";
				parameters = (itedescalib)? parameters + "&itedescalib=" + itedescalib : parameters + "&itedescalib=";
				parameters = (itedesformul)? parameters + "&itedesformul=" + itedesformul : parameters + "&itedesformul=";

				$.ajax({	   
					dataType: "html",
					type: "POST",        
					url: "../src/FunjQuery/jquery.phpscripts/jquery.listestatusmat.php",
					data: parameters,
					beforeSend: function(data){ 
						$('#listestatusmat').block({ theme : true , message : '<img src="../img/loading.gif">&nbsp;Espere mientras carga el listado.</img>'});
					},
					success: function(requestData){
						document.getElementById('listestatusmat').innerHTML = requestData;
					},
					complete : function(requestData){	
						$('#listestatusmat').unblock();
					}
				});
				

				return false;
			}

			$(function(){

				/*$(".btnestatus").button({ icons: { primary: "ui-icon-search" }}).click(function() {
					return false;
				});*/

				$( "#famestatusmat" ).buttonset();
					
			});	

		</script>
	</head>
<?php if(!$codigo){echo "<!--";} ?>
	<body bgcolor="FFFFFF" text="#000000">
		<form name="form1" method="post"  enctype="multipart/form-data">
			<table align="center" cellpadding="1" cellspacing="1" width="99%">
			<tr>
				<td>
					<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
						<tr>
							<td class="ui-state-default">&nbsp;
								<a onClick="return verocultar('filestatusmat',1);" href="javascript:animatedcollapse.toggle('filestatusmat');">
									<img id="row1" align="middle" align="top"  src="temas/Noise/AscOn.gif" border="0" />&nbsp;Filtros de status materiales.
								</a>

								<div id="filestatusmat" style="padding: 2px 2px 2px 2px; display:block;" >
									<?php if($nrFamEstatusMat > 0){ ?>
										<div id="toolbar" class="ui-widget-header ui-corner-all">
											<span id="famestatusmat">
										<?php 
											for($a = 0; $a < $nrFamEstatusMat; $a++){

											 	$rwFamEstatusMat = fncfetch($rsFamEstatusMat,$a);
											 	$idButton = "";
											 	$idButton = "famestatusmat_".$rwFamEstatusMat["famestcodigo"];
											 	$lblButton = "";
											 	$lblButton = $rwFamEstatusMat["famestnombre"];
										?>
											<input type="checkbox" id="<?php echo $idButton; ?>" name="<?php echo $idButton; ?>" onclick="setSelectionRow(this.value, document.getElementById('arrfamestatusmat').value, ',', 'arrfamestatusmat');filtroEstatus('<?php echo $nrFamEstatusMat; ?>');" value="<?php echo $rwFamEstatusMat["famestcodigo"]; ?>"><label for="<?php echo $idButton; ?>"><?php echo $lblButton; ?></label>
										<?php 
											}
										?>
											</span>
										</div>
									<?php 
										} 
									?>
									<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center">
										<tr>
											<td width="10%"  class="NoiseFooterTD">&nbsp;Ancho&nbsp;<b>(mm)<b></td>
											<td width="40%"  class="NoiseFooterTD">
												<select name="itedesancho" id="itedesancho" onchange="filtroEstatus(0);">
													<option value = "">-- Seleccione --</option>
													<?php
														include ('../src/FunGen/floadestatusmat.php');
														floaditedesancho($idcon);
													?>
												</select>
											</td>
											<td width="10%"  class="NoiseFooterTD">&nbsp;Calibre&nbsp;<b>(&micro;m)<b></td>
											<td width="40%"  class="NoiseFooterTD">
												<select name="itedescalib" id="itedescalib" onchange="filtroEstatus(0);">
													<option value = "">-- Seleccione --</option>
													<?php
														floadcalibre($idcon);
													?>
												</select>
											</td>
										</tr>
										<tr>
											<td width="10%"  class="NoiseFooterTD">&nbsp;Formula&nbsp;</td>
											<td colspan="3"  class="NoiseFooterTD">
												<select name="itedesformul" id="itedesformul" onchange="filtroEstatus(0);">
													<option value = "">-- Seleccione --</option>
													<?php
														floadformula($idcon);
													?>
												</select>
											</td>
										</tr>
						      		</table>
						     	</div> 
							</td>
						</tr>
					</table>

					<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
						<tr>
							<td class="ui-state-default">&nbsp;Listado de materiales</td>
						</tr>
						<div style="padding: 2px 2px 2px 2px; display:block;" >
							<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center">
								<tr>
									<td>
										<div id="listestatusmat">
											<?php
												$noAjax = true;
												include "../src/FunjQuery/jquery.phpscripts/jquery.listestatusmat.php";
											?>
										</div>
									</td>	
								</tr>
							</table>
						</div>
					</table>
				</td>
			</tr>
			<input type="hidden" name="arrfamestatusmat" id="arrfamestatusmat" value="<?php echo $arrfamestatusmat?>" />
			<input type="hidden" name="codigo" id="codigo" value="<?php echo $codigo; ?>" />
			<input type="hidden" name="accionnuevoopp" />
		</form>
		<div id="msgwindow" title="Adsum Kallpa"><span id="msg"></span></div>
  	</body>
<?php if(!$codigo){ echo " -->"; } ?>
</html>