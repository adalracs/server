<?php 

	ini_set('display_errors',1);
	include ('../../FunPerSecNiv/fncconn.php');
	include ( '../../FunPerSecNiv/fncfetch.php');
	include ( '../../FunPerPriNiv/pktblproducto.php');
	include ( '../../FunPerPriNiv/pktblvistaproductos.php');
	include ( '../../FunPerPriNiv/pktblproducpedido.php');
	include ( '../../FunPerPriNiv/pktblpedidoventa.php');
	include ( '../../FunPerPriNiv/pktblordencompra.php');
	include ('../../FunPerPriNiv/pktblproductoseguimiento.php');
	include ('../../FunPerPriNiv/pktblusuario.php');
	include ('../../FunGen/cargainput.php');
	include ('../jquery.service/jquery.array_json.php');
	
	$idcon = fncconn();
	$producto['produccoduno'] = $_POST['pedido'];
	$tipevecodigo = $_POST['tipevecodigo'];
	
	//if($tipevecodigo == 2){
		$rsProducto = dinamicscanvistaproductos($producto,$idcon);
		$arrpro = fncfetch($rsProducto);
		$rsProducpedido = loadrecordproducpedidoPER('produccodigo',$arrpro['produccodigo'],$idcon);
		$pedven = $rsProducpedido['pedvencodigo'];
		$rsPedidoventa = loadrecordpedidoventa($pedven,$idcon);
		$nombre = cargausuanombre($rsPedidoventa['usuacodi'], $idcon);
		if($rsPedidoventa['tipevecodigo'] !=4){
			$rsOrdencompra = loadrecordordencompra($rsPedidoventa['ordcomcodigo'],$idcon);
		}
		
		$clientnombre = $rsOrdencompra['ordcomrazsoc'];
		$ordcomcodcli = $rsOrdencompra['ordcomcodcli'];
		$produccodigo = $arrpro['produccodigo'];
		$rsProductoSeguimiento = loadrecordproductoseguimiento1($produccodigo,$idcon);		
	/*}else  if($tipevecodigo == 3){
		$rwProducto = dinamicscanvistaproducto($producto,$idcon);
	}*/
	
	$rsfinal = array_merge($arrpro,$rsProducpedido,$rsPedidoventa,$rsOrdencompra);
	echo array_to_json($rsfinal);
	
?>