<?php
/* 
+-------------------------------------------------------------------------- 
|   XCompress - Tar module
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

class Tar extends XCompress
{
    private $resource;
    private $compress_type = "f";
    private $tar_header_length = '512';
    private $tar_unpack_header  = 'a100filename/a8mode/a8uid/a8gid/a12size/a12mtime/a8chksum/a1typeflag/a100linkname/a6magic/a2version/a32uname/a32gname/a8devmajor/a8devminor/a155';

    
    // @Override
    public function saveFile($filename)
    {
        $this->detectCompressType($filename);
        
        $data = $this->compressProcess();
        
        if( $this->compress_type == 'gz' ) {
            $gz = gzopen($filename, "w9");
            gzwrite($gz, $data, strlen($data));
            gzclose($gz);
        }
        else if( $this->compress_type == 'bz' ) {
            $bz = bzopen($filename);
            bzwrite($bz, $data, strlen($data));
            bzclose($bz);
        }
        else {
            file_put_contents($filename, $data);
        }
        
        return file_exists($filename);
    }
    
    protected function compressProcess()
    {
        if( sizeof($this->files_in_mem) < 1 )
            return false;
        
        $tar_data = "";
        
        /*
        |    This code portion is based on:
        |     GNU Tar creation module by Matt Mecham (matt@invisionpower.com)
        |    (http://www.invisionboard.com)
        */
        
        foreach ($this->files_in_mem as $file)
        {
            $prefix = "";
            if (strlen($file['name']) > 99)
            {
                $pos = strrpos( $file['name'], "/" );
                if( $pos === false )
                    continue;
                
                $prefix = substr($file['name'], 0, $pos);  // Move the path to the prefix
                $file['name'] = substr($file['name'], ($pos+1));
                if( strlen($prefix) > 154 )
                    continue;
            }
            
            // BEGIN FORMATTING (a8a1a100)
            
            $mode  = sprintf("%6s ", decoct($file['mode']));
            $uid   = sprintf("%6s ", decoct($file['uid']));
            $gid   = sprintf("%6s ", decoct($file['gid']));
            $size  = sprintf("%11s ", decoct($file['size']));
            $mtime = sprintf("%11s ", decoct($file['mtime']));
            
            $tmp  = pack("a100a8a8a8a12a12", $file['name'], $mode, $uid, $gid, $size, $mtime);
            
            // flagtype, linkname, magic, version, uname, gname, devmajor, devminor, prefix 
            $last = pack("a1a100a6a2a32a32a8a8a155", 0, "", "ustar", "", "unknown", "unknown", "", "", $prefix);
            
            $test_len = $tmp . $last . "12345678";
            $last .= str_repeat("\0" , ($this->tar_header_length - strlen($test_len)));
            
            // handling the checksum.
            $checksum = 0;
            
            for ($i = 0 ; $i < 148 ; $i++ ) {
                $checksum += ord($tmp{$i});
            }
            for ($i = 148 ; $i < 156 ; $i++) {
                $checksum += ord(' ');
            }
            for ($i = 156, $j = 0 ; $i < 512 ; $i++, $j++) {
                $checksum += ord($last{$j});
            }
            
            $checksum = sprintf("%6s ", decoct($checksum));
            
            $tmp .= pack("a8", $checksum);
            
            $tmp .= $last;
            
               $tmp .= $file['data'];
            
               // Tidy up this chunk to the power of 512
            if ($file['size'] > 0)
            {
                if ($file['size'] % 512 != 0)
                {
                    $homer = str_repeat("\0" , (512 - ($file['size'] % 512)));
                    $tmp .= $homer;
                }
            }
            
            $tar_data .= $tmp;
        }
        
        $tar_data .= pack("a512", "");

        return $tar_data;
    }
    
    protected function uncompressProcess($filename)
    {
        // Detect compress
        $this->detectCompressType($filename);
        
        $this->openTar($filename);

        while( $buffer = $this->readBlock() )
        {
            $checksum = 0;

            for ($i = 0 ; $i < 148 ; $i++) {
                $checksum += ord($buffer{$i});
            }
            for ($i = 148 ; $i < 156 ; $i++) {
                $checksum += ord(' ');
            }
            for ($i = 156 ; $i < 512 ; $i++) {
                $checksum += ord($buffer{$i});
            }
            
            $file = unpack($this->tar_unpack_header, $buffer);

            $name     = trim($file['filename']);
            $mode     = octdec(trim($file['mode']));
            $uid      = octdec(trim($file['uid']));
            $gid      = octdec(trim($file['gid']));
            $size     = octdec(trim($file['size']));
            $mtime    = octdec(trim($file['mtime']));
            $chksum   = octdec(trim($file['chksum']));
            $typeflag = trim($file['typeflag']);
            $linkname = trim($file['linkname']);
            $magic    = trim($file['magic']);
            $version  = trim($file['version']);
            $uname    = trim($file['uname']);
            $gname    = trim($file['gname']);
            $devmajor = octdec(trim($file['devmajor']));
            $devminor = octdec(trim($file['devminor']));
            $prefix   = trim($file['prefix']);
            
            if( ($checksum == 256) && ($chksum == 0) ) {
                //EOF!
                break;
            }
            
            if( $prefix ) {
                $name = $prefix . '/' . $name;
            }
            
            if( (preg_match( "#/$#" , $name)) and (! $name) ) {
                $typeflag = 5;
            }
            
            // If it's the end of the tarball
            $test = str_repeat('\0' , 512);
            if( $buffer == $test ) {
                break;
            }
            
            // Read the next chunk
            $data = $this->readBlock($size);
            
            if( strlen($data) != $size ) {
                trigger_error( 'Read error on tar file', E_USER_ERROR );
                $this->closeTar();
                
                return false;
            }
            
            $diff = $size % 512;
            
            // Padding, throw away
            if( $diff != 0 )
                $crap = $this->readBlock((512-$diff));
            
            // Protect against tarfiles with garbage at the end
            if( $name == "" )
                break;
            
            $tar_info[] = array (
                                  'name'     => $name,
                                  'mode'     => $mode,
                                  'uid'      => $uid,
                                  'gid'      => $gid,
                                  'size'     => $size,
                                  'mtime'    => $mtime,
                                  'chksum'   => $chksum,
                                  'typeflag' => $typeflag,
                                  'linkname' => $linkname,
                                  'magic'    => $magic,
                                  'version'  => $version,
                                  'uname'    => $uname,
                                  'gname'    => $gname,
                                  'devmajor' => $devmajor,
                                  'devminor' => $devminor,
                                  'prefix'   => $prefix,
                                  'data'     => $data
                                 );
        }
        $this->closeTar();
        
        return $tar_info;
    }
    
    private function detectCompressType($filename)
    {
        if( @file_exists($filename) )
        {
            if( $fp = fopen($filename, "rb") ) {
                $data = fread($fp, 2);
                fclose($fp);
                if( $data == "\37\213" ) {
                    $this->compress_type = 'gz';
                } else if( $data == "BZ" ) {
                    $this->compress_type = 'bz';
                }
            }
        }
        else
        {
            if( preg_match("/\.gz$/i", $filename) ) {
                $this->compress_type = 'gz';
            } else if( preg_match("/\.bz(2)?/", $filename) ) {
                $this->compress_type = 'bz';
            }
        }
    }
    
    private function openTar($filename)
    {
        $this->resource = call_user_func_array($this->compress_type . "open", array($filename, "rb"));
    }
    
    private function closeTar()
    {
        call_user_func($this->compress_type . "close", $this->resource);
    }
    
    private function readBlock($size = false)
    {
        if(! is_resource($this->resource) )
            return false;
        
        if( $size === false )
            $size = $this->tar_header_length;
        else if( $size == 0 )
            return '';
        
        $block = NULL;
        
        if( $this->compress_type != "bz" )
            if( call_user_func($this->compress_type . "eof", $this->resource) )
                return false;
        
        $block = call_user_func_array($this->compress_type . "read", array($this->resource, $size));
        
        if( strlen($block) <= 0 )
            return false;
        
        return $block;
    }
}

?>