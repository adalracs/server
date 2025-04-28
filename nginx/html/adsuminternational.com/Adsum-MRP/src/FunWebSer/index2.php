<?php
if ($_POST["reload"] > 0)
{
	require("lib/nusoap.php");
	$cliente = new soapclient("http://gaia.li.com.co/cmms/src/FunWebSer/WSincidencias.php?wsdl", "wsdl");
	
	$iReginsidencia["datcod"]   = $_POST["datcod"];
	$iReginsidencia["datfechtemp"]   = $_POST["datfechtemp"];
	$iReginsidencia["datfechrep"]   = $_POST["datfechrep"];
	$iReginsidencia["datfechasig"]   = $_POST["datfechasig"];
	$iReginsidencia["datfechdesp"]   = $_POST["datfechdesp"];
	$iReginsidencia["datfechtrab"]   = $_POST["datfechtrab"];
	$iReginsidencia["datbrig"]   = $_POST["datbrig"];
	$iReginsidencia["datdisp"]   = $_POST["datdisp"];
	$iReginsidencia["datcausa"]   = $_POST["datcausa"];
	$iReginsidencia["datprogra"]   = $_POST["datprogra"];
	
	$radval = $_POST["radval"];

	switch ($radval)
	{
		case 1:
			$resultado = $cliente->call('insIncidencias', array('Incidencia' => $iReginsidencia));
			break;

		case 2:
			$resultado = $cliente->call('updIncidencias', array('Incidencia' => $iReginsidencia));
			break;

		case 3:
			$resultado = $cliente->call('delIncidencias', array('Incidencia' => $iReginsidencia));
			break;

		default:
			break;
	}

	if ($resultado != null)
	{
		if ($resultado < 1)
		{
			echo '<script language="Javascript">'."\n";
			echo "alert('Error al procesar la informacion. Llenar los campos vacios o no seleccionados.');"."\n";
			echo "</script>";
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
	<head><title>ADSUM CMMS - Gesti&oacute;n de mantenimiento</title></head>
	<body bgcolor="#FFFFFF">
		<br>
		<font face="verdana"><center><h3>ADSUM CMMS<br>Gesti&oacute;n de mantenimiento</h3></center></font><br><br>
		<div align="left">
			<ul>
				<li type="square"><a href="javascript:;" style="text-decoration:none;" onclick="window.document.datos.radval.value='1'; window.document.getElementById('update').style.display='none'; window.document.getElementById('delete').style.display='none'; window.document.getElementById('create').style.display='inline';">Crear incidencia</a></li>
				<li type="square"><a href="javascript:;" style="text-decoration:none;" onclick="window.document.datosb.radval.value='2';window.document.getElementById('update').style.display='none'; window.document.getElementById('create').style.display='none'; window.document.getElementById('delete').style.display='inline';">Borrar incidencia</a></li>
				<li type="square"><a href="javascript:;" style="text-decoration:none;" onclick="window.document.datosc.radval.value='3'; window.document.getElementById('create').style.display='none';window.document.getElementById('delete').style.display='none'; window.document.getElementById('update').style.display='inline';">Actualizar incidencia</a></li>
			</ul>
		</div>
		<span style="display:none;" id="create">
			<form name="datos"  method="POST">
				<input type="hidden" name="radval" value="1">
				<input type="hidden" id="reload" name="reload" value="">
				<table align="center" cellpadding="3" width="50%">
					<tr>
						<td>C&oacute;digo de incidencia</td><td><input type="text" name="datcod" size="12"></td>
						<td>Fecha y Hora Temporal</td><td><input type="text" name="datfechtemp" size="12"></td>
					</tr>
					<tr>
						<td>Fecha y Hora recepci&oacute;n</td><td><input type="text" name="datfechrep" size="50"></td>
						<td>Fecha y Hora reparaci&oacute;n</td><td><input type="text" name="datfechasig" size="50"></td>
					</tr>
					<tr>
						<td><b>Fecha y Hora despacho primera Cuadrilla</b></td><td><input type="text" name="datfechdesp" size="50" maxlength="50"></td>
						<td><b>Numero brigada</b></td><td><input type="text" name="datbrig" size="12"></td>
					</tr>
					<tr>
						<td><b>Fecha y Hora de trabajando</b></td><td><input type="text" name="datfechtrab" size="50" maxlength="50"></td>
						<td><b>Disponibilidad</b></td><td><input type="text" name="datdisp" size="12"></td>
					</tr>
					<tr>
						<td><b>Causa</b></td><td><input type="text" name="datcausa" size="12"></td>
						<td><b>Programa</b></td><td><input type="text" name="datprogra" size="50"></td>
					</tr>
				</table>
				<center><input name="boton" type="submit" value="Nueva incidencia" onclick="document.datos.reload.value='1';"></center>
			</form>
		</span>
		<span style="display:none;" id="update">
			<form name="datosb"  method="POST">
				<input type="hidden" name="radval" value="2">
				<input type="hidden" id="reload" name="reload" value="">
				<table align="center" cellpadding="3" width="50%">
					<tr>
						<td>C&oacute;digo de incidencia</td><td><input type="text" name="datcod" size="12"></td>
						<td>Fecha y Hora Temporal</td><td><input type="text" name="datfechtemp" size="12"></td>
					</tr>
					<tr>
						<td>Fecha y Hora recepci&oacute;n</td><td><input type="text" name="datfechrep" size="50"></td>
						<td>Fecha y Hora reparaci&oacute;n</td><td><input type="text" name="datfechasig" size="50"></td>
					</tr>
					<tr>
						<td><b>Fecha y Hora despacho primera Cuadrilla</b></td><td><input type="text" name="datfechdesp" size="50" maxlength="50"></td>
						<td><b>Numero brigada</b></td><td><input type="text" name="datbrig" size="12"></td>
					</tr>
					<tr>
						<td><b>Fecha y Hora de trabajando</b></td><td><input type="text" name="datfechtrab" size="50" maxlength="50"></td>
						<td><b>Disponibilidad</b></td><td><input type="text" name="datdisp" size="12"></td>
					</tr>
					<tr>
						<td><b>Causa</b></td><td><input type="text" name="datcausa" size="12"></td>
						<td><b>Programa</b></td><td><input type="text" name="datprogra" size="50"></td>
					</tr>
				</table>
				<center><input name="boton" type="submit" value="Actualizar incidencia" onclick="document.datosb.reload.value='1';"></center>
			</form>
		</span>
		<span style="display:none" id="delete">
			<form name="datosc" method="POST">
				<input type="hidden" name="radval" value="3">
				<input type="hidden" id="reload" name="reload" value="">
				<table width="50%" border="0" cellpadding="3" align="center">
					<tr>
						<td>C&oacute;digo de incidencia:&nbsp;&nbsp;<input type="text" name="datcod" size="12"></td>
					</tr>
					<tr>
						<td align="center"><input type="submit" value="Borrar incidencia" onclick="document.datosc.reload.value='1';" name="boton"></td>
					</tr>
				</table>
			</form>
		</span>
	</body>
</html>
