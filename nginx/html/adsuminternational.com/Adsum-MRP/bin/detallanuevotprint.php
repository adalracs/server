<?php
include('../src/FunPerSecNiv/fncconn.php');
/**
* Propiedad intelectual de Adsum (c).
*  Todos los derechos reservados
*
* Nombre: 		  detallaotprint.php
* Descripcion:    Convierte una cadena de HTML en PDF
*
* Fecha: 14-JUN-2006
* Autor: mstroh
*
* Historial de modificaciones
* ---------------------------
*/

// Convierte una orden de trabajo en PDF
require_once('../src/FunPrint/html2fpdf.php');
include('../src/FunGen/fnccargapresentac.php');

$nuConn=fncconn();
if ($nuConn)
{
	$sbSql="SELECT MAX(ordtracodigo) from ot;";
	$nuResult = pg_exec($nuConn,$sbSql);
	unset($sbSql);

	if ($nuResult)
	{
		$ordtracodigomax=pg_fetch_row($nuResult);

		if ($ordtracodigomax)
		{
			$sbSql = "SELECT ordtracodigo,ordtrafecgen,plantanombre,sistemnombre,ordtrahorgen,tipmannombre,equiponombre,ordtradescri,ordtrafecini,ordtrahorini,ordtrafecfin,ordtrahorfin,ordtranota from ot,planta,sistema,tipomant,equipo where ordtracodigo=".$ordtracodigomax[0]." and ot.plantacodigo=planta.plantacodigo and ot.sistemcodigo=sistema.sistemcodigo and ot.equipocodigo=equipo.equipocodigo and ot.tipmancodigo=tipomant.tipmancodigo;";

			$nuResult = pg_exec($nuConn,$sbSql);
			unset($sbSql);

			$sbSql = "SELECT equiponombre, equipomarca, equiposerie, equipoviduti from equipo, ot where ordtracodigo=".$ordtracodigomax[0]." and ot.equipocodigo = equipo.equipocodigo;";

			$nuResult1 = pg_exec($nuConn,$sbSql);
			unset($sbSql);
			$otdatosequipo = pg_fetch_row($nuResult1);
			
			if ($nuResult)
			{
				$otdatosbasicos = pg_fetch_row($nuResult);

				if ($otdatosbasicos)
				{
					$sbSql="SELECT tareotcodigo,tareadescri,tiptranombre,priorinombre,tareotnota from tareot,tarea,tipotrab,priorida where ordtracodigo=".$ordtracodigomax[0]." and tareot.tareacodigo=tarea.tareacodigo and tareot.tiptracodigo=tipotrab.tiptracodigo and tareot.prioricodigo=priorida.prioricodigo;";

					$nuResult = pg_exec($nuConn,$sbSql);
					unset($sbSql);

					if ($nuResult)
					{
						$otdatostarea = pg_fetch_row($nuResult);

						if ($otdatostarea)
						{

							$sbSql="SELECT usuanombre,usuapriape,usutarlider from usuariotareot,usuario where tareotcodigo =".$otdatostarea[0]." and usuariotareot.usuacodi=usuario.usuacodi and usutarlider='t';";

							$nuResult = pg_exec($nuConn,$sbSql);
							unset($sbSql);

							if ($nuResult)
							{
								$otdatospersona = pg_fetch_row($nuResult);

								if ($otdatospersona)
								{
									$sbSql="SELECT usuanombre,usuapriape from usuariotareot,usuario where tareotcodigo =".$otdatostarea[0]." and usuariotareot.usuacodi=usuario.usuacodi and usutarlider='f';";

									$nuResult = pg_exec($nuConn,$sbSql);

									unset($sbSql);
									if ($nuResult)
									{   $i=0;
									while ($row = pg_fetch_array($nuResult)) {

										$arreglo[$i]= $row["usuanombre"]." ".$row["usuapriape"];
										$i++;
									}
									//$otdatospersonaaux=pg_fetch_row($nuResult);

									}
								}

							}
						}else
						{
							echo "No se puede hacer consulta de personas";
						}
					}
				}else
				{
					echo "No se puede ejecutar consulta 2";
				}

			}else
			{
				echo "No se puede ejecutar consulta";
			}
		}else
		{
			echo "No se encontr� el c�digo de OT2";
		}
	}else
	{
		echo "No se encontr� el c�digo de OT";
	}

	$sbSql="SELECT herramie.herramnombre, transacherramie.transhercanti FROM (tareotherramie INNER JOIN transacherramie ON tareotherramie.transhercodigo = transacherramie.transhercodigo) INNER JOIN herramie ON transacherramie.herramcodigo = herramie.herramcodigo WHERE tareotherramie.tareotcodigo = "."'".$otdatostarea[0]."'";
	$nuResult = pg_exec($nuConn,$sbSql);

	unset($sbSql);
	if ($nuResult)
	{   $k=0;
	while ($row = pg_fetch_array($nuResult)) {

		$arregloherr[$k]= $row["herramnombre"]." ".$row["transhercanti"];
		$k++;
	}

	}

	$sbSql="SELECT item.itemnombre, transacitem.transitecantid FROM (itemtareot INNER JOIN transacitem ON itemtareot.transitecodigo = transacitem.transitecodigo) INNER JOIN item ON transacitem.itemcodigo = item.itemcodigo WHERE itemtareot.tareotcodigo = "."'".$otdatostarea[0]."'";
	$nuResult = pg_exec($nuConn,$sbSql);

	unset($sbSql);
	if ($nuResult)
	{   $l=0;
	while ($row = pg_fetch_array($nuResult)) {

		$arregloitem[$l]= $row["itemnombre"]." ".$row["transitecantid"];
		$l++;
	}

	}

}

else
{
	echo "No existe conexi�n";
}
//Armamos el pdf
$date = date('Y-m-d');
// Cadena que contiene los datos de el indicador "DISPONIBILIDAD" (HTML)
$html = $_SESSION['htmlreport'];
$pdf = new HTML2FPDF('P', 'mm', 'letter');
$pdf->AddPage('P');
$pdf->Image(fnccargapresentac(3), 10, 10, 30, 25);
$pdf->WriteHTML("<html>");
$pdf->WriteHTML("<head>");
//$pdf->WriteHTML("<title>Orden de trabajo</title>");
?>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta http-equiv="expires" content="0">
<link rel="stylesheet" type="text/css" href="temas/Noise/Style.css">
<SCRIPT LANGUAGE="JavaScript">
<!-- Begin
agree = 0;
//  End -->
</script>
<script language="JavaScript" src="motofech.js"></script></head>
<body bgcolor="FFFFFF" text="#000000">
<form name="form1" method="post"  enctype="multipart/form-data">
  <table border="0" align="center" cellpadding="0" cellspacing="0" width="90%">
 <!--   <tr>
      <th scope="col"><img src="../img/adsumcuasipequeno.jpg" alt="Adsum" align="left"></th>
    </tr> -->
    <tr>
      <th scope="col"><TABLE border="0" width="90%" align="center">
        <tr>
          <td colspan="4"><hr></td>
        </tr>
        <tr bgcolor="#5961A0">
          <td colspan="4"><FONT face="Verdana" color="White">Orden de trabajo</FONT></td>
        </tr>
        <tr>
          <TD width="25%"><B>Orden No.</B>&nbsp;<?php if ($otdatosbasicos){ print_r($otdatosbasicos[0]);}else {echo "No hay datos";}?></TD>
          <td colspan="3"><B>Fecha:</B>&nbsp;<?php if ($otdatosbasicos){ print_r($otdatosbasicos[1]."&nbsp;".$otdatosbasicos[4]);}else {echo "No hay datos";}?>              </td>
          </tr>
        <tr bgcolor="#E8F0F6">
          <TD><b>Tipo de mantenimiento:</b></TD>
          <TD colspan="3"><b><?php if ($otdatosbasicos){ print_r($otdatosbasicos[5]);}else {echo "No hay datos";}?>
          </b></TD>
        </tr>
        <tr>
          <TD colspan="2"><b>Planta:</b>&nbsp;<?php if ($otdatosbasicos){ print_r($otdatosbasicos[2]);}else {echo "No hay datos";}?>&nbsp;</TD>
         <TD colspan="2"><b>Proceso:</b>&nbsp;<?php if ($otdatosbasicos){ print_r($otdatosbasicos[3]);}else {echo "No hay datos";}?>&nbsp;</td>
          </tr>
          <tr bgcolor="#5961A0"><td colspan="4"></td></tr>
          <tr bgcolor="#D4E1EC"><td colspan="4"><b>Equipo</b></td></tr>
        <TR bgcolor="#F2F3F8">
          <TD colspan="2"><b>Nombre:</b>&nbsp;<?php if ($otdatosequipo){ print_r($otdatosequipo[0]);}else {echo "No hay datos";}?></TD>   
          <TD colspan="2"><b>Marca:</b>&nbsp;<?php if ($otdatosequipo){ print_r($otdatosequipo[1]);}else {echo "No hay datos";}?></TD>
          </TR>
         <TR bgcolor="#F2F3F8">
          <TD colspan="2"><b>Serie:</b>&nbsp;<?php if ($otdatosequipo){ print_r($otdatosequipo[2]);}else {echo "No hay datos";}?></TD>   
          <TD colspan="2"><b>No. Inventario t&eacute;cnico:</b>&nbsp;<?php if ($otdatosequipo){ print_r($otdatosequipo[3]);}else {echo "No hay datos";}?></TD>
          </TR>
          <tr bgcolor="#5961A0"><td colspan="4"></td></tr>
        <TR bgcolor="#E8F0F6">
          <TD colspan="2"><strong>Fecha Inicio:</strong>
            <?php if ($otdatosbasicos){ print_r($otdatosbasicos[8]."&nbsp;".$otdatosbasicos[9]);}else {echo "No hay datos";}?></TD>
          <TD colspan="2"><strong>Fecha Fin:</strong>
            <?php if ($otdatosbasicos){ print_r($otdatosbasicos[10]."&nbsp;".$otdatosbasicos[11]);}else {echo "No hay datos";}?></TD>
        </tr>
        <TR bgcolor="#F8FAFB">
          <td><strong>Responsable:</strong></td>
          <td colspan="3" bgcolor="#F2F3F8"><strong>
         
            <?php  
            if ($otdatospersona){ print_r($otdatospersona[0]."&nbsp;".$otdatospersona[1]);}else {echo "No hay datos";}?>
          </strong></td>
        </TR>
        <TR bgcolor="#F2F3F8">
          <TD><strong>Auxiliares:</strong></TD>
          <!--<TD colspan="2"><strong>-->
            <?php //if ($otdatospersonaaux){print_r($otdatospersonaaux[0]."&nbsp;".$otdatospersonaaux[1]);}else {echo "No hay auxiliares involucrados";}?>
			<?php 
			for ($j=0; $j<$i; $j++)
			{

				//echo "<td><B>Nombre:</B>&nbsp;".$otdatospersonaaux[0]."&nbsp;".$otdatospersonaaux[1]."</td>";
				echo '<td colspan= "3" bgcolor="#F2F3F8">'.$arreglo[$j].'</td>';
				echo "</tr><tr>";
				echo "<td></td>";

			}
			?>
          <!-- </strong></TD>-->
          </tr>
        <TR bgcolor="#E8F0F6">
          <TD><strong>Descripci&oacute;n del fallo</strong></TD>
          <TD colspan="3"><?php if ($otdatosbasicos){ print_r($otdatosbasicos[7]);}else {echo "No hay datos";}?></TD>
        </tr>
        <TR bgcolor="#F2F3F8">
          <TD colspan="2"><b>Tipo de trabajo:</b>&nbsp;<?php if ($otdatostarea){ print_r($otdatostarea[2]);}else {echo "No hay datos";}?></TD>
          <TD colspan="2"><b>Prioridad:</b>&nbsp;
            <?php if ($otdatostarea){ print_r($otdatostarea[3]);}else {echo "No hay datos";}?></TD>
        </tr>
                <TR>
          <TD colspan="4"><B>Descripci&oacute;n del trabajo a realizar:</B>&nbsp;
            <?php 
            
            if ($otdatostarea){
            	if($otdatostarea[1]){
	            	$datosdetarea = explode(".", $otdatostarea[1]);
	            	$cantdatos = count($datosdetarea);
	            	if ($cantdatos){
		            	echo "<br>";
		            	for ($j=0; $j < $cantdatos; $j++){
		            		echo "[&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;]".$datosdetarea[$j]."<br>";
		            	}
	            	}
            	}
            	unset($datosdetarea, $cantdatos );
            	if($otdatostarea[4]){
	            	$datosdetarea = explode(".", $otdatostarea[4]);
	            	$cantdatos = count($datosdetarea);
	            	if ($cantdatos){
		            	echo "<br>";
		            	for ($j=0; $j < $cantdatos; $j++){
		            		echo "[&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;]".$datosdetarea[$j]."<br>";
		            	}
	            	}
            	}
            }
            else
            {echo "No hay datos";}
            ?><br>
            </TD>
        </TR>        <tr>
          <td colspan="4">&nbsp;</td>
        </tr>
		<TR bgcolor="#F2F3F8">
          <TD><strong>Herramienta:</strong></TD>
          <!--<TD colspan="2"><strong>-->
            <?php //if ($otdatospersonaaux){print_r($otdatospersonaaux[0]."&nbsp;".$otdatospersonaaux[1]);}else {echo "No hay auxiliares involucrados";}?>
			<?php 
			for ($j=0; $j<$k; $j++)
			{
				echo '<td colspan = "3">'.$arregloherr[$j].'</td>';
				echo "</tr><tr>";
				echo "<td></td>";
			}
			?>
		</tr>
        <TR bgcolor="#E8F0F6">
          <TD><strong>Item:</strong></TD>
          <!--<TD colspan="2"><strong>-->
            <?php //if ($otdatospersonaaux){print_r($otdatospersonaaux[0]."&nbsp;".$otdatospersonaaux[1]);}else {echo "No hay auxiliares involucrados";}?>
			<?php 
			for ($j=0; $j<$l; $j++)
			{

				echo '<td colspan = "3">'.$arregloitem[$j].'</td>';
				echo "</tr><tr>";
				echo "<td></td>";
			}
			?>
		</tr>
        </TABLE></th>
    </tr>
  </table>
  <CENTER>
 <INPUT type="image" name="aceptar"  src="../img/aceptar.gif" onClick="form1.action='main.php?codigo=';"  width="86" height="18" alt="Aceptar" border=0>
 <INPUT type="image" name="imprimir" src="../img/imprimir.gif" onClick="window.open('detallaotprint.php','printReport','status=no,menubar=no,scrollbars=yes,resizable=yes,left=600,width=600,height=500'); return false;">
</CENTER>
</FORM>
</body>
</html>
<!-- Hidden SPAN -->
<SPAN id="printFrame" style="display:none;">
<CENTER>
<?php 
// El siguiente codigo sera almacenado en un ficheo auxiliar detallaotaux.php
//if ((!$flagnuevoot) && (!empty($codigoot)))
//	include("detallaotaux.php");
// Output buffering
ob_start();
?>
      <th scope="col"><TABLE border="0" width="100%" align="center">
        <tr>
        <TD width="25%"><B>Orden No.</B>&nbsp;<?php if ($otdatosbasicos){ print_r($otdatosbasicos[0]);}else {echo "No hay datos";}?></TD>
          <td colspan="3"><B>Fecha:</B>&nbsp;<?php if ($otdatosbasicos){ print_r($otdatosbasicos[1]."&nbsp;".$otdatosbasicos[4]);}else {echo "No hay datos";}?></td>
          </tr>
                <tr bgcolor="#E8F0F6">
          <TD><b>Tipo de mantenimiento:</b></TD>
          <TD colspan="3"><b><?php if ($otdatosbasicos){ print_r($otdatosbasicos[5]);}else {echo "No hay datos";}?>
          </b></TD>
        </tr>
        <tr>
          <TD colspan="2"><b>Planta:</b>&nbsp;<?php if ($otdatosbasicos){ print_r($otdatosbasicos[2]);}else {echo "No hay datos";}?>&nbsp;</TD>
         <TD colspan="2"><b>Sistema:</b>&nbsp;<?php if ($otdatosbasicos){ print_r($otdatosbasicos[3]);}else {echo "No hay datos";}?>&nbsp;</td>
        </tr>

          <tr bgcolor="#D4E1EC"><td colspan="4"><b>Equipo</b></td></tr>
        <TR bgcolor="#F2F3F8">
          <TD colspan="2"><b>Nombre:</b>&nbsp;<?php if ($otdatosequipo){ print_r($otdatosequipo[0]);}else {echo "No hay datos";}?></TD>   
          <TD colspan="2"><b>Marca:</b>&nbsp;<?php if ($otdatosequipo){ print_r($otdatosequipo[1]);}else {echo "No hay datos";}?></TD>
          </TR>
         <TR bgcolor="#F2F3F8">
          <TD colspan="2"><b>Serie:</b>&nbsp;<?php if ($otdatosequipo){ print_r($otdatosequipo[2]);}else {echo "No hay datos";}?></TD>   
          <TD colspan="2"><b>No. Inventario t&eacute;cnico:</b>&nbsp;<?php if ($otdatosequipo){ print_r($otdatosequipo[3]);}else {echo "No hay datos";}?></TD>
          </TR>
        <TR bgcolor="#E8F0F6">
          <TD colspan="2"><strong>Fecha Inicio:</strong>
            <?php if ($otdatosbasicos){ print_r($otdatosbasicos[8]."&nbsp;".$otdatosbasicos[9]);}else {echo "No hay datos";}?></TD>
          <TD colspan="2"><strong>Fecha Fin:</strong>
            <?php if ($otdatosbasicos){ print_r($otdatosbasicos[10]."&nbsp;".$otdatosbasicos[11]);}else {echo "No hay datos";}?></TD>
        </tr>
        <TR bgcolor="#F8FAFB">
          <td><strong>Responsable:</strong></td>
          <td colspan="3"  bgcolor="#F8FAFB"><strong>
            <?php if ($otdatospersona){ print_r($otdatospersona[0]."&nbsp;".$otdatospersona[1]);}else {echo "No hay datos";}?>
          </strong></td>
        </TR>
         <TR bgcolor="#F2F3F8">
          <TD  bgcolor="#F2F3F8"><strong>Auxiliares:</strong></TD>
          <!--<TD colspan="2"><strong>-->
            <?php //if ($otdatospersonaaux){print_r($otdatospersonaaux[0]."&nbsp;".$otdatospersonaaux[1]);}else {echo "No hay auxiliares involucrados";}?>
			<?php 
			for ($j=0; $j<$i; $j++)
			{

				//echo "<td><B>Nombre:</B>&nbsp;".$otdatospersonaaux[0]."&nbsp;".$otdatospersonaaux[1]."</td>";
				echo '<td colspan= "3">'.$arreglo[$j].'</td>';
				echo "</tr><tr bgcolor='#F2F3F8'>";
				echo "<td>&nbsp;</td>";

			}
			?>
          <!-- </strong></TD>-->
         </tr>
        <TR bgcolor="#E8F0F6">
          <TD><strong>Descripci&oacute;n del fallo</strong></TD>
          <TD colspan="3"><?php if ($otdatosbasicos){ print_r($otdatosbasicos[7]);}else {echo "No hay datos";}?></TD>
        </tr>
        <TR bgcolor="#F2F3F8">
          <TD colspan="2"><b>Tipo de trabajo:</b>&nbsp;<?php if ($otdatostarea){ print_r($otdatostarea[2]);}else {echo "No hay datos";}?></TD>
          <TD colspan="2"><b>Prioridad:</b>&nbsp;
            <?php if ($otdatostarea){ print_r($otdatostarea[3]);}else {echo "No hay datos";}?></TD>
        </tr>
                <TR>
          <TD colspan="4"><B>Descripci&oacute;n del trabajo a realizar:</B>&nbsp;
            <?php
                       if ($otdatostarea){
            	if($otdatostarea[1]){
	            	$datosdetarea = explode(".", $otdatostarea[1]);
	            	$cantdatos = count($datosdetarea);
	            	if ($cantdatos){
		            	echo "<br>";
		            	for ($j=0; $j < $cantdatos; $j++){
		            		echo "[&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;]".$datosdetarea[$j]."<br>";
		            	}
	            	}
            	}
            	unset($datosdetarea, $cantdatos );
            	if($otdatostarea[4]){
	            	$datosdetarea = explode(".", $otdatostarea[4]);
	            	$cantdatos = count($datosdetarea);
	            	if ($cantdatos){
		            	echo "<br>";
		            	for ($j=0; $j < $cantdatos; $j++){
		            		echo "[&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;]".$datosdetarea[$j]."<br>";
		            	}
	            	}
            	}
            }else {echo "No hay datos";}?><br></TD>
        </TR>        <tr>
          <td colspan="4">&nbsp;</td>
        </tr>
        <TR bgcolor="#F2F3F8">
          <TD><strong>Herramienta:</strong></TD>
          <!--<TD colspan="2"><strong>-->
            <?php //if ($otdatospersonaaux){print_r($otdatospersonaaux[0]."&nbsp;".$otdatospersonaaux[1]);}else {echo "No hay auxiliares involucrados";}?>
			<?php 
			for ($j=0; $j<$k; $j++)
			{

				echo '<td colspan = "3">'.$arregloherr[$j].'</td>';
				echo "</tr><tr>";
				echo "<td></td>";

			}
			?>
		</tr>
        <TR bgcolor="#E8F0F6">
          <TD><strong>Item:</strong></TD>
          <!--<TD colspan="2"><strong>-->
            <?php //if ($otdatospersonaaux){print_r($otdatospersonaaux[0]."&nbsp;".$otdatospersonaaux[1]);}else {echo "No hay auxiliares involucrados";}?>
			<?php 
			for ($j=0; $j<$l; $j++)
			{

				echo '<td colspan = "3">'.$arregloitem[$j].'</td>';
				echo "</tr><tr>";
				echo "<td></td>";

			}
			?>
		</tr>

      </TABLE></th>

</CENTER>
<?php  $_SESSION['htmlreport'] = ob_get_contents(); ?>
</SPAN>
<!-- End of hidden SPAN -->

