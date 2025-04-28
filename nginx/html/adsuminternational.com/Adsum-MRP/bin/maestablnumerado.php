<?php 
   include ( '../src/FunGen/sesion/fnccantrow.php'); 
   include ( '../src/FunGen/sesion/fnccantrow1.php'); 
   include ( '../src/FunPerPriNiv/limitscan.php'); 
   include ( '../src/FunGen/sesion/fncvalses.php'); 
include ( '../src/FunPerPriNiv/pktblnumerado.php'); 
   include ( '../src/FunGen/sesion/fncalmdat.php'); 
if($accionborrarnumerado) 
{ 
	include ( 'borranumerado.php'); 
} 
else 
{ 
	if($accioneditarnumerado) 
	{ 
		include ( 'editanumerado.php'); 
	} 
	else 
	{ 
		if($accionnuevonumerado) 
		{ 
			include ( 'grabanumerado.php'); 
		} 
		else 
		{ 
			if($accionconsultarnumerado) 
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
					$accionconsultarnumerado = 0; 
				} 
			} 
		} 
	} 
} 
include ( '../src/FunGen/sesion/fncaumdec.php'); 
?> 
<html> 
<head> 
<title>Registros de Numerador</title> 
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
      <table width="100%" border="0" cellspacing="0" cellpadding="5" 
align="center"> 
        <tr> 
          <td colspan="7"><font face="Arial, Helvetica, sans-serif" 
size="3"><b><font color="#006699">Tabla 
            de 
Numerador</font></b></font></td> 
        </tr> 
        <tr> 
          <td colspan="7" background="../img/panel.gif"><font 
color="669999"><b><font size="3" face="Arial, Helvetica, sans-serif"> 
            <font color="#006699">Seleccione item(s) 
y...</font></font></b></font></td> 
        </tr> 
        <tr> 
          <td width="315"> 
<?php 
if($nuevo){ 
echo '       <input type="image" name="nuevo"  
src="../img/nuevo.gif" 
onclick="form1.action='."'".'ingrnuevnumerado.php'."'".';submit();"  width="86" 
height="18" alt="Nuevo Registro" border=0>'; 
} 
if($consultar){ 
echo '            <input type="image" name="consultar"  
src="../img/consulta.gif" 
onclick="form1.action='."'".'consultarnumerado.php'."'".';submit();"  
width="86" height="18" alt="Consultar" border=0>'; 
} 
?> 
          </td> 
          <td width="50"> 
          <input type="image" name="adelanta"  
src="../img/adelanta.gif" 
onclick="foo(2);form1.action='maestablnumerado.php';submit();" 
alt="Anterior"></td> 
          <td width="57"><font size="2" color="#CC9900">Anterior</font></td> 
          <td width="53"> 
<?php 
	$intervalo = 
fncaumdec('numerado',$inicio,$fin,$mov,$accionconsultarnumerado,$recarreglo); 
	$cantrow = $intervalo[total]; 
	if($intervalo[idtrans]){ $idtrans = $intervalo[idtrans]; } 
?> 
          </td> 
          <td width="56"> 
            <div align="right"><font color="#CC9900">Siguiente</font></div> 
          </td> 
          <td width="53"><input type="image" name="atras"  
src="../img/atrasa.gif" 
onclick="foo(1);form1.action='maestablnumerado.php';submit();" 
alt="Siguiente"></td> 
        </tr> 
        <tr> 
          <td colspan="2">&nbsp;</td> 
			<td colspan="4"> 
			<div align="right"> 
<?php 
if($detallar){ 
echo '          <b><input type="image" name="detallar" 
src="../img/verdetal.gif" 
onclick="form1.action='."'".'detallarnumerado.php'."'".';submit();"  width="87" 
height="19"  alt="Ver detalle" border=0></b>'; 
} 
if($borrar){ 
echo '          <b><input type="image" name="borrar"  
src="../img/borrar.gif" 
onclick="form1.action='."'".'borrarnumerado.php'."'".';submit();"  width="87" 
height="19"  alt="Borrar Registro" border=0></b>'; 
} 
if($modificar){ 
echo '          <b><input type="image" name="modificar"  
src="../img/modifica.gif" 
onclick="form1.action='."'".'editarnumerado.php'."'".';submit();"  width="87" 
height="19"  alt="Modificar Registro" border=0></b>'; 
} 
?> 
			</div> 
			</td> 
        </tr> 
        <tr> 
          <td colspan="6"> 
            <table width="100%" border="1" cellspacing="0" cellpadding="0"> 
              <tr bgcolor="#CCCC99"> 
                <td width="8%"><b><font face="Arial, Helvetica, sans-serif" 
size ="2" color="#006699">selec</font></b></td> 
                <td width="46%"><b><font size="2" face="Arial,Helvetica, 
sans-serif" color="#006699">C�digo</font></b></td> 
                <td width="46%"><b><font size="2"
face="Arial,Helvetica, 
sans-serif" color="#006699">Descripci�n</font></b></td> 
              </tr> 
<?php 
include ( '../src/FunGen/sesion/fncvisreg.php'); 
	$reg[0] = 'numecodi'; 
	$nureturn = fncvisreg('numerado',$reg,$idtrans); 
?> 
            </table> 
          </td> 
        </tr> 
        <tr> 
          <td colspan="2">&nbsp; </td> 
          <td colspan="4"> 
          <div align="right"> 
<?php 
if($detallar){ 
echo  '          <b><input type="image" name="detallar"  
src="../img/verdetal.gif" 
onclick="form1.action='."'".'detallarnumerado.php'."'".';submit();"  width="87" 
height="19" alt="Ver detalle" border=0></b>'; 
} 
if($borrar){ 
echo  '          <b><input type="image" name="borrar"  
src="../img/borrar.gif" 
onclick="form1.action='."'".'borrarnumerado.php'."'".';submit();"  width="87" 
height="19" alt="Borrar Registro" border=0></b>'; 
} 
if($modificar){ 
echo  '          <b><input type="image" name="modificar"  
src="../img/modifica.gif" 
onclick="form1.action='."'".'editarnumerado.php'."'".';submit();"  width="87" 
height="19" alt="Modificar Registro" border=0></b>'; 
} 
?> 
        </div> 
        </td> 
        </tr> 
        <tr> 
          <td width="315">&nbsp;</td> 
          <td width="50"><input type="image" name="primero"  
src="../img/primero.gif" 
onclick="foo(3);form1.action='maestablnumerado.php';submit();" 
alt="Primero"></td> 
          <td width="57"><input type="image" name="adelanta"  
src="../img/adelanta.gif" 
onclick="foo(2);form1.action='maestablnumerado.php';submit();" 
alt="Anterior"></td> 
			<td width="53"> 
<?php 
echo '          <font color="#006699" size="2" face="Arial, Helvetica, 
sans-serif">'.$intervalo[inicio].'-'.$intervalo[fin].' de  
'.$intervalo[total].'</font>'; 
?> 
          </td> 
          <td width="56"><input type="image" name="atras2"  
src="../img/atrasa.gif" 
onclick="foo(1);form1.action='maestablnumerado.php';submit();" 
alt="Siguiente"></td> 
          <td width="53"><input type="image" name="ultimo"  
src="../img/ultimo.gif" 
onclick="foo(4);form1.action='maestablnumerado.php';submit();" 
alt="Ultimo"></td> 
        </tr> 
        <tr> 
          <td colspan="4" background="../img/panel2.gif"><font 
color="669999"><b><font size="3" face="Arial, Helvetica, sans-serif" 
color="#006699">Seleccione 
            item(s) y...</font></b></font></td> 
          <td colspan="2" 
background="../img/panel1.gif">&nbsp;</td> 
        </tr> 
      </table> 
      </td> 
  </tr> 
</table> 
<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
<input type="hidden" name="inicio" value="<?php echo $intervalo[inicio]; ?>"> 
<input type="hidden" name="fin" value="<?php echo $intervalo[fin]; ?>"> 
<input type="hidden" name="nombtabl" value="numerado"> 
<input type="hidden" name="columnas" value="numecodi, 
numedesc, 
numeprox 
"> 
<input type="hidden" name="numecodi" value="<?php echo $numecodi; ?>"> 
<input type="hidden" name="numedesc" value="<?php echo $numedesc; ?>"> 
<input type="hidden" name="numeprox" value="<?php echo $numeprox; ?>"> 
<input type="hidden" name="accionconsultarnumerado" value="<?php echo 
$accionconsultarnumerado; ?>"> 
<input type="hidden" name="nuevo" value="<?php echo $nuevo; ?>"> 
<input type="hidden" name="borrar" value="<?php echo $borrar; ?>"> 
<input type="hidden" name="consultar" value="<?php echo $consultar; ?>"> 
<input type="hidden" name="detallar" value="<?php echo $detallar; ?>"> 
<input type="hidden" name="modificar" value="<?php echo $modificar; ?>"> 
<input type="hidden" name="mov"> 
</form> 
<p>&nbsp;</p></body> 
<?php 
    if(!$codigo) 
    { echo " -->"; } 
?> 
</html> 
