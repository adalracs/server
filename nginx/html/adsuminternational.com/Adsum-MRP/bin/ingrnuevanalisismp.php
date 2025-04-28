<?php 
ob_start();
	include ( '../src/FunPerPriNiv/pktblrecepcionmercancia.php');
	include ( '../src/FunPerPriNiv/pktblestadoanalisis.php');
	include ( '../src/FunPerPriNiv/pktbltipoitemdesa.php');
	include ( '../src/FunPerPriNiv/pktblproveefabri.php');
	include ( '../src/FunPerPriNiv/pktblfabricante.php');
	include ( '../src/FunPerPriNiv/pktblanalisismp.php');
	include ('../src/FunPerPriNiv/pktblvaranalisis.php');
	include ( '../src/FunPerPriNiv/pktblitemdesa.php');
	include ( '../src/FunPerPriNiv/pktblproveedo.php');
	include ( '../src/FunPerPriNiv/pktblusuario.php');
	include ( '../src/FunGen/sesion/fncvalses.php'); 	
	include ( '../src/FunPerPriNiv/pktbllote.php');
	include ( '../src/FunGen/cargainput.php');

	if($accionnuevoanalisismp){
		include ( 'grabaanalisismp.php');
	}

	if(!$flagnuevoanalisismp){

		$analisdescri = "Gestion Analisis [OK]";

	}

ob_end_flush();

$idcon = fncconn();

	if( $estanacodigo > 0){

		$rwAnalisisMp = loadrecordestadoanalisis($estanacodigo,$idcon);
		$tipestcodigo = $rwAnalisisMp["tipestcodigo"];
	}
?>
<html> 
	<head> 
		<title>Nuevo registro de analisis de materias primas</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0"> 
		<?php include('../def/jquery.library_maestro.php');?>
		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.function_comun.js"></script>
		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jq.fncanalisismp.js"></script>
	</head> 
<?php if(!$codigo){ echo "<!--";} ?>
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Analisis de materias primas</font></p> 
			<table border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content" width="650">
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
            			<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center"> 
            				<tr>
								<td width="20%" class="NoiseFooterTD">&nbsp;Responsable</td>
								<td width="80%" class="NoiseDataTD"><?php echo ($usuacodi)? cargausuanombre($usuacodi,$idcon) : "---" ; ?></td> 
 							</tr>
 							<tr>
								<td width="20%" class="NoiseFooterTD"><?php if($campnomb["analisfecha"] == 1){ $analisfecha = null; echo "*";}?>&nbsp;Fecha</td>
								<td width="80%" class="NoiseDataTD"><?php echo date("Y-m-d"); ?></td> 
 							</tr>
            				<tr>
     							<td width="20%" class="NoiseFooterTD"><?php if($campnomb["proveecodigo"] == 1){ $proveecodigo = null; echo "*";}?>&nbsp;Proveedor</td>
     							<td width="80%" class="NoiseDataTD">
     								<select name="proveecodigo" id="proveecodigo">
     									<option value = "">--Seleccione--</option>
	     								<?php
											include ('../src/FunGen/floadproveedo.php');
											floadproveedosel($proveecodigo,$idcon);
										?>
    								</select>
    							</td>
							</tr>
							<tr>
							 	<td width="20%" class="NoiseFooterTD"><?php if($campnomb["fabricodigo"] == 1){ $fabricodigo = null; echo "*";}?>&nbsp;Fabricante</td>
					    		<td width="80%" class="NoiseDataTD">
									<select name="fabricodigo" id="fabricodigo">
										<option value="">--Seleccione--</option>
										<?php
											include ('../src/FunGen/floadfabricante.php');	
											floadfabricanteproveedor($fabricodigo,$proveecodigo,$idcon);
										?>	
								   	</select>
					    		</td>
					    	</tr>
							<tr>
     							<td width="20%" class="NoiseFooterTD"><?php if($campnomb["lotecodigo"] == 1){ $lotecodigo = null; echo "*";}?>&nbsp;Lote</td>
	     						<td width="80%" class="NoiseDataTD">
	     							<select name="lotecodigo" id="lotecodigo">
	     								<option value="">--Seleccione--</option>
	     								<?php
											include ('../src/FunGen/floadlote.php');
											floadlotefabricante($lotecodigo,$fabricodigo, $idcon);
										?>
    								</select>
    							</td>
							</tr>
							<tr>
								<td width="20%" class="NoiseFooterTD"><?php if($campnomb["itedescodigo"] == 1){ $itedescodigo = null; echo "*";}?>&nbsp;Item</td>
								<td width="80%" class="NoiseDataTD">
									<select name="itedescodigo" id="itedescodigo">
										<option value="">--Seleccione--</option>
										<?php
											include ('../src/FunGen/floaditemdesa.php');
											floaditemdesaanalisismp($itedescodigo,$lotecodigo,$idcon);
										?>
									</select>
								</td> 
							</tr>
							<tr>
								<td width="20%" class="NoiseFooterTD"><span id="lblhistorial" style="display:<?php echo ($itedescodigo > 0)? "block" : "none" ; ?>" >&nbsp;Historial</span></td>
								<td width="80%" class="NoiseDataTD"><span id="objhistorial" style="display:<?php echo ($itedescodigo > 0)? "block" : "none" ; ?>" ><small><button id="detanalisismp" onclick="">Detallar Historial Analisis</button></small></span></td> 
							</tr>
							<tr>
								<td width="20%" class="NoiseFooterTD"><?php if($campnomb["analistipo"] == 1){ $analistipo = null; echo "*";}?>&nbsp;Re Analisis ?</td>
								<td width="80%" class="NoiseDataTD">&nbsp;Si&nbsp;<input type="radio" name="analistipo" id="analistipo" value="1" <?php if($analistipo == "1") echo 'checked'; ?> />&nbsp;No&nbsp;<input type="radio" name="analistipo" id="analistipo" value="0" <?php if($analistipo != "1") echo 'checked'; ?> /></td> 
							</tr>
							<tr>
								<td colspan="2">
 									<div class="ui-buttonset ui-state-default NoiseDataTD">&nbsp;Plan de inspecci&oacute;n&nbsp;</div>
 										<div id="filtrlistavaranalisis">
										<?php
											$noAjax = true;
											include '../src/FunjQuery/jquery.visors/jq.vanalisismp.php';  
										?>
									</div>
 								</td>
							</tr>
      						<tr>
     							<td width="20%" class="NoiseFooterTD"><?php if($campnomb["estanacodigo"] == 1){ $estanacodigo = null; echo "*";}?>&nbsp;Estado</td>
     							<td width="80%" class="NoiseDataTD">
     								<select name="estanacodigo" id="estanacodigo">
     									<option value = "">-- Seleccione --</option>
	     								<?php									
											include ('../src/FunGen/floadestadoanalisis.php');
											floadestadoanalisis($estanacodigo,$idcon);
										?>
    								</select>
    							</td>
							</tr>
							<tr>
								<td width="20%" class="NoiseFooterTD"><span id="lblanaliscantap" style="display:<?php echo ($tipestcodigo == 1)? "none" : "block" ; ?>">&nbsp;<?php if($campnomb["analiscantap"] == 1){echo "*";}?>Cantidad Aprobada</span></td>
								<td width="80%" class="NoiseDataTD"><span id="objanaliscantap" style="display:<?php echo ($tipestcodigo == 1)? "none" : "block" ; ?>"><input type="text" name="analiscantap" id="analiscantap" value="<?php echo $analiscantap; ?>" size="9" /></span></td>
							</tr>
							<tr>
								<td width="20%" class="NoiseFooterTD"><span id="lblanaliscantre" style="display:<?php echo ($tipestcodigo == 1)? "none" : "block" ; ?>">&nbsp;<?php if($campnomb["analiscantre"] == 1){echo "*";}?>Cantidad Rechazada</span></td>
								<td width="80%" class="NoiseDataTD"><span id="objanaliscantre" style="display:<?php echo ($tipestcodigo == 1)? "none" : "block" ; ?>"><input type="text" name="analiscantre" id="analiscantre" value="<?php echo $analiscantre; ?>" size="9" /></span></td>
							</tr>
							<tr><td colspan="4" class="NoiseErrorDataTD"></td></tr>
							<tr><td colspan="4" class="NoiseFooterTD"><?php if($campnomb["analisdescri"]== 1){$analisdescri = null; echo "*";}?>&nbsp;Descripci&oacute;n</td></tr>
							<tr><td colspan="4" rowspan="2" class="NoiseDataTD"><textarea name="analisdescri" rows="3" cols="95"><?php echo $analisdescri; ?></textarea>  </td></tr>
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
			<input type="hidden" name="accionnuevoanalisismp">
			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>">
			<input type="hidden" name="sourceaction" value="nuevo">
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
		</form>
		<div id="msgwindowform" title="Adsum Kallpa"><span id="msgform"></span></div> 
	</body>
<?php if(!$codigo){ echo " -->"; } ?> 
</html>
