<?php 
/* 
-Todos los derechos reservados- 
Propiedad intelectual de Adsum (c). 
Funcion         : grabaservicio 
Decripcion      : Valida la data a grabar y la lleva al paquete. 
Parametros      : Descripicion 
    $iRegservicio         Arreglo de datos. 
    $flagnuevoservicio    Bandera de validación 
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
include ( '../src/FunPerPriNiv/pktblservicio.php'); 
include ( '../src/FunPerPriNiv/pktblcampo.php'); 
include ( '../src/FunPerPriNiv/pktbltabla.php'); 
include ( '../src/FunGen/buscacaracter.php'); 
include ( '../src/FunGen/fncmsgerror.php'); 
include ( '../src/FunGen/fncnombexs.php'); 
 
function grabaservicio($iRegservicio,&$flagnuevoservicio,&$campnomb) 
{ 
	$nuconn = fncconn(); 
	//	No utilice esta parte si va a utilizar la llave primaria como serial 
	define("id",66); 
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
	define("errorServ",41);
	 
	$nuidtemp = fncnumact(id,$nuconn); 
	do 
	{ 
		$nuresult = loadrecordservicio($nuidtemp,$nuconn); 
		if($nuresult == e_empty) 
		{ 
			$iRegservicio[servicicodigo] = $nuidtemp; 
		} 
		$nuidtemp ++; 
	}while ($nuresult != e_empty); 
 
	//	No utilice esta parte si va a utilizar la llave primaria como serial 

	if($iRegservicio)
	{
		$iRegtabla["tablnomb"] = "servicio";
		$resulttabla = dinamicscantabla($iRegtabla,$nuconn);
		$num = fncnumreg($resulttabla);
		for($i=0;$i<$num;$i++)
		{
			$sbregtabla = fncfetch($resulttabla,$i);
			if($sbregtabla[tablnomb] == "servicio")
			{
				$tablcodi=$sbregtabla['tablcodi'];
				break;
			}
		}

		$iRegCampo["tablcodi"] = $tablcodi;
		$resultcampo=dinamicscancampo($iRegCampo,$nuconn);
		$num = fncnumreg($resultcampo);

		while($elementos = each($iRegservicio))
		{
			$iRegCampo["campnomb"] = $elementos[0];
			$resultcampo = dinamicscancampo($iRegCampo,$nuconn);
			$num = fncnumreg($resultcampo);
			if($num>0)
			{
				$sbregcampo = fncfetch($resultcampo,0);
				if($elementos[0] != "servicicodigo")
				{
					if($sbregcampo["campnomb"] == $elementos[0])
					{
						$respuesta = strcmp($sbregcampo["campnotnull"],"t");
						if($respuesta == 0)
						{
							if($elementos[1] == "")
							{
								$campnomb[$elementos[0]] = 1;
								$flagnuevoservicio = 1;
								$flagerror = 1;
							}
						}
					}
				}
			}
			$validar = buscacaracter($elementos[1]);

			if($validar == 1)
			{
				$flagnuevoservicio = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;
			}
			$validresult = consulmetaservicio($elementos[0],$elementos[1],$nuconn);

			if($validresult == 1)
			{
				$flagnuevoservicio = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;
				unset ($validresult);
			}
			
			if(($elementos[0] == "negocicodigo") && ($elementos[1] == ""))
			{
				$flagnuevoservicio = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;
			}
			if($elementos[0] == "servicinombre")
			{
				if($elementos[1] != "")
				{
					$key = array($elementos[0], "negocicodigo");
					$value = array($elementos[1], $iRegservicio["negocicodigo"]);
					$valid =  fncnombexs('servicio', $iRegservicio, $key, $value, $nuconn);
					if ($valid == 1)
					{
						fncmsgerror(errorServ);
						$flagnuevoservicio = 1;
						$flagerror = 1;
						$flagnomberr = 1;
						$campnomb[$elementos[0]] = 1;
						unset ($valid);
					}
				}
			}
		}

		if(($flagerror == 1) && !($flagnomberr))
		{
			fncmsgerror(errorIng);
		}
		 
		if($flagerror != 1) 
		{ 
			$result = insrecordservicio($iRegservicio,$nuconn); 
			if($result < 0 ) 
			{ 
				ob_end_clean(); 
				fncmsgerror(errorReg); 
				$flagnuevoservicio=1; 
			} 
			if($result > 0) 
			{ 
				fncmsgerror(grabaEx);
				$nuresult1 = fncnumprox(id,$nuidtemp,$nuconn); 
			} 
			fncclose($nuconn); 
		} 
	} 
} 
$iRegservicio[servicicodigo] = $servicicodigo; 
$iRegservicio[negocicodigo] = $negocicodigo; 
$iRegservicio[servicinombre] = $servicinombre; 
$iRegservicio[servicidescri] = $servicidescri; 
grabaservicio($iRegservicio,$flagnuevoservicio,$campnomb); 
?> 
