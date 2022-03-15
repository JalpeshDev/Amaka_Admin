<?php
    include('../forceAction.php');
    $token =  $_SESSION['authToken'];
    
    $cfile = new CURLFile(
            $_FILES['file']['tmp_name'],
            $_FILES['file']['type'],
            $_FILES['file']['name']
        );
    $albumId = $_POST['albumId'];
    $curl = curl_init();

    curl_setopt_array($curl, array(
    CURLOPT_URL => $baseUrl.'Album/album-images',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS => array('files'=> $cfile,'albumId' => $albumId),
    CURLOPT_HTTPHEADER => array(
        'Authorization: Bearer '.$token
    ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    $data = json_decode($response);
    $result = json_encode($data);
    echo $result;
