<?php 
include ( '../src/FunGen/fncnumprox.php');
include ( '../src/FunGen/fncnumact.php');
include ( '../src/FunPerPriNiv/pktblsoliprog.php');
include ( '../src/FunPerPriNiv/pktblop.php');
include ( '../src/FunPerPriNiv/pktblopflexo.php');  
include ( '../src/FunPerPriNiv/pktblplanearutaitempv.php');    
include ( '../src/FunPerPriNiv/pktblcampo.php'); 
include ( '../src/FunPerPriNiv/pktbltabla.php'); 
include ( '../def/tipocampo.php'); 
include ( '../src/FunGen/buscacaracter.php'); 
include ( '../src/FunGen/fncmsgerror.php'); 
include( '../src/FunGen/fncnombeditexs.php');
//constantes
define("editaEx",9);
//conexion
$idcon = fncconn();
//escaneo a la tabla planea padreitem
$nr_op = 0;
$rsPlaneapadreitem = dinamicscanplaneapadreitem(array("produccodigo" => $produccodigo),$idcon);
//consulta numero de materiales planeados
$nrPlaneapadreitem = fncnumreg($rsPlaneapadreitem);
//recorre consulta
for($i=0;$i<$nrPlaneapadreitem;$i++)
{
	//trae registo de padre item dependiendo de su indice
	$rwPlaneapadreitem = fncfetch($rsPlaneapadreitem,$i);
	$rwpadreitem = loadrecordpadreitem($rwPlaneapadreitem['paditecodigo'],$idcon);
	//consulta su el material es extruido
	if($product_imp == $rwpadreitem['paditecodigo'])
	{
		$obj_material = 'material_'.$nr_op;
		$obj_calibre = 'calibre_'.$nr_op;
		$obj_cant_kg = 'cant_kg_'.$nr_op;
		$obj_cant_mt = 'cant_mt_'.$nr_op;
		$obj_ancho = 'ancho_'.$nr_op;
		$$obj_material = $rwpadreitem['paditecodigo'];
		$$obj_calibre = $rwPlaneapadreitem['plapadcalib'];
		$$obj_cant_kg = $rwPlaneapadreitem['plapadcantkg'];
		$$obj_cant_mt = $rwPlaneapadreitem['plapadcantmt'];
		$$obj_ancho = $rwPlaneapadreitem['plapadanchoi'];
		$nr_op++;
		break;
	}
}
//consecutivo de op
$nuidtemp = fncnumact(145,$idcon);
do
{
	$nuresult = loadrecordop($nuidtemp,$idcon);
	if($nuresult == e_empty)
	{
		$iRegop[ordprocodigo] = $nuidtemp;
	}
	$nuidtemp ++;
}while ($nuresult != e_empty);
//record para orden de produccion
$iRegop[solprocodigo] = $solprocodigo;
$iRegop[usuacodi] = $usuacodi;
$iRegop[ordprofecgen] = date('Y-m-d');
$rwhora = getdate(time());
$hora = $rwhora["hours"] . ":" . $rwhora["minutes"] . ":" . $rwhora["seconds"];
$iRegop[ordprohorgen] = $hora;
$iRegop[plantacodigo] = 1;//planta yumbo
$iRegop[ordproacti] = 1;//orden activa
$iRegop[procedcodigo] = $procedcodigo;
$iRegop[opestacodigo] = 1;//creada esta inicial
$iRegop[ordprodescri] = $solprodescri;
//se inserta el registro de orden de produccion
$res = insrecordop($iRegop,$idcon);
for($a = 0;$a < $nr_op;$a++){
	$obj_material = 'material_'.$a;
	$obj_calibre = 'calibre_'.$a;
	$obj_cant_kg = 'cant_kg_'.$a;
	$obj_cant_mt = 'cant_mt_'.$a;	
	$obj_ancho = 'ancho_'.$a;
	//record para el detalle para la gestion de la op
	$iRegopflexo[ordprocodigo] = $iRegop[ordprocodigo];
	$iRegopflexo[paditecodigo] = $$obj_material;
	$iRegopflexo[ordprocalib] = $$obj_calibre;
	$iRegopflexo[ordprocantid] = $$obj_cant_kg;
	$iRegopflexo[ordproanchop] = $$obj_ancho;
	$iRegopflexo[ordproanchom] = $ancho;
	$iRegopflexo[ordpropista] = $nropistas;
	$iRegopflexo[ordprometros] = $$obj_cant_mt;
	$iRegopflexo[ordprotipimp] = $tipo_impresion;
	$iRegopflexo[ordprorodillo] = $rodillo;
	//se le inserta el registro detallado de la operacion de produccion
	$res = insrecordopflexo($iRegopflexo,$idcon);
}
//se actualiza consecutivo de op
fncnumprox(145,$iRegop[ordprocodigo] + 1,$idcon); 
/*
* despues que se registran los diferentes eventos de la gestion 
* se reporta en la tabla de {planearutaitempv} que la solicutud de flexografia 
* cambia de estado referentes a la tabla de {soliprogestado}
*/
//se crea el registro para actualizar planearuteitempv ruta del pedidoventa
$iRegplanearutaitempv_[plarutcodigo] = $plarutcodigo;//programada 
$iRegplanearutaitempv_[estsolcodigo] = 2;//programada 
uprecordplanearutaitempvestado($iRegplanearutaitempv_,$idcon);
//desconectar
$flageditarvistasoliflexo = 1;
fncclose($idcon);
fncmsgerror(editaEx);
echo '<script language="javascript">';
echo '<!--//'."\n";
echo 'location ="maestablvistasoliflexo.php?codigo='.$codigo.';"';
echo '//-->'."\n";
echo '</script>';
?>