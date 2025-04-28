<?php
 require_once("Report.php");

 /**
  * Test array for the report class.
  **/  
  $test = array("0" =>array('_title' =>'titulo1',
                           '_subtitle' =>'subtitulo1',
                           'value1' =>'100.0',
                           'value2' =>'2001-02-01',
                           'value3' =>'10.0'),
              "1" =>array('_title' =>'titulo1',
                           '_subtitle' =>'subtitulo1',
                           'value1' =>'101.0',
                           'value2' =>'2001-02-02',
                           'value3' =>'11.0'),
              "2" =>array('_title' =>'titulo1',
                           '_subtitle' =>'subtitulo1',
                           'value1' =>'102.0',
                           'value2' =>'2001-02-03',
                           'value3' =>'12.0'),
              "3" =>array('_title' =>'titulo1',
                           '_subtitle' =>'subtitulo2',
                           'value1' =>'103.0',
                           'value2' =>'2002-12-03',
                           'value3' =>'22.0'),
              "4" =>array('_title' =>'titulo1',
                           '_subtitle' =>'subtitulo2',
                           'value1' =>'113.0',
                           'value2' =>'2001-12-03',
                           'value3' =>'3300'),
              "5" =>array('_title' =>'titulo1',
                           '_subtitle' =>'subtitulo2',
                           'value1' =>'13.0',
                           'value2' =>'2001-12-03',
                           'value3' =>'300'),
              "6" =>array('_title' =>'titulo2',
                           '_subtitle' =>'subtitulo2',
                           'value1' =>'13.3',
                           'value2' =>'2001-12-13',
                           'value3' =>'30.1'),
              "7" =>array('_title' =>'titulo2',
                           '_subtitle' =>'Just my cents',
                           'value1' =>'1.3',
                           'value2' =>'2001-12-03',
                           'value3' =>'0.1'),
    );
echo " 
<pre>
<h3>Inicial array:</h3>
";
print_r($test);
echo "
<h3>Resulting on:</h3>
";
$dir  = ".";
/*
 The template file
*/
$file = "report.htm";
$report = new Report($test, $dir, $file);
/**
 * Set types
 */
$types = array(
	"value1" => 'numeric',
	"value2" => 'date',
	"value3" => 'money');
$report->setVariableType($types);
/**
 * We want totals from column one and three
 */
$totals = array ( 
	"value1" => true,
	"value3" => true
);
$report->setTotals($totals);
/**
 * Set the titles
 */
$report->setTitle("_title", 0);
$report->setTitle("_subtitle", 1);

/**
 * Make the report... duh.
 */
$report->makeReport();
$report->show();

?>
Example source: <a href="report.phps">report.php</a>
