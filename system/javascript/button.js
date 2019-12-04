var Delete_file = function Delete_file(e) {
    var Data = new FormData();
    Data.append('filename', $(e).attr('filename'));
    $.ajax({
        url: 'system/route.php?action=delete',
        type: 'POST',
        dataType: 'json',
        cache: false,
        contentType: false,
        processData: false,
        data: Data,
        beforeSend: Delete_beforeSend,
        success: Delete_success,
        error: Delete_error,
    });
}

var Delete_beforeSend = function Delete_beforeSend() {
    var Toastr = Set_Toastr();
    Toastr["info"]('กำลังส่งคำสั่ง...');
    $(".overlay").fadeIn();
}

var Delete_success = function Delete_success(res) {
    var Toastr = Set_Toastr();
    Table_file_zip();
    Toastr["success"](res.delete_status);
    $(".overlay").fadeOut(1000);
}

var Delete_error = function Delete_error(res) {
    var Toastr = Set_Toastr();
    $(".overlay").fadeOut(1000);
}