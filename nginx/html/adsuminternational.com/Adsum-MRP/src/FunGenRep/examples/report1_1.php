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
$file = "report1_1.htm";
$report = new Report($test, $dir, $file);
/**
 * Set types
 */
$types = array(
	"valid" => 'date',
	"qtd" => 'numeric',
	"value" => 'money');
$report->setVariableType($types);
/**
 * We want totals from column two and three
 */
$totals = array ( 
	"qtd" => true,
	"value" => true
);
$report->setTotals($totals);
/*
  Set the title as column named "title", the number following
  is the the index for 
 */
$report->setTitle("store", 0);

/**
 * Make the report... duh.
 */
$report->setGranTotalBlock("bigtotals");
$report->makeReport();
$report->show();

?> Example source: <a href="/report/source.php?script=./examples/report1_1.php">report1.1.php</a> 
