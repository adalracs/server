<?php 
include ('../src/FunGen/sesion/fncvalses.php'); 
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
<title>Consultar en soliciusuario</title> 
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
		<td class="ui-widget-header">Consultar registro</td></tr> 
	<tr> 
		<td> 
		<table width="95%" border="0" cellspacing="1" cellpadding="1" align="center"> 
		<td width="59%"><input type="text" name="solusucodigo" 
					value="<?php if(!$flagconsultarsoliciusuario){ echo $sbreg[solusucodigo];}
					else{ echo 
$solusucodigo; } ?>"></td> 
	<tr> 
				<td width="25%" class="NoiseFooterTD">tisouscodigo</td> 
				<td width="25%"> 
				<input type="text" name="tisouscodigo"	value="<?php if(!$flagconsultarsoliciusuario){ echo $sbreg[tisouscodigo];}else{ echo $tisouscodigo; }?>"> 
				</td> 
				<td width="25%" class="NoiseFooterTD">solusucodigo</td> 
				<td width="25%"> 
				<input type="text" name="solusucodigo"	value="<?php if(!$flagconsultarsoliciusuario){ echo $sbreg[solusucodigo];}else{ echo $solusucodigo; }?>"> 
				</td> 
 </tr> 
	<tr> 
				<td width="25%" class="NoiseFooterTD">clausucodigo</td> 
				<td width="25%"> 
				<input type="text" name="clausucodigo"	value="<?php if(!$flagconsultarsoliciusuario){ echo $sbreg[clausucodigo];}else{ echo $clausucodigo; }?>"> 
				</td> 
				<td width="25%" class="NoiseFooterTD">solusufecha</td> 
				<td width="25%"> 
				<input type="text" name="solusufecha"	value="<?php if(!$flagconsultarsoliciusuario){ echo $sbreg[solusufecha];}else{ echo $solusufecha; }?>"> 
				</td> 
 </tr> 
	<tr> 
				<td width="25%" class="NoiseFooterTD">solusuperaca</td> 
				<td width="25%"> 
				<input type="text" name="solusuperaca"	value="<?php if(!$flagconsultarsoliciusuario){ echo $sbreg[solusuperaca];}else{ echo $solusuperaca; }?>"> 
				</td> 
				<td width="25%" class="NoiseFooterTD">solusumatmer</td> 
				<td width="25%"> 
				<input type="text" name="solusumatmer"	value="<?php if(!$flagconsultarsoliciusuario){ echo $sbreg[solusumatmer];}else{ echo $solusumatmer; }?>"> 
				</td> 
 </tr> 
	<tr> 
				<td width="25%" class="NoiseFooterTD">solusumatfec</td> 
				<td width="25%"> 
				<input type="text" name="solusumatfec"	value="<?php if(!$flagconsultarsoliciusuario){ echo $sbreg[solusumatfec];}else{ echo $solusumatfec; }?>"> 
				</td> 
				<td width="25%" class="NoiseFooterTD">solusudircom</td> 
				<td width="25%"> 
				<input type="text" name="solusudircom"	value="<?php if(!$flagconsultarsoliciusuario){ echo $sbreg[solusudircom];}else{ echo $solusudircom; }?>"> 
				</td> 
 </tr> 
	<tr> 
				<td width="25%" class="NoiseFooterTD">solusutelcom</td> 
				<td width="25%"> 
				<input type="text" name="solusutelcom"	value="<?php if(!$flagconsultarsoliciusuario){ echo $sbreg[solusutelcom];}else{ echo $solusutelcom; }?>"> 
				</td> 
				<td width="25%" class="NoiseFooterTD">solusufaxcom</td> 
				<td width="25%"> 
				<input type="text" name="solusufaxcom"	value="<?php if(!$flagconsultarsoliciusuario){ echo $sbreg[solusufaxcom];}else{ echo $solusufaxcom; }?>"> 
				</td> 
 </tr> 
	<tr> 
				<td width="25%" class="NoiseFooterTD">solusunacexp</td> 
				<td width="25%"> 
				<input type="text" name="solusunacexp"	value="<?php if(!$flagconsultarsoliciusuario){ echo $sbreg[solusunacexp];}else{ echo $solusunacexp; }?>"> 
				</td> 
				<td width="25%" class="NoiseFooterTD">solusuprisuc</td> 
				<td width="25%"> 
				<input type="text" name="solusuprisuc"	value="<?php if(!$flagconsultarsoliciusuario){ echo $sbreg[solusuprisuc];}else{ echo $solusuprisuc; }?>"> 
				</td> 
 </tr> 
	<tr> 
				<td width="25%" class="NoiseFooterTD">solusulocprop</td> 
				<td width="25%"> 
				<input type="text" name="solusulocprop"	value="<?php if(!$flagconsultarsoliciusuario){ echo $sbreg[solusulocprop];}else{ echo $solusulocprop; }?>"> 
				</td> 
				<td width="25%" class="NoiseFooterTD">solusuareloc</td> 
				<td width="25%"> 
				<input type="text" name="solusuareloc"	value="<?php if(!$flagconsultarsoliciusuario){ echo $sbreg[solusuareloc];}else{ echo $solusuareloc; }?>"> 
				</td> 
 </tr> 
	<tr> 
				<td width="25%" class="NoiseFooterTD">solusuarrend</td> 
				<td width="25%"> 
				<input type="text" name="solusuarrend"	value="<?php if(!$flagconsultarsoliciusuario){ echo $sbreg[solusuarrend];}else{ echo $solusuarrend; }?>"> 
				</td> 
				<td width="25%" class="NoiseFooterTD">solusutelarr</td> 
				<td width="25%"> 
				<input type="text" name="solusutelarr"	value="<?php if(!$flagconsultarsoliciusuario){ echo $sbreg[solusutelarr];}else{ echo $solusutelarr; }?>"> 
				</td> 
 </tr> 
	<tr> 
				<td width="25%" class="NoiseFooterTD">solusuantneg</td> 
				<td width="25%"> 
				<input type="text" name="solusuantneg"	value="<?php if(!$flagconsultarsoliciusuario){ echo $sbreg[solusuantneg];}else{ echo $solusuantneg; }?>"> 
				</td> 
				<td width="25%" class="NoiseFooterTD">solusuacteco</td> 
				<td width="25%"> 
				<input type="text" name="solusuacteco"	value="<?php if(!$flagconsultarsoliciusuario){ echo $sbreg[solusuacteco];}else{ echo $solusuacteco; }?>"> 
				</td> 
 </tr> 
	<tr> 
				<td width="25%" class="NoiseFooterTD">solusuactcod</td> 
				<td width="25%"> 
				<input type="text" name="solusuactcod"	value="<?php if(!$flagconsultarsoliciusuario){ echo $sbreg[solusuactcod];}else{ echo $solusuactcod; }?>"> 
				</td> 
				<td width="25%" class="NoiseFooterTD">solusutipinm</td> 
				<td width="25%"> 
				<input type="text" name="solusutipinm"	value="<?php if(!$flagconsultarsoliciusuario){ echo $sbreg[solusutipinm];}else{ echo $solusutipinm; }?>"> 
				</td> 
 </tr> 
	<tr> 
				<td width="25%" class="NoiseFooterTD">solusumatinm</td> 
				<td width="25%"> 
				<input type="text" name="solusumatinm"	value="<?php if(!$flagconsultarsoliciusuario){ echo $sbreg[solusumatinm];}else{ echo $solusumatinm; }?>"> 
				</td> 
				<td width="25%" class="NoiseFooterTD">solusudirecc</td> 
				<td width="25%"> 
				<input type="text" name="solusudirecc"	value="<?php if(!$flagconsultarsoliciusuario){ echo $sbreg[solusudirecc];}else{ echo $solusudirecc; }?>"> 
				</td> 
 </tr> 
	<tr> 
				<td width="25%" class="NoiseFooterTD">solusuvalcom</td> 
				<td width="25%"> 
				<input type="text" name="solusuvalcom"	value="<?php if(!$flagconsultarsoliciusuario){ echo $sbreg[solusuvalcom];}else{ echo $solusuvalcom; }?>"> 
				</td> 
				<td width="25%" class="NoiseFooterTD">solusutipinm1</td> 
				<td width="25%"> 
				<input type="text" name="solusutipinm1"	value="<?php if(!$flagconsultarsoliciusuario){ echo $sbreg[solusutipinm1];}else{ echo $solusutipinm1; }?>"> 
				</td> 
 </tr> 
	<tr> 
				<td width="25%" class="NoiseFooterTD">solusumatinm1</td> 
				<td width="25%"> 
				<input type="text" name="solusumatinm1"	value="<?php if(!$flagconsultarsoliciusuario){ echo $sbreg[solusumatinm1];}else{ echo $solusumatinm1; }?>"> 
				</td> 
				<td width="25%" class="NoiseFooterTD">solusudirecc1</td> 
				<td width="25%"> 
				<input type="text" name="solusudirecc1"	value="<?php if(!$flagconsultarsoliciusuario){ echo $sbreg[solusudirecc1];}else{ echo $solusudirecc1; }?>"> 
				</td> 
 </tr> 
	<tr> 
				<td width="25%" class="NoiseFooterTD">solusuvalcom1</td> 
				<td width="25%"> 
				<input type="text" name="solusuvalcom1"	value="<?php if(!$flagconsultarsoliciusuario){ echo $sbreg[solusuvalcom1];}else{ echo $solusuvalcom1; }?>"> 
				</td> 
				<td width="25%" class="NoiseFooterTD">solusuvehicu</td> 
				<td width="25%"> 
				<input type="text" name="solusuvehicu"	value="<?php if(!$flagconsultarsoliciusuario){ echo $sbreg[solusuvehicu];}else{ echo $solusuvehicu; }?>"> 
				</td> 
 </tr> 
	<tr> 
				<td width="25%" class="NoiseFooterTD">solusuvehmod</td> 
				<td width="25%"> 
				<input type="text" name="solusuvehmod"	value="<?php if(!$flagconsultarsoliciusuario){ echo $sbreg[solusuvehmod];}else{ echo $solusuvehmod; }?>"> 
				</td> 
				<td width="25%" class="NoiseFooterTD">solusuvehpla</td> 
				<td width="25%"> 
				<input type="text" name="solusuvehpla"	value="<?php if(!$flagconsultarsoliciusuario){ echo $sbreg[solusuvehpla];}else{ echo $solusuvehpla; }?>"> 
				</td> 
 </tr> 
	<tr> 
				<td width="25%" class="NoiseFooterTD">solusuprefav</td> 
				<td width="25%"> 
				<input type="text" name="solusuprefav"	value="<?php if(!$flagconsultarsoliciusuario){ echo $sbreg[solusuprefav];}else{ echo $solusuprefav; }?>"> 
				</td> 
				<td width="25%" class="NoiseFooterTD">solusuvevaco</td> 
				<td width="25%"> 
				<input type="text" name="solusuvevaco"	value="<?php if(!$flagconsultarsoliciusuario){ echo $sbreg[solusuvevaco];}else{ echo $solusuvevaco; }?>"> 
				</td> 
 </tr> 
	<tr> 
				<td width="25%" class="NoiseFooterTD">solusuvehicu1</td> 
				<td width="25%"> 
				<input type="text" name="solusuvehicu1"	value="<?php if(!$flagconsultarsoliciusuario){ echo $sbreg[solusuvehicu1];}else{ echo $solusuvehicu1; }?>"> 
				</td> 
				<td width="25%" class="NoiseFooterTD">solusuvehmod1</td> 
				<td width="25%"> 
				<input type="text" name="solusuvehmod1"	value="<?php if(!$flagconsultarsoliciusuario){ echo $sbreg[solusuvehmod1];}else{ echo $solusuvehmod1; }?>"> 
				</td> 
 </tr> 
	<tr> 
				<td width="25%" class="NoiseFooterTD">solusuvehpla1</td> 
				<td width="25%"> 
				<input type="text" name="solusuvehpla1"	value="<?php if(!$flagconsultarsoliciusuario){ echo $sbreg[solusuvehpla1];}else{ echo $solusuvehpla1; }?>"> 
				</td> 
				<td width="25%" class="NoiseFooterTD">solusuprefav1</td> 
				<td width="25%"> 
				<input type="text" name="solusuprefav1"	value="<?php if(!$flagconsultarsoliciusuario){ echo $sbreg[solusuprefav1];}else{ echo $solusuprefav1; }?>"> 
				</td> 
 </tr> 
	<tr> 
				<td width="25%" class="NoiseFooterTD">solusuvevaco1</td> 
				<td width="25%"> 
				<input type="text" name="solusuvevaco1"	value="<?php if(!$flagconsultarsoliciusuario){ echo $sbreg[solusuvevaco1];}else{ echo $solusuvevaco1; }?>"> 
				</td> 
				<td width="25%" class="NoiseFooterTD">solusunomrec</td> 
				<td width="25%"> 
				<input type="text" name="solusunomrec"	value="<?php if(!$flagconsultarsoliciusuario){ echo $sbreg[solusunomrec];}else{ echo $solusunomrec; }?>"> 
				</td> 
 </tr> 
	<tr> 
				<td width="25%" class="NoiseFooterTD">solusucuprec</td> 
				<td width="25%"> 
				<input type="text" name="solusucuprec"	value="<?php if(!$flagconsultarsoliciusuario){ echo $sbreg[solusucuprec];}else{ echo $solusucuprec; }?>"> 
				</td> 
				<td width="25%" class="NoiseFooterTD">solusutelrec</td> 
				<td width="25%"> 
				<input type="text" name="solusutelrec"	value="<?php if(!$flagconsultarsoliciusuario){ echo $sbreg[solusutelrec];}else{ echo $solusutelrec; }?>"> 
				</td> 
 </tr> 
	<tr> 
				<td width="25%" class="NoiseFooterTD">solusudirrec</td> 
				<td width="25%"> 
				<input type="text" name="solusudirrec"	value="<?php if(!$flagconsultarsoliciusuario){ echo $sbreg[solusudirrec];}else{ echo $solusudirrec; }?>"> 
				</td> 
				<td width="25%" class="NoiseFooterTD">solusuciurec</td> 
				<td width="25%"> 
				<input type="text" name="solusuciurec"	value="<?php if(!$flagconsultarsoliciusuario){ echo $sbreg[solusuciurec];}else{ echo $solusuciurec; }?>"> 
				</td> 
 </tr> 
	<tr> 
				<td width="25%" class="NoiseFooterTD">solusunomrec1</td> 
				<td width="25%"> 
				<input type="text" name="solusunomrec1"	value="<?php if(!$flagconsultarsoliciusuario){ echo $sbreg[solusunomrec1];}else{ echo $solusunomrec1; }?>"> 
				</td> 
				<td width="25%" class="NoiseFooterTD">solusucuprec1</td> 
				<td width="25%"> 
				<input type="text" name="solusucuprec1"	value="<?php if(!$flagconsultarsoliciusuario){ echo $sbreg[solusucuprec1];}else{ echo $solusucuprec1; }?>"> 
				</td> 
 </tr> 
	<tr> 
				<td width="25%" class="NoiseFooterTD">solusutelrec1</td> 
				<td width="25%"> 
				<input type="text" name="solusutelrec1"	value="<?php if(!$flagconsultarsoliciusuario){ echo $sbreg[solusutelrec1];}else{ echo $solusutelrec1; }?>"> 
				</td> 
				<td width="25%" class="NoiseFooterTD">solusudirrec1</td> 
				<td width="25%"> 
				<input type="text" name="solusudirrec1"	value="<?php if(!$flagconsultarsoliciusuario){ echo $sbreg[solusudirrec1];}else{ echo $solusudirrec1; }?>"> 
				</td> 
 </tr> 
	<tr> 
				<td width="25%" class="NoiseFooterTD">solusuciurec1</td> 
				<td width="25%"> 
				<input type="text" name="solusuciurec1"	value="<?php if(!$flagconsultarsoliciusuario){ echo $sbreg[solusuciurec1];}else{ echo $solusuciurec1; }?>"> 
				</td> 
				<td width="25%" class="NoiseFooterTD">solusunomrec2</td> 
				<td width="25%"> 
				<input type="text" name="solusunomrec2"	value="<?php if(!$flagconsultarsoliciusuario){ echo $sbreg[solusunomrec2];}else{ echo $solusunomrec2; }?>"> 
				</td> 
 </tr> 
	<tr> 
				<td width="25%" class="NoiseFooterTD">solusucuprec2</td> 
				<td width="25%"> 
				<input type="text" name="solusucuprec2"	value="<?php if(!$flagconsultarsoliciusuario){ echo $sbreg[solusucuprec2];}else{ echo $solusucuprec2; }?>"> 
				</td> 
				<td width="25%" class="NoiseFooterTD">solusutelrec2</td> 
				<td width="25%"> 
				<input type="text" name="solusutelrec2"	value="<?php if(!$flagconsultarsoliciusuario){ echo $sbreg[solusutelrec2];}else{ echo $solusutelrec2; }?>"> 
				</td> 
 </tr> 
	<tr> 
				<td width="25%" class="NoiseFooterTD">solusudirrec2</td> 
				<td width="25%"> 
				<input type="text" name="solusudirrec2"	value="<?php if(!$flagconsultarsoliciusuario){ echo $sbreg[solusudirrec2];}else{ echo $solusudirrec2; }?>"> 
				</td> 
				<td width="25%" class="NoiseFooterTD">solusuciurec2</td> 
				<td width="25%"> 
				<input type="text" name="solusuciurec2"	value="<?php if(!$flagconsultarsoliciusuario){ echo $sbreg[solusuciurec2];}else{ echo $solusuciurec2; }?>"> 
				</td> 
 </tr> 
	<tr> 
				<td width="25%" class="NoiseFooterTD">solusubanco</td> 
				<td width="25%"> 
				<input type="text" name="solusubanco"	value="<?php if(!$flagconsultarsoliciusuario){ echo $sbreg[solusubanco];}else{ echo $solusubanco; }?>"> 
				</td> 
				<td width="25%" class="NoiseFooterTD">solusutipcue</td> 
				<td width="25%"> 
				<input type="text" name="solusutipcue"	value="<?php if(!$flagconsultarsoliciusuario){ echo $sbreg[solusutipcue];}else{ echo $solusutipcue; }?>"> 
				</td> 
 </tr> 
	<tr> 
				<td width="25%" class="NoiseFooterTD">solusunumcue</td> 
				<td width="25%"> 
				<input type="text" name="solusunumcue"	value="<?php if(!$flagconsultarsoliciusuario){ echo $sbreg[solusunumcue];}else{ echo $solusunumcue; }?>"> 
				</td> 
				<td width="25%" class="NoiseFooterTD">solususucurs</td> 
				<td width="25%"> 
				<input type="text" name="solususucurs"	value="<?php if(!$flagconsultarsoliciusuario){ echo $sbreg[solususucurs];}else{ echo $solususucurs; }?>"> 
				</td> 
 </tr> 
	<tr> 
				<td width="25%" class="NoiseFooterTD">solusutelefo</td> 
				<td width="25%"> 
				<input type="text" name="solusutelefo"	value="<?php if(!$flagconsultarsoliciusuario){ echo $sbreg[solusutelefo];}else{ echo $solusutelefo; }?>"> 
				</td> 
				<td width="25%" class="NoiseFooterTD">solusuciudad</td> 
				<td width="25%"> 
				<input type="text" name="solusuciudad"	value="<?php if(!$flagconsultarsoliciusuario){ echo $sbreg[solusuciudad];}else{ echo $solusuciudad; }?>"> 
				</td> 
 </tr> 
	<tr> 
				<td width="25%" class="NoiseFooterTD">solusubanco1</td> 
				<td width="25%"> 
				<input type="text" name="solusubanco1"	value="<?php if(!$flagconsultarsoliciusuario){ echo $sbreg[solusubanco1];}else{ echo $solusubanco1; }?>"> 
				</td> 
				<td width="25%" class="NoiseFooterTD">solusutipcue1</td> 
				<td width="25%"> 
				<input type="text" name="solusutipcue1"	value="<?php if(!$flagconsultarsoliciusuario){ echo $sbreg[solusutipcue1];}else{ echo $solusutipcue1; }?>"> 
				</td> 
 </tr> 
	<tr> 
				<td width="25%" class="NoiseFooterTD">solusunumcue1</td> 
				<td width="25%"> 
				<input type="text" name="solusunumcue1"	value="<?php if(!$flagconsultarsoliciusuario){ echo $sbreg[solusunumcue1];}else{ echo $solusunumcue1; }?>"> 
				</td> 
				<td width="25%" class="NoiseFooterTD">solususucurs1</td> 
				<td width="25%"> 
				<input type="text" name="solususucurs1"	value="<?php if(!$flagconsultarsoliciusuario){ echo $sbreg[solususucurs1];}else{ echo $solususucurs1; }?>"> 
				</td> 
 </tr> 
	<tr> 
				<td width="25%" class="NoiseFooterTD">solusutelefo1</td> 
				<td width="25%"> 
				<input type="text" name="solusutelefo1"	value="<?php if(!$flagconsultarsoliciusuario){ echo $sbreg[solusutelefo1];}else{ echo $solusutelefo1; }?>"> 
				</td> 
				<td width="25%" class="NoiseFooterTD">solusuciudad1</td> 
				<td width="25%"> 
				<input type="text" name="solusuciudad1"	value="<?php if(!$flagconsultarsoliciusuario){ echo $sbreg[solusuciudad1];}else{ echo $solusuciudad1; }?>"> 
				</td> 
 </tr> 
	<tr> 
				<td width="25%" class="NoiseFooterTD">solusubanco2</td> 
				<td width="25%"> 
				<input type="text" name="solusubanco2"	value="<?php if(!$flagconsultarsoliciusuario){ echo $sbreg[solusubanco2];}else{ echo $solusubanco2; }?>"> 
				</td> 
				<td width="25%" class="NoiseFooterTD">solusutipcue2</td> 
				<td width="25%"> 
				<input type="text" name="solusutipcue2"	value="<?php if(!$flagconsultarsoliciusuario){ echo $sbreg[solusutipcue2];}else{ echo $solusutipcue2; }?>"> 
				</td> 
 </tr> 
	<tr> 
				<td width="25%" class="NoiseFooterTD">solusunumcue2</td> 
				<td width="25%"> 
				<input type="text" name="solusunumcue2"	value="<?php if(!$flagconsultarsoliciusuario){ echo $sbreg[solusunumcue2];}else{ echo $solusunumcue2; }?>"> 
				</td> 
				<td width="25%" class="NoiseFooterTD">solususucurs2</td> 
				<td width="25%"> 
				<input type="text" name="solususucurs2"	value="<?php if(!$flagconsultarsoliciusuario){ echo $sbreg[solususucurs2];}else{ echo $solususucurs2; }?>"> 
				</td> 
 </tr> 
	<tr> 
				<td width="25%" class="NoiseFooterTD">solusutelefo2</td> 
				<td width="25%"> 
				<input type="text" name="solusutelefo2"	value="<?php if(!$flagconsultarsoliciusuario){ echo $sbreg[solusutelefo2];}else{ echo $solusutelefo2; }?>"> 
				</td> 
				<td width="25%" class="NoiseFooterTD">solusuciudad2</td> 
				<td width="25%"> 
				<input type="text" name="solusuciudad2"	value="<?php if(!$flagconsultarsoliciusuario){ echo $sbreg[solusuciudad2];}else{ echo $solusuciudad2; }?>"> 
				</td> 
 </tr> 
	<tr> 
				<td width="25%" class="NoiseFooterTD">solusunomrfa</td> 
				<td width="25%"> 
				<input type="text" name="solusunomrfa"	value="<?php if(!$flagconsultarsoliciusuario){ echo $sbreg[solusunomrfa];}else{ echo $solusunomrfa; }?>"> 
				</td> 
				<td width="25%" class="NoiseFooterTD">solusuparrfa</td> 
				<td width="25%"> 
				<input type="text" name="solusuparrfa"	value="<?php if(!$flagconsultarsoliciusuario){ echo $sbreg[solusuparrfa];}else{ echo $solusuparrfa; }?>"> 
				</td> 
 </tr> 
	<tr> 
				<td width="25%" class="NoiseFooterTD">solusutelrfa</td> 
				<td width="25%"> 
				<input type="text" name="solusutelrfa"	value="<?php if(!$flagconsultarsoliciusuario){ echo $sbreg[solusutelrfa];}else{ echo $solusutelrfa; }?>"> 
				</td> 
				<td width="25%" class="NoiseFooterTD">solusudirrfa</td> 
				<td width="25%"> 
				<input type="text" name="solusudirrfa"	value="<?php if(!$flagconsultarsoliciusuario){ echo $sbreg[solusudirrfa];}else{ echo $solusudirrfa; }?>"> 
				</td> 
 </tr> 
	<tr> 
				<td width="25%" class="NoiseFooterTD">solusuciurfa</td> 
				<td width="25%"> 
				<input type="text" name="solusuciurfa"	value="<?php if(!$flagconsultarsoliciusuario){ echo $sbreg[solusuciurfa];}else{ echo $solusuciurfa; }?>"> 
				</td> 
				<td width="25%" class="NoiseFooterTD">solusunomrfa1</td> 
				<td width="25%"> 
				<input type="text" name="solusunomrfa1"	value="<?php if(!$flagconsultarsoliciusuario){ echo $sbreg[solusunomrfa1];}else{ echo $solusunomrfa1; }?>"> 
				</td> 
 </tr> 
	<tr> 
				<td width="25%" class="NoiseFooterTD">solusuparrfa1</td> 
				<td width="25%"> 
				<input type="text" name="solusuparrfa1"	value="<?php if(!$flagconsultarsoliciusuario){ echo $sbreg[solusuparrfa1];}else{ echo $solusuparrfa1; }?>"> 
				</td> 
				<td width="25%" class="NoiseFooterTD">solusutelrfa1</td> 
				<td width="25%"> 
				<input type="text" name="solusutelrfa1"	value="<?php if(!$flagconsultarsoliciusuario){ echo $sbreg[solusutelrfa1];}else{ echo $solusutelrfa1; }?>"> 
				</td> 
 </tr> 
	<tr> 
				<td width="25%" class="NoiseFooterTD">solusudirrfa1</td> 
				<td width="25%"> 
				<input type="text" name="solusudirrfa1"	value="<?php if(!$flagconsultarsoliciusuario){ echo $sbreg[solusudirrfa1];}else{ echo $solusudirrfa1; }?>"> 
				</td> 
				<td width="25%" class="NoiseFooterTD">solusuciurfa1</td> 
				<td width="25%"> 
				<input type="text" name="solusuciurfa1"	value="<?php if(!$flagconsultarsoliciusuario){ echo $sbreg[solusuciurfa1];}else{ echo $solusuciurfa1; }?>"> 
				</td> 
 </tr> 
	<tr> 
				<td width="25%" class="NoiseFooterTD">solusunomrfa2</td> 
				<td width="25%"> 
				<input type="text" name="solusunomrfa2"	value="<?php if(!$flagconsultarsoliciusuario){ echo $sbreg[solusunomrfa2];}else{ echo $solusunomrfa2; }?>"> 
				</td> 
				<td width="25%" class="NoiseFooterTD">solusuparrfa2</td> 
				<td width="25%"> 
				<input type="text" name="solusuparrfa2"	value="<?php if(!$flagconsultarsoliciusuario){ echo $sbreg[solusuparrfa2];}else{ echo $solusuparrfa2; }?>"> 
				</td> 
 </tr> 
	<tr> 
				<td width="25%" class="NoiseFooterTD">solusutelrfa2</td> 
				<td width="25%"> 
				<input type="text" name="solusutelrfa2"	value="<?php if(!$flagconsultarsoliciusuario){ echo $sbreg[solusutelrfa2];}else{ echo $solusutelrfa2; }?>"> 
				</td> 
				<td width="25%" class="NoiseFooterTD">solusudirrfa2</td> 
				<td width="25%"> 
				<input type="text" name="solusudirrfa2"	value="<?php if(!$flagconsultarsoliciusuario){ echo $sbreg[solusudirrfa2];}else{ echo $solusudirrfa2; }?>"> 
				</td> 
 </tr> 
	<tr> 
				<td width="25%" class="NoiseFooterTD">solusuciurfa2</td> 
				<td width="25%"> 
				<input type="text" name="solusuciurfa2"	value="<?php if(!$flagconsultarsoliciusuario){ echo $sbreg[solusuciurfa2];}else{ echo $solusuciurfa2; }?>"> 
				</td> 
				<td width="25%" class="NoiseFooterTD">solusucupsol</td> 
				<td width="25%"> 
				<input type="text" name="solusucupsol"	value="<?php if(!$flagconsultarsoliciusuario){ echo $sbreg[solusucupsol];}else{ echo $solusucupsol; }?>"> 
				</td> 
 </tr> 
	<tr> 
				<td width="25%" class="NoiseFooterTD">solusuplasol</td> 
				<td width="25%"> 
				<input type="text" name="solusuplasol"	value="<?php if(!$flagconsultarsoliciusuario){ echo $sbreg[solusuplasol];}else{ echo $solusuplasol; }?>"> 
				</td> 
				<td width="25%" class="NoiseFooterTD">solusucontac</td> 
				<td width="25%"> 
				<input type="text" name="solusucontac"	value="<?php if(!$flagconsultarsoliciusuario){ echo $sbreg[solusucontac];}else{ echo $solusucontac; }?>"> 
				</td> 
 </tr> 
	<tr> 
				<td width="25%" class="NoiseFooterTD">solusuobserv</td> 
				<td width="25%"> 
				<input type="text" name="solusuobserv"	value="<?php if(!$flagconsultarsoliciusuario){ echo $sbreg[solusuobserv];}else{ echo $solusuobserv; }?>"> 
				</td> 
				<td width="25%" class="NoiseFooterTD">solusucupsug</td> 
				<td width="25%"> 
				<input type="text" name="solusucupsug"	value="<?php if(!$flagconsultarsoliciusuario){ echo $sbreg[solusucupsug];}else{ echo $solusucupsug; }?>"> 
				</td> 
 </tr> 
	<tr> 
				<td width="25%" class="NoiseFooterTD">solusucupaut</td> 
				<td width="25%"> 
				<input type="text" name="solusucupaut"	value="<?php if(!$flagconsultarsoliciusuario){ echo $sbreg[solusucupaut];}else{ echo $solusucupaut; }?>"> 
				</td> 
				<td width="25%" class="NoiseFooterTD">solusuplacon</td> 
				<td width="25%"> 
				<input type="text" name="solusuplacon"	value="<?php if(!$flagconsultarsoliciusuario){ echo $sbreg[solusuplacon];}else{ echo $solusuplacon; }?>"> 
				</td> 
 </tr> 
	<tr> 
				<td width="25%" class="NoiseFooterTD">solusuobserv1</td> 
				<td width="25%"> 
				<input type="text" name="solusuobserv1"	value="<?php if(!$flagconsultarsoliciusuario){ echo $sbreg[solusuobserv1];}else{ echo $solusuobserv1; }?>"> 
				</td> 
				<td width="25%" class="NoiseFooterTD">solusuprecli</td> 
				<td width="25%"> 
				<input type="text" name="solusuprecli"	value="<?php if(!$flagconsultarsoliciusuario){ echo $sbreg[solusuprecli];}else{ echo $solusuprecli; }?>"> 
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
<input type="hidden" name="flagconsultarsoliciusuario" value="1"> 
<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>"> 
<input type="hidden" name="sourceaction" value="consultar"> 
<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
<input type="hidden" name="accionconsultarsoliciusuario"> 
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
"> 
<input type="hidden" name="nombtabl" value="soliciusuario"> 
</form> 
</body> 
<?php 
if (! $codigo) { 
    echo " -->"; 
} 
?> 
</html> 
