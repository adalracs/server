<?php 
include ('../src/FunGen/sesion/fnccantrow.php'); 
include ('../src/FunGen/sesion/fnccantrow1.php'); 
include ('../src/FunPerPriNiv/limitscan.php'); 
include ('../src/FunGen/sesion/fncvalses.php'); 
include ('../src/FunPerPriNiv/pktblsoliciusuario.php'); 
include ('../src/FunGen/sesion/fncalmdat.php'); 
include ('../src/FunGen/sesion/fnccaf.php'); 
$reccomact = fnccaf ( $GLOBALS [usuacodi], $_SERVER ["SCRIPT_FILENAME"] ); 
 
if ($accionborrarsoliciusuario) { 
	include ('borrasoliciusuario.php'); 
} else { 
	if ($accionconsultarsoliciusuario) { 
		$nusw = 0; 
		$nombcamp = strtok ( $columnas, "," ); 
		while ( $nombcamp ) { 
			$nombcamp = trim ( $nombcamp ); 
			$recarreglo [$nombcamp] = $$nombcamp; 
			if ($recarreglo [$nombcamp]) { 
				$nusw = 1; 
			} 
			$nombcamp = strtok ( "," ); 
		} 
		if (! $nusw) { 
			$accionconsultarsoliciusuario = 0; 
		} 
	} 
} 
include ('../src/FunGen/sesion/fncaumdec.php'); 
include ('../src/FunGen/fncpageposition.php'); 
 
$intervalo = fncaumdec ( 'soliciusuario', $inicio, $fin, $mov, $accionconsultarsoliciusuario, $recarreglo ); 
$cantrow = $intervalo [total]; 
if ($intervalo [idtrans]) { 
	$idtrans = $intervalo [idtrans]; 
} 
?> 
<!-- Propiedad intelectual de Adsum SAS (c) 
-Todos los derechos reservados- 
Creado con WAG Adsum 
Autor: Andrés A. Riascos D. 
Fecha: 20120110 
GenVers: 4.8 --> 
<!doctype html> 
<html> 
<head> 
<title>Registros de soliciusuario</title> 
<meta http-equiv="Content-Type" content="text/html; charset=UTF8"> 
<meta http-equiv="expires" content="0"> 
<meta http-equiv="X-UA-Compatible" content="IE=9"> 
<script language=JavaScript src="../src/FunGen/starPage_position.js" type="text/javascript"></script> 
<script language="JavaScript" type="text/javascript" src="../src/FunGen/fncsetcheck.js"></script> 
<script language="javascript" type="text/javascript" src="../src/FunGen/fncremembercheck.js"></script> 
<script language=JavaScript src="../src/FunGen/colorfooter.js" type="text/javascript"></script> 
 
<?php 
include ('../def/jquery.library_maestro.php'); 
?> 
</head> 
<?php 
if (! $codigo) { 
	echo "<!--"; 
} 
?> 
<body bgcolor="FFFFFF" class="NoisePageBODY"> 
<form name="form1" method="post" enctype="multipart/form-data"> 
<p><font class="NoiseFormHeaderFont">Listado de soliciusuario</font></p> 
<table border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content"> 
	<tr> 
		<td class="NoiseErrorDataTD" align="right"> 
	<?php 
	page_position ( $intervalo, 'maestablsoliciusuario.php', $flagcheck ); 
	?></td> 
	</tr> 
	<tr> 
		<td>&nbsp;</td> 
	</tr> 
	<tr> 
		<td align="left" class="NoiseErrorDataTD"><?php 
		include ('../def/jquery.maestablbuttons.php')?></td> 
	</tr> 
	<tr> 
		<td>&nbsp;</td> 
	</tr> 
	<tr> 
		<td><?php 
		include ('../def/jquery.button_navup.php')?></td> 
	</tr> 
	<tr> 
		<td></td> 
	</tr> 
	<tr> 
		<td></td> 
	</tr> 
	<tr> 
		<td> 
		<table width="100%" border="0" align="center" cellspacing="1" 
			cellpadding="1" class="ui-widget-content"> 
			<tr> 
				<td width="5%" class="ui-state-default">Selec.</td> 
				<td width="90%" class="ui-state-default">C&oacute;digo</td> 
				<td width="90%" class="ui-state-default">Nombre</td> 
			</tr> 
				<?php 
				include ('../src/FunGen/sesion/fncvisreg.php'); 
				$reg [0] = 'solusucodigo'; 
				$reg1 [0] = 'n'; 
				$nureturn = fncvisreg ( 'soliciusuario', $reg, $reg1, $idtrans, $arr_borrar, $flagcheck); 
				?> 
		</table> 
		</td> 
	</tr> 
	<tr> 
		<td></td> 
	</tr> 
	<tr> 
		<td></td> 
	</tr> 
	<tr> 
		<td><?php 
		include ('../def/jquery.button_navdown.php')?></td> 
	</tr> 
	<tr> 
		<td>&nbsp;</td> 
	</tr> 
	<tr> 
		<td class="NoiseErrorDataTD" align="right"> <?php 
		page_position ( $intervalo, 'maestablsoliciusuario.php', $flagcheck ); 
		?></td> 
	</tr> 
</table> 
<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
<input type="hidden" name="inicio" value="<?php echo $intervalo [inicio];	?>"> 
<input type="hidden" name="fin"	value="<?php echo $intervalo [fin];	?>"> 
<input type="hidden" name="sourcetable" value="soliciusuario"> 
<input type="hidden" name="selstar" id="selstar" value="0"> 
<input type="hidden" name="nombtabl" value="soliciusuario"> 
<input type="hidden" name="columnas" value="tisouscodigo, solusucodigo, clausucodigo, solusufecha, solusuperaca, solusumatmer, solusumatfec, solusudircom, 
solusutelcom, solusufaxcom, solusunacexp, solusuprisuc, solusulocprop, solusuareloc, solusuarrend, solusutelarr, solusuantneg, solusuacteco, solusuactcod, 
solusutipinm, solusumatinm, solusudirecc, solusuvalcom, solusutipinm1, solusumatinm1, solusudirecc1, solusuvalcom1, solusuvehicu, solusuvehmod, solusuvehpla, 
solusuprefav, solusuvevaco, solusuvehicu1, solusuvehmod1, solusuvehpla1, solusuprefav1, solusuvevaco1, solusunomrec, solusucuprec, solusutelrec, solusudirrec, 
solusuciurec, solusunomrec1, solusucuprec1, solusutelrec1, solusudirrec1, solusuciurec1, solusunomrec2, solusucuprec2, solusutelrec2, solusudirrec2, 
solusuciurec2, solusubanco, solusutipcue, solusunumcue, solususucurs, solusutelefo, solusuciudad, solusubanco1, solusutipcue1, solusunumcue1, solususucurs1, 
solusutelefo1, solusuciudad1, solusubanco2, solusutipcue2, solusunumcue2, solususucurs2, solusutelefo2, solusuciudad2, solusunomrfa, solusuparrfa, 
solusutelrfa, solusudirrfa, solusuciurfa, solusunomrfa1, solusuparrfa1, solusutelrfa1, solusudirrfa1, solusuciurfa1, solusunomrfa2, solusuparrfa2, 
solusutelrfa2, solusudirrfa2, solusuciurfa2, solusucupsol, solusuplasol, solusucontac, solusuobserv, solusucupsug, solusucupaut, solusuplacon, solusuobserv1, 
solusuprecli"> 
<input type="hidden" name="tisouscodigo" value="<?php if ($accionconsultarsoliciusuario) { echo $tisouscodigo; } ?>"> 
<input type="hidden" name="solusucodigo" value="<?php if ($accionconsultarsoliciusuario) { echo $solusucodigo; } ?>"> 
<input type="hidden" name="clausucodigo" value="<?php if ($accionconsultarsoliciusuario) { echo $clausucodigo; } ?>"> 
<input type="hidden" name="solusufecha" value="<?php if ($accionconsultarsoliciusuario) { echo $solusufecha; } ?>"> 
<input type="hidden" name="solusuperaca" value="<?php if ($accionconsultarsoliciusuario) { echo $solusuperaca; } ?>"> 
<input type="hidden" name="solusumatmer" value="<?php if ($accionconsultarsoliciusuario) { echo $solusumatmer; } ?>"> 
<input type="hidden" name="solusumatfec" value="<?php if ($accionconsultarsoliciusuario) { echo $solusumatfec; } ?>"> 
<input type="hidden" name="solusudircom" value="<?php if ($accionconsultarsoliciusuario) { echo $solusudircom; } ?>"> 
<input type="hidden" name="solusutelcom" value="<?php if ($accionconsultarsoliciusuario) { echo $solusutelcom; } ?>"> 
<input type="hidden" name="solusufaxcom" value="<?php if ($accionconsultarsoliciusuario) { echo $solusufaxcom; } ?>"> 
<input type="hidden" name="solusunacexp" value="<?php if ($accionconsultarsoliciusuario) { echo $solusunacexp; } ?>"> 
<input type="hidden" name="solusuprisuc" value="<?php if ($accionconsultarsoliciusuario) { echo $solusuprisuc; } ?>"> 
<input type="hidden" name="solusulocprop" value="<?php if ($accionconsultarsoliciusuario) { echo $solusulocprop; } ?>"> 
<input type="hidden" name="solusuareloc" value="<?php if ($accionconsultarsoliciusuario) { echo $solusuareloc; } ?>"> 
<input type="hidden" name="solusuarrend" value="<?php if ($accionconsultarsoliciusuario) { echo $solusuarrend; } ?>"> 
<input type="hidden" name="solusutelarr" value="<?php if ($accionconsultarsoliciusuario) { echo $solusutelarr; } ?>"> 
<input type="hidden" name="solusuantneg" value="<?php if ($accionconsultarsoliciusuario) { echo $solusuantneg; } ?>"> 
<input type="hidden" name="solusuacteco" value="<?php if ($accionconsultarsoliciusuario) { echo $solusuacteco; } ?>"> 
<input type="hidden" name="solusuactcod" value="<?php if ($accionconsultarsoliciusuario) { echo $solusuactcod; } ?>"> 
<input type="hidden" name="solusutipinm" value="<?php if ($accionconsultarsoliciusuario) { echo $solusutipinm; } ?>"> 
<input type="hidden" name="solusumatinm" value="<?php if ($accionconsultarsoliciusuario) { echo $solusumatinm; } ?>"> 
<input type="hidden" name="solusudirecc" value="<?php if ($accionconsultarsoliciusuario) { echo $solusudirecc; } ?>"> 
<input type="hidden" name="solusuvalcom" value="<?php if ($accionconsultarsoliciusuario) { echo $solusuvalcom; } ?>"> 
<input type="hidden" name="solusutipinm1" value="<?php if ($accionconsultarsoliciusuario) { echo $solusutipinm1; } ?>"> 
<input type="hidden" name="solusumatinm1" value="<?php if ($accionconsultarsoliciusuario) { echo $solusumatinm1; } ?>"> 
<input type="hidden" name="solusudirecc1" value="<?php if ($accionconsultarsoliciusuario) { echo $solusudirecc1; } ?>"> 
<input type="hidden" name="solusuvalcom1" value="<?php if ($accionconsultarsoliciusuario) { echo $solusuvalcom1; } ?>"> 
<input type="hidden" name="solusuvehicu" value="<?php if ($accionconsultarsoliciusuario) { echo $solusuvehicu; } ?>"> 
<input type="hidden" name="solusuvehmod" value="<?php if ($accionconsultarsoliciusuario) { echo $solusuvehmod; } ?>"> 
<input type="hidden" name="solusuvehpla" value="<?php if ($accionconsultarsoliciusuario) { echo $solusuvehpla; } ?>"> 
<input type="hidden" name="solusuprefav" value="<?php if ($accionconsultarsoliciusuario) { echo $solusuprefav; } ?>"> 
<input type="hidden" name="solusuvevaco" value="<?php if ($accionconsultarsoliciusuario) { echo $solusuvevaco; } ?>"> 
<input type="hidden" name="solusuvehicu1" value="<?php if ($accionconsultarsoliciusuario) { echo $solusuvehicu1; } ?>"> 
<input type="hidden" name="solusuvehmod1" value="<?php if ($accionconsultarsoliciusuario) { echo $solusuvehmod1; } ?>"> 
<input type="hidden" name="solusuvehpla1" value="<?php if ($accionconsultarsoliciusuario) { echo $solusuvehpla1; } ?>"> 
<input type="hidden" name="solusuprefav1" value="<?php if ($accionconsultarsoliciusuario) { echo $solusuprefav1; } ?>"> 
<input type="hidden" name="solusuvevaco1" value="<?php if ($accionconsultarsoliciusuario) { echo $solusuvevaco1; } ?>"> 
<input type="hidden" name="solusunomrec" value="<?php if ($accionconsultarsoliciusuario) { echo $solusunomrec; } ?>"> 
<input type="hidden" name="solusucuprec" value="<?php if ($accionconsultarsoliciusuario) { echo $solusucuprec; } ?>"> 
<input type="hidden" name="solusutelrec" value="<?php if ($accionconsultarsoliciusuario) { echo $solusutelrec; } ?>"> 
<input type="hidden" name="solusudirrec" value="<?php if ($accionconsultarsoliciusuario) { echo $solusudirrec; } ?>"> 
<input type="hidden" name="solusuciurec" value="<?php if ($accionconsultarsoliciusuario) { echo $solusuciurec; } ?>"> 
<input type="hidden" name="solusunomrec1" value="<?php if ($accionconsultarsoliciusuario) { echo $solusunomrec1; } ?>"> 
<input type="hidden" name="solusucuprec1" value="<?php if ($accionconsultarsoliciusuario) { echo $solusucuprec1; } ?>"> 
<input type="hidden" name="solusutelrec1" value="<?php if ($accionconsultarsoliciusuario) { echo $solusutelrec1; } ?>"> 
<input type="hidden" name="solusudirrec1" value="<?php if ($accionconsultarsoliciusuario) { echo $solusudirrec1; } ?>"> 
<input type="hidden" name="solusuciurec1" value="<?php if ($accionconsultarsoliciusuario) { echo $solusuciurec1; } ?>"> 
<input type="hidden" name="solusunomrec2" value="<?php if ($accionconsultarsoliciusuario) { echo $solusunomrec2; } ?>"> 
<input type="hidden" name="solusucuprec2" value="<?php if ($accionconsultarsoliciusuario) { echo $solusucuprec2; } ?>"> 
<input type="hidden" name="solusutelrec2" value="<?php if ($accionconsultarsoliciusuario) { echo $solusutelrec2; } ?>"> 
<input type="hidden" name="solusudirrec2" value="<?php if ($accionconsultarsoliciusuario) { echo $solusudirrec2; } ?>"> 
<input type="hidden" name="solusuciurec2" value="<?php if ($accionconsultarsoliciusuario) { echo $solusuciurec2; } ?>"> 
<input type="hidden" name="solusubanco" value="<?php if ($accionconsultarsoliciusuario) { echo $solusubanco; } ?>"> 
<input type="hidden" name="solusutipcue" value="<?php if ($accionconsultarsoliciusuario) { echo $solusutipcue; } ?>"> 
<input type="hidden" name="solusunumcue" value="<?php if ($accionconsultarsoliciusuario) { echo $solusunumcue; } ?>"> 
<input type="hidden" name="solususucurs" value="<?php if ($accionconsultarsoliciusuario) { echo $solususucurs; } ?>"> 
<input type="hidden" name="solusutelefo" value="<?php if ($accionconsultarsoliciusuario) { echo $solusutelefo; } ?>"> 
<input type="hidden" name="solusuciudad" value="<?php if ($accionconsultarsoliciusuario) { echo $solusuciudad; } ?>"> 
<input type="hidden" name="solusubanco1" value="<?php if ($accionconsultarsoliciusuario) { echo $solusubanco1; } ?>"> 
<input type="hidden" name="solusutipcue1" value="<?php if ($accionconsultarsoliciusuario) { echo $solusutipcue1; } ?>"> 
<input type="hidden" name="solusunumcue1" value="<?php if ($accionconsultarsoliciusuario) { echo $solusunumcue1; } ?>"> 
<input type="hidden" name="solususucurs1" value="<?php if ($accionconsultarsoliciusuario) { echo $solususucurs1; } ?>"> 
<input type="hidden" name="solusutelefo1" value="<?php if ($accionconsultarsoliciusuario) { echo $solusutelefo1; } ?>"> 
<input type="hidden" name="solusuciudad1" value="<?php if ($accionconsultarsoliciusuario) { echo $solusuciudad1; } ?>"> 
<input type="hidden" name="solusubanco2" value="<?php if ($accionconsultarsoliciusuario) { echo $solusubanco2; } ?>"> 
<input type="hidden" name="solusutipcue2" value="<?php if ($accionconsultarsoliciusuario) { echo $solusutipcue2; } ?>"> 
<input type="hidden" name="solusunumcue2" value="<?php if ($accionconsultarsoliciusuario) { echo $solusunumcue2; } ?>"> 
<input type="hidden" name="solususucurs2" value="<?php if ($accionconsultarsoliciusuario) { echo $solususucurs2; } ?>"> 
<input type="hidden" name="solusutelefo2" value="<?php if ($accionconsultarsoliciusuario) { echo $solusutelefo2; } ?>"> 
<input type="hidden" name="solusuciudad2" value="<?php if ($accionconsultarsoliciusuario) { echo $solusuciudad2; } ?>"> 
<input type="hidden" name="solusunomrfa" value="<?php if ($accionconsultarsoliciusuario) { echo $solusunomrfa; } ?>"> 
<input type="hidden" name="solusuparrfa" value="<?php if ($accionconsultarsoliciusuario) { echo $solusuparrfa; } ?>"> 
<input type="hidden" name="solusutelrfa" value="<?php if ($accionconsultarsoliciusuario) { echo $solusutelrfa; } ?>"> 
<input type="hidden" name="solusudirrfa" value="<?php if ($accionconsultarsoliciusuario) { echo $solusudirrfa; } ?>"> 
<input type="hidden" name="solusuciurfa" value="<?php if ($accionconsultarsoliciusuario) { echo $solusuciurfa; } ?>"> 
<input type="hidden" name="solusunomrfa1" value="<?php if ($accionconsultarsoliciusuario) { echo $solusunomrfa1; } ?>"> 
<input type="hidden" name="solusuparrfa1" value="<?php if ($accionconsultarsoliciusuario) { echo $solusuparrfa1; } ?>"> 
<input type="hidden" name="solusutelrfa1" value="<?php if ($accionconsultarsoliciusuario) { echo $solusutelrfa1; } ?>"> 
<input type="hidden" name="solusudirrfa1" value="<?php if ($accionconsultarsoliciusuario) { echo $solusudirrfa1; } ?>"> 
<input type="hidden" name="solusuciurfa1" value="<?php if ($accionconsultarsoliciusuario) { echo $solusuciurfa1; } ?>"> 
<input type="hidden" name="solusunomrfa2" value="<?php if ($accionconsultarsoliciusuario) { echo $solusunomrfa2; } ?>"> 
<input type="hidden" name="solusuparrfa2" value="<?php if ($accionconsultarsoliciusuario) { echo $solusuparrfa2; } ?>"> 
<input type="hidden" name="solusutelrfa2" value="<?php if ($accionconsultarsoliciusuario) { echo $solusutelrfa2; } ?>"> 
<input type="hidden" name="solusudirrfa2" value="<?php if ($accionconsultarsoliciusuario) { echo $solusudirrfa2; } ?>"> 
<input type="hidden" name="solusuciurfa2" value="<?php if ($accionconsultarsoliciusuario) { echo $solusuciurfa2; } ?>"> 
<input type="hidden" name="solusucupsol" value="<?php if ($accionconsultarsoliciusuario) { echo $solusucupsol; } ?>"> 
<input type="hidden" name="solusuplasol" value="<?php if ($accionconsultarsoliciusuario) { echo $solusuplasol; } ?>"> 
<input type="hidden" name="solusucontac" value="<?php if ($accionconsultarsoliciusuario) { echo $solusucontac; } ?>"> 
<input type="hidden" name="solusuobserv" value="<?php if ($accionconsultarsoliciusuario) { echo $solusuobserv; } ?>"> 
<input type="hidden" name="solusucupsug" value="<?php if ($accionconsultarsoliciusuario) { echo $solusucupsug; } ?>"> 
<input type="hidden" name="solusucupaut" value="<?php if ($accionconsultarsoliciusuario) { echo $solusucupaut; } ?>"> 
<input type="hidden" name="solusuplacon" value="<?php if ($accionconsultarsoliciusuario) { echo $solusuplacon; } ?>"> 
<input type="hidden" name="solusuobserv1" value="<?php if ($accionconsultarsoliciusuario) { echo $solusuobserv1; } ?>"> 
<input type="hidden" name="solusuprecli" value="<?php if ($accionconsultarsoliciusuario) { echo $solusuprecli; } ?>"> 
<input type="hidden" name="accionconsultarsoliciusuario"	value="<?php echo $accionconsultarsoliciusuario; ?>"> 
<input type="hidden" name="mov"><!-- Permite el cambio de checkbox/radiobuttion --> 
<input type="hidden" name="flagcheck" value="<?php echo $flagcheck; ?>"><!-- Campos a visualizar en maestablborrgen	--> 
<input type="hidden" name="selcampos" value="tisouscodigo, solusucodigo, clausucodigo, solusufecha, solusuperaca, solusumatmer, solusumatfec, solusudircom, 
solusutelcom, solusufaxcom, solusunacexp, solusuprisuc, solusulocprop, solusuareloc, solusuarrend, solusutelarr, solusuantneg, solusuacteco, solusuactcod, 
solusutipinm, solusumatinm, solusudirecc, solusuvalcom, solusutipinm1, solusumatinm1, solusudirecc1, solusuvalcom1, solusuvehicu, solusuvehmod, solusuvehpla, 
solusuprefav, solusuvevaco, solusuvehicu1, solusuvehmod1, solusuvehpla1, solusuprefav1, solusuvevaco1, solusunomrec, solusucuprec, solusutelrec, solusudirrec, 
solusuciurec, solusunomrec1, solusucuprec1, solusutelrec1, solusudirrec1, solusuciurec1, solusunomrec2, solusucuprec2, solusutelrec2, solusudirrec2, 
solusuciurec2, solusubanco, solusutipcue, solusunumcue, solususucurs, solusutelefo, solusuciudad, solusubanco1, solusutipcue1, solusunumcue1, solususucurs1, 
solusutelefo1, solusuciudad1, solusubanco2, solusutipcue2, solusunumcue2, solususucurs2, solusutelefo2, solusuciudad2, solusunomrfa, solusuparrfa, 
solusutelrfa, solusudirrfa, solusuciurfa, solusunomrfa1, solusuparrfa1, solusutelrfa1, solusudirrfa1, solusuciurfa1, solusunomrfa2, solusuparrfa2, 
solusutelrfa2, solusudirrfa2, solusuciurfa2, solusucupsol, solusuplasol, solusucontac, solusuobserv, solusucupsug, solusucupaut, solusuplacon, solusuobserv1, 
solusuprecli"><!--					--> 
<input type="hidden" name="arr_borrar" value="<?php echo $arr_borrar; ?>"> 
<input type="hidden" name="arreglo_b"> <!--						--></form> 
<div id="msgwindow" title="Adsum Kallpa"><span id="msg"></span></div> 
</body> 
<?php 
if (! $codigo) { 
	echo " -->"; 
} 
?> 
</html> 
