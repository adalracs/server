<?php 

include ( '../src/FunPerPriNiv/pktbldepartamento.php');
include ( '../src/FunPerPriNiv/pktblciudad.php');
include ( '../src/FunPerPriNiv/pktbltarea.php');
include ( '../src/FunPerPriNiv/pktblservicio.php');
include ( '../src/FunPerPriNiv/pktblpriorida.php');

	include('../src/FunPerSecNiv/fncclose.php');
	include('../src/FunPerSecNiv/fncconn.php');
	include('../src/FunPerSecNiv/fncnumreg.php');
	include('../src/FunPerSecNiv/fncfetch.php');

?> 
<html> 
<head> 
<title>Consultar en tareot</title> 
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
<meta http-equiv="expires" content="0"> 
<link rel="stylesheet" type="text/css" href="temas/Noise/Style.css"> 
		<script language="JavaScript" src="motofech.js"></script>
		<SCRIPT language=JavaScript src="../src/FunGen/jsrsClient.js"		type="text/javascript" ></SCRIPT>
		<script language=JavaScript src="../src/FunGen/cargarCiudades.js" type="text/javascript" ></script>
<SCRIPT LANGUAGE="JavaScript"> 
<!-- Begin 
agree = 0; 
//  End --> 
</script> 
<script language="JavaScript" src="motofech.js"></script> 
</head> 
<?php 
    if(!$codigo) 
    { echo "<!--";} 
?> 
<body bgcolor="FFFFFF" text="#000000">
 <font class="NoiseFormHeaderFont">Tarea por orden de trabajo</font>
 <form name="form1" method="post"  enctype="multipart/form-data">
  <table border="0" cellspacing="1" cellpadding="2" align="center" 
class="NoiseFormTABLE" width="60%"> 
  <tr> 
    <td class="NoiseErrorDataTD">&nbsp;</td> 
  </tr> 
  <tr> 
          <td class="NoiseFieldCaptionTD"><span class="style5"><font 
color="FFFFFF"> 
Consultar registro</font></span></td></tr> 
<tr> 
  <td> 
            <table width="85%" border="0" cellspacing="1" cellpadding="0" 
align="center"> 
<tr> 
 <td width="25%" class="NoiseFooterTD">&nbsp;No. Orden</td> 
  <td width="25%"> 
   <input type="text" name="ordtracodigo"	value="<?php 
if(!$flagconsultartareot){ echo $sbreg[ordtracodigo];}else{ echo 
$tareotcodigo;} ?>"> 
  </td> 
 </tr>
 <tr>
 <td width="25%"  class="NoiseFooterTD">&nbsp;ODS</td> 
  <td width="25%"> 
   <input type="text" name="clientsolici"	value="<?php 
if(!$flagconsultartareot){ echo $sbreg[clientsolici];}else{ echo $clientsolici;} 
?>"> 
  </td> 
 </tr> 
<tr> 
 <td width="25%"  class="NoiseFooterTD">&nbsp;Departamento</td> 
										<td width="35%"><select name="deptocodigo" onChange="cargarCiudades(this.value);">
										<?php
											$deptocodigo1 = $deptocodigo;
											echo '<option value = "">Seleccione</option>';
			
											$idcon = fncconn();
											$result = fullscandepartamento($idcon);
																
											if($result > 0)
												$numReg = fncnumreg($result);
																
											if($numReg){
												for ($i=0;$i<$numReg;$i++){
													$arr=fncfetch($result,$i);
					
													if($arr[deptocodigo] != 0){
								    						echo '<option value ="'.$arr[deptocodigo].'" ';
								    						
								    						if($flagnuevoclienteot){			
									    						if($deptocodigo1 == $arr[deptocodigo])
									    							echo "selected";
								    						}
								    					}	
								    					echo ">".$arr[deptonombre]."</option>"."\n";
												}
											}
										?>
					      	  		  </select></td> 
   <td width="25%"  class="NoiseFooterTD">&nbsp;Ciudad</td> 
										<td width="29%"><select name="ciudad">
										<?php
											$ciudad1 = $ciudad;
											echo '<option value = "">Seleccione</option>';
																
											$idcon = fncconn();
											$iregCiudad[deptocodigo] = $deptocodigo1;
											$iregCiudadop[deptocodigo] = "=";
											$result = dinamicscanopciudad($iregCiudad,$iregCiudadop,$idcon);
														
											if($result > 0)
												$numReg = fncnumreg($result);
																
											if($numReg){
												for ($i=0;$i<$numReg;$i++){
													$arr=fncfetch($result,$i);
															
													if($arr[ciudadcodigo] != 0){
								    						echo '<option value ="'.$arr[ciudadcodigo].'" ';
								    						if($flagnuevoclienteot){
															if($ciudad1 == $arr[ciudadcodigo])
								    								echo "selected";
								    						}
								    						echo ">".$arr[ciudadnombre]."</option>"."\n";
													}
												}
											}
										?>
									  </select></td>
 </tr> 
<tr> 
 <td width="25%"  class="NoiseFooterTD">&nbsp;Tipo de orden</td> 
										<td ><select name="tareacodigo">
										<?php
											$tipo_orden1 = $tareacodigo;
											echo '<option value = "">Seleccione</option>';

											$idcon = fncconn();			
											$result = fullscantarea($idcon);
											
											if($result > 0)
												$numReg = fncnumreg($result);
																
											if($numReg){
	        											for ($i=0;$i<$numReg;$i++){
                												$arr=fncfetch($result,$i);
                									
                												if($arr[tareacodigo] != 0){
                    													echo '<option value ="'.$arr[tareacodigo].'"';
                    									
                    													if($flagnuevoclienteot){
			    												if($tipo_orden1 == $arr[tareacodigo])
			    													echo "selected";
			    											}
                													echo ">".$arr[tareanombre]."</option>"."\n";		
													}
												}
											}
										?>
									      	</select></td>
 <td width="25%"  class="NoiseFooterTD">&nbsp;Servicio</td> 
										<td><select name="servicicodigo">
									      	<?php
											$servicio1 = $servicicodigo;
                                            								echo '<option value = "">Seleccione</option>';

											$idcon = fncconn();
											$result = fullscanservicio($idcon);
											
											if($result > 0)
												$numReg = fncnumreg($result);
												
											if($numReg){
        												for ($i=0;$i<$numReg;$i++){
                												$arr=fncfetch($result,$i);

                												if($arr[servicicodigo] != 0){
                													echo '<option value ="'.$arr[servicicodigo].'"';
                    									
                													if($flagnuevoclienteot){
			    												if($servicio1 == $arr[servicicodigo])
			    													echo "selected";
			    											}
           													echo ">".$arr[servicinombre]."</option>"."\n";                												
													}
												}
											}
										?>
										</select></td>
 </tr> 
<tr> 
 <td width="25%"  class="NoiseFooterTD">&nbsp;Prioridad</td> 
										<td><select name="prioricodigo">
										<?php
                                            								$prioridad1 = $prioricodigo;
											echo '<option value = "">Seleccione</option>';

											$idcon = fncconn();														
											$result = fullscanpriorida($idcon);
											
											if($result > 0)
												$numReg = fncnumreg($result);											
																
											if($numReg){
        												for ($i=0;$i<$numReg;$i++){
                												$arr=fncfetch($result,$i);
                									
                												if($arr[prioricodigo] != 0){
                    													echo '<option value ="'.$arr[prioricodigo].'"';
                    									
                    													if($flagnuevoclienteot){
                    														if($prioridad1 == $arr[prioricodigo])
			    													echo "selected";
			    											}
			    											echo ">".$arr[priorinombre]."</option>"."\n";
                												}		
												}
											}
										?>
									      	</select></td>

 </tr> 
<tr>
  <td>&nbsp;</td>
</tr> 
 <tr> 
  <td width="41%">&nbsp;</td> 
 </tr> 
</table> 
  </td> 
 </tr> 
 <tr> 
<td> 
<div align="center"> 
 
  <input type="image" name="aceptar"  src="../img/aceptar.gif" 
onclick="form1.accionconsultarvistaotservicio.value =  1;form1.accionborrarotservicio.value = 0; 
form1.action='maestablotsercierre.php';"  width="86" height="18" alt="Aceptar" 
border=0> 
  <input type="image" name="cancelar" src="../img/cancelar.gif" 
onclick="form1.action='maestablotsercierre.php';"  width="86" height="18" 
alt="Cancelar" border=0> 


  
  
  </div> 
</td> 
 </tr> 
 <tr> 
  <td class="NoiseErrorDataTD">&nbsp;</td> 
 </tr> 
</table> 
 <input type="hidden" name="flagconsultartareot" value="1"> 
<input type="hidden" name="accionconsultarvistaotservicio"> 
<input type="hidden" name="accionborrarotservicio"> 
<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
<input type="hidden" name="columnas" value="ordtracodigo, 
	clientsolici, 
	deptocodigo,
	ciudadcodigo,
	servicicodigo, 
	tareacodigo, 
	prioricodigo, 
	usuacodi,
	otestacodigo
"> 
<input type="hidden" name="nombtabl" value="vistaotservicioest"> 
</form> 
</body> 
<?php 
    if(!$codigo) 
    { echo " -->"; } 
?> 
</html> 
