<?php 
/*
-Todos los derechos reservados-
Propiedad intelectual de Adsum (c).
Funcion         : editatipoequipocamperequipo
Decripcion      :
Autor           : lfolaya
Escrito con     : WAG Adsum versi�n 3.1.1
Fecha           : 28122005
Historial de modificaciones
| Fecha  | Motivo					| Autor 	|
*/
function editatipoequipocamperequipo($iRegtipoequipocamperequipo,&$flageditartipoequipocamperequipo,&$campnomb,&$codigo) 
{ 
	$nuconn = fncconn(); 
	$result = insrecordtipoequipocamperequipo($iRegtipoequipocamperequipo,$nuconn); 
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
function armaarreglo($tipequcodigo, $idcon)
{
	if($idcon)
	{
		$flag = 0;
		$iRegtipoequipocamperequipo["tipequcodigo"] = $tipequcodigo;
		$iRegtipoequipocamperequipo["capeeqcodigo"] = "";
		$idres_tipoequipocamperequipo = dinamicscantipoequipocamperequipo($iRegtipoequipocamperequipo, $idcon);
		
		if(!is_numeric($idres_tipoequipocamperequipo))
		{
			$num_tipoequipocamperequipo = fncnumreg($idres_tipoequipocamperequipo);
		
			for($i=0; $i<$num_tipoequipocamperequipo; $i++)
			{
				$arr_tipoequipocamperequipo = fncfetch($idres_tipoequipocamperequipo, $i);
				
				if($arr_tipoequipocamperequipo["tipequcodigo"] == $iRegtipoequipocamperequipo["tipequcodigo"])
				{
					$arr_return[] = $arr_tipoequipocamperequipo["capeeqcodigo"];
				}
			}
		}else 
			return -1;
	}
	return $arr_return;
}

//***/// Esta parte es para la actuaizacion de los campos personalizados de equipocamperequipo
//---/// y de esta forma que los equipo sean actualizados de la misma forma
// cbedoya // 21-sep-2007
$idcon = fncconn();


include_once('../src/FunPerPriNiv/pktblequipo.php');
include_once('../src/FunPerPriNiv/pktblequipocamperequipo.php');


$datatipequ["tipequcodigo"] = $tipequcodigo;
$del_data = deleteexitvalcamp($tipequcodigo,$idcon);

$sbregequipodat = dinamicscanopequipo($datatipequ,"=",$idcon);

if ($sbregequipodat > 0){
	$nuCantRow = pg_numrows($sbregequipodat);
	
	$arr_camperdata = explode(",",$arreglo_aux);
	for($y=0; $y < count($arr_camperdata); $y++){
		for($c = 0; $c <$nuCantRow; $c++){
			$sbRow = pg_fetch_row ($sbregequipodat,$c);
			
			$exit_data = loadrecordequipocamperequipo($sbRow[0],$arr_camperdata[$y],$idcon);
			
			if ($exit_data < 0){
				$sbregnewcamper["equipocodigo"] = $sbRow[0];
				$sbregnewcamper["capeeqcodigo"] = $arr_camperdata[$y];
				$sbregnewcamper["capeeqvalor"] = "";
				insrecordequipocamperequipo($sbregnewcamper,$idcon);
			}
		}
	}
}
//cbedoya//// 21-sep-2007


//--- Validacion
$valposic = explode(",", $arreglo_aux);
$numposic = count($valposic);
$arrvalid = armaarreglo($tipequcodigo, $idcon);
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
		$iRegtipoequipocamperequipo["tipequcodigo"] = $tipequcodigo;
		$iRegtipoequipocamperequipo["capeeqcodigo"] = $valposic[$i];

		editatipoequipocamperequipo($iRegtipoequipocamperequipo, $flageditartipoequipocamperequipo, $campnomb, $codigo);
	}
}
else
{
	if(!empty($arrinsert))
	{
		for($i=0; $i<count($arrinsert); $i++)
		{
			$iRegtipoequipocamperequipo["tipequcodigo"] = $tipequcodigo;
			$iRegtipoequipocamperequipo["capeeqcodigo"] = $arrinsert[$i];
			editatipoequipocamperequipo($iRegtipoequipocamperequipo, $flageditartipoequipocamperequipo, $campnomb, $codigo);
		}
	}
	if(!empty($arrdelete))
	{
		$nuconn = fncconn();
		for($i=0; $i<count($arrdelete); $i++)
		{
			$sbregtipoequipocamperequipo["tipequcodigo"] = $tipequcodigo;
			$sbregtipoequipocamperequipo["capeeqcodigo"] = $arrdelete[$i];
			
			$resultado = dinamicscantipoequipocamperequipo($sbregtipoequipocamperequipo, $nuconn);
			$arrtipoequipocamperequipo = fncfetch($resultado, 0);
			$borrares = delrecordtipoequipocamperequipo($arrtipoequipocamperequipo["tipequcodigo"], $arrtipoequipocamperequipo["capeeqcodigo"], $nuconn);
		}
		fncclose($nuconn);
	}
}
?>