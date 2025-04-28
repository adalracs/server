<?php
    
    if(!$script) {
    echo "<BR><B>ERROR: Script Name needed</B><BR>";
    } else {
    if (ereg("(\.php|\.inc)$",$script)) {
    echo "<H1>Source of: $script</H1>\n<HR>\n";
    highlight_file("./$script");
    } else {
    echo "<H1>ERROR: Only PHP or include script names are allowed</H1>"; 
    }
    }
    echo "<HR>Processed: ".date("Y/M/d H:i:s",time());
?>

