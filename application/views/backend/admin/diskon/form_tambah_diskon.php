<input type="hidden" id="jenis" value="Tambah">
<div class="form-group">
    <label>Banner Diskon</label>
    <div class="text-center">
        <label class="btn btn-sm" for="gambar_diskon">
            <div class="form-control" style="padding: 0px; height: 230px;">
                <img id="blah" src="<?php echo base_url('assets/img/banner/undraw_discount.svg');?>" class="product-image" alt="Gambar Diskon" style="border-radius: 3px; width:100%; height:230px; object-fit: cover; ">  
            </div>
            <input class="hidden" accept="image/*" type='file' id="gambar_diskon" name="file" style="display: none;" />
        </label>
    </div>
</div>
<br>
<hr>
<br>
<div class="mb-3">
    <div class="form-group">
        <label>Nama Diskon</label>
        <input type="text" class="form-control" name="nama_diskon" id="nama_diskon" placeholder="Contoh: diskon akhir tahun">
    </div>
</div>
<div class="mb-3">
    <label>Durasi Diskon</label>
    <div class="row">
        <div class="col-lg-5 col-12">
            <div class="form-group">
                <input type="text" class="form-control" name="tanggal_awal_diskon" id="tanggal_awal_diskon" autocomplete="off" style="background-color: #fff; color:#000" placeholder="Tanggal Awal" readonly>
            </div>
        </div>
        s.d
        <div class="col-lg-5 col-12">
            <div class="form-group">
                <input type="text" class="form-control" name="tanggal_akhir_diskon" id="tanggal_akhir_diskon" autocomplete="off" style="background-color: #fff; color:#000" placeholder="Tanggal Akhir" readonly>
            </div>
        </div>
    </div>
</div> 
<div class="mb-2">
    <div class="form-group">
        <label>Deskripsi Diskon</label>
        <textarea class="form-control" name="deskripsi_diskon" id="deskripsi_diskon" style="height: 100px;" placeholder="Contoh: Dapatkan potongan harga hingga 10%!"></textarea>
    </div>
</div>    
<br>
<hr>
<br>
<div class="mb-3">
    <div class="form-group">
        <label>Daftar Produk</label>
        <div class="row">
            <div class="col-lg-10 col-12">
                <select class="form-control kode_ukuran" name="kode_ukuran" id="kode_ukuran" style="width: 100%;">
                    <option value="">Pilih Produk</option>
                    <?php 
                        foreach($ukuran->result() as $row){
                            if($row->kode_produk != ""){
                    ?>
                        <option value="<?php echo $row->kode_ukuran; ?>"><?php echo $row->nama_produk." (".$row->volume_ukuran.")"; ?></option>
                    <?php 
                            }
                        }
                    ?>
                </select>
            </div>
            <div class="col-lg-2 col-12">
                <input type="text" class="form-control" name="potongan_idiskon" id="potongan_idiskon" onkeypress="return /[0-9.]/i.test(event.key)" placeholder="(%)">
            </div>
        </div>
    </div>
    <div class="form-group float-right">
        <button type="button" class="btn btn-primary" id="btn_simpan_idiskon"><span class="bx bx-fw bx-plus"></span> Tambah Produk</button>
    </div>
    <div id="content_idiskon">
        <!--LOAD DATA-->
    </div>
</br>

<script type="text/javascript">
    var today = new Date()
    $(document).ready(function(){   
        $('#tanggal_awal_diskon').datetimepicker({
            //inline:true,
            minDateTime: today.setDate(today.getDate() - 1),
            format: 'Y-m-d',
            timepicker:false,
            autoclose: true
        });
    });

     $(document).ready(function(){   
        $('#tanggal_akhir_diskon').datetimepicker({
            //inline:true,
            minDateTime: new Date(),
            format: 'Y-m-d',
            timepicker:false,
            autoclose: true
        });
    });

	gambar_diskon.onchange = evt => {
		const [file] = gambar_diskon.files
		if (file) {
			blah.src = URL.createObjectURL(file)
		}
	}
</script>

<script type="text/javascript">
    load_data_idiskon();
    function load_data_idiskon(){
        $.ajax({
            method : "GET",
            url : '<?php echo base_url('admin/diskon/load_data_idiskon'); ?>',
            beforeSend : function(){
                $('#content_idiskon').html('<div style="text-align:center"><i class="bx bx-loader-alt bx-md bx-spin" style="margin-top: 30px; margin-bottom: 30px;" aria-hidden="true"></i></div>');
            },
            success : function(response){
                $('#content_idiskon').html(response);
            }
        });
    };
    
    $('#btn_simpan_idiskon').on("click",function(e){
        var kode_ukuran = $('#kode_ukuran').val();
        var potongan_idiskon = $('#potongan_idiskon').val();
        $.ajax({
            url : '<?php echo base_url('admin/diskon/tambah_idiskon'); ?>',
            method: 'POST',
            data : {
                kode_ukuran:kode_ukuran,
                potongan_idiskon:potongan_idiskon
            },
            success: function(response){
                if(response==1){
                    load_data_idiskon();
                    $('#kode_ukuran').val('');
                    $('#potongan_idiskon').val('');
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

    $(document).on('click', '.btn_hapus_idiskon', function() {
        var kode_idiskon = $(this).attr("kode_idiskon");
        $.ajax({
            url : '<?php echo base_url('admin/diskon/hapus_idiskon'); ?>',
            method: 'POST',
            data :{
                kode_idiskon:kode_idiskon,
            },
            success: function(response){
                load_data_idiskon();
            }
        })
    });
</script>