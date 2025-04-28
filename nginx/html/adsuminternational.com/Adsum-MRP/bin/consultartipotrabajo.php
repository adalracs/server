<?php
include ( '../src/FunGen/sesion/fncvalses.php');
include('../src/FunPerPriNiv/pktblusuaplanta.php');
include ( '../src/FunGen/sesion/fnccaf.php');

$reccomact = fnccaf($GLOBALS[usuacodi], $_SERVER["SCRIPT_FILENAME"]);
?>
<html>
<head>
<title>Tipos de Trabajo</title>
<meta http-equiv="Content-Type" cont	ent="text/html; charset=iso-8859-1">
		<meta http-equiv="expires" content="0">
		<link rel="stylesheet" type="text/css" href="temas/Noise/Style.css">
		<link rel="stylesheet" type="text/css" href="temas/Noise/help.css">
		<SCRIPT LANGUAGE="JavaScript">
			function loadlista(){
				if (document.form1.plant.checked == true){
					document.all("plantas").src="detallarusuaplantareportes.php?plantall=1&arrdata=" + document.form1.arrplantas.value;
					document.form1.plantatmp.value = 1;
				}else{
					document.all("plantas").src="detallarusuaplantareportes.php?plantall=0&arrdata=" ;			
					document.form1.plantatmp.value = 0;		
				}
			}
			 function verocultar(cual) {
			      var c=cual.nextSibling;
			      if(c.style.display=='none') {
			           c.style.display='block';
				document.getElementById("row").src = "temas/Noise/AscOn.gif";			           
			      } else {
			           c.style.display='none';
				document.getElementById("row").src = "temas/Noise/DescOn.gif";			           			           
			      }
			      return false;
			 }
		</script>
</head>
<?php
    if(!$codigo)
    { echo "<!--";}
    
if($accionnuevoreportetipotrab)
{
	include ( 'grabaottipotrabajo.php');
}

$idcon = fncconn();
$arrplantas = loadrecordusuaplanta($GLOBALS[usuacodi],$idcon);
fncclose($idcon);
    
?>
<body bgcolor="FFFFFF" text="#000000">
<form name="form1" method="post"  enctype="multipart/form-data">
<p><font class="NoiseFormHeaderFont">Tipos de Trabajo Realizados</font></p>
<table border="0" cellspacing="1" cellpadding="2" align="center"
class="NoiseFormTABLE" width="70%">
  <tr>
    <td class="NoiseErrorDataTD">&nbsp;</td>
  </tr>
  <tr>
          <td class="NoiseFieldCaptionTD"><span class="style5"><font
color="FFFFFF">Tipos de Trabajo</font></span></td></tr>
<tr>
	<td>
		<table width="93%" border="0" cellspacing="1" cellpadding="1" align="center">
          <!--DWLayoutTable-->
          <tr  class="NoiseFooterTD">
          						<td colspan="4" class="NoiseFooterTD">
									<a onClick="return verocultar(this);" href="javascript:void(0);">Plantas&nbsp;<img id="row"  align="middle"  src="temas/Noise/DescOn.gif" border="0"></a><div style="display: none;">
          									<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center">                            
										<tr><td class="NoiseFieldCaptionTD" colspan="2"></td></tr>
										<tr>
											<!--<td class="NoiseFooterTD" width="10%"><input type="checkbox" name="plant" <?php if($plantatmp){echo "checked";} ?> onChange="loadlista();"></td>-->
											<!--<td class="NoiseFooterTD" width="90%">Todos</td>-->
										</tr>
										<tr><td class="NoiseFieldCaptionTD" colspan="2"></td></tr>
	                        							<tr>
	                              								<td height="110" colspan="2" class="NoiseFooterTD"><iframe src="detallarusuaplantareportes.php?plantall=<?php echo $plantatmp; ?>&arrdata=<?php echo $arrplantas; ?>" frameborder="0" name="plantas" id = "plantagen"  height="110" width="100%" align="absmiddle"></iframe></td>
                            								</tr>
	                            						</table>
          									</div>          								</td>
          							</tr>
          <tr> 
            <td class="NoiseColumnTD" colspan="3">Seleccione el periodo de tiempo 
              a observar.</td>
          </tr>
         
          <tr> 
            <td height="27" colspan="3" valign="top"><HR/></td>
          </tr>
    
          <tr> 
            <td height="28" valign="top" class="NoiseFooterTD"><B>Periodo a observar</B></td>
            <td width="190" valign="top" class="NoiseDataTD">Fecha inicial&nbsp; <input type="text" name="fecini" size="8" onfocus="if(!agree)this.blur();" /> 
              &nbsp;<img src="../img/cal.gif" border="0" alt="Calendario" onClick="window.open('formcalendario.php?calencodigo=fecini','cal1','status=no,menubar=no,scrollbars=yes,resizable=yes,left=600,width=200,height=210');" /></td>
            <td width="180" valign="top" class="NoiseDataTD">Fecha final&nbsp; <input type="text" name="fecfin" size="8" onfocus="if(!agree)this.blur();" /> 
              &nbsp;<img src="../img/cal.gif" border="0" alt="Calendario" onClick="window.open('formcalendario.php?calencodigo=fecfin','cal1','status=no,menubar=no,scrollbars=yes,resizable=yes,left=600,width=200,height=210');" /></td>
          </tr>
        </table>
  </td>
 </tr>
 <tr>
<td>
<div align="center">
<input type="image" name="aceptar"  src="../img/aceptar.gif"
onclick="window.document.form1.accionnuevoreportetipotrab.value = 1" width="86" height="18" alt="Aceptar" border=0>&nbsp;
<?php //onclick="form1.action='reportdisponib.php'; return validaformtimedrep();"  width="86" height="18" alt="Aceptar" border=0>&nbsp;
?>

<input type="image" src="../img/cancelar.gif" border="0" alt="Cancelar" onclick="form1.action='main.php';">
</div>
</td>
 </tr>
 <tr>
  <td class="NoiseErrorDataTD">&nbsp;</td>
 </tr>
</table>
<input type="hidden" name="codigo" value="<?php echo $codigo; ?>">
<input type="hidden" name="accionnuevoreportetipotrab">
<input type="text"   name="strdataload" size="1" value="" style="border:none; color:#FFFFFF;" onfocus="sendReq(this.value); this.value=''; this.blur();">
<!-- Data: EQUIPOS|e COMPONETNES|c -->
<input type="hidden" name="strdata" value="<?php  $strdata; ?>">
	<input type="hidden" name="plantatmp" value="<?php echo $plantatmp; ?>">
			<input type="hidden" name="arrplantas" value="<?php echo $arrplantas; ?>">
</form>
</body>
<?php
if(!$codigo)
{ echo " -->"; }
?>
</html>