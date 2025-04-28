<?php 

include ( '../src/FunGen/sesion/fncvalses.php');
include ( '../src/FunPerPriNiv/pktblreportot.php');
include ( '../src/FunPerPriNiv/pktblsoliserv.php');
include ( '../src/FunPerPriNiv/pktblot.php');
include ( '../src/FunPerPriNiv/pktbltareot.php');
include ( '../src/FunPerPriNiv/pktblusuariotareot.php');
include ( '../src/FunPerPriNiv/pktblusuario.php');

include ( '../src/FunGen/cargainput.php' );
include ( '../src/FunGen/fncdatediff.php' );
 
include ( '../src/FunPerPriNiv/pktbltipomant.php'); 
 
include ( '../src/FunPerPriNiv/pktblpriorida.php'); 
include ( '../src/FunPerPriNiv/pktbltarea.php'); 
 
include ( '../src/FunPerPriNiv/pktblplanta.php');
include ( '../src/FunPerPriNiv/pktblsistema.php');
include ( '../src/FunPerPriNiv/pktblequipo.php');
include ( '../src/FunPerPriNiv/pktblcomponen.php');
  
include ( '../src/FunPerPriNiv/pktbltipotrab.php'); 
include ( '../src/FunPerPriNiv/pktbltipocump.php'); 

include ('../src/FunPerPriNiv/pktbldocumenot.php');



if(!$flagdetallarcierreot) 
{ 
	include ( '../src/FunGen/sesion/fnccarga.php'); 
	$sbreg = fnccarga($nombtabl,$radiobutton); 

	if (!$sbreg) 
		include( '../src/FunGen/fnccontfron.php'); 

	$idcon = fncconn();	
	$rs_reportot = loadrecordreportot($sbreg['reportcodigo'],$idcon);
	$rs_ot = loadrecordot($rs_reportot['ordtracodigo'], $idcon);
	
	if($rs_ot['solsercodigo'])
		$rs_soliserv = loadrecordsoliserv($rs_ot['solsercodigo'], $idcon);
		
	$rs_tareot = buscartareotordtracodigo($rs_ot['ordtracodigo'], $idcon);
	$rs_tareot = buscartareotordtracodigo($rs_ot['ordtracodigo'], $idcon);
	$rs_usuariotareot = buscarusuariotareottareotcodigo($rs_tareot['tareotcodigo'], $idcon);
	$usuario_aux = array();
	
	if($rs_usuariotareot > 0)
	{
		for($a = 0; $a < count($rs_usuariotareot); $a++)
		{
			if($rs_usuariotareot[$a]['usutarlider'] == 't')
				$usuario_encargado = $rs_usuariotareot[$a]['usuacodi'];
			else
				$usuario_aux[] = $rs_usuariotareot[$a]['usuacodi'];
		}
	}

	$rsDocumentot = dinamicscanopdocumenot(array("ordtracodigo" => $rs_reportot["ordtracodigo"]), array("ordtracodigo" => "="), $idcon);
	$nrDocumentot = fncnumreg($rsDocumentot);

	for($a = 0; $a < $nrDocumentot; $a++){

		$rwDocumentot = fncfetch($rsDocumentot, $a);

		if($rwDocumentot["docuotnombre"] && $rwDocumentot["docuottamano"]){

			$uploadocumen = ($uploadocumen)? $uploadocumen."::".$rwDocumentot["docuotnombre"] : $rwDocumentot["docuotnombre"];
			$uploadocumensize = ($uploadocumensize)? $uploadocumensize."::".$rwDocumentot["docuottamano"] : $rwDocumentot["docuottamano"];
		}

	}
	
//fncclose($idcon);
} 
?> 
<!-- Propiedad intelectual de Adsum SA (c) 
-Todos los derechos reservados- 
Creado con WAG Adsum 
Autor: Andrés A. Riascos D. 
Fecha: 26052004 
GenVers: 3.1 --> 
<html> 
	<head> 
		<title>Detalle de registro de cierreot</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0"> 
		<?php include('../def/jquery.library_maestro.php');?> 
		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.function_comun.js"></script>
		<link rel="stylesheet" type="text/css" href="temas/Noise/Style.css"> 
		<link rel="stylesheet" type="text/css" href="temas/Noise/help.css">
		<script language="javascript">
			function verocultar(cual, index) {
				var c=cual.nextSibling;
				if(c.style.display=='none') {
					c.style.display='block';
					document.getElementById("row"+ index).src = "temas/Noise/AscOn.gif";			           
				} else {
					c.style.display='none';
					document.getElementById("row"+ index).src = "temas/Noise/DescOn.gif";			           			           
				}
				return false;
			 }
		</script>
		<style type="text/css">
			#titulo_sesion {
				color:#ffffff;
			}
		</style>
	</head> 
<?php if(!$codigo){ echo "<!--";} ?> 
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Cierre de orden de trabajo</font></p> 
			<table border="0" cellspacing="1" width="70%" cellpadding="2" align="center" class="NoiseFormTABLE"> 
  				<tr><td class="NoiseDataTD">&nbsp;</td></tr>
  				<tr><td class="NoiseFieldCaptionTD"><span class="style5"><font color="FFFFFF">Detallar Registro</font></span></td></tr>
          		<tr> 
  					<td> 
						<table width="99%" border="0" cellspacing="1" cellpadding="0" align="center">
							<?php if($rs_soliserv > 0): ?>
							<tr><td class="NoiseFieldCaptionTD">&nbsp;<span class="style5"><font color="FFFFFF"><b>Solicitud de Servicio</b></font></span></td></tr>
							<tr>
								<td>
									<table width="100%" border="0" cellspacing="1" cellpadding="1" align="center">						
										<tr>
											<td width="15%" class="NoiseFooterTD">&nbsp;Solicitud No.</td>
											<td width="35%" class="NoiseErrorDataTD"><?php  echo $rs_soliserv['solsercodigo'] ?></td>
											<td width="15%" class="NoiseFooterTD">&nbsp;Fecha/Hora solicitud</td>
											<td width="35%" class="NoiseErrorDataTD"><?php  echo date('Y-m-d H:i a', strtotime($rs_soliserv['solserfecha'].' '.$rs_soliserv['solserhora'])) ?></td>
										</tr>
										<tr>
											<td width="15%" class="NoiseFooterTD">&nbsp;Solicitante</td>
											<td colspan="3" class="NoiseErrorDataTD"><?php  echo cargausuanombre($rs_soliserv['usuacodi'], $idcon) ?></td>
										</tr>
										<tr>
											<td width="15%" class="NoiseFooterTD">&nbsp;Motivo</td>
											<td colspan="3" class="NoiseErrorDataTD"><?php  echo $rs_soliserv['solsermotivo'] ?></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr><td class="NoiseErrorDataTD"></td></tr> 
							<tr><td class="NoiseFieldCaptionTD"></td></tr> 
							<tr><td class="NoiseErrorDataTD"></td></tr>
							<?php endif; ?>
							
							<tr><td class="NoiseFieldCaptionTD">&nbsp;<span class="style5"><font color="FFFFFF"><b>Orden de trabajo</b></font></span></td></tr>
							<tr>
								<td>
									<table width="100%" border="0" cellspacing="1" cellpadding="1" align="center">						
										<tr>
											<td width="20%" class="NoiseFooterTD">&nbsp;Numero OT.</td>
											<td width="30%" class="NoiseErrorDataTD"><?php  echo $rs_ot['ordtracodigo'] ?></td>
											<td width="20%" class="NoiseFooterTD">&nbsp;Fecha/Hora Generaci&oacute;n.</td>
											<td width="30%" class="NoiseErrorDataTD"><?php  echo date('Y-m-d h:i a', strtotime($rs_ot['ordtrafecgen'].' '.$rs_ot['ordtrahorgen'])) ?></td>
										</tr>
										<tr>
											<td class="NoiseFooterTD">&nbsp;Generado por.</td>
											<td colspan="3" class="NoiseErrorDataTD"><?php  echo cargausuanombre($rs_ot['usuacodi'],$idcon ); ?></td>
										</tr>
										<tr><td class="NoiseErrorDataTD" colspan="4"></td></tr> 
										<tr><td class="NoiseFieldCaptionTD" colspan="4"></td></tr> 
										<tr><td class="NoiseErrorDataTD" colspan="4"></td></tr>
										<tr>
											<td class="NoiseFooterTD">&nbsp;Planta</td>
											<td colspan="3" class="NoiseErrorDataTD"><?php  echo cargaplantanombre($rs_ot['plantacodigo'],$idcon ); ?></td>
										</tr>
										<tr>
											<td class="NoiseFooterTD">&nbsp;Sistema</td>
											<td colspan="3" class="NoiseErrorDataTD"><?php  echo cargasistemnombre($rs_ot['sistemcodigo'],$idcon ); ?></td>
										</tr>
										<tr>
											<td class="NoiseFooterTD">&nbsp;Equipo</td>
											<td colspan="3" class="NoiseErrorDataTD"><?php  echo cargaequiponombre($rs_ot['equipocodigo'],$idcon); ?></td>
										</tr>
										<tr>
											<td class="NoiseFooterTD">&nbsp;Componente</td>
											<td colspan="3" class="NoiseErrorDataTD"><?php if($rs_ot['componcodigo']){ echo cargacomponnombre($rs_ot['componcodigo'],$idcon); } ?></td>
										</tr>
										<tr><td class="NoiseErrorDataTD" colspan="4"></td></tr> 
										<tr><td class="NoiseFieldCaptionTD" colspan="4"></td></tr> 
										<tr><td class="NoiseErrorDataTD" colspan="4"></td></tr>
										<tr>
											<td class="NoiseFooterTD">&nbsp;Mantenimiento</td>
											<td class="NoiseErrorDataTD"><?php  echo cargatipmannombre($rs_ot['ordtracodigo'],$idcon); ?></td>
											<td class="NoiseFooterTD">&nbsp;Prioridad</td>
											<td class="NoiseErrorDataTD"><?php  echo cargapriorinombre($rs_tareot['prioricodigo'],$idcon); ?></td>
										</tr>	
										<tr>
											<td class="NoiseFooterTD">&nbsp;Tarea</td>
											<td class="NoiseErrorDataTD"><?php  echo cargatareanombre1($rs_tareot['tareacodigo'],$idcon); ?></td>
											<td class="NoiseFooterTD">&nbsp;Tipo de trabajo</td>
											<td class="NoiseErrorDataTD"><?php echo cargadetalleprogtiptrab($rs_tareot['tiptracodigo'],$idcon); ?></td>
										</tr>
										<tr><td class="NoiseErrorDataTD" colspan="4"></td></tr> 
										<tr><td class="NoiseErrorDataTD" colspan="4"></td></tr>
										<tr>
											<td class="NoiseFooterTD">&nbsp;Fecha/Hora de inicio</td>
											<td class="NoiseErrorDataTD"><?php echo date('Y-m-d h:i a', strtotime($rs_ot['ordtrafecini'].' '.$rs_ot['ordtrahorini'])) ?><br>&nbsp;aaaa-mm-dd hh:mm am/pm</td>
											<td class="NoiseFooterTD">&nbsp;Fecha/Hora estimada a finalizar</td>
											<td class="NoiseErrorDataTD"><?php echo date('Y-m-d h:i a', strtotime($rs_ot['ordtrafecfin'].' '.$rs_ot['ordtrahorfin'])) ?><br>&nbsp;aaaa-mm-dd hh:mm am/pm</td>
										</tr>
										<tr>
											<td class="NoiseFooterTD">&nbsp;Duraci&oacute;n estimada</td>
											<td colspan="3" class="NoiseErrorDataTD"><b><?php echo datediff('h', date('Y-m-d H:i', strtotime($rs_ot['ordtrafecini'].' '.$rs_ot['ordtrahorini'])), date('Y-m-d H:i', strtotime($rs_ot['ordtrafecfin'].' '.$rs_ot['ordtrahorfin']))) ?>&nbsp;hrs.</b></td>
										</tr>
										<tr><td class="NoiseErrorDataTD" colspan="4"></td></tr> 
										<tr><td class="NoiseFieldCaptionTD" colspan="4"></td></tr> 
										<tr><td class="NoiseErrorDataTD" colspan="4"></td></tr>
										<tr><td class="NoiseErrorDataTD" colspan="4"></td></tr>
										<tr><td colspan="4" class="NoiseSeparatorTD">Empleado de Mantenimiento&nbsp;&nbsp;&nbsp;</td></tr>
										<tr>
											<td width="15%" class="NoiseFooterTD">Encargado</td>
											<td colspan="3" class="NoiseErrorDataTD"><?php echo cargausuanombre($usuario_encargado, $idcon) ?></td>
										</tr>
										<tr><td class="NoiseErrorDataTD" colspan="4"></td></tr>
										<tr>
											<td width="15%" class="NoiseFooterTD" rowspan="<?php echo count($usuario_aux); ?>">Auxiliar</td>
											<td colspan="3" class="NoiseDataTD" ><?php echo cargausuanombre($usuario_aux[0], $idcon); ?></td>
										</tr>
	    			                    <?php for($i = 1; $i <= count($usuario_aux);$i++ ): ?>
	    			                    <tr><td colspan="3" class="NoiseDataTD" ><?php echo cargausuanombre($usuario_aux[$i], $idcon)?></td></tr>
										<?php endfor; ?>
            						</table> 
  	  							</td> 
 							</tr> 
							<tr><td class="NoiseFieldCaptionTD">&nbsp;<span class="style5"><font color="FFFFFF"><b>Gestion</b></font></span></td></tr>
							<tr>
								<td class="NoiseFooterTD">
									&nbsp;<a onClick="return verocultar(this,'1');" href="javascript:void(0);" >Ver/Ocultar<img id="row1"  align="middle" align="top"  src="temas/Noise/DescOn.gif" border="0"></a><div style="display: none;">
			  							<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center"> 
											<tr><td class="NoiseFieldCaptionTD"></td></tr> 
				    						<tr>
	                							<td><iframe src="detallahistorialtareot.php?ordtracodigo=<?php echo $rs_ot['ordtracodigo']; ?>" frameborder="0" name="detalleprograma" frameborder="0"  height="230" width="100%"></iframe></td>
	              							</tr>
										</table>
									</div>
              					</td>
              				</tr>   
							<tr><td class="NoiseFieldCaptionTD">&nbsp;<span class="style5"><font color="FFFFFF"><b>Reporte</b></font></span></td></tr>
							<tr>
								<td>
									<table width="100%" border="0" cellspacing="1" cellpadding="1" align="center">						
										<tr>
											<td width="15%" class="NoiseFooterTD">&nbsp;Fecha/Hora reporte</td>
											<td colspan="3" class="NoiseErrorDataTD"><?php  echo date('Y-m-d h:i a', strtotime($rs_reportot['reportfecha'].' '.$rs_reportot['reporthora'])) ?></td>
										</tr>
										<tr>
											<td width="15%" class="NoiseFooterTD">&nbsp;Observaci&oacute;n</td>
											<td colspan="3" class="NoiseErrorDataTD"><?php  echo $rs_reportot['reportdescri'] ?></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr><td class="NoiseFieldCaptionTD">&nbsp;<span class="style5"><font color="FFFFFF"><b>Cierre</b></font></span></td></tr>
							<tr>
								<td>
									<table width="100%" border="0" cellspacing="1" cellpadding="1" align="center">						
										<tr>
											<td width="15%" class="NoiseFooterTD">&nbsp;Fecha/Hora cierre</td>
											<td colspan="3" class="NoiseErrorDataTD"><?php  echo date('Y-m-d h:i a', strtotime($sbreg['cierotfecfin'].' '.$sbreg['cierothorfin'])) ?></td>
										</tr>
										<tr>
											<td width="15%" class="NoiseFooterTD">&nbsp;Tipo de cumplimiento</td>
											<td colspan="3" class="NoiseErrorDataTD"><?php  echo cargatipcumnombre($sbreg['tipcumcodigo'], $idcon) ?></td>
										</tr>
										<tr>
											<td width="15%" class="NoiseFooterTD">&nbsp;Observaci&oacute;n</td>
											<td colspan="3" class="NoiseErrorDataTD"><?php  echo $sbreg['cierotdescri'] ?></td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
  					</td> 
 				</tr> 
 				<tr>
	      			<td>
		      			<div id="filuploadfile">
							<table border="0" cellspacing="1" cellpadding="1" align="center" width="100%">
								<tr><td class="ui-state-default">&nbsp;Documentos </td></tr>					
								<tr>
									<td>
										<div style="height:2px;"></div>
										<div class="ui-widget-content content">
											<div id="reportot_file_load" class="file-upname">
												<?php 
													if($uploadocumen):
														$arrUpload = explode('::', $uploadocumen);
														$arrUploadSize = explode('::', $uploadocumensize);
														
														for($a = 0; $a < count($arrUpload); $a++):
												?>
												<div class="uploadifyQueueItem completed"><div class="cancel"><a href="javascript: void(0);" onclick="window.open('http://75.98.171.118/plasticel/doc/upload/gestionot/<?php echo $arrUpload[$a] ?>','impresion','status=no,menubar=no,scrollbars=yes,resizable=yes,width=880,height=650');">Detallar</a></div><span class="fileName"><?php echo $arrUpload[$a].' ('.$arrUploadSize[$a].')' ?></span></div>
												<?php												
														endfor;
													endif;
												?>
											</div>
											<input type="hidden" name="uploadocumen" id="uploadocumen" value="<?php echo $uploadocumen?>">
											<input type="hidden" name="uploadocumensize" id="uploadocumensize" value="<?php echo $uploadocumensize ?>">
										</div>
									</td>
								</tr>
							</table>
						</div>
					</td>
				</tr>
 				<tr> 
					<td><div align="center">  
  						<input type="image" name="aceptar"  src="../img/aceptar.gif" onclick="form1.action='maestablcierreot.php';"  width="86" height="18" alt="Aceptar" border=0>
  						<input type="image" name="imprimir" src="../img/imprimir.gif" onClick='form1.action="maestablcierreot.php", window.open("imprimircierreot.php?codigo=<?php echo $sbreg[cierotcodigo]; ?>","impresion","width=800, height=650, scrollbars=yes");'  width="86" height="18" alt="Imprimir" border="0">
					</div></td> 
 				</tr> 
 				<tr><td class="NoiseDataTD">&nbsp;</td></tr> 
			</table> 
 			<input type="hidden" name="flagdetallarcierreot" value="1"> 
			<input type="hidden" name="acciondetallarcierreot"> 
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
		</form> 
	</body> 
<?php if(!$codigo){ echo " -->"; } ?> 
</html>