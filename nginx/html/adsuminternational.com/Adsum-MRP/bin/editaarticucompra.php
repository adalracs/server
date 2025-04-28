<?php 
include ( '../src/FunPerPriNiv/pktblarticucompra.php');
include ( '../def/tipocampo.php');
include ( '../src/FunGen/buscacaracter.php');
include ( '../src/FunGen/fncmsgerror.php');
function editaarticucompra($iRegarticucompra,&$flageditararticucompra,&$campnomb,&$codigo)
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
	define("editaEx",14);
	define("errorNumArt",17);
if ($iRegarticucompra) 
	{ 
		while($elementos = each($iRegarticucompra)) 
		{ 
			$validar = buscacaracter($elementos[1]); 
			if($validar == 1) 
			{ 
				fncmsgerror(errorCar); 
				$flageditararticucompra = 1; 
				$flagerror = 1; 
				$campnomb = $elementos[0]; 
				break; 
			} 
			$validresult = 0;
			if ($validresult == 1) 
			{ 
				$flageditararticucompra = 1; 
				$flagerror = 1; 
				$campnomb = $elementos[0]; 
				unset ($validresult); 
				break; 
			} 
		} 
		if($flagerror != 1) 
		{ 
			$result = uprecordarticucompra($iRegarticucompra,$nuconn); 
			if($result < 0 ) 
			{ 
				ob_end_clean(); 
				fncmsgerror(errorReg); 
				$flageditararticucompra=1; 
			} 
			if($result > 0) 
			{ 
				fncmsgerror(editaEx); 
				echo '<script language="javascript">'; 
				echo '<!--//'."\n"; 
				echo 'location ="maestablarticucompra.php?codigo='.$codigo.';"'; 
				echo '//-->'."\n"; 
				echo '</script>'; 
			} 
			fncclose($nuconn); 
		} 
	} 
} 						
$iRegarticucompra[artcomcodigo] =$artcomcodigo;
$iRegarticucompra[compracodigo] = $compracodigo;
$iRegarticucompra[articucodigo] = $articucodigo;
$iRegarticucompra[artcomcant] = $artcomcant;
$iRegarticucompra[preciototal] = $preciototal;
$iRegarticucompra[costoenviototal] = $costoenviototal;
$iRegarticucompra[garantpreciototal] = $garantpreciototal;
$iRegarticucompra[ivatotal] = $ivatotal;
$iRegarticucompra[estadocompcod] = $estadocompcod;
editaarticucompra($iRegarticucompra,$flageditararticucompra,$campnomb,$codigo);
?> 
