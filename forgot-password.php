<?php
    include('layout/header.php');
    if(@$_POST['submit']){
        $email = $_POST['email'];     
        
        $curl = curl_init();
        
        curl_setopt_array($curl, array(
        CURLOPT_URL => 'http://192.168.1.205:51000/api/user/forgot-password',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS =>'{
            "Email":"'.$email.'",
            "ClientURI":"http://localhost/api/resetpassword.php"
        }',
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json'
        ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        $data = json_decode($response);
        if($data->status == 200){
            header("Location:index.php?msg=".$data->message);
        }
    }
?>
<div class="login-box">
  <div class="card card-outline card-primary">
    <!-- <div class="card-header text-center">
      <a href="../../index2.html" class="h1"><b>Admin</b>LTE</a>
    </div> -->
    <div class="card-body login-card-body">
      <h2 class="login-box-msg"><b>Forgot Password</b></h2>
      <form action="" method="post">
        <div class="input-group mb-3">
          <input type="email" name="email" class="form-control" placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <input type="submit" name="submit" class="btn btn-primary btn-block" value="Request new password">
          </div>
          <!-- /.col -->
        </div>
      </form>
      <div class="account-btn" style="margin-top: 10px;">
      <p class="mt-3 mb-1">
        <a href="index.php">Already have an account? Sign In</a>
      </p>
      </div>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->
<?php
   include('layout/footer.php');
?>