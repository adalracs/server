<html>
<link rel="stylesheet" href="style.css" type="text/css">

<body bgcolor="#FFFFFF">
<h1>PHP Report class</h1>
  
<p class="smallFont"><font size="2" class="smallFont"><span class="smallFont"><a href="index-pt_br.php">Este 
  site em portugu&ecirc;s</a> &gt;&gt;<br>
  <br>
  </span></font></p>
<h2>Introduction.</h2>
<p>The PHP Report classes are used to create html report pages from a generic<b> 
  result set </b>array. <br>
  A result set is any <b>array</b> you can came up with. That usually means the 
  result of a sql query, and <br>
  normally it is not ready for display. The classes here are used to parse that 
  result using HTML templates. </p>
<p>Suported template classes are PEAR::HTML_Template_IT and PHPLIB (from phplib 
  or PEAR)<br>
  <br>

<p>The classes you'll need besides having PEAR installed in you server are:
<menu> 
  <li> <a href="/report/source.php?script=Report.php">Report.php</a> THE class. 
  <li> <a href="/report/source.php?script=Report_template.php">Report_template.php</a> 
    'Interface' to the 'raw' PHPLib template. 
  <li><a href="/report/source.php?script=Report_PHPLIB.php">Report_PHPLIB.php</a> 
    'Interface' to the PEAR::HTML_Template_PHPLIB. <img src="newico.jpg" width="23" height="12">
  <li> <a href="/report/source.php?script=Report_IT.php">Report_IT.php</a> 'Interface' 
    to PEAR::HTML_Template_IT (<img src="newico.jpg" width="23" height="12"> fixed!).
  <li><a href="/report/source.php?script=Report_Sigma.php">Report_Sigma.php</a> 
    'Interface' to the PEAR::HTML_Template_Sigma (<img src="newico.jpg" width="23" height="12"> 
    but... not working, block parsing is broken). 
</menu>
<p>These classes are in the 'tar ball' for <a href="report.tar.gz">download</a> 
  together with this page and sample code. </p>
<h2>What I can do with it?</h2>
<p> Sometimes you need to process your result before send it to the user. Think 
  of<br>
  a shop cart. You have to list products, add columns, multiply one column with 
  another,<br>
  format the fields, so dates and floats coming from the database or operations 
  dont show up<br>
  as ugly 8 decimal digits and strange date patterns to the user, etc. <br>
  That all is done by this class. Just feed in your result and a template and 
  you get a very nice <br>
  html page to show to the user.<br>
  <br>
  Currently you can parse the result and: 
<menu>
  <li> have totalization for columns (<a href="#example1">example 1</a>), 
  <li>apply operations on columns and (<a href="#example2">example 2</a>)
  <li> apply functions on that operations or 
<li> apply functions directly to columns.
</menu>
<p> This is not Alpha code as far as it is being used for at<br>
  least 1 year in prodution e-commerce sites I am developing and maintaining. 
  <br>
  <br>
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
Store location		Description		Aquisition date 		qtd		unid. price
<?php 
require_once("./examples/array.php");
	foreach ($test as $i => $a) {
	        echo implode("\t\t",$a) . "<br>";
	}
?>
</pre>
<p>See the array <a href="./examples/showarray.php">here</a><br>
  <br>
  We now want to process that array and get a HTML page like this one:<br>
  <img src="report-example.gif" width="350" height="374"> <font size="2"><br>
  (aside comments the code for the example above used 10 lines of code)</font> 
  <br>
  <br>
  To make array a report we will proceed step by step. <br>
  First we add some titles, and then the make final example. </p>
<p>Open your preferred HTML editor (vi?) and write a page like this: </p>
<p>
<pre>
<?php
$content_array = file("./examples/report0.htm");
$content = implode("", $content_array);
print htmlspecialchars ($content);
?>  
<b> Report generated is <a href="examples/report0.php">here</a>:</b>
<br>
OBS: this is file report0.htm in the download tarball.
</pre>
<h2>Example 1<a name="example1"></a></h2>
<h3>Adding up values in a column</h3>

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
  NOTE: don't forget the spaces before the the BEGIN, END and last dashes, <br>
or you'll get problems.
<p>
Our new template file is now like:<br>
<pre>
<?php
$content_array = file("./examples/report1.htm");
$content = implode("", $content_array);
print htmlspecialchars ($content);
?>

(NOTE: <i>The 'b_' is add to prevent name overlap between block names
and tag names, it is added for default by the class before the title field's 
name, but you can change it if you need</i>)

</pre>
<p><b>Using the same test array as before we now get <a href="examples/report1.php">this 
  result</a>.</b> <br>
</p>
<p><b>Comment: </b>What if we want to add the parcial sums at the end in the example 
  1? To do that<br>
  we need to put a last block at the end of our report, if we set a name for the 
  big total using <br>
  $report-&gt;setGranTotalBlock(&quot;bigtotal&quot;), the new block must be called 
  &quot;bigtotal&quot;. The {vars} you<br>
  put in that new block must have the same name as the ones you want the <br>
  sums. This way:<br>
<pre>
<?php
$content_array = file("./examples/report1_1.htm");
$content = implode("", $content_array);
print htmlspecialchars ($content);
?>
</pre>
  <br>
Clik here so see <a href="examples/report1_1.php">what changed.</a> 
<h2> Example 2<a name="example2"></a></h2>
<h3>Doing match with columns</h3>
Now the fun begins. Since we have a <i>qtd</i> and <i>value</i> column we now want<br>
to now how much we got when multiplying both. What we need is operate on<br>
those columns, apply a formula and put the result somewhere.<br> 
We will do that now, but we will also go another level of filtering, <br>
and add a new subtitle.
<p> First we change the template again and add a subtitle and a new column to receive
the result of our expression:<br>
<pre>
<?php
$content_array = file("./examples/report2.htm");
$content = implode("", $content_array);
print htmlspecialchars ($content);
?>
</pre>
Expressions are math expressions using template tags, as in {qtd}*{value}. You 
can use group elements as () e and <br>
operations like +-/ or any math function known to PHP, or even functions you've 
yourself. When you call the method setExpression <br>
it take care of add a new column to your result set and set the type of the new 
column. Look at the call on the php code:<br>
$report-&gt;setExpression(&quot;total&quot;, &quot;{qtd}*{value}&quot;, &quot;money&quot;); 
<br>
The first arg is the name of the new columns, the second one the math expression 
and the last the column type.<br>
<br>
Look at the example and source code<b><a href="examples/report2.php"> here</a>.</b> 
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
Author: Sebastião Rocha Aladim Neto  (a.k.a  Neto, a.k.a toomuchcoffeman)
<p> Contact me: rocha at i-node dot com dot br, if you have any questions 
<h2>Mailing list</h2>
If you want to get involved, get news or give your contribution subscribe to the 
list, sending a message to:<br>
<a href="mailto:phpreport-subscribe@i-node.com.br">phpreport-subscribe@i-node.com.br<br>
</a> 
<h2>NEWS</h2>
<ul>
  <li>September, 05, 2003 - Support and test for some Template Engines of <a href="http://pear.php.net">PEAR</a> 
    added. Tested on PHPLIB<br>
    and IT. Still working on Sigma. IT was not working rigth before, fixed.<br>
  </li>
  <li>August, 29, 2003 - New example showing how to add several parcial sums in 
    a gran total, at the end of the report.</li>
  <li>April 26, 2003 - Changed capability to apply a multi argument function to 
    a column. That was working unless you<br>
    use a argument that is already being used as a title, or subtitle. In that 
    case the class was crashing.</li>
  <li>April 6, 2003 - Added some methods to have a gran totals block parsed at 
    the end of the report. No examples yet...</li>
  <li>March 27, 2003 - This site is put on-line <br>
    <br>
  </li>
</ul>
<p class="smallFont"><font size="2" class="smallFont"><span class="smallFont">&quot;We 
  still have a choice today: nonviolent coexistence or violent coannihilation. 
  We must move past indecision to action.<br>
  We must find new ways to speak for peace in {Vietnam} and justice throughout 
  the developing world, a world that borders <br>
  on our doors. If we do not act, we shall surely be dragged down the long, dark, 
  and shameful corridors of time reserved for<br>
  those who possess power without compassion, might without morality, and strength 
  without sight&quot;.<br>
  -- Martin Luther King.<br>
  Dont you think its tragical as history repeat itself...</span></font> </p>
<p class="smallFont"><span class="smallFont"><font size="2" class="smallFont">&quot;..the 
  individualism and the confinement of the people in the private sphere would 
  prepare the conditions for the emergency <br>
  of a new type of absolutism, the Democratic absolutism. This species of servitude, 
  regulated, candy and pacific, will be able <br>
  to be conjugated more easily than one imagines with some exterior forms of freedom, 
  and it will not be possible to establish<br>
  it without necessarily remove the sovereignty of the people.&quot;<br>
  <br>
  Alexis de Tocqueville XIX century (profetic...)</font></span></p>
<p>&nbsp;</p>
</body>
</html>
