<?php 
ob_start();
ini_set('display_errors',1);
	include ('../src/FunGen/sesion/fncvalsesion.php');
	include ('../src/FunPerSecNiv/fncsqlrun.php');
	include ('../src/FunPerSecNiv/fncnumreg.php');
	include ('../src/FunPerSecNiv/fncfetchall.php');
	include ('../src/FunPerSecNiv/fncfetch.php');
	include ( '../src/FunGen/fncnumprox.php');
	include ( '../src/FunGen/cargainput.php');
	include ( '../src/FunGen/fncnumact.php');
	include ( '../src/FunPerPriNiv/pktblop.php');
	include ( '../src/FunPerPriNiv/pktblopp.php');
	include ( '../src/FunGen/floadtimehours.php');
	include ( '../src/FunGen/floadtimeminut.php');
	include ( '../src/FunPerPriNiv/pktblplanta.php');
	include ( '../src/FunPerPriNiv/pktblsistema.php');
	include ( '../src/FunPerPriNiv/pktblopestado.php');
	include ( '../src/FunPerPriNiv/pktblequipo.php');
	include ( '../src/FunPerPriNiv/pktblusuario.php');
	include ( '../src/FunPerPriNiv/pktblopflexo.php');
	include ( '../src/FunPerPriNiv/pktblopcorte.php');
	include ( '../src/FunPerPriNiv/pktblitemdesa.php');
	include ( '../src/FunPerPriNiv/pktblproducto.php');
	include ( '../src/FunPerPriNiv/pktblpadreitem.php');
	include ( '../src/FunPerPriNiv/pktblitemformul.php');
	include ( '../src/FunPerPriNiv/pktbloplaminado.php');	
	include ( '../src/FunPerPriNiv/pktblformulacion.php');
	include ( '../src/FunPerPriNiv/pktblopextrusion.php');
	include ( '../src/FunPerPriNiv/pktbloppitemdesa.php');
	include ( '../src/FunPerPriNiv/pktblprocedimiento.php');
	include ( '../src/FunPerPriNiv/pktblprogramaflexo.php');
	include ( '../src/FunPerPriNiv/pktblprogramacorte.php');
	include ( '../src/FunPerPriNiv/pktblvistaformulacion.php');
	include ( '../src/FunPerPriNiv/pktblprogramalaminado.php');
	include ( '../src/FunPerPriNiv/pktblprogramaextrusion.php');
	
	$idcon = fncconn();

	if($arrusuaplanta)
	{
		$ircrecord['plantacodigo'] = $arrusuaplanta;
		$ircrecordop['plantacodigo'] = 'IN';
	}
	
	if($arrsistema)
	{
		$ircrecord['sistemcodigo'] = $arrsistema;
		$ircrecordop['sistemcodigo'] = 'IN';
	}
	
	if($paditecodigo)
	{
		$rwPadreitem = loadrecordpadreitem($paditecodigo,$idcon);
		$ircrecord['keylinea'] = $rwPadreitem['paditekeylin'];
		$ircrecordop['keylinea'] = 'IN';
	}
	
	if($opestacodigo)
	{
		$ircrecord['opestacodigo'] = $opestacodigo;
		$ircrecordop['opestacodigo'] = '=';
	}
	
	if($ordprofecini && $ordprofecfin)
	{
		$ircrecord['ordprofecini'] = $ordprofecini;
		$ircrecordop['ordprofecini'] = '=';
		$ircrecord['ordprofecfin'] = $ordprofecfin;
		$ircrecordop['ordprofecfin'] = '=';
	}
	
ob_end_flush();
?>
<html>
	<head>
		<title>Programacion de produccion</title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		<meta http-equiv="expires" content="0">
		<?php include('../def/jquery.library_maestro.php');?>
		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.function_comun.js"></script>
		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.ui.ajax_accionextras.js"></script>
	</head>
	<?php if(!$codigo){echo "<!--";} ?>
	<body bgcolor="FFFFFF" text="#000000">
		<form name="form1" method="post"  enctype="multipart/form-data">
<!-- 	CONTENIDO GENERAL -->
		<div style="padding: 6px;">
			<br>
			<div class="contenido-general-inf">
			
			<!-- 	TITULO -->
				<br>
	 			<div class="ui-widget-content">
	 				<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
	 					<tr class="ui-widget-header">
	          				<td colspan="3">&nbsp;<b>INFORME DE MATERIALES</b></td>
	          			</tr>
	 					<tr>
	         				<td align="right" colspan="3" class="borde-cell"><p><img src="../img/adsumcuasipequeno.jpg"><br><b><small>NIT 890307885-1</small></b></p></td>
	         			</tr>
	         		</table>
	         		<table width="50%" border="0" cellspacing="0" cellpadding="0" align="left" class="ui-widget-content">
						<?php 
							if($arrusuaplanta) $arrObjplanta = explode(',',$arrusuaplanta);
						?>
						<tr>
							<td class="NoiseFooterTD cont-field-b" colspan="<?php echo count($arrObjplanta); ?>">&nbsp;PLANTA / UBICACION</td>
						</tr>
						<tr>
						<?php 
	         				for( $a = 0; $a < count($arrObjplanta); $a++)
	         				{
	         			?>
		          			<td class="NoiseDataTD cont-field-b" width="10%">&nbsp;<?php echo cargaplantanombre($arrObjplanta[$a],$idcon);?></td>
	         			<?php 
	         				} 
	         			?>
	         			</tr>
	         		</table>
	         		<table width="50%" border="0" cellspacing="0" cellpadding="0" align="right" class="ui-widget-content">
						<?php 
							if($arrsistema) $arrObjsistema = explode(',',$arrsistema);
						?>
						<tr>
							<td class="NoiseFooterTD cont-field-b" colspan="<?php echo count($arrObjsistema); ?>">&nbsp;SISTEMA / SECCION</td>
						</tr>
						<tr>
						<?php 
	         				for( $a = 0; $a < count($arrObjsistema); $a++)
	         				{
	         			?>
		          			<td class="NoiseDataTD cont-field-b" width="10%">&nbsp;<?php echo cargasistemnombre($arrObjsistema[$a],$idcon);?></td>
	         			<?php 
	         				} 
	         			?>
	         			</tr>
	         		</table>
	         		<table width="50%" border="0" cellspacing="0" cellpadding="0" align="left" class="ui-widget-content">
	         			<tr>
							<td class="NoiseFooterTD cont-field-b" colspan="2">&nbsp;</td>
						</tr>
						<tr>
							<td class="NoiseDataTD cont-field-b" width="10%">&nbsp;DESDE :&nbsp;<?php echo ($ordprofecini)? $ordprofecini : '---' ; ?></td>
							<td class="NoiseDataTD cont-field-b" width="10%">&nbsp;HASTA :&nbsp;<?php echo ($ordprofecfin)? $ordprofecfin : '---' ; ?></td>
						</tr>
	         		</table>
	         		<table width="50%" border="0" cellspacing="0" cellpadding="0" align="right" class="ui-widget-content">
	         			<tr>
							<td class="NoiseFooterTD cont-field-b" colspan="1">&nbsp;MATERIAL</td>							
						</tr>
						<tr>
							<td class="NoiseDataTD cont-field-b" width="10%">&nbsp;<?php echo ($paditecodigo)? cargapadreitemnombre($paditecodigo,$idcon) : '---' ;?></td>
						</tr>
	         		</table>
	         	</div>
	         <!-- 	FIN TITULO -->
	         
	         <br>
	         
	        <!-- TITULO GENERAL -->
	 		<div class="ui-widget-content">
	          	<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
					<tr class="ui-widget-header">
	          			<td>&nbsp;<b>NECESIDAD DE LOS PROGRAMAS GENERAL</b></td>
	          			<td>&nbsp;</td>
	         		</tr>
	         	</table>
	         </div>
	        <!-- FIN TITULO GENERAL --> 
	        
	        
			<!-- 	CONTENIDO GENERAL -->
			<div class="ui-widget-content contenido-general-inf">
	          	<?php	          
	          		$rsOppitemdesa = dinamicscanoppitemdesagen($ircrecord,$ircrecordop,$idcon);
	          		$nrOppitemdesa = fncnumreg($rsOppitemdesa);
	          		
	          		$rsOppextrusion = dinamicscanoppextrusiongen($ircrecord,$ircrecordop,$idcon);
	          		$nrOppextrusion = fncnumreg($rsOppextrusion);
	          		
					if(!$nrOppitemdesa && !$nrOppextrusion)
					{
				?>
				<div class="ui-widget">
	 				<div style="margin-top: 1px; padding: 0 .7em;" class="ui-state-highlight ui-corner-all"> 
  						<p><span style="float: left; margin-right: .3em;" class="ui-icon ui-icon-info"></span>
  						<b>No se encontraron equipos aprobados.</b></p>
 					</div>
				</div>
				<?php 
					}
					
	          		for($a = 0; $a < $nrOppitemdesa; $a++)
	          		{
	          			$rwOppitemdesa = fncfetch($rsOppitemdesa,$a);
	          	?>
	          	<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" class="ui-widget-content">
					<tr>
	          			<td class="NoiseFooterTD cont-field-b" width="10%">&nbsp;Item</td>
	          			<td class="NoiseFooterTD cont-field-b" width="70%">&nbsp;Material</td>
	          			<td class="NoiseFooterTD cont-field-b" width="10%">&nbsp;KILOS&nbsp;<b>(kg)</b>&nbsp;</td>
	          			<td class="NoiseFooterTD cont-field-b" width="10%">&nbsp;METROS&nbsp;<b>(mts)</b>&nbsp;</td>
	         		</tr>
					<tr>
	          			<td class="NoiseDataTD cont-field-b" width="10%">&nbsp;<font color="#FF0000"><b><?php echo str_pad( $rwOppitemdesa['itedescodigo']  , 3, "0", STR_PAD_LEFT) ?></b></font></td>
	          			<td class="NoiseDataTD cont-field-b" width="70%">&nbsp;<font color="#000080"><b><?php echo ($rwOppitemdesa['itedescodigo'])? carganombitemdesa($rwOppitemdesa['itedescodigo'], $idcon) : '---' ;?></b></font></td>
	          			<td class="NoiseDataTD cont-field-b" width="10%">&nbsp;<font color="#000080"><b><?php echo ($rwOppitemdesa['oppitecantid'])? number_format($rwOppitemdesa['oppitecantid'], 2, ',', '.') : '---' ;?></b></font></td>
	          			<td class="NoiseDataTD cont-field-b" width="10%">&nbsp;---</td>
	         		</tr>
	         		<tr>
	         			<td class="NoiseDataTD cont-field-b" colspan="4">&nbsp;</td>
	         		</tr>
	         	</table>
	         	<?php
					}
				?>
			</div>
			<!-- 	FIN CONTENIDO GENERAL  -->
			<br>
			
			<?php if($nrOppextrusion > 0):?>
			<!-- TITULO GENERAL -->
	 		<div class="ui-widget-content">
	          	<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
					<tr class="ui-widget-header">
	          			<td>&nbsp;<b>NECESIDAD DE LOS PROGRAMAS GENERAL {RESINAS}</b></td>
	          			<td>&nbsp;</td>
	         		</tr>
	         	</table>
	         </div>
	        <!-- FIN TITULO GENERAL --> 
			<?php endif;?>
			
			<!-- 	CONTENIDO GENERAL -->
			<div class="ui-widget-content contenido-general-inf">
				<?php  
					$arrMateriales = array();
					for($a = 0; $a < $nrOppextrusion; $a++)
	          		{
	          			$rwOppextrusion = fncfetch($rsOppextrusion,$a);
	          			$rwViewFormulacion = loadrecordvistaformulacion1($rwOppextrusion['formulnumero'],$idcon);
	         	?>
	         	<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" class="ui-widget-content">
					<tr>
	          			<td class="NoiseFooterTD cont-field-b" width="10%">&nbsp;MEZCLA</td>
	          			<td class="NoiseFooterTD cont-field-b" width="70%">&nbsp;Responsable</td>
	          			<td class="NoiseFooterTD cont-field-b" width="10%">&nbsp;KILOS&nbsp;<b>(kg)</b>&nbsp;</td>
	          			<td class="NoiseFooterTD cont-field-b" width="10%">&nbsp;METROS&nbsp;<b>(mts)</b>&nbsp;</td>
	         		</tr>
					<tr>
	          			<td class="NoiseDataTD cont-field-b" width="10%">&nbsp;<font color="#FF0000"><b><?php echo $rwOppextrusion['formulnumero'] ?></b></font></td>
	          			<td class="NoiseDataTD cont-field-b" width="70%">&nbsp;<font color="#000080"><b><?php echo ($rwViewFormulacion['usuacodi'])? cargausuanombre($rwViewFormulacion['usuacodi'], $idcon) : '---' ;?></b></font></td>
	          			<td class="NoiseDataTD cont-field-b" width="10%">&nbsp;<font color="#000080"><b><?php echo ($rwOppextrusion['ordoppcantkg'])? number_format($rwOppextrusion['ordoppcantkg'], 2, ',', '.') : '---' ;?></b></font></td>
	          			<td class="NoiseDataTD cont-field-b" width="10%">&nbsp;---</td>
	         		</tr>
	         		<tr>
	         			<td class="NoiseDataTD cont-field-b" colspan="4">&nbsp;</td>
	         		</tr>
	         	<?php 
	          			$rsItemFormul = dinamicscanitemformulgen(array('formulcodigo' => $rwViewFormulacion['formulcodigo']),array('formulcodigo' => '='),$idcon);
	          			$nrItemFormul = fncnumreg($rsItemFormul);
	          			for($b = 0; $b < $nrItemFormul; $b++)
	          			{
	          				$rwItemFormul = fncfetch($rsItemFormul,$b);
							$rwItemdesa = loadrecorditemdesa($rwItemFormul['itedescodigo'],$idcon);
							//objetos a utilizar
							$objs_iteforporcen = 'iteforporcen_'.$rwItemFormul['itedescodigo'];//porcentaje del item en la capa
							$objs_formulcapa = 'formulcapa'.strtolower($rwItemFormul['iteforcapa']);//capa del item
							$$objs_iteforporcen = $$objs_iteforporcen + (($rwItemFormul['iteforporcen'] / 100) * ($rwViewFormulacion[$objs_formulcapa] / 100));
	          			}
	          			
	          			$rsItemFormul = dinamicscanitemformulgen1(array('formulcodigo' => $rwViewFormulacion['formulcodigo']),array('formulcodigo' => '='),$idcon);
	          			$nrItemFormul = fncnumreg($rsItemFormul);
	          			for($b = 0; $b < $nrItemFormul; $b++)
	          			{
							$rwItemFormul = fncfetch($rsItemFormul,$b);
							$rwItemdesa = loadrecorditemdesa($rwItemFormul['itedescodigo'],$idcon);
							//objetos a utilizar
							$objs_iteforporcen = 'iteforporcen_'.$rwItemFormul['itedescodigo'];//porcentaje del item en la capa
							$arrMateriales[$rwItemFormul['itedescodigo']]['itedescodigo'] = $rwItemdesa['itedescodigo'];
							$arrMateriales[$rwItemFormul['itedescodigo']]['sum'] += $$objs_iteforporcen * $rwOppextrusion['ordoppcantkg'];
			?>
					<tr>
	          			<td class="NoiseFooterTD cont-field-b" width="10%">&nbsp;</td>
	          			<td class="NoiseFooterTD cont-field-b" width="70%">&nbsp;RESINA</td>
	          			<td class="NoiseFooterTD cont-field-b" width="10%">&nbsp;PORCENTAJE&nbsp;<b>(%)</b>&nbsp;</td>
	          			<td class="NoiseFooterTD cont-field-b" width="10%">&nbsp;KILOS&nbsp;<b>(kg)</b>&nbsp;</td>
	         		</tr>
					<tr>
	          			<td class="NoiseDataTD cont-field-b" width="10%">&nbsp;</td>
	          			<td class="NoiseDataTD cont-field-b" width="70%">&nbsp;<font color="#000080"><b><?php echo ($rwItemdesa['itedesnombre'] && $rwItemdesa['itedescodigo'])? $rwItemdesa['itedescodigo'].' - '.$rwItemdesa['itedesnombre'] : '---' ;?></b></font></td>
	          			<td class="NoiseDataTD cont-field-b" width="10%">&nbsp;<font color="#000080"><b><?php echo ($$objs_iteforporcen)? number_format($$objs_iteforporcen * 100, 2, ',', '.') : '---' ;?></b></font></td>
	          			<td class="NoiseDataTD cont-field-b" width="10%">&nbsp;<font color="#000080"><b><?php echo ($$objs_iteforporcen && $rwOppextrusion['ordoppcantkg'])? number_format($$objs_iteforporcen * $rwOppextrusion['ordoppcantkg'], 2, ',', '.') : '---' ;?></b></font></td>
	         		</tr>
	         		<tr>
	         			<td class="NoiseDataTD cont-field-b" colspan="4">&nbsp;</td>
	         		</tr>
			<?php 
	          			}
	          ?>
	          </table>
	          <?php   			
	          		}
	          	?>
	 		</div>
	 		
	 		<?php if(count($arrMateriales) > 0):?>
	 		<!-- TITULO SUMATORIA RESINAS -->
	 		<div class="ui-widget-content">
	          	<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
					<tr class="ui-widget-header">
	          			<td>&nbsp;<b>SUMATORIA {RESINAS}</b></td>
	          			<td>&nbsp;</td>
	         		</tr>
	         	</table>
	         </div>
	        <!-- FIN TITULO SUMATORIA RESINAS -->
	        <?php endif;?>
	        
	        <!-- 	CONTENIDO GENERAL SUMATORIA RESINAS-->
			<div class="ui-widget-content contenido-general-inf">
	        	<?php 	        
	        		foreach($arrMateriales as $arrValue)
	        		{
	       		?>
	       		<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" class="ui-widget-content">
					<tr>
	          			<td class="NoiseFooterTD cont-field-b" width="10%">&nbsp;Item</td>
	          			<td class="NoiseFooterTD cont-field-b" width="70%">&nbsp;Material</td>
	          			<td class="NoiseFooterTD cont-field-b" width="10%">&nbsp;KILOS&nbsp;<b>(kg)</b>&nbsp;</td>
	          			<td class="NoiseFooterTD cont-field-b" width="10%">&nbsp;METROS&nbsp;<b>(mts)</b>&nbsp;</td>
	         		</tr>
					<tr>
	          			<td class="NoiseDataTD cont-field-b" width="10%">&nbsp;<font color="#FF0000"><b><?php echo str_pad( $arrValue['itedescodigo']  , 3, "0", STR_PAD_LEFT) ?></b></font></td>
	          			<td class="NoiseDataTD cont-field-b" width="70%">&nbsp;<font color="#000080"><b><?php echo ($arrValue['itedescodigo'])? carganombitemdesa($arrValue['itedescodigo'], $idcon) : '---' ;?></b></font></td>
	          			<td class="NoiseDataTD cont-field-b" width="10%">&nbsp;<font color="#000080"><b><?php echo ($arrValue['sum'])? number_format($arrValue['sum'], 2, ',', '.') : '---' ;?></b></font></td>
	          			<td class="NoiseDataTD cont-field-b" width="10%">&nbsp;---</td>
	         		</tr>
	         		<tr>
	         			<td class="NoiseDataTD cont-field-b" colspan="4">&nbsp;</td>
	         		</tr>
	         	</table>
	    		<?php 
					}
	        	?>
	        </div>
	 		<!-- 	FIN CONTENIDO GENERAL SUMATORIA RESINAS-->
	 		
	 		
	 		
	 		
	 		
	 		
	 		
	 		
	 		
	 		
	 		
	 		
	 		
	 		
	 		
	 		<br>
			<!-- TITULO ORDENES {OPP}-->
	 		<div class="ui-widget-content">
	          	<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
					<tr class="ui-widget-header">
	          			<td>&nbsp;<b>NECESIDAD DE LOS PROGRAMAS POR ORDEN {OPP}</b></td>
	         			<td>&nbsp;</td>
	         		</tr>
	         	</table>
	         </div>
	        <!-- FIN TITULO ORDENES {OPP}--> 
	         
	         <!-- 	CONTENIDO POR ORDENES {OPP} -->
			<div class="ui-widget-content contenido-general-inf">
	          	<?php	 
	          		unset($rsOppitemdesa,$nrOppitemdesa,$rwOppitemdesa,$rsOppextrusion,$nrOppextrusion,$rwOppextrusion);         
	          		$rsOppitemdesa = dinamicscanoppitemdesaopp($ircrecord,$ircrecordop,$idcon);
	          		$nrOppitemdesa = fncnumreg($rsOppitemdesa);
	          		
	          		$rsOppextrusion = dinamicscanoppextrusiongen1($ircrecord,$ircrecordop,$idcon);
	          		$nrOppextrusion = fncnumreg($rsOppextrusion);
	          		
					if(!$nrOppitemdesa && !$nrOppextrusion)
					{
				?>
				<div class="ui-widget">
	 				<div style="margin-top: 1px; padding: 0 .7em;" class="ui-state-highlight ui-corner-all"> 
  						<p><span style="float: left; margin-right: .3em;" class="ui-icon ui-icon-info"></span>
  						<b>No se encontraron OPP.</b></p>
 					</div>
				</div>
				<?php 
					}
					
	          		for($a = 0; $a < $nrOppitemdesa; $a++)
	          		{
	          			$rwOppitemdesa = fncfetch($rsOppitemdesa,$a);
	          			$rsOp = dinamicscanop(array('ordoppcodigo' => $rwOppitemdesa['ordoppcodigo']),$idcon);
	          			$nrOp = fncnumreg($rsOp);
	          			for( $b = 0; $b < $nrOp; $b++)
	          			{
	          				$rwOp = fncfetch($rsOp,$b);	
	          			}
	          	?>
	          	<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" class="ui-widget-content">
					<tr>
	          			<td class="NoiseFooterTD cont-field-b" width="10%">&nbsp;OPP</td>
	          			<td class="NoiseFooterTD cont-field-b" width="10%">&nbsp;Item</td>
	          			<td class="NoiseFooterTD cont-field-b" width="50%">&nbsp;Material</td>
	          			<td class="NoiseFooterTD cont-field-b" width="10%">&nbsp;Estado</td>
	          			<td class="NoiseFooterTD cont-field-b" width="10%">&nbsp;KILOS&nbsp;<b>(kg)</b>&nbsp;</td>
	          			<td class="NoiseFooterTD cont-field-b" width="10%">&nbsp;METROS&nbsp;<b>(mts)</b>&nbsp;</td>
	         		</tr>
					<tr>
	          			<td class="NoiseDataTD cont-field-b" width="10%">&nbsp;<font color="#FF0000"><b><?php echo str_pad( $rwOp['solprocodigo']  , 3, "0", STR_PAD_LEFT) ?></b></font></td>
	          			<td class="NoiseDataTD cont-field-b" width="10%">&nbsp;<font color="#FF0000"><b><?php echo ($rwOppitemdesa['itedescodigo'])? $rwOppitemdesa['itedescodigo'] : '---' ;?></b></font></td>
	          			<td class="NoiseDataTD cont-field-b" width="50%">&nbsp;<font color="#000080"><b><?php echo ($rwOppitemdesa['itedescodigo'])? carganombitemdesa($rwOppitemdesa['itedescodigo'], $idcon) : '---' ;?></b></font></td>
	          			<td class="NoiseDataTD cont-field-b" width="10%">&nbsp;<font color="#000080"><b><?php echo ($rwOp['opestacodigo'])? cargaopestanombre($rwOp['opestacodigo'],$idcon) : '---' ;?></b></font></td>
	          			<td class="NoiseDataTD cont-field-b" width="10%">&nbsp;<font color="#000080"><b><?php echo ($rwOppitemdesa['oppitecantid'])? number_format($rwOppitemdesa['oppitecantid'], 2, ',', '.') : '---' ;?></b></font></td>
	          			<td class="NoiseDataTD cont-field-b" width="10%">&nbsp;---</td>
	         		</tr>
	         		<tr>
	         			<td class="NoiseDataTD cont-field-b" colspan="6">&nbsp;</td>
	         		</tr>
	         	</table>
	         	<?php
					}

					for($a = 0; $a < $nrOppextrusion; $a++)
	          		{
	          			$rwOppextrusion = fncfetch($rsOppextrusion,$a);
	          			$rsOp = dinamicscanop(array('ordoppcodigo' => $rwOppextrusion['ordoppcodigo']),$idcon);
	          			$nrOp = fncnumreg($rsOp);
	          			for( $b = 0; $b < $nrOp; $b++)
	          			{
	          				$rwOp = fncfetch($rsOp,$b);	
	          			}
	         	?>
	         	<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" class="ui-widget-content">
					<tr>
	          			<td class="NoiseFooterTD cont-field-b" width="10%">&nbsp;OPP</td>
	          			<td class="NoiseFooterTD cont-field-b" width="10%">&nbsp;MEZCLA</td>
	          			<td class="NoiseFooterTD cont-field-b" width="50%">&nbsp;Material</td>
	          			<td class="NoiseFooterTD cont-field-b" width="10%">&nbsp;Estado</td>
	          			<td class="NoiseFooterTD cont-field-b" width="10%">&nbsp;KILOS&nbsp;<b>(kg)</b>&nbsp;</td>
	          			<td class="NoiseFooterTD cont-field-b" width="10%">&nbsp;METROS&nbsp;<b>(mts)</b>&nbsp;</td>
	         		</tr>
					<tr>
	          			<td class="NoiseDataTD cont-field-b" width="10%">&nbsp;<font color="#FF0000"><b><?php echo str_pad( $rwOppextrusion['solprocodigo']  , 3, "0", STR_PAD_LEFT) ?></b></font></td>
	          			<td class="NoiseDataTD cont-field-b" width="10%">&nbsp;<font color="#FF0000"><b><?php echo ($rwOppextrusion['formulnumero'])? $rwOppextrusion['formulnumero'] : '---' ;?></b></font></td>
	          			<td class="NoiseDataTD cont-field-b" width="50%">&nbsp;<font color="#000080"><b><?php echo ($rwOppextrusion['paditecodigo'])? cargapadreitemnombre($rwOppextrusion['paditecodigo'], $idcon) : '---' ;?></b></font></td>
	          			<td class="NoiseDataTD cont-field-b" width="10%">&nbsp;<font color="#000080"><b><?php echo ($rwOp['opestacodigo'])? cargaopestanombre($rwOp['opestacodigo'],$idcon) : '---' ;?></b></font></td>
	          			<td class="NoiseDataTD cont-field-b" width="10%">&nbsp;<font color="#000080"><b><?php echo ($rwOppextrusion['ordoppcantkg'])? number_format($rwOppextrusion['ordoppcantkg'], 2, ',', '.') : '---' ;?></b></font></td>
	          			<td class="NoiseDataTD cont-field-b" width="10%">&nbsp;---</td>
	         		</tr>
	         		<tr>
	         			<td class="NoiseDataTD cont-field-b" colspan="6">&nbsp;</td>
	         		</tr>
	         	</table>
	         	<?php 
	          		}
	         	?>
	 		</div>
	 		<!-- 	CONTENIDO POR ORDENES {OPP} -->
	 		
	 		
    <!-- 	PIE DE PAGINA -->
			<br><br>
			<div class="contenido-general-inf">
				<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
					<tr>
						<td colspan="10" align="center"><b>PLASTICEL S.A - L&iacute;deres en la Tranformaci&oacute;n del Pl&aacute;stico</b></td>
					</tr>
					<tr>
						<td colspan="10" align="center">Calle 15 #29-69 Acopi. Yumbo, Valle del Cauca Colombia Tel&eacute;fono (572) 6901010 www.plasticel.com e-mail info@plasticel.com </td>
	          		</tr>
	    		</table>
			</div>
			<!-- 	FIN PIE DE PAGINA -->
			
	 	</div>
	 </div>
<!-- 	FIN CONTENIDO GENERAL -->
			<input type="hidden" name="arrop" id="arrop" value="<?php echo $arrop?>" />
			<input type="hidden" name="codigo" id="codigo" value="<?php echo $codigo; ?>" />
		</form>
		<div id="msgwindow" title="Adsum Kallpa"><span id="msg"></span></div>
  	</body>
<?php if(!$codigo){ echo " -->"; } ?>
</html>