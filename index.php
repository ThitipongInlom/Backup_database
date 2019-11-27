<html>
    <head>
        <link rel="stylesheet" type="text/css" href="plugin/bootstrap/dist/css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="plugin/font-awesome/css/all.css">
        <link rel="stylesheet" type="text/css" href="plugin/toastr/build/toastr.css">
        <link rel="stylesheet" type="text/css" href="plugin/AdminLTE/dist/css/adminlte.css">
    </head> 
    <body>
        <div id="app">
            <div class="container-fluid">
                <div class="card mt-3">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="card">
                                    <div class="card-header text-center mb-1 pb-1">
                                        <h5><i class="fas fa-database"></i> ฐานข้อมูล</h5>
                                    </div>
                                    <div class="card-body text-center p-1 m-1">
                                        <div class="d-flex">
                                            <div class="mr-auto p-2"></div>
                                            <div class="p-2">
                                                <select class="form-control form-control-sm" onchange="Add_input_data()" id="list_item"></select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="host"><b>Host / IP</b></label>
                                                    <input type="text" class="form-control" id="host" placeholder="Host / IP" tabindex="1">
                                                </div>
                                                <div class="form-group">
                                                    <label for="password"><b>Password</b></label>
                                                    <input type="password" class="form-control" id="password" placeholder="Password" tabindex="3">
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="username"><b>Username</b></label>
                                                    <input type="text" class="form-control" id="username" placeholder="Username" tabindex="2">
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-12 text-center mb-3">
                                                <button class="btn btn-sm btn-success" onclick="backup();"><i class="fas fa-save"></i> Backup</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="card">
                                    <div class="card-header text-center mb-1 pb-1">
                                        <h5><i class="fas fa-file-archive"></i> ไฟล์ Backup</h5>
                                    </div>
                                    <div class="card-body text-center p-1 m-1">
                                       <table class="table table-sm table-bordered" id="table_file_backup">
                                            <tr class="text-center bg-info">
                                                <td><b>ชื่อไฟล์</b></td>
                                                <td><b>ขนาดไฟล์</b></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>              
                            </div>
                        </div>
                    </div>
                </div>                
            </div>
        </div>
        <script src="plugin/jquery/jquery.js"></script>
        <script src="plugin/toastr/build/toastr.min.js"></script>
        <script src="plugin/AdminLTE/dist/js/adminlte.js"></script>
        <script src="system/javascript/readjson.js"></script>
        <script src="system/javascript/backup.js"></script>
    </body>
</html>
