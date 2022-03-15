<?php
include('../forceAction.php');
include('../layouts/header.php');
$token =  $_SESSION['authToken'];
$id = $_SESSION['userDetails']['data']['id'];
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => $baseUrl.'Album/album-images/'.$id,
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
$albumAllList = json_decode(json_encode($datas),true);
$albumList = array();
if(@$albumAllList['status'] == 200){
    $albumList = $albumAllList['data'];
}

?>
 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Album</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Album</li>
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
                Add Album
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
                <h3 class="card-title">Album List</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>No.</th>
                    <th>Album Name</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                <?php foreach($albumList as $key => $album){ ?>
                  <tr>
                    <td><?php echo $album['albumId']; ?></td>
                    <td><?php echo $album['albumName']; ?></td>
                    <td>
                        <a href="gallery.php?action=view&id=<?php echo $album['albumId']; ?>&album=<?php echo $album['albumName'];  ?>" class="btn btn-primary">View Albums</a>
                        <button type="button" class="btn btn-danger" onclick="deleteAlbumFun(<?php echo $album['albumId']; ?>,'delete')">
                          Delete
                        </button>
                    </td>
                  </tr>
                  <?php } ?>
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>No.</th>
                    <th>Album Name</th>
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
        <h5 class="modal-title" id="exampleModalLabel">Add Album</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="card-body">
          <form name="albumAdd">
            <div class="form-group">
                <label for="exampleInputEmail1">Album Name</label>
                <input type="text" name="albumName" id="albumName" class="form-control" placeholder="Album Name">
            </div>
            <div  id="showAlbumImageinput" style="display:none;">
            <label for="exampleInputEmail1">Album Image</label>
            <div class="fieldList">
                <input type="hidden" id="albumId" name="albumId">
                <input type="hidden" id="count" name="count">
                <div id="fieldList" class="form-group" >
                <!-- style="
                    display: flex;
                    align-items: flex-start;
                    justify-content: flex-start;
                    flex-direction: row-reverse;
                    align-content: flex-start;" -->
                    <input type="file" name="albumImage[]" class="form-control albumImage">
                    
                </div>
            </div>
            <input type="button" name="addMoreFileds" id="addMoreFileds" value="Add More Image" class="btn btn-primary addMoreFileds">
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" name="createAlbumSubmit" class="btn btn-primary" id="createAlbumSubmit" >Create Album</button>
        <!-- <input type="submit" name="submitService" class="btn btn-primary" id="submit" value="Save & Close"> -->
      </div>
      </form>
    </div>
  </div>
</div>
<?php
  include('../layouts/footer.php');
  ?>