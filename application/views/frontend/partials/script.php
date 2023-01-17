<!-- Vendor JS Files -->
<script src="<?php echo base_url(); ?>assets/plugins/aos/aos.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/bootstrap-5/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/glightbox/js/glightbox.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/isotope-layout/isotope.pkgd.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/php-email-form/validate.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/purecounter/purecounter.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/swiper/swiper-bundle.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/waypoints/noframework.waypoints.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/jquery/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/jquery-ui/jquery-ui.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/sweetalert2/sweetalert2.all.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/jquery-validation/additional-methods.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datetimepicker/build/jquery.datetimepicker.full.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/fullcalendar/lib/moment.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/fullcalendar/fullcalendar.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/select2/js/select2.min.js"></script>

<script src="<?php echo base_url(); ?>assets/dist/frontend/js/main.js"></script>


<!-----------------------LOGIN LOGOUT RESET PASSWORD----------------------->
<script>
    $('.btn_modal_login').on("click",function(){
        $('#modal_login').modal('show');
    });
    
    $('#btn_login').on("click",function(){
        $('#form_login').validate({
            rules: {
                username_login: {
                    required: true,
                    minlength: 5,
                },
                password_login: {
                    required: true,
                    minlength: 5,
                },
            },
            messages: {
                username_login: {
                    required: "Username harus diisi",
                    minlength: "Minimal 5 karakter",
                },
                password_login: {
                    required: "Password harus diisi",
                    minlength: "Minimal 5 karakter",
                },
            },
            errorElement: 'span',
            errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-floating').append(error);
            },
            highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            },
            submitHandler: function() {
                $.ajax({
                    url : '<?php echo base_url('home/login'); ?>',
                    method: 'POST',
                    data : $('#form_login').serialize(),
                    success: function(response){
                        if(response==1){
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil login..!!',
                                showConfirmButton: true,
                                confirmButtonColor: '#007bff',
                                timer: 3000
                            }).then(function(){
                                window.location.replace("<?php echo base_url('home'); ?>");
                            })
                        } else {
                            $('#alert_login').html('<div class="alert alert-danger alert-dismissible fade show" role="alert">'+response+'<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>')
                            $('#simpan').prop("disabled",false);
                        }
                    }
                });     
            }
        });
    }); 
    


    $('#btn_modal_logout').on("click",function(){
        $('#modal_logout').modal('show');
    });

    $('#btn_logout').on("click",function(){
        $.ajax({
            url : '<?php echo base_url('home/logout'); ?>',
            method: 'POST',
            success: function(response){
                if(response==1){
                    window.location.replace("<?php echo base_url('home'); ?>");    
                }
            }             
        }) 
    });
    

    
    $('#btn_modal_reset_password').on("click",function(){
        $('#moda_reset_password').modal('show');
    });

    $('#btn_reset_password').on("click",function(){
        $('#form_reset_password').validate({
            rules: {
                password_lama_konsumen: {
                    required: true,
                    minlength: 5,
                },
                password1: {
                    required: true,
                    minlength: 5
                },
                password_baru_konsumen: {
                    required: true,
                    minlength: 5,
                    equalTo: password1,
                },
            },
            messages: {
                password_lama_konsumen: {
                    required: "Password harus diisi",
                    minlength: "Minimal 5 karakter",
                },
                password1: {
                    required: "Password harus diisi",
                    minlength: "Minimal 5 karakter"
                },
                password_baru_konsumen: {
                    required: "Password harus diisi",
                    minlength: "Minimal 5 karakter",
                    equalTo: "Password harus sama"
                },
            },
            errorElement: 'span',
            errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-floating').append(error);
            },
            highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            },
            submitHandler: function() {
                $.ajax({
                    url : '<?php echo base_url('home/reset_password'); ?>',
                    method: 'POST',
                    data: $('#form_reset_password').serialize(),
                    success: function(response){
                        if(response==1){
                            Swal.fire({
                                icon: 'success',
                                title: 'Password berhasil diganti..!!',
                                showConfirmButton: true,
                                confirmButtonColor: '#007bff',
                                timer: 3000
                            }).then(function(){
                                window.location.replace("<?php echo base_url('home'); ?>");
                            })
                        } else {
                            $('#alert_reset_password').html('<div class="alert alert-danger alert-dismissible fade show" role="alert">'+response+'<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>')
                            $('#simpan').prop("disabled",false);
                        }
                    }
                });    
            }
        });
    });
</script>

<!-----------------------CARI PRODUK----------------------->
<script>
    $(document).on('click', '.btn_kategori', function(e) {
        var kode_kategori=$(this).attr("kode_kategori");
        var nama_kategori=$(this).attr("nama_kategori");
        $.ajax({
            url : '<?php echo base_url('home/cari_kategori'); ?>',
            method: 'POST',
            data: {
                kode_kategori:kode_kategori,
                nama_kategori:nama_kategori
            },
            beforeSend : function(){
                $('#content_produk').html('<div style="text-align:center"><i class="fa fa-refresh fa-3x fa-spin" style="margin-top: 300px; margin-bottom: 300px;" aria-hidden="true"></i></div>');
            },
            success : function(response){
                $('#content_produk').html(response);
            }
        });    
    }); 
</script>

<!-----------------------CHAT KONSUMEN----------------------->
<script>
    $("#nama_chat").on("input", function(){
        var regexp = /[^A-z ]/g;
        if($(this).val().match(regexp)){
            $(this).val( $(this).val().replace(regexp,'') );
        }
    });

    $("#kontak_chat").on("input", function(){
        var regexp = /[^0-9]/g;
        if($(this).val().match(regexp)){
            $(this).val( $(this).val().replace(regexp,'') );
        }
    });

    $('#btn-chat-konsumen').on("click",function(){
        $('#modal_chat_konsumen').modal('show');
        loadChat();
    });


    function loadChat(){
        var url = "<?php echo base_url('home/load_chat'); ?>";

        $.ajax({
            method : "GET",
            url : url,
            beforeSend : function(){
                $('#content_chat').html('<div style="text-align:center"><i class="fa fa-refresh fa-3x fa-spin" style="margin-top: 30px; margin-bottom: 30px;" aria-hidden="true"></i></div>');
            },
            success : function(response){
                $('#content_chat').html(response);
            }
        });
    };

    $('#btn-chat-non-konsumen').on("click",function(){
        $('#modal_chat_nonkonsumen').modal('show');
    });

    $(document).on('click', '#btn_mulai_chat', function(e) {
        var nama_chat = $('#nama_chat').val();
        var kontak_chat = $('#kontak_chat').val();

         $.ajax({
            url : '<?php echo base_url('home/mulai_chat'); ?>',
            method: 'POST',
            data: {
                nama_chat:nama_chat,
                kontak_chat:kontak_chat
            },
            success: function(response){
                if(response==1){ 

                    var kontak_chat = $('#kontak_chat').val();
                    $.ajax({
                        method : "POST",
                        url : "<?php echo base_url('home/load_chat'); ?>",
                        data : {
                            kontak_chat:kontak_chat
                        },
                        beforeSend : function(){
                            $('#content_chat2').html('<div style="text-align:center"><i class="fa fa-refresh fa-3x fa-spin" style="padding: 20px;" aria-hidden="true"></i></div>');
                        },
                        success : function(response){
                            $('#content_chat2').html(response);
                        }
                    });

                } else if(response==2){
                    Swal.fire({
                        icon: 'error',
                        title: 'Data harus diisi!',
                        showConfirmButton: true,
                        timer: 3000
                    })
                }
            }
        });
    }); 

    $(document).on('click', '#btn_kirim_pesan', function(e) {
        var chat = $('#chat').val();

         $.ajax({
            url : '<?php echo base_url('home/kirim_pesan'); ?>',
            method: 'POST',
            data: {
                chat:chat
            },
            success: function(response){
                if(response==1){ 
                    $("#chat").val("");
                    loadChat();
                } else if(response==2){
                    Swal.fire({
                        icon: 'error',
                        title: 'Pesan harus diisi!',
                        showConfirmButton: true,
                        timer: 3000
                    })
                }
            }
        });
    }); 

</script>