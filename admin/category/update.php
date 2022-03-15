<?php
    include('../forceAction.php');
    $token =  $_SESSION['authToken'];


    $cfile = new CURLFile(
            $_FILES['file']['tmp_name'],
            $_FILES['file']['type'],
            $_FILES['file']['name']
    );
    $cfile2 = new CURLFile(
        $_FILES['file2']['name'],
        $_FILES['file2']['type'],
        $_FILES['file2']['tmp_name'],

    );

    $post_data = new CURLFile(
        chunk_split(base64_encode(file_get_contents($_FILES['file']['tmp_name']))),
        $_FILES['file']['type'],
        $_FILES['file']['name'],
 
    );  
    $post_data2 = new CURLFile(
       chunk_split(base64_encode(file_get_contents($_FILES['file2']['tmp_name']))),
        $_FILES['file2']['type'],
        $_FILES['file2']['name'],

    );  
    $category = $_POST['category'];
    $id = $_POST['id'];

    $curl = curl_init();

    curl_setopt_array($curl, array(
    CURLOPT_URL => $baseUrl.'Categories',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'PUT',
    CURLOPT_POSTFIELDS => array('categoryImage'=> $post_data,'category' => $category,'categoryId' =>  $id,'categoryImage2'=> $post_data2),
    array(
    'Authorization: Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJodHRwOi8vc2NoZW1hcy54bWxzb2FwLm9yZy93cy8yMDA1LzA1L2lkZW50aXR5L2NsYWltcy9uYW1laWRlbnRpZmllciI6IjI3OGExYjAwLTdhNjgtNDAyNi04OGM5LTViMmUzMjdjNmFlNyIsImh0dHA6Ly9zY2hlbWFzLnhtbHNvYXAub3JnL3dzLzIwMDUvMDUvaWRlbnRpdHkvY2xhaW1zL2VtYWlsYWRkcmVzcyI6ImFkbWluQGFtYWthLmNvbSIsImh0dHA6Ly9zY2hlbWFzLnhtbHNvYXAub3JnL3dzLzIwMDUvMDUvaWRlbnRpdHkvY2xhaW1zL25hbWUiOiJhZG1pbkBhbWFrYS5jb20iLCJodHRwOi8vc2NoZW1hcy5taWNyb3NvZnQuY29tL3dzLzIwMDgvMDYvaWRlbnRpdHkvY2xhaW1zL3JvbGUiOlsiMyIsIjIiLCIxIl0sIm5iZiI6MTY0NjM2OTE5MCwiZXhwIjoxNjc3OTA1MTkwLCJpc3MiOiJhbWFrYVdlYkFwaSIsImF1ZCI6Imh0dHA6Ly9sb2NhbGhvc3Q6NDIwMCJ9.Omu6hmNRhwZzDmLnmIH35EMI6-UFus2wIVc1dMiPsgA'
  ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    $data = json_decode($response);
    $serviceAllList = json_encode($data);
    echo $serviceAllList;
?>