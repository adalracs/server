<?php 
	include ( '../src/FunGen/sesion/fncvalsesion.php');
	include ( '../src/FunPerPriNiv/pktblusuario.php');
	include( '../src/FunPerSecNiv/fncnumreg.php');
	include( '../src/FunPerSecNiv/fncfetch.php');
	include( '../src/FunPerPriNiv/pktblusuagrup.php'); 
	include( '../src/FunPerPriNiv/pktblgrupcomp.php');
	include( '../src/FunPerPriNiv/pktblmenucomp.php');
	include ('../src/FunGen/fncloadpresentac.php');

	$nuconn = fncconn();
	$rs_usuagrup = loadrecordusuagr($GLOBALS[usuacodi], $nuconn);
			
	if($rs_usuagrup > 0)
	{
		$isbacra = array(1 => 'sse', 2 => 'otp', 3 => 'otm', 4 => 'equ');
		
		foreach ($isbacra as $value) 
		{
			$reccadena= array("mecoacra" => $value,"timecodi" => 4);
			$nuresult = dinamicscanmenucomp($reccadena, $nuconn);
	
			if($nuresult > 0)
			{
				$sbRow = fncfetch($nuresult, 0);
				$isbacra[$value] = $sbRow[mecocodi];
				
				$rs_grupcomp = loadrecordgrupcomp($rs_usuagrup[grupcodi], $sbRow[mecocodi], $nuconn);
					
				if($rs_grupcomp > 0)
				{
					$cadenwindow[$sbRow[mecocodi]] = $sbRow[mecoscri].'?codigo='.$sbRow[mecocodi];
					
					$record= array("mecocopa" => $sbRow[mecocodi], "timecodi" => 5);
					$recordop= array("mecocopa" => '=',"timecodi" => '=');
					$rs_submenucomp = dinamicscanopgrupcomp($record, $recordop, $nuconn);
					
					$num_row = fncnumreg($rs_submenucomp);
					
					for($a = 0; $a < $num_row; $a++)
					{
						$sbRow_mc = fncfetch($rs_submenucomp, 0);
						$rs_subgrupcomp = loadrecordgrupcomp($rs_usuagrup[grupcodi], $sbRow_mc[mecocodi], $nuconn);
						
						if($rs_subgrupcomp > 0)
							$cadenwindow[$sbRow[mecocodi]] .= $sbRow_mc[meconomb].'=1';
					}
				}
			}
		}
	}
?> 

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
	<head>
	    <meta http-equiv="content-type" content="text/html; charset=ISO-8859-1">
	    <title>Orden de trabajo</title>
	    <?php include('../def/jquery.library_title.php');?>
	    <script type="text/javascript" src="../src/FunjQuery/jquery.bandejaot.js"></script>
	    <script>
	    	$(function(){

	    		$("#search_string").keyup(function(event){

	    			if(event.keyCode == 13){
        				$("#icons").click();
        				event.preventDefault();
        				return false;
    				}

				});
				
				$("#form1").keypress(function(e) {
        			if (e.which == 13) {
            			return false;
        			}
    			});


    			$("#det_seguimiento").button({ icons: { primary: "ui-icon-clipboard" }, text : false }).click(function() {
    				return false;
    			});

			});

		    function logout()
		    {
		    	//autor:lfolaya
		    	//Fecha:20040412
		    	//Descripcion:Permite cerrar sesion
		    	padre=window.open("","Adsum_","toolbar=0,status=0,menubar=0,resizable=1");
		    	padre.location.href="../index.html";
		        window.opener=top;
		        top.close();
		    }

		    function buscarpv(idevent){

		    	var pedvennumero = $("#search_string").val();

		    	$.ajax({	   
						dataType: "json",
					type: "POST",        
					url: "../src/FunjQuery/jquery.accionextras/jq.buscarpv.php", 	
					data: { pedvennumero : pedvennumero, idevent : idevent},
					beforeSend: function(data){ },        
					success: function(json_data){

						if(json_data){

							if(json_data.producproces > 0){

								if(idevent > 0){

									//alert("" + json_data.seguimiento);

									top.text.openMensajePV(json_data.seguimiento);
								}else{
									//alert( "PV No." + pedvennumero + " se encuentra en : " + json_data.modulo + " - Consecutivo No. " + json_data.produccodigo);
									var mensaje = "PV No." + pedvennumero + " se encuentra en : " + json_data.modulo + " - Consecutivo No. " + json_data.produccodigo
									top.text.openMensajePV(mensaje);
								}

							}else{

								/*$("#msgwindow-pv").dialog("open");
								$("#msg-pv").html("No se encontro PV No." + pedvennumero);
								alert("No se encontro PV No." + pedvennumero);*/

								top.text.openMensajePV(pedvennumero, 1);
							}

						}else{

							/*$("form").after( '<div id="msgwindow-pv" title="Adsum Kallpa"><span id="msg-pv"></span></div>' );
							$("#msgwindow-pv").dialog("open");
							$("#msg-pv").html("No se encontro PV No." + pedvennumero);
							alert("No se encontro PV No." + pedvennumero);*/

							top.text.openMensajePV(pedvennumero, 1);


						}

						$("#search_string").val("");

					},         
					error: function(requestData, strError, strTipoError){ },
					complete: function(requestData, exito){ }                                      
				});
		    }

		    function cronnBandeja(idusuario){
		    	
		    	accionBandejaOt(idusuario);
		    	accionWsitemCronn(idusuario);
		    	accionCalificacionAuto(idusuario);
			}
	    </script>
 		<style type="text/css">
			body { text-align: center; color: #000000; background: #DFE8F6; padding: 0px; margin: 0px; font-family:Tahoma; font-size:10px; }
			div.logo { position: absolute; top: 0px; left: 0px; }
			div.logo img { height: 48px; }
			div.tabs { position: absolute; width: 428px; bottom: 17px; left: 18em; background: transparent; margin: 0 0 0 0; padding: 0em 0em 0em 0em; border-collapse: collapse; white-space: nowrap; z-index: 2; }
			div.forms { position: absolute; bottom: 17px; left: 58em; margin: 0 0 0 0; padding: 0em 0em 0em 0em; border-collapse: collapse; white-space: nowrap; z-index: 3; }
			div.forms form { margin: 0 0 0 0; }
			div.personalBar { position: absolute; left:0; bottom: 0; width: 100%; color: #ffffff; padding: 0 0 0 0; text-transform: lowercase; font-size: 10px;   z-index: 1; }
	
			
	
			.location { float:left; margin-left: 2em; font-size: 10px; text-align:left ; }
			
			.auth { float:right; text-align:right; margin-right: 2em; text-transform: lowercase; font-size: 10px; height: 15px; padding-bottom: 0; }
			.auth a { background-color: transparent; color: #ffffff; font-weight: normal; margin-left: .5; text-decoration: none; }
			.auth a:hover { color: #0099CC; text-decoration: none; }
			input { background-color: #F5F5F5; border-style: solid; padding: 0px; margin: 0px 0px 0px 4px; font-family: "arial"; font-size: 9px; color: #333333; vertical-align: middle; height: 18px; border: 1px solid #4297D7; }
			li.ui-state-default:hover  { border: 1px solid #79b7e7; background: #d0e5f5 url(images/ui-bg_glass_75_d0e5f5_1x400.png) 50% 50% repeat-x; font-weight: bold; color: #1d5987; }
			ui-state-default  { font-size: 70%;}
			
		</style>
	</head>
	<body bgcolor="#F5F5F5" onLoad="setInterval('cronnBandeja(<?php echo $usuacodi; ?>);',60000);" ><!--  300000 mseg = 3 min onLoad="setInterval('cronnBandeja(<?php //echo $usuacodi; ?>);',60000);" -->
		<div class="logo">
		<?php if($sbreg['presenbarra']): ?><img alt="" src="<?php echo $sbreg['presenbarra'] ?>"><?php endif; ?>
		</div>
		<?php if(is_array($cadenwindow)): ?>
		<div id="menu_top" class="tabs ui-tabs ui-widget ui-widget-content ui-corner-all">
			<ul class="ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all">
				<?php if($cadenwindow[$isbacra['sse']]): ?><li class="ui-state-default ui-corner-top"><a href="#" onClick="top.frames['text'].location = '<?php echo $cadenwindow[$isbacra['sse']]; ?>';">Solicitud de servicio</a></li><?php endif; ?>
				<?php if($cadenwindow[$isbacra['otm']]): ?><li class="ui-state-default ui-corner-top"><a href="#" onClick="top.frames['text'].location = '<?php echo $cadenwindow[$isbacra['otm']]; ?>';">Ordenes de trabajo</a></li><?php endif; ?>
				<?php if($cadenwindow[$isbacra['otp']]): ?><li class="ui-state-default ui-corner-top"><a href="#" onClick="top.frames['text'].location = '<?php echo $cadenwindow[$isbacra['otp']]; ?>';">P.M.</a></li><?php endif; ?>
				<?php if($cadenwindow[$isbacra['equ']]): ?><li class="ui-state-default ui-corner-top"><a href="#" onClick="top.frames['text'].location = '<?php echo $cadenwindow[$isbacra['equ']]; ?>';">Equipos</a></li><?php endif; ?>
			</ul>
		</div>
		<?php endif; ?>
		<div class="forms ui-tabs ui-widget ui-widget-content ui-widget-header ui-corner-all">
			<form name="form1" id="form1" style="display:inline" method="post" enctype="multipart/form-data">
				<table border="0" cellspacing="0" cellpadding="0" align="center" width="160">
					<tr>
						<td><input size="13" type="text" name="search_string" id="search_string" value="<?php $search_string; ?>" /></td>
						<td>
							<ul id="icons" class="ui-widget ui-helper-clearfix" onclick="buscarpv(0);">
								<li id="buscar_window" class="ui-state-default ui-corner-all" title="Buscar"><span class="ui-icon ui-icon-search"></span></li>
	       					</ul>
						</td>
						<td>
							<ul id="icons" class="ui-widget ui-helper-clearfix" onclick="buscarpv(1);">
								<li id="buscar_window1" class="ui-state-default ui-corner-all" title="Buscar"><span class="ui-icon ui-icon-clipboard"></span></li>
	       					</ul>
	       				</td>
					</tr>
				</table>
	        </form>
		</div>
		<div class="personalBar ui-widget-header">
			<div class="location">
				<?php 
					if ($usuacodi)
					{
						$idcon = fncconn();
						$nombreusuario = loadrecordusuario($_COOKIE[usuacodi],$idcon);
						echo '  >> El usuario '.($nombreusuario[usuanomb]).' est&aacute; activo en el momento';
						fncclose($idcon);
					}
					else
					{
						echo 'No hay un usuario v&aacute;lido en el momento';
						echo '<a href="principal.php">Ingrese nuevamente</a>';
					}
				?>
			</div>
			<div class="auth">
				<a href="javascript:;" onClick="logout();" target="_top" class="plain"><font color="White" face="Arial, Helvetica, sans-serif" size="1">Cerrar sesi&oacute;n</font></a>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<a href="javascript:void(0);" onClick="top.close();" target="_top" class="plain"><font color="White" face="Arial, Helvetica, sans-serif" size="1">Salir&nbsp;</font></a>
			</div>
		</div>
		<input type="hidden" name="codigo" value="<?php echo $codigo; ?>">
	</body>
</html>