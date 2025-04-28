<?php 
include ( '../src/FunGen/sesion/fnccantrow.php'); 
include ( '../src/FunGen/sesion/fnccantrow1.php'); 
include ( '../src/FunPerPriNiv/limitscan.php'); 
include ( '../src/FunGen/sesion/fncvalses.php'); 
include ( '../src/FunPerPriNiv/pktblvalor.php'); 
include ( '../src/FunGen/sesion/fncalmdat.php'); 
include ( '../src/FunGen/sesion/fnccaf.php'); 
$reccomact.= fnccaf($GLOBALS[usuacodi],$PATH_TRANSLATED); 
if($accionborrarvalor) 
{ 
	include ( 'borravalor.php'); 
} 
else 
{ 
	if($accioneditarvalor) 
	{ 
		include ( 'editavalor.php'); 
	} 
	else 
	{ 
		if($accionnuevovalor) 
		{ 
			include ( 'grabavalor.php'); 
		} 
		else 
		{ 
			if($accionconsultarvalor) 
			{ 
				//include ( '../src/FunGen/sesion/fncalmdatc.php'); 
				$nusw = 0; 
				$nombcamp = strtok ($columnas,","); 
				while ($nombcamp) 
				{ 
					$nombcamp = trim($nombcamp); 
					$recarreglo[$nombcamp] = $$nombcamp; 
					if($recarreglo[$nombcamp]){ $nusw =1;} 
					$nombcamp = strtok(","); 
				} 
				if(!$nusw){ 
					$accionconsultarvalor = 0; 
				} 
			} 
		} 
	} 
} 
include ( '../src/FunGen/sesion/fncaumdec.php'); 
?> 
<!-- C�igo creado por: 
Generador Adsum 
Autor: Andr� A. Riascos D. 
Fecha: 13082003 --> 
<html> 
<head> 
<title>Registros de Inserte nombre</title> 
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
<meta http-equiv="expires" content="0"> 
<script language="JavaScript"> 
<!-- Begin 
	function foo(flag) 
	{ 
		if(flag == 1) 
		{ 
			form1.mov.value = 'mas'; 
		} 
		else 
		{ 
			if(flag == 2) 
			{ 
				form1.mov.value = 'menos'; 
			} 
			else 
			{ 
				if(flag == 3) 
				{ 
					form1.mov.value = 'primero'; 
				} 
				else 
				{ 
					if(flag == 4) 
					{ 
						form1.mov.value = 'ultimo'; 
					} 
				} 
			} 
		} 
	} 
</script> 
</head> 
<?php 
    if(!$codigo) 
    { echo "<!--";} 
?> 
<body bgcolor="#FFFFFF" text="#000000" leftmargin="50" topmargin="20" 
marginwidth="0" marginheight="0"> 
<form name="form1" method="post"  enctype="multipart/form-data"> 
<table width="100%" border="1" cellspacing="0" cellpadding="15" 
bordercolor="#009933" align="center"> 
  <tr> 
    <td> 
<table width="100%" border="0" cellspacing="0" cellpadding="5" align="center"> 
 <tr> 
 <td colspan="6"><font face="Arial, Helvetica, sans-serif" size="3"><b><font 
color="#006699">Listado de valores </font></b></font></td> 
 </tr> 
 <tr> 
 <td colspan="6" background="../img/panel.gif"><b><font size="3" color="669999" 
face="Arial, Helvetica, sans-serif">&nbsp;</font></b></td> 
 </tr> 
  <tr> 
  <td> 
  <?php 
if($reccomact[nuevo]){ 
echo '       <input type="image" name="nuevo"  src="../img/nuevo.gif" 
onclick="form1.action='."'".'ingrnuevvalor.php'."'".';submit();"  width="86" 
height="18" alt="Nuevo Registro" border=0>'; 
} 
if($reccomact[consultar]){ 
echo '            <input type="image" name="consultar"  
src="../img/consulta.gif" 
onclick="form1.action='."'".'consultarvalor.php'."'".';submit();"  width="86" 
height="18" alt="Consultar" border=0>'; 
} 
?> 
 </td> 
 <td width="42"> 
  <input type="image" name="adelanta"  src="../img/adelanta.gif" 
onclick="form1.mov.value = 'menos';form1.action='maestablvalor.php';submit();" 
alt="Anterior"></td> 
 <td width="46"><font size="2" color="#CC9900">Anterior</font></td> 
 <td width="50"> 
  <?php 
	$intervalo = 
fncaumdec('valor',$inicio,$fin,$mov,$accionconsultarvalor,$recarreglo); 
	$cantrow = $intervalo[total]; 
	if($intervalo[idtrans]){ $idtrans = $intervalo[idtrans]; } 
?> 
 </td> 
 <td width="53"> 
 <div align="right"><font color="#CC9900">Siguiente</font></div> 
 </td> 
 <td width="53"><input type="image" name="atras"  src="../img/atrasa.gif" 
onclick="form1.mov.value = 'mas';form1.action='maestablvalor.php';submit();" 
alt="Siguiente"></td> 
 </tr> 
 <tr> 
  <td colspan="6"><div align="right"> 
   <?php 
if($reccomact[detallar]){ 
echo '<b><input type="image" name="detallar" src="../img/verdetal.gif" 
onclick="form1.action='."'".'detallarvalor.php'."'".';submit();"  width="87" 
height="19"  alt="Ver detalle" border=0></b>'; 
} 
if($reccomact[borrar]){ 
echo '<b><input type="image" name="borrar"  src="../img/borrar.gif" 
onclick="form1.action='."'".'borrarvalor.php'."'".';submit();"  width="87" 
height="19"  alt="Borrar Registro" border=0></b>'; 
} 
if($reccomact[modificar]){ 
echo '<b><input type="image" name="modificar"  src="../img/modifica.gif" 
onclick="form1.action='."'".'editarvalor.php'."'".';submit();"  width="87" 
height="19"  alt="Modificar Registro" border=0></b>'; 
} 
?> 
 </div></td> 
  
 </tr> 
 <tr> 
  <td colspan="6"> 
  <table width="100%" border="1" cellspacing="0" cellpadding="0"> 
<tr bgcolor="#CCCC99"> 
<td width="8%"><b><font face="Arial, Helvetica, sans-serif" size ="2" 
color="#006699">Selec.</font></b></td> 
<td width="46%"><b><font size="2" face="Arial,Helvetica, sans-serif" 
color="#006699">C&oacute;digo</font></b></td> 
<td width="46%"><b><font size="2" face="Arial,Helvetica, sans-serif" 
color="#006699">Nombre</font></b></td> 
</tr> 
<?php 
include ( '../src/FunGen/sesion/fncvisregvalor.php'); 
	$reg[0] = 'valorcodigo'; 
	$reg1[0] = 'n'; 
	$nureturn = fncvisregvalor('valor',$reg,$reg1,$idtrans); 
?> 
   </table> 
   </td> 
  </tr> 
  <tr> 
   <td colspan="6"> <div align="right"> 
  </div><div align="right"> 
<?php 
if($reccomact[detallar]){ 
echo  '<b><input type="image" name="detallar"  src="../img/verdetal.gif" 
onclick="form1.action='."'".'detallarvalor.php'."'".';submit();"  width="87" 
height="19" alt="Ver detalle" border=0></b>'; 
} 
if($reccomact[borrar]){ 
echo  '<b><input type="image" name="borrar"  src="../img/borrar.gif" 
onclick="form1.action='."'".'borrarvalor.php'."'".';submit();"  width="87" 
height="19" alt="Borrar Registro" border=0></b>'; 
} 
if($reccomact[modificar]){ 
echo  '<b><input type="image" name="modificar"  src="../img/modifica.gif" 
onclick="form1.action='."'".'editarvalor.php'."'".';submit();"  width="87" 
height="19" alt="Modificar Registro" border=0></b>'; 
} 
?> 
  </div><div align="right"> 
  </div></td> 
  
  </tr> 
  <tr> 
   <td>&nbsp;</td> 
   <td width="42"><input type="image" name="primero"  src="../img/primero.gif" 
onclick="form1.mov.value = 'primero';form1.action='maestablvalor.php';submit();" alt="Primero"></td> 
   <td width="46"><input type="image" name="adelanta"  
src="../img/adelanta.gif" 
onclick="form1.mov.value = 'menos';form1.action='maestablvalor.php';submit();" 
alt="Anterior"></td> 
   <td width="50"> 
<?php 
echo '<font color="#006699" size="2" face="Arial, Helvetica, 
sans-serif">'.$intervalo[inicio].'-'.$intervalo[fin].' de  
'.$intervalo[total].'</font>'; 
?> 
   </td> 
   <td width="53"><input type="image" name="atras2"  src="../img/atrasa.gif" 
onclick="form1.mov.value = 'mas';form1.action='maestablvalor.php';submit();" 
alt="Siguiente"></td> 
   <td width="53"><input type="image" name="ultimo"  src="../img/ultimo.gif" 
onclick="form1.mov.value = 'ultimo';form1.action='maestablvalor.php';submit();" alt="Ultimo"></td> 
  </tr> 
  <tr> 
   <td colspan="4" background="../img/panel2.gif">&nbsp;</td> 
   <td colspan="2" background="../img/panel1.gif">&nbsp;</td> 
  </tr> 
 </table> 
 </td> 
 </tr> 
</table> 
 <input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
 <input type="hidden" name="inicio" value="<?php echo $intervalo[inicio]; ?>"> 
 <input type="hidden" name="fin" value="<?php echo $intervalo[fin]; ?>"> 
 <input type="hidden" name="nombtabl" value="valor"> 
<input type="hidden" name="columnas" value="valorcodigo, 
valorvalor 
"> 
 <input type="hidden" name="valorcodigo" value="<?php echo $valorcodigo; ?>"> 
 <input type="hidden" name="valorvalor" value="<?php echo $valorvalor; ?>"> 
 <input type="hidden" name="accionconsultarvalor" value="<?php echo 
$accionconsultarvalor; ?>"> 
 <input type="hidden" name="nuevo" value="<?php echo $nuevo; ?>"> 
 <input type="hidden" name="borrar" value="<?php echo $borrar; ?>"> 
 <input type="hidden" name="consultar" value="<?php echo $consultar; ?>"> 
 <input type="hidden" name="detallar" value="<?php echo $detallar; ?>"> 
 <input type="hidden" name="modificar" value="<?php echo $modificar; ?>"> 
 <input type="hidden" name="mov"> 
 </form> 
 </body> 
<?php 
if(!$codigo) 
{ echo " -->"; } 
?> 
</html> 
