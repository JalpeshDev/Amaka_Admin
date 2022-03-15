<?php
    include('../forceAction.php');
    $token =  $_SESSION['authToken'];
    if(isset($_FILES['profileImg']['name'])){
        $cfile = new CURLFile(
            $_FILES['profileImg']['tmp_name'],
            $_FILES['profileImg']['type'],
            $_FILES['profileImg']['name']
        );
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => $baseUrl.'user/profilepicture',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS => array('file'=> $cfile),
          CURLOPT_HTTPHEADER => array(
            'Authorization: Bearer '.$token
          ),
        ));
        
        $response = curl_exec($curl);
        
        curl_close($curl);
        $data = json_decode($response);
        $_SESSION['profileImage'] = $data->data->pictureUrl;
        $profileResult= json_encode($data);
        echo $profileResult;
    
    }
?>