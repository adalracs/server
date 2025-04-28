<?php 
/* 
-Todos los derechos reservados- 
Propiedad intelectual de Adsum (c). 
Funcion         : grabatareot 
Decripcion      : Valida la data a grabar y la lleva al paquete. 
Parametros      : Descripicion 
    $iRegtareot         Arreglo de datos. 
    $flagnuevotareot    Bandera de validaci�n 
Retorno         : 
		true	= 1 
		false	= 0 
Autor           : ariascos 
Escrito con     : WAG Adsum versi�n 3.1.1 
Fecha           : 18082004 
Historial de modificaciones 
| Fecha | Motivo				| Autor 	| 
19012005 Implementacion			jcortes
*/  
// $flagotinicial: Indica que el archivo ha sido incluido en grabaot.php
if(!$flagotinicial && !$flagreportot )
{
	include ( '../src/FunGen/fncnumprox.php');
	include ( '../src/FunGen/fncnumact.php');
	include ( '../def/tipocampo.php');
	include ( '../src/FunPerPriNiv/pktblcampo.php');
	include ( '../src/FunPerPriNiv/pktbltabla.php');
	include ( '../src/FunGen/buscacaracter.php');
	include ( '../src/FunGen/fncmsgerror.php');
	include ( '../src/FunPerPriNiv/pktbltransaction.php');

}
include ( '../src/FunPerPriNiv/pktbltareot.php'); 
include ( '../src/FunGen/fncconverttime.php');

function grabatareot($iRegtareot,&$flagnuevotareot,&$flagnuevoot,&$campnomb,&$codigotareot,$flagotinicial) 
{ 	
	
	$nuconn = fncconn(); 

	define("id_1",38); 
	define("errorReg",1); 
	define("errorCar",2); 
	define("grabaEx",3); 
	define("compinst",4); 
	define("venccomp",5); 
	define("compactu",6); 
	define("fecvalid",7); 
	define("errormail",8); 
	define("editaEx",9);
	define("errorIng", 35);
	
	$nuidtemp = fncnumact(id_1,$nuconn); 
	do 
	{ 
		$nuresult = loadrecordtareot($nuidtemp,$nuconn); 
		
		if($nuresult == e_empty) 
		{ 
			$iRegtareot[tareotcodigo] = $nuidtemp; 
			$codigotareot = $iRegtareot[tareotcodigo];
			
			
		} 
		$nuidtemp ++; 
	}while ($nuresult != e_empty); 

	if($flagotinicial)
	{
			
		$result = insrecordtareot($iRegtareot,$nuconn); 
		return $codigotareot;
		unset($flagotinicial);
		
		if($result < 0 ) 
		{ 
			//fncmsgerror(errorReg); 
			$flagnuevotareot=1; 
			$flagnuevoot = 1;
		} 
		
		if($result > 0)
		{ 
			$nuresult1 = fncnumprox(id_1,$nuidtemp,$nuconn); 	//	No utilice esta parte si va a utilizar la llave primaria como serial //
			$flagnuevotareot = null; 
			$flagnuevoot = null;
			
 			return  $codigotareot;
			unset($iRegtareot);
		} 
		fncclose($nuconn); 
	}
	else 
	{
		if($iRegtareot)
		{
			
			$iRegtabla["tablnomb"] = "tareot";
			$resulttabla = dinamicscantabla($iRegtabla,$nuconn);
			$num = fncnumreg($resulttabla);
			for($i=0;$i<$num;$i++)
			{
				$sbregtabla = fncfetch($resulttabla,$i);
				if($sbregtabla[tablnomb] == "tareot")
				{
					$tablcodi = $sbregtabla['tablcodi'];
					break;
				}
			}
	
			$iRegCampo["tablcodi"]=$tablcodi;
			$resultcampo=dinamicscancampo($iRegCampo,$nuconn);
			$num = fncnumreg($resultcampo);
	
			while($elementos = each($iRegtareot))
			{
				$iRegCampo["campnomb"] = $elementos[0];
				$resultcampo = dinamicscancampo($iRegCampo,$nuconn);
				$num = fncnumreg($resultcampo);
				if($num>0)
				{
					$sbregcampo = fncfetch($resultcampo,0);
					if($elementos[0] != "tareotcodigo")
					{
						if($sbregcampo["campnomb"] == $elementos[0])
						{
							$respuesta = strcmp($sbregcampo["campnotnull"],"t");
							if($respuesta == 0)
							{
								if($elementos[1] == "")
								{
									$campnomb[$elementos[0]] = 1;
									$flagnuevotareot = 1;
									$flagerror = 1;
								}
							}
						}
					}
				}
				$validar = buscacaracter($elementos[1]);
	
				if($validar == 1)
				{
					$flagnuevotareot = 1;
					$flagerror = 1;
					$campnomb[$elementos[0]] = 1;
					
				}
	
				if(($elementos[0] != "tareotfecfin") && ($elementos[0] != "tareotcodigo"))
				{
					$validresult = consulmetatareot($elementos[0],$elementos[1],$nuconn);
	              
					if($validresult == 1)
					{
						$flagnuevotareot = 1;
						$flagerror = 1;
						$campnomb[$elementos[0]] = 1;
						
						unset ($validresult);
					}
				}
			}
			if($flagerror == 1)
			{
				fncmsgerror(errorIng);
			}
			
			if($flagerror != 1)
			{
				$validtareot = settareot($iRegtareot, $nuconn);
				$result = insrecordtareot($iRegtareot,$nuconn);
		        	
				if($result < 0 )
				{
					ob_end_clean();
					fncmsgerror(errorReg);
					$flagnuevotareot = 1;
				}
				if($result > 0)
				{
					//No utilice esta parte si va a utilizar la llave primaria como serial
					$nuresult1 = fncnumprox(id_1,$nuidtemp,$nuconn);
					return $iRegtareot[tareotcodigo];
					unset($iRegtareot);
					//fncmsgerror(grabaEx);
				}
				fncclose($nuconn);
			}
		}
	} 
} 

/*
-Todos los derechos reservados-
Propiedad intelectual de Adsum (c).
Funcion         : settareot
Decripcion      : Genera la secuencia (tareotsecuen) y actualiza las respectivas fechas en los registros previos de tareot
de tareot que coinciden con los parametros
Parametros      : Descripicion
$arr         	: Arreglo de datos.
$idcon    		: ID de conexion
Retorno         :
true	= 1
false	= 0
Autor           : mstroh
Fecha           : 05012006
Historial de modificaciones
| Fecha 	| Motivo				| Autor 	|
*/
function settareot(&$arr, $idcon)
{
	
	$iRegvalida['ordtracodigo'] = $arr['ordtracodigo'];
	$ccount = 0;

	$idres = dinamicscantareot($iRegvalida, $idcon);

	if(!is_numeric($idres))
	{
		$num = fncnumreg($idres);

		for($i=0; $i<$num; $i++)
		{
			$arrtareot = fncfetch($idres, $i);

			if($arrtareot['ordtracodigo'] == $iRegvalida['ordtracodigo'])
			{
				if($ccount == 0)
				{
					$maxsecuen = $arrtareot['tareotsecuen'];
					$maxseccod = $arrtareot['tareotcodigo'];
				}
				else
				{
					if($arrtareot['tareotsecuen'] > $maxsecuen)
					{
						$maxsecuen = $arrtareot['tareotsecuen'];
						$maxseccod = $arrtareot['tareotcodigo'];
					}
				}
			}
			$arr['tareotsecuen'] = ($maxsecuen + 1);

			// Actualizo el registro anterior
			$arrupdate = loadrecordtareot($maxseccod, $idcon);
           
			$arrupdate['tareothorfin'] = $arr['tareothorini'];
			$arrupdate['tareotfecfin'] = $arr['tareotfecini'];

			$result = uprecordtareot($arrupdate, $idcon);
			
			// --
			$ccount++;
		}
		unset($arrupdate);
	}
}


?>