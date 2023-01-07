<?php $this->load->view('backend/partials/head.php') ?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="m-1 text-dark"><span class="nav-icon bx bx-fw bxs-cog"></span>Pengaturan</h1>
                </div>
                <div class="col-sm-6 float-sm-right">
                    <ol class="breadcrumb float-sm-right m-2">
                        <span class="breadcrumb-item"><a href="<?php echo base_url('admin/dashboard'); ?>">Dashboard</a></span>
                        <span class="breadcrumb-item active">Pengaturan</span>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row justify-content-between">
                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="card">
                        <div class="card-body">
                            <form role="form" id="form_pengaturan" method="post">
                                <h4>Rekening Bank / E-Money</h4>
                                <small>Rekening penerima untuk pembayaran transfer</small>
                                <hr>
                                <h5>Rekening ke 1</h5>
                                <div class="row justify-content-center">
                                    <?php $rek1_pengaturan = explode("-", $edit['rek1_pengaturan']); ?>
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-12">
                                        <div class="mb-3">
                                            <div class="form-group">
                                                <label>No. Rekening / No. Akun</label>
                                                <input type="text" class="form-control" name="no1" id="no1" value="<?php echo $rek1_pengaturan[0]; ?>" onkeypress="return /[0-9]/i.test(event.key)" placeholder="Nomer">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-12">
                                        <div class="mb-3">
                                            <div class="form-group">
                                                <label>Atas Nama</label>
                                                <input type="text" class="form-control" name="an1" id="an1" value="<?php echo $rek1_pengaturan[1]; ?>" placeholder="Atas nama">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-12">
                                        <div class="mb-3">
                                            <div class="form-group">
                                                <label>Perusahaan Finance</label>
                                                <input type="text" class="form-control" name="fin1" id="fin1" value="<?php echo $rek1_pengaturan[2]; ?>" placeholder="Nama Perusahaan Pembayaran">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <h5>Rekening ke 2</h5>
                                <div class="row justify-content-center">
                                    <?php $rek1_pengaturan = explode("-", $edit['rek2_pengaturan']); ?>
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-12">
                                        <div class="mb-3">
                                            <div class="form-group">
                                                <label>No. Rekening / No. Akun</label>
                                                <input type="text" class="form-control" name="no2" id="no2" value="<?php echo $rek1_pengaturan[0]; ?>" onkeypress="return /[0-9]/i.test(event.key)" placeholder="Nomer">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-12">
                                        <div class="mb-3">
                                            <div class="form-group">
                                                <label>Atas Nama</label>
                                                <input type="text" class="form-control" name="an2" id="an2" value="<?php echo $rek1_pengaturan[1]; ?>" placeholder="Atas nama">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-12">
                                        <div class="mb-3">
                                            <div class="form-group">
                                                <label>Perusahaan Finance</label>
                                                <input type="text" class="form-control" name="fin2" id="fin2" value="<?php echo $rek1_pengaturan[2]; ?>" placeholder="Nama Perusahaan Pembayaran">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <h5>Rekening ke 3</h5>
                                <div class="row justify-content-center">
                                    <?php $rek1_pengaturan = explode("-", $edit['rek3_pengaturan']); ?>
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-12">
                                        <div class="mb-3">
                                            <div class="form-group">
                                                <label>No. Rekening / No. Akun</label>
                                                <input type="text" class="form-control" name="no3" id="no3" value="<?php echo $rek1_pengaturan[0]; ?>" onkeypress="return /[0-9]/i.test(event.key)" placeholder="Nomer">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-12">
                                        <div class="mb-3">
                                            <div class="form-group">
                                                <label>Atas Nama</label>
                                                <input type="text" class="form-control" name="an3" id="an3" value="<?php echo $rek1_pengaturan[1]; ?>" placeholder="Atas nama">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-12">
                                        <div class="mb-3">
                                            <div class="form-group">
                                                <label>Perusahaan Finance</label>
                                                <input type="text" class="form-control" name="fin3" id="fin3" value="<?php echo $rek1_pengaturan[2]; ?>" placeholder="Nama Perusahaan Pembayaran">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <h5>Rekening ke 4</h5>
                                <div class="row justify-content-center">
                                    <?php $rek1_pengaturan = explode("-", $edit['rek4_pengaturan']); ?>
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-12">
                                        <div class="mb-3">
                                            <div class="form-group">
                                                <label>No. Rekening / No. Akun</label>
                                                <input type="text" class="form-control" name="no4" id="no4" value="<?php echo $rek1_pengaturan[0]; ?>" onkeypress="return /[0-9]/i.test(event.key)" placeholder="Nomer">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-12">
                                        <div class="mb-3">
                                            <div class="form-group">
                                                <label>Atas Nama</label>
                                                <input type="text" class="form-control" name="an4" id="an4" value="<?php echo $rek1_pengaturan[1]; ?>" placeholder="Atas nama">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-12">
                                        <div class="mb-3">
                                            <div class="form-group">
                                                <label>Perusahaan Finance</label>
                                                <input type="text" class="form-control" name="fin4" id="fin4" value="<?php echo $rek1_pengaturan[2]; ?>" placeholder="Nama Perusahaan Pembayaran">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="float-right">
                                    <button type="submit" class="btn bg-warning" id="btn_simpan_pengaturan">Simpan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                
                            
                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4>Biaya Ongkos Kirim</h4>
                            <small>Pengaturan tarif harga pesan antar setiap kecamatan.</small>
                            <hr>
                            <div class="mb-3">
                                <div class="form-group">
                                    <label>Pilih Kabupaten</label>
                                     <select type="text" class="form-control" name="kode_kabupaten" id="kode_kabupaten" placeholder="Contoh: Kuningan">
                                        <?php foreach($data_kabupaten as $row){
                                            if($row->kode_kabupaten == '3208' || $row->kode_kabupaten == '3209' || $row->kode_kabupaten == '3210' || $row->kode_kabupaten == '3274'){
                                        ?>
                                            <option value="<?php echo $row->kode_kabupaten; ?>"><?php echo $row->nama_kabupaten; ?></option>
                                        <?php } } ?> 
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div id="content_kecamatan">
                                    <!--LOAD DATA-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<form role="form" id="form_kecamatan" method="post">
    <div id="modal_kecamatan" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
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
                    <button type="submit" class="btn bg-warning" id="btn_simpan_kecamatan"><span class="bx bx-fw bx-save"></span> Simpan</button>
                </div>
            </div>
        </div>
    </div>
</form>


<?php $this->load->view('backend/partials/footer.php') ?>
<?php $this->load->view('backend/partials/script.php') ?>

<!-----------------------FUNGSI----------------------->
<script type="text/javascript">
    var url_pengaturan =  "<?php echo base_url('admin/pengaturan'); ?>";
    var url = url_pengaturan ;
    $('ul.nav-sidebar a').filter(function() {
        return this.href == url;
    }).addClass('active ');
    $('ul.nav-treeview a').filter(function() {
        return this.href == url;
    }).parentsUntil(".nav-sidebar > .nav-treeview").addClass('menu-open').prev('a').addClass('active');
</script>

<!-----------------------REKENING BANK----------------------->
<script type="text/javascript">
    
    $(document).ready(function() {
        $('#btn_simpan_pengaturan').on("click",function(e){
            $('#form_pengaturan').validate({
                rules: {

                    no1: { required: true },
                    an1: { required: true },
                    fin1: { required: true },
                    no2: { required: true },
                    an2: { required: true },
                    fin2: { required: true },
                    no3: { required: true },
                    an3: { required: true },
                    fin3: { required: true },
                    no4: { required: true },
                    an4: { required: true },
                    fin4: { required: true },
                },
                messages: {

                    no1: { required: "Harus diisi" },
                    an1: { required: "Harus diisi" },
                    fin1: { required: "Harus diisi" },
                    no2: { required: "Harus diisi" },
                    an2: { required: "Harus diisi" },
                    fin2: { required: "Harus diisi" },
                    no3: { required: "Harus diisi" },
                    an3: { required: "Harus diisi" },
                    fin3: { required: "Harus diisi" },
                    no4: { required: "Harus diisi" },
                    an4: { required: "Harus diisi" },
                    fin4: { required: "Harus diisi" },
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
                    $("#form_pengaturan").load('submit', function(e){
                        $.ajax({
                            url : '<?php echo base_url('admin/pengaturan/edit_pengaturan'); ?>',
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
                                        location.reload();
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
</script>

<!-----------------------REKENING ONGKOS KECAMATAN----------------------->
<script type="text/javascript">
    load_data_kecamatan()
    function load_data_kecamatan(){
        var kode_kabupaten = $('#kode_kabupaten').val();
		$.ajax({
			url : "<?php echo base_url('admin/pengaturan/load_data_kecamatan'); ?>",
            method: 'POST',
            data: {kode_kabupaten:kode_kabupaten},
			beforeSend : function(){
				$('#content_kecamatan').html('<div style="text-align:center"><i class="bx bx-loader-alt bx-md bx-spin" style="margin-top: 30px; margin-bottom: 30px;" aria-hidden="true"></i></div>');
			},
			success : function(response){
				$('#content_kecamatan').html(response);
			}
		});
    };

    $("#kode_kabupaten").change(function() {
        load_data_kecamatan()
    });   

    $(document).on('click', '.btn_edit_kecamatan', function(e) {
        var kode_kecamatan=$(this).attr("kode_kecamatan");
        var nama_kecamatan=$(this).attr("nama_kecamatan");
        var ongkos_kecamatan=$(this).attr("ongkos_kecamatan");
        var url = "<?php echo base_url('admin/pengaturan/form_edit_kecamatan'); ?>";

        $('#modal_kecamatan').modal('show');
        $('.modal-title').text('Edit Ongkos Kirim ' + nama_kecamatan);
        $('.modal-body').load(url,{kode_kecamatan : kode_kecamatan, ongkos_kecamatan : ongkos_kecamatan});
    });  
    
    $(document).ready(function() {
        $('#btn_simpan_kecamatan').on("click",function(){
            $('#form_kecamatan').validate({
                rules: {
                    ongkos_kecamatan: { required: true },
                },
                messages: {
                    ongkos_kecamatan: { required: "Harus diisi" },
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
                        url : '<?php echo base_url('admin/pengaturan/edit_kecamatan'); ?>',
                        method: 'POST',
                        data : $('#form_kecamatan').serialize(),
                        success: function(response){
                            if(response==1){
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil Disimpan!',
                                    showConfirmButton: true,
                                    confirmButtonColor: '#ffc107',
                                    timer: 3000
                                }).then(function(){
                                    load_data_kecamatan();
                                    $('#modal_kecamatan').modal('hide');
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
</script>

</body>
</html>