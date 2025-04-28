<?php 
/* 
-Todos los derechos reservados- 
Propiedad intelectual de Adsum (c). 
Funcion         : grabaactivi 
Decripcion      : Valida la data a grabar y la lleva al paquete. 
Parametros      : Descripicion 
    $iRegactividades         Arreglo de datos. 
    $flagnuevoactividades    Bandera de validaci�n 
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
include ( '../src/FunPerPriNiv/pktblactividades.php');
include ( '../src/FunPerPriNiv/pktblcampo.php');
include ( '../src/FunPerPriNiv/pktbltabla.php');
include ( '../src/FunGen/buscacaracter.php');
include ( '../src/FunGen/fncmsgerror.php');
include( '../src/FunGen/fncnombexs.php');
 
function grabaactividades($iRegactividades,&$flagnuevoactividades,&$campnomb) 
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
	

	/*$nuidtemp = fncnumact(	id,$nuconn); 
	do 
	{ 
		$nuresult = loadrecordactivi($nuidtemp,$nuconn); 
		if($nuresult == e_empty) 
		{ 
			$iRegactividades[activicodigo] = $nuidtemp; 
		} 
		$nuidtemp ++; 
	}while ($nuresult != e_empty); */
	//	No utilice esta parte si va a utilizar la llave primaria como serial 
	if ($iRegactividades) 
	{ 
		$iRegtabla["tablnomb"] = "actividades";
		$resulttabla = dinamicscantabla($iRegtabla,$nuconn);
		$num = fncnumreg($resulttabla);
		for($i=0;$i<$num;$i++)
		{
			$sbregtabla = fncfetch($resulttabla,$i);
			if($sbregtabla[tablnomb] == "actividades")
			{
				$tablcodi=$sbregtabla['tablcodi'];
				break;
			}
		}

		$iRegCampo["tablcodi"]=$tablcodi;
		$resultcampo=dinamicscancampo($iRegCampo,$nuconn);
		$num = fncnumreg($resultcampo);
		
		while($elementos = each($iRegactividades))
		{
		    $iRegCampo["campnomb"] = $elementos[0];
			$resultcampo = dinamicscancampo($iRegCampo,$nuconn);
			$num = fncnumreg($resultcampo);
			if($num>0)
			{
				$sbregcampo = fncfetch($resultcampo,0);
				if($elementos[0] != "activicodigo")
				{
					if($sbregcampo["campnomb"] == $elementos[0])
					{
						$respuesta = strcmp($sbregcampo["campnotnull"],"t");
						if($respuesta == 0)
						{
							if($elementos[1] == "")
							{
								$campnomb[$elementos[0]] = 1;
								$flagnuevoactividades = 1;
								$flagerror = 1;
							}
						}
					}
				}
			}
			$validar = buscacaracter($elementos[1]); 
			if($validar == 1) 
			{ 
				$flagnuevoactividades = 1; 
				$flagerror = 1; 
				$campnomb[$elementos[0]] = 1;
			} 
			$validresult = consulmetaactividades($elementos[0],$elementos[1],$nuconn); 
			if ($validresult == 1) 
			{ 
				$flagnuevoactividades = 1; 
				$flagerror = 1; 
				$campnomb[$elementos[0]] = 1;
				unset ($validresult); 
			} 
			if($elementos[0]=='activinombre')
			{
				if($elementos[1] != null)
				{
					$validnombre =  fncnombexs('actividades',$iRegactividades,$elementos[0],$elementos[1],$nuconn);
					if ($validnombre == 1)
					{
						fncmsgerror(errorNombExs);
						$flagnuevoactividades = 1;
						$flagerror = 1;
						$campnomb[$elementos[0]] = 1;
						unset ($validnombre);
					}
				}
				else
				{
					$flagnuevoactividades = 1;
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
			$result = insrecordactividades($iRegactividades,$nuconn); 
			if($result < 0 ) 
			{ 
				ob_end_clean(); 
				fncmsgerror(errorReg); 
				$flagnuevoactividades = 1; 
			} 
			if($result > 0) 
			{ 
			//	$nuresult1 = fncnumprox(id,$nuidtemp,$nuconn); 	//	No utilice esta parte si va a utilizar la llave primaria como serial //
				fncmsgerror(grabaEx); 
			} 
			fncclose($nuconn); 
		} 
	} 
} 
$iRegactividades[activicodigo] = $activicodigo; 
$iRegactividades[activinombre] = $activinombre; 
$iRegactividades[actividescri] = $actividescri; 
$iRegactividades[activivalbar] = $activivalbar; 
$iRegactividades[clasecodigo] = $clasecodigo; 
$iRegactividades[unidadcodigo] = $unidadcodigo; 
 
grabaactividades($iRegactividades,$flagnuevoactividades,$campnomb); 
?> 
