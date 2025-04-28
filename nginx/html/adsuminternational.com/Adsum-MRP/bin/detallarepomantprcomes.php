<?php
/*
 -Todos los derechos reservados-
 Propiedad intelectual de Adsum (c).
 Funcion         : grabareporte
 Decripcion      : Valida la data a grabar y la lleva al paquete.
 Parametros      : Descripicion
 $iRegreporte         Arreglo de datos.
 $flagnuevoreporte    Bandera de validacion
 Retorno         :
 true	= 1
 false	= 0
 Autor           : ariascos
 Escrito con     : WAG Adsum versi�n 3.1.1
 Fecha           : 18082004
 Historial de modificaciones
 | Fecha | Motivo				| Autor 	|
 */
	include ('../src/FunGen/cargainput.php');
	include ('../src/FunPerPriNiv/pktblusuario.php');
	include ('../src/FunGen/sesion/fncvalsesion.php');
	include ('../src/FunPerPriNiv/pktbltipotrab.php');
	include ('../src/FunPerPriNiv/pktblplanta.php');

	// -------- Se construye la consulta --------
	$ordtrafecini = $data_ano.'-'.$data_mes.'-01';
	$ordtrafecfin = $data_ano.'-'.$data_mes.'-'.strftime("%d", mktime(0, 0, 0, $data_mes + 1, 0, $data_ano));
	
	$idcon = fncconn ();
	$arrtipotrab = array_keys ( $_POST );
	$tiptra = array();	

	for($i = 0; $i < count($arrtipotrab); $i++) 
	{
		if (ereg("tipotrab", $arrtipotrab[$i])) 
			$tiptra[]= loadrecordtipotrab(substr($arrtipotrab[$i], 8) ,$idcon);
	}

	$reportnombre = "Reporte de Mantenimiento x OT Cerrada";
	$mes = date ( m );
	$ano = date ( Y );
	$hoy = date ( d );

	$plantas = explode(",", $arrplantas);
?>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link rel="stylesheet" type="text/css" href="temas/Noise/Style.css"> 
		<title>Informe mensual</title>
	</head>
	<body>
		<table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
  			<tr>
    			<td>
    				<table width="95%" border="0" cellspacing="0" cellpadding="0" align="center">
        				<tr><td colspan="2"><br><br><strong>INDICE DE MANTENIMIENTO PREVENTIVO Vs MANTENIMIENTO CORRECTIVO</strong></td></tr>
        				<?php 
							for($i = 0; $i < count($plantas); $i ++)
								echo '<tr><td width="11%">PLANTA</td><td>-&nbsp;' . cargaplantanombre ( $plantas [$i], $idcon ) . '&nbsp;&nbsp;</td></tr>';
						?>
						<tr>
          					<td>GENERADO POR</td>
          					<td><?php echo cargausuanombre ( $usuacodi, $idcon ) ?></td>
        				</tr>
        				<tr><td colspan="2">&nbsp;</td></tr>
        				<tr>
          					<td>FECHA</td>
          					<td>
          						<table width="40%" border="1" cellpadding="0" cellspacing="0" bordercolor="#5961A0">
            						<tr>
              							<td class="NoiseFieldCaptionTD"><font color="ffffff">DIA</font></td>
              							<td class="NoiseFieldCaptionTD"><font color="ffffff">MES</font></td>
              							<td class="NoiseFieldCaptionTD"><font color="ffffff">A&Ntilde;O</font></td>
            						</tr>
            						<tr>
						              	<td><?php echo $hoy  ?></td>
						              	<td><?php echo $mes  ?></td>
						              	<td><?php echo $ano  ?></td>
            						</tr>
          						</table>
          					</td>
        				</tr>
        				<tr>
          					<td>Periodo</td>
          					<td>Del&nbsp;&nbsp;&nbsp;<?php echo $ordtrafecini ?></td>
        				</tr>
        				<tr>
          					<td>&nbsp;</td>
          					<td>Al&nbsp;&nbsp;&nbsp;<?php echo $ordtrafecfin ?></td>
        				</tr>
        				<tr><td colspan="2">&nbsp;</td></tr>
        				<tr>
          					<td colspan="2">
          						<table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#5961A0">
            						<tr>
				            			<td class="NoiseFooterTD">TIPO DE TRABAJO</td>
				              			<td class="NoiseFooterTD">OT PREVENTIVAS</td>
				              			<td class="NoiseFooterTD">OT CORRECTIVAS</td>
            						</tr>
<?php 
	$arr_tipomant = array();	

	include '../src/FunPerPriNiv/pktbltipomant.php';
	include '../src/FunPerSecNiv/fncnumreg.php';
	include '../src/FunPerSecNiv/fncfetch.php';
	
	$rs_tipomant = fullscantipomant($idcon);
	$nr_tipomant = fncnumreg($rs_tipomant);
	
	for($a = 0; $a < $nr_tipomant; $a++):
		$rw_tipomant = fncfetch($rs_tipomant, $a);
		if(strstr($rw_tipomant[tipmannombre], 'PREV'))
			$arr_tipomant[] = array($rw_tipomant[tipmancodigo], 'PREV');
		elseif(strstr($rw_tipomant[tipmannombre], 'CORR'))
			$arr_tipomant[] = array($rw_tipomant[tipmancodigo], 'CORR');
	endfor;
	
	$Ot_total = array(0,0);
	
	
	for($g = 0; $g < count($tiptra); $g++)  
	{
		echo '<tr><td>'.$tiptra[$g][tiptranombre].'</td>';
		
		for($h = 0; $h < count($arr_tipomant); $h++)
		{
			$SqlOtCump = "	SELECT 
								COUNT(ot.ordtracodigo) AS number_ot 
							FROM 
								ot LEFT JOIN tareot ON (tareot.ordtracodigo = ot.ordtracodigo) 
								LEFT JOIN reportot ON (reportot.ordtracodigo = ot.ordtracodigo ) 
								LEFT JOIN cierreot ON (cierreot.reportcodigo = reportot.reportcodigo)
							WHERE 
								ot.tipmancodigo = '{$arr_tipomant[$h][0]}' AND ot.plantacodigo IN ({$arrplantas}) 
								AND ot.ordtrafecini BETWEEN '{$ordtrafecini}' AND '{$ordtrafecfin}' AND tareot.tareotsecuen = 0 
								AND tareot.tiptracodigo = '{$tiptra[$g][tiptracodigo]}' AND reportot.ordtracodigo IS NOT NULL 
								AND cierreot.cierotcodigo IS NOT NULL AND  cierreot.cierotfecfin BETWEEN '{$ordtrafecini}' AND '{$ordtrafecfin}'";
			if($arr_tipomant[$h][1] == 'PREV')
				$SqlOtCump .= " AND  ot.ordtranumpro IS NOT NULL"; 

			$nuResult = pg_exec($idcon, $SqlOtCump);//." GROUP BY reportot.tiptracodigo");
			echo '<td>';
			if ($nuResult) 
			{ 
				$nuCantRow = pg_numrows($nuResult); 				 
				if($nuCantRow > cero)
				{
					$ResQuePer = pg_fetch_row($nuResult, 0);
					echo $ResQuePer[0];
					$Ot_total[$h] = $Ot_total[$h] + $ResQuePer[0];
				}
				else
					echo '0';	
			}
			echo '</td>';
		}
		echo '</tr>';
	}
?>
	
								</table>
							</td>
						</tr>
						<tr><td colspan="2">&nbsp;</td></tr>
        				<tr>
          					<td colspan="2">
          						<table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#5961A0">
            						<tr>
              							<td class="NoiseErrorDataTD">TOTAL OT REALIZADAS</td>
              							<td colspan="3"><?php echo ($Ot_total[0] + $Ot_total[1]); ?></td>
            						</tr>
          						</table>
          					</td>
        				</tr>
        				<tr><td colspan="2">&nbsp;</td></tr>
        				<tr> 
          					<td colspan="2">
          						<table width="100%" border="0" cellpadding="0" cellspacing="0">
            						<tr>
            							<td width="50%">
          									<table width="90%" border="1" cellpadding="0" cellspacing="0" bordercolor="#5961A0" align="left">
			            						<tr>
			              							<td class="NoiseErrorDataTD">Formula % DE PREVENTIVAS</td>
			              							<td>∑ ( OT Preventivas ) * 100 / Total OT Realizadas</td>
			              						</tr>
			            						<tr>
			              							<td class="NoiseErrorDataTD">Formula % DE CORRECTIVAS</td>
			              							<td>∑ ( OT Correctivas ) * 100 / Total OT Realizadas</td>
			              						</tr>
			          						</table>
			          					</td>
			          					<td width="30%">
			          						<table width="90%" border="1" cellpadding="0" cellspacing="0" bordercolor="#5961A0" align="center">
			            						<tr>
			              							<td class="NoiseErrorDataTD">Porcentaje Aceptable PREVENTIVAS minimo</td>
			              							<td>80%</td>
			              						</tr>
			            						<tr>
			              							<td class="NoiseErrorDataTD">Porcentaje Aceptable CORRECTIVAS hasta</td>
			              							<td>20%</td>
			              						</tr>
			          						</table>
		          						</td>
              							<td width="20%">
			          						<table width="90%" border="1" cellpadding="0" cellspacing="0" bordercolor="#5961A0" align="right">
			            						<tr>
			              							<td class="NoiseErrorDataTD">% DE PREVENTIVAS</td>
			              							<td><?php if($Ot_total[0]) { echo round(($Ot_total[0] * 100) / ($Ot_total[0] + $Ot_total[1])); }else {echo '0';} ?> %</td>
			              						</tr>
			            						<tr>
			              							<td class="NoiseErrorDataTD">% DE CORRECTIVAS</td>
			              							<td><?php  if($Ot_total[1]) {  echo round(( $Ot_total[1] * 100) / ($Ot_total[0] + $Ot_total[1])); }else {echo '0';} ?> %</td>
			              						</tr>
			          						</table>
			          					</td>
		          					</tr>
		          				</table>
		          			</td>
        				</tr>
        				<tr><td colspan="2">&nbsp;</td></tr>
        				<tr><td colspan="2">OBSERVACIONES</td></tr>
        				<tr>
          					<td colspan="2">
          						<textarea name="text" cols="75" rows="7" wrap="VIRTUAL"></textarea>
          					</td>
        				</tr>
        				<tr><td colspan="2">&nbsp;</td></tr>
        				<tr><td colspan="2">&nbsp;</td></tr>
        				<tr>
          					<td>FIRMA</td>
          					<td><p>______________________________________<br>JEFE DE MANTENIMIENTO PLANTA</p></td>
        				</tr>
        				<tr><td colspan="2">&nbsp;</td></tr>
      				</table>
      				<div align="center">
      					<input type="image" name="imprimir" src="../img/imprimir.gif" onClick='window.print();'  width="86" height="18" alt="Imprimir" border="0">
      				</div>
      			</td>
  			</tr>
		</table>
	</body>
</html>
