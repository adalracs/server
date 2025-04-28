<?php 
include ( '../src/FunPerPriNiv/pktblturno.php');
include ( '../src/FunPerPriNiv/pktblcampo.php');
include ( '../src/FunPerPriNiv/pktbltabla.php');
include ( '../def/tipocampo.php');
include ( '../src/FunGen/buscacaracter.php');
include ( '../src/FunGen/fncmsgerror.php');
include( '../src/FunGen/fncnombeditexs.php');

function editaturno($iRegturno,&$flageditarturno,&$campnomb,&$codigo)
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
	
	if ($iRegturno)
	{ 
		$iRegtabla["tablnomb"] = "turno";
		$resulttabla = dinamicscantabla($iRegtabla,$nuconn);
		$num = fncnumreg($resulttabla);
		
		for($i = 0; $i < $num; $i++)
		{
			$sbregtabla = fncfetch($resulttabla,$i);
			
			if($sbregtabla[tablnomb] == "turno")
			{
				$tablcodi = $sbregtabla['tablcodi'];
				break;
			}
		}
		
		$iRegCampo["tablcodi"] = $tablcodi;
		$resultcampo = dinamicscancampo($iRegCampo,$nuconn);
		$num = fncnumreg($resultcampo);
				
		while($elementos = each($iRegturno))
		{ 
			$iRegCampo["campnomb"] = $elementos[0];
			$resultcampo = dinamicscancampo($iRegCampo,$nuconn);
			$num = fncnumreg($resultcampo);
			
			if($num>0)
			{
				$sbregcampo = fncfetch($resultcampo,0);
				
				if($elementos[0] != "turnocodigo")
				{
					if($sbregcampo["campnomb"] == $elementos[0])
					{
						$respuesta = strcmp($sbregcampo["campnotnull"],"t");
						
						if($respuesta == 0)
						{
							if($elementos[1] == "")
							{
								$campnomb[$elementos[0]] = 1;
								$flageditarturno = 1;
								$flagerror = 1;
							}
						}
					}
				}
			}
			
			$validar = buscacaracter($elementos[1]); 
			if($validar == 1)
			{ 
				$flageditarturno = 1; 
				$flagerror = 1; 
				$campnomb[$elementos[0]] = 1; 
			} 
			$validresult = consulmetaturno($elementos[0],$elementos[1],$nuconn); 
			
			if ($validresult == 1)
			{ 
				$flageditarturno = 1; 
				$flagerror = 1; 
				$campnomb[$elementos[0]] = 1; 
				unset ($validresult); 
			} 
			
			/*
			if($elementos[0]=='turnonombre')
			{
				if($elementos[1] != null)
				{
					$validnombre =  fncnombeditexs('turno',$iRegturno,$elementos[0],$elementos[1],'turnocodigo',$iRegturno[turnocodigo],$nuconn);
					
					if ($validnombre == 1)
					{
						fncmsgerror(errorNombExs);
						$flageditarturno = 1;
						$flagerror = 1;
						$campnomb[$elementos[0]] = 1;
						unset ($validnombre);
					}
				}
				else
				{
					$flageditarturno = 1;
					$flagerror = 1;
					$campnomb[$elementos[0]] = 1;					
				}
			}
			*/
		} 
		
		if($flagerror == 1)
			fncmsgerror(errorIng);
		
		if($flagerror != 1)
		{ 
			$result = uprecordturno($iRegturno,$nuconn); 
			
			if($result < 0 )
			{			
				ob_end_clean(); 
				fncmsgerror(errorReg); 
				$flageditarturno=1; 
			} 
			if($result > 0)
			{ 
				fncmsgerror(editaEx); 
				echo '<script language="javascript">'; 
				echo '<!--//'."\n"; 
				echo 'location ="maestablturno.php?codigo='.$codigo.';"'; 
				echo '//-->'."\n"; 
				echo '</script>'; 
			} 
			fncclose($nuconn); 
		} 
	} 
}

/*
include ('../src/FunGen/fncdatediff.php');

if(datediff("n", $turnohorini, $turnohorfin) <= 0)
{
	$campnomb["turnohorini"] = 1;
	$campnomb["turnohorfin"] = 1;
	
	echo "<script language='JavaScript'>";
	echo "alert('Error: La hora de inicio debe ser mayor a la hora fin');";
	echo "</script>";
	
	$flageditarturno = 1;
}
else
{ */
	$iRegturno[turnocodigo] = $turnocodigo; 
	$iRegturno[turnonombre] = $turnonombre; 
	$iRegturno[turnoacroni] = $turnoacroni; 
	$iRegturno[turnohorini] = $turnohorini; 
	$iRegturno[turnohorfin] = $turnohorfin; 
	
	editaturno($iRegturno,$flageditarturno,$campnomb,$codigo); 
//}