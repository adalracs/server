<?php
/*
Propiedad intelectual Adsum
Funcion		: validaint4
Descripcion	: Valida que se ingrese solo los caracteres que permite este tipo de dato
Parametros	: $arg
Retorno		:
Autor		: lfolaya
Fecha		: 11-Agos-2004

Historial de modificaciones
Fecha			Motivo															Autor
19-ene-2006		Type casting del parametro, en caso de que no sea una cadena			mstroh
*/

function validaint4($arg)
{
	define("msgerror",1);
	define("msgexit",-1);

	if($arg != null)
	{
		if(!is_string($arg))
		{
			// -- Type casting
			$arg = (string)$arg;
			// --
		}
		
		for($i=0 ;$i < strlen($arg) ; $i++ )
		{
			if(!($arg[$i] == "1" || $arg[$i] == "2" || $arg[$i] =="3" ||
				 $arg[$i] == "4" || $arg[$i] == "5" || $arg[$i] =="6" ||
				 $arg[$i] == "7" || $arg[$i] == "8" || $arg[$i] =="9" || $arg[$i] == "0"))
			{
				return msgerror;
			}
		}
		return msgexit;
	}
	else
	{
		return msgexit;
	}

}
/*
Propiedad intelectual Adsum
Funcion		: validaint8
Descripcion	: Valida que se ingrese solo los caracteres que permite este tipo de dato
Parametros	: $arg
Retorno		:
Autor		: lfolaya
Fecha		: 11-Agos-2004
*/

function validaint8($arg)
{
	define("msgerror",1);
	define("msgexit",-1);

	for($i=0 ;$i < strlen($arg) ; $i++ )
	{
		if($arg[$i] =="1" || $arg[$i] =="2" || $arg[$i] =="3" || $arg[$i] =="4" || $arg[$i] =="5" || $arg[$i] =="6" || $arg[$i] =="7" || $arg[$i] =="8" || $arg[$i] =="9" || $arg[$i] =="0")
		{
			//			echo $arg[$i];
		}else
		{
			//			echo '<script language = "javascript">';
			//			echo '<!--//'."\n";
			//			echo 'alert("Caracter no v\u00e1lido,por favor digite un valor num\u00e9rico o seleccione un item")';
			//			echo '//-->'."\n";
			//			echo '</script>';
			return msgerror;
		}
	}
	return msgexit;
	/*if(!ereg("[0-9]",$arg))
	{
	echo '<script language = "javascript">';
	echo '<!--//'."\n";
	echo 'alert("Caracter no valido,por favor digite un valor numerico o seleccione un item")';
	echo '//-->'."\n";
	echo '</script>';
	return msgerror;
	}
	else
	{
	return msgexit;
	}*/
}


/*
Propiedad intelectual Adsum
Funcion		: validavarchar
Descripcion	: Valida que se ingrese solo los caracteres que permite este tipo de dato
Parametros	: $arg
Retorno		:
Autor		: lfolaya
Fecha		: 11-Agos-2004
*/

function validavarchar($arg)
{
	define("msgerror",1);
	define("msgexit",-1);

	return msgexit;
}


/*
Propiedad intelectual Adsum
Funcion		: validavarchar
Descripcion	: Valida que se ingrese solo los caracteres que permite este tipo de dato
Parametros	: $arg
Retorno		:
Autor		: lfolaya
Fecha		: 11-Agos-2004
*/

function validabigint($arg)
{
	define("msgerror",1);
	define("msgexit",-1);

	return msgexit;
}


/*
Propiedad intelectual Adsum
Funcion		: validatext
Descripcion	: Valida que se ingrese solo los caracteres que permite este tipo de dato
Parametros	: $arg
Retorno		:
Autor		: lfolaya
Fecha		: 11-Agos-2004
*/

function validatext($arg)
{
	define("msgerror",1);
	define("msgexit",-1);

	return msgexit;
}


/*
Propiedad intelectual Adsum
Funcion		: validabpchar
Descripcion	: Valida que se ingrese solo  los caracteres que permite este tipo de dato
Parametros	: $arg
Retorno		:
Autor		: lfolaya
Fecha		: 11-Agos-2004
*/

function validabpchar($arg)
{
	define("msgerror",1);
	define("msgexit",-1);

	return msgexit;
}


/*
Propiedad intelectual Adsum
Funcion		: validadate
Descripcion	: Valida que se ingrese solo los caracteres que permite este tipo de dato
Parametros	: $arg
Retorno		:
Autor		: lfolaya
Fecha		: 11-Agos-2004
*/

function validadate($arg)
{
	define("msgerror",1);
	define("msgexit",-1);

	$tok1 = explode("-",$arg);

	if($tok1[1] == null || $tok1[2] == null || $tok1[0] == null)
	{
		//   		echo '<script language = "javascript">';
		//		echo '<!--//'."\n";
		//		echo 'alert("Caracter no v\u00e1lido,por favor corregir el formato de la fecha")';
		//		echo '//-->'."\n";
		//		echo '</script>';
		return msgerror;
	}else
	{
		IF (checkdate($tok1[1], $tok1[2], $tok1[0]))
		{
			return msgexit;
		}
		ELSE
		{
			//			echo '<script language = "javascript">';
			//			echo '<!--//'."\n";
			//			echo 'alert("Caracter no v\u00e1lido,por favor corregir el formato de la fecha")';
			//			echo '//-->'."\n";
			//			echo '</script>';
			return msgerror;
		}
	}
}


/*
Propiedad intelectual Adsum
Funcion 	: validatime
Descripcion	: Valida que se ingrese los caracteres que permite este tipo de dato
Parametros	: $arg
Retorno		:
Autor		: lfolaya
Fecha		: 11-Agos-2004
*/

function validatime($arg)
{
	define("msgerror",1);
	define("msgexit",-1);

	$tok1 = explode(":",$arg);

	if($tok1[0] >= 0 && $tok1[0] < 24 )
	{
		if($tok1[1] >= 0 && $tok1[1] < 60 )
		{
			return msgexit;
		}
		else
		//				echo '<script language = "javascript">';
		//				echo '<!--//'."\n";
		//				echo 'alert("Caracter no v\u00e1lido,por favor corregir el formato de la hora")';
		//				echo '//-->'."\n";
		//				echo '</script>';
		return msgerror;
	}else
	//			echo '<script language = "javascript">';
	//			echo '<!--//'."\n";
	//			echo 'alert("Caracter no v\u00e1lido,por favor corregir el formato de la hora")';
	//			echo '//-->'."\n";
	//			echo '</script>';
	return msgerror;

	/*    if(!ereg("(([0-2])([0-9])):([0-5])([0-9])",$arg))
	{
	echo '<script language ="javascript">';
	echo '<!--//'."\n";
	echo 'alert("Caracter no valido, por favor ingrese hh:mm")';
	echo '//-->'."\n";
	echo '</script>';
	return msgerror;
	}
	else
	{
	return msgexit;
	}*/
}


/*
Propiedad intelectual Adsum
Funcion		: validatimetamptz
Descripcion	: Valida que se ingrese los caracteres que permite este tipo de dato
Parametros	: $arg
Retorno		:
Autor		: lfolaya
Fecha		: 11-Agos-2004
*/

function validatimetamptz($arg)
{
	define("msgerror",1);
	define("msgexit",-1);

	if(!ereg("[0-9]",$arg))
	{
		//	echo '<script language = "javascript">';
		//	echo '<!--//'."\n";
		//	echo 'alert("Caracter no v\u00e1lido")';
		//	echo '//-->'."\n";
		//	echo '</script>';
		return msgerror;
	}
	else
	{
		return msgexit;
	}
}


/*
Propiedad intelectual Adsum
Funcion		: validabool
Descripcion	: Valida que se ingrese los caracteres que permite este tipo de dato
Parametros	: $arg
Retorno		:
Autor		: lfolaya
Fecha		: 11-Agos-2004
*/

function validabool($arg)
{
	define("msgerror",1);
	define("msgexit",-1);

	return msgexit;
}


/*
Propiedad intelectual Adsum
Funcion		: validafloat4
Descripcion	: Valida que se ingrese los caracteres que permite este tipo de dato
Parametros	: $arg
Retorno		:
Autor		: lfolaya
Fecha		: 11-Agos-2004
*/

function validafloat4($arg)
{
//	define("msgerror",1);
//	define("msgexit",-1);
//
//	return msgexit;
	define("msgerror",1);
	define("msgexit",-1);

	if($arg != null)
	{
		if(!is_string($arg))
		{
			// -- Type casting
			$arg = (string)$arg;
			// --
		}
		
		for($i=0 ;$i < strlen($arg) ; $i++ )
		{
			if(!($arg[$i] == "1" || $arg[$i] == "2" || $arg[$i] =="3" ||
				 $arg[$i] == "4" || $arg[$i] == "5" || $arg[$i] =="6" ||
				 $arg[$i] == "7" || $arg[$i] == "8" || $arg[$i] =="9" || 
				 $arg[$i] == "0" || $arg[$i] == "."))
			{
				return msgerror;
			}
		}
		return msgexit;
	}
	else
	{
		return msgexit;
	}
}

/*
Propiedad intelectual Adsum
Funcion		: validafloat8
Descripcion	: Valida que se ingrese los caracteres que permite este tipo de dato
Parametros	: $arg
Retorno		:
Autor		: mstroh
Fecha		: 19-Sep-2005
*/

function validafloat8($arg)
{
	define("msgerror",1);
	define("msgexit",-1);

	return msgexit;
}
?>
