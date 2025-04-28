<?php
/*
Propiedad intelectual de Adsum SA (c).
Funcion         : grabagrupotemp
Decripcion      : Graba los datos temporales de los grupos.
Parametros      : Descripicion
   $iregcentturi  Arreglo con la data a grabar.

Retorno         : Descripicion

Autor           : agomez-freina-creyes
Fecha           : 13-Mar-2002
*/
include('../src/FunGen/fncnumact.php');
include('../src/FunGen/fncnumprox.php');
include('../src/FunPerPriNiv/fncbegin.php');

function grabagrupotemp($ireggrupo)
{
    define ("n",0);
	define ("n1",1);
	define("id",39);
	define("e_empty",-3);
	$nuconn = fncconn();

	$nures = fncbegin($nuconn);

	$nures1= fnclock("numerado",$nuconn);

	$nuidtemp = fncnumact(id,$nuconn);

	do
	{
		$nuresult = loadrecordgrupo($nuidtemp,$nuconn);

        if($nuresult == e_empty)
		{
			$ireggrupo[grupcodi] = $nuidtemp;
		}
		$nuidtemp --;

	}while ($nuresult != e_empty);

   	$nuresult1 = fncnumprox(id,$nuidtemp,$nuconn);
	$nuresult2 = insrecordgrupo($ireggrupo,$nuconn);

    $nures2 = fnccommit($nuconn);
    
	fncclose($nuconn);

return $ireggrupo[grupcodi];
}

?>
