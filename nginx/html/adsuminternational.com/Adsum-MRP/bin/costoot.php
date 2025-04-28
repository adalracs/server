<?php
  // Pre-Costeo: Revisa y calcula valores
  include ( '../src/FunGen/fnctimecmp.php');
  include ( '../src/FunPerSecNiv/fncconn.php');
  include ( '../src/FunPerSecNiv/fncclose.php');
  //A: Usuarios
  $inuconn = fncconn();
  $valcantherr=0;
  $valhorresp=0;
  $valhoraux=0;
  $valhorequ=0;
  $valcantitem=0;
  
  if (($fechini and $horini  and $fechfin and $horfin)){
  	 //Combierte el formato de hora 12 a formato de hora 24
	  $foo1 = explode(":",$horini);
	  $foo2 = explode(":",$horfin);
	  if($pasadmerini1=='true'){
	    if($foo1[0] != 12)
		  $horini = ($foo1[0] + 12).":".$foo1[1];
	  }elseif($foo1[0] == 12)
	     $horini = "00:".$foo1[1];
	  if($pasadmerfin1=='true'){
		if($foo2[0] != 12)
		$horfin = ($foo2[0] + 12).":".$foo2[1];
	  }elseif($foo2[0] == 12)
	     $horfin= "00:".$foo2[1];
      // canthortar = Numero de horas de la OT
	  $canthortar = fnctimecmp($fechini,$fechfin,$horini,$horfin);
      // Calcula el valor total de las horas del encargado segun duracion de la OT
      if ($empleacod){
	    $sbSql = 'SELECT SUM(usuavalhor*'.$canthortar.') AS valhort FROM usuario where usuacodi ='.$empleacod.';';
	    $nuResult = pg_exec( $inuconn, $sbSql );
	    unset( $sbSql );
      }
	    if ( $nuResult ){
          $nuCantRow = pg_numrows($nuResult);
          if ($nuCantRow > 0){
		    $sbRow = pg_fetch_row ( $nuResult, (0) );
		    $valhorresp = $sbRow[0];	
	        //valhorresp = Valor total de las horas del encargado segun duracion de la OT
          }
	    }
	  	unset( $nuResult );
       // Calcula el valor total de las horas de los auxiliares segun duracion de la OT
	  if ($arreglo_auxdef){
  	  	$sbSql = 'SELECT SUM(usuavalhor*'.$canthortar.') AS valhort FROM usuario where usuacodi IN ('.$arreglo_auxdef.');';
  	    $nuResult = pg_exec( $inuconn, $sbSql );
        unset( $sbSql );
	  }
        if ( $nuResult ){
          $nuCantRow = pg_numrows($nuResult);
          if ($nuCantRow > 0){
		      $sbRow = pg_fetch_row ( $nuResult, (0) );
		      $valhoraux = $sbRow[0];	
		      //valhoraux = Valor total de las horas de todos los auxiliares segun duracion de la OT
          }
        }  
        unset( $nuResult );
      // Calcula el valor total de las horas del equipo segun duracion de la OT
      if($equipocodigo){
	    $sbSql = 'SELECT SUM(equipovalhor*'.$canthortar.') AS valhort FROM equipo where equipocodigo ='.$equipocodigo.';';
	  	$nuResult = pg_exec( $inuconn, $sbSql );
	  	unset( $sbSql );
      }
        if ( $nuResult ){
        	
          $nuCantRow = pg_numrows($nuResult);
          if ($nuCantRow > 0){
            $sbRow = pg_fetch_row ( $nuResult, (0) );
	        $valhorequ = $sbRow[0];	
	        //valhorequ = Valor total de las horas del equipo segun duracion de la OT
          }
        }
        unset( $nuResult );
  }
  // Calcula el valor total de las herramientas segun cantidad por cada una
  $valposic = explode(",",$loadherram);
  $numposic = count($valposic)-1;
 
  for($i = 0; $i < $numposic; $i++){
	$arr_herrccant = explode("-",$valposic[$i]);
  	
	$sbSql = 'SELECT SUM(herramvalor*'.$arr_herrccant[1].') AS valherr FROM herramie where herramcodigo ='.$arr_herrccant[0].';';
	$nuResult = pg_exec( $inuconn, $sbSql );
	unset( $sbSql );

	if ( $nuResult ){    	
      $nuCantRow = pg_numrows($nuResult);
      if ($nuCantRow > 0){
        $sbRow = pg_fetch_row ( $nuResult, (0) );
	    $valcantherr += $sbRow[0];	
	    //valcantherr = Valor total de las herrmientas de la OT
       }
    }
    unset( $nuResult );
  }
  // Calcula el valor total de los Items segun cantidad por cada una
  $valposic = explode(",",$loaditem);
  $numposic = count($valposic)-1;
 
  for($i = 0; $i < $numposic; $i++){
	$arr_itemccant = explode("-",$valposic[$i]);
  	
	$sbSql = 'SELECT SUM(itemvalor*'.$arr_itemccant[1].') AS valherr FROM item where itemcodigo ='.$arr_itemccant[0].';';
	$nuResult = pg_exec( $inuconn, $sbSql );
	unset( $sbSql );

	if ( $nuResult ){    	
      $nuCantRow = pg_numrows($nuResult);
      if ($nuCantRow > 0){
        $sbRow = pg_fetch_row ( $nuResult, (0) );
	    $valcantitem += $sbRow[0];	
	    //valcantitem = Valor total de los Items de la OT
       }
    }
    unset( $nuResult );
  }

?>
<html>
<title>Costos de OT</title>
<link rel="stylesheet" type="text/css" href="temas/Noise/Style.css"> 
<body>
<table border="0" cellspacing="1" cellpadding="2" align="center" class="NoiseFormTABLE">
  <tr><td width="422" class="NoiseErrorDataTD">&nbsp;</td></tr>
  <tr><td class="NoiseFieldCaptionTD"><span class="style5"><font color="FFFFFF">Costo de OT </font></span></td></tr>
  <tr>
    <td><table width="94%" border="0" cellspacing="1" cellpadding="0" align="center">
          <tr>
            <td width="10%" class="NoiseFooterTD">&nbsp;Encargado</td>
            <td width="10%" class="NoiseFooterTD">&nbsp;x Vhr.</td>
            <td width="20%" bgcolor="#E8F0F6">$ <?php  echo $valhorresp;?></td>
          </tr>
          <tr>
            <td width="10%" class="NoiseFooterTD">&nbsp;Auxiliares</td>
            <td width="10%" class="NoiseFooterTD">&nbsp;x Vhr.</td>
            <td width="20%" bgcolor="#E8F0F6">$ <?php  echo $valhoraux;?></td>
          </tr>
          <tr>
            <td width="10%" class="NoiseFooterTD">&nbsp;Equipo</td>
            <td width="10%" class="NoiseFooterTD">&nbsp;x Vhr.</td>
            <td width="20%" bgcolor="#E8F0F6">$ <?php  echo $valhorequ;?></td>
          </tr>    	  
          <tr>
            <td width="10%" class="NoiseFooterTD">&nbsp;Herramienta</td>
            <td width="10%" class="NoiseFooterTD">&nbsp;x Vuni.</td>
            <td width="20%" bgcolor="#E8F0F6">$ <?php  echo $valcantherr;?></td>
          </tr>
          <tr>
            <td width="10%" class="NoiseFooterTD">&nbsp;Item</td>
            <td width="10%" class="NoiseFooterTD">&nbsp;x Vuni.</td>
            <td width="20%" bgcolor="#E8F0F6">$ <?php  echo $valcantitem;?></td>
          </tr>
          <tr><td colspan="3"><hr noshade></td></tr>
    	  <tr>
            <td colspan="2" class="NoiseFooterTD">&nbsp;Valor de OT </td>
            <td bgcolor="#E8F0F6">$ <?php  echo ($valcantitem + $valcantherr + $valhorequ + $valhoraux + $valhorresp);?></td>
        
      </tr>
      <tr><td colspan="3"><hr noshade></td></tr>
      
    </table></td>
  </tr>
  <tr>
	<td><div align="center">
			<input type="button" name="cerrar" onclick="window.close(this.form)" value="Cerrar"  width="86" height="18" alt="cerrar" border=0>
		</div>	</td>
</tr>
  <tr>
    <td class="NoiseErrorDataTD" colspan="2">&nbsp;</td>
  </tr>
</table>
</body>
</html>
