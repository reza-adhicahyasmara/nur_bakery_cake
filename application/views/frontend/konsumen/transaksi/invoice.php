<?php $this->load->view('frontend/partials/head.php') ?>

<section id="portfolio-details" class="portfolio-details">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div class="d-flex justify-content-center ">
            <img src="<?php echo base_url('assets/img/banner/bx-cake.svg'); ?>" class="brand-image" alt="Image" style="width: 60px;">
            <h1 class="text-bold ml-2 mt-3">Nur bakery & Cake</h1>
        </div>
        <div>
            <span class="text-bold fs-4">Invoice</span>
            <br>
            <span class="text-bold fs-6"><?php echo $data_pemesanan['kode_pemesanan']; ?></span>
        </div>
    </div>
    <hr>
    <div class="row mb-3">
        <div class="col-6 mb-3">
            <span class="text-bold fs-6">Diterbitkan Oleh</span>
            <table class="table-borderless">
                <caption></caption>
                <tr>
                    <th id="" style="width: 30%; vertical-align: top;"><small>Penjual</small></th>
                    <td style="width: 5%; vertical-align: top;"><small>:</small></td>
                    <td style="vertical-align: top;"><small>Nur Bakery & Cake</td>
                </tr>
            </table>
        </div>
        <div class="col-6 mb-3">
            <span class="text-bold fs-6">Untuk</span>
            <table class="table-borderless">
                <caption></caption>
                <thead>
                    <tr>
                        <th id="" style="width: 30%; vertical-align: top;"><small>Pembeli</small></th>
                        <td style="width: 5%; vertical-align: top;"><small>:</small></td>
                        <td style="vertical-align: top;"><small><?php echo $data_pemesanan['nama_konsumen']; ?></td>
                    </tr>
                    <tr>
                        <th id="" style="width: 30%; vertical-align: top;"><small>Tanggal Pemesanan</small></th>
                        <td style="width: 5%; vertical-align: top;"><small>:</small></td>
                        <td style="vertical-align: top;"><small><?php echo $data_pemesanan['tanggal_pemesanan']; ?></td>
                    </tr>
                    <tr>
                        <th id="" style="width: 30%; vertical-align: top;"><small>Alamat</small></th>
                        <td style="width: 5%; vertical-align: top;"><small>:</small></td>
                        <td style="vertical-align: top;"><small><?php echo "<b>".$data_pemesanan["kontak_konsumen"]."</b><br>";
                                $alamat_konsumen = explode("-", $data_pemesanan['alamat_konsumen']); 
                                echo $alamat_konsumen[0]." RT ".$alamat_konsumen[1]." RW ".$alamat_konsumen[2]." Desa/Lingk. ".$data_pemesanan['nama_desa'].", kec. ".$data_pemesanan['nama_kecamatan'].", kab. ".$data_pemesanan['nama_kabupaten'].", prov. ".$data_pemesanan['nama_provinsi'];
                            ?>
                        </td>
                    </tr>
                    
                </thead>
            </table>
        </div>
    </div>
    <table style="width:100%" id="datatable_admin" class="table">
        <caption></caption>
        <thead>
            <tr>
                <th id="" style="text-align: center; vertical-align: middle; "><strong>Nama Produk</strong></th>
                <th id="" style="text-align: center; vertical-align: middle; "><strong>Jumlah</strong></th>
                <th id="" style="text-align: center; vertical-align: middle; "><strong>Harga Satuan</strong></th>
                <th id="" style="text-align: center; vertical-align: middle; "><strong>Potongan</strong></th>
                <th id="" style="text-align: center; vertical-align: middle; "><strong>Total Harga</strong></th>
            </tr>
        </thead>
        <tbody>
            <?php 
                $jumlah_produk = 0;
                $jumlah_berat = 0;
                $total_tagihan_pemesanan = 0;
                foreach($data_produk as $item){
                    if($item->status_ipemesanan > 1 ){
            ?>
            <tr>
                <td class="text-sm" style="text-align: left; vertical-align: middle;"><?php echo $item->nama_produk." - ".$item->volume_ukuran;?></td>
                <td class="text-sm" style="text-align: right; vertical-align: middle;"><?php echo number_format($item->qty_ipemesanan, 0, ".", ".");?></td>
                <td class="text-sm" style="text-align: right; vertical-align: middle;"><?php echo "Rp ".number_format($item->harga_ipemesanan, 0, ".", ".");?></td>
                <td class="text-sm" style="text-align: right; vertical-align: middle;"><?php echo number_format($item->diskon_ipemesanan, 0, ".", ".")."%";?></td>
                <td class="text-sm" style="text-align: right; vertical-align: middle;"><?php echo "Rp ".number_format($item->subtotal_ipemesanan, 0, ".", ".");?></td>
            </tr>
            <?php      
                        $jumlah_berat += $item->berat_ukuran;
                        $jumlah_produk += 1; 
                    } 
                }
            ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="2" style="border-style: none;"></td>
                <td colspan="2" class="text-sm" style="text-align: left; vertical-align: middle;"><strong>Total Harga (<?php echo $jumlah_produk; ?> Produk) </strong></td>
                <td class="text-sm" style="text-align: right; vertical-align: middle;"><?php echo "Rp ".number_format($data_pemesanan['total_belanja_pemesanan'], 0, ".", ".");?></td>
            </tr>
            <tr>
                <td colspan="2" style="border-style: none;"></td>
                <td colspan="2" class="text-sm" style="text-align: left; vertical-align: middle;"><strong>Ongkos Kirim (<?php echo number_format( $jumlah_berat, 2, ".", ".")?> gram)</strong></td>
                <td class="text-sm" style="text-align: right; vertical-align: middle;">
                    <?php
                        $kurir = explode("|", $data_pemesanan['kurir_pemesanan']);
                        echo "Rp ".number_format($kurir[3], 0, ".", ".");
                    ?>
                </td>
            </tr>
            <tr>
                <td colspan="2" style="border-style: none;"></td>
                <td colspan="2" class="text-sm" style="text-align: left; vertical-align: middle;"><strong>Potongan Harga </strong></td>
                <td class="text-sm" style="text-align: right; vertical-align: middle;"><?php echo "Rp -".number_format($data_pemesanan['potongan_pemesanan'], 0, ".", ".");?></td>
            </tr>
            <tr>
                <td colspan="2" style="border-style: none;"></td>
                <td colspan="2" class="text-sm" style="text-align: left; vertical-align: middle;"><strong>Total Tagihan </strong></td>
                <td class="text-sm" style="text-align: right; vertical-align: middle;"><?php echo "Rp ".number_format($data_pemesanan['total_tagihan_pemesanan'], 0, ".", ".");?></td>
            </tr>
        </tfoot>
    </table>
    <hr>
    
    <div class="row mb-3">
        <div class="col-6 mb-3">
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
                    <tr>
                        <th id="" style="width: 30%; vertical-align: top;"><small>Metode Pemesanan</small></th>
                        <td style="width: 5%; vertical-align: top;"><small>:</small></td>
                        <td style="vertical-align: top;"><small><?php echo $data_pemesanan['metode_pengiriman_pemesanan']; ?></td>
                    </tr>
                    <?php if($data_pemesanan['metode_pengiriman_pemesanan'] == "Ekspedisi"){ ?>
                        <tr>
                            <th id="" style="width: 35%; vertical-align: top;"><small>Kurir</small></th>
                            <td style="width: 5%; vertical-align: top;"><small>:</small></td>
                            <td style="vertical-align: top;"><small><?php echo $kurir[0]." - ".$kurir[1]." (".$kurir[2]." Hari)"; ?></td>
                        </tr>
                        <tr>
                            <th id="" style="width: 35%; vertical-align: top;"><small>Resi</small></th>
                            <td style="width: 5%; vertical-align: top;"><small>:</small></td>
                            <td style="vertical-align: top;"><small>
                                <?php echo $data_pemesanan['noresi_pemesanan']; 
                                    if($data_pemesanan['noresi_pemesanan'] != ""){
                                ?>
                                <?php 
                                    } else {
                                        echo "-";
                                    }
                                ?>
                            </td>
                        </tr>
                    <?php } elseif($data_pemesanan['metode_pengiriman_pemesanan'] == "Antar Cepat") {?>
                    <tr>
                        <th id="" style="width: 35%; vertical-align: top;"><small>Kurir</small></th>
                        <td style="width: 5%; vertical-align: top;"><small>:</small></td>
                        <td style="vertical-align: top;"><small><?php echo $kurir[0]." - ".$kurir[1]." (".$kurir[2]." Hari)"; ?></td>
                    </tr>
                    <tr>
                        <th id="" style="width: 35%; vertical-align: top;"><small>Pramuniaga</small></th>
                        <td style="width: 5%; vertical-align: top;"><small>:</small></td>
                        <td style="vertical-align: top;"><small><?php echo $data_pemesanan['nama_karyawan']; ?></td>
                    </tr>
                    <?php } elseif($data_pemesanan['metode_pengiriman_pemesanan'] == "Ambil Sendiri") {?>
                    <tr>
                        <th id="" style="width: 35%; vertical-align: top;"><small>Prosedur</small></th>
                        <td style="width: 5%; vertical-align: top;"><small>:</small></td>
                        <td style="vertical-align: top;"><small>Pengambilan produk dapat dilakukan pada saat status pemesanan "PRODUK SIAP DIAMBIL"</td>
                    </tr>
                    <?php } ?>
                </thead>
            </table>
        </div>
        <div class="col-6 mb-3">
            <span class="text-bold fs-6">Info Pemabayaran</span>
            <table class="table-borderless">
                <caption></caption>
                <thead>
                    <tr>
                        <th id="" style="width: 35%; vertical-align: top;"><small>No Rekening</small></th>
                        <td style="width: 5%; vertical-align: top;"><small>:</small></td>
                        <td style="vertical-align: top;"><small><?php $rekening = explode("-",$data_pemesanan['rekening_pemesanan']); echo $rekening[0]; ?></td>
                    </tr>
                    <tr>
                        <th id="" style="width: 35%; vertical-align: top;"><small>Bank / Emoney</small></th>
                        <td style="width: 5%; vertical-align: top;"><small>:</small></td>
                        <td style="vertical-align: top;"><small><?php echo $rekening[1]; ?></td>
                    </tr>
                    <tr>
                        <th id="" style="width: 35%; vertical-align: top;"><small>Atas Nama</small></th>
                        <td style="width: 5%; vertical-align: top;"><small>:</small></td>
                        <td style="vertical-align: top;"><small><?php echo $rekening[2]; ?></td>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</section>

<?php $this->load->view('frontend/partials/script.php') ?>

<!-----------------------FUNGSI----------------------->
<script>
    $(document).ready(function() {  
        $("#topbar").remove(".fixed-top");
        $("header").remove("#header");
        $("nav").remove(".navbarr");
        $("a").remove(".active");
        window.print();
    });
</script>