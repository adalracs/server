<?php 
/*
-Todos los derechos reservados-
Propiedad intelectual de Adsum (c).
Funcion         : grabaparte
Decripcion      : Valida la data a grabar y la lleva al paquete.
Parametros      : Descripicion
$iRegparte         Arreglo de datos.
$flagnuevoparte    Bandera de validaci�n
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
include ( '../src/FunPerPriNiv/pktblparte.php');
include ( '../src/FunPerPriNiv/pktblcampo.php');
include ( '../src/FunPerPriNiv/pktbltabla.php');
include ( '../src/FunGen/datecmp.php');
include ( '../src/FunGen/buscacaracter.php');
include ( '../src/FunGen/fncmsgerror.php');
include( '../src/FunGen/fncnombexs.php');
function grabaparte($iRegparte,&$flagnuevoparte,&$fecactual,&$campnomb)
{
	$nuconn = fncconn();
	//	No utilice esta parte si va a utilizar la llave primaria como serial
	define("id",27);
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
		$nuresult = loadrecordparte($nuidtemp,$nuconn);
		if($nuresult == e_empty)
		{
			$iRegparte[partecodigo] = $nuidtemp;
		}
		$nuidtemp ++;
	}while ($nuresult != e_empty);
	//$nuresult1 = fncnumprox(id,$nuidtemp,$nuconn);
	//	No utilice esta parte si va a utilizar la llave primaria como serial
	if($iRegparte)
	{
		$iRegtabla["tablnomb"] = "parte";
		$resulttabla = dinamicscantabla($iRegtabla,$nuconn);
		$num = fncnumreg($resulttabla);

		for($i=0;$i<$num;$i++)
		{
			$sbregtabla = fncfetch($resulttabla,$i);
			if($sbregtabla[tablnomb] == "parte")
			{
				$tablcodi=$sbregtabla['tablcodi'];
				break;
			}
		}

		$iRegCampo["tablcodi"]=$tablcodi;
		$resultcampo=dinamicscancampo($iRegCampo,$nuconn);
		$num = fncnumreg($resultcampo);
		
		while($elementos = each($iRegparte))
		{
			$iRegCampo["campnomb"] = $elementos[0];
			$resultcampo = dinamicscancampo($iRegCampo,$nuconn);
			$num = fncnumreg($resultcampo);
			if($num>0)
			{
				$sbregcampo = fncfetch($resultcampo,0);
				if($elementos[0] != "partecodigo")
				{
					if($sbregcampo["campnomb"] == $elementos[0])
					{
						$respuesta = strcmp($sbregcampo["campnotnull"],"t");
						if($respuesta == 0)
						{
							if($elementos[1] == "")
							{
								$campnomb[$elementos[0]] = 1;
								$flagnuevoparte = 1;
								$flagerror = 1;
							}
						}
					}
				}
			}
			$validar = buscacaracter($elementos[1]);

			if($validar == 1)
			{
				$flagnuevoparte = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;
			}
			$validresult = consulmetaparte($elementos[0],$elementos[1],$nuconn);

			if($validresult == 1)
			{
				$flagnuevoparte = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;
				unset ($validresult);
			}
			
			if($elementos[0]=='partenombre')
			{
				if($elementos[1] != null)
				{
					$validnombre =  fncnombexs('parte',$iRegparte,$elementos[0],$elementos[1],$nuconn);
					if ($validnombre == 1)
					{
						fncmsgerror(errorNombExs);
						$flagnuevoparte = 1;
						$flagerror = 1;
						$campnomb[$elementos[0]] = 1;
						unset ($validnombre);
					}
				}else 
				{
					$flagnuevoparte = 1;
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
			if (($iRegparte[partefeccom]) and ($fecactual))
			{
				$comparar = datecmp($iRegparte[partefeccom],$fecactual);
				if($comparar < 1)
				{
					if (($iRegparte[partefeccom]) and ($iRegparte[partefecins]))
					{
						$comparar=datecmp($iRegparte[partefeccom],$iRegparte[partefecins]);
						if($comparar < 1)
						{
							if(($iRegparte[partefeccom]) and ($iRegparte[partevengar]))
							{
								$comparar = datecmp($iRegparte[partefeccom],$iRegparte[partevengar]);

								if ($comparar < 1 )
								{
									$result = insrecordparte($iRegparte,$nuconn);
									if($result < 0 )
									{
										ob_end_clean();
										fncmsgerror(errorReg);
										$flagnuevoparte=1;
									}
									if($result > 0)
									{
										$nuresult1 = fncnumprox(id,$nuidtemp,$nuconn); 	//	No utilice esta parte si va a utilizar la llave primaria como serial //
										fncmsgerror(grabaEx);
									}
									fncclose($nuconn);
								}
								else
								{
									if($comparar == 2)
									{
										fncmsgerror(fecvalid);
										$flagnuevoparte=1;
										unset($comparar);
									}
									else
									{
										fncmsgerror(venccomp);
										$flagnuevoparte=1;
										$campnomb = "equipovengar";
										unset($comparar);
									}
								}
							}
							else
							{
								$result = insrecordparte($iRegparte,$nuconn);
								if($result < 0 )
								{
									ob_end_clean();
									fncmsgerror(errorReg);
									$flagnuevoparte=1;
								}
								if($result > 0)
								{
									$nuresult1 = fncnumprox(id,$nuidtemp,$nuconn); 	//	No utilice esta parte si va a utilizar la llave primaria como serial //
									fncmsgerror(grabaEx);
								}
								fncclose($nuconn);
							}
						}
						else
						{
							if($comparar == 2)
							{
								fncmsgerror(fecvalid);
								$flagnuevoparte=1;
								unset($comparar);
							}
							else
							{
								fncmsgerror(compinst);
								$flagnuevoparte = 1;
								$campnomb = "equipofecins";
								unset($comparar);
							}
						}
					}
				}
				else
				{
					if($comparar == 2)
					{
						fncmsgerror(fecvalid);
						$flagnuevoparte = 1;
						unset($comparar);
					}else
					{
						fncmsgerror(compactu);
						$flagnuevoparte = 1;
						$campnomb = "equipofeccom";
						unset($comparar);
					}
				}
			}
		}
	}
}
$iRegparte[partecodigo] = $partecodigo;
$iRegparte[componcodigo] = $componcodigo;
$iRegparte[partenombre] = $partenombre;
$iRegparte[partedescri] = $partedescri;
$iRegparte[partefabric] = $partefabric;
$iRegparte[partemarca] = $partemarca;
$iRegparte[partemodelo] = $partemodelo;
$iRegparte[parteserie] = $parteserie;
$iRegparte[partefeccom] = $partefeccom;
$iRegparte[partefecins] = $partefecins;
$iRegparte[partecinv] = $partecinv;
$iRegparte[partevengar] = $partevengar;
$iRegparte[parteviduti] = $parteviduti;
grabaparte($iRegparte,$flagnuevoparte,$fecactual,$campnomb);
?> 
