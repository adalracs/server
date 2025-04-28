<?php 
include ( '../src/FunPerPriNiv/pktblmanual.php'); 
include ( '../src/FunPerPriNiv/pktblcampo.php'); 
include ( '../src/FunPerPriNiv/pktbltabla.php'); 
include ( '../def/tipocampo.php'); 
include ( '../src/FunGen/buscacaracter.php'); 
include( '../src/FunGen/fncsubirmanual.php');
include( '../src/FunGen/fncnombeditexs.php');

function editamanual($iRegmanual,&$flageditarmanual,&$campnomb,&$codigo,$inombarc,$itipoarc,$tamaarc,$irutaarc,$itemparc,$file) 
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
	  
	if ($iRegmanual) 
	{ 
		$iRegtabla["tablnomb"] = "manual";
		$resulttabla = dinamicscantabla($iRegtabla,$nuconn);
		$num = fncnumreg($resulttabla);
		
		for($i=0;$i<$num;$i++)
		{
			$sbregtabla = fncfetch($resulttabla,$i);
			
			if($sbregtabla[tablnomb] == "manual")
			{
				$tablcodi=$sbregtabla['tablcodi'];
				break;
			}
		}
		$iRegCampo["tablcodi"]=$tablcodi;
		$resultcampo=dinamicscancampo($iRegCampo,$nuconn);
		$num = fncnumreg($resultcampo);
				
		while($elementos = each($iRegmanual))
		{ 
			$iRegCampo["campnomb"] = $elementos[0];
			$resultcampo = dinamicscancampo($iRegCampo,$nuconn);
			$num = fncnumreg($resultcampo);
			if($num>0)
			{
				$sbregcampo = fncfetch($resultcampo,0);
				if($elementos[0] != "manualcodigo")
				{
					if($sbregcampo["campnomb"] == $elementos[0])
					{
						$respuesta = strcmp($sbregcampo["campnotnull"],"t");
						if($respuesta == 0)
						{
							if($elementos[1] == "")
							{
								$campnomb[$elementos[0]] = 1;
								$flageditarmanual = 1;
								$flagerror = 1;
							}
						}
					}
				}
			}
			$validar = buscacaracter($elementos[1]);
			if($validar == 1) 
			{ 
				$flageditarmanual = 1; 
				$flagerror = 1; 
				$campnomb[$elementos[0]] = 1;
			}
			
			$validresult = consulmetamanual($elementos[0],$elementos[1],$nuconn);
			if ($validresult == 1)
			{
				$flageditarmanual = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;
				unset ($validresult);
			}
			if($elementos[0] == 'manualnombre')
			{
				$validnombre =  fncnombeditexs('manual',$iRegmanual,$elementos[0],$elementos[1],
				'manualcodigo',$iRegmanual['manualcodigo'],$nuconn);
				if ($validnombre == 1)
				{
					fncmsgerror(errorNombExs);
					$flageditarmanual = 1;
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
		if (!$campnomb) 
			if($file) 
				fncsubirmanual($inombarc,$itipoarc,$tamaarc,$irutaarc,$itemparc,$flagerror,$flagnuevoplano,$flageditarplano);
		if($flagerror != 1) 
		{ 
			$result = uprecordmanual($iRegmanual,$nuconn); 
			if($result < 0 ) 
			{ 
				ob_end_clean(); 
				fncmsgerror(errorReg); 
				$flageditarmanual=1; 
			} 
			if($result > 0) 
			{ 
				fncmsgerror(editaEx); 
				echo '<script language="javascript">'; 
				echo '<!--//'."\n"; 
				echo 'location ="maestablmanual.php?codigo='.$codigo.';"'; 
				echo '//-->'."\n"; 
				echo '</script>'; 
			} 
			fncclose($nuconn); 
		} 
	} 
} 
if($file)
{
	//datos del archivo
	$inombarc = $HTTP_POST_FILES['file']['name'];
	$itipoarc = $HTTP_POST_FILES['file']['type'];
	$tamaarc = $HTTP_POST_FILES['file']['size'];
	$irutaarc = "../doc/manuales/";
	$itemparc = $HTTP_POST_FILES['file']['tmp_name'];
	$manualruta = $irutaarc.$inombarc;
}

$iRegmanual[manualcodigo] = $manualcodigo; 
$iRegmanual[manualnombre] = $manualnombre; 
$iRegmanual[manualruta] = $manualruta; 
$iRegmanual[manualdescri] = $manualdescri; 
editamanual($iRegmanual,$flageditarmanual,$campnomb,$codigo,$inombarc,$itipoarc,$tamaarc,$irutaarc,$itemparc,$file); 
?> 
