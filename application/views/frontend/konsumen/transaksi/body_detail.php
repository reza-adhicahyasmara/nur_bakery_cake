<?php
    $kode_pemesanan = $data_pemesanan['kode_pemesanan'];
    $id_karyawan = $data_pemesanan['id_karyawan'];
    $status_pemesanan = $data_pemesanan['status_pemesanan'];
    $total_tagihan_pemesanan = $data_pemesanan['total_tagihan_pemesanan'];
    $bukti_pby_pemesanan = $data_pemesanan['bukti_pby_pemesanan'];
    $status_pby_pemesanan = $data_pemesanan['status_pby_pemesanan'];
    $metode_pengiriman_pemesanan = $data_pemesanan['metode_pengiriman_pemesanan'];
    $keterangan_pemesanan = $data_pemesanan['keterangan_pemesanan'];
    
    $badge_menunggu_transfer = "<span class='badge rounded-pill bg-secondary text-sm p-2' style='width:100%'>Menunggu Transfer</span>";
    $badge_validasi_pembayaran = "<span class='badge rounded-pill bg-secondary text-sm p-2' style='width:100%'>Validasi Pembayaran</span>";
    $badge_proses_pembuatan = "<span class='badge rounded-pill bg-secondary text-sm p-2' style='width:100%'>Proses Pembuatan</span>";
    $badge_pengiriman =  "<span class='badge rounded-pill bg-secondary text-sm p-2' style='width:100%'>Produk Dikirim</span>";
    $badge_pengambilan =  "<span class='badge rounded-pill bg-secondary text-sm p-2' style='width:100%'>Produk Siap Ambil</span>";
    $badge_selesai = "<span class='badge rounded-pill bg-success text-sm p-2' style='width:100%'>Selesai</span>";
    $badge_batal = "<span class='badge rounded-pill bg-danger text-sm p-2' style='width:100%'>Batal</span>";
?>

<input type="hidden" id="id_konsumen" value="<?php echo $data_pemesanan['id_konsumen']; ?>">
<input type="hidden" id="kode_pemesanan" value="<?php echo $kode_pemesanan; ?>">
<input type="hidden" id="id_karyawan" value="<?php echo $id_karyawan; ?>">
<input type="hidden" id="metode_pengiriman_pemesanan" value="<?php echo $metode_pengiriman_pemesanan; ?>">
<input type="hidden" id="status_pemesanan" value="<?php echo $status_pemesanan; ?>">
<input type="hidden" id="status_poin_pemesanan" value="<?php echo $data_pemesanan['status_poin_pemesanan']; ?>">
<input type="hidden" id="status_pby_pemesanan" value="<?php echo $status_pby_pemesanan; ?>">
<input type="hidden" id="total_tagihan_pemesanan" value="<?php echo $total_tagihan_pemesanan; ?>">

<div class="row">
    <div class="col-lg-8 col-12">
        <div class="container">
            <div class="col-lg-12 align-items-stretch">
                <div class="row">
                    <div class="col-lg-8 align-items-stretch">
                        <span class="text-bold fs-6">Transaksi</span>
                        <table class="table-borderless">
                            <caption></caption>
                            <thead>
                                <tr>
                                    <th style="width: 48%; vertical-align: top;" id=""><small>Kode Pemesanan</small></th>
                                    <td style="width: 5%; vertical-align: top;"><small>:</small></td>
                                    <td style="vertical-align: top;"><small><?php echo $kode_pemesanan; ?></small></td>
                                </tr>
                                <tr>
                                    <th style="width: 48%; vertical-align: top;" id=""><small>Tanggal Pemesanan</small></th>
                                    <td style="width: 5%; vertical-align: top;"><small>:</small></td>
                                    <td style="vertical-align: top;"><small><?php echo $data_pemesanan['tanggal_pemesanan']; ?></small></td>
                                </tr>
                                <tr>
                                    <th id="" style="width: 48%; vertical-align: top;"><small>Metode Pemesanan</small></th>
                                    <td style="width: 5%; vertical-align: top;"><small>:</small></td>
                                    <td style="vertical-align: top;"><small><?php echo $data_pemesanan['metode_pengiriman_pemesanan']; ?></small></td>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    <div class="col-lg-4 align-items-stretch">

                        <div class="form-group">
                            <?php
                                if($status_pemesanan == 1){
                                    echo $badge_menunggu_transfer;
                                } elseif($status_pemesanan == 2){
                                    echo $badge_validasi_pembayaran;
                                } elseif($status_pemesanan == 3){
                                    echo $badge_proses_pembuatan;
                                } elseif($status_pemesanan == 4){
                                    echo $badge_pengiriman;
                                } elseif($status_pemesanan == 5){
                                    echo $badge_pengambilan;
                                } elseif($status_pemesanan == 6){
                                    echo $badge_selesai;
                                } elseif($status_pemesanan == 7){
                                    echo $badge_batal;
                                }
                            ?>
                        </div>
                    </div>
                </div>
                
            </div>
            <hr>
            <div class="col-lg-12 align-items-stretch">
                <?php 
                    $kurir = explode("|",$data_pemesanan['kurir_pemesanan']);
                    if($data_pemesanan['metode_pengiriman_pemesanan'] == "Ambil Sendiri") {?>
                    <span class="text-bold fs-6">Info Pengambilan</span>
                <?php }else{ ?>
                    <span class="text-bold fs-6">Info Pengiriman</span>
                <?php } ?>
                <table class="table-borderless">
                    <caption></caption>
                    <thead>
                        <?php if($data_pemesanan['metode_pengiriman_pemesanan'] == "Ekspedisi"){ ?>
                            <tr>
                                <th id="" style="width: 20%; vertical-align: top;"><small>Kurir</small></th>
                                <td style="width: 5%; vertical-align: top;"><small>:</small></td>
                                <td style="vertical-align: top;"><small><?php echo $kurir[0]." - ".$kurir[1]." (".$kurir[2]." Hari)"; ?></td>
                            </tr>
                            <tr>
                                <th id="" style="width: 20%; vertical-align: top;"><small>Resi</small></th>
                                <td style="width: 5%; vertical-align: top;"><small>:</small></td>
                                <td style="vertical-align: top;"><small>
                                    <?php echo $data_pemesanan['noresi_pemesanan']; 
                                        if($data_pemesanan['noresi_pemesanan'] != ""){
                                    ?>
                                            <a href="<?php echo "https://parcelsapp.com/id/tracking/".$data_pemesanan['noresi_pemesanan']; ?>" class="btn btn-sm btn-outline-primary" target="_blank" style="margin-top: -5px;"><span class="bx bx-fw bx-search"></span>Lacak</a>
                                    <?php 
                                        } else {
                                            echo "-";
                                        }
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <th id="" style="width: 20%; vertical-align: top;"><small>Alamat</small></th>
                                <td style="width: 5%; vertical-align: top;"><small>:</small></td>
                                <td style="vertical-align: top;"><small><?php echo "<b>".$data_pemesanan["nama_konsumen"]."</b><br>";
                                        $alamat_konsumen = explode("-", $data_pemesanan['alamat_konsumen']); 
                                        echo $alamat_konsumen[0]." RT ".$alamat_konsumen[1]." RW ".$alamat_konsumen[2]." Desa/Lingk. ".$data_pemesanan['nama_desa'].", kec. ".$data_pemesanan['nama_kecamatan'].", kab. ".$data_pemesanan['nama_kabupaten'].", prov. ".$data_pemesanan['nama_provinsi'];
                                    ?>
                                </td>
                            </tr>
                        <?php } elseif($data_pemesanan['metode_pengiriman_pemesanan'] == "Antar Cepat") {?>
                        <tr>
                            <th id="" style="width: 20%; vertical-align: top;"><small>Kurir</small></th>
                            <td style="width: 5%; vertical-align: top;"><small>:</small></td>
                            <td style="vertical-align: top;"><small><?php echo $kurir[0]." - ".$kurir[1]." (".$kurir[2]." Hari)"; ?></td>
                        </tr>
                        <tr>
                            <th id="" style="width: 20%; vertical-align: top;"><small>Pramuniaga</small></th>
                            <td style="width: 5%; vertical-align: top;"><small>:</small></td>
                            <td style="vertical-align: top;"><small><?php echo $data_pemesanan['nama_karyawan']; ?></td>
                        </tr>
                        <tr>
                            <th id="" style="width: 20%; vertical-align: top;"><small>Alamat</small></th>
                            <td style="width: 5%; vertical-align: top;"><small>:</small></td>
                            <td style="vertical-align: top;"><small><?php echo "<b>".$data_pemesanan["nama_konsumen"]."</b><br>";
                                    $alamat_konsumen = explode("-", $data_pemesanan['alamat_konsumen']); 
                                    echo $alamat_konsumen[0]." RT ".$alamat_konsumen[1]." RW ".$alamat_konsumen[2]." Desa/Lingk. ".$data_pemesanan['nama_desa'].", kec. ".$data_pemesanan['nama_kecamatan'].", kab. ".$data_pemesanan['nama_kabupaten'].", prov. ".$data_pemesanan['nama_provinsi'];
                                ?>
                            </td>
                        </tr>
                        <?php } elseif($data_pemesanan['metode_pengiriman_pemesanan'] == "Ambil Sendiri") {?>
                        <tr>
                            <th id="" style="width: 20%; vertical-align: top;"><small>Prosedur</small></th>
                            <td style="width: 5%; vertical-align: top;"><small>:</small></td>
                            <td style="vertical-align: top;"><small>Pengambilan produk dapat dilakukan pada saat status pemesanan "PRODUK SIAP DIAMBIL"</td>
                        </tr>
                        <?php } ?>
                    </thead>
                </table>
            </div>
            <hr>
            <div class="col-lg-12 align-items-stretch">
                <span class="text-bold fs-6">Info Pembayaran</span>
                <table class="table-borderless">
                    <caption></caption>
                        <tr>
                            <th id="" style="width: 20%; vertical-align: top;"><small>Transfer Rekening</small></th>
                            <td style="width: 5%; vertical-align: top;"><small>:</small></td>
                            <td style="vertical-align: top;"><small><?php echo $data_pemesanan['rekening_pemesanan']; ?></td>
                        </tr>
                        <tr>
                            <th id="" style="width: 20%; vertical-align: top;"><small>Total Belanja</small></th>
                            <td style="width: 5%; vertical-align: top;"><small>:</small></td>
                            <td style="vertical-align: top;"><small><?php echo "Rp. ".number_format($data_pemesanan['total_belanja_pemesanan'], 0, ".", ".") ?></td>
                        </tr>
                        <tr>
                            <th id="" style="width: 20%; vertical-align: top;"><small>Ongkos Kirim</small></th>
                            <td style="width: 5%; vertical-align: top;"><small>:</small></td>
                            <td style="vertical-align: top;"><small><?php echo "Rp. ".number_format($kurir[3], 0, ".", ".")." (".number_format($data_pemesanan['berat_pemesanan']/1000, 2, ".", ".")." Kg)"; ?></td>
                        </tr>
                        <tr>
                            <th id="" style="width: 20%; vertical-align: top;"><small>Potongan Harga</small></th>
                            <td style="width: 5%; vertical-align: top;"><small>:</small></td>
                            <td style="vertical-align: top;"><small><?php echo "Rp. -".number_format($data_pemesanan['potongan_pemesanan'], 0, ".", "."); ?></td>
                        </tr>
                        <tr>
                            <th id="" style="width: 20%; vertical-align: top;"><small>Total Tagihan</small></th>
                            <td style="width: 5%; vertical-align: top;"><small>:</small></td>
                            <td style="vertical-align: top;"><small><?php echo "Rp. ".number_format($data_pemesanan['total_tagihan_pemesanan'], 0, ".", ".") ?></td>
                        </tr>
                        <tr>
                            <th id="" style="width: 20%; vertical-align: top;"><small>Status Pembayaran</small></th>
                            <td style="width: 5%; vertical-align: top;"><small>:</small></td>
                            <td>
                                <?php 
                                    if($status_pby_pemesanan == "Belum Dibayarkan"){
                                        echo "<span class='badge bg-danger fs-6'>Belum Dibayarkan</span>";
                                    } elseif($status_pby_pemesanan == "Sudah Ditransfer"){
                                        echo "<span class='badge bg-warning fs-6'>Sudah Ditransfer</span>";
                                    } elseif($status_pby_pemesanan == "Lunas"){
                                        echo "<span class='badge bg-success fs-6'>Lunas</span>";
                                    } elseif($status_pby_pemesanan == "Dana Dikembalikan"){
                                        echo "<span class='badge bg-secondary fs-6'>Dana Dikembalikan</span>";
                                    } elseif($status_pby_pemesanan == "Cash on Delivery"){
                                        echo "<span class='badge bg-primary fs-6'>Cash on Delivery</span>";
                                    } 
                                ?>
                            </td>
                        </tr>
                    </thead>
                </table>
            </div>
            <hr>
            <br>
            <span class="text-bold fs-6">Daftar Produk</span>
            <div class="row justify-content-md-center">
                <div class="portfolio-info col-md-12 col-lg-12 col-12" style="border-radius: 10px">  
                    <?php 
                        $total_tagihan_pemesanan = 0;
                        foreach($data_produk as $item){
                            if($item->status_ipemesanan > 1 ){
                    ?>      
                        <div class="row justify-content-md-center">
                            <div class="col-md-3 col-12">
                                <div class="" style="text-align: center;">
                                    <?php if($item->gambar_produk != "" || $item->gambar_produk != null){ ?>
                                        <img src="<?php echo base_url('assets/img/produk/').$item->gambar_produk; ?>" alt="" style="border-radius: 10px; width: 100px; height: 100px;  object-fit: cover; ">
                                    <?php }else{ ?>
                                        <img src="<?php echo base_url('assets/img/banner/logo.png'); ?>" alt="" style="border-radius: 10px; width: 100px; height: 100px;  object-fit: cover; ">
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <span class="text-bold ts-5"><?php echo $item->nama_produk; ?></span> 
                                <br>
                                <?php 
                                    if($item->diskon_ipemesanan != 0){
                                        $diskon_ipemesanan = $item->diskon_ipemesanan;
                                        $harga_ipemesanan = $item->harga_ipemesanan;
                                        $harga_promo = $harga_ipemesanan - (($diskon_ipemesanan * $harga_ipemesanan) / 100);
                                ?>
                                    <input type="hidden" class="form-control" id="harga_ipemesanan" value="<?php echo $harga_promo; ?>" readonly>
                                    <span class="badge bg-success"><?php echo $diskon_ipemesanan; ?>%</span>
                                    <del>Rp. <?php echo number_format($harga_ipemesanan, 0, ".", "."); ?></del>
                                    <br>
                                    <span>
                                        Rp. 
                                        <?php
                                            echo $total_harga = number_format($harga_promo, 0, ".", ".")." X ".
                                            number_format($qty_ipemesanan = $item->qty_ipemesanan, 0, ".", ".")." = ".
                                            number_format($harga_promo * $qty_ipemesanan, 0, ".", ".");
                                        ?>
                                    </span>
                                <?php 
                                    } else { 
                                ?>
                                    <input type="hidden" class="form-control" id="harga_ipemesanan" value="<?php echo $item->harga_ipemesanan; ?>" readonly>
                                    <span>
                                        Rp.
                                        <?php 
                                            echo number_format($harga_ipemesanan = $item->harga_ipemesanan, 0, ".", ".")." X ". 
                                            $total_harga = number_format($qty_ipemesanan = $item->qty_ipemesanan, 0, ".", ".")." = ".
                                            number_format($harga_ipemesanan * $qty_ipemesanan, 0, ".", ".");
                                        ?>
                                    </span>
                                <?php } ?>                                
                                <br>
                                <small>Berat <?php echo number_format(($qty_ipemesanan * $item->berat_ukuran)/1000, 2, ",", "."). " Kg" ; ?></small>
                            </div>
                            <div class="col-md-3" style="margin-top: 5%; text-align:center">
                                <a class='btn btn-outline-success btn-sm btn-rounded rounded-pill' href="<?php echo base_url('home/detail_produk/').$item->kode_produk; ?>" style="margin:3px">Beli Lagi</a>
                            </div>
                        </div>
                        <hr>
                    <?php     
                                $total_tagihan_pemesanan += $item->subtotal_ipemesanan;
                            } 
                    ?>   
                    <?php 
                        } 
                    ?>
                </div>
            </div>
        </div>



        <?php if($status_pemesanan == 7){ ?>        
            <section id="portfolio-details" class="portfolio-details">
                <div class="container">
                    <div class="portfolio-info" style="border-radius: 10px">
                        <span class="text-bold fs-4">Keterangan Pemesanan Pembatalan</span>
                        <br>
                        <span class="text-bold fs-6"><?php echo $keterangan_pemesanan; ?></span>
                    </div>
                </div>
            </section>
        <?php } ?>
    </div>
    <div class="col-lg-4 col-12">
        <div class="container mb-5">
            <div class="form-group">
                <?php if($status_pemesanan >= 1 && $bukti_pby_pemesanan == "") { ?>    
                    <span class="fs-6">Total Tagihan</span>
                    <br>
                    <span class="text-bold fs-5">
                        <b>Rp. <?php echo number_format($data_pemesanan['total_tagihan_pemesanan'], 0, ".", "."); ?></b>
                    </span>
                    <br>
                    <span class="fs-6">Rekening Tujuan</span>
                    <br>
                    <span class="text-bold fs-5">
                        <?php 
                            $rekening = explode("-",$data_pemesanan['rekening_pemesanan']);
                            echo $rekening[2]."<br>".$rekening[0]."<br>".$rekening[1]; 
                        ?>
                    </span>
                    <br>
                    <br>
                    <div class="justify-content-md-center" style="text-align: center">
                        <?php if($bukti_pby_pemesanan == "") { ?>
                            <input type="hidden" name="kode_pemesanan_pembayaran" id="kode_pemesanan_pembayaran" value="<?php echo $kode_pemesanan;?>" />
                            <div class="d-flex justify-content-center">
                                <div class="form-group mb-3 text-center">
                                    <label class="btn btn-sm">
                                        <div class="form-control" style="padding: 0px; width:180px; height: 180px;">
                                            <img src="<?php echo base_url('assets/img/banner/receipt.svg');?>" class="product-image" id="blah" alt="Gambar Promo" style="border-radius: 3px; width:180px; height:180px; object-fit: cover; ">  
                                        </div>
                                        <input accept="image/*,application/pdf" type="file" id="bukti_pby_pemesanan" name="file" style="display: none;"/>                
                                    </label>
                                </div>
                            </div>
                            </br>
                            <button type="button" class="btn btn-outline-success rounded-pill btn_simpan_pembayaran" style="width:100%" kode_pemesanan = <?php echo $kode_pemesanan; ?>><span class="bx bx-fw bx-upload"></span>Upload Pemabayaran</button>
                        <?php }  ?>
                        </br>
                    </div>  
                <?php } else if($status_pemesanan >= 1 && $bukti_pby_pemesanan != "") { ?> 
                    <span class="fs-6">Bukti Pembayaran</span> 
                    <div style="text-align: center;">
                        <?php 
                            $arr_str = explode(".",$bukti_pby_pemesanan);
                            
                            $string_buntut = end($arr_str);
                            if($string_buntut == "pdf"){
                        ?>
                            <object data="<?php echo base_url('assets/img/pemesanan/'.$bukti_pby_pemesanan);?>" type="application/pdf" style="width: 100%; height: 500px; display:inline-block;"></object>
                        <?php }else{ ?>
                            <div style="border-radius:5px; border:1px solid #ced4da; width:100%; padding:5%;">
                                <img alt="bukti pembayaran" src="<?php echo base_url('assets/img/pemesanan/'.$bukti_pby_pemesanan); ?>" style="width: 100%; height: 500px; object-fit: cover;" >
                            </div>
                        <?php } ?>
                    </div>
                <?php } ?>
            </div>
            <?php if($status_pemesanan == 4 || $status_pemesanan == 5){ ?>
                <div class="form-group">
                    <button type="button" class="btn btn-outline-primary rounded-pill" id="btn_penerimaan_produk" style="width:100%"><span class="fa fa-check"></span> Selesaikan Pemesanan</button>
                </div>
            <?php } ?>
            <div class="form-group">
                <a href="<?php echo base_url('home/invoice/').$kode_pemesanan;?>" class="btn btn-outline-warning rounded-pill" target="_blank" style="width:100%"><span class="bx bx-fw bxs-printer"></span>Cetak Invoice</a>
            </div>
        </div>
    </div>
</div>



<!-----------------------PEMBAYARAN----------------------->

<script type="text/javascript">   
    $(document).ready(()=>{
        $('input#bukti_pby_pemesanan').change(function(){
            const file = this.files[0];
            var ext = file.name.split('.').pop();
            if (file){
                if(ext == "pdf") {
                    $('img#blah').attr('src','<?php echo base_url("assets/img/banner/pdf.png"); ?>');
                }else{
                    let reader = new FileReader();
                    reader.onload = function(event){
                        $('img#blah').attr('src', event.target.result);
                    }
                    reader.readAsDataURL(file);
                }
            }
        });
    });

      
    $('.btn_simpan_pembayaran').on("click",function(e){
        $.ajax({
            url : '<?php echo base_url('home/upload_pembayaran'); ?>',
            method: 'POST',
            data: new FormData($('form#form_upload_pembayaran')[0]),
            processData:false,
            contentType:false,
            cache:false,
            async:false,
            success: function(response){
                if(response==1){
                        Swal.fire({
                        icon: 'success',
                        title: 'Berhasil diupload!',
                        showConfirmButton: true,
                        timer: 3000
                    }).then(function(){
                        window.location.reload();
                    })
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: response,
                        showConfirmButton: true,
                        timer: 3000
                    })
                }
            }
        });
    });
</script>


<!-----------------------PENERIMAAN PRODUK----------------------->
<script>
    var url_global_penerimaan_produk = '<?php echo base_url('home/verifikasi_proses_produk'); ?>';

    $('button#btn_penerimaan_produk').on("click",function(){
        var id_karyawan = $('#id_karyawan').val();
        var kode_pemesanan = $('#kode_pemesanan').val();
        var metode_pengiriman_pemesanan = $('#metode_pengiriman_pemesanan').val();
        var status_pby_pemesanan = $('#status_pby_pemesanan').val();
        var status_poin_pemesanan = $('#status_poin_pemesanan').val();
        var status_pemesanan = "6";

        Swal.fire({
            title: 'Selesaikan Pemesanan',
            text: 'Apakah anda yakin telah menerima produk',
            type: 'warning',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ffc107',
            cancelButtonColor: '#dc3545',
            confirmButtonText: 'Simpan',
            cancelButtonText: "Tidak",
            showLoaderOnConfirm: true,

            preConfirm: (response) => {       
                $.ajax({
                    url: url_global_penerimaan_produk,
                    method: 'POST',
                    data: {
                        id_karyawan:id_karyawan,
                        kode_pemesanan:kode_pemesanan,
                        metode_pengiriman_pemesanan:metode_pengiriman_pemesanan,
                        status_pby_pemesanan:status_pby_pemesanan,
                        status_poin_pemesanan:status_poin_pemesanan,
                        status_pemesanan:status_pemesanan
                    },   
                    success: function(response){ 
                        if(response==1){
                            Swal.fire({
                                icon: 'success',
                                title: 'Data telah diupdate!',
                                showConfirmButton: true,
                                timer: 3000
                            }).then(function(){
                                window.location.reload();
                            })
                        }else {
                            Swal.fire({
                                icon: 'warning',
                                title: response,
                                showConfirmButton: true,
                                timer: 3000
                            })
                        }
                    }
                })
            },
        });
    });
</script>