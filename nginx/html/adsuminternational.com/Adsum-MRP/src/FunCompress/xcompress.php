<?php
/* 
+-------------------------------------------------------------------------- 
|   XCompress class
|   ======================================== 
|   by Marioly Garza Lozano <marioly@gmail.com> 
|   (c) 2008 Hackerss.com 
|   http://www.hackerss.com 
|   ========================================
|    Licensed under The MIT License
|    Redistributions of files must retain the above copyright notice.
|   
|    Web: http://www.hackerss.com 
|   Email: marioly@gmail.com 
|   Licence Info: http://www.opensource.org/licenses/mit-license.php The MIT License 
+---------------------------------------------------------------------------
*/

abstract class XCompress
{
    protected $files_in_mem = array();
    
    abstract protected function compressProcess();
    abstract protected function uncompressProcess($filename);
    
    public function compressFolder($dir)
    {
        if( !is_dir($dir) )
            trigger_error( "XCompress::compressFolder(): invalid directory (" . $dir . ")", E_USER_ERROR );
        
        $this->scanFolder($dir);
    }
    
    public function compressFiles($files)
    {
        if( !is_array($files) )
            $files = array($files);
        
        $this->evaluateFiles($files);
    }
    
    private function scanFolder($dir)
    {
        $dir = $this->correctSlash($dir);
        $files = array();

        $odr = dir($dir);
                
        while( ($file = $odr->read()) !== false )
        {
            if( preg_match("/^\.+$/", $file) )
                continue;
            
            $path = $dir . $file;
            
            if(    is_dir($path) )
            {
                $this->scanFolder($path);
            }
            else if( is_file($path) )
            {
                $files[] = $path;
            }
        }
        $odr->close();
        
        $this->evaluateFiles($files);
    }
    
    private function evaluateFiles($files)
    {
        foreach( $files as $k => $file )
        {
            if(! file_exists($file) )
                continue;
            
            $stat = stat($file);
                
            $mode  = fileperms($file);
            $uid   = $stat[4];
            $gid   = $stat[5];
            $rdev  = $stat[6];
            $size  = filesize($file);
            $mtime = filemtime($file);
            
            $data = file_get_contents($file);
            $file = preg_replace("/^(\.+\/)+/", "", $file);
            
            $this->files_in_mem[] = array (
                                        'name'     => $file,
                                        'mode'     => $mode,
                                        'uid'      => $uid,
                                        'gid'      => $gid,
                                        'size'     => $size,
                                        'mtime'    => $mtime,
                                        'data'     => $data);
        }
    }
    
    public function saveFile($filename)
    {
        $data = $this->compressProcess();
        
        return file_put_contents($filename, $data);
    }
    
    public function extract($filename, $extract_to = "", $selected = array())
    {
        if( !file_exists($filename) )
            trigger_error( "XCompress::extract(): invalid file (" . $filename . ")", E_USER_ERROR );
        
        $files = $this->uncompressProcess($filename);

        if( !empty($extract_to) ) {
            $extract_to = $this->correctSlash($extract_to);
            $this->createFolders($extract_to);
        }
        else {
            $extract_to = "./";
        }
        
        if( !is_writable($extract_to) )
            trigger_error( "XCompress::extract(): destination directory is not writable (" . $extract_to . ")", E_USER_ERROR );
        
        if( !is_array($selected) )
            $selected = array($selected);
        
        foreach ($files as $k => $file)
        {
            if( !empty($selected) )
                if( !in_array($file['name'], $selected) )
                    continue;
            
            if( preg_match("#/#", $file['name']) )
            {
                $path = $this->correctSlash($extract_to . dirname($file['name']));
                $this->createFolders($path);
            }
            
            $abs_path = $path . "/" . basename($file['name']);
            
            file_put_contents($abs_path, $file['data']);
            @touch($abs_path, $file['mtime']);
        }
        
        return true;
    }
    
    private function correctSlash($dirname)
    {
        $dirname = str_replace(DIRECTORY_SEPARATOR, "/", $dirname);
        
        return preg_match("#/$#", $dirname) ? $dirname : $dirname . "/";
    }
    
    // borrowed from cakephp
    private function createFolders($pathname, $mode = false)
    {
        if( is_dir($pathname) || empty($pathname) )
            return true;
        
        $mode = $mode ? $mode : 0775;
        
        $nextPathname = substr($pathname, 0, strrpos($pathname, "/"));
        if( $this->createFolders($nextPathname, $mode) )
        {
            if( !file_exists($pathname) ) {
                if( mkdir($pathname, intval($mode, 8)) ) {
                    return true;
                } else {
                    return false;
                }
            }
        }
        
        return true;
    }
}

?>