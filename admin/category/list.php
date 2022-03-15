<?php
include('../forceAction.php');
include('../layouts/header.php');
$token =  $_SESSION['authToken'];
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

$catResponse = curl_exec($curl);

curl_close($curl);
//echo $catResponse;
$catData = json_decode($catResponse);
$categoryAllList = json_decode(json_encode($catData),true);
$categoryList = array();
if(@$categoryAllList['status'] == 200){
    $categoryList = $categoryAllList['data'];
}

?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Category</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Category</li>
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
                Add Category
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
                <h3 class="card-title">Category List</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>No.</th>
                    <th>Name</th>
                    <th>Image</th>
                    <th>Image2</th>
                    <!-- <th>Status</th> -->
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                      <?php foreach($categoryList as $key => $value) {?>
                  <tr>
                      <td><?php echo $key++ ." ". $value['categoryId']; ?></td>
                    <td><?php echo $value['categoryName']; ?></td>
                    <td>
                        <img src="<?php echo $baseUrlFile."images/".$value['categoryImage']; ?>" widh="50" height="50">
                    </td>
                    <td>
                        <img src="<?php echo $baseUrlFile."images/".$value['categoryImage2']; ?>" widh="50" height="50">
                    </td>
                    <!-- <td>
                      <?php echo $value['isdelete'] == true ? "Inactive" : "Active"; ?>
                    </td> -->
                    <td>
                        <!-- <button type="button" onclick="cateUpdate(<?php echo $value['categoryId']; ?>)" class="btn btn-primary edit-btn">
                            Edit
                        </button> -->
                        <!-- <a href="delete.php?action=delete&id=<?php echo $value['categoryId'] ?>" id="complexConfirm" class="btn btn-danger">Delete</a> -->
                        
                        <button type="button" onclick="cateDelete(<?php echo $value['categoryId'] ?>,'delete',<?php echo var_export($value['isdelete'],true); ?>)" class="btn btn-danger <?php echo $value['isdelete'] == true ? "Active" : "Inactive"; ?>">
                          <?php echo $value['isdelete'] == true ? "Active" : "Inactive"; ?>
                        </button>
                    </td>
                  </tr>
                  <?php } ?>
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>No.</th>
                    <th>Name</th>
                    <th>Image</th>
                    <th>Image2</th>
                    <!-- <th>Status</th> -->
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
              <form name="categoryAdd">
                <div class="form-group">
                    <label for="exampleInputEmail1">Name</label>
                    <input type="hidden" name="catId" id="catId" class="form-control">
                    <input type="text" name="categoory" id="category" class="form-control" placeholder="Name">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Image1</label>
                    <input type="file" name="file" id="file">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Image2</label>
                    <input type="file" name="file2" id="file2">
                </div>
            </div>        
      </div>
      <div class="modal-footer">
        <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
        <button type="submit" name="addCategory" class="btn btn-primary" id="addCategory" >Save</button>
        <button type="button" name="updateCategory" class="btn btn-primary" id="updateCategory" style="display:none;">Update & Close</button>
        <!-- <input type="submit" name="submitService" class="btn btn-primary" id="submit" value="Save & Close"> -->
      </div>
      </form>
    </div>
  </div>
</div>
  <?php
  include('../layouts/footer.php');
  ?>