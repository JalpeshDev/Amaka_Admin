<?php
include('../forceAction.php');
include('../layouts/header.php');
$token =  $_SESSION['authToken'];
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => $baseUrl.'Promotions',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
));

$response = curl_exec($curl);

curl_close($curl);
//echo $response;
$datas = json_decode($response);
$promotionAllList = json_decode(json_encode($datas),true);
$promotionList = array();
if(@$promotionAllList['status'] == 200){
    $promotionList = $promotionAllList['data'];
}

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
                    <th>Title</th>
                    <th>Description</th>
                    <th>Photo</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                <?php foreach($promotionList as $key => $value) { ?>
                  <tr>
                      <td><?php echo $key+1; ?></td>
                    <td><?php echo $value['quoteTitle']; ?></td>
                    <td><?php echo $value['quoteDescription']; ?></td>
                    <td> <img src="<?php echo $baseUrlFile."/promotionimage/".$value['promotionImage']; ?>" alt="<?php echo $value['quoteTitle']; ?>" width="50" heigth="50"></td>
                    <td>
                        <button type="button" onclick="promotionSoftDeleteFun(<?php echo $value['promotionId']; ?>,<?php echo var_export($value['isDelete'],true); ?>)" class="btn btn-danger <?php echo $value['isDelete'] == true ? "Active" : "Inactive"; ?>">
                        <?php echo $value['isDelete'] == true ? "Inactive" : "Active"; ?>
                        </button>
                        <button type="button" onclick="promotionDeleteFun(<?php echo $value['promotionId']; ?>,<?php echo var_export($value['isPermanentDelete'],true); ?>)" class="btn btn-danger">
                          Delete
                        </button>
                    </td>
                  </tr>
                  <?php } ?>
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>No.</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Photo</th>
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
        <form name="promotionForm" action=""> 
            <div class="card-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Title</label>
                  <input type="text" name="quoteTitle" id="quoteTitle" placeholder="Title" class="form-control">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Title</label>
                  <textarea name="quoteDescription" id="quoteDescription" placeholder="Description" class="form-control"></textarea>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Service</label>
                    <input type="file" name="promotionImage" id="promotionImage">
                </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" name="promotionSubmit" class="btn btn-primary" id="promotionSubmit" >Save & Close</button>
          </div>
        </form>      
    </div>
  </div>
</div>
<?php
    include('../layouts/footer.php');
?>
