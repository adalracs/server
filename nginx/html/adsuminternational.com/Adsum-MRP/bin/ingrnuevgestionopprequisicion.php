<?php 
ini_set('display_errors',1);
ob_start(); 
	include ( '../src/FunPerPriNiv/pktblgestionoppitemdesa.php');
	include ( '../src/FunPerPriNiv/pktblvistaformulacion.php');
	include ( '../src/FunPerPriNiv/pktblinvplantaresina.php');
	include ( '../src/FunPerPriNiv/pktblvistagestionopp.php');
	include ( '../src/FunPerPriNiv/pktblvistareporteopp.php');
	include ( '../src/FunPerPriNiv/pktblgestionoppsaldo.php');
	include ( '../src/FunPerPriNiv/pktblvistacierreopp.php');
	include ( '../src/FunPerPriNiv/pktbloppitemdesa.php');
	include ( '../src/FunPerPriNiv/pktblopextrusion.php');
	include ( '../src/FunPerPriNiv/pktblgestionopp.php');
	include ( '../src/FunPerPriNiv/pktblitemformul.php');
	include ( '../src/FunPerPriNiv/pktblpadreitem.php');
	include ( '../src/FunPerPriNiv/pktblvistaopp.php');
	include ( '../src/FunPerPriNiv/pktblitemdesa.php');
	include ( '../src/FunPerPriNiv/pktblequipo.php');
	include ( '../src/FunPerPriNiv/pktblsaldo.php');
	include ( '../src/FunGen/sesion/fncvalses.php');
	include ( '../src/FunPerPriNiv/pktblopp.php');
	include ( '../src/FunGen/cargainput.php');
	
	if($accionnuevogestionopprequisicion)
		include ( 'grabagestionopprequisicion.php');

	if(!$flagnuevorequisicion){

		$idcon = fncconn(); 

		if($arrrequisicionopp) $arrObjsrequisicionopp = explode(',',$arrrequisicionopp); unset($arrObjsrequisicionopp);

		for($a = 0; $a < count($arrObjsrequisicionopp); $a++){

			$rwOPP = loadrecordvistaopp($arrObjsrequisicionopp[$a],$idcon);
			$tipsolcodigo = $rwOPP["tipsolcodigo"];

			if($tipsolcodigo > 0){
				break;
			}

		}

		$requisdescri = "Requisicion [OK]";

		fncclose($idcon);
	}
	
	$idcon = fncconn(); 

	
ob_end_flush();
	
?>
<html> 
	<head> 
		<title>Nuevo registro requisicion</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0"> 
		<?php include('../def/jquery.library_maestro.php');?>
		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.function_comun.js"></script>
		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jq.fnc.requisicion.js"></script>
	</head> 
<?php if(!$codigo){ echo "<!--";} ?>
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Requisicion</font></p> 
			<table border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content" width="450">
<?php if($campnomb): ?>
				<tr><td><div class="ui-widget">
					<div class="ui-state-error ui-corner-all" style="padding: 0 .7em;"> 
						<p><span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span> 
						<strong>Advertencia:</strong> Corrija los campos marcados con * <br><?php echo $campnomb[err] ?></p>
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
								<td width="25%" class="NoiseFooterTD">&nbsp;Fecha&nbsp;</td>
								<td width="75%" class="NoiseDataTD">&nbsp;<?php echo date('Y-m-d'); ?></td>
 							</tr>
 							<tr>
								<td width="25%" class="NoiseFooterTD"><?php if($campnomb["requisnumero"] == 1){ $requisnumero = null; echo "*";}?>&nbsp;Numero RI&nbsp;</td>
								<td width="75%" class="NoiseDataTD"><input type="text" name="requisnumero" id="requisnumero" value="<?php echo $requisnumero ?>" /></td>
 							</tr>
 							<tr>
		  						<td width="25%" class="NoiseFooterTD "><?php if($campnomb["arrrequisicionopp"] == 1){ $arrrequisicionopp = null; echo "*";}?>&nbsp;Ordenes Programadas</td>
		  						<td width="75%" class="NoiseDataTD">
		  							<div class="ui-buttonset" align="right">
										<button id="ingresaropp">Agregar</button>&nbsp;&nbsp;
		            					<button id="quitaropp">Quitar</button>
									</div>
		  						</td>
		  					</tr>
 							<tr>
 								<td colspan="2">
 									<div id="listaordenproduccion">
 										<?php 
 											$noAjax = true;
 											include "../src/FunjQuery/jquery.visors/jq.vrequisicionopp.php";
 										?>
 									</div>
 									<input type="hidden" name="arrrequisicionopp" id="arrrequisicionopp" size="60"value="<?php echo $arrrequisicionopp ?>" />
									<input type="hidden" name="arrrequisicionopptmp" id="arrrequisicionopptmp" size="60"value="<?php echo $arrrequisicionopptmp ?>" />
 								</td>
 							</tr>
 							<tr>
 								<td width="10%" class="NoiseFooterTD"></td>
 							</tr>
 							<tr><td colspan="2" class="NoiseErrorDataTD"></td></tr>
							<tr><td colspan="2" class="NoiseFooterTD"><?php if($campnomb["requisdescri"]	 == 1){$requisdescri = null; echo "*";}?>&nbsp;Nota / Gestion Requisicion Internta</td></tr>
							<tr><td colspan="2" rowspan="2" class="NoiseDataTD"><textarea name="requisdescri" rows="3" cols="110"><?php echo $requisdescri; ?></textarea>  </td></tr>
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
			<input type="hidden" name="tipsolcodigo" value="<?php echo $tipsolcodigo; ?>" >
			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>" >
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>" > 
			<input type="hidden" name="accionnuevogestionopprequisicion" >  
			<input type="hidden" name="sourceaction" value="nuevo" >						
		</form> 	
		<div id="msgwindowform" title="Adsum Kallpa [Ordenes Produccion]"><span id="msgform"></span></div>
	</body> 
<?php if(!$codigo){ echo " -->"; } ?> 
</html>