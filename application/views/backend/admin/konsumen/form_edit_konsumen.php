<input type="hidden" name="jenis" id="jenis" value="Edit">
<div class="mb-5">
    <h5>Data Profil</h5>
    <div class="d-flex justify-content-center">
        <div class="form-group text-center">
            <label class="btn" for="foto_konsumen">
                <div class="form-control" style="padding: 0px; width:180px; height: 180px; border-radius: 50%;">
                    <?php if($konsumen['foto_konsumen'] != "") { ?>
                        <img id="blah" src="<?php echo base_url('assets/img/konsumen/'.$konsumen['foto_konsumen']);?>" class="product-image" alt="Gambar" style="border-radius: 50%; width:180px; height:180px; object-fit: cover; ">  
                    <?php }else{ ?>
                        <img id="blah" src="<?php echo base_url('assets/img/banner/user_solid.png');?>" class="product-image" alt="Gambar" style="border-radius: 50%; width:180px; height:180px; object-fit: cover; ">  
                    <?php } ?> 
                </div>
                <input class="text" accept="image/*" type="file" id="foto_konsumen" name="file" style="display: none;" />
                <input class="text" type="text" id="foto_konsumen_lama" name="foto_konsumen_lama" value="<?php echo $konsumen['foto_konsumen']; ?>" style="display: none;" />
            </label>
        </div>
    </div>
    <div class="form-group">
        <label>Nama Konsumen</label>
        <input type="hidden" class="form-control" name="id_konsumen" id="id_konsumen" value="<?php echo $konsumen['id_konsumen']; ?>" placeholder="Nama Konsumen">
        <input type="text" class="form-control" name="nama_konsumen" id="nama_konsumen" value="<?php echo $konsumen['nama_konsumen']; ?>" placeholder="Nama Konsumen">
    </div>
</div>


<div class="mb-5">
    <h5>Data Alamat</h5>
    <?php $alamat_konsumen = explode("-",$konsumen['alamat_konsumen']);?>
    <div class="row">
        <div class="col-lg-6 col-md-6 col-12">
            <div class="form-group">
                <div class="form-group mb-3">
                    <label>Provinsi</label>
                    <select type="text" class="form-control kode_provinsi" name="kode_provinsi" id="kode_provinsi" placeholder="Contoh: Kuningan">
                        <option value="">Pilih</option>
                        <?php 
                            foreach($provinsi->result() as $row){ 
                                if($row->kode_provinsi == '32'){ ?>
                                    <option value="<?php echo $row->kode_provinsi; ?>" <?php if($row->kode_provinsi == $konsumen['kode_provinsi']){echo "selected";}?>><?php echo $row->nama_provinsi; ?></option>
                        <?php } } ?> 
                    </select>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-12">
            <div class="form-group">
                <div class="form-group mb-3">
                    <label>Kabupaten / Kota</label>
                    <select type="text" class="form-control kode_kabupaten" name="kode_kabupaten" id="kode_kabupaten" placeholder="Contoh: Kuningan">
                
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6 col-md-6 col-12">
            <div class="form-group">
                <div class="form-group mb-3">
                    <label>Kecamatan</label>
                    <select type="text" class="form-control kode_kecamatan" name="kode_kecamatan" id="kode_kecamatan" placeholder="Contoh: Kuningan">
                    
                    </select>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-12">
            <div class="form-group">
                <div class="form-group mb-3">
                    <label>Desa / Keluarahan</label>
                    <select type="text" class="form-control kode_desa " name="kode_desa" id="kode_desa" placeholder="Contoh: Kuningan">
                        
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4 col-md-6 col-12">
            <div class="form-group mb-3">
                <label>RT</label>
                <input type="text" class="form-control" name="rt" id="rt" value="<?php echo $alamat_konsumen[1]; ?>" maxlength="3" onkeypress="return /[0-9]/i.test(event.key)" placeholder="RT">
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-12">
            <div class="form-group mb-3">
                <label>RW</label>
                <input type="text" class="form-control" name="rw" id="rw" value="<?php echo $alamat_konsumen[2]; ?>" maxlength="3" onkeypress="return /[0-9]/i.test(event.key)" placeholder="RW">
            </div>    
        </div>
    </div>
    <div class="form-group">
        <label>Alamat</label>
        <textarea type="text" class="form-control" name="alamat" id="alamat" placeholder="Alamat"><?php echo $alamat_konsumen[0]; ?></textarea>
    </div>
</div>


<div class="mb-5">
    <h5>Data Kontak</h5>
    <div class="form-group">
        <label>No. Handphone</label>
        <input type="text" class="form-control" name="kontak_konsumen_baru" id="kontak_konsumen_baru" value="<?php echo $konsumen['kontak_konsumen']; ?>" onkeypress="return /[0-9]/i.test(event.key)"placeholder="No. Telepon / No. Handphone">
        <input type="hidden" class="form-control" name="kontak_konsumen_lama" id="kontak_konsumen_lama" value="<?php echo $konsumen['kontak_konsumen']; ?>" onkeypress="return /[0-9]/i.test(event.key)"placeholder="No. Telepon / No. Handphone">
    </div>
    <div class="form-group">
        <label>email</label>
        <input type="email" class="form-control" name="email_konsumen_baru" id="email_konsumen_baru" value="<?php echo $konsumen['email_konsumen']; ?>" placeholder="Email">
        <input type="hidden" class="form-control" name="email_konsumen_lama" id="email_konsumen_lama" value="<?php echo $konsumen['email_konsumen']; ?>" placeholder="Email">
    </div>
</div>


<div class="mb-5">
    <h5 class="pt-3">Data Akun</h5>
    <div class="form-group">
        <label>Status</label>
        <div class="row">  
            <div class="col-lg-4 col-md-12 col-12">                       
                <div class="custom-control custom-radio ">
                    <input class="custom-control-input" type="radio" id="customRadio11" value="Aktif" name="status_konsumen" <?php if($konsumen['status_konsumen'] == "Aktif"){echo "checked";} ?>>
                    <label for="customRadio1" class="custom-control-label">Aktif</label>
                </div>    
            </div>
            <div class="col-lg-4 col-md-12 col-12">                            
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" type="radio" id="customRadio22" value="Tidak Aktid" name="status_konsumen"  <?php if($konsumen['status_konsumen'] == "Tidak Aktif"){echo "checked";} ?>>
                    <label for="customRadio2" class="custom-control-label">Tidak Aktif</label>
                </div>   
            </div> 
        </div>
    </div>
    <div class="form-group">
        <label>Password</label>
        <input type="text" class="form-control" name="password_konsumen" id="password_konsumen" value="<?php echo $konsumen['password_konsumen']; ?>" placeholder="Password">
    </div>
</div>

<!-----------------------FUNGSI----------------------->
<script type="text/javascript">
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
        var kode_kabupaten = <?php echo $konsumen['kode_kabupaten']; ?>;
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
                        html += '<option value="'+data[i].kode_kabupaten+'"';
                        if(data[i].kode_kabupaten == kode_kabupaten){ html += 'selected' };
                        html += '>'+data[i].nama_kabupaten+'</option>';
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
        var kode_kecamatan = <?php echo $konsumen['kode_kecamatan']; ?>;
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
        var kode_desa = <?php echo $konsumen['kode_desa']; ?>;
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