<?php 
include ('../src/FunPerPriNiv/pktblsoliciusuario.php'); 
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
Funcion         : editasoliciusuario 
Decripcion      : Valida la data a editar y la lleva al paquete. 
Parametros      : Descripicion 
	$iRegsoliciusuario			Matriz de datos. 
	$flageditarsoliciusuario	Bandera 
	$campnomb			Campo a editar 
	$codigo				Codigo 
Retorno         : 
	true	= 1 
	false	= 0 
Historial de modificaciones: 
| Fecha | Motivo				| Autor 	| 
*/ 
  
function editasoliciusuario($iRegsoliciusuario, &$flageditarsoliciusuario, &$campnomb, &$codigo) { 
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
	if ($iRegsoliciusuario) { 
		$iRegtabla ["tablnomb"] = "soliciusuario"; 
		$resulttabla = dinamicscantabla ( $iRegtabla, $nuconn ); 
		$num = fncnumreg ( $resulttabla ); 
 
		for($i = 0; $i < $num; $i ++) { 
			$sbregtabla = fncfetch ( $resulttabla, $i ); 
 
			if ($sbregtabla [tablnomb] == "soliciusuario") { 
				$tablcodi = $sbregtabla ['tablcodi']; 
				break; 
			} 
		} 
		$iRegCampo ["tablcodi"] = $tablcodi; 
		$resultcampo = dinamicscancampo ( $iRegCampo, $nuconn ); 
		$num = fncnumreg ( $resultcampo ); 
 
		while ( $elementos = each ( $iRegsoliciusuario ) ) { 
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
								$flageditarsoliciusuario = 1; 
								$flagerror = 1; 
							} 
						} 
					} 
				} 
			} 
 
			$validar = buscacaracter ( $elementos [1] ); 
			if ($validar == 1) { 
				$flageditarsoliciusuario = 1; 
				$flagerror = 1; 
				$campnomb [$elementos[0]] = 1; 
			} 
			$validresult = consulmetasoliciusuario($elementos[0],$elementos[1],$nuconn); 
			if ($validresult == 1) 
			{ 
				$flageditarsoliciusuario = 1; 
				$flagerror = 1; 
				$campnomb = $elementos[0]; 
				unset ($validresult); 
				break; 
			} 
		} 
		if($flagerror != 1) 
		{ 
			$result = uprecordsoliciusuario($iRegsoliciusuario,$nuconn); 
			if($result < 0 ) 
			{ 
				ob_end_clean(); 
				fncmsgerror(errorReg); 
				$flageditarsoliciusuario=1; 
			} 
			if($result > 0) 
			{ 
				fncmsgerror(editaEx); 
				echo '<script language="javascript">'; 
				echo '<!--//'."\n"; 
				echo 'location ="maestablsoliciusuario.php?codigo='.$codigo.';"'; 
				echo '//-->'."\n"; 
				echo '</script>'; 
			} 
			fncclose($nuconn); 
		} 
	} 
} 
$iRegsoliciusuario[tisouscodigo] = $tisouscodigo; 
$iRegsoliciusuario[solusucodigo] = $solusucodigo; 
$iRegsoliciusuario[clausucodigo] = $clausucodigo; 
$iRegsoliciusuario[solusufecha] = $solusufecha; 
$iRegsoliciusuario[solusuperaca] = $solusuperaca; 
$iRegsoliciusuario[solusumatmer] = $solusumatmer; 
$iRegsoliciusuario[solusumatfec] = $solusumatfec; 
$iRegsoliciusuario[solusudircom] = $solusudircom; 
$iRegsoliciusuario[solusutelcom] = $solusutelcom; 
$iRegsoliciusuario[solusufaxcom] = $solusufaxcom; 
$iRegsoliciusuario[solusunacexp] = $solusunacexp; 
$iRegsoliciusuario[solusuprisuc] = $solusuprisuc; 
$iRegsoliciusuario[solusulocprop] = $solusulocprop; 
$iRegsoliciusuario[solusuareloc] = $solusuareloc; 
$iRegsoliciusuario[solusuarrend] = $solusuarrend; 
$iRegsoliciusuario[solusutelarr] = $solusutelarr; 
$iRegsoliciusuario[solusuantneg] = $solusuantneg; 
$iRegsoliciusuario[solusuacteco] = $solusuacteco; 
$iRegsoliciusuario[solusuactcod] = $solusuactcod; 
$iRegsoliciusuario[solusutipinm] = $solusutipinm; 
$iRegsoliciusuario[solusumatinm] = $solusumatinm; 
$iRegsoliciusuario[solusudirecc] = $solusudirecc; 
$iRegsoliciusuario[solusuvalcom] = $solusuvalcom; 
$iRegsoliciusuario[solusutipinm1] = $solusutipinm1; 
$iRegsoliciusuario[solusumatinm1] = $solusumatinm1; 
$iRegsoliciusuario[solusudirecc1] = $solusudirecc1; 
$iRegsoliciusuario[solusuvalcom1] = $solusuvalcom1; 
$iRegsoliciusuario[solusuvehicu] = $solusuvehicu; 
$iRegsoliciusuario[solusuvehmod] = $solusuvehmod; 
$iRegsoliciusuario[solusuvehpla] = $solusuvehpla; 
$iRegsoliciusuario[solusuprefav] = $solusuprefav; 
$iRegsoliciusuario[solusuvevaco] = $solusuvevaco; 
$iRegsoliciusuario[solusuvehicu1] = $solusuvehicu1; 
$iRegsoliciusuario[solusuvehmod1] = $solusuvehmod1; 
$iRegsoliciusuario[solusuvehpla1] = $solusuvehpla1; 
$iRegsoliciusuario[solusuprefav1] = $solusuprefav1; 
$iRegsoliciusuario[solusuvevaco1] = $solusuvevaco1; 
$iRegsoliciusuario[solusunomrec] = $solusunomrec; 
$iRegsoliciusuario[solusucuprec] = $solusucuprec; 
$iRegsoliciusuario[solusutelrec] = $solusutelrec; 
$iRegsoliciusuario[solusudirrec] = $solusudirrec; 
$iRegsoliciusuario[solusuciurec] = $solusuciurec; 
$iRegsoliciusuario[solusunomrec1] = $solusunomrec1; 
$iRegsoliciusuario[solusucuprec1] = $solusucuprec1; 
$iRegsoliciusuario[solusutelrec1] = $solusutelrec1; 
$iRegsoliciusuario[solusudirrec1] = $solusudirrec1; 
$iRegsoliciusuario[solusuciurec1] = $solusuciurec1; 
$iRegsoliciusuario[solusunomrec2] = $solusunomrec2; 
$iRegsoliciusuario[solusucuprec2] = $solusucuprec2; 
$iRegsoliciusuario[solusutelrec2] = $solusutelrec2; 
$iRegsoliciusuario[solusudirrec2] = $solusudirrec2; 
$iRegsoliciusuario[solusuciurec2] = $solusuciurec2; 
$iRegsoliciusuario[solusubanco] = $solusubanco; 
$iRegsoliciusuario[solusutipcue] = $solusutipcue; 
$iRegsoliciusuario[solusunumcue] = $solusunumcue; 
$iRegsoliciusuario[solususucurs] = $solususucurs; 
$iRegsoliciusuario[solusutelefo] = $solusutelefo; 
$iRegsoliciusuario[solusuciudad] = $solusuciudad; 
$iRegsoliciusuario[solusubanco1] = $solusubanco1; 
$iRegsoliciusuario[solusutipcue1] = $solusutipcue1; 
$iRegsoliciusuario[solusunumcue1] = $solusunumcue1; 
$iRegsoliciusuario[solususucurs1] = $solususucurs1; 
$iRegsoliciusuario[solusutelefo1] = $solusutelefo1; 
$iRegsoliciusuario[solusuciudad1] = $solusuciudad1; 
$iRegsoliciusuario[solusubanco2] = $solusubanco2; 
$iRegsoliciusuario[solusutipcue2] = $solusutipcue2; 
$iRegsoliciusuario[solusunumcue2] = $solusunumcue2; 
$iRegsoliciusuario[solususucurs2] = $solususucurs2; 
$iRegsoliciusuario[solusutelefo2] = $solusutelefo2; 
$iRegsoliciusuario[solusuciudad2] = $solusuciudad2; 
$iRegsoliciusuario[solusunomrfa] = $solusunomrfa; 
$iRegsoliciusuario[solusuparrfa] = $solusuparrfa; 
$iRegsoliciusuario[solusutelrfa] = $solusutelrfa; 
$iRegsoliciusuario[solusudirrfa] = $solusudirrfa; 
$iRegsoliciusuario[solusuciurfa] = $solusuciurfa; 
$iRegsoliciusuario[solusunomrfa1] = $solusunomrfa1; 
$iRegsoliciusuario[solusuparrfa1] = $solusuparrfa1; 
$iRegsoliciusuario[solusutelrfa1] = $solusutelrfa1; 
$iRegsoliciusuario[solusudirrfa1] = $solusudirrfa1; 
$iRegsoliciusuario[solusuciurfa1] = $solusuciurfa1; 
$iRegsoliciusuario[solusunomrfa2] = $solusunomrfa2; 
$iRegsoliciusuario[solusuparrfa2] = $solusuparrfa2; 
$iRegsoliciusuario[solusutelrfa2] = $solusutelrfa2; 
$iRegsoliciusuario[solusudirrfa2] = $solusudirrfa2; 
$iRegsoliciusuario[solusuciurfa2] = $solusuciurfa2; 
$iRegsoliciusuario[solusucupsol] = $solusucupsol; 
$iRegsoliciusuario[solusuplasol] = $solusuplasol; 
$iRegsoliciusuario[solusucontac] = $solusucontac; 
$iRegsoliciusuario[solusuobserv] = $solusuobserv; 
$iRegsoliciusuario[solusucupsug] = $solusucupsug; 
$iRegsoliciusuario[solusucupaut] = $solusucupaut; 
$iRegsoliciusuario[solusuplacon] = $solusuplacon; 
$iRegsoliciusuario[solusuobserv1] = $solusuobserv1; 
$iRegsoliciusuario[solusuprecli] = $solusuprecli; 
editasoliciusuario($iRegsoliciusuario,$flageditarsoliciusuario,$campnomb,$codigo); 
?> 
