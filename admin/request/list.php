<?php
include('../forceAction.php');
include('../layouts/header.php');
$token =  $_SESSION['authToken'];
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => $baseUrl.'user/getvendor-reqs',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'Authorization: Bearer '.$token
  ),
));

$reqResponse = curl_exec($curl);

curl_close($curl);
//echo $catResponse;
$reqData = json_decode($reqResponse);
$reqAllList = json_decode(json_encode($reqData),true);
$reqList = array();
if(@$reqAllList['status'] == 200){
    $reqList = $reqAllList['data'];
}
$reqAllListEdit = json_encode($reqData);
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Vendor</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Vendor</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
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
            </div><!-- /.container-fluid -->
        </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Vendor List</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>No.</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <!-- <th>Status</th> -->
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                      <?php foreach($reqList as $key => $value) {?>
                  <tr>
                      <td><?php echo $key+1; ?></td>
                    <td><?php echo $value['firstName']; ?></td>
                    <td>
                        <?php echo $value['lastName']; ?>
                    </td>
                    <td>
                        <?php echo $value['userName'] ?>
                    </td>
                    <td>
                        <button type="button" onclick="reqsFun('<?php echo $value['id']; ?>')" class="btn btn-primary edit-btn">
                            View
                        </button>
                    </td>
                  </tr>
                  <?php } ?>
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>No.</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Action</th>
                  </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
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

  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Category</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <div class="card-body">
              <div class="displayProfile">
                  <div class="form-group">
                    <img alt="" id="profile" class="userProfile">
                  </div>
                </div>
                <div class="form-group">
                    <label>First Name:</label>
                    <span id="firstName"></span>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1" >Last Name:</label>
                    <span id="lastName"></span>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1" >Email:</label>
                  <span id="email"></span>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1" >DOB:</label>
                  <span id="dateOfBirth"></span>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1" >Business Type:</label>
                  <span id="businessType"></span>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1" >Phone Number:</label>
                  <span id="phoneNumber"></span>
                </div>
                <div class="form-group">
                  <span id="userId" style="display:none"></span>
                  <input type="hidden" id="userIds">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1" >Vendor Discription:</label>
                  <span id="vendorDiscription"></span>
                </div>
            </div>        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" id="reject" style="background-color:#ff0000c9; width: 100%; max-width: 100px; color:white;">Reject</button>
        <button type="button" class="btn btn-success" id="accept" style="width: 100%; max-width: 100px;">Accept</button>
      </div>
    </div>
  </div>
</div>


<!-- Modal -->
<div class="modal fade" id="rejectionNote" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Rejection</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <div class="card-body">
                <div class="form-group">
                    <label>Rejection Discription</label>
                    <textarea class="form-control" placeholder="Rejection Discription" id="rejectionDiscription"></textarea>
                </div>
            </div>        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" id="rejectSubmit">Reject</button>
      </div>
    </div>
  </div>
</div>
    <script>
        function reqsFun(id){
            var reqData = <?php echo $reqAllListEdit; ?>;
            reqData.data.map(function(data,value){
                if(id == data.id){
                  var months_arr = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
                    console.log(data);
                    $('#firstName').text(data.firstName);
                    $('#lastName').text(data.lastName);
                    $('#email').text(data.email);
                    const unixTime = data.dateOfBirth;
                    const date = new Date(unixTime*1000);
                    const dob = date.getFullYear()+"-"+months_arr[date.getMonth()]+"-"+date.getDate();
                    $('#businessType').text(data.businessType);
                    $('#dateOfBirth').text(dob);
                    $('#phoneNumber').text(data.phoneNumber);
                    $('#vendorDiscription').text(data.vendorDiscription);
                    $('#userId').text(data.id);
                    $('#userIds').val(data.id);
                    if(data.pictureUrl != ''){
                      $('.displayProfile').show();
                      $('#profile').attr("src","<?php echo $baseUrlFile; ?>images/"+data.pictureUrl);
                    }else{
                      $('.displayProfile').hide();
                    }
                    $('#exampleModal').modal('show');
                }
            });
        }
    </script>
  <?php
  include('../layouts/footer.php');
  ?>