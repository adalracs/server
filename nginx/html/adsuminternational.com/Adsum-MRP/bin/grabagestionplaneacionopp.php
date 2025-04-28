<?php 
/*
-Todos los derechos reservados-
Propiedad intelectual de Adsum (c).
Funcion         : grabagestionplaneacionopp
Decripcion      : Valida la data a grabar y la lleva al paquete.
Parametros      : Descripicion
$iReggestionplaneacionopp         Arreglo de datos.
$flagnuevogestionplaneacionopp    Bandera de validaci�n
Retorno         :
true	= 1
false	= 0
Autor           : ariascos
Escrito con     : WAG Adsum versi�n 3.1.1
Fecha           : 18082004
Historial de modificaciones
| Fecha | Motivo				| Autor 	|
*/

include ( "../src/FunGen/fncnumprox.php");
include ( "../src/FunGen/fncnumact.php");
include ( "../def/tipocampo.php");
include ( "../src/FunPerPriNiv/pktblcampo.php");
include ( "../src/FunPerPriNiv/pktbltabla.php");
include ( "../src/FunGen/buscacaracter.php");
include ( "../src/FunGen/fncmsgerror.php");
include ( "../src/FunGen/fncnombexs.php");

function grabagestionplaneacionopp(&$iReggestionplaneacionopp,&$flagnuevogestionplaneacionopp,&$campnomb,$flagerror)
{
	$nuconn = fncconn();
	//	No utilice esta parte si va a utilizar la llave primaria como serial
	define("id",234);
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
		$nuresult = loadrecordgestionopp($nuidtemp,$nuconn);
		if($nuresult == e_empty)
		{
			$iReggestionplaneacionopp["gesoppcodigo"] = $nuidtemp;
		}
		$nuidtemp ++;
	}while ($nuresult != e_empty);

	//	No utilice esta parte si va a utilizar la llave primaria como serial

	if($iReggestionplaneacionopp){

		$iRegtabla["tablnomb"] = "gestionopp";
		$resulttabla = dinamicscantabla($iRegtabla,$nuconn);
		$num = fncnumreg($resulttabla);
		for($i=0;$i<$num;$i++)
		{
			$sbregtabla = fncfetch($resulttabla,$i);
			if($sbregtabla["tablnomb"] == "gestionopp")
			{
				$tablcodi=$sbregtabla['tablcodi'];
				break;
			}
		}

		$iRegCampo["tablcodi"]=$tablcodi;
		$resultcampo=dinamicscancampo($iRegCampo,$nuconn);
		$num = fncnumreg($resultcampo);
		$iReggestionplaneacionopp_b = $iReggestionplaneacionopp;

		while($elementos = each($iReggestionplaneacionopp)){

			$iRegCampo["campnomb"] = $elementos[0];
			$resultcampo = dinamicscancampo($iRegCampo,$nuconn);
			$num = fncnumreg($resultcampo);
			if($num>0){

				$sbregcampo = fncfetch($resultcampo,0);
				if($sbregcampo["campnomb"] == $elementos[0]){

					$respuesta = strcmp($sbregcampo["campnotnull"],"t");
					if($respuesta == 0){

						if($elementos[1] == ""){

							$campnomb[$elementos[0]] = 1;
							$flagnuevogestionplaneacionopp = 1;
							$flagerror = 1;
						}
					}
				}
			}
			
			$validar = buscacaracter($elementos[1]);

			if($validar == 1){

				$flagnuevogestionplaneacionopp = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;

			}
		
			
			$validresult = consulmetagestionopp($elementos[0],$elementos[1],$nuconn);

			if($validresult == 1){

				$flagnuevogestionplaneacionopp = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;
			}
			unset ($validresult);
			
		}
		
		if($flagerror == 1){

			fncmsgerror(errorIng);
			$flagnuevogestionplaneacionopp = 1;
		}

		if($flagerror != 1){

			$result = insrecordgestionopp($iReggestionplaneacionopp,$nuconn);
			
			if($result < 0 ){

				ob_end_clean();
				fncmsgerror(errorReg);
				$flagnuevogestionplaneacionopp=1;
			}

			if($result > 0){

				$nuresult1 = fncnumprox(id,$nuidtemp,$nuconn); 	//	No utilice esta parte si va a utilizar la llave primaria como serial //

    			$iRegop_opp["opestacodigo"] = $iReggestionplaneacionopp["opestacodigo"];
    			$iRegop_opp["ordoppcodigo"] = $iReggestionplaneacionopp["ordoppcodigo"];
    			uprecordop_estado($iRegop_opp,$nuconn);

    			fncmsgerror(grabaEx);
			}

			fncclose($nuconn);

		}

	}

}

$iReggestionplaneacionopp["gesoppcodigo"] = $gesoppcodigo;
$iReggestionplaneacionopp["ordoppcodigo"] = $ordoppcodigo;
$iReggestionplaneacionopp["opestacodigo"] = $opestacodigo;
$iReggestionplaneacionopp["gesoppfecha"] = date('Y-m-d');
$rwhora = getdate(time());
$hora = $rwhora["hours"] . ":" . $rwhora["minutes"] . ":" . $rwhora["seconds"];
$iReggestionplaneacionopp["gesopphora"] = $hora;
$iReggestionplaneacionopp["usuacodi"] = $usuacodi;
$iReggestionplaneacionopp["gesoppdescri"] = $gesoppdescri;
$iReggestionplaneacionopp["gesopptipo"] = 5;//gestion planeacion

$idcon = fncconn();

if(!$arrplaneacionopp){

	$campnomb["arrplaneacionopp"] = 1;
	$flagerror = 1;
	$flagnuevogestionplaneacionopp = 1;
}

if($arrplaneacionopp) $objsarrplaneacionopp = explode(",", $arrplaneacionopp); else unset($objsarrplaneacionopp);

for($a = 0; $a < count($objsarrplaneacionopp); $a++){

	$obj_consumo = "consumo_".$objsarrplaneacionopp[$a];

	if(validaint4($$obj_consumo) > 0 || !$$obj_consumo){
		$campnomb[$obj_consumo] = 1;
		$flagerror = 1;
		$flagnuevogestionplaneacionopp = 1;
	}
}

fncclose($idcon);

grabagestionplaneacionopp($iReggestionplaneacionopp,$flagnuevogestionplaneacionopp,$campnomb,$flagerror);

if(!$flagnuevogestionplaneacionopp){

	$idcon = fncconn();

	unset($nuidtemp, $nuresult);

	if($arrplaneacionopp) $objsarrplaneacionopp = explode(",", $arrplaneacionopp); else unset($objsarrplaneacionopp);

	if($objsarrplaneacionopp > 0){

		delrecordoppitemdesa($ordoppcodigo, $idcon);

		for($a = 0; $a < count($objsarrplaneacionopp); $a++){

			$obj_consumo = "consumo_".$objsarrplaneacionopp[$a];

			$nuidtemp = fncnumact(233,$idcon);
			do{
				$nuresult = loadrecordoppitemdesa($nuidtemp,$idcon);
				if($nuresult == e_empty){
					$iRegOppitemdesa["oppitecodigo"] = $nuidtemp;
				}
				$nuidtemp ++;
			}while ($nuresult != e_empty);

			$iRegOppitemdesa["ordoppcodigo"] = $ordoppcodigo;
			$iRegOppitemdesa["itedescodigo"] = $objsarrplaneacionopp[$a];
			$iRegOppitemdesa["oppitecantid"] = $$obj_consumo;

			if( insrecordoppitemdesa($iRegOppitemdesa, $idcon) > 0 ){

				$nuresult1 = fncnumprox(233, $nuidtemp, $idcon);
			}
		}

	}

 	fncclose($idcon);

 	echo '<script language="javascript">';
	echo '<!--//'."\n";
	echo 'location ="maestablgestionplaneacionopp.php?codigo='.$codigo.'&tipsolcodigo='.$tipsolcodigo.'&sourcetable=gestionplaneacionopp"';
	echo '//-->'."\n";
	echo '</script>';

}

?> 

