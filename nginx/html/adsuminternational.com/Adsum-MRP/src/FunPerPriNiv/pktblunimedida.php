<?php 
  
function nulounimedida ($arg) 
{ 
return (($arg == "0"))?"0":(!($arg))?"NULL":"'".$arg."'"; 
} 
  
  
/* 
    Generado con generador Adsum (c). 
  
Funci�n: Loadunimedida 
Descripcion: Accesa el Registro indicado de la tabla 
Parametros:  
$iintunidadcodigo Campo parte de la llave primaria 
Retorno:  
TRUE = Registro solicitado 
FALSE = Error de base de datos o de conecci�n 
Autor: ADSUM 
Fecha: 13-December-2004 
Modificaci�n | Fecha | Autor 
*/ 
  
function loadrecordunimedida( 
$iintunidadcodigo,$nuConn 
) 
{ 
  
define("e_connection",-1); 
define("e_db",-2); 
define("e_empty",-3); 
define("cero",0); 
  
if ($nuConn) 
{ 
 $sbSql = "SELECT * FROM unimedida WHERE unidadcodigo =  "."'".$iintunidadcodigo."'"; 
  
 $nuResult = @pg_exec($nuConn,$sbSql); 
  
unset($sbSql); 
if ($nuResult) 
		{ 
 $nuCantRow = pg_numrows($nuResult); 
  
if ($nuCantRow > cero) 
{ 
  
 $nuCantFields = pg_numfields($nuResult); 
 $sbRow = pg_fetch_row ($nuResult,cero); 
 $sbLista = array(  
 "unidadcodigo"=>$sbRow[0], 
 "unidadnombre"=>$sbRow[1], 
 "unidadacra"=>$sbRow[2], 
 "unidaddescri"=>$sbRow[3] 
 ); 
return $sbLista; 
} 
else 
{ 
  
return  e_empty; 
  
} 
} 
else 
{ 
// echo"Ha ocurrido un error \n"; 
// echo $php_errormsg; 
return  e_db; 
} 
} 
else 
{ 
// echo"Fallo Intento de Conexion \n"; 
return  e_connection; 
} 
} 
  
/* 
    Generado con generador Adsum (c). 
  
Funci�n: fullscanunimedida 
Descripcion: Accesa todos los Registros  de la tabla 
Parametros:  
Retorno:  
TRUE = Id de transaccion 
FALSE = Error de base de datos o de conecci�n 
Autor: ADSUM 
Fecha: 13-December-2004 
Modificaci�n | Fecha | Autor 
*/ 
  
function fullscanunimedida($nuConn) 
{ 
  
define("e_connection",-1); 
define("e_db",-2); 
define("e_empty",-3); 
define("cero",0); 
  
if ($nuConn) 
{ 
 $sbSql = "SELECT * FROM unimedida"; 
  
 $nuResult = @pg_exec($nuConn,$sbSql); 
 var_dump($nuResult);
if ($nuResult) 
{ 
 $nuCantRow = pg_numrows($nuResult); 
  
unset($sbSql); 
if ($nuCantRow > cero) 
{ 
  
return $nuResult; 
} 
else 
{ 
  
return  e_empty; 
  
} 
} 
else 
{ 
// echo"Ha ocurrido un error \n"; 
// echo $php_errormsg; 
return  e_db; 
} 
} 
else 
{ 
// echo"Fallo Intento de Conexion \n"; 
return  e_connection; 
} 
} 
  
/* 
    Generado con generador Adsum (c). 
  
Funci�n: Sintaxisunimedida 
Descripcion: Verifica sintaxis de la consulta en dinamicScan 
Parametros:  
 $arg Valor del campo 
 $campo Nombre del campo 
 $flagunimedida Bandera que define si se utiliza AND 
Retorno:  
TRUE =  
FALSE =  
Autor: ariascos 
Fecha: 13-December-2004 
Modificaci�n | Fecha | Autor 
*/ 
  
function sintaxisunimedida ($arg, $campo, &$flagunimedida) 
{ 
if ($flagunimedida) 
{ 
$aux = "AND"; 
} 
if ($arg=="") 
{ 
return ""; 
} 
else 
{ 
$flagunimedida = 1; 
if ($campo != "unidadnombre" )
	return $aux."  upper(".$campo.") like '%".strtoupper($arg)."%'"; 
else 
	return $aux."  upper(".$campo.") = '".strtoupper($arg)."'"; 
} 
} 
  
/* 
    Generado con generador Adsum (c). 
  
Funci�n: DinamicScanunimedida 
Descripcion: Accesa el registro que hace match con la entrada 
Parametros:  
$iintunidadcodigo Campo parte de la llave primaria 
Retorno:  
TRUE = Id. de transaccion. 
FALSE = Error de base de datos o de conecci�n 
Autor: ariascos 
Fecha: 13-December-2004 
Modificaci�n | Fecha | Autor 
*/ 
  
function dinamicscanunimedida 
( 
$ircRecord,$nuConn 
) 
{ 
define("e_connection",-1); 
define("e_db",-2); 
define("e_empty",-3); 
define("cero",0); 
$flagunimedida = cero; 
  
if ($nuConn) 
{ 
  
 $sbSql = "SELECT * FROM unimedida WHERE". 
 sintaxisunimedida($ircRecord[unidadcodigo],"unidadcodigo",$flagunimedida). 
 sintaxisunimedida($ircRecord[unidadnombre],"unidadnombre",$flagunimedida). 
 sintaxisunimedida($ircRecord[unidadacra],"unidadacra",$flagunimedida). 
 sintaxisunimedida($ircRecord[unidaddescri],"unidaddescri",$flagunimedida); 
  
 $nuResult = pg_exec($nuConn,$sbSql); 
  
unset($sbSql); 
  
if ($nuResult) 
{ 
$nuCantRow = pg_numrows($nuResult); 
  
if ($nuCantRow > cero) 
{ 
  
return $nuResult; 
} 
else 
{ 
  
return  e_empty; 
  
} 
} 
else 
{ 
// echo"Ha ocurrido un error \n"; 
// echo $php_errormsg; 
return  e_db; 
} 
} 
else 
{ 
// echo"Fallo Intento de Conexion \n"; 
return  e_connection; 
} 
} 
  
/* 
    Generado con generador Adsum (c). 
  
Funci�n: Sintaxisopunimedida 
Descripcion: Verifica sintaxis de la consulta en dinamicScan 
Parametros:  
$iintunidadcodigo Campo parte de la llave primaria 
Retorno:  
TRUE =  
FALSE =  
Autor: ariascos 
Fecha: 13-December-2004 
Modificaci�n | Fecha | Autor 
*/ 
  
function sintaxisopunimedida ($arg,$campo,&$flagunimedida,$oper) 
{ 
if ($flagunimedida) 
{ 
$aux = "AND"; 
} 
if ($arg=="") 
{ 
return ""; 
} 
else 
{ 
$flagunimedida = 1; 
switch ($oper): 
 case "like": 
  return $aux." ".$campo." like '%".$arg."%'"; 
  break; 
 case "=": 
  return $aux." ".$campo." = '".$arg."'"; 
  break; 
 case "<": 
  return $aux." ".$campo." < ".$arg; 
  break; 
 case "<=": 
  return $aux." ".$campo." <= ".$arg; 
  break; 
 case ">": 
  return $aux." ".$campo." > ".$arg; 
  break; 
 case ">=": 
  return $aux." ".$campo." >= ".$arg; 
  break; 
 case "<>": 
  return $aux." ".$campo." <> ".$arg; 
  break; 
 case "like%_": 
  return $aux." ".$campo." like '%".$arg."'"; 
  break; 
 case "like_%": 
  return $aux." ".$campo." like '".$arg."%'"; 
  break; 
endswitch; 
} 
} 
  
/* 
    Generado con generador Adsum (c). 
  
Funci�n: DinamicScanopunimedida 
Descripcion: Accesa el registro que hace match con la entrada 
Parametros:  
$iintunidadcodigo Campo parte de la llave primaria 
Retorno:  
TRUE = Id. de transaccion. 
FALSE = Error de base de datos o de conecci�n 
Autor: ariascos 
Fecha: 13-December-2004 
Modificaci�n | Fecha | Autor 
*/ 
  
function dinamicscanopunimedida($ircrecord,$ircrecordop,$nuconn) 
{ 
  
define("e_connection",-1); 
define("e_db",-2); 
define("e_empty",-3); 
define("cero",0); 
$flagunimedida = cero; 
  
if ($nuconn) 
{ 
  
 $sbSql = "SELECT * FROM unimedida WHERE". 
 sintaxisopunimedida($ircrecord[unidadcodigo],"unidadcodigo",$flagunimedida, 
$ircrecordop[unidadcodigo]). 
 sintaxisopunimedida($ircrecord[unidadnombre],"unidadnombre",$flagunimedida, 
$ircrecordop[unidadnombre]). 
 sintaxisopunimedida($ircrecord[unidadacra],"unidadacra",$flagunimedida, 
$ircrecordop[unidadacra]). 
 sintaxisopunimedida($ircrecord[unidaddescri],"unidaddescri",$flagunimedida, 
$ircrecordop[unidaddescri]); 
  
$nuResult = pg_exec($nuconn,$sbSql); 
  
unset($sbSql); 
  
if ($nuResult) 
{ 
 $nuCantRow = pg_numrows($nuResult); 
  
if ($nuCantRow > cero) 
{ 
  
return $nuResult; 
} 
else 
{ 
  
return  e_empty; 
  
} 
} 
else 
{ 
// echo"Ha ocurrido un error \n"; 
// echo $php_errormsg; 
return  e_db; 
} 
} 
else 
{ 
// echo"Fallo Intento de Conexion \n"; 
return  e_connection; 
} 
} 
  
/* 
    Generado con generador Adsum (c). 
  
Funci�n: DinamicLimitScanunimedida 
Descripcion: Accesa el registro que hace match con la entrada 
Parametros:  
$iintunidadcodigo Campo parte de la llave primaria 
Retorno:  
TRUE = Id. de transaccion. 
FALSE = Error de base de datos o de conecci�n 
Autor: ariascos 
Fecha: 13-December-2004 
Modificaci�n | Fecha | Autor 
*/ 
  
function dinamiclimitscanunimedida 
( 
$ircRecord,$inucant,$inupos,$nuConn 
) 
{ 
define("e_connection",-1); 
define("e_db",-2); 
define("e_empty",-3); 
define("cero",0); 
$flagunimedida = cero; 
  
if ($nuConn) 
{ 
  
 $sbSql = "SELECT * FROM unimedida WHERE". 
 sintaxisunimedida($ircRecord[unidadcodigo],"unidadcodigo",$flagunimedida). 
 sintaxisunimedida($ircRecord[unidadnombre],"unidadnombre",$flagunimedida). 
 sintaxisunimedida($ircRecord[unidadacra],"unidadacra",$flagunimedida). 
 sintaxisunimedida($ircRecord[unidaddescri],"unidaddescri",$flagunimedida). 
" LIMIT ".$inucant." OFFSET ".$inupos; 
  
  
 $nuResult = pg_exec($nuConn,$sbSql); 
  
unset($sbSql); 
  
if ($nuResult) 
{ 
 $nuCantRow = pg_numrows($nuResult); 
  
if ($nuCantRow > cero) 
{ 
  
return $nuResult; 
} 
else 
{ 
  
return  e_empty; 
  
} 
} 
else 
{ 
// echo"Ha ocurrido un error \n"; 
// echo $php_errormsg; 
return  e_db; 
} 
} 
else 
{ 
// echo"Fallo Intento de Conexion \n"; 
return  e_connection; 
} 
} 
  
/* 
    Generado con generador Adsum (c). 
  
Funci�n: DinamicLimitScanopunimedida 
Descripcion: Accesa el registro que hace match con la entrada 
Parametros:  
$iintunidadcodigo Campo parte de la llave primaria 
Retorno:  
TRUE = Id. de transaccion. 
FALSE = Error de base de datos o de conecci�n 
Autor: ariascos 
Fecha: 13-December-2004 
Modificaci�n | Fecha | Autor 
*/ 
  
function 
dinamiclimitscanopunimedida($ircrecord,$ircrecordop,$inucant,$inupos,$nuconn) 
{ 
  
define("e_connection",-1); 
define("e_db",-2); 
define("e_empty",-3); 
define("cero",0); 
$flagunimedida = cero; 
  
if ($nuconn) 
{ 
  
 $sbSql = "SELECT * FROM unimedida WHERE". 
 sintaxisopunimedida($ircrecord[unidadcodigo],"unidadcodigo",$flagunimedida, 
$ircrecordop[unidadcodigo]). 
 sintaxisopunimedida($ircrecord[unidadnombre],"unidadnombre",$flagunimedida, 
$ircrecordop[unidadnombre]). 
 sintaxisopunimedida($ircrecord[unidadacra],"unidadacra",$flagunimedida, 
$ircrecordop[unidadacra]). 
 sintaxisopunimedida($ircrecord[unidaddescri],"unidaddescri",$flagunimedida, 
$ircrecordop[unidaddescri])." LIMIT ".$inucant.",".$inupos; 
  
  
 $nuResult = pg_exec($nuconn,$sbSql); 
  
unset($sbSql); 
  
if ($nuResult) 
{ 
 $nuCantRow = pg_numrows($nuResult); 
  
if ($nuCantRow > cero) 
{ 
  
return $nuResult; 
} 
else 
{ 
  
return  e_empty; 
  
} 
} 
else 
{ 
// echo"Ha ocurrido un error \n"; 
// echo $php_errormsg; 
return  e_db; 
} 
} 
else 
{ 
// echo"Fallo Intento de Conexion \n"; 
return  e_connection; 
} 
} 
  
/* 
    Generado con generador Adsum (c). 
  
Funci�n: UpRecordunimedida 
Descripcion: Actualiza un registro en la tabla partir de un 
	record 
Parametros:  
 $ircRecordRegistro a  modificar en la tabla 
Retorno:  
TRUE = True 
FALSE = Error de base de datos o de conecci�n 
Autor: ADSUM 
Fecha: 13-December-2004 
Modificaci�n | Fecha | Autor 
*/ 
  
function uprecordunimedida( 
 $ircRecord,$nuConn 
) 
{ 
  
define("e_connection",-1); 
define("e_db",-2); 
define("e_empty",-3); 
define("cero",0); 
define("n1",1); 
  
  
if ($nuConn) 
{ 
 $sbSql = "UPDATE unimedida SET 
 unidadcodigo =  ".nulounimedida($ircRecord[unidadcodigoa]).", 
 unidadnombre =  ".nulounimedida($ircRecord[unidadnombre]).", 
 unidadacra =  ".nulounimedida($ircRecord[unidadacra]).", 
 unidaddescri =  ".nulounimedida($ircRecord[unidaddescri])." 
	             WHERE 
 unidadcodigo =  "."'".$ircRecord[unidadcodigo]."'"; 
  
 $nuResult = pg_exec($nuConn,$sbSql); 
  
unset($sbSql); 
if (!$nuResult) 
{ 
// echo "Ha ocurrido un error \n"; 
// echo $php_errormsg; 
return e_db; 
} 
} 
else 
{ 
// echo "Fallo Intento de Conexion \n"; 
return e_connection; 
} 
return n1; 
} 
  
/* 
    Generado con generador Adsum (c). 
  
Funci�n: Consulmetaunimedida 
Descripcion: Consulta tipo de dato 
Parametros:  
$iintunidadcodigo Campo parte de la llave primaria 
Retorno:  
TRUE = True 
FALSE = Error de base de datos o de conecci�n 
Autor: ariascos-lfolaya 
Fecha: 13-December-2004 
Modificaci�n | Fecha | Autor 
*/ 
  
function consulmetaunimedida 
( 
$metaunimedida1,$metaunimedida2,$nuConn 
) 
  
{ 
define("uno",1); 
define("cero",0); 
  
  
 $sbSql = "SELECT DISTINCT(camptida) FROM campo WHERE campnomb= 
"."'".$metaunimedida1."'"; 
  
 $nuResult = pg_exec($nuConn,$sbSql); 
  
unset($sbSql); 
  
 $arr = pg_fetch_array($nuResult); 
 $fncvalida = "valida".$arr[0]; 
 $result = $fncvalida($metaunimedida2); 
if ($result > 0) 
{ 
return uno; 
} 
else 
{ 
return cero; 
} 
} 
  
/* 
    Generado con generador Adsum (c). 
  
Funci�n: InsRecordunimedida 
Descripcion: Adiciona registro a la Tabla 
Parametros:  
 $ircRecordRegistro a insertar en la tabla 
Retorno:  
TRUE = True 
FALSE = Error de base de datos o de conecci�n 
Autor: ariascos 
Fecha: 13-December-2004 
Modificaci�n | Fecha | Autor 
*/ 
  
function insrecordunimedida 
( 
$ircRecord,$nuConn 
) 
  
{ 
define("e_connection",-1); 
define("e_db",-2); 
define("e_empty",-3); 
define("cero",0); 
define("n1",1); 
  
  
if ($nuConn) 
{ 
  
 $sbSql = "INSERT INTO unimedida ( 
 unidadcodigo,  
 unidadnombre,  
 unidadacra,  
 unidaddescri )  
VALUES (". 
 nulounimedida($ircRecord[unidadcodigo]).",". 
 nulounimedida($ircRecord[unidadnombre]).",". 
 nulounimedida($ircRecord[unidadacra]).",". 
 nulounimedida($ircRecord[unidaddescri]).")"; 
  
  
 $nuResult = pg_exec($nuConn,$sbSql); 
  
unset($sbSql); 
if (!$nuResult) 
{ 
// echo "Ha ocurrido un error \n"; 
// echo $php_errormsg; 
return e_db; 
} 
} 
else 
{ 
// echo "Fallo Intento de Conexion \n"; 
return e_connection; 
} 
return n1; 
} 
  
/* 
    Generado con generador Adsum (c). 
  
Funci�n: DelRecordunimedida 
Descripcion: Borra el registro indicado de la Tabla 
Parametros:  
$iintunidadcodigo Campo parte de la llave primaria 
Retorno:  
TRUE = True 
FALSE = Error de base de datos o de conecci�n 
Autor: ariascos 
Fecha: 13-December-2004 
Modificaci�n | Fecha | Autor 
*/ 
  
function delrecordunimedida( 
$iintunidadcodigo,$nuConn 
) 
{ 
  
define("e_connection",-1); 
define("e_db",-2); 
define("e_empty",-3); 
define("cero",0); 
define("n1",1); 
  
if ($nuConn) 
{ 
 $sbSql = "DELETE FROM unimedida WHERE 
 unidadcodigo =  "."'".$iintunidadcodigo."'"; 
  
 $nuResult = pg_exec($nuConn,$sbSql); 
  
unset($sbSql); 
if (!$nuResult) 
{ 
// echo"Ha ocurrido un error \n"; 
// echo $php_errormsg; 
return  e_db; 
} 
} 
else 
{ 
// echo"Fallo Intento de Conexion \n"; 
return  e_connection; 
} 
return n1; 
} 
?> 
