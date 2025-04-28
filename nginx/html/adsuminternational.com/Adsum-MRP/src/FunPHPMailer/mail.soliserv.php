<?php 
	include_once ( '../src/FunPerSecNiv/fncnumreg.php');
	include_once ( '../src/FunPerSecNiv/fncfetch.php');
//	include ( '../FunPerSecNiv/fncconn.php');
//	include ( '../FunPerSecNiv/fncclose.php');
	
	include_once ('../src/FunPerPriNiv/pktblusuario.php');
	include_once ('../src/FunPerPriNiv/pktblplanta.php');
	include_once ('../src/FunPerPriNiv/pktblsistema.php');
	include_once ('../src/FunPerPriNiv/pktblequipo.php');
	include_once ('../src/FunPerPriNiv/pktblcomponen.php');
	include_once ('../src/FunPerPriNiv/pktbltipotrab.php');
	include_once ('../src/FunPerPriNiv/pktbltipomant.php');
	include_once ('../src/FunPerPriNiv/pktblpriorida.php');
	include_once ('../src/FunPerPriNiv/pktbltipofall.php');
	include_once ('../src/FunPerPriNiv/pktbltarea.php');
	include_once ( '../src/FunGen/cargainput.php');

	/**
	 * Funcion sendMailsoliserv
	 * @param $arrData
	 * @param $sbreg
	 * @param $html
	 * @return string
	 */
	function sendMailsoliserv($arrData, $sbreg, &$html)
	{
		$idcon = fncconn();
		$remite = cargausuanombre($arrData['usuacodi'], $idcon);
		$solicitante = cargausuanombre($arrData['solicitausuacodi'], $idcon);
		
		$html .= <<<ADSUMAIL
		<br><br>
		<table width="700" border="0" align="center" cellpadding="1" cellspacing="1">
			<tr>
				<td>
			    	<table width="100%" border="0" cellpadding="0" cellspacing="0">
						<tr><td><div align="left"><img src="http://75.98.171.118/plasticel/img/adsumcuasipequeno.jpg" ></div></td></tr>
			    	</table>
			    </td>
			</tr>
			<tr><td>&nbsp;</td></tr>
			<tr><td class="over-table-text">&nbsp;{{HEAD_PAGE_MAIL}}</td></tr>
			<tr><td>&nbsp;</td></tr>
		 	<tr>
				<td>
		   			<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center">
		     			<tr><td class="borde-head">&nbsp;Aclaraciones</td></tr>
		     			<tr>
							<td>
								<table width="100%" border="0" cellspacing="1" cellpadding="2" align="center" class="borde-intabla">
									<tr><td class="borde-datcell">{$arrData[solsermotivo]}</td></tr>
		       					</table>
							</td>
			       		</tr>
			       	</table>
	       		</td>
	       	</tr>
			<tr><td>&nbsp;</td></tr>
			<tr><td>&nbsp;</td></tr>
			<tr><td class="over-table-text">&nbsp;{{FOOTER_SENDER_OUT}}</td></tr>
			<tr><td>&nbsp;</td></tr>
			<tr><td>&nbsp;</td></tr>
			<tr><td class="over-table-text">&nbsp;<b>{$remite}</b></td></tr>
			<tr><td>&nbsp;</td></tr>
			<tr><td class="borde-content">&nbsp;{{FOOTER_PAGE_MAIL}}</td></tr>
		</table>
ADSUMAIL;

		$html = str_replace('{{HEAD_PAGE_MAIL}}', str_replace('[s]', '<br>', $sbreg['headges_ss_page']), $html);
		$html = str_replace('{{FOOTER_PAGE_MAIL}}', str_replace('[s]', '<br>', $sbreg['foot_page']), $html);
		$html = str_replace('{{FOOTER_SENDER_OUT}}', str_replace('[s]', '<br>', $sbreg['send_off']), $html);
		$html = str_replace('{{NOMBRE_SOLICITANTE}}', $solicitante, $html);
		$html = str_replace('{{NUMERO_SOLICITUD}}', $arrData[solsercodigo], $html);
	}
	
	
	
	/**
	 * Funcion sendMailsoliservMant
	 * @param $arrData
	 * @param $sbreg
	 * @param $html
	 * @return string
	 */
	function sendMailsoliservMant($arrData, $sbreg, &$html)
	{
		$idcon = fncconn();
		$rsSoliserv = loadrecordsoliserv($arrData['solsercodigo'], $idcon);
		
		$plantanombre = cargaplantanombre($rsSoliserv['plantacodigo'], $idcon);
		$sistemnombre = cargasistemnombre($rsSoliserv['sistemcodigo'], $idcon);
		$equiponombre = cargaequiponombre($rsSoliserv['equipocodigo'], $idcon);
		$tipfalnombre = cargatipfalnombre($rsSoliserv['tipfalcodigo'], $idcon);
		$tiptranombre = cargatiptrabnombre($rsSoliserv['tiptracodigo'], $idcon);
		
		$remite = cargausuanombre($arrData['usuacodi'], $idcon);
		
		$html .= <<<ADSUMAIL
		<br><br>
		<table width="700" border="0" align="center" cellpadding="1" cellspacing="1">
			<tr>
				<td>
			    	<table width="100%" border="0" cellpadding="0" cellspacing="0">
						<tr><td><div align="left"><img src="http://75.98.171.118/plasticel/img/adsumcuasipequeno.jpg" ></div></td></tr>
			    	</table>
			    </td>
			</tr>
			<tr><td>&nbsp;</td></tr>
			<tr><td class="over-table-text">&nbsp;{{HEAD_PAGE_MAIL}}</td></tr>
			<tr><td>&nbsp;</td></tr>
		 	<tr>
				<td>
					<table width="100%" border="0" cellspacing="1" cellpadding="1" align="center" class="borde-intabla">
						<tr>
							<td width="20%" class="borde-datcell">&nbsp;Solicitud No.</td>
	         				<td width="80%" class="borde-datcell">&nbsp;{$arrData[solsercodigo]}</td>
	   					</tr>
	      				<tr>
	       					<td class="borde-incell">&nbsp;Ubicaci&oacute;n</td>
	       					<td class="borde-datcell">&nbsp;{$plantanombre}</td>
	      				</tr>
	      				<tr>
	       					<td class="borde-incell">&nbsp;Sistema</td>
	       					<td class="borde-datcell">&nbsp;{$sistemnombre}</td>
	      				</tr>
	      				<tr>
	       					<td class="borde-incell">&nbsp;Equipo</td>
	       					<td class="borde-datcell">&nbsp;{$equiponombre}</td>
	      				</tr>
	      			</table>
		   			<table width="100%" border="0" cellspacing="1" cellpadding="1" align="center" class="borde-intabla">
		   				<tr>
        					<td width="20%" class="borde-incell">&nbsp;Tipo Falla</td>
        					<td width="80%" class="borde-datcell">&nbsp;{$tipfalnombre}</td>
      					</tr>
      					<tr>
        					<td class="borde-incell">&nbsp;Tipo trabajo</td>
        					<td class="borde-datcell">&nbsp;{$tiptranombre}</td>
      					</tr>
      				</table>
      				<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center">
		     			<tr><td>&nbsp;</td></tr>
		     			<tr><td class="borde-head">&nbsp;Descripci&oacute;n de la solicitud</td></tr>
		     			<tr>
							<td>
								<table width="100%" border="0" cellspacing="1" cellpadding="2" align="center" class="borde-intabla">
									<tr><td class="borde-datcell">{$arrData[solsermotivo]}</td></tr>
		       					</table>
							</td>
			       		</tr>
			       	</table>
	       		</td>
	       	</tr>
			<tr><td>&nbsp;</td></tr>
			<tr><td>&nbsp;</td></tr>
			<tr><td class="over-table-text">&nbsp;{{FOOTER_SENDER_OUT}}</td></tr>
			<tr><td>&nbsp;</td></tr>
			<tr><td>&nbsp;</td></tr>
			<tr><td class="over-table-text">&nbsp;<b>{$remite}</b></td></tr>
			<tr><td>&nbsp;</td></tr>
			<tr><td class="borde-content">&nbsp;{{FOOTER_PAGE_MAIL}}</td></tr>
		</table>
ADSUMAIL;

		$html = str_replace('{{HEAD_PAGE_MAIL}}', str_replace('[s]', '<br>', $sbreg['headman_ss_page']), $html);
		$html = str_replace('{{FOOTER_PAGE_MAIL}}', str_replace('[s]', '<br>', $sbreg['foot_page']), $html);
		$html = str_replace('{{FOOTER_SENDER_OUT}}', str_replace('[s]', '<br>', $sbreg['send_off']), $html);
		$html = str_replace('{{NOMBRE_SOLICITANTE}}', $remite, $html);
		$html = str_replace('{{NUMERO_SOLICITUD}}', $arrData[solsercodigo], $html);
	}
	
	/**
	 * Funcion sendMailsolserot
	 * @param $arrData
	 * @param $sbreg
	 * @param $html
	 * @return string
	 */
	function sendMailsolserot($arrData, $sbreg, &$html)
	{
		include_once '../src/FunPerPriNiv/pktblot.php';
		include_once '../src/FunPerPriNiv/pktbltareot.php';
		include_once '../src/FunPerPriNiv/pktblusuariotareot.php';
		
		$idcon = fncconn();
		$remite = cargausuanombre($arrData['usuacodi'], $idcon);
		$solicitante = cargausuanombre($arrData['solicitausuacodi'], $idcon);
		
		
		$sbreg_ot = loadrecordot($arrData[ordtracodigo], $idcon);
		$sbreg_tareot = buscartareotordtracodigo($sbreg_ot[ordtracodigo],$idcon);
			
		$iRecordusertareot[tareotcodigo] = $sbreg_tareot[tareotcodigo];
		$rsUsuariotareot = dinamicscanusuariotareot($iRecordusertareot, $idcon);
		$nrUsuariotareot = fncnumreg($rsUsuariotareot);
			
		if($nrUsuariotareot > 0):
			for($i = 0; $i < $nrUsuariotareot; $i++):
				$rwUsuariotareot = fncfetch($rsUsuariotareot, $i);
				
				if($rwUsuariotareot[3] == 't')
					$encargado = cargausuanombre($rwUsuariotareot['usuacodi'], $idcon);
				else
					($auxmanteni) ? $auxmanteni .= '<br>'.cargausuanombre($rwUsuariotareot['usuacodi'], $idcon): $auxmanteni .= cargausuanombre($rwUsuariotareot['usuacodi'], $idcon);
			endfor;
		endif;
		
		/*****/
		$genusuario = cargausuanombre($sbreg_ot['usuacodi'], $idcon);
		$plantanombre = cargaplantanombre($sbreg_ot['plantacodigo'], $idcon);
		$sistemnombre = cargasistemnombre($sbreg_ot['sistemcodigo'], $idcon);
		$equiponombre = cargaequiponombre($sbreg_ot['equipocodigo'], $idcon);
		$componnombre = cargacomponnombre($sbreg_ot['componcodigo'], $idcon);
		$ordtrafecini = date("Y-m-d h:i a", strtotime($sbreg_ot['ordtrafecini'].' '.$sbreg_ot['ordtrahorini']));
		$ordtrafecfin = date("Y-m-d h:i a", strtotime($sbreg_ot['ordtrafecfin'].' '.$sbreg_ot['ordtrahorfin']));
		$tipfalnombre = cargatipfalnombre($sbreg_ot['tipfalcodigo'], $idcon);
		$tipmannombre = cargatipmannombre1($sbreg_ot['tipmancodigo'], $idcon);
		$tareanombre = cargatareanombre1($sbreg_tareot['tareacodigo'], $idcon);
		$tiptranombre = cargatiptrabnombre($sbreg_tareot['tiptracodigo'], $idcon);
		$priorinombre = cargapriorinombre($sbreg_tareot['prioricodigo'], $idcon);
		
		$datosdetarea = explode(".", $sbreg_tareot[tareotnota]);
  		for ($j = 0; $j < count($datosdetarea); $j++)
  			($descritrabajo) ? $descritrabajo .= '<br>[&nbsp;]'.$datosdetarea[$j]: $descritrabajo .= '<br>[&nbsp;]'.$datosdetarea[$j];	
		/*****/
  			
		$html .= <<<ADSUMAIL
		<br><br>
		<table width="700" border="0" align="center" cellpadding="1" cellspacing="1">
			<tr>
				<td>
			    	<table width="100%" border="0" cellpadding="0" cellspacing="0">
						<tr><td><div align="left"><img src="{$sbreg['url']}/img/adsumcuasipequeno.jpg" ></div></td></tr>
			    	</table>
			    </td>
			</tr>
			<tr><td>&nbsp;</td></tr>
			<tr><td class="over-table-text">&nbsp;{{HEAD_PAGE_MAIL}}</td></tr>
			<tr><td>&nbsp;</td></tr>
		 	<tr>
				<td>
		   			<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center">
		     			<tr><td class="borde-head">&nbsp;Datos de la Orden</td></tr>
		     			<tr>
							<td>
								<table width="100%" border="0" cellspacing="1" cellpadding="1" align="center">
									<tr><td class="borde-head">&nbsp;<small><strong>Generada por:</strong>&nbsp;{$genusuario}</small></td></tr>
								</table>
								<table width="100%" border="0" cellspacing="1" cellpadding="1" align="center" class="borde-intabla">
									<tr>
										<td width="20%" class="borde-datcell">&nbsp;Orden No.</td>
		         						<td width="80%" class="borde-datcell">&nbsp;{$sbreg_ot[ordtracodigo]}</td>
		   							</tr>
		      						<tr>
			       						<td class="borde-incell">&nbsp;Ubicaci&oacute;n</td>
			       						<td class="borde-datcell">&nbsp;{$plantanombre}</td>
		      						</tr>
		      						<tr>
			       						<td class="borde-incell">&nbsp;Sistema</td>
			       						<td class="borde-datcell">&nbsp;{$sistemnombre}</td>
		      						</tr>
		      						<tr>
			       						<td class="borde-incell">&nbsp;Equipo</td>
			       						<td class="borde-datcell">&nbsp;{$equiponombre}</td>
		      						</tr>
		      						<tr>
			       						<td class="borde-incell">&nbsp;Componente</td>
			       						<td class="borde-datcell">&nbsp;{$componnombre}</td>
		      						</tr>
		      					</table>
		      					<table width="100%" border="0" cellspacing="1" cellpadding="1" align="center" class="borde-intabla">
		      						<tr>
			        					<td width="20%" class="borde-incell">&nbsp;Fecha ejecuci&oacute;n</td>
			        					<td width="30%" class="borde-datcell">&nbsp;{$ordtrafecini}</td>
			        					<td width="20%" class="borde-incell">&nbsp;Fecha estimada a finalizar</td>
			        					<td width="30%" class="borde-datcell">&nbsp;{$ordtrafecfin}</td>
		      						</tr>
		      						<tr>
			        					<td class="borde-incell">&nbsp;</td>
			        					<td class="borde-datcell">&nbsp;aaaa-mm-dd hh:mm am/pm</td>
			        					<td class="borde-incell">&nbsp;</td>
			        					<td class="borde-datcell">&nbsp;aaaa-mm-dd hh:mm am/pm</td>
		      						</tr>
		       					</table>
		      					<table width="100%" border="0" cellspacing="1" cellpadding="1" align="center" class="borde-intabla">
		      						<tr>
			        					<td width="20%" class="borde-incell">&nbsp;Tipo Falla</td>
			        					<td width="80%" class="borde-datcell">&nbsp;{$tipfalnombre}</td>
		      						</tr>
		      						<tr><td colspan="2" class="borde-incell">&nbsp;Descripci&oacute;n</td></tr>
			        				<tr><td colspan="2" class="borde-datcell">&nbsp;{$sbreg_ot[ordtradescri]}</td></tr>
		       					</table>
		      					<table width="100%" border="0" cellspacing="1" cellpadding="1" align="center" class="borde-intabla">
		      						<tr>
			        					<td width="20%" class="borde-incell">&nbsp;Mantenimiento</td>
			        					<td width="30%" class="borde-datcell">&nbsp;{$tipmannombre}</td>
			        					<td width="20%" class="borde-incell">&nbsp;Prioridad</td>
			        					<td width="30%" class="borde-datcell">&nbsp;{$priorinombre}</td>
		      						</tr>
		      						<tr>
			        					<td class="borde-incell">&nbsp;Tipo trabajo</td>
			        					<td class="borde-datcell">&nbsp;{$tiptranombre}</td>
			        					<td class="borde-incell">&nbsp;Tarea</td>
			        					<td class="borde-datcell">&nbsp;{$tareanombre}</td>
		      						</tr>
		      						<tr><td colspan="4" class="borde-incell"></td></tr>
		      						<tr><td colspan="4" class="borde-incell">&nbsp;Descripci&oacute;n del trabajo a realizar</td></tr>
			        				<tr><td colspan="4" class="borde-datcell">&nbsp;{$descritrabajo}</td></tr>
		       					</table>
		      					<table width="100%" border="0" cellspacing="1" cellpadding="1" align="center" class="borde-intabla">
		      						<tr>
			        					<td width="20%" class="borde-incell">&nbsp;Encargado</td>
			        					<td width="80%" class="borde-datcell">&nbsp;{$encargado}</td>
		      						</tr>
		      						<tr>
			        					<td class="borde-incell">&nbsp;Auxiliares de mantenimiento</td>
			        					<td class="borde-datcell">&nbsp;{$auxmanteni}</td>
		      						</tr>
		       					</table>
							</td>
			       		</tr>
			       	</table>
	       		</td>
	       	</tr>
			<tr><td>&nbsp;</td></tr>
			<tr><td>&nbsp;</td></tr>
			<tr><td class="over-table-text">&nbsp;{{FOOTER_SENDER_OUT}},</td></tr>
			<tr><td>&nbsp;</td></tr>
			<tr><td>&nbsp;</td></tr>
			<tr><td class="over-table-text">&nbsp;<b>{$remite}</b></td></tr>
			<tr><td>&nbsp;</td></tr>
			<tr><td class="borde-content">&nbsp;{{FOOTER_PAGE_MAIL}}</td></tr>
		</table>
ADSUMAIL;
		
		$html = str_replace('{{HEAD_PAGE_MAIL}}', str_replace('[s]', '<br>', $sbreg['headot_ss_page']), $html);
		$html = str_replace('{{FOOTER_PAGE_MAIL}}', str_replace('[s]', '<br>', $sbreg['foot_page']), $html);
		$html = str_replace('{{FOOTER_SENDER_OUT}}', str_replace('[s]', '<br>', $sbreg['send_off']), $html);
		$html = str_replace('{{NOMBRE_SOLICITANTE}}', $solicitante, $html);
		$html = str_replace('{{NUMERO_SOLICITUD}}', $arrData[solsercodigo], $html);
		$html = str_replace('{{NUMERO_ORDEN_TRABAJO}}', $sbreg_ot[ordtracodigo], $html);
		
	}