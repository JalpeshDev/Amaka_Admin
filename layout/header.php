<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>BOB</title>
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
.tab {
  display: none;
}
.step.active {
  opacity: 1;
}
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
.btn-primary:not(:disabled):not(.disabled).active, .btn-primary:not(:disabled):not(.disabled):active, .show>.btn-primary.dropdown-toggle {
    color: #fff;
    background-color: #e83d81;
    border-color: #e83d81;
}
</style>
   <body class="hold-transition login-page">
      <div class="login-box">
         <div class="login-logo">
            <img src="AppLogo.png" alt="" width="100" height="100">
         </div>