<?php 
ini_set('display_errors',1);
/*
-Todos los derechos reservados-
Propiedad intelectual de Adsum (c).
Funcion         : grabaformula
Decripcion      : Valida la data a grabar y la lleva al paquete.
Parametros      : Descripicion
$iRegformula         Arreglo de datos.
$flagnuevoformula    Bandera de validaci�n
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
include ( '../src/FunPerPriNiv/pktblformula.php');
include ( '../src/FunPerPriNiv/pktblitemformul.php');
include ( '../src/FunPerPriNiv/pktblcampo.php');
include ( '../src/FunPerPriNiv/pktbltabla.php');
include ( '../src/FunGen/buscacaracter.php');
include ( '../src/FunGen/fncmsgerror.php');
include( '../src/FunGen/fncnombexs.php');

function grabaformula(&$iRegformula,&$flagnuevoformula,&$campnomb,$codigo)
{
	$nuconn = fncconn();
	//	No utilice esta parte si va a utilizar la llave primaria como serial
	define("id",132);
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
		$nuresult = loadrecordformula($nuidtemp,$nuconn);
		if($nuresult == e_empty)
		{
			$iRegformula[formulcodigo] = $nuidtemp;
		}
		$nuidtemp ++;
	}while ($nuresult != e_empty);


	//	No utilice esta parte si va a utilizar la llave primaria como serial

	if($iRegformula)
	{
		$iRegtabla["tablnomb"] = "formula";
		$resulttabla = dinamicscantabla($iRegtabla,$nuconn);
		$num = fncnumreg($resulttabla);
		for($i=0;$i<$num;$i++)
		{
			$sbregtabla = fncfetch($resulttabla,$i);
			if($sbregtabla[tablnomb] == "formula")
			{
				$tablcodi=$sbregtabla['tablcodi'];
				break;
			}
		}

		$iRegCampo["tablcodi"]=$tablcodi;
		$resultcampo=dinamicscancampo($iRegCampo,$nuconn);
		$num = fncnumreg($resultcampo);
		$iRegformula_b = $iRegformula;

		while($elementos = each($iRegformula))
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
								$flagnuevoformula = 1;
								$flagerror = 1;
							}
						}
					}
			}
			
			$validar = buscacaracter($elementos[1]);

			if($validar == 1)
			{
				$flagnuevoformula = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;

			}
		
			
			$validresult = consulmetaformula($elementos[0],$elementos[1],$nuconn);

			if($validresult == 1)
			{
				$flagnuevoformula = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;
				unset ($validresult);
			}
			
			$validacamp = fncnombexs("formula",$iRegformula,'formulnumero',$valorcampo,$nuconn);
			
			if($validacamp == 1)
				{
					$flagnuevoformula = 1;
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
			$result = insrecordformula($iRegformula,$nuconn);
			
			if($result < 0 )
			{
				ob_end_clean();
				fncmsgerror(errorReg);
				$flagnuevoformula=1;
			}
			if($result > 0)
			{
				$nuresult1 = fncnumprox(id,$nuidtemp,$nuconn); 	//	No utilice esta parte si va a utilizar la llave primaria como serial //
				fncmsgerror(grabaEx);
				
				echo '<script language="javascript">';
				echo '<!--//'."\n";
				echo 'location ="maestablformula.php?codigo='.$codigo.';"';
				echo '//-->'."\n";
				echo '</script>';
				
			}
			fncclose($nuconn);
		}
	}

}

$iRegformula[formulnumero] = $formulnumero;
$iRegformula[formulnombre] = $formulnombre;
$iRegformula[formulserie] = $formulserie;
$iRegformula[formulprecio] = $formulprecio;
$iRegformula[formulsolido] = $formulsolido;


grabaformula($iRegformula,$flagnuevoformula,$campnomb,$codigo);

?> 
