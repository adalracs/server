<?php
	include ('../src/FunGen/sesion/fncvalses.php');
	include ('../src/FunPerPriNiv/pktblplanta.php');
	include ('../src/FunPerPriNiv/pktblsistema.php');
	include ('../src/FunPerPriNiv/pktblusuaplanta.php');
	include ('../src/FunPerPriNiv/pktbltipotrab.php');
	include ('../src/FunGen/sesion/fnccaf.php');
	
	$reccomact = fnccaf ( $GLOBALS [usuacodi], $_SERVER ["SCRIPT_FILENAME"] );
	
	$idcon = fncconn ();
	$arrplantas = loadrecordusuaplanta ( $GLOBALS [usuacodi], $idcon );
	fncclose ( $idcon );
?>
<html>
	<head>
		<title>Mantenimientos</title>
		<meta http-equiv="Content-Type" cont ent="text/html; charset=iso-8859-1">
		<meta http-equiv="expires" content="0">
		<link rel="stylesheet" type="text/css" href="temas/Noise/Style.css">
		<link rel="stylesheet" type="text/css" href="temas/Noise/help.css">
		<script language="JavaScript" src="motofech.js"></script>
		<SCRIPT LANGUAGE="JavaScript">
			function loadlista(){
				if (document.form1.plant.checked == true){
					document.all("plantas").src="detallarusuaplantareportes.php?plantall=1&arrdata=" + document.form1.arrplantas.value;
					document.form1.plantatmp.value = 1;
				}else{
					document.all("plantas").src="detallarusuaplantareportes.php?plantall=0&arrdata=" ;			
					document.form1.plantatmp.value = 0;		
				}
			}
		</script>
	</head>
<?php if (! $codigo) { echo "<!--"; } ?>
	<body bgcolor="FFFFFF" text="#000000">
		<form name="form1" method="post" enctype="multipart/form-data">
			<p><font class="NoiseFormHeaderFont">Indice de mantenimiento preventivo vs correctivo</font></p>
			<table border="0" cellspacing="1" cellpadding="2" align="center" class="NoiseFormTABLE" width="70%">
				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr>
				<tr><td class="NoiseFieldCaptionTD"><span class="style5"><font color="FFFFFF">Mantenimientos</font></span></td></tr>
				<tr>
					<td>
						<table width="98%" border="0" cellspacing="0" cellpadding="0">
          					<tr>
            					<td>
            						<table width="93%" border="0" cellspacing="1" cellpadding="1" align="center">
              							<tr class="NoiseFooterTD">
                							<td colspan="5" class="NoiseFooterTD">Ubique aqu&iacute; la(s) planta(s) sobre la que quiera consultar
                  								<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center">
                        							<tr><td class="NoiseFieldCaptionTD" colspan="2"></td></tr>
                        							<tr><td class="NoiseFieldCaptionTD" colspan="2"></td></tr>
                        							<tr><td height="350" colspan="2" class="NoiseFooterTD"><iframe	src="detallarusuaplantareportes.php?plantall=<?php echo $plantatmp; ?>&arrdata=<?php echo $arrplantas;	?>"frameborder="0" name="plantas" id="plantagen" height="350" width="100%" align="absmiddle"></iframe></td></tr>
                    							</table>
                  							</td>
              							</tr>
              							<tr>
							                <td colspan="4" class="NoiseErrorDataTD">
							                	Fecha
							                	<select name="data_mes">
							                		<option value="01" >Enero</option>
							                		<option value="02" >Febrero</option>
							                		<option value="03" >Marzo</option>
							                		<option value="04" >Abril</option>
							                		<option value="05" >Mayo</option>
							                		<option value="06" >Junio</option>
							                		<option value="07" >Julio</option>
							                		<option value="08" >Agosto</option>
							                		<option value="09" >Septiembre</option>
							                		<option value="10" >Octubre</option>
							                		<option value="11" >Noviembre</option>
							                		<option value="12" >Diciembre</option>
							                	</select>
												<select name="data_ano">
							                		<?php 
							                			$anoactual = date('Y') + 0;
							                			if(date('Y') >= '2010')
							                			{
								                			for($i = $anoactual; $i >= 2010 ; $i--)
								                				echo '                		<option value="'.$i.'" >'.$i.'</option>';
							                			}
							                			else
							                				echo '                		<option value="2010" >2010</option>';
							                		?>
							                	</select>
						                	</td>
					              		</tr>
            						</table>
            					</td>
            					<td>
            						<table width="93%" border="0" cellspacing="1" cellpadding="1" align="center">
              							<tr class="NoiseFooterTD"><td colspan="5" class="NoiseFooterTD">Tipos de trabajo</td></tr>
                      					<?php
											$nuConn = fncconn ();
											$nuResult = fullscantipotrab($nuConn);
											
											if ($nuResult > 0)
												$nuCantRow = pg_numrows ( $nuResult );
					
											for($i = 0; $i < $nuCantRow; $i ++) 
											{
												$sbRow = pg_fetch_row ( $nuResult, $i );
											
												if (($i % 2) == 0) 
													echo '<tr bgcolor="#f0f6ff"  id="fila' . ($i + 1) . '">' . " \n";
												else
													echo '<tr bgcolor="#E8F0F6"  id="fila' . ($i + 1) . '">' . " \n";
						
												echo '<td width="5%"   class="estilo1">';
												echo '<input type="checkbox" name="tipotrab'.$sbRow [0].'"  value="' . $sbRow [0] . '" ';
						
												if ($arrdata != true or $plantall) 
												{
													if ($arr_delitem)
														$arr_delitem = $arr_delitem . "," . $sbRow [0];
													else
														$arr_delitem = $sbRow [0];
												} 
												else
													$unless = 1;
						
												if ($arr_temp)
												$arr_temp = $arr_temp . "," . $sbRow [0];
												else
													$arr_temp = $sbRow [0];
						
												echo '></td>' . " \n";
												echo '<td width="95%"  class="estilo1" >&nbsp;' . $sbRow [1] . '</td>' . " \n";
												echo '<tr>' . " \n";
											}
											if ($i < 4) 
											{
												for($j = $i; $j < 4; $j ++) 
												{
													if (($j % 2) == 0)
														echo '              <tr bgcolor="#f0f6ff"><td>&nbsp;</td><td>&nbsp;</td></tr>' . " \n";
													else
														echo '<tr bgcolor="#E8F0F6"><td>&nbsp;</td><td>&nbsp;</td></tr>' . " \n";
												}
											}
										?>
            						</table>
            					</td>
          					</tr>
        				</table>
        			</td>
				</tr>
				<tr>
					<td><div align="center">
						<input type="image" name="aceptar" src="../img/aceptar.gif" onclick="form1.action='detallarepomantprcomes.php';" width="86"	height="18" alt="Aceptar" border=0>
						&nbsp;<input type="image" src="../img/cancelar.gif" border="0" alt="Cancelar" onClick="form1.action='main.php';">
					</div></td>
				</tr>
				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr>
			</table>
			<input type="hidden" name="codigo" value="<?php echo $codigo;?>">
			<input type="hidden" name="accionnuevoreportemant">
			<input type="text" name="strdataload" size="1" value=""	style="border: none; color: #FFFFFF;" onFocus="sendReq(this.value); this.value=''; this.blur();"> <!-- Data: EQUIPOS|e COMPONETNES|c -->
			<input type="hidden" name="strdata" value="<?php $strdata; ?>">
			<input type="hidden" name="plantatmp" value="<?php echo $plantatmp;	?>">
			<input type="hidden" name="arrplantas" value="<?php	echo $arrplantas; ?>">
		</body>
<?php if (! $codigo) {echo " -->"; } ?>
</html>