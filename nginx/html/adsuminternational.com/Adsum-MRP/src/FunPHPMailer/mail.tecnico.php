<?php 
	function send_tecnico($ordtracodigo, $sbreg, &$html)
	{
		//	include ( '../FunPerSecNiv/fncnumreg.php');
		//	include ( '../FunPerSecNiv/fncfetch.php');
		//	include ( '../FunPerSecNiv/fncconn.php');
		//	include ( '../FunPerSecNiv/fncclose.php');
			
		//	include ('../FunPerPriNiv/pktblusuario.php');
		//	include ('../FunPerPriNiv/pktblcargo.php');
		//	include ('../FunPerPriNiv/pktblot.php');
			include ('../src/FunPerPriNiv/pktblvistamaxtareot.php');
		//	include ('../FunPerPriNiv/pktblsoliserv.php');
			include ('../src/FunPerPriNiv/pktbltiposolicitud.php');
		//	include ('../FunPerPriNiv/pktblclienteot.php');
		//	include ('../FunPerPriNiv/pktblciudad.php');
		//	include ('../FunPerPriNiv/pktbldepartamento.php');
		//	include ('../FunPerPriNiv/pktblequipo.php');
			include ('../src/FunPerPriNiv/pktbltipoequipo.php');
		//	include ('../FunPerPriNiv/pktblsistema.php');
			include ('../src/FunPerPriNiv/pktblotestado.php');
			include ('../src/FunPerPriNiv/pktblestado.php');
			
		//	include ('../FunGen/cargainput.php');
		
		
		if($ordtracodigo)
		{
			$idcon = fncconn();
			$rs_ot = loadrecordot($ordtracodigo, $idcon);
			
			$rs_vistamaxtareot = loadrecordvistamaxtareotall($ordtracodigo, $idcon);
			$rs_involucrados = loadrecordtareottecnicos($ordtracodigo, $idcon);
			
			/****/
			
			
			/****/
			$encargado = $rs_vistamaxtareot['usuacodi'];
			$solsercodigo = $rs_ot['solsercodigo'];
			$oldotestacodigo = $rs_vistamaxtareot['otestacodigo'];
			
			$rs_soliserv = loadrecordsoliserv($solsercodigo, $idcon);
			$rs_equipo = loadrecordequipo($rs_soliserv['equipocodigo'], $idcon);
			$sbregusuario = loadrecordusuario($rs_soliserv['usuacodi'], $idcon);
			$sbregsistema = loadrecordsistema($rs_soliserv['sistemcodigo'], $idcon);
			$sbregcliente = loadrecordclienteot($rs_soliserv['clientcodigo'], $idcon);
			$sbregciudad = loadrecordciudad($sbregcliente['ciudadcodigo'], $idcon);
			
			
			
			if(!$rs_soliserv['sistemcodigo'])
				$solicitud = 1;
		}

		$html .= str_replace('[s]', '<br>', $sbreg['head_asot_pagina_tc']);
		$html .= '		<br><br>';
		$html .= '		<table width="800" border="0" cellpadding="1" cellspacing="1">';
		$html .= '			<tr>'."\n";
		$html .= '	    		<td>'."\n";
		$html .= '	    			<table width="100%" border="0" cellpadding="0" cellspacing="0">'."\n";
		$html .= '						<tr>'."\n";
		$html .= '					        <td><div align="left"><img src="'.$sbreg['url'].'/img/adsumcuasipequeno.jpg" ></div></td>'."\n";
		$html .= '					    </tr>'."\n";
		$html .= '	    			</table>'."\n";
		$html .= '	    		</td>'."\n";
		$html .= '	 		</tr>'."\n";	
	  	$html .= '			<tr>';
	  	$html .= '				<td>';
		$html .= '  				<table width="100%" border="0" cellpadding="1" cellspacing="1">';
		$html .= '  					<tr><td colspan="2"></td></tr>';
		$html .= '  					<tr>';
		$html .= '		    				<td width="50%"><span class="Estilo6 Estilo10">Fecha de Generaci&oacute;n&nbsp;&nbsp;&nbsp;'.date("Y-m-d h:i a", strtotime($rs_ot["ordtrafecgen"]." ".$rs_ot["ordtrahorgen"])).'</span></td>';
		$html .= '		    				<td width="50%"><span class="Estilo6 Estilo10">Num. OT:&nbsp;&nbsp;&nbsp;'.$ordtracodigo.'</span></td>';
		$html .= '	    				</tr>';
		$html .= '	    				<tr><td colspan="2" class="borde-line">&nbsp;</td></tr>';
		$html .= '	    			</table>';
	    $html .= '				</td>';
	  	$html .= '			</tr>';
	  	$html .= '			<tr>';
	  	$html .= '				<td>';
	  	$html .= '					<table width="100%" border="0" cellspacing="1" cellpadding="1">';
	  	$html .= '						<tr><td colspan="4"><span class="Estilo6 Estilo10">&nbsp;<b>Datos de solicitud</b></span></td></tr>';
	    $html .= '  					<tr>';
	    $html .= '    						<td width="15%"><span class="Estilo6 Estilo10">&nbsp;Solicitante</span></td>';
	    $html .= '    						<td width="45%"><span class="Estilo6 Estilo10">&nbsp;'.$sbregusuario['usuanombre'].' '.$sbregusuario['usuapriape'].' '.$sbregusuario['usuasegape'].'</span></td>';
	    $html .= '    						<td width="15%"><span class="Estilo6 Estilo10">&nbsp;Cargo</span></td>';
	    $html .= '    						<td width="25%"><span class="Estilo6 Estilo10">&nbsp;'.cargacargonombre($sbregusuario['cargocodigo'], $idcon).'</span></td>';
	    $html .= '  					</tr>';
	    $html .= '  					<tr>';
	    $html .= '    						<td width="15%"><span class="Estilo6 Estilo10">&nbsp;Descripci&oacute;n</span></td>';
	    $html .= '    						<td colspan="3"><span class="Estilo6 Estilo10">&nbsp;'.$rs_soliserv['solserdescri'].'</span></td>';
	    $html .= '  					</tr>';
	    $html .= '  					<tr>';
	    $html .= '    						<td width="15%"><span class="Estilo6 Estilo10">&nbsp;Solicitud</span></td>';
	    $html .= '    						<td colspan="3"><span class="Estilo6 Estilo10">&nbsp;'.cargatipsolnombre($rs_soliserv['tipsolcodigo'], $idcon).'</span></td>';
	    $html .= '  					</tr>';
	    $html .= '		    			<tr><td colspan="4" class="borde-line">&nbsp;</td></tr>';
		$html .= '		    		</table>';
		$html .= '    			</td>';
		$html .= '  		</tr>';
    
		$html .= '			<tr>';
	  	$html .= '				<td>';
	  	$html .= '					<table width="100%" border="0" cellspacing="1" cellpadding="1">';
	  	$html .= '						<tr><td colspan="4"><span class="Estilo6 Estilo10">&nbsp;<b>Datos del cliente</b></span></td></tr>';
	
		if($solicitud == 1):
	    	$sbregclientedato = loadrecordusuario($rs_vistamaxtareot['cliente'], $idcon);
	    	$NOMBRE_CLIENTE_DIRECTO = $sbregclientedato[usuanombre];
	    	
			$html .= '						<tr>';
			$html .= '							<td width="15%"><span class="Estilo6 Estilo10">&nbsp;NIT</span></td>';
			$html .= '							<td width="45%"><span class="Estilo6 Estilo10">&nbsp;'.$sbregclientedato[usuanombre].'</span></td>';
			$html .= '							<td width="15%"><span class="Estilo6 Estilo10">&nbsp;Raz&oacute;n Social</span></td>';
			$html .= '							<td width="25%"><span class="Estilo6 Estilo10">&nbsp;'.$sbregclientedato[usuanombre].'</span></td>';
			$html .= '						</tr>';
			$html .= '						<tr>';
			$html .= '							<td width="15%"><span class="Estilo6 Estilo10">&nbsp;Tel&eacute;fono</span></td>';
			$html .= '							<td width="45%"><span class="Estilo6 Estilo10">&nbsp;'.$sbregclientedato[usuatelefo].'</span></td>';
			$html .= '							<td width="15%"><span class="Estilo6 Estilo10">&nbsp;Contacto comercial</span></td>';
			$html .= '							<td width="25%"><span class="Estilo6 Estilo10">&nbsp;'.$sbregclientedato[usuacontac].'</span></td>';
			$html .= '						</tr>';
			$html .= '						<tr>';
			$html .= '							<td width="15%"><span class="Estilo6 Estilo10">&nbsp;Correo electr&oacute;nico</span></td>';
			$html .= '							<td colspan="3"><span class="Estilo6 Estilo10">&nbsp;'.$sbregclientedato[usuaemail].'</span></td>';
			$html .= '						</tr>';
			$html .= '						<tr>';
			$html .= '							<td width="15%"><span class="Estilo6 Estilo10">&nbsp;Direcci&oacute;n</span></td>';
			$html .= '							<td colspan="3"><span class="Estilo6 Estilo10">&nbsp;'.$sbregclientedato[usuadirecc].'</span></td>';
			$html .= '						</tr>';
		else:
			$NOMBRE_CLIENTE_DIRECTO = $sbregsistema['sistemcodigo'].' - '.$sbregsistema[sistemnombre];
			
			$html .= '      				<tr>';
			$html .= '        					<td width="15%"><span class="Estilo6 Estilo10">&nbsp;Codigo</span></td>';
			$html .= '        					<td colspan="3"><span class="Estilo6 Estilo10">&nbsp;'.$sbregsistema['sistemcodigo'].'</span></td>';
			$html .= '      				</tr>';
			$html .= '      				<tr>';
			$html .= '        					<td width="15%"><span class="Estilo6 Estilo10">&nbsp;&Aacute;rea</span></td>';
			$html .= '        					<td width="45%"><span class="Estilo6 Estilo10">&nbsp;'.$sbregsistema['sistemnombre'].'</span></td>';
			$html .= '        					<td width="15%"><span class="Estilo6 Estilo10">&nbsp;Planta</span></td>';
			$html .= '        					<td width="25%"><span class="Estilo6 Estilo10">&nbsp;'.cargaplantanombre($sbregsistema[plantacodigo], $idcon).'</span></td>';
			$html .= '      				</tr>';
			$html .= '      				<tr>';
			$html .= '        					<td width="15%"><span class="Estilo6 Estilo10">&nbsp;Ciudad</span></td>';
			$html .= '        					<td colspan="3"><span class="Estilo6 Estilo10">&nbsp;'.cargaciudadnombre2($sbregsistema[ciudadcodigo], $idcon).'</span></td>';
			$html .= '      				</tr>';
		endif;
	
		$NOMBRE_CLIENTE_CONTACTO = $sbregcliente[clientcontac];
		
		$html .= '		    			<tr><td colspan="4" class="borde-line">&nbsp;</td></tr>';
		$html .= '		    		</table>';
		$html .= '    			</td>';
		$html .= '  		</tr>';
		$html .= '  		<tr>';
		$html .= '  			<td>';
		$html .= '  				<table width="100%" border="0" cellspacing="1" cellpadding="0">';
		$html .= '      				<tr><td colspan="4"><span class="Estilo6 Estilo10">&nbsp;<b>Datos de ubicaci&oacute;n</b></span></td></tr>';
		$html .= '      				<tr>';
		$html .= '        					<td width="15%"><span class="Estilo6 Estilo10">&nbsp;Persona de contacto</span></td>';
		$html .= '        					<td width="45%"><span class="Estilo6 Estilo10">&nbsp;'.$sbregcliente[clientcontac].'</span></td>';
		$html .= '        					<td width="15%"><span class="Estilo6 Estilo10">&nbsp;Cargo</span></td>';
		$html .= '        					<td width="25%"><span class="Estilo6 Estilo10">&nbsp;'.$sbregcliente[clientcargo].'</span></td>';
		$html .= '      				</tr>';
		$html .= '      				<tr>';
		$html .= '        					<td width="15%"><span class="Estilo6 Estilo10">&nbsp;Tel&eacute;fono</span></td>';
		$html .= '        					<td width="45%"><span class="Estilo6 Estilo10">&nbsp;'.$sbregcliente[clienttelcon].'</span></td>';
		$html .= '        					<td width="15%"><span class="Estilo6 Estilo10">&nbsp;Celular</span></td>';
		$html .= '        					<td width="25%"><span class="Estilo6 Estilo10">&nbsp;'.$sbregcliente[clientcelcon].'</span></td>';
		$html .= '      				</tr>';
		$html .= '      				<tr>';
		$html .= '        					<td width="15%"><span class="Estilo6 Estilo10">&nbsp;Correo electr&oacute;nico</span></td>';
		$html .= '        					<td width="45%"><span class="Estilo6 Estilo10">&nbsp;'.$sbregcliente[clientemail].'</span></td>';
		$html .= '        					<td width="15%"><span class="Estilo6 Estilo10">&nbsp;Nombre local</span></td>';
		$html .= '        					<td width="25%"><span class="Estilo6 Estilo10">&nbsp;'.$sbregcliente[clientnombre].'</span></td>';
		$html .= '      				</tr>';
		$html .= '      				<tr>';
		$html .= '        					<td width="15%"><span class="Estilo6 Estilo10">&nbsp;Direcci&oacute;n</span></td>';
		$html .= '        					<td colspan="3"><span class="Estilo6 Estilo10">&nbsp;'.$sbregcliente[clientdirecc].' '.$sbregciudad['ciudadnombre'].' ['.cargadeptonombre($sbregciudad['deptocodigo'], $idcon).']</span></td>';
		$html .= '      				</tr>';
		$html .= '		    			<tr><td colspan="4" class="borde-line">&nbsp;</td></tr>';
		$html .= '		    		</table>';
		$html .= '    			</td>';
		$html .= '  		</tr>';
		$html .= '  		<tr>';
	  	$html .= '  			<td>';
	  	$html .= '  				<table width="100%" border="0" cellspacing="1" cellpadding="0">';
	  	$html .= '						<tr><td colspan="2"><span class="Estilo6 Estilo10">&nbsp;<b>Tecnicos</b></span></td></tr>';
	  	$html .= '						<tr>';
	    $html .= '    						<td width="15%"><span class="Estilo6 Estilo10">&nbsp;Encagado</span></td>';
	    $html .= '    						<td width="85%"><span class="Estilo6 Estilo10">&nbsp;'.cargausuanombre($rs_involucrados['lider'], $idcon).'</span></td>';
	    $html .= '   					</tr>';
    
		if(is_array($rs_involucrados['auxiliar'])):
			$html .= '						<tr>';
	        $html .= '							<td width="15%"><span class="Estilo6 Estilo10">&nbsp;Auxiliar</span></td>';
	        $html .= '							<td width="85%"><span class="Estilo6 Estilo10">&nbsp;';
	        
	        foreach($rs_involucrados['auxiliar'] as $tecnico): 
	        	$html .= '- '.cargausuanombre($tecnico, $idcon).'<br>'; 
	        endforeach; 
	        $html .= '							</span></td>';
	      	$html .= '						</tr>';
	    endif;
    
		$html .= '    					<tr><td colspan="2" class="borde-line">&nbsp;</td></tr>';
		$html .= '    				</table>';
	    $html .= '				</td>';
	  	$html .= '			</tr>';
		$html .= '  		<tr>';
		$html .= '  			<td>';
		$html .= '  				<table width="100%" border="0" cellspacing="1" cellpadding="0">';
		$html .= '  					<tr><td colspan="4"><span class="Estilo6 Estilo10">&nbsp;<b>Datos del equipo</b></span></td></tr>';
		$html .= '      				<tr>';
		$html .= '        					<td width="15%"><span class="Estilo6 Estilo10">&nbsp;Tipo equipo</span></td>';
		$html .= '        					<td width="45%"><span class="Estilo6 Estilo10">&nbsp;'.cargatipequnombre($rs_equipo['tipequcodigo'], $idcon).'</span></td>';
		$html .= '        					<td width="15%"><span class="Estilo6 Estilo10">&nbsp;Equipo</span></td>';
		$html .= '        					<td width="25%"><span class="Estilo6 Estilo10">&nbsp;'.$rs_equipo['equiponombre'].'</span></td>';
		$html .= '      				</tr>';
		$html .= '		    			<tr><td colspan="4" class="borde-line">&nbsp;</td></tr>';
		$html .= '		    		</table>';
		$html .= '    			</td>';
		$html .= '  		</tr>';
		$html .= '  	</table>';
		$html .= '		<br>'."\n";
	    $html .= ' 		<hr width="100%">'."\n";
	    $html .= '		<br>'."\n";
	    $html .= str_replace('[s]', '<br>', $sbreg['pie_pagina'])."\n";
	    
	    $html = str_replace('{{NOMBRE_CLIENTE_DIRECTO}}', $NOMBRE_CLIENTE_DIRECTO, $html);
		$html = str_replace('{{NOMBRE_CLIENTE_CONTACTO}}', $NOMBRE_CLIENTE_CONTACTO, $html);
		$html = str_replace('{{NUMERO_SOLICITUD}}', $rs_soliserv['solseridpadr'], $html);
		$html = str_replace('{{NUMERO_DE_ORDEN}}', $ordtracodigo, $html);
	}