<?php 
/*
-Todos los derechos reservados-
Propiedad intelectual de Adsum (c).
Funcion         : grabatareotherramie
Decripcion      : Valida la data a grabar y la lleva al paquete.
Parametros      : Descripicion
$iRegtareotherramie         Arreglo de datos.
$flagnuevotareotherramie    Bandera de validaci�n
Retorno         :
true	= 1
false	= 0
Autor           : ariascos
Escrito con     : WAG Adsum versi�n 3.1.1
Fecha           : 18082004
Historial de modificaciones
| Fecha | Motivo				| Autor 	|
*/
include_once ( '../bin/grabatareotherramie2.php');

for($k = 0; $k < count($sbregcod); $k++)
{
	$iRegtareotherramie[tarherrcodigo] = $tarherrcodigo;
	$iRegtareotherramie[tareotcodigo] = $codigotareot;
	$iRegtareotherramie[transhercodigo] = $sbregcod[$k];
	
	grabatareotherramie($iRegtareotherramie,$flagnuevotareotherramie,$campnomb);
}
?> 
