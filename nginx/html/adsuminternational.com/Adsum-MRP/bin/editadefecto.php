<?php 
include ( '../src/FunPerPriNiv/pktbldefecto.php'); 
include ( '../src/FunPerPriNiv/pktblcampo.php');
include ( '../src/FunPerPriNiv/pktbltabla.php');
include ( '../def/tipocampo.php');
include ( '../src/FunGen/buscacaracter.php');
include ( '../src/FunGen/fncmsgerror.php');
include( '../src/FunGen/fncnombeditexs.php');

function editadefecto($iRegdefecto,&$flageditardefecto,&$campnomb,&$codigo)
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

	if ($iRegdefecto) 
	{ 
		$iRegtabla["tablnomb"] = "defecto";
		$resulttabla = dinamicscantabla($iRegtabla,$nuconn);
		$num = fncnumreg($resulttabla);
		
		for($i=0;$i<$num;$i++)
		{
			$sbregtabla = fncfetch($resulttabla,$i);
			
			if($sbregtabla[tablnomb] == "defecto")
			{
				$tablcodi=$sbregtabla['tablcodi'];
				break;
			}
		}
		$iRegCampo["tablcodi"]=$tablcodi;
		$resultcampo=dinamicscancampo($iRegCampo,$nuconn);
		$num = fncnumreg($resultcampo);
		$iRegdefecto_b = $iRegdefecto;
				
		while($elementos = each($iRegdefecto))
		{ 
			$iRegCampo["campnomb"] = $elementos[0];
			$resultcampo = dinamicscancampo($iRegCampo,$nuconn);
			$num = fncnumreg($resultcampo);
			if($num>0)
			{
				$sbregcampo = fncfetch($resultcampo,0);
				if($elementos[0] != "defectcodigo")
				{
					if($sbregcampo["campnomb"] == $elementos[0])
					{
						$respuesta = strcmp($sbregcampo["campnotnull"],"t");
						if($respuesta == 0)
						{
							if($elementos[1] == "")
							{
								$campnomb[$elementos[0]] = 1;
								$flageditardefecto = 1;
								$flagerror = 1;
							}
						}
					}
				}
			}		
				
			$validar = buscacaracter($elementos[1]);
			
			if($validar == 1) 
			{ 
				$flageditardefecto = 1; 
				$flagerror = 1; 
				$campnomb[$elementos[0]] = 1;
			}			
			$validresult = consulmetadefecto($elementos[0],$elementos[1],$nuconn);
			
			if ($validresult == 1)
			{
				$flageditardefecto = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;
				unset ($validresult);
			}
		}
		
		if($flagerror == 1)
		{
			fncmsgerror(errorIng);
		}
		
		
		if($flagerror != 1)
		{
			$result = uprecorddefecto($iRegdefecto,$nuconn);
			if($result < 0 )
			{
				ob_end_clean();
				fncmsgerror(errorReg);
				$flageditardefecto=1;
			}
			if($result > 0)
			{
				fncmsgerror(editaEx);
				echo '<script language="javascript">';
				echo '<!--//'."\n";
				echo 'location ="maestabldefecto.php?codigo='.$codigo.';"';
				echo '//-->'."\n";
				echo '</script>';
			}
			fncclose($nuconn);
		}
	}
}

$iRegdefecto["defectcodigo"] = $defectcodigo;
$iRegdefecto["defectnombre"] = $defectnombre;
$iRegdefecto["defectdescri"] = $defectdescri;

if( !$arrcausas ){
	
	$flagerror = 1;
	$campnomb["arrcausas"] = 1;
	$flageditardefecto = 1;

}

editadefecto($iRegdefecto,$flageditardefecto,$campnomb,$codigo);

if(!$flageditardefecto){

	$idcon = fncconn();

	if($arrcausas) $objsarrcausas = explode(",", $arrcausas); else unset($arrcausas);

	if( count( $objsarrcausas ) ){

		delrecorddefectocausa($iRegdefecto["defectcodigo"],$idcon);

		for($a = 0; $a < count($objsarrcausas); $a++){

			$iRegdefectocausa["defectcodigo"] = $iRegdefecto["defectcodigo"];
			$iRegdefectocausa["causacodigo"] = $objsarrcausas[$a];

			insrecorddefectocausa($iRegdefectocausa, $idcon);

		}

	}

	fncclose($idcon);

}
?> 
