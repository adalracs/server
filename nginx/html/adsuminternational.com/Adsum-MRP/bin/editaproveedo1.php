<?php 
include ( '../src/FunPerPriNiv/pktblproveedo.php');
//include ('../src/FunPerPriNiv/pktblproveefabri.php');
include ( '../src/FunPerPriNiv/pktblcampo.php');
include ( '../src/FunPerPriNiv/pktbltabla.php');
include ( '../def/tipocampo.php');
include ( '../src/FunGen/buscacaracter.php');
include ( '../src/FunGen/fncmsgerror.php');
include( '../src/FunGen/fncnombeditexs.php');

function editaproveedo1($iRegproveedo1,&$flageditarproveedo1,&$campnomb,&$codigo)
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
	
	if ($iRegproveedo1) 
	{ 
		$iRegtabla["tablnomb"] = "proveedo";
		$resulttabla = dinamicscantabla($iRegtabla,$nuconn);
		$num = fncnumreg($resulttabla);
		
		for($i=0;$i<$num;$i++)
		{
			$sbregtabla = fncfetch($resulttabla,$i);
			
			if($sbregtabla[tablnomb] == "proveedo")
			{
				$tablcodi=$sbregtabla['tablcodi'];
				break;
			}
		}
		$iRegCampo["tablcodi"]=$tablcodi;
		$resultcampo=dinamicscancampo($iRegCampo,$nuconn);
		$num = fncnumreg($resultcampo);
		$iRegproveedo1_b = $iRegproveedo1;
		
		while($elementos = each($iRegproveedo1))
		{ 
			$iRegCampo["campnomb"] = $elementos[0];
			$resultcampo = dinamicscancampo($iRegCampo,$nuconn);
			$num = fncnumreg($resultcampo);
			if($num>0)
			{
				$sbregcampo = fncfetch($resultcampo,0);
				if($elementos[0] != "proveecodigo")
				{
					if($sbregcampo["campnomb"] == $elementos[0])
					{
						$respuesta = strcmp($sbregcampo["campnotnull"],"t");
						if($respuesta == 0)
						{
							if($elementos[1] == "")
							{
								$campnomb[$elementos[0]] = 1;
								$flageditarproveedo1 = 1;
								$flagerror = 1;
							}
						}
					}
				}
			}			
			$validar = buscacaracter($elementos[1]);
			
			if($validar == 1) 
			{ 
				$flageditarproveedo1 = 1; 
				$flagerror = 1; 
				$campnomb[$elementos[0]] = 1;
			}			
			$validresult = consulmetaproveedo($elementos[0],$elementos[1],$nuconn);
			
			if ($validresult == 1)
			{
				$flageditarproveedo1 = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;
				unset ($validresult);
			}
			
			if($elementos[0]=='proveenombre')
			{
				$validnombre =  fncnombeditexs('proveedo',$iRegproveedo1,$elementos[0],$elementos[1],
				'proveecodigo',$iRegproveedo1[proveecodigo],$nuconn);
				if ($validnombre == 1)
				{
					fncmsgerror(errorNombExs);
					$flageditarproveedo1 = 1;
					$flagerror = 1;
					$campnomb[$elementos[0]] = 1;
					unset ($validnombre);
				}
			}
			
			if($elementos[0] == 'proveeemail' && $elementos[1] != null)
			{
					if (!ereg("^[_a-zA-Z0-9-]+(\.[_a-zA-Z0-9-]+)*@+([_a-zA-Z0-9-]+\.)*[a-zA-Z0-9-]{2,200}\.[a-zA-Z]{2,6}$",$elementos[1]) )
					{
						fncmsgerror(errormail);
						$flageditarproveedo1 = 1;
						$flagerror = 1;
						$campnomb[$elementos[0]] = 1;
					}
			}
			
			if($elementos[0] == 'proveerepleg' && $elementos[1] == null)
			{
				$flageditarproveedo1 = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;
			}

			if($elementos[0] == 'proveetelefo' && $elementos[1] == null)
			{
				$flageditarproveedo1 = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;
			}

			if($elementos[0] == 'proveepais' && $elementos[1] == null)
			{
				$flageditarproveedo1 = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;
			}
			
			if($elementos[0] == 'proveeciudad' && $elementos[1] == null)
			{
				$flageditarproveedo1 = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;
			}

			if($elementos[0] == 'proveedirecc' && $elementos[1] == null)
			{
				$flageditarproveedo1 = 1;
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
			$result = uprecordproveedo($iRegproveedo1,$nuconn);
			if($result < 0 )
			{
				ob_end_clean();
				fncmsgerror(errorReg);
				$flageditarproveedo1=1;
			}
			if($result > 0)
			{
				fncmsgerror(editaEx);
			}
			fncclose($nuconn);
		}
	}
}
$iRegproveedo1[proveecodigo] = $proveecodigo;
$iRegproveedo1[proveenombre] = $proveenombre;
$iRegproveedo1[proveerepleg] = $proveerepleg;
$iRegproveedo1[proveetelefo] = $proveetelefo;
$iRegproveedo1[proveefax] = $proveefax;
$iRegproveedo1[proveepais] = $proveepais;
$iRegproveedo1[ciudadcodigo] = $ciudadcodigo;
$iRegproveedo1[proveedirecc] = $proveedirecc;
$iRegproveedo1[proveeurl] = $proveeurl;
$iRegproveedo1[proveeemail] = $proveeemail;
$iRegproveedo1[proveenota] = $proveenota;
$iRegproveedo1[proestcodigo] = $proestcodigo;
$iRegproveedo1[proveepostal] = $proveepostal;
$iRegproveedo1[proveecontac] = $proveecontac;
$iRegproveedo1[proveetelcon] = $proveetelcon;
$iRegproveedo1[tipprocodigo] = $tipprocodigo;

editaproveedo1($iRegproveedo1,$flageditarproveedo1,$campnomb,$codigo);

if(!$flageditarproveedo1)
{
	$idcon = fncconn();	
		if($proveecodigo)
		{
			$rowarrfabricanteprovee = explode(',',$arrfabricanteprovee);
			delrecordproveefabri($proveecodigo,$idcon);
		}

		for($a = 0; $a < count($rowarrfabricanteprovee);$a++)
		{
			if($rowarrfabricanteprovee[$a]){
			$iRegfabricanteprovee[proveecodigo] = $proveecodigo;
			$iRegfabricanteprovee[fabricodigo] = $rowarrfabricanteprovee[$a];	
			insrecordproveefabri($iRegfabricanteprovee,$idcon);
			}
		}
		
}
?> 
