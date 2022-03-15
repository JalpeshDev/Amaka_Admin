<?php
include('../forceAction.php');
$token =  $_SESSION['authToken'];
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => $baseUrl.'user/getvendor-reqs',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'Authorization: Bearer '.$token
  ),
));

@$reqResponse = curl_exec($curl);

curl_close($curl);
//echo $catResponse;
$reqData = json_decode($reqResponse);
$reqAllList = json_decode(json_encode($reqData),true);
$reqList = array();
if(@$reqAllList['status'] == 200){
    $reqList = $reqAllList['data'];
}
if(isset($reqList)){
  echo count($reqList);
}
?>