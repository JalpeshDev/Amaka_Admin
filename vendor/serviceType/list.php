<?php
include('../forceAction.php');
include('../layouts/header.php');
$token =  $_SESSION['authToken'];

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => $baseUrl.'ServicesType',
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

$response = curl_exec($curl);

curl_close($curl);
//echo $response;
$datas = json_decode($response);
$serviceAllList = json_decode(json_encode($datas),true);
$serviceList = array();
if(@$serviceAllList['status'] == 200){
    $serviceList = $serviceAllList['data'];
}

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => $baseUrl.'Categories',
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

$response = curl_exec($curl);

curl_close($curl);
$data = json_decode($response);
$categoryAllData = json_decode(json_encode($data),true);
if(@$categoryAllData['status'] == 200){
  $category = $categoryAllData['data'];
}
$serviceAllListEdit = json_encode($datas);
// print_r($serviceAllListEdit);
// exit;
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Service</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Service</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12 text-right">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                Add Service
            </button>
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
                <h3 class="card-title">Services List</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>No.</th>
                    <th>Service</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                <?php foreach($serviceList as $key => $value) { ?>
                  <tr>
                    <td><?php echo $value['servicesID']; ?></td>
                    <td><?php echo $value['serviceName']; ?></td>
                    <td>
                        <?php if(!empty($value['userId'])) {?>
                        <!-- <a href="#" class="btn btn-primary">Edit</a> -->
                        <button type="button" onclick="myFunction(<?php echo $value['servicesID']; ?>)" class="btn btn-primary edit-btn">
                            Edit
                        </button>
                        <button type="button" onclick="deleteFun(<?php echo $value['servicesID']; ?>,'delete')" class="btn btn-danger">
                          Delete
                        </button>
                        <?php } ?>
                    </td>
                  </tr>
                  <?php } ?>
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>No.</th>
                    <th>Service</th>
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
        <h5 class="modal-title" id="exampleModalLabel">Add Service</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form name="serviceType" > 
            <div class="card-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Category</label>
                    <select class="form-control" name="category" id="category">
                        <option value="">--Select Category--</option>
                        <?php foreach($category as $value){ ?>
                        <option value="<?php echo $value['categoryId'] ?>"><?php echo $value['categoryName'] ?></option>
                        <?php }?>
                    </select>
                </div>
                <div class="form-group">
                          <input type="hidden" id="id">
                    <label for="exampleInputEmail1">Service</label>
                    <input type="text" name="service" id="service" class="form-control" placeholder="Service">
                </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" name="submitService" class="btn btn-primary" id="submit" >Save & Close</button>
          </div>
        </form>      
    </div>
  </div>
</div>


 <!-- Modal -->
 <div class="modal fade" id="serviceUpdate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Service</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form name="serviceUpdates">
            <div class="card-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Category</label>
                    <select class="form-control" name="categoryU" id="categoryU">
                        <option value="">--Select Category--</option>
                        <?php foreach($category as $value){ ?>
                        <option value="<?php echo $value['categoryId'] ?>"><?php echo $value['categoryName'] ?></option>
                        <?php }?>
                    </select>
                </div>
                <div class="form-group">
                          <input type="hidden" id="idU">
                    <label for="exampleInputEmail1">Service</label>
                    <input type="text" name="serviceU" id="serviceU" class="form-control" placeholder="Service">
                </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" name="updateService" class="btn btn-primary" id="updateService">Update & Close</button>
          </div>
        </form>      
    </div>
  </div>
</div>
<script>
  function myFunction(id){
        var id = id;
        var editData = <?php echo $serviceAllListEdit; ?>;
        editData.data.map(function(data,value){
            if(id == data.servicesID){
              $('#serviceU').val(data.serviceName);
              $('#idU').val(id);
              $("#categoryU option").each(function(){
              if($(this).val() == data.categoryId){
                $(this).prop("selected", true);
              }
              });
              $('#serviceUpdate').modal('show');
            }
        });
  }
  </script>
  <?php
  include('../layouts/footer.php');
  ?>
