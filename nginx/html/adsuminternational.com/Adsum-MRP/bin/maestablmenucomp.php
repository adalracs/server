<?php 
   include ( '../src/FunGen/sesion/fnccantrow.php');
   include ( '../src/FunGen/sesion/fnccantrow1.php');
   include ( '../src/FunPerPriNiv/limitscan.php');
   include ( '../src/FunGen/sesion/fncvalses.php');
   include ( '../src/FunGen/sesion/fnccaf.php');
   $reccomact = fnccaf($GLOBALS[usuacodi],$PATH_TRANSLATED);
   include ( '../src/FunGen/sesion/fncalmdat.php');
if($accionborrarmenucomp)
{
	include ( 'borramenucomp.php');
}
else
{
	if($accioneditarmenucomp)
	{
		include ( 'editamenucomp.php');
	}
	else
	{
		if($accionnuevomenucomp)
		{
			include ( 'grabamenucomp.php');
		}
		else
		{
			if($accionconsultarmenucomp)
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
					$accionconsultarmenucomp = 0;
				}
			}
		}
	}
}
include ( '../src/FunGen/sesion/fncaumdec.php');
?>
<!-- C�digo creado por:
Andr�s Riascos
Fecha: 11012002 -->
<html>
<head>
<title>Registros de Menu Comp</title>
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
<table width="100%" border="1" cellspacing="0" cellpadding="15" bordercolor="#009933" align="center">
  <tr>
    <td>
        <table width="100%" border="0" cellspacing="0" cellpadding="5" align="center">
          <tr>
            <td colspan="6"><font face="Arial, Helvetica, sans-serif" size="3"><b><font color="#006699">Menu componente</font></b></font></td>
          </tr>
          <tr>
            <td colspan="6" background="../img/panel.gif">&nbsp;</td>
          </tr>
          <tr>
            <td>
              <?php 
if($reccomact[nuevo]){
echo '       <input type="image" name="nuevo"
src="../img/nuevo.gif"
onclick="form1.action='."'".'ingrnuevmenucomp.php'."'".';submit();"  width="86"
height="18" alt="Nuevo Registro" border=0>';
}
if($reccomact[consultar]){
echo '            <input type="image" name="consultar"
src="../img/consulta.gif"
onclick="form1.action='."'".'consultarmenucomp.php'."'".';submit();"
width="86" height="18" alt="Consultar" border=0>';
}
?>
            </td>
            <td width="42">
              <input type="image" name="adelanta"
src="../img/adelanta.gif"
onclick="foo(2);form1.action='maestablmenucomp.php';submit();"
alt="Anterior">
            </td>
            <td width="46"><font size="2" color="#CC9900">Anterior</font></td>
            <td width="50">
              <?php 
	$intervalo =
fncaumdec('menucomp',$inicio,$fin,$mov,$accionconsultarmenucomp,$recarreglo);
	$cantrow = $intervalo[total];
	if($intervalo[idtrans]){ $idtrans = $intervalo[idtrans]; }
?>
            </td>
            <td width="53">
              <div align="right"><font color="#CC9900" size="2">Siguiente</font></div>
            </td>
            <td width="53">
              <input type="image" name="atras"
src="../img/atrasa.gif"
onclick="foo(1);form1.action='maestablmenucomp.php';submit();"
alt="Siguiente">
            </td>
          </tr>
          <tr>
            <td colspan="6">
              <div align="right"><?php 
if($reccomact[detallar]){
echo '          <input type="image" name="detallar"
src="../img/verdetal.gif"
onclick="form1.action='."'".'detallarmenucomp.php'."'".';submit();"  width="87"
height="19"  alt="Ver detalle" border=0>';
}
if($reccomact[borrar]){
echo '         <input type="image" name="borrar"
src="../img/borrar.gif"
onclick="form1.action='."'".'borrarmenucomp.php'."'".';submit();"  width="87"
height="19"  alt="Borrar Registro" border=0>';
}
if($reccomact[modificar]){
echo '          <input type="image" name="modificar"
src="../img/modifica.gif"
onclick="form1.action='."'".'editarmenucomp.php'."'".';submit();"  width="87"
height="19"  alt="Modificar Registro" border=0>';
}
?>
            </div></td>
		  </tr>
          <tr>
            <td colspan="6">
              <table width="100%" border="1" cellspacing="0" cellpadding="0">
                <tr bgcolor="#CCCC99">
                  <td width="8%"><b><font face="Arial, Helvetica, sans-serif" size="2" color="#006699">Selec.</font></b></td>
                  <td width="46%"><b><font size="2" face="Arial,Helvetica,
sans-serif" color="#006699">c�digo</font></b></td>
                  <td width="46%"><b><font size="2"
face="Arial,Helvetica,
sans-serif" color="#006699">Nombre</font></b></td>
                </tr>
                <?php 
include ( '../src/FunGen/sesion/fncvisreg.php');
	$reg[0] = 'mecocodi';
	$reg1[0] = 'n';
	$nureturn = fncvisreg('menucomp',$reg,$reg1,$idtrans);
?>
              </table>
            </td>
          </tr>
          <tr>
            <td colspan="6">
            <div align="right"><?php 
if($reccomact[detallar]){
echo  '          <input type="image" name="detallar"
src="../img/verdetal.gif"
onclick="form1.action='."'".'detallarmenucomp.php'."'".';submit();"  width="87"
height="19" alt="Ver detalle" border=0>';
}
if($reccomact[borrar]){
echo  '          <input type="image" name="borrar"
src="../img/borrar.gif"
onclick="form1.action='."'".'borrarmenucomp.php'."'".';submit();"  width="87"
height="19" alt="Borrar Registro" border=0>';
}
if($reccomact[modificar]){
echo  '          <input type="image" name="modificar"
src="../img/modifica.gif"
onclick="form1.action='."'".'editarmenucomp.php'."'".';submit();"  width="87"
height="19" alt="Modificar Registro" border=0>';
}
?>
           </div></td>
		  </tr>
          <tr>
            <td>&nbsp;</td>
            <td width="42">
              <input type="image" name="primero"
src="../img/primero.gif"
onclick="foo(3);form1.action='maestablmenucomp.php';submit();"
alt="Primero">
            </td>
            <td width="46">
              <input type="image" name="adelanta"
src="../img/adelanta.gif"
onclick="foo(2);form1.action='maestablmenucomp.php';submit();"
alt="Anterior">
            </td>
            <td width="50">
              <?php 
echo '          <font color="#006699" size="2" face="Arial,
Helvetica, sans-serif">'.$intervalo[inicio].'-'.$intervalo[fin].' de
'.$intervalo[total].'</font>';
?>
            </td>
            <td width="53">
              <input type="image" name="atras2"
src="../img/atrasa.gif"
onClick="foo(1);form1.action='maestablmenucomp.php';submit();"
alt="Siguiente">
            </td>
            <td width="53">
              <input type="image" name="ultimo"
src="../img/ultimo.gif"
onClick="foo(4);form1.action='maestablmenucomp.php';submit();"
alt="Ultimo">
            </td>
          </tr>
          <tr>
            <td colspan="4" background="../img/panel2.gif">&nbsp;</td>
            <td background="../img/panel1.gif" colspan="2">
              <div align="left"></div>
            </td>
          </tr>
        </table>
      </td>
  </tr>
</table>
<input type="hidden" name="codigo" value="<?php  echo $codigo; ?>">
<input type="hidden" name="inicio" value="<?php  echo $intervalo[inicio]; ?>">
<input type="hidden" name="fin" value="<?php  echo $intervalo[fin]; ?>">
<input type="hidden" name="nombtabl" value="menucomp">
<input type="hidden" name="columnas" value="mecocodi,mecocopa,mecoorde,timecodi,meconomb,mecoscri,mecoacra">
<input type="hidden" name="mecocodi" value="<?php  echo $mecocodi; ?>">
<input type="hidden" name="mecocopa" value="<?php  echo $mecocopa; ?>">
<input type="hidden" name="mecoorde" value="<?php  echo $mecoorde; ?>">
<input type="hidden" name="timecodi" value="<?php  echo $timecodi; ?>">
<input type="hidden" name="meconomb" value="<?php  echo $meconomb; ?>">
<input type="hidden" name="mecoscri" value="<?php  echo $mecoscri; ?>">
<input type="hidden" name="mecoacra" value="<?php  echo $mecoacra; ?>">
<input type="hidden" name="accionconsultarmenucomp" value="<?php  echo $accionconsultarmenucomp; ?>">
<input type="hidden" name="mov">
</form>
<p>&nbsp;</p></body>
<?php 
    if(!$codigo)
    { echo " -->"; }
?>
</html>
