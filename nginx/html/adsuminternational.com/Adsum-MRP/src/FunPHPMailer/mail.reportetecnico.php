<?php 
	include_once ( "../src/FunPerSecNiv/fncnumreg.php");
	include_once ( "../src/FunPerSecNiv/fncfetch.php");
	
	include_once ( "../src/FunPerPriNiv/pktblusuario.php");
	include_once ( "../src/FunPerPriNiv/pktblplanta.php");
	include_once ( "../src/FunPerPriNiv/pktblsistema.php");
	include_once ( "../src/FunPerPriNiv/pktblequipo.php");
	include_once ( "../src/FunPerPriNiv/pktblcomponen.php");
	include_once ( "../src/FunPerPriNiv/pktbltipotrab.php");
	include_once ( "../src/FunPerPriNiv/pktbltipomant.php");
	include_once ( "../src/FunPerPriNiv/pktbltipocump.php");
	include_once ( "../src/FunPerPriNiv/pktblpriorida.php");
	include_once ( "../src/FunPerPriNiv/pktbltipofall.php");
	include_once ( "../src/FunPerPriNiv/pktblparametro.php");
	include_once ( "../src/FunPerPriNiv/pktbltarea.php");
	include_once ( "../src/FunGen/cargainput.php");


	/**
	 * Funcion sendMailReporte
	 * @param $arrData
	 * @param $sbreg
	 * @param $html
	 * @return string
	 */

	function sendMailReporte($arrData, $sbreg, &$html){

		include_once '../src/FunPerPriNiv/pktblot.php';
		
		$idcon = fncconn();
		$rsReportot = loadrecordreportot($arrData['reportcodigo'], $idcon);
		$rsOt = loadrecordot($rsReportot['ordtracodigo'], $idcon);	

		$rwPargen1 = loadrecordparametro(1, $idcon);//Id parametro => valor_tipo_cump
		$rwPargen2 = loadrecordparametro(2, $idcon);//Id parametro => valor_calificacion_auto
		
		$genusuario = cargausuanombre($rsOt['usuacodi'], $idcon);
		$plantanombre = cargaplantanombre($rsOt['plantacodigo'], $idcon);
		$sistemnombre = cargasistemnombre($rsOt['sistemcodigo'], $idcon);
		$equiponombre = cargaequiponombre($rsOt['equipocodigo'], $idcon);
		$componnombre = cargacomponnombre($rsOt['componcodigo'], $idcon);
		
		$tipmannombre = cargatipmannombre1($rsReportot['tipmancodigo'], $idcon);
		$tareanombre = cargatareanombre1($rsReportot['tareacodigo'], $idcon);
		$tiptranombre = cargatiptrabnombre($rsReportot['tiptracodigo'], $idcon);
		$priorinombre = cargapriorinombre($rsReportot['prioricodigo'], $idcon);
		$tipcumnombre = cargatipcumnombre($rwPargen1['paramevalor'], $idcon);
		
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
							<td width="20%" class="borde-datcell">&nbsp;Orden No.</td>
	         				<td width="80%" class="borde-datcell">&nbsp;{$rsOt[ordtracodigo]}</td>
	   					</tr>
	   				</table>
					<table width="100%" border="0" cellspacing="1" cellpadding="1" align="center" class="borde-intabla">
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
							<td width="20%" class="borde-datcell">&nbsp;Reporte No.</td>
	         				<td width="80%" class="borde-datcell">&nbsp;{$arrData[reportcodigo]}</td>
	   					</tr>
		   				<tr>
        					<td width="20%" class="borde-incell">&nbsp;Tipo Mantenimiento</td>
        					<td width="80%" class="borde-datcell">&nbsp;{$tipmannombre}</td>
      					</tr>
      					<tr>
        					<td class="borde-incell">&nbsp;Prioridad</td>
        					<td class="borde-datcell">&nbsp;{$priorinombre}</td>
      					</tr>
      					<tr>
        					<td class="borde-incell">&nbsp;Tipo trabajo</td>
        					<td class="borde-datcell">&nbsp;{$tiptranombre}</td>
      					</tr>
      					<tr>
        					<td class="borde-incell">&nbsp;Tarea</td>
        					<td class="borde-datcell">&nbsp;{$tareanombre}</td>
      					</tr>
      				</table>
      				<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center">
		     			<tr><td>&nbsp;</td></tr>
		     			<tr><td class="borde-head">&nbsp;Descripci&oacute;n del reporte</td></tr>
		     			<tr>
							<td>
								<table width="100%" border="0" cellspacing="1" cellpadding="2" align="center" class="borde-intabla">
									<tr><td class="borde-datcell">{$rsReportot[reportdescri]}</td></tr>
		       					</table>
							</td>
			       		</tr>
			       	</table>
			       	<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center">
		     			<tr><td>&nbsp;</td></tr>
		     			<tr><td class="borde-head">&nbsp;Mensaje de Advertencia</td></tr>
		     			<tr>
							<td>
								<table width="100%" border="0" cellspacing="1" cellpadding="2" align="center" class="borde-intabla">
									<tr>
										<td class="borde-datcell">
											&nbsp;Este trabajo se calificar&aacute; autom&aacute;ticamente
											pasados {$rwPargen2[paramevalor]} d&iacute;a(s), Cumplimiento ({$tipcumnombre})
										</td>
									</tr>
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

		$html = str_replace('{{HEAD_PAGE_MAIL}}', str_replace('[s]', '<br>', $sbreg['headrep_ss_page']), $html);
		$html = str_replace('{{FOOTER_PAGE_MAIL}}', str_replace('[s]', '<br>', $sbreg['foot_page']), $html);
		$html = str_replace('{{FOOTER_SENDER_OUT}}', str_replace('[s]', '<br>', $sbreg['send_off']), $html);
		$html = str_replace('{{NUMERO_SOLICITUD}}', $rsOt[solsercodigo], $html);
		$html = str_replace('{{NOMBRE_TECNICO}}', $remite, $html);
		$html = str_replace('{{NUMERO_DE_ORDEN}}', $rsOt[ordtracodigo], $html);
		$html = str_replace('{{FECHA_REPORTE}}', date("Y-m-d h:i a", strtotime($rsReportot[reportfecha].' '.$rsReportot[reporthora])), $html);

	}
	
	/**
	 * Funcion sendMailCierre
	 * @param $arrData
	 * @param $sbreg
	 * @param $html
	 * @return string
	 */

	function sendMailCierre($arrData, $sbreg, &$html){

		include_once '../src/FunPerPriNiv/pktblot.php';
		include_once '../src/FunPerPriNiv/pktblreportot.php';

		$idcon = fncconn();
		$rsCierreot = loadrecordcierreot($arrData['cierotcodigo'], $idcon);
		$rsReportot = loadrecordreportot($rsCierreot['reportcodigo'], $idcon);
		$rsOt = loadrecordot($rsReportot['ordtracodigo'], $idcon);		
		
		$genusuario = cargausuanombre($rsOt['usuacodi'], $idcon);
		$plantanombre = cargaplantanombre($rsOt['plantacodigo'], $idcon);
		$sistemnombre = cargasistemnombre($rsOt['sistemcodigo'], $idcon);
		$equiponombre = cargaequiponombre($rsOt['equipocodigo'], $idcon);
		$componnombre = cargacomponnombre($rsOt['componcodigo'], $idcon);
		
		$tipcumnombre = cargatipcumnombre($rsCierreot['tipcumcodigo'], $idcon);
		
		if($arrData['usuacodi']){
			$remite = cargausuanombre($arrData['usuacodi'], $idcon);
		}else{
			$remite = "Adsum Kallpa";
		}
		
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
							<td width="20%" class="borde-datcell">&nbsp;Orden No.</td>
	         				<td width="80%" class="borde-datcell">&nbsp;{$rsOt[ordtracodigo]}</td>
	   					</tr>
	   				</table>
					<table width="100%" border="0" cellspacing="1" cellpadding="1" align="center" class="borde-intabla">
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
							<td width="20%" class="borde-datcell">&nbsp;Cierre No.</td>
	         				<td width="80%" class="borde-datcell">&nbsp;{$arrData[cierotcodigo]}</td>
	   					</tr>
      					<tr>
        					<td class="borde-incell">&nbsp;Tipo de cumplimiento</td>
        					<td class="borde-datcell">&nbsp;{$tipcumnombre}</td>
      					</tr>
      				</table>
      				<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center">
		     			<tr><td>&nbsp;</td></tr>
		     			<tr><td class="borde-head">&nbsp;Descripci&oacute;n del reporte</td></tr>
		     			<tr>
							<td>
								<table width="100%" border="0" cellspacing="1" cellpadding="2" align="center" class="borde-intabla">
									<tr><td class="borde-datcell">{$rsCierreot[cierotdescri]}</td></tr>
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

		$html = str_replace('{{HEAD_PAGE_MAIL}}', str_replace('[s]', '<br>', $sbreg['headcier_ss_page']), $html);
		$html = str_replace('{{FOOTER_PAGE_MAIL}}', str_replace('[s]', '<br>', $sbreg['foot_page']), $html);
		$html = str_replace('{{FOOTER_SENDER_OUT}}', str_replace('[s]', '<br>', $sbreg['send_off']), $html);
		$html = str_replace('{{NUMERO_SOLICITUD}}', $rsOt[solsercodigo], $html);
		$html = str_replace('{{NOMBRE_TECNICO}}', $remite, $html);
		$html = str_replace('{{NUMERO_DE_ORDEN}}', $rsOt[ordtracodigo], $html);
		$html = str_replace('{{FECHA_CIERRE}}', date("Y-m-d h:i a", strtotime($rsCierreot[cierotfecfin].' '.$rsCierreot[cierothorfin])), $html);

	}