
<?php $this->load->view('frontend/partials/head.php') ?>

<main id="main">
    <section class="breadcrumbs">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <h2><img src="<?php echo base_url('assets/img/banner/undraw_add_to_cart.svg')?>" style="height: 300px; object-fit: cover;"></h2>
                <ol>
                    <li><h1>Pedoman Berbelanja</h1></li>
                </ol>
            </div>
        </div>
    </section>

    <section class="inner-page">
        <div class="container">
            <div class="skills-content">

                <span class="fs-5">Terima kasih sudah berbelanja dengan kami! Untuk kelancaran proses pemesanan, mohon mengikuti ketentuan pesanan:</span>
                <ul>
                    <li>Pembayaran masuk melebihi jam 16:00 akan diproses produksi dihari berikutnya.</li>
                    <li>Pembayaran hanya dilakukan melalui metode cashless (transfer atau emoney).</li>
                    <li>Produk selalu tersedia, kami memproduksi dan langsung mengirim langsung ke palanggan.</li>
                    <li>Pengiriman dapat dilakukan 3 metode yaitu amnbil sendiri, antar cepat dan memalui ekspedisi.</li>
                </ul>
                <br>
                <div class="row justify-content-center">
                    <div class="accordion" id="accordionExample">
                        <div class="accordion-item">
                            <h class="accordion-header" id="headingOne">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    <b>Pemesanan By Sistem</b>
                                </button>
                            </h>
                            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <p>Nikmati produk-produk terbaik kami. Proses produk dilakukan selama 1 hari, jika pembayaran melebihi jam 16:000 akan proses hari beriukutnya. Silahkan chating atau hubungi admin kami.</p>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h class="accordion-header" id="headingTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    <b>Pembayaran</b>
                                </button>
                            </h>
                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <p>
                                        Kami menerima pembayaran melalui transfer bank dan E-Money
                                        <br>
                                        Informasi akun pembayaran kamu sebagai berikut:
                                        <ul>
                                            <li>
                                                <?php
                                                    $norek1 = explode("-",$data_pengaturan['rek1_pengaturan']);
                                                    echo $norek1[2]."<br>";
                                                    echo "Pemilik akun : ".$norek1[1]."<br>";
                                                    echo "Nomor akun : ".$norek1[0]."<br>";

                                                ?>
                                            </li>
                                            <li>
                                                <?php
                                                    $norek2 = explode("-",$data_pengaturan['rek2_pengaturan']);
                                                    echo $norek2[2]."<br>";
                                                    echo "Pemilik akun : ".$norek2[1]."<br>";
                                                    echo "Nomor akun : ".$norek2[0]."<br>";

                                                ?>
                                            </li>
                                            <li>
                                                <?php
                                                    $norek3 = explode("-",$data_pengaturan['rek3_pengaturan']);
                                                    echo $norek3[2]."<br>";
                                                    echo "Pemilik akun : ".$norek3[1]."<br>";
                                                    echo "Nomor akun : ".$norek3[0]."<br>";

                                                ?>
                                            </li>
                                            <li>
                                                <?php
                                                    $norek4 = explode("-",$data_pengaturan['rek4_pengaturan']);
                                                    echo $norek4[2]."<br>";
                                                    echo "Pemilik akun : ".$norek4[1]."<br>";
                                                    echo "Nomor akun : ".$norek4[0]."<br>";

                                                ?>
                                            </li>
                                        </ul>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h class="accordion-header" id="headingThree">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    <b>Pengiriman</b>
                                </button>
                            </h>
                            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <p>
                                        Kami mengirim dengan 3 metode yaitu metode Ambil Sendiri, Antar Cepat & Antar Ekspedisi.
                                        <br>
                                        <ul>
                                            <li>
                                                Ambil sendiri adalah metode diaman anda dapat memesan produk dan produk dapat diambil sendiri ke toko kami. Tidak ada ada biaya pengiriman apapun.
                                            </li>
                                            <li>
                                                Antar cepat adalah layanan antar yang dilakukan oleh petugas internal kami, estimasi pengiriman hanya 1 hari setelah produk selesai dibuat. Layanan antar cepat hanya berlaku untuk wilyah Kuningan, Majalengka & Cirebon. Berikut biaya pesan antar:
                                                <div class="mb-3 col-12 col-md-6">
                                                    <div class="form-group">
                                                        <select type="text" class="form-control" name="kode_kabupaten" id="kode_kabupaten" placeholder="Contoh: Kuningan">
                                                            <?php foreach($data_kabupaten as $row){
                                                                if($row->kode_kabupaten == '3208' || $row->kode_kabupaten == '3209' || $row->kode_kabupaten == '3210' || $row->kode_kabupaten == '3274'){
                                                            ?>
                                                                <option value="<?php echo $row->kode_kabupaten; ?>"><?php echo $row->nama_kabupaten; ?></option>
                                                            <?php } } ?> 
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="mb-3 col-12 col-md-6">
                                                    <div id="content_kecamatan">
                                                        <!--LOAD DATA-->
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                Antar ekspedisi adalah layanan antar yang berkerjasama dengan ekspedisi yang ada di Indonesia. Pengiriman ini direkomendasikan diluar wilayah Kuningan, Majalengka dan Cirebon. Berikut ekspedisi yang tersedia:
                                                <br>
                                                1. JNE
                                                <br>
                                                2. TIKI
                                                <br>
                                                3. POS
                                                <br>
                                                <br>
                                                <i>*Mohon diperhatikan bahwa kami tidak akan bertanggung jawab apabila kualitas produk rusak, keterlambatan proses pengirimana di ekspedisi, dikarenakan dikarena oleh pihak ekspedisi. TIdak Ada pengemabalian barang dalam kasus ini.</i>
                                            </li>
                                        <br>
                                    </small>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h class="accordion-header" id="headingFour">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                    <b>Kadaluarsa Produk</b>
                                </button>
                            </h>
                            <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <p>
                                        Kami ingin memastikan bahwa Anda dan Orang Tercinta Anda menerima produk kami dalam kualitas terbaik. Mohon perhatikan informasi berikut:
                                    </p>
                                    <ul>
                                        <li>
                                            Kue memiliki umur simpan 3-4 hari dalam kondisi dingin.
                                        </li>
                                        <li>
                                            Baked Goods memiliki umur simpan 3-4 minggu dengan suhu ruangan
                                        </li>
                                        <li>
                                            Pastikan tanggal kadaluwarsa/saran penyajian di setiap deskripsi produk
                                        </li>
                                    </ul>
                                    <p>
                                        <i>*Untuk pengiriman ekpedisi tergantung pada waktu proses pengiriman, kemungkinan produk memiliki waktu kurang dari 1 minggu tanggal kadaluarsa.</i>
                                    </p>

                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h class="accordion-header" id="headingFive">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                    <b>Pembatalan Produk</b>
                                </button>
                            </h>
                            <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <p>Pemabatalan produk hanya dapat diterima sebelum melakukan transfer pembayaran kepada kami.</p>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h class="accordion-header" id="headingSix">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                                    <b>Tidak ada Pengembalian & Tidak ada Pertukaran</b>
                                </button>
                            </h>
                            <div id="collapseSix" class="accordion-collapse collapse" aria-labelledby="headingSix" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <p>Perlu diingat setelah transfer pembayaran dan proses pembuatan produk, tidak ada pengembalian dan pertukaran produk/</p>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h class="accordion-header" id="headingSeven">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                                    <b>Pertanyaan & Pengaduan</b>
                                </button>
                            </h>
                            <div id="collapseSeven" class="accordion-collapse collapse" aria-labelledby="headingSeven" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <p>Nur Cake Bakery, kami sangat berhati-hati dalam pelayanan dan produk kami sampai ke tangan pelanggan kami. Untuk pertanyaan lebih lanjut atau saran, silahkan hubungai kami melalui chat sistem kami, kontak kami dan email ke bakerycake791@gmail.com. Terima kasih telah berbelanja dengan kami</p>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h class="accordion-header" id="headingEight">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseEight" aria-expanded="false" aria-controls="collapseEight">
                                    <b>Acara Diskon</b>
                                </button>
                            </h>
                            <div id="collapseEight" class="accordion-collapse collapse" aria-labelledby="headingEight" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <p>Kami akan memberikan diskon potongan harga kepada pelanggan setia kami yang telah mendaftarkan diri di dalam sistem. Jadi jangan lewatkan buruan daftarkan diri anda disistem kami dan kami menginformasikan acara diskon melalui email.</p>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h class="accordion-header" id="headingNine">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseNine" aria-expanded="false" aria-controls="collapseNine">
                                    <b>Poin Potongan</b>
                                </button>
                            </h>
                            <div id="collapseNine" class="accordion-collapse collapse" aria-labelledby="headingNine" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <p>Setiap transaksi akan mendapatkan 1 poin tanpa ada minimum transaksi. Anda dapat menukarkan setiap 10 poin dengan potongan harga dengan syarat berlaku.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<?php $this->load->view('frontend/partials/footer.php') ?>
<?php $this->load->view('frontend/partials/script.php') ?>

<!-----------------------FUNGSI----------------------->
<script>
    $(document).ready(function() {  
        $("#pedoman_berbelanja").addClass("active");
        $("#topbar").removeClass("topbar-transparent");
        $("#header").removeClass("header-transparent");
    });
</script>

<script type="text/javascript">
    load_data_kecamatan()
    function load_data_kecamatan(){
        var kode_kabupaten = $('#kode_kabupaten').val();
		$.ajax({
			url : "<?php echo base_url('admin/pengaturan/load_data_kecamatan'); ?>",
            method: 'POST',
            data: {kode_kabupaten:kode_kabupaten},
			beforeSend : function(){
				$('#content_kecamatan').html('<div style="text-align:center"><i class="bx bx-loader-alt bx-md bx-spin" style="margin-top: 30px; margin-bottom: 30px;" aria-hidden="true"></i></div>');
			},
			success : function(response){
				$('#content_kecamatan').html(response);
			}
		});
    };

    $("#kode_kabupaten").change(function() {
        load_data_kecamatan()
    }); 

</script>