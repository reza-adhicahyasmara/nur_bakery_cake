<?php $this->load->view('frontend/partials/head.php') ?>

<main id="main">
    <section id="breadcrumbs" class="breadcrumbs" style="margin-top: 80px">

    </section>

    <section class="inner-page">
        <div class="container">
            <div class="card">
                <div class="card-body ">
                    <form role="form" id="form_konsumen" method="post">
                        <div class="row justify-content-center p-3">
                            <div class="col-md-6 col-sm-6 col-12">
                                <div class="mb-5">
                                    <div class="mb-3 d-flex justify-content-center">
                                         <div class="form-group mb-3 text-center">
                                            <label class="btn" for="foto_konsumen">
                                                <div class="form-control" style="padding: 0px; width:180px; height: 180px; border-radius: 50%;">
                                                    <?php if($data_konsumen['foto_konsumen'] != "") { ?>
                                                        <img id="blah" src="<?php echo base_url('assets/img/konsumen/'.$data_konsumen['foto_konsumen']);?>" class="product-image" alt="Gambar" style="border-radius: 50%; width:180px; height:180px; object-fit: cover; ">  
                                                    <?php }else{ ?>
                                                        <img id="blah" src="<?php echo base_url('assets/img/banner/user_solid.png');?>" class="product-image" alt="Gambar" style="border-radius: 50%; width:180px; height:180px; object-fit: cover; ">  
                                                    <?php } ?> 
                                                </div>
                                                <input class="text" accept="image/*" type="file" id="foto_konsumen" name="file" style="display: none;" />
                                                <input class="text" type="text" id="foto_konsumen_lama" name="foto_konsumen_lama" value="<?php echo $data_konsumen['foto_konsumen']; ?>" style="display: none;" />
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="hidden" class="form-control" name="id_konsumen" id="id_konsumen" value="<?php echo $data_konsumen['id_konsumen']; ?>" placeholder="Contoh: Budi">
                                        <input type="text" class="form-control" name="nama_konsumen" id="nama_konsumen" value="<?php echo $data_konsumen['nama_konsumen']; ?>" onkeypress="return /[a-z A-Z]/i.test(event.key)" placeholder="Contoh: Budi">
                                        <label for="nama_konsumen">Nama Lengkap</label>
                                    </div> 
                                </div>


                                <div class="mb-5">
                                    <h4 class="sidebar-title">Data Kontak</h4>    
                                    <div class="form-floating mb-3">
                                        <input type="email" class="form-control" name="email_konsumen_baru" id="email_konsumen_baru" value="<?php echo $data_konsumen['email_konsumen']; ?>" placeholder="Contoh: budi@adutama.com">
                                        <input type="hidden" class="form-control" name="email_konsumen_lama" id="email_konsumen_lama" value="<?php echo $data_konsumen['email_konsumen']; ?>" placeholder="Contoh: budi@adutama.com">
                                        <label for="email_konsumen_baru">Email</label>  
                                    </div>
                                    <div class="form-floating mb-5">
                                        <input type="text" class="form-control" name="kontak_konsumen_baru" id="kontak_konsumen_baru" value="<?php echo $data_konsumen['kontak_konsumen']; ?>" minlength="11" maxlength="13"  onkeypress="return /[0-9]/i.test(event.key)" placeholder="Contoh: 08XXXXXXXXXX">
                                        <input type="hidden" class="form-control" name="kontak_konsumen_lama" id="kontak_konsumen_lama" value="<?php echo $data_konsumen['kontak_konsumen']; ?>" minlength="11" maxlength="13"  onkeypress="return /[0-9]/i.test(event.key)" placeholder="Contoh: 08XXXXXXXXXX">
                                        <label for="kontak_konsumen_baru">No. Handphone</label>  
                                    </div>  
                                </div>
                                <div class="mb-5">
                                    <h4 class="sidebar-title">Data Alamat</h4>
                                    <?php $alamat_konsumen = explode("-",$data_konsumen['alamat_konsumen']);?>  
                                    <div class="form-floating mb-3">
                                        <select type="text" class="form-control kode_provinsi" name="kode_provinsi" id="kode_provinsi" placeholder="Contoh: Kuningan">
                                            <option value="">Pilih</option>
                                            <?php foreach($provinsi->result() as $row){ ?>
                                                <option value="<?php echo $row->kode_provinsi; ?>" <?php if($row->kode_provinsi == $data_konsumen['kode_provinsi']){echo "selected";}?>><?php echo $row->nama_provinsi; ?></option>
                                            <?php } ?> 
                                        </select>
                                        <label for="kode_provinsi">Provinsi</label>  
                                    </div>
                                    <div class="form-floating mb-3">
                                        <select type="text" class="form-control kode_kabupaten" name="kode_kabupaten" id="kode_kabupaten" placeholder="Contoh: Kuningan">
                                            <?php foreach($kabupaten->result() as $row){ ?>
                                                <option value="<?php echo $row->kode_kabupaten; ?>" <?php if($row->kode_kabupaten == $data_konsumen['kode_kabupaten']){echo "selected";}?>><?php echo $row->nama_kabupaten; ?></option>
                                            <?php } ?>
                                        </select>
                                        <label for="kode_kabupaten">Kabuputen / Kota</label>  
                                    </div>
                                    <div class="form-floating mb-3">
                                        <select type="text" class="form-control kode_kecamatan" name="kode_kecamatan" id="kode_kecamatan" placeholder="Contoh: Kuningan">
                                            <?php foreach($kecamatan->result() as $row){ ?>
                                                <option value="<?php echo $row->kode_kecamatan; ?>" <?php if($row->kode_kecamatan == $data_konsumen['kode_kecamatan']){echo "selected";}?>><?php echo $row->nama_kecamatan; ?></option>
                                            <?php } ?>
                                        </select>
                                        <label for="kode_kecamatan">Kecamatan</label>  
                                    </div>
                                    <div class="form-floating mb-3">
                                        <select type="text" class="form-control kode_desa " name="kode_desa" id="kode_desa" placeholder="Contoh: Kuningan">
                                            <?php foreach($desa->result() as $row){ ?>
                                                <option value="<?php echo $row->kode_desa; ?>" <?php if($row->kode_desa == $data_konsumen['kode_desa']){echo "selected";}?>><?php echo $row->nama_desa; ?></option>
                                            <?php } ?>
                                        </select>
                                        <label for="kode_desa">Desa / Kelurahan</label>  
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4 col-md-6 col-12">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" name="rt" id="rt" value="<?php echo $alamat_konsumen[1]; ?>" maxlength="2" onkeypress="return /[0-9]/i.test(event.key)" placeholder="Contoh: 001">
                                                <label for="rt">RT</label>  
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6 col-12">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" name="rw" id="rw" value="<?php echo $alamat_konsumen[2]; ?>" maxlength="2" onkeypress="return /[0-9]/i.test(event.key)" placeholder="Contoh: 002">
                                                <label for="rw">RW</label>  
                                            </div>    
                                        </div>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <textarea type="text" class="form-control" name="alamat" id="alamat" rows="3" placeholder="Jalan, Dusun, Blok" style="height: 40%"><?php echo $alamat_konsumen[0]; ?></textarea>
                                        <label for="alamat">Jalan / Gang / Dusun / Blok</label>  
                                    </div> 
                                    <div class="mb-3">
                                        <button type="submit" class="btn btn-warning rounded-pill" id="simpan_konsumen" style="width:100%">Simpan</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</main>

<?php $this->load->view('frontend/partials/footer.php') ?>
<?php $this->load->view('frontend/partials/script.php') ?>

<!-----------------------FUNGSI LAIN----------------------->
<script>
    $(document).ready(function() {  
        $("#profil_konsumen").addClass("active");
        $("#topbar").removeClass("topbar-transparent");
        $("#header").removeClass("header-transparent");
    });
    
	foto_konsumen.onchange = evt => {
		const [file] = foto_konsumen.files
		if (file) {
			blah.src = URL.createObjectURL(file)
		}
	}
</script>

<!-----------------------SELECT OPTION WILAYAH----------------------->
<script>
    
    $("#kode_provinsi").change(function() {
        select_kabupaten();
    });   

    select_kabupaten();
    function select_kabupaten() {
        var kode_provinsi = $('.kode_provinsi').val();
        var kode_kabupaten = <?php echo $data_konsumen['kode_kabupaten']; ?>;
        $.ajax({
            url : '<?php echo base_url('home/select_kabupaten'); ?>',
            method: 'POST',
            data: {kode_provinsi:kode_provinsi},
            async : false,
            dataType : 'json',
            success: function(data){
                event.preventDefault();

                var html = '';
                var i;
                for(i=0; i<data.length; i++){
                    html += '<option value="'+data[i].kode_kabupaten+'"';
                    if(data[i].kode_kabupaten == kode_kabupaten){ html += 'selected' };
                    html += '>'+data[i].nama_kabupaten+'</option>';
                }
                $('#kode_kabupaten').html(html);
            }
        });  
        
        select_kecamatan();   
        select_desa();
    }    
 
    $("#kode_kabupaten").change(function() {
        select_kecamatan();
    });   
    
    select_kecamatan();
    function select_kecamatan(){
        var kode_kabupaten = $('.kode_kabupaten').val();
        var kode_kecamatan = <?php echo $data_konsumen['kode_kecamatan']; ?>;
        $.ajax({
            url : '<?php echo base_url('home/select_kecamatan'); ?>',
            method: 'POST',
            data: {kode_kabupaten:kode_kabupaten},
            async : false,
            dataType : 'json',
            success: function(data){
                event.preventDefault();
                
                var html = '';
                var i;
                for(i=0; i<data.length; i++){
                    html += '<option value="'+data[i].kode_kecamatan+'"';
                    if(data[i].kode_kecamatan == kode_kecamatan){ html += 'selected' };
                    html += '>'+data[i].nama_kecamatan+'</option>';
                }
                $('#kode_kecamatan').html(html);
            }
        }); 
        
        select_desa();
    } 

    
 
    $("#kode_kecamatan").change(function() {
        select_desa();
    });   
    
    select_desa();
    function select_desa(){
        var kode_kecamatan = $('.kode_kecamatan').val();
        var kode_desa = <?php echo $data_konsumen['kode_desa']; ?>;
        $.ajax({
            url : '<?php echo base_url('home/select_desa'); ?>',
            method: 'POST',
            data: {kode_kecamatan:kode_kecamatan},
            async : false,
            dataType : 'json',
            success: function(data){
                event.preventDefault();

                var html = '';
                var i;
                for(i=0; i<data.length; i++){
                    html += '<option value="'+data[i].kode_desa+'"';
                    if(data[i].kode_desa == kode_desa){ html += 'selected' };
                    html += '>'+data[i].nama_desa+'</option>';
                }
                $('#kode_desa').html(html);
            }
        });
    }     
</script>

<!-----------------------EDIT----------------------->
<script>
    $(document).on('click', '#simpan_konsumen', function(e) {
        $('#form_konsumen').validate({
            rules: {
                nama_konsumen: { required: true },
                jenis_kelamin_konsumen: { required: true },
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
            },
            messages: {
                nama_konsumen: { required: "Harus diisi" },
                jenis_kelamin_konsumen: { required: "Harus diisi" },
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
                $("#form_konsumen").load('submit', function(e){
                    $.ajax({
                        url : '<?php echo base_url('home/edit_konsumen'); ?>',
                        method: 'POST',
                        data: new FormData(this),
                        contentType: false,
                        cache: false,
                        processData:false, 
                        success: function(response){
                        $("#simpan_konsumen").attr("disabled", false);
                        if(response==1){ 
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: 'Data telah diedit',
                                showConfirmButton: true,
                                confirmButtonColor: '#007bff',
                                timer: 3000
                            }).then(function(){
                                window.location.replace("<?php echo base_url('home'); ?>");
                            });
                            }else{
                                Swal.fire({
                                    icon: 'warning',
                                    title: 'Gagal!',
                                    text: response,
                                    showConfirmButton: true,
                                    confirmButtonColor: '#007bff',
                                    timer: 3000
                                });
                            }
                        }
                    });
                });
            }
        });
    });
</script>