<?php
/*
-Todos los derechos reservados-
Propiedad intelectual de Adsum (c).
Autor           : lfolaya
Fecha           : 24012005

Historial de modificaciones
---------------------------

--FECHA--    	--MOTIVO--												--AUTOR--
14-08-2007		Se modifico para generar el detalle de las				cbedoya 
				programaciones
			
*/

include ( '../src/FunGen/cargainput.php');

$arr_cod = explode(",",$radiobutton);

$equipocodigo = trim(str_replace("|s","",$arr_cod[0]));
$tipmancodigo = trim(str_replace("|n","",$arr_cod[1]));
$tiptracodigo = trim(str_replace("|n","",$arr_cod[2]));

$idcon = fncconn();
$rsEquipo = loadrecordequipo($equipocodigo, $idcon);
$rsSistema = loadrecordsistema($rsEquipo['sistemcodigo'], $idcon);
$rsPlanta = loadrecordplanta($rsSistema['plantacodigo'], $idcon);
$tipmannombre = cargatipmannombre1($tipmancodigo, $idcon);
$tiptranombre = cargatiptrabnombre($tiptracodigo, $idcon);