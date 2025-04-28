<?php 
ini_set('display_errors',1);
/*
-Todos los derechos reservados-
Propiedad intelectual de Adsum (c).
Funcion         : grabacerticaltin
Decripcion      : Valida la data a grabar y la lleva al paquete.
Parametros      : Descripicion
$iRegcerticaltin         Arreglo de datos.
$flagnuevocerticaltin    Bandera de validaci�n
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
include ( '../src/FunPerPriNiv/pktblcerticaltin.php');
include ( '../src/FunPerPriNiv/pktblcampo.php');
include ( '../src/FunPerPriNiv/pktbltabla.php');
include ( '../src/FunGen/buscacaracter.php');
include ( '../src/FunGen/fncmsgerror.php');
include( '../src/FunGen/fncnombexs.php');

function grabacerticaltin(&$iRegcerticaltin,&$flagnuevocerticaltin,&$campnomb,$codigo)
{
	$nuconn = fncconn();
	//	No utilice esta parte si va a utilizar la llave primaria como serial
	define("id",133);
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
		$nuresult = loadrecordcerticaltin($nuidtemp,$nuconn);
		if($nuresult == e_empty)
		{
			$iRegcerticaltin[cercatcodigo] = $nuidtemp;
		}
		$nuidtemp ++;
	}while ($nuresult != e_empty);
	


	//	No utilice esta parte si va a utilizar la llave primaria como serial

	if($iRegcerticaltin)
	{
		$iRegtabla["tablnomb"] = "certicaltin";
		$resulttabla = dinamicscantabla($iRegtabla,$nuconn);
		$num = fncnumreg($resulttabla);
		for($i=0;$i<$num;$i++)
		{
			$sbregtabla = fncfetch($resulttabla,$i);
			if($sbregtabla[tablnomb] == "certicaltin")
			{
				$tablcodi=$sbregtabla['tablcodi'];
				break;
			}
		}

		$iRegCampo["tablcodi"]=$tablcodi;
		$resultcampo=dinamicscancampo($iRegCampo,$nuconn);
		$num = fncnumreg($resultcampo);
		$iRegcerticaltin_b = $iRegcerticaltin;

		while($elementos = each($iRegcerticaltin))
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
								$flagnuevocerticaltin = 1;
								$flagerror = 1;
							}
						}
					}
			}
			
			//$validar = buscacaracter($elementos[1]);

			if($validar == 1)
			{
				$flagnuevocerticaltin = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;

			}
		
			
			$validresult = consulmetacerticaltin($elementos[0],$elementos[1],$nuconn);

			if($validresult == 1)
			{
				$flagnuevocerticaltin = 1;
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
			$result = insrecordcerticaltin($iRegcerticaltin,$nuconn);
			
			if($result < 0 )
			{
				ob_end_clean();
				fncmsgerror(errorReg);
				$flagnuevocerticaltin=1;
			}
			if($result > 0)
			{
				$nuresult1 = fncnumprox(id,$nuidtemp,$nuconn); 	//	No utilice esta parte si va a utilizar la llave primaria como serial //
				fncmsgerror(grabaEx);
				
				echo '<script language="javascript">';
				echo '<!--//'."\n";
				echo 'location ="maestablcerticaltin.php?codigo='.$codigo.';"';
				echo '//-->'."\n";
				echo '</script>';
			}
			fncclose($nuconn);
		}
	}

}

$iRegcerticaltin[cercatlinea] = $cercatlinea;
$iRegcerticaltin[cercattipot] = $cercattipot;
$iRegcerticaltin[cercatlote] = $cercatlote;
$iRegcerticaltin[itedescodigo] = $itedescodigo;
$iRegcerticaltin[cercatfecha] = $cercatfecha;
$iRegcerticaltin[usuacodi] = $usuacodi;
$iRegcerticaltin[cercatviscos] = $cercatviscos;
$iRegcerticaltin[cercatvisco] = $cercatvisco;
$iRegcerticaltin[cercatcolor] = $cercatcolor;
$iRegcerticaltin[cercatsolido] = $cercatsolido;
$iRegcerticaltin[cercatadhere] = $cercatadhere;
$iRegcerticaltin[cercatrayado] = $cercatrayado;
$iRegcerticaltin[cercatdensid] = $cercatdensid;
$iRegcerticaltin[cercatsecado] = $cercatsecado;
$iRegcerticaltin[cercatdescri] = $cercatdescri;
$iRegcerticaltin[cercatdelrec] = 1;

grabacerticaltin($iRegcerticaltin,$flagnuevocerticaltin,$campnomb,$codigo);

?> 
