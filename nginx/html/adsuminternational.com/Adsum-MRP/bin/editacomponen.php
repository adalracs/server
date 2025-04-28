<!--=> cbedoya <=-07-09-2007-=> modificado para adaptación de los campos personalizados <=---->
<?php
include ( '../src/FunPerPriNiv/pktblcomponen.php');
include ( '../src/FunPerPriNiv/pktbltabla.php');
include ( '../src/FunPerPriNiv/pktblcampo.php');
include ( '../src/FunGen/datecmp.php');
include ( '../def/tipocampo.php');
include ( '../src/FunGen/buscacaracter.php');
include ( '../src/FunGen/fncmsgerror.php');
include( '../src/FunGen/fncnombeditexs.php');

function editacomponen($iRegcomponen,&$flageditarcomponen,&$campnomb,&$codigo,&$fecactual,&$iRegequicamper)
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

	if ($iRegcomponen)
	{
		$flageditarcomponen=0;
		$iRegtabla["tablnomb"] = "componen";
		$resulttabla = dinamicscantabla($iRegtabla,$nuconn);
		$num = fncnumreg($resulttabla);

		for($i=0;$i<$num;$i++)
		{
			$sbregtabla = fncfetch($resulttabla,$i);
				
			if($sbregtabla[tablnomb] == "componen")
			{
				$tablcodi=$sbregtabla['tablcodi'];
				break;
			}
		}
		$iRegCampo["tablcodi"]=$tablcodi;
		$resultcampo=dinamicscancampo($iRegCampo,$nuconn);
		$num = fncnumreg($resultcampo);

		while($elementos = each($iRegcomponen))
		{
			$iRegCampo["campnomb"] = $elementos[0];
			$resultcampo = dinamicscancampo($iRegCampo,$nuconn);
			$num = fncnumreg($resultcampo);
			if($num>0)
			{
				$sbregcampo = fncfetch($resultcampo,0);
				if($elementos[0] != "componcodigo")
				{
					if($sbregcampo["campnomb"] == $elementos[0])
					{
						$respuesta = strcmp($sbregcampo["campnotnull"],"t");
						if($respuesta == 0)
						{
							if($elementos[1] == "")
							{
								$campnomb[$elementos[0]] = 1;
								$flageditarcomponen = 1;
								$flagerror = 1;
							}
						}
					}
				}
			}
				
			$validar = buscacaracter($elementos[1]);
//			if($validar == 1)
//			{
//				$flageditarcomponen = 1;
//				$flagerror = 1;
//				$campnomb[$elementos[0]] = 1;
//			}
				
			$validresult = 0;
			
			if ($validresult == 1)
			{
				$flageditarcomponen = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;
				unset ($validresult);
			}

			if($elementos[0]=='componnombre')
			{
				if($elementos[1] != null)
				{
//					$validnombre =  fncnombeditexs('componen',$iRegcomponen,$elementos[0],$elementos[1],'componcodigo',$iRegcomponen[componcodigo],$nuconn);
//					if ($validnombre == 1)
//					{
//						fncmsgerror(errorNombExs);
//						$flageditarcomponen = 1;
//						$flagerror = 1;
//						$campnomb[$elementos[0]] = 1;
//						unset ($validnombre);
//					}
				}
				else
				{
					$flageditarcomponen = 1;
					$flagerror = 1;
					$campnomb[$elementos[0]] = 1;
				}
			}
			//cbedoya --
			if($elementos[0] == "tipcomcodigo")
			{

				if($elementos[1] == "")
				{
					$flageditarcomponen = 1;
					$flagerror = 1;
					$campnomb[$elementos[0]] = 1;
				}
			}
		}

		while ($element_cam = each($iRegequicamper)) {
			$validar_cam = buscacaracter($element_cam[1]);

			if($validar_cam == 1)
			{
				$flageditarcomponen = 1;
				$flagerror = 1;
				$campnomb[$element_cam[0]] = 1;
			}
		}

		if($flagerror == 1)
		{
			fncmsgerror(errorIng);
		}

		if($flagerror != 1)
		{
			$result = uprecordcomponen($iRegcomponen,$nuconn);
			if($result < 0 )
			{
				ob_end_clean();
				fncmsgerror(errorReg);
				$flagnuevocomponen = 1;
			}
			fncclose($nuconn);
		}
	}
}
$iRegcomponen[componcodigo] = $componcodigo;
$iRegcomponen[equipocodigo] = $equipocodigo;
$iRegcomponen[componnombre] = $componnombre;
$iRegcomponen[compondescri] = $compondescri;
$iRegcomponen[componfabric] = $componfabric;
$iRegcomponen[componmarca] = $componmarca;
$iRegcomponen[componmodelo] = $componmodelo;
$iRegcomponen[componserie] = $componserie;
$iRegcomponen[componfeccom] = $componfeccom;
$iRegcomponen[componfecins] = $componfecins;
$iRegcomponen[componcinv] = $componcinv;
$iRegcomponen[componvengar] = $componvengar;
$iRegcomponen[componviduti] = $componviduti;
$iRegcomponen[componubicac] = $componubicac;
$iRegcomponen[componalto] = $componalto;
$iRegcomponen[componlargo] = $componlargo;
$iRegcomponen[componancho] = $componancho;
$iRegcomponen[componpeso] = $componpeso;
$iRegcomponen[tipcomcodigo] = $tipcomcodigo;
//cbedoya


$arr_campers = explode(";",$arreglo_cam);

foreach ($arr_campers as $x)
{
	$arr_text = explode(":",$x);
	$iRegequicamper[$arr_text[0]] = $arr_text[1];
}

//cbedoya
editacomponen($iRegcomponen,$flageditarcomponen,$campnomb,$codigo,$fecactual,$iRegequicamper);//cbedoya


//cbedoya
if(!$flageditarcomponen){
	if($iRegequicamper)
	{include('editacomponencamperequipo.php');}
	 
	fncmsgerror(editaEx);
	echo '<script language="javascript">';
	echo '<!--//'."\n";
	echo 'location ="maestablcomponen.php?codigo='.$codigo.';"';
	echo '//-->'."\n";
	echo '</script>';
}//cbedoya
?>
