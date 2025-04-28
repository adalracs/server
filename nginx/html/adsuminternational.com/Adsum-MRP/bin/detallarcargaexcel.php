<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title><meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta http-equiv="expires" content="0">
<link rel="stylesheet" type="text/css" href="temas/Noise/Style.css">

</head>
<body bgcolor="#FFFFFF" text="#000000">
<form name="form1" method='post' enctype="multipart/form-data">
<p><font class="NoiseFormHeaderFont">Vista de Eventos</font></p>
  <table border="0" cellspacing="1" cellpadding="2" align="center" class="NoiseFormTABLE">
    <tr>
      <td width="534" class="NoiseErrorDataTD">&nbsp;</td>
    </tr>
    <tr>
      <td class="NoiseFieldCaptionTD"><font color="FFFFFF">Fecha: <?php echo date("Y/m/d");?></font></td>
    </tr>
    <tr>
      <td colspan="2"><strong><font face="Verdana">
      <?php
      /*Se recibe el numero de formulario.
       * Ejemplo: 1 = maestablcargaexcel.php > Cargar equipos desde excel 
       */      
      $valorFrm=($_GET["NumeroFormulario"]);      
      switch($valorFrm)
      {
      	case 1://Formulario cargar equipos desde excel
      		{
      			$arrayDatos=($_GET["arr1"]);      			
      			break 1;
      		}//End case 1
      	case 2://Formulario cargar componentes desde excel
      		{      			
      			$arrayDatos=($_GET["arrConDatos"]);
      		 	break 1;     				      		      		   		
      		}//End case 2      		
      		default: 
      		{
      			break;
      		}
      }
      
      if (isset($arrayDatos))
		{			
			/*array explode ( string separador, string cadena [, int limite]) \linebreak*/
			$cad=explode(",",$arrayDatos);
			for ($i=0;$i<count($cad);$i++)
			{
				if ($cad[$i]==-1)
				{
					echo "registro ".($i+1)."=> Error de conexion<br>";			 
					$resultado = -1;
				}
				if ($cad[$i]==-2)
				{
					echo "registro ".($i+1)."=> Error al guardar el registro.<br>";			 
					$resultado = -2;
				}
				if ($cad[$i]==1)
				{
					echo "registro ".($i+1)."=> Grabado exitoso.<br>";			 
					$resultado = 1;
				}
			}//End for
		}
		
		if ($resultado!=1 && $valorFrm ==1)
		{		
			echo "<SCRIPT LANGUAGE ='javascript'>alert('Error al guardar." .'\n'."Verifique el formato de fecha que tiene en el archivo excel, este debe tener en cada celda que contiene la fecha un apostrofo(Comilla) antes del anno, o la fecha debe tener este formato: AAAA/MM/DD. Esto lo puede ver en el formato de ejemplo de equipo.".'\n\n'."Si el formato de fecha y la información ingresada es correcta y persiste el error; talvez se debe a que ya se guardo el registro.');				
				location='maestablcargaexcel.php'
			</script>";			
		}            	
      	elseif ($resultado!=1 && $valorFrm ==2)
		{			
			echo "<SCRIPT LANGUAGE ='javascript'>alert('Error al guardar." .'\n'."Verifique el formato de fecha que tiene en el archivo excel, este debe tener en cada celda que contiene la fecha un apostrofo(Comilla) antes del anno, o la fecha debe tener este formato: AAAA/MM/DD. Esto lo puede ver en el formato de ejemplo de componente.".'\n\n'."Si el formato de fecha y la información ingresada es correcta y persiste el error; talvez se debe a que ya se guardo el registro.');								
				location='maestablcarcompexc.php'
			</script>";
		}
			          			
      ?></td></strong></font>
            <div align="center">
      <td>&nbsp;</td>
      </div>
    </tr>
    <tr>
      <td colspan="2">
        <div align="center"></div> </td>
    </tr>
    <tr>
      <td class="NoiseErrorDataTD">&nbsp;</td>
    </tr>
  </table>
</form>
</head>
</body>
</html>