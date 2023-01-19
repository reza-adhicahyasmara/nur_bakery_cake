<?php $this->load->view('frontend/partials/head.php') ?>

<main id="main">

    <section class="breadcrumbs">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <h2>Cari Produk</h2>
                <ol>
                    <li><a href="<?php echo base_url('home');?>">Home</a></li>
                    <li>Cari Produk</li>
                </ol>
            </div>
        </div>
    </section>



    <section id="specials" class="specials">
        <div class="container">
            
            <div class="section-title">
                <?php 
                    if(empty($data_produk)) {
                        echo "
                            <img class='m-5' style='width: 300px' src='"; echo base_url('assets/img/banner/undraw_birthday_cake.svg'); echo "'>
                            <br>
                            <h2 class='m-4'>Produk Tidak Ditemukan</h2>
                        ";
                    }else{
                        echo "<h2>Hasil Pencarian Produk</h2>";
                    } 
                ?>
            </div>
            <div class="row row-cols-1 row-cols-md-4 g-4">
                <?php
                    $delay = 100;
                    foreach($data_produk as $row1){
                        
                        //MENCARI MIN MAX
                        foreach($data_ukuran as $aaa){
                            if($aaa->kode_produk == $row1->kode_produk){
                                $harga_terendah[] = $aaa->harga_ukuran;
                            }
                        }
                        
                        //MENCARI POTONGAN HARGA
                        $harga_ukuran = 0;
                        $potongan_idiskon = 0;
                        $harga_diskon = 0;
                        foreach($data_ukuran as $row2){
                            if($row2->kode_produk == $row1->kode_produk){
                                $harga_ukuran = $row2->harga_ukuran;

                                foreach($data_idiskon as $row3){
                                    if($row3->kode_ukuran == $row2->kode_ukuran){
                                        $potongan_idiskon = $row3->potongan_idiskon;
                                        $harga_diskon = $harga_ukuran - (($potongan_idiskon * $harga_ukuran) / 100);
                                    }
                                }
                            }
                        }

                        //HITUNG RATING STAR
                        $total1 = 0;
                        $count1 = 0;
                        $average1 = 0;
                        $terjual = 0;
                        foreach($data_ulasan_produk as $rat){ 
                            if($rat->kode == $row1->hahaha && $rat->status_ipemesanan == 4){ 
                                $total1 += $rat->rating_ipemesanan;
                                $count1 += 1;
                                $terjual += $rat->qty_ipemesanan;
                            }
                        }
                        
                        if($total1 == 0 || $total1 == null){
                            $angka_format1 = 0;
                        }else if($total1 != 0 || $total1 != null){
                            $average1 = $total1/$count1;
                            $angka_format1 = number_format($average1,1);
                        }
                ?>  
                <a href="<?php echo base_url('home/detail_produk/').$row1->hahaha;?>" style="color: black;"> 
                    <div class="col">
                        <div class="card cards">
                        <div class="ratio ratio-1x1">
                            <?php if($row1->gambar_produk != "") { ?>
                                <img class="image-wrapper rounded-top" src="<?php echo base_url('assets/img/produk/'.$row1->gambar_produk);?>" alt="Image" style="object-fit: cover;">
                            <?php }else{ ?>
                                <img class="image-wrapper" src="<?php echo base_url('assets/img/banner/package_regular.png');?>" alt="Image" style="object-fit: cover;">
                            <?php } ?>
                        </div>
                            <div class="card-body">
                                <strong class="card-title fs-6" style="color: #ffc107"><?php echo mb_strimwidth($row1->nama_produk, 0, 20, "..."); ?></strong>
                                <p class="card-text">     
                                    <?php if($potongan_idiskon != 0){?>
                                        <span class="badge bg-success"><?php echo $potongan_idiskon; ?>%</span>
                                        <del>Rp. <?php echo number_format($harga_ukuran, 0, ".", "."); ?></del></li><br>
                                        <span>Rp. <?php echo number_format($harga_diskon, 0, ".", "."); ?></span>
                                    <?php }else{ ?>
                                        <span>Rp. <?php echo number_format(min($harga_terendah), 0, ".", "."); ?></span>
                                        <br>
                                    <?php } ?>
                                    <br>
                                    <small>
                                        <i class="fa fa-star checked"><span> <?php echo $angka_format1; ?></span></i> <span> | Terjual <?php echo $terjual; ?> qty</span>
                                    </small>
                                </p>
                            </div>
                        </div>
                    </div>
                </a>
                <?php } ?>
            </div>
        </div>
    </section>
</main>

<?php $this->load->view('frontend/partials/footer.php') ?>
<?php $this->load->view('frontend/partials/script.php') ?>

<!-----------------------FUNGSI----------------------->
<script>
    $(document).ready(function() {
        $("#home").addClass("active");
        $("#topbar").removeClass("topbar-transparent");
        $("#header").removeClass("header-transparent");
    });
</script>