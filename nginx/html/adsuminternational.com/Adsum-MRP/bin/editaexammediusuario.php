<?php 
include ( '../src/FunGen/fncnumprox.php');
include ( '../src/FunGen/fncnumact.php');
include ( '../def/tipocampo.php');
include ( '../src/FunPerPriNiv/pktblexammediusuario.php');
include ( '../src/FunPerPriNiv/pktblcampo.php');
include ( '../src/FunPerPriNiv/pktbltabla.php');
include ( '../src/FunGen/buscacaracter.php');
include ( '../src/FunGen/fncmsgerror.php');

function editaexammediusuario($iRegexammediusuario,&$flageditarexammediusuario,&$campnomb,&$bandera)
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
	define("errorIng",35);
	
	$nuidtemp = fncnumact(id,$nuconn);
	do
	{
		$nuresult = loadrecordexammediusuario($nuidtemp,$nuconn);
		if($nuresult == e_empty)
		{
			$iRegexammediusuario[exmusucodigo] = $nuidtemp;
		}
		$nuidtemp ++;
	}while ($nuresult != e_empty);
	$nuresult1 = fncnumprox(id,$nuidtemp,$nuconn);
	//	No utilice esta parte si va a utilizar la llave primaria como serial
	if ($iRegexammediusuario) 
	{ 
		$iRegtabla["tablnomb"] = "exammediusuario";
		$resulttabla = dinamicscantabla($iRegtabla,$nuconn);
		$num = fncnumreg($resulttabla);
		
		for($i=0;$i<$num;$i++)
		{
			$sbregtabla = fncfetch($resulttabla,$i);
			
			if($sbregtabla[tablnomb] == "exammediusuario")
			{
				$tablcodi=$sbregtabla['tablcodi'];
				break;
			}
		}
		$iRegCampo["tablcodi"] = $tablcodi;
		$resultcampo = dinamicscancampo($iRegCampo,$nuconn);
		$num = fncnumreg($resultcampo);
				
		while($elementos = each($iRegexammediusuario))
		{ 
			$iRegCampo["campnomb"] = $elementos[0];
			$resultcampo = dinamicscancampo($iRegCampo,$nuconn);
			$num = fncnumreg($resultcampo);
			if($num>0)
			{
				$sbregcampo = fncfetch($resultcampo,0);
				if($elementos[0] != "exmusucodigo")
				{
					if($sbregcampo["campnomb"] == $elementos[0])
					{
						$respuesta = strcmp($sbregcampo["campnotnull"],"t");
						if($respuesta == 0)
						{
							if($elementos[1] == "")
							{
								$campnomb[$elementos[0]] = 1;
								$flageditarexammediusuario = 1;
								$flagerror = 1;
							}
						}
					}
				}
			}			
			$validar = buscacaracter($elementos[1]);
			
			if($validar == 1) 
			{ 
				$flageditarexammediusuario = 1; 
				$flagerror = 1; 
				$campnomb[$elementos[0]] = 1;
			}		
			$validresult = consulmetaexammediusuario($elementos[0],$elementos[1],$nuconn);
			
			if ($validresult == 1)
			{
				$flageditarexammediusuario = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;
				unset ($validresult);
			}
		}
		
		if($flagerror == 1)
		{
			fncmsgerror(errorIng);
		}
		
		if($flagerror != 1)
		{
			$result = insrecordexammediusuario($iRegexammediusuario,$nuconn);
			if($result < 0 )
			{
				ob_end_clean();
				fncmsgerror(errorReg);
				$flageditarexammediusuario=1;
			}
			if($result > 0)
			{
				if ($bandera == 1)
				{
					fncmsgerror(editaEx);
					echo '<script language="javascript">';
					echo '<!--//'."\n";
					echo 'location ="maestablexammediusuario.php?codigo='.$codigo.';"';
					echo '//-->'."\n";
					echo '</script>';
				}
			}
			fncclose($nuconn);
		}
	}
}
//Validaci�n
/*
-Todos los derechos reservados-
Propiedad intelectual de Adsum (c).
Funcion         : validacupo
Decripcion      :
Autor           : lfolaya
Escrito con     : WAG Adsum versi�n 3.1.1
Fecha           : 15112004
Historial de modificaciones
| Fecha  | Motivo																	| Autor 	|
05072005  La validaci�n se realiza	por cada usuario y no por el grupo entero 		 jcortes
07222005  Implementacion para la tabla exammediusuario									 mstroh
*/
function validacupo($usr,$arrmate,$arrmatecant,$nucon)
{
	$result = loadrecordvalidaexammedi($usr,$nucon);
	if ($result > 0)
	{
		$numReg = fncnumreg($result);
		for ($x = 0 ;$x < $numReg;$x++)
		{
			$arr = fncfetch($result,$x);
			if($arr[examedcodigo] == $arrmate)
			{
				$result1 = loadrecordexammedi($arrmate[$i],$nucon);
				$idval = 0;
				return $idval;
			}
		}
	}
	$idval = 1;
	return $idval;
}
/*
-Todos los derechos reservados-
Propiedad intelectual de Adsum (c).
Funcion         : borraexammediusuario
Decripcion      :
Parametros      : Descripicion
$usr           Codigo del colaborador.
$arrmate       Arreglo con los codigos de los examenes a asignar al colaborador.
$arrmatecant   Numero de posiciones del arreglo arrmate.
$nucon         Conexi�n con la base de datos.
$flagborrar    Bandera que indica que se borr� al menos un registro.
Retorno         :
No retorna respuestas
Autor           : jcortes
Fecha           : 05072005
Historial de modificaciones
| Fecha 	| Motivo						| Autor 	|
13-jul-2005 editar parametro $flagborrar	 jcortes
04-ago-2005 Implementacion para exammediusuario	 mstroh
*/
function borraexammediusuario($usr,$arrmate,$arrmatecant,$nucon,&$flagborrar)
{
	$result = loadrecordvalidaexammedi($usr,$nucon);
	if ($result > 0)
	{
		$numReg = fncnumreg($result);
		for ($x = 0 ;$x < $numReg;$x++)
		{
			$arr = fncfetch($result,$x);
			$existe=0;
			for($i = 0; $i < $arrmatecant; $i++)
			{
				if($arr[examedcodigo] == $arrmate[$i])
				{
					$existe=1;
				}
			}
			if(!$existe)
			{
				$flagborrar=1;
				delrecordexammediusuariousr($arr[examedcodigo],$usr,$nucon);
			}
		}
		$flageditarexammediusuario = 1;
	}
}
if($usuacodigo1)
{
	if($arreglo1)
	{
		$valposic = explode(",",$arreglo1);
		$numposic = count($valposic);
		$idcon = fncconn();
		$flagborrar=0;
		borraexammediusuario($usuacodigo,$valposic,$numposic,$idcon,$flagborrar);
		$x = 0;
		for($i = 0; $i < $numposic; $i++)
		{
			$idval = validacupo($usuacodigo,$valposic[$i],$numposic,$idcon);
			if($idval ==1)
			{
				$auxexammedicodigo = $valposic[$i];
				$iRegexammediusuario[exmusucodigo] = $exmusucodigo;
				$iRegexammediusuario[examedcodigo] = $auxexammedicodigo;
				$iRegexammediusuario[usuacodi] = $usuacodigo;
				$iRegexammediusuario[exmusupinifec] = $exmusupinifec;
				$x++;
				editaexammediusuario($iRegexammediusuario,$flageditarexammediusuario,$campnomb,$x);
			}
		}
		if(!$x)
		{
			if($flagborrar)
			{
				echo '<script language="javascript">';
				echo '<!--//'."\n";
				echo 'alert("Proceso existoso");';
				echo 'location = "maestablexammediusuario.php?codigo='.$codigo.';"';
				echo '//-->'."\n";
				echo '</script>';
			}
			else
			{
				echo '<script language= "javascript">';
				echo '<!--//'."\n";
				echo 'alert("El/Los ex\u00E1men/es seleccionado/s ya ha/n sido asignado/s al colaborador")';
				echo '//-->'."\n";
				echo '</script>';
			}
		}
	}
	else
	{
		$flageditarexammediusuario = 1;
		echo '<script language= "javascript">';
		echo '<!--//'."\n";
		echo 'alert("Seleccione uno o mas ex\u00E1menes m\u00e9dicos")';
		echo '//-->'."\n";
		echo '</script>';
	}
}
else
{
	$flageditarexammediusuario = 1;
	echo '<script language= "javascript">';
	echo '<!--//'."\n";
	echo 'alert("Seleccione un colaborador")';
	echo '//-->'."\n";
	echo '</script>';
}
?>
