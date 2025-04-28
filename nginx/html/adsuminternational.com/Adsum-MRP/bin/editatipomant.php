<?php 
include ( '../src/FunPerPriNiv/pktbltipomant.php');
include ( '../src/FunPerPriNiv/pktblcampo.php');
include ( '../src/FunPerPriNiv/pktbltabla.php');
include ( '../def/tipocampo.php');
include ( '../src/FunGen/buscacaracter.php');
include ( '../src/FunGen/fncmsgerror.php');
include( '../src/FunGen/fncnombeditexs.php');

function editatipomant($iRegtipomant,&$flageditartipomant,&$campnomb,&$codigo)
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
	
	if ($iRegtipomant) 
	{ 
		$iRegtabla["tablnomb"] = "tipomant";
		$resulttabla = dinamicscantabla($iRegtabla,$nuconn);
		$num = fncnumreg($resulttabla);
		
		for($i=0;$i<$num;$i++)
		{
			$sbregtabla = fncfetch($resulttabla,$i);
			
			if($sbregtabla[tablnomb] == "tipmancodigo")
			{
				$tablcodi=$sbregtabla['tablcodi'];
				break;
			}
		}
		$iRegCampo["tablcodi"]=$tablcodi;

		if ($iRegCampo["tablcodi"]!=null){
			$resultcampo=dinamicscancampo($iRegCampo,$nuconn);
			$num = fncnumreg($resultcampo);
		}	
		while($elementos = each($iRegtipomant))
		{ 
			$iRegCampo["campnomb"] = $elementos[0];
			$resultcampo = dinamicscancampo($iRegCampo,$nuconn);
			$num = fncnumreg($resultcampo);
			if($num>0)
			{
				$sbregcampo = fncfetch($resultcampo,0);
				if($elementos[0] != "tipmancodigo")
				{
					if($sbregcampo["campnomb"] == $elementos[0])
					{
						$respuesta = strcmp($sbregcampo["campnotnull"],"t");
						if($respuesta == 0)
						{
							if($elementos[1] == "")
							{
								$campnomb[$elementos[0]] = 1;
								$flageditartipomant = 1;
								$flagerror = 1;
							}
						}
					}
				}
			}			
			$validar = buscacaracter($elementos[1]);
			
			if($validar == 1) 
			{ 
				$flageditartipomant = 1; 
				$flagerror = 1; 
				$campnomb[$elementos[0]] = 1;
			}			
			$validresult = consulmetatipomant($elementos[0],$elementos[1],$nuconn);
			
			if ($validresult == 1)
			{
				$flageditartipomant = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;
				unset ($validresult);
			}
			
			if($elementos[0]=='tipmannombre')
			{
				if($elementos[1] != null)
				{
					$validnombre =  fncnombeditexs('tipomant',$iRegtipomant,$elementos[0],$elementos[1],'tipmancodigo',$iRegtipomant[tipmancodigo],$nuconn);
					if ($validnombre == 1)
					{
						fncmsgerror(errorNombExs);
						$flageditartipomant = 1;
						$flagerror = 1;
						$campnomb[$elementos[0]] = 1;
						unset ($validnombre);
					}
				}
				else 
				{
					$flageditartipomant = 1;
					$flagerror = 1;
					$campnomb[$elementos[0]] = 1;
				}
			}
		}
		
		if($flagerror == 1)
		{
			fncmsgerror(errorIng);
		}
			
		if($flagerror != 1)
		{
			$result = uprecordtipomant($iRegtipomant,$nuconn);
			if($result < 0 )
			{
				ob_end_clean();
				fncmsgerror(errorReg);
				$flageditartipomant=1;
			}
			if($result > 0)
			{
				fncmsgerror(editaEx);
				echo '<script language="javascript">';
				echo '<!--//'."\n";
				echo 'location ="maestabltipomant.php?codigo='.$codigo.';"';
				echo '//-->'."\n";
				echo '</script>';
			}
			fncclose($nuconn);
		}
	}
}
$iRegtipomant[tipmancodigo] = $tipmancodigo;
$iRegtipomant[tipmannombre] = $tipmannombre;
$iRegtipomant[tipmandescri] = $tipmandescri;
editatipomant($iRegtipomant,$flageditartipomant,$campnomb,$codigo);
?> 
