<?php 
//	ini_set('display_errors', 1);
//	include ( '../FunPerSecNiv/fncnumreg.php');
//	include ( '../FunPerSecNiv/fncfetch.php');
//	include ( '../FunPerSecNiv/fncconn.php');
//	include ( '../FunPerSecNiv/fncclose.php');
	
//	include ('../FunPerPriNiv/pktblusuario.php');
//	include ('../FunPerPriNiv/pktblcargo.php');
//	include ('../FunPerPriNiv/pktblot.php');
//	include ('../FunPerPriNiv/pktblvistamaxtareot.php');
//	include ('../FunPerPriNiv/pktblsoliserv.php');
	
//	include ('../FunPerPriNiv/pktbltiposolicitud.php');
//	include ('../FunPerPriNiv/pktblclienteot.php');
//	include ('../FunPerPriNiv/pktblequipo.php');
//	include ('../FunPerPriNiv/pktbltipoequipo.php');
	
//	include ('../FunGen/cargainput.php');
	
	function send_asignatecnico($solseridpadr, $sbreg, &$html)
	{
		$idcon = fncconn();
		$rs_gsoliserv = loadrecordsoliservgrup($solseridpadr, $idcon);
		
		
		//-------------/---------------//
		$html .= str_replace('[s]', '<br>', $sbreg['head_asot_pagina']);
			
		$html .= '		<br><br>'."\n";
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
		
		for($w = 0; $w < count($rs_gsoliserv); $w++)
		{
			$ordtracodigo = loadrecordotsoliserv($rs_gsoliserv[$w]['solsercodigo'], $idcon);
						
			if($ordtracodigo)
			{
				$idcon = fncconn();
				$rs_ot = loadrecordot($ordtracodigo, $idcon);
				$rs_involucrados = loadrecordtareottecnicos($ordtracodigo, $idcon);
				
				$rs_soliserv = loadrecordsoliserv($rs_ot['solsercodigo'], $idcon);
				$clienteot = loadrecordclienteot($rs_soliserv['clientcodigo'], $idcon);
				
				$rs_equipo = loadrecordequipo($rs_soliserv['equipocodigo'], $idcon);
			}

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
			$html .= '				            			<td class="borde-datcell">&nbsp;'.$rs_equipo['equiponombre'].' / '.$rs_equipo['codigosrf'].'</td>'."\n";
			$html .= '				          			</tr>'."\n";
			$html .= '				          			<tr>'."\n";
			$html .= '				            			<td width="15%" class="borde-incell">&nbsp;Marca</td>'."\n";
			$html .= '				            			<td class="borde-datcell">&nbsp;'.$rs_equipo['equipomarca'].'</td>'."\n";
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
			$html .= '   		</tr>'."\n";
			$html .= '	    		<td>'."\n";
			$html .= '					<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center">'."\n";
			$html .= '	      				<tr><td class="borde-head">&nbsp;Encargado(s) de atender la solicitud</td></tr>'."\n";
		
			
			$sbreg_encargado = loadrecordusuario($rs_involucrados['lider'], $idcon);
			$oldusuaimage = 'logo.jpeg';
			//-----
		   	$arr_ext = array('.gif','.jpg','.jpeg','.png','.bmp','.GIF','.JPG','.JPEG','.PNG','.BMP');
		   	for($i = 0; $i < count($arr_ext); $i++)
		   	{
			   	if(file_exists('../img/pics_usuarios/'.$rs_involucrados['lider'].$arr_ext[$i]))
			   	{
			   		$oldusuaimage = $sbreg_encargado['usuacodi'].$arr_ext[$i];
			   		break;
			   	}
		   	}
		   	//-----
			$html .= '	      				<tr>'."\n";
			$html .= '							<td>'."\n";	
			$html .= '								<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" class="borde-intabla">'."\n";
			$html .= '				      				<tr>'."\n";
			$html .= '					        			<td class="borde-datcell" rowspan="7" width="30%" align="center"><img width="150" height="150" src="'.$sbreg['url'].'/img/pics_usuarios/'.$oldusuaimage.'"></td>'."\n";
			$html .= '					        			<td class="borde-incell" width="15%">&nbsp;Nombre</td>'."\n";
			$html .= '		           						<td class="borde-datcell" width="55%">&nbsp;'.$sbreg_encargado['usuanombre'].' '.$sbreg_encargado['usuapriape'].' '.$sbreg_encargado['usuasegape'].'</td>'."\n";
			$html .= '				      				</tr>'."\n";
			$html .= '				      				<tr>'."\n";
			$html .= '					        			<td class="borde-incell">&nbsp;Cargo</td>'."\n";
			$html .= '					        			<td class="borde-datcell">&nbsp;'.cargacargonombre($sbreg_encargado['cargocodigo'], $idcon).'</td>'."\n";
			$html .= '				      				</tr>'."\n";
			$html .= '				      				<tr>'."\n";
			$html .= '					        			<td class="borde-incell">&nbsp;Cedula</td>'."\n";
			$html .= '					        			<td class="borde-datcell">&nbsp;'.$sbreg_encargado['usuadocume'].'</td>'."\n";
			$html .= '				      				</tr>'."\n";
			$html .= '				      				<tr><td class="borde-incell" colspan="2">&nbsp;Encargado</td></tr>'."\n";
			$html .= '				      				<tr><td class="borde-incell" colspan="2" rowspan="4">&nbsp;</td></tr>'."\n";
			$html .= '				      				<tr><td colspan="3" class="NoiseErrorDataTD"></td></tr>'."\n";
			$html .= '				       			</table>'."\n";
			$html .= '			       			</td>'."\n";
			$html .= '			       		</tr>'."\n";
	
	
			for($a = 0; $a < count($rs_involucrados['auxiliar']); $a++):
			
				$sbreg_encargado = loadrecordusuario($rs_involucrados['auxiliar'][$a], $idcon);
				$oldusuaimage = 'logo.jpeg';
				//-----
			   	for($i = 0; $i < count($arr_ext); $i++)
			   	{
				   	if(file_exists('../img/pics_usuarios/'.$rs_involucrados['auxiliar'][$a].$arr_ext[$i]))
				   	{
				   		$oldusuaimage = $sbreg_encargado['usuacodi'].$arr_ext[$i];
				   		break;
				   	}
			   	}
			   	//-----
			
				$html .= '	      				<tr>'."\n";
				$html .= '							<td>'."\n";
				$html .= '								<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" class="borde-intabla">'."\n";
				$html .= '				      				<tr>'."\n";
				$html .= '					        			<td class="borde-datcell" rowspan="7" width="30%" align="center"><img width="150" height="150" src="'.$sbreg['url'].'/img/pics_usuarios/'.$oldusuaimage.'"></td>'."\n";
				$html .= '					        			<td class="borde-incell" width="15%">&nbsp;Nombre</td>'."\n";
				$html .= '		           						<td class="borde-datcell" width="55%">&nbsp;'.$sbreg_encargado['usuanombre'].' '.$sbreg_encargado['usuapriape'].' '.$sbreg_encargado['usuasegape'].'</td>'."\n";
				$html .= '				      				</tr>'."\n";
				$html .= '				      				<tr>'."\n";
				$html .= '					        			<td class="borde-incell">&nbsp;Cargo</td>'."\n";
				$html .= '					        			<td class="borde-datcell">&nbsp;'.cargacargonombre($sbreg_encargado['cargocodigo'], $idcon).'</td>'."\n";
				$html .= '				      				</tr>'."\n";
				$html .= '				      				<tr>'."\n";
				$html .= '					        			<td class="borde-incell">&nbsp;Cedula</td>'."\n";
				$html .= '					        			<td class="borde-datcell">&nbsp;'.$sbreg_encargado['usuadocume'].'</td>'."\n";
				$html .= '				      				</tr>'."\n";				
				$html .= '				      				<tr><td class="borde-incell" colspan="2">&nbsp;Auxiliar</td></tr>'."\n";
				$html .= '				      				<tr><td class="borde-incell" colspan="2" rowspan="4">&nbsp;</td></tr>'."\n";
				$html .= '				      				<tr><td colspan="3" class="NoiseErrorDataTD"></td></tr>'."\n";
				$html .= '				       			</table>'."\n";
				$html .= '			       			</td>'."\n";
				$html .= '			       		</tr>'."\n";
			endfor;
	
			$html .= '			       	</table>'."\n";
		    $html .= '   			</td>'."\n";
		    $html .= '   		</tr>'."\n";
		    $html .= '   		<tr><td>&nbsp;</td></tr>'."\n";
		}
	    $html .= ' 		</table>'."\n";
	    $html .= '		<br>'."\n";
	    $html .= ' 		<hr width="100%">'."\n";
	    $html .= '		<br>'."\n";
	    $html .= str_replace('[s]', '<br>', $sbreg['pie_pagina'])."\n";
	    
	    $html = str_replace('{{NOMBRE_CLIENTE_DIRECTO}}', $NOMBRE_CLIENTE_DIRECTO, $html);
	    $html = str_replace('{{NOMBRE_CLIENTE_CONTACTO}}', $NOMBRE_CLIENTE_CONTACTO, $html);
	    $html = str_replace('{{NUMERO_SOLICITUD}}', $solseridpadr, $html);
	}