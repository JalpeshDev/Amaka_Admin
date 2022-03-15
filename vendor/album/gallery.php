<?php
include('../forceAction.php');
include('../layouts/header.php');
$token =  $_SESSION['authToken'];
$id = $_SESSION['userDetails']['data']['id'];
if(@$_REQUEST['action'] == "view"){
    $urlId = $_REQUEST['id'];
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
}
?>
 <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
               <h1>Gallery</h1>
            </div>
            <div class="col-sm-6">
               <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active">Gallery</li>
               </ol>
            </div>
         </div>
      </div>
      <!-- /.container-fluid -->
   </section>

   <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12 text-right">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                Add Image
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
               <div class="card card-primary">
                  <div class="card-header">
                     <h4 class="card-title"><?php echo @$_REQUEST['album']; ?></h4>
                  </div>
                  <div class="card-body">
                     <div class="row">
                        <?php foreach($albumList as $img){ if($img['albumId'] == $urlId){ foreach($img['images'] as  $imgKey => $images) { ?>
                        <div class="col-sm-2 main-div">
                           <a href="<?php echo $baseUrlFile."albumimage/".$images['imageName']; ?>" data-toggle="lightbox" data-title="<?php echo $img['albumName'] ?>" data-gallery="gallery">
                           <img src="<?php echo $baseUrlFile."albumimage/".$images['imageName']; ?>" class="img-fluid mb-2" alt="white sample"/>
                           </a>
                           <div class="cross-btn" onclick="deleteAlbumPhotoFun(<?php echo $images['albumImageId']; ?>,'delete')">
                              <i class="fas fa-times" ></i>
                           </div>
                        </div>
                        <?php } } } ?>
                     </div>
                  </div>
               </div>
            </div>
         </div>
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
        <h5 class="modal-title" id="exampleModalLabel">Add More Photo to <?php echo @$_REQUEST['album']; ?> Album</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="card-body">
            <div class="form-group">
                <!-- <label for="exampleInputEmail1">Album Name</label> -->
                <input type="hidden" name="albumId" id="albumId" class="form-control" placeholder="Album Name" value="<?php echo $urlId; ?>">
            </div>
            <div  id="showAlbumImageinput">
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
        <!-- <input type="submit" name="submitService" class="btn btn-primary" id="submit" value="Save & Close"> -->
      </div>
    </div>
  </div>
</div>
<style>
   .cross-btn{
      cursor: pointer;
      position: absolute;
      right: 13px;
      top: 3px;
      color: black;
      padding-top: 5px;
      padding-bottom: 5px;
      padding-left: 8px;
      padding-right: 8px;
      background-color: white;
      border-radius: 50%;
      width: 30px;
      height: 30px;
      display: flex;
      justify-content: center;
      align-items: center;
   }
   .main-div{
      position: relative;
   }
</style>
<?php
  include('../layouts/footer.php');
  ?>