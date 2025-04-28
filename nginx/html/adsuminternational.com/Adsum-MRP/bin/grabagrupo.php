<?php
/*
Propiedad intelectual de Adsum SA (c).
Funcion         : grabagrupotemp
Decripcion      : Graba los datos temporales de los grupos.
Parametros      : Descripicion
   $iregcentturi  Arreglo con la data a grabar.

Retorno         : Descripicion

Autor           : ariascos
Fecha           : 13-Mar-2002
*/

include('../src/FunGen/fncnumact.php');
include('../src/FunGen/fncnumprox.php');
include('../src/FunPerPriNiv/fncbegin.php');
include('../src/FunPerPriNiv/fnclock.php');
include('../src/FunPerPriNiv/fnccommit.php');

function grabagrupo($ireggrupo)
{
	
	define ("n",0);
	define ("n1",1);
	define ("id",40);
	define("e_empty",-3);
	$nuconn = fncconn();
	$nures = fncbegin($nuconn);
	$nures1= fnclock("numerado",$nuconn);
	$nuidtemp = fncnumact(id,$nuconn);
	$idgruptemp = $ireggrupo[grupcodi];
	
	do
	{
		$nuresult = loadrecordgrupo($nuidtemp,$nuconn);
		if($nuresult == e_empty)
		{
			$ireggrupo[grupcodi] = $nuidtemp;
		}
		$nuidtemp ++;
		
	}while ($nuresult != e_empty);
	
	$nuresult1 = fncnumprox(id,$nuidtemp,$nuconn);
	
	$nuresult2 = insrecordgrupo($ireggrupo,$nuconn);
	
	uprecordgrupcomp($idgruptemp,$ireggrupo[grupcodi],$nuconn);
	
	delrecordgrupo($idgruptemp,$nuconn);
	
	$nures2 = fnccommit($nuconn);
	
	if(!$nuresult2)
	{
		echo '<script language="javascript">';
		echo '<!--//'."\n";
		echo 'alert("Error al ingresar el registro")';
		echo '//-->'."\n";
		echo '</script>';
	}
	fncclose($nuconn);
	
}
$ireggrupo[grupcodi] = $idgrupotemp;
$ireggrupo[grupnomb] = $grupnomb;
$ireggrupo[grupedit] = $grupedit;
grabagrupo($ireggrupo);
?>
