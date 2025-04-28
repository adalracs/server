<?php 
	ini_set('display_errors',1);
	include ( '../src/FunPerPriNiv/pktblproducpadreitem.php');
	include ( '../src/FunPerPriNiv/pktblproducpedido.php');
	include ( '../src/FunPerPriNiv/pktblpedidoventa.php');
	include ( '../src/FunPerPriNiv/pktblordencompra.php');
	include ( '../src/FunPerPriNiv/pktblcptpdetope.php');
	include ( '../src/FunPerPriNiv/pktblcampertippro.php');
	include ('../src/FunPerPriNiv/pktblpadreitem.php');
	include ( '../src/FunGen/sesion/fncvalses.php');
	include ('../src/FunPerPriNiv/pktblusuario.php');
	include ('../src/FunGen/cargainput.php');

	if(!$flagborrarproducto) 
	{ 
		include ( '../src/FunGen/sesion/fnccarga.php'); 
		$sbreg = fnccarga($nombtabl,$radiobutton);
		if (!$sbreg) 
			include( '../src/FunGen/fnccontfron.php');
		//carga de campos personalizados necesarios para el formulario.
		$idcon = fncconn();
		//variables globales
		$tipitecodigo = $sbreg['tipprocodigo']; 
		$produccodigo = $sbreg['produccodigo'];
		//registro de producpedido
		$rwProducpedido = loadrecordproducpedidoPER('produccodigo',$sbreg['produccodigo'],$idcon);
		//registro de pedido venta
		$rwPedidoventa = loadrecordpedidoventa($rwProducpedido['pedvencodigo'],$idcon);
		$tipevecodigo = $rwPedidoventa['tipevecodigo'];
		$nombre = cargausuanombre($rwPedidoventa['usuacodi'], $idcon);
		//registro de orden de compra si no es pedido de repeticion
		if($rwPedidoventa['tipevecodigo'] !=4)
			$rwOrdencompra = loadrecordordencompra($rwPedidoventa['ordcomcodigo'],$idcon);
		$clientnombre = $rwOrdencompra['ordcomrazsoc'];
		//carga de campos de personalizados de ventas 
		//nota hay que asignar la varible producto con el codigo del producto actual. 
		$producto = $produccodigo;
		include 'cargarcampertippro.php';
	} 
	
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
		<title>borrar registro de producto</title> 
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

				$('#imprimir').button({ icons: { primary: "ui-icon-document" } }).click(function() {
					window.open('imprimirproducto.php?codigo=<?php echo $produccodigo ?>','impresion','status=no,menubar=no,scrollbars=yes,resizable=yes,width=880,height=650');
					location ="maestablproducto.php?codigo=<?php echo $codigo?>;"
					return false;
				});
				
			});
		</script>
	</head> 
<?php if (! $codigo) echo "<!--"; ?> 
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post" enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">&Iacute;tem</font></p> 
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
				<tr><td class="ui-widget-header"><span class="style5"><font color="FFFFFF"> borrar registro</font></span></td></tr>
				<tr>
					<td>
						<table width="99%" border="0" cellspacing="1" cellpadding="1" align="center"> 
							<tr>
	  							<td class="NoiseFooterTD" width="15%"><?php if ($campnomb['tipprocodigo'] == 1) { $tipprocodigo = null; echo "*";}?>&nbsp;Tipo</td>
	  							<td class="NoiseDataTD">
	  								<select name="tipitecodigo" id="tipitecodigo" DISABLED>
		  								<option value="">-- Seleccione --</option>
		  								<option value="1"<?php if($tipitecodigo == 1) echo ' selected' ?>>Bolsa Flow Pack</option>
		  								<option value="2"<?php if($tipitecodigo == 2) echo ' selected' ?>>Bolsa Lateral</option>
		  								<option value="3"<?php if($tipitecodigo == 3) echo ' selected' ?>>Bolsa Pouch Doy Pack</option>
		  								<option value="4"<?php if($tipitecodigo == 4) echo ' selected' ?>>Bolsa Pouch Lateral</option>
		  								<option value="5"<?php if($tipitecodigo == 5) echo ' selected' ?>>Capuchon</option>
		  								<option value="6"<?php if($tipitecodigo == 6) echo ' selected' ?>>Lamina</option>
		  							</select>
		  							<select name="tipevecodigo" id="tipevecodigo" DISABLED>
		  								<option value="">-- Seleccione --</option>
		  								<option value="1"<?php if($tipevecodigo == 1) echo ' selected' ?>>Nuevo</option>
		  								<option value="2"<?php if($tipevecodigo == 2) echo ' selected' ?>>Modificaci&oacute;n</option>
		  								<option value="3"<?php if($tipevecodigo == 3) echo ' selected' ?>>Repetici&oacute;n</option>
		  								<option value="4"<?php if($tipevecodigo == 4) echo ' selected' ?>>Muestra</option>
		  							</select>
	  							</td>
	  						</tr>
						</table>
					</td>
				</tr>
				
				<!-- PESTAÑAS DEL FORMULARIO -->
				<tr>
					<td>
						<?php if($tipitecodigo && $tipevecodigo): ?>
						<div id="tabitems">
							<ul>
								<li style="text-align: center"><a href="#opt-tab1"><small>Item<br/>&nbsp;</small></a></li>
								<li style="text-align: center"><a href="#opt-tab2"><small>Especificaciones del<br/>producto</small></a></li>
								<li style="text-align: center"><a href="#opt-tab4"><small>Especificaci&oacute;n de<br/>embalaje</small></a></li>
								
								<li style="text-align: center"><a href="#opt-tab5"><small>Especificaciones de <br/>Material extruido</small></a></li>
								
								<?php if($tipitecodigo != 5): ?>
								<li style="text-align: center"><a href="#opt-tab6"><small>Laminaci&oacute;n<br/>&nbsp;</small></a></li>
								<?php endif ?>
								
								<?php if($tipitecodigo != 5): ?>
								<li style="text-align: center"><a href="#opt-tab7"><small>Condiciones de proceso<br/>para el desarrollo</small></a></li>
								<?php endif ?>
								<?php if($tipitecodigo == 6): ?>
								<li style="text-align: center"><a href="#opt-tab4a"><small>Forma de empaque<br/>&nbsp;</small></a></li>
								<?php endif ?>
								<?php if($tipevecodigo == 2): ?>
								<li style="text-align: center"><a href="#opt-tab8"><small>Notas a la<br/>modificaci&oacute;n</small></a></li>
								<?php endif?>
							</ul>
							<?php include '../src/FunjQuery/jquery.tabs/items/jquery.itemgeneral.det.php' ?>
							
							<?php if($tipitecodigo == 1) include '../src/FunjQuery/jquery.tabs/items/jquery.bolsaflowpack.det.php' ?>
							<?php if($tipitecodigo == 2) include '../src/FunjQuery/jquery.tabs/items/jquery.bolsalateral.det.php' ?>
							<?php if($tipitecodigo == 3) include '../src/FunjQuery/jquery.tabs/items/jquery.bolsapouchdoypack.det.php' ?>
							<?php if($tipitecodigo == 4) include '../src/FunjQuery/jquery.tabs/items/jquery.bolsapouchlateral.det.php' ?>
							<?php if($tipitecodigo == 5) include '../src/FunjQuery/jquery.tabs/items/jquery.capuchon.det.php' ?>
							<?php if($tipitecodigo == 6) include '../src/FunjQuery/jquery.tabs/items/jquery.lamina.det.php' ?>
						</div>
						<?php endif ?>
					</td>
				<tr><td>&nbsp;</td></tr>
				<tr>
					<td class="NoiseErrorDataTD" align="center"><?php include '../def/jquery.button_form.php'; ?></td>
				</tr>
				<tr><td>&nbsp;</td></tr> 
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

			<input type="hidden" name="flagborrarproducto" value="1"> 
			<input type="hidden" name="accionborrarproducto">
			<input type="hidden" name="pedvencodigo" value="<?php if(!$flagborrarproducto){ echo $sbreg[pedvencodigo];}else{ echo $pedvencodigo; }?>"> 
			<input type="hidden" name="produccodigo" value="<?php if(!$flagborrarproducto){ echo $sbreg[produccodigo];}else{ echo $produccodigo; } ?>"> 
			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>"> 
			<input type="hidden" name="sourceaction" id="sourceaction" value="borrar"> 
			<input type="hidden" name="accionnuevoproducto"> 
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
		</form>
		<div id="msgwindow" title="Adsum Kallpa"><span id="msg"></span></div>
	</body> 
<?php if (! $codigo) echo " -->"; ?> 
</html>