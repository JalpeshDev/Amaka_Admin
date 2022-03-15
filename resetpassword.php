<?php
    if(@$_POST['submit']){
        $token = $_REQUEST['token'];
        $id = $_REQUEST['id'];
        $password = $_POST['password'];
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'http://192.168.1.205:51000/api/user/reset-password',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS =>'{
            "Userid":"'.$id.'",
            "token":"'.$token.'",
            "password":"'.$password.'"
        }',
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json'
        ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        //echo $response; exit;
        $data = json_decode($response);
        if(@$data->status == 200){
            header("Location:index.php?msg=".$data->message);
        }
    }
?>
<?php
   include('layout/header.php');
?>
<div class="login-box">
  <div class="card">
    <div class="card-body">
    <h2 class="login-box-msg"><b>Reset Password</b></h2>
      <form action="" method="post" name="confirmPassword">
        <div class="input-group mb-3">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
          <input type="password" name="password" id="password" class="form-control" placeholder="Password">
        </div>
        <div class="input-group mb-3">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
          <input type="password" class="form-control" id="cpassword" name="cpassword" placeholder="Confirm Password">
        </div>
        <div class="row">
          <div class="col-12">
            <!-- <button type="submit" class="btn btn-primary btn-block"></button> -->
            <input type="submit" name="submit" class="btn btn-primary btn-block" value="Reset password">
          </div>
          <!-- /.col -->
        </div>
      </form>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->
<?php
   include('layout/footer.php');
   ?>
   <script>

      $.validator.addMethod("pwcheckspechars", function (value) {
          
          return /[!@#$%^&*()_=\[\]{};':"\\|,.<>\/?+-]/.test(value)
      }, "The password must contain at least one special character");

      $.validator.addMethod("pwchecklowercase", function (value) {
          return /[a-z]/.test(value) // has a lowercase letter
      }, "The password must contain at least one lowercase letter");

      $.validator.addMethod("pwcheckrepeatnum", function (value) {
          return /\d{2}/.test(value) // has a lowercase letter
      }, "The password must contain at least one lowercase letter");

      $.validator.addMethod("pwcheckuppercase", function (value) {
          return /[A-Z]/.test(value) // has an uppercase letter
      }, "The password must contain at least one uppercase letter");

      $.validator.addMethod("pwchecknumber", function (value) {
          return /\d/.test(value) // has a digit
      }, "The password must contain at least one number");

     $(function() {
       $("form[name='confirmPassword']").validate({
       rules:{
         password: {
              required: true,
              pwchecklowercase: true,
              pwcheckuppercase: true,
              pwchecknumber: true,
              pwcheckspechars: true,
              minlength: 8,
           },
         cpassword: {
              required: true,
              equalTo: "#password",
              pwchecklowercase: true,
              pwcheckuppercase: true,
              pwchecknumber: true,
              pwcheckspechars: true,
              minlength: 8,
           }
       },
       messages:{
         password:{required:"Please Enter Your Password",
          minlength:"Password Muct be long upto 8 Alphanumeric"
        },
         cpassword:{
           required:"Please Enter Your Confirm Password",
           equalTo:"Password and Confirm Password Much Be Same",
           minlength:"Password Muct be long upto 8 Alphanumeric"
         }
       }
   });
   });
   </script>