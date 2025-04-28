<?php 
/*
-Todos los derechos reservados-
Propiedad intelectual de Adsum (c).
Funcion         : editanormaseguriequipo
Decripcion      :
Autor           : lfolaya
Escrito con     : WAG Adsum versiï¿½n 3.1.1
Fecha           : 28122005
Historial de modificaciones
| Fecha  | Motivo					| Autor 	|
*/
include ( '../src/FunGen/fncnumprox.php');
include ( '../src/FunGen/fncnumact.php');
function editanormaseguriequipo($iRegnormaseguriequipo,&$flageditarnormaseguriequipo,&$campnomb,&$codigo) 
{ 
	$nuconn = fncconn(); 
	define("id",89);
	
	$nuidtemp = fncnumact(id,$nuconn);
	do
	{
		$nuresult = loadrecordnormaseguriequipo($nuidtemp,$nuconn);
		if($nuresult == e_empty)
		{
			$iRegnormaseguriequipo["nosequcodigo"] = $nuidtemp;
		}
		$nuidtemp ++;
	}while ($nuresult != e_empty);
	
	$result = insrecordnormaseguriequipo($iRegnormaseguriequipo,$nuconn); 
	 
	if($result > 0) 
		$nuresult1 = fncnumprox(id,$nuidtemp,$nuconn); //No utilice esta parte si va a utilizar la llave primaria como serial//
	 
	fncclose($nuconn); 
} 

/*
-Todos los derechos reservados-
Propiedad intelectual de Adsum (c).
Funcion         : armaarreglo
Decripcion      :
Autor           : mstroh
Escrito con     : WAG Adsum versión 3.1.1
Fecha           : 15112004
Historial de modificaciones
| Fecha  | Motivo					| Autor 	|
*/
function armaarreglo($equipocodigo, $idcon)
{
	if($idcon)
	{
		$flag = 0;
		$iRegnormaseguriequipo["nosequcodigo"] = "";
		$iRegnormaseguriequipo["equipocodigo"] = $equipocodigo;
		$iRegnormaseguriequipo["norsegcodigo"] = "";
		$idres_normaseguriequipo = dinamicscannormaseguriequipo($iRegnormaseguriequipo, $idcon);
		
		if(!is_numeric($idres_normaseguriequipo))
		{
			$num_normaseguriequipo = fncnumreg($idres_normaseguriequipo);
		
			for($i=0; $i<$num_normaseguriequipo; $i++)
			{
				$arr_normaseguriequipo = fncfetch($idres_normaseguriequipo, $i);
				
				if($arr_normaseguriequipo["equipocodigo"] == $iRegnormaseguriequipo["equipocodigo"])
				{
					$arr_return[] = $arr_normaseguriequipo["norsegcodigo"];
				}
			}
		}else 
			return -1;
	}
	return $arr_return;
}
//--- Validacion
$valposic = explode(",", $arreglo_aux);
$numposic = count($valposic);
$idcon = fncconn();
$arrvalid = armaarreglo($equipocodigo, $idcon);

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
		$iRegnormaseguriequipo["nosequcodigo"] = $nosequcodigo;
		$iRegnormaseguriequipo["equipocodigo"] = $equipocodigo;
		$iRegnormaseguriequipo["norsegcodigo"] = $valposic[$i];

		editanormaseguriequipo($iRegnormaseguriequipo, $flageditarnormaseguriequipo, $campnomb, $codigo);
	}
}
else
{
	if(!empty($arrinsert))
	{
		for($i=0; $i<count($arrinsert); $i++)
		{
			$iRegnormaseguriequipo["nosequcodigo"] = $nosequcodigo;
			$iRegnormaseguriequipo["equipocodigo"] = $equipocodigo;
			$iRegnormaseguriequipo["norsegcodigo"] = $arrinsert[$i];
			editanormaseguriequipo($iRegnormaseguriequipo, $flageditarnormaseguriequipo, $campnomb, $codigo);
		}
	}
	if(!empty($arrdelete))
	{
		$nuconn = fncconn();
		for($i=0; $i<count($arrdelete); $i++)
		{
			$sbregnormaseguriequipo["nosequcodigo"] = "";
			$sbregnormaseguriequipo["equipocodigo"] = $equipocodigo;
			$sbregnormaseguriequipo["norsegcodigo"] = $arrdelete[$i];
			
			$resultado = dinamicscannormaseguriequipo($sbregnormaseguriequipo, $nuconn);
			$arrnormaseguriequipo = fncfetch($resultado, 0);
			$borrares = delrecordnormaseguriequipo($arrnormaseguriequipo["nosequcodigo"], $nuconn);
		}
		fncclose($nuconn);
	}
	unset($sbregservicioplanta, $arrservicioplanta, $borrares);
}
fncclose($idcon);




$iRegnormaseguriequipo[nosequcodigo] = $nosequcodigo; 
$iRegnormaseguriequipo[equipocodigo] = $equipocodigo; 
$iRegnormaseguriequipo[norsegcodigo] = $norsegcodigo; 
editanormaseguriequipo($iRegnormaseguriequipo,$flageditarnormaseguriequipo,$campnomb,$codigo); 
?> 
