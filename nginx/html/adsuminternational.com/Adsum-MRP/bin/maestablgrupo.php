<?php
ob_start(); 
   include ( '../src/FunGen/sesion/fnccantrowfs.php');
   include ( '../src/FunGen/sesion/fnccantrow.php');
   include ( '../src/FunGen/sesion/fnccantrow1.php');
   include ( '../src/FunGen/sesion/fncvalses.php');
   include ( '../src/FunGen/sesion/fnccaf.php');
   $reccomact =  fnccaf($_COOKIE[usuacodi],$_SERVER["SCRIPT_FILENAME"]);
   include ( '../src/FunPerPriNiv/pktblgrupo.php');
   include ( '../src/FunGen/sesion/fncalmdatfs.php');

   if($accionborragrupotemp){
   	include ( 'borragrupotemp.php');
   }
   if($accionborrargrupo){
   	include ( 'borragrupo.php');
   }else{
   	if($accioneditargrupo && !$flageditargrupo){
   		include ( 'editagrupo.php');
   	}else{
   		if($accionnuevogrupo){
   			include ( 'grabagrupo.php');
   		}
   	}
   }
   
/*-- BLOQUE DE CONSULTA--*/

	if(!$columnas)
	{
		$columnas = "grupcodi";
	}
	$nombcamp = strtok ($columnas,",");
	while ($nombcamp)
	{
		$nombcamp = trim($nombcamp);
		$recarreglo[$nombcamp] = trim($$nombcamp);
		$recarregloop[$nombcamp] = 'like';
		$nombcamp = strtok(",");
	}
  
    $recarreglo[grupcodi] = "0";
    $recarregloop[grupcodi] = ">";

/*-- FIN BLOQUE CONSULTA--*/

include ( '../src/FunGen/sesion/fncaumdecfs.php');
include('../src/FunGen/fncpageposition.php');

	$intervalo = fncaumdecfs('grupo',$inicio,$fin,$mov,$accionconsultargrupo,$recarreglo,$recarregloop);
	
	$cantrow = $intervalo[total];
	if($intervalo[idtrans]){ $idtrans = $intervalo[idtrans]; }
	
ob_end_flush(); 
?>
<!-- C�digo creado por:
Andr�s Riascos
Fecha: 12012002 -->
<html>
<head>
<title>Registros de Grupo</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta http-equiv="expires" content="0">
<link rel="stylesheet" type="text/css" href="temas/Noise/Style.css">
<script language=JavaScript src="../src/FunGen/starPage_position.js" type="text/javascript" ></script>
<script language=JavaScript src="../src/FunGen/colorfooter.js" type="text/javascript" ></script>

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
//  End -->
</script>
<script language="JavaScript">
<!-- Begin
   function chang(){document.form1.switche.value=1;}
//  End -->
</script>
</head>
<?php
    if(!$codigo)
    { echo "<!--";}
?>
<body bgcolor="#FFFFFF" text="#000000">
<form name="form1" method="post"  enctype="multipart/form-data">
  <p><font class="NoiseFormHeaderFont">Listado de grupos</font><br>
    <br>
  </p>
  <table border="0" cellspacing="1" cellpadding="2" align="center" class="NoiseFormTABLE">
    <tr> 
      <td colspan="7"  class="NoiseErrorDataTD" align="right"> <?php page_position($intervalo,'maestablgrupo.php',''); ?></td>
    </tr>
    <tr> 
      <td> 
        <?php
if($reccomact[nuevo]){
echo '       <input type="image" name="nuevo"
src="../img/nuevo.gif"
onclick="chang();form1.action='."'".'ingrnuevgrupo.php'."'".';submit();"  width="86"
height="18" alt="Nuevo Registro" border=0>';
}
if($reccomact[consultar]){
echo '            <input type="image" name="consultar"
src="../img/consulta.gif"
onclick="form1.action='."'".'consultargrupo.php'."'".';submit();"  width="86"
height="18" alt="Consultar" border=0>';
}
?>
      </td>
      <td width="42"> 
        <input type="image" name="adelanta"
src="../img/adelanta.gif"
onClick="foo(2);form1.action='maestablgrupo.php';submit();"
alt="Anterior">
      </td>
      <td width="46"><font size="2" color="#CC9900">Anterior</font></td>
      <td width="50"> 
        <?php
	echo $intervalo[inicio].'-'.$intervalo[fin].' de '.$intervalo[total]; 

?>
      </td>
      <td width="53"> 
        <div align="right"><font color="#CC9900" size="2">Siguiente</font></div>
      </td>
      <td width="53"> 
        <input type="image" name="atras"
src="../img/atrasa.gif"
onClick="foo(1);form1.action='maestablgrupo.php';submit();"
alt="Siguiente">
      </td>
    </tr>
    <tr> 
      <td colspan="6"> 
        <div align="right"> 
          <?php
if($reccomact[borrar]){
echo '          <b><input type="image" name="borrar"
src="../img/borrar.gif"
onclick="form1.action='."'".'borrargrupo.php'."'".';submit();" alt="Borrar Registro" border=0></b>';
}
if($reccomact[modificar]){
echo '          <b><input type="image" name="modificar"
src="../img/modifica.gif"
onclick="form1.action='."'".'editargrupo.php'."'".';submit();" alt="Modificar Registro" border=0></b>';
}
?>
        </div>
      </td>
    </tr>
    <tr> 
      <td colspan="6"> 
        <table width="100%" border="0" cellspacing="1" cellpadding="2">
        <tr>
        	<td class="NoiseFieldCaptionTD" width="10%"><span class="style5"><font color="#FFFFFF">Sel.</font></span></td>
	<td class="NoiseFieldCaptionTD" width="90%"><span class="style5"><font color="#FFFFFF">Nombre</font></span></td>
       </tr>  
        

          <?php
    include ( '../src/FunGen/sesion/fncvisregcamp.php');
	$reg[0] = 'grupcodi';
	$reg1[0] = 's';
    $reg2[0] = 'grupnomb';
    $nureturn = fncvisregcamp($reg,$reg1,$reg2,$idtrans);
?>

        </table>
      </td>
    </tr>
    <tr> 
      <td colspan="6"> 
        <div align="right"> 
          <?php
if($reccomact[borrar]){
echo  '          <b><input type="image" name="borrar"
src="../img/borrar.gif"
onclick="form1.action='."'".'borrargrupo.php'."'".';submit();" alt="Borrar Registro" border=0></b>';
}
if($reccomact[modificar]){
echo  '          <b><input type="image" name="modificar"
src="../img/modifica.gif"
onclick="form1.action='."'".'editargrupo.php'."'".';submit();" alt="Modificar Registro" border=0></b>';
}
?>
        </div>
      </td>
    </tr>
    <tr> 
      <td><a href="javascript:;"><img type="image" src="../img/ayuda.gif" name="Ayuda"  onclick="window.open('ayudas/general.html','General','status=no,menubar=no,scrollbars=yes,resizable=yes,left=300,width=900,height=700');" width="86" height="18" alt="Ayuda" border=0 ></a>
	  		</td>
      
      <td width="42"> 
        <input type="image" name="primero" src="../img/primero.gif" onClick="foo(3);form1.action='maestablgrupo.php';submit();" alt="Primero">
      </td>
      <td width="46"> 
        <input type="image" name="adelanta" src="../img/adelanta.gif" onClick="foo(2);form1.action='maestablgrupo.php';submit();" alt="Anterior">
      </td>
      <td width="50"> 
        <?php
	echo $intervalo[inicio].'-'.$intervalo[fin].' de '.$intervalo[total]; 

?>
      </td>
      <td width="53"> 
        <input type="image" name="atras2" src="../img/atrasa.gif" onClick="foo(1);form1.action='maestablgrupo.php';submit();" alt="Siguiente">
      </td>
      <td width="53"> 
        <input type="image" name="ultimo" src="../img/ultimo.gif" onClick="foo(4);form1.action='maestablgrupo.php';" alt="Ultimo">
      </td>
    </tr>
    <tr> 
      <td colspan="6"  class="NoiseErrorDataTD" align="right"> <?php page_position($intervalo,'maestablgrupo.php',''); ?></td>
    </tr>
  </table>
<input type="hidden" name="codigo" value="<?php echo $codigo; ?>">
<input type="hidden" name="inicio" value="<?php echo $intervalo[inicio]; ?>">
<input type="hidden" name="fin" value="<?php echo $intervalo[fin]; ?>">
<input type="hidden" name="nombtabl" value="grupo">
<input type="hidden" name="columnas" value="grupcodi,grupnomb,grupedit">
<input type="hidden" name="grupcodi" value="<?php echo $grupcodi; ?>">
<input type="hidden" name="grupedit" value="<?php echo $grupedit; ?>">
<input type="hidden" name="accionconsultargrupo" value="<?php echo $accionconsultargrupo; ?>">
<input type="hidden" name="mov">
<input type="hidden" name="switche">
</form>
<p>&nbsp;</p></body>
<?php
    if(!$codigo)
    { echo " -->"; }
?>
</html> 
