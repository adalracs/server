<?php 
include ( '../src/FunGen/sesion/fncvalses.php'); 
include ( '../src/FunPerPriNiv/pktblplanta.php');
include ( '../src/FunPerPriNiv/pktblsistema.php');
include ( '../src/FunPerPriNiv/pktblequipo.php');
include ( '../src/FunPerPriNiv/pktblcomponen.php');
include ( '../src/FunPerPriNiv/pktblitem.php');
include ( '../src/FunPerPriNiv/pktbloperacio.php');
include ( '../src/FunPerPriNiv/pktbltipomant.php');
include ( '../src/FunPerPriNiv/pktblpriorida.php');
include ( '../src/FunPerPriNiv/pktbltarea.php');
include ( '../src/FunPerPriNiv/pktblherramie.php');
include ( '../src/FunPerPriNiv/pktbltransacherramie.php');
include ( '../src/FunPerPriNiv/pktbltransacitem.php');
include ( '../src/FunPerPriNiv/pktbltipotrab.php');
include ( '../src/FunPerPriNiv/pktbltareot.php');
include ( '../src/FunPerPriNiv/pktblusuariotareot.php');
include ( '../src/FunPerPriNiv/pktblusuario.php');
include ( '../src/FunPerPriNiv/pktbltareotherramie.php');
include ( '../src/FunPerPriNiv/pktblitemtareot.php');
include ( '../src/FunPerPriNiv/pktbltipomedi.php');
include ( '../src/FunPerPriNiv/pktblprogramacion2.php');

if(!$flagborrarprogramacion)
{
	include ( '../src/FunGen/sesion/fnccarga.php');
	$sbreg = fnccarga($nombtabl,$radiobutton);
	if (!$sbreg)
	{
		include( '../src/FunGen/fnccontfron.php');
	}
	include ('detallaprogramacion2.php');
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
<title>Borrar registro de programaci&oacute;n</title> 
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
<p><font class="NoiseFormHeaderFont">Programaci&oacute;n</font></p> 
<table border="0" cellspacing="1" cellpadding="2" align="center" class="NoiseFormTABLE"> 
  <tr> 
    <td width="708" class="NoiseErrorDataTD">&nbsp;</td> 
  </tr> 
  <tr> 
          <td class="NoiseFieldCaptionTD"><span class="style5"><font color="FFFFFF">Borrar registro</font></span></td></tr> 
<tr> 
	<td> 
		<table width="90%" border="0" cellspacing="0" cellpadding="0" align="center"> 
		<tr>
			<td width="21%" class="NoiseFooterTD">C&oacute;digo</td>
  			<td width="22%">
  			<?php if(!$flagborrarprogramacion){ echo $progracodigo;} else{ echo $progracodigo;} ?></td>
  			<td class="NoiseFooterTD">Fecha </td>
  			<td colspan="3"><?php if(!$flagborrarprogramacion){echo $sbregProgram[prografecgen];}?>
		    <?php if(!$flagborrarprogramacion){echo substr($sbregProgram[prograhorgen],0,5);}?></td>
		  </tr>
  			<tr>
				<td colspan="2" class="NoiseFooterTD">Planta</td>
			  <td colspan="2" class="NoiseFooterTD">Sistema</td>
			  <td colspan="2" class="NoiseFooterTD">&nbsp;&nbsp;&nbsp;Equipo</td>
		  </tr>
			<tr> 
			  <td colspan="2">
			  <?php if(!$flagborrarprogramacion){ echo $plantanombre;}else{ echo $sbregplannom;} ?></td> 	
			  <td colspan="2">
			  <?php if(!$flagborrarprogramacion){ echo $sistemnombre;}else{ echo $sbregsisnom;} ?></td> 
			  <td colspan="2">&nbsp;&nbsp;&nbsp;
			  <?php if(!$flagborrarprogramacion){ echo $equiponombre;}else{ echo $sbregequinom;} ?></td> 
			</tr> 
			<tr>
				<td class="NoiseFooterTD">Tipo de mantenimiento</td>
			  <td>
				<?php if(!$flagborrarprogramacion){ echo $tipmannombre;}else{ echo $sbregtipmanom;} ?></td>
			  <td width="16%" class="NoiseFooterTD">Tipo de medidor</td>
			  <td width="15%"><?php if(!$flagborrarprogramacion){ echo $tipmednombre;}else{ echo $sbregtipmednom;} ?></td>
			  <td width="13%" class="NoiseFooterTD">Frecuencia</td>
			  <td width="13%"><?php if(!$flagborrarprogramacion){ echo $sbregProgram[prografrecue];}?>
&nbsp;
<?php if($tipmedcodigo){ echo $arrtipomedi[tipmedacra];} ?></td>
			</tr>
 			<tr>
 				<td class="NoiseFooterTD">Duraci&oacute;n&nbsp;</td>
 				<td><?php if(!$flagborrarprogramacion){ echo $sbregProgram[progratiedur];}?>
			    &nbsp;horas</td>
 				<td colspan="2" class="NoiseFooterTD">&nbsp;&nbsp;Fecha Inicio</td>
 				<td><?php if(!$flagborrarprogramacion){ echo $sbregProgram[prografecini];}?></td>
 				<td><?php if(!$flagborrarprogramacion){echo substr($sbregProgram[prograhorini],0,5);}?></td>
 			</tr>
 			<tr>
 			  <td colspan="2" class="NoiseFooterTD">Colaborador de mantenimiento</td>
 			  <td><?php if(!$flagborrarprogramacion){ echo $sbregProgram[usuacodi];} else {echo $usuacodigo;} ?></td>
 			  <td><?php if(!$flagborrarprogramacion){ echo $nombre;}else{ echo $sbregusuanom;} ?></td>
 			  <td class="NoiseFooterTD">Prioridad</td>
 			  <td><?php if(!$flagborrarprogramacion){ echo $prioridad;}else{ echo $sbregtareanom;} ?></td>
		  </tr>
		</table>
	</td>
</tr>
<tr>
	<td>&nbsp;</td> 
 </tr> 
 <tr> 
<td> 
<div align="center"> 
  <input type="image" name="aceptar"  src="../img/aceptar.gif" 
  onClick="form1.accionborrarprogramacion.value = 1; 
  form1.action='maestablprogramacionequipos.php';"  width="86" height="18" alt="Aceptar" border=0> 
  <input type="image" name="cancelar" src="../img/cancelar.gif" 
  onClick="form1.action='maestablprogramacionequipos.php';"  width="86" height="18" alt="Cancelar" border=0> 
</div> 
</td> 
 </tr> 
 <tr> 
  <td class="NoiseErrorDataTD">&nbsp;</td> 
 </tr> 
</table> 
 <input type="hidden" name="flagborrarprogramacion" value="1"> 
<input type="hidden" name="accionborrarprogramacion"> 
<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
<input type="hidden" name="progracodigo" value="<?php echo $progracodigo; ?>">
</form> 
</body> 
<?php 
    if(!$codigo) 
    { echo " -->"; } 
?> 
</html> 
