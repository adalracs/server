<?php 
include ('../src/FunPerPriNiv/pktbltiposoliusua.php'); 
include ('../def/tipocampo.php'); 
include ('../src/FunGen/buscacaracter.php'); 
include ('../src/FunGen/fncmsgerror.php'); 
include ('../src/FunPerPriNiv/pktblcampo.php'); 
include ('../src/FunPerPriNiv/pktbltabla.php'); 
include ('../src/FunGen/fncnombeditexs.php'); 
/* 
<!-- Propiedad intelectual de Adsum SAS (c) 
-Todos los derechos reservados- 
Creado con WAG Adsum 
Autor: Andrés A. Riascos D. 
Fecha: 20120110 
GenVers: 4.8 --> 
Funcion         : editatiposoliusua 
Decripcion      : Valida la data a editar y la lleva al paquete. 
Parametros      : Descripicion 
	$iRegtiposoliusua			Matriz de datos. 
	$flageditartiposoliusua	Bandera 
	$campnomb			Campo a editar 
	$codigo				Codigo 
Retorno         : 
	true	= 1 
	false	= 0 
Historial de modificaciones: 
| Fecha | Motivo				| Autor 	| 
*/ 
  
function editatiposoliusua($iRegtiposoliusua, &$flageditartiposoliusua, &$campnomb, &$codigo) { 
	$nuconn = fncconn (); 
	define ( "errorReg", 1 ); 
	define ( "errorCar", 2 ); 
	define ( "grabaEx", 3 ); 
	define ( "compinst", 4 ); 
	define ( "venccomp", 5 ); 
	define ( "compactu", 6 ); 
	define ( "fecvalid", 7 ); 
	define ( "errormail", 8 ); 
	define ( "editaEx", 9 ); 
	define ( "errorNombExs", 18 ); 
	define ( "errorIng", 35 ); 
	if ($iRegtiposoliusua) { 
		$iRegtabla ["tablnomb"] = "tiposoliusua"; 
		$resulttabla = dinamicscantabla ( $iRegtabla, $nuconn ); 
		$num = fncnumreg ( $resulttabla ); 
 
		for($i = 0; $i < $num; $i ++) { 
			$sbregtabla = fncfetch ( $resulttabla, $i ); 
 
			if ($sbregtabla [tablnomb] == "tiposoliusua") { 
				$tablcodi = $sbregtabla ['tablcodi']; 
				break; 
			} 
		} 
		$iRegCampo ["tablcodi"] = $tablcodi; 
		$resultcampo = dinamicscancampo ( $iRegCampo, $nuconn ); 
		$num = fncnumreg ( $resultcampo ); 
 
		while ( $elementos = each ( $iRegtiposoliusua ) ) { 
			$iRegCampo ["campnomb"] = $elementos [0]; 
			$resultcampo = dinamicscancampo ( $iRegCampo, $nuconn ); 
			$num = fncnumreg ( $resultcampo ); 
 
			if ($num > 0) { 
				$sbregcampo = fncfetch ( $resultcampo, 0 ); 
 
				if ($elementos [0] != "tisouscodigo") { 
					if ($sbregcampo ["campnomb"] == $elementos [0]) { 
						$respuesta = strcmp ( $sbregcampo ["campnotnull"], "t" ); 
 
						if ($respuesta == 0) { 
							if ($elementos [1] == "") { 
								$campnomb [$elementos [0]] = 1; 
								$flageditartiposoliusua = 1; 
								$flagerror = 1; 
							} 
						} 
					} 
				} 
			} 
 
			$validar = buscacaracter ( $elementos [1] ); 
			if ($validar == 1) { 
				$flageditartiposoliusua = 1; 
				$flagerror = 1; 
				$campnomb [$elementos[0]] = 1; 
			} 
			$validresult = consulmetatiposoliusua($elementos[0],$elementos[1],$nuconn); 
			if ($validresult == 1) 
			{ 
				$flageditartiposoliusua = 1; 
				$flagerror = 1; 
				$campnomb = $elementos[0]; 
				unset ($validresult); 
				break; 
			} 
		} 
		if($flagerror != 1) 
		{ 
			$result = uprecordtiposoliusua($iRegtiposoliusua,$nuconn); 
			if($result < 0 ) 
			{ 
				ob_end_clean(); 
				fncmsgerror(errorReg); 
				$flageditartiposoliusua=1; 
			} 
			if($result > 0) 
			{ 
				fncmsgerror(editaEx); 
				echo '<script language="javascript">'; 
				echo '<!--//'."\n"; 
				echo 'location ="maestabltiposoliusua.php?codigo='.$codigo.';"'; 
				echo '//-->'."\n"; 
				echo '</script>'; 
			} 
			fncclose($nuconn); 
		} 
	} 
} 
$iRegtiposoliusua[tisouscodigo] = $tisouscodigo; 
$iRegtiposoliusua[tisousnombre] = $tisousnombre; 
$iRegtiposoliusua[tisousdesri] = $tisousdesri; 
editatiposoliusua($iRegtiposoliusua,$flageditartiposoliusua,$campnomb,$codigo); 
?> 
