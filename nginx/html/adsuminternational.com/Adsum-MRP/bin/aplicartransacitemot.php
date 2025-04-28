<?php
/*
Propiedad intelectual de Adsum(c).
Decripcion      : Maneja las variables de sesion necesarias para el proceso de crear la ot
Autor           : lfolaya	
Fecha           : 03-Mar-2004
*/

	
	if($flagsoliotitem == 1)
	{
		$_SESSION["arrtransacitem"] = $_SESSION["arrtransacitemAux"];
		$_SESSION["arrtransaccoditem"] = $_SESSION["arrtransaccoditemAux"];
		$_SESSION["arrtransacite"] = $_SESSION["arrtransaciteAux"];
		$_SESSION["arrtransactran"] = $_SESSION["arrtransactranAux"];
		$flagsoliotitem = 2;
		$_SESSION["flagsoliotitem"] = $flagsoliotitem;
	}
	else
	{
		$arrtransacitem = $_SESSION["arrtransacitem"];
		$arrtransaccoditem = $_SESSION["arrtransaccoditem"];
		$arrtransactran = $_SESSION["arrtransactran"];
		
		$arrtransacitemAux = $_SESSION["arrtransacitemAux"];
		$arrtransaccoditemAux = $_SESSION["arrtransaccoditemAux"];
		$arrtransactranAux = $_SESSION["arrtransactranAux"];
	
		
		
		// Ciclo de validaci�n de llave primaria de la tabla item
		for ($i = 0;$i < count($arrtransacitemAux); $i++)
		{
			for($j = 0;$j < count($arrtransacitem); $j++)
			{
				// Valido si itemcodigo existe para sobreescibir el registro
				if($arrtransacitemAux[$i][0] == $arrtransacitem[$j][0])
				{
					$arrtransacitem[$j][1] = $arrtransacitemAux[$i][1];
					$arrtransacitem[$j][2] = $arrtransacitemAux[$i][2];
					$arrtransacitem[$j+1][1] = $arrtransacitemAux[$i+1][0];
					$arrtransacitem[$j+1][2] = $arrtransacitemAux[$i+1][2];
//					$j = $j + 1;
					$transacedit = 1;
				}
			}
			if(!$transacedit)
			{
				//si no existe el registro, inserto uno nuevo
				$y = count($arrtransacitem);
				$arrtransacitem[$y][0] = $arrtransacitemAux[$i][0];
				$arrtransacitem[$y][1] = $arrtransacitemAux[$i][1];
				$arrtransacitem[$y][2] = $arrtransacitemAux[$i][2];
				$arrtransacitem[$y+1][0] = $arrtransacitemAux[$i+1][0];
				$arrtransacitem[$y+1][1] = $arrtransacitemAux[$i+1][1];
				$arrtransacitem[$y+1][2] = $arrtransacitemAux[$i+1][2];	$arrtransacitem[$y+1][2] = $resultSql;
			}
		}
		
		
		// Ciclo de validaci�n de llave primaria de la tabla item y campo cantidad
		for ($i = 0;$i < count($arrtransaccoditemAux); $i++)
		{
			for($j = 0;$j < count($arrtransaccoditem);$j++)
			{
				// Valido si herramcodigo existe para sobreescibir el registro
				if($arrtransaccoditemAux[$i][0] == $arrtransaccoditem[$j][0])
				{
					$arrtransaccoditem[$j][1] = $arrtransaccoditemAux[$i][1];
					$transacod = 1;
				}
			}
			if(!$transacod)
			{
				//si no existe el registro, inserto uno nuevo
				$x = count($arrtransaccoditem);
				$arrtransaccoditem[$x][0] = $arrtransaccoditemAux[$i][0];
				$arrtransaccoditem[$x][1] = $arrtransaccoditemAux[$i][1];
			}
		}
		
		// Ciclo de validaci�n de llave primaria de la tabla item y transacitem
		for ($i = 0;$i < count($arrtransactranAux); $i++)
		{
			for($j = 0; $j < count($arrtransactran); $j++)
			{
				// Valido si herramcodigo existe para sobreescibir el registro
				if($arrtransactranAux[$i][0] == $arrtransactran[$j][0])
				{
					$arrtransactran[$j][0] = $arrtransactranAux[$i][0];
					$arrtransactran[$j][1] = $arrtransactranAux[$i][1];
					$transacodite = 1;
				}
			}
			if(!$transacodite)
			{
				//si no existe el registro, inserto uno nuevo
				$z = count($arrtransactran);
				$arrtransactran[$z][0] = $arrtransactranAux[$i][0];
				$arrtransactran[$z][1] = $arrtransactranAux[$i][1];
			}
		}
		
		
		
		
	}
	//Subo los arreglos a las variables de sesi�n
	$_SESSION["arrtransacitem"] = $arrtransacitem;
	$_SESSION["arrtransaccoditem"] = $arrtransaccoditem;
	$_SESSION["arrtransacite"] = $arrtransacite;
	$_SESSION["arrtransactran"] = $arrtransactran;
	
	$arrtransacitetemp = $_SESSION["arrtransaccoditem"];
	unset($loaditem);
	
	for ($i = 0;$i < count($arrtransacitetemp);$i++)
	{	
		$loaditem = $loaditem.$arrtransacitetemp[$i][0]."-".$arrtransacitetemp[$i][1].",";
	} 
	
	//Bajo las variables de sesi�n usadas temporalmente
	session_unregister("arrtransacitemAux");
	session_unregister("arrtransaccoditemAux");
	session_unregister("arrtransaciteAux");
	session_unregister("arrtransactranAux");

	echo '<script language="javascript">';
	echo '<!--//'."\n";
	echo 'window.opener.document.form1.flagsoliotitem.value=2;window.opener.document.form1.loaditem.value="'.$loaditem.'";window.opener.document.form1.radio4.focus();window.close();';
	echo '//-->'."\n";
	echo '</script>';
?>