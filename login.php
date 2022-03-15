<?php
 $baseUrl = "http://192.168.1.205:51000/api/";
if(@$_POST['submit']){
  session_start();
  $userName =  $_POST['userName'];
  $password =  $_POST['password'];

  $curl = curl_init();

  curl_setopt_array($curl, array(
    CURLOPT_URL => $baseUrl.'user/login',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS =>'{"Username": "'.$userName.'", "password":"'. $password.'"}',
    CURLOPT_HTTPHEADER => array(
      'Content-Type: application/json'
    ),
  ));

$response = curl_exec($curl);
curl_close($curl);
$data = json_decode($response);
  if(@$data->status == 200){
    $userData = json_decode(json_encode($data), true);
    $_SESSION["authToken"] = $data->data->authToken;
    $_SESSION['userDetails'] = $userData;
    if($data->data->userRoles == 3){
      header("Location:admin/index.php");
      // getlist userlist than request handling
    }elseif($data->data->userRoles == 2){
      header("Location:vendor/index.php");
    }else{
      // echo "<pre>";
      // print_r($data);
      // exit;
      header("Location:index.php");
    }
  }
  
}

?>
<?php
   include('layout/header.php');
?>
  <!-- /.login-logo -->
  <?php  if(@$_REQUEST['msg']){ ?>
    <div class="alert alert-success alert-dismissible" id="msg">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <h5><i class="icon fas fa-check"></i>
      <?php       
          echo $_REQUEST['msg'];        
      ?>
    </h5>    
    </div>
    <?php } elseif(@$data->status == 400 && @$data->message == "Invalid User ID and/or Password.") { ?>
      <div class="alert alert-danger alert-dismissible" id="msg">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h5><i class="icon fas fa-check"></i>
          <?php       
              echo $data->message;        
          ?>
        </h5>    
      </div>
    <?php } ?>

  <div class="card">
    <div class="card-body login-card-body">
      <h2 class="login-box-msg"><b>Sign In</b></h2>

      <form action="" method="post">
        <div class="input-group mb-3">
          <input type="email" class="form-control" placeholder="Email" name="userName">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Password" name="password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">
                Remember Me
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-12">
          <input type="submit" class="btn btn-primary btn-block" name="submit" value="Sign In">
          </div>
          <!-- /.col -->
        </div>
      </form>
        <div class="account-btn" style="margin-top: 14px;">
          <p class="mb-1">
            <a href="forgot-password.php">Forgot Password</a>
          </p>
          <p class="mb-0">
            <a href="register.php" class="text-center">Don't have an account? Sign Up</a>
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
