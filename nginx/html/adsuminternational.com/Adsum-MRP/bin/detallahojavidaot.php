<?php
include_once ('../src/FunPerPriNiv/pktbltipomant.php');
include_once ('../src/FunPerPriNiv/pktbltipofall.php');
include_once ('../src/FunGen/fncdatediff.php');
/**
* Propiedad intelectual de Adsum (c).
*  Todos los derechos reservados
*
* Descripcion: Imprime las ordenes de trabajo
* 			   relacionadas al equipo indicado, en el
* 			   periodod de tiempo seleciconado. Adicionalmente,
* 			   despliega las horas de paro de maquina.
*
* Fecha:
* Autor:
*
* Historial de modificaciones
* ---------------------------
* Autor     | Fecha		| Motivo
*
*/
$idcon = fncconn();
//
$iRegot['plantacodigo'] =$plantacodigo;
$iRegot['sistemcodigo'] =$sistemcodigo;
$iRegot['equipocodigo'] = $equipo["equipocodigo"];
$iRegot['componcodigo'] = $componcodigo;
$iRegot['ordtrafecini'] = $fecini;
$iRegot['ordtrafecfin'] = $fecfin;

// Operadores para entonrar las ordenes de trabajo
// involucradas, teniendo en cuenta el rango de fechas
$iRegotop['plantacodigo'] ="=";
$iRegotop['sistemcodigo'] ="=";
$iRegotop['equipocodigo'] = "=";
$iRegotop['componcodigo'] = "=";
$iRegotop['ordtrafecini'] = ">=";
$iRegotop['ordtrafecfin'] = "<=";
//
$idresot = dinamicscanopot($iRegot, $iRegotop, $idcon);
// --

if (!is_numeric($idresot))
{
	$sumhours_total = 0;
	$sumhours_local = 0;
	$numregot = fncnumreg($idresot);

	ini_set("display_errors", 1);
	
	for ($i=0; $i<$numregot; $i++)
	{
		echo "<tr bgcolor='";

		if (($i % 2) == 0)
			echo "";

		echo "'>";
		
		$arrot = fncfetch($idresot, $i);
		$descrireport=loadrecordreportots($arrot['ordtracodigo'],$idcon);
		$tareots=loadrecordtareotord($arrot['ordtracodigo'],$idcon);
		$descriptarea=loadrecordtarea($tareots["tareacodigo"],$idcon);
		$tipomante = loadrecordtipomant($arrot["tipmancodigo"],$idcon);
		$tipofall = loadrecordtipofall($arrot["tipfalcodigo"],$idcon);
		
		echo "<td class='NoiseFooterTD'><B>&nbsp;C&oacute;digo:</B>&nbsp;{$arrot['ordtracodigo']}</td>";
		echo "<td class='NoiseFooterTD' colspan='2'><B>&nbsp;Fecha de Inicio:</B>&nbsp;{$arrot['ordtrafecini']} - {$arrot['ordtrahorini']}</td>";
		echo "<td class='NoiseFooterTD' colspan='2'><B>&nbsp;Fecha de Fin:</B>&nbsp;{$arrot['ordtrafecfin']} - {$arrot['ordtrahorfin']}</td>";
		echo "</tr>";
		
	
		
		$rsParaprod = loadrecordparaprodot($arrot['ordtracodigo'],$idcon);
		
		if($rsParaprod > 0)
		{
			echo "<tr bgcolor='";
	
			if (($i % 2) == 0)
				echo "";
	
			echo "'>";
			
			echo "<td class='NoiseErrorDataTD'><b>&nbsp;Parada de Maqina</b></td>";
			echo "<td class='NoiseErrorDataTD' colspan='2'><b>&nbsp;Fecha de Inicio:&nbsp;{$rsParaprod['parprofecini']} - {$rsParaprod['parprohorini']}</b></td>";
			echo "<td class='NoiseErrorDataTD' colspan='2'><b>&nbsp;Fecha de Fin:&nbsp;{$rsParaprod['parprofecfin']} - {$rsParaprod['parprohorfin']}</b></td>";
			echo "</tr>";
			
			$minutos_parada = datediff("n", $rsParaprod['parprofecini'].' '.$rsParaprod['parprohorini'],$rsParaprod['parprofecfin'].' '.$rsParaprod['parprohorfin']);
			
		}
		
		
		if($descrireport > 0)
		{
			echo "<tr>";
			echo "<td class='NoiseFooterTD'>&nbsp;</td>";
			echo "<td class='NoiseFooterTD' colspan='2'><B>&nbsp;Fecha de reporte:</B>&nbsp;{$descrireport['reportfecha']} - {$descrireport['reporthora']}</td>";
			echo "<td class='NoiseFooterTD' colspan='2'>&nbsp;</td>";
			echo "</tr>";
		}
		
		
		echo "<tr bgcolor='";

		if (($i % 2) == 0)
			echo "";

		echo "'>";
		echo "<td class='NoiseFooterTD'><B>&nbsp;Descripci&oacute;n del Da&ntilde;o:</B></td><td>
			  {$arrot['ordtradescri']}</td><td class='NoiseFooterTD'><B>&nbsp;Tipo de mantenimiento:</B></td><td>$tipomante[tipmannombre]</td>";
		echo "</tr>";
		
		if ($arrtareot['tareotnota']==0 || $arrtareot['tareotnota']=='' || $arrtareot['tareotnota']==null) 
		{
			echo "<tr>";
			echo "<td class='NoiseFooterTD'><B>&nbsp;Trabajo Realizado:</B></td><td>
			  {$descriptarea["tareanombre"]}</td><td class='NoiseFooterTD'><B>&nbsp;Descripci&oacute;n del trabajo:</B></td><td>$tareots[tareotnota]</td>";
			echo "</tr>";
			echo "<tr><td class='NoiseFooterTD'><B>&nbsp;Tipo de falla:</B></td><td>$tipofall[tipfalnombre]</td></tr>";
		}
		else 
		{
			echo "<tr>";
			echo "<td colspan='4' class='NoiseFooterTD'><B>&nbsp;Trabajo Realizado:</B><br />
			  {$arrtareot['tareotnota']}</td>";
			echo "</tr>";
		}
		
		
		echo "<tr>";
		echo "<td colspan='3'><B>Descripci&oacute;n del Reporte:</B><br />
			  $descrireport[reportdescri]</td>";
		echo "</tr>";

		//--
		$iRegtareot['ordtracodigo']   = $arrot['ordtracodigo'];
		$iRegtareotop['ordtracodigo'] = "=";

		$idrestareot = dinamicscanoptareot($iRegtareot, $iRegtareotop, $idcon);

		if (!is_numeric($idrestareot))
		{
			$numregtareot = fncnumreg($idrestareot);

			for ($j=0; $j<$numregtareot; $j++)
			{
				$arrtareot = fncfetch($idrestareot, $j);
				$arrotestado = loadrecordotestado($arrtareot['otestacodigo'], $idcon);
				
				if (($arrotestado['otestatipo'] != 5 && $arrotestado['otestatipo'] != 4) && (!empty($arrtareot['tareottiedur'])))
				{
					$sumhours_total += $arrtareot['tareottiedur'] * 60;
					$sumhours_local += $arrtareot['tareottiedur'] * 60;
				}
			}
		}

//		if (!empty($sumhours_local))
//		{
			echo "<tr bgcolor='";

			if (($i % 2) == 0)
				echo "#F9FAFF";

			echo "'>";
			if ($minutos_parada)
				echo "<td bgcolor='#D8D9E6' colspan='4'><B>&nbsp;Horas de paro de Equipo:&nbsp;</B>$minutos_parada Minutos</td>";
			
				
			unset($minutos_parada);	
//			echo "<td bgcolor='#D8D9E6' colspan='4'><B>&nbsp;Horas de ejecucion del trabajo:&nbsp;</B>$sumhours_local Minutos</td>";
			
			echo "</tr>";

			echo "<tr><td bgcolor='#D8D9E6' colspan='4'><B>&nbsp;Horas de ejecucion del trabajo:&nbsp;</B>$sumhours_local Minutos</td></tr>";
			echo "<tr>"; 
		        echo "<td colspan='4'><hr></td>";
		    echo "</tr>";
//		}
		$sumhours_local = 0;
	}

	if (!empty($sumhours_total))
	{
		echo "<tr bgcolor='#5961A0'>";
		echo "<td colspan='4'>";
		echo "<FONT face='Verdana' color='White'>";
		echo "&nbsp;Horas totales de paro de equipo, para el periodo
		$fecini - $fecfin:<B>&nbsp;$sumhours_total Minutos</B>";
		echo "</FONT>";
		echo "</td>";
		echo "</tr>";
		echo "<tr>"; 
			echo "<td colspan='4'><hr></td>";
		echo "</tr>";
	}
}
else {
	echo "<tr>";
	echo "<td colspan='3'>&nbsp;No existen Ordenes de Trabajo relacionadas
	      al Equipo indicado en el rango de Fechas Especificado</td>";
	echo "</tr>";
		echo "<tr>"; 
			echo "<td colspan='4'><hr></td>";
		echo "</tr>";
}
fncclose($idcon);
?>