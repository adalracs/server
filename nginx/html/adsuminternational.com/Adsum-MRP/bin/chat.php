<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Chat - Adsum</title>
 <?php
	include ('../def/jquery.library_maestro.php');
	?>
  		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.function_comun.js"></script>
</head>

<div id="wrapper">
<div id="menu">
<p class="welcome">Welcome, <b></b></p>
<p class="logout"><a id="exit" href="#">Exit Chat</a></p>
<div style="clear: both"></div>
</div>
<div id="chatbox"></div>

<form name="message" action=""><input name="usermsg" type="text"
	id="usermsg" size="63" /> <input name="submitmsg" type="submit"
	id="submitmsg" value="Send" /></form>
</div>
<script type="text/javascript"
	src="http://ajax.googleapis.com/ajax/libs/jquery/1.3/jquery.min.js"></script>
<script type="text/javascript">
 $(document).ready(function(){
 
});
 </script>
</body>
</html>

