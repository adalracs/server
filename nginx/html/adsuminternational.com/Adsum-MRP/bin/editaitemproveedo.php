<?php
/*
-Todos los derechos reservados-
Propiedad intelectual de Adsum (c).
Funcion         : editaitemproveedo
Decripcion      :
Autor           : mstroh
Escrito con     : WAG Adsum versi�n 3.1.1
Fecha           : 28122005
Historial de modificaciones
| Fecha  | Motivo					| Autor 	|
*/
include ( '../src/FunGen/fncnumprox.php');
include ( '../src/FunGen/fncnumact.php');

function editaitemproveedo($iRegitemproveedo, &$flageditaritemproveedo, &$campnomb, &$codigo)
{
	$nuconn = fncconn();
	define("id_iteprovee", 79);
	define("errorReg",1);
	define("errorCar",2);
	define("grabaEx",3);
	define("compinst",4);
	define("venccomp",5);
	define("compactu",6);
	define("fecvalid",7);
	define("errormail",8);
	define("editaEx",9);

	$nuidtemp = fncnumact(id_iteprovee,$nuconn);
	do
	{
		$nuresult = loadrecorditemproveedo($nuidtemp,$nuconn);
		if($nuresult == e_empty)
		{
			$iRegitemproveedo["iteprocodigo"] = $nuidtemp;
		}
		$nuidtemp ++;
	}while ($nuresult != e_empty);

	$result = insrecorditemproveedo($iRegitemproveedo,$nuconn);

	if($result < 0 )
	{
		ob_end_clean();
		$flageditaritemproveedo = 1;
	}

	if($result > 0)
	{
		$nuresult1 = fncnumprox(id_iteprovee, $nuidtemp, $nuconn); 
		//No utilice esta parte si va a utilizar la llave primaria como serial//
	}
	fncclose($nuconn);
}
/*
-Todos los derechos reservados-
Propiedad intelectual de Adsum (c).
Funcion         : armaarreglo
Decripcion      :
Autor           : mstroh
Escrito con     : WAG Adsum versi�n 3.1.1
Fecha           : 15112004
Historial de modificaciones
| Fecha  | Motivo					| Autor 	|
*/
function armaarreglo($item, $idcon)
{
	if($idcon)
	{
		$flag = 0;
		$iRegitemproveedo["itemcodigo"] = $item;
		$nuresult = dinamicscanitemproveedo($iRegitemproveedo, $idcon);
			
		if(!is_numeric($nuresult))
		{
			$numreg = fncnumreg($nuresult);

			for($i=0; $i<$numreg; $i++)
			{
				$arritemproveedo = fncfetch($nuresult, $i);
				
				if($arritemproveedo["itemcodigo"] == $iRegitemproveedo["itemcodigo"])
				{					
					$arr_return[] = $arritemproveedo["proveecodigo"];
				}
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
$arrvalid = armaarreglo($itemcodigo, $idcon);
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
		$iRegitemproveedo["iteprocodigo"] = $iteprocodigo;
		$iRegitemproveedo["proveecodigo"] = $valposic[$i];
		$iRegitemproveedo["itemcodigo"]   = $itemcodigo;

		editaitemproveedo($iRegitemproveedo, $flageditaritemproveedo, $campnomb, $codigo);
	}
}
else
{
	if(!empty($arrinsert))
	{
		for($i=0; $i<count($arrinsert); $i++)
		{
			$iRegitemproveedo["iteprocodigo"] = $iteprocodigo;
			$iRegitemproveedo["proveecodigo"] = $arrinsert[$i];
			$iRegitemproveedo["itemcodigo"]   = $itemcodigo;

			editaitemproveedo($iRegitemproveedo, $flageditaritemproveedo, $campnomb, $codigo);
		}
	}
	if(!empty($arrdelete))
	{
		$nuconn = fncconn();
		
		for($i=0; $i<count($arrdelete); $i++)
		{
			$sbregitemproveedo["iteprocodigo"] = "";
			$sbregitemproveedo["proveecodigo"] = $arrdelete[$i];
			$sbregitemproveedo["itemcodigo"]   = $itemcodigo;
			
			$resultado = dinamicscanitemproveedo($sbregitemproveedo, $nuconn);
			$arritemproveedo = fncfetch($resultado, 0);

			if($arritemproveedo["itemcodigo"] == $sbregitemproveedo["itemcodigo"])
			{
				$borrares = delrecorditemproveedo($arritemproveedo["iteprocodigo"], $nuconn);
			}
		}
		fncclose($nuconn);
	}
	unset($sbregitemproveedo, $arritemproveedo, $borrares);
}
fncclose($idcon);
?>