<?php 
include ('../src/FunGen/sesion/fncvalses.php'); 
if (! $flagdetallarsoliciusuario) { 
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
<title>Detalle de registro de soliciusuario</title> 
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
		<td class="ui-widget-header">Detallar registro</td></tr> 
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
				if (! $flagdetallarsoliciusuario) { 
					echo $sbreg [solusucodigo]; 
				} 
				?></td> 
	<tr> 
				<td width="25%" class="NoiseFooterTD">tisouscodigo</td> 
				<td width="25%" class="NoiseDataTD"><?php 
				if (! $flagdetallarsoliciusuario) { 
					echo $sbreg [tisouscodigo]; 
				} 
				?> 
				</td> 
				<td width="25%" class="NoiseFooterTD">solusucodigo</td> 
				<td width="25%" class="NoiseDataTD"><?php 
				if (! $flagdetallarsoliciusuario) { 
					echo $sbreg [solusucodigo]; 
				} 
				?> 
				</td> 
 </tr> 
	<tr> 
				<td width="25%" class="NoiseFooterTD">clausucodigo</td> 
				<td width="25%" class="NoiseDataTD"><?php 
				if (! $flagdetallarsoliciusuario) { 
					echo $sbreg [clausucodigo]; 
				} 
				?> 
				</td> 
				<td width="25%" class="NoiseFooterTD">solusufecha</td> 
				<td width="25%" class="NoiseDataTD"><?php 
				if (! $flagdetallarsoliciusuario) { 
					echo $sbreg [solusufecha]; 
				} 
				?> 
				</td> 
 </tr> 
	<tr> 
				<td width="25%" class="NoiseFooterTD">solusuperaca</td> 
				<td width="25%" class="NoiseDataTD"><?php 
				if (! $flagdetallarsoliciusuario) { 
					echo $sbreg [solusuperaca]; 
				} 
				?> 
				</td> 
				<td width="25%" class="NoiseFooterTD">solusumatmer</td> 
				<td width="25%" class="NoiseDataTD"><?php 
				if (! $flagdetallarsoliciusuario) { 
					echo $sbreg [solusumatmer]; 
				} 
				?> 
				</td> 
 </tr> 
	<tr> 
				<td width="25%" class="NoiseFooterTD">solusumatfec</td> 
				<td width="25%" class="NoiseDataTD"><?php 
				if (! $flagdetallarsoliciusuario) { 
					echo $sbreg [solusumatfec]; 
				} 
				?> 
				</td> 
				<td width="25%" class="NoiseFooterTD">solusudircom</td> 
				<td width="25%" class="NoiseDataTD"><?php 
				if (! $flagdetallarsoliciusuario) { 
					echo $sbreg [solusudircom]; 
				} 
				?> 
				</td> 
 </tr> 
	<tr> 
				<td width="25%" class="NoiseFooterTD">solusutelcom</td> 
				<td width="25%" class="NoiseDataTD"><?php 
				if (! $flagdetallarsoliciusuario) { 
					echo $sbreg [solusutelcom]; 
				} 
				?> 
				</td> 
				<td width="25%" class="NoiseFooterTD">solusufaxcom</td> 
				<td width="25%" class="NoiseDataTD"><?php 
				if (! $flagdetallarsoliciusuario) { 
					echo $sbreg [solusufaxcom]; 
				} 
				?> 
				</td> 
 </tr> 
	<tr> 
				<td width="25%" class="NoiseFooterTD">solusunacexp</td> 
				<td width="25%" class="NoiseDataTD"><?php 
				if (! $flagdetallarsoliciusuario) { 
					echo $sbreg [solusunacexp]; 
				} 
				?> 
				</td> 
				<td width="25%" class="NoiseFooterTD">solusuprisuc</td> 
				<td width="25%" class="NoiseDataTD"><?php 
				if (! $flagdetallarsoliciusuario) { 
					echo $sbreg [solusuprisuc]; 
				} 
				?> 
				</td> 
 </tr> 
	<tr> 
				<td width="25%" class="NoiseFooterTD">solusulocprop</td> 
				<td width="25%" class="NoiseDataTD"><?php 
				if (! $flagdetallarsoliciusuario) { 
					echo $sbreg [solusulocprop]; 
				} 
				?> 
				</td> 
				<td width="25%" class="NoiseFooterTD">solusuareloc</td> 
				<td width="25%" class="NoiseDataTD"><?php 
				if (! $flagdetallarsoliciusuario) { 
					echo $sbreg [solusuareloc]; 
				} 
				?> 
				</td> 
 </tr> 
	<tr> 
				<td width="25%" class="NoiseFooterTD">solusuarrend</td> 
				<td width="25%" class="NoiseDataTD"><?php 
				if (! $flagdetallarsoliciusuario) { 
					echo $sbreg [solusuarrend]; 
				} 
				?> 
				</td> 
				<td width="25%" class="NoiseFooterTD">solusutelarr</td> 
				<td width="25%" class="NoiseDataTD"><?php 
				if (! $flagdetallarsoliciusuario) { 
					echo $sbreg [solusutelarr]; 
				} 
				?> 
				</td> 
 </tr> 
	<tr> 
				<td width="25%" class="NoiseFooterTD">solusuantneg</td> 
				<td width="25%" class="NoiseDataTD"><?php 
				if (! $flagdetallarsoliciusuario) { 
					echo $sbreg [solusuantneg]; 
				} 
				?> 
				</td> 
				<td width="25%" class="NoiseFooterTD">solusuacteco</td> 
				<td width="25%" class="NoiseDataTD"><?php 
				if (! $flagdetallarsoliciusuario) { 
					echo $sbreg [solusuacteco]; 
				} 
				?> 
				</td> 
 </tr> 
	<tr> 
				<td width="25%" class="NoiseFooterTD">solusuactcod</td> 
				<td width="25%" class="NoiseDataTD"><?php 
				if (! $flagdetallarsoliciusuario) { 
					echo $sbreg [solusuactcod]; 
				} 
				?> 
				</td> 
				<td width="25%" class="NoiseFooterTD">solusutipinm</td> 
				<td width="25%" class="NoiseDataTD"><?php 
				if (! $flagdetallarsoliciusuario) { 
					echo $sbreg [solusutipinm]; 
				} 
				?> 
				</td> 
 </tr> 
	<tr> 
				<td width="25%" class="NoiseFooterTD">solusumatinm</td> 
				<td width="25%" class="NoiseDataTD"><?php 
				if (! $flagdetallarsoliciusuario) { 
					echo $sbreg [solusumatinm]; 
				} 
				?> 
				</td> 
				<td width="25%" class="NoiseFooterTD">solusudirecc</td> 
				<td width="25%" class="NoiseDataTD"><?php 
				if (! $flagdetallarsoliciusuario) { 
					echo $sbreg [solusudirecc]; 
				} 
				?> 
				</td> 
 </tr> 
	<tr> 
				<td width="25%" class="NoiseFooterTD">solusuvalcom</td> 
				<td width="25%" class="NoiseDataTD"><?php 
				if (! $flagdetallarsoliciusuario) { 
					echo $sbreg [solusuvalcom]; 
				} 
				?> 
				</td> 
				<td width="25%" class="NoiseFooterTD">solusutipinm1</td> 
				<td width="25%" class="NoiseDataTD"><?php 
				if (! $flagdetallarsoliciusuario) { 
					echo $sbreg [solusutipinm1]; 
				} 
				?> 
				</td> 
 </tr> 
	<tr> 
				<td width="25%" class="NoiseFooterTD">solusumatinm1</td> 
				<td width="25%" class="NoiseDataTD"><?php 
				if (! $flagdetallarsoliciusuario) { 
					echo $sbreg [solusumatinm1]; 
				} 
				?> 
				</td> 
				<td width="25%" class="NoiseFooterTD">solusudirecc1</td> 
				<td width="25%" class="NoiseDataTD"><?php 
				if (! $flagdetallarsoliciusuario) { 
					echo $sbreg [solusudirecc1]; 
				} 
				?> 
				</td> 
 </tr> 
	<tr> 
				<td width="25%" class="NoiseFooterTD">solusuvalcom1</td> 
				<td width="25%" class="NoiseDataTD"><?php 
				if (! $flagdetallarsoliciusuario) { 
					echo $sbreg [solusuvalcom1]; 
				} 
				?> 
				</td> 
				<td width="25%" class="NoiseFooterTD">solusuvehicu</td> 
				<td width="25%" class="NoiseDataTD"><?php 
				if (! $flagdetallarsoliciusuario) { 
					echo $sbreg [solusuvehicu]; 
				} 
				?> 
				</td> 
 </tr> 
	<tr> 
				<td width="25%" class="NoiseFooterTD">solusuvehmod</td> 
				<td width="25%" class="NoiseDataTD"><?php 
				if (! $flagdetallarsoliciusuario) { 
					echo $sbreg [solusuvehmod]; 
				} 
				?> 
				</td> 
				<td width="25%" class="NoiseFooterTD">solusuvehpla</td> 
				<td width="25%" class="NoiseDataTD"><?php 
				if (! $flagdetallarsoliciusuario) { 
					echo $sbreg [solusuvehpla]; 
				} 
				?> 
				</td> 
 </tr> 
	<tr> 
				<td width="25%" class="NoiseFooterTD">solusuprefav</td> 
				<td width="25%" class="NoiseDataTD"><?php 
				if (! $flagdetallarsoliciusuario) { 
					echo $sbreg [solusuprefav]; 
				} 
				?> 
				</td> 
				<td width="25%" class="NoiseFooterTD">solusuvevaco</td> 
				<td width="25%" class="NoiseDataTD"><?php 
				if (! $flagdetallarsoliciusuario) { 
					echo $sbreg [solusuvevaco]; 
				} 
				?> 
				</td> 
 </tr> 
	<tr> 
				<td width="25%" class="NoiseFooterTD">solusuvehicu1</td> 
				<td width="25%" class="NoiseDataTD"><?php 
				if (! $flagdetallarsoliciusuario) { 
					echo $sbreg [solusuvehicu1]; 
				} 
				?> 
				</td> 
				<td width="25%" class="NoiseFooterTD">solusuvehmod1</td> 
				<td width="25%" class="NoiseDataTD"><?php 
				if (! $flagdetallarsoliciusuario) { 
					echo $sbreg [solusuvehmod1]; 
				} 
				?> 
				</td> 
 </tr> 
	<tr> 
				<td width="25%" class="NoiseFooterTD">solusuvehpla1</td> 
				<td width="25%" class="NoiseDataTD"><?php 
				if (! $flagdetallarsoliciusuario) { 
					echo $sbreg [solusuvehpla1]; 
				} 
				?> 
				</td> 
				<td width="25%" class="NoiseFooterTD">solusuprefav1</td> 
				<td width="25%" class="NoiseDataTD"><?php 
				if (! $flagdetallarsoliciusuario) { 
					echo $sbreg [solusuprefav1]; 
				} 
				?> 
				</td> 
 </tr> 
	<tr> 
				<td width="25%" class="NoiseFooterTD">solusuvevaco1</td> 
				<td width="25%" class="NoiseDataTD"><?php 
				if (! $flagdetallarsoliciusuario) { 
					echo $sbreg [solusuvevaco1]; 
				} 
				?> 
				</td> 
				<td width="25%" class="NoiseFooterTD">solusunomrec</td> 
				<td width="25%" class="NoiseDataTD"><?php 
				if (! $flagdetallarsoliciusuario) { 
					echo $sbreg [solusunomrec]; 
				} 
				?> 
				</td> 
 </tr> 
	<tr> 
				<td width="25%" class="NoiseFooterTD">solusucuprec</td> 
				<td width="25%" class="NoiseDataTD"><?php 
				if (! $flagdetallarsoliciusuario) { 
					echo $sbreg [solusucuprec]; 
				} 
				?> 
				</td> 
				<td width="25%" class="NoiseFooterTD">solusutelrec</td> 
				<td width="25%" class="NoiseDataTD"><?php 
				if (! $flagdetallarsoliciusuario) { 
					echo $sbreg [solusutelrec]; 
				} 
				?> 
				</td> 
 </tr> 
	<tr> 
				<td width="25%" class="NoiseFooterTD">solusudirrec</td> 
				<td width="25%" class="NoiseDataTD"><?php 
				if (! $flagdetallarsoliciusuario) { 
					echo $sbreg [solusudirrec]; 
				} 
				?> 
				</td> 
				<td width="25%" class="NoiseFooterTD">solusuciurec</td> 
				<td width="25%" class="NoiseDataTD"><?php 
				if (! $flagdetallarsoliciusuario) { 
					echo $sbreg [solusuciurec]; 
				} 
				?> 
				</td> 
 </tr> 
	<tr> 
				<td width="25%" class="NoiseFooterTD">solusunomrec1</td> 
				<td width="25%" class="NoiseDataTD"><?php 
				if (! $flagdetallarsoliciusuario) { 
					echo $sbreg [solusunomrec1]; 
				} 
				?> 
				</td> 
				<td width="25%" class="NoiseFooterTD">solusucuprec1</td> 
				<td width="25%" class="NoiseDataTD"><?php 
				if (! $flagdetallarsoliciusuario) { 
					echo $sbreg [solusucuprec1]; 
				} 
				?> 
				</td> 
 </tr> 
	<tr> 
				<td width="25%" class="NoiseFooterTD">solusutelrec1</td> 
				<td width="25%" class="NoiseDataTD"><?php 
				if (! $flagdetallarsoliciusuario) { 
					echo $sbreg [solusutelrec1]; 
				} 
				?> 
				</td> 
				<td width="25%" class="NoiseFooterTD">solusudirrec1</td> 
				<td width="25%" class="NoiseDataTD"><?php 
				if (! $flagdetallarsoliciusuario) { 
					echo $sbreg [solusudirrec1]; 
				} 
				?> 
				</td> 
 </tr> 
	<tr> 
				<td width="25%" class="NoiseFooterTD">solusuciurec1</td> 
				<td width="25%" class="NoiseDataTD"><?php 
				if (! $flagdetallarsoliciusuario) { 
					echo $sbreg [solusuciurec1]; 
				} 
				?> 
				</td> 
				<td width="25%" class="NoiseFooterTD">solusunomrec2</td> 
				<td width="25%" class="NoiseDataTD"><?php 
				if (! $flagdetallarsoliciusuario) { 
					echo $sbreg [solusunomrec2]; 
				} 
				?> 
				</td> 
 </tr> 
	<tr> 
				<td width="25%" class="NoiseFooterTD">solusucuprec2</td> 
				<td width="25%" class="NoiseDataTD"><?php 
				if (! $flagdetallarsoliciusuario) { 
					echo $sbreg [solusucuprec2]; 
				} 
				?> 
				</td> 
				<td width="25%" class="NoiseFooterTD">solusutelrec2</td> 
				<td width="25%" class="NoiseDataTD"><?php 
				if (! $flagdetallarsoliciusuario) { 
					echo $sbreg [solusutelrec2]; 
				} 
				?> 
				</td> 
 </tr> 
	<tr> 
				<td width="25%" class="NoiseFooterTD">solusudirrec2</td> 
				<td width="25%" class="NoiseDataTD"><?php 
				if (! $flagdetallarsoliciusuario) { 
					echo $sbreg [solusudirrec2]; 
				} 
				?> 
				</td> 
				<td width="25%" class="NoiseFooterTD">solusuciurec2</td> 
				<td width="25%" class="NoiseDataTD"><?php 
				if (! $flagdetallarsoliciusuario) { 
					echo $sbreg [solusuciurec2]; 
				} 
				?> 
				</td> 
 </tr> 
	<tr> 
				<td width="25%" class="NoiseFooterTD">solusubanco</td> 
				<td width="25%" class="NoiseDataTD"><?php 
				if (! $flagdetallarsoliciusuario) { 
					echo $sbreg [solusubanco]; 
				} 
				?> 
				</td> 
				<td width="25%" class="NoiseFooterTD">solusutipcue</td> 
				<td width="25%" class="NoiseDataTD"><?php 
				if (! $flagdetallarsoliciusuario) { 
					echo $sbreg [solusutipcue]; 
				} 
				?> 
				</td> 
 </tr> 
	<tr> 
				<td width="25%" class="NoiseFooterTD">solusunumcue</td> 
				<td width="25%" class="NoiseDataTD"><?php 
				if (! $flagdetallarsoliciusuario) { 
					echo $sbreg [solusunumcue]; 
				} 
				?> 
				</td> 
				<td width="25%" class="NoiseFooterTD">solususucurs</td> 
				<td width="25%" class="NoiseDataTD"><?php 
				if (! $flagdetallarsoliciusuario) { 
					echo $sbreg [solususucurs]; 
				} 
				?> 
				</td> 
 </tr> 
	<tr> 
				<td width="25%" class="NoiseFooterTD">solusutelefo</td> 
				<td width="25%" class="NoiseDataTD"><?php 
				if (! $flagdetallarsoliciusuario) { 
					echo $sbreg [solusutelefo]; 
				} 
				?> 
				</td> 
				<td width="25%" class="NoiseFooterTD">solusuciudad</td> 
				<td width="25%" class="NoiseDataTD"><?php 
				if (! $flagdetallarsoliciusuario) { 
					echo $sbreg [solusuciudad]; 
				} 
				?> 
				</td> 
 </tr> 
	<tr> 
				<td width="25%" class="NoiseFooterTD">solusubanco1</td> 
				<td width="25%" class="NoiseDataTD"><?php 
				if (! $flagdetallarsoliciusuario) { 
					echo $sbreg [solusubanco1]; 
				} 
				?> 
				</td> 
				<td width="25%" class="NoiseFooterTD">solusutipcue1</td> 
				<td width="25%" class="NoiseDataTD"><?php 
				if (! $flagdetallarsoliciusuario) { 
					echo $sbreg [solusutipcue1]; 
				} 
				?> 
				</td> 
 </tr> 
	<tr> 
				<td width="25%" class="NoiseFooterTD">solusunumcue1</td> 
				<td width="25%" class="NoiseDataTD"><?php 
				if (! $flagdetallarsoliciusuario) { 
					echo $sbreg [solusunumcue1]; 
				} 
				?> 
				</td> 
				<td width="25%" class="NoiseFooterTD">solususucurs1</td> 
				<td width="25%" class="NoiseDataTD"><?php 
				if (! $flagdetallarsoliciusuario) { 
					echo $sbreg [solususucurs1]; 
				} 
				?> 
				</td> 
 </tr> 
	<tr> 
				<td width="25%" class="NoiseFooterTD">solusutelefo1</td> 
				<td width="25%" class="NoiseDataTD"><?php 
				if (! $flagdetallarsoliciusuario) { 
					echo $sbreg [solusutelefo1]; 
				} 
				?> 
				</td> 
				<td width="25%" class="NoiseFooterTD">solusuciudad1</td> 
				<td width="25%" class="NoiseDataTD"><?php 
				if (! $flagdetallarsoliciusuario) { 
					echo $sbreg [solusuciudad1]; 
				} 
				?> 
				</td> 
 </tr> 
	<tr> 
				<td width="25%" class="NoiseFooterTD">solusubanco2</td> 
				<td width="25%" class="NoiseDataTD"><?php 
				if (! $flagdetallarsoliciusuario) { 
					echo $sbreg [solusubanco2]; 
				} 
				?> 
				</td> 
				<td width="25%" class="NoiseFooterTD">solusutipcue2</td> 
				<td width="25%" class="NoiseDataTD"><?php 
				if (! $flagdetallarsoliciusuario) { 
					echo $sbreg [solusutipcue2]; 
				} 
				?> 
				</td> 
 </tr> 
	<tr> 
				<td width="25%" class="NoiseFooterTD">solusunumcue2</td> 
				<td width="25%" class="NoiseDataTD"><?php 
				if (! $flagdetallarsoliciusuario) { 
					echo $sbreg [solusunumcue2]; 
				} 
				?> 
				</td> 
				<td width="25%" class="NoiseFooterTD">solususucurs2</td> 
				<td width="25%" class="NoiseDataTD"><?php 
				if (! $flagdetallarsoliciusuario) { 
					echo $sbreg [solususucurs2]; 
				} 
				?> 
				</td> 
 </tr> 
	<tr> 
				<td width="25%" class="NoiseFooterTD">solusutelefo2</td> 
				<td width="25%" class="NoiseDataTD"><?php 
				if (! $flagdetallarsoliciusuario) { 
					echo $sbreg [solusutelefo2]; 
				} 
				?> 
				</td> 
				<td width="25%" class="NoiseFooterTD">solusuciudad2</td> 
				<td width="25%" class="NoiseDataTD"><?php 
				if (! $flagdetallarsoliciusuario) { 
					echo $sbreg [solusuciudad2]; 
				} 
				?> 
				</td> 
 </tr> 
	<tr> 
				<td width="25%" class="NoiseFooterTD">solusunomrfa</td> 
				<td width="25%" class="NoiseDataTD"><?php 
				if (! $flagdetallarsoliciusuario) { 
					echo $sbreg [solusunomrfa]; 
				} 
				?> 
				</td> 
				<td width="25%" class="NoiseFooterTD">solusuparrfa</td> 
				<td width="25%" class="NoiseDataTD"><?php 
				if (! $flagdetallarsoliciusuario) { 
					echo $sbreg [solusuparrfa]; 
				} 
				?> 
				</td> 
 </tr> 
	<tr> 
				<td width="25%" class="NoiseFooterTD">solusutelrfa</td> 
				<td width="25%" class="NoiseDataTD"><?php 
				if (! $flagdetallarsoliciusuario) { 
					echo $sbreg [solusutelrfa]; 
				} 
				?> 
				</td> 
				<td width="25%" class="NoiseFooterTD">solusudirrfa</td> 
				<td width="25%" class="NoiseDataTD"><?php 
				if (! $flagdetallarsoliciusuario) { 
					echo $sbreg [solusudirrfa]; 
				} 
				?> 
				</td> 
 </tr> 
	<tr> 
				<td width="25%" class="NoiseFooterTD">solusuciurfa</td> 
				<td width="25%" class="NoiseDataTD"><?php 
				if (! $flagdetallarsoliciusuario) { 
					echo $sbreg [solusuciurfa]; 
				} 
				?> 
				</td> 
				<td width="25%" class="NoiseFooterTD">solusunomrfa1</td> 
				<td width="25%" class="NoiseDataTD"><?php 
				if (! $flagdetallarsoliciusuario) { 
					echo $sbreg [solusunomrfa1]; 
				} 
				?> 
				</td> 
 </tr> 
	<tr> 
				<td width="25%" class="NoiseFooterTD">solusuparrfa1</td> 
				<td width="25%" class="NoiseDataTD"><?php 
				if (! $flagdetallarsoliciusuario) { 
					echo $sbreg [solusuparrfa1]; 
				} 
				?> 
				</td> 
				<td width="25%" class="NoiseFooterTD">solusutelrfa1</td> 
				<td width="25%" class="NoiseDataTD"><?php 
				if (! $flagdetallarsoliciusuario) { 
					echo $sbreg [solusutelrfa1]; 
				} 
				?> 
				</td> 
 </tr> 
	<tr> 
				<td width="25%" class="NoiseFooterTD">solusudirrfa1</td> 
				<td width="25%" class="NoiseDataTD"><?php 
				if (! $flagdetallarsoliciusuario) { 
					echo $sbreg [solusudirrfa1]; 
				} 
				?> 
				</td> 
				<td width="25%" class="NoiseFooterTD">solusuciurfa1</td> 
				<td width="25%" class="NoiseDataTD"><?php 
				if (! $flagdetallarsoliciusuario) { 
					echo $sbreg [solusuciurfa1]; 
				} 
				?> 
				</td> 
 </tr> 
	<tr> 
				<td width="25%" class="NoiseFooterTD">solusunomrfa2</td> 
				<td width="25%" class="NoiseDataTD"><?php 
				if (! $flagdetallarsoliciusuario) { 
					echo $sbreg [solusunomrfa2]; 
				} 
				?> 
				</td> 
				<td width="25%" class="NoiseFooterTD">solusuparrfa2</td> 
				<td width="25%" class="NoiseDataTD"><?php 
				if (! $flagdetallarsoliciusuario) { 
					echo $sbreg [solusuparrfa2]; 
				} 
				?> 
				</td> 
 </tr> 
	<tr> 
				<td width="25%" class="NoiseFooterTD">solusutelrfa2</td> 
				<td width="25%" class="NoiseDataTD"><?php 
				if (! $flagdetallarsoliciusuario) { 
					echo $sbreg [solusutelrfa2]; 
				} 
				?> 
				</td> 
				<td width="25%" class="NoiseFooterTD">solusudirrfa2</td> 
				<td width="25%" class="NoiseDataTD"><?php 
				if (! $flagdetallarsoliciusuario) { 
					echo $sbreg [solusudirrfa2]; 
				} 
				?> 
				</td> 
 </tr> 
	<tr> 
				<td width="25%" class="NoiseFooterTD">solusuciurfa2</td> 
				<td width="25%" class="NoiseDataTD"><?php 
				if (! $flagdetallarsoliciusuario) { 
					echo $sbreg [solusuciurfa2]; 
				} 
				?> 
				</td> 
				<td width="25%" class="NoiseFooterTD">solusucupsol</td> 
				<td width="25%" class="NoiseDataTD"><?php 
				if (! $flagdetallarsoliciusuario) { 
					echo $sbreg [solusucupsol]; 
				} 
				?> 
				</td> 
 </tr> 
	<tr> 
				<td width="25%" class="NoiseFooterTD">solusuplasol</td> 
				<td width="25%" class="NoiseDataTD"><?php 
				if (! $flagdetallarsoliciusuario) { 
					echo $sbreg [solusuplasol]; 
				} 
				?> 
				</td> 
				<td width="25%" class="NoiseFooterTD">solusucontac</td> 
				<td width="25%" class="NoiseDataTD"><?php 
				if (! $flagdetallarsoliciusuario) { 
					echo $sbreg [solusucontac]; 
				} 
				?> 
				</td> 
 </tr> 
	<tr> 
				<td width="25%" class="NoiseFooterTD">solusuobserv</td> 
				<td width="25%" class="NoiseDataTD"><?php 
				if (! $flagdetallarsoliciusuario) { 
					echo $sbreg [solusuobserv]; 
				} 
				?> 
				</td> 
				<td width="25%" class="NoiseFooterTD">solusucupsug</td> 
				<td width="25%" class="NoiseDataTD"><?php 
				if (! $flagdetallarsoliciusuario) { 
					echo $sbreg [solusucupsug]; 
				} 
				?> 
				</td> 
 </tr> 
	<tr> 
				<td width="25%" class="NoiseFooterTD">solusucupaut</td> 
				<td width="25%" class="NoiseDataTD"><?php 
				if (! $flagdetallarsoliciusuario) { 
					echo $sbreg [solusucupaut]; 
				} 
				?> 
				</td> 
				<td width="25%" class="NoiseFooterTD">solusuplacon</td> 
				<td width="25%" class="NoiseDataTD"><?php 
				if (! $flagdetallarsoliciusuario) { 
					echo $sbreg [solusuplacon]; 
				} 
				?> 
				</td> 
 </tr> 
	<tr> 
				<td width="25%" class="NoiseFooterTD">solusuobserv1</td> 
				<td width="25%" class="NoiseDataTD"><?php 
				if (! $flagdetallarsoliciusuario) { 
					echo $sbreg [solusuobserv1]; 
				} 
				?> 
				</td> 
				<td width="25%" class="NoiseFooterTD">solusuprecli</td> 
				<td width="25%" class="NoiseDataTD"><?php 
				if (! $flagdetallarsoliciusuario) { 
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
 <input type="hidden" name="flagdetallarsoliciusuario" value="1"> 
<input type="hidden" name="sourcetable" value="<?php echo $sourcetable;	?>"> 
<input type="hidden" name="sourceaction" value="detallar"> 
<input type="hidden" name="acciondetallarsoliciusuario"> 
<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
<input type="hidden" name="columnas" value="tisouscodigo, 
solusucodigo, 
clausucodigo, 
solusufecha, 
solusuperaca, 
solusumatmer, 
solusumatfec, 
solusudircom, 
solusutelcom, 
solusufaxcom, 
solusunacexp, 
solusuprisuc, 
solusulocprop, 
solusuareloc, 
solusuarrend, 
solusutelarr, 
solusuantneg, 
solusuacteco, 
solusuactcod, 
solusutipinm, 
solusumatinm, 
solusudirecc, 
solusuvalcom, 
solusutipinm1, 
solusumatinm1, 
solusudirecc1, 
solusuvalcom1, 
solusuvehicu, 
solusuvehmod, 
solusuvehpla, 
solusuprefav, 
solusuvevaco, 
solusuvehicu1, 
solusuvehmod1, 
solusuvehpla1, 
solusuprefav1, 
solusuvevaco1, 
solusunomrec, 
solusucuprec, 
solusutelrec, 
solusudirrec, 
solusuciurec, 
solusunomrec1, 
solusucuprec1, 
solusutelrec1, 
solusudirrec1, 
solusuciurec1, 
solusunomrec2, 
solusucuprec2, 
solusutelrec2, 
solusudirrec2, 
solusuciurec2, 
solusubanco, 
solusutipcue, 
solusunumcue, 
solususucurs, 
solusutelefo, 
solusuciudad, 
solusubanco1, 
solusutipcue1, 
solusunumcue1, 
solususucurs1, 
solusutelefo1, 
solusuciudad1, 
solusubanco2, 
solusutipcue2, 
solusunumcue2, 
solususucurs2, 
solusutelefo2, 
solusuciudad2, 
solusunomrfa, 
solusuparrfa, 
solusutelrfa, 
solusudirrfa, 
solusuciurfa, 
solusunomrfa1, 
solusuparrfa1, 
solusutelrfa1, 
solusudirrfa1, 
solusuciurfa1, 
solusunomrfa2, 
solusuparrfa2, 
solusutelrfa2, 
solusudirrfa2, 
solusuciurfa2, 
solusucupsol, 
solusuplasol, 
solusucontac, 
solusuobserv, 
solusucupsug, 
solusucupaut, 
solusuplacon, 
solusuobserv1, 
solusuprecli 
<input type="hidden" name="tisouscodigo" value="<?php if ($accionconsultarsoliciusuario) echo $tisouscodigo; ?>"> 
<input type="hidden" name="solusucodigo" value="<?php if ($accionconsultarsoliciusuario) echo $solusucodigo; ?>"> 
<input type="hidden" name="clausucodigo" value="<?php if ($accionconsultarsoliciusuario) echo $clausucodigo; ?>"> 
<input type="hidden" name="solusufecha" value="<?php if ($accionconsultarsoliciusuario) echo $solusufecha; ?>"> 
<input type="hidden" name="solusuperaca" value="<?php if ($accionconsultarsoliciusuario) echo $solusuperaca; ?>"> 
<input type="hidden" name="solusumatmer" value="<?php if ($accionconsultarsoliciusuario) echo $solusumatmer; ?>"> 
<input type="hidden" name="solusumatfec" value="<?php if ($accionconsultarsoliciusuario) echo $solusumatfec; ?>"> 
<input type="hidden" name="solusudircom" value="<?php if ($accionconsultarsoliciusuario) echo $solusudircom; ?>"> 
<input type="hidden" name="solusutelcom" value="<?php if ($accionconsultarsoliciusuario) echo $solusutelcom; ?>"> 
<input type="hidden" name="solusufaxcom" value="<?php if ($accionconsultarsoliciusuario) echo $solusufaxcom; ?>"> 
<input type="hidden" name="solusunacexp" value="<?php if ($accionconsultarsoliciusuario) echo $solusunacexp; ?>"> 
<input type="hidden" name="solusuprisuc" value="<?php if ($accionconsultarsoliciusuario) echo $solusuprisuc; ?>"> 
<input type="hidden" name="solusulocprop" value="<?php if ($accionconsultarsoliciusuario) echo $solusulocprop; ?>"> 
<input type="hidden" name="solusuareloc" value="<?php if ($accionconsultarsoliciusuario) echo $solusuareloc; ?>"> 
<input type="hidden" name="solusuarrend" value="<?php if ($accionconsultarsoliciusuario) echo $solusuarrend; ?>"> 
<input type="hidden" name="solusutelarr" value="<?php if ($accionconsultarsoliciusuario) echo $solusutelarr; ?>"> 
<input type="hidden" name="solusuantneg" value="<?php if ($accionconsultarsoliciusuario) echo $solusuantneg; ?>"> 
<input type="hidden" name="solusuacteco" value="<?php if ($accionconsultarsoliciusuario) echo $solusuacteco; ?>"> 
<input type="hidden" name="solusuactcod" value="<?php if ($accionconsultarsoliciusuario) echo $solusuactcod; ?>"> 
<input type="hidden" name="solusutipinm" value="<?php if ($accionconsultarsoliciusuario) echo $solusutipinm; ?>"> 
<input type="hidden" name="solusumatinm" value="<?php if ($accionconsultarsoliciusuario) echo $solusumatinm; ?>"> 
<input type="hidden" name="solusudirecc" value="<?php if ($accionconsultarsoliciusuario) echo $solusudirecc; ?>"> 
<input type="hidden" name="solusuvalcom" value="<?php if ($accionconsultarsoliciusuario) echo $solusuvalcom; ?>"> 
<input type="hidden" name="solusutipinm1" value="<?php if ($accionconsultarsoliciusuario) echo $solusutipinm1; ?>"> 
<input type="hidden" name="solusumatinm1" value="<?php if ($accionconsultarsoliciusuario) echo $solusumatinm1; ?>"> 
<input type="hidden" name="solusudirecc1" value="<?php if ($accionconsultarsoliciusuario) echo $solusudirecc1; ?>"> 
<input type="hidden" name="solusuvalcom1" value="<?php if ($accionconsultarsoliciusuario) echo $solusuvalcom1; ?>"> 
<input type="hidden" name="solusuvehicu" value="<?php if ($accionconsultarsoliciusuario) echo $solusuvehicu; ?>"> 
<input type="hidden" name="solusuvehmod" value="<?php if ($accionconsultarsoliciusuario) echo $solusuvehmod; ?>"> 
<input type="hidden" name="solusuvehpla" value="<?php if ($accionconsultarsoliciusuario) echo $solusuvehpla; ?>"> 
<input type="hidden" name="solusuprefav" value="<?php if ($accionconsultarsoliciusuario) echo $solusuprefav; ?>"> 
<input type="hidden" name="solusuvevaco" value="<?php if ($accionconsultarsoliciusuario) echo $solusuvevaco; ?>"> 
<input type="hidden" name="solusuvehicu1" value="<?php if ($accionconsultarsoliciusuario) echo $solusuvehicu1; ?>"> 
<input type="hidden" name="solusuvehmod1" value="<?php if ($accionconsultarsoliciusuario) echo $solusuvehmod1; ?>"> 
<input type="hidden" name="solusuvehpla1" value="<?php if ($accionconsultarsoliciusuario) echo $solusuvehpla1; ?>"> 
<input type="hidden" name="solusuprefav1" value="<?php if ($accionconsultarsoliciusuario) echo $solusuprefav1; ?>"> 
<input type="hidden" name="solusuvevaco1" value="<?php if ($accionconsultarsoliciusuario) echo $solusuvevaco1; ?>"> 
<input type="hidden" name="solusunomrec" value="<?php if ($accionconsultarsoliciusuario) echo $solusunomrec; ?>"> 
<input type="hidden" name="solusucuprec" value="<?php if ($accionconsultarsoliciusuario) echo $solusucuprec; ?>"> 
<input type="hidden" name="solusutelrec" value="<?php if ($accionconsultarsoliciusuario) echo $solusutelrec; ?>"> 
<input type="hidden" name="solusudirrec" value="<?php if ($accionconsultarsoliciusuario) echo $solusudirrec; ?>"> 
<input type="hidden" name="solusuciurec" value="<?php if ($accionconsultarsoliciusuario) echo $solusuciurec; ?>"> 
<input type="hidden" name="solusunomrec1" value="<?php if ($accionconsultarsoliciusuario) echo $solusunomrec1; ?>"> 
<input type="hidden" name="solusucuprec1" value="<?php if ($accionconsultarsoliciusuario) echo $solusucuprec1; ?>"> 
<input type="hidden" name="solusutelrec1" value="<?php if ($accionconsultarsoliciusuario) echo $solusutelrec1; ?>"> 
<input type="hidden" name="solusudirrec1" value="<?php if ($accionconsultarsoliciusuario) echo $solusudirrec1; ?>"> 
<input type="hidden" name="solusuciurec1" value="<?php if ($accionconsultarsoliciusuario) echo $solusuciurec1; ?>"> 
<input type="hidden" name="solusunomrec2" value="<?php if ($accionconsultarsoliciusuario) echo $solusunomrec2; ?>"> 
<input type="hidden" name="solusucuprec2" value="<?php if ($accionconsultarsoliciusuario) echo $solusucuprec2; ?>"> 
<input type="hidden" name="solusutelrec2" value="<?php if ($accionconsultarsoliciusuario) echo $solusutelrec2; ?>"> 
<input type="hidden" name="solusudirrec2" value="<?php if ($accionconsultarsoliciusuario) echo $solusudirrec2; ?>"> 
<input type="hidden" name="solusuciurec2" value="<?php if ($accionconsultarsoliciusuario) echo $solusuciurec2; ?>"> 
<input type="hidden" name="solusubanco" value="<?php if ($accionconsultarsoliciusuario) echo $solusubanco; ?>"> 
<input type="hidden" name="solusutipcue" value="<?php if ($accionconsultarsoliciusuario) echo $solusutipcue; ?>"> 
<input type="hidden" name="solusunumcue" value="<?php if ($accionconsultarsoliciusuario) echo $solusunumcue; ?>"> 
<input type="hidden" name="solususucurs" value="<?php if ($accionconsultarsoliciusuario) echo $solususucurs; ?>"> 
<input type="hidden" name="solusutelefo" value="<?php if ($accionconsultarsoliciusuario) echo $solusutelefo; ?>"> 
<input type="hidden" name="solusuciudad" value="<?php if ($accionconsultarsoliciusuario) echo $solusuciudad; ?>"> 
<input type="hidden" name="solusubanco1" value="<?php if ($accionconsultarsoliciusuario) echo $solusubanco1; ?>"> 
<input type="hidden" name="solusutipcue1" value="<?php if ($accionconsultarsoliciusuario) echo $solusutipcue1; ?>"> 
<input type="hidden" name="solusunumcue1" value="<?php if ($accionconsultarsoliciusuario) echo $solusunumcue1; ?>"> 
<input type="hidden" name="solususucurs1" value="<?php if ($accionconsultarsoliciusuario) echo $solususucurs1; ?>"> 
<input type="hidden" name="solusutelefo1" value="<?php if ($accionconsultarsoliciusuario) echo $solusutelefo1; ?>"> 
<input type="hidden" name="solusuciudad1" value="<?php if ($accionconsultarsoliciusuario) echo $solusuciudad1; ?>"> 
<input type="hidden" name="solusubanco2" value="<?php if ($accionconsultarsoliciusuario) echo $solusubanco2; ?>"> 
<input type="hidden" name="solusutipcue2" value="<?php if ($accionconsultarsoliciusuario) echo $solusutipcue2; ?>"> 
<input type="hidden" name="solusunumcue2" value="<?php if ($accionconsultarsoliciusuario) echo $solusunumcue2; ?>"> 
<input type="hidden" name="solususucurs2" value="<?php if ($accionconsultarsoliciusuario) echo $solususucurs2; ?>"> 
<input type="hidden" name="solusutelefo2" value="<?php if ($accionconsultarsoliciusuario) echo $solusutelefo2; ?>"> 
<input type="hidden" name="solusuciudad2" value="<?php if ($accionconsultarsoliciusuario) echo $solusuciudad2; ?>"> 
<input type="hidden" name="solusunomrfa" value="<?php if ($accionconsultarsoliciusuario) echo $solusunomrfa; ?>"> 
<input type="hidden" name="solusuparrfa" value="<?php if ($accionconsultarsoliciusuario) echo $solusuparrfa; ?>"> 
<input type="hidden" name="solusutelrfa" value="<?php if ($accionconsultarsoliciusuario) echo $solusutelrfa; ?>"> 
<input type="hidden" name="solusudirrfa" value="<?php if ($accionconsultarsoliciusuario) echo $solusudirrfa; ?>"> 
<input type="hidden" name="solusuciurfa" value="<?php if ($accionconsultarsoliciusuario) echo $solusuciurfa; ?>"> 
<input type="hidden" name="solusunomrfa1" value="<?php if ($accionconsultarsoliciusuario) echo $solusunomrfa1; ?>"> 
<input type="hidden" name="solusuparrfa1" value="<?php if ($accionconsultarsoliciusuario) echo $solusuparrfa1; ?>"> 
<input type="hidden" name="solusutelrfa1" value="<?php if ($accionconsultarsoliciusuario) echo $solusutelrfa1; ?>"> 
<input type="hidden" name="solusudirrfa1" value="<?php if ($accionconsultarsoliciusuario) echo $solusudirrfa1; ?>"> 
<input type="hidden" name="solusuciurfa1" value="<?php if ($accionconsultarsoliciusuario) echo $solusuciurfa1; ?>"> 
<input type="hidden" name="solusunomrfa2" value="<?php if ($accionconsultarsoliciusuario) echo $solusunomrfa2; ?>"> 
<input type="hidden" name="solusuparrfa2" value="<?php if ($accionconsultarsoliciusuario) echo $solusuparrfa2; ?>"> 
<input type="hidden" name="solusutelrfa2" value="<?php if ($accionconsultarsoliciusuario) echo $solusutelrfa2; ?>"> 
<input type="hidden" name="solusudirrfa2" value="<?php if ($accionconsultarsoliciusuario) echo $solusudirrfa2; ?>"> 
<input type="hidden" name="solusuciurfa2" value="<?php if ($accionconsultarsoliciusuario) echo $solusuciurfa2; ?>"> 
<input type="hidden" name="solusucupsol" value="<?php if ($accionconsultarsoliciusuario) echo $solusucupsol; ?>"> 
<input type="hidden" name="solusuplasol" value="<?php if ($accionconsultarsoliciusuario) echo $solusuplasol; ?>"> 
<input type="hidden" name="solusucontac" value="<?php if ($accionconsultarsoliciusuario) echo $solusucontac; ?>"> 
<input type="hidden" name="solusuobserv" value="<?php if ($accionconsultarsoliciusuario) echo $solusuobserv; ?>"> 
<input type="hidden" name="solusucupsug" value="<?php if ($accionconsultarsoliciusuario) echo $solusucupsug; ?>"> 
<input type="hidden" name="solusucupaut" value="<?php if ($accionconsultarsoliciusuario) echo $solusucupaut; ?>"> 
<input type="hidden" name="solusuplacon" value="<?php if ($accionconsultarsoliciusuario) echo $solusuplacon; ?>"> 
<input type="hidden" name="solusuobserv1" value="<?php if ($accionconsultarsoliciusuario) echo $solusuobserv1; ?>"> 
<input type="hidden" name="solusuprecli" value="<?php if ($accionconsultarsoliciusuario) echo $solusuprecli; ?>"> 
<input type="hidden" name="accionconsultar" value="<?php echo $accionconsultar;	?>"> 
</form> 
</body> 
<?php 
if (! $codigo) { 
    echo " -->"; 
} 
?> 
</html> 
