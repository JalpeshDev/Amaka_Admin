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
  $(function () {
    $(document).on('click', '[data-toggle="lightbox"]', function(event) {
      event.preventDefault();
      $(this).ekkoLightbox({
        alwaysShowClose: true
      });
    });
  });
 function deleteFun(id,action){
  $.confirm({
          title: 'Category Delete!',
          content: 'Are You Sure to Delete this Category?',
          buttons: {
              confirm: function () {
                  $.ajax({
                    url:"../serviceType/delete.php",
                    type:"GET",
                    data:{id:id,action:action},
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
              },
              cancel: function () {
                  //$.alert('Canceled!');
              },
          }
      });
 }

 function vendorDeleteFun(id,action){
  $.confirm({
      title: 'Vendor Service Delete!',
      content: 'Are You Sure to Delete this Vendor Service?',
      buttons: {
          confirm: function () {
              $.ajax({
                url:"../vendorService/delete.php",
                type:"GET",
                data:{id:id,action:action},
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
          },
          cancel: function () {
              //$.alert('Canceled!');
          },
      }
  });
}
function deleteAlbumFun(id,action){
  $.confirm({
    title: 'Album Delete!',
    content: 'Are You Sure to Delete this Album?',
    buttons: {
      confirm: function() {
        $.ajax({
          url: "../album/albumDelete.php",
          type: "GET",
          data: {
            id: id,
            action: action
          },
          success: function(res) {
            var json = $.parseJSON(res);
            if (json.status == 200) {
              $('#exampleModal').modal('hide');
              $('#addMsg').text(json.message);
              $('#addSection').show();
              setTimeout(function() {
                location.reload();
              }, 1000)
            }
          }
        });
      },
      cancel: function() {
        //$.alert('Canceled!');
      },
    }
  });
}
function deleteAlbumPhotoFun(id,action){
  //id,action
  $.confirm({
    title: 'Album Image Delete!',
    content: 'Are You Sure to Delete this Image?',
    buttons: {
      confirm: function() {
        $.ajax({
          url: "../album/deleteImage.php",
          type: "GET",
          data: {
            id: id,
            action: action
          },
          success: function(res) {
            var json = $.parseJSON(res);
            if (json.status == 200) {
              $('#exampleModal').modal('hide');
              $('#addMsg').text(json.message);
              $('#addSection').show();
              setTimeout(function() {
                location.reload();
              }, 1000)
            }
          }
        });
      },
      cancel: function() {
        //$.alert('Canceled!');
      },
    }
  });
}
function voucherDeleteFun(id,action){
  $.confirm({
    title: 'Category Delete!',
    content: 'Are You Sure to Delete this Category?',
    buttons: {
      confirm: function() {
        $.ajax({
          url: "../voucher/delete.php",
          type: "GET",
          data: {
            id: id,
            action: action
          },
          success: function(res) {
            var json = $.parseJSON(res);
            if (json.status == 200) {
              $('#exampleModal').modal('hide');
              $('#addMsg').text(json.message);
              $('#addSection').show();
              // setTimeout(function() {
              //   location.reload();
              // }, 1000)
            }
          }
        });
      },
      cancel: function() {
        //$.alert('Canceled!');
      },
    }
  });
}

function profileDetailSave(){
  // $('#profileDetailSave').click(function(){
    var firstName = $('#firstName').val();
    var lastName = $('#lastName').val();
    var phoneNumber = $('#phoneNumber').val();
    var dob = $('#dob').val();
    var userName = $('#userName').val();
    $.ajax({
      url:"../account/profileDetailUpdate.php",
      type:"POST",
      data:{
        firstName:firstName,
        lastName:lastName,
        phoneNumber:phoneNumber,
        dob:dob,
        userName:userName
      },success:function(res){
        var json = $.parseJSON(res);
        if(json.status == 200){
          $('#addMsg').text(json.message);
          $('#addSection').show();
          setTimeout(function(){
            location.reload();
          },1000)
        }
      }
    });
  // });
}

function changePassword(){
    var currentPassword = $('#currentPassword').val();
    var newPassword = $('#newPassword').val();
    $.ajax({
      url:"../account/changePassword.php",
      type:"POST",
      data:{currentPassword:currentPassword,newPassword:newPassword},
      success:function(res){
        var json = $.parseJSON(res);
        if(json.status == 200){
          $('#addMsg').text(json.message);
          $('#addSection').show();
          setTimeout(function(){
            location.reload();
          },1000)
        }else if(json.status == 400){
          $('#errorMsg').text(json.message);
          $('#errorSection').show();
        }
      }
    });
}
$(document).ready(function(){

  

  $('#vendorServiceSubmit').click(function(){
    var service = $('#service').val();
    var category = $('#category').val();
    var servicePrice = $('#servicePrice').val();
    var timeTaken = $('#timeTaken').val();
    $.ajax({
      url:"../vendorService/add.php",
      type:"POST",
      data:{
        service:service,
        category:category,
        servicePrice:servicePrice,
        timeTaken:timeTaken,
      },
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
  });

  $('#voucherSubmit').click(function(){
    var voucherCode = $('#voucherCode').val();
    var percentageApplied = $('#percentageApplied').val();
    var description = $('#description').val();
    var expiryDate = $('#expiryDate').val();
    var vendorService = $('#vendorService').val();
    $.ajax({
      url:"../voucher/add.php",
      type:"POST",
      data:{
        voucherCode:voucherCode,
        percentageApplied:percentageApplied,
        description:description,
        expiryDate:expiryDate,
        vendorService:vendorService
      },
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
  });

  $('#submit').click(function(){
    var category = $('#category').val();
    var service = $('#service').val();
    $.ajax({
        url:"../serviceType/add.php",
        type:"POST",
        data:{category:category,service:service},
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
  });
  $("#updateService").click(function(){
    var formData = new FormData();
    formData.append('category', $('#categoryU').val());
    formData.append('id', $('#idU').val());
    formData.append('service', $('#serviceU').val());
    $.ajax({
      url:"../serviceType/update.php",
      type:"POST",
      data:formData,
      contentType: false,
      processData: false,
        success:function(res){
          var json = $.parseJSON(res);
          if(json.status == 200){
            $('#serviceUpdate').modal('hide');
            $('#addMsg').text(json.message);
            $('#addSection').show();
            setTimeout(function(){
              location.reload();
            },1000)
          }
        }
      });
    });
    var date = new Date();
    date.setDate(date.getDate()+1);

      $('#expiryDate').datepicker({
        startDate: date,
        format: 'yyyy-mm-dd'
    });

      $('#dob').datepicker({
        format: 'yyyy-mm-dd'
    });
    $('#createAlbumSubmit').click(function(){
      var albumName = $('#albumName').val();
      if(albumName != ""){
        $.ajax({
          url:"../album/add.php",
          type:"POST",
          data:{albumName:albumName},
          success:function(res){
            var json = $.parseJSON(res);
            if(json.status == 200){
              var albumId = json.data.albumId != '' ? json.data.albumId : "Sorry we Don't Get Your Album";
              $('#albumId').val(albumId);

              $('#showAlbumImageinput').show();
              $('#createAlbumSubmit').hide();
              $('#albumSubmit').show();
            }
          }
        });
      }
    });
    var max_fields      = 10;
    var wrapper         = $(".fieldList");
    var add_button      = $(".addMoreFileds");
    var x = 1;
    $(add_button).click(function(e){
      e.preventDefault();
      if(x < max_fields){
          x++;
          $(wrapper).append(
            '<div class="form-group"><input type="file" name="albumImage[]" class="form-control albumImage"><a href="#" class="remove_field">Remove</a></div>'
        );
          $("#count").val(x);
      }
    });

      $(wrapper).on("click",".remove_field", function(e){
        e.preventDefault(); $(this).parent('div').remove(); x--;
      });
    $(document).on('change', 'input[name="albumImage[]"]', function() {
      var file = $(this).get(0).files[0];
      var formData = new FormData();
      formData.append('file', file);
      formData.append('albumId', $('#albumId').val());
      var count = $('#count').val();
      $.ajax({
        url:"../album/addAlbumImage.php",
        type:"POST",
        data:formData,
        contentType: false,
        processData: false,
        success:function(res){
          var json = $.parseJSON(res);
          if(json.status == 200 && count == 10){
            $('#exampleModal').modal('hide');
            $('#addMsg').text(json.message);
            $('#addSection').show();
            setTimeout(function(){
              location.reload();
            },1000)
          }
        }
      });
    });


});
$(document).on('change', '#profileImg', function() {
  var file = $(this).get(0).files[0];
  var formData = new FormData();
  formData.append('profileImg', file);
  $.ajax({
      url:"../profile/profileImgUpdate.php",
      type:"POST",
      data:formData,
      contentType: false,
      processData: false,
      success:function(res){
        var json = $.parseJSON(res);
        if(json.status == 200){
          $('#addSection').show();
          $('#addMsg').text(json.message);
          setTimeout(function(){
            location.reload();
          },1000)
        }
      }
  });
});
