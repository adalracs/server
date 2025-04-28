<?php
class cadena
{
function sintaxisql ($arg, $campo, &$flag) 
{ 
if ($flag) 
{ 
@$aux = " AND "; 
} 
if ($arg=="") 
{ 
return ""; 
} 
else 
{ 
$flag = 1; 
return @$aux." upper(".$campo.") like '%".strtoupper($arg)."%'";
} 
} 
}
?>