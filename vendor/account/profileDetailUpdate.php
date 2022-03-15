<?php
    include('../forceAction.php');
    $token =  $_SESSION['authToken'];

    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $phoneNumber = $_POST['phoneNumber'];
    $dob = $_POST['dob'];
    $userName = $_POST['userName'];
   
    $curl = curl_init();

    curl_setopt_array($curl, array(
    CURLOPT_URL => $baseUrl.'user/updateuserinfo',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS =>'{
        "FirstName":"'.$firstName.'",
        "LastName":"'.$lastName.'",
        "DateOfBirth":"'.$dob.'",
        "PhoneNumber":"'.$phoneNumber.'",
        "UserName":"'.$userName.'"
    }',
    CURLOPT_HTTPHEADER => array(
        'Authorization: Bearer '.$token,
        'Content-Type: application/json'
    ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    $data = json_decode($response);
    $profileResult= json_encode($data);
    echo $profileResult;
    $userNewDetails = array('firstName' => $firstName,'lastName' => $lastName,'phoneNumber' => $phoneNumber,'dob' => $dob,'userName' => $userName);
    $_SESSION['userNewDetails'] = $userNewDetails;
