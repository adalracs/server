<?php 
/*
-Todos los derechos reservados-
Propiedad intelectual de Adsum (c).
Funcion         : grabareportot
Decripcion      : Valida la data a grabar y la lleva al paquete.
Parametros      : Descripicion
$iRegreportot         Arreglo de datos.
$flagnuevoreportot    Bandera de validaci�n
Retorno         :
true	= 1
false	= 0
Autor           : ariascos
Escrito con     : WAG Adsum versi�n 3.1.1
Fecha           : 18082004
Historial de modificaciones
| Fecha 	| Motivo												| Autor 	|

 08082005	 Integrar funcionalidad con las tablas transacherramie,	 jcortes	
			 reportotherramie,transacitem, reportotitem
			 
 24012006	 Integrar funcionalidad con OT, REPORTOT, 
*/

function grabareportot(&$iRegreportot,&$flagnuevoreportot,&$campnomb,&$reportcodigo)
{
	$nuconn = fncconn();
	//	No utilice esta parte si va a utilizar la llave primaria como serial
	define("idreportot",60);
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
	
	$nuidtemp = fncnumact(idreportot,$nuconn);
	do
	{
		$nuresult = loadrecordreportot($nuidtemp,$nuconn);
		if($nuresult == e_empty)
		{
			$iRegreportot[reportcodigo] = $nuidtemp;
		}
		$nuidtemp ++;
	}while ($nuresult != e_empty);

	if($iRegreportot)
	{
		$iRegtabla["tablnomb"] = "reportot";
		$resulttabla = dinamicscantabla($iRegtabla,$nuconn);
		$num = fncnumreg($resulttabla);
		for($i=0;$i<$num;$i++)
		{
			$sbregtabla = fncfetch($resulttabla,$i);
			if($sbregtabla[tablnomb] == "reportot")
			{
				$tablcodi=$sbregtabla['tablcodi'];
				break;
			}
		}

		$iRegCampo["tablcodi"] = $tablcodi;
		$resultcampo = dinamicscancampo($iRegCampo,$nuconn);
		$num = fncnumreg($resultcampo);
		
		while($elementos = each($iRegreportot))
		{
			$iRegCampo["campnomb"] = $elementos[0];
			$resultcampo = dinamicscancampo($iRegCampo,$nuconn);
			$num = fncnumreg($resultcampo);
			if($num>0)
			{
				$sbregcampo = fncfetch($resultcampo,0);
				if($elementos[0] != "reportcodigo")
				{
					if($sbregcampo["campnomb"] == $elementos[0])
					{
						$respuesta = strcmp($sbregcampo["campnotnull"],"t");
						if($respuesta == 0)
						{
							if($elementos[1] == "")
							{
								$campnomb[$elementos[0]] = 1;
								$flagnuevoreportot = 1;
								$flagerror = 1;
							}
						}
					}
				}
			}
			$validar = buscacaracter($elementos[1]);

			if($validar == 1)
			{
				$flagnuevoreportot = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;
			}
			$validresult = consulmetareportot($elementos[0],$elementos[1],$nuconn);

			if($validresult == 1)
			{
				$flagnuevoreportot = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;
				unset ($validresult);
			}
			
			if (($elementos[0] == "ordtracodigo") && ($elementos[1] == ""))
			{
				$flagnuevoreportot = 1;
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
			$result = insrecordreportot($iRegreportot,$nuconn);
			if($result < 0 )
			{
				ob_end_clean();
				fncmsgerror(errorReg);
				$flagnuevoreportot=1;
			}
			if($result > 0)
			{

				$reportcodigo = $iRegreportot[reportcodigo];
				$nuresult1 = fncnumprox(idreportot,$nuidtemp,$nuconn);
				//No utilice esta parte si va a utilizar la llave primaria como serial
				//fncmsgerror(grabaEx);
			}
			fncclose($nuconn);
		}
	}
}
?>