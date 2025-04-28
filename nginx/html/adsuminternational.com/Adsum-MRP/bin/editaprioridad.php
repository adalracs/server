<?php 
include ( '../src/FunPerPriNiv/pktblprioridad.php'); 
include ( '../def/tipocampo.php'); 
include ( '../src/FunGen/buscacaracter.php'); 
include ( '../src/FunGen/fncmsgerror.php'); 
function 
editaprioridad($iRegprioridad,&$flageditarprioridad,&$campnomb,&$codigo) 
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
	if ($iRegprioridad) 
	{ 
		while($elementos = each($iRegprioridad)) 
		{ 
			$validar = buscacaracter($elementos[1]); 
			if($validar == 1) 
			{ 
				fncmsgerror(errorCar); 
				$flageditarprioridad = 1; 
				$flagerror = 1; 
				$campnomb = $elementos[0]; 
				break; 
			} 
			$validresult = consulmetaprioridad($elementos[0],$elementos[1],$nuconn); 
			if ($validresult == 1) 
			{ 
				$flageditarprioridad = 1; 
				$flagerror = 1; 
				$campnomb = $elementos[0]; 
				unset ($validresult); 
				break; 
			} 
		} 
		if($flagerror != 1) 
		{ 
			$result = uprecordprioridad($iRegprioridad,$nuconn); 
			if($result < 0 ) 
			{ 
				ob_end_clean(); 
				fncmsgerror(errorReg); 
				$flageditarprioridad=1; 
			} 
			if($result > 0) 
			{ 
				fncmsgerror(editaEx); 
				echo '<script language="javascript">'; 
				echo '<!--//'."\n"; 
				echo 'location ="maestablprioridad.php?codigo='.$codigo.';"'; 
				echo '//-->'."\n"; 
				echo '</script>'; 
			} 
			fncclose($nuconn); 
		} 
	} 
} 
$iRegprioridad[prioricodigo] = $prioricodigo; 
$iRegprioridad[priorinombre] = $priorinombre; 
$iRegprioridad[prioridescri] = $prioridescri; 
editaprioridad($iRegprioridad,$flageditarprioridad,$campnomb,$codigo); 
?> 
