<?php 
/*
-Todos los derechos reservados-
Propiedad intelectual de Adsum (c).
Funcion         : grabamedidoequipo
Decripcion      : Valida la data a grabar y la lleva al paquete.
Parametros      : Descripicion
$iRegmedidoequipo         Arreglo de datos.
$flagnuevomedidoequipo    Bandera de validaci�n
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
include ( '../src/FunPerPriNiv/pktblmedidoequipo.php');
include ( '../src/FunPerPriNiv/pktblcampo.php');
include ( '../src/FunPerPriNiv/pktbltabla.php');
include ( '../src/FunGen/buscacaracter.php');
include ( '../src/FunGen/fncmsgerror.php');
include( '../src/FunGen/fncnombexs.php');

function grabamedidoequipo($iRegmedidoequipo,&$flagnuevomedidoequipo,&$campnomb)
{
	$nuconn = fncconn();
	//	No utilice esta parte si va a utilizar la llave primaria como serial
	define("id",1);
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
		$nuresult = loadrecordmedidoequipo($nuidtemp,$nuconn);
		if($nuresult == e_empty)
		{
			$iRegmedidoequipo[medequcodigo] = $nuidtemp;
		}
		$nuidtemp ++;
	}while ($nuresult != e_empty);


	//	No utilice esta parte si va a utilizar la llave primaria como serial

	if($iRegmedidoequipo)
	{
		$iRegtabla["tablnomb"] = "medidoequipo";
		$resulttabla = dinamicscantabla($iRegtabla,$nuconn);
		$num = fncnumreg($resulttabla);
		for($i=0;$i<$num;$i++)
		{
			$sbregtabla = fncfetch($resulttabla,$i);
			if($sbregtabla[tablnomb] == "medidoequipo")
			{
				$tablcodi=$sbregtabla['tablcodi'];
				break;
			}
		}

		$iRegCampo["tablcodi"]=$tablcodi;
		$resultcampo=dinamicscancampo($iRegCampo,$nuconn);
		$num = fncnumreg($resultcampo);
		$iRegmedidoequipo_b = $iRegmedidoequipo;

		while($elementos = each($iRegmedidoequipo))
		{
			$iRegCampo["campnomb"] = $elementos[0];
			$resultcampo = dinamicscancampo($iRegCampo,$nuconn);
			$num = fncnumreg($resultcampo);
			if($num>0)
			{
				$sbregcampo = fncfetch($resultcampo,0);
//				if($elementos[0] != "medidoequipocodigo")
//				{
					if($sbregcampo["campnomb"] == $elementos[0])
					{
						$respuesta = strcmp($sbregcampo["campnotnull"],"t");
						if($respuesta == 0)
						{
							if($elementos[1] == "")
							{
								$campnomb[$elementos[0]] = 1;
								$flagnuevomedidoequipo = 1;
								$flagerror = 1;
							}
						}
					}
//				}
			}
			
			$validar = buscacaracter($elementos[1]);

			if($validar == 1)
			{
				$flagnuevomedidoequipo = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;

			}
		
			
			$validresult = consulmetamedidoequipo($elementos[0],$elementos[1],$nuconn);

			if($validresult == 1)
			{
				$flagnuevomedidoequipo = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;
				unset ($validresult);
			}
			
			

			if($elementos[0]=='medequnombre' && $elementos[1])
			{

				$validnombre =  fncnombexs('medidoequipo',$iRegmedidoequipo_b,$elementos[0],$elementos[1],$nuconn);
				if ($validnombre == 1)
				{
					fncmsgerror(errorNombExs);
					$flagnuevomedidoequipo = 1;
					$flagerror = 1;
					$campnomb[$elementos[0]] = 1;
					unset ($validnombre);
				}
			}
			
		}
		
		
		

		if($flagerror == 1)
		{
			fncmsgerror(errorIng);
		}

		if($flagerror != 1)
		{
			$result = insrecordmedidoequipo($iRegmedidoequipo,$nuconn);
			
			if($result < 0 )
			{
				ob_end_clean();
				fncmsgerror(errorReg);
				$flagnuevomedidoequipo=1;
			}
			if($result > 0)
			{
				$nuresult1 = fncnumprox(id,$nuidtemp,$nuconn); 	//	No utilice esta parte si va a utilizar la llave primaria como serial //
				fncmsgerror(grabaEx);
				echo '<script language="javascript">';
				echo '<!--//'."\n";
				echo 'location ="maestablmedidoequipo.php?codigo='.$codigo.';"';
				echo '//-->'."\n";
				echo '</script>';
			}
			fncclose($nuconn);
		}
	}

}

$iRegmedidoequipo[medequcodigo] = $medequcodigo;
$iRegmedidoequipo[tipmedcodigo] = $tipmedcodigo;
$iRegmedidoequipo[equipocodigo] = $equipocodigo;

grabamedidoequipo($iRegmedidoequipo,$flagnuevomedidoequipo,$campnomb);
?> 
