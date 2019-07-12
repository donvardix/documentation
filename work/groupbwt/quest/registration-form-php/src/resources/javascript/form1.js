jQuery.validator.addMethod("phoneno", function(phone_number, element) {
    phone_number = phone_number.replace(/\s+/g, "");
    return this.optional(element) || phone_number.length > 9 &&
        phone_number.match(/^((\+[1-9]{1,4}[ \-]*)|(\([0-9]{2,3}\)[ \-]*)|([0-9]{2,4})[ \-]*)*?[0-9]{3,4}?[ \-]*[0-9]{3,4}?$/);
}, "<br />Please specify a valid phone number");

$(function(){
    var dat = new Date().getFullYear();
    $('#form1').validate({
        rules: {
            firstname: {
                required: true,
                maxlength: 50
            },
            lastname: {
                required: true,
                maxlength: 50
            },
            birthdate: {
                max: dat+'-12-31'
            },
            reportsubject: {
                required: true,
                minlength: 2,
                maxlength: 255
            },
            country: {
                required: true
            },
            phone: {
                required: true,
                phoneno: true
            },
            email: {
                required: true,
                email: true,
                maxlength: 255
            }
        }
    });
});

var listCountries = $.masksSort($.masksLoad("https://cdn.rawgit.com/andr-04/inputmask-multi/master/data/phone-codes.json"), ['#'], /[0-9]|#/, "mask");
var listRU = $.masksSort($.masksLoad("https://cdn.rawgit.com/andr-04/inputmask-multi/master/data/phones-ru.json"), ['#'], /[0-9]|#/, "mask");
var maskOpts = {
    inputmask: {
        definitions: {
            '#': {
                validator: "[0-9]",
                cardinality: 1
            }
        },
        showMaskOnHover: false,
        autoUnmask: true,
        clearMaskOnLostFocus: false
    },
    match: /[0-9]/,
    replace: '#',
    listKey: "mask"
};

var maskChangeWorld = function(maskObj, determined) {
    if (determined) {
        var hint = maskObj.name_ru;
        if (maskObj.desc_ru && maskObj.desc_ru != "") {
            hint += " (" + maskObj.desc_ru + ")";
        }
        $("#descr").html(hint);
    } else {
        $("#descr").html("Маска ввода");
    }
}

var maskChangeRU = function(maskObj, determined) {
    if (determined) {
        if (maskObj.type != "mobile") {
            $("#descr").html(maskObj.city.toString() + " (" + maskObj.region.toString() + ")");
        } else {
            $("#descr").html("мобильные");
        }
    } else {
        $("#descr").html("Маска ввода");
    }
}

$('#phone_mask, input[name="mode"]').change(function() {
    if ($('#phone_mask').is(':checked')) {
        $('#phone').inputmask("remove");
        if ($('#is_world').is(':checked')) {
            $('#phone').inputmasks($.extend(true, {}, maskOpts, {
                list: listCountries,
                onMaskChange: maskChangeWorld
            }));
        } else {
            $('#phone').inputmasks($.extend(true, {}, maskOpts, {
                list: listRU,
                onMaskChange: maskChangeRU
            }));
        }
    } else {
        $('#phone').inputmasks("remove");
        $('#phone').inputmask("+#{*}", maskOpts.inputmask);
        $("#descr").html("Маска ввода");
    }
});

$('#phone_mask').change();


$('#form1').on('submit', function (e) {
    e.preventDefault();
    var formData = new FormData(this);
    $.ajax({
        url: 'controllers/store_form/store.php',
        type: 'POST',
        cache: false,
        processData: false,
        contentType: false,
        data: formData,
        dataType: 'html',
        success: function (data) {
            if(data=='errorEmail'){
                $("#emaild").html('<span class="text-danger">Email is used</span>');
            }else if(data){
                $("#forms").html(data);
            }
        }
    });
});




