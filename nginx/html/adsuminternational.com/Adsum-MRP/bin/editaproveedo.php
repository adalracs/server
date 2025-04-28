<?php 
include ( '../src/FunPerPriNiv/pktblproveedo.php');
//include ('../src/FunPerPriNiv/pktblproveefabri.php');
include ( '../src/FunPerPriNiv/pktblcampo.php');
include ( '../src/FunPerPriNiv/pktbltabla.php');
include ( '../def/tipocampo.php');
include ( '../src/FunGen/buscacaracter.php');
include ( '../src/FunGen/fncmsgerror.php');
include( '../src/FunGen/fncnombeditexs.php');

function editaproveedo($iRegproveedo,&$flageditarproveedo,&$campnomb,&$codigo)
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
	
	if ($iRegproveedo) 
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
		$iRegproveedo_b = $iRegproveedo;
		
		while($elementos = each($iRegproveedo))
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
								$flageditarproveedo = 1;
								$flagerror = 1;
							}
						}
					}
				}
			}			
			$validar = buscacaracter($elementos[1]);
			
			if($validar == 1) 
			{ 
				$flageditarproveedo = 1; 
				$flagerror = 1; 
				$campnomb[$elementos[0]] = 1;
			}			
			$validresult = consulmetaproveedo($elementos[0],$elementos[1],$nuconn);
			
			if ($validresult == 1)
			{
				$flageditarproveedo = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;
				unset ($validresult);
			}
			
			if($elementos[0]=='proveenombre')
			{
				$validnombre =  fncnombeditexs('proveedo',$iRegproveedo,$elementos[0],$elementos[1],
				'proveecodigo',$iRegproveedo[proveecodigo],$nuconn);
				if ($validnombre == 1)
				{
					fncmsgerror(errorNombExs);
					$flageditarproveedo = 1;
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
						$flageditarproveedo = 1;
						$flagerror = 1;
						$campnomb[$elementos[0]] = 1;
					}
			}
			
			if($elementos[0] == 'proveerepleg' && $elementos[1] == null)
			{
				$flageditarproveedo = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;
			}

			if($elementos[0] == 'proveetelefo' && $elementos[1] == null)
			{
				$flageditarproveedo = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;
			}

			if($elementos[0] == 'proveepais' && $elementos[1] == null)
			{
				$flageditarproveedo = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;
			}
			
			if($elementos[0] == 'proveeciudad' && $elementos[1] == null)
			{
				$flageditarproveedo = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;
			}

			if($elementos[0] == 'proveedirecc' && $elementos[1] == null)
			{
				$flageditarproveedo = 1;
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
			$result = uprecordproveedo($iRegproveedo,$nuconn);
			if($result < 0 )
			{
				ob_end_clean();
				fncmsgerror(errorReg);
				$flageditarproveedo=1;
			}
			if($result > 0)
			{
				fncmsgerror(editaEx);
			}
			fncclose($nuconn);
		}
	}
}
$iRegproveedo[proveecodigo] = $proveecodigo;
$iRegproveedo[proveenombre] = $proveenombre;
$iRegproveedo[proveerepleg] = $proveerepleg;
$iRegproveedo[proveetelefo] = $proveetelefo;
$iRegproveedo[proveefax] = $proveefax;
$iRegproveedo[proveepais] = $proveepais;
$iRegproveedo[ciudadcodigo] = $ciudadcodigo;
$iRegproveedo[proveedirecc] = $proveedirecc;
$iRegproveedo[proveeurl] = $proveeurl;
$iRegproveedo[proveeemail] = $proveeemail;
$iRegproveedo[proveenota] = $proveenota;
$iRegproveedo[proestcodigo] = $proestcodigo;
$iRegproveedo[proveepostal] = $proveepostal;
$iRegproveedo[proveecontac] = $proveecontac;
$iRegproveedo[proveetelcon] = $proveetelcon;
$iRegproveedo[tipprocodigo] = $tipprocodigo;

editaproveedo($iRegproveedo,$flageditarproveedo,$campnomb,$codigo);

if(!$flageditarproveedo)
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
