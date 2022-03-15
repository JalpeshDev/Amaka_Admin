<?php
include('../forceAction.php');
$token =  $_SESSION['authToken'];
if(@$_REQUEST['action'] == "delete"){
    $id =  $_REQUEST['id'];
    $isDel = $_REQUEST['isDel'];
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => $baseUrl.'Categories',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'DELETE',
        CURLOPT_POSTFIELDS =>'{
            "CategoryId":"'.$id.'",
            "Isdelete":'.$isDel.'
        }',
        CURLOPT_HTTPHEADER => array(
            'Authorization: Bearer '.$token,
            'Content-Type: application/json'
        ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    $data = json_decode($response);
    $cateDeleteResult = json_encode($data);
    echo $cateDeleteResult;

}

?>