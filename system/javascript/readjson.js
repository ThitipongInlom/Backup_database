$(document).ready(function () {
    // Json file
    Load_config();
    // Table Path
    Load_table();
});

var Load_config = function Load_config() {
    var Toastr = Set_Toastr();
    $.getJSON("system/config.json", function (result) {
        $.each(result, function (key, res) {
            var id = res.id;
            var name = res.name;
            $("#list_item").append('<option value="' + id + '" name_json="' + name + '">' + name + '</option>');
        });
        Add_input_data();
    });
}

var Add_input_data = function Add_input_data() {
    $.getJSON("system/config.json", function (result) {
        var select = $("#list_item").val();
        // Json File To Host
        $("#host").val(result[select].host);
        // Json File To Username
        $("#username").val(result[select].username);
        // Json File To Password
        $("#password").val(result[select].password);
    });
}

var Load_table = function Load_table() {
    var Toastr = Set_Toastr();
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

$("input").change(function () {
    var Data = new FormData();
    Data.append('list_item', $("#list_item").val());
    Data.append('name', $("#list_item option:selected").text());
    Data.append('host', $("#host").val());
    Data.append('username', $("#username").val());
    Data.append('password', $("#password").val());
    $.ajax({
        url: 'system/server/readjson.php',
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
});
var Ajax_beforeSend = function Ajax_beforeSend() {
    var Toastr = Set_Toastr();
    Toastr["info"]('กำลังส่งคำสั่ง...');
}
var Ajax_success = function Ajax_success(res) {
    var Toastr = Set_Toastr();
    Toastr["success"]('บันทึกข้อมูล เสร็จสิ้น');
}
var Ajax_error = function Ajax_error(res) {
    var Toastr = Set_Toastr();
    Toastr["error"]('เกิดความผิดพลาด');
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