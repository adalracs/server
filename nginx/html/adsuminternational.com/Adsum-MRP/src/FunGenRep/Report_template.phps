<?php

require_once("template.inc");
class ReportTemplate extends template {
        	        	    
   /**
    * public Report::setup()
    * Calls the right initialization for the template
    * 
    * IMPORTANT: template.inc uses a handle to point to the file
    * if you need a different one from "Index"  remover the call
    * to setFile here and call it yourself with another name.
    * 
    * @return 
    **/
   function setup()
   {
        /**
         *  Call the template constructor
         **/
        $this->Template($this->_dir);
        $this->setFile();
    } 

    /**
     * Report::setFile()
     * 
     * Wrapper for set file functions of templates
     * 
     * @param string $handle name of the variable holding the file.
     * @return 
     **/
    function setFile($handle="")
    {
        /**
         *  Call the template file file
         **/
        if( $handle ) {
            $this->_handle = $handle; // Variable holding the page
        } else {
            $this->_handle = "Index";
        }
        $this->set_file($this->_handle, $this->_file);      
    }
    
    function setHandle($handle) 
    {
		$this->_handle = $handle;
    }
    /**
     * Wrapper for template's set variable functions
     *
     * @access public
     * @return void 
     **/
    function replaceVar($name, $value)
    {
        /**
         * PHPLib template set variable style. 
         **/
        $this->set_var($name, $value);
    }

    
    /**
     * Report::blockParser()
     * 
     * Wrapper to block parsing functions.
     * 
     * @param $titlename
     * @param $title
     * @return 
     **/
    function blockParser($titlename, $title)
    {
       /**
        * PHPlib template's block handling. 
        **/
        $titleblock = "b_" . $titlename; 
        
        if ( !isset($this->dummies[$titleblock])) {
        /** 
         * if not we create one.
         * Create a marker to replace $block at the parent block
         **/
            $this->dummies[$titleblock] = "_" . $titlename . "_";
            $this->set_block($this->_handle, $titleblock, $this->dummies[$titleblock]);
        }
        $this->setVar($titlename, $title);
        $this->parse($this->dummies[$titleblock], $titleblock, true);         
    //    $this->parse($titleblock, $this->dummies[$titleblock]);         
    }
    /**
     * ReportTemplate::cleanBlock()
     * 
     * Do the same cleaning we have at parseVariable, but should be
     * called from Report class
     * 
     * @param $titlename
     * @return 
     **/
    function cleanBlock($titlename)
    {
        $titleblock = "b_" . $titlename; 
        if ( isset($this->dummies[$titleblock]) ) {
            $this->set_var($this->dummies[$titleblock], "");    	
        }
    }
    
    /**
     * Report::parseVariables()
     * 
     * Wrapper to parse the last level from report, i.e., the vars
     * 
     * PHPlib template's block handling.
     * This should the done at the innermost level of parsing, or 
     * else we get in trouble.
     * $value can be an array of values.
     * 
     * @param $block
     * @param $value
     * @return 
     **/
    function parseVariables($list)
    {
       /**
        * See if we already have a handler $block
        * if not we create one.
        * Create a marker to replace $block at the parent currentblock
        **/
        $block = $this->_blockvaluename;
        if ( !isset($this->dummies[$block])) {
            $this->dummies[$block] = "_" . $block . "_";
            $this->set_block($this->_handle, $block, $this->dummies[$block]);
        }  
           
        /**
         * See if we have totals to parse too. 
         **/    
        $totalsname = $this->_blocktotalname;
        if ($this->_showtotals && !$this->dummies[$totalsname] ) {
            /** 
             * Create a marker to replace $block for the totals
             **/
            $this->dummies[$totalsname] = "_" . $totalsname . "_";
            $this->set_block($this->_handle, $totalsname, $this->dummies[$totalsname]);
        }
        
        $this->set_var($this->dummies[$block], "");
		$this->_totalizing = true;
        foreach ($list as $name => $value) {
            $this->setVar($value);
		    $this->parse($this->dummies[$block], $block, true);
        } 
        /**
         * Parse totals
         **/
        if ($this->_showtotals) {        
			$this->_totalizing = false;
            $this->setVar($this->_totals);
            $this->parse($this->dummies[$totalsname], $totalsname);
            unset($this->_totals);
			$this->_totalizing = true;
        } 
    }
    /**
     * Show the report
     * 
     * @access public
     * @return void 
     **/
    function show()
    {
        $this->parse("Out", $this->_handle);
        $this->p("Out");
    }
    
}

?>
