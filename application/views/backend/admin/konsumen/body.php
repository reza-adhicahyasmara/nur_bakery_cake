<?php $this->load->view('backend/partials/head.php') ?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="m-1 text-dark"><span class="nav-icon bx bx-fw bxs-group"></span>Konsumen</h1>
                </div>
                <div class="col-sm-6 float-sm-right">
                    <ol class="breadcrumb float-sm-right m-2">
                        
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="card card-secondary">
                <div class="card-body">
                    <div id="content_konsumen">
                        <!--LOAD DATA-->
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<form role="form" id="form_konsumen" method="post">
    <div id="modal_konsumen" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header">
                    <strong><span class="modal-title text-lg" id="myModalLabel"></span></strong>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- FORM -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><span class="bx bx-fw bx-x"></span> Batal</button>
                    <button type="submit" id="btn_simpan_konsumen" class="btn bg-warning"><span class="bx bx-fw bx-save"></span> Simpan</button>
                </div>
            </div>
        </div>
    </div>
</form>

<?php $this->load->view('backend/partials/footer.php') ?>
<?php $this->load->view('backend/partials/script.php') ?>

<!-----------------------FUNGSI----------------------->
<script type="text/javascript">
    var url_konsumen =  "<?php echo base_url('admin/konsumen'); ?>";
    var url = url_konsumen ;
    $('ul.nav-sidebar a').filter(function() {
        return this.href == url;
    }).addClass('active ');
    $('ul.nav-treeview a').filter(function() {
        return this.href == url;
    }).parentsUntil(".nav-sidebar > .nav-treeview").addClass('menu-open').prev('a').addClass('active');
</script>


<script type="text/javascript">
    load_data_konsumen();
	function load_data_konsumen(){
		$.ajax({
			method : "GET",
			url : "<?php echo base_url('admin/konsumen/load_data_konsumen'); ?>",
			beforeSend : function(){
				$('#content_konsumen').html('<div style="text-align:center"><i class="bx bx-loader-alt bx-md bx-spin" style="margin-top: 30px; margin-bottom: 30px;" aria-hidden="true"></i></div>');
			},
			success : function(response){
				$('#content_konsumen').html(response);
			}
		});
    };

    $('#btn_tambah_konsumen').on("click",function(){
        var url = "<?php echo base_url('admin/konsumen/form_tambah_konsumen'); ?>";

        $('#modal_konsumen').modal('show');
        $('.modal-title').text('Tambah Konsumen');
        $('.modal-body').load(url);
    });

    $(document).on('click', '.btn_edit_konsumen', function(e) {
        var id_konsumen=$(this).attr("id_konsumen");
        var url = "<?php echo base_url('admin/konsumen/form_edit_konsumen'); ?>";

        $('#modal_konsumen').modal('show');
        $('.modal-title').text('Edit Konsumen');
        $('.modal-body').load(url,{id_konsumen : id_konsumen});
    });  
    
    $(document).ready(function() {
        $('#btn_simpan_konsumen').on("click",function(e){
            $('#form_konsumen').validate({
                rules: {
                    nama_konsumen: { required: true },
                    alamat: { required: true },
                    rt: { required: true },
                    rw: { required: true },
                    kode_provinsi: { required: true },
                    kode_kabupaten: { required: true },
                    kode_kecamatan: { required: true },
                    kode_desa: { required: true },
                    email_konsumen: { required: true, email: true },
                    kontak_konsumen_daftar: { required: true, minlength: 11, maxlength: 13 },
                    foto_konsumen: { required: true },
                    password_konsumen: { required: true, minlength: 5 },
                },
                messages: {
                    nama_konsumen: { required: "Harus diisi" },
                    alamat: { required: "Harus diisi" },
                    rt: { required: "Haarus diisi" },
                    rw: { required: "Harus diisi" },
                    kode_provinsi: { required: "Harus diisi" },
                    kode_kabupaten: { required: "Harus diisi" },
                    kode_kecamatan: { required: "Harus diisi" },
                    kode_desa: { required: "Harus diisi" },
                    email_konsumen: { required: "Harus diisi", email: "Tidak sesui dengan format email" },
                    kontak_konsumen_daftar: { required: "Harus diisi", minlength: "Minimal 11 karakter", maxlength: "Maksimal 13 karakter" },
                    foto_konsumen: { required: "Harus diisi" },
                    foto_konsumen: { required: "Harus diisi", minlength: "Minimal 5 karakter" },
                },
                errorElement: 'span',
                errorPlacement: function (error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function (element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function (element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                },
                submitHandler: function() {
                    $("#form_konsumen").load('submit', function(e){
                        $.ajax({
                            url : '<?php echo base_url('admin/konsumen/edit_konsumen'); ?>',
                            method: 'POST',
                            data: new FormData(this),
                            contentType: false,
                            cache: false,
                            processData:false, 
                            success: function(response){
                                if(response==1){
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Berhasil Disimpan!',
                                        showConfirmButton: true,
                                        confirmButtonColor: '#ffc107',
                                        timer: 3000
                                    }).then(function(){
                                        load_data_konsumen();
                                        $('#modal_konsumen').modal('hide');
                                    });
                                } else {
                                    Swal.fire({
                                        icon: 'warning',
                                        title: 'Gagal!',
                                        text: response,
                                        showConfirmButton: true,
                                        confirmButtonColor: '#ffc107',
                                        timer: 3000
                                    })
                                }
                            }
                        }); 
                    }); 
                }
            });  
        });
    });
    
    $(document).on('click', '.btn_hapus_konsumen', function() {
        var id_konsumen=$(this).attr("id_konsumen");
        var nama_konsumen=$(this).attr("nama_konsumen");
        var foto_konsumen=$(this).attr("foto_konsumen");
        Swal.fire({
            title: 'Apakah anda yakin?',
            text: 'Akan menghapus data"' + nama_konsumen + '"!',
            type: 'warning',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ffc107',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, hapus',
            cancelButtonText: "Tidak, batalkan",
            showLoaderOnConfirm: true,
            customClass: 'animated tada',
            preConfirm: function() {
                return new Promise(function(resolve) {
                    $.ajax({
                        url: "<?php echo base_url('admin/konsumen/hapus_konsumen');?>",
                        method: 'POST',
                        data: {
                            id_konsumen:id_konsumen,
                            foto_konsumen:foto_konsumen
                        },                
                    })
                    .done(function(response) {
                        load_data_konsumen();
                        $('#modal_konsumen').modal('hide');
                        Swal.fire({
                            title: 'Data Berhasil Dihapus',
                            icon: 'success',
                            showConfirmButton: true,
                            confirmButtonColor: '#ffc107',
                        })
                    })
                    .fail(function() {
                        Swal.fire({
                            title: 'Terjadi Kesalahan',
                            icon: 'error',
                            showConfirmButton: true,
                            confirmButtonColor: '#ffc107',
                        })
                    });
                });
            },
        });
    });  
</script>

</body>
</html>