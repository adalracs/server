<?php
ini_set('display_errors',1);
	include ( '../src/FunPerPriNiv/pktblrequisicionitemdesa.php');
	include ( '../src/FunPerPriNiv/pktblgestionoppitemdesa.php');
	include ( '../src/FunPerPriNiv/pktblrequisicionopp.php');
	include ( '../src/FunPerPriNiv/pktblvistaformulacion.php');
	include ( '../src/FunPerPriNiv/pktblestadorequisicion.php');
	include ( '../src/FunPerPriNiv/pktblvistagestionopp.php');
	include ( '../src/FunPerPriNiv/pktblvistareporteopp.php');
	include ( '../src/FunPerPriNiv/pktblgestionoppsaldo.php');
	include ( '../src/FunPerPriNiv/pktblvistacierreopp.php');
	include ( '../src/FunPerPriNiv/pktbloppitemdesa.php');
	include ( '../src/FunPerPriNiv/pktblopextrusion.php');
	include ( '../src/FunPerPriNiv/pktblitemformul.php');
	include ( '../src/FunPerPriNiv/pktblgestionopp.php');
	include ( '../src/FunPerPriNiv/pktblpadreitem.php');
	include ( '../src/FunPerPriNiv/pktblvistaopp.php');
	include ( '../src/FunPerPriNiv/pktblitemdesa.php');
	include ( '../src/FunPerPriNiv/pktblequipo.php');
	include ( '../src/FunGen/sesion/fncvalses.php');
	include ( '../src/FunPerPriNiv/pktblsaldo.php');
	include ( '../src/FunPerPriNiv/pktblopp.php');
	include ( '../src/FunGen/cargainput.php');
	

	if($accionnuevogestionrequisicion){
		include ( "grabagestionrequisicion.php");
	}

	if(!$flagnuevogestionrequisicion){
		$idcon = fncconn();
		include ( '../src/FunGen/sesion/fnccarga.php'); 
		$sbreg = fnccarga($nombtabl,$radiobutton);

		if (!$sbreg) 
			include( '../src/FunGen/fnccontfron.php');

		$idcon = fncconn();

		$requiscodigo = $sbreg["requiscodigo"];
		$requisfecha = $sbreg["requisfecha"];
		$usuacodigo = $sbreg["usuacodi"];
		$requisnumero = $sbreg["requisnumero"];
		$requisdescri = $sbreg["requisdescri"];

		$rsRequisicionopp = dinamicscanoprequisicionopp(array('requiscodigo' => $sbreg['requiscodigo']),array('requiscodigo' => '='),$idcon);		
		$nrRequisicionopp = fncnumreg($rsRequisicionopp);
		for( $a = 0; $a < $nrRequisicionopp; $a++)
		{
			$rwRequisicionopp = fncfetch($rsRequisicionopp,$a);
			$arrrequisicionopp = ($arrrequisicionopp)? $arrrequisicionopp.','.$rwRequisicionopp['ordoppcodigo'] : $rwRequisicionopp['ordoppcodigo'] ;
		}

		$rsRequisicionItemDesa =dinamicscanoprequisicionitemdesa(array('requiscodigo' => $sbreg['requiscodigo']),array('requiscodigo' => '='),$idcon);		
		$nrRequisicionItemDesa = fncnumreg($rsRequisicionItemDesa);
		for( $a = 0; $a < $nrRequisicionItemDesa; $a++)
		{
			$rwRequisicionItemDesa = fncfetch($rsRequisicionItemDesa,$a);
			$arrrequisiionitemdesa = ($arrrequisiionitemdesa)? $arrrequisiionitemdesa.":|:".$rwRequisicionItemDesa["itedescodigo"] : $rwRequisicionItemDesa["itedescodigo"];
		}

		
		fncclose($idcon);
	}
	$idcon = fncconn();
?> 
<html> 
	<head> 
		<title>Gestionar de registro de requisicion</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0"> 
		<?php include('../def/jquery.library_maestro.php');?>
		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.function_comun.js"></script>
		<script type="text/javascript">
			
				function eventRequisicion( idvalor ){
					var dsplay = (idvalor > 2)? "none"  : "block";
					document.getElementById('seccionRecRequisicion').style.display = dsplay;
				}

		</script>
	</head> 
<?php if(!$codigo){ echo "<!--";} ?> 
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Requisicion</font></p> 
			<table border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content" width="450">
  				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr> 
  				<tr><td class="ui-widget-header"><span class="style5"><font color="FFFFFF"> Detallar requisicion</font></span></td></tr> 
				<tr> 
  					<td> 
            			<table width="95%" border="0" cellspacing="1" cellpadding="0" align="center"> 
 							<tr>
								<td width="25%" class="NoiseFooterTD">&nbsp;Fecha&nbsp;</td>
								<td width="75%" class="NoiseDataTD">&nbsp;<?php echo ($requisfecha)? $requisfecha : '---' ; ?></td>
 							</tr>
 							<tr>
								<td width="25%" class="NoiseFooterTD">&nbsp;Numero RI&nbsp;</td>
								<td width="75%" class="NoiseDataTD">&nbsp;<?php echo ($requisnumero)? $requisnumero : '' ;?></td>
 							</tr>
 							<tr>
		  						<td colspan="2" class="NoiseFooterTD ">&nbsp;Ordenes Programadas</td>
		  					</tr>
 							<tr>
 								<td colspan="2">
 									<div id="listaordenproduccion">
 										<?php 
 											$noAjax = true;
 											$flagdetallar = 1;
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
							<tr><td colspan="2" class="NoiseFooterTD">&nbsp;Nota / Gestion Requisicion Internta</td></tr>
							<tr><td colspan="2" rowspan="2" class="NoiseDataTD">&nbsp;<?php echo $requisdescri; ?></td></tr>
						</table> 
  					</td> 
 				</tr> 
 				<tr><td class="ui-widget-header"><span class="style5"><font color="FFFFFF"> Gestion requisicion</font></span></td></tr> 
 				<tr> 
  					<td> 
            			<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center"> 
 							<tr>
								<td width="25%" class="NoiseFooterTD"><?php if($campnomb["estreqcodigo"] == 1){ echo "*";}?>&nbsp;Estado&nbsp;</td>
								<td width="75%" class="NoiseDataTD">&nbsp;
									<select name="estreqcodigo" id="estreqcodigo" onchange="eventRequisicion(this.value);">
										<option value="-1">--Seleccione--</option>
										<?php 
											include("../src/FunGen/floadestadorequisicion.php");
											floadestadorequisicion1($estreqcodigo,2,$idcon);//cerradas
										?>
									</select>
								</td>
 							</tr>
 							<tr>
 								<td colspan="2">
 									<div id="seccionRecRequisicion" style="display: <?php echo ($estreqcodigo > 2)?  "none" : "block" ; ?>">
										<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
											<tr>
												<td colspan="5" class="ui-state-default">&nbsp;Rececpcion material requisicion&nbsp;</td>
											</tr>
											<tr>
												<td width="15%" class="ui-state-default">&nbsp;Item&nbsp;</td>
												<td width="70%" class="ui-state-default">&nbsp;Referencia&nbsp;</td>
												<td width="15%" class="ui-state-default">&nbsp;Recibido&nbsp;(<b>kgs</b>)</td>
											</tr>
											<?php 

												if($arrrequisiionitemdesa) $arrObjrequisiionitemdesa = explode(":|:",$arrrequisiionitemdesa);  else unset($arrrequisiionitemdesa);

												for($a = 0; $a < count($arrObjrequisiionitemdesa); $a++){
													$obj_reqitecantre = "reqitecantre_".$arrObjrequisiionitemdesa[$a];
													$rwItemdesa = loadrecorditemdesa($arrObjrequisiionitemdesa[$a],$idcon);
											?>
											<tr>
										 		<td width="15%" class="NoiseFooterTD cont-field-b">&nbsp;<?php echo ($rwItemdesa["itedescodigo"])? $rwItemdesa["itedescodigo"] : "---"; ?></td>
										      	<td width="70%" class="NoiseFooterTD cont-field-b">&nbsp;<?php echo ($rwItemdesa["itedesnombre"])? $rwItemdesa["itedesnombre"] : "---"; ?></td>
												<td width="15%" class="NoiseFooterTD cont-field-b">&nbsp;<input type="text" name="<?php echo $obj_reqitecantre; ?>" id="<?php echo $obj_reqitecantre; ?>" value="<?php echo $$obj_reqitecantre; ?>" size="7" class="<?php if($campnomb[$obj_reqitecantre] == 1) echo 'ui-state-error ui-corner-all'; ?>" /></td>
											</tr>	
											<?php


												}

											?>
										</table>
									</div>
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
 			<input type="hidden" name="flagnuevogestionrequisicion">
			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>"> 
			<input type="hidden" name="sourceaction" id="sourceaction" value="nuevo">  
			<input type="hidden" name="accionnuevogestionrequisicion"> 
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 

			<input type="hidden" name="requiscodigo" id="requiscodigo" value="<?php echo $requiscodigo; ?>">
			<input type="hidden" name="requisfecha" value="<?php echo $requisfecha; ?>">
			<input type="hidden" name="usuacodigo" value="<?php echo $usuacodigo; ?>">
			<input type="hidden" name="requisnumero" value="<?php echo $requisnumero; ?>">
			<input type="hidden" name="requisdescri" value="<?php echo $requisdescri; ?>">
			<input type="hidden" name="arrrequisiionitemdesa" value="<?php echo $arrrequisiionitemdesa; ?>">
		</form> 
	</body> 
<?php if(!$codigo){ echo " -->"; } ?> 
</html>