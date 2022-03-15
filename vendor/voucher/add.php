<?php
    include('../forceAction.php');
    $token =  $_SESSION['authToken'];

    $voucherCode = $_POST['voucherCode'];
    $percentageApplied = $_POST['percentageApplied'];
    $description = $_POST['description'];
    $expiryDate = $_POST['expiryDate'];
    $vendorService = $_POST['vendorService'];

    $curl = curl_init();

    curl_setopt_array($curl, array(
    CURLOPT_URL => $baseUrl.'Voucher/',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS =>'{
        "VendorServiceID":"'.$vendorService.'",
        "Description":"'.$description.'",
        "VoucherCode":"'.$voucherCode.'",
        "ExpiryDate":"'.$expiryDate.'",
        "PercentageApplied":'.$percentageApplied.'

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
?>