$.validator.addMethod("pwcheckspechars", function (value) {
          
    return /[!@#$%^&*()_=\[\]{};':"\\|,.<>\/?+-]/.test(value)
}, "The password must contain at least one special character");

$.validator.addMethod("pwchecklowercase", function (value) {
    return /[a-z]/.test(value) // has a lowercase letter
}, "The password must contain at least one lowercase letter");

$.validator.addMethod("pwcheckrepeatnum", function (value) {
    return /\d{2}/.test(value) // has a lowercase letter
}, "The password must contain at least one lowercase letter");

$.validator.addMethod("pwcheckuppercase", function (value) {
    return /[A-Z]/.test(value) // has an uppercase letter
}, "The password must contain at least one uppercase letter");

$.validator.addMethod("pwchecknumber", function (value) {
    return /\d/.test(value) // has a digit
}, "The password must contain at least one number");
$(function() {
    $("form[name='serviceType']").validate({
    rules:{
        category: "required",
        service:{
            required:true
        }
    },
    messages:{
        category:"Please Select Category",
        service:{
            required:"Please Enter Service Name"
        },
    },
    submitHandler: function(form) {
        return false;
    }
});

$("form[name='serviceUpdates']").validate({
    rules:{
        categoryU: "required",
        serviceU:{
            required:true
        }
    },
    messages:{
        categoryU:"Please Select Category",
        serviceU:{
            required:"Please Enter Service Name"
        },
    },
    submitHandler: function(form) {
        return false;
    }
});

$("form[name='vocucherAdd']").validate({
    rules:{
        vendorService: "required",
        voucherCode:"required",
        percentageApplied:{
            digits:true,
            required: true,
        },
        description:"required",
        expiryDate:{
            date:true,
            required:true
        },
    },
    messages:{
        vendorService:"Please Select Service",
        voucherCode:"Please Enter Voucher Code",
        percentageApplied:{
            digits:"Please Enter Number Only",
            required:"Please Enter Percentage"
        },
        description:"Please Enter Description",
        expiryDate:{
            date:"Please Enter Date Only",
            required:"Please Enter Expiry Date"
        }
    },
    submitHandler: function(form) {
        return false;
    }
});
$("form[name='profileForm']").validate({
    rules:{
        firstName: "required",
        lastName: "required",
        phoneNumber:{
            required: true,
            digits:true
        },
        dob: {
            required:true,
            date:true  
        },
        userName: "required",
    },messages:{
        firstName:"Please Enter First Name",
        lastName:"Please Enter Your Last Name",
        phoneNumber:{
            required:"Please Enter Your Phone Number",
            digits:"Please Enter Only Number"
        },
        dob:{
            required:"Please Enter Your Date Of Birth",
            date:"Please Enter Your Date Of Birth"
        },
        userName:"Please Enter Your User Name"
    },
    submitHandler: function(form) {
        //console.log(form);
        profileDetailSave()
        return false;
    }
});

$("form[name='vendorAdd']").validate({
    rules:{
        service: "required",
        category:"required",
        servicePrice:{
            digits:true,
            required: true,
        },
        timeTaken:{
            digits:true,
            required:true
        },
    },
    messages:{
        service:"Please Select Service",
        category:"Please Enter Category",
        servicePrice:{
            digits:"Please Enter Number Only",
            required:"Please Enter Service Price"
        },
        timeTaken:{
            digits:"Please Enter Number Only",
            required:"Please Enter Time Taken"
        }
    },
    submitHandler: function(form) {
        return false;
    }
});
    $("form[name='albumAdd']").validate({
        rules:{
            albumName: "required",
        },
        messages:{
            albumName:"Please Enter Your Album Name",
        },
        submitHandler: function(form) {
            return false;
        }
    });

    $("form[name='changePasswordForm']").validate({
        rules:{
            currentPassword:"required",
            newPassword: {
               required: true,
               pwchecklowercase: true,
               pwcheckuppercase: true,
               pwchecknumber: true,
               pwcheckspechars: true,
               minlength: 8,
            },
            confirmPassword: {
               required: true,
               equalTo: "#newPassword",
               pwchecklowercase: true,
               pwcheckuppercase: true,
               pwchecknumber: true,
               pwcheckspechars: true,
               minlength: 8,
            }
        },
        messages:{
            currentPassword:"Please Enter Your Current Password",
            newPassword:{
                required:"Please Enter Your Password",
                minlength:"Password Muct be long upto 8 Alphanumeric"
         },
         confirmPassword:{
            required:"Please Enter Your Confirm Password",
            equalTo:"Password and Confirm Password Much Be Same",
            minlength:"Password Muct be long upto 8 Alphanumeric"
          }
        },
        submitHandler: function(form) {
            changePassword()
            return false;
        }
    });
});

