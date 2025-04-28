<?php 
/* 
-Todos los derechos reservados- 
Propiedad intelectual de Adsum (c). 
Funcion         : grabahorasextra
Decripcion      : Valida la data a grabar y la lleva al paquete. 
Parametros      : Descripicion 
    $iReghorasextra         Arreglo de datos. 
    $flagnuevohorasextra    Bandera de validaci�n 
Retorno         : 
		true	= 1 
		false	= 0 
Autor           : cbedoya
Escrito con     : WAG Adsum versi�n 3.1.1 
Fecha           : 30-November-2007
Historial de modificaciones 
| Fecha | Motivo				| Autor 	| 
*/ 
  
include ( '../src/FunGen/fncnumprox.php');
include ( '../src/FunGen/fncnumact.php');
include ( '../def/tipocampo.php');
include ( '../src/FunPerPriNiv/pktblhorasextra.php');
include ( '../src/FunPerPriNiv/pktblcampo.php');
include ( '../src/FunPerPriNiv/pktbltabla.php');
include ( '../src/FunGen/buscacaracter.php');
include ( '../src/FunGen/fncmsgerror.php');
include ( '../src/FunGen/fncnombexs.php');

//include ( '../src/FunGen/fncdatediff.php');
 
function grabahorasextra($iReghorasextra, $iReghorasextraAll, &$flagnuevohorasextra,&$campnomb,&$horextcode)
{ 
	$nuconn = fncconn(); 
	//	No utilice esta parte si va a utilizar la llave primaria como serial 
	define("id",104); 
	define("errorReg",1);
	define("errorCar",2);
	define("grabaEx",3);
	define("compinst",4);
	define("venccomp",5);
	define("errorNombExs",18);
	define("errorTimeValid",26);
	define("errorIng",35);
	
	$nuidtemp = fncnumact(	id,$nuconn); 
	do{ 
		$nuresult = loadrecordhorasextra($nuidtemp,$nuconn); 
		if($nuresult == e_empty):
			$iReghorasextra[horextcodigo] = $nuidtemp; 
		endif;
		$nuidtemp ++; 
	}while ($nuresult != e_empty); 
	//	No utilice esta parte si va a utilizar la llave primaria como serial
	
	if ($iReghorasextra)
	{ 
		$iRegtabla["tablnomb"] = "horasextra";
		$resulttabla = dinamicscantabla($iRegtabla,$nuconn);
		$num = fncnumreg($resulttabla);
		
		for($i = 0; $i < $num; $i++)
		{
			$sbregtabla = fncfetch($resulttabla,$i);
			
			if($sbregtabla[tablnomb] == "horasextra")
			{
				$tablcodi = $sbregtabla['tablcodi'];
				break;
			}
		}

		$iRegCampo["tablcodi"] = $tablcodi;
		$resultcampo = dinamicscancampo($iRegCampo,$nuconn);
		$num = fncnumreg($resultcampo);
		
		$iReghorasextra_to = $iReghorasextra; 
		
		while($elementos = each($iReghorasextra))
		{
		    $iRegCampo["campnomb"] = $elementos[0];
			$resultcampo = dinamicscancampo($iRegCampo,$nuconn);
			$num = fncnumreg($resultcampo);
			
			if($num>0)
			{
				$sbregcampo = fncfetch($resultcampo,0);
				
				if($elementos[0] != "horextcodigo")
				{
					if($sbregcampo["campnomb"] == $elementos[0])
					{
						$respuesta = strcmp($sbregcampo["campnotnull"],"t");
						
						if($respuesta == 0)
						{
							if($elementos[1] == "")
							{
								$campnomb[$elementos[0]] = 1;
								$flagnuevohorasextra = 1;
								$flagerror = 1;
							}
						}
					}
				}
			}
			$validar = buscacaracter($elementos[1]); 
			
			if($validar == 1)
			{ 
				$flagnuevohorasextra = 1; 
				$flagerror = 1; 
				$campnomb[$elementos[0]] = 1;
			}

			$validresult = consulmetahorasextra($elementos[0],$elementos[1],$nuconn); 
			
			if ($validresult == 1)
			{			
				$flagnuevohorasextra = 1; 
				$flagerror = 1; 
				$campnomb[$elementos[0]] = 1;
				unset ($validresult); 
			}
		}
		
//		if(datediff("n", $iReghorasextra['horextfecha'].' '.$iReghorasextra['horexthorini'], $iReghorasextra['horextfecha'].' '.$iReghorasextra['horexthorfin']) <= 0)
//		{
//			$flagnuevohorasextra = 1; 
//			$flagerror = 1; 
//			$campnomb['horexthorini'] = 1;
//			$campnomb['horexthorfin'] = 1;
//			fncmsgerror('errorTimeValid');
//		}
		
		if($flagerror == 1)
			fncmsgerror(errorIng);
		
		if($flagerror != 1)
		{ 
			for($a = 0; $a < count($iReghorasextraAll); $a++):
				$iReghorasextraAll[$a][horextcodigo] = $nuidtemp;
				$result = insrecordhorasextra($iReghorasextraAll[$a], $nuconn);
				$horextcode[$a] = $nuidtemp;
				$nuidtemp ++; 
			endfor;
				
			if($result < 0 )
			{ 
				ob_end_clean(); 
				fncmsgerror(errorReg); 
				$flagnuevohorasextra = 1; 
			} 
			if($result > 0)
			{ 
				$nuresult1 = fncnumprox(id,$nuidtemp,$nuconn); 	//	No utilice esta parte si va a utilizar la llave primaria como serial //
				fncmsgerror(grabaEx); 
			} 
			fncclose($nuconn); 
		} 
	} 
}

//$medini == 1 ? $horexthorini = date("H:i", strtotime($horini.':'.$minini.' am')) : $horexthorini = date("H:i", strtotime($horini.':'.$minini.' pm'));
//$medfin == 1 ? $horexthorfin = date("H:i", strtotime($horfin.':'.$minfin.' am')) : $horexthorfin = date("H:i", strtotime($horfin.':'.$minfin.' pm'));

if($asignar == 1):
	$iReghorasextra[0][horextcodigo] = $horextcodigo;
	$iReghorasextra[0][horextfecha] = $horextfecha; 
	$iReghorasextra[0][horexthorini] = $horexthorini; 
	$iReghorasextra[0][horexthorfin] = $horexthorfin; 
	$iReghorasextra[0][horextdescri] = $horextdescri; 
	$iReghorasextra[0][usuacodi] = $usuacodigo; 
else:
	if($arrlsttecnicoot)
		$arr_tec = explode(',', $arrlsttecnicoot);
	else
		$arr_tec = explode(',', $arrallsttecnicoot);
	
	for($a = 0; $a < count($arr_tec); $a++):
		$iReghorasextra[$a][horextcodigo] = $horextcodigo;
		$iReghorasextra[$a][horextfecha] = $horextfecha; 
		$iReghorasextra[$a][horexthorini] = $horexthorini; 
		$iReghorasextra[$a][horexthorfin] = $horexthorfin; 
		$iReghorasextra[$a][horextdescri] = $horextdescri; 
		$iReghorasextra[$a][usuacodi] = $arr_tec[$a];
	endfor;

endif;

grabahorasextra($iReghorasextra[0], $iReghorasextra, $flagnuevohorasextra,$campnomb,$horextcode);

if(!$flagnuevohorasextra)
{
	if($arrheots)
	{
		include_once '../src/FunPerPriNiv/pktblhoraextraot.php';
		$idcon = fncconn();
		
		$nuidtemp = fncnumact(107, $idcon); 
		do{ 
			$nuresult = loadrecordhoraextraotcod($nuidtemp, $idcon); 
			if($nuresult == -3)
				$hoexotcodigo = $nuidtemp; 
			$nuidtemp ++; 
		}while ($nuresult != -3); 
		
		$sub_arrots = explode(',', $arrheots);
		
		for($a = 0; $a < count($horextcode); $a++)
		{
			for($b = 0; $b < count($sub_arrots); $b++)
			{
				$iReghoraextraot['hoexotcodigo'] = $hoexotcodigo;
				$iReghoraextraot['ordtracodigo'] = $sub_arrots[$b];
				$iReghoraextraot['horextcodigo'] = $horextcode[$a];
				
				insrecordhoraextraot($iReghoraextraot, $idcon);
				
				$hoexotcodigo++;
			}
		}
		
		$nuresult1 = fncnumprox(107,$hoexotcodigo,$idcon);
		unset($arrheots);
	}
}