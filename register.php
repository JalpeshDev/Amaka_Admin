<?php
 $baseUrl = "http://192.168.1.205:51000/api/";
if(@$_POST['submit']){

   $firstName = $_POST['firstName'];
   $lastName = $_POST['lastName'];
   $phone = $_POST['phone'];
   $email = $_POST['email'];
   $password = $_POST['password'];
   $dob = $_POST['dob'];
   $business_type = $_POST['business_type'];
   $long = $_POST['long'];
   $lanti = $_POST['lanti'];
   $description =  $_POST['description'];
   $UserName = $_POST['UserName'];
   // echo  $baseUrl.'user/register';
   // exit;
   $curl = curl_init();

   curl_setopt_array($curl, array(
   CURLOPT_URL => $baseUrl.'user/register',
   CURLOPT_RETURNTRANSFER => true,
   CURLOPT_ENCODING => '',
   CURLOPT_MAXREDIRS => 10,
   CURLOPT_TIMEOUT => 0,
   CURLOPT_FOLLOWLOCATION => true,
   CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
   CURLOPT_CUSTOMREQUEST => 'POST',
   CURLOPT_POSTFIELDS =>'{
      "firstName": "'.$firstName.'",
      "lastName": "'.$lastName.'",
      "password": "'.$password.'",
      "phone": "'.$phone.'",
      "email": "'.$email.'" ,
      "UserName": "'.$UserName.'"
   }
   ',
   CURLOPT_HTTPHEADER => array(
      'Content-Type: application/json'
   ),
   ));
   $response = curl_exec($curl);
   curl_close($curl);
   $data = json_decode($response);
   // echo "<pre>";
   // print_r($data);
   // exit;
   if($data->status == 200 && !empty($data->data->id) && !empty($data->data->authToken)){
      $date = new DateTime($dob);
      $curl = curl_init();

      curl_setopt_array($curl, array(
        CURLOPT_URL => $baseUrl.'user/reqbecomevendor',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS =>'{
          "Latitude":"'.$lanti.'",
          "Longitude":"'.$long.'",
          "DateOfBirth":"'.$date->getTimestamp().'",
          "VendorDiscription":"'.$description.'",
          "BusinessType":"'.$business_type.'",
          "Id":"'.$data->data->id.'"
         }',
         CURLOPT_HTTPHEADER => array(
            'Authorization: Bearer '.$data->data->authToken,
            'Content-Type: application/json'
         ),
      ));
      //"Id":"'.$data->data->id.'"
      
      $response = curl_exec($curl);
      
      curl_close($curl);
      //echo $response; exit;
      $data = json_decode($response);
      if($data->status == 200){
         header("Location:index.php?msg=".$data->message);
      }
   }
   exit;
}
?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>AdminLTE 3 | Log in</title>
      <!-- Google Font: Source Sans Pro -->
      <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
      <!-- Font Awesome -->
      <link rel="stylesheet" href="admin/plugins/fontawesome-free/css/all.min.css">
      <!-- icheck bootstrap -->
      <link rel="stylesheet" href="admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
      <!-- Theme style -->
      <link rel="stylesheet" href="admin/dist/css/adminlte.min.css">
   </head>
   <style>
      /* Hide all steps by default: */
      .fa, .fas {
      color: #e83d81;
      font-weight: 900;
      }
      .btn-primary {
      background-color: #e83d81;
      border-color: #e83d81;
      }
      a {
      color: #666666;
      }
      img{
      border-radius: 50%;
      }
      [class*=icheck-]>input:first-child+input[type=hidden]+label::before, [class*=icheck-]>input:first-child+label::before {
      border: 1px solid #e83d81;
      }
      .btn-primary:hover {
      color: #fff;
      background-color: #e83d81;
      border-color: #e83d81;
      }
      .account-btn {
      display: flex;
      flex-direction: column;
      align-items: center;
      }
      p{
      /* padding-top:5px;
      padding-bottom:5px; */
      margin-top:5px;
      }
      a:hover {
      color: #e83d81;
      text-decoration: none;
      }
      .card-primary.card-outline {
      border-top: 3px solid #e83d81;
      }
      input#password {
      width: 80%;
      }
      input#cpassword {
      width: 80%;
      }
      .error{
      color:red;
      }
      .login-box, .register-box {
      width: 100%;
      max-width: 50%;
      }
      .login-card-body .input-group .form-control, .register-card-body .input-group .form-control {
      border-right: 1px solid #ced4da  !important;
      }
      .card-body.login-card-body {
         border-radius: 15px;
      }
      .sign-up-block{
         display: flex;
         justify-content: flex-end;
         flex-direction: column;
         align-content: flex-end;
      }
      .input-group.mb-3 {
         display: flex;
         flex-direction: column;
         width:100%;
      }
      .form-control {
         width:100% !important;
      }
   </style>
   <body class="hold-transition login-page">
      <div class="login-box">
         <div class="login-logo">
            <img src="AppLogo.png" alt="" width="100" height="100">
         </div>
         <!-- /.login-logo -->
         <div class="card">
            <div class="card-body login-card-body">
               <h2 class="login-box-msg"><b>Sign Up</b></h2>
               <form action="" method="post" id="regForm" name="register">
                  <div class="row">
                     <div class="col-6">
                        <div class="input-group mb-3">
                           <input type="text" class="form-control" placeholder="First Name" name="firstName">
                        </div>                        
                        <div class="input-group mb-3">
                           <input type="text" class="form-control" placeholder="User Name" name="UserName">
                        </div>
                        
                        <div class="input-group mb-3">
                           <input type="email" class="form-control" placeholder="Email" name="email">
                        </div>
                        <div class="input-group mb-3">
                           <input type="password" class="form-control" placeholder="Password" name="password">
                        </div>
                        <div class="input-group mb-3">
                           <input type="text" class="form-control" id="lanti" placeholder="lanti" name="lanti" readonly>
                        </div>
                        <div class="input-group mb-3">
                           <input type="text" class="form-control" placeholder="Business Type" name="business_type">
                        </div>
                        
                     </div>
                     <div class="col-6">
                     <div class="input-group mb-3">
                           <input type="text" class="form-control" placeholder="Last Name" name="lastName">
                        </div>
                        <div class="input-group mb-3">
                           <input type="text" class="form-control" placeholder="Phone" name="phone">
                        </div>
                        <div class="input-group mb-3">
                           <input type="date" class="form-control" id="datepicker" placeholder="DOB" name="dob">
                        </div>
                        <div class="input-group mb-3">
                           <input type="password" class="form-control" placeholder="Confirm Password" name="cpassword">
                        </div>
                        
                        <div class="input-group mb-3">
                           <input type="text" class="form-control" id="long" placeholder="long" name="long" readonly>
                        </div>
                        
                        <div class="input-group mb-3">
                           <textarea class="form-control" placeholder="Description" name="description"></textarea>
                        </div>
                     </div>
                  </div>
                  <div class="row" style="display: flex; margin-top: 10px; justify-content: center; flex-direction:column ; align-content: space-around;">
                     <!-- /.col -->
                     
                     <div class="col-4 sign-up-block">
                        <input type="submit" class="btn btn-primary btn-block" id="submit" value="Sign Up" name="submit">
                     </div>
                     <div style="margin-top: 10px;">
                        <p class="mb-0" style="text-align: center;">
                           <a href="login.php" class="text-center">Already have an account? Sign In</a>
                        </p>
                     </div>
                     <!-- /.col -->
                  </div>
                  
               </form>
               
            </div>
            <!-- /.login-card-body -->
         </div>
      </div>
      <!-- /.login-box -->
      <!-- jQuery -->
      <script src="admin/plugins/jquery/jquery.min.js"></script>
      <!-- Bootstrap 4 -->
      <script src="admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
      <!-- AdminLTE App -->
      <script src="admin/dist/js/adminlte.min.js"></script>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>
      <script src="js/jquery.js"></script>
      <script src="js/location.js"></script>
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
         $("form[name='register']").validate({
            rules:{
               firstName:"required",
               UserName:"required",
               email: { required: true, email: true },
               business_type:"required",
               lastName:"required",
               phone:"required",
               dob:"required",
               description:"required",
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
                  firstName:"Please Enter Your First Name",
                  UserName:"Please Enter Your User Name",
                  email: {
                        required: "Please Enter Your Email",
                        email: "Please Enter Your Valid Email"
                  },
                  business_type:"Please Enter Your Business Type",
                  lastName:"Please Enter Your Last Name",
                  phone:"Please Enter Your Phone Number",
                  dob:"Please Enter Your Date of birth",
                  description:"Please Enter Description",
                  password:{
                     required:"Please Enter Your Password",
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
   </body>
</html>