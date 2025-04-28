<?php 
include ( '../src/FunPerPriNiv/pktblsistema.php');
include ( '../src/FunPerPriNiv/pktblcampo.php');
include ( '../src/FunPerPriNiv/pktbltabla.php');
include ( '../def/tipocampo.php');
include ( '../src/FunGen/buscacaracter.php');
include ( '../src/FunGen/fncmsgerror.php');
include( '../src/FunGen/fncnombeditexs.php');

function editasistema($iRegsistema,&$flageditarsistema,&$campnomb,&$codigo,&$iRegequicamper)
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


			if($elementos[0]=='sistemnombre')
			{
				$keyArray = array($elementos[0], "plantacodigo");
				$valueArray = array($elementos[1], $iRegsistema["plantacodigo"]);
				$validnombre =  fncnombeditexs('sistema',$iRegsistema,$keyArray,$valueArray,
				'sistemcodigo',$iRegsistema[sistemcodigo],$nuconn);
				if ($validnombre == 1)
				{
					fncmsgerror(errorNombExs);
					$flageditarsistema = 1;
					$flagerror = 1;
					$campnomb = $elementos[0];
					unset ($validnombre);
					break;
				}
			}
	if ($iRegsistema) 
	{ 
		$flageditarsistema=0;
		$iRegtabla["tablnomb"] = "sistema";
		$resulttabla = dinamicscantabla($iRegtabla,$nuconn);
		$num = fncnumreg($resulttabla);
		
		for($i=0;$i<$num;$i++)
		{
			$sbregtabla = fncfetch($resulttabla,$i);
			
			if($sbregtabla[tablnomb] == "sistema")
			{
				$tablcodi=$sbregtabla['tablcodi'];
				break;
			}
		}
		$iRegCampo["tablcodi"]=$tablcodi;
		$resultcampo = dinamicscancampo($iRegCampo,$nuconn);
		$num = fncnumreg($resultcampo);
				
		while($elementos = each($iRegsistema))
		{ 
			$iRegCampo["campnomb"] = $elementos[0];
			$resultcampo = dinamicscancampo($iRegCampo,$nuconn);
			$num = fncnumreg($resultcampo);
			if($num>0)
			{
				$sbregcampo = fncfetch($resultcampo,0);
				if($elementos[0] != "sistemcodigo")
				{
					if($sbregcampo["campnomb"] == $elementos[0])
					{
						$respuesta = strcmp($sbregcampo["campnotnull"],"t");
						if($respuesta == 0)
						{
							if($elementos[1] == "")
							{
								$campnomb[$elementos[0]] = 1;
								$flageditarsistema = 1;
								$flagerror = 1;
							}
						}
					}
				}
			}
			
			$validar = buscacaracter($elementos[1]);
			if($validar == 1) 
			{ 
				$flageditarsistema = 1; 
				$flagerror = 1; 
				$campnomb[$elementos[0]] = 1;
			}
			
			$validresult = consulmetasistema($elementos[0],$elementos[1],$nuconn);
			if ($validresult == 1)
			{
				$flageditarsistema = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;
				unset ($validresult);
			}
				//cbedoya -- Revisa si alguno de los campos esta vacio

			/*if($elementos[0] == "tipsiscodigo")
			{

				if($elementos[1] == "")
				{
					$flageditarsistema = 1;
					$flagerror = 1;
					$campnomb[$elementos[0]] = 1;
				}
			}*/
		}	

		while ($element_cam = each($iRegequicamper)) {
			$validar_cam = buscacaracter($element_cam[1]);

			if($validar_cam == 1)
			{
				$flageditarsistema = 1;
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
			$result = uprecordsistema($iRegsistema,$nuconn);
			if($result < 0 )
			{
				ob_end_clean();
				fncmsgerror(errorReg);
				$flageditarsistema=1;
			}
			if($result > 0)
			{
				/*fncmsgerror(editaEx);
				echo '<script language="javascript">';
				echo '<!--//'."\n";
				echo 'location ="maestablsistema.php?codigo='.$codigo.';"';
				echo '//-->'."\n";
				echo '</script>';*/
			}
			fncclose($nuconn);
		}
	}
}
$iRegsistema[sistemcodigo] = $sistemcodigo;
$iRegsistema[plantacodigo] = $plantacodigo;
$iRegsistema[sistemnombre] = $sistemnombre;
$iRegsistema[sistemdescri] = $sistemdescri;
$iRegsistema[tipsiscodigo] = $tipsiscodigo;

//cbedoya
$arr_campers = explode(";",$arreglo_cam);

foreach ($arr_campers as $x)
{
	$arr_text = explode(":",$x);
	$iRegequicamper[$arr_text[0]] = $arr_text[1];
}

//cbedoya
editasistema($iRegsistema,$flageditarsistema,$campnomb,$codigo,&$iRegequicamper);//cbedoya


//cbedoya
if(!$flageditarsistema){
	if($iRegequicamper)
	  {include('editasistemacamperequipo.php');}
	  
		
	  fncmsgerror(editaEx);
	  echo '<script language="javascript">';
	  echo '<!--//'."\n";
	  echo 'location ="maestablsistema.php?codigo='.$codigo.';"';
	  echo '//-->'."\n";
	  echo '</script>';
}//cbedoya
?> 
