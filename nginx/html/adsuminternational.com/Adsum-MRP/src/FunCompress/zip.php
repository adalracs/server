<?php
/* 
+-------------------------------------------------------------------------- 
|   XCompress - Zip module
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

class Zip extends XCompress
{
    protected function compressProcess()
    {
        if( sizeof($this->files_in_mem) < 1 )
            return false;
        
        $datasec = array();
        $ctrl_dir = array();
        $old_offset = 0;
        
        // This implementation has been derived 
        // from code originally written by John Coggeshall
        // (http://www.coggeshall.org/)
        
        foreach ($this->files_in_mem as $file)
        {
            $fr = "\x50\x4b\x03\x04";
            $fr .= "\x14\x00";    // ver needed to extract
            $fr .= "\x00\x00";    // gen purpose bit flag
            $fr .= "\x08\x00";    // compression method
            $fr .= "\x00\x00\x00\x00"; // last mod time and date
            
            $unc_len = strlen($file['data']);
            $crc = crc32($file['data']);
            
            $zdata = gzcompress($file['data']);
            $zdata = substr(substr($zdata, 0, strlen($zdata) - 4), 2); // fix crc bug
            $c_len = strlen($zdata);

            $fr .= pack("VVVvv", $crc, $c_len, $unc_len, strlen($file['name']), 0);
            $fr .= $file['name'];
            
            // "filedata" segment
            $fr .= $zdata;
            
            // "data descriptor" segment
            $fr .= pack("VVV", $crc, $c_len, $unc_len);
            
            $datasec[] = $fr;
            $new_offset = strlen(implode('', $datasec));
            
            // add to central directory record
            $cdrec = "\x50\x4b\x01\x02";
            $cdrec .="\x00\x00";    // version made by
            $cdrec .="\x14\x00";    // version needed to extract
            $cdrec .="\x00\x00";    // gen purpose bit flag
            $cdrec .="\x08\x00";    // compression method
            $cdrec .="\x00\x00\x00\x00"; // last mod time & date
            $cdrec .= pack("VVVvvvvvVV", $crc, $c_len, $unc_len, strlen($file['name']), 0, 0, 0, 0, 32, $old_offset);
            
            $old_offset = $new_offset;
            
            $cdrec .= $file['name'];

            // save to central directory
            $ctrl_dir[] = $cdrec;
        }
        
        $data = implode('', $datasec);
        $ctrl = implode('', $ctrl_dir);
        $ctrl_size = sizeof($ctrl_dir);
        
        return 
             $data . //compress data
             $ctrl . // central directory
             "\x50\x4b\x05\x06\x00\x00\x00\x00" . //end of Central directory record
             pack("vvVV", $ctrl_size, $ctrl_size, strlen($ctrl), strlen($data)) .
             "\x00\x00";
    }   
    
    protected function uncompressProcess($filename)
    {
        $data = file_get_contents($filename);
        
        $zip_files         = array();
        $zip_file_info  = array();
        
        if( substr($data, 0, 2) != 'PK' )
            return false;
        
        if( substr($data, -22, 4) == 'PK' . chr(5) . chr(6) )
        {
            $p = -22;
        }
        else
        {
            for( $p = -22; $p > -strlen($data); $p-- )
            {
                if( substr($data, $p, 4) == 'PK' . chr(5) . chr(6) )
                    break;
            }
        }
        
        $zip_file_info = unpack('vfiles/Vsize/Voffset', substr($data, $p + 10, 10));
        
        $p = $zip_file_info['offset'];
        
        for( $i = 0; $i < $zip_file_info['files']; $i++ )
        {
            if( substr($data, $p, 4) != 'PK' . chr(1) . chr(2) )
                return false;
            
            $file_info = unpack("Vcrc/Vcompressed_size/Vsize/vfilename_len/vextra_len/vcomment_len/vdisk/vinternal/Vexternal/Voffset", substr($data, $p + 16, 30));
            $file_info['filename'] = substr($data, $p + 46, $file_info['filename_len']);
            
            $p += 46 + $file_info['filename_len'] + $file_info['extra_len'] + $file_info['comment_len'];
            
            $file_info['data'] = substr($data, $file_info['offset'] + 30 + $file_info['filename_len'] + $file_info['extra_len'], $file_info['compressed_size']);
            
            if( $file_info['compressed_size'] != $file_info['size'] )
            {
                $file_info['data'] = @gzinflate($file_info['data']);
            }
            
            $name     = trim($file_info['filename']);
            $mode     = octdec(trim($file_info['mode']));
            $uid      = octdec(trim($file_info['uid']));
            $gid      = octdec(trim($file_info['gid']));
            $size     = octdec(trim($file_info['offset']));
            $mtime    = octdec(trim($file_info['mtime']));
            
            $zip_files[] = array (
                                    'name'     => $name,
                                    'mode'     => $mode,
                                    'uid'      => $uid,
                                    'gid'      => $gid,
                                    'size'     => $size,
                                    'mtime'    => $mtime,
                                    'data'     => $file_info['data']
                                );
        }
        
        return $zip_files;
    }
}

?> 