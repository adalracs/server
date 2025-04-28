<?php
include ('consultaconfotestado.php');

function borraotestado($otestacodigo)
{
	if($otestacodigo)
	{
		$nuconn = fncconn();
		// -- Leemos el archivo de configuracion de OT --
		//-----------------------------------------------
		$fparr = file('../etc/ot.conf');
		$flnum = count($fparr);
		$needle = $otestacodigo;

		for ($i=0; $i<$flnum; $i++)
		{
			if(rtrim($fparr[$i]) == "[Orden logico]")
			{
				while (rtrim($fparr[$i+1]) != "[/Orden logico]")
				{
					$i++;
					$str_cmp = rtrim($fparr[$i]);
					$arr_cmp = explode('-', $str_cmp);

					for($j=0; $j<2; $j++)
					{
						if($arr_cmp[$j] == $needle)
						{
							$flagborrarerr = true;
						}
					}
				}
			}
		}
		//------------------------------------------------
		if(!$flagborrarerr)
		{
			$result = delrecordotestado($otestacodigo,$nuconn);
			
			if($result > 0)
			{
				echo '<script language="javascript">';
				echo '<!--//'."\n";
				echo 'alert("Borrado exitoso")';
				echo '//-->'."\n";
				echo '</script>';
			}
			else 
			{
				echo '<script language="javascript">'."\n";
				echo '<!--//'."\n";
				echo 'alert("El registro no se puede eliminar ya que se encuentra en uso");'."\n";
				echo 'location ="maestablotestado.php?codigo='.$codigo.';"';
				echo '//-->'."\n";
				echo '</script>';
			}
		}
		else
		{
			ob_end_clean();
			echo '<script language="javascript">';
			echo '<!--//'."\n";
			echo 'alert("Este registro no se puede eliminar del sistema")'."\n";
			echo 'location ="maestablotestado.php?codigo='.$codigo.';"';
			echo '//-->'."\n";
			echo '</script>';
		}
	}
	fncclose($nuconn);
}
borraotestado($otestacodigo);
?> 
