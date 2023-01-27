<?php $this->load->view('frontend/partials/head.php') ?>

<?php 
    $link_detail = "transaksi/detail/"; 

    $menunggu_transfer = 0;
    $validasi_pembayaran = 0;
    $proses_pembuatan = 0;
    $pengiriman = 0;
    $pengambilan = 0;
    $selesai = 0;
    $batal = 0;


    foreach($data_pemesanan as $data){
            if($data->status_pemesanan == '1'){
                $menunggu_transfer = $menunggu_transfer + 1;
            }
            if($data->status_pemesanan == '2'){
                $validasi_pembayaran = $validasi_pembayaran + 1;
            }
            if($data->status_pemesanan == '3'){
                $proses_pembuatan = $proses_pembuatan + 1;
            }
            if($data->status_pemesanan == '4'){
                $pengiriman = $pengiriman + 1;
            }
            if($data->status_pemesanan == '6'){
                $pengambilan = $pengambilan + 1;
            }
            if($data->status_pemesanan == '7'){
                $selesai = $selesai + 1;
            }
            if($data->status_pemesanan == '8'){
                $batal = $batal + 1;
            }
    }
    
    $badge_menunggu_transfer = "<span class='badge rounded-pill bg-secondary text-sm'>Menunggu Transfer</span>";
    $badge_validasi_pembayaran = "<span class='badge rounded-pill bg-secondary text-sm'>Validasi Pembayaran</span>";
    $badge_proses_pembuatan = "<span class='badge rounded-pill bg-secondary text-sm'>Proses Pembuatan</span>";
    $badge_pengiriman =  "<span class='badge rounded-pill bg-secondary text-sm'>Produk Dikirim</span>";
    $badge_pengambilan =  "<span class='badge rounded-pill bg-secondary text-sm'>Produk Siap Ambil</span>";
    $badge_selesai = "<span class='badge rounded-pill bg-success text-sm'>Selesai</span>";
    $badge_batal = "<span class='badge rounded-pill bg-danger text-sm'>Batal</span>";
?>

<main id="main">
    <section id="breadcrumbs" class="breadcrumbs" style="margin-top: 80px">

    </section>

    <!-- ======= Menu Section ======= -->
    <section id="menu" class="menu">
        <div class="container">
            <div class="section-title">
                <h2>Daftar <span>Transaksi</span></h2>
            </div>
            <div class="row">
                <div class="col-lg-12 d-flex justify-content-center">
                    <ul id="menu-flters">
                        <li data-filter="*" class="filter-active position-relative">
                            Semua Transaksi 
                        </li>
                        <li data-filter=".filter_menunggu_transfer" class="position-relative">
                            Menunggu Transfer 
                            <?php if($menunggu_transfer != 0){ ?>
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="margin-bottom: -10px;">
                                    <?php echo $menunggu_transfer; ?>
                                </span>
                            <?php } ?>
                        </li>
                        <li data-filter=".filter_validasi_pembayaran" class="position-relative">
                            Validasi Pembayaran 
                            <?php if($validasi_pembayaran != 0){ ?>
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="margin-bottom: -10px;">
                                    <?php echo $validasi_pembayaran; ?>
                                </span>
                            <?php } ?>
                        </li>
                        <li data-filter=".filter_proses_pembuatan" class="position-relative">
                            Proses Pembuatan 
                            <?php if($proses_pembuatan != 0){ ?>
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="margin-bottom: -10px;">
                                    <?php echo $proses_pembuatan; ?>
                                </span>
                            <?php } ?>
                        </li>
                        <li data-filter=".filter_pengiriman" class="position-relative">
                            Produk Dikirim 
                            <?php if($pengiriman != 0){ ?>
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="margin-bottom: -10px;">
                                    <?php echo $pengiriman; ?>
                                </span>
                            <?php } ?>
                        </li>
                        <li data-filter=".filter_pengambilan" class="position-relative">
                            Produk Siap Diambil 
                            <?php if($pengambilan != 0){ ?>
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="margin-bottom: -10px;">
                                    <?php echo $pengambilan; ?>
                                </span>
                            <?php } ?>
                        </li>
                        <li data-filter=".filter_selesai" class="position-relative">
                            Selesai 
                        </li>
                        <li data-filter=".filter_batal" class="position-relative">
                            Batal 
                        </li>
                    </ul>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="row menu-container">
                        <div class="col-lg-12 menu-item filter_menunggu_transfer">
                            <div style="overflow-x:auto;">
                                <table style="width:100%" class="table table-borderless">
                                    <tbody>
                                        <?php 
                                            foreach($data_pemesanan as $haha) {
                                                if($haha->status_pemesanan == 1 ){
                                        ?>
                                            <thead class="border">
                                                <tr>
                                                    <td style="text-align: left; vertical-align: middle;">
                                                        <small><?php echo $haha->tanggal_pemesanan;?></small>
                                                        <?php
                                                            if($haha->status_pemesanan == 1){
                                                                echo $badge_menunggu_transfer;
                                                            } elseif($haha->status_pemesanan == 2){
                                                                echo $badge_validasi_pembayaran;
                                                            } elseif($haha->status_pemesanan == 3){
                                                                echo $badge_proses_pembuatan;
                                                            } elseif($haha->status_pemesanan == 4){
                                                                echo $badge_pengiriman;
                                                            } elseif($haha->status_pemesanan == 5){
                                                                echo $badge_pengambilan;
                                                            } elseif($haha->status_pemesanan == 6){
                                                                echo $badge_selesai;
                                                            } elseif($haha->status_pemesanan == 7){
                                                                echo $badge_batal;
                                                            }
                                                        ?>
                                                        <small><?php echo $haha->kode_pemesanan;?></small>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="text-align: left; vertical-align: middle;">
                                                        <table style="width:100%" id="table" class="table ">
                                                            <tbody>
                                                                <?php 
                                                                    $jumlah_produk = 0;
                                                                    $no = 1;
                                                                    $jumlah_produk += 1;
                                                                    foreach($data_produk as $row1){
                                                                        if($row1->kode_pemesanan == $haha->kode_pemesanan && $no < 2){  
                                                                ?>      
                                                                <tr>
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
                                                                            <span class="fs-6 text-bold"><?php echo $row1->nama_produk; ?></span>
                                                                            <br> 
                                                                            <small><?php echo number_format($row1->qty_ipemesanan, 0, ".", ".")." Item" ; ?></small> x 
                                                                            <small>Rp. <?php echo number_format($row1->harga_ipemesanan, 0, ".", "."); ?></small>
                                                                        </a>
                                                                        <br>
                                                                        <a href="#" class="btn_detail_transaksi" kode_pemesanan="<?php echo $haha->kode_pemesanan; ?>">
                                                                            <?php if($jumlah_produk > 0 ){ echo "+ <small>".$jumlah_produk." produk lainnya</small>"; } ?>
                                                                        </a>
                                                                    </td>
                                                                    <td class="pt-4 pb-4" style="text-align: right; vertical-align: bottom;">
                                                                        Total Belanja <span class="fs-5 text-bold">Rp. <?php echo number_format($haha->total_tagihan_pemesanan, 0, ".", "."); ?></span>
                                                                        <br>
                                                                        <a class="btn btn_detail_transaksi text-warning" kode_pemesanan="<?php echo $haha->kode_pemesanan; ?>">Lihat Detail Transaksi</a>
                                                                    </td>
                                                                </tr>
                                                                <?php     
                                                                    $no++;
                                                                        } 
                                                                        $jumlah_produk++;
                                                                    } 
                                                                ?>   
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </thead>
                                        <?php 
                                                } 
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="col-lg-12 menu-item filter_validasi_pembayaran">
                            <div style="overflow-x:auto;">
                                <table style="width:100%" class="table table-borderless">
                                    
                                    <tbody>
                                        <?php 
                                            foreach($data_pemesanan as $haha) {
                                                if($haha->status_pemesanan == 2 ){
                                        ?>
                                            <thead class="border">
                                                <tr>
                                                    <td style="text-align: left; vertical-align: middle;">
                                                        <small><?php echo $haha->tanggal_pemesanan;?></small>
                                                        <?php
                                                            if($haha->status_pemesanan == 1){
                                                                echo $badge_menunggu_transfer;
                                                            } elseif($haha->status_pemesanan == 2){
                                                                echo $badge_validasi_pembayaran;
                                                            } elseif($haha->status_pemesanan == 3){
                                                                echo $badge_proses_pembuatan;
                                                            } elseif($haha->status_pemesanan == 4){
                                                                echo $badge_pengiriman;
                                                            } elseif($haha->status_pemesanan == 5){
                                                                echo $badge_pengambilan;
                                                            } elseif($haha->status_pemesanan == 6){
                                                                echo $badge_selesai;
                                                            } elseif($haha->status_pemesanan == 7){
                                                                echo $badge_batal;
                                                            }
                                                        ?>
                                                        <small><?php echo $haha->kode_pemesanan;?></small>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="text-align: left; vertical-align: middle;">
                                                        <table style="width:100%" id="table" class="table ">
                                                            <tbody>
                                                                <?php 
                                                                    $jumlah_produk = 0;
                                                                    $no = 1;
                                                                    $jumlah_produk += 1;
                                                                    foreach($data_produk as $row1){
                                                                        if($row1->kode_pemesanan == $haha->kode_pemesanan && $no < 2){  
                                                                ?>      
                                                                <tr>
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
                                                                            <span class="fs-6 text-bold"><?php echo $row1->nama_produk; ?></span>
                                                                            <br> 
                                                                            <small><?php echo number_format($row1->qty_ipemesanan, 0, ".", ".")." Item" ; ?></small> x 
                                                                            <small>Rp. <?php echo number_format($row1->harga_ipemesanan, 0, ".", "."); ?></small>
                                                                        </a>
                                                                        <br>
                                                                        <a href="#" class="btn_detail_transaksi" kode_pemesanan="<?php echo $haha->kode_pemesanan; ?>">
                                                                            <?php if($jumlah_produk > 0 ){ echo "+ <small>".$jumlah_produk." produk lainnya</small>"; } ?>
                                                                        </a>
                                                                    </td>
                                                                    <td class="pt-4 pb-4" style="text-align: right; vertical-align: bottom;">
                                                                        Total Belanja <span class="fs-5 text-bold">Rp. <?php echo number_format($haha->total_tagihan_pemesanan, 0, ".", "."); ?></span>
                                                                        <br>
                                                                        <a class="btn btn_detail_transaksi text-warning" kode_pemesanan="<?php echo $haha->kode_pemesanan; ?>">Lihat Detail Transaksi</a>
                                                                    </td>
                                                                </tr>
                                                                <?php     
                                                                    $no++;
                                                                        } 
                                                                        $jumlah_produk++;
                                                                    } 
                                                                ?>   
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </thead>
                                        <?php 
                                                } 
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="col-lg-12 menu-item filter_proses_pembuatan">
                            <div style="overflow-x:auto;">
                                <table style="width:100%" class="table table-borderless">
                                    
                                    <tbody>
                                        <?php 
                                            foreach($data_pemesanan as $haha) {
                                                if($haha->status_pemesanan == 3 ){
                                        ?>
                                            <thead class="border">
                                                <tr>
                                                    <td style="text-align: left; vertical-align: middle;">
                                                        <small><?php echo $haha->tanggal_pemesanan;?></small>
                                                        <?php
                                                            if($haha->status_pemesanan == 1){
                                                                echo $badge_menunggu_transfer;
                                                            } elseif($haha->status_pemesanan == 2){
                                                                echo $badge_validasi_pembayaran;
                                                            } elseif($haha->status_pemesanan == 3){
                                                                echo $badge_proses_pembuatan;
                                                            } elseif($haha->status_pemesanan == 4){
                                                                echo $badge_pengiriman;
                                                            } elseif($haha->status_pemesanan == 5){
                                                                echo $badge_pengambilan;
                                                            } elseif($haha->status_pemesanan == 6){
                                                                echo $badge_selesai;
                                                            } elseif($haha->status_pemesanan == 7){
                                                                echo $badge_batal;
                                                            }
                                                        ?>
                                                        <small><?php echo $haha->kode_pemesanan;?></small>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="text-align: left; vertical-align: middle;">
                                                        <table style="width:100%" id="table" class="table ">
                                                            <tbody>
                                                                <?php 
                                                                    $jumlah_produk = 0;
                                                                    $no = 1;
                                                                    $jumlah_produk += 1;
                                                                    foreach($data_produk as $row1){
                                                                        if($row1->kode_pemesanan == $haha->kode_pemesanan && $no < 2){  
                                                                ?>      
                                                                <tr>
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
                                                                            <span class="fs-6 text-bold"><?php echo $row1->nama_produk; ?></span>
                                                                            <br> 
                                                                            <small><?php echo number_format($row1->qty_ipemesanan, 0, ".", ".")." Item" ; ?></small> x 
                                                                            <small>Rp. <?php echo number_format($row1->harga_ipemesanan, 0, ".", "."); ?></small>
                                                                        </a>
                                                                        <br>
                                                                        <a href="#" class="btn_detail_transaksi" kode_pemesanan="<?php echo $haha->kode_pemesanan; ?>">
                                                                            <?php if($jumlah_produk > 0 ){ echo "+ <small>".$jumlah_produk." produk lainnya</small>"; } ?>
                                                                        </a>
                                                                    </td>
                                                                    <td class="pt-4 pb-4" style="text-align: right; vertical-align: bottom;">
                                                                        Total Belanja <span class="fs-5 text-bold">Rp. <?php echo number_format($haha->total_tagihan_pemesanan, 0, ".", "."); ?></span>
                                                                        <br>
                                                                        <a class="btn btn_detail_transaksi text-warning" kode_pemesanan="<?php echo $haha->kode_pemesanan; ?>">Lihat Detail Transaksi</a>
                                                                    </td>
                                                                </tr>
                                                                <?php     
                                                                    $no++;
                                                                        } 
                                                                        $jumlah_produk++;
                                                                    } 
                                                                ?>   
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </thead>
                                        <?php 
                                                } 
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="col-lg-12 menu-item filter_pengiriman">
                            <div style="overflow-x:auto;">
                                <table style="width:100%" class="table table-borderless">
                                    
                                    <tbody>
                                        <?php 
                                            foreach($data_pemesanan as $haha) {
                                                if($haha->status_pemesanan == 4 ){
                                        ?>
                                            <thead class="border">
                                                <tr>
                                                    <td style="text-align: left; vertical-align: middle;">
                                                        <small><?php echo $haha->tanggal_pemesanan;?></small>
                                                        <?php
                                                            if($haha->status_pemesanan == 1){
                                                                echo $badge_menunggu_transfer;
                                                            } elseif($haha->status_pemesanan == 2){
                                                                echo $badge_validasi_pembayaran;
                                                            } elseif($haha->status_pemesanan == 3){
                                                                echo $badge_proses_pembuatan;
                                                            } elseif($haha->status_pemesanan == 4){
                                                                echo $badge_pengiriman;
                                                            } elseif($haha->status_pemesanan == 5){
                                                                echo $badge_pengambilan;
                                                            } elseif($haha->status_pemesanan == 6){
                                                                echo $badge_selesai;
                                                            } elseif($haha->status_pemesanan == 7){
                                                                echo $badge_batal;
                                                            }
                                                        ?>
                                                        <small><?php echo $haha->kode_pemesanan;?></small>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="text-align: left; vertical-align: middle;">
                                                        <table style="width:100%" id="table" class="table ">
                                                            <tbody>
                                                                <?php 
                                                                    $jumlah_produk = 0;
                                                                    $no = 1;
                                                                    $jumlah_produk += 1;
                                                                    foreach($data_produk as $row1){
                                                                        if($row1->kode_pemesanan == $haha->kode_pemesanan && $no < 2){  
                                                                ?>      
                                                                <tr>
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
                                                                            <span class="fs-6 text-bold"><?php echo $row1->nama_produk; ?></span>
                                                                            <br> 
                                                                            <small><?php echo number_format($row1->qty_ipemesanan, 0, ".", ".")." Item" ; ?></small> x 
                                                                            <small>Rp. <?php echo number_format($row1->harga_ipemesanan, 0, ".", "."); ?></small>
                                                                        </a>
                                                                        <br>
                                                                        <a href="#" class="btn_detail_transaksi" kode_pemesanan="<?php echo $haha->kode_pemesanan; ?>">
                                                                            <?php if($jumlah_produk > 0 ){ echo "+ <small>".$jumlah_produk." produk lainnya</small>"; } ?>
                                                                        </a>
                                                                    </td>
                                                                    <td class="pt-4 pb-4" style="text-align: right; vertical-align: bottom;">
                                                                        Total Belanja <span class="fs-5 text-bold">Rp. <?php echo number_format($haha->total_tagihan_pemesanan, 0, ".", "."); ?></span>
                                                                        <br>
                                                                        <a class="btn btn_detail_transaksi text-warning" kode_pemesanan="<?php echo $haha->kode_pemesanan; ?>">Lihat Detail Transaksi</a>
                                                                    </td>
                                                                </tr>
                                                                <?php     
                                                                    $no++;
                                                                        } 
                                                                        $jumlah_produk++;
                                                                    } 
                                                                ?>   
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </thead>
                                        <?php 
                                                } 
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="col-lg-12 menu-item filter_pengambilan">
                            <div style="overflow-x:auto;">
                                <table style="width:100%" class="table table-borderless">
                                    
                                    <tbody>
                                        <?php 
                                            foreach($data_pemesanan as $haha) {
                                                if($haha->status_pemesanan == 5 ){
                                        ?>
                                            <thead class="border">
                                                <tr>
                                                    <td style="text-align: left; vertical-align: middle;">
                                                        <small><?php echo $haha->tanggal_pemesanan;?></small>
                                                        <?php
                                                            if($haha->status_pemesanan == 1){
                                                                echo $badge_menunggu_transfer;
                                                            } elseif($haha->status_pemesanan == 2){
                                                                echo $badge_validasi_pembayaran;
                                                            } elseif($haha->status_pemesanan == 3){
                                                                echo $badge_proses_pembuatan;
                                                            } elseif($haha->status_pemesanan == 4){
                                                                echo $badge_pengiriman;
                                                            } elseif($haha->status_pemesanan == 5){
                                                                echo $badge_pengambilan;
                                                            } elseif($haha->status_pemesanan == 6){
                                                                echo $badge_selesai;
                                                            } elseif($haha->status_pemesanan == 7){
                                                                echo $badge_batal;
                                                            }
                                                        ?>
                                                        <small><?php echo $haha->kode_pemesanan;?></small>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="text-align: left; vertical-align: middle;">
                                                        <table style="width:100%" id="table" class="table ">
                                                            <tbody>
                                                                <?php 
                                                                    $jumlah_produk = 0;
                                                                    $no = 1;
                                                                    $jumlah_produk += 1;
                                                                    foreach($data_produk as $row1){
                                                                        if($row1->kode_pemesanan == $haha->kode_pemesanan && $no < 2){  
                                                                ?>      
                                                                <tr>
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
                                                                            <span class="fs-6 text-bold"><?php echo $row1->nama_produk; ?></span>
                                                                            <br> 
                                                                            <small><?php echo number_format($row1->qty_ipemesanan, 0, ".", ".")." Item" ; ?></small> x 
                                                                            <small>Rp. <?php echo number_format($row1->harga_ipemesanan, 0, ".", "."); ?></small>
                                                                        </a>
                                                                        <br>
                                                                        <a href="#" class="btn_detail_transaksi" kode_pemesanan="<?php echo $haha->kode_pemesanan; ?>">
                                                                            <?php if($jumlah_produk > 0 ){ echo "+ <small>".$jumlah_produk." produk lainnya</small>"; } ?>
                                                                        </a>
                                                                    </td>
                                                                    <td class="pt-4 pb-4" style="text-align: right; vertical-align: bottom;">
                                                                        Total Belanja <span class="fs-5 text-bold">Rp. <?php echo number_format($haha->total_tagihan_pemesanan, 0, ".", "."); ?></span>
                                                                        <br>
                                                                        <a class="btn btn_detail_transaksi text-warning" kode_pemesanan="<?php echo $haha->kode_pemesanan; ?>">Lihat Detail Transaksi</a>
                                                                    </td>
                                                                </tr>
                                                                <?php     
                                                                    $no++;
                                                                        } 
                                                                        $jumlah_produk++;
                                                                    } 
                                                                ?>   
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </thead>
                                        <?php 
                                                } 
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="col-lg-12 menu-item filter_selesai">
                        
                            <div style="overflow-x:auto;">
                                <table style="width:100%" class="table table-borderless">
                                    
                                    <tbody>
                                        <?php 
                                            foreach($data_pemesanan as $haha) {
                                                if($haha->status_pemesanan == 7 ){
                                        ?>
                                            <thead class="border">
                                                <tr>
                                                    <td style="text-align: left; vertical-align: middle;">
                                                        <small><?php echo $haha->tanggal_pemesanan;?></small>
                                                        <?php
                                                            if($haha->status_pemesanan == 1){
                                                                echo $badge_menunggu_transfer;
                                                            } elseif($haha->status_pemesanan == 2){
                                                                echo $badge_validasi_pembayaran;
                                                            } elseif($haha->status_pemesanan == 3){
                                                                echo $badge_proses_pembuatan;
                                                            } elseif($haha->status_pemesanan == 4){
                                                                echo $badge_pengiriman;
                                                            } elseif($haha->status_pemesanan == 5){
                                                                echo $badge_pengambilan;
                                                            } elseif($haha->status_pemesanan == 6){
                                                                echo $badge_selesai;
                                                            } elseif($haha->status_pemesanan == 7){
                                                                echo $badge_batal;
                                                            }
                                                        ?>
                                                        <small><?php echo $haha->kode_pemesanan;?></small>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="text-align: left; vertical-align: middle;">
                                                        <table style="width:100%" id="table" class="table ">
                                                            <tbody>
                                                                <?php 
                                                                    $jumlah_produk = 0;
                                                                    $no = 1;
                                                                    $jumlah_produk += 1;
                                                                    foreach($data_produk as $row1){
                                                                        if($row1->kode_pemesanan == $haha->kode_pemesanan && $no < 2){  
                                                                ?>      
                                                                <tr>
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
                                                                            <span class="fs-6 text-bold"><?php echo $row1->nama_produk; ?></span>
                                                                            <br> 
                                                                            <small><?php echo number_format($row1->qty_ipemesanan, 0, ".", ".")." Item" ; ?></small> x 
                                                                            <small>Rp. <?php echo number_format($row1->harga_ipemesanan, 0, ".", "."); ?></small>
                                                                        </a>
                                                                        <br>
                                                                        <a href="#" class="btn_detail_transaksi" kode_pemesanan="<?php echo $haha->kode_pemesanan; ?>">
                                                                            <?php if($jumlah_produk > 0 ){ echo "+ <small>".$jumlah_produk." produk lainnya</small>"; } ?>
                                                                        </a>
                                                                    </td>
                                                                    <td class="pt-4 pb-4" style="text-align: right; vertical-align: bottom;">
                                                                        Total Belanja <span class="fs-5 text-bold">Rp. <?php echo number_format($haha->total_tagihan_pemesanan, 0, ".", "."); ?></span>
                                                                        <br>
                                                                        <a class="btn btn_detail_transaksi text-warning" kode_pemesanan="<?php echo $haha->kode_pemesanan; ?>">Lihat Detail Transaksi</a>
                                                                    </td>
                                                                </tr>
                                                                <?php     
                                                                    $no++;
                                                                        } 
                                                                        $jumlah_produk++;
                                                                    } 
                                                                ?>   
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </thead>
                                        <?php 
                                                } 
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="col-lg-12 menu-item filter_batal">
                            <div style="overflow-x:auto;">
                                <table style="width:100%" class="table table-borderless">
                                    
                                    <tbody>
                                        <?php 
                                            foreach($data_pemesanan as $haha) {
                                                if($haha->status_pemesanan == 8 ){
                                        ?>
                                            <thead class="border">
                                                <tr>
                                                    <td style="text-align: left; vertical-align: middle;">
                                                        <small><?php echo $haha->tanggal_pemesanan;?></small>
                                                        <?php
                                                            if($haha->status_pemesanan == 1){
                                                                echo $badge_menunggu_transfer;
                                                            } elseif($haha->status_pemesanan == 2){
                                                                echo $badge_validasi_pembayaran;
                                                            } elseif($haha->status_pemesanan == 3){
                                                                echo $badge_proses_pembuatan;
                                                            } elseif($haha->status_pemesanan == 4){
                                                                echo $badge_pengiriman;
                                                            } elseif($haha->status_pemesanan == 5){
                                                                echo $badge_pengambilan;
                                                            } elseif($haha->status_pemesanan == 6){
                                                                echo $badge_selesai;
                                                            } elseif($haha->status_pemesanan == 7){
                                                                echo $badge_batal;
                                                            }
                                                        ?>
                                                        <small><?php echo $haha->kode_pemesanan;?></small>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="text-align: left; vertical-align: middle;">
                                                        <table style="width:100%" id="table" class="table ">
                                                            <tbody>
                                                                <?php 
                                                                    $jumlah_produk = 0;
                                                                    $no = 1;
                                                                    $jumlah_produk += 1;
                                                                    foreach($data_produk as $row1){
                                                                        if($row1->kode_pemesanan == $haha->kode_pemesanan && $no < 2){  
                                                                ?>      
                                                                <tr>
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
                                                                            <span class="fs-6 text-bold"><?php echo $row1->nama_produk; ?></span>
                                                                            <br> 
                                                                            <small><?php echo number_format($row1->qty_ipemesanan, 0, ".", ".")." Item" ; ?></small> x 
                                                                            <small>Rp. <?php echo number_format($row1->harga_ipemesanan, 0, ".", "."); ?></small>
                                                                        </a>
                                                                        <br>
                                                                        <a href="#" class="btn_detail_transaksi" kode_pemesanan="<?php echo $haha->kode_pemesanan; ?>">
                                                                            <?php if($jumlah_produk > 0 ){ echo "+ <small>".$jumlah_produk." produk lainnya</small>"; } ?>
                                                                        </a>
                                                                    </td>
                                                                    <td class="pt-4 pb-4" style="text-align: right; vertical-align: bottom;">
                                                                        Total Belanja <span class="fs-5 text-bold">Rp. <?php echo number_format($haha->total_tagihan_pemesanan, 0, ".", "."); ?></span>
                                                                        <br>
                                                                        <a class="btn btn_detail_transaksi text-warning" kode_pemesanan="<?php echo $haha->kode_pemesanan; ?>">Lihat Detail Transaksi</a>
                                                                    </td>
                                                                </tr>
                                                                <?php     
                                                                    $no++;
                                                                        } 
                                                                        $jumlah_produk++;
                                                                    } 
                                                                ?>   
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </thead>
                                        <?php 
                                                } 
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<form role="form" class="form_upload_pembayaran" id="form_upload_pembayaran" method="post" aria-label="">  
    <div id="modal_detail_transaksi" class="modal animated pulse" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl modal-dialog-scrollable">
            <div class="modal-content" style="border: 2px solid #ffc107; border-radius: 20px">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Detail Transaksi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                </div>
            </div>
        </div>
    </div>
</form>

<?php $this->load->view('frontend/partials/footer.php') ?>
<?php $this->load->view('frontend/partials/script.php') ?>

<!-----------------------FUNGSI LAIN----------------------->
<script>
    $(document).ready(function() {  
        $("#profil_konsumen").addClass("active");
        $("#topbar").removeClass("topbar-transparent");
        $("#header").removeClass("header-transparent");
    });
</script>


<script type="text/javascript">
    $(document).on('click', '.btn_detail_transaksi', function(e) {
        var kode_pemesanan=$(this).attr("kode_pemesanan");
        var url = "<?php echo base_url('home/detail_transaksi'); ?>";

        $('#modal_detail_transaksi').modal('show');
        $('.modal-title').text('Detail Transaksi');
        $('.modal-body').load(url,{kode_pemesanan : kode_pemesanan});
    });  
    
    
</script>