<?php 
/*
-Todos los derechos reservados-
Propiedad intelectual de Adsum (c).
Funcion         : grabagestionnoconformeppr
Decripcion      : Valida la data a grabar y la lleva al paquete.
Parametros      : Descripicion
$iRegproveedo         Arreglo de datos.
$flagnuevogestionnoconformeppr    Bandera de validaci�n
Retorno         :
true	= 1
false	= 0
Autor           : ariascos
Escrito con     : WAG Adsum versi�n 3.1.1
Fecha           : 18082004
Historial de modificaciones
| Fecha | Motivo				| Autor 	|
*/

include ( '../src/FunPerPriNiv/pktblgestionnoconformeppr.php');
include ( '../src/FunPerPriNiv/pktblcausanoconformeppr.php'); 
include ( '../src/FunPerPriNiv/pktbltabla.php');
include ( '../src/FunPerPriNiv/pktblcampo.php');
include ( '../src/FunGen/buscacaracter.php');
include ( '../src/FunGen/fncmsgerror.php');
include ( '../src/FunGen/fncnumprox.php');
include ( '../src/FunGen/fncnumact.php');
include ( '../src/FunGen/fncnombexs.php');
include ( '../def/tipocampo.php');

function grabagestionnoconformeppr(&$iReggestionnoconformeppr,&$flagnuevogestionnoconformeppr,&$campnomb,$flagerror)
{
	$nuconn = fncconn();
	//	No utilice esta parte si va a utilizar la llave primaria como serial
	define("id",292);
	define("errorReg",1);
	define("errorCar",2);
	define("grabaEx",3);
	define("compinst",4);
	define("venccomp",5);
	define("compactu",6);
	define("fecvalid",7);
	define("errormail",8);
	define("editaEx",9);
	define("errorNombExs",18);
	define("errorIng",35);
	
	$nuidtemp = fncnumact(id,$nuconn);
	do
	{
		$nuresult = loadrecordgestionnoconformeppr($nuidtemp,$nuconn);
		if($nuresult == e_empty)
		{
			$iReggestionnoconformeppr[gesnoccodigo] = $nuidtemp;
			$analiscodi=$nuidtemp;
		}
		$nuidtemp ++;
	}while ($nuresult != e_empty);
	//$nuresult1 = fncnumprox(id,$nuidtemp,$nuconn);
	//	No utilice esta parte si va a utilizar la llave primaria como serial
	
		
	if($iReggestionnoconformeppr)
	{
		$iRegtabla["tablnomb"] = "gestionnoconformeppr";
		$resulttabla = dinamicscantabla($iRegtabla,$nuconn);
		$num = fncnumreg($resulttabla);
		for($i=0;$i<$num;$i++)
		{
			$sbregtabla = fncfetch($resulttabla,$i);
			if($sbregtabla[tablnomb] == "gestionnoconformeppr")
			{
				$tablcodi=$sbregtabla['tablcodi'];
				break;
			}
		}

		$iRegCampo["tablcodi"]=$tablcodi;

		$resultcampo=dinamicscancampo($iRegCampo,$nuconn);
		$num = fncnumreg($resultcampo);
		
		while($elementos = each($iReggestionnoconformeppr))
		{

			$iRegCampo["campnomb"] = $elementos[0];
			$resultcampo = dinamicscancampo($iRegCampo,$nuconn);
			$num = fncnumreg($resultcampo);

			if($num>0)
			{
				$sbregcampo = fncfetch($resultcampo,0);
				if($elementos[0] != 'gesnoccodigo')
				{

					if($sbregcampo["campnomb"] == $elementos[0])
					{
						$respuesta = strcmp($sbregcampo["campnotnull"],"t");
						if($respuesta == 0)
						{
							if($elementos[1] == "")
							{

								$campnomb[$elementos[0]] = 1;
								$flagnuevogestionnoconformeppr = 1;
								$flagerror = 1;
							}
						}
					}
				}
			}
			$validar = buscacaracter($elementos[1]);

			if($validar == 1)
			{

				$flagnuevogestionnoconformeppr = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;
			}
			$validresult = consulmetagestionnoconformeppr($elementos[0],$elementos[1],$nuconn);

			if($validresult == 1)
			{
				
				$flagnuevogestionnoconformeppr = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;
				unset ($validresult);
			}

		}

		if($flagerror == 1)
		{
			fncmsgerror(errorIng);
		}

		if($flagerror != 1)
		{

			$result = insrecordgestionnoconformeppr($iReggestionnoconformeppr,$nuconn);
			if($result < 0 )
			{
				fncmsgerror(errorReg);
				$flagnuevogestionnoconformeppr=1;
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

$iReggestionnoconformeppr["gesnoccodigo"] = $gesnoccodigo;
$iReggestionnoconformeppr["nocomcodigo"] = $nocomcodigo;
$iReggestionnoconformeppr["gesnocfecha"] = date("Y-m-d");
$rwhora = getdate(time());
$hora = $rwhora["hours"] . ":" . $rwhora["minutes"] . ":" . $rwhora["seconds"];
$iReggestionnoconformeppr["gesnochora"] = $hora;
$iReggestionnoconformeppr["usuacodi"] = $usuacodi;
$iReggestionnoconformeppr["gesnocdescau"] = $gesnocdescau;
$iReggestionnoconformeppr["gesnocplaacc"] = $gesnocplaacc;
$iReggestionnoconformeppr["gesnocrespon"] = $gesnocrespon;
$iReggestionnoconformeppr["gesnocfecest"] = $gesnocfecest;

if(!$arrcausa){

	$flagerror = 1;
	$campnomb["arrcausa"] = 1;
	$flagnuevogestionnoconformeppr = 1;
}

grabagestionnoconformeppr($iReggestionnoconformeppr,$flagnuevogestionnoconformeppr,$campnomb,$flagerror);

if(!$flagnuevogestionnoconformeppr){

	$idcon = fncconn();

	if($arrcausa) $objsarrcausa = explode(",", $arrcausa); else unset($objsarrcausa);

	for($a = 0; $a < count($objsarrcausa); $a++){

		$iRegcausanoconformeppr["gesnoccodigo"] = $iReggestionnoconformeppr["gesnoccodigo"];
		$iRegcausanoconformeppr["causacodigo"] = $objsarrcausa[$a];

		insrecordcausanoconformeppr($iRegcausanoconformeppr,$idcon);

	}

	fncclose($idcon);

	echo '<script language="javascript">';
	echo '<!--//'."\n";
	echo 'location ="maestablgestionnoconformeppr.php?codigo='.$codigo.';"';
	echo '//-->'."\n";
	echo '</script>';

}

?> 
