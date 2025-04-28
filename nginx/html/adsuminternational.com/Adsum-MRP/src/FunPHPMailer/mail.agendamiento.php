<?php 
//	ini_set('display_errors', 1);

	function send_agendamiento($ordtracodigo, $sbreg, &$html)
	{
		
//		include ( '../FunPerSecNiv/fncnumreg.php');
//		include ( '../FunPerSecNiv/fncfetch.php');
//		include ( '../FunPerSecNiv/fncconn.php');
//		include ( '../FunPerSecNiv/fncclose.php');
		
//		include ('../FunPerPriNiv/pktblusuario.php');
//		include ('../FunPerPriNiv/pktblcargo.php');
//		include ('../FunPerPriNiv/pktblot.php');
		include ('../src/FunPerPriNiv/pktblvistamaxtareot.php');
//		include ('../FunPerPriNiv/pktblsoliserv.php');
		
		include ('../src/FunPerPriNiv/pktbltiposolicitud.php');
//		include ('../FunPerPriNiv/pktblclienteot.php');
//		include ('../FunPerPriNiv/pktblequipo.php');
//		include ('../FunPerPriNiv/pktbltipoequipo.php');
		
//		include ('../FunGen/cargainput.php');
	
		if($ordtracodigo)
		{
			$idcon = fncconn();
			$rs_ot = loadrecordot($ordtracodigo, $idcon);
			$rs_involucrados = loadrecordtareottecnicos($ordtracodigo, $idcon);
			
			$rs_soliserv = loadrecordsoliserv($rs_ot['solsercodigo'], $idcon);
			$clienteot = loadrecordclienteot($rs_soliserv['clientcodigo'], $idcon);
			
			$rs_equipo = loadrecordequipo($rs_soliserv['equipocodigo'], $idcon);
		}

		$html .= str_replace('[s]', '<br>', $sbreg['head_agot_pagina']);
		//-------------/---------------//
		
		if($clienteot['sistemcodigo'])
		{
			$sbregclientedato = loadrecordsistema($clienteot['sistemcodigo'], $idcon);
			$NOMBRE_CLIENTE_DIRECTO = $sbregclientedato[sistemcodigo].' - '.$sbregclientedato[sistemnombre];
		}
		else
		{
			$sbregclientedato = loadrecordusuario($clienteot['usuacodi'], $idcon);
			$NOMBRE_CLIENTE_DIRECTO = $sbregclientedato[usuanombre];
		}
			
		$NOMBRE_CLIENTE_CONTACTO = $clienteot[clientcontac];
		$NUMERO_DE_ORDEN = $ordtracodigo;
		$NUMERO_SOLICITUD = $rs_soliserv['solseridpadr'];
		
		
		$html .= '		<table width="800" border="0" align="center" cellpadding="1" cellspacing="1">'."\n";
		$html .= '			<tr>'."\n";
		$html .= '	    		<td>'."\n";
		$html .= '	    			<table width="100%" border="0" cellpadding="0" cellspacing="0">'."\n";
		$html .= '						<tr>'."\n";
		$html .= '					        <td><div align="left"><img src="'.$sbreg['url'].'/img/adsumcuasipequeno.jpg" ></div></td>'."\n";
		$html .= '					    </tr>'."\n";
		$html .= '	    			</table>'."\n";
		$html .= '	    		</td>'."\n";
		$html .= '	 		</tr>'."\n";	
		$html .= '			<tr>'."\n";
		$html .= '	   			<td>'."\n";
		$html .= '					<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center">'."\n";
		$html .= ' 						<tr><td class="borde-head">&nbsp;Datos del servicio</td></tr>'."\n";
		$html .= ' 						<tr>'."\n";
		$html .= '							<td>'."\n";
		$html .= '								<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" class="borde-intabla">'."\n";
		$html .= '				      				<tr>'."\n";
		$html .= '					        			<td width="15%" class="borde-datcell">&nbsp;Numero de solicitud</td>'."\n";
		$html .= '					        			<td class="borde-datcell">&nbsp;'.$rs_soliserv['solseridpadr'].'</td>'."\n";
		$html .= '				      				</tr>'."\n";
		$html .= '				      				<tr>'."\n";
		$html .= '					        			<td width="15%" class="borde-datcell">&nbsp;Numero de orden</td>'."\n";
		$html .= '					        			<td class="borde-datcell">&nbsp;'.$ordtracodigo.'</td>'."\n";
		$html .= '				      				</tr>'."\n";
		$html .= '									<tr>'."\n";
		$html .= '			            				<td width="15%" class="borde-incell">&nbsp;Fecha/hora visita</td>'."\n";
		$html .= '			            				<td class="borde-datcell">&nbsp;<b>'.date('Y-m-d h:i a', strtotime($rs_ot['ordtrafecini'].' '.$rs_ot['ordtrahorini'])).'</b></td>'."\n";
		$html .= '			          				</tr>'."\n";
		$html .= '				      				<tr><td colspan="2" class="NoiseErrorDataTD"></td></tr>'."\n";
		$html .= '				       			</table>'."\n";
		$html .= '				       			<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" class="borde-intabla">'."\n";
		$html .= '				          			<tr>'."\n";
		$html .= '				            			<td width="15%" class="borde-incell">&nbsp;Solicitud</td>'."\n";
		$html .= '				            			<td class="borde-datcell">&nbsp;'.cargatipsolnombre($rs_soliserv['tipsolcodigo'], $idcon).'</td>'."\n";
		$html .= '				          			</tr>'."\n";
		$html .= '				          			<tr>'."\n";
		$html .= '				            			<td width="15%" class="borde-incell">&nbsp;Tipo equipo</td>'."\n";
		$html .= '				            			<td class="borde-datcell">&nbsp;'.cargatipequnombre($rs_equipo['tipequcodigo'], $idcon).'</td>'."\n";
		$html .= '				          			</tr>'."\n";
		$html .= '				          			<tr>'."\n";
		$html .= '				            			<td width="15%" class="borde-incell">&nbsp;Equipo</td>'."\n";
		$html .= '				            			<td class="borde-datcell">&nbsp;'.$rs_equipo['equiponombre'].'</td>'."\n";
		$html .= '				          			</tr>'."\n";
		$html .= '				          			<tr>'."\n";
		$html .= '				            			<td width="15%" class="borde-incell">&nbsp;Marca</td>'."\n";
		$html .= '				            			<td class="borde-datcell">&nbsp;'.$rs_equipo['equipomarca'].'</td>'."\n";
		$html .= '				          			</tr>'."\n";
		$html .= '				          			<tr>'."\n";
		$html .= '				            			<td width="15%" class="borde-incell">&nbsp;Referencia</td>'."\n";
		$html .= '				            			<td class="borde-datcell">&nbsp;'.$rs_equipo['codigosrf'].'</td>'."\n";
		$html .= '				          			</tr>'."\n";		
		$html .= '				          			<tr><td colspan="2" class="borde-incell">&nbsp;Descripci&oacute;n</td></tr>'."\n";
		$html .= '				          			<tr><td colspan="2" class="borde-datcell">&nbsp;'.$rs_soliserv['solserdescri'].'</td></tr>'."\n";
		$html .= '	           						<tr><td colspan="2" class="NoiseErrorDataTD"></td></tr>'."\n";
		$html .= '           					</table>'."\n";
		$html .= '			       			</td>'."\n";
		$html .= '			       		</tr>'."\n";
		$html .= '			       	</table>'."\n";
	    $html .= '   			</td>'."\n";
		$html .= '			<tr>'."\n";
	    $html .= ' 		</table>'."\n";
	 	$html .= '		<br>'."\n";
	    $html .= ' 		<hr width="100%">'."\n";
	    $html .= '		<br>'."\n";
	    $html .= str_replace('[s]', '<br>', $sbreg['pie_pagina'])."\n";
	    
	    $html = str_replace('{{NOMBRE_CLIENTE_DIRECTO}}', $NOMBRE_CLIENTE_DIRECTO, $html);
		$html = str_replace('{{NOMBRE_CLIENTE_CONTACTO}}', $NOMBRE_CLIENTE_CONTACTO, $html);
		$html = str_replace('{{NUMERO_SOLICITUD}}', $NUMERO_SOLICITUD, $html);
		$html = str_replace('{{NUMERO_DE_ORDEN}}', $NUMERO_DE_ORDEN, $html);
		$html = str_replace('{{FECHA_AGENDAMIENTO}}', date('Y-m-d h:i a', strtotime($rs_ot['ordtrafecini'].' '.$rs_ot['ordtrahorini'])), $html);
	}