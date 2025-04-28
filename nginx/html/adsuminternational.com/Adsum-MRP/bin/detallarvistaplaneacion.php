<?php 
	ini_set('display_errors',1);
	include ('../src/FunPerPriNiv/pktblalarma.php');
	include ('../src/FunPerPriNiv/pktblvistaalarmagestion.php');
	include ('../src/FunPerPriNiv/pktblalarmaitem.php');
	include ('../src/FunPerPriNiv/pktblalarmamodulo.php');
	include ('../src/FunGen/sesion/fncvalses.php'); 
	include ('../src/FunGen/floadcriterio.php'); 
	include ('../src/FunPerSecNiv/fncsqlrun.php');
	include ('../src/FunPerPriNiv/pktblitemdesa.php');
	include ('../src/FunPerPriNiv/pktblusuario.php');
	include ('../src/FunPerPriNiv/pktblmodulo.php');
	include ('../src/FunPerPriNiv/pktblproductoseguimiento.php');
	include ('../src/FunPerPriNiv/pktblformulacion.php');
	include ('../src/FunPerPriNiv/pktblcriterio.php');
	include ('../src/FunPerPriNiv/pktblpadreitem.php');
	include ('../src/FunPerPriNiv/pktblproducpadreitem.php');
	include ('../src/FunPerPriNiv/pktblcampertippro.php');
	include ('../src/FunPerPriNiv/pktblcamperdesarr.php');
	include ('../src/FunPerPriNiv/pktblcamperplanea.php');
	include ('../src/FunPerPriNiv/pktblcpdesadetope.php');
	include ('../src/FunPerPriNiv/pktblcpplandetope.php');
	include ('../src/FunPerPriNiv/pktblcptpdetope.php');
	include ('../src/FunPerPriNiv/pktblproducpedido.php');
	include ('../src/FunPerPriNiv/pktblpedidoventa.php');
	include ('../src/FunPerPriNiv/pktblordencompra.php');
	include ('../src/FunPerPriNiv/pktblpedidotemp.php');
	include ('../src/FunPerPriNiv/pktblinventariotemp.php');
	include ('../src/FunPerPriNiv/pktblvistaitemplaneacion.php');
	include ('../src/FunPerPriNiv/pktblplaneapadreitem.php');
	include ('../src/FunPerPriNiv/pktblplaneaitemdesa.php');
	include ('../src/FunPerPriNiv/pktblplanearutaitempv.php');
	include ('../src/FunPerPriNiv/pktblproducto.php');
	include ('../src/FunGen/cargainput.php');
	include ('../src/FunGen/fncnumprox.php'); 
	include ('../src/FunGen/fncnumact.php'); 	
	
	if(!$flagdetallarvistaplaneacion) 
	{ 
		$idcon = fncconn();
		$nombre = cargausuanombre($usuacodi, $idcon);
		include ( '../src/FunGen/sesion/fnccarga.php'); 
		$sbreg = fnccarga($nombtabl,$radiobutton);
		if (!$sbreg) 
			include( '../src/FunGen/fnccontfron.php');
		//carga de campos personalizados necesarios para el formulario.
		$idcon = fncconn();
		//variables globales
		$tipitecodigo = $sbreg['tipprocodigo']; 
		$produccodigo = $sbreg['produccodigo'];
		$produccoduno = $sbreg['produccoduno'];
		//registro de producpedido
		$rwProducpedido = loadrecordproducpedidoPER('produccodigo',$sbreg['produccodigo'],$idcon);
		//registro de pedido venta
		$rwPedidoventa = loadrecordpedidoventa($rwProducpedido['pedvencodigo'],$idcon);
		//campos para formulario
		$pedvenfecent = $rwPedidoventa['pedvenfecent'];
		$pedvenfecent = $rwPedidoventa['pedvenfecelb'];
		$pedvennumero = $rwPedidoventa['pedvennumero'];
		$produccoduno = $sbreg['produccoduno'];
		$pedvenfecrec =  $rwPedidoventa['pedvenfecrec'];
		$tipevecodigo = $rwPedidoventa['tipevecodigo'];
		$nombre = cargausuanombre($rwPedidoventa['usuacodi'], $idcon);
		//registro de orden de compra si no es pedido de repeticion
		if($rwPedidoventa['tipevecodigo'] !=4)
			$rwOrdencompra = loadrecordordencompra($rwPedidoventa['ordcomcodigo'],$idcon);
		$clientnombre = $rwOrdencompra['ordcomrazsoc'];
		$ordcomcodcli = $rwOrdencompra['ordcomcodcli'];//codigo del cliente

		//carga de campos de personalizados de ventas 		
		//nota hay que asignar la varible producto con el codigo del producto actual. 
		$producto = $produccodigo;
		include 'cargarcampertippro.php';
		//carga de campos de personalizados de desarrollo 
		//nota hay que asignar la varible producto con el codigo del producto actual. 
		if($tipevecodigo != 3)
			$producto = $produccodigo;
		include 'cargarcamperdesarr.php';	
		//carga de campos de personalizados de planeacion 
		//nota hay que asignar la varible producto con el codigo del producto actual. 
		if($tipevecodigo != 3)
			$producto = $produccodigo;
		include 'cargarcamperplanea.php';
		//adicionales
		$unimedi = $rwProducpedido['unidadcodigo'];
		$cantsol = $rwProducpedido['propedcansol'];
		$nombre = $sbreg['producnombre'];
		//peso millar = round((((double) $solaa / 1000) + ((double) $largo / 1000 * 2) + ((double)  $solapa / 1000 * 2) + ((double)  $fuelle / 1000 * 2)) * (((double)  $ancho / 1000) * ((double) $total_gramaje)) * 100 ) / 100;
		if(!$cant_planea)
			$cant_planea = $cantsol;
		//validacion adicional para repeticion en proceso de planeacion
		//nota exige planear primero el nuevo y despues la repeticion no al contrario
		if($tipevecodigo == 3)
		{
			$rwProducto_rep = loadrecordproducto($producto,$idcon);
			if($rwProducto_rep['producproces'] <= 5)
			{
				echo '<script language= "javascript">';
				echo '<!--//'."\n";
				echo 'alert("ocurrio un error inesperado. favor planear el pedido con consecutivo '.$producto.'")';
				echo '//-->'."\n";
				echo '</script>';
				echo '<script language="javascript">';
				echo '<!--//'."\n";
				echo 'location ="maestablvistaplaneacion.php?codigo='.$codigo.';"';
				echo '//-->'."\n";
				echo '</script>';
			}
		}
	} 

	$rwProductoSeguimiento = loadrecordproductoseguimiento1($produccodigo,$idcon);
	
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
		<title>nuevo registro de desarrollo</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=UTF8"> 
		<meta http-equiv="expires" content="0"> 
		<meta http-equiv="X-UA-Compatible" content="IE=9"> 
		<?php include ('../def/jquery.library_maestro.php'); ?>
		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.function_comun.js"></script>
		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.planeacion.js"></script>
		<script type="text/javascript">
			$(function(){
				$( "#tabitems" ).tabs( );
			});
			
		</script>
		
	</head> 
<?php if (! $codigo) echo "<!--"; ?> 
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post" enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Pedido/&Iacute;tem [Planeaci&oacute;n]</font></p> 
			<table border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content" width="850">

<?php if( $rwProductoSeguimiento > 0 && isset($rwProductoSeguimiento['prosegdescri']) ): ?>
				<tr>
					<td>
						<div class="ui-widget">
							<div class="ui-state-highlight ui-corner-all" style="padding: 0 .7em;"> 
								<p><span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span> 
									<strong>Mensaje de devolucion:</strong>&nbsp;<?php echo $rwProductoSeguimiento['prosegdescri']; ?>
								</p>
								<p><span class="ui-icon ui-icon-home" style="float: left; margin-right: .3em;"></span> 
									<strong>Modulo:</strong>&nbsp;<?php echo strtoupper( carganombremodulo($rwProductoSeguimiento['modulocodigoorg'],$idcon) ); ?>
								</p>
								<p><span class="ui-icon ui-icon-person" style="float: left; margin-right: .3em;"></span> 
									<strong>Responsable:</strong>&nbsp;<?php echo cargausuanombre($rwProductoSeguimiento['usuacodi'],$idcon); ?>
								</p>
							</div>
						</div>
					</td>
				</tr>
<?php endif; ?>

<?php if($campnomb): ?>
				<tr><td><div class="ui-widget">
					<div class="ui-state-error ui-corner-all" style="padding: 0 .7em;"> 
						<p><span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span> 
						<strong>Advertencia:</strong> Corrija los campos marcados con *</p>
					</div>
				</div></td></tr>
<?php elseif($varMsj): echo $varMsj; ?>
<?php else: ?>
				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr>	
<?php endif; ?>

				<tr><td class="ui-widget-header"><span class="style5"><font color="FFFFFF"> nuevo registro</font></span></td></tr>
				
				<!-- PESTAÑAS DEL FORMULARIO -->
				<tr>
					<td>
						<?php if($tipitecodigo && $tipevecodigo): ?>
						<div id="tabitems">
							<ul>
								<li style="text-align: center"><a href="#opt-tab1"><small>Item<br/>&nbsp;</small></a></li>
								<li style="text-align: center"><a href="#opt-tab2"><small>Especificaciones del<br/>producto</small></a></li>
								<li style="text-align: center"><a href="#opt-tab5"><small>Explosi&oacute;n de <br/>materia prima</small></a></li>
								<li style="text-align: center"><a href="#opt-tab4"><small>Rutas<br/>&nbsp;</small></a></li>
								<?php if($tipitecodigo != 5): ?>
								<li style="text-align: center"><a href="#opt-tab7"><small>Condiciones de proceso<br/>para el desarrollo</small></a></li>
								<?php endif?>
								<?php if($tipitecodigo == 6): ?>
								<li style="text-align: center"><a href="#opt-tab4a"><small>Forma de empaque<br/>&nbsp;</small></a></li>
								<?php endif?>
							</ul>
							<?php include '../src/FunjQuery/jquery.tabs/planeacion/jquery.itemgeneral.php' ?>
							<!--		TABS PARA NUEVO MUESTRA	 -->
							<?php if($tipitecodigo == 1 && ($tipevecodigo != 3 && $tipevecodigo != 2)) include '../src/FunjQuery/jquery.tabs/planeacion/jquery.bolsaflowpack.det.php' ?>
							<?php if($tipitecodigo == 2 && ($tipevecodigo != 3 && $tipevecodigo != 2)) include '../src/FunjQuery/jquery.tabs/planeacion/jquery.bolsalateral.det.php' ?>
							<?php if($tipitecodigo == 3 && ($tipevecodigo != 3 && $tipevecodigo != 2)) include '../src/FunjQuery/jquery.tabs/planeacion/jquery.bolsapouchdoypack.det.php' ?>
							<?php if($tipitecodigo == 4 && ($tipevecodigo != 3 && $tipevecodigo != 2)) include '../src/FunjQuery/jquery.tabs/planeacion/jquery.bolsapouchlateral.det.php' ?>
							<?php if($tipitecodigo == 5 && ($tipevecodigo != 3 && $tipevecodigo != 2)) include '../src/FunjQuery/jquery.tabs/planeacion/jquery.capuchon.det.php' ?>
							<?php if($tipitecodigo == 6 && ($tipevecodigo != 3 && $tipevecodigo != 2)) include '../src/FunjQuery/jquery.tabs/planeacion/jquery.lamina.det.php' ?>
						</div>
						<?php endif?>
					</td>
				</tr>
				<tr>
				<td class="NoiseErrorDataTD" align="center"></td>
				<tr>
					<td class="NoiseErrorDataTD" align="center"><?php include '../def/jquery.button_formdetall.php'; ?></td>
				</tr>
			</table>
			<input type="hidden" name="esp_pro" id="esp_pro" value="<?php echo $esp_pro ?>" />
			<input type="hidden" name="emb" id="emb" value="<?php echo $emb ?>" />
			<input type="hidden" name="ext" id="ext" value="<?php echo $ext ?>" />
			<input type="hidden" name="lmn" id="lmn" value="<?php echo $lmn ?>" />
			<input type="hidden" name="con_pro" id="con_pro" value="<?php echo $con_pro ?>" />
			<input type="hidden" name="not_mod" id="not_mod" value="<?php echo $not_mod ?>" />
			<input type="hidden" name="for_emp" id="for_emp" value="<?php echo $for_emp ?>" />
			<input type="hidden" name="arrTabs" id="arrTabs" value="<?php echo $arrTabs ?>" />

			<input type="hidden" name="pedvencodigo" value="<?php if(!$flagdetallarvistaplaneacion){ echo $rwPedidoventa[pedvencodigo];}else{ echo $pedvencodigo; }?>"> 
			<input type="hidden" name="produccodigo" id="produccodigo" value="<?php if(!$flagdetallarvistaplaneacion){ echo $sbreg[produccodigo];}else{ echo $produccodigo; } ?>">  		
			<input type="hidden" name="ordcomcodigo" value="<?php if(!$flagdetallarvistaplaneacion){ echo $rwOrdencompra[ordcomcodigo];}else{ echo $ordcomcodigo; } ?>">  		
			<input type="hidden" name="propedcodigo" value="<?php if(!$flagdetallarvistaplaneacion){ echo $rwProducpedido[propedcodigo];}else{ echo $propedcodigo; } ?>">  		
			<input type="hidden" name="tipitecodigo" id="tipitecodigo"  value="<?php echo $tipitecodigo; ?>"> 
			<input type="hidden" name="tipevecodigo" value="<?php echo $tipevecodigo; ?>"> 
			<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>"> 
			<input type="hidden" name="sourceaction" id="sourceaction" value="detallar">  
			<input type="hidden" name="acciondetallarvistaplaneacion"> 
			<input type="hidden" name="codigo" value="<?php echo $codigo ?>">

			<input type="hidden" name="windetallar" id="windetallar" value="1"><!-- ventana de detalle -->
			<input type="hidden" name="modulocodigo" id="modulocodigo" value="5"><!-- modulo de planeacion -->
			<input type="hidden" name="produccoduno" id="produccoduno" value="<?php echo $produccoduno; ?>"><!-- codigo item -->
			<input type="hidden" name="ordcomcodcli" id="ordcomcodcli" value="<?php echo $ordcomcodcli; ?>"><!-- codigo cliente -->


			<!--		variable adicionales para calculo de materiales 	-->
			<input type="hidden" name="arrtabla2" id="arrtabla2" value="<?php echo ($arrtabla2)? $arrtabla2 : 0 ; ?>" /> 
			<input type="hidden" name="totalgramaje" id="totalgramaje" value="<?php echo ($totalgramaje)? $totalgramaje : 0 ; ?>" /> 
			<input type="hidden" name="unimedi" id="unimedi" value="<?php echo ($unimedi)? $unimedi : 0 ; ?>" /> 
			<input type="hidden" name="cantsol" id="cantsol" value="<?php echo ($cantsol)? $cantsol : 0 ; ?>" /> 
			<input type="hidden" name="solapa" id="solapa" value="<?php echo ($solapa)? $solapa : 0 ; ?>" /> 
			<input type="hidden" name="largo" id="largo" value="<?php echo ($largo)? $largo : 0 ; ?>" />  
			<input type="hidden" name="fuelle" id="fuelle" value="<?php echo ($fuelle)? $fuelle : 0 ; ?>" />  
			<input type="hidden" name="ancho" id="ancho" value="<?php echo ($ancho)? $ancho : 0 ; ?>" />  
			<input type="hidden" name="bmayor" id="bmayor" value="<?php echo ($bmayor)? $bmayor : 0 ; ?>" />  
			<input type="hidden" name="bmenor" id="bmenor" value="<?php echo ($bmenor)? $bmenor: 0 ; ?>" />  
			<input type="hidden" name="pestania" id="pestania" value="<?php echo ($pestania)? $pestania : 0 ; ?>" />  
			<input type="hidden" name="formulcodigo" id="formulcodigo" value="<?php echo ($formulcodigo)? $formulcodigo : 0 ; ?>" />    
			<input type="hidden" name="product_imp" id="product_imp" value="<?php echo ($product_imp)? $product_imp : 0 ; ?>" />  
			<input type="hidden" name="valid_produc_imp" id="valid_produc_imp" value="<?php echo ($valid_produc_imp)? $valid_produc_imp : 0 ; ?>" />  
		</form>
		<div id="msgwindow" title="Adsum Kallpa"><span id="msg"></span></div>
	</body> 
<?php if (!$codigo){echo " -->";} ?> 
</html>