<input type="hidden" name="jenis" id="jenis" value="Edit">
<h5>Gambar Produk</h5>
<div class="d-flex justify-content-center">
    <div class="form-group text-center">
        <label class="btn" for="gambar_produk">
            <div class="form-control" style="padding: 0px; width:180px; height: 180px;">
                <?php if($produk['gambar_produk'] != "") { ?>
                    <img id="blah" src="<?php echo base_url('assets/img/produk/'.$produk['gambar_produk']);?>" class="product-image" alt="Gambar Produk" style="border-radius: 3px; width:180px; height:180px; object-fit: cover; ">  
                <?php }else{ ?>
                    <img id="blah" src="<?php echo base_url('assets/img/banner/bx-cake.svg');?>" class="product-image" alt="Gambar Produk" style="border-radius: 3px; width:180px; height:180px; object-fit: cover; ">  
                <?php } ?> 
            </div>
        </label>
        <input class="text" accept="image/*" type="file" id="gambar_produk" name="file" style="display: none;" />
        <input class="text" type="text" id="gambar_produk_lama" name="gambar_produk_lama" value="<?php echo $produk['gambar_produk']; ?>" style="display: none;" />
    </div>
</div>
<br>
<hr>
<br>
<div class="mb-3">
    <h5>Kode Produk</h5>
    <div class="form-group">
    <label>Kode</label>
            <input type="text" class="form-control" name="kode_produk_baru" id="kode_produk_baru" value="<?php echo $produk['kode_produk'];?>" onkeypress="return /[A-Z-0-9]/i.test(event.key)" placeholder="Contoh: KUE-123">
            <input type="hidden" class="form-control" name="kode_produk_lama" id="kode_produk_lama" value="<?php echo $produk['kode_produk'];?>" onkeypress="return /[A-Z-0-9]/i.test(event.key)" placeholder="Contoh: KUE-123">
        </div>
    </div>
</div>
<div class="mb-3">
    <div class="form-group">
        <label>Nama</label>
        <input type="text" class="form-control" name="nama_produk" id="nama_produk" value="<?php echo $produk['nama_produk'];?>" placeholder="Contoh : Tiramisu Pudding">
    </div>
</div>
<div class="mb-3">
    <div class="form-group">
        <label>Kategori</label>
        <select class="form-control kode_kategori" name="kode_kategori" id="kode_kategori">
            <option value="">Pilih</option>
            <?php foreach($kategori->result() as $row){
                echo '<option value="'.$row->kode_kategori.'"'; if($produk['kode_kategori'] == $row->kode_kategori){echo 'selected'; }; echo'>'.$row->nama_kategori.'</option>';
            } ?> 
        </select>
    </div>
</div>
<div class="mb-3">
    <div class="form-group">
        <label>Bentuk</label>
        <select class="form-control bentuk_produk" name="bentuk_produk" id="bentuk_produk">
            <option value="">Pilih</option>
            <option value="Persegi" <?php if($produk['bentuk_produk'] == "Persegi"){echo "selected";} ?>>Persegi</option>
            <option value="Lingkaran" <?php if($produk['bentuk_produk'] == "Lingkaran"){echo "selected";} ?>>Lingkaran</option>
        </select>
    </div>
</div>
<div class="mb-3">
    <div class="form-group">
        <label>Saran Penyajian</label>
        <input type="text" class="form-control" name="penyajian_produk" id="penyajian_produk" value="<?php echo $produk['penyajian_produk'];?>" placeholder="Contoh : Dikonsumsi terbaik saat dingin">
    </div>
</div>
<div class="mb-3">
    <div class="form-group">
        <label>Penyimpanan</label>
        <input type="text" class="form-control" name="penyimpanan_produk" id="penyimpanan_produk" value="<?php echo $produk['penyimpanan_produk'];?>" placeholder="Contoh : Di kulkas Baik dikonsumsi dalam 3 hari">
    </div>
</div>
<div class="mb-3">
    <div class="form-group">
        <label>Pengemasan</label>
        <input type="text" class="form-control" name="pengemasan_produk" id="pengemasan_produk" value="<?php echo $produk['pengemasan_produk'];?>" placeholder="Contoh : Box Kue Ulang Tahun 20'', tas kue">
    </div>
</div>
<div class="mb-3">
    <div class="form-group">
        <label>Aksesoris</label>
        <input type="text" class="form-control" name="aksesoris_produk" id="aksesoris_produk" value="<?php echo $produk['aksesoris_produk'];?>" placeholder="Contoh : Gift Tag melalui Permintaan, Pita, Gantungan 'Fine Selection'">
    </div>
</div>
<div class="mb-3">
    <div class="form-group">
        <label>Deskripsi Produk</label>
        <textarea class="form-control" name="deskripsi_produk" id="deskripsi_produk" style="height: 100px;"placeholder="Rincian produk"><?php echo $produk['deskripsi_produk'];?></textarea>
    </div>
</div>
<br>
<hr>
<h5>Daftar Ukuran dan Harga</h5>
<ul>
    <li>Jika akan menambahkan varian produk, isi kolom kemudian klik tombol Tambah Varian</li>
    <li>Jika akan mengedit varian produk, klik edit pada kolom daftar varian produk, otomatis kolom akan menampilkan data, lakukan edit data, setelah itu klik tombol edit varian</li>
</ul>
<div id="content_edit_ukuran">
    <!--LOAD DATA-->
</div>
<div class="row">
    <div calss="" id="form_volume" style="display: none;">
        <label id="text_volume"></label>
        <br>
        <div class="form-group">
            <input type="hidden" class="form-control" name="kode_ukuran" id="kode_ukuran" placeholder="">
            <input type="text" class="form-control" name="volume_ukuran" id="volume_ukuran" placeholder="">    
        </div>
    </div>
    <div calss="" id="form_irisan" style="display: none;">
        <label>Jumlah Irisan</label>
        <br>
        <div class="form-group">
            <input type="text" class="form-control" name="irisan_ukuran" id="irisan_ukuran" onkeypress="return /[0-9-]/i.test(event.key)" placeholder="10-12 Irisan">
        </div>
    </div>
    <div calss="" id="form_berat" style="display: none;">
        <label>Berat</label>
        <br>
        <div class="form-group">
            <div class="input-group">
                <input type="text" class="form-control" name="berat_ukuran" id="berat_ukuran" onkeypress="return /[0-9]/i.test(event.key)" placeholder="">
                <div class="input-group-prepend">
                    <span class="input-group-text">gram</span>
                </div>
            </div>
        </div>
    </div>
    <div calss="" id="form_harga" style="display: none;">
        <label>Harga Jual</label>
        <br>
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">Rp.</span>
                </div>
                <input type="text" class="form-control" name="harga_ukuran" id="harga_ukuran" onkeypress="return /[0-9]/i.test(event.key)" placeholder="">
            </div>
        </div>
    </div>
</div>
<div class="float-right">
    <div class="row">
        <div class="form-group">
            <button type="button" class="btn btn-primary btn_simpan_ukuran" id="btn_simpan_ukuran" style="margin-left: 10px; display:none">Simpan Varian</button>
        </div>
    </div>
</div>

<!-----------------------FUNGSI----------------------->
<script type="text/javascript">
	gambar_produk.onchange = evt => {
		const [file] = gambar_produk.files
		if (file) {
			blah.src = URL.createObjectURL(file)
		}
	}
</script>

<script>
    $(".kode_kategori").change(function() {
        var kode_kategori = $(this).val();
        $.ajax({
            url : '<?php echo base_url('admin/produk/select_subkategori'); ?>',
            method: 'POST',
            data: {kode_kategori:kode_kategori},
            async : false,
            dataType : 'json',
            success: function(data){
                var html = '';
                var i;
                for(i=0; i<data.length; i++){
                    html += '<option value='+data[i].kode_subkategori+'>'+data[i].nama_subkategori+'</option>';
                }
                $('#kode_subkategori').html(html);
            }
        });     
    });    
    
    $(document).ready(function(){
        ahnaon();
    }); 

    $(document).on('click', '.bentuk_produk', function() {
        ahnaon();
    }); 

    function ahnaon(){
        var bentuk_produk = $('#bentuk_produk').val();

        $("button#btn_simpan_ukuran").hide(500);
        $("div#form_volume").hide(500);
        $("div#form_irisan").hide(500);
        $("div#form_berat").hide(500);
        $("div#form_harga").hide(500);

        $("div#form_volume").removeClass("col-lg-3 col-12");
        $("div#form_irisan").removeClass("col-lg-3 col-12");
        $("div#form_berat").removeClass("col-lg-3 col-12");
        $("div#form_harga").removeClass("col-lg-3 col-12");

        if(bentuk_produk == "Persegi"){
            $("label#text_volume").text("Panjang X Lebar X Tinggi");
            $("input#volume_ukuran").attr("placeholder", "20cm X 30xm X 5cm");
            $("button#btn_simpan_ukuran").show(500);
            $("div#form_volume").show(500);
            $("div#form_irisan").show(500);
            $("div#form_berat").show(500);
            $("div#form_harga").show(500);

            $("div#form_volume").addClass("col-lg-3 col-12");
            $("div#form_irisan").addClass("col-lg-3 col-12");
            $("div#form_berat").addClass("col-lg-3 col-12");
            $("div#form_harga").addClass("col-lg-3 col-12");

        }else if(bentuk_produk == "Lingkaran"){
            $("label#text_volume").text("Diameter X Tinggi");
            $("input#volume_ukuran").attr("placeholder", "30xm X 5cm");
            $("button#btn_simpan_ukuran").show(500);
            $("div#form_volume").show(500);
            $("div#form_irisan").show(500);
            $("div#form_berat").show(500);
            $("div#form_harga").show(500);

            $("div#form_volume").addClass("col-lg-3 col-12");
            $("div#form_irisan").addClass("col-lg-3 col-12");
            $("div#form_berat").addClass("col-lg-3 col-12");
            $("div#form_harga").addClass("col-lg-3 col-12");

        }else{

        }
    }
        
</script>

<script type="text/javascript">
    load_data_edit_ukuran();
    function load_data_edit_ukuran(){
        
        var kode_produk = '<?php echo $produk['kode_produk']; ?>';
        $.ajax({
            url : '<?php echo base_url('admin/produk/load_data_edit_ukuran'); ?>',
            method: 'POST',
            data :{
                kode_produk:kode_produk,
            },
            beforeSend : function(){
                $('#content_edit_ukuran').html('<div style="text-align:center"><i class="bx bx-loader-alt bx-md bx-spin" style="margin-top: 30px; margin-bottom: 30px;" aria-hidden="true"></i></div>');
            },
            success : function(response){
                $('#content_edit_ukuran').html(response);
            }
        });
    };

    
    $('#btn_simpan_ukuran').on("click",function(e){
        var kode_produk = $('#kode_produk_baru').val();
        var kode_ukuran = $('#kode_ukuran').val();
        var volume_ukuran = $('#volume_ukuran').val();
        var irisan_ukuran = $('#irisan_ukuran').val();
        var berat_ukuran = $('#berat_ukuran').val();
        var harga_ukuran = $('#harga_ukuran').val();
        $.ajax({
            url : '<?php echo base_url('admin/produk/tambah_edit_ukuran'); ?>',
            method: 'POST',
            data : {
                kode_produk:kode_produk,
                kode_ukuran:kode_ukuran,
                volume_ukuran:volume_ukuran,
                irisan_ukuran:irisan_ukuran,
                berat_ukuran:berat_ukuran,
                harga_ukuran:harga_ukuran,
            },
            success: function(response){
                if(response==1){
                    load_data_edit_ukuran();
                    $('#kode_ukuran').val('');
                    $('#volume_ukuran').val('');
                    $('#irisan_ukuran').val('');
                    $('#berat_ukuran').val('');
                    $('#harga_ukuran').val('');
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal!',
                        text: response,
                        showConfirmButton: true,
                        timer: 3000
                    })
                }
            }
        }); 
    });

    $(document).on('click', '.btn_hapus_ukuran', function() {
        var kode_ukuran = $(this).attr("kode_ukuran");
        $.ajax({
            url : '<?php echo base_url('admin/produk/hapus_ukuran'); ?>',
            method: 'POST',
            data :{
                kode_ukuran:kode_ukuran,
            },
            success: function(response){
                load_data_edit_ukuran();
            }
        })
    });
</script>