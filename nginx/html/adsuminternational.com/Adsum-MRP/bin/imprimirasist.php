<?php
	session_start();
	include ( '../src/FunPerSecNiv/fncconn.php');
	include ( '../src/FunPerSecNiv/fncfetch.php');
	include ( '../src/FunPerSecNiv/fncnumreg.php');
	
	include ( '../src/FunPerPriNiv/pktblcurso.php');
	include ( '../src/FunPerPriNiv/pktbltema.php');
	include ( '../src/FunPerPriNiv/pktblcapacitacion.php');
	include ( '../src/FunPerPriNiv/pktblcapaciusuario.php');
	include ( '../src/FunPerPriNiv/pktblcapacimateap.php');
	include ( '../src/FunPerPriNiv/pktblmateapoy.php');
	include ( '../src/FunPerPriNiv/pktblgrupcapa.php');
	include ( '../src/FunPerPriNiv/pktblusuario.php');
	include ( '../src/FunPerPriNiv/pktblinsgrupcapa.php');
	include ( '../src/FunPerPriNiv/pktblcapacitema.php');
	include ( '../src/FunPerPriNiv/pktblcargo.php');
	include ( '../src/FunPerPriNiv/pktbldepartam.php');
	include ( '../src/FunGen/cargainput.php');
	
	$idcon = fncconn();
	
	$rsCapacitacion = loadrecordcapacitacion($codigo, $idcon);
	$rsCurso = loadrecordcurso($rsCapacitacion[cursocodigo],$idcon);
	$rsCapacitema = dinamicscancapacitema(array('capacicodigo' => $codigo), $idcon);
//	$rsGrupo = loadrecordgrupcapa($rsCursogrupo[grucapcodigo],$idcon);
	$rsCapaciusuario = dinamicscancapaciusuario(array('capacicodigo' => $codigo),$idcon);
	$nombre = cargausuanombre($rsCapacitacion[usuacodi],$idcon);
?>
<html xml="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<title>Registro de asistencia</title>
		<style type="text/css">
			<!--
			.Estilo5 {font-family: Arial, Helvetica, sans-serif; font-size: 12px; }
			.Estilo6 {font-family: Arial, Helvetica, sans-serif; font-size: 10px; }
			.Estilo10 {font-family: Arial, Helvetica, sans-serif}
			.Estilo12 {font-family: Arial, Helvetica, sans-serif; font-size: 10px;	font-weight: bold;}
			body {
				margin-left: 0px;
				margin-top: 0px;
				margin-right: 0px;
				margin-bottom: 0px;
			}
			.Estilo13 {font-size: 9px}
			.tbl-borde {
				border-top: 1px solid #000000;
				border-left: 1px solid #000000;
			}
			.tbl-borde td {
				border-bottom: 1px solid #000000;
				border-right: 1px solid #000000;
			}
			-->
			
		</style>
	</head>
	<body onLoad="window.print()">
	<div class="Estilo6" align="right"><u>GH-DP-R03 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;V
      		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;3&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2011-07-29</u></div>
		<table width="100%" border="0" cellpadding="0" cellspacing="0" bordercolor="#000000" class="tbl-borde">
      		<tr>
        		<td width="26%"><div align="center"><img src="../img/adsumcuasipequeno.jpg"></div></td>
      		<td class="Estilo5"><div align="center"><b>FORMATO DE ASISTENCIA</b></div></td></tr>
		</table>
		
		<TABLE width=100% cellPadding=0 cellSpacing=0 bordercolor="#000000" class="tbl-borde">
      <tr class="Estilo12">
        <td bgcolor="#CCCCCC">CAPACITACION / REUNION</td>
        <td colspan="2" bgcolor="#CCCCCC">RESPONSABLE</td>
        <td colspan="2" bgcolor="#CCCCCC">FECHA</td>
        <td bgcolor="#CCCCCC">HORA</td>
      </tr>
    		<tr class="Estilo6">
      			<td width="20%">&nbsp;<?php echo $rsCurso['cursonombre'] ?></td>
      			<td colspan="2">&nbsp;<?php echo $nombre ?></td>
      			<td colspan="2">&nbsp;<?php echo $rsCapacitacion['capacifecini'] ?></td>
      			<td width="21%">&nbsp;<?php echo date("h:i a", strtotime($rsCapacitacion['capacihorini'])) ?></td>
    		</tr>
    		<tr class="Estilo6">
      			<td colspan="6" bgcolor="#FFFFFF">EN CASO DE QUE LA CAPACITACION CONTENGA VARIOS TEMAS O VARIOS CAPACITADORES POR FAVOR DILIGENCIAR LAS CELDAS TEMAS A TRATAR, NOMBRE DEL CAPACITADOR POR TEMA Y POR DURACION</td>
		    </tr>
    		<tr class="Estilo6">
      			<td bgcolor="#CCCCCC">TEMAS A TRATAR</td>
      			<td colspan="4" bgcolor="#CCCCCC">NOMBRE DEL CAPACITADOR POR TEMA</td>
      			<td bgcolor="#CCCCCC">DURACION POR TEMA</td>
    		</tr>
    		<?php 
    			$nrCapacitema = fncnumreg($rsCapacitema);
    			
    			for($a = 0; $a < $nrCapacitema; $a++):
    				$rwCapacitema = fncfetch($rsCapacitema, $a);
    				$rsTema = loadrecordtema($rwCapacitema['temacodigo'], $idcon);
    			
    			?>
	<tr class="Estilo6">
      			<td>&nbsp;<?php echo $rsTema['temanombre']  ?></td>
      			<td colspan="4">&nbsp;<?php echo cargausuanombre($rwCapacitema[usuacodi],$idcon); ?></td>
      			<td>&nbsp;<?php echo (($rwCapacitema['captemtiedur'] < 1) ? ($rwCapacitema['captemtiedur'] * 60).' min.' : $rwCapacitema['captemtiedur'].' hr.')  ?></td>
    		</tr>
    		<?php 
    			endfor;
    			
    			
    			if($a < 5):
    				for($b = $a; $b < 5; $b++):
    			?>
    		<tr class="Estilo6">
      			<td>&nbsp;</td>
      			<td colspan="4">&nbsp;</td>
      			<td>&nbsp;</td>
    		</tr>
    		<?php 
    				endfor;
    			endif;
    		?>
    		
    		<tr class="Estilo6">
			  <td colspan="6"><div align="center">En mi calidad de colaborador manifiesto que 
			  asist&iacute; a la capacitaci&oacute;n / reuni&oacute;n:<?php echo $rsCurso['cursonombre'] ?>, por tanto asumo 
			  el compromiso de aplicar en mis labores diarias de conocimientos y t&eacute;cnicas aprendidas a trav&eacute;s 
			  de esta, con el objetivo de mejorar la calidad de mi trabajo.
			   </div></td>
	</tr>
    		<tr class="Estilo6">
    			<td bgcolor="#CCCCCC">&nbsp;No.</td>
       			<td bgcolor="#CCCCCC">NOMBRE DEL COLABORADOR</td>
       			<td bgcolor="#CCCCCC"><div align="center">CARGO</div></td>
       			<td bgcolor="#CCCCCC">CEDULA</td>
   			  <td bgcolor="#CCCCCC">AREA</td>
   			  <td bgcolor="#CCCCCC">FIRMA</td>
    		</tr>
    		
    		<?php 
    			//$rsCursoconten
    			$nrCapaciusuario = fncnumreg($rsCapaciusuario);
    			
    			for($a = 0; $a < $nrCapaciusuario; $a++):
    				$rwCapaciusuario = fncfetch($rsCapaciusuario, $a);
    			
    				$rsUsuario = loadrecordusuario($rwCapaciusuario['usuacodi'], $idcon);
    			
    			?>
    		
    		<tr class="Estilo6">
      			<td>&nbsp;<?php echo ($a+1)  ?></td>
      			<td>&nbsp;<?php echo $rsUsuario['usuanombre'].' '.$rsUsuario['usuapriape'].' '.$rsUsuario['usuasegape']  ?></td>
      			<td>&nbsp;<?php echo ($rsUsuario['cargocodigo']) ?  cargacargonombre($rsUsuario['cargocodigo'], $idcon)  : ''; ?></td>
      			<td>&nbsp;<?php echo $rsUsuario['usuadocume'] ?></td>
      			<td>&nbsp;<?php echo ($rwCapaciusuario['departcodigo']) ?  cargadepartnombre($rwCapaciusuario['departcodigo'], $idcon)  : ''; ?></td>
      			<td>&nbsp;<br><br></td>
    		</tr>
    		
    		<?php 
    			endfor;
    			
    			
    			if($a < 20):
    				for($b = $a; $b < 20; $b++):
    			?>
    		<tr class="Estilo6">
      			<td>&nbsp;<?php echo $b+1 ?></td>
      			<td>&nbsp;</td>
      			<td>&nbsp;</td>
      			<td>&nbsp;</td>
      			<td>&nbsp;</td>
      			<td>&nbsp;<br><br></td>
    		</tr>
    		
    		<?php 
    				endfor;
    			endif;
    		?>
    		<tr class="Estilo6">
      			<td colspan="6" bgcolor="#CCCCCC" align="center">OBSERVACIONES</td>
   			</tr>
  			<tr class="Estilo6">
  				<td colspan="6"><div align="center">&nbsp;<br><br><br><br><br></div></td>
			</tr>
  			<tr class="Estilo6">
  				<td bgcolor="#CCCCCC">Area que coordina la reunion</td>
  				<td colspan="5" bgcolor="#FFFFFF">&nbsp;<br><br></td>
			</tr>
    		<tr class="Estilo6">
      			<td bgcolor="#CCCCCC">Lugar donde se dict&oacute;</td>
      			<td colspan="5" bgcolor="#FFFFFF">&nbsp;<br><br></td>
   			</tr>
		</TABLE>
	</body>
</html>
