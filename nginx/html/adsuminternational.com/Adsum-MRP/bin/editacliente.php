<?php

	include('../def/tipocampo.php');
	include('../src/FunGen/buscacaracter.php');
	include('../src/FunGen/fncmsgerror.php');
	include('../src/FunPerPriNiv/pktblusuario.php'); 
	include('../src/FunPerPriNiv/fnccommit.php');
	include('../src/FunPerPriNiv/pktblupdateusuagrup.php');
	include('../src/FunPerPriNiv/pktblcampo.php');
	include('../src/FunPerPriNiv/pktbltabla.php');
	include('../src/FunGen/fncnombeditexs.php');

function editausuario($iRegusuario,$iregusuagrup,&$flageditarusuario,&$campnomb,&$codigo, $iRegvalpass, $usuadocume1)
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
	
	$nuconn = fncconn();
	
	$recusuario = loadrecordusuario($iRegusuario[usuacodi],$nuconn);
	if($iRegusuario)
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
		$resultcampo = dinamicscancampo($iRegCampo,$nuconn);
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
				fncmsgerror(errorCar);
				$flageditarusuario = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;
			}
			$validresult = consulmetausuario($elementos[0],$elementos[1],$nuconn);
			if($validresult == 1)
			{
				$flagerror = 1;
				$flageditarusuario = 1;
				$campnomb[$elementos[0]] = 1;
				unset($validresult);
			}
			
   			if($elementos[0] == "usuanomb" && $elementos[1] == null)
			{
				$flageditarusuario = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;
			}
			if($elementos[0] == "usuaacti" && $elementos[1] == null)
			{
				$flageditarusuario = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;
			}
			if($elementos[0] == "usuaemail" && $elementos[1] != null)
			{
				if (!ereg("^[_a-zA-Z0-9-]+(\.[_a-zA-Z0-9-]+)*@+([_a-zA-Z0-9-]+\.)*[a-zA-Z0-9-]{2,200}\.[a-zA-Z]{2,6}$",$elementos[1]) )
				{
					fncmsgerror(errormail);
					$flageditarusuario = 1;
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
					$validnombre =  fncnombeditexs('usuario',$iRegusuario_a,$elementos[0],$elementos[1],'usuacodi',$iRegusuario[usuacodi],$nuconn);
					if ($validnombre == 1)
					{
						fncmsgerror(errorNombExs);
						$flageditarusuario = 1;
						$flagerror = 1;
						$campnomb[$elementos[0]] = 1;
						unset ($validnombre);
					}
				}
				else 
				{
					$flageditarusuario = 1;
					$flagerror = 1;
					$campnomb[$elementos[0]] = 1;
				}
			}
			
			if($elementos[0]=='usuadocume' && $elementos[1] != $usuadocume1)
			{
				if($elementos[1] != null)
				{
					$validnombre =  fncnombeditexs('usuario',$iRegusuario_a,$elementos[0],$elementos[1],'usuacodi',$iRegusuario[usuacodi],$nuconn);
					if ($validnombre == 1)
					{
						echo '<script language="javascript">';
						echo '<!--//'."\n";
						echo 'alert("El NIT ya se encuentra registrado");';
						echo '//-->'."\n";
						echo '</script>';
						$flageditarusuario = 1;
						$flagerror = 1;
						$campnomb[$elementos[0]] = 1;
						unset ($validnombre);
					}
				}
				else 
				{
					$flageditarusuario = 1;
					$flagerror = 1;
					$campnomb[$elementos[0]] = 1;
				}
			}
		}
		if($flagerror == 1)
		{
//			fncmsgerror(errorIng);
		}
	
		if($flagerror != 1)
		{
			if($recusuario[usuaacti] == 1 && $iRegusuario[usuaacti] == 2)
			{
				include ( '../src/FunGen/fncinacusuario.php');
				fncinacusuario($iRegusuario[usuacodi],$nuconn);
				echo '<script language="javascript">';
				echo '<!--//'."\n";
				echo 'alert("Desactivando cuenta: '.$iRegusuario[usuanomb].' ")';
				echo '//-->'."\n";
				echo '</script>';
			}
			elseif($recusuario[usuaacti] == 2 && $iRegusuario[usuaacti] == 1)
			{
				if($iregusuagrup[grupcodi])
				{
					insrecordusuagrup($iregusuagrup,$nuconn);
					echo '<script language="javascript">';
					echo '<!--//'."\n";
					echo 'alert("Activando cuenta: '.$iRegusuario[usuanomb].' ")';
					echo '//-->'."\n";
					echo '</script>';
				}
			
			}elseif($recusuario[usuaacti] == null && $iRegusuario[usuaacti] == 2)
			{
				include ( '../src/FunGen/fncinacusuario.php');
				fncinacusuario($iRegusuario[usuacodi],$nuconn);
				echo '<script language="javascript">';
				echo '<!--//'."\n";
				echo 'alert("Desactivando cuenta: '.$iRegusuario[usuanomb].' ")';
				echo '//-->'."\n";
				echo '</script>';
			}elseif($recusuario[usuaacti] == null && $iRegusuario[usuaacti] == 1)
			{
				if($iregusuagrup[grupcodi])
				{
					insrecordusuagrup($iregusuagrup,$nuconn);
					echo '<script language="javascript">';
					echo '<!--//'."\n";
					echo 'alert("Activando cuenta: '.$iRegusuario[usuanomb].' ")';
					echo '//-->'."\n";
					echo '</script>';
				}
			}
			
			$result = uprecordusuario($iRegusuario,$nuconn);
			
			if($iRegusuario[usuapass])
			{
				$iRegusuario[usuapass] = crypt($iRegusuario[usuapass],'LS');//encripta pass
				uprecordusuariopass($iRegusuario,$nuconn);
			}
			
			if($iregusuagrup[grupcodi] && $iregusuagrup[usuacodi])
			{
				fncupdateusuagrup($iregusuagrup,$nuconn);
			}
		
			if($result > 0)
			{				
				fncmsgerror(editaEx);
			}
			if($result < 0 )
			{
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
	$iRegusuario[usuadocume] = $usuadocume;
	$iRegusuario[usuanombre] = $usuanombre;
	$iRegusuario[usuapriape] = $usuapriape;
	$iRegusuario[usuatelefo] = $usuatelefo;
	$iRegusuario[usuatelef2] = $usuatelef2;
	$iRegusuario[usuacontac] = $usuacontac;
	$iRegusuario[usuatelcon] = $usuatelcon;
	$iRegusuario[usuadirecc] = $usuadirecc;
	$iRegusuario[usuaemail] = $usuaemail;
	$iRegusuario[usuavalhor] = $usuavalhor;
	$iRegusuario[ciudadcodigo] = $ciudadcodigo;
	$iRegusuario[usuaricarcon] = $usuaricarcon;
	$iRegusuario[usuaactiot] = 4;
	$iRegusuario[usuaacti] = $usuaacti;

	
	editausuario($iRegusuario,$iregusuagrup,$flageditarusuario,$campnomb,$codigo,$iRegvalpass, $usuadocume1);

	if(!$flageditarusuario){
		echo '<script language="javascript">'; 
		echo '<!--//'."\n"; 
		echo 'location ="maestablcliente.php?codigo='.$codigo.';"'; 
		echo '//-->'."\n"; 
		echo '</script>';  
	}