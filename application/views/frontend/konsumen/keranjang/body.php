<?php $this->load->view('frontend/partials/head.php') ?>

<main id="main">
    <section id="breadcrumbs" class="breadcrumbs" style="margin-top: 80px">

    </section>

    <section id="portfolio-details" class="portfolio-details">
        <div class="container">        
            <div class="row justify-content-md-between">
                <div class="portfolio-info col-12 col-lg-8" style="border-radius: 10px">  
                    <?php 
                        $cek = 0;
                        foreach($data_keranjang as $row1){
                            if($row1->status_ipemesanan == 1){ 
                                $cek =+ 1;
                            }
                        }
                        
                        if($cek == 0) {
                    ?>
                        <div style="text-align: center; margin-top: 6%; margin-bottom: 6%;">  
                            <h4>Tidak ada produk</h4>
                        </div>
                    <?php } else { ?>
                        <input type="checkbox" id="select_all" id="select_all" /> Pilih Semua
                        <table style="width:100%" id="table" class="table ">
                            <tbody>
                                <?php 
                                    $checked = 0;
                                    $unchecked = 0;
                                    $no = 1;
                                    foreach($data_keranjang as $row1){
                                        if($row1->status_ipemesanan == 1){
                                                        
                                            //MENCARI POTONGAN HARGA
                                            $harga_ukuran = 0;
                                            $potongan_idiskon = 0;
                                            $subtotal_harga = 0;
                                            $qty_ipemesanan = $row1->qty_ipemesanan;

                                            foreach($data_ukuran as $row2){
                                                if($row2->kode_ukuran == $row1->kode_ukuran){
                                                    $harga_ukuran = $row2->harga_ukuran;
                                                    $berat_ukuran = $row2->berat_ukuran;
                                                    $volume_ukuran = $row2->volume_ukuran;
                
                                                    foreach($data_idiskon as $row3){
                                                        if($row3->kode_ukuran == $row2->kode_ukuran){
                                                            $potongan_idiskon = $row3->potongan_idiskon;
                                                            $subtotal_harga = $harga_ukuran - (($potongan_idiskon * $harga_ukuran) / 100);

                                                        }
                                                    }
                                                }
                                            }
                                ?>      
                                <tr>
                                    <td class="pt-4 pb-4" style="text-align: center; vertical-align: middle; width:5%">
                                        <input type="checkbox" class="hitung" 
                                            checked_kode_ipemesanan="<?php echo $row1->kode_ipemesanan;?>" 
                                            unchecked_kode_ipemesanan="<?php echo $row1->kode_ipemesanan;?>" 
                                            <?php if($potongan_idiskon != 0){ ?>
                                                checked_belanja="<?php echo $qty_ipemesanan * $subtotal_harga;?>" 
                                                checked_berat="<?php echo $qty_ipemesanan * $row2->berat_ukuran;?>" 
                                            <?php } else {  ?>
                                                checked_belanja="<?php echo $qty_ipemesanan * $harga_ukuran;?>" 
                                                checked_berat="<?php echo $qty_ipemesanan * $row2->berat_ukuran;?>" 
                                            <?php } if($row1->check_ipemesanan == 1){ echo "checked"; } ?>
                                        />
                                    </td>
                                    <td class="pt-4 pb-4" style="text-align: center; vertical-align: middle; width:15%">
                                        <a href="<?php echo base_url('home/detail_produk/').$row1->hahaha;?>" style="color: black;"> 
                                            <div class="" style="text-align: center;">
                                                <?php if($row1->gambar_produk != ""){ ?>
                                                    <img src="<?php echo base_url('assets/img/produk/').$row1->gambar_produk; ?>" alt="" style="border-radius: 10px; width: 100px; height: 100px;  object-fit: cover; ">
                                                <?php }else{ ?>
                                                    <img src="<?php echo base_url('assets/img/banner/logo.png'); ?>" alt="" style="border-radius: 10px; width: 100px; height: 100px;  object-fit: cover; ">
                                                <?php } ?>
                                            </div>
                                        </a>
                                    </td>
                                    <td class="pt-4 pb-4" style="text-align: left; vertical-align: middle;">
                                        <a href="<?php echo base_url('home/detail_produk/').$row1->hahaha;?>" style="color: black;"> 
                                            <span class="fs-5 text-bold"><?php echo $row1->nama_produk; ?></span>
                                            <br> 
                                            <?php 
                                                if($potongan_idiskon != 0){
                                            ?>
                                                <input type="hidden" class="form-control" id="harga_pemesanan" value="<?php echo $subtotal_harga; ?>" readonly>
                                                <span class="badge bg-success"><?php echo $potongan_idiskon; ?>%</span>
                                                <del>Rp. <?php echo number_format($harga_ukuran, 0, ".", "."); ?></del>
                                                <strong>Rp. <?php echo number_format($subtotal_harga, 0, ".", "."); ?></strong>
                                            <?php 
                                                } else { 
                                            ?>
                                                <input type="hidden" class="form-control" id="harga_pemesanan" value="<?php echo $harga_ukuran; ?>" readonly>
                                                <strong>Rp. <?php echo number_format($harga_ukuran, 0, ".", "."); ?></strong>
                                            <?php } ?>
                                            <br>
                                            <small><?php echo $volume_ukuran; if($row1->bentuk_produk == "Lingkaran"){ echo " (DxT)"; } else { echo " (PxLxT)"; } echo " - ".$berat_ukuran." gram"; ?> </small>
                                            <br>
                                            <small><?php echo number_format($cek = $qty_ipemesanan, 0, ".", ".")." Item (".number_format(($qty_ipemesanan * $row2->berat_ukuran)/1000, 2, ",", "."). " Kg)" ; ?></small>
                                        </a>
                                    </td>
                                    <td class="pt-4 pb-4" style="text-align: center; vertical-align: bottom;">
                                        <div class="d-flex float-end">
                                            <div class="row">
                                                <div class="col-3">
                                                    <button type="button" type="button" class="btn btn-danger btn-block btn_hapus_keranjang btn-sm" kode_ipemesanan = <?php echo $row1->kode_ipemesanan; ?> nama_produk = <?php echo $row1->nama_produk; ?>><span class="bx bx-trash"></span></button>
                                                </div>
                                                <div class="col-9">
                                                    <div class="row"> 
                                                        <button type="button" class="btn btn-outline-warning btn-sm" onclick="decrement(<?php echo $no; ?>)"  style="width: 25%;"><span class="fa fa-minus"></span></button>
                                                        <input type="number" class="form-control form-control-sm" onkeyup="input(<?php echo $no; ?>)" name="qty_ipemesanan<?php echo $no; ?>" id="qty_ipemesanan<?php echo $no; ?>" min="1" max="1000" value="<?php echo $row1->qty_ipemesanan; ?>" style="width: 40%; text-align:center">
                                                        <input type="hidden" class="form-control form-control-sm" name="qty_kode_ipemesanan<?php echo $no; ?>" id="qty_kode_ipemesanan<?php echo $no; ?>" value = "<?php echo $row1->kode_ipemesanan; ?>">
                                                        <button type="button" class="btn btn-outline-warning btn-sm" onclick="incerment(<?php echo $no; ?>)"  style="width: 25%;"><span class="fa fa-plus"></span></button> 
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <?php     
                                        $no++;
                                        } 
                                    } 
                                ?>   
                            </tbody>
                        </table>
                    <?php } ?>
                </div>
                <div class="col-12 col-lg-3">
                    <div class="book-a-table" id="book-a-table" style="border-radius: 10px">
                        <form role="form" class="php-email-form" id="form_beli" method="post" aria-label="">
                            <div class="form-group">
                                <div class="row">
                                    <strong>Total Harga</strong>
                                    <span class="fs-4">Rp. <span id="text_total_belanja_pemesanan_1">0</span></span>
                                </div>
                            </div>
                            <?php if($this->session->userdata('ses_akses') != NUll){ ?>
                            <br>
                            <div class="form-group">
                                <div class="row">
                                    <button type="button" id="btn_beli" class="btn btn-warning btn-block rounded-pill">Beli</button>
                                </div>
                            </div>
                            <?php } ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<div id="modal_checkout" class="modal animated pulse" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content" style="border-radius: 20px;">
            <div class="modal-body">
                <form role="form" id="form_checkout" method="post" aria-label="">
                    <div class="modal-header">
                        <h3>Checkout</h3>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" class="form-control" id="id_konsumen" value="<?php echo $this->session->userdata['ses_id_konsumen']; ?>">
                        <input type="hidden" class="kurir_pemesanan" name="kurir_pemesanan" id="kurir_pemesanan" readonly>
                        <input type="hidden" class="berat_pemesanan" name="berat_pemesanan" id="berat_pemesanan" readonly>
                        <input type="hidden" class="kota_asal" name="kota_asal" id="kota_asal" value="428" readonly>
                        <input type="hidden" class="kota_tujuan" name="kota_tujuan" id="kota_tujuan" value="<?php echo $data_konsumen['city_id']; ?>" readonly>
                        <input type="hidden" class="total_belanja_pemesanan" name="total_belanja_pemesanan" id="total_belanja_pemesanan" readonly>
                        <input type="hidden" class="total_tagihan_pemesanan" name="total_tagihan_pemesanan" id="total_tagihan_pemesanan" readonly>
                        <input type="hidden" class="checked_kode_ipemesanan" name="checked_kode_ipemesanan" id="checked_kode_ipemesanan" readonly>

                        <div class="row">
                            <div class="col-12 col-md-6">
                                <div class="mb-5" id="form_pembayaran">
                                    <strong class="fs-5">Pengiriman</strong>
                                    <hr>
                                    <div class="form-group mb-5">
                                        <table>
                                            <tr>
                                                <td><i class="bx bx-fw bx-home"></i> Alamat penerima </td>
                                            </tr>
                                            <tr>
                                                <td><?php $alamat_konsumen = explode("-",$data_konsumen['alamat_konsumen']); echo $alamat_konsumen[0]." RT ".$alamat_konsumen[1]." RW ".$alamat_konsumen[2].", Desa ".$data_konsumen['nama_desa'].", Kec. ".$data_konsumen['nama_kecamatan'].", Kab. ".$data_konsumen['nama_kabupaten']." ".$data_konsumen['nama_provinsi'];?></td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="form-label">Metode Pengiriman</label>
                                        <select class="form-control metode_pengiriman_pemesanan" name="metode_pengiriman_pemesanan" id="metode_pengiriman_pemesanan">
                                            <option value="">Pilih</option>
                                            <option value="Ambil Sendiri">Ambil Sendiri</option>
                                            <?php if($data_konsumen['city_id'] == "252" || $data_konsumen['city_id'] == "211" || $data_konsumen['city_id'] == "108" || $data_konsumen['city_id'] == "109"){ ?>
                                                <option value="Antar Cepat">Antar Cepat</option>
                                            <?php } else { ?>
                                                <option value="" disabled>Antar Cepat (Kuningan, Cirebon, Majalengka)</option>
                                            <?php } ?>
                                            <option value="Ekspedisi">Ekspedisi</option>
                                        </select>
                                    </div>
                                    <div id="form_ambil_sendiri" style="display: none;">
                                        <div class="form-group mb-3">
                                            <i>Produk dapat diambil setelah proses pembuatan selesai. Diinformasikan via sistem dan Whatsapp</i>
                                        </div>
                                    </div>
                                    <div id="form_antar_cepat" style="display: none;">
                                        <div class="form-group mb-3">
                                            <i>Estimasi pengiriman 1 hari. Pengiriman langsung ke rumah anda diantar oleh karyawan Nur Bakery & Cake setelah proses pembuatan selesai.</i>
                                        </div>
                                    </div>
                                    <div id="form_ekspedisi" style="display: none;">
                                        <div class="form-group mb-3">
                                            <label class="form-label">Ekspedisi</label>
                                            <select class="form-control kurir" name="kurir" id="kurir">
                                                <option value="">Pilih</option>
                                                <option value="jne">JNE</option>
                                                <option value="tiki">TIKI</option>
                                                <option value="pos">POS INDONESIA</option>
                                            </select>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="form-label">Nama Layanan</label>
                                            <select class="form-control layanan" name="layanan" id="layanan">
                                                <option value="">Pilih</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            
                            <div class="col-12 col-md-6">
                                <strong class="fs-5">Pembayaran</strong>
                                <hr>
                                <div class="form-group mb-3">
                                    <table style="width: 100%;">
                                        <caption></caption>
                                        <th></th>
                                        <tr><td style="width: 50%; text-align:left">Total Belanja</td><td style="width: 50%; text-align:right">Rp. <label id="text_total_belanja_pemesanan_2"></label></td></tr>
                                        <tr><td style="width: 50%; text-align:left">Ongkos Kirim</td><td style="width: 50%; text-align:right">(<label id="text_berat" ></label> kg) Rp. <label id="text_tarif_kurir" ></label></td></tr>
                                        <tr><td style="width: 50%; text-align:left">Total Tagihan</td><td style="width: 50%; text-align:right">Rp. <label id="text_total_tagihan_pemesanan"></label></td></tr>
                                    </table>
                                </div>
                                <div class="form-group mb-3">
                                    <label class="form-label">Rekening / E-Money</label>
                                    <select class="form-control rekening_pemesanan" name="rekening_pemesanan" id="rekening_pemesanan">
                                        <option value="">Pilih</option>
                                        <option value="<?php echo $data_pengaturan['rek1_pengaturan'];?>"><?php echo $data_pengaturan['rek1_pengaturan'];?></option>
                                        <option value="<?php echo $data_pengaturan['rek2_pengaturan'];?>"><?php echo $data_pengaturan['rek2_pengaturan'];?></option>
                                        <option value="<?php echo $data_pengaturan['rek3_pengaturan'];?>"><?php echo $data_pengaturan['rek3_pengaturan'];?></option>
                                        <option value="<?php echo $data_pengaturan['rek4_pengaturan'];?>"><?php echo $data_pengaturan['rek4_pengaturan'];?></option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="float-right">
                                    <div class="form-group mb-3">
                                        <small class="mr-3"><a href="<?php echo base_url('home/syarat_ketentuan');?>">Syarat & Ketentuan</a></small>
                                        <button type="submit" id="btn_checkout" class="btn btn-warning rounded-pill">Checkout</button>  
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php $this->load->view('frontend/partials/footer.php') ?>
<?php $this->load->view('frontend/partials/script.php') ?>

<!-----------------------FUNGSI LAIN----------------------->
<script>
    $(document).ready(function() {
        $("#keranjang").addClass("active");
        $("#topbar").removeClass("topbar-transparent");
        $("#header").removeClass("header-transparent");
    });
</script>

<!-----------------------KERANJANG----------------------->
<script>
    
    function incerment(key) {
        document.getElementById('qty_ipemesanan'+key).stepUp();
        simpan_jumlah(key);
    }

    function decrement(key) {
        document.getElementById('qty_ipemesanan'+key).stepDown();
        simpan_jumlah(key);
    }


    function input(key) {
        simpan_jumlah(key);
    }
   
    function simpan_jumlah(key){
        var kode_ipemesanan = $('#qty_kode_ipemesanan'+key).val();
        var qty_ipemesanan = $('#qty_ipemesanan'+key).val();

        $.ajax({
            url : '<?php echo base_url('home/tambah_keranjang'); ?>',
            method: 'POST',
            data: {
                kode_ipemesanan:kode_ipemesanan,
                qty_ipemesanan:qty_ipemesanan
            },
            success: function(response){
                if(response==3){
                    location.reload();
                }
            }
        });   

    };

    product_checked()
    $(document).ready(function() {
        var $select_all = $('#select_all'); 
        var $table = $('.table'); 
        var $td_checkbox = $table.find('tbody input:checkbox');
        var td_checkbox_checked = 0; 

        
        $select_all.on('click', function () {
            $td_checkbox.prop('checked', this.checked);
            product_checked();
        });

        $td_checkbox.on('change', function(e){
            td_checkbox_checked = $table.find('tbody input:checkbox:checked').length;
            $select_all.prop('checked', (td_checkbox_checked === $td_checkbox.length));
            product_checked()
        })

        $td_checkbox.ready(function(e){
            td_checkbox_checked = $table.find('tbody input:checkbox:checked').length;
            $select_all.prop('checked', (td_checkbox_checked === $td_checkbox.length));
        })
    });

    //NGITUNG
    function product_checked(){
        var checked_belanja = [];
        var checked_berat = [];
        var checked_kode_ipemesanan = [];
        var unchecked_kode_ipemesanan = [];
        var belanja_amount = 0;
        var berat_amount = 0
        var h = 0;
        var i = 0;
        var j = 0;
        var k = 0;

        //RESET HEULA PEUNTEUN
        $('#text_total_belanja_pemesanan_1').text(new Number(belanja_amount).toLocaleString("id-ID"));
        $('#text_total_belanja_pemesanan_2').text(new Number(belanja_amount).toLocaleString("id-ID"));
        $('#total_belanja_pemesanan').val(belanja_amount);
        $('#berat_pemesanan').val(berat_amount);

        checkout(belanja_amount)
        //KAREK HITUNG ULANG PEUNTEUN
        let sum = a => a.reduce((x, y) => x + y);
        //CEBOK HIJIAN
        jQuery('#table').find('tr').each(function () {
            var row = jQuery(this);
            row.find('input[type="checkbox"]').each(function () {
                var checkbox = jQuery(this);
                if(checkbox.prop("checked") == true){
                    checked_belanja[h++] = checkbox.attr("checked_belanja");
                    checked_berat[i++] = checkbox.attr("checked_berat");
                    checked_kode_ipemesanan[j++] = checkbox.attr("checked_kode_ipemesanan");
                    var belanja_amount = sum(checked_belanja.map(x => Number(x)));
                    var berat_amount = sum(checked_berat.map(x => Number(x)));
                    
                    $('#text_total_belanja_pemesanan_1').text(new Number(belanja_amount).toLocaleString("id-ID"));
                    $('#text_total_belanja_pemesanan_2').text(new Number(belanja_amount).toLocaleString("id-ID"));
                    $('#total_belanja_pemesanan').val(belanja_amount);
                    $('#berat_pemesanan').val(berat_amount);
                    $('#checked_kode_ipemesanan').val(checked_kode_ipemesanan);

                    checked(checked_kode_ipemesanan); 
                    checkout(belanja_amount)
                }     
                
                
                if(checkbox.prop("checked") == false){
                    unchecked_kode_ipemesanan[k++] = checkbox.attr("unchecked_kode_ipemesanan");
                    unchecked(unchecked_kode_ipemesanan);
                }
            });
        });
        
        
    }
        
    function checked(checked_kode_ipemesanan){
        var check_ipemesanan = 1;
        $.ajax({
            url: "<?php echo base_url('home/update_checked');?>",
            method: 'POST',
            data: {
                check_ipemesanan:check_ipemesanan,
                kode_ipemesanan:checked_kode_ipemesanan,
            },             
        })
    }
        
    function unchecked(unchecked_kode_ipemesanan){
        var check_ipemesanan = 0;
        $.ajax({
            url: "<?php echo base_url('home/update_checked');?>",
            method: 'POST',
            data: {
                check_ipemesanan:check_ipemesanan,
                kode_ipemesanan:unchecked_kode_ipemesanan
            },                
        })
    }
    
    $(document).on('click', '.btn_hapus_keranjang', function(e) {
        var kode_ipemesanan=$(this).attr("kode_ipemesanan");
        var nama_produk=$(this).attr("nama_produk");

        Swal.fire({
            title: 'Apakah anda yakin?',
            text: 'Akan menghapus data"' + nama_produk + '"!',
            type: 'warning',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ffc107',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus',
            cancelButtonText: "Tidak, batalkan",
            showLoaderOnConfirm: true,
            customClass: 'animated tada',
            preConfirm: function() {
                return new Promise(function(resolve) {
                    $.ajax({
                        url: '<?php echo base_url('home/hapus_keranjang'); ?>',
                        method: 'POST',
                        data: {
                            kode_ipemesanan : kode_ipemesanan
                        },                
                    })
                    .done(function(response) {
                        location.reload();
                        Swal.fire('Berhasil!', 'Data telah dihapus.', 'success')
                    })
                    .fail(function() {
                        Swal.fire('Oops...', 'Terjadi kesahan!', 'error')
                    });
                });
            },
        });
    });  

    function checkout(belanja_amount){
        if(belanja_amount == "0" ){
            $("button#btn_beli").hide(100);
               
            
        }else{
            $("button#btn_beli").show(100);
        }
    }

    $('#btn_beli').on("click",function(){
        $('#modal_checkout').modal('show');
    });
</script>



<!-----------------------CHECKOUT----------------------->
<script>

        
    $('#modal_checkout').on('hidden.bs.modal', function () {
        reset_modal()
    })

    $(".metode_pengiriman_pemesanan").change(function() {
        reset_modal();

        var metode_pengiriman_pemesanan = $('#metode_pengiriman_pemesanan').val();
        var total_belanja_pemesanan = $('#total_belanja_pemesanan').val();
        var berat = $('#berat_pemesanan').val();

        if(metode_pengiriman_pemesanan == "Ambil Sendiri"){
            $("div#form_ambil_sendiri").show(500);

            var kurir = 0;
            var layanan = 0;
            var estimasi = 0;
            var ongkir = 0;

        }else if(metode_pengiriman_pemesanan == "Antar Cepat"){
            $("div#form_antar_cepat").show(500);

            var kurir = "Nur Cake & Bakery";
            var layanan = "Antar Cepat";
            var estimasi = 1;
            var ongkir = <?php echo $data_konsumen['ongkos_kecamatan']; ?>;

        }else if(metode_pengiriman_pemesanan == "Ekspedisi"){
            $("div#form_ekspedisi").show(500);

            var kurir = 0;
            var layanan = 0;
            var estimasi = 0;
            var ongkir = 0;
        }
            

        var total_tagihan_pemesanan = parseFloat(total_belanja_pemesanan) + parseFloat(ongkir);
        $('#text_total_belanja_pemesanan_2').text(new Number(total_belanja_pemesanan).toLocaleString("id-ID"));
        $('#text_tarif_kurir').text(new Number(ongkir).toLocaleString("id-ID"));
        $('#text_berat').text(new Number(berat/1000).toLocaleString("id-ID"));
        $('#text_total_tagihan_pemesanan').text(new Number(total_tagihan_pemesanan).toLocaleString("id-ID"));

        $('#berat_pemesanan').val(berat);
        $('#total_belanja_pemesanan').val(total_belanja_pemesanan);
        $('#total_tagihan_pemesanan').val(total_tagihan_pemesanan);
        $('#kurir_pemesanan').val(kurir+"|"+layanan+"|"+estimasi+"|"+ongkir);

        if(metode_pengiriman_pemesanan == ""){
            reset_modal();
        }

    });

    function reset_modal(){
        var total_belanja_pemesanan = $('#total_belanja_pemesanan').val();
        var berat = $('#berat_pemesanan').val();
        
        var kurir = 0;
        var layanan = 0;
        var estimasi = 0;
        var ongkir = 0;

        $('#text_total_belanja_pemesanan_2').text(new Number(total_belanja_pemesanan).toLocaleString("id-ID"));
        $('#text_tarif_kurir').text(new Number(ongkir).toLocaleString("id-ID"));
        $('#text_berat').text(new Number(berat/1000).toLocaleString("id-ID"));
        $('#text_total_tagihan_pemesanan').text(new Number(total_belanja_pemesanan).toLocaleString("id-ID"));

        $("div#form_ambil_sendiri").hide(500);
        $("div#form_antar_cepat").hide(500);
        $("div#form_ekspedisi").hide(500);

        $('#rekening_pemesanan').prop('selectedIndex', 0);
        $('#kurir').prop('selectedIndex', 0);
        $('.layanan').html('<option value=""></option>');
        $('#total_tagihan_pemesanan').val(total_belanja_pemesanan);
    }


    $(".kurir").change(function() {
        var kota_asal = $('#kota_asal').val();
        var kota_tujuan = $('#kota_tujuan').val();
        var kurir = $('#kurir').val();
        var berat = $('#berat_pemesanan').val();
        var total_belanja_pemesanan = $('#total_belanja_pemesanan').val();
        
        $.ajax({
            url : '<?php echo base_url('home/cek_ongkir'); ?>',
            method: 'POST',
            data: {
                kota_asal:kota_asal,
                kota_tujuan:kota_tujuan,
                kurir:kurir,
                berat:berat
            },
            async : false,
            dataType : 'json',
            success: function(response){
                event.preventDefault();
                var kurir = response.rajaongkir['results'][0]['name'];
                $('.layanan').prop("disabled", false);
                var hujan=response.rajaongkir['results'][0]['costs'];
                //cara ngaluarkeun harga hujan[0]['cost'][0]['value']
                var html = '';
                for(i=0; i<hujan.length; i++){
                    var layanan = hujan[i]['service'];
                    var ongkir = hujan[i]['cost'][0]['value'];
                    var estimasi = hujan[i]['cost'][0]['etd']; 
                    var value 
                    html += "<option value='"+kurir+"|"+layanan+"|"+estimasi+"|"+ongkir+"'>"+layanan+" | Estimasi " +estimasi+" Hari"+" (Rp. "+new Number(ongkir).toLocaleString("id-ID")+")</option>";
                }
                $('.layanan').html(html);

                
                var total_tagihan_pemesanan = parseFloat(total_belanja_pemesanan) + parseFloat(hujan[0]['cost'][0]['value']);

                $('#text_total_belanja_pemesanan_2').text(new Number(total_belanja_pemesanan).toLocaleString("id-ID"));
                $('#text_tarif_kurir').text(new Number(hujan[0]['cost'][0]['value']).toLocaleString("id-ID"));
                $('#text_berat').text(new Number(berat/1000).toLocaleString("id-ID"));
                $('#text_total_tagihan_pemesanan').text(new Number(total_tagihan_pemesanan).toLocaleString("id-ID"));

                $('#berat_pemesanan').val(berat);
                $('#total_belanja_pemesanan').val(total_belanja_pemesanan);
                $('#total_tagihan_pemesanan').val(total_tagihan_pemesanan);
                $('#kurir_pemesanan').val(kurir+'|'+hujan[0]['service']+'|'+hujan[0]['cost'][0]['etd']+'|'+hujan[0]['cost'][0]['value']);
            }
        });    
    });

    $(".layanan").change(function() {
        var total_belanja_pemesanan = $('#total_belanja_pemesanan').val();
        var berat = $('#berat_pemesanan').val();
        var layanan = $('#layanan').val();
        var myarr = layanan.split("|");
        var total_tagihan_pemesanan = parseFloat(total_belanja_pemesanan) + parseFloat(myarr[3]);

        $('#text_total_belanja_pemesanan_2').text(new Number(total_belanja_pemesanan).toLocaleString("id-ID"));
        $('#text_tarif_kurir').text(new Number(myarr[3]).toLocaleString("id-ID"));
        $('#text_berat').text(new Number(berat/1000).toLocaleString("id-ID"));
        $('#text_total_tagihan_pemesanan').text(new Number(total_tagihan_pemesanan).toLocaleString("id-ID"));

        $('#berat_pemesanan').val(berat);
        $('#total_belanja_pemesanan').val(total_belanja_pemesanan);
        $('#total_tagihan_pemesanan').val(total_tagihan_pemesanan);
        $('#kurir_pemesanan').val(layanan);
    });

    $('#btn_checkout').on("click",function(){
        $('#form_checkout').validate({
            rules: {
                metode_pengiriman_pemesanan: {
                    required: true,
                },
                rekening_pemesanan: {
                    required: true,
                },
                kurir: {
                    required: true,
                },
                layanan: {
                    required: true,
                },
            },
            messages: {
                metode_pengiriman_pemesanan: {
                    required: "Harus diisi",
                },
                rekening_pemesanan: {
                    required: "Harus diisi",
                },
                kurir: {
                    required: "Harus diisi",
                },
                layanan: {
                    required: "Harus diisi",
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
                $.ajax({
                    url : '<?php echo base_url('home/checkout'); ?>',
                    method: 'POST',
                    data: $('#form_checkout').serialize(),
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
                        if(response=="Gagal"){
                            Swal.fire({
                                icon: 'warning',
                                title: 'Gagal!',
                                text: response,
                                showConfirmButton: true,
                                confirmButtonColor: '#ffc107',
                            })
                        }else{
                            Swal.fire({
                                icon: 'success',
                                title: 'Checkout Berhasil!',
                                showConfirmButton: true,
                                confirmButtonColor: '#ffc107',
                            }).then(function(){
                                window.location.replace("<?php echo base_url('transaksi'); ?>");
                            });
                        }
                    }
                });   
            }
        });
    });
</script>
