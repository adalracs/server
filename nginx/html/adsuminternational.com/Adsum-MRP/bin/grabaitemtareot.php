<?php 
/*
-Todos los derechos reservados-
Propiedad intelectual de Adsum (c).
Funcion         : grabaitemtareot
Decripcion      : Valida la data a grabar y la lleva al paquete.
Parametros      : Descripicion
$iRegitemtareot         Arreglo de datos.
$flagnuevoitemtareot    Bandera de validaci�n
Retorno         :
true	= 1
false	= 0
Autor           : ariascos
Escrito con     : WAG Adsum versi�n 3.1.1
Fecha           : 18082004
Historial de modificaciones
| Fecha | Motivo				| Autor 	|
*/

//include ( '../src/FunGen/fncnumprox.php');
//include ( '../src/FunGen/fncnumact.php');
//include ( '../def/tipocampo.php');
include_once ( '../bin/grabaitemtareot2.php');
//include ( '../src/FunGen/buscacaracter.php');
//include ( '../src/FunGen/fncmsgerror.php');

for($l = 0; $l < count($sbregcod); $l++)
{
	$iRegitemtareot[itemtarecodigo] = $itemtarecodigo;
	$iRegitemtareot[tareotcodigo] = $codigotareot;
	$iRegitemtareot[transitecodigo] = $sbregcod[$l];
	$iRegitemtareot[numitem] = $l==count($sbregcod)-1?99:$l+1;

	grabaitemtareot($iRegitemtareot,$flagnuevoitemtareot,$campnomb);
}
?> 
