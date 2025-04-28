<?php 
include ( '../src/FunPerPriNiv/pktblsoliserv.php'); 
include ( '../src/FunPerPriNiv/pktblcampo.php'); 
include ( '../src/FunPerPriNiv/pktbltabla.php'); 
include ( '../def/tipocampo.php'); 
include ( '../src/FunGen/buscacaracter.php'); 
include ( '../src/FunGen/fncmsgerror.php'); 
include( '../src/FunGen/fncnombeditexs.php');
function editasoliserv($iRegsoliserv,&$flageditarsoliserv,&$campnomb,&$codigo) 
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
	define("errorIng",35);
	define("errorSolFall",37); 
	if ($iRegsoliserv) 
	{ 
		$iRegtabla["tablnomb"] = "soliserv";
		$resulttabla = dinamicscantabla($iRegtabla,$nuconn);

		$num = fncnumreg($resulttabla);
		
		for($i=0;$i<$num;$i++)
		{
			$sbregtabla = fncfetch($resulttabla,$i);
			
			if($sbregtabla[tablnomb] == "soliserv")
			{
				$tablcodi=$sbregtabla['tablcodi'];
				break;
			}
		}
		$iRegCampo["tablcodi"]=$tablcodi;
		$resultcampo=dinamicscancampo($iRegCampo,$nuconn);
		$num = fncnumreg($resultcampo);
				
		while($elementos = each($iRegsoliserv))
		{ 
			$iRegCampo["campnomb"] = $elementos[0];
			$resultcampo = dinamicscancampo($iRegCampo,$nuconn);
			$num = fncnumreg($resultcampo);
			if($num>0)
			{
				$sbregcampo = fncfetch($resultcampo,0);
				if($elementos[0] != "solsercodigo")
				{
					if($sbregcampo["campnomb"] == $elementos[0])
					{
						$respuesta = strcmp($sbregcampo["campnotnull"],"t");

						if($respuesta == 0)
						{
							if($elementos[1] == "")
							{
								$campnomb[$elementos[0]] = 1;
								$flageditarsoliserv = 1;
								$flagerror = 1;
							}
						}
						
					}
				}
			}
			
			$validar = buscacaracter($elementos[1]);

			
			$validresult = consulmetasoliserv($elementos[0],$elementos[1],$nuconn);
			if ($validresult == 1)
			{
				$flageditarsoliserv = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;
				unset ($validresult);
			}
		}
		
		$nuResultdb = loadrecordvalsoliserv($nuconn);
		$num = fncnumreg($nuResultdb);
		for ($i = 0; $i < $num; $i++)
		{	
			$sbregtabla = fncfetch($nuResultdb ,$i);
			if(($sbregtabla[1] == $iRegsoliserv[equipocodigo])&&($sbregtabla[2]==$iRegsoliserv[tipfalcodigo])&&($sbregtabla[3]==$iRegsoliserv[solserfecha]))
			{ 	
				fncmsgerror(errorSolFall);
				$flageditarsoliserv =1;
				$flagerror=1;
				break;
			}
		}			
		
		if($flagerror == 1)
		{
			fncmsgerror(errorIng);
		}

		if($flagerror != 1) 
		{ 
			$result = uprecordsoliserv($iRegsoliserv,$nuconn); 
			if($result < 0 ) 
			{ 
				ob_end_clean(); 
				fncmsgerror(errorReg); 
				$flageditarsoliserv=1; 
			} 
			if($result > 0) 
			{ 
				fncmsgerror(editaEx); 
				echo '<script language="javascript">'; 
				echo '<!--//'."\n"; 
				echo 'location ="maestablsoliserv.php?codigo='.$codigo.';"'; 
				echo '//-->'."\n"; 
				echo '</script>'; 
			} 
			fncclose($nuconn); 
		} 
	} 
} 
if ($estsolcodigo==4){ $soliservestado="Aprobado";}; 

$iRegsoliserv[solsercodigo] = $solsercodigo; 
$iRegsoliserv[usuacodi] = $usuacodi1; 
$iRegsoliserv[plantacodigo] = $plantacodigo; 
$iRegsoliserv[sistemcodigo] = $sistemcodigo; 
$iRegsoliserv[equipocodigo] = $equipocodigo; 
$iRegsoliserv[tipfalcodigo] = $tipfalcodigo; 
$iRegsoliserv[estsolcodigo] = $estsolcodigo; 
$iRegsoliserv[solsermotivo] = $solsermotivo."::".$usuarinombre."--".$solserfecha."--".$solserhora."--".$soliservestado."&nbsp;".$solsermotivo1;
$iRegsoliserv[solserfecha] = $solserfecha1;
$iRegsoliserv[solserhora] = $solserhora;  
editasoliserv($iRegsoliserv,$flageditarsoliserv,$campnomb,$codigo);
?>