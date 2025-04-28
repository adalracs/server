<?php

if (!(string)$_POST["boton"] == "")
{
	require("lib/nusoap.php");
	$cliente = new soapclient("http://172.16.3.4/sifa/adsum_li/src/FunWebSer/WSusuario.php?wsdl", "wsdl");

	$iRegusuario["usuacodi"] = $_POST["usuacodi"];
	$iRegusuario["usuanombre"] = $_POST["usuanombre"];
	$iRegusuario["usuapriape"] = $_POST["usuapriape"];
	$iRegusuario["usuasegape"] = $_POST["usuasegape"];
	$iRegusuario["usuadocume"] = $_POST["usuadocume"];
	$iRegusuario["usuatelefo"] = $_POST["usuatelefo"];
	$iRegusuario["usuatelef2"] = $_POST["usuatelef2"];
	$iRegusuario["usuaacti"] = $_POST["usuaacti"];
	$iRegusuario["usuacontac"] = $_POST["usuacontac"];
	$iRegusuario["usuatelcon"] = $_POST["usuatelcon"];
	$iRegusuario["usuadirecc"] = $_POST["usuadirecc"];
	$iRegusuario["usuaemail"] = $_POST["usuaemail"];
	$iRegusuario["estadocodigo"] = $_POST["estadocodigo"];
	$iRegusuario["cargocodigo"] = $_POST["cargocodigo"];
	$iRegusuario["departcodigo"] = $_POST["departcodigo"];
	$iRegusuario["tipusucodigo"] = $_POST["tipusucodigo"];
	$iRegusuario["usuanomb"] = $_POST["usuanomb"];
	$iRegusuario["usuapass"] = $_POST["usuapass"];
	$iRegusuario["usuavalhor"] = $_POST["usuavalhor"];
	$iRegusuario["usuaactiot"] = $_POST["usuaactiot"];

	$radval = $_POST["radval"];

	switch ($radval)
	{
		case 1:
			$resultado = $cliente->call('setUsuario', array('Usuario' => $iRegusuario));
			break;

		case 2:
			$resultado = $cliente->call('delUsuario', array('Usuanomb' => $_POST['usuanomb']));
			break;

		case 3:
			$resultado = $cliente->call('updUsuario', array('Usuario' => $iRegusuario));
			break;

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
<head><title>ADSUM CMMS - Gesti&oacute;n de usuarios</title></head>
<body bgcolor="#FFFFFF"><br>
<font face="verdana">
<center><h3>ADSUM CMMS<br>Gesti&oacute;n de usuarios</h3></center><br><br>
<div align="left">
<ul>
<li type="square"><a href="javascript:;" style="text-decoration:none;" onclick="window.document.datos.radval.value='1'; window.document.getElementById('delete').style.display='none'; window.document.getElementById('create').style.display='inline';">Crear usuario</a></li>
<li type="square"><a href="javascript:;" style="text-decoration:none;" onclick="window.document.datosb.radval.value='2'; window.document.getElementById('create').style.display='none'; window.document.getElementById('delete').style.display='inline';">Borrar usuario</a></li>
<li type="square"><a href="javascript:;" style="text-decoration:none;" onclick="window.document.datos.radval.value='3'; window.document.getElementById('delete').style.display='none'; window.document.getElementById('create').style.display='inline';">Actualizar usuario</a></li>
</ul>
</div>
<span style="display:none;" id="create">
<form name="datos" action="#"  method="POST">
<input type="hidden" name="radval" value="0">
<table align="center" cellpadding="3" width="50%">
<tr>
<td>C&oacute;digo:</td><td><input type="text" name="usuacodi" size="12"></td>
</tr
<tr>
<td>Login:</td><td><input type="text" name="usuanomb" size="12"></td>
<td>Password:</td><td><input type="password" name="usuapass" size="12"></td>
</tr>
<tr>
<td><b>Documento:</b></td><td><input type="text" name="usuadocume" size="12" maxlength="15"></td>
<td><b>Nombre:</b></td><td><input type="text" name="usuanombre" size="12"></td>
</tr>
<tr>
<td><b>Apellido:</b></td><td><input type="text" name="usuapriape" size="12"></td>
<td><b>Apellido 2:</b></td><td><input type="text" name="usuasegape" size="12"></td>
</tr>
<tr>
<td><b>Tel&eacute;fono:</b></td><td><input type="text" name="usuatelefo" size="12"></td>
<td>Tel&eacute;fono 2:</td><td><input type="text" name="usuatelef2" size="12"></td>
</tr>
<tr>
<td>Direcci&oacute;n</td><td><input type="text" name="usuadirecc" size="12"></td>
<td>E-mail:</td><td><input type="text" name="usuaemail" size="12"></td>
</tr>
<tr>
<td><b>Contacto:</b></td><td><input type="text" name="usuacontac" size="12"></td>
<td><b>Telefono:</b></td><td><input type="text" name="usuatelcon" size="12"></td>
</tr>
<tr>
<td><b>Cargo:</b></td><td><input type="text" name="cargocodigo" size="5"></td>
<td><b>Departamento:</b></td><td><input type="text" name="departcodigo" size="5"></td>
</tr>
<tr>
<td><b>Tipo:</b></td><td><input type="text" name="tipusucodigo" size="5"></td>
<td>Valor hora<b></b>:</td><td><input type="text" name="usuavalhor" size="12"></td>
</tr>
<tr>
<td>Estado:</td><td><input type="text" name="estadocodigo" size="5" value="1"></td>
<td>Activo OT:</td><td><input type="text" name="usuaactiot" size="5" value="1"></td>
</tr>
<tr>
<td>Activo</td><td colspan="3"><input type="text" name="usuaacti" size="5" value="1"></td>
</tr>
</table>
<center><input name="boton" type="submit" value="Nuevo usuario"></center>
</form>
</span>
<span style="display:none" id="delete">
<form name="datosb" action="#" method="POST">
<input type="hidden" name="radval" value="0">
<table width="50%" border="0" cellpadding="3" align="center">
<tr>
<td>Login:&nbsp;&nbsp;<input type="text" name="usuanomb" size="12"></td>
</tr>
<tr>
<td align="center"><input type="submit" value="Borrar usuario" name="boton"></td>
</tr>
</table>
</form>
</span
</font>
</body>
</html>
