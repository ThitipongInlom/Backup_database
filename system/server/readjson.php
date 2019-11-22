<?php
$str_data = file_get_contents("../config.json");
$data = json_decode($str_data,true);
foreach ($data as $key => $row) {
    if($row['id'] == $_POST['list_item']) {
        $response[] = array(
                        'id' => $_POST['list_item'], 
                        'name' => $_POST['name'], 
                        'host' => $_POST['host'], 
                        'username' => $_POST['username'], 
                        'password' => $_POST['password']
                    );
    }else{
        $response[] = array(
                        'id' => $row['id'], 
                        'name' => $row['name'], 
                        'host' => $row['host'], 
                        'username' => $row['username'], 
                        'password' => $row['password']
                    );        
    }
}

$file_config = fopen('../config.json', 'w');
fwrite($file_config, json_encode($response));
fclose($file_config);

$array_res = array('status' => 'success');
echo json_encode($array_res);
