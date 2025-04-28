<?php 
/*
-Todos los derechos reservados-
Propiedad intelectual de Adsum (c).
Funcion         : grabagrupcapa
Decripcion      : Valida la data a grabar y la lleva al paquete.
Parametros      : Descripicion
$iReggrupcapa         Arreglo de datos.
$flagnuevogrupcapa    Bandera de validaci�n
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
include ( '../src/FunPerPriNiv/pktblinsgrupcapa.php');
include ( '../src/FunPerPriNiv/pktblcampo.php');
include ( '../src/FunPerPriNiv/pktbltabla.php');
include ( '../src/FunGen/buscacaracter.php');
include ( '../src/FunGen/fncmsgerror.php');
include( '../src/FunGen/fncnombexs.php');

function grabagrupcapa($iReggrupcapa,&$flagnuevogrupcapa,&$campnomb,&$grucapcodigo )
{
	$nuconn = fncconn();
	//	No utilice esta parte si va a utilizar la llave primaria como serial
	define("id",44);
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
		$nuresult = loadrecordgrupcapa($nuidtemp,$nuconn);
		if($nuresult == e_empty)
		{
			$iReggrupcapa[grucapcodigo] = $nuidtemp;
			$grucapcodigo = $nuidtemp;
		}
		$nuidtemp ++;
	}while ($nuresult != e_empty);


	//	No utilice esta parte si va a utilizar la llave primaria como serial

	if($iReggrupcapa)
	{
		$iRegtabla["tablnomb"] = "grupcapa";
		$resulttabla = dinamicscantabla($iRegtabla,$nuconn);
		$num = fncnumreg($resulttabla);
		for($i=0;$i<$num;$i++)
		{
			$sbregtabla = fncfetch($resulttabla,$i);
			if($sbregtabla[tablnomb] == "grupcapa")
			{
				$tablcodi=$sbregtabla['tablcodi'];
				break;
			}
		}

		$iRegCampo["tablcodi"]=$tablcodi;
		$resultcampo=dinamicscancampo($iRegCampo,$nuconn);
		$num = fncnumreg($resultcampo);
		$iReggrupcapa_b = $iReggrupcapa;

		while($elementos = each($iReggrupcapa))
		{
			$iRegCampo["campnomb"] = $elementos[0];
			$resultcampo = dinamicscancampo($iRegCampo,$nuconn);
			$num = fncnumreg($resultcampo);
			if($num>0)
			{
				$sbregcampo = fncfetch($resultcampo,0);
//				if($elementos[0] != "grupcapacodigo")
//				{
					if($sbregcampo["campnomb"] == $elementos[0])
					{
						$respuesta = strcmp($sbregcampo["campnotnull"],"t");
						if($respuesta == 0)
						{
							if($elementos[1] == "")
							{
								$campnomb[$elementos[0]] = 1;
								$flagnuevogrupcapa = 1;
								$flagerror = 1;
							}
						}
					}
//				}
			}
			
			$validar = buscacaracter($elementos[1]);

			if($validar == 1)
			{
				$flagnuevogrupcapa = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;

			}
		
			
			$validresult = consulmetagrupcapa($elementos[0],$elementos[1],$nuconn);

			if($validresult == 1)
			{
				$flagnuevogrupcapa = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;
				unset ($validresult);
			}
			
			

			if($elementos[0]=='grupcapnombre' && $elementos[1])
			{

				$validnombre =  fncnombexs('grupcapa',$iReggrupcapa_b,$elementos[0],$elementos[1],$nuconn);
				if ($validnombre == 1)
				{
					fncmsgerror(errorNombExs);
					$flagnuevogrupcapa = 1;
					$flagerror = 1;
					$campnomb[$elementos[0]] = 1;
					unset ($validnombre);
				}
			}
			
		}

		if($flagerror == 1)
			fncmsgerror(errorIng);

		if($flagerror != 1)
		{
			$result = insrecordgrupcapa($iReggrupcapa,$nuconn);
			
			if($result < 0 )
			{
				ob_end_clean();
				fncmsgerror(errorReg);
				$flagnuevogrupcapa=1;
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

$iReggrupcapa[grucapcodigo] = $grucapcodigo;
$iReggrupcapa[grucapnombre] = $grucapnombre;
$iReggrupcapa[grucapdescri] = $grucapdescri;

grabagrupcapa($iReggrupcapa,$flagnuevogrupcapa,$campnomb, $grucapcodigo);

if(!$flagnuevogrupcapa)
{
	if($lstempleado)
	{
		$idcon = fncconn();
		$nuidtemp = fncnumact(106, $idcon);
		do
		{
			$nuresult = loadrecordinsgrupcapa($nuidtemp, $idcon);
			if($nuresult == e_empty)
				$insgrucodigo = $nuidtemp;
			$nuidtemp ++;
		}while ($nuresult != e_empty);
		
		$arrObject = explode(',', $lstempleado);
		
		for($i = 0; $i < count($arrObject); $i++)
		{
			$iReginsgrupcapa[insgrucodigo] = $insgrucodigo;
			$iReginsgrupcapa[grucapcodigo] = $grucapcodigo;
			$iReginsgrupcapa[usuacodi] = $arrObject[$i];
			$resultado = insrecordinsgrupcapa($iReginsgrupcapa,$idcon);
			
			$insgrucodigo ++;
		}
		$nuresult1 = fncnumprox(106,$insgrucodigo,$idcon);
	}
	unset($lstempleado);
}
