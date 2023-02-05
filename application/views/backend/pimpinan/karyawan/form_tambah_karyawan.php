<input type="hidden" name="jenis" id="jenis" value="Tambah">
    <div class="form-group">
        <div class="d-flex justify-content-center">
            <label class="btn" for="foto_karyawan">
                <div class="form-control" style="border-radius: 50%; padding: 0px; width:180px; height: 180px;">
                    <img id="blah" src="<?php echo base_url('assets/img/banner/user_solid.png');?>" class="product-image" alt="Gambar Profil" style="border-radius: 50%; width:180px; height:180px; object-fit: cover; ">  
                </div>
                <input class="hidden" accept="image/*" type="file" id="foto_karyawan" name="file" style="display: none;" />
            </label>
        </div>
    </div>
</div>
<div class="form-group">
    <label for="id_karyawan">ID</label>
    <input type="text" class="form-control" name="id_karyawan" id="id_karyawan" placeholder="ID">
</div>
<div class="form-group">
    <label for="level_karyawan">Level</label>
    <select class="form-control" name="level_karyawan" id="level_karyawan">
        <option value="">Pilih</option>
        <option value="Admin">Admin</option>
        <option value="Petugas">Petugas</option>
    </select>
</div>
<div class="form-group">
    <label for="nama_karyawan">Nama</label>
    <input type="text" class="form-control" name="nama_karyawan" id="nama_karyawan" onkeypress="return /[a-z A-Z]/i.test(event.key)" placeholder="Nama">
</div>
<div class="form-group">
    <label for="alamat_karyawan">Alamat</label>
    <textarea type="text" class="form-control" name="alamat_karyawan" id="alamat_karyawan" placeholder="Alamat" style="height:100px;"></textarea>
</div>
<div class="form-group">
    <label for="kontak_karyawan">Kontak</label>
    <input type="text" class="form-control" name="kontak_karyawan" id="kontak_karyawan" onkeypress="return /[0-9]/i.test(event.key)" placeholder="No. Telepon / No. Handphone">
</div>
<div class="form-group" id="form_username" style="display: none">
    <label for="username_karyawan_baru">Username</label>
    <input type="text" class="form-control" name="" id="username_karyawan_baru" placeholder="Password">
</div>
<div class="form-group" id="form_password" style="display: none">
    <label for="password_karyawan">Password</label>
    <input type="text" class="form-control" name="" id="password_karyawan" placeholder="Password">
</div>


<!-----------------------FUNGSI----------------------->
<script type="text/javascript">
	foto_karyawan.onchange = evt => {
		const [file] = foto_karyawan.files
		if (file) {
			blah.src = URL.createObjectURL(file)
		}
	}
    
    $(document).ready(function() {
        $("#level_karyawan").change(function() {
            var level_karyawan = $('#level_karyawan').val();
            
            if(level_karyawan == "Petugas" || level_karyawan == ""){
                $("div#form_username").hide(500);
                $("div#form_password").hide(500);
                $('#username_karyawan_baru').attr('name', '');
                $('#password_karyawan').attr('name', '');


            }else{
                $("div#form_username").show(500);
                $("div#form_password").show(500);
                $('#username_karyawan_baru').attr('name', 'username_karyawan_baru');
                $('#password_karyawan').attr('name', 'password_karyawan');
            }
        });
    });
</script>
