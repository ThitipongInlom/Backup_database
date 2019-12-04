$(document).ready(function () {
    $(".overlay").hide();
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
        beforeSend: Backup_beforeSend,
        success: Backup_success,
        error: Backup_error,
    });
}

var Backup_beforeSend = function Backup_beforeSend() {
    var Toastr = Set_Toastr();
    Toastr["info"]('กำลังส่งคำสั่ง...');
    $(".overlay").fadeIn();
}
var Backup_success = function Backup_success(res) {
    var Toastr = Set_Toastr();
    Table_file_zip();
    Toastr["success"]('Backup เสร็จสิ้น');
    $(".overlay").fadeOut(1000);
}
var Backup_error = function Backup_error(res) {
    var Toastr = Set_Toastr();
    Toastr["error"]('เกิดความผิดพลาด');
    $(".overlay").fadeOut(1000);
}

var Table_file_zip = function Table_file_zip() {
    var head_table = '<tr class="text-center bg-info">'+
                     '<td><b>ชื่อไฟล์</b></td>'+
                     '<td><b>ขนาดไฟล์</b></td>'+
                     '<td><b>เครื่องมือ</b></td>'+
                     '</tr>';
    $("#table_file_backup").html(head_table);
    $.getJSON("system/route.php?action=path_file_zip", function (result) {
        $.each(result, function (key, value) {
            var table = '<tr>' +
                '<td>' + value.filename + '</td>' +
                '<td class="text-right">' + value.sizefile + '</td>' +
                '<td class="text-center">' + value.action + '</td>' +
                '<tr>';
            $("#table_file_backup").append(table);
        });
        $('[data-toggle="tooltip"]').tooltip({"html": true,});
    });
}
