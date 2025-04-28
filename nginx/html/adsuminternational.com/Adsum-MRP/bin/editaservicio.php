<?php 
include ( '../src/FunPerPriNiv/pktblservicio.php');
include ( '../src/FunPerPriNiv/pktbltabla.php');
include ( '../src/FunPerPriNiv/pktblcampo.php');
include ( '../def/tipocampo.php');
include ( '../src/FunGen/buscacaracter.php');
include ( '../src/FunGen/fncmsgerror.php');
include ( '../src/FunGen/fncnombeditexs.php');

function editaservicio($iRegservicio,&$flageditarservicio,&$campnomb,&$codigo)
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
	define("errorServ",41);

	if ($iRegservicio)
	{
		$iRegtabla["tablnomb"] = "servicio";
		$resulttabla = dinamicscantabla($iRegtabla,$nuconn);
		$num = fncnumreg($resulttabla);

		for($i=0;$i<$num;$i++)
		{
			$sbregtabla = fncfetch($resulttabla,$i);

			if($sbregtabla[tablnomb] == "servicio")
			{
				$tablcodi=$sbregtabla['tablcodi'];
				break;
			}
		}
		$iRegCampo["tablcodi"]=$tablcodi;
		$resultcampo=dinamicscancampo($iRegCampo,$nuconn);
		$num = fncnumreg($resultcampo);

		while($elementos = each($iRegservicio))
		{
			$iRegCampo["campnomb"] = $elementos[0];
			$resultcampo = dinamicscancampo($iRegCampo,$nuconn);
			$num = fncnumreg($resultcampo);
			if($num>0)
			{
				$sbregcampo = fncfetch($resultcampo,0);
				if($elementos[0] != "servicicodigo")
				{
					if($sbregcampo["campnomb"] == $elementos[0])
					{
						$respuesta = strcmp($sbregcampo["campnotnull"],"t");
						if($respuesta == 0)
						{
							if($elementos[1] == "")
							{
								$campnomb[$elementos[0]] = 1;
								$flageditarservicio = 1;
								$flagerror = 1;
							}
						}
					}
				}
			}

			$validar = buscacaracter($elementos[1]);
			if($validar == 1)
			{
				$flageditarservicio = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;
			}

			$validresult = consulmetaservicio($elementos[0],$elementos[1],$nuconn);
			if ($validresult == 1)
			{
				$flageditarservicio = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;
				unset ($validresult);
			}

			if($elementos[0] == 'servicinombre')
			{
				if($elementos[1] != "")
				{
					$key = array($elementos[0], "negocicodigo");
					$value = array($elementos[1], $iRegservicio["negocicodigo"]);
					$valid = fncnombeditexs("servicio", $iRegservicio, $key, $value,
					"servicicodigo", $iRegservicio["servicicodigo"], $nuconn);
					
					if($valid == 1)
					{
						fncmsgerror(errorServ);
						$flageditarservicio = 1;
						$flagerror = 1;
						$flagnomberr = 1;
						$campnomb[$elementos[0]] = 1;
					}
				}

				if ($validnombre == 1)
				{
					fncmsgerror(errorPlnExs);
					$flageditardocuequi = 1;
					$flagerror = 1;
					$campnomb[$elementos[0]] = 1;
					unset ($validnombre);
				}
			}
		}

		if(($flagerror == 1) && !($flagnomberr))
		{
			fncmsgerror(errorIng);
		}

		if($flagerror != 1)
		{
			$result = uprecordservicio($iRegservicio,$nuconn);
			if($result < 0 )
			{
				ob_end_clean();
				fncmsgerror(errorReg);
				$flageditarservicio=1;
			}
			if($result > 0)
			{
				fncmsgerror(editaEx);
				echo '<script language="javascript">';
				echo '<!--//'."\n";
				echo 'location ="maestablservicio.php?codigo='.$codigo.';"';
				echo '//-->'."\n";
				echo '</script>';
			}
			fncclose($nuconn);
		}
	}
}
$iRegservicio[servicicodigo] = $servicicodigo;
$iRegservicio[negocicodigo] = $negocicodigo;
$iRegservicio[servicinombre] = $servicinombre;
$iRegservicio[servicidescri] = $servicidescri;
editaservicio($iRegservicio,$flageditarservicio,$campnomb,$codigo);
?> 
