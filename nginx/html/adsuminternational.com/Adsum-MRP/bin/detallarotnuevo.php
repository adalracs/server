<?php
include ( '../src/FunGen/sesion/fncvalses.php');
include ( '../src/FunPerPriNiv/pktblplanta.php');
include ( '../src/FunPerPriNiv/pktblsistema.php');
include ( '../src/FunPerPriNiv/pktblequipo.php');
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
include ( '../src/FunPerPriNiv/pktblcomponen.php');
include ( '../src/FunPerPriNiv/pktblusuariotareot.php');
include ( '../src/FunPerPriNiv/pktblusuario.php');
include ( '../src/FunPerPriNiv/pktbltareotherramie.php');
include ( '../src/FunPerPriNiv/pktblotestado.php');
include ( '../src/FunPerPriNiv/pktblitemtareot.php');

//****
$nuConn=fncconn();
if ($nuConn)
{
	$sbSql="SELECT MAX(ordtracodigo) from ot;";
	$nuResult = pg_exec($nuConn,$sbSql);
	unset($sbSql);

	if ($nuResult)
	{
		$ordtracodigomax=pg_fetch_row($nuResult);

		if ($ordtracodigomax)
		{
			$sbSql = "SELECT ordtracodigo,ordtrafecgen,plantanombre,sistemnombre,ordtrahorgen,tipmannombre,equiponombre,ordtradescri,ordtrafecini,ordtrahorini,ordtrafecfin,ordtrahorfin,ordtranota from ot,planta,sistema,tipomant,equipo where ordtracodigo=".$ordtracodigomax[0]." and ot.plantacodigo=planta.plantacodigo and ot.sistemcodigo=sistema.sistemcodigo and ot.equipocodigo=equipo.equipocodigo and ot.tipmancodigo=tipomant.tipmancodigo;";

			$nuResult = pg_exec($nuConn,$sbSql);
			unset($sbSql);

			if ($nuResult)
			{
				$sbreg = pg_fetch_row($nuResult);

				if (!$sbreg)
				{
					die();
				}
				include('detallaot.php');
				
			}
		}
	}
}			
?>

<html>
<head>
<title>Detalle de registro de ot</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta http-equiv="expires" content="0">
<link rel="stylesheet" type="text/css" href="temas/Noise/Style.css">
<SCRIPT LANGUAGE="JavaScript">
<!-- Begin
agree = 0;
//  End -->
</script>
<script language="JavaScript" src="motofech.js"></script>
</head>

<?php
if(!$codigo)
{ echo "<!--";}
?>
<body bgcolor="FFFFFF" text="#000000">
<form name="form1" method="post"  enctype="multipart/form-data">
<p><font class="NoiseFormHeaderFont">Orden de trabajo</font></p>
<table border="0" cellspacing="1" cellpadding="2" align="center" class="NoiseFormTABLE">
<tr>
	<td width="708" class="NoiseErrorDataTD">&nbsp;</td>
</tr>
  <tr>
	<td class="NoiseFieldCaptionTD"><span class="style5"><font color="FFFFFF">
Detallar registro</font></span>
	</td>
</tr>
<tr>
  <td><table width="97%" border="0" cellspacing="0" cellpadding="0" align="center">
 <tr>
 <td colspan="6">&nbsp;</td>
 </tr>
 <tr>
	<td><table width="97%" border="0" cellspacing="0" cellpadding="0" align="center">
	<tr>
			<td>C&oacute;digo</td>
  			<td><input name="ordtracodigo" type="text" value="<?php if(!$flagdetallarot){ echo $sbreg[ordtracodigo];}else{ echo $ordtracodigo;} ?>" size="12" onFocus="if (!agree)this.blur();" ></td>
  			<td colspan="2">Fecha :&nbsp;&nbsp;
  			<input name="annogen" type="text"	value="<?php if(!$flagdetallarot){echo $anno1;}else{ echo $annogen;}?>" size="4" maxlength="4" onFocus="if (!agree)this.blur();">-<input name="mesgen" type="text"	value="<?php if(!$flagdetallarot){ echo $mesgen;}else{ echo $mesgen;}?>" size="2" maxlength="2" onFocus="if (!agree)this.blur();">-
					   <input name="diagen" type="text"	value="<?php if(!$flagdetallarot){echo $diagen;}else{ echo $diagen;}?>" size="2" maxlength="2">&nbsp;<span class="style1" onFocus="if (!agree)this.blur();"></span></td>
  			<td><div align="right">Hora :&nbsp;&nbsp;</div></td>
  			<td><input name="horagen" type="text"	value="<?php if(!$flagdetallarot){echo $horagen;}else{ echo $horagen;}?>" size="2" maxlength="2" onFocus="if (!agree)this.blur();">:
              	<input name="minutogen" type="text" value="<?php if(!$flagdetallarot){echo $minutogen;}else{ echo $minutogen;}?>" size="2" maxlength="2" onFocus="if (!agree)this.blur();"></td>

  	</tr>
  	 <tr>
			<td colspan="6"><hr></td>
		</tr>
 <tr>
	<td>Centro industrial</td>
	<td>&nbsp;</td>
  	<td>Taller</td>
	<td>&nbsp;</td>
  	<td>Equipo</td>
  	<td>&nbsp;</td>
 </tr>
<tr>
  <td colspan="2"><input type="text" name="plantacodigo" value="<?php if(!$flagdetallarot){ echo $sbregplannom;}else{ echo $sbregplannom;} ?>" size="25" onFocus="if (!agree)this.blur();"></td>
  <td colspan="2"><input type="text" name="sistemcodigo" value="<?php if(!$flagdetallarot){ echo $sbregsistnom;}else{ echo $sbregsistnom;} ?>" size="25" onFocus="if (!agree)this.blur();" ></td>
  <td colspan="2"><input type="text" name="equipocodigo" value="<?php if(!$flagdetallarot){ echo $sbregequinom;}else{ echo $sbregequinom;} ?>" size="25" onFocus="if (!agree)this.blur();"></td>
</tr>
<tr>
  <td colspan = "6">&nbsp;</td>
</tr>
 <tr>
 <td width="17%">Tipo de mantenimiento</td>
 <td width="16%"><input type="text" name="tipmancodigo" value="<?php if(!$flagdetallarot){ echo $sbregtipmanom;}else{ echo $sbregtipmanom;} ?>" onFocus="if (!agree)this.blur();" ></td>
 <td width="13%" align="right">Prioridad</td>
 <td colspan="2">&nbsp;&nbsp;&nbsp;<input name="prioricodigo" type="text" value="<?php if(!$flagdetallarot){ echo $sbregpriornom;}else{ echo $sbregpriornom;} ?>" onFocus="if (!agree)this.blur();" ></td>
 <td width="22%">&nbsp;</td>
 </tr>
 <tr>
 <td width="17%">Descripci&oacute;n</td>
  <td colspan="5">
   <textarea name="ordtradescri" cols="60" rows="3" wrap="VIRTUAL" onFocus="if (!agree)this.blur();"><?php if(!$flagdetallarot){ echo $sbreg[ordtradescri];}else{ echo $ordtradescri;} ?></textarea>
  </td>
  </tr>
  <tr>
			<td width="17%">Fecha de inicio</td>
            <td colspan="2"><input name="anno" type="text"	value="<?php if(!$flagdetallarot){echo $anno;}else{ echo $anno;}?>" size="4" maxlength="4" onFocus="if (!agree)this.blur();">-<input name="mes" type="text"	value="<?php if(!$flagdetallarot){echo $mes;}else{ echo $mes;}?>" size="2" maxlength="2" onFocus="if (!agree)this.blur();">-
							<input name="dia" type="text"	value="<?php if(!$flagdetallarot){echo $dia;}else{ echo $dia;}?>" size="2" maxlength="2" onFocus="if (!agree)this.blur();">&nbsp;<span class="style1">aaaa-mm-dd</span>
			</td>
            <td><div align="right">Hora inicio&nbsp;</div></td>
			<td><input name="hora" type="text"	value="<?php if(!$flagdetallarot){echo $hora;}else{ echo $hora;}?>" size="2" maxlength="2" onFocus="if (!agree)this.blur();">:
                <input name="minuto" type="text"	value="<?php if(!$flagdetallarot){echo $minuto;}else{ echo $minuto;}?>" size="2" maxlength="2" onFocus="if (!agree)this.blur();">&nbsp;
			</td>
            <td colspan="1">&nbsp;<span class="style1">hh:mm</span></td>
	</tr>
  		<tr>
 			<td width="17%">Fecha de fin</td>
  			<td colspan="2"><input name="anno1" type="text"	value="<?php if(!$flagdetallarot){echo $anno1;}else{ echo $anno1;}?>" size="4" maxlength="4" onFocus="if (!agree)this.blur();">-<input name="mes1" type="text"	value="<?php if(!$flagdetallarot){ echo $mes1;}else{ echo $mes1;}?>" size="2" maxlength="2" onFocus="if (!agree)this.blur();">-
							<input name="dia1" type="text"	value="<?php if(!$flagdetallarot){echo $dia1;}else{ echo $dia1;}?>" size="2" maxlength="2" onFocus="if (!agree)this.blur();">&nbsp;<span class="style1">aaaa-mm-dd</span></td>
	        <td><div align="right">Hora fin&nbsp;</div></td>
            <td><input name="hora1" type="text"	value="<?php if(!$flagdetallarot){echo $hora1;}else{ echo $hora1;}?>" size="2" maxlength="2" onFocus="if (!agree)this.blur();">:
              	<input name="minuto1" type="text" value="<?php if(!$flagdetallarot){echo $minuto1;}else{ echo $minuto1;}?>" size="2" maxlength="2" onFocus="if (!agree)this.blur();">
			</td>
            <td colspan="1">&nbsp;<span class="style1">hh:mm</span></td>
		</tr>
<tr>
			<td colspan="6"><hr></td>
		</tr>
 	</table></td>
</tr>
<tr>
  <td><table width="97%" border="0" cellspacing="0" cellpadding="0" align="center">
<tr>
 <td colspan="3">Empleado de mantenimiento</td>
 <td>C&oacute;digo</td>
 <td><input name="usuacodigo" type="text"	value="<?php if(!$flagdetallarot){ echo $usuacodigo;} else {echo $usuacodigo;} ?>" size="8" onFocus="if (!agree)this.blur();"></td>
 <td colspan="3">Nombre&nbsp;&nbsp;
  <input type="text" name="sbregusuanom" value="<?php if(!$flagdetallarot){ echo $sbregusuanom;}else{ echo $sbregusuanom;} ?>" size="25" onFocus="if (!agree)this.blur();" ></td>
</tr>
    <tr>
      <td colspan="8">&nbsp;</td>
    </tr>
 <tr>
 <td colspan="3">Auxiliares de mantenimiento  </td>
 <td colspan="5">&nbsp;</td>
</tr>
    <tr>
      <td colspan="8">&nbsp;</td>
    </tr>
   <tr>
      <td colspan="3" rowspan="2"><div align="left">
       <select name="sbregusuaselec" size="3">
   <?php
   if (!$flagdetallarot)
   {
   	include('../src/FunGen/floadusuaaux.php');
   	$idcon = fncconn();
   	floadusuaaux($idcon,$sbregusuaselec);
   	fncclose($idcon);
   }
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
  <td colspan="2"><input name="sbregtipotnom" type="text" onFocus="if(!agree)this.blur();" value="<?php if(!$flagdetallarot){ echo $sbregtipotnom;}else{ echo $sbregtipotnom;} ?>" size="20" ></td>
  <td>&nbsp;</td>
 <td width="10%">Tarea</td>
  <td width="10%"><input type="text" name="sbregtareanom" value="<?php if(!$flagdetallarot){ echo $sbregtareanom;}else{ echo $sbregtareanom;} ?>" onFocus="if (!agree)this.blur();" size="25"></td>
  <td colspan="2">&nbsp;</td>
 </tr>
<tr>
 <td width="13%">Descripci&oacute;n del trabajo a realizar</td>
  <td height="36" colspan="7"><textarea name="sbregtarnota" cols="60" rows="3" wrap="VIRTUAL" onFocus="if (!agree)this.blur();"><?php if(!$flagdetallarot){ echo $sbregtarnota;}else{ echo $sbregtarnota;} ?></textarea></td>
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
	<td>&nbsp;</td>
	</tr>
	<tr>
	    	<td width="13%" rowspan="2"><select name="sbregherrselec" size="3">
	    	<?php
		     	if (!$flagdetallarot)
		       {
					include('../src/FunGen/floadtransacherramie.php');
					$idcon = fncconn();
					floadtransacherramie($idcon,$herrseleccodi,$herrseleccant);
					fncclose($idcon);
		       }
    		?></select></td>
	    	<td colspan="4">&nbsp;</td>
	    	<td width="16%" rowspan="2"><div align="left"><select name="sbregitemtareot" size="3">
	    	<?php
		     	if (!$flagdetallarot)
		       {
		       		include('../src/FunGen/floadtransacitem.php');
					$idcon = fncconn();
					floadtransacitem($idcon,$itemseleccodi,$itemseleccant);
					fncclose($idcon);
		       }
    		?></select> </div></td>
	    	<td colspan="2"></td>
	</tr>
  </table></td>
</tr>
	<tr>
	  <td>
	  &nbsp;
	  </td>
	</tr>
 <tr>
<td>
<div align="center">
  <input type="image" name="aceptar"  src="../img/aceptar.gif"
onclick="form1.action='maestablot.php';"  width="86" height="18" alt="Aceptar"
border=0>
  <input type="image" name="imprimir"  src="../img/imprimir.gif"
onclick="window.open('detallaotprint.php','printReport','status=no,menubar=no,scrollbars=yes,resizable=yes,left=600,width=600,height=500'); return false;"  width="86" height="18" alt="Aceptar"
border=0>
</div>
</td>
 </tr>
 <tr>
  <td class="NoiseErrorDataTD">&nbsp;</td>
 </tr>
</table>
 <input type="hidden" name="flagdetallarot" value="1">
<input type="hidden" name="acciondetallarot">
<input type="hidden" name="codigo" value="<?php echo $codigo; ?>">


</form>
<!-- Hidden SPAN -->
<SPAN id="printFrame1" style="display:none;">

<CENTER>
<?php
$codigoot 	  = $sbreg['ordtracodigo'];
$tipmancodigo = $sbreg['tipmancodigo'];
$plantacodigo = $sbreg['plantacodigo'];
$sistemcodigo = $sbreg['sistemcodigo'];
$equipocodigo = $sbreg['equipocodigo'];
$componcodigo = $sbreg['componcodigo'];
// ----
if ($hora > 12)
{
	$hora -= 12;
	$pasadmerini = true;
}
if ($hora1 > 12)
{
	$hora1 -= 12;
	$pasadmerfin = true;
}
$horini	= $hora;
$minini	= $minuto;
$horfin	= $hora1;
$minfin	= $minuto1;
include("detallaotaux.php");

$idcon = fncconn();
$arrotestado = loadrecordotestado($arrTareot['otestacodigo'], $idcon);
$arrpriorida = loadrecordpriorida($arrTareot['prioricodigo'], $idcon);
$arrtipotrab = loadrecordtipotrab($arrTareot['tiptracodigo'], $idcon);
$arrtarea 	 = loadrecordtarea($arrTareot['tareacodigo'], $idcon);
fncclose($idcon);
// Output buffering
ob_start();
?>
<table width="100%" border="0">
<tr>
 <td bgcolor="#5961A0" colspan="3"><FONT face="Verdana" color="White">Orden de trabajo</FONT></td>
</tr>
<tr bgcolor="#F2F3F8">
  <td width="40%"><B>Fecha:</B>&nbsp;<?php echo  $annogen; ?>-<?php echo  $mesgen; ?>-<?php echo  $diagen; ?></td>
  <td width="30%"><B>N&uacute;mero OT:</B>&nbsp;<?php echo  $codigoot; ?></td>
  <td><B>Estado:</B>&nbsp;<?php echo  $arrotestado['otestanombre']; ?></td>
</tr>
<tr bgcolor="#F8FAFB">
 <td colspan="2"><B>Tipo de mantenimiento:</B>&nbsp;<?php echo  $arrtipomant['tipmannombre']; ?></td>
 <td><B>Prioridad:</B>&nbsp;<?php echo  $arrpriorida['priorinombre']; ?></td>
</tr>
<tr>
 <td bgcolor="#E8F0F6" colspan="3"><B>Planta</B></td>
</tr>
<tr bgcolor="#F8FAFB">
 <td><B>C&oacute;digo:</B>&nbsp;<?php echo  $arrplanta['plantacodigo']; ?></td>
 <td><B>Nombre:</B>&nbsp;<?php echo  $arrplanta['plantanombre']; ?></td>
 <td>&nbsp;</td>
</tr>
<tr>
 <td bgcolor="#E8F0F6" colspan="3"><B>Sistema</B></td>
</tr>
<tr bgcolor="#F8FAFB">
 <td><B>C&oacute;digo:</B>&nbsp;<?php echo  $arrsistema['sistemcodigo']; ?></td>
 <td><B>Nombre:</B>&nbsp;<?php echo  $arrsistema['sistemnombre']; ?></td>
 <td>&nbsp;</td>
</tr>
<tr>
 <td bgcolor="#E8F0F6" colspan="3"><B>Equipo</B></td>
</tr>
<tr bgcolor="#F8FAFB">
 <td><B>C&oacute;digo:</B>&nbsp;<?php echo  $arrequipo['equipocodigo']; ?></td>
 <td><B>Nombre:</B>&nbsp;<?php echo  $arrequipo['equiponombre']; ?></td>
 <td>&nbsp;</td>
</tr>
<tr>
 <td bgcolor="#E8F0F6" colspan="3"><B>Descripci&oacute;n del da&ntilde;o</B></td>
</tr>
<tr bgcolor="#F8FAFB">
 <td colspan="3"><?php echo  $sbreg['ordtradescri']; ?></td>
</tr>
<tr>
 <td bgcolor="#E8F0F6" colspan="3"><B>Horarios</B></td>
</tr>
<tr bgcolor="#F8FAFB">
 <td><B>Fecha de inicio:</B>&nbsp;<?php echo  $anno; ?>-<?php echo  $mes; ?>-<?php echo  $dia; ?> </td>
 <td colspan="2"><B>Hora de inicio:</B>&nbsp;<?php echo  $horini.":".$minini; if ($pasadmerini) echo " PM"; else echo " AM"; ?></td>
</tr>
<tr bgcolor="#F8FAFB">
 <td><B>Fecha de fin:</B>&nbsp;<?php echo  $anno1; ?>-<?php echo  $mes1; ?>-<?php echo  $dia1; ?></td>
 <td colspan="2"><B>Hora de fin:</B>&nbsp;<?php echo  $horfin.":".$minfin; if ($pasadmerfin) echo " PM"; else echo " AM"; ?></td>
</tr>
<tr>
 <td bgcolor="#BBCCEC" colspan="3"><B>Empleados involucrados en la OT</B></td>
</tr>
<tr bgcolor="#EBF0FA">
 <td><B>Encargado</B></td>
 <td><B>C&oacute;digo:</B>&nbsp;<?php echo  $arrUsuLider['usuacodi']; ?></td>
 <td><B>Nombre:</B>&nbsp;<?php echo  $arrUsuLider['usuanombre']; ?></td>
</tr>
<?php
if ($flagUsuAux)
{
	include("../src/FunGen/fnccargausuaauxot.php");

	fnccargausuaauxot($arrUsuAux);
}
?>
<!-- -->
<tr>
 <td bgcolor="#D9D9F3" colspan="3"><B>Trabajo a realizar</B></td>
</tr>
<tr>
 <td><B>Tipo de trabajo:</B>&nbsp;<?php echo  $arrtipotrab['tiptranombre']; ?></td>
 <td colspan="2"><B>Tarea:</B>&nbsp;<?php echo  $arrtarea['tareanombre']; ?></td>
</tr>
<tr>
 <td colspan="3"><B>Descripci&oacute;n del trabajo a realizar:</B></td>
</tr> 
<tr>
 <td><?php echo  $arrTareot['tareotnota']; ?></td>
</tr>
<?php
if ((!$flagNoHerramie) || (!$flagNoItem))
{
	echo "<tr>";
	echo " <td bgcolor=\"#E0E0FD\" colspan=\"3\"><B>Herramientas y/o items utilizados</B></td>";
	echo "</tr>";
}
if (!$flagNoItem)
{
	include("../src/FunGen/fnccargaitemotaux.php");
	fnccargaitemotaux($sbregItemCantid);
}

if (!$flagNoHerramie)
{
	include("../src/FunGen/fnccargaherrotaux.php");
	fnccargaherrotaux($sbregHerramieCantid);
}
?>
<!-- Herramientas y/o Items -->
</table>
</CENTER>
<?php $_SESSION['htmlreport'] = ob_get_contents(); ?>
</SPAN>
<!-- End of hidden SPAN -->
</body>
<?php
if(!$codigo)
{ echo " -->"; }
?>
</html>