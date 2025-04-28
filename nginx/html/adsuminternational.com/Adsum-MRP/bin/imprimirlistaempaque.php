<?php 
?> 
<html> 
	<head> 
		<title>Lista de impresion</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0"> 
		<style type="text/css">
			img {border: none;}
			.marcar{
				background-color: #D3CFCF;
				font-weight: bold;
			}
			td{
				font-family: Arial;
				text-align: center;
				font-size: 11;
				border:dashed 0.1px #000000;
			}
			th{
				border:dashed 0.1px #000000;
			}
			table{
				border:dashed 1px #000000;
			}
		</style>
	</head>
	<body bgcolor="#FFFFFF" text="#000000">
		<table   width="850"  align="center" cellpadding="1" cellspacing="1">
			<tr>
				<td  width="140"></td>
				<td  width="300"></td>
				<td  width="100"></td>
				<td ></td>
				<td width="50"></td>	
				<td width="50"></td>	
				<td width="50"></td>	
			</tr>
			<tr>
				<td height="40" width="200"><img src=""></img></span></td>
				<td height="40" width="200" colspan="2"><p align="center">LISTA DE EMPAQUE N&deg;<p></td>
				<td height="40" width="100" colspan="2"><p align="center">6277<p></td>
				<td colspan="5"><table  width="150"border=1>
					<tr><td>R.GP.59</td></tr>
					<tr><td>Actualizaci&oacute;n N&deg;</td></tr>
					<tr><td>3</td></tr>
				</table></td>	
			</tr>	
			<tr>
				<td width="200"></td>
				<td  width="200" >
					<table  width="300" border=1>
						<tr class="marcar"><td width="50">Dia</td><td width="50">Mes</td><td width="50">A&ntilde;o</td></tr>
					</table>
				</td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td  widht="100">Fecha</td>
				<td width="100">
					<table  width="300">
						<tr><td width="20">dd</td><td width="20">mm</td><td width="20">yy</td></tr>
					</table>
				</td>
				<td width="100">&Iacute;tem</td>
				<td width="150">1</td>
				<td width="100" >Orden de compra</td>
				<td width="100">1</td>
			</tr>
			<tr height="25">
				<td widht="100">Cliente</td>
				<td width="100">1</td>
				<td width="100">Pedidio</td>
				<td width="150">1</td>
				<td width="150" >Cantidad Solicitada</td>
				<td width="100">1</td>
			</tr>
			<tr height="25">
				<td widht="100">Producto</td>
				<td width="100">1</td>
				<td width="100">E.P.T.No.</td>
				<td width="150">1</td>
			</tr>
		</table><br>
		<?php for($k=0;$k<2;$k++){ ?>
		<table  width="850" align="center" cellpadding="1" cellspacing="1">
			<tr>
				<td width="50" class="marcar">No. De pallet</td>
				<th width="100">1</th>
				<td width="100" colspan="18" class="marcar">Relacion de Pesos y Unidades por unidad de empaque</td>
			</tr>
			<?php for($j=0;$j<3;$j++){ ?>
			<tr>
				<td colspan="14" height="20"></td>
			</tr>
			
			<tr class="marcar">
				<td>Nivel</td>
				<td>Cosecutivo</td>
				<?php 
					for($i=0;$i<17;$i++){
						if($i==16){
							echo "<td width='36'>Total</td>";
						}else{
							echo "<td width='36'>".$i."</td>";
						}
					}
				?>
			</tr>
			<tr>
					<td rowspan="2">d</td>
					<td>Peso  (Kg)</td>
				<?php 
					for($i=0;$i<17;$i++){
						echo "<td>d</td>";
					}
					
				?>
			</tr>
			<tr>
					<td>Unidades</td>
				<?php 
					for($i=0;$i<17;$i++){
						echo "<td>d</td>";
					}
					
				?>
			</tr>

			<?php } ?>
		</table><br>
		    <table  width="300" cellpadding="1" cellspacing="1" style="position:absolute;left:807px;">
				<tr>
					<td width="200">Peso Neto Pallet (Kg)</td>
					<td>d</td>
				</tr>
				<tr>
					<td>Tara Por unidad de empaque (Kg)</td>
					<td>d</td>
				</tr>
				<tr>
					<td>No. de Rollos/Cajas por Pallet</td>
					<td>d</td>
				</tr>
				<tr>
					<td>Peso Estiba (Kg)</td>
					<td>d</td>
				</tr>
				<tr>
					<td>Peso Bruto Pallet (Kg)</td>
					<td>d</td>
				</tr>
				<tr>
					<td>Unidades</td>
					<td>d</td>
				</tr>
			</table><br><br><br><br><br><br>
			<?php } ?>
	</table>
    </body>
</html>