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
include ( '../src/FunPerPriNiv/pktbltipotrab.php');
include ( '../src/FunPerPriNiv/pktblusuario.php');
$idcon = fncconn();
$sbregusuario = loadrecordusuario($_SESSION['usuacodi'],$idcon);
fncclose($idcon);
?> 
<html> 
<head> 
<title>Consultar en ot</title> 
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
<meta http-equiv="expires" content="0"> 
<link rel="stylesheet" type="text/css" href="temas/Noise/Style.css"> 
<SCRIPT LANGUAGE="JavaScript"> 
<!-- Begin 
agree = 0; 
//  End --> 
</script> 
<script language="JavaScript" src="motofech.js"></script> 
<SCRIPT language=JavaScript src="../src/FunGen/jsrsClient.js"		type="text/javascript" ></SCRIPT>
<script language=JavaScript src="../src/FunGen/cargarSistema.js" type="text/javascript" ></script>
<script language=JavaScript src="../src/FunGen/cargarEquipos.js" type="text/javascript" ></script>
<script language=JavaScript src="../src/FunGen/cargarComponen.js" type="text/javascript" ></script>
<script language=JavaScript src="../src/FunGen/prototype162.js" type="text/javascript" ></script>
<SCRIPT src="../src/FunGen/achess.js" type="text/javascript"></SCRIPT>
</head> 
<?php 
    if(!$codigo) 
    { echo "<!--";} 
?> 
<body onload="focus();" bgcolor="FFFFFF" text="#000000"> 
<form name="form1" method="post"  enctype="multipart/form-data"> 
<p><font class="NoiseFormHeaderFont">Orden de trabajo</font></p> 
<table border="0" cellspacing="1" cellpadding="2" align="center" class="NoiseFormTABLE"> 
<tr>
	<td width="708" class="NoiseErrorDataTD">&nbsp;</td>
</tr>
  <tr> 
          <td class="NoiseFieldCaptionTD"><span class="style5"><font color="FFFFFF"> 
Consultar registro</font></span></td></tr> 
<tr> 
  <td> 
<table width="90%" border="0" cellspacing="0" cellpadding="0" align="center">
		
		
		<tr>
		  <td>C&oacute;digo</td>
		  <td><input type="text" name="ordtracodigo" value="<?php if(!$flagconsultarvistaot){ echo $sbreg[ordtracodigo];}else{ echo $ordtracodigo;} ?>" size="10"></td>
		  <td>Fecha</td>
		  <td><input type="text" name="ordtrafecgen" value="<?php if(!$flagconsultarvistaot){ echo $sbreg[ordtrafecgen];}else{ echo $ordtrafecgen;} ?>" size="10">&nbsp;&nbsp;aaaa-mm-dd</td>
		</tr>
		
		
		
		<tr>
		  <td>Planta</td>
		  <td colspan="3"><select name="plantacodigo" onchange="cargarSistemas(this.value);">
            <?php
				if($plantacodigo)
				{
					echo '<option value = "'.$plantacodigo.'">'; 
					$idcon	= fncconn();
					$arrplanta = loadrecordplanta($plantacodigo,$idcon);
					echo $arrplanta[plantanombre];
					fncclose($idcon);
	            	echo '<option value = "">Seleccione'; 
				}
				else
				{
					echo '<option value = "">Seleccione'; 
				}
            ?></OPTION>
            <?php
				include ('../src/FunGen/floadplanta.php');
				$idcon = fncconn();
				floadplanta($plantacodigo,$idcon);
				fncclose($idcon);
			?></select></td>
		</tr>
<tr>
  <td>Sistema</td>
  <td>
            <select name="sistemcodigo" onchange="cargarEquipos(this.value);">
            <?php
				if($sistemcodigo)
				{
					echo '<option value = "'.$sistemcodigo.'">'; 
					$idcon	= fncconn();
					$arrsistema = loadrecordsistema($sistemcodigo,$idcon);
					echo $arrsistema[sistemnombre]."</OPTION>";
					include ('../src/FunGen/floadsistema1.php');
					floadsistema1($plantacodigo,$idcon);
					fncclose($idcon);
				}
            ?>
            <option value="">Seleccione</option>
			</select>
</td>
  <td colspan="2">&nbsp;</td>
 </tr>
		<tr>
			<td>Equipo</td>
			<td><select name="equipocodigo" id="equipocodigo"  onchange="cargarComponen(this.value);">
            <?php
				if($equipocodigo)
				{
					echo '<option value = "'.$equipocodigo.'">'; 
					$idcon	= fncconn();
					$arrequipo = loadrecordequipo($equipocodigo,$idcon);
					echo $arrequipo[equiponombre]."</OPTION>";
					include ('../src/FunGen/floadequipo1.php');
					floadequipo1($sistemcodigo,$idcon);
					fncclose($idcon);
				}
            ?>
            	<option value="">Seleccione</option>
           </select>
            <IMG 
      onclick="filtradorselect('equipocodigo') ; " 
      src="filter.png" border=0>
      <SCRIPT type=text/javascript>
				Event.observe($('equipocodigo'),'keyup', function(f){ if (f.keyCode==113)filtradorselect('equipocodigo')} );
				
				</SCRIPT></td>
<td>Componente</td>
			<td><select name="componcodigo">
            <?php
				if($componcodigo)
				{
					echo '<option value = "'.$componcodigo.'">'; 
					$idcon	= fncconn();
					$arrcomponen = loadrecordcomponen($componcodigo,$idcon);
					echo $arrcomponen[componnombre]."</OPTION>";
					include ('../src/FunGen/floadcomponen1.php');
					floadcomponen1($equipocodigo,$idcon);
					fncclose($idcon);
				}
            ?>
            	<option value="">Seleccione</option>
            </select></td>
		</tr>
		<tr>
			<td width="16%">Tipo de mantenimiento</td>
 			<td><select name="tipmancodigo">
				<?php 
     			if($tipmancodigo)
     			{
       				echo '<option value = "'.$tipmancodigo.'">'; 
	        		$idcon	= fncconn();
					$arrtipomant = loadrecordtipomant($tipmancodigo,$idcon);
					echo $arrtipomant[tipmannombre];
					fncclose($idcon);
					echo '<option value = "">Seleccione'; 
			     }else
			     	echo '<option value = "">Seleccione'; 
			     ?></OPTION>
				<?php
					include ('../src/FunGen/floadtipomant.php');
					$idcon = fncconn();
					floadtipomant($tipmancodigo,$idcon);
					fncclose($idcon);
				?>
				</select></td>
				<td width="16%">Prioridad</td>
				<td><select name="prioricodigo">
 			<?php
     			if($prioricodigo)
     			{
       				echo '<option value = "'.$prioricodigo.'">'; 
        			$idcon	= fncconn();
					$arrprioridad = loadrecordpriorida($prioricodigo,$idcon);
					echo $arrprioridad[priorinombre];
					fncclose($idcon);
					echo '<option value = "">Seleccione'; 
     			}else
     				echo '<option value = "">Seleccione'; 
     			?></OPTION>
			<?php
				include ('../src/FunGen/floadpriorida.php');
				$idcon = fncconn();
				floadpriorida($prioricodigo,$idcon);
				fncclose($idcon);
			?></select></td>
		</tr>
		<tr>
			<td width="16%">Fecha de inicio</td>
            <td><input name="ordtrafecini" type="text"	value="<?php if(!$flagconsultarvistaot){echo $sbreg[ordtrafecini];}else{ echo $ordtrafecini;}?>" size="10" maxlength="10">&nbsp;<span class="style1">aaaa-mm-dd</span>
			</td>
			<td>Fecha de fin</td>
            <td><input name="ordtrafecfin" type="text"	value="<?php if(!$flagconsultarvistaot){echo $sbreg[ordtrafecfin];}else{ echo $ordtrafecfin;}?>" size="10" maxlength="10">&nbsp;<span class="style1">aaaa-mm-dd</span></td>
		</tr>
		<tr>
   		<td width="13%"><?php if($campnomb == "tiptracodigo"){$tiptracodigo = null; echo "*";}?>Tipo de trabajo</td>
    		<td><select name="tiptracodigo">
    		<?php
    		if($tiptracodigo)
     			{
       				echo '<option value = "'.$tiptracodigo.'">'; 
	        		$idcon	= fncconn();
					$arrtipotrab = loadrecordtipotrab($tiptracodigo,$idcon);
					echo $arrtipotrab[tiptranombre];
					fncclose($idcon);
					echo '<option value = "">Seleccione'; 
			     }else
			     		echo '<option value = "">Seleccione';
			     ?></OPTION>
				<?php
					include ('../src/FunGen/floadtipotrab.php');
					$idcon = fncconn();
					floadtipotrab($tiptracodigo,$idcon);
					fncclose($idcon);
				?>
	        	</select>
		</td>
		<td>Tarea</td>
		<td><select name="tareacodigo">
          	<?php
          	if($tareacodigo)
     			{
       				echo '<option value = "'.$tareacodigo.'">'; 
	        		$idcon	= fncconn();
					$arrtarea = loadrecordtarea($tareacodigo,$idcon);
					echo $arrtarea[tareanombre];
					fncclose($idcon);
					echo '<option value = "">Seleccione'; 
			     }else
			     		echo '<option value = "">Seleccione';  
			     ?></OPTION>
				<?php
					include ('../src/FunGen/floadtarea.php');
					$idcon = fncconn();
					floadtarea($tareacodigo,$idcon);
					fncclose($idcon);
				?>
            		</select></td>
          	</tr>
	</table>
  </td> 
 </tr> 
 <tr> 
<td> 
<div align="center"> 
  <input type="image" name="aceptar"  src="../img/aceptar.gif" 
onclick="form1.accionconsultarvistaot.value =  1; form1.action='maestablotsecunddos.php';"
width="86" height="18" alt="Aceptar" border=0> 
  <input type="image" name="cancelar" src="../img/cancelar.gif" 
onclick="window.close();"  width="86" height="18" alt="Cancelar" 
border=0> 
<img src="../img/ayuda.gif" border="0" alt="Ayuda">
</div> 
</td> 
 </tr> 
 <tr> 
  <td class="NoiseErrorDataTD">&nbsp;</td> 
 </tr> 
</table> 
<input type="hidden" name="flagconsultarvistaot" value="1"> 
<input type="hidden" name="accionconsultarvistaot"> 
<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
<input type="hidden" name="columnas" value="ordtracodigo, 
ordtrafecgen, 
plantacodigo,
sistemcodigo,
equipocodigo,
componcodigo,
tipmancodigo, 
prioricodigo, 
ordtrafecini,  
ordtrafecfin,  
tiptracodigo,
tareacodigo">
<input type="hidden" name="nombtabl" value="ot">
<input type="hidden" name="usuacodi" value="<?php //echo $sbregusuario['usuacodi']; ?>"> 
</form> 
</body> 
<?php 
    if(!$codigo) 
    { echo " -->"; } 
?> 
</html> 
