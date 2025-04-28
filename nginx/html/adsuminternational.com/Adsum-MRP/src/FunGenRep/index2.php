<html>
<body bgcolor="#FFFFFF">
<h1>PHP Report class</h1>
  This class creates an html report page from a result set array. 
  A result set is any array you can came up with.<br>
  That usually means a result of a sql query, and normally
  it is not ready for display. <br>The class here is used to parse that result 
  using HTML templates. 
<p>Suported template classes are PEAR::HTML_Template_IT and PHPLib template<br> 
  (Not the PEAR::HTML_Template_PHPLIB one yet, sorry, it is in my TODO list). 
<p>The classes you'll need besides having PEAR installed in you server are:
<menu>
<li> <a href="/report/source.php?script=Report.php">Report.php</a> THE class.
<li> <a href="/report/source.php?script=Report_template.php">Report_template.php</a> 'Interface' to PHPLib template.
<li> <a href="/report/source.php?script=Report_IT.php">Report_IT.php</a> 'Interface' to PEAR::HTML_Template_IT
</menu>
These classes are in the 'tar ball' for <a href="report.tar.gz">download</a> together
with this page and sample code.
<p> 
 Currently you can parse the result set and:
<menu>
<li> have totalization of columns, 
<li>apply operations on columns and 
<li> apply functions on that operations or 
<li> apply functions directly to columns.
</menu>
<p>
This is not Alpha code as far as it is being use for at<br> least 1 year in prodution
e-commerce sites I am developing and maintaining.
<P>
Bellow I will show you how to get started using this package. 
<h2>Example 0</h2>
<h3>A Simple example</h3>
 This firt example is meant to ilustrate the common parse block feature<br>
 inherited from those template classes. Not really a report yet.<br>
 But note we already have the formatting of float and date fields
<p>
 Suppose your SQL query gave you a array like the one bellow:
 <pre> 
Ex.: Inicial result set:
----------------------------------------------------------------------------------
title		subtitle		value1		value2		value2
<?php 
require_once("./array.php");
	foreach ($test as $i => $a) {
	        echo implode("\t\t",$a) . "<br>";
	}
?>
</pre>
 To make that a report, you have to open your preferred
 HTML editor (vi?) and write a page like this: <p>
<pre>
<?php
$content_array = file("./report0.htm");
$content = implode("", $content_array);
print htmlspecialchars ($content);
?>  
<b> Report generated is <a href="examples/report0.php">here</a>:</b>
<br>
OBS: this is file report0.htm in the download tarball.
</pre>
<h2>Example 1</h2>
<h3>Reporting and adding columns</h3>

Now we will put a title on the report and add the columns to<br>
have some totals at the end.
<p>
To have a title we need to add a block to the template. 
<p>
Blocks as you may know or have guessed from the above, are <br>
HTML (special) comments:<br>
This is the one to mark a begining of a block<br>
<font color="#FF0000"> &lt;!-- BEGIN block_name --&gt</font>
<p>
and this other for the end<br>
<font color="#FF0000"> &lt;!-- END block_name --&gt</font>
<br> 
NOTE: to forget the spaces before the the BEGIN, END and last dashes, <br>
or you'll get problems.
<p>
Our new template file is now like:<br>
<pre>
<?php
$content_array = file("./report1.htm");
$content = implode("", $content_array);
print htmlspecialchars ($content);
?>

(NOTE: <i>The 'b_' is add to prevent name overlap between block names
and tag names, it is added for default by the class before the title field's 
name, but you can change it if you need</i>)

</pre>
<b>Using the same test array as before we now get <a href="examples/report1.php">this 
result</a>.</b> 
<h1>Example 2</h1>
<h3>Applying formulas to columns</h3>
Now the fun begins. Since we have a <i>qtd</i> and <i>value</i> column we now want<br>
to now how much we got when multiplying both. What we need is operate on<br>
those columns, apply a formula and put the result somewhere.<br> 
We will do that now, but we will also go another level of filtering, <br>
and add a new subtitle.
<p> First we change the template again and add a subtitle and a new column to receive
the result of our expression:<br>
<pre>
<?php
$content_array = file("./report2.htm");
$content = implode("", $content_array);
print htmlspecialchars ($content);
?>
</pre>
Expressions are math expressions using template tags, as in {qtd}*{duzia}.<br>
This is what <b><a href="examples/report2.php">we got now</a>.</b> 
<p>
This is it, for now.<p>
<a href="report.tar.gz">Download the package</a><br> read the examples, 
share it, <form action="https://www.paypal.com/cgi-bin/webscr" method="post">
<input type="hidden" name="cmd" value="_xclick">
<input type="hidden" name="business" value="rocha@i-node.com.br">
<input type="hidden" name="item_name" value="PHP Report class">
<input type="hidden" name="no_note" value="1">
<input type="hidden" name="currency_code" value="USD">
<input type="hidden" name="tax" value="0">
<input type="image" src="https://www.paypal.com/images/x-click-but04.gif" border="0" name="submit" alt="Make payments with PayPal - it's fast, free and secure!">
</form> ;).
<p>
I will keep updating this page with new examples as time permits. 
<p>
Author: Sebastião Rocha Aladim Neto  (a.k.a  Neto, a.k.a toomuchcoffeman)<p>
Contact <a href="mailto:rocha@i-node.com.br">me</a> if you have any questions 
</body>
</html>
