<?php
/*
Propiedad intelectual de Adsum(c).
Decripcion      : Maneja las variables de sesion necesarias para el proceso de crear la ot
Autor           : lfolaya	
Fecha           : 03-Mar-2004
*/

	
	if($flagsoliot == 1)
	{
		$_SESSION["arrtransac"] = $_SESSION["arrtransacAux"];
		$_SESSION["arrtransaccod"] = $_SESSION["arrtransaccodAux"];
		$_SESSION["arrtransacherr"] = $_SESSION["arrtransacherrAux"];
		$flagsoliot = 2;
		$_SESSION["flagsoliot"] = $flagsoliot;
	}
	else
	{
		$arrtransac = $_SESSION["arrtransac"];
		$arrtransaccod = $_SESSION["arrtransaccod"];
		$arrtransacherr = $_SESSION["arrtransacherr"];
		
		$arrtransacAux = $_SESSION["arrtransacAux"];
		$arrtransaccodAux = $_SESSION["arrtransaccodAux"];
		$arrtransacherrAux = $_SESSION["arrtransacherrAux"];
		
		// Ciclo de validaci�n de llave primaria de la tabla item
		for ($i = 0;$i < count($arrtransacAux); $i++)
		{
			for($j = 0;$j < count($arrtransac); $j++)
			{
				// Valido si itemcodigo existe para sobreescibir el registro
				if($arrtransacAux[$i][0] == $arrtransac[$j][0])
				{
					$arrtransac[$j][1] = $arrtransacAux[$i][1];
					$arrtransac[$j][2] = $arrtransacAux[$i][2];
					$arrtransac[$j+1][1] = $arrtransacAux[$i+1][0];
					$arrtransac[$j+1][2] = $arrtransacAux[$i+1][2];
//					$j = $j + 1;
					$transacedit = 1;
				}
			}
			if(!$transacedit)
			{
				//si no existe el registro, inserto uno nuevo
				$y = count($arrtransac);
				$arrtransac[$y][0] = $arrtransacAux[$i][0];
				$arrtransac[$y][1] = $arrtransacAux[$i][1];
				$arrtransac[$y][2] = $arrtransacAux[$i][2];
				$arrtransac[$y+1][0] = $arrtransacAux[$i+1][0];
				$arrtransac[$y+1][1] = $arrtransacAux[$i+1][1];
				$arrtransac[$y+1][2] = $arrtransacAux[$i+1][2];	
				$arrtransac[$y+1][2] = $resultSql;
			}
		}
		
		// Ciclo de validaci�n de llave primaria de la tabla item y campo cantidad
		for ($i = 0;$i < count($arrtransaccodAux); $i++)
		{
			for($j = 0;$j < count($arrtransaccod);$j++)
			{
				// Valido si herramcodigo existe para sobreescibir el registro
				if($arrtransaccodAux[$i][0] == $arrtransaccod[$j][0])
				{
					$arrtransaccod[$j][1] = $arrtransaccodAux[$i][1];
					$transacod = 1;
				}
			}
			if(!$transacod)
			{
				//si no existe el registro, inserto uno nuevo
				$x = count($arrtransaccod);
				$arrtransaccod[$x][0] = $arrtransaccodAux[$i][0];
				$arrtransaccod[$x][1] = $arrtransaccodAux[$i][1];
			}
		}
		
		// Ciclo de validaci�n de llave primaria de la tabla item y transacitem
		for ($i = 0;$i < count($arrtransacherrAux); $i++)
		{
			for($j = 0; $j < count($arrtransacherr); $j++)
			{
				// Valido si herramcodigo existe para sobreescibir el registro
				if($arrtransacherrAux[$i][0] == $arrtransacherr[$j][0])
				{
					$arrtransacherr[$j][0] = $arrtransacherrAux[$i][0];
					$arrtransacherr[$j][1] = $arrtransacherrAux[$i][1];
					$transacodherr = 1;
				}
			}
			if(!$transacodherr)
			{
				//si no existe el registro, inserto uno nuevo
				$z = count($arrtransacherr);
				$arrtransacherr[$z][0] = $arrtransacherrAux[$i][0];
				$arrtransacherr[$z][1] = $arrtransacherrAux[$i][1];
			}
		}
		
		
		
		
	}
	//Subo los arreglos a las variables de sesi�n
	
	$_SESSION["arrtransac"] = $arrtransac;
	$_SESSION["arrtransaccod"] = $arrtransaccod;
	$_SESSION["arrtransacherr"] = $arrtransacherr;
		
	$arrtransachertemp = $_SESSION["arrtransaccod"];
	unset($loadherram);
	
	for ($i = 0;$i < count($arrtransachertemp);$i++)
	{	
		$loadherram = $loadherram.$arrtransachertemp[$i][0]."-".$arrtransachertemp[$i][1].",";
	} 
	
	//Bajo las variables de sesi�n usadas temporalmente
	session_unregister("arrtransacAux");
	session_unregister("arrtransaccodAux");
	session_unregister("arrtransacherrAux");

	echo '<script language="javascript">';
	echo '<!--//'."\n";
	echo 'window.opener.document.form1.flagsoliot.value=2;window.opener.document.form1.loadherram.value="'.$loadherram.'";window.opener.document.form1.radio3.focus();window.close();';
	echo '//-->'."\n";
	echo '</script>';
?>