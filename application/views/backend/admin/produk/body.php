<?php $this->load->view('backend/partials/head.php') ?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="m-1 text-dark"><span class="nav-icon bx bx-fw bx-cake"></span>Produk</h1>
                </div>
                <div class="col-sm-6 float-sm-right">
                    <ol class="breadcrumb float-sm-right m-2">
                        <span class="breadcrumb-item"><a href="<?php echo base_url('admin/dashboard'); ?>">Dashboard</a></span>
                        <span class="breadcrumb-item active">Produk</span>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <div class="float-right">
                        <a type="button" class="btn bg-warning"  id="btn_tambah_produk"><span class="bx bx-fw bx-plus"></span> Tambah Data</a>
                    </div>
                    <br>
                    <br>
                    <br>
                    <div id="content_produk">
                        <!--LOAD DATA-->
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<form role="form" id="form_produk" method="post">
    <div id="modal_produk" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg">
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
                    <button type="submit" id="btn_simpan_produk" class="btn bg-warning"><span class="bx bx-fw bx-save"></span> Simpan</button>
                </div>
            </div>
        </div>
    </div>
</form>

<?php $this->load->view('backend/partials/footer.php') ?>
<?php $this->load->view('backend/partials/script.php') ?>

<!-----------------------FUNGSI----------------------->
<script type="text/javascript">
    var url_produk =  "<?php echo base_url('admin/produk'); ?>";
    var url = url_produk ;
    $('ul.nav-sidebar a').filter(function() {
        return this.href == url;
    }).addClass('active ');
    $('ul.nav-treeview a').filter(function() {
        return this.href == url;
    }).parentsUntil(".nav-sidebar > .nav-treeview").addClass('menu-open').prev('a').addClass('active');
</script>


<script type="text/javascript">
    load_data_produk();
	function load_data_produk(){
		$.ajax({
			method : "GET",
			url : "<?php echo base_url('admin/produk/load_data_produk'); ?>",
			beforeSend : function(){
				$('#content_produk').html('<div style="text-align:center"><i class="bx bx-loader-alt bx-md bx-spin" style="margin-top: 30px; margin-bottom: 30px;" aria-hidden="true"></i></div>');
			},
			success : function(response){
				$('#content_produk').html(response);
			}
		});
    };

    $('#btn_tambah_produk').on("click",function(){
        var url = "<?php echo base_url('admin/produk/form_tambah_produk'); ?>";

        $('#modal_produk').modal('show');
        $('.modal-title').text('Tambah Produk');
        $('.modal-body').load(url);
    });

    $(document).on('click', '.btn_edit_produk', function(e) {
        var kode_produk=$(this).attr("kode_produk");
        var url = "<?php echo base_url('admin/produk/form_edit_produk'); ?>";

        $('#modal_produk').modal('show');
        $('.modal-title').text('Edit Produk');
        $('.modal-body').load(url,{kode_produk : kode_produk});
    });  
    
    $(document).ready(function() {
        $('#btn_simpan_produk').on("click",function(e){
            $('#form_produk').validate({
                rules: {
                    kode_produk_baru: { required: true, maxlength: 10 },
                    nama_produk: { required: true },
                    kode_kategori: { required: true },
                    kode_subkategori: { required: true },
                    berat_produk: { required: true },
                    warna_produk: { required: true },
                    deskripsi_produk: { required: true },
                },
                messages: {
                    kode_produk_baru: { required: "Harus diisi", maxlength: "Maksimal 10 digit"},
                    nama_produk: { required: "Harus diisi" },
                    kode_kategori: { required: "Harus diisi" },
                    kode_subkategori: { required: "Harus diisi" },
                    berat_produk: { required: "Harus diisi" },
                    warna_produk: { required: "Harus diisi" },
                    deskripsi_produk: { required: "Harus diisi" },
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
                    $("#form_produk").load('submit', function(e){
                        $.ajax({
                            url : '<?php echo base_url('admin/produk/tambah_edit_produk'); ?>',
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
                                        confirmButtonColor: '#007bff',
                                        timer: 3000
                                    }).then(function(){
                                        load_data_produk();
                                        $('#modal_produk').modal('hide');
                                    });
                                } else {
                                    Swal.fire({
                                        icon: 'warning',
                                        title: 'Gagal!',
                                        text: response,
                                        showConfirmButton: true,
                                        confirmButtonColor: '#007bff',
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
    
    $(document).on('click', '.btn_hapus_produk', function() {
        var kode_produk=$(this).attr("kode_produk");
        var nama_produk=$(this).attr("nama_produk");
        var gambar_produk=$(this).attr("gambar_produk");
        Swal.fire({
            title: 'Apakah anda yakin?',
            text: 'Akan menghapus data"' + nama_produk + '"!',
            type: 'warning',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#007bff',
            cancelButtonColor: '#dc3545',
            confirmButtonText: 'Ya, hapus',
            cancelButtonText: "Tidak, batalkan",
            showLoaderOnConfirm: true,
            customClass: 'animated tada',
            preConfirm: function() {
                return new Promise(function(resolve) {
                    $.ajax({
                        url: "<?php echo base_url('admin/produk/hapus_produk');?>",
                        method: 'POST',
                        data: {
                            kode_produk:kode_produk,
                            gambar_produk:gambar_produk
                        },                
                    })
                    .done(function(response) {
                        load_data_produk();
                        $('#modal_produk').modal('hide');
                        Swal.fire({
                            title: 'Data Berhasil Dihapus',
                            icon: 'success',
                            showConfirmButton: true,
                            confirmButtonColor: '#007bff',
                        })
                    })
                    .fail(function() {
                        Swal.fire({
                            title: 'Terjadi Kesalahan',
                            icon: 'error',
                            showConfirmButton: true,
                            confirmButtonColor: '#007bff',
                        })
                    });
                });
            },
        });
    });  
</script>

</body>
</html>