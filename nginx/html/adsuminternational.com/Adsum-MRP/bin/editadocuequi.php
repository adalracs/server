<?php 
include ( '../def/tipocampo.php');
include ( '../src/FunGen/buscacaracter.php');
include ( '../src/FunGen/fncmsgerror.php');
include( '../src/FunGen/fncnombeditexs.php');
include ( '../src/FunPerPriNiv/pktbldocuequi.php');
include ( '../src/FunPerPriNiv/pktblcampo.php');
include ( '../src/FunPerPriNiv/pktbltabla.php');

function editadocuequi($iRegdocuequi,&$flageditardocuequi,&$campnomb,&$codigo)
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
	define("errorPlnExs",30);
	define("errorNoDoc",31);
	define("errorIng",35);

	if ($iRegdocuequi) 
	{ 
		$iRegtabla["tablnomb"] = "docuequi";
		$resulttabla = dinamicscantabla($iRegtabla,$nuconn);
		$num = fncnumreg($resulttabla);
		
		for($i=0;$i<$num;$i++)
		{
			$sbregtabla = fncfetch($resulttabla,$i);
			
			if($sbregtabla[tablnomb] == "docuequi")
			{
				$tablcodi=$sbregtabla['tablcodi'];
				break;
			}
		}
		$iRegCampo["tablcodi"]=$tablcodi;
		$resultcampo=dinamicscancampo($iRegCampo,$nuconn);
		$num = fncnumreg($resultcampo);
				
		while($elementos = each($iRegdocuequi))
		{ 
			$iRegCampo["campnomb"] = $elementos[0];
			$resultcampo = dinamicscancampo($iRegCampo,$nuconn);
			$num = fncnumreg($resultcampo);
			if($num>0)
			{
				$sbregcampo = fncfetch($resultcampo,0);
				if($elementos[0] != "docequcodigo")
				{
					if($sbregcampo["campnomb"] == $elementos[0])
					{
						$respuesta = strcmp($sbregcampo["campnotnull"],"t");
						if($respuesta == 0)
						{
							if($elementos[1] == "")
							{
								$campnomb[$elementos[0]] = 1;
								$flageditardocuequi = 1;
								$flagerror = 1;
							}
						}
					}
				}
			}
			$validar = buscacaracter($elementos[1]);

			if($validar == 1) 
			{ 
				$flageditardocuequi = 1; 
				$flagerror = 1; 
				$campnomb[$elementos[0]] = 1;
			}		
			$validresult = consulmetadocuequi($elementos[0],$elementos[1],$nuconn);
			
			if ($validresult == 1)
			{
				$flageditardocuequi = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;
				unset ($validresult);
			}
			
			if($elementos[0] == "equipocodigo" and $elementos[1] == null)
			{
				$flageditardocuequi = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;
			}
			
			if($elementos[0]=='planocodigo' and $elementos[1] != null)
			{
				$keyArray = array($elementos[0], "equipocodigo");
				$valueArray = array($elementos[1], $iRegdocuequi["equipocodigo"]);
				$validnombre =  fncnombeditexs('docuequi',$iRegdocuequi,$keyArray,$valueArray,
				'docequcodigo',$iRegdocuequi[docequcodigo],$nuconn);
				
				if ($validnombre == 1)
				{
					fncmsgerror(errorPlnExs);
					$flageditardocuequi = 1;
					$flagerror = 1;
					$campnomb[$elementos[0]] = 1;
					unset ($validnombre);
				}
			}
			
			if($elementos[0]=='manualcodigo' and $elementos[1] != null)
			{
				$keyArray = array($elementos[0], "equipocodigo");
				$valueArray = array($elementos[1], $iRegdocuequi["equipocodigo"]);
				$validnombre =  fncnombeditexs('docuequi',$iRegdocuequi,$keyArray,$valueArray,
				'docequcodigo',$iRegdocuequi[docequcodigo],$nuconn);
				
				if ($validnombre == 1)
				{
					fncmsgerror(errorPlnExs);
					$flageditardocuequi = 1;
					$flagerror = 1;
					$campnomb[$elementos[0]] = 1;
					unset ($validnombre);
				}
			}
			if($iRegdocuequi[planocodigo] == null and $iRegdocuequi[manualcodigo] == null)
			{
				fncmsgerror(errorNoDoc);
				$flageditardocuequi = 1;
				$flagerror = 1;
				break;
			}
		}
		
		if($flagerror == 1)
		{
			fncmsgerror(errorIng);
		}

		if($flagerror != 1)
		{
			$result = uprecorddocuequi($iRegdocuequi,$nuconn);
			if($result < 0 )
			{
				ob_end_clean();
				fncmsgerror(errorReg);
				$flageditardocuequi=1;
			}
			if($result > 0)
			{
				fncmsgerror(editaEx);
				echo '<script language="javascript">';
				echo '<!--//'."\n";
				echo 'location ="maestabldocuequi.php?codigo='.$codigo.';"';
				echo '//-->'."\n";
				echo '</script>';
			}
			fncclose($nuconn);
		}
	}
}
$iRegdocuequi[docequcodigo] = $docequcodigo;
$iRegdocuequi[equipocodigo] = $equipocodigo;
$iRegdocuequi[planocodigo] = $planocodigo;
$iRegdocuequi[manualcodigo] = $manualcodigo;
editadocuequi($iRegdocuequi,$flageditardocuequi,$campnomb,$codigo);
?> 
