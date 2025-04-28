<?php
ob_start();
include ( '../src/FunGen/sesion/fncvalses.php');
include ( '../src/FunPerPriNiv/pktblplanta.php');
include ( '../src/FunPerPriNiv/pktblsistema.php');
include ( '../src/FunPerPriNiv/pktblequipo.php');
include ( '../src/FunPerPriNiv/pktblcomponen.php');
include ( '../src/FunPerPriNiv/pktblitem.php');
include ( '../src/FunPerPriNiv/pktbloperacio.php');
include ( '../src/FunPerPriNiv/pktblotestado.php');
include ( '../src/FunPerPriNiv/pktbltipomant.php');
include ( '../src/FunPerPriNiv/pktblpriorida.php');
include ( '../src/FunPerPriNiv/pktbltarea.php');
include ( '../src/FunPerPriNiv/pktblherramie.php');
include ( '../src/FunPerPriNiv/pktbltransacherramie.php');
include ( '../src/FunPerPriNiv/pktbltransacitem.php');
include ( '../src/FunPerPriNiv/pktbltipotrab.php');
include ( '../src/FunPerPriNiv/pktblusuario.php');
include ( '../src/FunPerPriNiv/pktbltransaction.php');
include ( '../src/FunGen/sesion/fncvarsesion.php');
include ( '../src/FunGen/floadtimehours.php');
include ( '../src/FunGen/floadtimeminut.php');

$flagsoliot = 1;

if($accionnuevoot)
{
	include ( 'grabaot.php');
}
ob_end_flush();
?>
<html>
<head>
<title>Nuevo registro de ot</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta http-equiv="expires" content="0">
<link rel="stylesheet" type="text/css" href = "temas/Noise/Style.css">
<SCRIPT LANGUAGE="JavaScript">
<!-- Begin
agree = 0;
//  End -->
function MM_openBrWindow(theURL,winName,features)
{ //v2.0
  window.open(theURL,winName,features);
}
</script>
<script language="JavaScript" src="motofech.js"></script>
<SCRIPT language=JavaScript src="../src/FunGen/jsrsClient.js"		type="text/javascript" ></SCRIPT>
<script language=JavaScript src="../src/FunGen/cargarSistema.js" type="text/javascript" ></script>
<script language=JavaScript src="../src/FunGen/cargarEquipos.js" type="text/javascript" ></script>
<script language=JavaScript src="../src/FunGen/cargarComponen.js" type="text/javascript" ></script>
<script language=JavaScript src="../src/FunGen/cargarEmpleaselec.js" type="text/javascript" ></script>
<script language=JavaScript src="../src/FunGen/cargarTransacherram.js" type="text/javascript" ></script>
<script language=JavaScript src="../src/FunGen/cargarTransacitem.js" type="text/javascript" ></script>
<script language=JavaScript src="../src/FunGen/fncbotton.js" type="text/javascript" ></script>
<script language=JavaScript src="../src/FunGen/fncverificarlider.js" type="text/javascript" ></script>
<style type="text/css">
<!--
.style1 {font-size: 12px}
-->
</style>
<SCRIPT LANGUAGE="JavaScript">
var arreglo_auxdef = new Array;
var arreglo_ite = new Array;
var arreglo_herr = new Array;
function carga()
{
	for(var i=0; i < document.form1.elements['empleaselec'].length; i++)
	{
		arreglo_auxdef[i] = document.form1.empleaselec[i].value;
	}
	document.form1.arreglo_auxdef.value = arreglo_auxdef;
	for(var j=0; j < document.form1.elements['herramcodigo'].length; j++)
	{
		arreglo_herr[j] = document.form1.herramcodigo[j].value;
	}
	document.form1.arreglo_herr.value = arreglo_herr;
	for(var k=0; k < document.form1.elements['itemcodigo'].length; k++)
	{
		arreglo_ite[k] = document.form1.itemcodigo[k].value;
	}
	document.form1.arreglo_ite.value = arreglo_ite;
}
</script>
</head>
<?php
if(!$codigo)
{ echo "<!--";}
?>
<body bgcolor="FFFFFF" text="#000000">
<!--<form NAME="form1" method="POST" action="prueba.php">-->
<form name="form1" method="post"  enctype="multipart/form-data">
<p><font class="NoiseFormHeaderFont">Ordenes de trabajo</font></p>
<table border="0" cellspacing="1" cellpadding="2" align="center" class="NoiseFormTABLE">
<tr>
	<td width="749" class="NoiseErrorDataTD">&nbsp;</td>
</tr>
<tr>
	<td class="NoiseFieldCaptionTD"><span class="style5"><font color="FFFFFF">Ingresar nuevo registro</font></span>
	</td>
</tr>
<tr>
	<td><table width="95%" border="0" cellspacing="0" cellpadding="0" align="center">
		<tr>
			<td class="NoiseSeparatorTD"><div align="center">Fecha y Hora</div></td>
  			<td class="NoiseSeparatorTD" colspan="5">Estado de creaci&oacute;n </td>
  		</tr>
		<tr>
		  <td class="NoiseSeparatorTD"><div align="center"><?php $fecha=date("Y-m-d");echo $fecha; ?>:<?php $horainicial= date("H:i"); echo $horainicial; ?>
	        </div></td>
		  <td class="NoiseSeparatorTD" colspan="5">
		  <select name="otestacodigo">
            <?php
 			include('../src/FunGen/floadotestadoot.php');
 			$idcon = fncconn();
 			floadotestadoot($idcon);
 			fncclose($idcon);
 			?>
          </select></td>
          </tr>
          <tr>
          <td><?php if($campnomb["plantacodigo"] == 1)echo "*"; ?>Planta</td>
          <td colspan="2"><?php if($campnomb["sistemcodigo"] == 1)echo "*"; ?>Sistema</td>
          <td colspan="2"><?php if($campnomb["equipocodigo"] == 1)echo "*"; ?>Equipo</td>
          <td><?php if($campnomb["componcodigo"] == 1)echo "*"; ?>Componente</td>
          </tr>
          <tr>
		  <td><select name="plantacodigo" onChange="cargarSistemas(this.value);">
            <?php
            	if(!$flagnuevoot)
            		echo '<option value="">Seleccione';
				else if($plantacodigo)
				{
					echo '<option value = "'.$plantacodigo.'">';
					$idcon	= fncconn();
					$arrplanta = loadrecordplanta($plantacodigo,$idcon);
					echo $arrplanta[plantanombre];
					fncclose($idcon);
	            	echo '<option value = "">Seleccione';
				}
				else
					echo '<option value = "">Seleccione';
				echo '</option>';

				include ('../src/FunGen/floadplanta.php');
				$idcon = fncconn();
				floadplanta($idcon);
				fncclose($idcon);
			?>
          </select>          </td>
		  <td colspan="2"><select name="sistemcodigo" onChange="cargarEquipos(this.value);">
            <?php
            	if(!$flagnuevoot)
            		echo '<option value="">Seleccione</option>';
				else if($sistemcodigo)
				{
					echo '<option value = "'.$sistemcodigo.'">';
					$idcon	= fncconn();
					$arrsistema = loadrecordsistema($sistemcodigo,$idcon);
					echo $arrsistema[sistemnombre]."</OPTION>";
					include ('../src/FunGen/floadsistemaot.php');
					floadsistemaot($plantacodigo,$idcon);
					fncclose($idcon);
				}
				else
					echo "<option value=''>Seleccione</option>";
            ?>
          </select>
          </td>
          <td colspan="2">
		  <select name="equipocodigo"  onChange="cargarComponen(this.value);">
		    <?php
		    if(!$flagnuevoot)
		    	echo '<option value="">Seleccione</option>';
			else if($equipocodigo)
			{
				echo '<option value = "'.$equipocodigo.'">';
				$idcon	= fncconn();
				$arrequipo = loadrecordequipo($equipocodigo,$idcon);
				echo $equipocodigo."</OPTION>";
				include ('../src/FunGen/floadequipoot.php');
				floadequipoot($sistemcodigo,$idcon);
				fncclose($idcon);
			}
			else
				echo "<option value=''>Seleccione</option>";
		    ?>
		  </select>
		  </td>
          <td>
			<select name="componcodigo">
			<?php
			if(!$flagnuevoot)
		    	echo '<option value="">Seleccione';
			else if($componcodigo)
			{
				echo '<option value = "'.$componcodigo;
				$idcon	= fncconn();
				$arrcomponen = loadrecordcomponen($componcodigo,$idcon);
				echo $arrcomponen[componnombre]."</OPTION>";
				include ('../src/FunGen/floadcomponenequi.php');
				floadcomponenequi($equipocodigo,$idcon);
				fncclose($idcon);
			}
			else
				echo '<option value="">Seleccione</option>';
			?>

			</select>
			</td>
		</tr>
		<tr>
  			<td colspan="6"><hr size="1" noshade></td>
	      </tr>
		<tr>
			<td colspan="3"><?php if($campnomb["tipmancodigo"] == 1){$tipmancodigo = null; echo "*";}?>Tipo de mantenimiento</td>
			<td width="13%"><select name="tipmancodigo">
            <?php
              	if(!$flagnuevoot)
					echo '<option value = "">Seleccione';
				else if($tipmancodigo)
     			{
       				echo '<option value = "'.$tipmancodigo.'">';
	        		$idcon	= fncconn();
					$arrtipomant = loadrecordtipomant($tipmancodigo,$idcon);
					echo $arrtipomant[tipmannombre];
					fncclose($idcon);
					echo '<option value = "">Seleccione';
			     }else
			     	echo '<option value = "">Seleccione';

				include ('../src/FunGen/floadtipomant.php');
				$idcon = fncconn();
				floadtipomant($idcon);
				fncclose($idcon);
			?>
            </select></td>
			<td width="16%"><?php if($campnomb["prioricodigo"] == 1){$prioricodigo = null; echo "*";}?>
		    Prioridad</td>
			<td width="16%"><select name="prioricodigo">
              <?php
              	if(!$flagnuevoot)
              		echo '<option value ="">Seleccione';
     			else if($prioricodigo)
     			{
       				echo '<option value = "'.$prioricodigo.'">';
        			$idcon	= fncconn();
					$arrprioridad = loadrecordpriorida($prioricodigo,$idcon);
					echo $arrprioridad[priorinombre];
					fncclose($idcon);
					echo '<option value = "">Seleccione';
     			}else
     				echo '<option value = "">Seleccione';

     			echo '</option>';
				include ('../src/FunGen/floadpriorida.php');
				$idcon = fncconn();
				floadpriorida($idcon);
				fncclose($idcon);
			?>
            </select></td>
 		</tr>
		<tr>
  			<td>&nbsp;</td>
		    <td colspan="5">&nbsp;</td>
	      </tr>
		<tr>
			<td width="17%"><?php if($campnomb["ordtradescri"] == 1){$ordtradescri = null; echo "*";} ?>Descripci&oacute;n del da&ntilde;o del equipo</td>
 			<td colspan="5" rowspan="2"><textarea name="ordtradescri" cols="60" rows="3" wrap="VIRTUAL"><?php if(!$flagnuevoot){echo $sbreg["ordtradescri"];}else{ echo $ordtradescri;}?></textarea></td>
		</tr>
		<tr>
		  <td>&nbsp;</td>
		  </tr>
		<tr>
			<td colspan="6"><?php if($campnomb["ordtrafecini"] == 1){$ordtrafecini = null; echo "*";}?>Fecha de inicio
			  <input type="text" name="ordtrafecini" size="8" value="<?php if(!$flagnuevoot){echo $ordtrafecini=date("Y-m-d");} else {echo $ordtrafecini;}?>" onFocus="if (!agree)this.blur();">&nbsp;
              <img src="../img/cal.gif" border="0" onClick="window.open('formcalendario.php?calencodigo=ordtrafecini','cal1','status=no,menubar=no,scrollbars=yes,resizable=yes,left=600,width=200,height=210');">
              <select name="horini">
                <?php
				 	if($flagnuevoot)
				 		echo '<option value ="'.$horini.'">'.$horini.'</option>'."\n";
					floadtimehours();
				  ?>
              </select>
            :
            <select name="minini">
                <?php
					if($flagnuevoot)
				 		echo '<option value ="'.$minini.'">'.$minini.'</option>'."\n";
				 	floadtimeminut();
				 ?>
            </select>
            <input type="checkbox" name="pasadmerini" <?php if($flagnuevoot){if($pasadmerini)echo "CHECKED";}?>>
&nbsp;p.m
<?php if($campnomb["ordtrafecfin"] == 1){ $ordtrafecfin = null; echo "*";} ?>
Fecha de fin
<input type="text" name="ordtrafecfin" size="8" value="<?php if(!$flagnuevoot){ echo $sbreg[ordtrafecfin];} else {echo $ordtrafecfin;}?>" onFocus="if (!agree)this.blur();">
<img src="../img/cal.gif" border="0" onClick="window.open('formcalendario.php?calencodigo=ordtrafecfin','cal1','status=no,menubar=no,scrollbars=yes,resizable=yes,left=600,width=200,height=210');">
		<select name="horfin">
		  <?php
		  if($flagnuevoot)
		  echo '<option value ="'.$horfin.'">'.$horfin.'</option>'."\n";
		  floadtimehours();
		  ?>
		</select>
		:
		<select name="minfin">
		  <?php
		  if($flagnuevoot)
		  echo '<option value ="'.$minfin.'">'.$minfin.'</option>'."\n";
		  floadtimeminut();
		  ?>
		</select>
		<input type="checkbox" name="pasadmerfin" <?php if($flagnuevoot){if($pasadmerfin)echo "CHECKED";}?>>&nbsp;p.m</td>
        </tr>
  		<tr>
 			<td colspan="6"></td>
		  </tr>
		<tr>
			<td colspan="6" class="NoiseSeparatorTD">Empleados involucrados en la OT </td>
	      </tr>
		<tr>
		  <td colspan="3"><?php if($campnomb["usuacodi"] == 1)echo "*";?>
		    <input type="button" name="radio1" value="Buscar encargado" onClick="window.open('consultarusuarioot.php?codigo=<?php echo $codigo?>','','status=no,menubar=no,scrollbars=yes,resizable=yes,left=300,width=800,height=600');" width="86" height="18" border=0 href="#" target="_parent"></td>
		  <td colspan="3"><input name="empleacod" type="text"	value="<?php if($flagnuevoot) echo $empleacod; ?>" size="8">
		  				  <input  name="empleanomb" type="text" value="<?php if($flagnuevoot) echo $empleanomb; ?>" size="25" onFocus="if (!agree)this.blur();"></td>
		  </tr>
		<tr>
		  <td colspan="3"><input type="button" name="radio2_" value=" Buscar auxiliares  " oncFocus="cargarEmpleaselec(document.form1.arreglo_auxdef.value);" onClick="resp=fncverificarlider(window.document.form1.empleacod);if(resp)window.open('consultarusuaauxot.php?codigo=<?php echo $codigo?>&empleacod='+window.document.form1.empleacod.value,'','status=no,menubar=no,scrollbars=yes,resizable=yes,left=300,width=800,height=600');" width="86" height="18" border=0 href="#" target="_parent"></td>
		  <td colspan="3"><select name="empleaselec" size="3">
            <?php
            if($flagnuevoot)
            {
	        	include('../src/FunGen/floadusuaselect.php');
				$idcon = fncconn();
				floadusuaselect($idcon,$arreglo_auxdef);
				fncclose($idcon);
            }
  			?>
          </select>
		    <input type="button" value="Agregar" name="adicionaux" onClick="transferTo(this.form.empleadelet,this.form.empleaselec);">
		    <input type="button" value="Eliminar" name="eliminaaux" onClick="window.document.form1.arr_borrar.value='';transferTo(this.form.empleaselec,this.form.empleadelet);">
		    <select name="empleadelet" size="3">
            </select></td>
		  </tr>
		<tr>
		  <td colspan="6" class="NoiseSeparatorTD">Trabajo a realizar y herramientas utilizadas </td>
		  </tr>
		<tr>
		  <td><?php if($campnomb["tiptracodigo"] == 1){$tiptracodigo = null; echo "*";}?>
		    Tipo de trabajo</td>
		  <td colspan="3"><select name="tiptracodigo">
            <?php
	            if(!$flagnuevoot)
						echo '<option value = "">Seleccione';
				else if($tiptracodigo)
	     		{
	       			echo '<option value = "'.$tiptracodigo.'">';
		        	$idcon	= fncconn();
					$arrtipotrab = loadrecordtipotrab($tiptracodigo,$idcon);
					echo $arrtipotrab[tiptranombre];
					fncclose($idcon);
					echo '<option value = "">Seleccione';
				}
				else
					echo '<option value = "">Seleccione';
		     	echo '</option>';

				include ('../src/FunGen/floadtipotrab.php');
				$idcon = fncconn();
				floadtipotrab($idcon);
				fncclose($idcon);
			?>
          </select></td>
		  <td><?php if($campnomb["tareacodigo"] == 1){ echo $tareacodigo = null; echo "*";}?>
		    Tarea</td>
		  <td><select name="tareacodigo">
            <?php
	            if(!$flagnuevoot)
						echo '<option value = "">Seleccione';
				else if($tareacodigo)
	     		{
	   				echo '<option value = "'.$tareacodigo.'">';
	        		$idcon	= fncconn();
					$arrtarea = loadrecordtarea($tareacodigo,$idcon);
					echo $arrtarea[tareanombre];
					fncclose($idcon);
					echo '<option value = "">Seleccione';
			     }
			     else
				 	echo '<option value = "">Seleccione';
				 echo '</option>';

				include ('../src/FunGen/floadtarea.php');
				$idcon = fncconn();
				floadtarea($idcon);
				fncclose($idcon);
			?>
          </select></td>
		  </tr>
		<tr>
		  <td><?php if($campnomb["tareotnota"] == 1){echo $tareotnota = null; echo "*";}?>
		    Descripci&oacute;n del trabajo a realizar</td>
		  <td colspan="5" rowspan="2"><textarea name="tareotnota" cols="60" rows="3" wrap="VIRTUAL"><?php if(!$flagnuevoot){ echo $sbreg["tareotnota"];}else{ echo $tareotnota;}?></textarea></td>
		  </tr>
		<tr>
		  <td>&nbsp;</td>
		  </tr>
		<tr>
		  <td colspan="3"><input type="button" name="radio3" value="Buscar herramientas" onFocus="cargarTransacherram(document.form1.loadherram.value);"  onClick="window.open('ingrnuevtransacherramieot.php?codigo=<?php echo $codigo?>&flagsoliot=<?php echo $flagsoliot;?>','','status=no,menubar=no,scrollbars=yes,resizable=yes,left=300,width=800,height=600');" width="86" height="18" alt="Cancelar" border=0 href="#" target="_parent"></td>
		  <td colspan="3"><input type="button" name="radio4" value="     Buscar item       " onFocus="cargarTransacitem(document.form1.loaditem.value);" onClick="window.open('ingrnuevtransacitemot.php?codigo=<?php echo $codigo?>&flagsoliotitem=<?php echo $flagsoliotitem;?>','','status=no,menubar=no,scrollbars=yes,resizable=yes,left=300,width=800,height=600');" width="86" height="18" alt="Cancelar" border=0 href="#" target="_parent"></td>
		  </tr>
		<tr>
		  <td colspan="3"><select name="herramcodigo" size="3">
            <?php
            if($flagnuevoot)
            {
				include ('../src/FunGen/floadherramieot.php');

				$idcon = fncconn();
				floadherramieot($idcon,$arrtransaccod);
				fncclose($idcon);
            }
			?>
          </select>
		    <input type="button" name="eliminaher" value="Agregar" onClick="transferTo( this.form.herramcodigo1,this.form.herramcodigo,this.form.flag.value=4 );">
		    <input type="button" name="adicionaher" value="Eliminar" onClick="transferTo( this.form.herramcodigo,this.form.herramcodigo1,this.form.flag.value=3 );">
		    <select name="herramcodigo1" size="3">
		      </select>		    </td>
		  <td colspan="3"><select name="itemcodigo" size="3">
		    <?php
		    if($flagnuevoot)
		    {
				include ('../src/FunGen/floaditemot.php');

				$idcon = fncconn();
				floaditemot($idcon,$arrtransaccoditem);
				fncclose($idcon);
		    }
			?>
		    </select>
		    <input type="button" name="eliminaite" value="Agregar" onClick="transferTo( this.form.itemcodigo1,this.form.itemcodigo,this.form.flag.value=6 );">
		    <input type="button" name="adicionaite" value="Eliminar" onClick="transferTo( this.form.itemcodigo,this.form.itemcodigo1,this.form.flag.value=5 );">
		    <select name="itemcodigo1" size="3">
	        </select>		    </td>
		  </tr>
	</table>
</td>
</tr>
<tr>
	<td><div align="center">
		<input type="image" name="aceptar"  src="../img/aceptar.gif" onClick="form1.ordtrahorini.value = form1.horini.value+':'+form1.minini.value;form1.ordtrahorfin.value = form1.horfin.value+':'+form1.minfin.value;form1.accionnuevoot.value = 1;" width="86" height="18" alt="Aceptar" border=0>
			<input type="image" name="cancelar" src="../img/cancelar.gif" onClick="form1.action='maestablot.php';"  width="86" height="18" alt="Cancelar" border=0>
		</div>
	</td>
</tr>
<tr>
	<td class="NoiseErrorDataTD">&nbsp;</td>
</tr>
</table>
<?php if($campnomb){ echo '<font face= "Verdana" >Corregir los campos marcados con *</font>';}?>
<!-- Datos de ot -->
<input type="hidden" name="accionnuevoot">
<input type="hidden" name="ordtracodigo" value="<?php if(!$flagnuevoot){echo $sbreg[ordtracodigo];}else {echo $ordtracodigo;}?>">
<input type="hidden" name="ordtrahorgen" value="<?php $ordtrahorgen= date("H:i"); echo $ordtrahorgen; ?>">
<input type="hidden" name="ordtrafecgen" value="<?php $ordtrafecgen=date("Y-m-d"); echo $ordtrafecgen;?>">
<input type="hidden" name="ordtratipo" value="1">
<input type="hidden" name="ordtrahorini">
<input type="hidden" name="ordtrahorfin">
<input type="hidden" name="otcantid">

<!-- Datos de usuariotareot -->
<input type="hidden" name="arr_borrar" value="<?php echo $arr_borrar; ?>">
<input type="hidden" name="arreglo_auxdef" value="<?php echo $arreglo_auxdef;?>">

<!-- Datos de herramienta -->
<input type="hidden" name="arreglo_herr" value="<?php echo $arreglo_herr; ?>">
<input type="hidden" name="loadherram" value="<?php $loadherram; ?>">
<input type="hidden" name="flagsoliot" value="<?php echo $flagsoliot; ?>">
<!-- Datos de item -->
<input type="hidden" name="arreglo_ite" value="<?php echo $arreglo_ite; ?>">
<input type="hidden" name="loaditem" value="<?php echo $loaditem; ?>">

<input type="hidden" name="flagsoliotitem" value="<?php echo $flagsoliotitem; ?>">

<!-- 'Disparador' auxiliar usado para cargar los trabajadores de mantenimiento
	 ( Cambio realizado debido a las modificaciones que sufrio el formulario [Radiobuttion/Button] ) -->
<input type="text" name="radio2" style="border:none; color:#FFFFFF;" onFocus="cargarEmpleaselec(document.form1.arreglo_auxdef.value);" size="1">

<input type="hidden" name="codigo" value="<?php echo $codigo; ?>">
<input type="hidden" name="valor">
<input type="hidden" name="flag">

<input type="hidden" name="otestacodigo1" value= $otestacodigo>
<input type="hidden" name="palntacodigo1" value= $plantacodigo>
<input type="hidden" name="sistemcodigo1" value= $sistemcodigo>
<input type="hidden" name="equipocodigo1" value= $equipocodigo>
<input type="hidden" name="componcodigo1" value= $componcodigo>
<input type="hidden" name="tipmancodigo1" value= $tipmancodigo>
<input type="hidden" name="prioricodigo1" value= $prioricodigo>
<input type="hidden" name="ordtradescri1" value= $ordtradescri>
<input type="hidden" name="ordtrafecini1" value= $ordtrafecini>
<input type="hidden" name="horini1" value= $horini>
<input type="hidden" name="minini1" value= $minini>
<input type="hidden" name="ordtrafecfin1" value= $ordtrafecfin>
<input type="hidden" name="horfin1" value= $horfin>
<input type="hidden" name="minfin1" value= $minfin>
<input type="hidden" name="empleacod1" value= $empleacod>
<input type="hidden" name="empleanomb1" value= $empleanomb>
<input type="hidden" name="empleaselect1" value= $empleaselect>
<input type="hidden" name="tiptracodigo1" value= $tiptracodigo>
<input type="hidden" name="tareacodigo1" value= $tareacodigo>
<input type="hidden" name="tareaotnota1" value= $tareaotnota>
<input type="hidden" name="herramcodigo1" value= $herramcodigo>
<input type="hidden" name="codigoot" value= $codigoot>
</form>
</body>
<?php
if(!$codigo)
{ echo " -->"; }
?>
</html>
