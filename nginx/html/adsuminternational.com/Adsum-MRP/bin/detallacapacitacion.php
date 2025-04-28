<?php 

$idcon = fncconn();	


$horini = date("h", strtotime($sbreg['capacihorini']));
$minini = date("i", strtotime($sbreg['capacihorini']));
$pasadmerini = (date("a", strtotime($sbreg['capacihorini'])) == 'pm') ? 1 : null;


			
$rsDepartam = ($sbreg['departcodigo']) ? loadrecorddepartam($sbreg['departcodigo'], $idcon) : null;
$departcodigo1 = $sbreg['departcodigo'];
$departnombre = $rsDepartam['departnombre'];

$rsCUsuario = ($sbreg['usuacodi']) ? loadrecordusuario($sbreg['usuacodi'], $idcon) : null;
$usuacodigo = $sbreg['usuacodi'];
$usuanombre = $rsCUsuario['usuanombre'].' '.$rsCUsuario['usuapriape'].' '.$rsCUsuario['usuasegape'];


$rsCapacimateap = dinamicscancapacimateap(array('capacicodigo' => $sbreg['capacicodigo']), $idcon);
$nrCapacimateap = fncnumreg($rsCapacimateap);

for($a = 0; $a < $nrCapacimateap; $a++)
{
	$rwCapacimateap = fncfetch($rsCapacimateap, $a);
	$arritem .= (($arritem) ? ',' : '').$rwCapacimateap['matapocodigo'];
}

$rsCapaciusuario = dinamicscancapaciusuario(array('capacicodigo' => $sbreg['capacicodigo']), $idcon);
$nrCapaciusuario = fncnumreg($rsCapaciusuario);

for($a = 0; $a < $nrCapaciusuario; $a++)
{
	$rwCapaciusuario = fncfetch($rsCapaciusuario, $a);
	$objDepartam = 'depart_'.$rwCapaciusuario['usuacodi'];
	$$objDepartam = $rwCapaciusuario['departcodigo'];
	
	$lsttecnicoot .= (($lsttecnicoot) ? ',' : '').$rwCapaciusuario['usuacodi'];
}

$rsCapacitema = dinamicscancapacitema(array('capacicodigo' => $sbreg['capacicodigo']), $idcon);
$nrCapacitema = fncnumreg($rsCapacitema);
$arrExist = array();
$min = 0;
$hor = 0;

for($a = 0; $a < $nrCapacitema; $a++)
{
	$rwCapacitema = fncfetch($rsCapacitema, $a);
	
	for($b = 1; $b < 100; $b++)
	{
		$insCodigo = $b.'_'.$rwCapacitema['usuacodi'];
		if(!array_key_exists($insCodigo, $arrExist))
		{
			$arrExist[$insCodigo] = 1;
			break;
		}
	}
	
	$objTema = 'curcontema_'.$insCodigo.'_'.$a;
	$objHora = 'curconhora_'.$insCodigo.'_'.$a;
	$objvalor = 'curconvalor_'.$insCodigo.'_'.$a;
	$objThora = 'tipohora_'.$insCodigo.'_'.$a;
	
	$tiedur = (strpos($rwCapacitema['captemtiedur'], '.')) ? (int)($rwCapacitema['captemtiedur'] * 60) : (int)$rwCapacitema['captemtiedur'];
	$tipohr = (strpos($rwCapacitema['captemtiedur'], '.')) ? 2 : 1;
	
	
	$$objTema = $rwCapacitema['temacodigo'];
	$$objHora = $tiedur;
	$$objvalor = $rwCapacitema['captemvalor'];
	$$objThora = $tipohr;
	$lstinstructor .= (($lstinstructor) ? ',' : '').$insCodigo;
	
	$min += ($tipohr == 2) ?  $tiedur : 0;
	$hor += ($tipohr == 1) ?  $tiedur : 0;
	
}

$cursocodigo = $sbreg['cursocodigo'];
$ubicapcodigo = $sbreg['ubicapcodigo'];
$salcapcodigo = $sbreg['salcapcodigo'];
$capacifecini = $sbreg['capacifecini'];
