<?php
ob_start();
	include ( '../src/FunPerPriNiv/pktbltipoequipo.php');
	include ( '../src/FunPerSecNiv/fncnumreg.php');
	include ( '../src/FunPerSecNiv/fncfetch.php');
	include ( '../src/FunPerSecNiv/fncconn.php');
	include ( '../src/FunPerSecNiv/fncclose.php');
	include ( '../src/FunGen/cargainput.php');
ob_end_flush();
?>

<html>
	<head>
		<title>Lista visor tipo produccion</title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		<meta http-equiv="expires" content="0">
		<link rel="stylesheet" type="text/css" href="temas/Noise/Style.css">
		<script type="text/javascript" src="../src/FunjQuery/jquery-1.3.js"></script>
		<script type="text/javascript" src="../src/FunjQuery/jquery.ajax_loadsubnivel.js"></script>
		<script type="text/javascript" src="../src/FunjQuery/jquery.ajax_listacampos.js"></script>
		<script type="text/javascript">
			function delitemdata(data, arreglo)
			{
				var enc = 0;
				var new_arreglo ="";
				
				arreglogen = arreglo.split(",");
				
				if (arreglogen != "")
				{
					for(var i=0; i < (arreglogen.length); i++)
					{
						if (arreglogen[i] == data)
							enc = 1;
						else
						{
							if (i == 0)
								new_arreglo = arreglogen[i];
							else
								new_arreglo = new_arreglo + "," + arreglogen[i];
						}
					}
				}
				
				if (enc == 0)
				{
					if (new_arreglo == "")
						new_arreglo = data;	
					else
						new_arreglo = data + "," + new_arreglo;
				}
				document.form1.arr_delitem.value = new_arreglo;
				window.parent.document.getElementById('arr_tipoequipo').value = new_arreglo;
			}
		
		</script>
		<style type="text/css">
			body { margin: 0px;}
			form { margin: 0px;}
			.NoiseFieldCaptionTD {font-size: 85%; font-family : Arial; color:#ffffff; } 
			.estilo1 {font-size: 85%; font-family : Arial; } 
		</style>
	</head>
	<body bgcolor="FFFFFF" text="#000000">
		<form name="form1" method="post"  enctype="multipart/form-data">
  			<table width="100%" border="0" cellspacing="1" cellpadding="1" align="center">
    			<tr>
	  				<td class="NoiseFieldCaptionTD" width="5%">&nbsp;Sel.</td>
	  				<td class="NoiseFieldCaptionTD" width="95%">&nbsp;Tipo equipo</td>
    			</tr>
				<?php
					include ( '../src/FunGen/fncdetallalistasvisor.php');
					$nureturn = fncdetallatipoequipo($arr_tipoequipo, $plantacodigo);
				?>	
  			</table>
  			<input type="hidden" name="arr_detalle" id="arr_detalle">
  			<input type="hidden" name="arr_delitem" id="arr_delitem" value="<?php echo $arr_delitem ?>">
		</form>
	</body>
</html>