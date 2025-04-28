<?php
	include("../src/FunPerPriNiv/pktblcampo.php");
	include("../src/FunPerPriNiv/pktblot.php");
	include("../src/FunPerPriNiv/pktbltareot.php");
	include("../src/FunPerPriNiv/pktblplanta.php");
	include("../src/FunPerPriNiv/pktblsistema.php");
	include("../src/FunPerPriNiv/pktblequipo.php");
	include("../src/FunPerPriNiv/pktblcomponen.php");
	include("../src/FunPerPriNiv/pktblusuaequipo.php");
	include("../src/FunPerPriNiv/pktblusuario.php");
	include("../src/FunPerPriNiv/pktbltipoequipo.php");
	include("../src/FunPerPriNiv/pktblestado.php");
	include("../src/FunPerPriNiv/pktblotestado.php");
	include("../src/FunPerPriNiv/pktblcentcost.php");
	include("../src/FunPerPriNiv/pktblnormaseguri.php");
	include("../src/FunPerPriNiv/pktblmanual.php");
	include("../src/FunPerPriNiv/pktbldocuequi.php");
	include("../src/FunPerPriNiv/pktblnormaseguriequipo.php");
	include("../src/FunPerPriNiv/pktblreportot.php");
	include("../src/FunPerPriNiv/pktbltarea.php");
	include("../src/FunPerPriNiv/pktblparaprod.php");
	
	include("detallahojavida.php");
	// Registra la variable de sesion
	if (!session_is_registered("htmlreport"))
	//	session_register("htmlreport");
?>
<html>
	<head>
		<title>Hoja de vida</title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		<meta http-equiv="expires" content="0">
		<link rel="stylesheet" type="text/css" href="temas/Noise/Style.css">
		<SCRIPT LANGUAGE="JavaScript">
		<!-- Begin
			agree = 0;
		//  End -->
		</script>
		<script language="JavaScript" src="motofech.js"></script>
		<style type="text/css">
		<!--
			.Estilo1 {color: #000000}
		-->
		</style>
	</head>
<?php if(!$codigo){ echo "<!--";} ?>
	<body bgcolor="FFFFFF" text="#000000" onload="window.print();">
		<form name="form1" method="post"  enctype="multipart/form-data">
  			<table border="0" align="center" cellpadding="1" cellspacing="1" width="80%">
    			<tr>
      				<th scope="col"><img src="../img/adsumcuasipequeno.jpg"></th>
      				<th scope="col">
      					<p align="center" class="Estilo1"><font face="Verdana">Hoja de Vida</font></p>
      				</th>
    			</tr>
    			<tr>
      				<th colspan="2" scope="col">
      					<table border="0" width="95%" align="center" cellpadding="1" cellspacing="1">
							<?php ob_start(); ?>
        					<tr bgcolor="#5961A0"><td colspan="4">&nbsp;</td></tr>
        					<tr>
          						<TD class="NoiseFooterTD" colspan="4"><B>&nbsp;Planta:</B>&nbsp;<?php echo  $plantanombre; ?></TD>
          					</tr>   
        					<tr><td></td></tr>  
        					<?php 
        						$numsistem = fncnumreg($arrsistema);
        						if($numsistem >= 1)
        						{
        							for($a = 0; $a < $numsistem; $a++)
        							{
        								$sistema = fncfetch($arrsistema, $a);	
       						?>
        					<tr>
          						<TD colspan="4" class="NoiseFooterTD"><B>&nbsp;Sistema:</B>&nbsp;<?php  echo $sistema['sistemnombre'];?></TD>
        					</tr>
        					<?php 
        								$numequipo = fncnumreg($arrequipo);
        						
        								if($numequipo == 0)
        								{
        									$idcon = fncconn();
        									$iRegEquipo['sistemcodigo'] = $sistema['sistemcodigo'];
											$iRegEquipoop['sistemcodigo'] = '=';
				
											$arrequipo = dinamicscanopequipo($iRegEquipo, $iRegEquipoop, $idcon);
				
											$numequipo = fncnumreg($arrequipo);
        								}
        	
        								for($b = 0; $b < $numequipo; $b++)
       									{
        									$equipo = fncfetch($arrequipo, $b);
        					?>
        					<tr>
          						<TD colspan="2" class="NoiseErrorDataTD"><B>&nbsp;Equipo:</B>&nbsp;<?php echo  $equipo['equipocodigo']; ?> -             <?php  echo $equipo['equiponombre'];?></TD>
          						<TD colspan="2" class="NoiseFooterTD"><B>&nbsp;Tipo:</B>&nbsp;<?php  echo $arrtipoequipo['tipequnombre']; ?></TD>
        					</tr>
        					<tr>  
           						<TD colspan="2" class="NoiseFooterTD"><B>&nbsp;Estado:</B>&nbsp;<?php  echo $arrestado['estadonombre']; ?></TD>
              					<td colspan="2" class="NoiseFooterTD">&nbsp;</td>
        					</tr>
        					<tr><td colspan="4"><hr></td></tr>
        					<tr>
          						<TD colspan="2" class="NoiseFooterTD"><strong>&nbsp;Mantenedor a cargo</strong></td>
          						<TD colspan="2" class="NoiseFooterTD"><?php echo $arrresponsable['usuacodi']?> - <?php echo $arrnombre['usuanombre'].' '.$arrnombre['usuapriape']?></td>
        					</tr>
        					<TR>
          						<TD width="28%" class="NoiseFooterTD"><b>&nbsp;Centro de costos</b></TD>
          						<TD colspan="3" class="NoiseFooterTD"><?php echo  $arrcentcost['cencosnumero']; ?></TD>
        					</TR>
        					<TR>
          						<TD class="NoiseFooterTD"><strong>&nbsp;Ubicaci&oacute;n</strong></TD>
          						<TD colspan="3" class="NoiseFooterTD"><?php echo  $equipo['equipoubicac']; ?></TD>
          					</tr>
        					<?php
									     	$idcon = fncconn();
									     	$arrresponsable= loadrecordusuaequipo1($equipo['equipocodigo'],$idcon);
							                $arrnombre = loadrecordusuario($arrresponsable['usuacodi'],$idcon);
											fncclose($idcon);
				    		?>
        					<TR class="NoiseFooterTD">
          						<td class="NoiseFooterTD"><b>&nbsp;Fabricante</b></td>
          						<td class="NoiseFooterTD"><?php echo  $equipo['equipofabric']; ?></td>
          						<td width="22%" class="NoiseFooterTD"><b>&nbsp;Marca</b></td>
          						<td width="31%" class="NoiseFooterTD"><?php echo  $equipo['equipomarca']; ?></td>
        					</TR>
        					<TR>
          						<TD class="NoiseFooterTD"><b>&nbsp;Modelo</b></TD>
          						<TD width="19%" class="NoiseFooterTD"><?php echo  $equipo['equipomodelo']; ?></TD>
          						<TD class="NoiseFooterTD"><b>&nbsp;No. de serie</b></TD>
          						<TD class="NoiseFooterTD"><?php echo  $equipo['equiposerie']; ?></TD>
        					</tr>
        					<TR>
          						<TD class="NoiseFooterTD"><b>&nbsp;No. Activo fijo</b></TD>
          						<TD class="NoiseFooterTD"><?php echo  $equipo['equipoviduti']; ?></TD>
          						<TD class="NoiseFooterTD"><b>&nbsp;No. inv. T&eacute;cnico</b></TD>
          						<TD class="NoiseFooterTD"><?php echo  $equipo['equipovalhor']; ?></TD>
        					</tr>
        					<TR>
					          	<TD class="NoiseFooterTD"><b>&nbsp;Fecha de Compra</b></TD>
					          	<TD class="NoiseFooterTD"><?php echo  $equipo['equipofeccom']; ?></TD>
					          	<TD class="NoiseFooterTD"><b>&nbsp;Costo de Inversi&oacute;n</b></TD>
					          	<TD class="NoiseFooterTD"><?php echo  $equipo['equipocinv']; ?></TD>
        					</tr>
        					<TR>
          						<td class="NoiseFooterTD"><b>&nbsp;Fecha de Instalaci&oacute;n</b></td>
          						<td class="NoiseFooterTD"><?php echo  $equipo['equipofecins']; ?></td>
          						<td class="NoiseFooterTD"><B>&nbsp;Fec. Vencimiento de Garant&iacute;a</B></td>
          						<td class="NoiseFooterTD"><?php echo  $equipo['equipovengar']; ?></td>
        					</tr>
        					<TR>
          						<TD class="NoiseFooterTD"><b>&nbsp;Descripci&oacute;n:</b></TD>
          						<TD colspan="3" class="NoiseFooterTD"><?php echo  $equipo['equipodescri']; ?></TD>
          					</TR>
        					<?php
			 								if (!empty($arrtipoequipo['tipequcodigo']))
												include("detallahoravidacampos.php");
							?>
							<TR>
          						<td class="NoiseFooterTD"><B>&nbsp;Informaci&oacute;n T&eacute;cnica</B></td>
          						<td class="NoiseFooterTD" colspan="3">
          						<?php
									     	$idcon = fncconn();
									     	$arrdocuequi= loadrecorddocuequi1($equipo['equipocodigo'],$idcon);
									     	$arrnombre = loadrecordmanual($arrdocuequi['manualcodigo'],$idcon);
									     	echo $arrnombre['manualnombre'];
											fncclose($idcon);
    							?>
    							</td>
        					</tr>
							<tr><td colspan="4"><hr></td></tr>
							<?php 
        									$numcomponen = fncnumreg($arrcomponen);
        						
        									if($numcomponen > 0)
        									{
        										for($h = 0; $h < $numcomponen; $h++)
       											{
        											$componente = fncfetch($arrcomponen, $h);
        					?>
							<tr>
          						<TD colspan="4" class="NoiseErrorDataTD"><B>&nbsp;Componente:</B>&nbsp;<?php echo  $componente['componcodigo']; ?> -             <?php  echo $componente['componnombre'];?></TD>
        					</tr>
        					<?php   			} ?>
        					<tr><td colspan="4"><hr></td></tr>
        					<?php
        									}
 							// Almacena la primera pagina del reporte; datos basicos del
 							// equipo
			 								$_SESSION['htmlreport'] = ob_get_contents();
			 								$_SESSION['htmlreport'] .= "|||";
			 								ob_start();
							 // Si existen normas de seguirdad asociadas al equipo, se
							 // despliegan a continuacion
							//include("detallahojavidanormaseguri.php");
							?>
        					<tr bgcolor='#D8D9E6'>
          						<td colspan='4'><B>&nbsp;Ordenes de trabajo involucradas del equipo</B></td>
        					</tr>
							<?php
							// 	Despliega las ordenes de trabajo asociadas al equipo,
							// para el periodo seleccionado,
											include("detallahojavidaot.php");
											$_SESSION['htmlreport'] .= ob_get_contents();
											$_SESSION['htmlreport'] .= "|||".$equipocodigo;
       									}
       									unset($arrequipo, $numequipo);
        							}
        		
        						}
							?>
      					</TABLE>
      				</th>
    			</tr>
  			</table>
  			<CENTER>
 				<INPUT type="image" name="aceptar"  src="../img/aceptar.gif" onClick="form1.action='maestablhojavida.php?codigo=<?php echo  $codigo; ?>';"  width="86" height="18" alt="Aceptar" border=0>
 				<!--<INPUT type="image" name="imprimir" src="../img/imprimir.gif" onClick="window.open('detallahojavidasimprint.php','printReport','status=no,menubar=no,scrollbars=yes,resizable=yes,left=600,width=600,height=500'); return false;">-->
			</CENTER>
		</FORM>
	</body>
<?php if(!$codigo){ echo " -->"; } ?>
</html>
