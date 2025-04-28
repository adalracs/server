<?php
function editausuario($iRegusuario,$iregusuagrup,&$flageditarusuario,&$campnomb,&$codigo,$auxpass){
	include('../def/tipocampo.php');
	include('../src/FunGen/buscacaracter.php');
	include('../src/FunGen/fncmsgerror.php');
	include('../src/FunPerPriNiv/pktblusuario.php'); 
	include('../src/FunPerPriNiv/fnccommit.php');
	include('../src/FunPerPriNiv/pktblupdateusuagrup.php');
	include('../src/FunPerPriNiv/pktblcampo.php');
	include('../src/FunPerPriNiv/pktbltabla.php');
	include('../src/FunGen/fncnombeditexs.php');
	
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
	
	$nuconn = fncconn();

	$recusuario = loadrecordusuario($iRegusuario[usuacodi],$nuconn);
	if($iRegusuario){
		$iRegtabla["tablnomb"] = "usuario";
		$resulttabla = dinamicscantabla($iRegtabla,$nuconn);
		$num = fncnumreg($resulttabla);
		for($i=0;$i<$num;$i++){
			$sbregtabla = fncfetch($resulttabla,$i);
			if($sbregtabla[tablnomb] == "usuario"){
				$tablcodi=$sbregtabla['tablcodi'];
				break;
			}
		}

		$iRegCampo["tablcodi"]=$tablcodi;
		$resultcampo = dinamicscancampo($iRegCampo,$nuconn);
		$num = fncnumreg($resultcampo);
		
		while($elementos = each($iRegusuario)){
			$iRegCampo["campnomb"] = $elementos[0];
			$resultcampo = dinamicscancampo($iRegCampo,$nuconn);
			$num = fncnumreg($resultcampo);
			if($num>0){
				$sbregcampo = fncfetch($resultcampo,0);
				if($elementos[0] != "usuacodi"){
					if($sbregcampo["campnomb"] == $elementos[0]){
						$respuesta = strcmp($sbregcampo["campnotnull"],"t");
						if($respuesta == 0)
						{
							if($elementos[1] == null)
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
			if($validar == 1){
				fncmsgerror(errorCar);
				$flageditarusuario = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;
			}
		/*	$validresult = consulmetausuario($elementos[0],$elementos[1],$nuconn);
			if($validresult == 1){
				$flagerror = 1;
				$flageditarusuario = 1;
				$campnomb[$elementos[0]] = 1;
				unset($validresult);
			}*/
			if($elementos[0] == "usuapass" && $elementos[1] == null){
				echo '<script language="javascript">';
				echo '<!--//'."\n";
				echo 'alert("Digitar Clave");';
				echo '//-->'."\n";
				echo '</script>';
				$flageditarusuario = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;
    			}
   			if($elementos[0] == "usuanomb" && $elementos[1] == null){
				$flageditarusuario = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;
			}
			if($elementos[0] == "usuapass" && $elementos[1] == null){
				$flageditarusuario = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;
			}
			if($elementos[0] == "usuaacti" && $elementos[1] == null){
				$flageditarusuario = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;
			}
			if($elementos[0] == "usuaemail" && $elementos[1] != null){
				if (!ereg("^[_a-zA-Z0-9-]+(\.[_a-zA-Z0-9-]+)*@+([_a-zA-Z0-9-]+\.)*[a-zA-Z0-9-]{2,200}\.[a-zA-Z]{2,6}$",$elementos[1]) ){
					fncmsgerror(errormail);
					$flageditarusuario = 1;
					$flagerror = 1;
					$campnomb = $elementos[0];
				}
			}
		/*	if($elementos[0]=='usuanomb'){
				if($elementos[1] != null){
					$validnombre =  fncnombeditexs('usuario',$iRegusuario,$elementos[0],$elementos[1],'usuacodi',$iRegusuario[usuacodi],$nuconn);
					if ($validnombre == 1){
						fncmsgerror(errorNombExs);
						$flageditarusuario = 1;
						$flagerror = 1;
						$campnomb[$elementos[0]] = 1;
						unset ($validnombre);
					}
				}else {
					$flageditarusuario = 1;
					$flagerror = 1;
					$campnomb[$elementos[0]] = 1;
				}
			}*/
		}

		if($flagerror == 1){
			fncmsgerror(errorIng);
		}
	
		if($flagerror != 1){
			if($recusuario[usuaacti] == 1 && $iRegusuario[usuaacti] == 2){
				include ( '../src/FunGen/fncinacusuario.php');
				fncinacusuario($iRegusuario[usuacodi],$nuconn);
				echo '<script language="javascript">';
				echo '<!--//'."\n";
				echo 'alert("Desactivando usuario: '.$iRegusuario[usuanomb].' ")';
				echo '//-->'."\n";
				echo '</script>';
			}
			elseif($recusuario[usuaacti] == 2 && $iRegusuario[usuaacti] == 1){
				if($iregusuagrup[grupcodi]){
					insrecordusuagrup($iregusuagrup,$nuconn);
					echo '<script language="javascript">';
					echo '<!--//'."\n";
					echo 'alert("Activando usuario: '.$iRegusuario[usuanomb].' ")';
					echo '//-->'."\n";
					echo '</script>';
				}
			
			}elseif($recusuario[usuaacti] == null && $iRegusuario[usuaacti] == 2){
				include ( '../src/FunGen/fncinacusuario.php');
				fncinacusuario($iRegusuario[usuacodi],$nuconn);
				echo '<script language="javascript">';
				echo '<!--//'."\n";
				echo 'alert("Desactivando usuario: '.$iRegusuario[usuanomb].' ")';
				echo '//-->'."\n";
				echo '</script>';
			}elseif($recusuario[usuaacti] == null && $iRegusuario[usuaacti] == 1){
				if($iregusuagrup[grupcodi]){
					insrecordusuagrup($iregusuagrup,$nuconn);
					echo '<script language="javascript">';
					echo '<!--//'."\n";
					echo 'alert("Activando usuario: '.$iRegusuario[usuanomb].' ")';
					echo '//-->'."\n";
					echo '</script>';
				}
			}elseif($recusuario[usuaacti] == $iRegusuario[usuaacti]){
				if($iregusuagrup[grupcodi])
					fncupdateusuagrup($iregusuagrup,$nuconn);
			}
					
			if($auxpass != $iRegusuario[usuapass])
				$iRegusuario[usuapass] = crypt($iRegusuario[usuapass],'LS');
				
			$result = uprecordusuario($iRegusuario,$nuconn);

			
			unset($_SESSION["auxpass"]);
			
			if($iregusuagrup[grupcodi] && $iregusuagrup[usuacodi]){
				fncupdateusuagrup($iregusuagrup,$nuconn);
			}
			if($result > 0){
				fncmsgerror(editaEx);
			}
			if($result < 0 ){
				ob_end_clean();
				fncmsgerror(errorReg);
				$flageditarusuario = 1;
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
$iRegusuario[usuacodinv] = $usuacodi2;
$iRegusuario[usuasolser]= $usuasolser;
$iRegusuario[usuabandeja] = $usuabandeja;

$iregusuagrup[grupcodi]= $grupcodi;
$iregusuagrup[usuacodi]= $usuacodigo;


$auxpass = $_SESSION["auxpass"];

editausuario($iRegusuario,$iregusuagrup,$flageditarusuario,$campnomb,$codigo,$auxpass);

if(!$flageditarusuario)
{
	$idcon = fncconn();	
	$result = delrecordusuaplanta($usuacodigo, $idcon);
	$result = delrecordusuatipotrab($usuacodigo, $idcon);
	
	if($arrusuaplanta)
	{
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
		$arrTipotrab = explode(",", $arrusuatipotrab);
		$iregUsuatipotrab[usuacodi] = $usuacodigo;
		
		for ($i = 0; $i < count($arrTipotrab); $i++)
		{
			$iregUsuatipotrab[tiptracodigo] = $arrTipotrab[$i];
			insrecordusuatipotrab($iregUsuatipotrab, $idcon);
		}
	}
	unset($arrusuaplanta, $arrusuatipotrab, $allusuaplanta, $allusuatipotrab);
	
	echo '<script language="javascript">'; 
	echo '<!--//'."\n"; 
	echo 'location ="maestablusuario.php?codigo='.$codigo.';"'; 
	echo '//-->'."\n"; 
	echo '</script>'; 
}