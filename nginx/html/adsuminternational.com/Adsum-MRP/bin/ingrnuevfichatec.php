<?php 
//	ini_set('display_errors',1);
	include ('../src/FunGen/sesion/fncvalses.php'); 
	include ('../src/FunPerPriNiv/pktblusuario.php');
	include ('../src/FunPerPriNiv/pktblitemventas.php');
	include ('../src/FunPerPriNiv/pktblitemfictecventas.php');
	include ('../src/FunPerPriNiv/pktblcampertippro.php');
	include ('../src/FunPerPriNiv/pktblcptpdetope.php');
	include ('../src/FunPerPriNiv/pktblfichatec.php');
	include ('../src/FunGen/cargainput.php');
	include ('../src/FunGen/fncnumprox.php'); 
	include ('../src/FunGen/fncnumact.php'); 	
	
	if($accionnuevofichatec) 
		include ( 'grabafichatec.php');

	$idcon = fncconn();
	$nombre = cargausuanombre($usuacodi, $idcon);
	
	 if($flagrepeticion)
	 {
		include '../src/FunjQuery/jquery.tabs/reloadCampos.php';
		$arrObj = explode(',',$arrTabs);
		for($i = 0;$i<count($arrObj);$i++){
			
		}
	}
	
	if(!$flagrepeticion){
	$arrTabs = '';

	//Tabs Enabled - Disabled
	if($esp_pro == '0') ($arrTabs) ? $arrTabs .= ',1' : $arrTabs .= '1'; 
	if($emb == '0') ($arrTabs) ? $arrTabs .= ',2' : $arrTabs .= '2'; 
	if($ext == '0') ($arrTabs) ? $arrTabs .= ',3' : $arrTabs .= '3'; 
	if($lmn == '0') ($arrTabs) ? $arrTabs .= ',4' : $arrTabs .= '4'; 
	if($con_pro == '0') ($arrTabs) ? $arrTabs .= ',5' : $arrTabs .= '5'; 
	}
	
	$tipitecodigo= 1;
	$tipevecodigo = 1;
	
?> 
<!-- Propiedad intelectual de Adsum SAS (c) 
-Todos los derechos reservados- 
Creado con WAG Adsum 
Autor: Andrés A. Riascos D. 
Fecha: 20120110 
GenVers: 4.8 --> 
<!doctype html> 
<html> 
	<head> 
		<title>Nuevo registro de ficha tecnica</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=UTF8"> 
		<meta http-equiv="expires" content="0"> 
		<meta http-equiv="X-UA-Compatible" content="IE=9"> 
		<?php include ('../def/jquery.library_maestro.php'); ?>
		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.function_comun.js"></script>
		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.producitem.js"></script>
		<script type="text/javascript">
			$(function(){
				$( "#tabitems" ).tabs( "option", "disabled", [<?php echo $arrTabs ?>] );

				$("#pedvenfecent").datepicker("setDate","<?php echo $pedvenfecent?>");
				$("#pedvenfecrec").datepicker("setDate","<?php echo $pedvenfecrec?>");
			});
			
		</script>
		
	</head> 
<?php if (! $codigo) echo "<!--"; ?> 
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post" enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Ficha tecnica</font></p> 
			<table border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content" width="850">
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
						<table width="99%" border="0" cellspacing="1" cellpadding="1" align="center"> 
						</table>
					</td>
				</tr>
				
				<!-- PESTAÑAS DEL FORMULARIO -->
				<tr>
					<td>
						<?php if($tipitecodigo && $tipevecodigo): ?>
						<div id="tabitems">
						<?php if($tipevecodigo != 3 && $tipevecodigo != 2):?>
							<ul>
								<li style="text-align: center"><a href="#opt-tab1"><small>Item<br/>&nbsp;</small></a></li>
								<li style="text-align: center"><a href="#opt-tab2"><small>Extrusion Material<br/>impresion</small></a></li>
								<li style="text-align: center"><a href="#opt-tab3"><small>Extrusion Material<br/>laminacion</small></a></li>
								
								
								
								<li style="text-align: center"><a href="#opt-tab4"><small>Impresion <br/> &nbsp;</small></a></li>
								
								<?php if($tipitecodigo != 5): ?>
								<li style="text-align: center"><a href="#opt-tab5"><small>Laminaci&oacute;n<br/>&nbsp;</small></a></li>
								<?php endif?>
								
								<?php if($tipitecodigo != 5): ?>
								<li style="text-align: center"><a href="#opt-tab6"><small>Corte o <br/>refilado</small></a></li>
								<li style="text-align: center"><a href="#opt-tab7"><small>Doblado <br/>&nbsp;</small></a></li>
								<li style="text-align: center"><a href="#opt-tab8"><small>Micro <br/>&nbsp;</small></a></li>
								<li style="text-align: center"><a href="#opt-tab9"><small>Sellado <br/>&nbsp;</small></a></li>
								<li style="text-align: center"><a href="#opt-tab10"><small>Embalaje <br/>&nbsp;</small></a></li>
								<?php endif?>
							</ul>
							<?php else:?>
								<ul>
								<?php if(!$flagrepeticion):?>
								<li style="text-align: center"><a href="#opt-tab1"><small>Item<br/>&nbsp;</small></a></li>
								<?php endif?>
								<?php if($flagrepeticion):?>
								<?php /*include '../src/FunjQuery/jquery.tabs/reloadCampos.php'*/ ?>
								<li style="text-align: center"><a href="#opt-tab1"><small>Item<br/>&nbsp;</small></a></li>
								<li style="text-align: center"><a href="#opt-tab2"><small>Extrusion Material<br/> impresion</small></a></li>
								<li style="text-align: center"><a href="#opt-tab3"><small>Extrusion Material<br/> laminacion</small></a></li>
								
								<li style="text-align: center"><a href="#opt-tab4"><small>Impresion <br/> &nbsp;</small></a></li>
								
								<?php if($tipitecodigo != 5): ?>
								<li style="text-align: center"><a href="#opt-tab5"><small>Laminaci&oacute;n<br/>&nbsp;</small></a></li>
								<?php endif?>
								
								<?php if($tipitecodigo != 5): ?>
								<li style="text-align: center"><a href="#opt-tab6"><small>Corte o <br/>refilado</small></a></li>
								<li style="text-align: center"><a href="#opt-tab7"><small>Doblado <br/>&nbsp;</small></a></li>
								<li style="text-align: center"><a href="#opt-tab8"><small>Micro <br/>&nbsp;</small></a></li>
								<li style="text-align: center"><a href="#opt-tab9"><small>Sellado <br/>&nbsp;</small></a></li>
								<li style="text-align: center"><a href="#opt-tab10"><small>Embalaje <br/>&nbsp;</small></a></li>
								<?php endif?>
								<?php endif?>
							</ul>
							<?php endif?>
							<?php include '../src/FunjQuery/jquery.tabs/fichatec/jquery.itemgeneral.php' ?>
							<!--		TABS PARA NUEVO MUESTRA	 -->
							<?php if($tipitecodigo == 1 && ($tipevecodigo != 3 && $tipevecodigo != 2)) include '../src/FunjQuery/jquery.tabs/fichatec/jquery.bolsaflowpack.php' ?>
							<?php if($tipitecodigo == 2 && ($tipevecodigo != 3 && $tipevecodigo != 2)) include '../src/FunjQuery/jquery.tabs/items/jquery.bolsalateral.php' ?>
							<?php if($tipitecodigo == 3 && ($tipevecodigo != 3 && $tipevecodigo != 2)) include '../src/FunjQuery/jquery.tabs/items/jquery.bolsapouchdoypack.php' ?>
							<?php if($tipitecodigo == 4 && ($tipevecodigo != 3 && $tipevecodigo != 2)) include '../src/FunjQuery/jquery.tabs/items/jquery.bolsapouchlateral.php' ?>
							<?php if($tipitecodigo == 5 && ($tipevecodigo != 3 && $tipevecodigo != 2)) include '../src/FunjQuery/jquery.tabs/items/jquery.capuchon.php' ?>
							<?php if($tipitecodigo == 6 && ($tipevecodigo != 3 && $tipevecodigo != 2)) include '../src/FunjQuery/jquery.tabs/items/jquery.lamina.php' ?>
							<!--		TABS PARA REPETICION					-->
							<?php if($flagrepeticion):?>
							<?php if($tipitecodigo == 1 && $tipevecodigo == 3) include '../src/FunjQuery/jquery.tabs/fichatec/jquery.bolsaflowpack.det.php' ?>
							<?php if($tipitecodigo == 2 && $tipevecodigo == 3) include '../src/FunjQuery/jquery.tabs/items/jquery.bolsalateral.det.php' ?>
							<?php if($tipitecodigo == 3 && $tipevecodigo == 3) include '../src/FunjQuery/jquery.tabs/items/jquery.bolsapouchdoypack.det.php' ?>
							<?php if($tipitecodigo == 4 && $tipevecodigo == 3) include '../src/FunjQuery/jquery.tabs/items/jquery.bolsapouchlateral.det.php' ?>
							<?php if($tipitecodigo == 5 && $tipevecodigo == 3) include '../src/FunjQuery/jquery.tabs/items/jquery.capuchon.det.php' ?>
							<?php if($tipitecodigo == 6 && $tipevecodigo == 3) include '../src/FunjQuery/jquery.tabs/items/jquery.lamina.det.php' ?>
							<!--		TABS PARA MODIFICACION				-->
							<?php if($tipitecodigo == 1 && $tipevecodigo == 2) include '../src/FunjQuery/jquery.tabs/fichatec/jquery.bolsaflowpack.php' ?>
							<?php if($tipitecodigo == 2 && $tipevecodigo == 2) include '../src/FunjQuery/jquery.tabs/items/jquery.bolsalateral.php' ?>
							<?php if($tipitecodigo == 3 && $tipevecodigo == 2) include '../src/FunjQuery/jquery.tabs/items/jquery.bolsapouchdoypack.php' ?>
							<?php if($tipitecodigo == 4 && $tipevecodigo == 2) include '../src/FunjQuery/jquery.tabs/items/jquery.bolsapouchlateral.php' ?>
							<?php if($tipitecodigo == 5 && $tipevecodigo == 2) include '../src/FunjQuery/jquery.tabs/items/jquery.capuchon.php' ?>
							<?php if($tipitecodigo == 6 && $tipevecodigo == 2) include '../src/FunjQuery/jquery.tabs/items/jquery.lamina.php' ?>
							<?php endif?>
						</div>
						<?php endif?>
					</td>
				</tr>
				<tr>
				<td class="NoiseErrorDataTD" align="center"></td>
				</tr>
				<tr><td class="NoiseErrorDataTD" align="center"><?php include '../def/jquery.button_form.php'; ?></td></tr> 
				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr> 
			</table>
			<input type="hidden" name="esp_pro" id="esp_pro" value="<?php echo $esp_pro ?>" />
			<input type="hidden" name="emb" id="emb" value="<?php echo $emb ?>" />
			<input type="hidden" name="ext" id="ext" value="<?php echo $ext ?>" />
			<input type="hidden" name="lmn" id="lmn" value="<?php echo $lmn ?>" />
			<input type="hidden" name="con_pro" id="con_pro" value="<?php echo $con_pro ?>" />
			<input type="hidden" name="not_mod" id="not_mod" value="<?php echo $not_mod ?>" />
			<input type="hidden" name="for_emp" id="for_emp" value="<?php echo $for_emp ?>" />
			<input type="hidden" name="arrTabs" id="arrTabs" value="<?php echo $arrTabs ?>" />

			<input type="hidden" name="pedvencodigo" value="<?php if(!$flagnuevofichatec){ echo $sbreg[pedvencodigo];}else{ echo $pedvencodigo; }?>"> 
			<input type="hidden" name="ficteccodigo" value="<?php if(!$flagnuevofichatec){ echo $sbreg[ficteccodigo];}else{ echo $ficteccodigo; } ?>"> 
			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>"> 
			<input type="hidden" name="sourceaction" id="sourceaction" value="nuevo"> 
			<input type="hidden" name="accionnuevofichatec"> 
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
			<input type="hidden" name="flagrepeticion" id="flagrepeticion" value="<?php echo $flagrepeticion ?>"/>
		</form>
		<div id="msgwindow" title="Adsum Kallpa"><span id="msg"></span></div>
	</body> 
<?php if (! $codigo) echo " -->"; ?> 
</html>