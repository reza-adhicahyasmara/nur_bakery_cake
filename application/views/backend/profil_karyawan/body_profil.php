<?php $this->load->view('backend/partials/head.php') ?>

<form role="form" id="form_karyawan" method="post">
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"><span class="nav-icon bx bx-fw bx-user"></span>Profil</h1>
                </div>
                <div class="col-sm-6 float-sm-right">
                    <ol class="breadcrumb float-sm-right m-2">
                        <span class="breadcrumb-item"><a href="<?php echo base_url($this->session->userdata('ses_akses').'/dashboard'); ?>">Dashboard</a></span>
                        <span class="breadcrumb-item active">Profil</span>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    
    <section class="content">
        <div class="container-fluid">
            <div class="row justify-content-md-center">
                <div class="col-lg-4 col-12">
                    <div class="card card-outline">
                        <div class="card-body">
                            <input type="hidden" id="jenis" value="Edit">
                            <?php foreach($edit->result() as $edit) { ?>
                            <div class="form-group">
                                <div class="d-flex justify-content-center">
                                    <label class="btn" for="foto_karyawan">
                                        <div class="form-control" style="border-radius: 50%; padding: 0px; width:180px; height: 180px;">
                                            <?php if($edit->foto_karyawan != "") { ?>
                                                <img id="blah" src="<?php echo base_url('assets/img/karyawan/'.$edit->foto_karyawan);?>" class="product-image" alt="Gambar Profil" style="border-radius: 50%; width:180px; height:180px; object-fit: cover; ">  
                                            <?php }else{ ?>
                                                <img id="blah" src="<?php echo base_url('assets/img/banner/user_solid.png');?>" class="product-image" alt="Gambar Profil" style="border-radius: 50%; width:180px; height:180px; object-fit: cover; ">  
                                            <?php } ?> 
                                        </div>
                                        <input class="text" accept="image/*" type="file" id="foto_karyawan" name="file" style="display: none;" />
                                        <input class="text" type="text" id="foto_karyawan_lama" name="foto_karyawan_lama" value="<?php echo $edit->foto_karyawan; ?>" style="display: none;" />
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>ID</label>
                                <input type="hidden" class="form-control" name="level_karyawan" id="level_karyawan" value="admin">
                                <input type="text" class="form-control" name="id_karyawan" id="id_karyawan" value="<?php echo $edit->id_karyawan; ?>" placeholder="NIK" readonly>
                            </div>
                            <div class="form-group">
                                <label>Nama Lengkap</label>
                                <input type="text" class="form-control" name="nama_karyawan" id="nama_karyawan" value="<?php echo $edit->nama_karyawan; ?>" placeholder="Nama Lengkap">
                            </div>
                            <div class="form-group">
                                <label>Alamat</label>
                                <textarea type="text" class="form-control" name="alamat_karyawan" id="alamat_karyawan" placeholder="Alamat" style="height:100px;"><?php echo $edit->alamat_karyawan; ?></textarea>
                            </div>
                            <div class="form-group">
                                <label>No. Telepon / HP</label>
                                <input type="text" class="form-control" name="kontak_karyawan" id="kontak_karyawan" value="<?php echo $edit->kontak_karyawan; ?>" placeholder="No. Telepon / HP">
                            </div>
                            <div class="form-group">
                                <label>Username</label>
                                <input type="hidden" class="form-control" name="username_karyawan_lama" id="username_karyawan_lama" value="<?php echo $edit->username_karyawan; ?>" placeholder="Username">
                                <input type="text" class="form-control" name="username_karyawan_baru" id="username_karyawan_baru" value="<?php echo $edit->username_karyawan; ?>" placeholder="Username">
                            </div>
                            </br>
                            <div class="form-group" style="text-align:center">
                                <button type="submit" class="btn btn-warning" id="btn_simpan_karyawan" style="margin-right:5px"><i class="bx bx-fw bx-save"></i> Simpan</button>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php $this->load->view('backend/partials/footer.php') ?>
<?php $this->load->view('backend/partials/script.php') ?>

</form>
<!-----------------------FUNGSI----------------------->
<script type="text/javascript">
       
    var url = window.location;
    $('ul.nav-sidebar a').filter(function() {
        return this.href == url;
    }).addClass('active ');
    $('ul.nav-treeview a').filter(function() {
        return this.href == url;
    }).parentsUntil(".nav-sidebar > .nav-treeview").addClass('menu-open').prev('a').addClass('active');

	foto_karyawan.onchange = evt => {
		const [file] = foto_karyawan.files
		if (file) {
			blah.src = URL.createObjectURL(file)
		}
	}
</script>


<script type="text/javascript">
    $(document).ready(function() {
        $('#btn_simpan_karyawan').on("click",function(e){
            $('#form_karyawan').validate({
                rules: {
                    id_karyawan: {
                        required: true,
                    },
                    nama_karyawan: {
                        required: true,
                    },
                    alamat_karyawan: {
                        required: true,
                    },
                    kontak_karyawan: {
                        required: true,
                        minlength: 11,
                        maxlength: 15,

                    },
                    password_karyawan: {
                        required: true,
                        minlength: 5,
                    },
                    username_karyawan_baru: {
                        required: true,
                        minlength: 5,
                    },
                },
                messages: {
                    id_karyawan: {
                        required: "ID harus diisi",
                    },
                    nama_karyawan: {
                        required: "Nama harus diisi",
                    },
                    alamat_karyawan: {
                        required: "Alamat harus diisi",
                    },
                    kontak_karyawan: {
                        required: "Mo. Telepon / HP harus diisi",
                        minlength: "Minimal 11 karakter",
                        maxlength: "Maksimal 15 karakter",
                    },
                    password_karyawan: {
                        required: "Pasword harus diisi",
                        minlength: "Minimal 5 karakter",
                    },
                    username_karyawan_baru: {
                        required: "Username harus diisi",
                        minlength: "Minimal 5 karakter",
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
                    $("#form_karyawan").on('submit', function(e){
                        $.ajax({
                            url : '<?php echo base_url('profil_karyawan/edit_karyawan'); ?>',
                            method: 'POST',
                            data: new FormData(this),
                            contentType: false,
                            cache: false,
                            processData:false, 
                            success: function(response){
                                if(response==1){
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Berhasil!',
                                        text: 'Data telah diedit',
                                        showConfirmButton: true,
                                        confirmButtonColor: '##007bff',
                                        timer: 3000
                                    }).then(function(){
                                        window.location.replace("<?php echo base_url('login/logout'); ?>");
                                    });
                                }else{
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Gagal!',
                                        text: response,
                                        showConfirmButton: true,
                                        confirmButtonColor: '##007bff',
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

</body>
</html>