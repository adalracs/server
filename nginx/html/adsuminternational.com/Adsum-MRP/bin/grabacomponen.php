<?php 
/*
-Todos los derechos reservados-
Propiedad intelectual de Adsum (c).
Funcion         : grabacomponen
Decripcion      : Valida la data a grabar y la lleva al paquete.
Parametros      : Descripicion
$iRegcomponen         Arreglo de datos.
$flagnuevocomponen    Bandera de validaci�n
Retorno         :
true	= 1
false	= 0
Autor           : ariascos
Escrito con     : WAG Adsum versi�n 3.1.1
Fecha           : 18082004

    Historia de Modificaciones
    Fecha	    |    Autor      	 |   Modificacion
    07-09-2007   cbedoya			  Adaptacion para campos personalizados de componente
*/

include ( '../src/FunGen/fncnumprox.php');
include ( '../src/FunGen/fncnumact.php');
include ( '../def/tipocampo.php');
include ( '../src/FunPerPriNiv/pktblcomponen.php');
include ( '../src/FunPerPriNiv/pktblcampo.php');
include ( '../src/FunPerPriNiv/pktbltabla.php');
include ( '../src/FunGen/datecmp.php');
include ( '../src/FunGen/buscacaracter.php');
include ( '../src/FunGen/fncmsgerror.php');
include( '../src/FunGen/fncnombexs.php');
function grabacomponen($iRegcomponen,&$flagnuevocomponen,&$fecactual,&$campnomb, &$componeqcamprr, &$iRegequicamper)
{
	$nuconn = fncconn();
	//	No utilice esta parte si va a utilizar la llave primaria como serial
	define("id",26);
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
/*
	$nuidtemp = fncnumact(	id,$nuconn);
	do
	{
		$nuresult = loadrecordcomponen($nuidtemp,$nuconn);
		if($nuresult == e_empty)
		{
			$iRegcomponen[componcodigo] = $nuidtemp;
			
		}
		$nuidtemp ++;
	}while ($nuresult != e_empty);*/
	//$nuresult1 = fncnumprox(id,$nuidtemp,$nuconn);
	//	No utilice esta parte si va a utilizar la llave primaria como serial
	$componeqcamprr = $iRegcomponen[componcodigo];
	if($iRegcomponen)
	{
		$iRegtabla["tablnomb"] = "componen";
		$resulttabla = dinamicscantabla($iRegtabla,$nuconn);
		$num = fncnumreg($resulttabla);
		for($i=0;$i<$num;$i++)
		{
			$sbregtabla = fncfetch($resulttabla,$i);
			if($sbregtabla[tablnomb] == "componen")
			{
				$tablcodi=$sbregtabla['tablcodi'];
				break;
			}
		}

		$iRegCampo["tablcodi"]=$tablcodi;
		$resultcampo = dinamicscancampo($iRegCampo,$nuconn);
		$num = fncnumreg($resultcampo);

		while($elementos = each($iRegcomponen))
		{
			$iRegCampo["campnomb"] = $elementos[0];
			$resultcampo = dinamicscancampo($iRegCampo,$nuconn);
			$num = fncnumreg($resultcampo);
			if($num>0)
			{
				$sbregcampo = fncfetch($resultcampo,0);
			//	if($elementos[0] != "componcodigo")
			//	{
					if($sbregcampo["campnomb"] == $elementos[0])
					{
						$respuesta = strcmp($sbregcampo["campnotnull"],"t");
						if($respuesta == 0)
						{
							if($elementos[1] == "")
							{
								$campnomb[$elementos[0]] = 1;
								$flagnuevocomponen = 1;
								$flagerror = 1;
							}
						}
					}
				//}
			}
			$validar = buscacaracter($elementos[1]);

			if($validar == 1)
			{
				$flagnuevocomponen = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;
			}
			$validresult = consulmetacomponen($elementos[0],$elementos[1],$nuconn);

			if($validresult == 1)
			{
				$flagnuevocomponen = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;
				unset ($validresult);
			}

			if($elementos[0]=='componnombre')
			{
				if($elementos[1] != null)
				{
					$validnombre =  fncnombexs('componen',$iRegcomponen,$elementos[0],$elementos[1],$nuconn);
					if ($validnombre == 1)
					{
						fncmsgerror(errorNombExs);
						$flagnuevocomponen = 1;
						$flagerror = 1;
						$campnomb[$elementos[0]] = 1;
						unset ($validnombre);
					}
				}
				else 
				{
					$flagnuevocomponen = 1;
					$flagerror = 1;
					$campnomb[$elementos[0]] = 1;
				}
			}
			//cbedoya --

			if($elementos[0] == "tipcomcodigo")
			{

				if($elementos[1] == "")
				{
					$flagnuevocomponen = 1;
					$flagerror = 1;
					$campnomb[$elementos[0]] = 1;
				}
			}
		}

		while ($element_cam = each($iRegequicamper)) {
			$validar_cam = buscacaracter($element_cam[1]);

			if($validar_cam == 1)
			{
				$flagnuevocomponen = 1;
				$flagerror = 1;
				$campnomb[$element_cam[0]] = 1;
			}
		}
		

		
		if($flagerror == 1)
		{
			fncmsgerror(errorIng);
		}
		if($flagerror != 1)
		{
			/*if (($iRegcomponen[componfeccom]) and ($fecactual))
			{
				$comparar = datecmp($iRegcomponen[componfeccom],$fecactual);
				if($comparar < 1)
				{
					if (($iRegcomponen[componfeccom]) and ($iRegcomponen[componfecins]))
					{
						$comparar = datecmp($iRegcomponen[componfeccom],$iRegcomponen[componfecins]);
						if($comparar < 1)
						{
							if(($iRegcomponen[componfeccom]) and ($iRegcomponen[componvengar]))
							{
								$comparar = datecmp($iRegcomponen[componfeccom],$iRegcomponen[componvengar]);

								if ($comparar < 1 )
								{*/
									$result = insrecordcomponen($iRegcomponen,$nuconn);
									if($result < 0 )
									{
										ob_end_clean();
										fncmsgerror(errorReg);
										$flagnuevocomponen = 1;
									}
									if($result > 0)
									{
										$nuresult1 = fncnumprox(id,$nuidtemp,$nuconn); 	//	No utilice esta parte si va a utilizar la llave primaria como serial //
										fncmsgerror(grabaEx);
									}
									fncclose($nuconn);
							/*	}
								else
								{
									if($comparar == 2)
									{
										fncmsgerror(fecvalid);
										$flagnuevocomponen = 1;
										unset($comparar);
									}
									else
									{
										fncmsgerror(venccomp);
										$flagnuevocomponen = 1;
										$campnomb = "componvengar";
										unset($comparar);
									}
								}
							}
							else
							{
								$result = insrecordcomponen($iRegcomponen,$nuconn);
								if($result < 0 )
								{
									ob_end_clean();
									fncmsgerror(errorReg);
									$flagnuevocomponen = 1;
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
								$flagnuevocomponen = 1;
								unset($comparar);
							}
							else
							{
								fncmsgerror(compinst);
								$flagnuevocomponen = 1;
								$campnomb = "componfecins";
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
						$flagnuevocomponen = 1;
						unset($comparar);
					}else
					{
						fncmsgerror(compactu);
						$flagnuevocomponen = 1;
						$campnomb = "componfeccom";
						unset($comparar);
					}
				}
			}*/
		}
	}
}
$iRegcomponen[componcodigo] = $componcodigo;
$iRegcomponen[equipocodigo] = $equipocodigo;
$iRegcomponen[componnombre] = $componnombre;
$iRegcomponen[compondescri] = $compondescri;
$iRegcomponen[componfabric] = $componfabric;
$iRegcomponen[componmarca] = $componmarca;
$iRegcomponen[componmodelo] = $componmodelo;
$iRegcomponen[componserie] = $componserie;
$iRegcomponen[componfeccom] = $componfeccom;
$iRegcomponen[componfecins] = $componfecins;
$iRegcomponen[componcinv] = $componcinv;
$iRegcomponen[componvengar] = $componvengar;
$iRegcomponen[componviduti] = $componviduti;
$iRegcomponen[componubicac] = $componubicac;
$iRegcomponen[componalto] = $componalto;
$iRegcomponen[componlargo] = $componlargo;
$iRegcomponen[componancho] = $componancho;
$iRegcomponen[componpeso] = $componpeso;
$iRegcomponen[tipcomcodigo] = $tipcomcodigo;




$arr_campers = explode(";",$arreglo_cam);

foreach ($arr_campers as $x)
{
	$arr_text = explode(":",$x);
	$iRegequicamper[$arr_text[0]] = $arr_text[1];
}

grabacomponen($iRegcomponen,$flagnuevocomponen,$fecactual,$campnomb,$componeqcamprr,$iRegequicamper);

if(!$flagnuevocomponen){
	if($iRegequicamper)
	  {include('grabacomponencamperequipo.php');}
	
  	echo '<script language="javascript">';
	echo "alert('Grabado exitoso');";
	echo "</script>";
}