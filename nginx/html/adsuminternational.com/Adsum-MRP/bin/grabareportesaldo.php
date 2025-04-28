<?php 
/*
-Todos los derechos reservados-
Propiedad intelectual de Adsum (c).
Funcion         : grabasaldos
Decripcion      : Valida la data a grabar y la lleva al paquete.
Parametros      : Descripicion
$iRegsaldos         Arreglo de datos.
$flagnuevoreportesaldos    Bandera de validaci�n
Retorno         :
true	= 1
false	= 0
Autor           : ariascos
Escrito con     : WAG Adsum versi�n 3.1.1
Fecha           : 18082004
Historial de modificaciones
| Fecha | Motivo				| Autor 	|
*/

include ( "../src/FunPerPriNiv/pktblsaldo.php");
include ( "../src/FunPerPriNiv/pktblcampo.php");
include ( "../src/FunPerPriNiv/pktbltabla.php");
include ( "../src/FunGen/buscacaracter.php");
include ( "../src/FunGen/fncmsgerror.php");
include ( "../src/FunGen/fncnumprox.php");
include ( "../src/FunGen/fncnombexs.php");
include ( "../src/FunGen/fncnumact.php");
include ( "../def/tipocampo.php");

function grabasaldo(&$iRegsaldo,&$flagnuevoreportesaldo,&$campnomb)
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
			$iRegsaldo['saldocodigo'] = $nuidtemp; 
		} 
		$nuidtemp ++; 
	}while ($nuresult != e_empty); 

	//	No utilice esta parte si va a utilizar la llave primaria como serial

	if($iRegsaldo)
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
		$iRegsaldo_b = $iRegsaldo;

		while($elementos = each($iRegsaldo))
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
							$flagnuevoreportesaldo = 1;
							$flagerror = 1;
						}
					}
				}
			}
			
			$validar = buscacaracter($elementos[1]);

			if($validar == 1)
			{
				$flagnuevoreportesaldo = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;

			}
		
			
			$validresult = consulmetasaldo($elementos[0],$elementos[1],$nuconn);

			if($validresult == 1)
			{
				$flagnuevoreportesaldo = 1;
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
			$result = insrecordsaldo($iRegsaldo,$nuconn);
			
			if($result < 0 )
			{
				ob_end_clean();
				fncmsgerror(errorReg);
				$flagnuevoreportesaldo=1;
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

$iRegsaldo['itedescodigo'] = $itreportesaldo;
$iRegsaldo['estsalcodigo'] = $estsalcodigo;
$iRegsaldo['saldoubicaci'] = $saldoubicaci;
$iRegsaldo['saldoposicio'] = $saldoposicio;
$iRegsaldo['saldoformula'] = $saldoformula;
$iRegsaldo['saldocantkgs'] = $kgreportesaldo;
$iRegsaldo['saldocantmts'] = $mtreportesaldo;
$iRegsaldo['saldotipoinv'] = 1;//inventario
$iRegsaldo['lotecodigo'] = $ltreportesaldo;
$iRegsaldo['saldodescri'] = $saldodescri;

grabasaldo($iRegsaldo,$flagnuevoreportesaldo,$campnomb);

if(!$flagnuevoreportesaldo){

	$idcon = fncconn();


	$nuidtemp = fncnumact(303,$idcon);//id numerado tabla => saldoreporte

	do{ 
		$nuresult = loadrecordsaldoreporte($nuidtemp,$idcon); 

		if($nuresult == e_empty) {  
			$iRegsaldoreporte["salrepcodigo"] = $nuidtemp; 
		} 
		$nuidtemp ++; 
	}while ($nuresult != e_empty); 


	$iRegsaldoreporte["saldocodigo"] = $iRegsaldo["saldocodigo"];
	$iRegsaldoreporte["salrepidenti"] = $id;

	switch ($id) {

		case 1:
			$iRegsaldoreporte["reopmtcodigo_sl"] = $kyreportesaldo;
			$iRegsaldoreporte["reopmtcodigo_pn"] = null;
			$iRegsaldoreporte["reopmtcodigo_mt"] = null;
			break;
		case 2:
			$iRegsaldoreporte["reopmtcodigo_sl"] = null;
			$iRegsaldoreporte["reopmtcodigo_pn"] = $kyreportesaldo;
			$iRegsaldoreporte["reopmtcodigo_mt"] = null;
			break;
		case 3:
			$iRegsaldoreporte["reopmtcodigo_sl"] = null;
			$iRegsaldoreporte["reopmtcodigo_pn"] = null;
			$iRegsaldoreporte["reopmtcodigo_mt"] = $kyreportesaldo;
			break;
	}

	if( insrecordsaldoreporte($iRegsaldoreporte, $idcon) > 0){

		fncnumprox(303,$nuidtemp,$idcon);//id numerado tabla => saldoreporte
	}

	fncclose($idcon);
}

?> 
