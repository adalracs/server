<?php
/**
 *
 * Wrapper of IT'template basic functions
 *
 **/

require_once("HTML/Template/Sigma.php");
class ReportTemplate extends HTML_Template_Sigma {
        	        	    
   /**
    * public Report::setup()
    * Calls the right initialization
    * 
    * @return 
    **/
   function setup()
   {
        /**
         * Call the  IT's template constructor.
         **/
        $this->HTML_Template_Sigma($this->_dir);
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
         * Call the  IT template's function.
         **/
        $this->loadTemplatefile($this->_file, true, true);
    }

    /**
     * Wrapper for templates set variable functions
     * 
     * @access public
     * @return void 
     **/
    function replaceVar($name, $value)
    {
        /**
         * IT set variable style. 
         **/
        $this->setVariable($name, $value);
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
         * IT ideias of a block is very diferent from PHPlib template's. 
         **/
        $this->setCurrentBlock($titlename);
        $this->_setVar($titlename, $title);
        $this->parseCurrentBlock($titlename);
    }
    /**
     * ReportTemplate::cleanBlock()
     * 
     * Do nothing, only needed by phplib template.inc
     * 
     * @param $titlename
     * @return 
     **/
    function cleanBlock($titlename)
    {
    }

    /**
     * Report::parseVariables()
     * 
     * Wrapper to parse the last level from report, i.e., the vars
     * 
     * @param $block
     * @param $value
     * @return 
     **/
    function parseVariables($list)
    {
		$this->_currentlist = $list;
		foreach ($list as $name => $value) {
            $this->setCurrentBlock($this->_blockvaluename);
            $this->_setVar($value);
            $this->parseCurrentBlock($this->_blockvaluename);
        } 
        /**
         * Parse totals
         **/
        if ($this->_showtotals) {
            $this->setCurrentBlock($this->_blocktotalname);
            $this->_setVar($this->_totals);
            $this->parseCurrentBlock($this->_blocktotalname);
            unset($this->_totals);
        } 
    }

    /**
	 * Apply the transform to a indepentend block.
     *
	 */
    function parseFinal($list, $block)
    {
		$this->_totalizing = false;
        $this->setCurrentBlock($block);
        $this->_setVar($list);
        $this->parseCurrentBlock($block);
		$this->_totalizing = true;
    }
}

?>
