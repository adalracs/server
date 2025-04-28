<?php 
$idcon = fncconn();

$fecha_actual = date("d/m/Y");
// --------------------
(!empty($sistemcodigo)) ? $arrsistema  = loadrecordsistema($sistemcodigo, $idcon)  : $arrsistema = null;
(!empty($equipocodigo)) ? $arrequipo   = loadrecordequipo($equipocodigo, $idcon)   : $arrequipo = null;
(!empty($componcodigo)) ? $arrcomponen = loadrecordcomponen($componcodigo, $idcon) : $arrcomponen = null;
(!empty($tiptracodigo)) ? $arrtipotrab = loadrecordtipotrab($tiptracodigo, $idcon) : $arrtipotrab = null;
(!empty($tareacodigo))  ? $arrtarea    = loadrecordtarea($tareacodigo, $idcon)     : $arrtarea = null;
// --------------------
$sbregTareot['ordtracodigo'] = $codigoot;
$idresTareot = dinamicscantareot($sbregTareot, $idcon);

if (!is_numeric($idresTareot))
{
	$numRegTareot = fncnumreg($idresTareot);

	for ($i=0; $i<$numRegTareot; $i++)
	{
		$arrTareot = fncfetch($idresTareot, $i);

		if ($arrTareot['ordtracodigo'] == $sbregTareot['ordtracodigo'])
			break;
	}
}
$arrotestado = loadrecordotestado($otestacodigo, $idcon);
$arrplanta   = loadrecordplanta($plantacodigo, $idcon);
$arrtipomant = loadrecordtipomant($tipmancodigo, $idcon);
$arrpriorida = loadrecordpriorida($prioricodigo, $idcon);

// Uno o varios registros se reciben
$sbregTareotHerramie['tareotcodigo'] = $arrTareot['tareotcodigo'];
$idresTareotHerramie = dinamicscantareotherramie($sbregTareotHerramie, $idcon);

if (!is_numeric($idresTareotHerramie))
{
	$numTareotHerramie = fncnumreg($idresTareotHerramie);

	for ($i=0; $i<$numTareotHerramie; $i++)
	{
		$arrTareotHerramie = fncfetch($idresTareotHerramie, $i);

		if ($arrTareotHerramie['tareotcodigo'] == $sbregTareotHerramie['tareotcodigo'])
		{
			$sbregTransacHerramie = loadrecordtransacherramie($arrTareotHerramie['transhercodigo'], $idcon);
			$sbregHerramie = loadrecordherramie($sbregTransacHerramie['herramcodigo'], $idcon);
			// Matriz que almacena los codigos de cada herramienta, en conjunto
			// con los nombres y la respectiva cantidad seleccionada por el usuario
			$sbregHerramieCantid[] = $sbregHerramie['herramcodigo']."|".$sbregHerramie['herramnombre']." <B>({$sbregTransacHerramie['transhercanti']})</B>";
		}
	}
}
else
	$flagNoHerramie = true;
// $flagNoHerramie --> Indica la ausencia de HERRAMIENTAS

$sbregItemTareot['tareotcodigo'] = $arrTareot['tareotcodigo'];
$idresItemTareot = dinamicscanitemtareot($sbregItemTareot, $idcon);

if (!is_numeric($idresItemTareot))
{
	$numItemTareot = fncnumreg($idresItemTareot);

	for ($i=0; $i<$numItemTareot; $i++)
	{
		$arrItemTareot = fncfetch($idresItemTareot, $i);

		if ($arrItemTareot['tareotcodigo'] == $sbregItemTareot['tareotcodigo'])
		{
			$sbregTransacItem = loadrecordtransacitem($arrItemTareot['transitecodigo'], $idcon);
			$sbregItem = loadrecorditem($sbregTransacItem['itemcodigo'], $idcon);
			// Matriz que almacena los codigo de cada item, en conjunto
			// con los nombres y la respectiva cantidad seleccionada por el usuario
			$sbregItemCantid[] = $sbregItem['itemcodigo']."|".$sbregItem['itemnombre']." <B>({$sbregTransacItem['transitecantid']})</B>";
		}
	}
}
else
	$flagNoItem = true;
// $flagNoItem --> Indica la ausencia de ITEMS

$sbregUsuarioTareot['tareotcodigo'] = $arrTareot['tareotcodigo'];
$idresUsuarioTareot = dinamicscanusuariotareot($sbregUsuarioTareot, $idcon);

if (!is_numeric($idresUsuarioTareot))
{
	$numUsuarioTareot = fncnumreg($idresUsuarioTareot);

	for ($i=0; $i<$numUsuarioTareot; $i++)
	{
		$arrUsuarioTareot = fncfetch($idresUsuarioTareot, $i);

		if ($arrUsuarioTareot['tareotcodigo'] == $sbregUsuarioTareot['tareotcodigo'])
		{
			$arrUsuario = loadrecordusuario($arrUsuarioTareot['usuacodi'], $idcon);

			if ($arrUsuarioTareot['usutarlider'] == 't')
			{
				$arrUsuLider['usuacodi'] = $arrUsuario['usuacodi'];
				$arrUsuLider['usuanombre'] = $arrUsuario['usuanombre']." ".$arrUsuario['usuapriape']." ".$arrUsuario['usuasegape'];
			}
			else
				$arrUsuAux[] = $arrUsuario['usuacodi']."|".$arrUsuario['usuanombre']." ".$arrUsuario['usuapriape']." ".$arrUsuario['usuasegape'];
		}
	}
}
// Indica si existen AUXILIARES DE MANTENIMIENTO
if ((isset($arrUsuAux)) && (!empty($arrUsuAux)))
	$flagUsuAux = true;
// --------------------
fncconn($idcon);
?>