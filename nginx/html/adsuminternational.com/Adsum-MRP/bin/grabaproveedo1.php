<?php 
/*
-Todos los derechos reservados-
Propiedad intelectual de Adsum (c).
Funcion         : grabaproveedo1
Decripcion      : Valida la data a grabar y la lleva al paquete.
Parametros      : Descripicion
$iRegproveedo1         Arreglo de datos.
$flagnuevoproveedo1    Bandera de validaci�n
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
include ( '../src/FunPerPriNiv/pktblproveedo.php');
include ('../src/FunPerPriNiv/pktblproveefabri.php');
include ( '../src/FunPerPriNiv/pktblcampo.php');
include ( '../src/FunPerPriNiv/pktbltabla.php');
include ( '../src/FunGen/buscacaracter.php');
include ( '../src/FunGen/fncmsgerror.php');
include( '../src/FunGen/fncnombexs.php');
function grabaproveedo1($iRegproveedo1,&$flagnuevoproveedo1,&$campnomb)
{
	$nuconn = fncconn();
	//	No utilice esta parte si va a utilizar la llave primaria como serial
	define("idproveedo",12);
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

	$nuidtemp = fncnumact(idproveedo,$nuconn);
	do
	{
		$nuresult = loadrecordproveedo($nuidtemp,$nuconn);
		if($nuresult == e_empty)
		{
			$iRegproveedo1[proveecodigo] = $nuidtemp;
			$idprovee=$nuidtemp;
		}
		$nuidtemp ++;
	}while ($nuresult != e_empty);
	//$nuresult1 = fncnumprox(id,$nuidtemp,$nuconn);
	//	No utilice esta parte si va a utilizar la llave primaria como serial

	if($iRegproveedo1)
	{
		$iRegtabla["tablnomb"] = "proveedo";
		$resulttabla = dinamicscantabla($iRegtabla,$nuconn);
		$num = fncnumreg($resulttabla);
		for($i=0;$i<$num;$i++)
		{
			$sbregtabla = fncfetch($resulttabla,$i);
			if($sbregtabla[tablnomb] == "proveedo")
			{
				$tablcodi=$sbregtabla['tablcodi'];
				break;
			}
		}

		$iRegCampo["tablcodi"]=$tablcodi;
		$resultcampo=dinamicscancampo($iRegCampo,$nuconn);
		$num = fncnumreg($resultcampo);

		while($elementos = each($iRegproveedo1))
		{
			$iRegCampo["campnomb"] = $elementos[0];
			$resultcampo = dinamicscancampo($iRegCampo,$nuconn);
			$num = fncnumreg($resultcampo);
			if($num>0)
			{
				$sbregcampo = fncfetch($resultcampo,0);
				if($elementos[0] != "proveecodigo")
				{
					if($sbregcampo["campnomb"] == $elementos[0])
					{
						$respuesta = strcmp($sbregcampo["campnotnull"],"t");
						if($respuesta == 0)
						{
							if($elementos[1] == "")
							{
								$campnomb[$elementos[0]] = 1;
								$flagnuevoproveedo1 = 1;
								$flagerror = 1;
							}
						}
					}
				}
			}
			$validar = buscacaracter($elementos[1]);

			if($validar == 1)
			{
				$flagnuevoproveedo1 = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;
			}
			$validresult = consulmetaproveedo($elementos[0],$elementos[1],$nuconn);

			if($validresult == 1)
			{
				$flagnuevoproveedo1 = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;
				unset ($validresult);
			}

			if($elementos[0] == 'proveeemail')
			{
				if($elementos[1] != null)
				{
					if (!ereg("^[_a-zA-Z0-9-]+(\.[_a-zA-Z0-9-]+)*@+([_a-zA-Z0-9-]+\.)*[a-zA-Z0-9-]{2,200}\.[a-zA-Z]{2,6}$",$elementos[1]) )
					{
						fncmsgerror(errormail);
						$flagnuevoproveedo1 = 1;
						$flagerror = 1;
						$campnomb[$elementos[0]] = 1;
					}
				}
				else
				{
					$flagnuevoproveedo1 = 1;
					$flagerror = 1;
					$campnomb[$elementos[0]] = 1;
				}
			}

			if($elementos[0]=='proveenombre')
			{
				if($elementos != null)
				{
					$validnombre =  fncnombexs('proveedo',$iRegproveedo1,$elementos[0],$elementos[1],$nuconn);
					if ($validnombre == 1)
					{
						fncmsgerror(errorNombExs);
						$flagnuevoproveedo1 = 1;
						$flagerror = 1;
						$campnomb[$elementos[0]] = 1;
						unset ($validnombre);
					}
				}
				else
				{
					$flagnuevoproveedo1 = 1;
					$flagerror = 1;
					$campnomb[$elementos[0]] = 1;
				}
			}

			if($elementos[0] == 'proveerepleg' && $elementos[1] == null)
			{
				$flagnuevoproveedo1 = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;
			}

			if($elementos[0] == 'proveetelefo' && $elementos[1] == null)
			{
				$flagnuevoproveedo1 = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;
			}

			if($elementos[0] == 'proveepais' && $elementos[1] == null)
			{
				$flagnuevoproveedo1 = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;
			}
			
//			if($elementos[0] == 'proveeciudad' && $elementos[1] == null)
//			{
//				$flagnuevoproveedo1 = 1;
//				$flagerror = 1;
//				$campnomb[$elementos[0]] = 1;
//			}

			if($elementos[0] == 'proveedirecc' && $elementos[1] == null)
			{
				$flagnuevoproveedo1 = 1;
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
			$result = insrecordproveedo($iRegproveedo1,$nuconn);
			if($result < 0 )
			{
				fncmsgerror(errorReg);
				$flagnuevoproveedo1=1;
				return false;
			}

			if($result > 0)
			{
				$nuresult1 = fncnumprox(idproveedo,$nuidtemp,$nuconn); 	//	No utilice esta parte si va a utilizar la llave primaria como serial //
				fncmsgerror(grabaEx);
				return $idprovee;
				
			}
			fncclose($nuconn);
		}
	}
			return $idprovee;
}
$iRegproveedo1[proveecodigo] = $proveecodigo;
$iRegproveedo1[proveenombre] = $proveenombre;
$iRegproveedo1[proveerepleg] = $proveerepleg;
$iRegproveedo1[proveetelefo] = $proveetelefo;
$iRegproveedo1[proveefax] = $proveefax;
$iRegproveedo1[proveepais] = $proveepais;
$iRegproveedo1[proveeciudad] = $proveeciudad;
$iRegproveedo1[proveedirecc] = $proveedirecc;
$iRegproveedo1[proveeurl] = $proveeurl;
$iRegproveedo1[proveeemail] = $proveeemail;
$iRegproveedo1[proveenota] = $proveenota;
$iRegproveedo1[proestcodigo] = $proestcodigo;
$iRegproveedo1[proveepostal] = $proveepostal;
$iRegproveedo1[proveecontac] = $proveecontac;
$iRegproveedo1[proveetelcon] = $proveetelcon;
$iRegproveedo1[tipprocodigo] = $tipprocodigo;
$proveecodi=grabaproveedo1($iRegproveedo1,$flagnuevoproveedo1,$campnomb);

if(!$flagnuevoproveedo1)
{
	$idcon = fncconn();
	if($arrfabricanteprovee){
		
		if($arrfabricanteprovee)
		{
			$rowarrfabricanteprovee = explode(',',$arrfabricanteprovee);
			delrecordproveefabri($proveecodi,$idcon);
		}
		for($a = 0; $a < count($rowarrfabricanteprovee);$a++)
		{
			$iRegfabricanteprovee[proveecodigo] = $proveecodi;
			$iRegfabricanteprovee[fabricodigo] = $rowarrfabricanteprovee[$a];	
			insrecordproveefabri($iRegfabricanteprovee,$idcon);
		}
	}
}
?> 
