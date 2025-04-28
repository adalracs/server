<?php
ob_start();

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
include ( '../src/FunPerPriNiv/pktbltransaction.php');
include ( '../src/FunGen/fncstrfecha.php');
include ( '../src/FunPerSecNiv/fncsqlrun.php');

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
	
	if(!$flageditarprogramacion)
	{
		if (!$radiobutton)
			include( '../src/FunGen/fnccontfron.php');
		else
			include('detallaprogramacion.php');
		
		include_once ('../src/FunPerPriNiv/pktblprogramacion.php');
		
	}
	
ob_end_flush();
?>
<html>
	<head>
		<title>Editar registro de programacion</title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		<meta http-equiv="expires" content="0">
		<?php include('../def/jquery.library_maestro.php');?>
		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.function_comun.js"></script>
		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.function_ot.js"></script>
		<script type="text/javascript">
			$(function(){
				/**
				 * Window Show Edit Program
				 */
				$("#windoweditprogram").dialog({
					autoOpen: false,
					width: 670,
					height: 330,
					modal: true,
					buttons: {
						"Cancelar": function() { 
							$(this).dialog("close"); 
						},
						"Grabar": function() {
							var arrRutina = document.getElementById('progracodigo').value + '||' + document.getElementById('tipcomcodigo').value + '||' +
											document.getElementById('prioricodigo').value + '||' + document.getElementById('tareacodigo').value + '||' +
											document.getElementById('otestacodigo').value + '||' + document.getElementById('progratiedur').value + '||' +
											document.getElementById('optiedur').value + '||' + document.getElementById('prograacti').value + '||' +
											document.getElementById('progranota').value;
							accionSaveRutina(arrRutina, document.getElementById('tiptracodigo').value, document.getElementById('tipmancodigo').value, document.getElementById('equipocodigo').value);
							$(this).dialog("close");
						}
					}
				});


			});

			function showWindow(idrutina)
			{
				/**
				var arrRutina: 	posicion 0 => progracodigo
								posicion 1 => componcodigo
								posicion 2 => prioricodigo
								posicion 3 => tareacodigo
								posicion 4 => otestacodigo
								posicion 5 => progratiedur
								posicion 6 => optiedur
								posicion 7 => prograacti
								posicion 8 => progranota
				*/
				var arrRutina = document.getElementById('arrrutina' + idrutina).value.split('||');

				selectObjList('tipcomcodigo', arrRutina[1]);
				selectObjList('prioricodigo', arrRutina[2]);
				selectObjList('tareacodigo', arrRutina[3]);
				selectObjList('otestacodigo', arrRutina[4]);
				selectObjList('optiedur', arrRutina[6]);
				selectObjList('prograacti', arrRutina[7]);
				
				document.getElementById('progracodigo').value = arrRutina[0];
				document.getElementById('progranota').value = arrRutina[8];
				document.getElementById('progratiedur').value = arrRutina[5];
				$('#windoweditprogram').dialog('open');
			}
			
		</script>
		
		<style type="text/css">
			select,	 #equiponombre {font-size: 12px;}
			.estilo1 {font-size: 10px; font-family : Arial } 
			.estilo2 {font-size: 10px; font-family : Arial; color: red; } 
			.dont-line-1 {border-top:0; border-bottom:0; border-left:0;}
			.dont-line-2 {border:0;}
		</style>
	</head>
<?php if(!$codigo){echo "<!--";} ?>
	<body bgcolor="FFFFFF" text="#000000">
    	<form name="form1" method="post"  enctype="multipart/form-data">
      		<p><font class="NoiseFormHeaderFont">Programaci&oacute;n</font></p>
      		<table width="900" align="center" cellpadding="1" cellspacing="0" class="ui-widget-content">
        		<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr>
	    		<tr><td class="ui-widget-header"><span class="style5"><font color="FFFFFF">&nbsp;Rutinas de mantenimiento</font></span></td></tr>
	    		<tr>
					<td>
						<table width="99%" border="0" cellspacing="0" cellpadding="0" align="center">
							<tr><td class="ui-state-default">&nbsp;<small><?php echo strfecha(date("Y-m-d"))  ?></small></td></tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>
       					<table width="99%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
       						<tr>
          						<td width="20%" class="NoiseFooterTD">&nbsp;Ubicaci&oacute;n</td>
          						<td width="80%" class="NoiseDataTD">&nbsp;<?php echo $rsPlanta['plantanombre'] ?></td>
          					</tr>
       						<tr>
          						<td class="NoiseFooterTD">&nbsp;Proceso</td>
          						<td class="NoiseDataTD">&nbsp;<?php echo $rsSistema['sistemnombre'] ?></td>
          					</tr>
       						<tr>
          						<td class="NoiseFooterTD">&nbsp;Equipo</td>
          						<td class="NoiseDataTD">&nbsp;<b><?php echo $rsEquipo['equiponombre'] ?></b></td>
          					</tr>
       						<tr>
          						<td class="NoiseFooterTD">&nbsp;Mantenimiento</td>
          						<td class="NoiseDataTD">&nbsp;<?php echo $tipmannombre ?></td>
          					</tr>
       						<tr>
          						<td class="NoiseFooterTD">&nbsp;Tipo trabajo</td>
          						<td class="NoiseDataTD">&nbsp;<b><?php echo $tiptranombre ?></b></td>
          					</tr>
						</table>
					</td>
				</tr>
				<tr>
	 				<td>
	 					<div id="listarutinas">
	 					<?php 
	 						$noAjax = true;
	 						include '../src/FunjQuery/jquery.visors/jquery.programacionequipos.php';
	 					?>
	 					</div>
	 				</td>
				</tr>
				<tr><td>&nbsp;</td></tr>
				<tr>
					<td class="NoiseErrorDataTD" align="center"><div class="ui-buttonset">
						<button id="cancelar">Salir</button>
					</div></td>
				</tr>
				<tr><td>&nbsp;</td></tr>
				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr>  
  			</table>
		  	<input type="hidden" name="accioneditarprogramacion">
		  	<input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>">
			<input type="hidden" name="sourceaction" value="editar">
		  	<input type="hidden" name="flageditarprogramacion" value="<?php echo $flageditarprogramacion; ?>">
		  	<input type="hidden" name="progracodigo" id="progracodigo">
		  	<input type="hidden" name="tiptracodigo" id="tiptracodigo" value="<?php echo $tiptracodigo ?>">
		  	<input type="hidden" name="tipmancodigo" id="tipmancodigo" value="<?php echo $tipmancodigo ?>">
		  	<input type="hidden" name="equipocodigo" id="equipocodigo" value="<?php echo $equipocodigo ?>">
  			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>">
		</form>
		<div id="windoweditprogram" title="Adsum Kallpa [Editar Rutina]">
			<div id="content">
				<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
					<tr>	
						<td width="15%" class="NoiseDataTD"><span id="errestado"></span>&nbsp;Estado Rutina</td>
  						<td width="85%" class="NoiseDataTD"><select name="prograacti" id="prograacti">
								<option value="1">Activa</option>
								<option value="0">Inactiva</option>
							</select>
						</td>
					</tr>
					<tr>
  						<td class="NoiseFooterTD"><span id="errcomponen"></span>&nbsp;Tipo Componente</td>
  						<td class="NoiseDataTD"><select name="tipcomcodigo" id="tipcomcodigo">
							<option value = "">-- Seleccione --</option>
            				<?php
								include ('../src/FunGen/floadtipocompon.php');
								floadtipocomponequipo($tipcomcodigo,$equipocodigo,$idcon);
							?>
          				</select></td>
					</tr>
				</table>
				<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
					<tr>
						<td width="15%" class="NoiseFooterTD"><span id="errpriorida"></span>&nbsp;Prioridad</td>
						<td width="85%" class="NoiseDataTD"><select name="prioricodigo" id="prioricodigo">
							<?php
	  							include ('../src/FunGen/floadpriorida.php');
								floadpriorida($prioricodigo, $idcon);
							?>
						</select></td>
					</tr>
					<tr>
						<td class="NoiseFooterTD"><span id="errtarea"></span>&nbsp;Tarea</td>
						<td class="NoiseDataTD"><select name="tareacodigo" id="tareacodigo">
							<?php
								include ('../src/FunGen/floadtarea.php');
								floadtarea($tareacodigo,$idcon);
							?>
          				</select></td>
          			</tr>
  					<tr><td class="ui-state-default" colspan="2"></td></tr>
					<tr><td class="NoiseFooterTD" colspan="2"><span id="errprogranota"></span>&nbsp;Descripci&oacute;n del Trabajo a Realizar</td></tr>
  					<tr><td colspan="2" class="NoiseDataTD"><textarea name="progranota" id="progranota" cols="86" rows="3" wrap="VIRTUAL"></textarea></td></tr>
				</table>
				<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
        			<tr>
						<td width="20%" class="NoiseFooterTD"><span id="errestadoot"></span>&nbsp;Estado de creaci&oacute;n OT</td>
						<td width="25%" class="NoiseDataTD"><select name="otestacodigo" id="otestacodigo">
							<?php
								include('../src/FunGen/floadotestadoot.php');
								floadotestadoot($otestacodigo,$idcon);
							?>
						</select></td>
						<td width="20%" class="NoiseFooterTD"><span id="errtiedur"></span>&nbsp;Duraci&oacute;n de la OT</td>
						<td width="25%" class="NoiseDataTD">
							<input type="text" name="progratiedur" id="progratiedur" size="10">
							<select name="optiedur" id="optiedur">
								<option value="1">hora(s).</option>
								<option value="2">minuto(s).</option>
							</select>
						</td>
					</tr>
				</table>
			</div>
		</div>
  	</body>
  <?php
	if(!$codigo){ echo " -->"; }
  ?>
</html>
