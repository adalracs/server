<?php 
/*
-Todos los derechos reservados-
Propiedad intelectual de Adsum (c).
Funcion         : editatipocomponencamperequipo
Decripcion      :
Autor           : lfolaya
Escrito con     : WAG Adsum versi�n 3.1.1
Fecha           : 28122005
Historial de modificaciones
| Fecha  | Motivo					| Autor 	|
*/
function editatipocomponencamperequipo($iRegtipocomponencamperequipo,&$flageditartipocomponencamperequipo,&$campnomb,&$codigo) 
{ 
	$nuconn = fncconn(); 
	$result = insrecordtipocomponencamperequipo($iRegtipocomponencamperequipo,$nuconn); 
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
function armaarreglo($tipcomcodigo, $idcon)
{
	if($idcon)
	{
		$flag = 0;
		$iRegtipocomponencamperequipo["tipcomcodigo"] = $tipcomcodigo;
		$iRegtipocomponencamperequipo["capeeqcodigo"] = "";
		$idres_tipocomponencamperequipo = dinamicscantipocomponencamperequipo($iRegtipocomponencamperequipo, $idcon);
		
		if(!is_numeric($idres_tipocomponencamperequipo))
		{
			$num_tipocomponencamperequipo = fncnumreg($idres_tipocomponencamperequipo);
		
			for($i=0; $i<$num_tipocomponencamperequipo; $i++)
			{
				$arr_tipocomponencamperequipo = fncfetch($idres_tipocomponencamperequipo, $i);
				
				if($arr_tipocomponencamperequipo["tipcomcodigo"] == $iRegtipocomponencamperequipo["tipcomcodigo"])
				{
					$arr_return[] = $arr_tipocomponencamperequipo["capeeqcodigo"];
				}
			}
		}else 
			return -1;
	}
	return $arr_return;
}

//***/// Esta parte es para la actuaizacion de los campos personalizados de componencamperequipo
//---/// y de esta forma que los componentes sean actualizados de la misma forma
// cbedoya // 21-sep-2007
$idcon = fncconn();


include_once('../src/FunPerPriNiv/pktblcomponen.php');
include_once('../src/FunPerPriNiv/pktblcomponencamperequipo.php');


$datatipcom["tipcomcodigo"] = $tipcomcodigo;
$del_data = deleteexitvalcamp($tipcomcodigo,$idcon);

$sbregcomponendat = dinamicscanopcomponen($datatipcom,"=",$idcon);

if ($sbregcomponendat > 0){
	$nuCantRow = pg_numrows($sbregcomponendat);
	
	$arr_camperdata = explode(",",$arreglo_aux); 
	for($y=0; $y < count($arr_camperdata); $y++){
		for($c = 0; $c <$nuCantRow; $c++){
			$sbRow = pg_fetch_row ($sbregcomponendat,$c);
			
			$exit_data = loadrecordcomponencamperequipo($sbRow[0],$arr_camperdata[$y],$idcon);
			
			if ($exit_data < 0){
				$sbregnewcamper["componcodigo"] = $sbRow[0];
				$sbregnewcamper["capeeqcodigo"] = $arr_camperdata[$y];
				$sbregnewcamper["capeeqvalor"] = "";
				insrecordcomponencamperequipo($sbregnewcamper,$idcon);
			}
		}
	}
}
//cbedoya//// 21-sep-2007


//--- Validacion
$valposic = explode(",", $arreglo_aux);
$numposic = count($valposic);
$arrvalid = armaarreglo($tipcomcodigo, $idcon);
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
		$iRegtipocomponencamperequipo["tipcomcodigo"] = $tipcomcodigo;
		$iRegtipocomponencamperequipo["capeeqcodigo"] = $valposic[$i];

		editatipocomponencamperequipo($iRegtipocomponencamperequipo, $flageditartipocomponencamperequipo, $campnomb, $codigo);
	}
}
else
{
	if(!empty($arrinsert))
	{
		for($i=0; $i<count($arrinsert); $i++)
		{
			$iRegtipocomponencamperequipo["tipcomcodigo"] = $tipcomcodigo;
			$iRegtipocomponencamperequipo["capeeqcodigo"] = $arrinsert[$i];
			editatipocomponencamperequipo($iRegtipocomponencamperequipo, $flageditartipocomponencamperequipo, $campnomb, $codigo);
		}
	}
	if(!empty($arrdelete))
	{
		$nuconn = fncconn();
		for($i=0; $i<count($arrdelete); $i++)
		{
			$sbregtipocomponencamperequipo["tipcomcodigo"] = $tipcomcodigo;
			$sbregtipocomponencamperequipo["capeeqcodigo"] = $arrdelete[$i];
			
			$resultado = dinamicscantipocomponencamperequipo($sbregtipocomponencamperequipo, $nuconn);
			$arrtipocomponencamperequipo = fncfetch($resultado, 0);
			$borrares = delrecordtipocomponencamperequipo($arrtipocomponencamperequipo["tipcomcodigo"], $arrtipocomponencamperequipo["capeeqcodigo"], $nuconn);
		}
		fncclose($nuconn);
	}
}
?>