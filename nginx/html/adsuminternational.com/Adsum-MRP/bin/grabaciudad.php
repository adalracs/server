<?php 
/* 
-Todos los derechos reservados- 
Propiedad intelectual de Adsum (c). 
Funcion         : grabaciudad 
Decripcion      : Valida la data a grabar y la lleva al paquete. 
Parametros      : Descripicion 
    $iRegciudad         Arreglo de datos. 
    $flagnuevociudad    Bandera de validaci�n 
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
include ( '../src/FunPerPriNiv/pktblciudad.php');
include ( '../src/FunPerPriNiv/pktblcampo.php');
include ( '../src/FunPerPriNiv/pktbltabla.php');
include ( '../src/FunGen/buscacaracter.php');
include ( '../src/FunGen/fncmsgerror.php');
include( '../src/FunGen/fncnombexs.php');
 
function grabaciudad($iRegciudad,&$flagnuevociudad,&$campnomb) 
{ 
	$nuconn = fncconn(); 
	//	No utilice esta parte si va a utilizar la llave primaria como serial 
	define("id",84); 
	define("errorReg",1);
	define("errorCar",2);
	define("grabaEx",3);
	define("compinst",4);
	define("venccomp",5);
	define("errorNombExs",18);
	define("errorIng",35);
	$nuidtemp = fncnumact(	id,$nuconn); 
	do 
	{ 
		$nuresult = loadrecordciudad($nuidtemp,$nuconn); 
		if($nuresult == e_empty) 
		{ 
			$iRegciudad[ciudadcodigo] = $nuidtemp; 
		} 
		$nuidtemp ++; 
	}while ($nuresult != e_empty); 
	//	No utilice esta parte si va a utilizar la llave primaria como serial 
	if ($iRegciudad) 
	{ 
		$iRegtabla["tablnomb"] = "ciudad";
		$resulttabla = dinamicscantabla($iRegtabla,$nuconn);
		$num = fncnumreg($resulttabla);
		for($i=0;$i<$num;$i++)
		{
			$sbregtabla = fncfetch($resulttabla,$i);
			if($sbregtabla[tablnomb] == "ciudad")
			{
				$tablcodi=$sbregtabla['tablcodi'];
				break;
			}
		}

		$iRegCampo["tablcodi"]=$tablcodi;
		$resultcampo=dinamicscancampo($iRegCampo,$nuconn);
		$num = fncnumreg($resultcampo);
		
		while($elementos = each($iRegciudad))
		{
		    $iRegCampo["campnomb"] = $elementos[0];
			$resultcampo = dinamicscancampo($iRegCampo,$nuconn);
			$num = fncnumreg($resultcampo);
			if($num>0)
			{
				$sbregcampo = fncfetch($resultcampo,0);
				if($elementos[0] != "ciudadcodigo")
				{
					if($sbregcampo["campnomb"] == $elementos[0])
					{
						$respuesta = strcmp($sbregcampo["campnotnull"],"t");
						if($respuesta == 0)
						{
							if($elementos[1] == "")
							{
								$campnomb[$elementos[0]] = 1;
								$flagnuevociudad = 1;
								$flagerror = 1;
							}
						}
					}
				}
			}
			$validar = buscacaracter($elementos[1]); 
			if($validar == 1) 
			{ 
				$flagnuevociudad = 1; 
				$flagerror = 1; 
				$campnomb[$elementos[0]] = 1;
			} 
			$validresult = consulmetaciudad($elementos[0],$elementos[1],$nuconn); 
			if ($validresult == 1) 
			{ 
				$flagnuevociudad = 1; 
				$flagerror = 1; 
				$campnomb[$elementos[0]] = 1;
				unset ($validresult); 
			} 
			if($elementos[0]=='ciudadnombre')
			{
				if($elementos[1] != null)
				{
					$validnombre =  fncnombexs('ciudad',$iRegciudad,$elementos[0],$elementos[1],$nuconn);
					if ($validnombre == 1)
					{
						fncmsgerror(errorNombExs);
						$flagnuevociudad = 1;
						$flagerror = 1;
						$campnomb[$elementos[0]] = 1;
						unset ($validnombre);
					}
				}
				else
				{
					$flagnuevociudad = 1;
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
			$result = insrecordciudad($iRegciudad,$nuconn); 
			if($result < 0 ) 
			{ 
				ob_end_clean(); 
				fncmsgerror(errorReg); 
				$flagnuevociudad=1; 
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
$iRegciudad[ciudadcodigo] = $ciudadcodigo; 
$iRegciudad[ciudadnombre] = $ciudadnombre; 
$iRegciudad[ciudaddescri] = $ciudaddescri; 
$iRegciudad[deptocodigo] = $deptocodigo; 

grabaciudad($iRegciudad,$flagnuevociudad,$campnomb); 
?> 
