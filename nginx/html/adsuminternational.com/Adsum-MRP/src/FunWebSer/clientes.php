<?php
if (!(string) @$_POST["boton"] == "")
{
	include("lib/nusoap.php");
	$wsdl='http://localhost/li/src/FunWebSer/WSincidencias.php';
	$cliente=new soapclients($wsdl, 'wsdl'); 
    
	

	$iregIncidencias["datcod"] = $_POST["datcod"];
	$iregIncidencias["datfechtemp"] = @$_POST["datfechtemp"];
	$iregIncidencias["datfechrep"] = @$_POST["datfechrep"];
	$iregIncidencias["datfechasig"] = @$_POST["datfechasig"];
	$iregIncidencias["datfechdesp"] = @$_POST["datfechdesp"];
	$iregIncidencias["datfechtrab"] = @$_POST["datfechtrab"];
	$iregIncidencias["datbrig"] = @$_POST["datbrig"];
	$iregIncidencias["datdisp"] = @$_POST["datdisp"];
	$iregIncidencias["datcausa"] = @$_POST["datcausa"];
	$iregIncidencias["datproga"] = trim(@$_POST["datprogra"]);
	
	$radval = $_POST["radval"];
   
	switch ($radval)
	{
		case 1:
			$resultado = $cliente->call('instrdattemp', array('Incidencia' => $iregIncidencias));
			
			$array=unserialize($resultado);
			
			echo ($array[0]);
			
			break;

		case 2:
			$resultado = $cliente->call('delIncidencias', array('Incidencia' => $_POST["datcod"]));
			
			
			$array=unserialize($resultado);
			
			echo ($array[0]);
			
			break;

		case 3:
			$resultado = $cliente->call('updIncidencias', array('Incidencia' => $iregIncidencias));
			$array=unserialize($resultado);
			
			echo ($array[0]);
			break;
			
		case 4:
			
			$resultado = $cliente->call('saludo', array('name' => $iregIncidencias['datcod']), '', '', false, true);
			
			echo ($resultado);
			break;	
			
		case 5:
			$resultado = $cliente->call('consIncidencias', array('Incidencia' => $iregIncidencias));
			
			if ($cliente->fault) { // si
				echo 'No se pudo completar la operación';
				die();
			}else{ // no
				$error = $cliente->getError();
				if ($error) { // Hubo algun error
					echo 'Error:' . $error;
				}
			}
             $array=unserialize($resultado);
			if(is_array($array)){ //si hay valores en el array
				echo '<table width="878" border="2" cellpadding="0" cellspacing="0" align="center">
  <!--DWLayoutTable-->
  <tr>
    
    <td width="105" valign="top">Incidente ID&nbsp;</td>
    <td width="90" valign="top">Fecha Recepcion&nbsp;</td>
    <td width="85" valign="top">Fecha Asignacion&nbsp;</td>
    <td width="86" valign="top">Fecha Trabajando&nbsp;</td>
    <td width="90" valign="top">Dispositivos&nbsp;</td>
    <td width="80" valign="top">Programada&nbsp;</td>
    <td width="73" valign="top">Fecha Reparacion&nbsp;</td>
    <td width="99" valign="top">Fecha Despacho&nbsp;</td>
  <td width="86" valign="top">Brigadas&nbsp;</td>
  </tr>
  ';
				for($i=0;$i<count($array[0]);$i++){
					echo '<tr>';
					for($j=0;$j<9;$j++)
					{
					 echo '<td valign="top">'.$array[0][$i][$j].'&nbsp;</td>';
					}
					 echo '</tr>';
				}
				echo '</table>';
			}else{
				
				echo 'No hay Nada';
				echo '<h2>Request</h2><pre>' . htmlspecialchars($cliente->request, ENT_QUOTES) . '</pre>';
echo '<h2>Response</h2><pre>' . htmlspecialchars($cliente->response, ENT_QUOTES) . '</pre>';
echo '<h2>Debug</h2><pre>' . htmlspecialchars($cliente->debug_str, ENT_QUOTES) . '</pre>';

			}	
			
			
			break;	
			
		case 6:
			$resultado = $cliente->call('listarregistros', array('Incidencia' => $iregIncidencias));
			
			if ($cliente->fault) { // si
				echo 'No se pudo completar la operación';
				die();
			}else{ // no
				$error = $cliente->getError();
				if ($error) { // Hubo algun error
					echo 'Error:' . $error;
				}
			}
             $array=unserialize($resultado);
			if(is_array($array)){ //si hay valores en el array
				echo '<table width="878" border="2" cellpadding="0" cellspacing="0" align="center">
  <!--DWLayoutTable-->
  <tr>
    
    <td width="105" valign="top">Incidente ID&nbsp;</td>
    <td width="90" valign="top">Fecha Recepcion&nbsp;</td>
    <td width="85" valign="top">Fecha Asignacion&nbsp;</td>
    <td width="86" valign="top">Fecha Trabajando&nbsp;</td>
    <td width="90" valign="top">Dispositivos&nbsp;</td>
    <td width="80" valign="top">Programada&nbsp;</td>
    <td width="73" valign="top">Fecha Reparacion&nbsp;</td>
    <td width="99" valign="top">Fecha Despacho&nbsp;</td>
  <td width="86" valign="top">Brigadas&nbsp;</td>
  </tr>
  ';
				
				for($i=0;$i<count($array[0]);$i++){
					echo '<tr>';
					for($j=0;$j<9;$j++)
					{
					 echo '<td valign="top">'.$array[0][$i][$j].'&nbsp;</td>';
					}
					 echo '</tr>';
				}
				echo '</table>';
				
			}else{
				
				echo 'No hay Nada';
				echo '<h2>Request</h2><pre>' . htmlspecialchars($cliente->request, ENT_QUOTES) . '</pre>';
echo '<h2>Response</h2><pre>' . htmlspecialchars($cliente->response, ENT_QUOTES) . '</pre>';
echo '<h2>Debug</h2><pre>' . htmlspecialchars($cliente->debug_str, ENT_QUOTES) . '</pre>';

			}
	

		default:
			break;
	}
   
	if ($resultado != null)
	{
		
echo '<h2>Request</h2><pre>' . htmlspecialchars($cliente->request, ENT_QUOTES) . '</pre>';
echo '<h2>Response</h2><pre>' . htmlspecialchars($cliente->response, ENT_QUOTES) . '</pre>';
echo '<h2>Debug</h2><pre>' . htmlspecialchars($cliente->debug_str, ENT_QUOTES) . '</pre>';
		
		if ($resultado < 1)
		{
			/*echo '<script language="Javascript">'."\n";
			echo "alert('Error al procesar la informacion. Llenar los campos vacios o no seleccionados.');"."\n";
			echo "</script>";*/
		}
		else
		{
			echo '<script language="Javascript">'."\n";
			echo "alert('Proceso exitoso.');"."\n";
			echo "</script>";
		}
	}
}
?>
<html>
<head><title>ADSUM CMMS - Gesti&oacute;n de Insidencias</title></head>
<body bgcolor="#FFFFFF"><br>
<font face="verdana">
<center><h3>ADSUM CMMS<br>Gesti&oacute;n de Insidencias</h3></center><br><br>
<div align="left">
<ul>
<li type="square"><a href="javascript:;" style="text-decoration:none;" onclick="window.document.datos.radval.value='1'; window.document.getElementById('delete').style.display='none'; window.document.getElementById('create').style.display='inline';">Crear Incidencia</a></li>
<li type="square"><a href="javascript:;" style="text-decoration:none;" onclick="window.document.datosb.radval.value='2'; window.document.getElementById('create').style.display='none'; window.document.getElementById('delete').style.display='inline';">Borrar Incidencia</a></li>
<li type="square"><a href="javascript:;" style="text-decoration:none;" onclick="window.document.datos.radval.value='3'; window.document.getElementById('delete').style.display='none'; window.document.getElementById('create').style.display='inline';">Actualizar Incidencia</a></li>


<li type="square"><a href="javascript:;" style="text-decoration:none;" onclick="window.document.saludo.radval.value='4'; window.document.getElementById('saludo').style.display='none'; window.document.getElementById('saludo').style.display='inline';">Saludo</a></li>
<li type="square"><a href="javascript:;" style="text-decoration:none;" onclick="window.document.datos.radval.value='5'; window.document.getElementById('create').style.display='none'; window.document.getElementById('create').style.display='inline';">Consultar Incidencia</a></li>
<li type="square"><a href="javascript:;" style="text-decoration:none;" onclick="window.document.listar.radval.value='6'; window.document.getElementById('listar').style.display='none'; window.document.getElementById('listar').style.display='inline';">Listar Incidencias</a></li>
</ul>
</div>
<span style="display:none;" id="create">
<form name="datos" action="#"  method="POST">
<input type="hidden" name="radval" value="0">
<table align="center" cellpadding="3" width="50%">

	
	
	
<tr>
<td>Incidente ID:</td><td><input type="text" name="datcod" size="12"></td>
</tr
<tr>
<td>Fecha Recepcion:</td><td><input type="text" name="datfechtemp" size="12"></td>
<td>Fecha Reparacion:</td><td><input type="text" name="datfechrep" size="12"></td>
</tr>
<tr>
<td><b>Fecha Asignacion:</b></td><td><input type="text" name="datfechasig" size="12" maxlength="15"></td>
<td><b>Fecha Despacho:</b></td><td><input type="text" name="datfechdesp" size="12"></td>
</tr>
<tr>
<td><b>Fecha Trabajando:</b></td><td><input type="text" name="datfechtrab" size="12"></td>
<td><b>Brigadas:</b></td><td><input type="text" name="datbrig" size="12"></td>
</tr>
<tr>
<td><b>Dispositivos:</b></td><td><input type="text" name="datdisp" size="12"></td>
<td>Causa:</td><td><input type="text" name="datcausa" size="12"></td>
</tr>
<tr>
<td>Programada</td><td><input type="text" name="datprogra" size="12"></td>


</tr>

</table>
<center><input name="boton" type="submit" value="Oprimir Boton"></center>
</form>
</span>
<span style="display:none" id="delete">
<form name="datosb" action="#" method="POST">
<input type="hidden" name="radval" value="0">
<table width="50%" border="0" cellpadding="3" align="center">
<tr>
<td>Codigo:&nbsp;&nbsp;<input type="text" name="datcod" size="12"></td>
</tr>
<tr>
<td align="center"><input type="submit" value="Borrar registro" name="boton"></td>
</tr>
</table>
</form>
</span>
<span style="display:none" id="saludo">
<form name="saludo" action="#" method="POST">
<input type="hidden" name="radval" value="0">
<table width="50%" border="0" cellpadding="3" align="center">
<tr>
<td>Digite su nombre:&nbsp;&nbsp;<input type="text" name="datcod" size="12"></td>
</tr>
<tr>
<td align="center"><input type="submit" value="Oprimir Boton" name="boton"></td>
</tr>
</table>
</form>
</span>
<span style="display:none" id="listar">
<form name="listar" action="#" method="POST">
<input type="hidden" name="radval" value="0">
<table width="50%" border="0" cellpadding="3" align="center">
<tr>
<td><input type="hidden" name="datcod" size="12"></td>
</tr>
<tr>
<td align="center"><input type="submit" value="Oprimir Boton" name="boton"></td>
</tr>
</table>
</form>
</span>

</font>
</body>
</html>
