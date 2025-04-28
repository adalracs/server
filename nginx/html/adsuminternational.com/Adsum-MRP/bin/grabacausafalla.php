<?php
/*
-Todos los derechos reservados-
Propiedad intelectual de Adsum (c).
Funcion         : grabacausa
Decripcion      : Valida la data a grabar y la lleva al paquete.
Parametros      : Descripicion
$iRegcausa         Arreglo de datos.
$flagnuevocausafalla    Bandera de validaci�n
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
include ( '../src/FunPerPriNiv/pktblcausafalla.php');
include ( '../src/FunPerPriNiv/pktblcampo.php');
include ( '../src/FunPerPriNiv/pktbltabla.php');
include ( '../src/FunGen/buscacaracter.php');
include ( '../src/FunGen/fncmsgerror.php');
include( '../src/FunGen/fncnombexs.php');

function grabacausafalla($iRegcausa,&$flagnuevocausafalla,&$campnomb)
{
	$nuconn = fncconn();
	//	No utilice esta parte si va a utilizar la llave primaria como serial
	define("id",100);
	define("errorReg",1);
	define("errorCar",2);
	define("grabaEx",3);
	define("compinst",4);
	define("venccomp",5);
	define("errorNombExs",18);
	define("errorIng",35);

	$nuidtemp = fncnumact(id,$nuconn);
	do
	{
		$nuresult = loadrecordcausafalla($nuidtemp,$nuconn);
		if($nuresult == e_empty)
		{
			$iRegcausa[caufallcodigo] = $nuidtemp;
			$codigo_causa=$iRegcausa[caufallcodigo];
		}
		$nuidtemp ++;
	}while ($nuresult != e_empty);
	//$nuresult1 = fncnumprox(id,$nuidtemp,$nuconn);
	//	No utilice esta parte si va a utilizar la llave primaria como serial

	if($iRegcausa)
	{
		$iRegtabla["tablnomb"] = "causafalla";
		$resulttabla = dinamicscantabla($iRegtabla,$nuconn);
		$num = fncnumreg($resulttabla);
		for($i=0;$i<$num;$i++)
		{
			$sbregtabla = fncfetch($resulttabla,$i);
			if($sbregtabla[tablnomb] == "causafalla")
			{
				$tablcodi=$sbregtabla['tablcodi'];
				break;
			}
		}
		$iRegCampo["tablcodi"]=$tablcodi;
		$resultcampo=dinamicscancampo($iRegCampo,$nuconn);
		$num = fncnumreg($resultcampo);

		while($elementos = each($iRegcausa))
		{
			$iRegCampo["campnomb"] = $elementos[0];
			$resultcampo = dinamicscancampo($iRegCampo,$nuconn);
			$num = fncnumreg($resultcampo);
			if($num>0)
			{
				$sbregcampo = fncfetch($resultcampo,0);
				if($elementos[0] != "caufallcodigo")
				{
					if($sbregcampo["campnomb"] == $elementos[0])
					{
						$respuesta = strcmp($sbregcampo["campnotnull"],"t");
						if($respuesta == 0)
						{
							if($elementos[1] == "")
							{
								$campnomb[$elementos[0]] = 1;
								$flagnuevocausafalla = 1;
								$flagerror = 1;
							}
						}
					}
				}
			}
			
			$validar = buscacaracter($elementos[1]);

			if($validar == 1)
			{
				$flagnuevocausafalla = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;
			}
			$validresult = consulmetacausafalla($elementos[0],$elementos[1],$nuconn);

			if($validresult == 1)
			{
				$flagnuevocausafalla = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;
				unset ($validresult);
			}

			if($elementos[0]=='caufallnombre')
			{
				if($elementos[1] != null)
				{
					$validnombre =  fncnombexs('causafalla',$iRegcausa,$elementos[0],$elementos[1],$nuconn);
					if ($validnombre == 1)
					{
						fncmsgerror(errorNombExs);
						$flagnuevocausafalla = 1;
						$flagerror = 1;
						$campnomb[$elementos[0]] = 1;
						unset ($validnombre);
					}
				}
				else
				{
					$flagnuevocausafalla = 1;
					$flagerror = 1;
					$campnomb[$elementos[0]] = 1;
				}
			}
		}

		if($flagerror == 1)
		{
			fncmsgerror(errorIng);
		}

		if($flagerror != 1)
		{
			$result = insrecordcausafalla($iRegcausa,$nuconn);
			if($result < 0 )
			{
				ob_end_clean();
				fncmsgerror(errorReg);
				$flagnuevocausafalla=1;
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
$iRegcausa[caufallcodigo] = $caufallcodigo;
$iRegcausa[caufallnombre] = $caufallnombre;
$iRegcausa[caufalldescri] = $caufalldescri;

grabacausafalla($iRegcausa,$flagnuevocausafalla,$campnomb);
?>