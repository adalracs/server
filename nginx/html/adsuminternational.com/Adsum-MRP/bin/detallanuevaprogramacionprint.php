<?php
session_start();
include('../src/FunPerSecNiv/fncconn.php');
include ( '../src/FunGen/cargainput.php');
/**
* Propiedad intelectual de Adsum (c).
*  Todos los derechos reservados
*
* Nombre: 		  detallaotprint.php
* Descripcion:    Convierte una cadena de HTML en PDF
*
* Fecha: 14-JUN-2006
* Autor: mstroh
*
* Historial de modificaciones
* ---------------------------
*/

// Convierte una orden de trabajo en PDF
require_once('../src/FunPrint/html2fpdf.php');
include('../src/FunGen/fnccargapresentac.php');

	$nuConn=fncconn();
	$sbSql="SELECT MAX(progranumgru) from programacion;";
	$nuResult = pg_exec($nuConn,$sbSql);
	
	unset($sbSql);
	$progranumgru1 = pg_fetch_row($nuResult);
	
	
	$nuConn=fncconn();
	$sbSql="SELECT departnombre from departam where departcodigo=".$_COOKIE["departamento"];
	
	
	$nuResult = pg_exec($nuConn,$sbSql);
	
	unset($sbSql);
	$departamentos = pg_fetch_row($nuResult);
	
	if ($nuConn){
		//
		$sbSql="SELECT vistagrupprogram.progranumgru, planta.plantanombre, tipomant.tipmannombre, priorida.priorinombre,vistagrupprogram.progranota,
				vistagrupprogram.prografecgen,vistagrupprogram.prograhorgen, usuario.usuanombre, usuario.usuapriape, usuario.usuasegape,
				vistagrupprogram.prografecini,vistagrupprogram.prograhorini,max(programacion.prografechfutur) as prografechfutur
				FROM planta, tipomant, usuario, vistagrupprogram, priorida
				WHERE vistagrupprogram.progranumgru=".$progranumgru1[0]." AND planta.plantacodigo = vistagrupprogram.plantacodigo AND 
				tipomant.tipmancodigo = vistagrupprogram.tipmancodigo AND usuario.usuacodi = vistagrupprogram.usuacodi AND 
				priorida.prioricodigo= vistagrupprogram.prioricodigo
				GROUP BY vistagrupprogram.progranumgru, 
				planta.plantanombre,
				tipomant.tipmannombre,
				priorida.priorinombre,
				vistagrupprogram.progranota, 
				vistagrupprogram.prografecgen,
				vistagrupprogram.prograhorgen, 
				usuario.usuanombre,
				usuario.usuapriape,
				usuario.usuasegape, vistagrupprogram.prografecini,vistagrupprogram.prograhorini
				;"; 
         	
		$nuResult = pg_exec($nuConn,$sbSql);
		unset($sbSql);
		$sbRow = pg_fetch_row ($nuResult,0);
		$arreglohead= array(
				"progranumgru"=>$sbRow[0],
				"plantanombre"=>$sbRow[1],
				"tipmannombre"=>$sbRow[2],
				"priorinombre"=>$sbRow[3],
				"progranota"=>$sbRow[4],
				"prografecgen"=>$sbRow[5],
				"prograhorgen"=>$sbRow[6],
				"encargado"=>$sbRow[7].' '.$sbRow[8].' '.$sbRow[9],
				"prografecini"=>$sbRow[10],
				"prograhorini"=>$sbRow[11],
				"prografechfutur"=>$sbRow[12]
				
				);
			
		if ($nuResult){
			include_once( '../src/FunPerPriNiv/pktblprogramacion.php');
			include_once ( '../src/FunPerPriNiv/pktblequipo.php');
			include_once ( '../src/FunPerPriNiv/pktblcomponen.php');
			$sbregProgram = loadrecordgrupprogramacion($progranumgru1[0],$nuConn);//ok
            
			for($i = 0;$i < count($sbregProgram); $i++){
				if ($sbregProgram[$i]['equipocodigo'] != null){
					$nombreEq = cargaequiponombre($sbregProgram[$i]['equipocodigo'],$nuConn);
				}else{
					$nombreEq = "";
				}
				if ($sbregProgram[$i]['componcodigo'] != null){
					$nombreCom = cargacomponnombre($sbregProgram[$i]['componcodigo'],$nuConn);
				}else{
					$nombreCom = "";
				}
				$sbListaprogram[$i] = array(
						"ordtracodigo"=>$sbregProgram[$i]['ordtracodigo'],
						"equiponombre"=>$nombreEq,
						"componnombre"=>$nombreCom,
						"sistemnombre"=>$sbregProgram[$i]['sistemnombre'],
						"tiptranombre"=>$sbregProgram[$i]['tiptranombre'],
						"tareanombre"=>$sbregProgram[$i]['tareanombre'],
						"otestanombre"=>$sbregProgram[$i]['otestanombre'],
						"progratiedur"=>$sbregProgram[$i]['progratiedur'],
						"progracodigo"=>$sbregProgram[$i]['progracodigo']
						);
			}


		
			if ($nuResult){
				$sbSqls="SELECT max(usuariotareot.tareotcodigo) as tareotcodigo, usuario.usuanombre, usuario.usuapriape, usuario.usuasegape FROM usuariotareot, usuario, tareot
							WHERE tareot.progracodigo='".$sbListaprogram[0]["progracodigo"]."' AND usuariotareot.tareotcodigo=tareot.tareotcodigo AND
							usuariotareot.usutarlider='t' AND usuario.usuacodi = usuariotareot.usuacodi group by usuario.usuanombre, usuario.usuapriape, usuario.usuasegape";
					
					$nuResults = pg_exec($nuConn,$sbSqls);
					$sbRowencargado = pg_fetch_row ($nuResults,0);
								$arregloencargado[0] = array(
										"tareotcodigo"=>$sbRowencargado[0],
										"encargado"=>$sbRowencargado[1].' '.$sbRowencargado[2].' '.$sbRowencargado[3]
								);
					unset($sbSqls);
					
								
				
					$sbSql="SELECT max(usuariotareot.tareotcodigo) as tareotcodigo, usuario.usuanombre, usuario.usuapriape, usuario.usuasegape FROM usuariotareot, usuario, tareot
							WHERE tareot.progracodigo='".$sbListaprogram[0]["progracodigo"]."' AND usuariotareot.tareotcodigo=tareot.tareotcodigo AND
							usuariotareot.usutarlider='f' AND usuario.usuacodi = usuariotareot.usuacodi group by usuario.usuanombre, usuario.usuapriape, usuario.usuasegape";
					
					$nuResult = pg_exec($nuConn,$sbSql);
					unset($sbSql);
					
					if ($nuResult){
						$nuCantRow = pg_numrows($nuResult);
						if ($nuCantRow > 0){
							for($i=0;$i<$nuCantRow;$i++){
								$nuCantFields = pg_numfields($nuResult);
								$sbRow = pg_fetch_row ($nuResult,$i);
								$arregloauxusuario[$i] = array(
										"tareotcodigo"=>$sbRow[0],
										"auxusuario"=>$sbRow[1].' '.$sbRow[2].' '.$sbRow[3]
								);
							}
						}
					}	
			}
			else{
				echo "No se puede hacer consulta de personas";
			}
		}
		else{
				echo "No se puede ejecutar consulta 2";
		}
	
	}
	else{
		echo "No se puede ejecutar consulta";
	}

	
	$sbSql="SELECT herramie.herramnombre, transacherramie.transhercanti FROM (tareotherramie INNER JOIN transacherramie ON tareotherramie.transhercodigo = transacherramie.transhercodigo) INNER JOIN herramie ON transacherramie.herramcodigo = herramie.herramcodigo WHERE tareotherramie.tareotcodigo = "."'".$arregloauxusuario[0]["tareotcodigo"]."'";
	$nuResult = pg_exec($nuConn,$sbSql);

	unset($sbSql);
	if ($nuResult){   
		$k=0;
		while ($row = pg_fetch_array($nuResult)) {
	
			$arregloherr[$k]= $row["herramnombre"]." ".$row["transhercanti"];
			$k++;
		}
	}

	$sbSql="SELECT item.itemnombre, transacitem.transitecantid FROM (itemtareot INNER JOIN transacitem ON itemtareot.transitecodigo = transacitem.transitecodigo) INNER JOIN item ON transacitem.itemcodigo = item.itemcodigo WHERE itemtareot.tareotcodigo = "."'".$arregloauxusuario[0]["tareotcodigo"]."'";
	$nuResult = pg_exec($nuConn,$sbSql);

	unset($sbSql);
	if ($nuResult){ 
		$l=0;
		while ($row = pg_fetch_array($nuResult)) {
			$arregloitem[$l]= $row["itemnombre"]." ".$row["transitecantid"];
			$l++;
		}
	}

?>
<!--<SPAN id="printFrame1" style="display:none;">-->

<CENTER>
<?php 
	ob_start();
?>

</CENTER>
<?php $_SESSION['htmlreport'] = ob_get_contents(); ?>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta http-equiv="expires" content="0">
<link rel="stylesheet" type="text/css" href="temas/Noise/Style.css">
<SCRIPT LANGUAGE="JavaScript">
<!-- Begin
agree = 0;
//  End -->
</script>
<script language="JavaScript" src="motofech.js"></script></head>
<body bgcolor="FFFFFF" text="#000000" onLoad="window.print()">
<form name="form1" method="post"  enctype="multipart/form-data">
  
<table border="0" align="center" cellpadding="1" cellspacing="2" >
  <tr><td width="708" class="NoiseErrorDataTD">&nbsp;</td></tr>
  <tr><th scope="col"><img src="../img/adsumcuasipequeno.jpg" alt="Adsum" align="left"></th></tr>
  <tr>
    <th scope="col">
      <TABLE border="0" width="100%" align="center">
        <tr><td colspan="4" align="center"><B><? echo $departamentos[0];?></B></td></tr>
        <tr><td colspan="4"><hr></td></tr>
        <tr bgcolor="#5961A0"><td colspan="4"><FONT face="Verdana" color="White">Programacion</FONT></td></tr>
        <tr>
		  <td class="NoiseFieldCaptionTD" ><font color="White"><strong>Programaci&oacute;n No.</strong></font></td>
  		  <td class="NoiseFieldCaptionTD"><font color="White"><strong>&nbsp;
  		  <?php if ($arreglohead){echo $arreglohead['progranumgru'];}else {echo "No hay datos";}?>
  		  </strong></font></td>
  		  <td colspan="4"><div align="right">Fecha:&nbsp;&nbsp;<?php if ($arreglohead){ echo $arreglohead['prografecgen']."&nbsp;".$arreglohead['prograhorgen'];}else {echo "No hay datos";}?>
  		  </div></td>
  		 
  		</tr>
 		<tr>
 			<td class="NoiseFooterTD">Planta</td>
 			<TD colspan="5"><?php if ($arreglohead){ echo $arreglohead['plantanombre'];}else {echo "No hay datos";}?>&nbsp;</TD>
		</tr>
		<tr>
		  <td colspan="6"><hr noshade></td>
		</tr>					

		<tr class="NoiseErrorDataTD">
		  <td class="NoiseFooterTD" colspan="5" align="center"><strong>Lista de OT's</strong></td>
		</tr>
		<tr>		  
			<td colspan="6">
				<table width="100%" border="0" cellspacing="2" cellpadding="0" align="center">
		  			<tr class="NoiseFooterTD">
					  <td class="estilo1">No. OT</td>
		  			  <td class="estilo1">Sistema</td>
		  			  <td class="estilo1">Equipo</td>
		  			  <td class="estilo1">Componente</td>
		  			  <td class="estilo1">Trabajo</td>
		  			  <td class="estilo1">Tarea</td>
		  			  <td class="estilo1">Dur. hr</td>
		  			  <td class="estilo1">Estado</td>
					</tr>
			<?php
				for($i=0;$i<count($sbListaprogram);$i++){
					echo '<tr class="NoiseDataTD">';
					echo '<td class="estilo1">'.$sbListaprogram[$i][ordtracodigo].'</td>';
					echo '<td class="estilo1">'.$sbListaprogram[$i][sistemnombre].'</td>';
					echo '<td class="estilo1">'.$sbListaprogram[$i][equiponombre].'</td>';
					echo '<td class="estilo1">'.$sbListaprogram[$i][componnombre].'</td>';
					echo '<td class="estilo1">'.$sbListaprogram[$i][tiptranombre].'</td>';
					echo '<td class="estilo1">'.$sbListaprogram[$i][tareanombre].'</td>';
					echo '<td class="estilo1">'.$sbListaprogram[$i][progratiedur].'</td>';
					echo '<td class="estilo1">'.$sbListaprogram[$i][otestanombre].'</td>';
					echo '</tr>';
				}
			?>
				</table>
			</td>
		</tr>		
		<tr>
			<td colspan="6"><hr noshade></td>
		</tr>	

 		<tr>
 		  <td width="20%" class="NoiseFooterTD">Tipo de mantenimiento</td>
 		  <td width="20%"><?php if ($arreglohead){ echo $arreglohead['tipmannombre'];}else {echo "No hay datos";}?></td>
		  <td width="20%" class="NoiseFooterTD">Prioridad</td>
		  <td width="20%"><?php if ($arreglohead){ echo $arreglohead['priorinombre'];}else {echo "No hay datos";}?></TD>
		</tr>
  		<tr>
		  <td width="20%" class="NoiseFooterTD">Fecha de inicio</td>
		  <td><?php if ($arreglohead){ echo $arreglohead['prografecini']."&nbsp;".$arreglohead['prograhorini'];}else {echo "No hay datos";}?></TD>
		   <td colspan="3"><B>Fecha de generacion de ot</B>&nbsp;&nbsp;&nbsp;<?php if ($arreglohead){ echo $arreglohead['prografechfutur']."&nbsp;";}?></TD>
	    </tr>
	    <tr>
	    	<td>&nbsp;</td>
	    	<td><span class="style1">aaaa-mm-dd-hh:mm</span></td>
	    </tr>
		<tr>
		  <td colspan="6"><hr noshade></td>
		</tr>
  </table></td>
<tr>
  <td><table width="97%" border="0" cellspacing="1" cellpadding="0" align="center">
    <tr class="NoiseErrorDataTD">
 	  <td class="NoiseFooterTD"><strong>Encargado</strong></td>
 	  <td width="36%" class="NoiseFooterTD">&nbsp;</td>
 	  <td colspan="3">&nbsp;<?php  if ($arregloencargado){ echo $arregloencargado[0]["encargado"];}else {echo "No hay datos";}?></td>
 	</tr>
    <tr>
      <td colspan="2" class="NoiseFooterTD">Auxiliares de mantenimiento </td>
        <td><?php 
			if ($arregloauxusuario){
				for($i=0;$i<count($arregloauxusuario);$i++){
					echo $arregloauxusuario[$i]['auxusuario']."<br>";
				}
			}
			?></td>
          <!-- </strong></TD>-->
      
      <td width="10%">&nbsp;</td>
   </tr>
  	<tr>
	  <td colspan="8"><hr noshade></td>
	</tr>

	<tr>
 	  <td width="13%" class="NoiseFooterTD">Descripci&oacute;n del trabajo a realizar</td>
  	  <td height="36" colspan="4">
  	  <?php 
  	  	if($arreglohead){
			$datosdetarea = explode(".", $arreglohead['progranota']);
			$cantdatos = count($datosdetarea);
			for ($j=0; $j < $cantdatos; $j++){
				echo "[&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;]".$datosdetarea[$j]."<br>";
			}

  		}else{ echo "No hay datos";} 
  	  ?></td>
  	</tr>
  <tr>
	  <td class="NoiseFooterTD">Comentarios de seguridad</td>
	  <td>&nbsp;</td>
	  <td colspan="3" class="NoiseFooterTD">Utilizar Todos los elementos de seguridad como casco,guantes,gafas,botas con puntera,cinturon ergonomico,protectores auditivos</td>
	</tr>
  
  
	<tr>
	  <td class="NoiseFooterTD">Herramientas</td>
	  <td>&nbsp;</td>
	  <td colspan="3" class="NoiseFooterTD">Item</td>
	</tr>
	<tr>
	  <td colspan="2" rowspan="2">
	  <?php
	  	if ($arregloherr){
	  		for ($j=0; $j < count($arregloherr); $j++){
				echo $arregloherr[$j]."<br>";
			}
		}else{ echo "No hay datos";} 
	  ?></td>
	  
	  <td colspan="3">
	  <?php
	    if ($arregloitem){
	  		for ($j=0; $j < count($arregloitem); $j++){
				echo $arregloitem[$j]."<br>";
			}
		}else{ echo "No hay datos";} 
      ?>
      </td>
	</tr>
  </TABLE></th>
    </tr>
  </table>
  <CENTER>
 <INPUT type="image" name="aceptar"  src="../img/aceptar.gif" onClick="form1.action='main.php?codigo=';"  width="86" height="18" alt="Aceptar" border=0>
</CENTER>
</FORM>
</body>
</html>
<!-- Hidden SPAN -->
<SPAN id="printFrame" style="display:none;">
<CENTER>
<?php 
ob_start();
?>

<table width="90%" border="0" cellspacing="0" cellpadding="1" align="center" class="NoiseFormTABLE" >
	<tr>
 		<td bgcolor="#5961A0" colspan="8"><span class="style5"><FONT face="Verdana" color="White">Programaci&oacute;n Equipos</FONT></span></td>
	</tr>
	<tr bgcolor="#F2F3F8">
		<td colspan="3"><B>Fecha de inicio</B>&nbsp;&nbsp;&nbsp;<?php if ($arreglohead){ echo $arreglohead['prografecini']."&nbsp;".$arreglohead['prograhorini'];}?></TD>
		<td colspan="3"><B>Fecha de generacion de ot</B>&nbsp;&nbsp;&nbsp;<?php if ($arreglohead){ echo $arreglohead['prografechfutur']."&nbsp;".$arreglohead['prografechfutur'];}?></TD>
		<!--<td colspan="3"><B>Fecha:</B>&nbsp;<?php echo $annogen; ?>-<?php echo $mesgen; ?>-<?php echo $diagen; ?></td>-->
  		<td colspan="2"><B>Programaci&oacute;n No.:</B>&nbsp;<?php echo $arreglohead['progranumgru']; ?></td>
	    <!--<td width="12%"><?php echo $sbreg[progranumgru]; ?></td>-->
	    <td width="9%"><b>Planta</b></td>
	    <td colspan="2"><?php if ($arreglohead){ echo $arreglohead['plantanombre'];}?></TD>
    </tr>
	<tr>
 		<td colspan="8">&nbsp;</td>
	</tr>
	
	  <tr>	
			<td bgcolor="#BBCCEC" colspan="8" align="center"><B>Listado OT's </B></td>
	  </tr>
	  <tr bgcolor="#5961A0"><FONT color="White">
		  <td width="11%">No. OT</td>
		  <td width="11%">Sistema</td>
		  <td >Equipo</td>
		  <td >Componente</td>
		  <td >Trabajo</td>
		  <td >Tarea</td>
		  <td >Dur. hr</td>
		  <td width="10%">Estado</td>
		  </FONT>
  </tr>
		<?php
			for($i=0;$i<count($sbListaprogram);$i++){
				echo '<tr class="NoiseDataTD">';
				echo '<td class="estilo1">'.$sbListaprogram[$i][ordtracodigo].'</td>';
				echo '<td class="estilo1">'.$sbListaprogram[$i][sistemnombre].'</td>';
				echo '<td class="estilo1">'.$sbListaprogram[$i][equiponombre].'</td>';
				echo '<td class="estilo1">'.$sbListaprogram[$i][componnombre].'</td>';
				echo '<td class="estilo1">'.$sbListaprogram[$i][tiptranombre].'</td>';
				echo '<td class="estilo1">'.$sbListaprogram[$i][tareanombre].'</td>';
				echo '<td class="estilo1">'.$sbListaprogram[$i][progratiedur].'</td>';
				echo '<td class="estilo1">'.$sbListaprogram[$i][otestanombre].'</td>';
				echo '</tr>';
			}
		?>
				
	<tr ><td colspan="8" bgcolor="White" ><font color="White">--></font></td></tr>
	<tr bgcolor="#F2F3F8">		  
	    <td colspan="3"><B>Tipo de matenimiento:</B>&nbsp;<?php if ($arreglohead){ echo $arreglohead['tipmannombre'];}?></td>
	    <td colspan="2"><B>Prioridad:</B>&nbsp;<?php if ($arreglohead){ echo $arreglohead['priorinombre'];}?></td>
	    <td colspan="2">&nbsp;</td>
  </tr>
	
	    <tr>
	    	<td bgcolor="#BBCCEC" colspan="8"><B>Empleados involucrados</B></td>
	    </tr>
	    <tr bgcolor="#EBF0FA">
	 		<td colspan="3"><B>Encargado</B></td>
	 		<td colspan="4"><B>Nombre:</B>&nbsp;<?php  if ($arregloencargado){ echo $arregloencargado[0]["encargado"];}else {echo "No hay datos";}?></td></td>
		</tr>
        	<?php 
				if ($arregloauxusuario){
					for($i=0;$i<count($arregloauxusuario);$i++){
						echo '<tr bgcolor="#EBF0FA">';
						if ($i == 0){
							echo '<td colspan="3" rowspan="'.count($arregloauxusuario).'" class="NoiseFooterTD">Auxiliares de mantenimiento </td>';				
						}
						
						echo '<td colspan="4">'.$arregloauxusuario[$i]['auxusuario']."</td>";
						echo '</tr>';
					}
				}
			?>
    <tr>
 		<td bgcolor="#D9D9F3" colspan="8"><B>Trabajo a realizar</B></td>
	</tr>
	<tr>
 		<td colspan="8"><B>Descripci&oacute;n del trabajo a realizar:</B></td>
	</tr> 
	<tr>
 		<td colspan="8">
 		<?php 
	 	  	if($arreglohead){
				$datosdetarea = explode(".", $arreglohead['progranota']);
				$cantdatos = count($datosdetarea);
				for ($j=0; $j < $cantdatos; $j++){
					echo "[&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;]".$datosdetarea[$j]."<br>";
				}
	
	  		}
 		?></td>
	</tr>
	<tr>
	  <td class="NoiseFooterTD">Herramientas</td>
	  <td>&nbsp;</td>
	  <td colspan="3" class="NoiseFooterTD">Item</td>
	</tr>
	<tr>
	  <td class="NoiseFooterTD">Comentarios de seguridad</td>
	  <td>&nbsp;</td>
	  <td colspan="8" class="NoiseFooterTD">Utilizar Todos los elementos de seguridad como casco,guantes,gafas,botas con puntera,cinturon ergonomico,protectores auditivos</td>
	</tr>
	<tr>
	  <td colspan="2" rowspan="2">
	  <?php
	  	if ($arregloherr){
	  		for ($j=0; $j < count($arregloherr); $j++){
				echo $arregloherr[$j]."<br>";
			}
		}else{ echo "No hay datos";} 
	  ?></td>
	  
	  <td colspan="3">
	  <?php
	    if ($arregloitem){
	  		for ($j=0; $j < count($arregloitem); $j++){
				echo $arregloitem[$j]."<br>";
			}
		}else{ echo "No hay datos";} 
      ?></td>
	</tr>
		
<!-- Herramientas y/o Items -->
</table>
</CENTER>
<?php $_SESSION['htmlreport'] = ob_get_contents(); ?>
</SPAN>
<!-- End of hidden SPAN -->
</body>
</html>
