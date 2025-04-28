<?php 
include ('../src/FunGen/sesion/fncvalses.php'); 
if (! $flagborrarsoliciusuario) { 
	include ('../src/FunGen/sesion/fnccarga.php'); 
	$sbreg = fnccarga ( $nombtabl, $radiobutton ); 
	if (! $sbreg) { 
		include ('../src/FunGen/fnccontfron.php'); 
	} 
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
<title>Borrar registro de soliciusuario</title> 
<meta http-equiv="Content-Type" content="text/html; charset=UTF8"> 
<meta http-equiv="expires" content="0"> 
<meta http-equiv="X-UA-Compatible" content="IE=9"> 
<?php 
include ('../def/jquery.library_maestro.php'); 
?> 
</head> 
<?php 
if (! $codigo) { 
    echo "<!--"; 
} 
?> 
<body bgcolor="FFFFFF" text="#000000"> 
<form name="form1" method="post" enctype="multipart/form-data"> 
<p><font class="NoiseFormHeaderFont">soliciusuario</font></p> 
<table border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content" width="80%"> 
	<tr> 
		<td class="NoiseErrorDataTD">&nbsp;</td> 
	</tr> 
	<tr> 
		<td class="ui-widget-header">Borrar registro</td></tr> 
	<tr> 
		<td> 
		<table width="95%" border="0" cellspacing="1" cellpadding="1" align="center"> 
			<tr> 
				<td width="41%" class="NoiseFooterTD">solusucodigo</td> 
				<td width="59%" class="NoiseDataTD"><?php 
				if ($sbreg) { 
					echo $sbreg [solusucodigo]; 
				} 
				?></td> 
			</tr> 
			<tr> 
				<td width="59%" class="NoiseDataTD"><?php 
				if (! $flagborrarsoliciusuario) { 
					echo $sbreg [solusucodigo]; 
				} 
				?></td> 
	<tr> 
				<td width="25%" class="NoiseFooterTD">tisouscodigo</td> 
				<td width="25%" class="NoiseDataTD"><?php 
				if (! $flagborrarsoliciusuario) { 
					echo $sbreg [tisouscodigo]; 
				} 
				?> 
				</td> 
				<td width="25%" class="NoiseFooterTD">solusucodigo</td> 
				<td width="25%" class="NoiseDataTD"><?php 
				if (! $flagborrarsoliciusuario) { 
					echo $sbreg [solusucodigo]; 
				} 
				?> 
				</td> 
 </tr> 
	<tr> 
				<td width="25%" class="NoiseFooterTD">clausucodigo</td> 
				<td width="25%" class="NoiseDataTD"><?php 
				if (! $flagborrarsoliciusuario) { 
					echo $sbreg [clausucodigo]; 
				} 
				?> 
				</td> 
				<td width="25%" class="NoiseFooterTD">solusufecha</td> 
				<td width="25%" class="NoiseDataTD"><?php 
				if (! $flagborrarsoliciusuario) { 
					echo $sbreg [solusufecha]; 
				} 
				?> 
				</td> 
 </tr> 
	<tr> 
				<td width="25%" class="NoiseFooterTD">solusuperaca</td> 
				<td width="25%" class="NoiseDataTD"><?php 
				if (! $flagborrarsoliciusuario) { 
					echo $sbreg [solusuperaca]; 
				} 
				?> 
				</td> 
				<td width="25%" class="NoiseFooterTD">solusumatmer</td> 
				<td width="25%" class="NoiseDataTD"><?php 
				if (! $flagborrarsoliciusuario) { 
					echo $sbreg [solusumatmer]; 
				} 
				?> 
				</td> 
 </tr> 
	<tr> 
				<td width="25%" class="NoiseFooterTD">solusumatfec</td> 
				<td width="25%" class="NoiseDataTD"><?php 
				if (! $flagborrarsoliciusuario) { 
					echo $sbreg [solusumatfec]; 
				} 
				?> 
				</td> 
				<td width="25%" class="NoiseFooterTD">solusudircom</td> 
				<td width="25%" class="NoiseDataTD"><?php 
				if (! $flagborrarsoliciusuario) { 
					echo $sbreg [solusudircom]; 
				} 
				?> 
				</td> 
 </tr> 
	<tr> 
				<td width="25%" class="NoiseFooterTD">solusutelcom</td> 
				<td width="25%" class="NoiseDataTD"><?php 
				if (! $flagborrarsoliciusuario) { 
					echo $sbreg [solusutelcom]; 
				} 
				?> 
				</td> 
				<td width="25%" class="NoiseFooterTD">solusufaxcom</td> 
				<td width="25%" class="NoiseDataTD"><?php 
				if (! $flagborrarsoliciusuario) { 
					echo $sbreg [solusufaxcom]; 
				} 
				?> 
				</td> 
 </tr> 
	<tr> 
				<td width="25%" class="NoiseFooterTD">solusunacexp</td> 
				<td width="25%" class="NoiseDataTD"><?php 
				if (! $flagborrarsoliciusuario) { 
					echo $sbreg [solusunacexp]; 
				} 
				?> 
				</td> 
				<td width="25%" class="NoiseFooterTD">solusuprisuc</td> 
				<td width="25%" class="NoiseDataTD"><?php 
				if (! $flagborrarsoliciusuario) { 
					echo $sbreg [solusuprisuc]; 
				} 
				?> 
				</td> 
 </tr> 
	<tr> 
				<td width="25%" class="NoiseFooterTD">solusulocprop</td> 
				<td width="25%" class="NoiseDataTD"><?php 
				if (! $flagborrarsoliciusuario) { 
					echo $sbreg [solusulocprop]; 
				} 
				?> 
				</td> 
				<td width="25%" class="NoiseFooterTD">solusuareloc</td> 
				<td width="25%" class="NoiseDataTD"><?php 
				if (! $flagborrarsoliciusuario) { 
					echo $sbreg [solusuareloc]; 
				} 
				?> 
				</td> 
 </tr> 
	<tr> 
				<td width="25%" class="NoiseFooterTD">solusuarrend</td> 
				<td width="25%" class="NoiseDataTD"><?php 
				if (! $flagborrarsoliciusuario) { 
					echo $sbreg [solusuarrend]; 
				} 
				?> 
				</td> 
				<td width="25%" class="NoiseFooterTD">solusutelarr</td> 
				<td width="25%" class="NoiseDataTD"><?php 
				if (! $flagborrarsoliciusuario) { 
					echo $sbreg [solusutelarr]; 
				} 
				?> 
				</td> 
 </tr> 
	<tr> 
				<td width="25%" class="NoiseFooterTD">solusuantneg</td> 
				<td width="25%" class="NoiseDataTD"><?php 
				if (! $flagborrarsoliciusuario) { 
					echo $sbreg [solusuantneg]; 
				} 
				?> 
				</td> 
				<td width="25%" class="NoiseFooterTD">solusuacteco</td> 
				<td width="25%" class="NoiseDataTD"><?php 
				if (! $flagborrarsoliciusuario) { 
					echo $sbreg [solusuacteco]; 
				} 
				?> 
				</td> 
 </tr> 
	<tr> 
				<td width="25%" class="NoiseFooterTD">solusuactcod</td> 
				<td width="25%" class="NoiseDataTD"><?php 
				if (! $flagborrarsoliciusuario) { 
					echo $sbreg [solusuactcod]; 
				} 
				?> 
				</td> 
				<td width="25%" class="NoiseFooterTD">solusutipinm</td> 
				<td width="25%" class="NoiseDataTD"><?php 
				if (! $flagborrarsoliciusuario) { 
					echo $sbreg [solusutipinm]; 
				} 
				?> 
				</td> 
 </tr> 
	<tr> 
				<td width="25%" class="NoiseFooterTD">solusumatinm</td> 
				<td width="25%" class="NoiseDataTD"><?php 
				if (! $flagborrarsoliciusuario) { 
					echo $sbreg [solusumatinm]; 
				} 
				?> 
				</td> 
				<td width="25%" class="NoiseFooterTD">solusudirecc</td> 
				<td width="25%" class="NoiseDataTD"><?php 
				if (! $flagborrarsoliciusuario) { 
					echo $sbreg [solusudirecc]; 
				} 
				?> 
				</td> 
 </tr> 
	<tr> 
				<td width="25%" class="NoiseFooterTD">solusuvalcom</td> 
				<td width="25%" class="NoiseDataTD"><?php 
				if (! $flagborrarsoliciusuario) { 
					echo $sbreg [solusuvalcom]; 
				} 
				?> 
				</td> 
				<td width="25%" class="NoiseFooterTD">solusutipinm1</td> 
				<td width="25%" class="NoiseDataTD"><?php 
				if (! $flagborrarsoliciusuario) { 
					echo $sbreg [solusutipinm1]; 
				} 
				?> 
				</td> 
 </tr> 
	<tr> 
				<td width="25%" class="NoiseFooterTD">solusumatinm1</td> 
				<td width="25%" class="NoiseDataTD"><?php 
				if (! $flagborrarsoliciusuario) { 
					echo $sbreg [solusumatinm1]; 
				} 
				?> 
				</td> 
				<td width="25%" class="NoiseFooterTD">solusudirecc1</td> 
				<td width="25%" class="NoiseDataTD"><?php 
				if (! $flagborrarsoliciusuario) { 
					echo $sbreg [solusudirecc1]; 
				} 
				?> 
				</td> 
 </tr> 
	<tr> 
				<td width="25%" class="NoiseFooterTD">solusuvalcom1</td> 
				<td width="25%" class="NoiseDataTD"><?php 
				if (! $flagborrarsoliciusuario) { 
					echo $sbreg [solusuvalcom1]; 
				} 
				?> 
				</td> 
				<td width="25%" class="NoiseFooterTD">solusuvehicu</td> 
				<td width="25%" class="NoiseDataTD"><?php 
				if (! $flagborrarsoliciusuario) { 
					echo $sbreg [solusuvehicu]; 
				} 
				?> 
				</td> 
 </tr> 
	<tr> 
				<td width="25%" class="NoiseFooterTD">solusuvehmod</td> 
				<td width="25%" class="NoiseDataTD"><?php 
				if (! $flagborrarsoliciusuario) { 
					echo $sbreg [solusuvehmod]; 
				} 
				?> 
				</td> 
				<td width="25%" class="NoiseFooterTD">solusuvehpla</td> 
				<td width="25%" class="NoiseDataTD"><?php 
				if (! $flagborrarsoliciusuario) { 
					echo $sbreg [solusuvehpla]; 
				} 
				?> 
				</td> 
 </tr> 
	<tr> 
				<td width="25%" class="NoiseFooterTD">solusuprefav</td> 
				<td width="25%" class="NoiseDataTD"><?php 
				if (! $flagborrarsoliciusuario) { 
					echo $sbreg [solusuprefav]; 
				} 
				?> 
				</td> 
				<td width="25%" class="NoiseFooterTD">solusuvevaco</td> 
				<td width="25%" class="NoiseDataTD"><?php 
				if (! $flagborrarsoliciusuario) { 
					echo $sbreg [solusuvevaco]; 
				} 
				?> 
				</td> 
 </tr> 
	<tr> 
				<td width="25%" class="NoiseFooterTD">solusuvehicu1</td> 
				<td width="25%" class="NoiseDataTD"><?php 
				if (! $flagborrarsoliciusuario) { 
					echo $sbreg [solusuvehicu1]; 
				} 
				?> 
				</td> 
				<td width="25%" class="NoiseFooterTD">solusuvehmod1</td> 
				<td width="25%" class="NoiseDataTD"><?php 
				if (! $flagborrarsoliciusuario) { 
					echo $sbreg [solusuvehmod1]; 
				} 
				?> 
				</td> 
 </tr> 
	<tr> 
				<td width="25%" class="NoiseFooterTD">solusuvehpla1</td> 
				<td width="25%" class="NoiseDataTD"><?php 
				if (! $flagborrarsoliciusuario) { 
					echo $sbreg [solusuvehpla1]; 
				} 
				?> 
				</td> 
				<td width="25%" class="NoiseFooterTD">solusuprefav1</td> 
				<td width="25%" class="NoiseDataTD"><?php 
				if (! $flagborrarsoliciusuario) { 
					echo $sbreg [solusuprefav1]; 
				} 
				?> 
				</td> 
 </tr> 
	<tr> 
				<td width="25%" class="NoiseFooterTD">solusuvevaco1</td> 
				<td width="25%" class="NoiseDataTD"><?php 
				if (! $flagborrarsoliciusuario) { 
					echo $sbreg [solusuvevaco1]; 
				} 
				?> 
				</td> 
				<td width="25%" class="NoiseFooterTD">solusunomrec</td> 
				<td width="25%" class="NoiseDataTD"><?php 
				if (! $flagborrarsoliciusuario) { 
					echo $sbreg [solusunomrec]; 
				} 
				?> 
				</td> 
 </tr> 
	<tr> 
				<td width="25%" class="NoiseFooterTD">solusucuprec</td> 
				<td width="25%" class="NoiseDataTD"><?php 
				if (! $flagborrarsoliciusuario) { 
					echo $sbreg [solusucuprec]; 
				} 
				?> 
				</td> 
				<td width="25%" class="NoiseFooterTD">solusutelrec</td> 
				<td width="25%" class="NoiseDataTD"><?php 
				if (! $flagborrarsoliciusuario) { 
					echo $sbreg [solusutelrec]; 
				} 
				?> 
				</td> 
 </tr> 
	<tr> 
				<td width="25%" class="NoiseFooterTD">solusudirrec</td> 
				<td width="25%" class="NoiseDataTD"><?php 
				if (! $flagborrarsoliciusuario) { 
					echo $sbreg [solusudirrec]; 
				} 
				?> 
				</td> 
				<td width="25%" class="NoiseFooterTD">solusuciurec</td> 
				<td width="25%" class="NoiseDataTD"><?php 
				if (! $flagborrarsoliciusuario) { 
					echo $sbreg [solusuciurec]; 
				} 
				?> 
				</td> 
 </tr> 
	<tr> 
				<td width="25%" class="NoiseFooterTD">solusunomrec1</td> 
				<td width="25%" class="NoiseDataTD"><?php 
				if (! $flagborrarsoliciusuario) { 
					echo $sbreg [solusunomrec1]; 
				} 
				?> 
				</td> 
				<td width="25%" class="NoiseFooterTD">solusucuprec1</td> 
				<td width="25%" class="NoiseDataTD"><?php 
				if (! $flagborrarsoliciusuario) { 
					echo $sbreg [solusucuprec1]; 
				} 
				?> 
				</td> 
 </tr> 
	<tr> 
				<td width="25%" class="NoiseFooterTD">solusutelrec1</td> 
				<td width="25%" class="NoiseDataTD"><?php 
				if (! $flagborrarsoliciusuario) { 
					echo $sbreg [solusutelrec1]; 
				} 
				?> 
				</td> 
				<td width="25%" class="NoiseFooterTD">solusudirrec1</td> 
				<td width="25%" class="NoiseDataTD"><?php 
				if (! $flagborrarsoliciusuario) { 
					echo $sbreg [solusudirrec1]; 
				} 
				?> 
				</td> 
 </tr> 
	<tr> 
				<td width="25%" class="NoiseFooterTD">solusuciurec1</td> 
				<td width="25%" class="NoiseDataTD"><?php 
				if (! $flagborrarsoliciusuario) { 
					echo $sbreg [solusuciurec1]; 
				} 
				?> 
				</td> 
				<td width="25%" class="NoiseFooterTD">solusunomrec2</td> 
				<td width="25%" class="NoiseDataTD"><?php 
				if (! $flagborrarsoliciusuario) { 
					echo $sbreg [solusunomrec2]; 
				} 
				?> 
				</td> 
 </tr> 
	<tr> 
				<td width="25%" class="NoiseFooterTD">solusucuprec2</td> 
				<td width="25%" class="NoiseDataTD"><?php 
				if (! $flagborrarsoliciusuario) { 
					echo $sbreg [solusucuprec2]; 
				} 
				?> 
				</td> 
				<td width="25%" class="NoiseFooterTD">solusutelrec2</td> 
				<td width="25%" class="NoiseDataTD"><?php 
				if (! $flagborrarsoliciusuario) { 
					echo $sbreg [solusutelrec2]; 
				} 
				?> 
				</td> 
 </tr> 
	<tr> 
				<td width="25%" class="NoiseFooterTD">solusudirrec2</td> 
				<td width="25%" class="NoiseDataTD"><?php 
				if (! $flagborrarsoliciusuario) { 
					echo $sbreg [solusudirrec2]; 
				} 
				?> 
				</td> 
				<td width="25%" class="NoiseFooterTD">solusuciurec2</td> 
				<td width="25%" class="NoiseDataTD"><?php 
				if (! $flagborrarsoliciusuario) { 
					echo $sbreg [solusuciurec2]; 
				} 
				?> 
				</td> 
 </tr> 
	<tr> 
				<td width="25%" class="NoiseFooterTD">solusubanco</td> 
				<td width="25%" class="NoiseDataTD"><?php 
				if (! $flagborrarsoliciusuario) { 
					echo $sbreg [solusubanco]; 
				} 
				?> 
				</td> 
				<td width="25%" class="NoiseFooterTD">solusutipcue</td> 
				<td width="25%" class="NoiseDataTD"><?php 
				if (! $flagborrarsoliciusuario) { 
					echo $sbreg [solusutipcue]; 
				} 
				?> 
				</td> 
 </tr> 
	<tr> 
				<td width="25%" class="NoiseFooterTD">solusunumcue</td> 
				<td width="25%" class="NoiseDataTD"><?php 
				if (! $flagborrarsoliciusuario) { 
					echo $sbreg [solusunumcue]; 
				} 
				?> 
				</td> 
				<td width="25%" class="NoiseFooterTD">solususucurs</td> 
				<td width="25%" class="NoiseDataTD"><?php 
				if (! $flagborrarsoliciusuario) { 
					echo $sbreg [solususucurs]; 
				} 
				?> 
				</td> 
 </tr> 
	<tr> 
				<td width="25%" class="NoiseFooterTD">solusutelefo</td> 
				<td width="25%" class="NoiseDataTD"><?php 
				if (! $flagborrarsoliciusuario) { 
					echo $sbreg [solusutelefo]; 
				} 
				?> 
				</td> 
				<td width="25%" class="NoiseFooterTD">solusuciudad</td> 
				<td width="25%" class="NoiseDataTD"><?php 
				if (! $flagborrarsoliciusuario) { 
					echo $sbreg [solusuciudad]; 
				} 
				?> 
				</td> 
 </tr> 
	<tr> 
				<td width="25%" class="NoiseFooterTD">solusubanco1</td> 
				<td width="25%" class="NoiseDataTD"><?php 
				if (! $flagborrarsoliciusuario) { 
					echo $sbreg [solusubanco1]; 
				} 
				?> 
				</td> 
				<td width="25%" class="NoiseFooterTD">solusutipcue1</td> 
				<td width="25%" class="NoiseDataTD"><?php 
				if (! $flagborrarsoliciusuario) { 
					echo $sbreg [solusutipcue1]; 
				} 
				?> 
				</td> 
 </tr> 
	<tr> 
				<td width="25%" class="NoiseFooterTD">solusunumcue1</td> 
				<td width="25%" class="NoiseDataTD"><?php 
				if (! $flagborrarsoliciusuario) { 
					echo $sbreg [solusunumcue1]; 
				} 
				?> 
				</td> 
				<td width="25%" class="NoiseFooterTD">solususucurs1</td> 
				<td width="25%" class="NoiseDataTD"><?php 
				if (! $flagborrarsoliciusuario) { 
					echo $sbreg [solususucurs1]; 
				} 
				?> 
				</td> 
 </tr> 
	<tr> 
				<td width="25%" class="NoiseFooterTD">solusutelefo1</td> 
				<td width="25%" class="NoiseDataTD"><?php 
				if (! $flagborrarsoliciusuario) { 
					echo $sbreg [solusutelefo1]; 
				} 
				?> 
				</td> 
				<td width="25%" class="NoiseFooterTD">solusuciudad1</td> 
				<td width="25%" class="NoiseDataTD"><?php 
				if (! $flagborrarsoliciusuario) { 
					echo $sbreg [solusuciudad1]; 
				} 
				?> 
				</td> 
 </tr> 
	<tr> 
				<td width="25%" class="NoiseFooterTD">solusubanco2</td> 
				<td width="25%" class="NoiseDataTD"><?php 
				if (! $flagborrarsoliciusuario) { 
					echo $sbreg [solusubanco2]; 
				} 
				?> 
				</td> 
				<td width="25%" class="NoiseFooterTD">solusutipcue2</td> 
				<td width="25%" class="NoiseDataTD"><?php 
				if (! $flagborrarsoliciusuario) { 
					echo $sbreg [solusutipcue2]; 
				} 
				?> 
				</td> 
 </tr> 
	<tr> 
				<td width="25%" class="NoiseFooterTD">solusunumcue2</td> 
				<td width="25%" class="NoiseDataTD"><?php 
				if (! $flagborrarsoliciusuario) { 
					echo $sbreg [solusunumcue2]; 
				} 
				?> 
				</td> 
				<td width="25%" class="NoiseFooterTD">solususucurs2</td> 
				<td width="25%" class="NoiseDataTD"><?php 
				if (! $flagborrarsoliciusuario) { 
					echo $sbreg [solususucurs2]; 
				} 
				?> 
				</td> 
 </tr> 
	<tr> 
				<td width="25%" class="NoiseFooterTD">solusutelefo2</td> 
				<td width="25%" class="NoiseDataTD"><?php 
				if (! $flagborrarsoliciusuario) { 
					echo $sbreg [solusutelefo2]; 
				} 
				?> 
				</td> 
				<td width="25%" class="NoiseFooterTD">solusuciudad2</td> 
				<td width="25%" class="NoiseDataTD"><?php 
				if (! $flagborrarsoliciusuario) { 
					echo $sbreg [solusuciudad2]; 
				} 
				?> 
				</td> 
 </tr> 
	<tr> 
				<td width="25%" class="NoiseFooterTD">solusunomrfa</td> 
				<td width="25%" class="NoiseDataTD"><?php 
				if (! $flagborrarsoliciusuario) { 
					echo $sbreg [solusunomrfa]; 
				} 
				?> 
				</td> 
				<td width="25%" class="NoiseFooterTD">solusuparrfa</td> 
				<td width="25%" class="NoiseDataTD"><?php 
				if (! $flagborrarsoliciusuario) { 
					echo $sbreg [solusuparrfa]; 
				} 
				?> 
				</td> 
 </tr> 
	<tr> 
				<td width="25%" class="NoiseFooterTD">solusutelrfa</td> 
				<td width="25%" class="NoiseDataTD"><?php 
				if (! $flagborrarsoliciusuario) { 
					echo $sbreg [solusutelrfa]; 
				} 
				?> 
				</td> 
				<td width="25%" class="NoiseFooterTD">solusudirrfa</td> 
				<td width="25%" class="NoiseDataTD"><?php 
				if (! $flagborrarsoliciusuario) { 
					echo $sbreg [solusudirrfa]; 
				} 
				?> 
				</td> 
 </tr> 
	<tr> 
				<td width="25%" class="NoiseFooterTD">solusuciurfa</td> 
				<td width="25%" class="NoiseDataTD"><?php 
				if (! $flagborrarsoliciusuario) { 
					echo $sbreg [solusuciurfa]; 
				} 
				?> 
				</td> 
				<td width="25%" class="NoiseFooterTD">solusunomrfa1</td> 
				<td width="25%" class="NoiseDataTD"><?php 
				if (! $flagborrarsoliciusuario) { 
					echo $sbreg [solusunomrfa1]; 
				} 
				?> 
				</td> 
 </tr> 
	<tr> 
				<td width="25%" class="NoiseFooterTD">solusuparrfa1</td> 
				<td width="25%" class="NoiseDataTD"><?php 
				if (! $flagborrarsoliciusuario) { 
					echo $sbreg [solusuparrfa1]; 
				} 
				?> 
				</td> 
				<td width="25%" class="NoiseFooterTD">solusutelrfa1</td> 
				<td width="25%" class="NoiseDataTD"><?php 
				if (! $flagborrarsoliciusuario) { 
					echo $sbreg [solusutelrfa1]; 
				} 
				?> 
				</td> 
 </tr> 
	<tr> 
				<td width="25%" class="NoiseFooterTD">solusudirrfa1</td> 
				<td width="25%" class="NoiseDataTD"><?php 
				if (! $flagborrarsoliciusuario) { 
					echo $sbreg [solusudirrfa1]; 
				} 
				?> 
				</td> 
				<td width="25%" class="NoiseFooterTD">solusuciurfa1</td> 
				<td width="25%" class="NoiseDataTD"><?php 
				if (! $flagborrarsoliciusuario) { 
					echo $sbreg [solusuciurfa1]; 
				} 
				?> 
				</td> 
 </tr> 
	<tr> 
				<td width="25%" class="NoiseFooterTD">solusunomrfa2</td> 
				<td width="25%" class="NoiseDataTD"><?php 
				if (! $flagborrarsoliciusuario) { 
					echo $sbreg [solusunomrfa2]; 
				} 
				?> 
				</td> 
				<td width="25%" class="NoiseFooterTD">solusuparrfa2</td> 
				<td width="25%" class="NoiseDataTD"><?php 
				if (! $flagborrarsoliciusuario) { 
					echo $sbreg [solusuparrfa2]; 
				} 
				?> 
				</td> 
 </tr> 
	<tr> 
				<td width="25%" class="NoiseFooterTD">solusutelrfa2</td> 
				<td width="25%" class="NoiseDataTD"><?php 
				if (! $flagborrarsoliciusuario) { 
					echo $sbreg [solusutelrfa2]; 
				} 
				?> 
				</td> 
				<td width="25%" class="NoiseFooterTD">solusudirrfa2</td> 
				<td width="25%" class="NoiseDataTD"><?php 
				if (! $flagborrarsoliciusuario) { 
					echo $sbreg [solusudirrfa2]; 
				} 
				?> 
				</td> 
 </tr> 
	<tr> 
				<td width="25%" class="NoiseFooterTD">solusuciurfa2</td> 
				<td width="25%" class="NoiseDataTD"><?php 
				if (! $flagborrarsoliciusuario) { 
					echo $sbreg [solusuciurfa2]; 
				} 
				?> 
				</td> 
				<td width="25%" class="NoiseFooterTD">solusucupsol</td> 
				<td width="25%" class="NoiseDataTD"><?php 
				if (! $flagborrarsoliciusuario) { 
					echo $sbreg [solusucupsol]; 
				} 
				?> 
				</td> 
 </tr> 
	<tr> 
				<td width="25%" class="NoiseFooterTD">solusuplasol</td> 
				<td width="25%" class="NoiseDataTD"><?php 
				if (! $flagborrarsoliciusuario) { 
					echo $sbreg [solusuplasol]; 
				} 
				?> 
				</td> 
				<td width="25%" class="NoiseFooterTD">solusucontac</td> 
				<td width="25%" class="NoiseDataTD"><?php 
				if (! $flagborrarsoliciusuario) { 
					echo $sbreg [solusucontac]; 
				} 
				?> 
				</td> 
 </tr> 
	<tr> 
				<td width="25%" class="NoiseFooterTD">solusuobserv</td> 
				<td width="25%" class="NoiseDataTD"><?php 
				if (! $flagborrarsoliciusuario) { 
					echo $sbreg [solusuobserv]; 
				} 
				?> 
				</td> 
				<td width="25%" class="NoiseFooterTD">solusucupsug</td> 
				<td width="25%" class="NoiseDataTD"><?php 
				if (! $flagborrarsoliciusuario) { 
					echo $sbreg [solusucupsug]; 
				} 
				?> 
				</td> 
 </tr> 
	<tr> 
				<td width="25%" class="NoiseFooterTD">solusucupaut</td> 
				<td width="25%" class="NoiseDataTD"><?php 
				if (! $flagborrarsoliciusuario) { 
					echo $sbreg [solusucupaut]; 
				} 
				?> 
				</td> 
				<td width="25%" class="NoiseFooterTD">solusuplacon</td> 
				<td width="25%" class="NoiseDataTD"><?php 
				if (! $flagborrarsoliciusuario) { 
					echo $sbreg [solusuplacon]; 
				} 
				?> 
				</td> 
 </tr> 
	<tr> 
				<td width="25%" class="NoiseFooterTD">solusuobserv1</td> 
				<td width="25%" class="NoiseDataTD"><?php 
				if (! $flagborrarsoliciusuario) { 
					echo $sbreg [solusuobserv1]; 
				} 
				?> 
				</td> 
				<td width="25%" class="NoiseFooterTD">solusuprecli</td> 
				<td width="25%" class="NoiseDataTD"><?php 
				if (! $flagborrarsoliciusuario) { 
					echo $sbreg [solusuprecli]; 
				} 
				?> 
				</td> 
 </tr> 
		</table> 
		</td> 
	</tr> 
	<tr> 
		<td class="NoiseErrorDataTD" align="center"><?php 
		include '../def/jquery.button_form.php'; 
		?></td> 
	</tr> 
	<tr> 
		<td class="NoiseErrorDataTD">&nbsp;</td> 
	</tr> 
		<td> 
</table> 
</div> 
</td> 
 </tr> 
 <tr> 
  <td class="NoiseErrorDataTD">&nbsp;</td> 
 </tr> 
</table> 
<input type="hidden" name="" value="<?php echo $sbreg []; ?>"> 
<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>"> 
<input type="hidden" name="sourceaction" value="borrar"> 
<input type="hidden" name="flagborrarsoliciusuario" value="1"> 
<input type="hidden" name="accionborrarsoliciusuario"> 
<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
</form> 
</body> 
<?php 
if (! $codigo) { 
    echo " -->"; 
} 
?> 
</html> 
