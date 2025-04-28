<?php 
/*
-Todos los derechos reservados-
Propiedad intelectual de Adsum (c).
Funcion         : editaempleadotareot
Decripcion      : Valida la data a editar y la lleva al paquete.
Parametros      : Descripicion
$iRegempleadotareot         Arreglo de datos.
$flageditarempleadotareot    Bandera de validaciï¿½n
Retorno         :
true	= 1
false	= 0
Autor           : ariascos
Escrito con     : WAG Adsum versiï¿½n 3.1.1
Fecha           : 18082004
Historial de modificaciones
| Fecha 		| Motivo									| Autor 	|
24-nov-2005		Implementacion al editar					 mstroh
18-ene-2005		Implementación a la versión 'desarrollo'
*/
include ( '../src/FunGen/fncnumprox.php');
include ( '../src/FunGen/fncnumact.php');

function editausuariotareot($iRegusuariotareot, &$flageditarusuariotareot , &$campnomb ,$flagins)
{
	$nuconn = fncconn();
	//	No utilice esta parte si va a utilizar la llave primaria como serial
	define("id_eut",52);
	define("errorReg",1);
	define("errorCar",2);
	define("editaEx",3);
	define("compinst",4);
	define("venccomp",5);
	define("compactu",6);
	define("fecvalid",7);
	define("errormail",8);
	define("editaEx",9);

	if ($flagins)
	{
		$nuidtemp = fncnumact(id_eut,$nuconn);
		do
		{
			$nuresult = loadrecordusuariotareot($nuidtemp,$nuconn);
			if($nuresult == e_empty)
			{
				$iRegusuariotareot[usutarcodigo] = $nuidtemp;
			}
			$nuidtemp ++;
		}while ($nuresult != e_empty);
	}

	if ($iRegusuariotareot)
	{
		if ($flagins)
		{
			$result = insrecordusuariotareot($iRegusuariotareot, $nuconn);
		}
		else
		{
			$result = uprecordusuariotareot($iRegusuariotareot, $nuconn);
		}
		if($result < 0 )
		{
			ob_end_clean();
			fncmsgerror(errorReg);
			$flageditarusuariotareot = 1;
		}
		if (($result > 0) && $flagins)
		{
			$nuresult1 = fncnumprox(id_eut, $nuidtemp, $nuconn);
		}
		fncclose($nuconn);
	}
}

function borrausrtareot($arrUsr, $regCode, $idConn)
{
	$result = loadrecordvalidausuariotareot($regCode, $idConn);
	$arrvalue = explode(",", $arrUsr);
	$num_arr = count($arrvalue);

	if ($result > 0)
	{
		$num = fncnumreg($result);

		if ($num == $num_arr)
		{
			for ($i = 0; $i < $num; $i++)
			{
				$sbregusrtareot = fncfetch($result, $i);
				$arrcmp[] = $sbregusrtareot["usuacodi"];
			}
			sort($arrcmp);
			sort($arrvalue);

			if ($arrcmp == $arrvalue)
			{
				return -1;
			}
		}

		for ($i = 0; $i < $num_arr; $i++)
		{
			$existe = false;

			for ($j = 0; $j < $num; $j++)
			{
				$response = fncfetch($result, $j);

				if ($arrvalue[$i] == $response["usuacodi"])
				{
					$existe = true;
				}
				else
				{
					$array_codes[] = $response["usutarcodigo"];
				}
			}
			if (!$existe)
			{
				$array_insert[] = $arrvalue[$i];
			}
			else
			{
				$array_delete[] = $arrvalue[$i];
			}
		}
	}

	if (isset($array_insert) && !isset($array_delete))
	{
		$res = delrecordusuariotareotaux($regCode, $array_delete, $idConn);
		return $array_insert;
	}

	if (isset($array_delete) && !isset($array_insert))
	{
		$res = delrecordusuariotareotaux($regCode, $array_delete, $idConn);
		return -1;
	}

	if (isset($array_insert) && isset($array_delete))
	{
		$res = delrecordusuariotareotaux($regCode, $array_delete, $idConn);
		return $array_insert;
	}

	if ($result < 0)
	{
		return $arrvalue;
	}
}
$idcon = fncconn();
$arrtmpusuariotar = loadrecordusuariotareot($usutarcodigo, $idcon);

if(!($arrtmpusuariotar['usuacodi'] == $empleacod))
{
	$flaginsert = false;
	$iRegusuariotareot[usutarcodigo] = $usutarcodigo;
	$iRegusuariotareot[usuacodi]     = $empleacod;
	$iRegusuariotareot[tareotcodigo] = $tareotcodigo;
	$iRegusuariotareot[usutarlider]  = 't';
	editausuariotareot($iRegusuariotareot, $flageditarusuariotareot, $campnomb, $flaginsert);
}
fncclose($idcon);
unset($arrtmpusuariotar);

if($arreglo_auxdef)
{
	$flaginsert = true;

	$idcon = fncconn();
	$arr_insert = borrausrtareot($arreglo_auxdef, $tareotcodigo, $idcon);
	$numposic = count($arr_insert);

	if (is_array($arr_insert))
	{
		for($i = 0; $i < $numposic; $i++)
		{
			$iRegusuariotareot[usutarcodigo] = $usutarcodigo;
			$iRegusuariotareot[usuacodi] 	 = $arr_insert[$i];
			$iRegusuariotareot[tareotcodigo] = $tareotcodigo;
			$iRegusuariotareot[usutarlider]  = 'f';
			editausuariotareot($iRegusuariotareot,$flageditarusuariotareot,$campnomb, $flaginsert);
		}
	}
	fncclose($idcon);
}
else
{
	$idcon = fncconn();
	$result = loadrecordvalidausuariotareot($tareotcodigo, $idcon);

	if ($result > 0)
	{
		$num = fncnumreg($result);

		for ($i = 0; $i < $num; $i++)
		{
			$arr_result = fncfetch($result, $i);
			delrecordusuariotareot($arr_result["usutarcodigo"], $idcon);
		}
	}
}
?>