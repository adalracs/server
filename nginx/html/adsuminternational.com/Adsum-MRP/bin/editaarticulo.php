<?php
include ( '../src/FunPerPriNiv/pktblarticulo.php');
include ( '../def/tipocampo.php');
include ( '../src/FunGen/buscacaracter.php');
include ( '../src/FunGen/fncmsgerror.php');
function editaarticulo($iRegarticulo,&$flageditararticulo,&$campnomb,&$codigo)
{
	$nuconn = fncconn();
	define("id",1);
	define("errorReg",1);
	define("errorCar",2);
	define("grabaEx",3);
	define("compinst",4);
	define("venccomp",5);
	define("errorTipArc",6);
	define("errorTamArc",7);
	define("errorSub",8);
	define("subirEx",9);
	define("errorArcExs",10);
	define("errorArcNoExs",11);
	define("bajarEx",12);
	define("errorRutNull",13);
	define("editaEx",14);
	define("errorNoIva",20);
	if ($iRegarticulo)
	{
		while($elementos = each($iRegarticulo))
		{
			//$validar = buscacaracter($elementos[1]);
			if($validar == 1)
			{
				fncmsgerror(errorCar);
				$flageditararticulo = 1;
				$flagerror = 1;
				$campnomb = $elementos[0];
				break;
			}
//			$validresult = consulmetaarticulo($elementos[0],$elementos[1],$nuconn);
			if ($validresult == 1)
			{
				$flageditararticulo = 1;
				$flagerror = 1;
				$campnomb = $elementos[0];
				unset ($validresult);
				break;
			}
			if ($elementos[0] == "articuiva" and $elementos[1] == null)
			{
				fncmsgerror(errorNoIva);
				$flageditararticulo = 1;
				$flagerror = 1;
				$campnomb = $elementos[0];
				break;
			}
		}
		if($flagerror != 1)
		{
			$result = uprecordarticulo($iRegarticulo,$nuconn);
			if($result < 0 )
			{
				ob_end_clean();
				fncmsgerror(errorReg);
				$flageditararticulo=1;
			}
			if($result > 0)
			{
				fncmsgerror(editaEx);
			}
			fncclose($nuconn);
		}
	}
}
$iRegarticulo[articucodigo] = $articucodigo;
$iRegarticulo[tipartcodigo] = $tipartcodigo;
$iRegarticulo[marcacodigo] = $marcacodigo;
$iRegarticulo[fabriccodigo] = $fabriccodigo;
$iRegarticulo[disponcodigo] = $disponcodigo;
$iRegarticulo[estadocodigo] = $estadocodigo;
$iRegarticulo[platafcodigo] = $platafcodigo;
$iRegarticulo[articutitulo] = $articutitulo;
$iRegarticulo[articumodelo] = $articumodelo;
$iRegarticulo[articurefere] = $articurefere;
$iRegarticulo[articunumman] = $articunumman;
$iRegarticulo[articudescor] = $articudescor;
$iRegarticulo[articudeslar] = $articudeslar;
$iRegarticulo[articuprecio] = $articuprecio;
$iRegarticulo[articupreant] = $articupreant;
$iRegarticulo[articunumtie] = $articunumtie;
$iRegarticulo[articunumfab] = $articunumfab;
$iRegarticulo[articufecent] = $articufecent;
$iRegarticulo[articugarantia] = $articugarantia;
$iRegarticulo[articucosgar] = $articucosgar;
$iRegarticulo[articuacceso] = $articuacceso;
$iRegarticulo[articupadre] = $articupadre;
$iRegarticulo[articufecact] = $articufecact;
$iRegarticulo[articufecdes] = $articufecdes;
if ($articuiva != null)
{
	$foo = explode(".", $articuiva);
	if ($foo[1] == "")
	{
		$foo = explode(",", $articuiva);
		if ($foo[1] == "")
		$articuiva = $articuiva.".0";
		else
		$articuiva = $foo[0].".".$foo[1];
	}
}
$iRegarticulo[articuiva] = $articuiva;
$iRegarticulo[articutax] = $articutax;
$iRegarticulo[articustockmax] = $articustockmax;
$iRegarticulo[articustockmin] = $articustockmin;
editaarticulo($iRegarticulo,$flageditararticulo,$campnomb,$codigo);
?>
