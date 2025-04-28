<?php 
	include ('../src/FunjQuery/jquery.service/jquery.array_json.php');
	include ('../src/FunPerPriNiv/pktblproducto.php');
	include ('../src/FunPerSecNiv/fncnumreg.php');
	include ('../src/FunPerSecNiv/fncfetch.php');
	include ('../src/FunPerSecNiv/fncconn.php');
	include ('../src/FunPerSecNiv/fncclose.php');
	
	$idcon = fncconn();
	$rsProducto = dinamicscanopproducto(array('produccoduno' => $idproducto),array('produccoduno' => '='),$idcon);
	$nrProducto = fncnumreg($rsProducto);
	$rwProducto = fncfetch($rsProducto,0);
	
	if($rsProducto > 0)
	echo array_to_json(array('tipprocodigo' => $rwProducto['tipprocodigo'], 'produccodigo' => $rwProducto['produccodigo']));
	fncclose($idcon);
?>