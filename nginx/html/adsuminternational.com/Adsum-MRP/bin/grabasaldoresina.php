<?php 
/*
-Todos los derechos reservados-
Propiedad intelectual de Adsum (c).
Funcion         : grabasaldoresinas
Decripcion      : Valida la data a grabar y la lleva al paquete.
Parametros      : Descripicion
$iRegsaldoresinas         Arreglo de datos.
$flagnuevosaldoresinas    Bandera de validaci�n
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
include ( '../src/FunPerPriNiv/pktblsaldo.php');
include ( '../src/FunPerPriNiv/pktblitemdesa.php');
include ( '../src/FunPerPriNiv/pktblcampo.php');
include ( '../src/FunPerPriNiv/pktbltabla.php');
include ( '../src/FunGen/buscacaracter.php');
include ( '../src/FunGen/fncmsgerror.php');
include( '../src/FunGen/fncnombexs.php');

function grabasaldoresina($iRegsaldoresina,&$flagnuevosaldoresina,&$campnomb)
{
	$nuconn = fncconn();
	//	No utilice esta parte si va a utilizar la llave primaria como serial
	define("id",235);
	define("errorReg",1);
	define("errorCar",2);
	define("grabaEx",3);
	define("compinst",4);
	define("venccomp",5);
	define("compactu",6);
	define("fecvalid",7);
	define("errormail",8);
	define("editaEx",9);
	define("errorIng",35);

	$nuidtemp = fncnumact(id,$nuconn); 
	do 
	{ 
		$nuresult = loadrecordsaldo($nuidtemp,$nuconn); 
		if($nuresult == e_empty) 
		{  
			$iRegsaldoresina['saldocodigo'] = $nuidtemp; 
		} 
		$nuidtemp ++; 
	}while ($nuresult != e_empty); 

	//	No utilice esta parte si va a utilizar la llave primaria como serial

	if($iRegsaldoresina)
	{
		$iRegtabla["tablnomb"] = "saldo";
		$resulttabla = dinamicscantabla($iRegtabla,$nuconn);
		$num = fncnumreg($resulttabla);
		for($i=0;$i<$num;$i++)
		{
			$sbregtabla = fncfetch($resulttabla,$i);
			if($sbregtabla['tablnomb'] == "saldo")
			{
				$tablcodi=$sbregtabla['tablcodi'];
				break;
			}
		}

		$iRegCampo["tablcodi"]=$tablcodi;
		$resultcampo=dinamicscancampo($iRegCampo,$nuconn);
		$num = fncnumreg($resultcampo);
		$iRegsaldoresina_b = $iRegsaldoresina;

		while($elementos = each($iRegsaldoresina))
		{
			$iRegCampo["campnomb"] = $elementos[0];
			$resultcampo = dinamicscancampo($iRegCampo,$nuconn);
			$num = fncnumreg($resultcampo);
			if($num>0)
			{
				$sbregcampo = fncfetch($resultcampo,0);
				if($sbregcampo["campnomb"] == $elementos[0])
				{
					$respuesta = strcmp($sbregcampo["campnotnull"],"t");
					if($respuesta == 0)
					{
						if($elementos[1] == "")
						{
							$campnomb[$elementos[0]] = 1;
							$flagnuevosaldoresina = 1;
							$flagerror = 1;
						}
					}
				}
			}
			
			$validar = buscacaracter($elementos[1]);

			if($validar == 1)
			{
				$flagnuevosaldoresina = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;

			}
		
			
			$validresult = consulmetasaldo($elementos[0],$elementos[1],$nuconn);

			if($validresult == 1)
			{
				$flagnuevosaldoresina = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;
			}
			
			unset ($validresult);
		}
		

		if($flagerror == 1)
		{
			fncmsgerror(errorIng);
		}

		if($flagerror != 1)
		{
			$result = insrecordsaldo($iRegsaldoresina,$nuconn);
			
			if($result < 0 )
			{
				ob_end_clean();
				fncmsgerror(errorReg);
				$flagnuevosaldoresina=1;
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

//$rwTipoEstadoSaldo = loadrecordtipoestadosaldo1(1,$idcon);//tipo 1 estados disponibles

$iRegsaldoresina['itedescodigo'] = $itedescodigo;
$iRegsaldoresina['estsalcodigo'] = $estsalcodigo;
$iRegsaldoresina['saldoubicaci'] = "Saldo Resina";
$iRegsaldoresina['saldoposicio'] = "Saldo Resina";
$iRegsaldoresina['saldoformula'] = "Saldo Resina";
$iRegsaldoresina['saldocantkgs'] = $saldocantkgs;
$iRegsaldoresina['saldocantmts'] = 1;
$iRegsaldoresina['saldotipoinv'] = 2;//inventario de saldo {Resinas}
$iRegsaldoresina['lotecodigo'] = $lotecodigo;
$iRegsaldoresina['saldodescri'] = $saldodescri;

grabasaldoresina($iRegsaldoresina,$flagnuevosaldoresina,$campnomb);

?> 
