<?php $this->load->view('frontend/partials/head.php') ?>

    <section id="portfolio-details" class="portfolio-details">
        <h3 class="text-center">Invoice</h3>
        <h6 class="text-center"><?php echo $data_detail['kode_pemesanan']; ?></h6>
        <br>
        <div class="col-lg-12 align-items-stretch">
            <h4>Transaksi</h4>
            <table class="table table-borderless fs-6">
                <caption></caption>
                <thead>
                    <tr>
                        <th style="width: 30%; vertical-align: top;" id="">Tanggal Pemesanan</th>
                        <td style="width: 5%; vertical-align: top;">:</td>
                        <td style="width: 75%; vertical-align: top;"><?php echo $data_detail['tanggal_pemesanan']; ?></td>
                    </tr>
                    <tr>
                        <th id="" style="width: 30%; vertical-align: top;">Metode Pemesanan</th>
                        <td style="width: 5%; vertical-align: top;">:</td>
                        <td style="width: 75%; vertical-align: top;"><?php echo $data_detail['metode_pby_pemesanan']; ?></td>
                    </tr>
                    <tr>
                        <th id="" style="width: 30%; vertical-align: top;">Status Transaksi</th>
                        <td style="width: 5%; vertical-align: top;">:</td>
                        <td style="width: 75%; vertical-align: top;">
                            <?php
                                if($data_detail['status_pemesanan'] == 1 && $data_detail['metode_pby_pemesanan'] == "Transfer"){
                                    echo "Menunggu Transfer";
                                } elseif($data_detail['status_pemesanan'] == 1 && $data_detail['metode_pby_pemesanan'] == "Cash on Delivery"){
                                    echo "Menunggu Konfirmasi";
                                } elseif($data_detail['status_pemesanan'] == 2){
                                    echo "Verifikasi Transfer";
                                } elseif($data_detail['status_pemesanan'] == 3){
                                    echo "Proses Produk";
                                } elseif($data_detail['status_pemesanan'] == 4){
                                    echo "Produk Dikirim";
                                } elseif($data_detail['status_pemesanan'] == 5){
                                    echo "Selesai";
                                } elseif($data_detail['status_pemesanan'] == 6){
                                    echo "Batal";
                                } elseif($data_detail['status_pemesanan'] == 7){
                                    echo "Komplain";
                                }
                            ?>
                        </td>
                    </tr>
                </thead>
            </table>
        </div>
        <hr>
        <div class="col-lg-12 align-items-stretch">
            <h4>Info Pengiriman</h4>
            <table class="table table-borderless fs-6">
                <caption></caption>
                <thead>
                    <tr>
                        <th id="" style="width: 30%; vertical-align: top;">Kurir</th>
                        <td style="width: 5%; vertical-align: top;">:</td>
                        <td style="width: 75%; vertical-align: top;"><?php $kurir = explode("|",$data_detail['kurir_pemesanan']); echo $kurir[0]." - ".$kurir[1]." (".$kurir[2]." Hari)"; ?></td>
                    </tr>
                    <?php if($data_detail['metode_pby_pemesanan'] == "Transfer"){ ?>
                        <tr>
                            <th id="" style="width: 30%; vertical-align: top;">Resi</th>
                            <td style="width: 5%; vertical-align: top;">:</td>
                            <td style="width: 75%; vertical-align: top;">
                                <?php echo $data_detail['noresi_pemesanan']; 
                                    if($data_detail['noresi_pemesanan'] != ""){
                                ?>
                                <?php 
                                    } else {
                                        echo "-";
                                    }
                                ?>
                            </td>
                        </tr>
                    <?php } else {?>
                    <tr>
                        <th id="" style="width: 30%; vertical-align: top;">Pramuniaga</th>
                        <td style="width: 5%; vertical-align: top;">:</td>
                        <td style="width: 75%; vertical-align: top;"><?php echo $data_detail['nama_karyawan']; ?></td>
                    </tr>
                    <?php } ?>
                    <tr>
                        <th id="" style="width: 30%; vertical-align: top;">Alamat</th>
                        <td style="width: 5%; vertical-align: top;">:</td>
                        <td style="width: 75%; vertical-align: top;"><?php echo "<b>".$data_detail["nama_customer"]."</b><br>";
                                $alamat_customer = explode("-", $data_detail['alamat_customer']); 
                                echo $alamat_customer[0]." RT ".$alamat_customer[1]." RW ".$alamat_customer[2]." Desa/Lingk. ".$data_detail['nama_desa'].", kec. ".$data_detail['nama_kecamatan'].", kab. ".$data_detail['nama_kabupaten'].", prov. ".$data_detail['nama_provinsi'];
                            ?>
                        </td>
                    </tr>
                </thead>
            </table>
        </div>
        <hr>
        <div class="col-lg-12 align-items-stretch">
            <h4>Info Pembayaran</h4>
            <table class="table table-borderless fs-6">
                <caption></caption>
                    <tr>
                        <th id="" style="width: 30%; vertical-align: top;">Transfer Rekening</th>
                        <td style="width: 5%; vertical-align: top;">:</td>
                        <td style="width: 75%; vertical-align: top;"><?php echo $data_detail['rekening_pemesanan']; ?></td>
                    </tr>
                    <tr>
                        <th id="" style="width: 30%; vertical-align: top;">Total Belanja</th>
                        <td style="width: 5%; vertical-align: top;">:</td>
                        <td style="width: 75%; vertical-align: top;"><?php echo "Rp. ".number_format($data_detail['total_belanja_pemesanan'], 0, ".", ".") ?></td>
                    </tr>
                    <tr>
                        <th id="" style="width: 30%; vertical-align: top;">Ongkos Kirim</th>
                        <td style="width: 5%; vertical-align: top;">:</td>
                        <td style="width: 75%; vertical-align: top;"><?php echo "Rp. ".number_format($kurir[3], 0, ".", ".")." (".number_format($data_detail['berat_pemesanan']/1000, 2, ".", ".")." Kg)"; ?></td>
                    </tr>
                    <tr>
                        <th id="" style="width: 30%; vertical-align: top;">Total Tagihan</th>
                        <td style="width: 5%; vertical-align: top;">:</td>
                        <td style="width: 75%; vertical-align: top;"><?php echo "Rp. ".number_format($data_detail['total_tagihan_pemesanan'], 0, ".", ".") ?></td>
                    </tr>
                    <tr>
                        <th id="" style="width: 30%; vertical-align: top;">Status Pembayaran</th>
                        <td style="width: 5%; vertical-align: top;">:</td>
                        <td style="width: 75%; vertical-align: top;"><?php echo $data_detail['status_pby_pemesanan']; ?></td>
                    </tr>
                </thead>
            </table>
        </div>
        <br>
        <h4>Daftar Produk</h4>
        <br>
        <div class="col-lg-12 d-flex align-items-stretch">
            <table class="table table-bordered">
                <caption></caption>
                <thead>
                    <tr>
                        <th id="" style="text-align: center; vertical-align: middle; ">No.</th>
                        <th id="" style="text-align: center; vertical-align: middle; ">Nama Produk</th>
                        <th id="" style="text-align: center; vertical-align: middle; ">Harga Produk (Rp.)</th>
                        <th id="" style="text-align: center; vertical-align: middle; ">Potongan Harga (%)</th>
                        <th id="" style="text-align: center; vertical-align: middle; ">Jumlah</th>
                        <th id="" style="text-align: center; vertical-align: middle; ">Subtotal (Rp.)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        $no = 1;
                        $total_harga_pemesanan = 0;
                        foreach($list_produk as $item){
                    ?>      
                    <tr>
                        <td style="text-align: center; vertical-align: middle;"><?php echo $no; ?></td>
                        <td style="text-align: left; vertical-align: middle;"><?php echo $item->nama_produk; ?></td>
                        <td style="text-align: right; vertical-align: middle;"><?php echo number_format($item->harga_ipemesanan, 0, ".", "."); ?></td>
                        <td style="text-align: center; vertical-align: middle;"><?php echo $item->potongan_ipemesanan; ?></td>
                        <td style="text-align: center; vertical-align: middle;"><?php echo number_format($item->jumlah_ipemesanan, 0, ".", "."); ?></td>
                        <td style="text-align: right; vertical-align: middle;">
                            <?php 
                               if($item->potongan_ipemesanan != 0){
                                    $harga_promo = $item->harga_ipemesanan - (($item->potongan_ipemesanan * $item->harga_ipemesanan) / 100);
                            ?>
                                 
                                    <?php
                                        echo number_format($harga_promo * $item->jumlah_ipemesanan, 0, ".", ".");
                                    ?>
                            <?php 
                                } else { 
                            ?>
                                <?php 
                                    echo number_format($item->harga_ipemesanan * $item->jumlah_ipemesanan, 0, ".", ".");
                                ?>
                            <?php } ?>
                        </td>
                    </tr>
                </tbody>
            <?php     
                        $total_harga_pemesanan += $item->subtotal_ipemesanan;
                        $no++;
                    } 
            ?>
            </table>
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