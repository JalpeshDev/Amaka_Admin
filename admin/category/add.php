<?php
include('../forceAction.php');
$token =  $_SESSION['authToken'];
    $cfile = new CURLFile(
            $_FILES['file']['tmp_name'],
            $_FILES['file']['type'],
            $_FILES['file']['name']
        );
        $cfile2 = new CURLFile(
            $_FILES['file2']['tmp_name'],
            $_FILES['file2']['type'],
            $_FILES['file2']['name']
        );

        $category = $_POST['category'];
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => $baseUrl.'Categories',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => array('categoryImage'=> $cfile,'categoryName' => $category,'categoryImage2'=> $cfile2),
        CURLOPT_HTTPHEADER => array(
            'Authorization: Bearer '.$token),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        //echo $response;
        $data = json_decode($response);
        $cateAddResult = json_encode($data);
        echo $cateAddResult;
?>