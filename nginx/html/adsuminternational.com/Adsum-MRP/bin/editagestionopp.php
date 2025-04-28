<?php 

/*
-Todos los derechos reservados-
Propiedad intelectual de Adsum (c).
Funcion         : editagestionopp
Decripcion      : Valida la data a grabar y la lleva al paquete.
Parametros      : Descripicion
$iReggestionopp         Arreglo de datos.
$flageditargestionopp    Bandera de validaci�n
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
include ( '../src/FunPerPriNiv/pktblcampo.php');
include ( '../src/FunPerPriNiv/pktbltabla.php');
include ( '../src/FunGen/buscacaracter.php');
include ( '../src/FunGen/fncmsgerror.php');
include( '../src/FunGen/fncnombexs.php');


function editagestionopp(&$iReggestionopp,&$flageditargestionopp,&$campnomb,$flagerror)
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
			$iReggestionopp["gesoppcodigo"] = $nuidtemp;
		}
		$nuidtemp ++;
	}while ($nuresult != e_empty);

	//	No utilice esta parte si va a utilizar la llave primaria como serial

	if($iReggestionopp)
	{
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
		$iReggestionopp_b = $iReggestionopp;

		while($elementos = each($iReggestionopp))
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
							$flageditargestionopp = 1;
							$flagerror = 1;
						}
					}
				}
			}
			
			$validar = buscacaracter($elementos[1]);

			if($validar == 1)
			{
				$flageditargestionopp = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;

			}
		
			
			$validresult = consulmetagestionopp($elementos[0],$elementos[1],$nuconn);

			if($validresult == 1)
			{
				$flageditargestionopp = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;
			}
			
			if($elementos[0]=='gesoppcodigo' && $elementos[1] && $validresult == 0)
			{
				$valcodi = loadrecordgestionopp($iReggestionopp["gesoppcodigo"], $nuconn);
		
				if($valcodi > -3)
				{
					$flageditargestionopp = 1;
					$flagerror = 1;
					$campnomb["gesoppcodigo"] = 1;
					$campnomb["err"] = 'Codigo existente o invalido';
					unset ($valcodi);
				}
			}
			
			unset ($validresult);
			
		}
		

		if($flagerror == 1)
		{
			fncmsgerror(errorIng);
			$flageditargestionopp = 1;
		}

		if($flagerror != 1)
		{
			$result = insrecordgestionopp($iReggestionopp,$nuconn);
			
			if($result < 0 )
			{
				ob_end_clean();
				fncmsgerror(errorReg);
				$flageditargestionopp=1;
			}
			if($result > 0)
			{
				$nuresult1 = fncnumprox(id,$nuidtemp,$nuconn); 	//	No utilice esta parte si va a utilizar la llave primaria como serial //

				$iRegop_opp["opestacodigo"] = $iReggestionopp["opestacodigo"];
    			$iRegop_opp["ordoppcodigo"] = $iReggestionopp["ordoppcodigo"];
    			uprecordop_estado($iRegop_opp,$nuconn);

			}
			fncclose($nuconn);
		}
		
	}

}


$iReggestionopp["gesoppcodigo"] = $gesoppcodigo;
$iReggestionopp["ordoppcodigo"] = $ordoppcodigo;
$iReggestionopp["opestacodigo"] = $opestacodigo;
$iReggestionopp["gesoppfecha"] = date('Y-m-d');
$rwhora = getdate(time());
$hora = $rwhora["hours"] . ":" . $rwhora["minutes"] . ":" . $rwhora["seconds"];
$iReggestionopp["gesopphora"] = $hora;
$iReggestionopp["usuacodi"] = $usuacodi;
$iReggestionopp["gesoppdescri"] = $gesoppdescri;
$iReggestionopp["gesopptipo"] = 4;//gestion de recepcion

if(!$arrgestionoppreporte && !$arrgestionoppreporterch){

	$flageditargestionopp = 1;
	$flagerror = 1;
	$campnomb["arrgestionoppreporte"] = 1;
}

editagestionopp($iReggestionopp,$flageditargestionopp,$campnomb,$flagerror);

if(!$flageditargestionopp){

	$idcon = fncconn();

	if($arrgestionoppreporte) $arrobjsarrgestionoppreporte = explode(":|:", $arrgestionoppreporte); else unset($arrobjsarrgestionoppreporte);

	for($a =0; $a < count($arrobjsarrgestionoppreporte); $a++){

		$rowarrgestionoppreporte = explode(":-:", $arrobjsarrgestionoppreporte[$a]);
		unset($iReggestionoppreporte);

		if($rowarrgestionoppreporte[1] == "t"){

			$iReggestionoppreportesaldo["geoprecodigo"] = $rowarrgestionoppreporte[0];
			$iReggestionoppreportesaldo["geopreestado"] = $rowarrgestionoppreporte[2];
			
			uprecordgestionoppreportesaldo($iReggestionoppreportesaldo,$idcon);

		}elseif($rowarrgestionoppreporte[1] == "f"){

			$iReggestionoppreporte["geoprecodigo"] = $rowarrgestionoppreporte[0];
			$iReggestionoppreporte["geopreestado"] = $rowarrgestionoppreporte[2];

			uprecordgestionoppreporte1($iReggestionoppreporte,$idcon);

		}
		

	}


	if($arrgestionoppreporterch) $arrobjsgestionoppreporterch = explode(":|:", $arrgestionoppreporterch); else unset($arrobjsgestionoppreporterch);

	for($a =0; $a < count($arrobjsgestionoppreporterch); $a++){

		$rowarrgestionoppreporterch = explode(":-:", $arrobjsgestionoppreporterch[$a]);
		unset($iReggestionoppreporte);

		if($rowarrgestionoppreporterch[1] == "t"){

			$iReggestionoppreportesaldo["geoprecodigo"] = $rowarrgestionoppreporterch[0];
			$iReggestionoppreportesaldo["geopreestado"] = $rowarrgestionoppreporterch[2];
			
			uprecordgestionoppreportesaldo($iReggestionoppreportesaldo,$idcon);

		}elseif($rowarrgestionoppreporterch[1] == "f"){

			$iReggestionoppreporte["geoprecodigo"] = $rowarrgestionoppreporterch[0];
			$iReggestionoppreporte["geopreestado"] = $rowarrgestionoppreporterch[2];

			uprecordgestionoppreporte1($iReggestionoppreporte,$idcon);

		}
		

	}

	fncclose($idcon);

	//mensaje de grabado exitoso
	fncmsgerror(grabaEx);
	echo '<script language="javascript">';
	echo '<!--//'."\n";
	echo 'location ="maestablgestionopp.php?codigo='.$codigo.';"';
	echo '//-->'."\n";
	echo '</script>';
}
			