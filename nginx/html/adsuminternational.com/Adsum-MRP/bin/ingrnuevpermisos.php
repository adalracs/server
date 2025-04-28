<?php	
	include ( '../src/FunPerPriNiv/pktblmenucomp.php');
	include ( '../src/FunPerSecNiv/fncnumreg.php');
	include ( '../src/FunPerSecNiv/fncfetch.php');
	include ( '../src/FunPerPriNiv/pktblgrupcomp.php');
	include ( '../src/FunPerSecNiv/fncclose.php');
	include ( '../src/FunPerSecNiv/fncconn.php');
	
	if($grupnomb){
		include('validagrupnom.php');
	}
	if($flagret){
		include('grabahijo.php');
		$recval = explode(',',$valores1);
		$recpad = explode(',',$arrpad);
		$nomtemp = array_pop($recval);
		$rectemp = array_pop($recpad);
		unset($nomtemp);
		unset($rectemp);
	
		if($ed){
			include('editagrupo.php');
			include('borrahijo.php');
			if($recval){
				borrahijo($grupcodi);
				grabahijo($recval,$recpad,$grupcodi);
				print	'<script language="JavaScript">
						<!-- Begin
							location="maestablgrupo.php?codigo=1";
						// End -->
					</script>';
        			}
		}else{
        			if($recval){
	        			grabahijo($recval,$recpad,$idgrupotemp);
	            		print	'<script language="JavaScript">
                					<!-- Begin
                  						location="maestablgrupo.php?idgrupotemp='.$idgrupotemp.'&codigo=1&accionnuevogrupo=1&grupnomb='.$grupnomb.'&grupedit='.$grupedit.'";
                					//  End -->
               				</script>';
        			}
        		}
    	}
?>

<html>
	<SCRIPT language=JavaScript src="../src/FunGen/fncllenacheckbox.js"		type="text/javascript" ></SCRIPT>
	<script language="JavaScript">
    		<!-- Begin
		function sig(){
			var valores1 = "";
        			
			document.form1.flagret.value = 1;
        			
			for (var i=0;i < document.form1.elements.length;i++){
            			if(document.form1.elements[i].type == "checkbox" && document.form1.elements[i].checked == true){
                  				valores1 = valores1+document.form1.elements[i].value+",";
            			}
        			}
        			if(valores1 == ""){
            			alert("selecione alguna casilla");
            			return;
        			}
        			document.form1.action='ingrnuevpermisos.php?valores1='+valores1;
        			document.form1.submit();
    		}
		function verocultar(cual, index) {
			var c=cual.nextSibling;
			if(c.style.display=='none') {
				c.style.display='block';
				document.getElementById("row"+ index).src = "temas/Noise/AscOn.gif";			           
			}else{
				c.style.display='none';
				document.getElementById("row"+ index).src = "temas/Noise/DescOn.gif";			           			           
			}
			return false;
		}
		//  End -->
	</script>
	<SCRIPT language=JavaScript src="../src/FunGen/fncllenacheckbox.js"		type="text/javascript" ></SCRIPT>
	<style type="text/css">
		.estilo1 {font-size: 85%; font-family : Arial; color : #999999 } 
		.estilo2 {font-size: 90%; font-family : Arial } 
	</style>
	<head>
		<title>Asignaci&oacute;n de permisos</title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		<link rel="stylesheet" type="text/css" href="temas/Noise/Style.css">
		<link rel="stylesheet" type="text/css" href="temas/Noise/help.css">		
	</head>
	<body bgcolor="#FFFFFF" text="#000000">
		<div align="center">
			<form name="form1" method="post" enctype="multipart/form-data">
    				<table width="90%" border="0" cellspacing="1" cellpadding="2" class="NoiseFormTABLE">
      					<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr>
      					<tr><td class="NoiseFieldCaptionTD"><span class="style5"><font color="FFFFFF">Asignaci&oacute;n de permisos</font></span></td></tr>
      					<tr>
						<td colspan="2">
          							<table width="100%">
            							<tr><td bgcolor="#E8F0F6">
									<table cellspacing = "0" cellpadding = "0" width = "100%" bgcolor = "#f7f7f7" border = "0" align = "center">
                  									<tbody>
											<tr><td colspan="13"></td></tr>                  									
											<tr>
												<td width = "45%">&nbsp;</td>
												<td><font color = "#E8F0F6" ><b>|</b></font></td> 
												<td class = "estilo1" width = "11%"  align="center">N = Nuevo</td>
												<td><font color = "#E8F0F6" ><b>|</b></font></td>  
												<td class = "estilo1" width = "11%" align="center">C = Consultar</td>
												<td><font color = "#E8F0F6" ><b>|</b></font></td>  
												<td class = "estilo1" width = "11%" align="center">D = Detallar</td>
												<td><font color = "#E8F0F6" ><b>|</b></font></td>  
												<td class = "estilo1" width = "11%" align="center">B = Borrar</td>
												<td><font color = "#E8F0F6" ><b>|</b></font></td>  
												<td class = "estilo1" width = "11%" align="center">M = Modificar</td>
												<td><font color = "#E8F0F6" ><b>|</b></font></td>  
												<td valign="middle">&nbsp;</td>
											</tr>
											<tr><td colspan="13"></td></tr>
											<tr><td class="NoiseErrorDataTD" colspan="13"></td></tr>
											<tr><td colspan="13"></td></tr>				
											<tr><td class="NoiseErrorDataTD" colspan="13"></td></tr>
											<tr><td colspan="13"></td></tr>															
							
											<tr>			
												<td width = "45%">&nbsp;</td>
												<td><font color = "#E8F0F6" ><b>|</b></font></td>  
												<td  valign="middle" class = "estilo2" colspan = "10" ><b>Seleccionar todos&nbsp;<input type=checkbox name="incheck" onclick="llenachekall(this);"></b></td>
												<td valign="middle">&nbsp;</td>
											</tr>
											<tr><td colspan="13"></td></tr>
											<tr><td class="NoiseErrorDataTD" colspan="13"></td></tr>
											<tr><td colspan="13"></td></tr>				
											<tr><td class="NoiseErrorDataTD" colspan="13"></td></tr>
											<tr><td colspan="13"></td></tr>
										</tbody>
              								</table>
                								<table cellspacing = "0" cellpadding = "0" width = "100%" bgcolor = "#f7f7f7" border = "0" align = "center">
                  									<tbody>
                    									<?php
								                                include('../src/FunGen/fncpintacheckbox.php');
								                                include('../src/FunGen/fncpintacheckboxed.php');
								                                $rec = explode(',',$valores);
								                                $nom = explode(',',$nombres);
								                                $nomtemp = array_pop($nom);
								                                $rectemp = array_pop($rec);
								                                unset($nomtemp);
								                                unset($rectemp);
								                                $conn = fncconn();
                                
								                                if($grupcodi){
								                                	$arrpad = fncpintacheckboxed($rec,$nom,4,$grupcodi,$conn);
								                                   	$ed = 1;
								                                }else{
												$arrpad = fncpintacheckbox($rec,$nom,4,$conn);
												$ed = 0;
								                                }
								                                fncclose($conn);
                  									?>
              									</tbody>
              								</table>
              							</td></tr>
        							</table>
        						</td>
      					</tr>
      					<tr><td colspan="2"><div align="right">
            					<input type="image" name="aceptar" onclick="sig();" alt="Aceptar" border=0 width="86" height="18" src="../img/aceptar.gif">
            					<input type="image" name="cancelar" onclick="form1.flageditargrupo.value=1;form1.action='maestablgrupo.php';" alt="Cancelar" border=0 src="../img/cancelar.gif" width="86" height="18" >
        					</div></td></tr>
      					<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr>
				</table>
				<input type="hidden" name="codigo" value="<?php echo $codigo; ?>">
				<input type="hidden" name="arrpad" value="<?php echo $valores; ?>">
				<input type="hidden" name="idgrupotemp" value="<?php echo $idgrupotemp; ?>">
				<input type="hidden" name="grupnomb" value="<?php echo $grupnomb; ?>">
				<input type="hidden" name="grupedit" value="<?php echo $grupedit; ?>">
				<input type="hidden" name="grupcodi" value="<?php echo $grupcodi; ?>">
				<input type="hidden" name="flagret">
				<input type="hidden" name="ed" value="<?php echo $ed; ?>">
				<input type="hidden" name="accioneditargrupo" value="<?php echo $accioneditargrupo; ?>">
				<input type="hidden" name="flageditargrupo">
  			</form>
		</div>
	</body>
</html>

