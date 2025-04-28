<?php
ini_set("display_errors", 1);
ob_start();
$num =0;
$indice=0;
include ( '../src/FunGen/sesion/fncvalses.php');
include ( '../src/FunPerPriNiv/pktblprogramacion.php');
include ( '../src/FunPerPriNiv/pktblplanta.php');
include ( '../src/FunPerPriNiv/pktblsistema.php');
include ( '../src/FunPerPriNiv/pktblequipo.php');
include ( '../src/FunPerPriNiv/pktbltipotrab.php');
include ( '../src/FunGen/fncnumprox.php');
include ( '../src/FunGen/fncnumact.php');
include ( '../src/FunGen/sesion/fncvarsesion.php');
include ( '../src/FunGen/floadtimehours.php');
include ( '../src/FunGen/floadtimeminut.php');
include ( '../src/FunPerPriNiv/pktbltransaction.php');
include ( '../src/FunPerPriNiv/pktbltarea.php');

if($accionnuevoprogramacion)
{
	if($arr_detalle)
	{
		if($lider)
		{
			$prograhorini = $horini.":".$minini;
			$cont=0;
			
			if($prografecini == date("Y-m-d"))
			{
				$foo1 = explode(":",$prograhorini);
				
				if($pasadmerini)
				{
					if($foo1[0] != 12)
						$prograhorini = ($foo1[0] + 12).":".$foo1[1];
				}
				elseif($foo1[0] == 12)
					$prograhorini = "00:".$foo1[1];
               	else 
                {
	                $prograhorini = ($foo1[0] + 12).":".$foo1[1];
	            	$cont = 1;
	            }
				if ($prograhorini >= date("H:i"))
					$cont = 1;
				else
					$cont = 1;
					
			}
			elseif ($prografecini > date("Y-m-d"))
				$cont = 1;
			// Aqui termina la diferencia
			/* Diferencia	
				if ($prograhorini >= date("H:i")){
					$cont = 1;
				}else{
					$cont = 0;
				}
			}elseif ($prografecini > date("Y-m-d")){
				$cont = 1;
			}
				$cont=1;
 Vuelve a ser igual */
			if ($cont == 1)
			{
				$idcon = fncconn();
				$progranumgru = fncnumact(98,$idcon); //cbedoya
				//$progratiedur = loadsumtiedurprogramacion($arr_detalle, $idcon);
				fncclose($idcon);
				$progranumgru ++;
				$arreglodetalle = explode(":?:", $arr_detalle);
				$cantequipo = count($arreglodetalle);
			
				while( $cantequipo > 0 ){
					$arrregtarequipo = $arreglodetalle[($cantequipo - 1)]; 
					$flagnuevoprogramacion=NULL;
					$campnomb=NULL;
					$codigoprog=NULL;
				   
					if($arrregtarequipo){ include ( 'grabaotprograma.php');}
					$cantequipo--;
				}
			}else{
				echo '<script language="javascript">';
				echo '<!--//'."\n";
				echo 'alert(\'La Fecha - Hora debe ser mayor a la actual\');'."\n";
				echo '//-->'."\n";
				echo '</script>';
				$flagnuevoprogramacion=1;	
			}
		} 
		else 
		{
			echo '<script language="javascript">';
			echo '<!--//'."\n";
			echo 'alert(\'Debe seleccionar el usuario encargado de la ejecucion de la orden\');'."\n";
			echo '//-->'."\n";
			echo '</script>';	
			$flagnuevoprogramacion=1;	
		}
	}
	else
	{
		echo '<script language="javascript">';
		echo '<!--//'."\n";
		echo 'alert(\'Debe seleccionar al menos una tarea para generar la OT\');'."\n";
		echo '//-->'."\n";
		echo '</script>';	
		$flagnuevoprogramacion=1;	
	}
	$accionnuevoprogramacion = 0;
}

if($acciondesactivatarea){
	$arreglodetalle = split(",", $arr_detalle);
	$cantequipo = count($arreglodetalle);
	while( $cantequipo > 0 ){
		$arrregtarequipo = $arreglodetalle[($cantequipo - 1)]; 
		if($arrregtarequipo){ 
			include_once ( '../src/FunPerPriNiv/pktblprogramacion.php');
			$ircRecord[progracodigo] = $arrregtarequipo;
			$ircRecord[prografecini] =  date("Y-m-d");
			$ircRecord[prograhorini] =  date("H:i");
			$ircRecord[prograrepot]=0;
			/* Campo diferente
			$ircRecord[prograacti]=0;	Termina campo dferente*/		
			$nuconn =fncconn();				
			$nuResult = uprecordprogramacion($ircRecord,$nuconn);
			fncclose($nuconn);
		}
		$cantequipo--;
	}
	$acciondesactivatarea=0;
	//$flagnuevoprogramacion=1;
}
$idcon = fncconn();
ob_end_flush();
?>
<!-- Propiedad intelectual de Adsum SA (c)
-Todos los derechos reservados-
Creado con WAG Adsum
Autor: cbedoya
Fecha: 12-oct-2007
GenVers: 3.1 -->
<html>
	<head>
		<title>Nuevo registro de programaci&oacute;n</title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		<meta http-equiv="expires" content="0">
		<link rel="stylesheet" type="text/css" href="temas/Noise/Style.css">
		<link rel="stylesheet" type="text/css" href="temas/Noise/help.css">
		<SCRIPT language=JavaScript src="../src/FunGen/jsrsClient.js"		type="text/javascript" ></SCRIPT>
		<script language=JavaScript src="../src/FunGen/cargarSistema.js" type="text/javascript" ></script>
		<script language=JavaScript src="../src/FunGen/cargarEquipos.js" type="text/javascript" ></script>
		<script language=JavaScript src="../src/FunGen/prototype162.js" type="text/javascript" ></script>
        <SCRIPT src="../src/FunGen/achelista.js" type="text/javascript"></SCRIPT>
		<SCRIPT LANGUAGE="JavaScript">
			function loadlista(){
				document.all("detalleprograma").src="detallaotprogramacion.php?ingplantas=<?php echo $ingplantas; ?>&plantacodigo="+ document.form1.plantacodigo.value+"&sistemcodigo="+ document.form1.sistemcodigo.value+"&equipocodigo="+ document.form1.equipocodigo.value + "&estadoprogra=" + document.form1.estadoprogra.value+"&prografechfutur="+document.form1.prografechfutur.value + '&tiptracodigo=' +document.form1.tiptracodigo.value;
			
			}

			function desactivboton(valor){
				if (valor == 0){
					document.form1.DESACT.disabled = false;
				}else{
					document.form1.DESACT.disabled = false;
				}
			}
			function verocultar(cual, index) {
				var c=cual.nextSibling;
				if(c.style.display=='none') {
					c.style.display='block';
					document.getElementById("row"+ index).src = "temas/Noise/AscOn.gif";			           
				} else {
					c.style.display='none';
					document.getElementById("row"+ index).src = "temas/Noise/DescOn.gif";			           			           
				}
				return false;
			 }
			 
 			 function load_detall(delitem, arr_detall, arr_detalltmp){
				
				var enc = 0;
				 var new_arreglo = "";
				if(delitem == 0){ new_arreglo = arr_detall; }
						
				arreglogen = arr_detall.split(",");
				arreglogentmp = arr_detalltmp.split(",");
				
				if(arreglogen != ""){
					if (arreglogentmp != ""){
						for(var i=0; i < (arreglogentmp.length); i++){
							if(arreglogentmp[i] != ''){
								for(var j = 0; j < (arreglogen.length); j++){
									if (arreglogen[j] == arreglogentmp[i]){
										enc = 1;
									}
								}
								if(enc == 0){
									if(new_arreglo == ''){
										new_arreglo = arreglogentmp[i];
									}else{
										new_arreglo = new_arreglo + ',' + arreglogentmp[i];
									}
								}else{
									enc = 0;
								}
							}
						}
					}
				}
				
				if(new_arreglo != ""){
					window.document.form1.arreglo_tecnic.value = new_arreglo;
				}else{
					window.document.form1.arreglo_tecnic.value = '';
					if(delitem == 0){	window.document.form1.arreglo_tecnic.value = arr_detalltmp;}
					if(delitem == 1 && arr_detall == ""){	window.document.form1.arreglo_tecnic.value = arr_detalltmp;}
				}
				window.document.form1.arreglo_temptecnic.value = '';
				
				document.all("detall").src="detallausuaot.php?arr_detall="+ window.document.form1.arreglo_tecnic.value + "&lider="+ window.document.form1.lider.value;
			} 
		</script>
	</head>
<?php if(!$codigo){echo "<!--";} ?>
	<body bgcolor="FFFFFF" text="#000000">
		<form name="form1" method="post"  enctype="multipart/form-data">
			<p><font class="NoiseFormHeaderFont">Ordenes Programadas </font></p>
			<table width="100%" align="center" cellpadding="1" cellspacing="1" class="NoiseFormTABLE">
				<tr><td class="NoiseErrorDataTD" colspan="4">&nbsp;</td></tr>
				<tr><td class="NoiseFieldCaptionTD" colspan="4">&nbsp;</td></tr>
	    			
	   			<!--Fecha | Hora-->
	   			<tr><td class="NoiseSeparatorTD" colspan="4">&nbsp;Fecha:&nbsp;<?php $prografecgen=date("Y-m-d"); $prograhorgen = date("h:i a");  echo $prografecgen."&nbsp;&nbsp;&nbsp;&nbsp;Hora:&nbsp;".$prograhorgen; ?></td></tr>
    				<!--Planta |  Sistema | Equipo | Estado-->
				<tr>
					<td width="25%"  class="NoiseFooterTD"><?php if($campnomb["plantacodigo"] == 1)echo "*"; ?>&nbsp;Planta</td>
					<td width="25%" class="NoiseFooterTD"><?php if($campnomb["sistemcodigo"] == 1)echo "*"; ?>&nbsp;Sistema</td>
					<td width="25%" class="NoiseFooterTD"><?php if($campnomb["equipocodigo"] == 1)echo "*"; ?>&nbsp;Equipo</td>
					<td width="25%" class="NoiseFooterTD"><?php if($campnomb["tiptracodigo"] == 1)echo "*"; ?>&nbsp;Tipo Trabajo</td>
				</tr>
    			<tr>
    				<!--Planta-->
					<td width="25%" class="NoiseDataTD"><select name="plantacodigo" onChange="loadlista();cargarSistemas(this.value);">
					<?php
						echo '<option value = "">-- Seleccione --</option>';
						
						include ('../src/FunGen/floadplanta.php');
						floadplanta($plantacodigo,$idcon);
					?>
					</select></td>
					<!--Sistema-->
					<td width="25%" class="NoiseDataTD"><select name="sistemcodigo" onChange="loadlista();cargarEquipos(this.value);">
					<?php
						echo '<option value="">-- Seleccione --</option>';

						include ('../src/FunGen/floadsistemaot.php');
						floadsistemaot($sistemcodigo,$plantacodigo,$idcon);
					?>
					</select></td>
					<!--Equipo-->
					<td width="25%" valign="top" class="NoiseDataTD">
						<select name="equipocodigo"  id="equipocodigo" onChange="loadlista();">
						<?php
							echo '<option value="">-- Seleccione --</option>';
			
							include ('../src/FunGen/floadequipoot.php');
							floadequipoot($equipocodigo, $sistemcodigo,$idcon);
						?>
						</select>
						<IMG onclick="filtradorselect('equipocodigo') ; " src="filter.png" border=0>
	      				<SCRIPT type=text/javascript> Event.observe($('equipocodigo'),'keyup', function(f){ if (f.keyCode==113)filtradorselect('equipocodigo')} ); </SCRIPT>		
					</td>
					<!-- tipo de trabajo -->
					<td width="25%" class="NoiseDataTD"><select name="tiptracodigo" onChange="loadlista();">
					<?php
						echo '<option value="">-- Seleccione --</option>';

						include ('../src/FunGen/floadtipotrab.php');
						floadtipotrab($tiptracodigo,$idcon);
					?>
					</select></td>
				</tr>
				<tr>
					<td width="25%" class="NoiseFooterTD"><?php if($campnomb["estadotarea"] == 1)echo "*"; ?>&nbsp;Estado tarea</td>
					<td width="25%" class="NoiseFooterTD"><?php if($campnomb["prografechfutur"] == 1)echo "*"; ?>&nbsp;Fecha de futura programacion</td>
					<td colspan="2" rowspan="2" class="NoiseFooterTD">&nbsp;</td>
				</tr>
				<tr>
					<!--Estado-->
					<td width="25%" valign="top" class="NoiseDataTD"><select name="estadoprogra" id="estadoprogra" onchange="loadlista();desactivboton(this.value);">
						<option value="" >Seleccione</option>
						<option value="t">Activo</option>
						<option value="f">Inactivo</option>
					</select></td>
					<td width="25%" valign="top" class="NoiseDataTD">
				 		<input type="text" name="prografechfutur" size="8" value="<?php if(!$flagnuevoprogramacion){} else {echo $prografechfutur;}?>"  onchange="loadlista();">&nbsp;
						<img src="../img/cal.gif" align="absmiddle" border="0" onClick="window.open('formcalendario.php?calencodigo=prografechfutur','cal1','status=no,menubar=no,scrollbars=yes,resizable=yes,left=600,width=200,height=210');">
					</td>
				</tr>
				<tr><td class="NoiseErrorDataTD" colspan="4"></td></tr> 
				<tr><td class="NoiseFieldCaptionTD" colspan="4"></td></tr> 
				<tr><td class="NoiseErrorDataTD" colspan="4"></td></tr>
				<tr><td class="NoiseErrorDataTD" colspan="4"></td></tr>
				<tr  class="NoiseFooterTD">
		  			<td colspan="4" class="NoiseFooterTD" valign="middle">
		    				<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center">
							<tr><td class="NoiseFieldCaptionTD"></td></tr> 
  							<tr>
		  						<td bgcolor="White"><iframe src="detallaotprogramacion.php?equipocodigo=<?php $equipocodigo;?>&estadoprogra=<?php $estadoprogra;?>&arr_data=<?php $arr_detalle;?>&fechafutur=<?php date("Y-m-d");?>" frameborder="0" name="detalleprograma" frameborder="0"  height="350" width="100%" align="absmiddle"></iframe></td>
  							</tr>
		  				</table>
		  			</td>
	  			</tr>
				<tr><td class="NoiseErrorDataTD" colspan="4"></td></tr> 
				<tr><td class="NoiseErrorDataTD" colspan="4"></td></tr>
				<tr><td class="NoiseFieldCaptionTD" colspan="4"></td></tr> 
				<tr><td class="NoiseErrorDataTD" colspan="4"></td></tr>	
				<tr>
					<td colspan="9"  class="NoiseFooterTD"><!-- 
						<?php if($campnomb["prografecini"] == 1){$prografecini = null; echo "*";}?>&nbsp;Fecha Inicio 
  						<input type="text" name="prografecini" size="8" value="<?php if(!$flagnuevoprogramacion){echo $prografecini=date("Y-m-d");} else {echo $prografecini;}?>" onFocus="if (!agree)this.blur();">&nbsp;
						<img src="../img/cal.gif" align="absmiddle" border="0" onClick="window.open('formcalendario.php?calencodigo=prografecini','cal1','status=no,menubar=no,scrollbars=yes,resizable=yes,left=600,width=200,height=210');">
						<select name="horini">
						<?php
		 					if(!$flagnuevoprogramacion){
									$horini = date("h");
									if(date("a") == 'pm')
										$pasadmerini = 1;
		 						//echo '<option value ="'.$horini.'">'.$horini.'</option>'."\n";
		 					}				 		
							floadtimehours($horini);
		  				?>
						</select>
						:
						<select name="minini">
						<?php
							if(!$flagnuevoprogramacion){
								$minini = date("i");
		 						//echo '<option value ="'.$minini.'">'.$minini.'</option>'."\n";
							}
		 					floadtimeminut($minini);
		 				?>
						</select>
						<input type="checkbox" name="pasadmerini" <?php if($flagnuevoprogramacion){if($pasadmerini)echo "CHECKED";}else{if($pasadmerini)echo "CHECKED";}?>>p.m
					 --></td>
				</tr>
				<tr><td class="NoiseErrorDataTD" colspan="4"></td></tr> 
				<tr><td class="NoiseErrorDataTD" colspan="4"></td></tr>
				<tr><td class="NoiseFieldCaptionTD" colspan="4"></td></tr> 
				<tr><td class="NoiseErrorDataTD" colspan="4"></td></tr>
				<!--<tr class="NoiseSeparatorTD">
					<td colspan="9" ><?php if($campnomb["lider"] == 1){$lider = null; echo "*";}?> 
						&nbsp;<a onClick="return verocultar(this,'2');" href="javascript:void(0);" >Empleados involucrados en la(s) OT(s)&nbsp;<img id="row2"  align="middle" align="top"  src="temas/Noise/AscOn.gif" border="0"></a><div style="display: none;">
							<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center">      
								<tr><td class="NoiseFieldCaptionTD"></td></tr> 
								<tr>
                									<td align="center"><iframe src="detallausuaot.php?arr_detall=<?php echo $arreglo_tecnic; ?>&lider=<?php echo $lider; ?>" frameborder="0" name="detall"  height="125" width="100%" align="absmiddle"></iframe></td>
                    								</tr>
                								<tr>
                									<td align="right">
                    									<input type="button" name="quitar" onClick="load_detall(1, window.frames['detall'].document.form2.arr_delitem.value,window.document.form1.arreglo_tecnic.value);" alt="Nuevo Registro"  value="Quitar usuarios">
                    									<input type="button" name="consulta"  onFocus="load_detall(0, window.document.form1.arreglo_tecnic.value,window.document.form1.arreglo_temptecnic.value);"  onClick="window.open('maestablusuacuadri.php?codigo=<?php echo $codigo?>&accionconsultarusuario=1&ciudadcodigo=','','status=no,menubar=no,scrollbars=yes,resizable=yes,left=300,width=800,height=600');" alt="Nuevo Registro"  value="Agregar usuarios">
                									</td>
                								</tr>
							</table>
						</dir>  
					</td>
				</tr>
				<tr><td class="NoiseErrorDataTD" colspan="4"></td></tr> 
				<tr><td class="NoiseErrorDataTD" colspan="4"></td></tr>
				<tr><td class="NoiseFieldCaptionTD" colspan="4"></td></tr> 
				<tr><td class="NoiseErrorDataTD" colspan="4"></td></tr>-->
				<tr>
  					<td colspan="3"><!-- <input type="submit" name="GEN" value="Generar OT" onClick="form1.arr_detalle.value = window.frames['detalleprograma'].document.form2.arr_coditem.value; form1.accionnuevoprogramacion.value=1;" width="86" height="18" alt="Aceptar" border=0> --> </td> 
  					<td width="25%">&nbsp;</td>
  				</tr>
				<tr><td class="NoiseErrorDataTD" colspan="4">&nbsp;</td></tr>  
	  		</table>
			<!-- Datos de usuariotareot -->
			<input type="hidden" name="arreglo_tecnic" value="<?php  if($flagnuevoot){ echo $arreglo_tecnic;}  ?>">
			<input type="hidden" name="arreglo_temptecnic" value="<?php  if($flagnuevoot){echo $arreglo_temptecnic;}  ?>">
			<input type="hidden" name="lider"  value="<?php   if($flagnuevoot){ echo $lider;}  ?>">
			  <!--<INPUT TYPE="HIDDEN" NAME="selec" value= "$arreglo_equi" >-->
			  <input type="hidden" name="accionnuevoprogramacion">
			  <input type="hidden" name="acciondesactivatarea">
			  <input type="hidden" name="flagnuevoprogramacion">
			  <input type="hidden" name="fechfutur">
			  <input type="hidden" name="progranumgru" value="<?php echo $progranumgru;  ?>">
			  <input type="hidden" name="indice" value="<?php echo $indice; ?>">
			  <input type="hidden" name="arr_detalle" value="<?php echo $arr_detalle; ?>">
			  <input type="hidden" name="arreglo_del" value="<?php echo $arreglo_del; ?>">
			  <input type="hidden" name="codigo" value="<?php echo $codigo; ?>">
		</form>
  	</body>
<?php 
	fncclose($idcon);
	if(!$codigo){ echo " -->"; }  
?>
</html>