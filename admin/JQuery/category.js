$(function () {
    bsCustomFileInput.init();
  });
$(function () {
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
  function addCategory(){
    var file = $('#file').get(0).files[0];
          var file2 =$('#file2').get(0).files[0];
          var formData = new FormData();
          formData.append('file', file);
          formData.append('file2', file2);
          formData.append('category', $('#category').val());
          $.ajax({
            url:"../category/add.php",
            type:"POST",
            data:formData,
            contentType: false,
            processData: false,
            success:function(res){
              var json = $.parseJSON(res);
              if(json.status == 200){
                $('#exampleModal').modal('hide');
                $('#addMsg').text(json.message);
                $('#addSection').show();
                setTimeout(function(){
                  location.reload();
                },1000)
              }
            }
          });
  }
$(document).ready(function(){
      $("#updateCategory").click(function(){
        var file = $('#file').get(0).files[0];
        var file2 =$('#file2').get(0).files[0];
          var formData = new FormData();
          formData.append('file', file);
          formData.append('file2', file2);
          formData.append('category', $('#category').val());
          formData.append('id', $('#catId').val());
          $.ajax({
            url:"../category/update.php",
            type:"POST",
            data:formData,
            contentType: false,
            processData: false,
            success:function(res){
              //var json = $.parseJSON(res);
              console.log(res);
              // if(json.status == 200){
              //   $('#exampleModal').modal('hide');
              //   $('#addMsg').text(json.message);
              //   $('#addSection').show();
              //   setTimeout(function(){
              //     location.reload();
              //   },1000)
              // }
            }
          });
      });

      $('#reject').click(function(){
        var id = $('#userIds').val();
        $('#rejectionNote').modal('show');
        $('#exampleModal').modal('hide');
        $('#rejectSubmit').click(function(){
          var rejectionDiscription = $('#rejectionDiscription').val();
          $.ajax({
            url:"../request/request.php",
            type:"POST",
            data:{id:id,request:3,rejectionDiscription:rejectionDiscription},
            success:function(res){
              $('#exampleModal').modal('hide');
              var json = $.parseJSON(res);
              if(json.status == 200){
                $('#rejectionNote').modal('hide');
                $('#addMsg').text(json.message);
                $('#addSection').show();
              }
              setTimeout(function(){
               location.reload();
              },1000)
            }
          });
        });
      });
      $('#accept').click(function(){
        var id = $('#userIds').val();
        $.ajax({
          url:"../request/request.php",
          type:"POST",
          data:{id:id,request:2},
          success:function(res){
            var json = $.parseJSON(res);
            $('#exampleModal').modal('hide');
            if(json.status == 200){
              $('#exampleModal').modal('hide');
              $('#addMsg').text(json.message);
              $('#addSection').show();
            }
            setTimeout(function(){
             location.reload();
            },1000)
          }
        });
      });
  });
  function cateUpdate(id){
      $("#addCategory").hide();
      $("#updateCategory").show();
      
      $('#exampleModal').modal('show');
      $.ajax({
        url:'../category/edit.php',
        type:"GET",
        data:{id:id},
        success:function(res){
          var json = $.parseJSON(res);
          if(json.status == 200){
            $('#category').val(json.data.categoryName);
            $('#catId').val(json.data.categoryId);
            $('#catImg1').attr('src', 'http://192.168.1.205:51000/images/'+json.data.categoryImage);
            $('#catImg2').attr('src', 'http://192.168.1.205:51000/images/'+json.data.categoryImage2);
          }
        }
      });
  }

  function cateDelete(id,action,isDelete){
    var isDel = isDelete == false ? true : false;
    var msg = isDelete == false ? "Inactive" : "Active";
    $.ajax({
      url:"../category/delete.php",
      type:"GET",
      data:{id:id,action:action,isDel},
      success:function(res){
        var json = $.parseJSON(res);
        if(json.status == 200){
          $('#exampleModal').modal('hide');
          $('#addMsg').text("Category "+msg);
          $('#addSection').show();
          setTimeout(function(){
            location.reload();
          },1000)
        }
      }
    });
    }

    function promotionAdd(){
      var file = $('#promotionImage').get(0).files[0];
      var formData = new FormData();
      formData.append('profileImg', file);
      formData.append('quoteTitle', $('#quoteTitle').val());
      formData.append('quoteDescription', $('#quoteDescription').val());
      $.ajax({
        url:"../promotion/add.php",
        type:"POST",
        data:formData,
        contentType: false,
        processData: false,
        success:function(res){
          var json = $.parseJSON(res);
          if(json.status == 200){
            $('#exampleModal').modal('hide');
            $('#addMsg').text(json.message);
            $('#addSection').show();
            setTimeout(function(){
              location.reload();
            },1000)
          }
        }
      })
    }
function promotionSoftDeleteFun(id,req){
  console.log(id,req);
}
function promotionDeleteFun(id,req){
  console.log(id,req);
}