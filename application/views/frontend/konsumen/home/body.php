<?php $this->load->view('frontend/partials/head.php') ?>
<section id="hero">
    <div class="hero-container">
        <div id="heroCarousel" data-bs-interval="5000" class="carousel slide carousel-fade" data-bs-ride="carousel">

            <ol class="carousel-indicators" id="hero-carousel-indicators"></ol>

            <div class="carousel-inner" role="listbox">

            <!-- Slide 1 -->
            <div class="carousel-item active" style="background-image: url(assets/dist/frontend/img/slide/slide-1.jpg);">
                <div class="carousel-container">
                    <div class="carousel-content">
                        <h2 class="animate__animated animate__fadeInDown"><span>Nur</span> Bakery & Cake</h2>
                        <p class="animate__animated animate__fadeInUp">.</p>
                        <div>
                        <a href="#menu" class="btn-menu animate__animated animate__fadeInUp scrollto">Our Menu</a>
                        <a href="#book-a-table" class="btn-book animate__animated animate__fadeInUp scrollto">Book a Table</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Slide 2 -->
            <div class="carousel-item" style="background-image: url(assets/dist/frontend/img/slide/slide-2.jpg);">
                <div class="carousel-container">
                    <div class="carousel-content">
                        <h2 class="animate__animated animate__fadeInDown">XXX</h2>
                        <p class="animate__animated animate__fadeInUp">.</p>
                        <div>
                        <a href="#menu" class="btn-menu animate__animated animate__fadeInUp scrollto">Our Menu</a>
                        <a href="#book-a-table" class="btn-book animate__animated animate__fadeInUp scrollto">Book a Table</a>
                        </div>
                    </div>
                </div>
            </div>

        <!-- Slide 3 -->
            <div class="carousel-item" style="background-image: url(assets/dist/frontend/img/slide/slide-3.jpg);">
                <div class="carousel-container">
                    <div class="carousel-content">
                        <h2 class="animate__animated animate__fadeInDown">XXX</h2>
                        <p class="animate__animated animate__fadeInUp">.</p>
                        <div>
                        <a href="#menu" class="btn-menu animate__animated animate__fadeInUp scrollto">Our Menu</a>
                        <a href="#book-a-table" class="btn-book animate__animated animate__fadeInUp scrollto">Book a Table</a>
                        </div>
                    </div>
                </div>
            </div>

            </div>

            <a class="carousel-control-prev" href="#heroCarousel" role="button" data-bs-slide="prev">
            <span class="carousel-control-prev-icon bi bi-chevron-left" aria-hidden="true"></span>
            </a>

            <a class="carousel-control-next" href="#heroCarousel" role="button" data-bs-slide="next">
            <span class="carousel-control-next-icon bi bi-chevron-right" aria-hidden="true"></span>
            </a>

        </div>
    </div>
</section>
    


<main id="main">  

    <section id="specials" class="specials">
        <div class="container">
            <div class="section-title">
                <h2>Produk Terbaik <span>Kami</span></h2>
                <p>Dibuat dengan bahan baku berkualitas. Diolah dengan tangan profesional dengan cita rasa premium.</p>
            </div>
            <div class="events-slider swiper mb-5">
                <div class="swiper-wrapper">
                    <?php if(empty($data_diskon)) {?>
                    
                    <?php } else { ?>     
                        
                            <?php
                                $no = 1;
                                foreach($data_diskon as $row){ 
                            ?>  
                            <div class="swiper-slide">
                            <a href="<?php echo base_url('home/detail_acara_diskon/').$row->kode_diskon;?>">
                                <div>
                                    <img alt="Gambar diskon" src="<?php echo base_url('assets/img/diskon/').$row->gambar_diskon;?>" style="width:100%; height: 400px; object-fit: cover; border-radius: 5px">
                                </div>
                            </a>
                        </div>
                            <?php   
                                    $no++;    
                                }
                            ?>
                    <?php } ?>
                </div>
                <div class="swiper-pagination"></div>
            </div>
            <div class="row">
                <div class="col-12 col-md-3">
                    <h2>Kategori</h2>
                    <hr>
                    <ul class="nav nav-tabs flex-column">
                        <li class="nav-item">
                            <a class="nav-link active show btn_kategori" data-bs-toggle="tab" href="#tab-1" kode_kategori = <?php echo "Semua"; ?> nama_kategori = "<?php echo "Produk" ?>">Semua Produk</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link btn_kategori" data-bs-toggle="tab" href="#tab-0" kode_kategori = <?php echo "Terlaris"; ?> nama_kategori = "<?php echo "Produk" ?>">Produk Terlaris</a>
                        </li>
                        <?php  foreach($data_kategori as $kat){ ?>
                            <li class="nav-item">
                                <a class="nav-link btn_kategori" data-bs-toggle="tab" href="#tab-2" kode_kategori = "<?php echo $kat->kode_kategori; ?>" nama_kategori = "<?php echo $kat->nama_kategori; ?>"><?php echo $kat->nama_kategori; ?></a>
                            </li>
                        <?php } ?> 
                    </ul>
                </div>
                <div class="col-12 col-md-9">
                    <div id="content_produk">
                        <div class="row row-cols-1 row-cols-md-3 g-4">
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
                </div>
            </div>
        </div>
    </section>
    


    
    <!-- ======= Testimonials Section ======= -->
    
    <section id="events" class="events">
        <div class="container">
            <div class="section-title">
                <h2>Ulasan  <span>Konsumen Setia</span> Nur Baker Cake</h2>
            </div>
            <div class="events-slider swiper">
                <div class="swiper-wrapper">
                    <?php if(empty($data_pemesanan)) { ?>
                        <div class="carousel-item active">
                            <spaan class="fs-5 text-white" class="color: white;">Belum ada diskon event, daftarkan diri Anda untuk mendapatkan informaasi diskon terupdate dari kami.</spaan>
                        </div>
                    <?php
                        }else{
                            $no = 1;
                            foreach($data_pemesanan as $row) {
                                if($row->status_pemesanan == 6 && $row->ulasan_pemesanan != ""){
                    ?>
                    <div class="swiper-slide">
                        <div class="testimonial-item text-center">
                            <?php if($row->foto_konsumen != "") { ?>
                                <img class="testimonial-img" src="<?php echo base_url('assets/img/konsumen/'.$row->foto_konsumen);?>" alt="User Image" style="width:100px; height:100px; object-fit: cover; border-radius: 50px;">
                            <?php }else{ ?>
                                <img class="testimonial-img" src="<?php echo base_url('assets/img/banner/profile.jpg');?>" alt="User Image" style="width:100px; height:100px; object-fit: cover; border-radius: 50px;">
                            <?php } ?>
                            <br>
                            <span class="fs-5 text-white"><?php echo $row->nama_konsumen; ?></span>
                            <br>
                            <small class="text-white"><?php echo $row->tanggal_ulasan_pemesanan; ?></small>
                            <br>
                            <?php 
                                $aa = $row->rating_pemesanan;
                                if($aa <= 1){
                                    echo "<span class='fa fa-star checked'></span>
                                    <span class='fa fa-star'></span>
                                    <span class='fa fa-star'></span>
                                    <span class='fa fa-star'></span>
                                    <span class='fa fa-star'></span>";
                                } elseif($aa <= 2){
                                    echo "<span class='fa fa-star checked'></span>
                                    <span class='fa fa-star checked'></span>
                                    <span class='fa fa-star'></span>
                                    <span class='fa fa-star'></span>
                                    <span class='fa fa-star'></span>";
                                } elseif($aa <= 3){
                                    echo "<span class='fa fa-star checked'></span>
                                    <span class='fa fa-star checked'></span>
                                    <span class='fa fa-star checked'></span>
                                    <span class='fa fa-star'></span>
                                    <span class='fa fa-star'></span>";
                                } elseif($aa <= 4){
                                    echo "<span class='fa fa-star checked'></span>
                                    <span class='fa fa-star checked'></span>
                                    <span class='fa fa-star checked'></span>
                                    <span class='fa fa-star checked'></span>
                                    <span class='fa fa-star'></span>";
                                } elseif($aa <= 5){
                                    echo "<span class='fa fa-star checked'></span>
                                    <span class='fa fa-star checked'></span>
                                    <span class='fa fa-star checked'></span>
                                    <span class='fa fa-star checked'></span>
                                    <span class='fa fa-star checked'></span>";
                                }
                            ?>
                            <br>
                            <p >
                                <i class="bx bxs-quote-alt-left quote-icon-left text-white"></i>
                                <span class="fs-5 text-white"><?php echo $row->ulasan_pemesanan; ?></span>
                                <i class="bx bxs-quote-alt-right quote-icon-right text-white"></i>
                            </p>
                        </div>
                    </div>
                    <?php 
                                    $no++;
                                }
                            }
                        } 
                    ?>

                </div>
            <div class="swiper-pagination"></div>
            </div>

        </div>
    </section><!-- End Testimonials Section -->



    <section id="chefs" class="chefs">
        <div class="container">

            <div class="section-title">
                <h2>Keuntungan Berbelanja Online Produk <span>Kami</span></h2>
            </div>

           
            <div class="row">   
                <div class="col-lg-6 d-flex align-items-center">
                    <img src="<?php echo base_url(); ?>assets/img/banner/undraw_window_shopping.svg" class="img-fluid" alt="">
                </div>
                <div class="col-lg-6 pt-4 pt-lg-0 content">
                    <div class="skills-content">
                        <div class="row justify-content-center">
                            <p>
                                <ol>
                                    <li>Produk kami merupakan produk original dan berkualitas karena produksi kami sendiri.</li>
                                    <li>Terdapat harga diskon untuk pelanggan baru.</li>
                                    <li>Terdapat potongan harga untuk setiap pembelian diatas 5 liter dari setiap varian dan kategori kemasan yang berbeda.</li>
                                    <li>Pengiriman paket yang cepat dan terjamin aman.</li>
                                </ol>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>




    <section id="services" class="services" style="background-color: rgba(0,0,0,0.05);">
        <div class="container">
            <div class="row">   
                <div class="col-lg-6 pt-4 pt-lg-0 content">
                    <div class="section-title">
                        <h2>FAQ</h2>
                    </div>
                    <div class="skills-content">
                        <div class="row justify-content-center">
                            <div class="accordion" id="accordionExample">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingOne">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                            Apakah seluruh produk tersedia?
                                        </button>
                                    </h2>
                                    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            Ya, seluruh produk tersedia dan siap dikirim. Kamu bisa cek melalui halaman “Rincian Produk” > “ Stok”.
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingTwo">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                            kategori apa saja yang tersedia?
                                        </button>
                                    </h2>
                                    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            Produk kami memiliki 2 macam kategori yaitu kategori 1 Liter dan kategori 5 Liter. Dan akan ada varian aroma baru, dan kategori kemasan baru loh !
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingThree">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                            Apakah saya dapat menjadi reseller/dropshipper?
                                        </button>
                                    </h2>
                                    <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            Mohon maaf untuk saat ini toko kami tidak menerima Reseller/Dropshipper.
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingFour">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                            Apakah saya dapat menukar produk saya?
                                        </button>
                                    </h2>
                                    <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            Produk yang dibeli dapat ditukar dengan barang yang sama jika terjadi kerusakan pada produk tersebut, untuk biaya ongkos kirim ditanggung oleh pembeli.
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingFive">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                            Berapa lama waktu yang dibutuhkan untuk melakukan pengiriman?
                                        </button>
                                    </h2>
                                    <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            Durasi pengiriman tergantung pada jenis dan jasa kirim yang dipilih. Untuk estimasi pengiriman dalam kabupaten Kuningan 1 hari kerja. Sedangkan luar kabupaten Kuningan estimasi untuk pengiriman regular adalah 2-4 hari kerja tergantung layanan ekspedii yang dipilih. 
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingSix">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                                            Apa saja jasa kirim dan jenis pengiriman yang tersedia?
                                        </button>
                                    </h2>
                                    <div id="collapseSix" class="accordion-collapse collapse" aria-labelledby="headingSix" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            Untuk melihat ekspedisi dan layanan jasa kirim yang tersedia, kamu bisa <a href="<?php echo base_url("home/jangkauan_wilayah"); ?>">klik disni</a> untuk melihat jangkauan wilayah pengiriman.
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingSeven">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                                            Kapan pesanan saya akan dikirim ?
                                        </button>
                                    </h2>
                                    <div id="collapseSeven" class="accordion-collapse collapse" aria-labelledby="headingSeven" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            Kami akan mengirimkan pesananmu secepatnya. Pesanan yang masuk hingga pukul 17.00 WIB akan dikirimkan pada hari yang sama, tetapi pesanan yang masuk setelah jam tersebut akan dikirimkan keesokan harinya.
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingEight">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseEight" aria-expanded="false" aria-controls="collapseEight">
                                            Bagaimana cara melakukan pengembalian barang?
                                        </button>
                                    </h2>
                                    <div id="collapseEight" class="accordion-collapse collapse" aria-labelledby="headingEight" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            Pada saat penerimaan produk dimetode pembelian Pesan Antar atau pengambilan produk dimetode Pesan Ambil, kamu dapat malakukan kompalin produk. Masukan keterangan dan foto produk yang rusak. Kemudian ajukan komplain, dan barang kamu dapat dikrim kembali ke alamat kami. Kami akan segera memproses produk retur kamu.
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingNine">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseNine" aria-expanded="false" aria-controls="collapseNine">
                                            Apa saja metode pembayaran yang tersedia?
                                        </button>
                                    </h2>
                                    <div id="collapseNine" class="accordion-collapse collapse" aria-labelledby="headingNine" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            Kami hanya menyediakan metode pembayaran transfer bank. Kami menyediakan nomer rekening beberapa bank terbesar di Indonesia, untuk memudahkan kamu bertransaksi.
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingTen">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTen" aria-expanded="false" aria-controls="collapseTen">
                                            Apakah layanan COD (Bayar di tempat) tersedia?
                                        </button>
                                    </h2>
                                    <div id="collapseTen" class="accordion-collapse collapse" aria-labelledby="headingTen" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            Tidak, layanan COD (Bayar di tempat) tidak tersedia.
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingEleven">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseEleven" aria-expanded="false" aria-controls="collapseEleven">
                                            Apakah terdapat diskon/ diskon ditoko ini?
                                        </button>
                                    </h2>
                                    <div id="collapseEleven" class="accordion-collapse collapse" aria-labelledby="headingEleven" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <ul>
                                                <li>Terdapat diskon untuk setiap pelanggan baru.</li>
                                                <li>Terdapat potongan harga untuk setiap pembelian diatas 5 liter dari setiap varian dan kategori kemasan yang berbeda.</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 d-flex align-items-center">
                    <img src="<?php echo base_url(); ?>assets/img/banner/undraw_questions.svg" class="img-fluid" alt="">
                </div>
            </div>
        </div>
    </section>
</main>

<?php $this->load->view('frontend/partials/footer.php') ?>
<?php $this->load->view('frontend/partials/script.php') ?>

<!-----------------------FUNGSI LAIN----------------------->
<script>
    $(document).ready(function() {
        document.getElementById("logo-text").style.color = "#ffb03b";
    });
</script>