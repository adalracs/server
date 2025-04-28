<?php
ob_start();
include ( '../src/FunGen/sesion/fncvalses.php');
include ( '../src/FunPerPriNiv/pktblusuario.php');
include ( '../src/FunPerPriNiv/pktblot.php');
include ( '../src/FunPerPriNiv/pktbltipomant.php');
include ( '../src/FunPerPriNiv/pktblpriorida.php');
include ( '../src/FunPerPriNiv/pktbltipotrab.php');
include ( '../src/FunPerPriNiv/pktbltipocump.php');
include ( '../src/FunPerPriNiv/pktbltarea.php');
include ( '../src/FunGen/floadtimehours.php');
include ( '../src/FunGen/floadtimeminut.php');

if($accionnuevohistoriaot)
{
	include ( 'grabahistoriaot.php');
}

$idcon = fncconn();
$arrusr = loadrecordusuario($usuacodi, $idcon);
$usrname = $arrusr["usuanombre"]." ".$arrusr["usuapriape"]." ".$arrusr["usuasegape"];
fncclose($idcon);
?> 
<!-- Propiedad intelectual de Adsum SA (c) 
-Todos los derechos reservados- 
Creado con WAG Adsum 
Autor: Andr�s A. Riascos D. 
Fecha: 26052004 
GenVers: 3.1 --> 
<html> 
<head> 
<title>Nuevo registro de historiaot</title> 
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
<meta http-equiv="expires" content="0"> 
<link rel="stylesheet" type="text/css" href="temas/Noise/Style.css"> 
<script language="JavaScript" src="../src/FunGen/jsrsClient.js" type="text/javascript" ></script>
<script language="JavaScript" src="../src/FunGen/cargarEmpleaselec.js" type="text/javascript" ></script>
<script language=JavaScript src="../src/FunGen/cargarTransacitem.js" type="text/javascript" ></script>
<script language=JavaScript src="../src/FunGen/cargarFormahistoriaot.js" type="text/javascript" ></script>
<script language=JavaScript src="../src/FunGen/cargarVistaot.js" type="text/javascript" ></script>
<script language=JavaScript src="../src/FunGen/fncbotton.js" type="text/javascript" ></script>
<SCRIPT LANGUAGE="JavaScript"> 
<!-- Begin
agree = 0;
//  End -->
</script> 
</head> 
<?php 
if(!$codigo)
{ echo "<!--";}
?> 
<body bgcolor="FFFFFF" text="#000000"> 
<form name="form1" method="post"  enctype="multipart/form-data"> 
<p><font class="NoiseFormHeaderFont">Historia de OT</font></p> 
<table border="0" cellspacing="1" cellpadding="2" align="center" class="NoiseFormTABLE"> 
	<tr> 
    	<td class="NoiseErrorDataTD">&nbsp;</td> 
  	</tr> 
  	<tr> 
     	<td class="NoiseFieldCaptionTD"><span class="style5"><font color="FFFFFF">Ingresar nuevo registro</font></span></td>
    </tr> 
	<tr> 
  		<td> 
         	<table width="93%" border="0" cellspacing="0" cellpadding="3" align="center"> 
         		<tr>
					<td>
						<table width="100%" border="0" cellspacing="0" cellpadding="3" align="center">
							<?php
							if($flagnuevohistoriaot)
							{
								$idcon = fncconn();
								if($ordtracodigo)
								{
									$sbregot = loadrecordot($ordtracodigo,$idcon);
								//  include('detallareportot.php');
								}
								fncclose($idcon);
								$itemseleccodi1=explode(",",$itemseleccodi1);
								$itemseleccant1=explode(",",$itemseleccant1);
							}
							?>
							<tr>
 								<td width="16%">&nbsp;
 								</td> 
 							</tr> 
							<tr>
								<td colspan="2">Orden de trabajo<br>
  									<?php if($campnomb["ordtracodigo"] == 1)echo "*";?>
  									<input type="text" name="ordtracodigo"  size="13" value="<?php if($flagnuevohistoriaot) echo $ordtracodigo;?>" onFocus="if(!agree)this.blur();">
  									<input type="button" name="buscar" value="Buscar OT" onclick="window.open('consultarvistaot.php?codigo=<?php 
  									echo $codigo?>','secundaria1','status=no,menubar=no,scrollbars=yes,resizable=yes,left=300,width=800,height=600');"
  									width="86" height="18" alt="Cancelar" border=0 href="#" target="_parent"></td>
					  			<td>Fecha:</td>
					  			<td width="14%"><input type="text" name="ordtrafecgen" size="13" value="<?php if(!$flagnuevohistoriaot){
									echo $sbregot[ordtrafecgen];}else{ echo $ordtrafecgen; }?>" onFocus="if (!agree)this.blur();">
									</td>
					  			<td width="11%">Hora:&nbsp;&nbsp;</td>
								<td><input type="text" name="ordtrahorgen"  size="13" value="<?php if(!$flagnuevohistoriaot){
									echo $sbregot[ordtrahorgen];}else{ echo $ordtrahorgen; }?>" onFocus="if (!agree)this.blur();"></td>
							</tr>
							<tr>
								<td colspan="7"><hr></td>
							</tr>
							<tr>
							 	<td>Planta</td>
							  	<td>&nbsp;&nbsp;Sistema</td>
							  	<td colspan="2">Equipo</td>
							  	<td colspan="2">Componente</td>
							</tr>
							<tr>
								<td>
									<input type="text" name="plantanombre"  size="17" value="<?php if(!$flagnuevohistoriaot){
									echo $sbregot[plantanombre];}else{ echo $plantanombre; }?>" onFocus="if (!agree)this.blur();">
								</td>
								<td>				
									&nbsp;&nbsp;<input type="text" name="sistemnombre"  size="17" value="<?php if(!$flagnuevohistoriaot){
									echo $sbreg[sistemnombre];}else{ echo $sistemnombre; }?>" onFocus="if (!agree)this.blur();">&nbsp;
								</td>
								<td colspan="2">
									<input type="text" name="equiponombre"  size="17" value="<?php if(!$flagnuevohistoriaot){
									echo $sbreg[equiponombre];}else{ echo $equiponombre; }?>" onFocus="if (!agree)this.blur();">
								</td>
  								<td colspan="2">
									<input type="text" name="componnombre"  size="17" value="<?php if(!$flagnuevohistoriaot){
									echo $sbreg[componnombre];}else{ echo $componnombre; }?>" onFocus="if (!agree)this.blur();">
								</td>
 							</tr>							
							<tr>
								<td width="16%">Tipo de mantenimiento</td>
								<td width="33%">
									<input type="text" name="tipmannombre"  size="18" value="<?php if(!$flagnuevohistoriaot){
									echo $sbreg[tipmannombre];}else{ echo $tipmannombre; }?>" onFocus="if (!agree)this.blur();">
								</td>
								<td width="11%" align="right">Prioridad&nbsp;&nbsp;&nbsp;&nbsp;</td>
								<td colspan="2">
									<input type="text" name="priorinombre"  size="13" value="<?php if(!$flagnuevohistoriaot){
									echo $sbreg[priorinombre];}else{ echo $priorinombre; }?>" onFocus="if (!agree)this.blur();">
								</td>
								<td width="15%">&nbsp;</td>
							</tr>
							<tr>
								<td width="16%">Fecha de inicio</td>
				              	<td colspan="2">
            						<input type="text" name="ordtrafecini" onFocus="if (!agree)this.blur();" size="10" maxlength="10"
									value="<?php if(!$flagnuevohistoriaot){echo $sbreg[ordtrafecini];}else{ echo $ordtrafecini; }?>">&nbsp;aaaa-mm-dd
            					</td>
            					<td>Hora inicio&nbsp;</td>
            						<td colspan="1"><input name="ordtrahorini" type="text" onFocus="if (!agree)this.blur();" value="<?php 
									if(!$flagnuevohistoriaot){echo $sbreg[ordtrahorini];}else{ echo $ordtrahorini; }?>" size="5" 
									maxlength="5"></td>
					  			<td>
								&nbsp;
					  			</td>
							</tr>
							<tr>
					 			<td width="16%">Fecha de fin</td>
				  			  	<td colspan="2">
            						<input type="text" name="ordtrafecfin" onFocus="if (!agree)this.blur();" size="10" maxlength="10"
									value="<?php if(!$flagnuevohistoriaot){echo $sbreg[ordtrafecfin];}else{ echo $ordtrafecfin; }?>">&nbsp;aaaa-mm-dd
            					</td>
	        					<td>Hora fin</td>
            					<td colspan="1"><input name="ordtrahorfin" type="text"	onFocus="if (!agree)this.blur();" value="<?php if(!$flagnuevohistoriaot){
									echo $sbreg[ordtrahorfin];}else{ echo $ordtrahorfin; }?>" size="5" maxlength="5"></td>
  								<td>
								&nbsp;
  								</td>
							</tr>
							<tr>
								<td colspan="5"></td>
							</tr>
							<tr>
								<td colspan="6"><hr></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
  					<td>
  						<table width="100%" border="0" cellspacing="0" cellpadding="3" align="center">
    						<tr>
      							<td width="35%">Empleado de mantenimiento&nbsp;&nbsp;&nbsp;</td>
        						<td width="10%">C&oacute;digo</td>
        						<td width="14%"><input name="empleacod" type="text"	onFocus="if (!agree)this.blur();"
									value="<?php if(!$flagnuevohistoriaot){echo $sbreg[empleacod];}else{ echo $empleacod; }?>" size="8">
        						</td>
      							<td width="10%">Nombre </td>
      							<td width="31%"><input  name="empleanomb" type="text" value="<?php if(!$flagnuevohistoriaot){echo $sbreg[empleanomb];}else{ echo $empleanomb; }?>" size="25" onFocus="if (!agree)this.blur();"></td>
      						</tr>
    						<tr>
      							<td>&nbsp;</td>
      							<td colspan="4">&nbsp;</td>
    						</tr>
						    <tr>
      							<td colspan="5">
								<span id="auxiliares" style="display:none;">Auxiliares de mantenimiento<br>	
      							<select name="empleaselec" size="3">
                                    <?php
                                    if($sbregotusuaselec)
                                    {
                                    	include('../src/FunGen/floadusuaaux.php');
                                    	$idcon = fncconn();
                                    	floadusuaaux($idcon,$sbregotusuaselec);
                                    	fncclose($idcon);
                                    }
									?>
                                  </select>
                                  </span>
      							</td>
      						</tr>
      						<tr>
      						<td colspan="5"><hr></td>
      						</tr>
      						<tr class="NoiseErrorDataTD">
      						 <td colspan="2">&nbsp;&nbsp;&nbsp;&nbsp;Estado&nbsp;&nbsp;
      						  <select name="otestacodigo">
      						  <option value="">Seleccione</option>
      						  </select>
      						 </td>
      						 <td colspan="3">
      						   <table border="0" width="20%" class="NoiseErrorDataTD"> 
      						    <tr>
							     <td>
							     <span style="display:none;" id="items_dev">
							     <input type="button" value="Devolver items" onclick="abreVentanas(<?php echo $codigo;?>, 1)">
							     </span>
							     </td>
							     <td>
							     <span style="display:none;" id="herram_dev">
							     <input type="button" value="Devolver herramientas" onclick="abreVentanas(<?php echo $codigo;?>, 0)">
							     </span>
							     </td>
							   </tr>
						    </table>
      						</tr>
      					    <tr>
							 <td colspan="5"><hr></td>
						    </tr>
					</table>
  				</td>
			</tr>
			<tr>
			<td>
			<span id="reporte" style="display:none;">
				<table border="0" width="100%" class="NoiseErrorDataTD">
				<tr>
					<td colspan="2">
					<font color="Black"><b>Reporte de OT</b></font>
					</td>				
				</tr>
				<tr>
					<td>
					Tipo de mantenimiento&nbsp;&nbsp;
					<select name="tipmancodigo_h">
					<option value="">Seleccione</option>
					<?php
					include('../src/FunGen/floadtipomant.php');
					$idcon = fncconn();
					floadtipomant($idcon);
					fncclose($idcon);
					?>
					</select>
					</td>
					<td>
					Prioridad&nbsp;&nbsp;
					<select name="prioricodigo_h">
					<option value="">Seleccione</option>
					<?php
					include('../src/FunGen/floadpriorida.php');
					$idcon = fncconn();
					floadpriorida($idcon);
					fncclose($idcon);
					?>
					</select>
					</td>
				</tr>
				<tr>
					<td>
					Tipo de trabajo&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<select name="tiptracodigo_h">
					<option value="">Seleccione</option>
					<?php
					include('../src/FunGen/floadtipotrab.php');
					$idcon = fncconn();
					floadtipotrab($idcon);
					fncclose($idcon);
					?>
					</select>
					</td>
					<td>
					Tarea&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<select name="tareacodigo_h">
					<option value="">Seleccione</option>
					<?php
					include('../src/FunGen/floadtarea.php');
					$idcon = fncconn();
					floadtarea($idcon);
					fncclose($idcon);
					?>
					</select>
					</td>
				</tr>
				<tr>
					<td colspan="2">
					&nbsp;
					</td>
				</tr>
				</table>
			</span>
			</td>
			</tr>
			<tr>
			<td>
			<span id="cierre" style="display:none;">
				<table border="0" width="100%" class="NoiseErrorDataTD">
				<tr>
					<td colspan="2">
					<font color="Black"><b>Cierre de OT</b></font>
					</td>
				</tr>
				<tr>
					<td colspan="2">
					Tipo de cumplimiento&nbsp;&nbsp;
					<select name="tipcumcodigo_h">
					<option value="">Seleccione</option>
					<?php
					include('../src/FunGen/floadtipocump.php');
					$idcon = fncconn();
					floadtipocump($idcon);
					fncclose($idcon);
					?>
					</select>
					</td>
				</tr>
				<tr>
				<td colspan="2">&nbsp;</td>
				</tr>
				</table>
			</span>
			</td>
			</tr>
			<tr>
			<td>
			<span id="divic" style="display:none;">
			<hr>
			</span>
			</td>
			</tr>
         	<tr> 
				<td>
					<table width="100%" border="0" cellspacing="0" cellpadding="3" align="center">
							<tr>
      							<td width="25%"><?php if($campnomb["usuacodi"] == 1){$usuacodi = null; echo "*";}?>Empleado&nbsp;&nbsp;&nbsp;</td>
        						<td width="10%">C&oacute;digo</td>
        						<td width="18%"><input name="usuacodic" type="text"	onFocus="if (!agree)this.blur();"
									value="<?php if(!$flagnuevohistoriaot){echo $usuacodi;}else{ echo $usuacodi; }?>" size="8">
        						</td>
      							<td width="16%">Nombre</td>
      							<td colspan="2"><input  name="usuanombre" type="text" value="<?php if(!$flagnuevocierreot){ echo $usrname;}else{ echo $usuanombre; }?>" onFocus="if (!agree)this.blur();"></td>
      						</tr>
      						<tr>
								<td width="16%"><?php if($campnomb["ordtradescri"] == 1){$histotdescri = null; echo "*";} ?>Motivo</td>
					 			<td colspan="5">
 									<textarea name="histotdescri" cols="57" rows="3" wrap="VIRTUAL"><?php if(!$flagnuevohistoriaot){
									echo $sbreg[histotdescri];}else{ echo $histotdescri; }?></textarea>
 								</td>
							</tr>
    						<tr><td colspan="6">&nbsp;</td></tr>
      				</table>
				</td>
			</tr>
		</table> 
  	</td> 
</tr> 
<tr> 
<td> 
<div align="center">  
  <input type="image" name="aceptar"  src="../img/aceptar.gif" 
onclick="form1.accionnuevohistoriaot.value =  1;"  width="86" height="18" 
alt="Aceptar" border=0> 
  <input type="image" name="cancelar" src="../img/cancelar.gif" 
onclick="form1.action='maestablhistoriaot.php';"  width="86" height="18" 
alt="Cancelar" border=0> 
</div> 
</td> 
 </tr> 
 <tr> 
  <td class="NoiseErrorDataTD">&nbsp;</td> 
 </tr> 
</table> 
<?php 
if($campnomb){'<font face = "Verdana" >Corregir los capos marcados con
*</font>';}
?> 
<input type="hidden" name="histotcodigo" value="<?php if(!$flagnuevohistoriaot){ echo $sbreg[histotcodigo];}else{ echo $histotcodigo;}?>"> 
<input type="hidden" name="accionnuevohistoriaot">
<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
<input type="hidden" name="tiptranombre">
<input type="hidden" name="tareanombre">
<input type="hidden" name="ordtranota">
<!-- Banderas de grabado -->
<input type="text" name="flagrport" style="display:none; border:none; color:#FFFFFF" onfocus="showDivs(window.document.form1.items_aux.value, this.value); window.document.form1.usuarios_aux.focus(); this.style.display='none';">
<input type="hidden" name="flagcclosed">
<!-- 	Auxiliares de mantenimiento    -->
<input type="text" size="1" name="usuarios_aux" style="border:none; color:#FFFFFF" onfocus="cargarFormahistoriaot(this.value); if(!agree)this.blur();">
<!-- Elimina los selects -->
<input type="text" name="delete_options" onfocus="limpiaSelects(this);" size="1" style="display:none; color:#FFFFFF; border:none;">
<input type="text" size="1" style="display:none; border:none; color:#FFFFFF;" name="items_aux" value="<?php echo $items_aux;?>" onfocus="this.style.display='none';">
<!--	*	*	*	*	*	-->
<input type="hidden" name="arreglo_ite" value="<?php echo $arreglo_ite; ?>"> 
<input type="hidden" name="arreglo_herr" value="<?php echo $arreglo_herr; ?>"> 
<!--	*	*	*	*	*	-->
</form> 
</body> 
<?php 
if(!$codigo)
{ echo " -->"; }
?> 
</html>