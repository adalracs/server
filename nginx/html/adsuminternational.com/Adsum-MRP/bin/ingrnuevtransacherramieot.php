<?php 
session_start(); 
//include ( '../src/FunGen/sesion/fncvalses.php'); 
include('../src/FunPerSecNiv/fncconn.php');
include('../src/FunPerSecNiv/fncclose.php');
include('../src/FunPerSecNiv/fncnumreg.php');
include('../src/FunPerSecNiv/fncfetch.php');
include('../src/FunPerPriNiv/pktbltipomovi.php');
include ( '../src/FunPerPriNiv/pktbltransaction.php'); 
include('../src/FunPerPriNiv/pktblherramie.php');
if($accionnuevotransacherramie) 
{ 
	include ( 'grabatransacherramieot.php'); 
	if(!$flagnuevotransacherramie)
	{
		$herramcodigo = "";
		$herramnombre = "";
		$herramvalor = "";
		$herramdispon = "";
	}
} 
if($flagsoliot == 1)
{
	$_SESSION["arrtransacAux"] = $_SESSION["arrtransac"];
	$_SESSION["arrtransaccodAux"] = $_SESSION["arrtransaccod"];
	$_SESSION["arrtransacherrAux"] = $_SESSION["arrtransacherr"];
}
ob_end_flush();
if($accionaplicartransacherramie)
{
	include('aplicartransacherramieot.php');
}

//$arrtransachertemp = $_SESSION["arrtransaccod"];
//unset($loadherram);
//for ($i = 0;$i < count($arrtransachertemp);$i++)
//{	
//	$loadherram = $loadherram.$arrtransachertemp[$i][0]."-".$arrtransachertemp[$i][1].",";
//}
ob_end_flush(); 
?> 
<!-- Propiedad intelectual de Adsum SA (c) 
-Todos los derechos reservados- 
Creado con WAG Adsum 
Autor: Andr�s A. Riascos D. 
Fecha: 26052004 
GenVers: 3.1 --> 
<html> 
<head> 
<title>Nuevo registro de E/S de Herramienta</title> 
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
<meta http-equiv="expires" content="0"> 
<link rel="stylesheet" type="text/css" href="temas/Noise/Style.css"> 
<SCRIPT LANGUAGE="JavaScript" type="text/javascript" src="../src/FunGen/jsrsClient.js"></script> 
<SCRIPT LANGUAGE="JavaScript" type="text/javascript" src="../src/FunGen/cargarHerramtransac.js"></script> 
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
<body bgcolor="FFFFFF" text="#000000" onload="this.focus();"> 
<form name="form1" method="post"  enctype="multipart/form-data"> 
<p><font class="NoiseFormHeaderFont">Entrada/Salida de Herramienta</font></p> 
<table border="0" cellspacing="1" cellpadding="2" align="center" 
class="NoiseFormTABLE"> 
  <tr> 
    <td width="540" class="NoiseErrorDataTD">&nbsp;</td> 
  </tr> 
  	<tr>
  		<td class="NoiseFieldCaptionTD"><span class="style5"><font color="FFFFFF">Ingresar nuevo registro</font></span></td></tr> 
			<tr> 
  				<td> 
            		<table width="99%" border="0" cellspacing="2" cellpadding="3" align="center">  
            		<tr> 
            		<tr> 
					 	<td colspan="2">Seleccione Herramienta&nbsp;&nbsp;
						  	<input name="radiobutton" type="radio" onclick="window.open('consultarherramietransac.php?codigo=<?php echo $codigo?>','ventana','status=no,menubar=no,scrollbars=yes,resizable=yes,left=300,width=800,height=600');" width="86" height="18" border=0 href="#" target="_parent""></td> 
						<td>C&oacute;digo</td>
						<td><input type="text" onblur=" if(this.value != '') {cargarHerramtransac(this.value); }" name="herramcodigo" value="<?php echo $herramcodigo;?>" size="10"></td>
						<td><div align="right">Nombre</div></td>
						<td colspan="2"><input type="text" name="herramnombre" value="" onFocus="if (!agree)this.blur();"></td>
					</tr>
            		<tr>
						<td>Disponible</td>
						<td width="9%"><input type="text" style="border:none;" size="8" name="herramdispon" onfocus="if(!agree)this.blur();" value="<?php echo $herramdispon;?>"></td>
						<td colspan="3"><div align="right">Valor $</div></td>
						<td colspan="2"><input type="text" style="border:none;" size="8" name="herramvalor" onfocus="if(!agree)this.blur();" value="<?php echo $herramvalor;?>"></td>
					</tr> 
					<tr>
						<td colspan="7"><hr></td>
					</tr>
					<tr> 
						<td width="20%"><?php if($campnomb == "transitecanti"){$transitecanti = null; echo "*";}?>Cantidad</td> 
					 	<td colspan="6"><input name="transhercanti" type="text"	value="<?php if(!$flagnuevotransacherramie){ echo $sbreg[transhercanti];}else{ echo $transhercanti; }?>" size="10"></td> 
					</tr> 
					<tr> 
						<td width="23%">&nbsp;</td> 
					</tr> 
				</table> 
  			</td> 
 		</tr> 
 		<tr> 
			<td><div align="center"> 
				<input type="image" name="Adicionar" src="../img/adicionar.gif" onclick="form1.accionnuevotransacherramie.value =  1;"  width="86" height="18" alt="Adicionar" border=0>
				<input type="image" name="Cancelar"  src="../img/cancelar.gif" onclick="window.close();"  width="86" height="18" alt="Cancelar" border=0>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="image" name="Aplicar a OT"  src="../img/aplicaraOT.gif" onclick="window.document.form1.accionaplicartransacherramie.value=1;"  width="86" height="18" alt="Aplicar a OT" border=0>
			</div></td> 
 		</tr> 		
 		<tr> 
  			<td class="NoiseErrorDataTD">&nbsp;</td> 
 		</tr> 
	</table> 
<?php if($campnomb){echo '<font face = "Verdana" >Corregir los capos marcados con *</font>';} ?> 
<p>
<input type="hidden" name="transhercodigo" value="<?php if(!$flagnuevotransacherramie){ echo $sbreg[transhercodigo];}else{ echo $transhercodigo; } ?>"> 
<input type="hidden" name="transhertotal"	value="<?php if(!$flagnuevotransacherramie){ echo $sbreg[transhertotal];}else{ echo $transhertotal; }?>"> 
<input type="hidden" name="transherfecha" value="<?php $transherfecha = date("Y-m-d"); echo $transherfecha;?>">
<input type="hidden" name="usuacodi" value="<?php echo $GLOBALS[usuacodi]; ?>">
<input type="hidden" name="tipmovcodigo" value="2"> 
<input type="hidden" name="loadherram" value="<?php echo $loadherram; ?>"> 
<input type="hidden" name="flagsoliot" value="<?php echo $flagsoliot; ?>"> 
<input type="hidden" name="accionnuevotransacherramie"> 
<input type="hidden" name="accionaplicartransacherramie">
<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<table width="588" height="48" border="0" align="center" cellpadding="2" cellspacing="1" 
class="NoiseFormTABLE">
  <tr>
    <td height="21" bgcolor="#FFFFFF" class="NoiseErrorDataTD Estilo2"><span class="Estilo7">Nota</span></td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF">Para adicionar una o varias herramientas, presione el bot&oacute;n <em>Adicionar</em>.<br>
      Para adicionarlos y regresar a la OT, presione <em>Aplicar a OT</em></td>
  </tr>
</table>
<p>&nbsp;</p>
</form> 
</body> 
<?php 
    if(!$codigo) 
    { echo " -->"; } 
?> 
</html> 
