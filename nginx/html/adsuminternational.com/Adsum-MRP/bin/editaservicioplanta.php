<?php
/*
-Todos los derechos reservados-
Propiedad intelectual de Adsum (c).
Funcion         : editaservicioplanta
Decripcion      :
Autor           : mstroh
Escrito con     : WAG Adsum versiï¿½n 3.1.1
Fecha           : 28122005
Historial de modificaciones
| Fecha  | Motivo					| Autor 	|
*/
include ( '../src/FunGen/fncnumprox.php');
include ( '../src/FunGen/fncnumact.php');

function editaservicioplanta($iRegservicioplanta, &$flageditarservicioplanta, &$campnomb, &$codigo)
{
	$nuconn = fncconn();
	define("id",65);
	define("errorReg",1);
	define("errorCar",2);
	define("grabaEx",3);
	define("compinst",4);
	define("venccomp",5);
	define("compactu",6);
	define("fecvalid",7);
	define("errormail",8);
	define("editaEx",9);

	$nuidtemp = fncnumact(id,$nuconn);
	do
	{
		$nuresult = loadrecordservicioplanta($nuidtemp,$nuconn);
		if($nuresult == e_empty)
		{
			$iRegservicioplanta["serplacodigo"] = $nuidtemp;
		}
		$nuidtemp ++;
	}while ($nuresult != e_empty);

	$result = insrecordservicioplanta($iRegservicioplanta,$nuconn);

	if($result < 0 )
	{
		ob_end_clean();
		//		fncmsgerror(errorReg);
		$flageditarservicioplanta=1;
	}

	if($result > 0)
	{
		$nuresult1 = fncnumprox(id,$nuidtemp,$nuconn); //No utilice esta parte si va a utilizar la llave primaria como serial//
		//		fncmsgerror(editaEx);
	}
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
function armaarreglo($planta, $idcon)
{
	if($idcon)
	{
		$flag = 0;
		$nuresult = fullscanservicioplantaaux($planta, $idcon);

		if(!is_numeric($nuresult))
		{
			$numreg = fncnumreg($nuresult);

			for($i=0; $i<$numreg; $i++)
			{
				$arrservicioplanta = fncfetch($nuresult, $i);
				$arr_return[] = $arrservicioplanta["servicicodigo"];
			}
		}
		else
		{
			return -1;
		}
	}
	return $arr_return;
}
//--- Validacion
$valposic = explode(",", $arreglo_aux);
$numposic = count($valposic);
$idcon = fncconn();
$arrvalid = armaarreglo($plantacode, $idcon);
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
		$iRegservicioplanta["serplacodigo"] = $serplacodigo;
		$iRegservicioplanta["plantacodigo"] = $plantacode;
		$iRegservicioplanta["servicicodigo"] = $valposic[$i];

		editaservicioplanta($iRegservicioplanta, $flageditarservicioplanta, $campnomb, $codigo);
	}
}
else
{
	if(!empty($arrinsert))
	{
		for($i=0; $i<count($arrinsert); $i++)
		{
			$iRegservicioplanta["serplacodigo"] = $serplacodigo;
			$iRegservicioplanta["plantacodigo"] = $plantacode;
			$iRegservicioplanta["servicicodigo"] = $arrinsert[$i];

			editaservicioplanta($iRegservicioplanta, $flageditarservicioplanta, $campnomb, $codigo);
		}
	}
	if(!empty($arrdelete))
	{
		$nuconn = fncconn();
		for($i=0; $i<count($arrdelete); $i++)
		{
			$sbregservicioplanta["serplacodigo"] = "";
			$sbregservicioplanta["plantacodigo"] = $plantacode;
			$sbregservicioplanta["servicicodigo"] = $arrdelete[$i];
			
			$resultado = dinamicscanservicioplanta($sbregservicioplanta, $nuconn);
			$arrservicioplanta = fncfetch($resultado, 0);
			$borrares = delrecordservicioplanta($arrservicioplanta["serplacodigo"], $nuconn);
		}
		fncclose($nuconn);
	}
	unset($sbregservicioplanta, $arrservicioplanta, $borrares);
}
fncclose($idcon);
?>