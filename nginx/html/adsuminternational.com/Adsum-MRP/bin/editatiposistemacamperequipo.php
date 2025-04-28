<?php 
/*
-Todos los derechos reservados-
Propiedad intelectual de Adsum (c).
Funcion         : editatiposistemacamperequipo
Decripcion      :
Autor           : lfolaya
Escrito con     : WAG Adsum versi�n 3.1.1
Fecha           : 28122005
Historial de modificaciones
| Fecha  | Motivo					| Autor 	|
*/
function editatiposistemacamperequipo($iRegtiposistemacamperequipo,&$flageditartiposistemacamperequipo,&$campnomb,&$codigo) 
{ 
	$nuconn = fncconn(); 
	$result = insrecordtiposistemacamperequipo($iRegtiposistemacamperequipo,$nuconn); 
	fncclose($nuconn); 
} 

/*
-Todos los derechos reservados-
Propiedad intelectual de Adsum (c).
Funcion         : armaarreglo
Decripcion      :
Autor           : lfolaya
Escrito con     : WAG Adsum versi�n 3.1.1
Fecha           : 25092006
Historial de modificaciones
| Fecha  | Motivo					| Autor 	|
*/
function armaarreglo($tipsiscodigo, $idcon)
{
	if($idcon)
	{
		$flag = 0;
		$iRegtiposistemacamperequipo["tipsiscodigo"] = $tipsiscodigo;
		$iRegtiposistemacamperequipo["capeeqcodigo"] = "";
		$idres_tiposistemacamperequipo = dinamicscantiposistemacamperequipo($iRegtiposistemacamperequipo, $idcon);
		
		if(!is_numeric($idres_tiposistemacamperequipo))
		{
			$num_tiposistemacamperequipo = fncnumreg($idres_tiposistemacamperequipo);
		
			for($i=0; $i<$num_tiposistemacamperequipo; $i++)
			{
				$arr_tiposistemacamperequipo = fncfetch($idres_tiposistemacamperequipo, $i);
				
				if($arr_tiposistemacamperequipo["tipsiscodigo"] == $iRegtiposistemacamperequipo["tipsiscodigo"])
				{
					$arr_return[] = $arr_tiposistemacamperequipo["capeeqcodigo"];
				}
			}
		}else 
			return -1;
	}
	return $arr_return;
}

//***/// Esta parte es para la actuaizacion de los campos personalizados de sistemacamperequipo
//---/// y de esta forma que los sistemas sean actualizados de la misma forma
// cbedoya // 21-sep-2007
$idcon = fncconn();


include_once('../src/FunPerPriNiv/pktblsistema.php');
include_once('../src/FunPerPriNiv/pktblsistemacamperequipo.php');


$datatipsis["tipsiscodigo"] = $tipsiscodigo;
$del_data = deleteexitvalcamp($tipsiscodigo,$idcon);

$sbregsistemadat = dinamicscanopsistema($datatipsis,"=",$idcon);

if ($sbregsistemadat > 0){
	$nuCantRow = pg_numrows($sbregsistemadat);
	
	$arr_camperdata = explode(",",$arreglo_aux);
	for($y=0; $y < count($arr_camperdata); $y++){
		for($c = 0; $c <$nuCantRow; $c++){
			$sbRow = pg_fetch_row ($sbregsistemadat,$c);
			
			$exit_data = loadrecordsistemacamperequipo($sbRow[0],$arr_camperdata[$y],$idcon);
			
			if ($exit_data < 0){
				$sbregnewcamper["sistemcodigo"] = $sbRow[0];
				$sbregnewcamper["capeeqcodigo"] = $arr_camperdata[$y];
				$sbregnewcamper["capeeqvalor"] = "";
				insrecordsistemacamperequipo($sbregnewcamper,$idcon);
			}
		}
	}
}
//cbedoya//// 21-sep-2007

//--- Validacion
$valposic = explode(",", $arreglo_aux);
$numposic = count($valposic);
$arrvalid = armaarreglo($tipsiscodigo, $idcon);
fncclose($idcon);

// Contiene valores nuevos
$arrinsert = array_diff($valposic, $arrvalid);
sort($arrinsert);

// Contiene valores a eliminados
$arrdelete = array_diff($arrvalid, $valposic);


sort($arrdelete);

if(!is_array($arrvalid))
{
	for($i=0; $i<$numposic; $i++)
	{
		$iRegtiposistemacamperequipo["tipsiscodigo"] = $tipsiscodigo;
		$iRegtiposistemacamperequipo["capeeqcodigo"] = $valposic[$i];

		editatiposistemacamperequipo($iRegtiposistemacamperequipo, $flageditartiposistemacamperequipo, $campnomb, $codigo);
	}
}
else
{
	if(!empty($arrinsert))
	{
		for($i=0; $i<count($arrinsert); $i++)
		{
			$iRegtiposistemacamperequipo["tipsiscodigo"] = $tipsiscodigo;
			$iRegtiposistemacamperequipo["capeeqcodigo"] = $arrinsert[$i];
			editatiposistemacamperequipo($iRegtiposistemacamperequipo, $flageditartiposistemacamperequipo, $campnomb, $codigo);
		}
	}
	if(!empty($arrdelete))
	{
		$nuconn = fncconn();
		for($i=0; $i<count($arrdelete); $i++)
		{
			$sbregtiposistemacamperequipo["tipsiscodigo"] = $tipsiscodigo;
			$sbregtiposistemacamperequipo["capeeqcodigo"] = $arrdelete[$i];
			
			$resultado = dinamicscantiposistemacamperequipo($sbregtiposistemacamperequipo, $nuconn);
			$arrtiposistemacamperequipo = fncfetch($resultado, 0);
			$borrares = delrecordtiposistemacamperequipo($arrtiposistemacamperequipo["tipsiscodigo"], $arrtiposistemacamperequipo["capeeqcodigo"], $nuconn);
		}
		fncclose($nuconn);
	}
}
?>