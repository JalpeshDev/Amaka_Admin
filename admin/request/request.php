<?php
include('../forceAction.php');
$token =  $_SESSION['authToken'];

$request = $_POST['request'];
$id = $_POST['id'];
$rejectionDiscription = isset($_POST['rejectionDiscription']) ? $_POST['rejectionDiscription'] : '';
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => $baseUrl.'user/acceptvendorreq',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{
    "IsVendor":"'.$request.'",
    "Id":"'.$id.'",
    "rejectionDiscription":"'.$rejectionDiscription.'"
}',
  CURLOPT_HTTPHEADER => array(
    'Authorization: Bearer '.$token,
    'Content-Type: application/json'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;
?>