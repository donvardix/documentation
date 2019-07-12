$('#form2').on('submit', function (e) {
    e.preventDefault();
    var formData = new FormData(this);
    $.ajax({
        url: 'controllers/store_form/store2.php',
        type: 'POST',
        cache: false,
        processData: false,
        contentType: false,
        data: formData,
        dataType: 'html',
        success: function (data) {
            if(data=='The file is not a picture.'){
                $("#res").html(data);
            }else{
                $("#forms").html(data);
            }
        }
    });
});


