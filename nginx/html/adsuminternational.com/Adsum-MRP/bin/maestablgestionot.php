<?php
ob_start();
$indice=0;

include ( '../src/FunGen/sesion/fncvalses.php');
include ( '../src/FunPerPriNiv/pktblplanta.php');
include ( '../src/FunPerPriNiv/pktblsistema.php');

//include ( '../src/FunGen/fncnumprox.php');
//include ( '../src/FunGen/fncnumact.php');
include ( '../src/FunPerPriNiv/pktbltiposistema.php');
include ( '../src/FunGen/sesion/fncvarsesion.php');

if($accionnuevoprogramacion){
	if($arr_detalle){
		$arreglodetalle = split(",", $arr_detalle);
		$cantot = count($arreglodetalle);
		  	
		while( $cantot > 0 ){
			$arr_regot = $arreglodetalle[($cantot - 1)]; 
			include ( 'grabagestionotprograma.php');
	
			$cantot--;
		}
	}else{
		echo '<script language="javascript">';
		echo '<!--//'."\n";
		echo 'alert(\'Debe seleccionar al menos una orden para reportar\');'."\n";

		echo '//-->'."\n";
		echo '</script>';		
	}
}
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
<SCRIPT language=JavaScript src="../src/FunGen/jsrsClient.js"		type="text/javascript" ></SCRIPT>
<script language=JavaScript src="../src/FunGen/cargarSistemaprog.js" type="text/javascript" ></script>
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
function loadlista(){
	document.all("detalleprograma").src="detallaotprogramacion.php?sistemcodigo="+ document.form1.sistemcodigo.value + "&estadoprogra=" + document.form1.estadoprogra.value;
}
</script>
<style type="text/css">
<!--.Estilo1 {color: #FFFFFF}-->
</style>
</head>
<?php if(!$codigo){echo "<!--";} ?>
<body bgcolor="FFFFFF" text="#000000">
	<form name="form1" method="post"  enctype="multipart/form-data">
      		<p><font class="NoiseFormHeaderFont">Listado de OT Programadas</font></p>
      		<table width="100%" align="center" cellpadding="1" cellspacing="0" class="NoiseFormTABLE" cols="6">
        			<tr><td class="NoiseErrorDataTD" colspan="4">&nbsp;</td></tr>
	    		<tr><td class="NoiseFieldCaptionTD" colspan="4">&nbsp;</td></tr>
	   		<!--Fecha Hora-->
	 		<tr> 
   	  	  		<td bgcolor="#f0f6ff" colspan="4">
   	  	    		&nbsp;Fecha:&nbsp;<?php $prografecgen=date("Y-m-d");echo $prografecgen; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Hora:&nbsp;<?php $prograhorgen= date("H:i"); echo $prograhorgen; ?>   	  	  </td>
    			</tr>
    			<!--Planta
    			<tr>
    				<td>&nbsp;<?php if($campnomb["plantacodigo"] == 1)echo "*";?>Planta </td>
    	  			<td valign="top"><?php if($campnomb["sistemcodigo"] == 1)echo "*";?>Equipo</td>
    	  			<td width="65%">&nbsp;</td>
    	  			<td colspan="2">&nbsp;</td>
  	  		</tr>
    			<tr>
    	  			<td width="14%">&nbsp;<select name="plantacodigo" onChange="borrar();" onclick="cargarSistemasprog(this.value);">
    	      				<?php
    	  	    				if (!$flagnuevoprogramacion)
    	  		  				echo '<option value="">Seleccione';
        	    					elseif($plantacodigo){
                  						echo '<option value = "'.$plantacodigo.'">';
                  						$idcon	= fncconn();
                  						$arrplanta = loadrecordplanta($plantacodigo,$idcon);
                  						echo $arrplanta[plantanombre];
                  						fncclose($idcon);
                					}else{
               	  					echo '<option value = "">Seleccione';
                					}
        	    					echo '</option>';
        
						include ('../src/FunGen/floadplanta.php');
						$idcon = fncconn();
						floadplanta($sbreg[plantacodigo],$idcon);
						fncclose($idcon);
		      			?>
	        			</select></td>
	      			<!--Sistema//Equipo
	      			<td valign="top" width="15%"><select name="sistemcodigo" onchange="loadlista();">
            				<?php 
    		  				if (!$flagnuevoprogramacion)
		  		    			echo '<option value="">Seleccione';
    		  				elseif($sistemcodigo){
				  			echo '<option value = "'.$sistemcodigo.'">';
				      			$idcon	= fncconn();
      							$arrsistema = loadrecordsistema($sistemcodigo,$idcon);
      							$arr2 = loadrecordtiposistema($arrsistema[tipsiscodigo],$conn);
      			
      							echo $arrsistema[sistemnombre]." / ".$arr2[tipsisnombre]."</OPTION>";
      							$codigosistema= $arrsistema[sistemcodigo];
      							$nombresistema= $arrsistema[sistemnombre];
    
      							include ('../src/FunGen/floadsistemaot.php');
      							floadsistemaot($plantacodigo,$idcon);
      							fncclose($idcon);
   			  			}
			  			else
							echo "<option value=''>Seleccione</option>";
			  
			  			echo '</option>';
  					?>
          				</select></td>
    	  			
          				<td>&nbsp;Estado de la tarea&nbsp;&nbsp;<select name="estadoprogra" id="estadoprogra" onchange="loadlista();"><option value="1" selected>Activo</option><option value="0">Inactivo</option></select></td>     
  		  		<td width="6%" colspan="2">&nbsp;</td>
  		  	</tr>-->

			<tr>
		  		<td colspan="4">
		    			<table width="100%" border="0" cellspacing="2" cellpadding="1" align="center">
					<!--Detalle de las OT agregadas a la Programación-->
      		  				<tr>	
	  	  					<td colspan="6" align="center" bgcolor="#f0f6ff">
	  	  		  				<table width="100%" border="1" cellspacing="1" cellpadding="3" align="center" bgcolor="#f0f6ff">
	  	  							<tr>
					  					<td bgcolor="White"><iframe src="detallagestionotprogramacion.php?arr_data=<?php echo $arr_detalle;?>" frameborder="0" name="detalleprograma" frameborder="0"  height="250" width="90%" align="absmiddle"></iframe></td>
	  	  							</tr>
				  				</table>
				  			</td>
			  			</tr>
					<!--Consola para Agregar/Eliminar al detalle de las OT programadas-->
    		  
          	  					<tr>
		  					<td colspan="6" bgcolor="#f0f6ff">&nbsp;&nbsp;<input type="submit" name="REP" value="Reportar OT" onClick="form1.arr_detalle.value = window.frames['detalleprograma'].document.form2.arr_coditem.value; form1.accionnuevoprogramacion.value=1;" width="86" height="18" alt="Aceptar" border=0></td> 
		  				</tr>
					</table>		  
				</td>
			</tr>
			<tr>
		  		<td colspan="4"><div align="center">
  					<input type="image" name="aceptar"  src="../img/aceptar.gif" onClick="form1.action='main.php?codigo=';"  width="86" height="18" alt="Aceptar" border=0>  			
		  		</div></td>
			</tr>
			<tr><td class="NoiseErrorDataTD" colspan="4">&nbsp;</td></tr>  
	  	</table>
	  
	  <!--<INPUT TYPE="HIDDEN" NAME="selec" value= "$arreglo_equi" >-->
	  <input type="hidden" name="accionnuevoprogramacion">

	  <input type="hidden" name="progranumgru" value="<?php echo $progranumgru;  ?>">

	  <input type="hidden" name="indice" value="<?php echo $indice; ?>">
	  <input type="hidden" name="arr_detalle" value="<?php echo $arr_detalle; ?>">
	  <input type="hidden" name="arreglo_del" value="<?php echo $arreglo_del; ?>">
	  
	  <input type="hidden" name="codigo" value="<?php echo $codigo; ?>">
	  
	  
	</form>
  </body>
  <?php
	if(!$codigo){ echo " -->"; }
  ?>
</html>