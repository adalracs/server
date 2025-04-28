<?php 
ob_start();
include ( '../src/FunGen/sesion/fncvalses.php'); 
include ( '../src/FunPerPriNiv/pktbltipomant.php');
include ( '../src/FunPerPriNiv/pktblpriorida.php');
include ( '../src/FunPerPriNiv/pktbltipotrab.php');
include ( '../src/FunPerPriNiv/pktbltarea.php');
include ( '../src/FunPerPriNiv/pktblot.php');
include ( '../src/FunPerPriNiv/pktblplanta.php');
include ( '../src/FunPerPriNiv/pktblsistema.php');
include ( '../src/FunPerPriNiv/pktblequipo.php');
include ( '../src/FunPerPriNiv/pktblcomponen.php');
include ( '../src/FunPerPriNiv/pktblitem.php');
include ( '../src/FunPerPriNiv/pktbloperacio.php');
include ( '../src/FunPerPriNiv/pktbltransacitem.php');
include ( '../src/FunPerPriNiv/pktbltareot.php');
include ( '../src/FunPerPriNiv/pktblusuariotareot.php');
include ( '../src/FunPerPriNiv/pktblusuario.php');
include ( '../src/FunPerPriNiv/pktblitemtareot.php');
include ( '../src/FunPerPriNiv/pktblreportotitem.php');

/**/
if($accioneditarreportot)
{ 
	
	include ( 'editareportot.php'); 
	$flageditarreportot = 1; 
} 
ob_end_flush(); 
if(!$flageditarreportot) 
{ 
include ( '../src/FunGen/sesion/fnccarga.php'); 
$sbreg = fnccarga($nombtabl,$radiobutton); 
if (!$sbreg) 
	{ 
		include( '../src/FunGen/fnccontfron.php'); 
	} 
	$idcon = fncconn();
	$vartipomant = $sbreg[tipmancodigo];
	$arrtipomant= loadrecordtipomant($vartipomant,$idcon);
	$codtipomant = $sbreg[tipmancodigo];

	$varpriorida = $sbreg[prioricodigo];
	$arrpriorida= loadrecordpriorida($varpriorida,$idcon);
	$codpriorida = $sbreg[prioricodigo];
	
	$vartipotrab = $sbreg[tiptracodigo];
	$arrtipotrab= loadrecordtipotrab($vartipotrab,$idcon);
	$codtipotrab = $sbreg[tiptracodigo];

	$vartarea = $sbreg[tareacodigo];
	$arrtarea= loadrecordtarea($vartarea,$idcon);
	$codtarea = $sbreg[tareacodigo];
	
	fncclose($idcon);
}
?> 
<!-- Propiedad intelectual de Adsum SA (c) 
-Todos los derechos reservados- 
Creado con WAG Adsum 
Autor: Andr�s A. Riascos D. 
Fecha: 26052004 
GenVers: 3.1 --> 
<html> 
<head>
<script language="JavaScript" src="../src/FunGen/jsrsClient.js" type="text/javascript" ></script>
<script language="JavaScript" src="../src/FunGen/cargarEmpleaselec.js" type="text/javascript" ></script>
<script language=JavaScript src="../src/FunGen/cargarTransacitem.js" type="text/javascript" ></script>
<script language=JavaScript src="../src/FunGen/fncbotton.js" type="text/javascript" ></script>
<script language="JavaScript" type="text/javascript">
function devolverItem(itemselect)
{
	if(itemselect.options.selectedIndex == "-1")
	{
		alert('No ha seleccionado un elemento de la lista');
		return;
	}
	var valor;
	var texto;
	for(var i = 0; i < itemselect.length; i++)
	{
		if(itemselect.options[i].selected)
		{
			valor = itemselect.options[i].value;
			texto = itemselect.options[i].text;
			window.open('devolveritem.php?codigo=<?php 
  			echo $codigo;?>&itemcodigo='+valor+'&texto='+texto,'secundaria2','status=no,menubar=no,scrollbars=yes,resizable=yes,left=300,width=800,height=600');
		}
	}
	//delete_list(idselec);
}

//Borra del select el option seleccionado
function borraroption(lista)
{
	if(lista.options.selectedIndex == "-1")
	{
		alert('No ha seleccionado un elemento de la lista');
		return;
	}
	else
	{
		for(var i = 0; i < lista.length; i++)
		{
			alert('borraroption');
			if (lista.options[i].selected)
			{
				delete_record(lista,i)
			}
		}
	}
}

/*
Recorre el select itemcodigo1, el cual contiene el listado de los items que se van devolver, con el fin de 
llenar un input con los codigos y las cantidades ejemplo 1-20 1 es el codigo del item y 20 es la cantidad a 
devolver
*/
function tomarCantidadesItems(lista)
{
	if(lista.length > 0)
	{
		var items = new Array;
		var loaditem1 = new Array;
		var itemseleccodi1 = new Array;
		var itemseleccant1 = new Array;
		for(var i=0;i<lista.length;i++)
		{
			//obtengo el codigo del item y lo asigno al arreglo de codigos
			itemseleccodi1[i] = lista.options[i].value;
			//divido el texto del option en un arreglo separa por (,) en donde habian (-)
			items = lista.options[i].text.split("-");
			//obtengo la cantidad del item y lo asigno al arreglo de cantidades
			itemseleccant1[i] = items[1];
			//creo un arreglo compuesto por el codigo del item y la cantidad
			loaditem1[i] = itemseleccodi1[i]+"-"+items[1];
		}
		/*Asigno los contenidos de los arreglos a los inputs del formulario. para enviarlos a la funcion
		grabareportot.php*/
		window.document.form1.loaditem1.value=loaditem1;
		window.document.form1.itemseleccodi1.value=itemseleccodi1;
		window.document.form1.itemseleccant1.value=itemseleccant1;
	}
}
</script>
<title>Editar registro de reporte de orden de trabajo</title> 
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
<meta http-equiv="expires" content="0"> 
<link rel="stylesheet" type="text/css" href="temas/Noise/Style.css"> 
<SCRIPT LANGUAGE="JavaScript"> 
<!-- Begin 
agree = 0; 
//  End --> 
</script> 
</head> 
<?php 
    if(!$codigo) 
    { echo "<!--";} 
?> 
<body bgcolor="FFFFFF" text="#000000"> 
<form name="form1" method="post"  enctype="multipart/form-data"> 
<p><font class="NoiseFormHeaderFont">Reporte de orden de trabajo</font></p> 
<table border="0" cellspacing="1" cellpadding="2" align="center" 
class="NoiseFormTABLE"> 
  <tr> 
    <td class="NoiseErrorDataTD">&nbsp;</td> 
  </tr> 
  <tr> 
          <td class="NoiseFieldCaptionTD"><span class="style5"><font 
color="FFFFFF"> 
Editar registro</font></span></td></tr> 
<!-- -- -->
<tr> 
  <td><table width="97%" border="0" cellspacing="0" cellpadding="0" align="center">
 <tr>
 <td colspan="6">&nbsp;</td> 
 </tr>
 <tr>
	<td><table width="97%" border="0" cellspacing="0" cellpadding="3" align="center">
<tr>
 <td width="59%">
  <input type="button" name="buscar" value="Buscar OT" onclick="window.open('consultarotsecunduno.php?codigo=<?php 
  echo $codigo?>','secundaria1','status=no,menubar=no,scrollbars=yes,resizable=yes,left=300,width=800,height=600');"
  width="86" height="18" alt="Cancelar" border=0 href="#" target="_parent">
 </td> 
 </tr> 
 <tr>
 <td>
 &nbsp;
 </td>
 </tr>
	<tr>
			<?php 
			$idcon = fncconn();
	
			if(!$flageditarreportot)
				$ordtracodigo = $sbreg[ordtracodigo];
			if($ordtracodigo)
			{
				$sbregot = loadrecordot($ordtracodigo,$idcon);
				include('detallareportot.php');
			}
			//fncclose($idcon);
			?>
			<td>C&oacute;digo</td>
  			<td><input name="ordtracodigo" type="text" value="<?php if(!$flageditarreportot){ echo $sbregot[ordtracodigo];}else{ echo $ordtracodigo;} ?>" size="12" onFocus="if (!agree)this.blur();" ></td>
  			<td colspan="2">Fecha :&nbsp;&nbsp;
			<input type="text" name="ordtrafecgen"  size="13" value="<?php if(!$flageditarreportot){
			echo $ordtrafecgen;}else{ echo $ordtrafecgen; }?>" onFocus="if (!agree)this.blur();">
					   </td>
  			<td><div align="right">Hora :&nbsp;&nbsp;</div></td>
  			<td>
			<input type="text" name="ordtrahorgen"  size="13" value="<?php if(!$flageditarreportot){
echo $ordtrahorgen;}else{ echo $ordtrahorgen; }?>" onFocus="if (!agree)this.blur();">
              	</td>
            
  	</tr>
  	 <tr>
			<td colspan="7"><hr></td>
		</tr>
 <tr>
	<td>Centro industrial</td>
	<td>&nbsp;</td>
  	<td>Taller</td>
	<td>&nbsp;</td>
  	<td>&nbsp;&nbsp;Equipo</td>
  	<td>&nbsp;</td>
  	<td>Componente</td>
 </tr>
<tr> 
  <td colspan="2"><input type="text" name="plantanombre" value="<?php if(!$flageditarreportot){ echo $plantanombre;}else{ echo $plantanombre;} ?>" size="25" onFocus="if (!agree)this.blur();"></td>
  <td colspan="2"><input type="text" name="sistemnombre" value="<?php if(!$sistemnombre){ echo $sbregotsistnom;}else{ echo $sistemnombre;} ?>" size="25" onFocus="if (!agree)this.blur();" ></td> 
  <td colspan="2">&nbsp;&nbsp;<input type="text" name="equiponombre" value="<?php if(!$flageditarreportot){ echo $equiponombre;}else{ echo $equiponombre;} ?>" size="25" onFocus="if (!agree)this.blur();"></td> 
  <td colspan="2"><input type="text" name="componnombre" value="<?php if(!$flageditarreportot){ echo $componnombre;}else{ echo $componnombre;} ?>" size="25" onFocus="if (!agree)this.blur();"></td> 
</tr> 
<tr>
  <td colspan = "6">&nbsp;</td>
</tr>
 <tr> 
 <td width="17%">Tipo de mantenimiento</td>
 <td width="16%"><input type="text" name="tipmannombre" value="<?php if(!$flageditarreportot){ echo $tipmannombre;}else{ echo $tipmannombre;} ?>" onFocus="if (!agree)this.blur();" ></td>
 <td width="13%" align="right">Prioridad</td>
 <td colspan="2">&nbsp;&nbsp;&nbsp;<input name="priorinombre" type="text" value="<?php if(!$flageditarreportot){ echo $arrpriorida[priorinombre];}else{ echo $arrpriorida[priorinombre];} ?>" onFocus="if (!agree)this.blur();" ></td> 
 <td width="22%">&nbsp;</td>
 </tr> 
 <tr> 
 <td width="17%">Descripci&oacute;n</td> 
  <td colspan="5"> 
   <textarea name="ordtradescri" cols="41" rows="3" wrap="VIRTUAL" onFocus="if (!agree)this.blur();"><?php if(!$flageditarreportot){ echo $sbregot[ordtradescri];}else{ echo $ordtradescri;} ?></textarea> 
  </td> 
  </tr>
  <tr>
			<td width="17%">Fecha de inicio</td>
            <td>
            <input name="ordtrafecini" type="text"	value="<?php if(!$flageditarreportot){echo $ordtrafecini;}else{ echo $ordtrafecini;}?>" size="8" maxlength="8" onFocus="if (!agree)this.blur();">
			&nbsp;<span class="style1">aaaa-mm-dd</span>
			</td>
            <td><div align="right">Hora inicio&nbsp;</div></td>
			<td>
			<input name="ordtrahorini" type="text"	value="<?php if(!$flageditarreportot){echo $ordtrahorini;}else{ echo $ordtrahorini;}?>" size="6" maxlength="6" onFocus="if (!agree)this.blur();">
            &nbsp;
			</td>
            <!--<td colspan="1">&nbsp;<span class="style1">hh:mm</span></td>-->
            <td colspan="1">
            <input type="checkbox" name="pasadmerini" <?php if(!$flageditarreportot){if($hora>12) echo 
            "CHECKED";}
  			?>>&nbsp;p.m
			</td>
	</tr>
  		<tr>
 			<td width="17%">Fecha de fin</td>
  			<td>
  			<input name="ordtrafecfin" type="text"	value="<?php if(!$flageditarreportot){echo $ordtrafecfin;}else{ echo $ordtrafecfin;}?>" size="8" maxlength="8" onFocus="if (!agree)this.blur();">
			&nbsp;<span class="style1">aaaa-mm-dd</span></td>
	        <td><div align="right">Hora fin&nbsp;</div></td>
            <td>
            <input name="ordtrahorfin" type="text"	value="<?php if(!$flageditarreportot){echo $ordtrahorfin;}else{ echo $ordtrahorfin;}?>" size="6" maxlength="6" onFocus="if (!agree)this.blur();">
			</td>
            <!--<td colspan="1">&nbsp;<span class="style1">hh:mm</span></td>-->
            <td colspan="1">
            <input type="checkbox" name="pasadmerfin" <?php if(!$flagborrarreportot){if($hora1>12) echo 
            "CHECKED";}
  			?>>&nbsp;p.m
			</td>
		</tr>
		<tr>
			<td colspan="7"><hr></td>
		</tr>
 	</table></td>	
</tr>
<tr>
  <td><table width="97%" border="0" cellspacing="0" cellpadding="0" align="center">
<tr> 
 <td colspan="3">Colaborador de Mantenimiento</td> 
 <td>C&oacute;digo</td>
 <td><input name="empleacod" type="text" value="<?php if(!$flageditarreportot){ echo $usuacodigo;} else {echo $empleacod;} ?>" size="8" onFocus="if (!agree)this.blur();"></td>
 <td colspan="3">Nombre&nbsp;&nbsp;
  <input type="text" name="empleanomb" value="<?php if(!$flageditarreportot){ echo $sbregotusuanom;}else{ echo $empleanomb;} ?>" size="25" onFocus="if (!agree)this.blur();" ></td> 
</tr> 
    <tr>
      <td colspan="8">&nbsp;</td>
    </tr>
 <tr> 
 <td colspan="3">Auxiliares de Mantenimiento</td> 
 <td colspan="5">&nbsp;</td>
</tr>
    <tr>
      <td colspan="8">&nbsp;</td>
    </tr>
   <tr>
      <td colspan="3" rowspan="2"><div align="left">
       <select name="empleaselec" size="3">
   <?php
			include('../src/FunGen/floadusuaaux.php');
			$idcon = fncconn();
			floadusuaaux($sbregotusuaselec,$idcon); 
			fncclose($idcon);
    ?>
 </select> </div></td>
   <td><div align="center"></div></td>
   <td colspan="4" rowspan="2"><div align="center"></div><div align="left"></div></td>
  </tr>
  <tr>
      <td><div align="center"></div></td>
  </tr>
  <tr>
		<td colspan="8"><hr></td>
		</tr>
 <tr> 
 <td width="13%">Tipo de trabajo</td> 
  <td colspan="2"><input name="tiptranombre" type="text" onFocus="if (!agree)this.blur();" value="<?php if(!$flageditarreportot){ echo $tiptranombre;}else{ echo $tiptranombre;} ?>" size="20" ></td> 
  <td>&nbsp;</td>
 <td width="10%">Tarea</td> 
  <td width="10%"><input type="text" name="tareanombre" value="<?php if(!$flageditarreportot){ echo $tareanombre;}else{ echo $tareanombre;} ?>" onFocus="if (!agree)this.blur();" size="25"></td> 
  <td colspan="2">&nbsp;</td>
 </tr> 
<tr> 
 <td width="13%">Descripci&oacute;n del trabajo a realizar</td> 
  <td height="36" colspan="7"><textarea name="ordtranota" cols="41" rows="3" wrap="VIRTUAL" onFocus="if (!agree)this.blur();"><?php if(!$flageditarreportot){ echo $tareotnota;}else{ echo $ordtranota;} ?></textarea></td> 
</tr> 
   <tr>
	<td colspan="8">&nbsp;</td>
	</tr>
	<tr>
	<td colspan="2">Herramientas</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td colspan="2">Item</td>
	<td>Items devueltos</td>
	<td>&nbsp;</td>
	</tr>
	<tr>
	<td colspan="2">&nbsp;</td>
	<td colspan="2">&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	</tr>
	<tr>
	    	<td width="13%" rowspan="2"></td>
	    	<td colspan="4">&nbsp;</td>
	    	<td width="16%" rowspan="2">
	    	<div align="left">
	    	<select name="itemcodigo" size="3">
	    	<?php
		       		include('../src/FunGen/floadtransacitem.php');
					$idcon = fncconn();
					floadtransacitem($idcon,$itemseleccodi,$itemseleccant); 
					fncclose($idcon);
    		?></select>
    		</div>
    		</td>
        	<td width="11%"><div align="center">
			<input type="button" name="buscar" value=" > "
    		onclick="devolverItem(window.document.form1.itemcodigo);">
        	<!--<input type="button" name="adicionaite" value=" > " 
    		onClick="transferTo( this.form.itemcodigo,this.form.itemcodigo1,this.form.flag.value=5 );">-->
          </div></td>
	      	<td width="18%" rowspan="3" align="left">
	      	<div align="center">
	      	<?php
				$idcon = fncconn();
				$sbregreportotitem[reportcodigo]=$sbreg[reportcodigo];
		      	$nuResult=dinamicscanreportotitem($sbregreportotitem,$idcon);
		      	$numRows = fncnumreg($nuResult);
		      	for($i=0;$i<$numRows;$i++)
		      	{
		      		$sbregreportotitem=fncfetch($nuResult,$i);
		      		if($sbregreportotitem)
		      		{
		      			$sbregtransacitem[transitecodigo]=$sbregreportotitem[transitecodigo];
				      	$nuResulttransacitem=dinamicscantransacitem($sbregtransacitem,$idcon);
				      	$numtransacitem=fncnumreg($nuResulttransacitem);
				      	if($numtransacitem>0)
				      	{
				      		$sbregtransacitem=fncfetch($nuResulttransacitem,0);
				      		if($sbregtransacitem)
				      		{
								$itemseleccodi1[] = $sbregtransacitem[itemcodigo];
								$itemseleccant1[] = $sbregtransacitem[transitecantid];
				      		}
				      	}
				      	$sbregtransacitem=null;
		      		}
		      	}
				fncclose($idcon);
	      	?>
	      	<select name="itemcodigo1" size="3">
	      	<?php
	      	if(!$flagdetallarreportot)
	      	{
	      		if($itemseleccodi1 && $itemseleccant1)
	      		{
	      			$idcon = fncconn();
	      			floadtransacitem($idcon,$itemseleccodi1,$itemseleccant1);
	      			fncclose($idcon);
	      		}
	      	}
			?>
	      	</select></div></td>
	      	<td><input type="button" value="Eliminar" name="eliminar" 
			onclick="borraroption(window.document.form1.itemcodigo1);"></td>
	</tr>
	<tr>
	  <td width="9%">
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  </td>
    		<td width="11%"><div align="center">
    		<input type="button" name="eliminaite" value="Limpiar" 
  onClick="window.document.form1.itemcodigo1.length=0;">
	      	</div></td>
<!--    		<td width="11%">
    		<div align="center">
	      	</div></td>-->
		<td width="1%" colspan="6">&nbsp;</td>
  	</tr>
  </table></td>
</tr>
<!-- -- -->
	<tr>
		<td colspan="6"><hr></td>
	</tr>
<tr> 
  <td> 
            <table width="85%" border="0" cellspacing="0" cellpadding="3" 
align="center">
<tr>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td align="right"colspan="2">
	Fecha:&nbsp;<?php if(!$flageditarreportot)echo $sbreg['reportfecha'];
	else echo $reportfecha;?>
	</td>
</tr>
<tr> 
 <td width="41%"><?php if($campnomb["reportcodigo"] == 1){$reportcodigo = null; 
echo "*";}?>C&oacute;digo</td>
 <td width="59%"> 
  <input type="text" name="reportcodigo1" value="<?php if(!$flageditarreportot){ 
echo $sbreg[reportcodigo];}else{ echo $reportcodigo1; }?>" " onFocus="if (!agree)this.blur();"> 
 </td> 
 <td width="41%"><?php if($campnomb["ordtracodigo"] == 1){$ordtracodigo = null; 
echo "*";}?>Orden de trabajo</td> 
 <td width="59%"> 
  <input type="text" name="ordtracodigo1" value="<?php if(!$flageditarreportot){ 
echo $sbreg[ordtracodigo];}else{ echo $ordtracodigo; }?>" onFocus="if (!agree)this.blur();"> 
 </td> 
 </tr> 
<tr> 
 <td width="41%"><?php if($campnomb["tipmancodigo"] == 1){$tipmancodigo1 = null; 
echo "*";}?>Tipo de mantenimiento</td>
 <td width="59%"> 
  <select name="tipmancodigo1">
<?php
	if(!$flageditarreportot)
	{ 	
		echo '<option value="'.$codtipomant.'">';
		echo $arrtipomant[tipmannombre];
	}
	if($accioneditarreportot)
	{
		echo '<option value="'.$tipmancodigo1.'">';
		$idcon = fncconn();
		$arrtipomant = loadrecordtipomant($tipmancodigo1,$idcon);
		echo $arrtipomant[tipmannombre];
	}
?>
	</OPTION>
<?php
	include ('../src/FunGen/floadtipomant.php');
	$idcon = fncconn();
	floadtipomant($tipmancodigo1,$idcon);
	fncclose($idcon);
?>
</select> 
 </td> 
 <td width="41%"><?php if($campnomb["prioricodigo"] == 1){$prioricodigo1 = null; 
echo "*";}?>Prioridad</td> 
 <td width="59%"> 
  <select name="prioricodigo1">
<?php
	if(!$flageditarreportot)
	{ 	
		echo '<option value="'.$codpriorida.'">';
		echo $arrpriorida[priorinombre];
	}
	if($accioneditarreportot)
	{
		echo '<option value="'.$prioricodigo1.'">';
		$idcon = fncconn();
		$arrpriorida = loadrecordpriorida($prioricodigo1,$idcon);
		echo $arrpriorida[priorinombre];
	}
?>
	</OPTION>
<?php
	include ('../src/FunGen/floadpriorida.php');
	$idcon = fncconn();
	floadpriorida($prioricodigo1,$idcon);
	fncclose($idcon);
?>
</select> 
 </td> 
 </tr> 
<tr> 
 <td width="41%"><?php if($campnomb["tiptracodigo"] == 1){$tiptracodigo1 = null; 
echo "*";}?>Tipo de trabajo</td> 
 <td width="59%"> 
  <select name="tiptracodigo1">
<?php
	if(!$flageditarreportot)
	{ 	
		echo '<option value="'.$codtipotrab.'">';
		echo $arrtipotrab[tiptranombre];
	}
	if($accioneditarreportot)
	{
		echo '<option value="'.$tiptracodigo1.'">';
		$idcon = fncconn();
		$arrtipotrab = loadrecordtipotrab($tiptracodigo1,$idcon);
		echo $arrtipotrab[tiptranombre];
	}
?>
	</OPTION>
<?php
	include ('../src/FunGen/floadtipotrab.php');
	$idcon = fncconn();
	floadtipotrab($tiptracodigo1,$idcon);
	fncclose($idcon);
?>
</select> 
 </td> 
 <td width="41%"><?php if($campnomb["tareacodigo"] == 1){$tareacodigo1 = null; echo 
"*";}?>Tarea</td>
 <td width="59%"> 
  <select name="tareacodigo1">
<?php
	if(!$flageditarreportot)
	{ 	
		echo '<option value="'.$codtarea.'">';
		echo $arrtarea[tareanombre];
	}
	if($accioneditarreportot)
	{
		echo '<option value="'.$tareacodigo1.'">';
		$idcon = fncconn();
		$arrtarea = loadrecordtarea($tareacodigo1,$idcon);
		echo $arrtarea[tareanombre];
	}
?>
	</OPTION>
<?php
	include ('../src/FunGen/floadtarea.php');
	$idcon = fncconn();
	floadtarea($tareacodigo1,$idcon);
	fncclose($idcon);
?>
</select> 
 </td> 
 </tr> 
<tr> 
 <td width="41%"><?php if($campnomb["reportdescri"] == 1){$reportdescri = null; 
echo "*";}?>Descripci&oacute;n</td>
 <td width="59%"> 
  <textarea name="reportdescri1" cols="41" rows="3"><?php if(!$flageditarreportot){ 
echo $sbreg[reportdescri];}else{ echo $reportdescri1; }?></textarea>
 </td> 
 </tr> 
 <tr> 
  <td width="41%">&nbsp;</td> 
 </tr> 
</table> 
  </td> 
 </tr> 
 <tr> 
<td> 
<div align="center"> 
  <input type="image" name="aceptar"  src="../img/aceptar.gif" 
onclick="
tomarCantidadesItems(window.document.form1.itemcodigo1);
form1.accioneditarreportot.value =  1;"  width="86" height="18" 
alt="Aceptar" border=0> 
  <input type="image" name="cancelar" src="../img/cancelar.gif" 
onclick="form1.action='maestablreportot.php';"  width="86" height="18" 
alt="Cancelar" border=0> 
<input type="image" name="cancelar2" src="../img/ayuda.gif" width="86" 
height="18" alt="Cancelar" border=0> 
</div> 
</td> 
 </tr> 
 <tr> 
  <td class="NoiseErrorDataTD">&nbsp;</td> 
 </tr> 
</table> 
<?php 
if($campnomb){echo '<font face = "Verdana" >Corregir los capos marcados con 
*</font>';} 
?>
<!-- Datos de la tabla OT--- -->
<div id="divreport" style="visibility:hidden">
<input type="text" name="arreglo_aux" value="<?php if(!$flageditarreportot){
echo $sbreg[arreglo_aux];}else{ echo $arreglo_aux; }?>"
onfocus="
cargarEmpleaselec(window.document.form1.arreglo_aux.value);
cargarTransacitem(window.document.form1.loaditem.value);
window.document.form1.reportdescri.focus();
">

<input type="text" name="loaditem" value="<?php if(!$flageditarreportot){
echo $sbreg[ordtrahorgen];}else{ echo $ordtrahorgen; }?>"
onfocus="
cargarEmpleaselec(window.document.form1.arreglo_aux.value);
cargarTransacitem(window.document.form1.loaditem.value);
">

<input type="hidden" name="tipmancodigo" value="<?php echo $tipmancodigo; ?>"> 
<input type="hidden" name="prioricodigo" value="<?php echo $prioricodigo; ?>"> 
<input type="hidden" name="tiptracodigo" value="<?php echo $tiptracodigo; ?>"> 
<input type="hidden" name="tareacodigo" value="<?php echo $tareacodigo; ?>">

<input type="hidden" name="reporttiedur" value="<?php echo $reporttiedur; ?>">
<input type="hidden" name="reportdescri" value="<?php echo $reportdescri; ?>">
</div>
<!-- --- -->
<input type="hidden" name="accioneditarreportot">
<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
<input type="hidden" name="reporttiedur1" value="<?php if(!$flageditarreportot){ echo $sbreg[reporttiedur];}else{ echo $reporttiedur1; }?>" onFocus="if (!agree)this.blur();">
<input type="hidden" name="reportfecha" value="<?php if(!$flageditarreportot){ echo $sbreg[reportfecha];}else{ echo $reportfecha; }?>" onFocus="if (!agree)this.blur();">
<input type="hidden" name="loaditem1" value="<?php echo $loaditem1;?>">
<input type="hidden" name="itemseleccodi1" value="<?php echo $itemseleccodi1;?>">
<input type="hidden" name="itemseleccant1" value="<?php echo $itemseleccant1;?>">
<input type="hidden" name="itemseleccodi" value="<?php echo $itemseleccodi;?>">
<input type="hidden" name="itemseleccant" value="<?php echo $itemseleccant;?>">
</form> 
</body> 
<?php 
    if(!$codigo) 
    { echo " -->"; } 
?> 
</html> 
