<?php
class SettingPath 
{
    public function Path_File_Zip()
    {
        $files_list = scandir('../flie_database',0);
        $response = array();
        foreach ($files_list as $file) {
            if ($file != '.' && $file != '..') {
                $btn_download = '<button class="btn btn-sm btn-success" data-toggle="tooltip" data-placement="left" title="โหลด SQL '.$file.'"><i class="fas fa-cloud-download-alt"></i></button>';
                $btn_delete   = '<button class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="left" title="ลบ SQL '.$file.'" filename='.$file.' onclick="Delete_file(this);"><i class="fas fa-trash-alt"></i></button>';
                $response[] = array(
                                'filename' => $file,
                                'sizefile' => SettingPath::formatBytes(filesize("../flie_database/".$file)),
                                'action'   => $btn_download.' '.$btn_delete
                              );
            }
        }
        
        return json_encode($response);
    }

    public function Delete_file_zip($filename)
    {
        $status_delete = unlink('../flie_database/'.$filename);
        if($status_delete) {
            $status = 'ลบไฟล์เสร็จสิ้น';
        }
        else {
            $status = 'ไม่สามารถลบไฟล์ได้';
        }

        return json_encode(array('status' => 'success', 'delete_status' => $status));
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