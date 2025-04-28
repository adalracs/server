<?php 
/* 
-Todos los derechos reservados- 
Propiedad intelectual de Adsum (c). 
Funcion         : grabacotizacione 
Decripcion      : Valida la data a grabar y la lleva al paquete. 
Parametros      : Descripicion 
    $iRegcotizacione         Arreglo de datos. 
    $flagnuevocotizacione    Bandera de validación 
Retorno         : 
		true	= 1 
		false	= 0 
Autor           : ariascos 
Escrito con     : WAG Adsum versión 3.1.1 
Fecha           : 18082004 
Historial de modificaciones 
| Fecha | Motivo				| Autor 	| 
*/ 
  
include ( '../src/FunGen/fncnumprox.php'); 
include ( '../src/FunGen/fncnumact.php'); 
include ( '../def/tipocampo.php'); 
include ( '../src/FunPerPriNiv/pktblcotizacione.php'); 
include ( '../src/FunPerPriNiv/pktblcampo.php');
include ( '../src/FunPerPriNiv/pktbltabla.php');
include ( '../src/FunGen/buscacaracter.php'); 
include ( '../src/FunGen/fncmsgerror.php'); 
 
function grabacotizacione($iRegcotizacione,&$flagnuevocotizacione,&$campnomb) 
{ 
	$nuconn = fncconn(); 
	//	No utilice esta parte si va a utilizar la llave primaria como serial 
	define("id",35); 
	define("errorReg",1); 
	define("errorCar",2); 
	define("grabaEx",3); 
	define("compinst",4); 
	define("venccomp",5); 
	define("compactu",6); 
	define("fecvalid",7); 
	define("errormail",8); 
	define("editaEx",9); 
	define("errorNoPrvee",33);
	define("errorIng",35);
	 
	$nuidtemp = fncnumact(	id,$nuconn); 
	do 
	{ 
		$nuresult = loadrecordcotizacione($nuidtemp,$nuconn); 
		if($nuresult == e_empty) 
		{ 
			$iRegcotizacione[cotizacodigo] = $nuidtemp; 
		} 
		$nuidtemp ++; 
	}while ($nuresult != e_empty); 
	$nuresult1 = fncnumprox(id,$nuidtemp,$nuconn); 
	//	No utilice esta parte si va a utilizar la llave primaria como serial 

	if ($iRegcotizacione) 
	{ 
		$iRegtabla["tablnomb"] = "cotizacione";
		$resulttabla = dinamicscantabla($iRegtabla,$nuconn);
		$num = fncnumreg($resulttabla);
		
		for($i=0;$i<$num;$i++)
		{
			$sbregtabla = fncfetch($resulttabla,$i);
			
			if($sbregtabla[tablnomb] == "cotizacione")
			{
				$tablcodi=$sbregtabla['tablcodi'];
				break;
			}
		}
		$iRegCampo["tablcodi"]=$tablcodi;
		$resultcampo=dinamicscancampo($iRegCampo,$nuconn);
		$num = fncnumreg($resultcampo);
				
		while($elementos = each($iRegcotizacione))
		{ 
			$iRegCampo["campnomb"] = $elementos[0];
			$resultcampo = dinamicscancampo($iRegCampo,$nuconn);
			$num = fncnumreg($resultcampo);
			if($num>0)
			{
				$sbregcampo = fncfetch($resultcampo,0);
				if($elementos[0] != "cotizacodigo")
				{
					if($sbregcampo["campnomb"] == $elementos[0])
					{
						$respuesta = strcmp($sbregcampo["campnotnull"],"t");
						if($respuesta == 0)
						{
							if($elementos[1] == "")
							{
								$campnomb[$elementos[0]] = 1;
								$flageditarcotizacione = 1;
								$flagerror = 1;
							}
						}
					}
				}
			}			
			$validar = buscacaracter($elementos[1]);
			
			if($validar == 1) 
			{ 
				$flageditarcotizacione = 1; 
				$flagerror = 1; 
				$campnomb[$elementos[0]] = 1;
			}			
			$validresult = consulmetacotizacione($elementos[0],$elementos[1],$nuconn);
			
			if ($validresult == 1)
			{
				$flageditarcotizacione = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;
				unset ($validresult);
			}
			
			if (($elementos[0] == "proveecodigo") && ($elementos[1] == null))
			{
				$flagnuevocotizacione = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;
			}
			if ($elementos[0] == "cotizdescri")
			{
				if($elementos[1] == null)
				{
					$flagnuevocotizacione = 1;
					$flagerror = 1;
					$campnomb[$elementos[0]] = 1;
				}
			}
		}
		
		if($flagerror == 1)
		{
			fncmsgerror(errorIng);
		}
		 
		if($flagerror != 1) 
		{ 
			$result = insrecordcotizacione($iRegcotizacione,$nuconn); 
			if($result < 0 ) 
			{ 
				ob_end_clean(); 
				fncmsgerror(errorReg); 
				$flagnuevocotizacione=1; 
			} 
			if($result > 0) 
			{ 
				fncmsgerror(grabaEx); 
			} 
			fncclose($nuconn); 
		} 
	} 
} 
$iRegcotizacione[cotizacodigo] = $cotizacodigo; 
$iRegcotizacione[proveecodigo] = $proveecodigo; 
$iRegcotizacione[usuacodi] = $usuacodi; 
$iRegcotizacione[cotiznombre] = $cotiznombre; 
$iRegcotizacione[cotizafecha] = $cotizafecha; 
$iRegcotizacione[cotizahora] = $cotizahora; 
$iRegcotizacione[cotizdescri] = $cotizdescri; 
grabacotizacione($iRegcotizacione,$flagnuevocotizacione,$campnomb); 
?> 
