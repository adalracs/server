<?php
/**
* Propiedad intelectual de Adsum (c).
*  Todos los derechos reservados
*
* Descripcion: Despliega las normas de seguridad
* 			   relacionadas a un equipo en particular
*
* Fecha: 09122006
* Autor: mstroh
*
* Historial de modificaciones
* ---------------------------
* Autor     | Fecha		| Motivo
*
*/
$idcon = fncconn();

$iRegnormaseguriequipo['equipocodigo'] = $arrequipo['equipocodigo'];
$idresnormaseguriequipo = dinamicscannormaseguriequipo($iRegnormaseguriequipo, $idcon);
// Almacena los codigos de las normas de seguridad
if (!is_numeric($idresnormaseguriequipo))
{
	$numregnormaseguriequipo = fncnumreg($idresnormaseguriequipo);

	for ($i=0; $i<$numregnormaseguriequipo; $i++)
	{
		$arrnormaseguriequipo = fncfetch($idresnormaseguriequipo, $i);
		$arrCodNormaSeguri[] = $arrnormaseguriequipo['norsegcodigo'];
	}
}
if (!empty($arrCodNormaSeguri))
{
	echo "<tr bgcolor='#E8F0F6'>";
	echo "<td colspan='3'>Normas de seguridad</td>";
	echo "</tr>";

	foreach ($arrCodNormaSeguri as $cod)
	{
		echo "<tr>";
		$arrNormaSeguri = loadrecordnormaseguri($cod, $idcon);

		if (is_array($arrNormaSeguri))
		{
			echo "<td><B>$arrNormaSeguri[norsegnombre]</B></td>";
			echo "<td colspan='2'>$arrNormaSeguri[norsegdescri]</td>";
		}
		echo "</tr>";
	}
}
fncclose($idcon);
?>