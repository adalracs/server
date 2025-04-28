<?php 
include ( '../src/FunPerPriNiv/pktblplano.php');
include ( '../src/FunPerPriNiv/pktblcampo.php');
include ( '../src/FunPerPriNiv/pktbltabla.php');
include ( '../def/tipocampo.php');
include ( '../src/FunGen/buscacaracter.php');
include( '../src/FunGen/fncsubirplano.php');
include( '../src/FunGen/fncnombeditexs.php');

function editaplano($iRegplano,&$flageditarplano,&$campnomb,&$codigo,$inombarc,$itipoarc,$tamaarc,$irutaarc,$itemparc,$file)
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

	if ($iRegplano)
	{
		$iRegtabla["tablnomb"] = "plano";
		$resulttabla = dinamicscantabla($iRegtabla,$nuconn);
		$num = fncnumreg($resulttabla);

		for($i=0;$i<$num;$i++)
		{
			$sbregtabla = fncfetch($resulttabla,$i);

			if($sbregtabla[tablnomb] == "plano")
			{
				$tablcodi=$sbregtabla['tablcodi'];
				break;
			}
		}
		$iRegCampo["tablcodi"] = $tablcodi;
		$resultcampo = dinamicscancampo($iRegCampo,$nuconn);
		$num = fncnumreg($resultcampo);

		while($elementos = each($iRegplano))
		{
			$iRegCampo["campnomb"] = $elementos[0];
			$resultcampo = dinamicscancampo($iRegCampo,$nuconn);
			$num = fncnumreg($resultcampo);
			if($num>0)
			{
				$sbregcampo = fncfetch($resultcampo,0);
				if($elementos[0] != "planocodigo")
				{
					if($sbregcampo["campnomb"] == $elementos[0])
					{
						$respuesta = strcmp($sbregcampo["campnotnull"],"t");
						if($respuesta == 0)
						{
							if($elementos[1] == "")
							{
								$campnomb[$elementos[0]] = 1;
								$flageditarplano = 1;
								$flagerror = 1;
							}
						}
					}
				}
			}

			$validar = buscacaracter($elementos[1]);
			if($validar == 1)
			{
				$flageditarplano = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;
			}

			$validresult = consulmetaplano($elementos[0],$elementos[1],$nuconn);
			if ($validresult == 1)
			{
				$flageditarplano = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;
				unset ($validresult);
			}

			if($elementos[0] == 'planonombre')
			{
				$validnombre =  fncnombeditexs('plano',$iRegplano,$elementos[0],$elementos[1],
				'planocodigo',$iRegplano[planocodigo],$nuconn);
				if ($validnombre == 1)
				{
					fncmsgerror(errorNombExs);
					$flageditarplano = 1;
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
				fncsubirplano($inombarc,$itipoarc,$tamaarc,$irutaarc,$itemparc,$flagerror,$flagnuevoplano,$flageditarplano);

		if($flagerror != 1)
		{
			$result = uprecordplano($iRegplano,$nuconn);
			if($result < 0 )
			{
				ob_end_clean();
				fncmsgerror(errorReg);
				$flageditarplano=1;
			}
			if($result > 0)
			{
				fncmsgerror(editaEx);
				echo '<script language="javascript">';
				echo '<!--//'."\n";
				echo 'location ="maestablplano.php?codigo='.$codigo.';"';
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
	$irutaarc = "../img/planos/";
	$itemparc = $HTTP_POST_FILES['file']['tmp_name'];
	$planoruta = $irutaarc.$inombarc;
}

$iRegplano[planocodigo] = $planocodigo;
$iRegplano[planonombre] = $planonombre;
$iRegplano[planoruta] = $planoruta;
$iRegplano[planodescri] = $planodescri;
editaplano($iRegplano,$flageditarplano,$campnomb,$codigo,$inombarc,$itipoarc,$tamaarc,$irutaarc,$itemparc,$file);
?> 
