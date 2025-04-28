<?php
include ( '../src/FunPerPriNiv/pktblsoliserv.php');
include ( '../src/FunPerPriNiv/pktblusuario.php');
include ( '../src/FunPerPriNiv/pktblequipo.php');
include ( '../src/FunPerPriNiv/pktbltipofall.php');
include ( '../src/FunPerPriNiv/pktblsoliservestado.php');
include ( '../src/FunPerPriNiv/pktblplanta.php');
include ( '../src/FunPerPriNiv/pktblsistema.php');
include ( '../src/FunPerSecNiv/fncconn.php');

$idcon = fncconn();

$soliserv = loadrecordsoliserv($codigo,$idcon);
$usuario = loadrecordusuario($soliserv[usuacodi],$idcon);
$tipofalla = loadrecordtipofall($soliserv[tipfalcodigo],$idcon);
$estado = loadrecordsoliservestado($soliserv[estsolcodigo],$idcon);
$planta = loadrecordplanta($soliserv[plantacodigo],$idcon);
$sistema = loadrecordsistema($soliserv[sistemcodigo],$idcon);
$equipo = loadrecordequipo($soliserv[equipocodigo],$idcon);
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Solicitud de servicio</title>
<style type="text/css">
<!--
.Estilo6 Estilo10 {font-family: Arial, Helvetica, sans-serif; font-size: 12px; }
.Estilo6 {font-size: 10px; }
.Estilo7 {font-family: Arial, Helvetica, sans-serif; font-size: 10px; }
.Estilo6 Estilo10 {font-family: Arial, Helvetica, sans-serif; font-size: 12px; font-weight: bold; }
.Estilo10 {font-family: Arial, Helvetica, sans-serif}
-->
</style>
</head>

<body onLoad="window.print()">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="4"><table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
      <tr>
        <td width="26%" rowspan="2">
          <div align="center"><img src="../img/adsumcuasipequeno.jpg"></div></td>
        <td width="48%"><div align="center" class="Estilo6 Estilo10"><b>GESTION DE MANTENIMIENTO</b></div></td>
      </tr>
      <tr>
        <td><div align="center" class="Estilo6 Estilo10"><b>SOLICITUD DE SERVICIO</b></div></td>
        </tr>

    </table></td>
  </tr>

  <tr>
    <td><span class="Estilo6 Estilo10">Fecha</span></td>
    
    <td colspan="2"><span class="Estilo6 Estilo10"><?php echo $soliserv[solserfecha]; ?></span></td>
    <td class="Estilo6 Estilo10">Numero de Solicitud: <span class="Estilo6 Estilo10"><?php echo $soliserv[solsercodigo]; ?></span></td>
  </tr>
  <tr><span class="Estilo6 Estilo10">
    <td colspan="4">------------------------------------------------------------------------------------------------------------------</td></span>
   </tr>
  <tr>
    <td><span class="Estilo6 Estilo10">Ubicaci&oacute;n</span></td>
    <td colspan="3"><span class="Estilo6 Estilo10"><?php echo $planta[plantanombre]; ?></span></td>
  </tr>
    <tr>
    <td><span class="Estilo6 Estilo10">Proceso</span></td>
    <td colspan="3"><span class="Estilo6 Estilo10"><?php echo $sistema[sistemnombre]; ?></span></td>
  </tr>
    <tr>
    <td><span class="Estilo6 Estilo10">codigo del Equipo</span></td>
    <td colspan="3"><span class="Estilo6 Estilo10"><?php echo $equipo[equipocodigo]; ?></span></td>
  </tr>
   <tr>
    <td><span class="Estilo6 Estilo10"> Nombre del Equipo</span></td>
    <td colspan="3"><span class="Estilo6 Estilo10"><?php echo $equipo[equiponombre]; ?></span></td>
  </tr>
  <tr>
    <td><span class="Estilo6 Estilo10">Solicitante</span></td>
    <td colspan="3"><span class="Estilo6 Estilo10"><?php echo $usuario[usuanombre]."&nbsp;".$usuario[usuapriape]; ?></span></td>
  </tr>
  
   <tr><span class="Estilo6 Estilo10">
    <td colspan="4">------------------------------------------------------------------------------------------------------------------</td></span>
   </tr>
  <?php
  if($soliserv)
      			{ $texto = split("::",$soliserv[solsermotivo] );
					$contador = count($texto);
					echo '<td><span class="Estilo6 Estilo10">Usuario</span></td>
					<td><span class="Estilo6 Estilo10">Fecha y hora de la solicitud</span></td>';
					echo '<td colspan="2"><span class="Estilo6 Estilo10">Descripci&oacute;n de la solicitud</span></td></tr>';
					for ($i=0;$i<$contador;$i++)
		      			{$texto1 = split("--",$texto[$i] );
						{echo '<tr>
						<td><span class="Estilo6 Estilo10">&nbsp;'.$texto1[0].'</span></td>
						<td><span class="Estilo6 Estilo10">&nbsp;'.$texto1[1].' '.$texto1[2].'</span></td>
						<td colspan="2"><span class="Estilo6 Estilo10">'.$texto1[3].'</span></td></tr>';}}
		      	}
      			else {echo $solsermotivo;}?>
      			
 <tr><span class="Estilo6 Estilo10">
    <td colspan="4">------------------------------------------------------------------------------------------------------------------</td></span>
   </tr>
   
  <tr>
    <td><span class="Estilo6 Estilo10">Observaciones</span></td>
    <td colspan="3" rowspan="2">
    <table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#CCCCCC">
      <tr>
        <td>&nbsp;</td>
        </tr>
      <tr>
        <td>&nbsp;</td>
        </tr>
         <tr>
        <td>&nbsp;</td>
        </tr>
      <tr>
        <td>&nbsp;</td>
        </tr>
              <tr>
        <td>&nbsp;</td>
        </tr>
    </table></td>
    </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>.</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
    <tr>
    <td>.</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
    <tr>
    <td>.</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td class="Estilo6 Estilo10">Firma solicitante:</td>
    <td>_________________________________</td>
    <td><span class="Estilo6 Estilo10">Ingeniero de mantenimiento:</span></td>
    <td>_________________________________</td>
    </tr>
</table>
</body>
</html>
