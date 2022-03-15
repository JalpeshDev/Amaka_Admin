<?php
include('../forceAction.php');
include('../layouts/header.php');
$token =  $_SESSION['authToken'];
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => $baseUrl.'Voucher',
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
$datas = json_decode($response);
$voucherAllList = json_decode(json_encode($datas),true);
if(@$voucherAllList['status'] == 200){
    $voucherList = $voucherAllList['data'];
}

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => $baseUrl.'VendorService/getby-vendorid',
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
$vendorData = json_decode($response);
$vendorAllList = json_decode(json_encode($vendorData),true);
if(@$vendorAllList['status'] == 200){
    $vendorList = $vendorAllList['data'];
}


$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => $baseUrl.'ServicesType/',
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
$serviceData = json_decode($response);
$serviceAllList = json_decode(json_encode($serviceData),true);
if(@$serviceAllList['status'] == 200){
    $serviceList = $serviceAllList['data'];
}
?>
 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Vouchers</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Vouchers</li>
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
                Add Voucher
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
                <h3 class="card-title">Vouchers List</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>No.</th>
                    <th>Voucher Code</th>
                    <th>Percentage Applied</th>
                    <th>Description</th>
                    <th>Expiry Date</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                <?php foreach($voucherList as $key => $value) { ?>
                  <tr>
                    <td><?php echo $value['voucherId']; ?></td>
                    <td><?php echo $value['voucherCode']; ?></td>
                    <td><?php echo $value['percentageApplied']; ?></td>
                    <td><?php echo $value['description']; ?></td>
                    <td>
                        <?php
                            $date=date_create($value['expiryDate']);
                            echo date_format($date,"Y-M-d");
                        ?>
                    </td>
                    <td>
                        <?php if(!empty($value['userId'])) {?>
                        <button type="button" onclick="voucherDeleteFun(<?php echo $value['voucherId']; ?>,'delete')" class="btn btn-danger">
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
                    <th>Voucher Code</th>
                    <th>Percentage Applied</th>
                    <th>Description</th>
                    <th>Expiry Date</th>
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
            <div class="card-body">
            <form name="vocucherAdd">
            <div class="form-group">
                    <label for="exampleInputEmail1">Vendor Service</label>
                    <select class="form-control" name="vendorService" id="vendorService">
                        <option value="">--Select Vendor Service--</option>
                        <option value="0">All</option>
                        <?php
                            foreach($vendorList as $venGetService){
                                foreach($serviceList as $serviceVal){ 
                                    if($venGetService['servicesID'] == $serviceVal['servicesID']) { ?>
                                        <option value="<?php echo $venGetService['vendorServiceID']; ?>">
                                            <?php echo $serviceVal['serviceName']; ?>
                                        </option>
                        <?php } } } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Voucher Code</label>
                    <input type="text" name="voucherCode" id="voucherCode" class="form-control" placeholder="Voucher Code">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Percentage Applied</label>
                    <input type="text" name="percentageApplied" id="percentageApplied" class="form-control" placeholder="Percentage Applied">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Description</label>
                    <input type="text" name="description" id="description" class="form-control" placeholder="Description">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Expiry Date</label>
                    <input type="text" name="expiryDate" id="expiryDate" class="form-control" placeholder="Expiry Date">
                </div>                
            </div>        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" name="voucherSubmit" class="btn btn-primary" id="voucherSubmit" >Save & Close</button>
      </div>
      </form>
    </div>
  </div>
</div>


<?php
  include('../layouts/footer.php');
  ?>
 