<?php
 require_once("../Report.php");

 /**
  * Test array for the report class.
  **/  
require_once("array.php");

$dir  = ".";
/*
 The template file
*/
$file = "report0.htm";

/*
 Create a new report class
*/
$report =& new Report($test, $dir, $file);

/*
  Set types
 */
$types = array(
	"valid" => 'date',
	"qtd" => 'numeric',
	"duzia" => 'money');
$report->setVariableType($types);

/*
  Make the report... .
 */
$report->makeReport();

/*
    Show it
*/
$report->show();

?>
Example source: <a href="/report/source.php?script=./examples/report0.php">report0.php</a>
