<?php 
/*
-Todos los derechos reservados-
Propiedad intelectual de Adsum (c).
Funcion         : grabaflagproduccion
Decripcion      : Valida la data a grabar y la lleva al paquete.
Parametros      : Descripicion
$iRegflagproduccion         Arreglo de datos.
$flagnuevoflagproduccion    Bandera de validaci�n
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
include ( '../src/FunPerPriNiv/pktblvelocidadpn.php');
include ( '../src/FunPerPriNiv/pktblcampo.php');
include ( '../src/FunPerPriNiv/pktbltabla.php');
include ( '../src/FunGen/buscacaracter.php');
include ( '../src/FunGen/fncmsgerror.php');
include( '../src/FunGen/fncnombexs.php');

function grabavelocidadpn($iRegvelocidadpn,&$flagnuevovelocidadpn,&$campnomb)
{
	$nuconn = fncconn();
	//	No utilice esta parte si va a utilizar la llave primaria como serial
	define("id",252);
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
	define("e_empty",-3); 

	$nuidtemp = fncnumact(id,$nuconn); 
	do 
	{ 
		$nuresult = loadrecordvelocidadpn($nuidtemp,$nuconn); 
		if($nuresult == e_empty) 
		{  
			$iRegvelocidadpn[velocicodigo] = $nuidtemp; 
		} 
		$nuidtemp ++; 
	}while ($nuresult != e_empty);

	//	No utilice esta parte si va a utilizar la llave primaria como serial

	if($iRegvelocidadpn)
	{
		$iRegtabla["tablnomb"] = "velocidadpn";
		$resulttabla = dinamicscantabla($iRegtabla,$nuconn);
		$num = fncnumreg($resulttabla);
		for($i=0;$i<$num;$i++)
		{
			$sbregtabla = fncfetch($resulttabla,$i);
			if($sbregtabla[tablnomb] == "velocidadpn")
			{
				$tablcodi=$sbregtabla['tablcodi'];
				break;
			}
		}

		$iRegCampo["tablcodi"]=$tablcodi;
		$resultcampo=dinamicscancampo($iRegCampo,$nuconn);
		$num = fncnumreg($resultcampo);
		$iRegvelocidadpn_b = $iRegvelocidadpn;
		

		while($elementos = each($iRegvelocidadpn))
		{
			$iRegCampo["campnomb"] = $elementos[0];
			$resultcampo = dinamicscancampo($iRegCampo,$nuconn);
			$num = fncnumreg($resultcampo);
			if($num>0)
			{
				$sbregcampo = fncfetch($resultcampo,0);
//				if($elementos[0] != "tipsolcodigo")
//				{
					if($sbregcampo["campnomb"] == $elementos[0])
					{
						$respuesta = strcmp($sbregcampo["campnotnull"],"t");
						if($respuesta == 0)
						{
							if($elementos[1] == "")
							{
								$campnomb[$elementos[0]] = 1;
								$flagnuevovelocidadpn = 1;
								$flagerror = 1;
							}
						}
					}
//				}
			}
			
			$validar = buscacaracter($elementos[1]);

			if($validar == 1)
			{
				$flagnuevovelocidadpn = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;

			}
		
			
			$validresult = consulmetavelocidadpn($elementos[0],$elementos[1],$nuconn);

			if($validresult == 1)
			{
				$flagnuevovelocidadpn = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;
			}
			
		}
		

		if($flagerror == 1)
		{
			fncmsgerror(errorIng);
		}
		
		

		if($flagerror != 1)
		{
			$result = insrecordvelocidadpn($iRegvelocidadpn,$nuconn);
			
			if($result < 0 )
			{
				ob_end_clean();
				fncmsgerror(errorReg);
				$flagnuevovelocidadpn=1;
			}
			if($result > 0)
			{
				$nuresult1 = fncnumprox(id,$nuidtemp,$nuconn); 	//	No utilice esta parte si va a utilizar la llave primaria como serial //
				fncmsgerror(grabaEx);
				echo '<script language="javascript">';
				echo '<!--//'."\n";
				echo 'location ="maestablvelocidadpn.php?codigo='.$codigo.';"';
				echo '//-->'."\n";
				echo '</script>';
			}
			fncclose($nuconn);
		}
	}

}

$iRegvelocidadpn[velocinombre] = $velocinombre;
$iRegvelocidadpn[complecodigo] = $complecodigo;
$iRegvelocidadpn[tipsolcodigo] = $tipsolcodigo;
$iRegvelocidadpn[equipocodigo] = $equipocodigo;
$iRegvelocidadpn[velocivalora] = $velocivalora;
$iRegvelocidadpn[velocidescri] = $velocidescri;

grabavelocidadpn($iRegvelocidadpn,$flagnuevovelocidadpn,$campnomb);
?> 
