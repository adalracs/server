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
$progracodigo = trim(str_replace("|n","",$arr_cod[1]));

$idcon = fncconn();
$sbregProgram = loadrecordprogramacionserial($progracodigo, $idcon);//ok

if($sbregProgram)
{
	$plantacodigo = $sbregProgram['plantacodigo'];
	$sistemcodigo = $sbregProgram['sistemcodigo'];
	$tipmancodigo = $sbregProgram['tipmancodigo'];
}

$equiponombre = cargaequiponombre($equipocodigo, $idcon);
$plantanombre = cargaplantanombre($plantacodigo, $idcon);
$sistemnombre = cargasistemnombre($sistemcodigo, $idcon);
$tipmannombre = cargatipmannombre1($tipmancodigo, $idcon);
$tipmednombre = cargatipmnombre($sbregProgram['tipmedcodigo'], $idcon);
$nombre = cargausuanombre($sbregProgram['usuacodi'], $idcon);
$prioridad = cargapriorinombre($sbregProgram['prioricodigo'], $idcon);

for($i = 0;$i < count($sbregProgram); $i++)
{
	if ($sbregProgram['componcodigo'] != null)
		$nombreCom = cargacomponnombre($sbregProgram['componcodigo'],$idcon);
	else 
		$nombreCom = "-----";
		
	if($sbregProgram[$i]['prograrepot'] == 1)
		$repot = "Activo";
	else 
		$repot = "Inactivo";
		
	if($sbregProgram[$i]['prograacti'] == 1)
		$acti = "Activo";
	else 
		$acti = "Inactivo";
		
	if (($j % 2) == 0){
		$sbListaprogram .= '<tr class="NoiseFooterTD">'."\n";
	}else{
		$sbListaprogram .= '<tr class="NoiseDataTD">'."\n";
	}
	
	$sbListaprogram .= '<td style="font-size: 90%;">'.$sbregProgram[$i]['progracodigo'].'</td>'."\n";
	$sbListaprogram .= '<td style="font-size: 90%;">'.$sbregProgram[$i]['tareanombre'].'</td>'."\n";
	$sbListaprogram .= '<td style="font-size: 90%;">'.$sbregProgram[$i]['progranota'].'</td>'."\n";
	$sbListaprogram .= '<td style="font-size: 90%;">'.$nombreCom.'</td>'."\n";
	$sbListaprogram .= '<td style="font-size: 90%;">'.$sbregProgram[$i]['tiptranombre'].'</td>'."\n";
	$sbListaprogram .= '<td style="font-size: 90%;">'.$sbregProgram[$i]['progratiedur'].'</td>'."\n";
	$sbListaprogram .= '<td style="font-size: 90%;">'.$sbregProgram[$i]['prografrecue'].'</td>'."\n";
	//$sbListaprogram .= '<td style="font-size: 90%;">'.'</td>'."\n";
	$sbListaprogram .= '<td style="font-size: 90%;">'.$sbregProgram[$i]['tipmednombre'].'</td>'."\n";
	//$sbListaprogram .= '<td style="font-size: 90%;">'.$repot.'</td>'."\n";
	$sbListaprogram .= '<td style="font-size: 90%;">'.$acti.'</td>'."\n";
	$sbListaprogram .= '</tr>'."\n";
	
	unset($nombreCom);
}

?>