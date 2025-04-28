<?php 
/*
-Todos los derechos reservados-
Propiedad intelectual de Adsum (c).
Funcion         : grabanoconformepr
Decripcion      : Valida la data a grabar y la lleva al paquete.
Parametros      : Descripicion
$iRegproveedo         Arreglo de datos.
$flagnuevonoconformepr    Bandera de validaci�n
Retorno         :
true	= 1
false	= 0
Autor           : ariascos
Escrito con     : WAG Adsum versi�n 3.1.1
Fecha           : 18082004
Historial de modificaciones
| Fecha | Motivo				| Autor 	|
*/
include_once ( '../src/FunPerPriNiv/pktblanalisispr.php');
include ( '../src/FunPerPriNiv/pktblnoconformepr.php');
include ( '../src/FunPerPriNiv/pktbltabla.php');
include ( '../src/FunPerPriNiv/pktblcampo.php');
include ( '../src/FunGen/buscacaracter.php');
include ( '../src/FunGen/fncmsgerror.php');
include ( '../src/FunGen/fncnumprox.php');
include ( '../src/FunGen/fncnumact.php');
include ( '../src/FunGen/fncnombexs.php');
include ( '../def/tipocampo.php');

function grabanoconformepr($iRegnoconformepr,&$flagnuevonoconformepr,&$campnomb,$flagerror)
{
	$nuconn = fncconn();
	//	No utilice esta parte si va a utilizar la llave primaria como serial
	define("id",290);
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
		$nuresult = loadrecordnoconformepr($nuidtemp,$nuconn);
		if($nuresult == e_empty)
		{
			$iRegnoconformepr[nocomcodigo] = $nuidtemp;
			$analiscodi=$nuidtemp;
		}
		$nuidtemp ++;
	}while ($nuresult != e_empty);
	//$nuresult1 = fncnumprox(id,$nuidtemp,$nuconn);
	//	No utilice esta parte si va a utilizar la llave primaria como serial
	
		
	if($iRegnoconformepr)
	{
		$iRegtabla["tablnomb"] = "noconformepr";
		$resulttabla = dinamicscantabla($iRegtabla,$nuconn);
		$num = fncnumreg($resulttabla);
		for($i=0;$i<$num;$i++)
		{
			$sbregtabla = fncfetch($resulttabla,$i);
			if($sbregtabla[tablnomb] == "noconformepr")
			{
				$tablcodi=$sbregtabla['tablcodi'];
				break;
			}
		}

		$iRegCampo["tablcodi"]=$tablcodi;

		$resultcampo=dinamicscancampo($iRegCampo,$nuconn);
		$num = fncnumreg($resultcampo);
		
		while($elementos = each($iRegnoconformepr))
		{

			$iRegCampo["campnomb"] = $elementos[0];
			$resultcampo = dinamicscancampo($iRegCampo,$nuconn);
			$num = fncnumreg($resultcampo);

			if($num>0)
			{
				$sbregcampo = fncfetch($resultcampo,0);
				if($elementos[0] != 'nocomcodigo')
				{

					if($sbregcampo["campnomb"] == $elementos[0])
					{
						$respuesta = strcmp($sbregcampo["campnotnull"],"t");
						if($respuesta == 0)
						{
							if($elementos[1] == "")
							{

								$campnomb[$elementos[0]] = 1;
								$flagnuevonoconformepr = 1;
								$flagerror = 1;
							}
						}
					}
				}
			}
			$validar = buscacaracter($elementos[1]);

			if($validar == 1)
			{

				$flagnuevonoconformepr = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;
			}
			$validresult = consulmetanoconformepr($elementos[0],$elementos[1],$nuconn);

			if($validresult == 1)
			{
				
				$flagnuevonoconformepr = 1;
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

			$result = insrecordnoconformepr($iRegnoconformepr,$nuconn);
			if($result < 0 )
			{
				fncmsgerror(errorReg);
				$flagnuevonoconformepr=1;
			}

			if($result > 0)
			{
				$nuresult1 = fncnumprox(id,$nuidtemp,$nuconn); 	//	No utilice esta parte si va a utilizar la llave primaria como serial //
				fncmsgerror(grabaEx);
				echo '<script language="javascript">';
				echo '<!--//'."\n";
				echo 'location ="maestablhistorialapr.php?codigo='.$codigo.';"';
				echo '//-->'."\n";
				echo '</script>';
			}

			fncclose($nuconn);
		}
		
	}
}

$iRegnoconformepr["nocomcodigo"] = $nocomcodigo;
$iRegnoconformepr["analiscodigo"] = $analiscodigo;
$iRegnoconformepr["usuacodi1"] = $usuacodi;
$iRegnoconformepr["usuacodi2"] = $usuacodigo;
$iRegnoconformepr["nocomfecha"] = date("Y-m-d");
$iRegnoconformepr["nocomhora"] = date("H:i:s");
$iRegnoconformepr["defectcodigo"] = $defectcodigo;
$iRegnoconformepr["nocomdescri"] = $nocomdescri;
$iRegnoconformepr["nocomestado "] = 1//estado inicial

grabanoconformepr($iRegnoconformepr,$flagnuevonoconformepr,$campnomb,$flagerror);

?> 
