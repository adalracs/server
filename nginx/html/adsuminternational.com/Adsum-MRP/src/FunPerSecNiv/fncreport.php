<?php
/*
Propiedad intelectual de Adsum (c)
funcion		: fncexecSql
Descripcion	: Ejecuta una cadena sql
Parametros	: Descripcion
		  $conn   Conexion con la base de datos
		  $sql    La cadena a ejecutar
Retorno		: $arreglo
Autor		: lfolaya
Fecha		: 04-agos-2004
*/

function fncexecSql($conn,$sql)
{
    $arreglo = pg_exec($conn,$sql);
    return $arreglo;
}


function fnccountReg($arreglo)
{
    $cantrow = pg_numrows($arreglo);
    return $cantrow;
}

function fncfetchRow($arreglo,$numReg)
{
    $regRow = pg_fetch_array($arreglo,$numReg);
    return $regRow;
}
?>