<?php 
include ( '../src/FunPerPriNiv/pktblpedido.php'); 
include ( '../def/tipocampo.php'); 
include ( '../src/FunGen/buscacaracter.php'); 
include ( '../src/FunGen/fncmsgerror.php'); 
function editapedido($iRegpedido,&$flageditarpedido,&$campnomb,&$codigo) 
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
	if ($iRegpedido) 
	{ 
		while($elementos = each($iRegpedido)) 
		{ 
			$validar = buscacaracter($elementos[1]); 
			if($validar == 1) 
			{ 
				fncmsgerror(errorCar); 
				$flageditarpedido = 1; 
				$flagerror = 1; 
				$campnomb = $elementos[0]; 
				break; 
			} 
			$validresult = consulmetapedido($elementos[0],$elementos[1],$nuconn); 
			if ($validresult == 1) 
			{ 
				$flageditarpedido = 1; 
				$flagerror = 1; 
				$campnomb = $elementos[0]; 
				unset ($validresult); 
				break; 
			} 
		} 
		if($flagerror != 1) 
		{ 
			$result = uprecordpedido($iRegpedido,$nuconn); 
			if($result < 0 ) 
			{ 
				ob_end_clean(); 
				fncmsgerror(errorReg); 
				$flageditarpedido=1; 
			} 
			if($result > 0) 
			{ 
				fncmsgerror(editaEx); 
				echo '<script language="javascript">'; 
				echo '<!--//'."\n"; 
				echo 'location ="maestablpedido.php?codigo='.$codigo.';"'; 
				echo '//-->'."\n"; 
				echo '</script>'; 
			} 
			fncclose($nuconn); 
		} 
	} 
} 
$iRegpedido[pedidocodigo] = $pedidocodigo; 
$iRegpedido[cotizacodigo] = $cotizacodigo; 
$iRegpedido[proveecodigo] = $proveecodigo; 
$iRegpedido[usuacodi] = $usuacodi; 
$iRegpedido[pedidofecgen] = $pedidofecgen; 
$iRegpedido[pedidofecfin] = $pedidofecfin; 
$iRegpedido[pedidofecrec] = $pedidofecrec; 
editapedido($iRegpedido,$flageditarpedido,$campnomb,$codigo); 
?> 
