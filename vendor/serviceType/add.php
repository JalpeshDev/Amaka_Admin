<?php
include('../forceAction.php');
      $token =  $_SESSION['authToken'];
      $category = $_POST['category'];
      $service = $_POST['service'];
      
      $curl = curl_init();
      curl_setopt_array($curl, array(
        CURLOPT_URL => $baseUrl.'ServicesType/',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS =>'{"ServiceName":"'.$service.'","CategoryId":"'.$category.'"}',
        CURLOPT_HTTPHEADER => array(
          'Authorization: Bearer '.$token,
          'Content-Type: application/json'
        ),
      ));
      
      $response = curl_exec($curl);
      
      curl_close($curl);
      //echo $response;
      $data = json_decode($response);
      $serviceAllList = json_encode($data);
      echo $serviceAllList;
      //header("Location:list.php");
  ?>


