<?php
   	//include ( '../src/FunGen/sesion/fncvalses.php');
   	
   	// -------------------------------------------
	include ('../src/FunPerSecNiv/fncconn.php');
	include ('../src/FunPerSecNiv/fncclose.php');
	include ('../src/FunPerSecNiv/fncnumreg.php');
	include ('../src/FunPerSecNiv/fncfetch.php');
	// -------------------------------------------
   	
  	include ( '../src/FunPerPriNiv/pktblotestado.php');
  	include ('consultaconfotestado.php');
?>
<html>
<head>
<title>Nuevo registro de Regla</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta http-equiv="expires" content="0">
<link rel="stylesheet" type="text/css" href="temas/Noise/Style.css">
<SCRIPT LANGUAGE="JavaScript">
<!-- Begin
agree = 0;
//  End -->
</script>
<script language="JavaScript" src="motofech.js"></script>
<script language=JavaScript  type="text/javascript" >
function validedit(val)
{
	if(val == 1)
	{
		for(var i=0; i < document.form1.elements.length; i++)
		{
			if(document.form1.elements[i].name == "radiobutton")
				if(document.form1.elements[i].checked == true)
					var flag = 1;
		}
		if(flag == 1)
		{
			document.form1.action='editarordenotestado.php';
			document.form1.submit();
		}else
			alert("Seleccione un elemento");	
	}
	else if(val == 2)
	{
		for(var i=0; i < document.form1.elements.length; i++)
		{
			if(document.form1.elements[i].name == "radiobutton1")
				if(document.form1.elements[i].checked == true)
					var flagval = 1;
		}
		if(flagval == 1)
		{
			document.form1.action='editarvalorotestado.php';
			document.form1.submit();
		}else
			alert("Seleccione un elemento");	
	}
}
function validdelet(val)
{
	if(val == 1)
	{
		for(var i=0; i < document.form1.elements.length; i++)
		{
			if(document.form1.elements[i].name == "radiobutton")
				if(document.form1.elements[i].checked == true)
					var flag = 1;
		}
		if(flag == 1)
		{
			document.form1.action='borrarordenotestado.php';
			document.form1.submit();
		}else
			alert("Seleccione un elemento");	
	}
	else if(val == 2)
	{
		for(var i=0; i < document.form1.elements.length; i++)
		{
			if(document.form1.elements[i].name == "radiobutton1")
				if(document.form1.elements[i].checked == true)
					var flagval = 1;
		}
		if(flagval == 1)
		{
			document.form1.action='borrarvalorotestado.php';
			document.form1.submit();
		}else
			alert("Seleccione un elemento");	
	}
}
</script>
</head>
<?php
    if(!$codigo)
    { echo "<!--";}
?>
<body bgcolor="#FFFFFF" text="#000000">
<form name="form1" method="post"  enctype="multipart/form-data">
  <p><font class="NoiseFormHeaderFont">Reglas de estados de OT</font></p>
  <table border="0" cellspacing="1" cellpadding="2" align="center" class="NoiseFormTABLE">
    <tr>
      <td width="450" colspan="2" class="NoiseErrorDataTD">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="2" class="NoiseFieldCaptionTD"><span class="style5"><font color="#FFFFFF">Ingresar nueva regla</font></span></td>
    </tr>
        <tr>
    <td colspan="2">&nbsp;</td>
        </tr>
        <tr>
      <td colspan="2">
        <table width="97%" border="0" cellspacing="0" cellpadding="0"
align="center">
        <tr>
       <td colspan="2"><b>Orden L&oacute;gico<b></td>
       <td colspan="2" align="right"><input type="submit" name="newOrden" value="Nuevo" onClick="form1.action='ingrnuevordenotestado.php';"><input type="submit" name="editOrden" value="Editar" onClick="validedit(1);"><input type="submit" name="delOrden" value="Borrar" onClick="validdelet(1);"></td>
    	</tr>
    	<tr><td colspan="2" align="center" class="NoiseErrorDataTD">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Inicial</td><td class="NoiseErrorDataTD">&nbsp;</td><td align="left" class="NoiseErrorDataTD">Final</td></tr>
    	         <?php
    	         	$idcon = fncconn();
					consultaconfotestado($arrval,$arrlog);
					for($j = 0;$j < count($arrlog); $j++)
					{
						$trlog = explode("-",$arrlog[$j]);
						
						$sbregest = loadrecordotestado($trlog[0],$idcon);
						$sbregest1 = loadrecordotestado($trlog[1],$idcon);
						echo '<tr><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td align="left"><input type="radio" name="radiobutton" value="'.$trlog[0]."-".$trlog[1].'">&nbsp;'.$sbregest["otestanombre"].'</td><td>&nbsp;</td><td align="left">'.$sbregest1["otestanombre"].'</td></tr>';
					}
				?>
          <tr>
            <td colspan="4">&nbsp;</td>
           </tr>
        <!--<tr>
	       <td colspan="2"><b>Valor<b></td>
	       <td colspan="2" align="right"><input type="submit" name="newValor" value="Nuevo" onClick="form1.action='ingrnuevvalorotestado.php';"><input type="submit" name="editValor" value="Editar" onClick="validedit(2);"><input type="submit" name="delValor" value="Borrar" onClick="validdelet(2);"></td>
    	</tr>
		<tr><td colspan="2" align="center" class="NoiseErrorDataTD">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Estado</td><td class="NoiseErrorDataTD">&nbsp;</td><td align="left" class="NoiseErrorDataTD">Valor</td></tr>
    	         <?php
    	         	/*for($k = 0;$k < count($arrval); $k++)
					{
						$trval = explode("-",$arrval[$k]);
						$sbregest = loadrecordotestado($trval[0],$idcon);
						echo '<tr><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td align="left"><input type="radio" name="radiobutton1" value="'.$trval[0]."-".$trval[1].'">&nbsp;'.$sbregest["otestanombre"].'</td><td>&nbsp;</td><td align="left">'.$trval[1].'</td></tr>';
					}
					fncclose($idcon);*/
                 ?>
                 -->
           <tr>
            <td colspan="4">&nbsp;</td>
           </tr>
        </table>
      </td>
    </tr>
    <tr>
      <td colspan="4">
        <div align="center"> <font color="#FFFFFF">Espacio vacio</font>
          <input type="image" name="aceptar" onClick="form1.action='maestablotestado.php';" alt="Aceptar" border=0 width="86" height="18" src="../img/aceptar.gif">
          <font color="#FFFFFF">Espacio vacio</font></div>
      </td>
    </tr>
    <tr>
      <td class="NoiseErrorDataTD" colspan="2">&nbsp;</td>
    </tr>
  </table>
<input type="hidden" name="accionnuevoregla">
<input type="hidden" name="codigo" value="<?php echo $codigo; ?>">
<input type="hidden" name="arrtext" value="<?php echo $arrtext; ?>">
<input type="hidden" name="arrcodtex" value="<?php echo $arrcodtex; ?>">
</form>
</body>
<?php
    if(!$codigo)
    { echo " -->"; }
?>
</html>
