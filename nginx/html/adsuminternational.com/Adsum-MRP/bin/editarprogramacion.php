<?php
ob_start();
ini_set('display_errors',1);
$num =0;
$indice=0;
include ( '../def/tipocampo.php');
include ( '../src/FunGen/fncmsgerror.php');
//include('editaprogramaciones.php');
include ( '../src/FunGen/buscacaracter.php');
include ( '../src/FunGen/sesion/fncvalses.php');
include ( '../src/FunPerPriNiv/pktblplanta.php');
include ( '../src/FunPerPriNiv/pktblsistema.php');
include ( '../src/FunPerPriNiv/pktblequipo.php');
include ( '../src/FunPerPriNiv/pktblcomponen.php');
include ( '../src/FunPerPriNiv/pktblparte.php');
include ( '../src/FunPerPriNiv/pktbltipomedi.php');
include ( '../src/FunPerPriNiv/pktbltiposistema.php');
include ( '../src/FunPerPriNiv/pktbltipoequipo.php');
include ( '../src/FunPerPriNiv/pktbltipocomponen.php');
include ( '../src/FunPerPriNiv/pktblitem.php');
include ( '../src/FunPerPriNiv/pktblherramie.php');
include ( '../src/FunPerPriNiv/pktbltipomant.php');
include ( '../src/FunPerPriNiv/pktbltarea.php');
include ( '../src/FunPerPriNiv/pktbltipotrab.php');
include ( '../src/FunPerPriNiv/pktbltransacherramie.php');
include ( '../src/FunPerPriNiv/pktblusuario.php');
include ( '../src/FunPerPriNiv/pktblpriorida.php');
include ( '../src/FunPerPriNiv/pktblotestado.php');
include ( '../src/FunGen/sesion/fncvarsesion.php');
include ( '../src/FunGen/fncnumprox.php');
include ( '../src/FunGen/fncnumact.php');
include ( '../src/FunPerPriNiv/pktbloperacio.php');
include ( '../src/FunPerPriNiv/pktblot.php');
include ( '../src/FunGen/floadtimehours.php');
include ( '../src/FunGen/floadtimeminut.php');
include ( '../src/FunGen/cargainput.php');
include ( '../src/FunPerPriNiv/pktbltransaction.php');

	$idconn = fncconn();
	
	if($accioneditarprogramacion){
		$arreglodetalle = explode(":", $arr_detalle);

		$cantequipo = count($arreglodetalle);
		
		while( $cantequipo > 0 ){
			$arrregtarequipo = $arreglodetalle[($cantequipo - 1)]; 
			
			//$prograhorini= $horini.':'.$minini;
			$flageditarprogramacion=NULL;
			$campnomb=NULL;
			$codigoprog=NULL;
			
			include ( 'editaprogramacion.php');
	
			$cantequipo--;
		}
	}
	
	if(!$flageditarprogramacion){
		if (!$radiobutton){
			include( '../src/FunGen/fnccontfron.php');
		}
		
		$arr_cod = explode(",",$radiobutton);

		$equipocodigo = trim(str_replace("|s","",$arr_cod[0]));
		$tipmancodigo = trim(str_replace("|n","",$arr_cod[1]));
		
		include_once ('../src/FunPerPriNiv/pktblprogramacion.php');
		
		$programaciones = loadrecordprogramaciongrupo($equipocodigo, $tipmancodigo, $idconn);

		for($i = 0; $i < count($programaciones); $i++ )
		{
			
			if($arr_detalle){
				$arr_detalle .=	':'.$programaciones[$i]['progracodigo'].','.
								$programaciones[$i]['tareotcodigo'].','.
								$programaciones[$i]['sistemcodigo'].','.
								$programaciones[$i]['equipocodigo'].','.
								$programaciones[$i]['componcodigo'].','.
								$programaciones[$i]['partecodigo'].','.
								$programaciones[$i]['tiptracodigo'].','.
								$programaciones[$i]['tareacodigo'].','.
								$programaciones[$i]['progratiedur'].','.
								$programaciones[$i]['prografrecue'].','.
								$programaciones[$i]['tipmedcodigo'].','.
								$programaciones[$i]['prografecini'].','.
								$programaciones[$i]['prograacti'].','.
								$programaciones[$i]['progranota'];
			}else{
				$arr_detalle = 	$programaciones[$i]['progracodigo'].','.
								$programaciones[$i]['tareotcodigo'].','.
								$programaciones[$i]['sistemcodigo'].','.
								$programaciones[$i]['equipocodigo'].','.
								$programaciones[$i]['componcodigo'].','.
								$programaciones[$i]['partecodigo'].','.
								$programaciones[$i]['tiptracodigo'].','.
								$programaciones[$i]['tareacodigo'].','.
								$programaciones[$i]['progratiedur'].','.
								$programaciones[$i]['prografrecue'].','.
								$programaciones[$i]['tipmedcodigo'].','.
								$programaciones[$i]['prografecini'].','.
								$programaciones[$i]['prograacti'].','.
								$programaciones[$i]['progranota'];
			}
		}

		$plantacodigo = $programaciones[0]['plantacodigo'];
		$sistemcodigo = $programaciones[0]['sistemcodigo'];
		$tipmancodigo = $programaciones[0]['tipmancodigo'];
		$otestacodigo = $programaciones[0]['otestacodigo'];
		$prioricodigo = $programaciones[0]['prioricodigo'];
		$prografecgen = $programaciones[0]['prografecgen'];
	
		$Horacreado = explode(":", $programaciones[0]['prograhorgen']);
		
		if($Horacreado[0] == '00')
			$prograhorgen = '12:'.$Horacreado[1].' am';
		elseif($Horacreado[0] < 12)
			$prograhorgen = $Horacreado[0].':'.$Horacreado[1].' am';
		elseif($Horacreado[0] == 12)
			$prograhorgen = $Horacreado[0].':'.$Horacreado[1].' pm';
		elseif($Horacreado[0] > 12)
			$prograhorgen = ($Horacreado[0] - 12).':'.$Horacreado[1].' pm';
		
	}
	
ob_end_flush();
?>
<!-- Propiedad intelectual de Adsum SA (c)
-Todos los derechos reservados-
Creado con WAG Adsum
Autor: Andres A. Riascos D.
Fecha: 26052004
GenVers: 3.1 -->
<html>
	<head>
		<title>Editar registro de programaci&oacute;n</title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		<meta http-equiv="expires" content="0">
		<link rel="stylesheet" type="text/css" href="temas/Noise/Style.css">
		<SCRIPT language=JavaScript src="../src/FunGen/jsrsClient.js" type="text/javascript" ></SCRIPT>
		<script language=JavaScript src="../src/FunGen/fncbotton.js" type="text/javascript" ></script>
		<script language=JavaScript src="../src/FunGen/fncverificarlider.js" type="text/javascript" ></script>
		<SCRIPT LANGUAGE="JavaScript">
			<!-- Begin
			agree = 0;
			//  End -->
			function MM_openBrWindow(theURL,winName,features)
			{ //v2.0
			  window.open(theURL,winName,features);
			}
		</script>
		<SCRIPT LANGUAGE="JavaScript">
			var valor = 0;

			function grabado()
			{
				var data='';
				if(document.form1.tipmancodigo.value == '' || document.form1.prioricodigo.value == '')
				{	
					alert('Alguno de los campos se encuentran vacios, por favor corrija los marcados con *');
					document.form1.flageditarprogramacion.value=1;
				}
				else
				{
					listas_select();
					document.form1.accioneditarprogramacion.value=1;
				}
			}

			function listas_select()
			{
				var arr_detalle = document.form1.arr_detalle.value;
				var row_temp = "";
				var arreglogen = "";
	
				if(arr_detalle != '')
				{
					arr_detalle = arr_detalle.split(":");
		
					for(var i=0; i < (arr_detalle.length); i++)
					{
						row_temp = arr_detalle[i].split(",");
			            
						if(document.getElementById(i + 'activ').checked == true)
						{
							var activacion = '1';	
						}
						else
						{
							var activacion = '0';
						}
			            
						if (arreglogen == "")
						{
							arreglogen = row_temp[0] + ',' + row_temp[1] + ',' + row_temp[2] + ',' + row_temp[3] + ',' + row_temp[4] + ',' + row_temp[5] + ',' + row_temp[6] + ',' + row_temp[7] + ',' + document.getElementById(i + 'dur').value + ',' + document.getElementById(i + 'fre').value + ',' + document.getElementById(i + 'tipmed').value + ',' + document.getElementById(i + 'fecini').value + ',' + activacion + ',' + document.getElementById(i + 'nota').value; 
						}
						else
						{
							arreglogen = arreglogen + ':' + row_temp[0] + ',' + row_temp[1] + ',' + row_temp[2] + ',' + row_temp[3] + ',' + row_temp[4] + ',' + row_temp[5] + ',' + row_temp[6] + ',' + row_temp[7] + ',' + document.getElementById(i + 'dur').value + ',' + document.getElementById(i + 'fre').value + ',' + document.getElementById(i + 'tipmed').value + ',' + document.getElementById(i + 'fecini').value + ',' + activacion + ',' + document.getElementById(i + 'nota').value;
						}
					}
					document.form1.arr_detalle.value = arreglogen;	
				}
			}
		</script>
		<style type="text/css">
			.estilo1 {font-size: 85%; font-family : Arial } 
		</style>
	</head>
<?php if(!$codigo){echo "<!--";} ?>
	<body bgcolor="FFFFFF" text="#000000">
    	<form name="form1" method="post"  enctype="multipart/form-data">
      		<p><font class="NoiseFormHeaderFont">Programaci&oacute;n</font></p>
      		<table width="98%" align="center" cellpadding="1" cellspacing="0" class="NoiseFormTABLE">
        		<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr>
	    		<tr><td class="NoiseFieldCaptionTD"><span class="style5"><font color="FFFFFF">&nbsp;Editar Registro</font></span></td></tr>
	  			<tr><td class="NoiseErrorDataTD" ></td></tr> 
				<tr><td class="NoiseFieldCaptionTD"></td></tr> 
				<!--Fecha Hora-->
				<tr><td class="NoiseSeparatorTD">&nbsp;Fecha / Hora Creaci&oacute;n&nbsp; | &nbsp;<?php  echo $prografecgen." / ".$prograhorgen; ?></td></tr>
				<tr><td class="NoiseFieldCaptionTD"></td></tr> 
				<tr><td class="NoiseErrorDataTD"></td></tr>
	    		<!--Planta-->
	    		<tr><td class="NoiseFooterTD"><?php if($flageditarprogramacion && !$plantacodigo)echo "*";?>&nbsp;Maquina&nbsp;&nbsp;<b><?php echo cargaplantanombre($plantacodigo, $idconn); ?></b></td></tr>
	    		<tr><td class="NoiseFooterTD"><?php if($flageditarprogramacion && !$sistemcodigo)echo "*";?>&nbsp;Sistema&nbsp;&nbsp;<b><?php echo cargasistemnombre($sistemcodigo, $idconn); ?></b></td></tr>
	    		<tr><td class="NoiseFooterTD"><?php if($flageditarprogramacion && !$equipocodigo)echo "*";?>&nbsp;Equipo&nbsp;&nbsp;<b><?php echo cargaequiponombre($equipocodigo, $idconn); ?></b></td></tr>
				<tr>
	 				<td>
	 					<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center">
							<tr><td class="NoiseErrorDataTD" colspan="10"></td></tr>
							<tr><td class="NoiseFieldCaptionTD" colspan="10"></td></tr>
            				<!--Detalle de las OT agregadas a la Programaci&Atilde;&sup3;n-->
            				<tr><td class="NoiseErrorDataTD" colspan="10" align="center"><?php if($flageditarprogramacion && !$arr_detalle)echo "*";?>&nbsp;Programaci&oacute;n</td></tr>
            			    <tr>
            					<td class="NoiseFieldCaptionTD estilo1" width="12%"><font color="#FFFFFF">&nbsp;Tarea</font></td>
            					<td class="NoiseFieldCaptionTD estilo1" width="12%"><font color="#FFFFFF">&nbsp;Componente</font></td>
            					<td class="NoiseFieldCaptionTD estilo1" width="10%"><font color="#FFFFFF">&nbsp;Parte</font></td>
            					<td class="NoiseFieldCaptionTD estilo1" width="10%"><font color="#FFFFFF">&nbsp;Tipo Trabajo</font></td>
            					<td class="NoiseFieldCaptionTD estilo1" width="6%"><font color="#FFFFFF">&nbsp;Dur. hrs.</font></td>
            					<td class="NoiseFieldCaptionTD estilo1" width="4%"><font color="#FFFFFF">&nbsp;Frec.</font></td>
            					<td class="NoiseFieldCaptionTD estilo1" width="9%"><font color="#FFFFFF">&nbsp;Medidor</font></td>
            					<td class="NoiseFieldCaptionTD estilo1" width="9%"><font color="#FFFFFF">&nbsp;Prox. Ejecuci&oacute;n</font></td>
            					<td class="NoiseFieldCaptionTD estilo1" width="6%"><font color="#FFFFFF">&nbsp;Estado</font></td>
            					<td class="NoiseFieldCaptionTD estilo1" width="22%"><font color="#FFFFFF">&nbsp;Descripci&oacute;n</font></td>
							</tr>
							<?php
								$arrAllDetalle = explode(":", $arr_detalle);
								$idcon = fncconn();
								
								for ($j = 0; $j < count($arrAllDetalle); $j++){
									if (($j % 2) == 0)
										echo '<tr class="NoiseFooterTD">'."\n";
									else
										echo '<tr class="NoiseDataTD">'."\n";
									
									$arr_Row = explode(",", $arrAllDetalle[$j]);
								
									$nombcompon = cargacomponnombre($arr_Row[4],$idcon);
									$nombparte = cargapartenombre($arr_Row[5],$idcon);
									$nombtiptrab = cargadetalleprogtiptrab($arr_Row[6],$idcon);
									$nombtarea = cargadetalleprogtarea($arr_Row[7],$idcon);
			                        
									echo '<td class="estilo1">&nbsp;'.$nombtarea.'</td>'."\n";
									echo '<td class="estilo1">&nbsp;'.$nombcompon.'</td>'."\n";
									echo '<td class="estilo1">&nbsp;'.$nombparte.'</td>'."\n";
									echo '<td class="estilo1">&nbsp;'.$nombtiptrab.'</td>'."\n";
									
									$durorden = $j.'dur'; 
									$frecuencia = $j.'fre'; 
									$tipmedida = $j.'tipmed'; 
									$fecinicio = $j.'fecini'; 
									$activo = $j.'activ'; 
									
									if(!$$durorden)
										$duracionot = $arr_Row[8];
									else 
										$duracionot = $$durorden;

									if(!$$frecuencia)
										$frecuenciaot = $arr_Row[9];
									else 
										$frecuenciaot = $$frecuencia;

									if(!$$tipmedida)
										$tipmedidaot = $arr_Row[10];
									else 
										$tipmedidaot = $$tipmedida;

									if(!$$fecinicio)
										$fecinicioot = $arr_Row[11];
									else 
										$fecinicioot = $$fecinicio;

									if(!$$activo)
										$activoot = $arr_Row[12];
									else 
										$activoot = $$activo;
									
									echo '<td width="6%" class="estilo1" align="center"><input type="text" name="'.$j.'dur" id="'.$j.'dur" value="'.$duracionot.'" onblur ="listas_select();" size="1"></td>'."\n";
									echo '<td width="5%" class="estilo1" align="center"><input type="text" name="'.$j.'fre" id="'.$j.'fre" value="'.$frecuenciaot.'" onblur ="listas_select();" size="1"></td>'."\n";
									echo '<td width="10%" class="estilo1"><select name="'.$j.'tipmed" id="'.$j.'tipmed" onchange ="listas_select();">';
									
									$tipomed1 = $tipmedidaot;
			
									$result = fullscantipomedi($idcon);
															
									if($result > 0)
							 			$numReg = fncnumreg($result);
																	
							 		if($numReg)
							 		{
							  	 		for ($i = 0; $i < $numReg; $i++){
							   				$arr = fncfetch($result,$i);
							
							   				if($arr[tipmedcodigo] != 0)
							   				{
						    					echo '<option value ="'.$arr[tipmedcodigo].'" ';
						    										
						      					if($tipomed1 == $arr[tipmedcodigo])
						    						echo "selected";
						    	  				echo ">".$arr[tipmednombre]."</option>"."\n";
											}
							   			}
							 		}
									echo '</select></td>'."\n";
									echo '<td width="12%" class="estilo1" align="center">            
				  							<input name="'.$j.'fecini" id="'.$j.'fecini" type="text"	value="'.$fecinicioot.'" onchange ="listas_select();" size="9" onFocus="if(!agree) this.blur();">
											<img src="../img/cal.gif" border="0" align="absmiddle"  onClick="window.open('."'formcalendario.php?calencodigo=".$j."fecini','cal1','status=no,menubar=no,scrollbars=yes,resizable=yes,left=600,width=200,height=210'".');"></td>'."\n";
									
									echo '<td width="5%" align="center">'."\n";
									echo '<input type="checkbox" name="'.$j.'activ" id="'.$j.'activ" onchange ="listas_select();" ';
									
									if($activoot)
										echo 'checked';
									echo '></td>';
									echo '<td width="5%" align="center">'."\n";
									//echo '<input name="'.$j.'nota" id="'.$j.'nota" type="text"	value="'.$arr_Row[13].'" onchange ="listas_select();" size="25"></td>';
									echo '<textarea name="'.$j.'nota" id="'.$j.'nota" rows="3" wrap="VIRTUAL">'.$arr_Row[13].'</textarea></td>';
									echo '</tr>'."\n";
								}
							?>
            				<tr><td class="NoiseFieldCaptionTD" colspan="10"></td></tr> 
							<tr><td class="NoiseErrorDataTD" colspan="10"></td></tr>
                		</table>
                	</td>
    			</tr>
				<tr>
	 				<td>
	 					<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center">
							<tr>
								<td width="20%" class="NoiseFooterTD"><?php if($flageditarprogramacion && !$tipmancodigo){$tipmancodigo = null; echo "*";}?>&nbsp;Tipo de Mantenimiento</td>
              					<td width="30%" class="NoiseFooterTD"><select name="tipmancodigo">
                  				<?php
          							$tipoman1 = $tipmancodigo;
			
									$idcon = fncconn();
									$result = fullscantipomant($idcon);
									
									if($result > 0)
				 						$numReg = fncnumreg($result);
											
				 					if($numReg){
				   						for ($i = 0; $i < $numReg; $i++)
				   						{
				   							$arr = fncfetch($result,$i);
		
				   							if($arr[tipmancodigo] != 0)
				   							{
			    								echo '<option value ="'.$arr[tipmancodigo].'" ';
			    										
		    	  								if($tipoman1 == $arr[tipmancodigo])
			    									echo "selected";
			    	  							echo ">".$arr[tipmannombre]."</option>"."\n";
											}
				   						}
				 					}
								?>
              					</select></td>
              					<td width="20%" class="NoiseFooterTD"><?php if($flageditarprogramacion && !$prioricodigo){ echo $prioricodigo = null; echo "*";}?><span>&nbsp;Prioridad de las OT</span></td>    
              					<!--Prioridad-->
              					<td width="30%" align="left" class="NoiseFooterTD"><select name="prioricodigo">
                				<?php
          							$priori1 = $prioricodigo;
			
									$idcon = fncconn();
									$result = fullscanpriorida($idcon);
									
									if($result > 0)
				 						$numReg = fncnumreg($result);
											
				 					if($numReg){
				   						for ($i = 0; $i < $numReg; $i++)
				   						{
				   							$arr = fncfetch($result,$i);
		
				   							if($arr[prioricodigo] != 0)
				   							{
			    								echo '<option value ="'.$arr[prioricodigo].'" ';
		    	  								if($priori1 == $arr[prioricodigo])
		    										echo "selected";
			    	  							echo ">".$arr[priorinombre]."</option>"."\n";
											}
				   						}
				 					}
								?>
              					</select></td>
	    					</tr>
            				<tr>
              					<!--Estado-->
              					<td class="NoiseFooterTD">&nbsp;Estado</td>
              					<td class="NoiseFooterTD"><select name="otestacodigo">
                  				<?php
        							include('../src/FunGen/floadotestadoot.php');
            						$idcon = fncconn();
            						floadotestadoot($otestacodigo,$idcon);
            						fncclose($idcon);
 			  					?>
              					</select></td>
              					<td colspan="2" class="NoiseFooterTD">&nbsp;</td>
            				</tr>
            				<tr>
            				<tr><td class="NoiseErrorDataTD" colspan="4"></td></tr> 
							<tr><td class="NoiseFieldCaptionTD" colspan="4"></td></tr> 
							<tr><td class="NoiseErrorDataTD" colspan="4"></td></tr>
							<tr><td class="NoiseErrorDataTD" colspan="4"></td></tr>
          				</table>
          			</td>
				</tr>
				<tr>
	  				<td><div align="center">
  						<input type="image" name="aceptar"  src="../img/aceptar.gif" onClick="grabado();"  width="86" height="18" alt="Aceptar" border=0>
  						<!--onClick="carga();form1.ordtrahorini.value = form1.horini.value+':'+form1.minini.value;form1.ordtrahorfin.value = form1.horfin.value+':'+form1.minfin.value;form1.accionnuevoot.value = 1;" width="86" height="18" alt="Aceptar" border=0>
  						<!--Cambio nombre de archivo a cargar 03/08/2007 946AMcbedoya-->
  						<input type="image" name="cancelar" src="../img/cancelar.gif" onClick="form1.action='maestablprogramacionequipos.php';"  width="86" height="18" alt="Cancelar" border=0>
	  				</div></td>
				</tr>
				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr>  
  			</table>
  			<?php
				if($campnomb){
			  		echo '<font face = "Verdana" >Corregir los capos marcados con *</font>';
			  		echo '<script language="javascript">';
			  		echo '<!--//'."\n";
			  		echo 'alert("Por favor corrija los campos marcados con *")';
			 		echo '//-->'."\n";
			  		echo '</script>';
				}
  			?>
		  	<!--<INPUT TYPE="HIDDEN" NAME="selec" value= "$arreglo_equi" >-->
		  	<input type="hidden" name="accioneditarprogramacion">
		  	<input type="hidden" name="flageditarprogramacion" value="<?php echo $flageditarprogramacion; ?>">
		  	<input type="hidden" name="plantacodigo" value="<?php echo $plantacodigo; ?>">
		  	<input type="hidden" name="equipocodigo" value="<?php echo $equipocodigo; ?>">
		  	<input type="hidden" name="sistemcodigo" value="<?php echo $sistemcodigo; ?>">
  
  			<!-- Datos de usuariotareot -->
			<input type="hidden" name="arreglo_tecnic" value="<?php  echo $arreglo_tecnic; ?>">
			<input type="hidden" name="arreglo_temptecnic" value="<?php echo $arreglo_temptecnic; ?>">
			<!-- Arreglo de programacion -->
  			<input type="hidden" name="arr_detalle" value="<?php echo $arr_detalle; ?>">
             
  			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>">
		</form>
  	</body>
  <?php
	if(!$codigo){ echo " -->"; }
  ?>
</html>