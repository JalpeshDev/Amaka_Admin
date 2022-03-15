<?php
    include('../forceAction.php');
    $token =  $_SESSION['authToken'];
    $albumName = $_POST['albumName'];
    $curl = curl_init();

    curl_setopt_array($curl, array(
    CURLOPT_URL => $baseUrl.'Album',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS =>'{
        "AlbumName":"'.$albumName.'"
    }',
    CURLOPT_HTTPHEADER => array(
        'Authorization: Bearer '.$token,
        'Content-Type: application/json'
    ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    $data = json_decode($response);
    $result = json_encode($data);
    echo $result;
