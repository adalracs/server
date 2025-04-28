<?php 
include ( '../src/FunPerPriNiv/pktblcapacitacion.php');
include ( '../src/FunPerPriNiv/pktblcampo.php');
include ( '../src/FunPerPriNiv/pktbltabla.php');
include ( '../def/tipocampo.php');
include ( '../src/FunGen/buscacaracter.php');
include ( '../src/FunGen/fncmsgerror.php');
include( '../src/FunGen/fncnombeditexs.php');

function editacapacitacion(&$iRegcapacitacion,&$flageditarcapacitacion,&$campnomb,&$codigo)
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
				if($elementos[0] != "capacicodigo")
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
			fncmsgerror(errorIng);
		
		
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

$capacihorini = date("H:i", strtotime($horini.':'.$minini.(($pasadmerini) ? ' pm' : ' am')));


$iRegcapacitacion['capacicodigo'] = $capacicodigo;
$iRegcapacitacion['cursocodigo'] = $cursocodigo;
$iRegcapacitacion['ubicapcodigo'] = $ubicapcodigo;
$iRegcapacitacion['salcapcodigo'] = $salcapcodigo;
$iRegcapacitacion['capacifecgen'] = date("Y-m-d");
$iRegcapacitacion['capacifecini'] = $capacifecini;
$iRegcapacitacion['capacihorini'] = $capacihorini;
$iRegcapacitacion['capacihorfin'] = $capacihorfin;
$iRegcapacitacion['usuacodi'] = $usuacodigo;
$iRegcapacitacion['departcodigo'] = $departcodigo1;
$iRegcapacitacion['capacigenera'] = $usuacodi;
$iRegcapacitacion['capaciobjeti'] = $capaciobjeti;

editacapacitacion($iRegcapacitacion,$flageditarcapacitacion,$campnomb,$codigo);

if(!$flageditarcapacitacion)
{
	include_once ( '../src/FunGen/fncnumprox.php');
	include_once ( '../src/FunGen/fncnumact.php');
	
	$idcon = fncconn();
	
	if($arritem)
	{
		$delResult = delrecordcapacimateap($capacicodigo, $idcon);
		$arrMateap = explode(',', $arritem);
		
		$nuidtemp = fncnumact(107,$idcon);
		do
		{
			$nuresult = loadrecordcapacimateap($nuidtemp,$idcon);
			if($nuresult == e_empty)
				$capmpycodigo = $nuidtemp;
			$nuidtemp ++;
		}while ($nuresult != e_empty);
		
		$iRegcapacimateap['capacicodigo'] = $capacicodigo;
		
		for($a = 0; $a < count($arrMateap); $a++)
		{
			$iRegcapacimateap['capmpycodigo'] = $capmpycodigo;	
			$iRegcapacimateap['matapocodigo'] = $arrMateap[$a];	
			insrecordcapacimateap($iRegcapacimateap, $idcon);
			
			$capmpycodigo ++;
		}
		$nuresult1 = fncnumprox(107, $capmpycodigo,$idcon);
	}
	
	if($lsttecnicoot)
	{
		$delResult = delrecordcapaciusuario($capacicodigo, $idcon);
		$arrUsuarios = explode(',', $lsttecnicoot);
		
		$nuidtemp = fncnumact(108,$idcon);
		do
		{
			$nuresult = loadrecordcapaciusuario($nuidtemp,$idcon);
			if($nuresult == e_empty)
				$capusucodigo = $nuidtemp;
			$nuidtemp ++;
		}while ($nuresult != e_empty);
		
		$iRegcapaciusuario['capacicodigo'] = $capacicodigo;
		
		for($a = 0; $a < count($arrUsuarios); $a++)
		{
			$objDepart = 'depart_'.$arrUsuarios[$a];
			
			$iRegcapaciusuario['capusucodigo'] = $capusucodigo;	
			$iRegcapaciusuario['usuacodi'] = $arrUsuarios[$a];	
			$iRegcapaciusuario['departcodigo'] = $$objDepart;
			
			insrecordcapaciusuario($iRegcapaciusuario, $idcon);
			
			$capusucodigo ++;
		}
		$nuresult1 = fncnumprox(108, $capusucodigo,$idcon);
	}
	
	
	if($lstinstructor)
	{
		$delResult = delrecordcapacitema($capacicodigo, $idcon);
		$arrTemas = explode(',', $lstinstructor);
		if($arrcontratista) 
			$arrObj = explode(':|:', $arrcontratista);
		
		$nuidtemp = fncnumact(109,$idcon);
		do
		{
			$nuresult = loadrecordcapacitema($nuidtemp,$idcon);
			if($nuresult == e_empty)
				$captemcodigo = $nuidtemp;
			$nuidtemp ++;
		}while ($nuresult != e_empty);
		
		$iRegcapacitema['capacicodigo'] = $capacicodigo;
		
		for($a = 0; $a < count($arrTemas); $a++)
		{
			$arrInstructor = explode('_', $arrTemas[$a]);
			$rsUsuario = loadrecordusuario($arrInstructor[1], $idcon);
			
			$objTema = 'curcontema_'.$arrTemas[$a].'_'.$a;
			$objHora = 'curconhora_'.$arrTemas[$a].'_'.$a;
			$objvalor = 'curconvalor_'.$arrTemas[$a].'_'.$a;
			$objThora = 'tipohora_'.$arrTemas[$a].'_'.$a;
			
			$iRegcapacitema['captemcodigo'] = $captemcodigo;
			$iRegcapacitema['usuacodi'] = $arrInstructor[1];
			$res = 1;
			
			if($rsUsuario == -3)
			{
				if($arrObj)
				{
					for($j = 0; $j < count($arrObj); $j++)
					{
						$arrCont = explode(':-:',$arrObj[$j]);
						
						if($arrCont[0] == $arrInstructor[1])
						{
							$iRegUsuario['usuacodi']  = $arrCont[0];
//							$iRegUsuario['cargocodigo']  = 122;
							$iRegUsuario['usuadocume']  = $arrCont[1];
							$iRegUsuario['usuanombre']  = $arrCont[2];
							$iRegUsuario['usuapriape']  = $arrCont[3];
							$iRegUsuario['usuasegape']  = $arrCont[4];
							$iRegUsuario['usuatelefo']  = $arrCont[5];
							$iRegUsuario['usuatelef2']  = $arrCont[6];
							$iRegUsuario['usuadirecc']  = $arrCont[7];
							$iRegUsuario['usuaemail']  = $arrCont[8];
							$iRegUsuario['usuacontac']  = $arrCont[9];
							$iRegUsuario['usuavalhor']  = 10;
							$iRegUsuario['usuaactiot']  = 4;
							$iRegUsuario['usuaacti']  = 1;
							$res = insrecordusuario($iRegUsuario, $idcon);
							break;
						}
					}
				}
			}
			
			if($res > 0)
			{
				$iRegcapacitema[temacodigo] = $$objTema;
				$iRegcapacitema[captemtiedur] = ($$objThora == 2) ? $$objHora / 60 : $$objThora;
				$iRegcapacitema[captemvalor] = $$objValor;
				
				insrecordcapacitema($iRegcapacitema, $idcon);
				$captemcodigo ++;
			}
		}
		$nuresult1 = fncnumprox(109, $captemcodigo,$idcon);
	}
	
	
	unset($cursocodigo, $ubicapcodigo, $salcapcodigo, $capacifecini, $usuacodigo, $usuanombre, $departnombre, $departcodigo1, $capaciobjeti,$arritem, $lstinstructor,$lsttecnicoot);
	echo '<script language="javascript">';
	echo '<!--//'."\n";
	echo "window.open('imprimirasist.php?codigo=$capacicodigo','impresion','status=no,menubar=no,scrollbars=yes,resizable=yes,width=800,height=650');";
	echo 'location ="maestablcapacitacion.php?codigo='.$codigo.'";';
	echo '//-->'."\n";
	echo '</script>';
}