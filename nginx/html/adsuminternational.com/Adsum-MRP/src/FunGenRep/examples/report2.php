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
$file = "report2.htm";
$report = new Report($test, $dir, $file);
/**
 * Set types
 */
$types = array(
	"valid" => 'date',
	"qtd" => 'numeric',
	"duzia" => 'money');
$report->setVariableType($types);

/**
 * Set the titles
 */
$report->setTitle("store", 0);
$report->setTitle("description", 1);

/*
 Find the total per line
 */
$report->setExpression("total", "{qtd}*{value}", "money");

/**
 * We want totals from column one and three
 */
$totals = array ( 
	"qtd" => true,
	"duzia" => true,
	"total" => true,
);
$report->setTotals($totals);

/**
 * Make the report... duh.
 */
$report->makeReport();
$report->show();

?>
Example source: <a href="/report/source.php?script=./examples/report2.php">report2.php</a>
