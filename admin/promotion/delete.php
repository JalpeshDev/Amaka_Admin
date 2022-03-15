<?php
  include('../forceAction.php');
  $token =  $_SESSION['authToken'];
  $id = $_POST['id'];
  $softDelete = isset($_POST['softDelete']) ? $_POST['softDelete'] : '';
  $permanentDelete = isset($_POST['IsPermanentDelete']) ? $_POST['IsPermanentDelete'] : '';

  $curl = curl_init();

  curl_setopt_array($curl, array(
  CURLOPT_URL =>  $baseUrl.'Promotions/',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'DELETE',
  CURLOPT_POSTFIELDS =>'{
      "PromotionId":"'.$id.'",
      "IsPermanentDelete":'.$permanentDelete.',
      "IsDelete":'.$softDelete.'
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
