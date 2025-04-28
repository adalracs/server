<?php 
/* 
-Todos los derechos reservados- 
Propiedad intelectual de Adsum (c). 
Funcion         : grabaturno
Decripcion      : Valida la data a grabar y la lleva al paquete. 
Parametros      : Descripicion 
    $iRegturno         Arreglo de datos. 
    $flagnuevoturno    Bandera de validaci�n 
Retorno         : 
		true	= 1 
		false	= 0 
Autor           : cbedoya
Escrito con     : WAG Adsum versi�n 3.1.1 
Fecha           : 30-November-2007
Historial de modificaciones 
| Fecha | Motivo				| Autor 	| 
*/ 
  
include ( '../src/FunGen/fncnumprox.php');
include ( '../src/FunGen/fncnumact.php');
include ( '../def/tipocampo.php');
include ( '../src/FunPerPriNiv/pktblturno.php');
include ( '../src/FunPerPriNiv/pktblcampo.php');
include ( '../src/FunPerPriNiv/pktbltabla.php');
include ( '../src/FunGen/buscacaracter.php');
include ( '../src/FunGen/fncmsgerror.php');
include ( '../src/FunGen/fncnombexs.php');
 
function grabaturno($iRegturno,&$flagnuevoturno,&$campnomb)
{ 
	$nuconn = fncconn(); 
	//	No utilice esta parte si va a utilizar la llave primaria como serial 
	define("id",95); 
	define("errorReg",1);
	define("errorCar",2);
	define("grabaEx",3);
	define("compinst",4);
	define("venccomp",5);
	define("errorNombExs",18);
	define("errorIng",35);
	
	$nuidtemp = fncnumact(	id,$nuconn); 
	do{ 
		$nuresult = loadrecordturno($nuidtemp,$nuconn); 
		if($nuresult == e_empty) 
			$iRegturno[turnocodigo] = $nuidtemp; 
		$nuidtemp ++; 
	}while ($nuresult != e_empty); 
	//	No utilice esta parte si va a utilizar la llave primaria como serial
	
	if ($iRegturno)
	{ 
		$iRegtabla["tablnomb"] = "turno";
		$resulttabla = dinamicscantabla($iRegtabla,$nuconn);
		$num = fncnumreg($resulttabla);
		
		for($i = 0; $i < $num; $i++)
		{
			$sbregtabla = fncfetch($resulttabla,$i);
			
			if($sbregtabla[tablnomb] == "turno")
			{
				$tablcodi = $sbregtabla['tablcodi'];
				break;
			}
		}

		$iRegCampo["tablcodi"] = $tablcodi;
		$resultcampo = dinamicscancampo($iRegCampo,$nuconn);
		$num = fncnumreg($resultcampo);
		
		while($elementos = each($iRegturno))
		{
		    $iRegCampo["campnomb"] = $elementos[0];
			$resultcampo = dinamicscancampo($iRegCampo,$nuconn);
			$num = fncnumreg($resultcampo);
			
			if($num>0)
			{
				$sbregcampo = fncfetch($resultcampo,0);
				
				if($elementos[0] != "turnocodigo")
				{
					if($sbregcampo["campnomb"] == $elementos[0])
					{
						$respuesta = strcmp($sbregcampo["campnotnull"],"t");
						
						if($respuesta == 0)
						{
							if($elementos[1] == "")
							{
								$campnomb[$elementos[0]] = 1;
								$flagnuevoturno = 1;
								$flagerror = 1;
							}
						}
					}
				}
			}
			$validar = buscacaracter($elementos[1]); 
			
			if($validar == 1)
			{ 
				$flagnuevoturno = 1; 
				$flagerror = 1; 
				$campnomb[$elementos[0]] = 1;
			} 
			$validresult = consulmetaturno($elementos[0],$elementos[1],$nuconn); 
			
			if ($validresult == 1)
			{			
				$flagnuevoturno = 1; 
				$flagerror = 1; 
				$campnomb[$elementos[0]] = 1;
				unset ($validresult); 
			} 
			
			/*
			if($elementos[0]=='turnonombre')
			{
				if($elementos[1] != null)
				{
					$validnombre =  fncnombexs('turno',$iRegturno,$elementos[0],$elementos[1],$nuconn);
					
					if ($validnombre == 1)
					{
						fncmsgerror(errorNombExs);
						$flagnuevoturno = 1;
						$flagerror = 1;
						$campnomb[$elementos[0]] = 1;
						unset ($validnombre);
					}
				}
				else
				{
					$flagnuevoturno = 1;
					$flagerror = 1;
					$campnomb[$elementos[0]] = 1;
				}
			}
			*/
		}
		
		if($flagerror == 1)
			fncmsgerror(errorIng);
		
		if($flagerror != 1)
		{ 
			$result = insrecordturno($iRegturno,$nuconn); 
			
			if($result < 0 )
			{ 
				ob_end_clean(); 
				fncmsgerror(errorReg); 
				$flagnuevoturno = 1; 
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

/*
include ('../src/FunGen/fncdatediff.php');

if(datediff("n", $turnohorini, $turnohorfin) <= 0)
{
	$campnomb["turnohorini"] = 1;
	$campnomb["turnohorfin"] = 1;
	
	echo "<script language='JavaScript'>";
	echo "alert('Error: La hora de inicio debe ser mayor a la hora fin');";
	echo "</script>";
	
	$flagnuevoturno = 1;
}
else
{ */
	$iRegturno[turnocodigo] = $turnocodigo; 
	$iRegturno[turnonombre] = $turnonombre; 
	$iRegturno[turnoacroni] = $turnoacroni; 
	$iRegturno[turnohorini] = $turnohorini; 
	$iRegturno[turnohorfin] = $turnohorfin; 

	grabaturno($iRegturno,$flagnuevoturno,$campnomb);
//}