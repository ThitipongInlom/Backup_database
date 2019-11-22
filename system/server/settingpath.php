<?php
class SettingPath 
{
    public function Path_File_Zip()
    {
        $files_list = scandir('../flie_database',1);
        $response = array();
        foreach ($files_list as $file) {
            if ($file != '.' && $file != '..') {
                $response[] = array(
                                'filename' => $file,
                                'sizefile' => SettingPath::formatBytes(filesize("../flie_database/".$file))
                              );
            }
        }
        
        return json_encode($response);
    }

    public function formatBytes($bytes)
    {
        if ($bytes >= 1073741824) {
            $bytes = number_format($bytes / 1073741824, 2) . ' GB';
        } elseif ($bytes >= 1048576) {
            $bytes = number_format($bytes / 1048576, 2) . ' MB';
        } elseif ($bytes >= 1024) {
            $bytes = number_format($bytes / 1024, 2) . ' KB';
        } elseif ($bytes > 1) {
            $bytes = $bytes . ' bytes';
        } elseif ($bytes == 1) {
            $bytes = $bytes . ' byte';
        } else {
            $bytes = '0 bytes';
        }
        
        return $bytes;
    }

}