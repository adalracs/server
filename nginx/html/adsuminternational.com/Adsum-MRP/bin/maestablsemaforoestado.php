<?php
ob_start(); 
	include('../src/FunPerPriNiv/pktblsemaforoestado.php');
	include ( '../src/FunGen/sesion/fncvalses.php'); 
	
	if($accionnuevosemaforoestado){ 
		include ( 'editasemaforoestado.php'); 
	} 
	
	
ob_end_flush(); 
  /* if(!$flageditartipodespacho){ 
		include ( '../src/FunGen/sesion/fnccarga.php'); 
		$nombtabl="semaforoestado";
		$radiobutton="1|n";
		$sbreg = fnccarga($nombtabl,$radiobutton);     
		if (!$sbreg){ 
			include( '../src/FunGen/fnccontfron.php'); 
		} 
	}*/
   	$idcnx = fncconn();
   	$sbreg = loadrecordsemaforoestado(1,$idcnx);
?>
<html>
	<head>
		<title>Semaforo</title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		<meta http-equiv="expires" content="0">
		<link rel="stylesheet" type="text/css" href = "temas/Noise/Style.css">
		<link href="temas/Noise/semaforo.css" rel="stylesheet" type="text/css" />
		<script language="JavaScript" src="motofech.js"></script>
		<SCRIPT language=JavaScript src="../src/FunGen/jsrsClient.js"		type="text/javascript" ></SCRIPT>
		<script language=JavaScript src="../src/FunGen/cargarSubsegmentos.js" type="text/javascript" ></script>
		<script language="JavaScript">
			function revise(index_i){
				if(index_i == 1){
					if (form1.semestverde.value >=  form1.semestnaranj.value){
						alert('El valor del estado verde debe ser menor al estado rojo');
					}
				}
				if(index_i == 2){
					if (form1.semestnaranj.value >=  form1.semestrojo.value){
						alert('El valor del estado naranja debe ser menor al estado rojo');
					}
					else if (form1.semestnaranj.value <  form1.semestverde.value){
						alert('El valor del estado naranja debe ser mayor al estado verde');
					}
				}
				if(index_i == 3){		
					if (form1.semestrojo.value >=  form1.semestnegro.value){
						alert('El valor del estado rojo debe ser menor al estado negro');
					}
					else if (form1.semestrojo.value <  form1.semestnaranj.value){
						alert('El valor del estado rojo debe ser mayor al estado naranja');
					}
				}
				if(index_i == 4){		
					if (form1.semestnegro.value <  form1.semestrojo.value){
						alert('El valor del estado negro debe ser mayor al estado rojo');
					}
				}
			}
			function grabar(){
				form1.accionnuevosemaforoestado.value =1;
				document.form1.action = 'maestablsemaforoestado.php';
				document.form1.submit();
			}
		</script>
		
		
	</head>
<?php if(!$codigo){ echo "<!--";} ?>
	<body bgcolor="FFFFFF" text="#000000">
		<form name="form1" method="POST"  enctype="multipart/form-data">
			<p><font class="NoiseFormHeaderFont">Semaforo</font><br><br></p>
  			<table width="40%" border="0" align="center" cellpadding="2" cellspacing="0" class="NoiseFormTABLE">
				<tr><td colspan="3" class="NoiseColumnTD">&nbsp;</td></tr>
				<tr>
				  <td colspan="3" class="NoiseFieldCaptionTD"><span class="style5"><font color="FFFFFF">Editar estados </font></span></td>
				</tr>
				<tr>
					<td colspan="3">
						<table width="90%" border="0" cellspacing="2" cellpadding="3" align="center">
					 		
							<tr>
							  <td colspan="5" class="NoiseFooterTD">Estados </td>
							</tr>
							
 							<tr> 
 								<td width="41%" class="NoiseDataTD"><?php if($campnomb["semestverde"] == 1){ echo "*";} ?>&nbsp;&nbsp;Verde</td> 
 								<td width="59%"><input name="semestverde" type="text" id="verde" onChange="revise(1);" value="<?php if(!$flageditarsemaforoestado){ echo $sbreg[semestverde];}else{ echo $semestverde; }?>" size="10">
 								%</td> 
 							</tr> 
 							<tr> 
 								<td width="41%" class="NoiseDataTD"><?php if($campnomb["semestnaranj"] == 1){ echo "*";} ?>&nbsp;&nbsp;Naranja</td> 
 								<td width="59%"><input name="semestnaranj" type="text" id="naranja" onChange="revise(2);" value="<?php if(!$flageditarsemaforoestado){ echo $sbreg[semestnaranj];}else{ echo $semestnaranj; }?>" size="10">
 								%</td> 
 							</tr> 
 							 <tr> 
 								<td width="41%" class="NoiseDataTD"><?php if($campnomb["semestrojo"] == 1){ echo "*";} ?> &nbsp;&nbsp;Rojo</td> 
 								<td width="59%"><input name="semestrojo" type="text" id="rojo" onChange="revise(3);"	value="<?php if(!$flageditarsemaforoestado){ echo $sbreg[semestrojo];}else{ echo $semestrojo; }?>" size="10">
 								%</td> 
 							</tr> 
 							<tr> 
 								<td width="41%" class="NoiseDataTD"><?php if($campnomb["semestnegro"] == 1){ echo "*";} ?>&nbsp;&nbsp;Negro</td> 
 								<td width="59%"><input name="semestnegro" type="text" id="negro" onChange="revise(4);" value="<?php if(!$flageditarsemaforoestado){ echo $sbreg[semestnegro];}else{ echo $semestnegro; }?>" size="10">
 								%</td> 
 							</tr> 
													 	
                        					<tr>
                        						<td colspan="5" align="center"><input type="button" name="nuevo" onClick="grabar();" alt="Editar Registro" value="Grabar">
                        						&nbsp;</td>
                        					</tr>

	  		  		  </table>
			  		</td>
  		  		</tr>
				<tr><td colspan="3" class="NoiseColumnTD">&nbsp;</td></tr>
  	  		</table>
		
			<label></label>
			<?php if($campnomb){echo '<font face = "Verdana" >Corregir los campos marcados con *</font>';} ?> 
			<input type="hidden" name="accionnuevosemaforoestado">
			<input type="hidden" name="flageditarsemaforoestado">
			<input type="hidden" name="semestcodigo" value="<?php if(!$flageditarsemaforoestado){ echo $sbreg[semestcodigo];}else{ echo $semestcodigo; } ?>"> 
			<input type="hidden" name="accioneditartipodespacho"> 
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>">	
		</form>
	</body>
<?php if(!$codigo){ echo " -->"; } ?>
</html>