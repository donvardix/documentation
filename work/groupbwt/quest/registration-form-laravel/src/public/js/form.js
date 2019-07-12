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
    }
}

var maskChangeRU = function(maskObj, determined) {
    if (determined) {
        if (maskObj.type != "mobile") {
            $("#descr").html(maskObj.city.toString() + " (" + maskObj.region.toString() + ")");
        }
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
    }
});

$('#phone_mask').change();

$("#form1").on('submit', function (e) {
    e.preventDefault();
    var formData = new FormData(this);
    $.ajax({
        type: 'POST',
        url: '/store',
        data: formData,
        cache: false,
        processData: false,
        contentType: false,
        dataType: 'json',
        success: function (data) {
            $("#form1-block").hide();
            $("#form2-block").show();
            $('#number').html(data.number);
        },
        error: function (data) {
            if (data.status === 422) {
                $('.text-danger').empty();
                var response = $.parseJSON(data.responseText);
                $.each(response.errors, function (key, value) {
                    $('#' + key + '-error').html(value);
                });
            } else {
                $('#res').html('my unknown error');
                console.log('my unknown error:');
                console.log(data);
            }
        }
    });
});


$("#form2").on('submit', function (e) {
    e.preventDefault();
    var formData = new FormData(this);
    $.ajax({
        type: 'POST',
        url: '/store2',
        data: formData,
        cache: false,
        processData: false,
        contentType: false,
        dataType: 'json',
        success: function () {
            $("#form2-block").hide();
            $("#form3-block").show();
        },
        error: function (data) {
            if (data.status === 422) {
                $('.text-danger').empty();
                var response = $.parseJSON(data.responseText);
                $.each(response.errors, function (key, value) {
                    $('#' + key + '-error').html(value);
                });
            } else {
                $('#res').html('Unknown error');
                console.log('Unknown error:');
                console.log(data);
            }
        }
    });
});