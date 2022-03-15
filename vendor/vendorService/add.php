<?php
    include('../forceAction.php');
    $token =  $_SESSION['authToken'];
    $service = $_POST['service'];
    $category = $_POST['category'];
    $servicePrice = $_POST['servicePrice'];
    $timeTaken = $_POST['timeTaken'];
    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => $baseUrl.'VendorService/',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS =>'{
        "ServicesID":"'.$service.'",
        "CategoryId":"'.$category.'",
        "ServicePrice":"'.$servicePrice.'",
        "TimeTaken":"'.$timeTaken.'"
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
