<?php 
/*
Propiedad intelectual de FullEngine (c).
Funcion         : grabaobservac
Decripcion      : Graba los datos de observaciones.
Parametros      : Descripicion
   $iregcentturi  Arreglo con la data a grabar.

Retorno         : Descripicion

Autor           : agomez-freina-creyes-ariascos
Fecha           : 20-feb-2002
*/

//include('../src/FunGen/fncactdetcetu.php');
include('../src/FunGen/fncnumact.php');
include('../src/FunGen/fncnumprox.php');
include('../src/FunPerPriNiv/fncbegin.php');
include('../src/FunPerPriNiv/fnclock.php');
include('../src/FunPerPriNiv/fnccommit.php');
 
function grabamenucomp($iRegmenucomp)  
{ 
	define ("n",0);
	define ("n1",1);
	define("id",34);
	define("e_empty",-3);
	$result= n;
	$nuconn = fncconn();

	if($iRegmenucomp[mecocodi]&&   // valida si los datos estan completos.
	   $iRegmenucomp[mecocopa]&&
	   $iRegmenucomp[mecoorde]&&
	   $iRegmenucomp[timecodi]&&
	   $iRegmenucomp[mecoscri])
	{
		//genera (mecocodi) el codigo de la tabla pormedio de "$nuidtemp".

		$nucomecoditemp = $iRegmenucomp[mecocodi];

		$nures = fncbegin($nuconn);

		$nures1= fnclock("numerado",$nuconn);

		$nuidtemp = fncnumact(id,$nuconn);

		do
			{
			$nuresult = loadrecordmenucomp($nuidtemp,$nuconn);

			if($nuresult == e_empty)
			{
				$iRegmenucomp[mecocodi]= $nuidtemp;
			}
			$nuidtemp ++;

		}while ($nuresult != e_empty);

		$nuresult1 = fncnumprox(id,$nuidtemp,$nuconn);

		$nuresult2 = insrecordmenucomp($iRegmenucomp,$nuconn); //inserta los datos en la tabla (menucomp).

		$nures2 = fnccommit($nuconn);
		if ($nuresul2 < 0)
		{
			echo '<script language="javascript">';
			echo '<!--//'."\n";
			echo 'alert("Error al ingresar el registro")';
			echo '//-->'."\n";
			echo '</script>';
		}
	}
	else
	{
		echo '<script language="javascript">';
		echo '<!--//'."\n";
		echo 'alert("Datos Incompletos");';
		echo "location=".'"'."/template/paginas/ingrnuevmenucomp".'.'."php?codigo=1&mecocodi=".$iRegmenucomp[mecocodi].'";'."\n";
		echo '//-->'."\n";
		echo '</script>';
	}

	fncclose($nuconn);
	 
} 
$iRegmenucomp[mecocodi] = $mecocodi; 
$iRegmenucomp[mecocopa] = $mecocopa; 
$iRegmenucomp[mecoorde] = $mecoorde; 
$iRegmenucomp[timecodi] = $timecodi; 
$iRegmenucomp[meconomb] = $meconomb; 
$iRegmenucomp[mecoscri] = $mecoscri; 
$iRegmenucomp[mecoacra] = $mecoacra; 
grabamenucomp($iRegmenucomp); 
?> 
