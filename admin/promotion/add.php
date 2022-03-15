<?php
  include('../forceAction.php');
  $token =  $_SESSION['authToken'];

  $quoteTitle = $_POST['quoteTitle'];
  $quoteDescription = $_POST['quoteDescription'];

  $cfile = new CURLFile(
    $_FILES['profileImg']['tmp_name'],
    $_FILES['profileImg']['type'],
    $_FILES['profileImg']['name']
  );

  $curl = curl_init();

  curl_setopt_array($curl, array(
    CURLOPT_URL => $baseUrl.'Promotions',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS => array('promotionImage'=> $cfile,'quoteTitle' => $quoteTitle,'quoteDescription' => $quoteDescription),
    CURLOPT_HTTPHEADER => array(
      'Authorization: Bearer '.$token
    ),
  ));

  $response = curl_exec($curl);

  curl_close($curl);
  $data = json_decode($response);
  $result = json_encode($data);
  echo $result;
