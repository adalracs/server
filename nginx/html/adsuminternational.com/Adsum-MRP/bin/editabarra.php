<?php 
include ( '../src/FunPerPriNiv/pktblbarra.php'); 
include ( '../def/tipocampo.php'); 
include ( '../src/FunGen/buscacaracter.php'); 
if(!$file)
{
	include ('../src/FunGen/fncmsgerror.php');
}
function editabarra($iRegbarra,&$flageditarbarra,&$campnomb,&$codigo) 
{ 
	$nuconn = fncconn(); 
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
	if ($iRegbarra) 
	{ 
		while($elementos = each($iRegbarra)) 
		{ 
			//$validar = buscacaracter($elementos[1]); 
			if($validar == 1) 
			{ 
				fncmsgerror(errorCar); 
				$flageditarbarra = 1; 
				$flagerror = 1; 
				$campnomb = $elementos[0]; 
				break; 
			} 
			$validresult = consulmetabarra($elementos[0],$elementos[1],$nuconn); 
			if ($validresult == 1) 
			{ 
				$flageditarbarra = 1; 
				$flagerror = 1; 
				$campnomb = $elementos[0]; 
				unset ($validresult); 
				break; 
			} 
		} 
		if($flagerror != 1) 
		{ 
			$result = uprecordbarra($iRegbarra,$nuconn); 
			if($result < 0 ) 
			{ 
				ob_end_clean(); 
				fncmsgerror(errorReg); 
				$flageditarbarra=1; 
			} 
			if($result > 0) 
			{ 
				fncmsgerror(editaEx); 
				echo '<script language="javascript">'; 
				echo '<!--//'."\n"; 
				echo 'location ="maestablbarra.php?codigo='.$codigo.';"'; 
				echo '//-->'."\n"; 
				echo '</script>'; 
			} 
			fncclose($nuconn); 
		} 
	} 
} 
$iRegbarra[barracodigo] = $barracodigo; 
$iRegbarra[estadocodigo] = $estadocodigo; 
$iRegbarra[tipbarcodigo] = $tipbarcodigo; 
$iRegbarra[barratitulo] = $barratitulo; 
$iRegbarra[barratexto] = $barratexto; 
$iRegbarra[barraorden] = $barraorden; 
$iRegbarra[barraimagen] = $barraimagen; 
if($file)
{
	$inombarc = $HTTP_POST_FILES['file']['name'];
	$irutaarc = "pagina/imagenes/";
	$iRegbarra[barraimagen] = $irutaarc.$inombarc;
}
$iRegbarra[barraconsulta] = $barraconsulta; 
$iRegbarra[barralink] = $barralink; 
$iRegbarra[barrapadre] = $barrapadre; 
$iRegbarra[barradescri] = $barradescri; 
editabarra($iRegbarra,$flageditarbarra,$campnomb,$codigo); 
?>