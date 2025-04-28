<?php
/*
Propiedad intelectual de Adsum SA (c).
Funcion         : grabaobservac
Decripcion      : Graba los datos de observaciones.
Parametros      : Descripicion
$iregcentturi  Arreglo con la data a grabar.
Retorno         : Descripicion
Modificado por  : ariascos
Fecha           : 05-mar-2002
Modificado por  : lfolaya
Fecha           : 17-may-2006
Motivo			: Validación según estandar de la aplicación
*/

include('../src/FunPerPriNiv/fncbegin.php');
include('../src/FunPerPriNiv/fnclock.php');
/*include('../src/FunGen/fncnumact.php');
include('../src/FunGen/fncnumprox.php');*/
include('../src/FunPerPriNiv/pktblusuario.php');
include('../src/FunPerPriNiv/fnccommit.php');
include('../src/FunGen/fncvalexiusu.php');
include('../def/tipocampo.php');
include('../src/FunGen/buscacaracter.php');
include('../src/FunGen/fncmsgerror.php');
include ( '../src/FunPerPriNiv/pktblcampo.php');
include ( '../src/FunPerPriNiv/pktbltabla.php');
include( '../src/FunGen/fncnombexs.php');


function grabausuario($iRegusuario,$iRegusuagrup,&$flagnuevousuario,&$campnomb,$iRegvalpass,&$usuacode)
{
	define ("n",0);
	define ("n1",1);
	define ("id",2);
	define ("e_empty",-3);
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
	$result = n;
	$nuconn = fncconn();
	
	//genera (usuacodi) el codigo de la tabla por medio de "$nuidtemp".
	/*$nucomecoditemp = $iRegusuario[usuacodi];
	$nures = fncbegin($nuconn);
	$nures1= fnclock("numerado",$nuconn);
	$nuidtemp = fncnumact(id,$nuconn);
	do
	{
		$nuresult = loadrecordusuario($nuidtemp,$nuconn);
		if($nuresult == e_empty)
		{
			$iRegusuario[usuacodi]= $nuidtemp;
			$iRegusuagrup[usuacodi]= $nuidtemp;
			$usuacode = $nuidtemp;
		}
		$nuidtemp ++;
		
	}while ($nuresult != e_empty);*/
	
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
		$iRegusuario_a = $iRegusuario;
		
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
							if($elementos[1] == null)
							{
								$campnomb[$elementos[0]] = 1;
								$flagnuevousuario = 1;
								$flagerror = 1;
							}
						}
					}
				}
			}
			$validar = buscacaracter($elementos[1]);
			if($validar == 1)
			{
				fncmsgerror(errorCar);
				$flagnuevousuario = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;
			}
			$validresult = consulmetausuario($elementos[0],$elementos[1],$nuconn);
			if($validresult == 1)
			{
				$flagerror = 1;
				$flagnuevousuario = 1;
				$campnomb[$elementos[0]] = 1;
				unset($validresult);
			}
			if($elementos[0] == "usuanomb" && $elementos[1] == null)
			{
				$flagnuevousuario = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;
			}
			if($elementos[0] == "usuapass" && $elementos[1] == null)
			{
				$flagnuevousuario = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;
			}
			if($elementos[0] == "usuaacti" && $elementos[1] == null)
			{
				$flagnuevousuario = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;
			}
			if($elementos[0] == "usuaemail" && $elementos[1] != null)
			{
				if (!ereg("^[_a-zA-Z0-9-]+(\.[_a-zA-Z0-9-]+)*@+([_a-zA-Z0-9-]+\.)*[a-zA-Z0-9-]{2,200}\.[a-zA-Z]{2,6}$",$elementos[1]) )
				{
					fncmsgerror(errormail);
					$flagnuevousuario = 1;
					$flagerror = 1;
					$campnomb = $elementos[0];
				}
			}
			if($elementos[0]=="usuapass" && $elementos[1] != null)
			{
				if($elementos[1] != $iRegvalpass[usuapass])
				{
					echo '<script language = "javascript">';
					echo '<!--//'."\n";
					echo 'alert("Claves no coinciden");';
					echo '//-->'."\n";
					echo '</script>';
					$flagnuevousuario = 1;
					$flagerror = 1;
					$campnomb[$elementos[0]] = 1;
				}
			}
			if($elementos[0]=='usuanomb')
			{
				if($elementos[1] != null)
				{
					$validnombre =  fncnombexs('usuario',$iRegusuario_a,$elementos[0],$elementos[1],$nuconn);
					if ($validnombre == 1)
					{
						echo '<script language="javascript">';
						echo '<!--//'."\n";
						echo 'alert("El login especificado ya existe");';
						echo '//-->'."\n";
						echo '</script>';
						$flagnuevousuario = 1;
						$flagerror = 1;
						$campnomb[$elementos[0]] = 1;
						unset ($validnombre);
					}
				}
				else 
				{
					$flagnuevousuario = 1;
					$flagerror = 1;
					$campnomb[$elementos[0]] = 1;
				}
			}
		}
		
		if($iRegusuagrup[grupcodi] == null)
		{
			$flagnuevousuario = 1;
			$flagerror = 1;
			$campnomb["grupcodi"] = 1;
		}
		
		if($flagerror == 1)
		{
			fncmsgerror(errorIng);
		}
		
		$verificarregistro=loadrecordusuario($iRegusuario[usuacodi],$nuconn);
		
		if ($verificarregistro != '-3')
		{
			echo '<script language="javascript">';
			echo '<!--//'."\n";
			echo 'alert("El registro asignado ya existe");';
			echo '//-->'."\n";
			echo '</script>';
			$flagnuevousuario = 1;
			$flagerror = 1;
			$campnomb['usuacodi'] = 1;
			unset ($verificarregistro);
		}
		
		if($flagerror != 1)
		{
			$iRegusuario[usuapass]=crypt($iRegusuario[usuapass],'LS');//encripta pass
			
			$nuresult2 = insrecordusuario($iRegusuario,$nuconn); //inserta los datos en la tabla (usuario).
			$nuresult3 = insrecordusuagrup($iRegusuagrup,$nuconn);//inserta los datos en la tabla (usuagrup).
						
			$nures2 = fnccommit($nuconn);
			
			if ($nures2 < 2)
			{
				ob_end_clean();
				fncmsgerror(errorReg);
				$flagnuevousuario = 1;
			}
			else
			{
			//	$nuresult1 = fncnumprox(id,$nuidtemp,$nuconn); 	//	No utilice esta parte si va a utilizar la llave primaria como serial //
				fncmsgerror(grabaEx);
			}
		}
	}
	fncclose($nuconn);
}
$iRegusuario[usuacodi] = $usuacodigo;
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
$iRegusuario[usuasolser]= $usuasolser;
$iRegusuario[usuabandeja] = $usuabandeja;

$iRegusuagrup[grupcodi] = $grupcodi;
$iRegusuagrup[usuacodi] = $usuacodigo;
$iRegvalpass[usuapass] = $usuapass1;

grabausuario($iRegusuario,$iRegusuagrup,$flagnuevousuario,$campnomb,$iRegvalpass,$usuacode);

if(!$flagnuevousuario)
{
	if($arrusuaplanta)
	{
		$idcon = fncconn();
		$arrPlanta = explode(",", $arrusuaplanta);
		$iregUsuaplanta[usuacodi] = $usuacodigo;
		
		for ($i = 0; $i < count($arrPlanta); $i++)
		{
			$iregUsuaplanta[plantacodigo] = $arrPlanta[$i];
			insrecordusuaplanta($iregUsuaplanta, $idcon);
		}
	}
	
	if($arrusuatipotrab)
	{
		$idcon = fncconn();
		$arrTipotrab = explode(",", $arrusuatipotrab);
		$iregUsuatipotrab[usuacodi] = $usuacodigo;
		
		for ($i = 0; $i < count($arrTipotrab); $i++)
		{
			$iregUsuatipotrab[tiptracodigo] = $arrTipotrab[$i];
			insrecordusuatipotrab($iregUsuatipotrab, $idcon);
		}
	}
	unset($arrusuaplanta, $arrusuatipotrab, $allusuaplanta, $allusuatipotrab);
}