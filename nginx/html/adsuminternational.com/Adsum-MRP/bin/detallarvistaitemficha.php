<?php 
	ini_set('display_errors',1);
	include ( '../src/FunPerPriNiv/pktblproducpadreitem.php');
	include ( '../src/FunPerPriNiv/pktblpadreitem.php');
	include ( '../src/FunPerPriNiv/pktblproducto.php');
	include ( '../src/FunPerPriNiv/pktblproducpedido.php');
	include ( '../src/FunPerPriNiv/pktblpedidoventa.php');
	include ( '../src/FunPerPriNiv/pktblpedidotemp.php');
	include ( '../src/FunPerPriNiv/pktblordencompra.php');
	include ( '../src/FunPerPriNiv/pktblcptpdetope.php');
	include ( '../src/FunPerPriNiv/pktblcampertippro.php');
	include ('../src/FunPerPriNiv/pktblusuario.php');
	include ( '../src/FunGen/sesion/fncvalses.php');
	include ('../src/FunGen/cargainput.php');
	
	
	if(!$flagdetallarvistafichatecnica) 
	{ 
		include ( '../src/FunGen/sesion/fnccarga.php'); 
		$sbreg = fnccarga($nombtabl,$radiobutton);
		
		if (!$sbreg) 
			include( '../src/FunGen/fnccontfron.php');
			
		$idcon = fncconn();
		$rwProducto = loadrecordproducto($sbreg['produccodigo'],$idcon);
		$rwProducpedido = loadrecordproducpedidoPER('produccodigo',$sbreg['produccodigo'],$idcon);
		$rwPedidoventa = loadrecordpedidoventa($rwProducpedido['pedvencodigo'],$idcon);
		if($rwPedidoventa['tipevecodigo'] !=4)
			$rwOrdencompra = loadrecordordencompra($rwPedidoventa['ordcomcodigo'],$idcon);

		$clientnombre = $rwOrdencompra['ordcomrazsoc'];
		$tipitecodigo = $rwProducto['tipprocodigo']; 
		$tipevecodigo = $rwPedidoventa['tipevecodigo'];
		
		if($tipitecodigo == 1) $tipoproducto = 'BOLSA FLOW PACK';
		if($tipitecodigo == 2) $tipoproducto = 'BOLSA LATERAL';
		if($tipitecodigo == 3) $tipoproducto = 'BOLSA POUCH DOY PACK';
		if($tipitecodigo == 4) $tipoproducto = 'BOLSA POUCH LATERAL';
		if($tipitecodigo == 5) $tipoproducto = 'CAPUCHON';
		if($tipitecodigo == 6) $tipoproducto = 'LAMINA';
		
		
		if($rwProducto[producpadre])
		{
			$produc = $rwProducto[producpadre];
		}
		else
		{
			$produc = $sbreg['produccodigo'];
		}
		
		$rsItemproduc = dinamicscanproducpadreitem(array("produccodigo" =>$produc), $idcon);
		$nrItemproduc = fncnumreg($rsItemproduc);
		
		for($a = 0; $a < $nrItemproduc; $a++):
			$rwItemproduc = fncfetch($rsItemproduc, $a);
			$rwItem = loadrecordpadreitem($rwItemproduc['paditecodigo'],$idcon);
			
			($arrtabla1) ? $arrtabla1 .= ':|:'.($a +1).':-:'.$rwItemproduc['paditecodigo'].':-:'.$rwItem['paditedensid'].':-:'.$rwItemproduc['propadcalib'].':-:'.$rwItem['paditeextrui'] : $arrtabla1 = ($a +1).':-:'.$rwItemproduc['paditecodigo'].':-:'.$rwItem['paditedensid'].':-:'.$rwItemproduc['propadcalib'].':-:'.$rwItem['paditeextrui'];  
			
			$objColor = 'color_'.($a +1).'_'.$rwItemproduc['paditecodigo'];
			$$objColor = $rwItemproduc['propadcolor'];
			
		endfor;
		
		$rsCptpdetope = dinamicscancptpdetope(array('produccodigo' =>$produc),$idcon);
		
		if($rsCptpdetope > 0) $nrCptpdetope = fncnumreg($rsCptpdetope);
		/*
		 * cArga valores a campos personalizados
		 */
		for($i = 0;$i<$nrCptpdetope;$i++)
		{
			$rwCptpdetope = fncfetch($rsCptpdetope,$i);
			$rwCampertippro = loadrecordcampertippro($rwCptpdetope['cptprocodigo'],$idcon);
			if($rwCampertippro['procescodigo'] != '3'):
				$objCampo = $rwCampertippro['cptprnombre'];
				$$objCampo = $rwCptpdetope['cptprovalor'];
				$arrCampertippro[$objCampo] = $$objCampo ;
			else:
				$array_tmp = explode(',',$rwCptpdetope['cptprovalor']);
				for($a = 0; $a < count($array_tmp); $a++):
					$objCampo = $rwCampertippro['cptprnombre'].'_'.($a+1);
					$$objCampo = $array_tmp[$a];
				endfor;
			endif;
		}
		
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
		<title>Detallar registro de producto</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=UTF8"> 
		<meta http-equiv="expires" content="0"> 
		<meta http-equiv="X-UA-Compatible" content="IE=9"> 
		<?php include ('../def/jquery.library_maestro.php'); ?>
		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.function_comun.js"></script>
		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.producitem.js"></script>
	</head> 
<?php if (! $codigo) echo "<!--"; ?> 
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post" enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">&Iacute;tem [Ficha Tecnica]</font></p> 
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
				<tr><td class="ui-widget-header"><span class="style5"><font color="FFFFFF"> Detallar registro</font></span></td></tr>
				<tr>
					<td>
						<table width="99%" border="0" cellspacing="1" cellpadding="1" align="center"> 
							<tr><td colspan="4" class="ui-state-default">&nbsp;<small>Sistema de aseguramiento de calidad ficha tecnica del producto</small></td></tr>
							<tr> 
								<td width="15%" class="NoiseFooterTD">&nbsp;Item</td> 
  								<td width="85%" class="NoiseDataTD">&nbsp;<?php echo $sbreg[produccoduno] ?></td> 
 							</tr>
							<tr> 
								<td width="15%" class="NoiseFooterTD">&nbsp;Referencia</td> 
  								<td width="85%" class="NoiseDataTD">&nbsp;<?php echo $sbreg[producnombre] ?></td> 
 							</tr>
 							<tr> 
								<td width="15%" class="NoiseFooterTD">&nbsp;Cliente</td> 
  								<td width="85%" class="NoiseDataTD">&nbsp;<?php echo $clientnombre ?></td> 
 							</tr>
 							<tr> 
								<td width="15%" class="NoiseFooterTD">&nbsp;Producto</td> 
  								<td width="85%" class="NoiseDataTD">&nbsp;<?php echo $tipoproducto ?></td> 
 							</tr>
						</table>
						<?php include '../src/FunjQuery/jquery.tabs/fichatec/jquery.bolsaflowpack.det.php' ?>
					</td>
				</tr>
				
				<!-- PESTAÑAS DEL FORMULARIO -->
				<tr>
				<tr><td>&nbsp;</td></tr>
				<tr><td class="NoiseErrorDataTD" align="center"><?php include '../def/jquery.button_form.php'; ?></td></tr>
				<tr><td>&nbsp;</td></tr> 
 				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr> 
			</table>
		</form>
		<div id="msgwindow" title="Adsum Kallpa"><span id="msg"></span></div>
	</body> 
<?php if (! $codigo) echo " -->"; ?> 
</html>