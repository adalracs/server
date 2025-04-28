<?php 
/* 
-Todos los derechos reservados- 
Propiedad intelectual de Adsum (c). 
Funcion         : grabaproveestado 
Decripcion      : Valida la data a grabar y la lleva al paquete. 
Parametros      : Descripicion 
    $iRegproveestado         Arreglo de datos. 
    $flagnuevoproveestado    Bandera de validaci�n 
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
include ( '../src/FunPerPriNiv/pktblproveestado.php'); 
include ( '../src/FunPerPriNiv/pktblcampo.php'); 
include ( '../src/FunPerPriNiv/pktbltabla.php'); 
include ( '../src/FunGen/buscacaracter.php'); 
include ( '../src/FunGen/fncmsgerror.php'); 
include( '../src/FunGen/fncnombexs.php'); 
function grabaproveestado($iRegproveestado,&$flagnuevoproveestado,&$campnomb) 
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
	define("errorNombExs",18);
	define("errorIng",35);
	
	$nuidtemp = fncnumact(	id,$nuconn); 
	do 
	{ 
		$nuresult = loadrecordproveestado($nuidtemp,$nuconn); 
		if($nuresult == e_empty) 
		{ 
			$iRegproveestado[proestcodigo] = $nuidtemp; 
		} 
		$nuidtemp ++; 
	}while ($nuresult != e_empty); 
	//	No utilice esta parte si va a utilizar la llave primaria como serial 
	
	if($iRegproveestado)
	{
		$iRegtabla["tablnomb"] = "proveestado";
		$resulttabla = dinamicscantabla($iRegtabla,$nuconn);
		$num = fncnumreg($resulttabla);
		for($i=0;$i<$num;$i++)
		{
			$sbregtabla = fncfetch($resulttabla,$i);
			if($sbregtabla[tablnomb] == "proveestado")
			{
				$tablcodi=$sbregtabla['tablcodi'];
				break;
			}
		}

		$iRegCampo["tablcodi"] = $tablcodi;
		$resultcampo = dinamicscancampo($iRegCampo,$nuconn);
		$num = fncnumreg($resultcampo);
		$iRegproveestado_b = $iRegproveestado;
		
		while($elementos = each($iRegproveestado))
		{
			$iRegCampo["campnomb"] = $elementos[0];
			$resultcampo = dinamicscancampo($iRegCampo,$nuconn);
			$num = fncnumreg($resultcampo);
			if($num>0)
			{
				$sbregcampo = fncfetch($resultcampo,0);
				if($elementos[0] != "proestcodigo")
				{
					if($sbregcampo["campnomb"] == $elementos[0])
					{
						$respuesta = strcmp($sbregcampo["campnotnull"],"t");
						if($respuesta == 0)
						{
							if($elementos[1] == "")
							{
								$campnomb[$elementos[0]] = 1;
								$flagnuevoproveestado = 1;
								$flagerror = 1;
							}
						}
					}
				}
			}
			$validar = buscacaracter($elementos[1]);

			if($validar == 1)
			{
				$flagnuevoproveestado = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;
			}
			$validresult = consulmetaproveestado($elementos[0],$elementos[1],$nuconn);

			if($validresult == 1)
			{
				$flagnuevoproveestado = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;
				unset ($validresult);
			}
			
			if($elementos[0]=='proestnombre')
			{
				if($elementos[1] != null)
				{
					$validnombre =  fncnombexs('proveestado',$iRegproveestado_b,$elementos[0],$elementos[1],$nuconn);
					if ($validnombre == 1)
					{
						fncmsgerror(errorNombExs);
						$flagnuevoproveestado = 1;
						$flagerror = 1;
						$campnomb[$elementos[0]] = 1;
						unset ($validnombre);
					}
				}
				else 
				{
					$flagnuevoproveestado = 1;
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
			$result = insrecordproveestado($iRegproveestado,$nuconn); 
			if($result < 0 ) 
			{ 
				ob_end_clean(); 
				fncmsgerror(errorReg); 
				$flagnuevoproveestado=1; 
			} 
			if($result > 0) 
			{ 
				$nuresult1 = fncnumprox(id,$nuidtemp,$nuconn); 	//	No utilice esta parte si va a utilizar la llave primaria como serial 
				fncmsgerror(grabaEx); 
			} 
			fncclose($nuconn); 
		} 
	} 
} 
$iRegproveestado[proestcodigo] = $proestcodigo; 
$iRegproveestado[proestnombre] = $proestnombre; 
$iRegproveestado[proestdescri] = $proestdescri; 
grabaproveestado($iRegproveestado,$flagnuevoproveestado,$campnomb); 
?> 
