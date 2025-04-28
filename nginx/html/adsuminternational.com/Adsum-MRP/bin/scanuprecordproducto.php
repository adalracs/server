<?php

$idcon = fncconn();

$rsPlaneacion = fullscanvistaplaneacion($idcon);
$nrPlaneacion = fncnumreg($rsPlaneacion);

for($a = 0; $a < $nrPlaneacion; $a++){
	$rwPlaneacion = fncfetch($rsPlaneacion,$a);

	if($rwPlaneacion['tipevecodigo'] == 3 ){
		$rwProducto = loadrecordproducto($rwPlaneacion['produccodigo'] ,$idcon);
		$rwProductopedido = loadrecordproducpedidoPER('produccodigo',$rwPlaneacion['produccodigo'],$idcon);			
		$rwProducto1 = loadrecordproducto($rwProductopedido['propedproduc'] ,$idcon);

		if($rwProducto1['producfecha'] < '20130801'){
			$iRegproducto['produccodigo'] = $rwProducto1['produccodigo'];
			$iRegproducto['producfecha'] = $rwProducto['producfecha'];
			updateproducto1($iRegproducto,$idcon);
		}

	}

}

fncclose($idcon);

?>