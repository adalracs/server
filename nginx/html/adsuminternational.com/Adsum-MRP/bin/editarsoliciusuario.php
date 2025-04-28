<?php 
include ('../src/FunGen/sesion/fncvalses.php'); 
if ($accioneditarsoliciusuario) { 
	include ('editasoliciusuario.php'); 
	$flageditarsoliciusuario = 1; 
} 
if (! $flageditarsoliciusuario) { 
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
<title>Editar registro de soliciusuario</title> 
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
		<td class="ui-widget-header">Editar registro</td></tr> 
	<tr> 
		<td> 
		<table width="95%" border="0" cellspacing="1" cellpadding="1" align="center"> 
				<td width="59%" class="NoiseDataTD"><?php 
				if (! $flageditarsoliciusuario) { 
					echo $sbreg [solusucodigo]; 
				} 
				?></td> 
	<tr> 
				<td width="25%" class="NoiseFooterTD"> 
				<?php if ($campnomb == "tisouscodigo") { $tisouscodigo = null; echo "*";}?>tisouscodigo</td> 
				<td width="25%"> 
				<input type="text" name="tisouscodigo"	value="<?php if(!$flageditarsoliciusuario){ echo $sbreg[tisouscodigo];}else{ echo $tisouscodigo; }?>"> 
				</td> 
				<td width="25%" class="NoiseFooterTD"> 
				<?php if ($campnomb == "solusucodigo") { $solusucodigo = null; echo "*";}?>solusucodigo</td> 
				<td width="25%"> 
				<input type="text" name="solusucodigo"	value="<?php if(!$flageditarsoliciusuario){ echo $sbreg[solusucodigo];}else{ echo $solusucodigo; }?>"> 
				</td> 
 </tr> 
	<tr> 
				<td width="25%" class="NoiseFooterTD"> 
				<?php if ($campnomb == "clausucodigo") { $clausucodigo = null; echo "*";}?>clausucodigo</td> 
				<td width="25%"> 
				<input type="text" name="clausucodigo"	value="<?php if(!$flageditarsoliciusuario){ echo $sbreg[clausucodigo];}else{ echo $clausucodigo; }?>"> 
				</td> 
				<td width="25%" class="NoiseFooterTD"> 
				<?php if ($campnomb == "solusufecha") { $solusufecha = null; echo "*";}?>solusufecha</td> 
				<td width="25%"> 
				<input type="text" name="solusufecha"	value="<?php if(!$flageditarsoliciusuario){ echo $sbreg[solusufecha];}else{ echo $solusufecha; }?>"> 
				</td> 
 </tr> 
	<tr> 
				<td width="25%" class="NoiseFooterTD"> 
				<?php if ($campnomb == "solusuperaca") { $solusuperaca = null; echo "*";}?>solusuperaca</td> 
				<td width="25%"> 
				<input type="text" name="solusuperaca"	value="<?php if(!$flageditarsoliciusuario){ echo $sbreg[solusuperaca];}else{ echo $solusuperaca; }?>"> 
				</td> 
				<td width="25%" class="NoiseFooterTD"> 
				<?php if ($campnomb == "solusumatmer") { $solusumatmer = null; echo "*";}?>solusumatmer</td> 
				<td width="25%"> 
				<input type="text" name="solusumatmer"	value="<?php if(!$flageditarsoliciusuario){ echo $sbreg[solusumatmer];}else{ echo $solusumatmer; }?>"> 
				</td> 
 </tr> 
	<tr> 
				<td width="25%" class="NoiseFooterTD"> 
				<?php if ($campnomb == "solusumatfec") { $solusumatfec = null; echo "*";}?>solusumatfec</td> 
				<td width="25%"> 
				<input type="text" name="solusumatfec"	value="<?php if(!$flageditarsoliciusuario){ echo $sbreg[solusumatfec];}else{ echo $solusumatfec; }?>"> 
				</td> 
				<td width="25%" class="NoiseFooterTD"> 
				<?php if ($campnomb == "solusudircom") { $solusudircom = null; echo "*";}?>solusudircom</td> 
				<td width="25%"> 
				<input type="text" name="solusudircom"	value="<?php if(!$flageditarsoliciusuario){ echo $sbreg[solusudircom];}else{ echo $solusudircom; }?>"> 
				</td> 
 </tr> 
	<tr> 
				<td width="25%" class="NoiseFooterTD"> 
				<?php if ($campnomb == "solusutelcom") { $solusutelcom = null; echo "*";}?>solusutelcom</td> 
				<td width="25%"> 
				<input type="text" name="solusutelcom"	value="<?php if(!$flageditarsoliciusuario){ echo $sbreg[solusutelcom];}else{ echo $solusutelcom; }?>"> 
				</td> 
				<td width="25%" class="NoiseFooterTD"> 
				<?php if ($campnomb == "solusufaxcom") { $solusufaxcom = null; echo "*";}?>solusufaxcom</td> 
				<td width="25%"> 
				<input type="text" name="solusufaxcom"	value="<?php if(!$flageditarsoliciusuario){ echo $sbreg[solusufaxcom];}else{ echo $solusufaxcom; }?>"> 
				</td> 
 </tr> 
	<tr> 
				<td width="25%" class="NoiseFooterTD"> 
				<?php if ($campnomb == "solusunacexp") { $solusunacexp = null; echo "*";}?>solusunacexp</td> 
				<td width="25%"> 
				<input type="text" name="solusunacexp"	value="<?php if(!$flageditarsoliciusuario){ echo $sbreg[solusunacexp];}else{ echo $solusunacexp; }?>"> 
				</td> 
				<td width="25%" class="NoiseFooterTD"> 
				<?php if ($campnomb == "solusuprisuc") { $solusuprisuc = null; echo "*";}?>solusuprisuc</td> 
				<td width="25%"> 
				<input type="text" name="solusuprisuc"	value="<?php if(!$flageditarsoliciusuario){ echo $sbreg[solusuprisuc];}else{ echo $solusuprisuc; }?>"> 
				</td> 
 </tr> 
	<tr> 
				<td width="25%" class="NoiseFooterTD"> 
				<?php if ($campnomb == "solusulocprop") { $solusulocprop = null; echo "*";}?>solusulocprop</td> 
				<td width="25%"> 
				<input type="text" name="solusulocprop"	value="<?php if(!$flageditarsoliciusuario){ echo $sbreg[solusulocprop];}else{ echo $solusulocprop; }?>"> 
				</td> 
				<td width="25%" class="NoiseFooterTD"> 
				<?php if ($campnomb == "solusuareloc") { $solusuareloc = null; echo "*";}?>solusuareloc</td> 
				<td width="25%"> 
				<input type="text" name="solusuareloc"	value="<?php if(!$flageditarsoliciusuario){ echo $sbreg[solusuareloc];}else{ echo $solusuareloc; }?>"> 
				</td> 
 </tr> 
	<tr> 
				<td width="25%" class="NoiseFooterTD"> 
				<?php if ($campnomb == "solusuarrend") { $solusuarrend = null; echo "*";}?>solusuarrend</td> 
				<td width="25%"> 
				<input type="text" name="solusuarrend"	value="<?php if(!$flageditarsoliciusuario){ echo $sbreg[solusuarrend];}else{ echo $solusuarrend; }?>"> 
				</td> 
				<td width="25%" class="NoiseFooterTD"> 
				<?php if ($campnomb == "solusutelarr") { $solusutelarr = null; echo "*";}?>solusutelarr</td> 
				<td width="25%"> 
				<input type="text" name="solusutelarr"	value="<?php if(!$flageditarsoliciusuario){ echo $sbreg[solusutelarr];}else{ echo $solusutelarr; }?>"> 
				</td> 
 </tr> 
	<tr> 
				<td width="25%" class="NoiseFooterTD"> 
				<?php if ($campnomb == "solusuantneg") { $solusuantneg = null; echo "*";}?>solusuantneg</td> 
				<td width="25%"> 
				<input type="text" name="solusuantneg"	value="<?php if(!$flageditarsoliciusuario){ echo $sbreg[solusuantneg];}else{ echo $solusuantneg; }?>"> 
				</td> 
				<td width="25%" class="NoiseFooterTD"> 
				<?php if ($campnomb == "solusuacteco") { $solusuacteco = null; echo "*";}?>solusuacteco</td> 
				<td width="25%"> 
				<input type="text" name="solusuacteco"	value="<?php if(!$flageditarsoliciusuario){ echo $sbreg[solusuacteco];}else{ echo $solusuacteco; }?>"> 
				</td> 
 </tr> 
	<tr> 
				<td width="25%" class="NoiseFooterTD"> 
				<?php if ($campnomb == "solusuactcod") { $solusuactcod = null; echo "*";}?>solusuactcod</td> 
				<td width="25%"> 
				<input type="text" name="solusuactcod"	value="<?php if(!$flageditarsoliciusuario){ echo $sbreg[solusuactcod];}else{ echo $solusuactcod; }?>"> 
				</td> 
				<td width="25%" class="NoiseFooterTD"> 
				<?php if ($campnomb == "solusutipinm") { $solusutipinm = null; echo "*";}?>solusutipinm</td> 
				<td width="25%"> 
				<input type="text" name="solusutipinm"	value="<?php if(!$flageditarsoliciusuario){ echo $sbreg[solusutipinm];}else{ echo $solusutipinm; }?>"> 
				</td> 
 </tr> 
	<tr> 
				<td width="25%" class="NoiseFooterTD"> 
				<?php if ($campnomb == "solusumatinm") { $solusumatinm = null; echo "*";}?>solusumatinm</td> 
				<td width="25%"> 
				<input type="text" name="solusumatinm"	value="<?php if(!$flageditarsoliciusuario){ echo $sbreg[solusumatinm];}else{ echo $solusumatinm; }?>"> 
				</td> 
				<td width="25%" class="NoiseFooterTD"> 
				<?php if ($campnomb == "solusudirecc") { $solusudirecc = null; echo "*";}?>solusudirecc</td> 
				<td width="25%"> 
				<input type="text" name="solusudirecc"	value="<?php if(!$flageditarsoliciusuario){ echo $sbreg[solusudirecc];}else{ echo $solusudirecc; }?>"> 
				</td> 
 </tr> 
	<tr> 
				<td width="25%" class="NoiseFooterTD"> 
				<?php if ($campnomb == "solusuvalcom") { $solusuvalcom = null; echo "*";}?>solusuvalcom</td> 
				<td width="25%"> 
				<input type="text" name="solusuvalcom"	value="<?php if(!$flageditarsoliciusuario){ echo $sbreg[solusuvalcom];}else{ echo $solusuvalcom; }?>"> 
				</td> 
				<td width="25%" class="NoiseFooterTD"> 
				<?php if ($campnomb == "solusutipinm1") { $solusutipinm1 = null; echo "*";}?>solusutipinm1</td> 
				<td width="25%"> 
				<input type="text" name="solusutipinm1"	value="<?php if(!$flageditarsoliciusuario){ echo $sbreg[solusutipinm1];}else{ echo $solusutipinm1; }?>"> 
				</td> 
 </tr> 
	<tr> 
				<td width="25%" class="NoiseFooterTD"> 
				<?php if ($campnomb == "solusumatinm1") { $solusumatinm1 = null; echo "*";}?>solusumatinm1</td> 
				<td width="25%"> 
				<input type="text" name="solusumatinm1"	value="<?php if(!$flageditarsoliciusuario){ echo $sbreg[solusumatinm1];}else{ echo $solusumatinm1; }?>"> 
				</td> 
				<td width="25%" class="NoiseFooterTD"> 
				<?php if ($campnomb == "solusudirecc1") { $solusudirecc1 = null; echo "*";}?>solusudirecc1</td> 
				<td width="25%"> 
				<input type="text" name="solusudirecc1"	value="<?php if(!$flageditarsoliciusuario){ echo $sbreg[solusudirecc1];}else{ echo $solusudirecc1; }?>"> 
				</td> 
 </tr> 
	<tr> 
				<td width="25%" class="NoiseFooterTD"> 
				<?php if ($campnomb == "solusuvalcom1") { $solusuvalcom1 = null; echo "*";}?>solusuvalcom1</td> 
				<td width="25%"> 
				<input type="text" name="solusuvalcom1"	value="<?php if(!$flageditarsoliciusuario){ echo $sbreg[solusuvalcom1];}else{ echo $solusuvalcom1; }?>"> 
				</td> 
				<td width="25%" class="NoiseFooterTD"> 
				<?php if ($campnomb == "solusuvehicu") { $solusuvehicu = null; echo "*";}?>solusuvehicu</td> 
				<td width="25%"> 
				<input type="text" name="solusuvehicu"	value="<?php if(!$flageditarsoliciusuario){ echo $sbreg[solusuvehicu];}else{ echo $solusuvehicu; }?>"> 
				</td> 
 </tr> 
	<tr> 
				<td width="25%" class="NoiseFooterTD"> 
				<?php if ($campnomb == "solusuvehmod") { $solusuvehmod = null; echo "*";}?>solusuvehmod</td> 
				<td width="25%"> 
				<input type="text" name="solusuvehmod"	value="<?php if(!$flageditarsoliciusuario){ echo $sbreg[solusuvehmod];}else{ echo $solusuvehmod; }?>"> 
				</td> 
				<td width="25%" class="NoiseFooterTD"> 
				<?php if ($campnomb == "solusuvehpla") { $solusuvehpla = null; echo "*";}?>solusuvehpla</td> 
				<td width="25%"> 
				<input type="text" name="solusuvehpla"	value="<?php if(!$flageditarsoliciusuario){ echo $sbreg[solusuvehpla];}else{ echo $solusuvehpla; }?>"> 
				</td> 
 </tr> 
	<tr> 
				<td width="25%" class="NoiseFooterTD"> 
				<?php if ($campnomb == "solusuprefav") { $solusuprefav = null; echo "*";}?>solusuprefav</td> 
				<td width="25%"> 
				<input type="text" name="solusuprefav"	value="<?php if(!$flageditarsoliciusuario){ echo $sbreg[solusuprefav];}else{ echo $solusuprefav; }?>"> 
				</td> 
				<td width="25%" class="NoiseFooterTD"> 
				<?php if ($campnomb == "solusuvevaco") { $solusuvevaco = null; echo "*";}?>solusuvevaco</td> 
				<td width="25%"> 
				<input type="text" name="solusuvevaco"	value="<?php if(!$flageditarsoliciusuario){ echo $sbreg[solusuvevaco];}else{ echo $solusuvevaco; }?>"> 
				</td> 
 </tr> 
	<tr> 
				<td width="25%" class="NoiseFooterTD"> 
				<?php if ($campnomb == "solusuvehicu1") { $solusuvehicu1 = null; echo "*";}?>solusuvehicu1</td> 
				<td width="25%"> 
				<input type="text" name="solusuvehicu1"	value="<?php if(!$flageditarsoliciusuario){ echo $sbreg[solusuvehicu1];}else{ echo $solusuvehicu1; }?>"> 
				</td> 
				<td width="25%" class="NoiseFooterTD"> 
				<?php if ($campnomb == "solusuvehmod1") { $solusuvehmod1 = null; echo "*";}?>solusuvehmod1</td> 
				<td width="25%"> 
				<input type="text" name="solusuvehmod1"	value="<?php if(!$flageditarsoliciusuario){ echo $sbreg[solusuvehmod1];}else{ echo $solusuvehmod1; }?>"> 
				</td> 
 </tr> 
	<tr> 
				<td width="25%" class="NoiseFooterTD"> 
				<?php if ($campnomb == "solusuvehpla1") { $solusuvehpla1 = null; echo "*";}?>solusuvehpla1</td> 
				<td width="25%"> 
				<input type="text" name="solusuvehpla1"	value="<?php if(!$flageditarsoliciusuario){ echo $sbreg[solusuvehpla1];}else{ echo $solusuvehpla1; }?>"> 
				</td> 
				<td width="25%" class="NoiseFooterTD"> 
				<?php if ($campnomb == "solusuprefav1") { $solusuprefav1 = null; echo "*";}?>solusuprefav1</td> 
				<td width="25%"> 
				<input type="text" name="solusuprefav1"	value="<?php if(!$flageditarsoliciusuario){ echo $sbreg[solusuprefav1];}else{ echo $solusuprefav1; }?>"> 
				</td> 
 </tr> 
	<tr> 
				<td width="25%" class="NoiseFooterTD"> 
				<?php if ($campnomb == "solusuvevaco1") { $solusuvevaco1 = null; echo "*";}?>solusuvevaco1</td> 
				<td width="25%"> 
				<input type="text" name="solusuvevaco1"	value="<?php if(!$flageditarsoliciusuario){ echo $sbreg[solusuvevaco1];}else{ echo $solusuvevaco1; }?>"> 
				</td> 
				<td width="25%" class="NoiseFooterTD"> 
				<?php if ($campnomb == "solusunomrec") { $solusunomrec = null; echo "*";}?>solusunomrec</td> 
				<td width="25%"> 
				<input type="text" name="solusunomrec"	value="<?php if(!$flageditarsoliciusuario){ echo $sbreg[solusunomrec];}else{ echo $solusunomrec; }?>"> 
				</td> 
 </tr> 
	<tr> 
				<td width="25%" class="NoiseFooterTD"> 
				<?php if ($campnomb == "solusucuprec") { $solusucuprec = null; echo "*";}?>solusucuprec</td> 
				<td width="25%"> 
				<input type="text" name="solusucuprec"	value="<?php if(!$flageditarsoliciusuario){ echo $sbreg[solusucuprec];}else{ echo $solusucuprec; }?>"> 
				</td> 
				<td width="25%" class="NoiseFooterTD"> 
				<?php if ($campnomb == "solusutelrec") { $solusutelrec = null; echo "*";}?>solusutelrec</td> 
				<td width="25%"> 
				<input type="text" name="solusutelrec"	value="<?php if(!$flageditarsoliciusuario){ echo $sbreg[solusutelrec];}else{ echo $solusutelrec; }?>"> 
				</td> 
 </tr> 
	<tr> 
				<td width="25%" class="NoiseFooterTD"> 
				<?php if ($campnomb == "solusudirrec") { $solusudirrec = null; echo "*";}?>solusudirrec</td> 
				<td width="25%"> 
				<input type="text" name="solusudirrec"	value="<?php if(!$flageditarsoliciusuario){ echo $sbreg[solusudirrec];}else{ echo $solusudirrec; }?>"> 
				</td> 
				<td width="25%" class="NoiseFooterTD"> 
				<?php if ($campnomb == "solusuciurec") { $solusuciurec = null; echo "*";}?>solusuciurec</td> 
				<td width="25%"> 
				<input type="text" name="solusuciurec"	value="<?php if(!$flageditarsoliciusuario){ echo $sbreg[solusuciurec];}else{ echo $solusuciurec; }?>"> 
				</td> 
 </tr> 
	<tr> 
				<td width="25%" class="NoiseFooterTD"> 
				<?php if ($campnomb == "solusunomrec1") { $solusunomrec1 = null; echo "*";}?>solusunomrec1</td> 
				<td width="25%"> 
				<input type="text" name="solusunomrec1"	value="<?php if(!$flageditarsoliciusuario){ echo $sbreg[solusunomrec1];}else{ echo $solusunomrec1; }?>"> 
				</td> 
				<td width="25%" class="NoiseFooterTD"> 
				<?php if ($campnomb == "solusucuprec1") { $solusucuprec1 = null; echo "*";}?>solusucuprec1</td> 
				<td width="25%"> 
				<input type="text" name="solusucuprec1"	value="<?php if(!$flageditarsoliciusuario){ echo $sbreg[solusucuprec1];}else{ echo $solusucuprec1; }?>"> 
				</td> 
 </tr> 
	<tr> 
				<td width="25%" class="NoiseFooterTD"> 
				<?php if ($campnomb == "solusutelrec1") { $solusutelrec1 = null; echo "*";}?>solusutelrec1</td> 
				<td width="25%"> 
				<input type="text" name="solusutelrec1"	value="<?php if(!$flageditarsoliciusuario){ echo $sbreg[solusutelrec1];}else{ echo $solusutelrec1; }?>"> 
				</td> 
				<td width="25%" class="NoiseFooterTD"> 
				<?php if ($campnomb == "solusudirrec1") { $solusudirrec1 = null; echo "*";}?>solusudirrec1</td> 
				<td width="25%"> 
				<input type="text" name="solusudirrec1"	value="<?php if(!$flageditarsoliciusuario){ echo $sbreg[solusudirrec1];}else{ echo $solusudirrec1; }?>"> 
				</td> 
 </tr> 
	<tr> 
				<td width="25%" class="NoiseFooterTD"> 
				<?php if ($campnomb == "solusuciurec1") { $solusuciurec1 = null; echo "*";}?>solusuciurec1</td> 
				<td width="25%"> 
				<input type="text" name="solusuciurec1"	value="<?php if(!$flageditarsoliciusuario){ echo $sbreg[solusuciurec1];}else{ echo $solusuciurec1; }?>"> 
				</td> 
				<td width="25%" class="NoiseFooterTD"> 
				<?php if ($campnomb == "solusunomrec2") { $solusunomrec2 = null; echo "*";}?>solusunomrec2</td> 
				<td width="25%"> 
				<input type="text" name="solusunomrec2"	value="<?php if(!$flageditarsoliciusuario){ echo $sbreg[solusunomrec2];}else{ echo $solusunomrec2; }?>"> 
				</td> 
 </tr> 
	<tr> 
				<td width="25%" class="NoiseFooterTD"> 
				<?php if ($campnomb == "solusucuprec2") { $solusucuprec2 = null; echo "*";}?>solusucuprec2</td> 
				<td width="25%"> 
				<input type="text" name="solusucuprec2"	value="<?php if(!$flageditarsoliciusuario){ echo $sbreg[solusucuprec2];}else{ echo $solusucuprec2; }?>"> 
				</td> 
				<td width="25%" class="NoiseFooterTD"> 
				<?php if ($campnomb == "solusutelrec2") { $solusutelrec2 = null; echo "*";}?>solusutelrec2</td> 
				<td width="25%"> 
				<input type="text" name="solusutelrec2"	value="<?php if(!$flageditarsoliciusuario){ echo $sbreg[solusutelrec2];}else{ echo $solusutelrec2; }?>"> 
				</td> 
 </tr> 
	<tr> 
				<td width="25%" class="NoiseFooterTD"> 
				<?php if ($campnomb == "solusudirrec2") { $solusudirrec2 = null; echo "*";}?>solusudirrec2</td> 
				<td width="25%"> 
				<input type="text" name="solusudirrec2"	value="<?php if(!$flageditarsoliciusuario){ echo $sbreg[solusudirrec2];}else{ echo $solusudirrec2; }?>"> 
				</td> 
				<td width="25%" class="NoiseFooterTD"> 
				<?php if ($campnomb == "solusuciurec2") { $solusuciurec2 = null; echo "*";}?>solusuciurec2</td> 
				<td width="25%"> 
				<input type="text" name="solusuciurec2"	value="<?php if(!$flageditarsoliciusuario){ echo $sbreg[solusuciurec2];}else{ echo $solusuciurec2; }?>"> 
				</td> 
 </tr> 
	<tr> 
				<td width="25%" class="NoiseFooterTD"> 
				<?php if ($campnomb == "solusubanco") { $solusubanco = null; echo "*";}?>solusubanco</td> 
				<td width="25%"> 
				<input type="text" name="solusubanco"	value="<?php if(!$flageditarsoliciusuario){ echo $sbreg[solusubanco];}else{ echo $solusubanco; }?>"> 
				</td> 
				<td width="25%" class="NoiseFooterTD"> 
				<?php if ($campnomb == "solusutipcue") { $solusutipcue = null; echo "*";}?>solusutipcue</td> 
				<td width="25%"> 
				<input type="text" name="solusutipcue"	value="<?php if(!$flageditarsoliciusuario){ echo $sbreg[solusutipcue];}else{ echo $solusutipcue; }?>"> 
				</td> 
 </tr> 
	<tr> 
				<td width="25%" class="NoiseFooterTD"> 
				<?php if ($campnomb == "solusunumcue") { $solusunumcue = null; echo "*";}?>solusunumcue</td> 
				<td width="25%"> 
				<input type="text" name="solusunumcue"	value="<?php if(!$flageditarsoliciusuario){ echo $sbreg[solusunumcue];}else{ echo $solusunumcue; }?>"> 
				</td> 
				<td width="25%" class="NoiseFooterTD"> 
				<?php if ($campnomb == "solususucurs") { $solususucurs = null; echo "*";}?>solususucurs</td> 
				<td width="25%"> 
				<input type="text" name="solususucurs"	value="<?php if(!$flageditarsoliciusuario){ echo $sbreg[solususucurs];}else{ echo $solususucurs; }?>"> 
				</td> 
 </tr> 
	<tr> 
				<td width="25%" class="NoiseFooterTD"> 
				<?php if ($campnomb == "solusutelefo") { $solusutelefo = null; echo "*";}?>solusutelefo</td> 
				<td width="25%"> 
				<input type="text" name="solusutelefo"	value="<?php if(!$flageditarsoliciusuario){ echo $sbreg[solusutelefo];}else{ echo $solusutelefo; }?>"> 
				</td> 
				<td width="25%" class="NoiseFooterTD"> 
				<?php if ($campnomb == "solusuciudad") { $solusuciudad = null; echo "*";}?>solusuciudad</td> 
				<td width="25%"> 
				<input type="text" name="solusuciudad"	value="<?php if(!$flageditarsoliciusuario){ echo $sbreg[solusuciudad];}else{ echo $solusuciudad; }?>"> 
				</td> 
 </tr> 
	<tr> 
				<td width="25%" class="NoiseFooterTD"> 
				<?php if ($campnomb == "solusubanco1") { $solusubanco1 = null; echo "*";}?>solusubanco1</td> 
				<td width="25%"> 
				<input type="text" name="solusubanco1"	value="<?php if(!$flageditarsoliciusuario){ echo $sbreg[solusubanco1];}else{ echo $solusubanco1; }?>"> 
				</td> 
				<td width="25%" class="NoiseFooterTD"> 
				<?php if ($campnomb == "solusutipcue1") { $solusutipcue1 = null; echo "*";}?>solusutipcue1</td> 
				<td width="25%"> 
				<input type="text" name="solusutipcue1"	value="<?php if(!$flageditarsoliciusuario){ echo $sbreg[solusutipcue1];}else{ echo $solusutipcue1; }?>"> 
				</td> 
 </tr> 
	<tr> 
				<td width="25%" class="NoiseFooterTD"> 
				<?php if ($campnomb == "solusunumcue1") { $solusunumcue1 = null; echo "*";}?>solusunumcue1</td> 
				<td width="25%"> 
				<input type="text" name="solusunumcue1"	value="<?php if(!$flageditarsoliciusuario){ echo $sbreg[solusunumcue1];}else{ echo $solusunumcue1; }?>"> 
				</td> 
				<td width="25%" class="NoiseFooterTD"> 
				<?php if ($campnomb == "solususucurs1") { $solususucurs1 = null; echo "*";}?>solususucurs1</td> 
				<td width="25%"> 
				<input type="text" name="solususucurs1"	value="<?php if(!$flageditarsoliciusuario){ echo $sbreg[solususucurs1];}else{ echo $solususucurs1; }?>"> 
				</td> 
 </tr> 
	<tr> 
				<td width="25%" class="NoiseFooterTD"> 
				<?php if ($campnomb == "solusutelefo1") { $solusutelefo1 = null; echo "*";}?>solusutelefo1</td> 
				<td width="25%"> 
				<input type="text" name="solusutelefo1"	value="<?php if(!$flageditarsoliciusuario){ echo $sbreg[solusutelefo1];}else{ echo $solusutelefo1; }?>"> 
				</td> 
				<td width="25%" class="NoiseFooterTD"> 
				<?php if ($campnomb == "solusuciudad1") { $solusuciudad1 = null; echo "*";}?>solusuciudad1</td> 
				<td width="25%"> 
				<input type="text" name="solusuciudad1"	value="<?php if(!$flageditarsoliciusuario){ echo $sbreg[solusuciudad1];}else{ echo $solusuciudad1; }?>"> 
				</td> 
 </tr> 
	<tr> 
				<td width="25%" class="NoiseFooterTD"> 
				<?php if ($campnomb == "solusubanco2") { $solusubanco2 = null; echo "*";}?>solusubanco2</td> 
				<td width="25%"> 
				<input type="text" name="solusubanco2"	value="<?php if(!$flageditarsoliciusuario){ echo $sbreg[solusubanco2];}else{ echo $solusubanco2; }?>"> 
				</td> 
				<td width="25%" class="NoiseFooterTD"> 
				<?php if ($campnomb == "solusutipcue2") { $solusutipcue2 = null; echo "*";}?>solusutipcue2</td> 
				<td width="25%"> 
				<input type="text" name="solusutipcue2"	value="<?php if(!$flageditarsoliciusuario){ echo $sbreg[solusutipcue2];}else{ echo $solusutipcue2; }?>"> 
				</td> 
 </tr> 
	<tr> 
				<td width="25%" class="NoiseFooterTD"> 
				<?php if ($campnomb == "solusunumcue2") { $solusunumcue2 = null; echo "*";}?>solusunumcue2</td> 
				<td width="25%"> 
				<input type="text" name="solusunumcue2"	value="<?php if(!$flageditarsoliciusuario){ echo $sbreg[solusunumcue2];}else{ echo $solusunumcue2; }?>"> 
				</td> 
				<td width="25%" class="NoiseFooterTD"> 
				<?php if ($campnomb == "solususucurs2") { $solususucurs2 = null; echo "*";}?>solususucurs2</td> 
				<td width="25%"> 
				<input type="text" name="solususucurs2"	value="<?php if(!$flageditarsoliciusuario){ echo $sbreg[solususucurs2];}else{ echo $solususucurs2; }?>"> 
				</td> 
 </tr> 
	<tr> 
				<td width="25%" class="NoiseFooterTD"> 
				<?php if ($campnomb == "solusutelefo2") { $solusutelefo2 = null; echo "*";}?>solusutelefo2</td> 
				<td width="25%"> 
				<input type="text" name="solusutelefo2"	value="<?php if(!$flageditarsoliciusuario){ echo $sbreg[solusutelefo2];}else{ echo $solusutelefo2; }?>"> 
				</td> 
				<td width="25%" class="NoiseFooterTD"> 
				<?php if ($campnomb == "solusuciudad2") { $solusuciudad2 = null; echo "*";}?>solusuciudad2</td> 
				<td width="25%"> 
				<input type="text" name="solusuciudad2"	value="<?php if(!$flageditarsoliciusuario){ echo $sbreg[solusuciudad2];}else{ echo $solusuciudad2; }?>"> 
				</td> 
 </tr> 
	<tr> 
				<td width="25%" class="NoiseFooterTD"> 
				<?php if ($campnomb == "solusunomrfa") { $solusunomrfa = null; echo "*";}?>solusunomrfa</td> 
				<td width="25%"> 
				<input type="text" name="solusunomrfa"	value="<?php if(!$flageditarsoliciusuario){ echo $sbreg[solusunomrfa];}else{ echo $solusunomrfa; }?>"> 
				</td> 
				<td width="25%" class="NoiseFooterTD"> 
				<?php if ($campnomb == "solusuparrfa") { $solusuparrfa = null; echo "*";}?>solusuparrfa</td> 
				<td width="25%"> 
				<input type="text" name="solusuparrfa"	value="<?php if(!$flageditarsoliciusuario){ echo $sbreg[solusuparrfa];}else{ echo $solusuparrfa; }?>"> 
				</td> 
 </tr> 
	<tr> 
				<td width="25%" class="NoiseFooterTD"> 
				<?php if ($campnomb == "solusutelrfa") { $solusutelrfa = null; echo "*";}?>solusutelrfa</td> 
				<td width="25%"> 
				<input type="text" name="solusutelrfa"	value="<?php if(!$flageditarsoliciusuario){ echo $sbreg[solusutelrfa];}else{ echo $solusutelrfa; }?>"> 
				</td> 
				<td width="25%" class="NoiseFooterTD"> 
				<?php if ($campnomb == "solusudirrfa") { $solusudirrfa = null; echo "*";}?>solusudirrfa</td> 
				<td width="25%"> 
				<input type="text" name="solusudirrfa"	value="<?php if(!$flageditarsoliciusuario){ echo $sbreg[solusudirrfa];}else{ echo $solusudirrfa; }?>"> 
				</td> 
 </tr> 
	<tr> 
				<td width="25%" class="NoiseFooterTD"> 
				<?php if ($campnomb == "solusuciurfa") { $solusuciurfa = null; echo "*";}?>solusuciurfa</td> 
				<td width="25%"> 
				<input type="text" name="solusuciurfa"	value="<?php if(!$flageditarsoliciusuario){ echo $sbreg[solusuciurfa];}else{ echo $solusuciurfa; }?>"> 
				</td> 
				<td width="25%" class="NoiseFooterTD"> 
				<?php if ($campnomb == "solusunomrfa1") { $solusunomrfa1 = null; echo "*";}?>solusunomrfa1</td> 
				<td width="25%"> 
				<input type="text" name="solusunomrfa1"	value="<?php if(!$flageditarsoliciusuario){ echo $sbreg[solusunomrfa1];}else{ echo $solusunomrfa1; }?>"> 
				</td> 
 </tr> 
	<tr> 
				<td width="25%" class="NoiseFooterTD"> 
				<?php if ($campnomb == "solusuparrfa1") { $solusuparrfa1 = null; echo "*";}?>solusuparrfa1</td> 
				<td width="25%"> 
				<input type="text" name="solusuparrfa1"	value="<?php if(!$flageditarsoliciusuario){ echo $sbreg[solusuparrfa1];}else{ echo $solusuparrfa1; }?>"> 
				</td> 
				<td width="25%" class="NoiseFooterTD"> 
				<?php if ($campnomb == "solusutelrfa1") { $solusutelrfa1 = null; echo "*";}?>solusutelrfa1</td> 
				<td width="25%"> 
				<input type="text" name="solusutelrfa1"	value="<?php if(!$flageditarsoliciusuario){ echo $sbreg[solusutelrfa1];}else{ echo $solusutelrfa1; }?>"> 
				</td> 
 </tr> 
	<tr> 
				<td width="25%" class="NoiseFooterTD"> 
				<?php if ($campnomb == "solusudirrfa1") { $solusudirrfa1 = null; echo "*";}?>solusudirrfa1</td> 
				<td width="25%"> 
				<input type="text" name="solusudirrfa1"	value="<?php if(!$flageditarsoliciusuario){ echo $sbreg[solusudirrfa1];}else{ echo $solusudirrfa1; }?>"> 
				</td> 
				<td width="25%" class="NoiseFooterTD"> 
				<?php if ($campnomb == "solusuciurfa1") { $solusuciurfa1 = null; echo "*";}?>solusuciurfa1</td> 
				<td width="25%"> 
				<input type="text" name="solusuciurfa1"	value="<?php if(!$flageditarsoliciusuario){ echo $sbreg[solusuciurfa1];}else{ echo $solusuciurfa1; }?>"> 
				</td> 
 </tr> 
	<tr> 
				<td width="25%" class="NoiseFooterTD"> 
				<?php if ($campnomb == "solusunomrfa2") { $solusunomrfa2 = null; echo "*";}?>solusunomrfa2</td> 
				<td width="25%"> 
				<input type="text" name="solusunomrfa2"	value="<?php if(!$flageditarsoliciusuario){ echo $sbreg[solusunomrfa2];}else{ echo $solusunomrfa2; }?>"> 
				</td> 
				<td width="25%" class="NoiseFooterTD"> 
				<?php if ($campnomb == "solusuparrfa2") { $solusuparrfa2 = null; echo "*";}?>solusuparrfa2</td> 
				<td width="25%"> 
				<input type="text" name="solusuparrfa2"	value="<?php if(!$flageditarsoliciusuario){ echo $sbreg[solusuparrfa2];}else{ echo $solusuparrfa2; }?>"> 
				</td> 
 </tr> 
	<tr> 
				<td width="25%" class="NoiseFooterTD"> 
				<?php if ($campnomb == "solusutelrfa2") { $solusutelrfa2 = null; echo "*";}?>solusutelrfa2</td> 
				<td width="25%"> 
				<input type="text" name="solusutelrfa2"	value="<?php if(!$flageditarsoliciusuario){ echo $sbreg[solusutelrfa2];}else{ echo $solusutelrfa2; }?>"> 
				</td> 
				<td width="25%" class="NoiseFooterTD"> 
				<?php if ($campnomb == "solusudirrfa2") { $solusudirrfa2 = null; echo "*";}?>solusudirrfa2</td> 
				<td width="25%"> 
				<input type="text" name="solusudirrfa2"	value="<?php if(!$flageditarsoliciusuario){ echo $sbreg[solusudirrfa2];}else{ echo $solusudirrfa2; }?>"> 
				</td> 
 </tr> 
	<tr> 
				<td width="25%" class="NoiseFooterTD"> 
				<?php if ($campnomb == "solusuciurfa2") { $solusuciurfa2 = null; echo "*";}?>solusuciurfa2</td> 
				<td width="25%"> 
				<input type="text" name="solusuciurfa2"	value="<?php if(!$flageditarsoliciusuario){ echo $sbreg[solusuciurfa2];}else{ echo $solusuciurfa2; }?>"> 
				</td> 
				<td width="25%" class="NoiseFooterTD"> 
				<?php if ($campnomb == "solusucupsol") { $solusucupsol = null; echo "*";}?>solusucupsol</td> 
				<td width="25%"> 
				<input type="text" name="solusucupsol"	value="<?php if(!$flageditarsoliciusuario){ echo $sbreg[solusucupsol];}else{ echo $solusucupsol; }?>"> 
				</td> 
 </tr> 
	<tr> 
				<td width="25%" class="NoiseFooterTD"> 
				<?php if ($campnomb == "solusuplasol") { $solusuplasol = null; echo "*";}?>solusuplasol</td> 
				<td width="25%"> 
				<input type="text" name="solusuplasol"	value="<?php if(!$flageditarsoliciusuario){ echo $sbreg[solusuplasol];}else{ echo $solusuplasol; }?>"> 
				</td> 
				<td width="25%" class="NoiseFooterTD"> 
				<?php if ($campnomb == "solusucontac") { $solusucontac = null; echo "*";}?>solusucontac</td> 
				<td width="25%"> 
				<input type="text" name="solusucontac"	value="<?php if(!$flageditarsoliciusuario){ echo $sbreg[solusucontac];}else{ echo $solusucontac; }?>"> 
				</td> 
 </tr> 
	<tr> 
				<td width="25%" class="NoiseFooterTD"> 
				<?php if ($campnomb == "solusuobserv") { $solusuobserv = null; echo "*";}?>solusuobserv</td> 
				<td width="25%"> 
				<input type="text" name="solusuobserv"	value="<?php if(!$flageditarsoliciusuario){ echo $sbreg[solusuobserv];}else{ echo $solusuobserv; }?>"> 
				</td> 
				<td width="25%" class="NoiseFooterTD"> 
				<?php if ($campnomb == "solusucupsug") { $solusucupsug = null; echo "*";}?>solusucupsug</td> 
				<td width="25%"> 
				<input type="text" name="solusucupsug"	value="<?php if(!$flageditarsoliciusuario){ echo $sbreg[solusucupsug];}else{ echo $solusucupsug; }?>"> 
				</td> 
 </tr> 
	<tr> 
				<td width="25%" class="NoiseFooterTD"> 
				<?php if ($campnomb == "solusucupaut") { $solusucupaut = null; echo "*";}?>solusucupaut</td> 
				<td width="25%"> 
				<input type="text" name="solusucupaut"	value="<?php if(!$flageditarsoliciusuario){ echo $sbreg[solusucupaut];}else{ echo $solusucupaut; }?>"> 
				</td> 
				<td width="25%" class="NoiseFooterTD"> 
				<?php if ($campnomb == "solusuplacon") { $solusuplacon = null; echo "*";}?>solusuplacon</td> 
				<td width="25%"> 
				<input type="text" name="solusuplacon"	value="<?php if(!$flageditarsoliciusuario){ echo $sbreg[solusuplacon];}else{ echo $solusuplacon; }?>"> 
				</td> 
 </tr> 
	<tr> 
				<td width="25%" class="NoiseFooterTD"> 
				<?php if ($campnomb == "solusuobserv1") { $solusuobserv1 = null; echo "*";}?>solusuobserv1</td> 
				<td width="25%"> 
				<input type="text" name="solusuobserv1"	value="<?php if(!$flageditarsoliciusuario){ echo $sbreg[solusuobserv1];}else{ echo $solusuobserv1; }?>"> 
				</td> 
				<td width="25%" class="NoiseFooterTD"> 
				<?php if ($campnomb == "solusuprecli") { $solusuprecli = null; echo "*";}?>solusuprecli</td> 
				<td width="25%"> 
				<input type="text" name="solusuprecli"	value="<?php if(!$flageditarsoliciusuario){ echo $sbreg[solusuprecli];}else{ echo $solusuprecli; }?>"> 
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
<?php 
if($campnomb){echo '<font face = "Verdana" >Corregir los capos marcados con *</font>';} 
?> 
<input type="hidden" name="solusucodigo" value="<?php if(!$flageditarsoliciusuario){ echo $sbreg[solusucodigo];}else{ echo $solusucodigo; } ?>"> 
<input type="hidden" name="accioneditarsoliciusuario"> 
<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
</form> 
</body> 
<?php 
if (! $codigo) { 
    echo " -->"; 
} 
?> 
</html> 
