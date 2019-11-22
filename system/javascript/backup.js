$(document).ready(function () {

});

var backup = function backup() {
    var Data = new FormData();
    Data.append('host', $("#host").val());
    Data.append('username', $("#username").val());
    Data.append('password', $("#password").val());
    $.ajax({
        url: 'system/route.php?action=backup',
        type: 'POST',
        dataType: 'json',
        cache: false,
        contentType: false,
        processData: false,
        data: Data,
        beforeSend: Ajax_beforeSend,
        success: Ajax_success,
        error: Ajax_error,
    });
}

var Ajax_beforeSend = function Ajax_beforeSend() {
    var Toastr = Set_Toastr();
    Toastr["info"]('กำลังส่งคำสั่ง...');
}
var Ajax_success = function Ajax_success(res) {
    var Toastr = Set_Toastr();
    table_file_zip();
    Toastr["success"]('Backup เสร็จสิ้น');
}
var Ajax_error = function Ajax_error(res) {
    var Toastr = Set_Toastr();
    Toastr["error"]('เกิดความผิดพลาด');
}

var table_file_zip = function table_file_zip() {
    var head_table = '<tr class="text-center bg-info">'+
                     '<td><b>ชื่อไฟล์</b></td>'+
                     '<td><b>ขนาดไฟล์</b></td>'+
                     '</tr>';
    $("#table_file_backup").html(head_table);
    $.getJSON("system/route.php?action=path_file_zip", function (result) {
        $.each(result, function (key, value) {
            var table = '<tr>' +
                '<td><a href="#">' + value.filename + '</a></td>' +
                '<td class="text-right">' + value.sizefile + '</td>' +
                '<tr>';
            $("#table_file_backup").append(table);
        });
    });
}

var Set_Toastr = function Set_Toastr() {
    // Toastr Options
    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": true,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "2500",
        "timeOut": "2500",
        "extendedTimeOut": "2500",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }
    return toastr;
}