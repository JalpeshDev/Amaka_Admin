$(function() {
    $("form[name='categoryAdd']").validate({
    rules:{
        categoory: "required",
    },
    messages:{
        categoory:"Please Select Category",
    },
    submitHandler: function(form) {
        addCategory()
        return false;
    }
});
});


function readImage(file, element) {
    var reader = new FileReader();
    var image  = new Image();
    reader.readAsDataURL(file);
    reader.onload = function (_file) {
        image.src = _file.target.result;
        image.onload = function() {
            $(element).data('height', this.height);
            $(element).data('width', this.width);
            $(element).data('size', ~~((file.size / 1024) / 1024));
        }
    }
};

jQuery.validator.addMethod('height', function (value, element, param) {
    if ($(element).data('height')) {
        return $(element).data('height') == param;
    }    return this.optional(element) || true;
}, 'Image Height Should be {0}px');

jQuery.validator.addMethod('width', function (value, element, param) {
    if ($(element).data('width')) {
        return $(element).data('width') == param;
    }    return this.optional(element) || true;
}, 'Image Width Should be {0}px');

jQuery(function ($) {
    "use strict";
    $('#promotionImage').change(function () {
        var files = this.files;
        if (files && files[0]) {
            readImage(files[0], '#promotionImage');
        }
    });

    $("form[name='promotionForm']").validate({
        rules: {
            quoteTitle:"required",
            quoteDescription:"required",
            promotionImage: {
                required: true,
                width: 1284,
                height: 2778,
            }
        },submitHandler: function(form) {
            promotionAdd()
            return false;
        }
    });
});