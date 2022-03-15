<?php
include('../forceAction.php');
include('../layouts/header.php');
$token =  $_SESSION['authToken'];
// echo "<pre>";
// print_r($_SESSION['userDetails']['data']);
// exit;
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
               <h1>Update Profile</h1>
            </div>
            <div class="col-sm-6">
               <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active">Update Profile</li>
               </ol>
            </div>
         </div>
      </div>
      <!-- /.container-fluid -->
   </section>
   <section class="content-header" id="addSection" style="display:none;">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-12">
               <div class="alert alert-success alert-dismissible" id="msg">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true" style="color: white; opacity: 100;">
                  &times;
                  </button>
                  <h5><i class="icon fas fa-check"></i>
                     <label id="addMsg"></label>
                  </h5>
               </div>
            </div>
         </div>
      </div>
      <!-- /.container-fluid -->
   </section>
   <section class="content-header" id="errorSection" style="display:none;">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-12">
               <div class="alert alert-danger alert-dismissible" id="msg">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true" style="color: white; opacity: 100;">
                  &times;
                  </button>
                  <h5><i class="icon fas fa-check"></i>
                     <label id="errorMsg"></label>
                  </h5>
               </div>
            </div>
         </div>
      </div>
      <!-- /.container-fluid -->
   </section>
   <!-- Main content -->
   <section class="content">
      <div class="container-fluid">
         <div class="row">
            <!-- /.col -->
            <div class="col-md-12">
               <div class="card">
                  <div class="card-header p-2">
                     <ul class="nav nav-pills">
                        <li class="nav-item"><a class="nav-link active" href="#account" data-toggle="tab">Profile</a></li>
                        <li class="nav-item"><a class="nav-link" href="#business-details" data-toggle="tab">Business Details</a></li>
                        <li class="nav-item"><a class="nav-link" href="#change-password" data-toggle="tab">Change Password</a></li>
                     </ul>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body">
                     <div class="tab-content">
                        <!-- /.tab-pane -->
                        <div class="active tab-pane" id="account">
                           <div class="row">
                              <div class="col-12">
                                 <div class="mb-4" style="display: flex; flex-direction: column; align-items: center;;">
                                    <?php
                                       if(isset($_SESSION['profileImage'])){ ?>
                                    <img src="<?php echo $baseUrlFile."/images/".$_SESSION['profileImage']; ?>"
                                       class="img-circle avatar-pic" style="width: 200px; height: 200px;">
                                    <?php } elseif(isset($_SESSION['userDetails']['data']['pictureUrl'])){ ?>
                                    <img src="<?php echo $baseUrlFile."/images/".$_SESSION['userDetails']['data']['pictureUrl']; ?>"
                                       class="img-circle avatar-pic" style="width: 200px; height: 200px;">
                                    <?php }else{ ?>
                                    <img src="https://mdbootstrap.com/img/Photos/Others/placeholder-avatar.webp"
                                       class="img-circle avatar-pic" style="width: 200px; height: 200px;">
                                    <?php } ?>
                                    <label class="btn btn-default">
                                    Chosse Profile Photo
                                    <input type="file" hidden name="profileImg" id="profileImg">
                                    </label>
                                 </div>
                              </div>
                           </div>
                           <form class="form-horizontal" name="profileForm">
                              <div class="form-group row">
                                 <label for="inputName" class="col-sm-2 col-form-label">First Name</label>
                                 <div class="col-sm-10">
                                    <input type="text" class="form-control" name="firstName" id="firstName" placeholder="First Name" value="<?php if(isset($_SESSION['userNewDetails']['firstName'])){ echo $_SESSION['userNewDetails']['firstName']; }elseif(isset($_SESSION['userDetails']['data']['firstName'])){ echo $_SESSION['userDetails']['data']['firstName']; } ?>">
                                 </div>
                              </div>
                              <div class="form-group row">
                                 <label for="inputName2" class="col-sm-2 col-form-label">Last Name</label>
                                 <div class="col-sm-10">
                                    <input type="text" class="form-control" name="lastName" id="lastName" placeholder="Last Name" value="<?php if(isset($_SESSION['userNewDetails']['lastName'])){ echo $_SESSION['userNewDetails']['lastName']; }elseif(isset($_SESSION['userDetails']['data']['lastName'])){ echo $_SESSION['userDetails']['data']['lastName']; } ?>">
                                 </div>
                              </div>
                              <div class="form-group row">
                                 <label for="inputSkills" class="col-sm-2 col-form-label">Phone Number</label>
                                 <div class="col-sm-10">
                                    <input type="text" class="form-control" name="phoneNumber" id="phoneNumber" placeholder="Phone Number" value="<?php if(isset($_SESSION['userNewDetails']['phoneNumber'])){ echo $_SESSION['userNewDetails']['phoneNumber']; }elseif(isset($_SESSION['userDetails']['data']['phoneNumber'])){ echo $_SESSION['userDetails']['data']['phoneNumber']; } ?>">
                                 </div>
                              </div>
                              <div class="form-group row">
                                 <label for="inputExperience" class="col-sm-2 col-form-label">Date of Birth</label>
                                 <div class="col-sm-10">
                                    <input type="text" class="form-control" name="dob" id="dob" placeholder="Date of Birth" value="<?php if(isset($_SESSION['userNewDetails']['dob'])){ echo $_SESSION['userNewDetails']['dob']; }elseif(isset($_SESSION['userDetails']['data']['dateOfBirth'])){ echo $_SESSION['userDetails']['data']['dateOfBirth']; } ?>">
                                 </div>
                              </div>
                              <div class="form-group row">
                                 <label for="inputSkills" class="col-sm-2 col-form-label">UserName</label>
                                 <div class="col-sm-10">
                                    <input type="text" class="form-control" name="userName" id="userName" placeholder="User Name" value="<?php if(isset($_SESSION['userNewDetails']['userName'])){ echo $_SESSION['userNewDetails']['userName']; }elseif(isset($_SESSION['userDetails']['data']['userName'])){ echo $_SESSION['userDetails']['data']['userName']; } ?>">
                                 </div>
                              </div>
                              <div class="form-group row">
                                 <div class="col-sm-12" style="display: flex; justify-content: center;">
                                    <!-- <button type="submit" class="btn btn-danger">Submit</button> -->
                                    <input type="submit" class="btn btn-danger" id="profileDetailSave" value="Update" style="color: white; background-color: #ed4381; border-color: #ed4381; box-shadow: none;">
                                 </div>
                              </div>
                           </form>
                        </div>
                        <!-- /.tab-pane -->
                        <!-- /.tab-pane -->
                        <div class="tab-pane" id="business-details">
                           <form class="form-horizontal" name="businessFormUpdate">
                              <div class="form-group row">
                                 <label for="inputName" class="col-sm-2 col-form-label">Latitude</label>
                                 <div class="col-sm-10">
                                    <input type="text" class="form-control" name="latitude" id="latitude" placeholder="latitude" value="<?php if(isset($_SESSION['userNewDetails']['latitude'])){ echo $_SESSION['userNewDetails']['latitude']; }elseif(isset($_SESSION['userDetails']['data']['latitude'])){ echo $_SESSION['userDetails']['data']['latitude']; } ?>">
                                 </div>
                              </div>
                              <div class="form-group row">
                                 <label for="inputName2" class="col-sm-2 col-form-label">Longitude</label>
                                 <div class="col-sm-10">
                                    <input type="text" class="form-control" name="longitude" id="longitude" placeholder="longitude" value="<?php if(isset($_SESSION['userNewDetails']['longitude'])){ echo $_SESSION['userNewDetails']['longitude']; }elseif(isset($_SESSION['userDetails']['data']['longitude'])){ echo $_SESSION['userDetails']['data']['longitude']; } ?>">
                                 </div>
                              </div>
                              <div class="form-group row">
                                 <label for="inputSkills" class="col-sm-2 col-form-label">Business Type</label>
                                 <div class="col-sm-10">
                                    <input type="text" class="form-control" name="businessType" id="businessType" placeholder="Business Type" value="<?php if(isset($_SESSION['userNewDetails']['businessType'])){ echo $_SESSION['userNewDetails']['businessType']; }elseif(isset($_SESSION['userDetails']['data']['businessType'])){ echo $_SESSION['userDetails']['data']['businessType']; } ?>">
                                 </div>
                              </div>
                              <div class="form-group row">
                                 <label for="inputExperience" class="col-sm-2 col-form-label">Description</label>
                                 <div class="col-sm-10">
                                    <textarea class="form-control" name="description" id="description" placeholder="Description"><?php if(isset($_SESSION['userNewDetails']['vendorDiscription'])){echo $_SESSION['userNewDetails']['vendorDiscription'];}elseif(isset($_SESSION['userDetails']['data']['vendorDiscription'])){echo $_SESSION['userDetails']['data']['vendorDiscription']; }?></textarea>
                                 </div>
                              </div>
                              <div class="form-group row">
                                 <div class="col-sm-12" style="display: flex; justify-content: center;">
                                    <!-- <button type="submit" class="btn btn-danger">Submit</button> -->
                                    <input type="submit" class="btn btn-danger" id="businessSave" value="Update" style="color: white; background-color: #ed4381; border-color: #ed4381; box-shadow: none;">
                                 </div>
                              </div>
                           </form>
                        </div>
                        <!-- /.tab-pane -->
                        <!-- /.tab-pane -->
                        <div class="tab-pane" id="change-password">
                           <form class="form-horizontal" name="changePasswordForm">
                              <div class="form-group row">
                                 <label for="inputName" class="col-sm-2 col-form-label">Current Password</label>
                                 <div class="col-sm-10">
                                    <input type="password" class="form-control" name="currentPassword" id="currentPassword" placeholder="Current Password">
                                 </div>
                              </div>
                              <div class="form-group row">
                                 <label for="inputName2" class="col-sm-2 col-form-label">New Password</label>
                                 <div class="col-sm-10">
                                    <input type="password" class="form-control" name="newPassword" id="newPassword" placeholder="New Password">
                                 </div>
                              </div>
                              <div class="form-group row">
                                 <label for="inputSkills" class="col-sm-2 col-form-label">Confirm Password</label>
                                 <div class="col-sm-10">
                                    <input type="password" class="form-control" name="confirmPassword" id="confirmPassword" placeholder="Confirm Password">
                                 </div>
                              </div>
                              <div class="form-group row">
                                 <div class="col-sm-12" style="display: flex; justify-content: center;">
                                    <!-- <button type="submit" class="btn btn-danger">Submit</button> -->
                                    <input type="submit" class="btn btn-danger" id="changePassword" value="Change Password" style="color: white; background-color: #ed4381; border-color: #ed4381; box-shadow: none;">
                                 </div>
                              </div>
                           </form>
                        </div>
                        <!-- /.tab-pane -->
                     </div>
                     <!-- /.tab-content -->
                  </div>
                  <!-- /.card-body -->
               </div>
               <!-- /.card -->
            </div>
            <!-- /.col -->
         </div>
         <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
   </section>
   <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php
include('../layouts/footer.php');
?>
