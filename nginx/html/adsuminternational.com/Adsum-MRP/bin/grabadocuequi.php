<?php 
/*
-Todos los derechos reservados-
Propiedad intelectual de Adsum (c).
Funcion         : grabadocuequi
Decripcion      : Valida la data a grabar y la lleva al paquete.
Parametros      : Descripicion
$iRegdocuequi         Arreglo de datos.
$flagnuevodocuequi    Bandera de validaci�n
Retorno         :
true	= 1
false	= 0
Autor           : ariascos
Escrito con     : WAG Adsum versi�n 3.1.1
Fecha           : 18082004
Historial de modificaciones
| Fecha | Motivo				| Autor 	|
*/

include ( '../src/FunGen/fncnumprox.php');
include ( '../src/FunGen/fncnumact.php');
include ( '../def/tipocampo.php');
include ( '../src/FunPerPriNiv/pktbldocuequi.php');
include ( '../src/FunPerPriNiv/pktblcampo.php');
include ( '../src/FunPerPriNiv/pktbltabla.php');
include ( '../src/FunGen/buscacaracter.php');
include ( '../src/FunGen/fncmsgerror.php');
include ( '../src/FunGen/fncnombexs.php');

function grabadocuequi($iRegdocuequi,&$flagnuevodocuequi,&$campnomb)
{
	$nuconn = fncconn();
	//	No utilice esta parte si va a utilizar la llave primaria como serial
	define("id",31);
	define("errorReg",1);
	define("errorCar",2);
	define("grabaEx",3);
	define("compinst",4);
	define("venccomp",5);
	define("compactu",6);
	define("fecvalid",7);
	define("errormail",8);
	define("editaEx",9);
	define("errorPlnExs",30);
	define("errorNoDoc",31);
	define("errorIng",35);
	
	$nuidtemp = fncnumact(	id,$nuconn);
	do
	{
		$nuresult = loadrecorddocuequi($nuidtemp,$nuconn);
		if($nuresult == e_empty)
		{
			$iRegdocuequi[docequcodigo] = $nuidtemp;
		}
		$nuidtemp ++;
	}while ($nuresult != e_empty);
	//$nuresult1 = fncnumprox(id,$nuidtemp,$nuconn);
	//	No utilice esta parte si va a utilizar la llave primaria como serial
			
	if($iRegdocuequi)
	{
		$iRegtabla["tablnomb"] = "docuequi";
		$resulttabla = dinamicscantabla($iRegtabla,$nuconn);
		$num = fncnumreg($resulttabla);
		for($i=0;$i<$num;$i++)
		{
			$sbregtabla = fncfetch($resulttabla,$i);
			if($sbregtabla[tablnomb] == "docuequi")
			{
				$tablcodi=$sbregtabla['tablcodi'];
				break;
			}
		}

		$iRegCampo["tablcodi"]=$tablcodi;
		$resultcampo=dinamicscancampo($iRegCampo,$nuconn);
		$num = fncnumreg($resultcampo);
		
		while($elementos = each($iRegdocuequi))
		{
			$iRegCampo["campnomb"] = $elementos[0];
			$resultcampo = dinamicscancampo($iRegCampo,$nuconn);
			$num = fncnumreg($resultcampo);
			if($num>0)
			{
				$sbregcampo = fncfetch($resultcampo,0);
				if($elementos[0] != "docequcodigo")
				{
					if($sbregcampo["campnomb"] == $elementos[0])
					{
						$respuesta = strcmp($sbregcampo["campnotnull"],"t");
						if($respuesta == 0)
						{
							if($elementos[1] == "")
							{
								$campnomb[$elementos[0]] = 1;
								$flagnuevodocuequi = 1;
								$flagerror = 1;
							}
						}
					}
				}
			}
			$validar = buscacaracter($elementos[1]);

			if($validar == 1)
			{
				$flagnuevodocuequi = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;
			}
			$validresult = consulmetadocuequi($elementos[0],$elementos[1],$nuconn);

			if($validresult == 1)
			{
				$flagnuevodocuequi = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;
				unset ($validresult);
			}
			
			if($elementos[0] == "equipocodigo" and $elementos[1] == null)
			{
				$flagnuevodocuequi = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;
			}
			
			if($elementos[0] == "planocodigo" and $elementos[1] != null)
			{
				$keyArray = array($elementos[0], "equipocodigo");
				$valueArray = array($elementos[1], $iRegdocuequi["equipocodigo"]);
				$validnombre =  fncnombexs('docuequi',$iRegdocuequi,$keyArray,$valueArray,$nuconn);
				if ($validnombre == 1)
				{
					fncmsgerror(errorPlnExs);
					$flagnuevodocuequi = 1;
					$flagerror = 1;
					$campnomb[$elementos[0]] = 1;
					unset ($validnombre);
				}
			}
			
			if($elementos[0] == "manualcodigo" and $elementos[1] != null)
			{
				$keyArray = array($elementos[0], "equipocodigo");
				$valueArray = array($elementos[1], $iRegdocuequi["equipocodigo"]);
				$validnombre =  fncnombexs('docuequi',$iRegdocuequi,$keyArray,$valueArray,$nuconn);
				if ($validnombre == 1)
				{
					fncmsgerror(errorPlnExs);
					$flagnuevodocuequi = 1;
					$flagerror = 1;
					$campnomb = $elementos[0];
					unset ($validnombre);
				}
			}
			if($iRegdocuequi["planocodigo"] == null and $iRegdocuequi["manualcodigo"] == null)
			{
//				fncmsgerror(errorNoDoc);
				$flagnuevodocuequi = 1;
				$campnomb["planocodigo"] = 1;
				$campnomb["planocodigo"] = 1;
				$flagerror = 1;
			}
		}
		
		if($flagerror == 1)
		{
			fncmsgerror(errorIng);
		}

		if($flagerror != 1)
		{
			$result = insrecorddocuequi($iRegdocuequi,$nuconn);
			if($result < 0 )
			{
				ob_end_clean();
				fncmsgerror(errorReg);
				$flagnuevodocuequi=1;
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
$iRegdocuequi[docequcodigo] = $docequcodigo;
$iRegdocuequi[equipocodigo] = $equipocodigo;
$iRegdocuequi[planocodigo] = $planocodigo;
$iRegdocuequi[manualcodigo] = $manualcodigo;
grabadocuequi($iRegdocuequi,$flagnuevodocuequi,$campnomb);
?> 
