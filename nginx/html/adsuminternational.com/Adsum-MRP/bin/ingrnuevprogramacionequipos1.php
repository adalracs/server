<?php
ob_start();
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
include ( '../src/FunPerPriNiv/pktbltipomedi.php');
include ( '../src/FunPerPriNiv/pktbltransaction.php');
include ( '../src/FunPerPriNiv/pktblotestado.php');
include ( '../src/FunGen/sesion/fncvarsesion.php');
include ( '../src/FunGen/floadtimehours.php');
include ( '../src/FunGen/floadtimeminut.php');
if($accionnuevoprogramacion)
{
	$arregloequipos[0]=1;
	$arregloequipos[1]=2;
	$arregloequipos[2]=3;

	$tamano= count($arregloequipos);
	for ($i = 0; $i < $tamano; $i++) {

		$equipocodigo=$arregloequipos[$i];
		include ( 'grabaprogramacion.php');
	} 
}

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
<title>Nuevo registro de programaci&oacute;n</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta http-equiv="expires" content="0">
<link rel="stylesheet" type="text/css" href="temas/Noise/Style.css">
<SCRIPT language=JavaScript src="../src/FunGen/jsrsClient.js"		type="text/javascript" ></SCRIPT>
<script language=JavaScript src="../src/FunGen/cargarSistema.js" type="text/javascript" ></script>
<script language=JavaScript src="../src/FunGen/cargarEquipos.js" type="text/javascript" ></script>
<script language=JavaScript src="../src/FunGen/cargarComponen.js" type="text/javascript" ></script>
<script language=JavaScript src="../src/FunGen/cargarEmpleaselec.js" type="text/javascript" ></script>
<script language=JavaScript src="../src/FunGen/cargarTransacherram.js" type="text/javascript" ></script>
<script language=JavaScript src="../src/FunGen/cargarTransacitem.js" type="text/javascript" ></script>
<script language=JavaScript src="../src/FunGen/cargarTipomedi.js" type="text/javascript" ></script>
<script language=JavaScript src="../src/FunGen/fncbotton.js" type="text/javascript" ></script>
<script language=JavaScript src="../src/FunGen/fncverificarlider.js" type="text/javascript" ></script>
<SCRIPT LANGUAGE="JavaScript">
<!-- Begin
agree = 0;
//  End -->

</script>
<SCRIPT LANGUAGE="JavaScript">
var arreglo_auxdef = new Array;
var arreglo_herr = new Array;
var arreglo_ite = new Array;
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

	form1.prograhorini.value = form1.horini.value+':'+form1.minini.value;
}
</script>
</head>
<?php
    if(!$codigo)
    { echo "<!--";}
?>
<body bgcolor="FFFFFF" text="#000000">
<form name="form1" method="post"  enctype="multipart/form-data">
<p><font class="NoiseFormHeaderFont">Programaci&oacute;n</font></p>
<table border="0" cellspacing="1" cellpadding="2" align="center"
class="NoiseFormTABLE">
  <tr>
    <td class="NoiseErrorDataTD">&nbsp;</td>
  </tr>
  <tr>
  	<td class="NoiseFieldCaptionTD"><span class="style5"><font color="FFFFFF">Ingresar nuevo registro</font></span></td>
  </tr>
<tr>
	<td>
		<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
          <!--DWLayoutTable-->
          <tr> 
            <td width="100" height="21">&nbsp;</td>
            <td width="5">&nbsp;</td>
            <td width="106">&nbsp;</td>
            <td width="56">&nbsp;</td>
            <td width="16">&nbsp;</td>
            <td width="31">&nbsp;</td>
            <td width="143">Fecha: 
              <?php $prografecgen=date("Y-m-d");echo $prografecgen; ?>
              <br></td>
            <td colspan="2"><div align="right">Hora:&nbsp;&nbsp;</div></td>
            <td width="52"> 
              <?php $prograhorgen= date("H:i"); echo $prograhorgen; ?>
            </td>
            <td width="163">&nbsp;</td>
          </tr>
          <tr> 
            <td height="44" valign="top"> 
              <?php if($campnomb["plantacodigo"] == 1)echo "*";?>
              Planta</td>
            <td colspan="2" valign="top"> 
              <?php if($campnomb["sistemcodigo"] == 1)echo "*";?>
              Sistema </td>
            <td colspan="3" valign="top"> 
              <?php if($campnomb["equipocodigo"] == 1)echo "*";?>
              Equipo</td>
              <?php if($campnomb["selectequipo1"] == 1)echo "*";?>
              Lista equipos</td>
            <td colspan="2" valign="top"><input type="button" name="ingresaequipo" value=">>" onClick= "transferTo( this.form.selectequipo1,this.form.selectequipo2);">

              <input type="button" name="eliminaequipo" value="<<" onClick="transferTo( this.form.selectequipo2,this.form.selectequipo1);"> 
            </td>
            <td colspan="2" valign="top"> 
              <?php if($campnomb["componcodigo"] == 1)echo "*";?>
              Componente</td>
            <td>&nbsp;</td>
          </tr>
          <tr> 
            <td height="54" valign="top"> <select name="plantacodigo" onchange="cargarSistemas(this.value);">
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
					floadplanta($idcon);
					fncclose($idcon);
				?>
              </select> </td>
            <td colspan="2" valign="top"> <select name="sistemcodigo" onChange="cargarEquiposprog(this.value);">
                <?php
					if($sistemcodigo)
					{
						echo '<option value = "'.$sistemcodigo.'">';
						$idcon	= fncconn();
						$arrsistema = loadrecordsistema($sistemcodigo,$idcon);
						echo $arrsistema[sistemnombre]."</OPTION>";
						$codigosistema= $arrsistema[sistemcodigo];
						$nombresistema= $arrsistema[sistemnombre];
						include ('../src/FunGen/floadsistemaot.php');
						floadsistemaot($plantacodigo,$idcon);
						fncclose($idcon);
					}
            	?> 
                <option value="">Seleccione</option>
              </select> </td>
            <td colspan="3" valign="top"><select name="equipocodigo" disabled=0 onChange="cargarComponen(this.value);">
                <?php
					if($equipocodigo)
					{
						echo '<option value = "'.$equipocodigo.'">';
						$idcon	= fncconn();
						$arrequipo = loadrecordequipo($equipocodigo,$idcon);
						echo $arrequipo[equiponombre]."</OPTION>";
						$codigoequipo= $arrequipo[equipocodigo];
						$nombresistema= $arrequipo[equiponombre];
						include ('../src/FunGen/floadequipoot.php');
						floadequipoot($sistemcodigo,$idcon);
						fncclose($idcon);
					}
            	?>
                <option value="">Seleccione</option>
              </select></td>
            <td colspan="2" valign="top"> <select name="selectequipo1" size="3">
            </select>
              <select name="selectequipo2" size="3">
              </select> </td>
            <!-- se registran los equipos ana -->
            <td colspan="2" rowspan="2" valign="top"> <select name="componcodigo">
                <?php
					if($componcodigo)
					{
						echo '<option value = "'.$componcodigo.'">';
						$idcon	= fncconn();
						$arrcomponen = loadrecordcomponen($componcodigo,$idcon);
						echo $arrcomponen[componnombre]."</OPTION>";
						include ('../src/FunGen/floadcomponenequi.php');
						floadcomponenequi($equipocodigo,$idcon);
						fncclose($idcon);
					}
	            ?>
                <option value="">Seleccione</option>
              </select> 
            <td></td>
            <!-- se registran los equipos ana -->
          </tr>
          <tr> 
            <td height="16"></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td width="52">
            <td></td>
          </tr>
          <tr> 
            <td height="21" colspan="10"><hr></td>
            <td>&nbsp;</td>
          </tr>
          <tr> 
            <td height="34" colspan="2"> 
              <?php if($campnomb["tipmancodigo"] == 1){$tipmancodigo = null; echo "*";}?>
              Tipo de mantenimiento</td>
            <td colspan="8"><select name="tipmancodigo">
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
					floadtipomant($idcon);
					fncclose($idcon);
				?>
              </select></td>
            <td>&nbsp;</td>
          </tr>
          <tr> 
            <td height="16" colspan="3"></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td width="39"></td>
            <td></td>
            <td></td>
          </tr>
          <tr> 
            <td height="38" colspan="2"> 
              <?php if($campnomb["tipmedcodigo"] == 1){$tipmedcodigo = null; echo "*";}?>
              Tipo de medidor</td>
            <td colspan="2"> <select name="tipmedcodigo" onchange="cargarTipomedi(this.value);">
                <?php
					if($tipmedcodigo)
					{
						echo '<option value = "'.$tipmedcodigo.'">';
						$idcon	= fncconn();
						$arrtipomedi = loadrecordtipomedi($tipmedcodigo,$idcon);
						fncclose($idcon);
						echo $arrtipomedi[tipmednombre];
						echo '<option value = "">Seleccione';
					}
					else
					{
						echo '<option value = "">Seleccione';
					}
            	?></OPTION>
                <?php
					include ('../src/FunGen/floadtipomedi.php');
					$idcon = fncconn();
					floadtipomedi($idcon);
					fncclose($idcon);
				?>
              </select> </td>
            <td colspan="3"> 
              <?php if($campnomb["prografrecue"] == 1){$prografrecue = null; echo "*";}?>
              Frecuencia&nbsp;&nbsp; <input type="text" name="prografrecue" value="<?php if(!$flagnuevoprogramacion){ echo $sbreg[prografrecue];}else{echo $prografrecue;}?>" size="6"> 
              &nbsp; <input type="text" name="tipmedacra" onfocus="if(!agree)this.blur();" value="<?if($flagnuevoprogramacion){ echo $tipmedacra; }?>" size="5" style="border:none"></td>
            <td colspan="2"> 
              <?php if($campnomb["progratiedur"] == 1){$progratiedur = null; echo "*";}?>
              Duraci&oacute;n&nbsp; </td>
            <td><input type="text" name="progratiedur" value="<?php if(!$flagnuevoprogramacion){ echo $sbreg[progratiedur];}else{echo $progratiedur;}?>" size="6"> 
              &nbsp;horas</td>
            <td>&nbsp;</td>
          </tr>
          <tr> 
            <td height="16" colspan="3"></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
          </tr>
          <tr> 
            <td height="50" colspan="2"> 
              <?php if($campnomb["prografecini"] == 1){$prografecini = null; echo "*";}?>
              Fecha Inicio </td>
            <td colspan="2"><input name="prografecini" type="text"	value="<?php if(!$flagnuevoprogramacion){ echo $sbreg[prografecini];} else {echo $prografecini;}?>" size="12" onfocus="if(!agree) this.blur();"> 
              &nbsp; <img src="../img/cal.gif" border="0" onclick="window.open('formcalendario.php?calencodigo=prografecini','cal1','status=no,menubar=no,scrollbars=yes,resizable=yes,left=600,width=200,height=210');">&nbsp;&nbsp; 
            </td>
            <td>&nbsp;</td>
            <td> 
              <?php if($campnomb["prograhorini"] == 1){$prograhorini = null; echo "*";}?>
              Hora Inicio </td>
            <td> <select name="horini">
                <?php
					if($flagnuevoprogramacion)
						echo '<option value ="'.$horini.'">'.$horini.'</option>'."\n";
						floadtimehours();
				?>
              </select> <select name="minini">
                <?php
					if($flagnuevoprogramacion)
						echo '<option value ="'.$minini.'">'.$minini.'</option>'."\n";
						floadtimeminut();
				?>
              </select> &nbsp;&nbsp; <input type="checkbox" name="pasadmerini" <?php if($flagnuevoprogramacion){if($pasadmerini)echo "CHECKED";}?>> 
              &nbsp;p.m </td>
            <td colspan="2"> 
              <?php if($campnomb["progracantid"] == 1){$progracantid = null; echo "*";}?>
              Cantidad&nbsp; </td>
            <td><input type="text" name="progracantid" value="<?php if(!$flagnuevoprogramacion){ echo $sbreg[progracantid];}else{echo $progracantid;}?>" size="4"></td>
            <td>&nbsp;</td>
          </tr>
          <tr> 
            <td height="16" colspan="3"></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
          </tr>
          <tr> 
            <td height="24" colspan="2" align="left">Estado</td>
            <td colspan="2"> <select name="otestacodigo">
                <?
 				include('../src/FunGen/floadotestadoot.php');
 				$idcon = fncconn();
 				floadotestadoot($idcon);
 				fncclose($idcon);
 				?>
              </select> </td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr> 
            <td height="16" colspan="3"></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
          </tr>
          <tr> 
            <td height="21" colspan="10"><hr></td>
            <td>&nbsp;</td>
          </tr>
        </table>
	</td>
</tr>
<tr>
	<td>
		<table width="97%" border="0" cellspacing="0" cellpadding="0" align="center">
			<tr>
      			<td colspan="3"><?php
      			if($campnomb["empleacod"] == 1)
      			{
      				echo "*";
      				$empleacod="";
      				$empleanomb="";
      			}
      			?>
      			Colaborador de mantenimiento&nbsp;&nbsp;&nbsp;
        		<input name="radio1" type="radio" onclick="window.open('consultarusuarioot.php?codigo=<?php echo $codigo?>','ventana1','status=no,menubar=no,scrollbars=yes,resizable=yes,left=300,width=800,height=600');" width="86" height="18" alt="Cancelar" border=0 href="#" target="_parent"></td>
        		<td>C&oacute;digo</td>
        		<td><input name="empleacod" type="text"	value="<?php if(!$flagnuevoprogramacion){ echo $empleacod;} else {echo $empleacod;} ?>" size="8"></td>
      			<td>Nombre </td>
      			<td colspan="2"><input  name="empleanomb" type="text" value="<?php echo $empleanomb;?>" size="25" onFocus="if (!agree)this.blur();"></td>
      		</tr>
			<tr>
      			<td colspan="8">&nbsp;</td>
    		</tr>
    		<tr>
      			<td colspan="3">Auxiliares de mantenimiento&nbsp;&nbsp;
          		<input name="radio2" onfocus="resp=fncverificarlider(window.document.form1.empleacod);if(resp)cargarEmpleaselec(document.form1.arreglo_auxdef.value);" type="radio" onclick="window.open('consultarusuaauxot.php?codigo=<?php echo $codigo?>&empleacod='+window.document.form1.empleacod.value,'ventana2','status=no,menubar=no,scrollbars=yes,resizable=yes,left=300,width=800,height=600');" width="86" height="18" alt="Cancelar" border=0 href="#" target="_parent"></td>
      			<td colspan="5">&nbsp;</td>
    		</tr>
    		<tr>
      			<td colspan="8">&nbsp;</td>
    		</tr>
			<tr>
      			<td colspan="3">Auxiliares</td>
      			<td colspan="5">Auxiliares eliminados</td>
      		</tr>
			<tr>
      			<td colspan="2" rowspan="2"><div align="left">
          		<select name="empleaselec" size="3">
		    	<?php
		        	include('../src/FunGen/floadusuario2.php');
					$idcon = fncconn();
					floadusuario2($idcon,$arr_borrar);
					fncclose($idcon);
		        ?>
		        </select></div>
		        </td>
      			<td><div align="center">
        		<input type="button" value="Eliminar" name="eliminaaux"
		        onClick="window.document.form1.arr_borrar.value='';
		        transferTo(this.form.empleaselec,this.form.empleadelet);">
      			</div>
      			</td>
      			<td colspan="5" rowspan="2"><div align="center"></div>
        		<div align="left">
          		<select name="empleadelet" size="3">
          		</select>
        		</div>
        		</td>
      		</tr>
      		<tr>
      			<td><div align="center">
        		<input type="button" value="Agregar" name="adicionaux" onClick="transferTo(this.form.empleadelet,this.form.empleaselec);">
      			</div>
      			</td>
      		</tr>
      		<tr>
				<td colspan="8"><hr></td>
			</tr>
      		<tr>
   				<td width="13%"><?php if($campnomb["tiptracodigo"] == 1){$tiptracodigo = null; echo "*";}?>Tipo de trabajo</td>
    			<td colspan="2"><select name="tiptracodigo">
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
					floadtipotrab($idcon);
					fncclose($idcon);
				?>
	        	</select>
				</td>
				<td width="10%"><?php if($campnomb["tareacodigo"] == 1){ echo $tareacodigo = null; echo "*";}?>Tarea</td>
          		<td colspan="2"><select name="tareacodigo">
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
					floadtarea($idcon);
					fncclose($idcon);
				?>
            	</select>
				</td>
        		<td><?php if($campnomb["prioricodigo"] == 1){ echo $prioricodigo = null; echo "*";}?>Prioridad</td>
          		<td><select name="prioricodigo">
          		<?php
	          		if($prioricodigo)
	     			{
	       				echo '<option value = "'.$prioricodigo.'">';
		        		$idcon	= fncconn();
						$arrpriorida = loadrecordpriorida($prioricodigo,$idcon);
						echo $arrpriorida[priorinombre];
						fncclose($idcon);
						echo '<option value = "">Seleccione';
				     }else
				     		echo '<option value = "">Seleccione';
			     ?></OPTION>
				<?php
					include ('../src/FunGen/floadpriorida.php');
					$idcon = fncconn();
					floadpriorida($idcon);
					fncclose($idcon);
				?>
            	</select>
				</td>
			</tr>
      		<tr>
    			<td width="13%"><?php if($campnomb["progranota"] == 1){echo $progranota = null; echo "*";}?>Descripci&oacute;n del trabajo a realizar</td>
	      		<td height="36" colspan="7"><textarea name="progranota" cols="71" rows="3" wrap="VIRTUAL"><?php if(!$flagnuevoprogramacion){ echo $sbreg["progranota"];}else{ echo $progranota;}?></textarea></td>
			</tr>
			<tr>
				<td colspan="8">&nbsp;</td>
			</tr>
			<tr>
				<td colspan="2">Herramientas
			    <input name="radio3" type="radio" onfocus="cargarTransacherram(document.form1.loadherram.value);"  onclick="window.open('ingrnuevtransacherrampro.php?codigo=<?php echo $codigo;?>','ventana3','status=no,menubar=no,scrollbars=yes,resizable=yes,left=300,width=800,height=600');" width="86" height="18" alt="Cancelar" border=0 href="#" target="_parent"></td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td colspan="2">Item
		  		<input name="radio4" onfocus="cargarTransacitem(document.form1.loaditem.value);" type="radio" onclick="window.open('ingrnuevtransacitempro.php?codigo=<?php echo $codigo?>','ventana4','status=no,menubar=no,scrollbars=yes,resizable=yes,left=300,width=800,height=600');" width="86" height="18" alt="Cancelar" border=0 href="#" target="_parent"></td>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td colspan="2">&nbsp;</td>
				<td colspan="2">Herramientas Eliminadas </td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>Item Eliminados </td>
			</tr>
			<tr>
	    		<td width="13%" rowspan="2"><select name="herramcodigo" size="3">
	    		<?php
					include ('../src/FunGen/floadherramieot.php');
					$idcon = fncconn();
					floadherramieot($idcon,$arrtransaccod);
					fncclose($idcon);
				?>
            	</select>
            	</td>
      			<td width="9%" height="25"><div align="center">
      			<!--
fncborraropcselecc(window.document.form1.herramcodigo,window.document.form1.loadherram);
				-->
      		  	<input type="button" name="adicionaher" value="Eliminar"
				onClick="window.document.form1.loadherram.value='';
				transferTo( this.form.herramcodigo,this.form.herramcodigo1);">
      			</div>
				</td>
	        	<td width="12%" rowspan="2"><div align="center"></div>
	        	<div align="left">
	          	<select name="herramcodigo1" size="3">
	          	</select>
				</div>
				</td>
	       		<td width="10%" rowspan="2"><div align="left"></div></td>
      			<td width="10%" rowspan="2"><div align="right">&nbsp;&nbsp;&nbsp;</div></td>
				<td width="16%" rowspan="2"><div align="left">
		  		<select name="itemcodigo" size="3">
		  		<?php
					include ('../src/FunGen/floaditemot.php');
					$idcon = fncconn();
					floaditemot($idcon,$arrtransaccoditem);
					fncclose($idcon);
				?>
				</select>
		  		</div></td>
        		<td width="11%"><div align="center"><input type="button" name="adicionaite" value="Eliminar"
				onClick="window.document.form1.loaditem.value='';
				transferTo(this.form.itemcodigo,this.form.itemcodigo1);">
        		</div></td>
	      		<td width="18%" rowspan="3"><div align="left"><select name="itemcodigo1" size="3"></select></div></td>
			</tr>
			<tr>
	  			<td width="9%"><input type="button" name="eliminaher" value="Agregar" onClick="transferTo( this.form.herramcodigo1,this.form.herramcodigo);"></td>
    			<td width="11%"><div align="center"><input type="button" name="eliminaite" value="Agregar" onClick="transferTo( this.form.itemcodigo1,this.form.itemcodigo);">
	      		</div>
	      		</td>
				<td width="1%" colspan="6">&nbsp;</td>
  			</tr>
  		</table>
	</td>
</tr>
<tr>
	<td>
	<div align="center">
  	<input type="image" name="aceptar"  src="../img/aceptar.gif" onclick="carga();form1.accionnuevoprogramacion.value =  1;"  width="86" height="18" alt="Aceptar" border=0>
  	<input type="image" name="cancelar" src="../img/cancelar.gif" onclick="form1.action='maestablprogramacion.php';"  width="86" height="18" alt="Cancelar" border=0>
	</div>
	</td>
</tr>
<tr>
	<td class="NoiseErrorDataTD">&nbsp;</td>
</tr>
</table>
<?php
if($campnomb){echo '<font face = "Verdana" >Corregir los capos marcados con *</font>';}
?>
<input type="hidden" name="accionnuevoprogramacion">
<input type="hidden" name="progracodigo" value="<?php if(!$flagnuevoprogramacion){ echo $sbreg[progracodigo];}else{ echo $progracodigo; } ?>">
<input type="hidden" name="prografecgen" value="<?php echo $prografecgen; ?>">
<input type="hidden" name="prograhorgen" value="<?php echo $prograhorgen; ?>">
<input type="hidden" name="prograhorini">
<!-- Datos de colaborador lider-->
<input type="hidden" name="emptarlider" value="<?php if($empleacod){ $emptarlider=1; echo $emptarlider; } else{ $emptarlider=0; echo $emptarlider; }?>">
<!-- Datos de colaboradores auxiliares -->
<input type="hidden" name="arreglo_auxdef" value="<?php echo $arreglo_auxdef; ?>">
<input type="hidden" name="arr_borrar" value="<?php echo $arr_borrar; ?>">
<!-- Datos de herramienta -->
<input type="hidden" name="arreglo_herr" value="<?php echo $arreglo_herr; ?>">
<input type="hidden" name="loadherram" value="<?php $loadherram; ?>">
<!-- Datos de item -->
<input type="hidden" name="arreglo_ite" value="<?php echo $arreglo_ite; ?>">
<input type="hidden" name="loaditem" value="<?php $loaditem; ?>">

<input type="hidden" name="codigo" value="<?php echo $codigo; ?>">
<input type="hidden" name="tipo_de_ot" value="1">
</form>
</body>
<?php
    if(!$codigo)
    { echo " -->"; }
?>
</html>