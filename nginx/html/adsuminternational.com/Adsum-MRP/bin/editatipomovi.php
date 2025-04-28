<?php 
include ( '../src/FunPerPriNiv/pktbltipomovi.php');
include ( '../src/FunPerPriNiv/pktblcampo.php');
include ( '../src/FunPerPriNiv/pktbltabla.php');
include ( '../def/tipocampo.php');
include ( '../src/FunGen/buscacaracter.php');
include ( '../src/FunGen/fncmsgerror.php');
include( '../src/FunGen/fncnombeditexs.php');
function editatipomovi($iRegtipomovi,&$flageditartipomovi,&$campnomb,&$codigo)
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
	define("Ingdef",1);
	define("Egrdef",2);
	
	if($iRegtipomovi[tipmovcodigo] == Ingdef || $iRegtipomovi[tipmovcodigo] == Egrdef)
	{
		echo '<script language="javascript">';
		echo '<!--//'."\n";
		echo 'alert("Este registro no se puede editar");';
		echo 'location ="maestabltipomovi.php?codigo='.$codigo.';"';
		echo '//-->'."\n";
		echo '</script>';	
	}else 
	{ 
		$iRegtabla["tablnomb"] = "tipomovi";
		$resulttabla = dinamicscantabla($iRegtabla,$nuconn);
		$num = fncnumreg($resulttabla);
		
		for($i=0;$i<$num;$i++)
		{
			$sbregtabla = fncfetch($resulttabla,$i);
			
			if($sbregtabla[tablnomb] == "tipomovi")
			{
				$tablcodi=$sbregtabla['tablcodi'];
				break;
			}
		}
		$iRegCampo["tablcodi"] = $tablcodi;
		$resultcampo = dinamicscancampo($iRegCampo,$nuconn);
		$num = fncnumreg($resultcampo);
		$iRegtipomovi_b = $iRegtipomovi;
		
		while($elementos = each($iRegtipomovi))
		{ 
			$iRegCampo["campnomb"] = $elementos[0];
			$resultcampo = dinamicscancampo($iRegCampo,$nuconn);
			$num = fncnumreg($resultcampo);
			if($num>0)
			{
				$sbregcampo = fncfetch($resultcampo,0);
				if($elementos[0] != "tipmovcodigo")
				{
					if($sbregcampo["campnomb"] == $elementos[0])
					{
						$respuesta = strcmp($sbregcampo["campnotnull"],"t");
						if($respuesta == 0)
						{
							if($elementos[1] == "")
							{
								$campnomb[$elementos[0]] = 1;
								$flageditartipomovi = 1;
								$flagerror = 1;
							}
						}
					}
				}
			}			
			$validar = buscacaracter($elementos[1]);
			
			if($validar == 1) 
			{ 
				$flageditartipomovi = 1; 
				$flagerror = 1; 
				$campnomb[$elementos[0]] = 1;
			}			
			$validresult = consulmetatipomovi($elementos[0],$elementos[1],$nuconn);
			
			if ($validresult == 1)
			{
				$flageditartipomovi = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;
				unset ($validresult);
			}
			
			if($elementos[0] == 'tipmovnombre')
			{
				$validnombre =  fncnombeditexs('tipomovi',$iRegtipomovi_b,$elementos[0],$elementos[1],
				'tipmovcodigo',$iRegtipomovi[tipmovcodigo],$nuconn);
				if ($validnombre == 1)
				{
					fncmsgerror(errorNombExs);
					$flageditartipomovi = 1;
					$flagerror = 1;
					$campnomb[$elementos[0]] = 1;
					unset ($validnombre);
				}
			}
			
			if (($elementos[0] == "tipmovtipo") && ($elementos[0] = ""))
			{
				$flageditartipomovi = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;
			}			
		}
		
		if($flagerror == 1)
		{
			fncmsgerror(errorIng);
		}
		
		if($flagerror != 1)
		{
			$result = uprecordtipomovi($iRegtipomovi,$nuconn);
			if($result < 0 )
			{
				ob_end_clean();
				fncmsgerror(errorReg);
				$flageditartipomovi=1;
			}
			if($result > 0)
			{
				fncmsgerror(editaEx);
				echo '<script language="javascript">';
				echo '<!--//'."\n";
				echo 'location ="maestabltipomovi.php?codigo='.$codigo.';"';
				echo '//-->'."\n";
				echo '</script>';
			}
			fncclose($nuconn);
		}
	}
}
$iRegtipomovi[tipmovcodigo] = $tipmovcodigo;
$iRegtipomovi[tipmovnombre] = $tipmovnombre;
$iRegtipomovi[tipmovdescri] = $tipmovdescri;
$iRegtipomovi[tipmovtipo] = $tipmovtipo;
editatipomovi($iRegtipomovi,$flageditartipomovi,$campnomb,$codigo);
?> 
