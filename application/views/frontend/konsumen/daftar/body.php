<?php $this->load->view('frontend/partials/head.php') ?>

<main id="main">
    <section class="breadcrumbs">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <h2><img src="<?php echo base_url('assets/img/banner/undraw_forms.svg')?>" style="height: 300px; object-fit: cover;"></h2>
                <ol>
                    <li><h1>Formulir Pendaftaran</h1></li>
                </ol>
            </div>
        </div>
    </section>

    <section class="inner-page">
        <div class="container">
            <form role="form" id="form_daftar" method="post">
                <div class="row justify-content-center">
                    <div class="col-md-6 col-sm-6 col-12">
                        <div class="mb-3">
                            <div class="d-flex justify-content-center">
                                <div class="form-group mb-3 text-center">
                                    <label class="btn" for="foto_konsumen">
                                        <div class="form-control" style="padding: 0px; width:180px; height: 180px; border-radius: 50%;">
                                            <img id="blah" src="<?php echo base_url('assets/img/banner/user.svg');?>" class="product-image" alt="Gambar" style="border-radius: 50%; width:180px; height:180px; object-fit: cover;">  
                                        </div>
                                        <input class="hidden" accept="image/*" type="file" id="foto_konsumen" name="file" style="display: none;" />
                                    </label>
                                </div>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="nama_konsumen" id="nama_konsumen" onkeypress="return /[a-z A-Z]/i.test(event.key)" placeholder="Contoh: Budi">
                                <label for="nama_konsumen">Nama Lengkap</label>
                            </div> 
                        </div> 
                        <br>
                        <div class="mb-3">
                            <h4 class="sidebar-title">Data Alamat</h4>
                            <div class="mb-3">
                                <small>Hanya tersedia 3 wilayah (Kuningan, Majalengka, dan Cirebon)</small>
                            </div>
                            <div class="form-floating mb-3">
                                <select type="text" class="form-control kode_provinsi" name="kode_provinsi" id="kode_provinsi" placeholder="Contoh: Kuningan">
                                    <option value="">Pilih</option>
                                    <?php foreach($provinsi->result() as $row){
                                        if($row->kode_provinsi == '32'){
                                    ?>
                                        <option value="<?php echo $row->kode_provinsi; ?>"><?php echo $row->nama_provinsi; ?></option>
                                    <?php } } ?> 
                                </select>
                                <label for="kode_provinsi">Provinsi</label>  
                            </div>
                            <div class="form-floating mb-3">
                                <select type="text" class="form-control kode_kabupaten" name="kode_kabupaten" id="kode_kabupaten" placeholder="Contoh: Kuningan"></select>
                                <label for="kode_kabupaten">Kabuputen / Kota</label>  
                            </div>
                            <div class="form-floating mb-3">
                                <select type="text" class="form-control kode_kecamatan" name="kode_kecamatan" id="kode_kecamatan" placeholder="Contoh: Kuningan"></select>
                                <label for="kode_kecamatan">Kecamatan</label>  
                            </div>
                            <div class="form-floating mb-3">
                                <select type="text" class="form-control kode_desa " name="kode_desa" id="kode_desa" placeholder="Contoh: Kuningan"></select>
                                <label for="kode_desa">Desa / Kelurahan</label>  
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-md-6 col-12">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" name="rt" id="rt" maxlength="2" onkeypress="return /[0-9]/i.test(event.key)" placeholder="Contoh: 01">
                                        <label for="rt">RT</label>  
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-12">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" name="rw" id="rw" maxlength="2" onkeypress="return /[0-9]/i.test(event.key)" placeholder="Contoh: 02">
                                        <label for="rw">RW</label>  
                                    </div>    
                                </div>
                            </div>
                            <div class="form-floating mb-3">
                                <textarea type="text" class="form-control" name="alamat" id="alamat" rows="3" placeholder="Jalan, Dusun, Blok"></textarea>
                                <label for="alamat">Jalan / Gang / Dusun / Blok</label>  
                            </div> 
                        </div>
                        <br>
                        <div class="mb-3">
                            <h4 class="sidebar-title">Data Kontak</h4>
                            <div class="form-floating mb-3">
                                <input type="email" class="form-control" name="email_konsumen_daftar" id="email_konsumen_daftar" placeholder="Contoh: budi@adutama.com">
                                <label for="email_konsumen_daftar">Email</label>  
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="kontak_konsumen_daftar" id="kontak_konsumen_daftar" minlength="11" maxlength="13"  onkeypress="return /[0-9]/i.test(event.key)" placeholder="Contoh: 08XXXXXXXXXX">
                                <label for="kontak_konsumen_daftar">No. Handphone</label>  
                            </div>   
                        </div>
                        <br>
                        <div class="mb-3">
                            <h4 class="sidebar-title">Data Akun</h4>
                            <div class="form-floating mb-3">
                                <input type="password" class="form-control" name="password11" id="password11" placeholder="Masukan Password">
                                <label for="password11">Password Baru</label>  
                            </div>
                            <div class="form-floating mb-3"> 
                                <input type="password" class="form-control" name="password22" id="password22" placeholder="Ketik ulang password">
                                <label for="password22">Ketik Ulang Passsword Baru</label> 
                            </div>
                        </div>
                        <br>
                        <div class="mb-3">
                            <button type="submit" id="btn_daftar" class="btn btn-warning rounded-pill btn-block" style="width:100%">Daftar</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
</main>

<?php $this->load->view('frontend/partials/footer.php') ?>
<?php $this->load->view('frontend/partials/script.php') ?>

<!-----------------------FUNGSI----------------------->
<script>
    $(document).ready(function() {
        $("#daftar").addClass("active");
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
                    if(data[i].kode_kabupaten == '3208' || data[i].kode_kabupaten == '3209' || data[i].kode_kabupaten == '3210' || data[i].kode_kabupaten == '3274'){
                        html += '<option value="'+data[i].kode_kabupaten+'">'+data[i].nama_kabupaten+'</option>';
                    }
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
                    html += '<option value="'+data[i].kode_kecamatan+'">'+data[i].nama_kecamatan+'</option>';
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
                    html += '<option value="'+data[i].kode_desa+'">'+data[i].nama_desa+'</option>';
                }
                $('#kode_desa').html(html);
            }
        });
    }     
</script>

<!-----------------------DAFTAR----------------------->
<script>
    $('#btn_daftar').on("click",function(){
        $('#form_daftar').validate({
            rules: {
                nama_konsumen: { required: true },
                kode_provinsi: { required: true },
                kode_kabupaten: { required: true },
                kode_kecamatan: { required: true },
                kode_desa: { required: true },
                rt: { required: true },
                rw: { required: true },
                alamat: { required: true },
                email_konsumen_daftar: { required: true, email: true },
                kontak_konsumen_daftar: { required: true, minlength: 11, maxlength: 13 },
                foto_konsumen: { required: true },
                password11: { required: true, minlength: 5 },
                password22: { required: true, minlength: 5, equalTo: password11, minlength: 5 },
            },
            messages: {
                nama_konsumen: { required: "Harus diisi" },
                kode_provinsi: { required: "Harus diisi" },
                kode_kabupaten: { required: "Harus diisi" },
                kode_kecamatan: { required: "Harus diisi" },
                kode_desa: { required: "Harus diisi" },
                rt: { required: "Garus diisi" },
                rw: { required: "Harus diisi" },
                alamat: { required: "Harus diisi" },
                email_konsumen_daftar: { required: "Harus diisi", email: "Tidak sesui dengan format email" },
                kontak_konsumen_daftar: { required: "Harus diisi", minlength: "Minimal 11 karakter", maxlength: "Maksimal 13 karakter" },
                foto_konsumen: { required: "Harus diisi" },
                password11: { required: "Harus diisi", minlength: "Minimal 5 karakter" },
                password22: { required: "Harus diisi", minlength: "Minimal 5 karakter", equalTo: "Password tidak sama", minlength: "Minimal 5 karakter" },
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
                $("#form_daftar").load('submit', function(e){
                    $.ajax({
                        url : '<?php echo base_url('home/tambah_konsumen'); ?>',
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
                                window.location.replace("<?php echo base_url('home/berhasil'); ?>");
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: response,
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
