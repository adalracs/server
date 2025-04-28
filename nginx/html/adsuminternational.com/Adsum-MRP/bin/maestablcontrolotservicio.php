<?php
ob_start(); 
	include('../src/FunPerPriNiv/pktblrequeritiempo.php');
	include('../src/FunPerPriNiv/pktblvistaotservicio.php');
	include('../src/FunPerPriNiv/pktblservicio.php');
	include('../src/FunPerPriNiv/pktbldepartam.php');
	include('../src/FunPerPriNiv/pktbldepartamento.php');
	include ( '../src/FunGen/sesion/fncvalses.php'); 
	
ob_end_flush(); 
?>
<html>
	<head>
		<title>Agendamiento - Despacho</title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		<meta http-equiv="expires" content="0">
		<link rel="stylesheet" type="text/css" href = "temas/Noise/Style.css">
		<link href="temas/Noise/semaforo.css" rel="stylesheet" type="text/css" />
		<script language="JavaScript" src="motofech.js"></script>
		<SCRIPT language=JavaScript src="../src/FunGen/jsrsClient.js"		type="text/javascript" ></SCRIPT>
		<script language=JavaScript src="../src/FunGen/cargarSubsegmentos.js" type="text/javascript" ></script>
		<SCRIPT LANGUAGE="JavaScript">
		function load_detalles(){
			if(form1.estado.value != ""){
				document.all("lista_reqtiempo").src="detallarcontrolotservicioest.php?estado="+ form1.estado.value + "&departcodigo="+ form1.departamento.value + "&servicicodigo=" + form1.servicio.value;	
			}else{
				document.all("lista_reqtiempo").src="detallarcontrolotservicio.php?departcodigo="+ form1.departamento.value + "&servicicodigo=" + form1.servicio.value;	
			}
		}

</script>
		
		
		
	</head>
<?php if(!$codigo){ echo "<!--";} ?>
	<body bgcolor="FFFFFF" text="#000000">
		<form name="form1" method="POST"  enctype="multipart/form-data">
			<p><font class="NoiseFormHeaderFont">Control</font><br><br></p>
  			<table width="95%" border="0" align="center" cellpadding="2" cellspacing="0" class="NoiseFormTABLE">
				<tr><td colspan="3" class="NoiseColumnTD">&nbsp;</td></tr>
				<tr><td colspan="3" class="NoiseFieldCaptionTD"><span class="style5"><font color="FFFFFF">&nbsp;Control de Estado de OS</font></span></td></tr>
				<tr>
					<td colspan="3">
						<table width="100%" border="0" cellspacing="2" cellpadding="3" align="center">
					 		<tr>
					 			<td>
					 				<table border="0" cellspacing="1" cellpadding="0" align="center" width="100%" >
										<tr>
					<td colspan="6"><table border="0" cellspacing="1" cellpadding="0" align="center" width="100%">
						<tr>
						  <td class="NoiseColumnTD">Departamento</td>
						  <td width="19%" class="NoiseColumnTD">Servicio</td>
					      <td width="53%" class="NoiseColumnTD">Estado</td>
					  <tr>
						  <td class="NoiseDataTD" width="28%"><select name="departamento" onChange="load_detalles();">
			  				  <?php
									$departamento1 = $departcodigo;
									echo '<option value = "">TODOS</option>';
					
									$idcon = fncconn();
									$result = fullscandepartam($idcon);
													
									if($result > 0)
									 $numReg = fncnumreg($result);
																
									 if($numReg){
									   for ($i=0;$i<$numReg;$i++){
									   $arr=fncfetch($result,$i);
							
									   if($arr[departcodigo] != 0){
								    	echo '<option value ="'.$arr[departcodigo].'" ';
								    										
								    	if($accionfiltrarotserv){
								    	  if($departamento1 == $arr[departcodigo])
								    		echo "selected";
								    	  }	
								    	  echo ">".$arr[departnombre]."</option>"."\n";
										}
									   }
									 }
								?>
				            </select></td>
						  <td class="NoiseDataTD"><select name="servicio" onChange="load_detalles();">
			  				  <?php
									$servicio1 = $servicio;
									echo '<option value = "">TODOS</option>';
					
									$idcon = fncconn();
									$result = fullscanservicio($idcon);
													
									if($result > 0)
										$numReg = fncnumreg($result);
													
									if($numReg){
										for ($i=0;$i<$numReg;$i++){
											$arr=fncfetch($result,$i);
		
											if($arr[servicicodigo] != 0){
					    						echo '<option value ="'.$arr[servicicodigo].'" ';
					    									
					    						if($accionfiltrarotserv){
					    							if($servicio1 == $arr[servicicodigo])
					    								echo "selected";
					    						}	
					    						echo ">".$arr[servicinombre]."</option>"."\n";
											}
										}
									}
								?>
					    </select></td>
					      <td class="NoiseDataTD"><select name="estado" onChange="load_detalles();">
					  	<option value="" <?php if(!$estado){echo 'selected';} ?>>TODOS</option>
					  	<option id ="verde" value="1" <?php if($estado == 1){echo 'selected';} ?>>Verde</option>
					  	<option id = "naranja" value="2" <?php if($estado == 2){echo 'selected';} ?>>Naranja</option>
					 	<option id = "rojo" value="3" <?php if($estado == 3){echo 'selected';} ?>>Rojo</option>
					 	<option id = "negro" value="4" <?php if($estado == 4){echo 'selected';} ?>>Negro</option>
                          				</select></td>
					  </table></td>
				</tr>
									</table>								</td>
							</tr>
							<tr><td class="NoiseFooterTD">&nbsp;</td></tr>
			  				<tr>
                        						<td height="213" align="center">
                        							<table width="100%" height="271" border="1" align="center" cellpadding="0" cellspacing="1" bgcolor="White">                            
                            								<tr>
                           									  <td height="190" colspan="5" bgcolor="White"><iframe src="detallarcontrolotservicio.php?departcodigo=<?php echo $departamento;  ?>&servicicodigo=<?php echo $servicio;  ?>"  frameborder="0" name="lista_reqtiempo"  height="300" width="100%" align="absmiddle"></iframe></td>
                            								</tr>
                       							</table>       						  </td>
			  		  		</tr>
													 	
							
							

		  		  		</table>
			  		</td>
  		  		</tr>
				<tr><td colspan="3" class="NoiseColumnTD">&nbsp;</td></tr>
  	  		</table>
		
			<label></label>
			<input type="hidden" name="accionnuevorequerimiento">
			<input type="hidden" name="accionborrarequerimiento">
			<input type="hidden" name="flagnuevorequeritiempo">
			<input type="hidden" name="reqtiecodigo">
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>">	
		</form>
	</body>
<?php if($campnomb){echo '<font face = "Verdana" >Corregir los capos marcados con *</font>';} ?> 
<?php if(!$codigo){ echo " -->"; } ?>
</html>