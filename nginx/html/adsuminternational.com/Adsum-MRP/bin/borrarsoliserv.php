<?php 
include ( '../src/FunGen/sesion/fncvalses.php');
include('../src/FunPerPriNiv/pktblusuario.php');
include('../src/FunPerPriNiv/pktblequipo.php');
include('../src/FunPerPriNiv/pktbltipofall.php');
include('../src/FunPerPriNiv/pktblsoliservestado.php');
if(!$flagborrarsoliserv)
{
	include ( '../src/FunGen/sesion/fnccarga.php');
	$sbreg = fnccarga($nombtabl,$radiobutton);
	if (!$sbreg)
	{
		include( '../src/FunGen/fnccontfron.php');
	}
	
	$idcon = fncconn();
	$sbregequip = loadrecordequipo($sbreg[equipocodigo],$idcon);
	$equiponombre = $sbregequip[equiponombre];
	fncclose($idcon);
}
?> 
<html> 
<head> 
<title>Borrar registro de soliserv</title> 
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
<p><font class="NoiseFormHeaderFont">Solicitud de servicio</font></p> 
<table width="90%" border="0" cellspacing="1" cellpadding="0" align="center" 
class="NoiseFormTABLE"> 
  <tr> 
    <td width="633" class="NoiseErrorDataTD">&nbsp;</td> 
  </tr> 
  <tr> 
          <td class="NoiseFieldCaptionTD"><span class="style5"><font 
color="FFFFFF"> 
Borrar registro</font></span></td></tr> 
<tr> 
  <td><table width="90%" border="0" cellspacing="0" cellpadding="0"
align="center">
      <tr class="NoiseColumnTD">
        <td width="15%">&nbsp;C&oacute;digo</td>
        <td><?php if(!$flagdetallarsoliserv){
   	 echo $sbreg[solsercodigo]; }else{ echo $solsercodigo;}
?>
        </td>
        <td>&nbsp;Fecha</td>
        <td><?php if(!$flagdetallarsoliserv){
echo $sbreg[solserfecha];}else {echo $solserfecha;}?>
          a-m-d</td>
      </tr>
      <tr>
        <td width="15%" class="NoiseDataTD">&nbsp;Empleado</td>
        <td><?php
  if(!$flagdetallarsoliserv)
  {
  	$idcon = fncconn();
  	$sbregusuario = loadrecordusuario($sbreg[usuacodi],$idcon);
   	echo $sbregusuario[usuanombre]."&nbsp;".$sbregusuario[usuapriape]."&nbsp;".$sbregusuario[usuasegape];
  }
  else
  {
  	echo $usuacodi;
  }?></td>
        <td class="NoiseErrorDataTD">&nbsp;</td>
        <td class="NoiseErrorDataTD">&nbsp;</td>
      </tr>
      <tr>
        <td class="NoiseDataTD">&nbsp;Ubicaci&oacute;n</td>
        <td><?php if(!$flagdetallarsoliserv){ 
 $sbreg2 = cargadatossoliserv($sbreg[equipocodigo],$idcon);
   	echo $sbreg2[plantanombre];
 }else{
echo $equipocodigo;} ?></td>
        <td class="NoiseDataTD">&nbsp;Proceso</td>
        <td><?php if(!$flagdetallarsoliserv){ 
 $sbreg2 = cargadatossoliserv($sbreg[equipocodigo],$idcon);
   	echo $sbreg2[sistemnombre];
 }else{
echo $equipocodigo;} ?></td>
      </tr>
      <tr class="NoiseColumnTD">
        <td width="15%">&nbsp;Equipo</td>
        <td colspan="3"><?php if(!$flagdetallarsoliserv){
echo $equiponombre;} ?></td>
      </tr>
      <tr>
        <td width="15%" class="NoiseDataTD">&nbsp;Tipo de falla</td>
        <td><?php
  if(!$flagdetallarsoliserv)
  {
  	$idcon = fncconn();
  	$sbregtipofall = loadrecordtipofall($sbreg[tipfalcodigo],$idcon);
   	echo $sbregtipofall[tipfalnombre];
   	fncclose($idcon);
  }
  else
  {
  	echo $tipalcodigo;
  }?></td>
        <td width="9%" class="NoiseDataTD">&nbsp;Estado</td>
        <td><?php if(!$flagdetallarsoliserv)
        {
        	$idcon = fncconn();
  			$sbregsolest = loadrecordsoliservestado($sbreg[estsolcodigo],$idcon);
   			
  			echo $sbregsolest[estsolnombre];
   			fncclose($idcon);
   	 }
   	 else
   	 {
   	 	echo $solsercodigo;}
?></td>
      </tr>
      <tr>
        <td width="15%" class="NoiseDataTD">&nbsp;Motivo</td>
        <td colspan="3" rowspan="2"><table width="95%" border="0" cellspacing="0" cellpadding="0" align="center">
        <?php if(!$flagdetallarsoliserv)
      			{ $texto = split("::",$sbreg[solsermotivo] );
					$contador = count($texto);
					for ($i=0;$i<$contador;$i++)
		      			{$texto1 = split("--",$texto[$i] );
						{echo '<tr><td class="NoiseErrorDataTD" width="20%">'.$texto1[0].'</td><td align="center">'.$texto1[1].'</td>
						<td>'.$texto1[2].'</td><td>&nbsp;&nbsp;'.$texto1[3].'</td></tr>';}}
		      	}
      			else {echo $solsermotivo;}?>
       </table>
        </td>
      </tr>
     </table>
    &nbsp;</td> 
 </tr> 
 <tr> 
<td> 
<div align="center"> 
  <input type="image" name="aceptar"  src="../img/aceptar.gif" 
onclick="form1.accionborrarsoliserv.value =  1; 
form1.action='maestablsoliserv.php';"  width="86" height="18" alt="Aceptar" 
border=0> 
  <input type="image" name="cancelar" src="../img/cancelar.gif" 
onclick="form1.action='maestablsoliserv.php';"  width="86" height="18" 
alt="Cancelar" border=0> 
</div> 
</td> 
 </tr> 
 <tr> 
  <td class="NoiseErrorDataTD">&nbsp;</td> 
 </tr> 
</table> 
 <input type="hidden" name="flagborrarsoliserv" value="1"> 
<input type="hidden" name="accionborrarsoliserv"> 
<input type="hidden" name="solsercodigo" value="<?php echo $sbreg[solsercodigo]; ?>">
<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
</form> 
</body> 
<?php 
if(!$codigo)
{ echo " -->"; }
?> 
</html> 
