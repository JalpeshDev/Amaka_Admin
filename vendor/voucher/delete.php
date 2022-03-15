<?php
    include('../forceAction.php');
    $token =  $_SESSION['authToken'];

    if(@$_REQUEST['action'] == "delete"){
        $id = $_REQUEST['id'];
    
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => $baseUrl.'Voucher/'.$id,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'DELETE',
        CURLOPT_HTTPHEADER => array(
            'Authorization:Bearer '.$token
        ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $data = json_decode($response);
        $voucherDeleteResult = json_encode($data);
        echo $voucherDeleteResult;
    }
?>
