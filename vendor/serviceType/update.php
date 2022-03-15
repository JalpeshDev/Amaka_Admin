<?php
include('../forceAction.php');
$token =  $_SESSION['authToken'];
$category = $_POST['category'];
$id = $_POST['id'];
$service = $_POST['service'];
$arr = array("ServicesID"=>$id,"ServiceName"=>$service,"CategoryId"=>$category);
$arrJson = json_encode($arr);
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => $baseUrl.'ServicesType',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'PUT',
  CURLOPT_POSTFIELDS =>$arrJson,
  CURLOPT_HTTPHEADER => array(
    'Authorization: Bearer '.$token,
    'Content-Type: application/json'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
$data = json_decode($response);
$cateUpdateResult = json_encode($data);
echo $cateUpdateResult;
?>
