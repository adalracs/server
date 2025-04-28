<?php 
include ( '../src/FunPerPriNiv/pktblusuario.php');
include ( '../src/FunPerPriNiv/pktblcampo.php');
include ( '../src/FunPerPriNiv/pktbltabla.php');
include ( '../def/tipocampo.php');
include ( '../src/FunGen/buscacaracter.php');
include ( '../src/FunGen/fncmsgerror.php');
include( '../src/FunGen/fncnombeditexs.php');

function editausuacolab($iRegusuario,&$flageditarusuario,&$campnomb,&$codigo)
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
	define("errorValneg",23);
	define("errorUsrExs",29);
	define("errorIng",35);
			
	if ($iRegusuario) 
	{ 
		$iRegtabla["tablnomb"] = "usuario";
		$resulttabla = dinamicscantabla($iRegtabla,$nuconn);
		$num = fncnumreg($resulttabla);
		
		for($i=0;$i<$num;$i++)
		{
			$sbregtabla = fncfetch($resulttabla,$i);
			
			if($sbregtabla[tablnomb] == "usuario")
			{
				$tablcodi=$sbregtabla['tablcodi'];
				break;
			}
		}
		$iRegCampo["tablcodi"]=$tablcodi;
		$resultcampo=dinamicscancampo($iRegCampo,$nuconn);
		$num = fncnumreg($resultcampo);
				
		while($elementos = each($iRegusuario))
		{ 
			$iRegCampo["campnomb"] = $elementos[0];
			$resultcampo = dinamicscancampo($iRegCampo,$nuconn);
			$num = fncnumreg($resultcampo);
			if($num>0)
			{
				$sbregcampo = fncfetch($resultcampo,0);
				if($elementos[0] != "usuacodi")
				{
					if($sbregcampo["campnomb"] == $elementos[0])
					{
						$respuesta = strcmp($sbregcampo["campnotnull"],"t");
						if($respuesta == 0)
						{
							if($elementos[1] == "")
							{
								$campnomb[$elementos[0]] = 1;
								$flageditarusuario = 1;
								$flagerror = 1;
							}
						}
					}
				}
			}
			
			$validar = buscacaracter($elementos[1]);
			if($validar == 1) 
			{ 
				$flageditarusuario = 1; 
				$flagerror = 1; 
				$campnomb[$elementos[0]] = 1;
			}
			
			$validresult = consulmetausuario($elementos[0],$elementos[1],$nuconn);
			if ($validresult == 1)
			{
				$flageditarusuario = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;
				unset ($validresult);
			}
			
			if($elementos[0] == "usuaemail" && $elementos[1] != null)
			{
				if (!ereg("^[_a-zA-Z0-9-]+(\.[_a-zA-Z0-9-]+)*@+([_a-zA-Z0-9-]+\.)*[a-zA-Z0-9-]{2,200}\.[a-zA-Z]{2,6}$",$elementos[1]) )
				{
					fncmsgerror(errormail);
					$flagnuevousuario = 1;
					$flagerror = 1;
					$campnomb[$elementos[0]] = 1;
				}

			}

			if($elementos[0] == "usuavalhor" && $elementos[1] < 0)
			{
				fncmsgerror(errorValneg);
				$flageditarusuario = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;
			}

			if($elementos[0]=='usuadocume')
			{
				$validnombre =  fncnombeditexs('usuario',$iRegusuario,$elementos[0],$elementos[1],
				'usuacodi',$iRegusuario[usuacodi],$nuconn);
				if ($validnombre == 1)
				{
					fncmsgerror(errorUsrExs);
					$flageditarusuario = 1;
					$flagerror = 1;
					$campnomb[$elementos[0]] = 1;
					unset ($validnombre);
				}
			}
		}
		
		if($flagerror == 1)
		{
			fncmsgerror(errorIng);
		}

		if($flagerror != 1)
		{
			$result = uprecordusuario($iRegusuario,$nuconn);
			if($result < 0 )
			{
				ob_end_clean();
				fncmsgerror(errorReg);
				$flageditarusuario=1;
			}
			if($result > 0)
			{
				fncmsgerror(editaEx);
				echo '<script language="javascript">';
				echo '<!--//'."\n";
				echo 'location ="maestablusuacolab.php?codigo='.$codigo.';"';
				echo '//-->'."\n";
				echo '</script>';
			}
			fncclose($nuconn);
		}
	}
}
$iRegusuario[usuacodi] = $usuacodic;
$iRegusuario[cargocodigo] = $cargocodigo;
$iRegusuario[departcodigo] = $departcodigo;
$iRegusuario[tipusucodigo] = $tipusucodigo;
$iRegusuario[usuanomb] = $usuanomb;
$iRegusuario[usuapass] = $usuapass;
$iRegusuario[usuaacti] = $usuaacti;
$iRegusuario[usuadocume] = $usuadocume;
$iRegusuario[usuanombre] = $usuanombre;
$iRegusuario[usuapriape] = $usuapriape;
$iRegusuario[usuasegape] = $usuasegape;
$iRegusuario[usuatelefo] = $usuatelefo;
$iRegusuario[usuatelef2] = $usuatelef2;
$iRegusuario[usuacontac] = $usuacontac;
$iRegusuario[usuatelcon] = $usuatelcon;
$iRegusuario[usuadirecc] = $usuadirecc;
$iRegusuario[usuaemail] = $usuaemail;
$iRegusuario[usuavalhor] = $usuavalhor;
$iRegusuario[usuaactiot] = $usuaactiot;
editausuacolab($iRegusuario,$flageditarusuario,$campnomb,$codigo);
?> 
