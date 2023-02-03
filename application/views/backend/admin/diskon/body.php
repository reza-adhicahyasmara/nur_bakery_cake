<?php $this->load->view('backend/partials/head.php') ?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="m-1 text-dark"><span class="nav-icon bx bx-fw bxs-offer"></span>Diskon</h1>
                </div>
                <div class="col-sm-6 float-sm-right">
                    <ol class="breadcrumb float-sm-right m-2">
                        <a type="button" class="btn bg-warning"  id="btn_tambah_diskon"><span class="bx bx-fw bx-plus"></span> Tambah Data</a>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <div id="content_diskon">
                        <!--LOAD DATA-->
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>


<form role="form" id="form_diskon" method="post">
    <div id="modal_diskon" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-md">
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
                    <button type="submit" id="btn_simpan_diskon" class="btn bg-warning"><span class="bx bx-fw bx-save"></span> Simpan</button>
                </div>
            </div>
        </div>
    </div>
</form>

<?php $this->load->view('backend/partials/footer.php') ?>
<?php $this->load->view('backend/partials/script.php') ?>

<!-----------------------FUNGSI----------------------->
<script type="text/javascript">
    var url_diskon =  "<?php echo base_url('admin/diskon'); ?>";
    var url = url_diskon ;
    $('ul.nav-sidebar a').filter(function() {
        return this.href == url;
    }).addClass('active ');
    $('ul.nav-treeview a').filter(function() {
        return this.href == url;
    }).parentsUntil(".nav-sidebar > .nav-treeview").addClass('menu-open').prev('a').addClass('active');
</script>


<script type="text/javascript">
    load_data_diskon();
	function load_data_diskon(){
		$.ajax({
			method : "GET",
			url : '<?php echo base_url('admin/diskon/load_data_diskon'); ?>',
			beforeSend : function(){
				$('#content_diskon').html('<div style="text-align:center"><i class="bx bx-loader-alt bx-md bx-spin" style="margin-top: 30px; margin-bottom: 30px;" aria-hidden="true"></i></div>');
			},
			success : function(response){
				$('#content_diskon').html(response);
			}
		});
    };

    $('#btn_tambah_diskon').on("click",function(){
        var url = "<?php echo base_url('admin/diskon/form_tambah_diskon'); ?>";

        $('#modal_diskon').modal('show');
        $('.modal-title').text('Tambah Diskon');
        $('.modal-body').load(url);
    });

    $("#btn_simpan_diskon").on("click", function(e) {
        $('#form_diskon').validate({
            rules: {
                file: {
                    required: true,
                },
                nama_diskon: {
                    required: true,
                },
                deskripsi_diskon: {
                    required: true,
                },
                tanggal_awal_diskon: {
                    required: true,
                },
                tanggal_akhir_diskon: {
                    required: true,
                },
            },
            messages: {
                file: {
                    required: "Gambar harus diisi",
                },
                nama_diskon: {
                    required: "Judul harus diisi",
                },
                deskripsi_diskon: {
                    required: "Deskripsi harus diisi",
                },
                tanggal_awal_diskon: {
                    required: "Tanggal harus diisi",
                },
                tanggal_akhir_diskon: {
                    required: "Tanggal harus diisi",
                },
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
                $("form#form_diskon").load('submit', function(e){
                    $.ajax({
                        url : '<?php echo base_url('admin/diskon/tambah_diskon'); ?>',
                        method: 'POST',
                        data: new FormData(this),
                        contentType: false,
                        cache: false,
                        processData:false, 
                        beforeSend : function(){
                            let timerInterval
                            Swal.fire({
                                title: 'Mohon tunggu sebentar sedang memproses',
                                html: '',
                                timer: 5000,
                                timerProgressBar: true,
                                didOpen: () => {
                                    Swal.showLoading()
                                    timerInterval = setInterval(() => {
                                    const content = Swal.getHtmlContainer()
                                    if (content) {
                                        const b = content.querySelector('b')
                                        if (b) {
                                        b.textContent = Swal.getTimerLeft()
                                        }
                                    }
                                    }, 100)
                                },
                                willClose: () => {
                                    clearInterval(timerInterval)
                                }
                            })
                        }, 
                        success: function(response){
                            if(response==1){
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil Disimpan!',
                                    showConfirmButton: true,
                                    confirmButtonColor: '#ffc107',
                                    timer: 3000
                                }).then(function(){
                                    load_data_diskon();
                                    $('#modal_diskon').modal('hide');
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
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
    
    $(document).on('click', '.btn_hapus_diskon', function() {
        var kode_diskon=$(this).attr("kode_diskon");
        var nama_diskon=$(this).attr("nama_diskon");
        var gambar_diskon=$(this).attr("gambar_diskon");
        Swal.fire({
            title: 'Apakah anda yakin?',
            text: 'Akan menghapus data"' + nama_diskon + '"!',
            type: 'warning',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ffc107',
            cancelButtonColor: '#dc3545',
            confirmButtonText: 'Ya, hapus',
            cancelButtonText: "Tidak, batalkan",
            showLoaderOnConfirm: true,
            customClass: 'animated tada',
            preConfirm: function() {
                return new Promise(function(resolve) {
                    $.ajax({
                        url: '<?php echo base_url('admin/diskon/hapus_diskon'); ?>',
                        method: 'POST',
                        data: {
                            kode_diskon:kode_diskon,
                            gambar_diskon:gambar_diskon
                        },                
                    })
                    .done(function(response) {
                        load_data_diskon();
                        $('#modal_diskon').modal('hide');
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