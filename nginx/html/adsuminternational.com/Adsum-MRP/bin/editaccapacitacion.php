<?php 
include ( '../src/FunPerPriNiv/pktblcapacitacion.php');
include ( '../src/FunPerPriNiv/pktblcampo.php');
include ( '../src/FunPerPriNiv/pktbltabla.php');
include ( '../def/tipocampo.php');
include ( '../src/FunGen/buscacaracter.php');
include ( '../src/FunGen/fncmsgerror.php');
include( '../src/FunGen/fncnombeditexs.php');

function editacapacitacion($iRegcapacitacion,&$flageditarcapacitacion,&$campnomb,&$codigo)
{
	$nuconn = fncconn();
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

	if ($iRegcapacitacion) 
	{ 
		$iRegtabla["tablnomb"] = "capacitacion";
		$resulttabla = dinamicscantabla($iRegtabla,$nuconn);
		$num = fncnumreg($resulttabla);
		
		for($i=0;$i<$num;$i++)
		{
			$sbregtabla = fncfetch($resulttabla,$i);
			
			if($sbregtabla[tablnomb] == "capacitacion")
			{
				$tablcodi=$sbregtabla['tablcodi'];
				break;
			}
		}
		$iRegCampo["tablcodi"]=$tablcodi;
		$resultcampo=dinamicscancampo($iRegCampo,$nuconn);
		$num = fncnumreg($resultcampo);
		$iRegcapacitacion_b = $iRegcapacitacion;
				
		while($elementos = each($iRegcapacitacion))
		{ 
			$iRegCampo["campnomb"] = $elementos[0];
			$resultcampo = dinamicscancampo($iRegCampo,$nuconn);
			$num = fncnumreg($resultcampo);
			if($num>0)
			{
				$sbregcampo = fncfetch($resultcampo,0);
				if($elementos[0] != "curgrucodigo")
				{
					if($sbregcampo["campnomb"] == $elementos[0])
					{
						$respuesta = strcmp($sbregcampo["campnotnull"],"t");
						if($respuesta == 0)
						{
							if($elementos[1] == "")
							{
								$campnomb[$elementos[0]] = 1;
								$flageditarcapacitacion = 1;
								$flagerror = 1;
							}
						}
					}
				}
			}		
				
			$validar = buscacaracter($elementos[1]);
			
			if($validar == 1) 
			{ 
				$flageditarcapacitacion = 1; 
				$flagerror = 1; 
				$campnomb[$elementos[0]] = 1;
			}			
			$validresult = consulmetacapacitacion($elementos[0],$elementos[1],$nuconn);
			
			if ($validresult == 1)
			{
				$flageditarcapacitacion = 1;
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
			$result = uprecordcapacitacion($iRegcapacitacion,$nuconn);
			if($result < 0 )
			{
				ob_end_clean();
				fncmsgerror(errorReg);
				$flageditarcapacitacion=1;
			}
			if($result > 0)
			{
				fncmsgerror(editaEx);
			}
			fncclose($nuconn);
		}
	}
}

$idcon = fncconn();
$iRegcapacitacion = loadrecordcapacitacion($capacicodigo, $idcon);
$iRegcapacitacion['capacicalifi'] = 1;

editacapacitacion($iRegcapacitacion,$flageditarcapacitacion,$campnomb,$codigo);

if(!$flageditarcapacitacion)
{
	$idcon = fncconn();
	$rsCapaciusuario = dinamicscancapaciusuario(array('capacicodigo' => $capacicodigo), $idcon);
	$nrCapaciusuario = fncnumreg($rsCapaciusuario);
	
	for($a = 0; $a < $nrCapaciusuario; $a++)
	{
		$rwCapaciusuario = fncfetch($rsCapaciusuario, $a);
		$objCalificacion = 'capusucalifi_'.$rwCapaciusuario['capusucodigo'];
		$rwCapaciusuario['capusucalifi'] = $$objCalificacion;
		uprecordcapaciusuario($rwCapaciusuario, $idcon);
	}
	
	echo '<script language="javascript">';
	echo '<!--//'."\n";
	echo 'location ="maestablcapacitacion.php?codigo='.$codigo.';"';
	echo '//-->'."\n";
	echo '</script>';
}