<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <link rel="shortcut icon" href="<?php echo base_url('assets/img/banner/bx-cake.svg'); ?>"></link>
    <title>Login</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/floating-labels/floating-labels.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/boxicons/css/boxicons.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/backend/css/adminlte.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/sweetalert2/sweetalert2.min.css">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    
    <style>
        .demo-bg {  
            background-position: center center;
            background-size: cover;
            position: fixed; 
            left: 0;
            top: 0;
            min-width: 100%;
            min-height: 100%;
            filter: brightness(50%);
            -webkit-filter: brightness(50%);
        }   

        .tengah{
            -webkit-align-items: center;
            -ms-flex-align: center;
            align-items: center;
            display: -webkit-flex;
            display: -ms-flexbox;
            display: flex;
            -webkit-flex-direction: column;
            -ms-flex-direction: column;
            flex-direction: column;
            height: 100vh;
            -webkit-justify-content: center;
            -ms-flex-pack: center;
            justify-content: center;
        }
    </style>

</head>
<body class="hold-transition sidebar-mini layout-fixed text-sm">
    <div class="preloader flex-column justify-content-center align-items-center bg-warning">
        <img class="animation__shake" src="<?php echo base_url('assets/img/banner/bx-cake.svg'); ?>" alt="AdminLTELogo" height="60" width="60">
    </div>
    <img class="demo-bg" src="<?php echo base_url('assets/img/banner/background.jpg'); ?>" alt="">
    <div class="card-body tengah"> 
        <div class="container">
            <div class="row justify-content-center">  
                <div class="login-box">
                    <div class="card">
                        <div class="card-header text-center">
                            <div class="row justify-content-center">
                                <img src="<?php echo base_url('assets/img/banner/bx-cake.svg'); ?>" alt="AdminLTELogo" style="padding-top: 4px; padding-right: 4px" height="35" width="35">
                                <span class="text-lg" style="padding-top: 4px;"><b>Nur Bakery & Cake</b></span>
                            </div>
                        </div>
                        <div class="card-body">
                            <p class="login-box-msg">Masuk untuk memulai sesi Anda</p>
                            <form role="form" id="form_login" action="<?php echo base_url('login');?>" method="post">
                                <div class="input-group mb-3">
                                    <input class="form-control" id="username" name="username" value="<?php echo set_value('username');?>" placeholder="Username">
                                    <div class="input-group-append">
                                        <div class="input-group-text"><span class="bx bx-fw bxs-user"></span></div>
                                    </div>
                                </div>
                                <div class="input-group mb-3">
                                    <input type="password" class="form-control" name="password" value="<?php echo set_value('password');?>" placeholder="Password" autofocus>
                                    <div class="input-group-append">
                                        <div class="input-group-text"><span class="bx bx-fw bxs-lock"></span></div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-8">
                                            <caption></caption>
                                    </div>
                                    <div class="col-4">
                                            <button type="submit" name="proses" id="btn_login" class="btn btn-warning btn-block">Masuk <i class="float-right fa fa-arrow-right" style="margin-top: 5px;"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="<?php echo base_url(); ?>assets/plugins/jquery/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/dist/backend/js/adminlte.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/bootstrap-4/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/jquery-validation/jquery.validate.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/jquery-validation/additional-methods.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/sweetalert2/sweetalert2.all.min.js"></script>

    <!--VALIDATION-->
    <script>
        $(document).ready(function() {
            $('#btn_login').on("click",function(){
                $('#form_login').validate({
                    rules: {
                        username: {
                            required: true,
                            minlength: 5
                        },
                        password: {
                            required: true,
                            minlength: 5
                        },
                    },
                    messages: {
                        username: {
                            required: "Username harus diisi",
                            minlength: "Minimal 5 karakter"
                        },
                        password: {
                            required: "Password harus diisi",
                            minlength: "Minimal 5 karakter"
                        },
                    },
                    errorElement: 'span',
                    errorPlacement: function (error, element) {
                        error.addClass('invalid-feedback');
                        element.closest('.input-group').append(error);
                    },
                    highlight: function (element, errorClass, validClass) {
                        $(element).addClass('is-invalid');
                    },
                    unhighlight: function (element, errorClass, validClass) {
                        $(element).removeClass('is-invalid');
                    },
                    submitHandler: function() {
                        $.ajax({
                            url : '<?php echo base_url('login/proses'); ?>',
                            method: 'POST',
                            data : $('#form_login').serialize(),
                            success: function(response){
                                if(response == 1){
                                    Swal.fire({
                                        icon: 'warning',
                                        title: 'Username atau Password salah!',
                                        showConfirmButton: true,
                                        confirmButtonColor: '#ffc107',
                                        timer: 3000
                                    })
                                } else {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Login Berhasil!',
                                        showConfirmButton: true,
                                        confirmButtonColor: '#ffc107',
                                        timer: 3000
                                    }).then(function(){
                                        window.location.replace(response);
                                    });
                                }
                            }
                        }); 
                    }
                });
            });
        });
    </script>
</body>
</html>
