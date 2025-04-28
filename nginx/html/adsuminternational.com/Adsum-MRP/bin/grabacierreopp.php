<?php 
/*
-Todos los derechos reservados-
Propiedad intelectual de Adsum (c).
Funcion         : grabacierreopp
Decripcion      : Valida la data a grabar y la lleva al paquete.
Parametros      : Descripicion
$iRegcierreopp         Arreglo de datos.
$flagnuevocierreopp    Bandera de validaci�n
Retorno         :
true	= 1
false	= 0
Autor           : ariascos
Escrito con     : WAG Adsum versi�n 3.1.1
Fecha           : 18082004
Historial de modificaciones
| Fecha | Motivo				| Autor 	|
*/

include_once ( '../src/FunGen/fncnumprox.php');
include_once ( '../src/FunGen/fncnumact.php');
include_once ( '../def/tipocampo.php');
include_once ( '../src/FunPerPriNiv/pktblcampo.php');
include_once ( '../src/FunPerPriNiv/pktbltabla.php');
include_once ( '../src/FunGen/buscacaracter.php');
include_once ( '../src/FunGen/fncmsgerror.php');
include_once( '../src/FunGen/fncnombexs.php');

function grabacierreopp(&$iRegcierreopp,&$flagnuevocierreopp,&$campnomb, $flagerror, $tipsolcodigo, $opestacodigo, $codigo){

	$nuconn = fncconn();
	//	No utilice esta parte si va a utilizar la llave primaria como serial
	define("id",250);
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
	do{

		$nuresult = loadrecordcierreopp($nuidtemp,$nuconn);

		if($nuresult == e_empty){
			$iRegcierreopp["cieoppcodigo"] = $nuidtemp;
		}

		$nuidtemp ++;
	}while ($nuresult != e_empty);

	//	No utilice esta parte si va a utilizar la llave primaria como serial

	if($iRegcierreopp)
	{
		$iRegtabla["tablnomb"] = "cierreopp";
		$resulttabla = dinamicscantabla($iRegtabla,$nuconn);
		$num = fncnumreg($resulttabla);
		for($i=0;$i<$num;$i++)
		{
			$sbregtabla = fncfetch($resulttabla,$i);
			if($sbregtabla["tablnomb"] == "cierreopp")
			{
				$tablcodi=$sbregtabla['tablcodi'];
				break;
			}
		}

		$iRegCampo["tablcodi"]=$tablcodi;
		$resultcampo=dinamicscancampo($iRegCampo,$nuconn);
		$num = fncnumreg($resultcampo);
		$iRegcierreopp_b = $iRegcierreopp;

		while($elementos = each($iRegcierreopp))
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
							$flagnuevocierreopp = 1;
							$flagerror = 1;
						}
					}
				}
			}
			
			$validar = buscacaracter($elementos[1]);

			if($validar == 1)
			{
				$flagnuevocierreopp = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;

			}
		
			
			$validresult = consulmetacierreopp($elementos[0],$elementos[1],$nuconn);

			if($validresult == 1)
			{
				$flagnuevocierreopp = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;
			}
			
			if($elementos[0]=='cieoppcodigo' && $elementos[1] && $validresult == 0)
			{
				$valcodi = loadrecordcierreopp($iRegcierreopp["cieoppcodigo"], $nuconn);
		
				if($valcodi > -3)
				{
					$flagnuevocierreopp = 1;
					$flagerror = 1;
					$campnomb["cieoppcodigo"] = 1;
					$campnomb["err"] = 'Codigo existente o invalido';
					unset ($valcodi);
				}
			}
			unset ($validresult);
		}
        
		if($flagerror == 1)
		{
			fncmsgerror(errorIng);
		}

		if($flagerror != 1)
		{
			$result = insrecordcierreopp($iRegcierreopp,$nuconn);
			
			if($result < 0 )
			{
				ob_end_clean();
				fncmsgerror(errorReg);
				$flagnuevocierreopp=1;
			}
			if($result > 0)
			{
				$nuresult1 = fncnumprox(id,$nuidtemp,$nuconn); 	//	No utilice esta parte si va a utilizar la llave primaria como serial //

    			$iRegop_opp["tipcumcodigo"] = $iRegcierreopp["tipcumcodigo"];
    			$iRegop_opp["ordoppcodigo"] = $iRegcierreopp["ordoppcodigo"];
    			$iRegop_opp["opestacodigo"] = $opestacodigo;
    			
    			uprecordop_estado($iRegop_opp,$nuconn);
    			fncmsgerror(grabaEx);

				echo '<script language="javascript">';
				echo '<!--//'."\n";
				echo 'location ="maestablreporteopp.php?codigo='.$codigo.'&tipsolcodigo='.$tipsolcodigo.'&sourcetable=reporteopp"';
				echo '//-->'."\n";
				echo '</script>';
			}
			fncclose($nuconn);
		}
	}
}

$iRegcierreopp["cieoppcodigo"] = $cieoppcodigo;
$iRegcierreopp["ordoppcodigo"] = $ordoppcodigo;
$iRegcierreopp["tipcumcodigo"] = $tipcumcodigo;
$iRegcierreopp["cieoppfecha"] = date('Y-m-d');
$rwhora = getdate(time());
$hora = $rwhora["hours"] . ":" . $rwhora["minutes"] . ":" . $rwhora["seconds"];
$iRegcierreopp["cieopphora"] = $hora;
$iRegcierreopp["usuacodi"] = $usuacodi;
$iRegcierreopp["cieoppdescri"] = $cieoppdescri;
$iRegcierreopp["cieopptipo"] = 1;//gestion

if($opestacodigo <= 0){

	$flagnuevocierreopp = 1;
	$flagerror = 1;
	$campnomb["opestacodigo"] = 1;
}

grabacierreopp($iRegcierreopp,$flagnuevocierreopp,$campnomb, $flagerror, $tipsolcodigo, $opestacodigo, $codigo);

?>