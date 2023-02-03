<?php $this->load->view('backend/partials/head.php') ?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="m-1 text-dark"><span class="nav-icon bx bx-fw bxs-bookmarks"></span>Kategori Produk</h1>
                </div>
                <div class="col-sm-6 float-sm-right">
                    <ol class="breadcrumb float-sm-right m-2">
                        <a type="button" class="btn bg-warning"  id="btn_tambah_kategori"><span class="bx bx-fw bx-plus"></span> Tambah Data</a>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <div id="content_kategori">
                        <!--LOAD DATA-->
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<form role="form" id="form_kategori" method="post">
    <div id="modal_kategori" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
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
                    <button type="submit" class="btn bg-warning" id="btn_simpan_kategori"><span class="bx bx-fw bx-save"></span> Simpan</button>
                </div>
            </div>
        </div>
    </div>
</form>

<?php $this->load->view('backend/partials/footer.php') ?>
<?php $this->load->view('backend/partials/script.php') ?>

<!-----------------------FUNGSI----------------------->
<script type="text/javascript">
    var url_kategori =  "<?php echo base_url('admin/kategori_produk'); ?>";
    var url = url_kategori ;
    $('ul.nav-sidebar a').filter(function() {
        return this.href == url;
    }).addClass('active ');
    $('ul.nav-treeview a').filter(function() {
        return this.href == url;
    }).parentsUntil(".nav-sidebar > .nav-treeview").addClass('menu-open').prev('a').addClass('active');
</script>


<script type="text/javascript">
    load_data_kategori();
	function load_data_kategori(){
		$.ajax({
			method : "GET",
			url : "<?php echo base_url('admin/kategori_produk/load_data_kategori'); ?>",
			beforeSend : function(){
				$('#content_kategori').html('<div style="text-align:center"><i class="bx bx-loader-alt bx-md bx-spin" style="margin-top: 30px; margin-bottom: 30px;" aria-hidden="true"></i></div>');
			},
			success : function(response){
				$('#content_kategori').html(response);
			}
		});
    };

    $('#btn_tambah_kategori').on("click",function(){
        var url = "<?php echo base_url('admin/kategori_produk/form_tambah_kategori'); ?>";

        $('#modal_kategori').modal('show');
        $('.modal-title').text('Tambah Kategori Produk');
        $('.modal-body').load(url);
    });

    $(document).on('click', '.btn_edit_kategori', function(e) {
        var kode_kategori=$(this).attr("kode_kategori");
        var url = "<?php echo base_url('admin/kategori_produk/form_edit_kategori'); ?>";

        $('#modal_kategori').modal('show');
        $('.modal-title').text('Edit Kategori Produk');
        $('.modal-body').load(url,{kode_kategori : kode_kategori});
    });  
    
    $(document).ready(function() {
        $('#btn_simpan_kategori').on("click",function(){
            $('#form_kategori').validate({
                rules: {
                    nama_kategori: { required: true },
                },
                messages: {
                    nama_kategori: { required: "Harus diisi" },
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
                    $.ajax({
                        url : '<?php echo base_url('admin/kategori_produk/tambah_edit_kategori'); ?>',
                        method: 'POST',
                        data : $('#form_kategori').serialize(),
                        success: function(response){
                            if(response==1){
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil Disimpan!',
                                    showConfirmButton: true,
                                    confirmButtonColor: '#ffc107',
                                    timer: 3000
                                }).then(function(){
                                    load_data_kategori();
                                    $('#modal_kategori').modal('hide');
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
                }
            });  
        });
    });
    
    $(document).on('click', '.btn_hapus_kategori', function() {
        var kode_kategori=$(this).attr("kode_kategori");
        var nama_kategori=$(this).attr("nama_kategori");
        Swal.fire({
            title: 'Apakah anda yakin?',
            text: 'Akan menghapus data" ' + nama_kategori + '"!',
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
                        url: "<?php echo base_url('admin/kategori_produk/hapus_kategori');?>",
                        method: 'POST',
                        data: {
                            kode_kategori:kode_kategori
                        },                
                    })
                    .done(function(response) {
                        load_data_kategori();
                        $('#modal_kategori').modal('hide');
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