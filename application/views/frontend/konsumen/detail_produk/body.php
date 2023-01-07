<?php $this->load->view('frontend/partials/head.php') ?>

<main id="main">
    <section id="breadcrumbs" class="breadcrumbs" style="margin-top: 80px">

    </section>

    <section class="inner-page">
        <div class="container mb-3">
            <div class="row gy-4">
                <div class="col-lg-4">
                    <div class="card-body">
                        <div class="d-flex justify-content-center">
                            <div class="ratio ratio-1x1">
                                <?php if($data_produk['gambar_produk'] != "") { ?>
                                    <img class="rounded" src="<?php echo base_url('assets/img/produk/').$data_produk['gambar_produk']; ?>" alt="" style="object-fit: cover; ">
                                <?php }else{ ?>
                                    <img class="rounded" src="<?php echo base_url('assets/img/banner/logo.png'); ?>" alt="" style="object-fit: cover; ">
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card-body">
                        <div class="form-group mb-3">
                            <strong class="fs-3"><?php echo $data_produk['nama_produk']."<br>"; ?></strong>
                            <p>        
                                <?php
                                    if(empty($data_ulasan_produk)) {
                                        echo "Belum ada ulasan |"; 
                                    }else{
                                        $total = 0;
                                        $count = 0;
                                        $average = 0;
                                        $angka_format = 0;
                                        $total_penilaian = 0;
                                        $total_penjualan = 0;
                                        foreach($data_ulasan_produk as $rat){ 
                                            if($rat->kode == $data_produk['hahaha'] && $rat->status_ipesanan == 4){ 
                                                $total_penilaian += 1;
                                                $total += $rat->rating_ipesanan;
                                                $count += 1;
                                                $average = $total / $count;
                                                $angka_format = number_format($average,1);
                                            }
                                            
                                            if($rat->kode == $data_produk['hahaha'] && $rat->status_pesanan >= 3){
                                                $total_penjualan += $rat->jumlah_ipesanan;
                                            }
                                        }

                                        if($average >= 5){
                                            echo "<span class='fa fa-star checked'></span>
                                            <span class='fa fa-star checked'></span>
                                            <span class='fa fa-star checked'></span>
                                            <span class='fa fa-star checked'></span>
                                            <span class='fa fa-star checked'></span>";
                                        } elseif($average >= 4){
                                            echo "<span class='fa fa-star checked'></span>
                                            <span class='fa fa-star checked'></span>
                                            <span class='fa fa-star checked'></span>
                                            <span class='fa fa-star checked'></span>
                                            <span class='fa fa-star'></span>";
                                        } elseif($average >= 3){
                                            echo "<span class='fa fa-star checked'></span>
                                            <span class='fa fa-star checked'></span>
                                            <span class='fa fa-star checked'></span>
                                            <span class='fa fa-star'></span>
                                            <span class='fa fa-star'></span>";
                                        } elseif($average >= 2){
                                            echo "<span class='fa fa-star checked'></span>
                                            <span class='fa fa-star checked'></span>
                                            <span class='fa fa-star'></span>
                                            <span class='fa fa-star'></span>
                                            <span class='fa fa-star'></span>";
                                        } else if($average >= 1){
                                            echo "<span class='fa fa-star checked'></span>
                                            <span class='fa fa-star'></span>
                                            <span class='fa fa-star'></span>
                                            <span class='fa fa-star'></span>
                                            <span class='fa fa-star'></span>";
                                        } 
                                        if($angka_format == 0){
                                            echo "Belum ada ulasan | "; 
                                        }else{
                                            echo " ".$angka_format." | ".$total_penilaian." Penilaian | ";
                                        }
                                        
                                        echo $total_penjualan." Penjualan";
                                    }
                                ?> 
                            </p>  
                        </div>
                    
                    
                        <div class="form-group mb-3">
                            <div id="potongan" style="display: none">
                                <span class="badge bg-success"><text id="text_potongan_ipromo"></text> %</span>
                                <del>Rp. <span id="text_harga_ukuran1"></span></del> 
                                <br>
                                <strong class="fs-4">Rp. <span id="text_harga_promo"></span></strong>
                            </div>
                            <div id="tanpa_potongan" style="display: none">
                                <strong class="fs-4">Rp. <span id="text_harga_ukuran2"></span></strong>
                            </div>
                        </div>
                        <hr>
                    
                    
                        <div class="form-group mb-3">
                            <p><?php echo nl2br($data_produk['deskripsi_produk']); ?></p>
                        </div>
                    

                        <div class="form-group mb-3">
                            <strong>Pilih Ukuran</strong><br>        
                            <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                                <?php 

                                    //MENCARI POTONGAN HARGA
                                    $no = 1;
                                    $harga_ukuran = 0;
                                    foreach($data_ukuran as $row2){
                                        if($row2->kode_produk == $data_produk['kode_produk']){
                                            $harga_ukuran = $row2->harga_ukuran;

                                            $potongan_ipromo = 0;
                                            $harga_promo = 0;
                                            foreach($data_ipromo as $row3){
                                                if($row3->kode_ukuran == $row2->kode_ukuran){
                                                    $potongan_ipromo = $row3->potongan_ipromo;
                                                    $harga_promo = $harga_ukuran - (($potongan_ipromo * $harga_ukuran) / 100);
                                                }else{

                                                }
                                            }
                                ?>
                                    <input type="radio" class="btn-check" name="btn_ukuran" id="btn_ukuran<?php echo $no;?>" value="<?php echo $row2->kode_ukuran."|".$row2->volume_ukuran."|".$row2->irisan_ukuran."|".$row2->berat_ukuran."|".$harga_ukuran."|".$potongan_ipromo."|".$harga_promo;?>" autocomplete="off" <?php if($no == 1){echo "checked";} ?> onclick="myFunction(event)">
                                    <label class="btn btn-outline-warning" for="btn_ukuran<?php echo $no;?>">
                                        <?php 
                                            echo "<b>".$row2->volume_ukuran."</b>";
                                            if($potongan_ipromo != 0){ echo "<small><span class='badge bg-warning'style='top: -15px; right: -10px;'>".$potongan_ipromo."%</span></small>";} 
                                        ?>
                                    </label>
                                <?php
                                            $no++;
                                        }
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>    


                <div class="col-lg-2">
                    <div class="card-body">
                        <form role="form" id="form_keranjang" method="post" aria-label="">
                            <input type="hidden" class="form-control" name="id_konsumen" id="id_konsumen" value="<?php if($this->session->userdata('ses_akses') != NUll){ echo $this->session->userdata['ses_id_konsumen']; }?>">
                            <input type="hidden" class="form-control" name="kode_produk" id="kode_produk" value="<?php echo $data_produk['hahaha']; ?>">
                            <input type="hidden" class="form-control" name="kode_ukuran" id="kode_ukuran">
                            <input type="hidden" class="form-control" name="volume_ukuran" id="volume_ukuran">
                            <input type="hidden" class="form-control" name="irisan_ukuran" id="irisan_ukuran">
                            <input type="hidden" class="form-control" name="berat_ukuran" id="berat_ukuran">
                            <input type="hidden" class="form-control" name="harga_ukuran" id="harga_ukuran">
                            <input type="hidden" class="form-control" name="potongan_ipromo" id="potongan_ipromo">
                            <input type="hidden" class="form-control" name="harga_promo" id="harga_promo">
                            <input type="hidden" class="form-control" name="hitung_harga" id="hitung_harga">
                            
                            <div class="form-group mb-3">
                                <strong>Jumlah Pembelian</strong>
                            </div>
                            <div class="row mb-3">
                                <button type="button" class="btn btn-outline-warning" onclick="decrement()" style="width: 20%;"><span class="fa fa-minus"></span></button>
                                <input type="number" class="form-control" name="jumlah_ipemesanan" id="jumlah_ipemesanan" min="0" max="1000" value="0" style="width: 60%; text-align:center">
                                <button type="button" class="btn btn-outline-warning" onclick="incerment()" style="width: 20%;"><span class="fa fa-plus"></span></button> 
                            </div>
                            <div class="form-group mb-3">
                                <div class="row">
                                    <small>Subtotal</small>
                                    <strong class="fs-5">Rp. <span id="subtotal_ipemesanan_text">0<span></strong>
                                </div>
                            </div>
                            <?php if($this->session->userdata('ses_akses') != NUll){ ?>
                            <div class="form-group mb-3">
                                <div class="row">
                                    <button type="submit" id="btn_tambah_keranjang" class="btn btn-warning btn-block"><span class="fa fa-plus"></span> Keranjang</button>
                                </div>
                            </div>
                            <?php } else { ?>
                            <div class="form-group mb-3">
                                <div class="row">
                                    <button type="button" class="btn btn-warning btn-block btn_modal_login"><span class="fa fa-plus"></span> Keranjang</button>
                                </div>
                            </div>
                            <?php } ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>


        <div class="container">
            <div class="d-flex justify-content-center">
                <div class="col-md-12 col-lg-12 col-12">
                    <div class="card-body">
                        <div class="portfolio-info">
                            <nav>
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                    <button class="nav-link active link-warning" id="nav-informasi-tanmbahan-tab" data-bs-toggle="tab" data-bs-target="#nav-informasi-tanmbahan" type="button" role="tab" aria-controls="nav-informasi-tanmbahan" aria-selected="true">Informasi Tambahan</button>
                                    <button class="nav-link link-warning" id="nav-ulasan-tab" data-bs-toggle="tab" data-bs-target="#nav-ulasan" type="button" role="tab" aria-controls="nav-ulasan" aria-selected="false">Ulasan</button>
                                    <button class="nav-link link-warning" id="nav-pengiriman-tab" data-bs-toggle="tab" data-bs-target="#nav-pengiriman" type="button" role="tab" aria-controls="nav-pengiriman" aria-selected="false">Pengiriman</button>
                                </div>
                            </nav>
                            <div class="tab-content" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="nav-informasi-tanmbahan" role="tabpanel" aria-labelledby="nav-informasi-tanmbahan-tab">
                                    <div class="card-body">
                                        <table class="table">
                                            <tr>
                                                <td style="width: 20%; text-align:left">Kategori</td>
                                                <td style="width: 80%; text-align:left"><?php echo $data_produk['nama_kategori']; ?></td>
                                            </tr>
                                            <tr>
                                                <td style="width: 20%; text-align:left">Bentuk</td>
                                                <td style="width: 80%; text-align:left"><?php echo $data_produk['bentuk_produk']; ?></td>
                                            </tr>
                                            <tr>
                                                <td style="width: 20%; text-align:left">Berat</td>
                                                <td style="width: 80%; text-align:left"><span id="text_berat_ukuran"></span></td>
                                            </tr>
                                            <tr>
                                                <td style="width: 20%; text-align:left">Irisan</td>
                                                <td style="width: 80%; text-align:left"><span id="text_irisan_ukuran"></span></td>
                                            </tr>
                                            <tr>
                                                <td style="width: 20%; text-align:left">Saran Penyajian</td>
                                                <td style="width: 80%; text-align:left"><?php echo $data_produk['penyajian_produk']; ?></td>
                                            </tr>
                                            <tr>
                                                <td style="width: 20%; text-align:left">Penyimpanan</td>
                                                <td style="width: 80%; text-align:left"><?php echo $data_produk['penyimpanan_produk']; ?></td>
                                            </tr>
                                            <tr>
                                                <td style="width: 20%; text-align:left">Kemasan</td>
                                                <td style="width: 80%; text-align:left"><?php echo $data_produk['pengemasan_produk']; ?></td>
                                            </tr>
                                            <tr>
                                                <td style="width: 20%; text-align:left">Aksesoris</td>
                                                <td style="width: 80%; text-align:left"><?php echo $data_produk['aksesoris_produk']; ?></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>


                                <div class="tab-pane fade" id="nav-ulasan" role="tabpanel" aria-labelledby="nav-ulasan-tab">
                                    <div class="card-body">
                                        <table class="table table-borderless">
                                            <tr>
                                                <td style="width: 1%; text-align:left">
                                                    <?php 
                                                        if(empty($data_ulasan_produk)) {
                                                            echo "- Belum ada ulasan -"; 
                                                        }

                                                        foreach($data_ulasan_produk as $i => $ul){ 
                                                            if($ul->kode == $data_produk['hahaha'] && $ul->status_ipesanan == 4){ 
                                                    ?>
                                                    <div class="row">
                                                        <div class="col-4">
                                                            <div class="row">
                                                                <div class="image col-3">
                                                                    <?php if($ul->foto_member != "") { ?>
                                                                        <img src="<?php echo base_url('assets/img/member/').$ul->foto_member; ?>" class="img-circle elevation-1" style=" border-radius: 20px; width:50px; height:50px; object-fit: cover;" alt="Image">
                                                                    <?php }else{ ?>
                                                                        <img src="<?php echo  base_url('assets/img/banner/profile.jpg'); ?>" class="img-circle elevation-1"  style="width:50px; height:50px; object-fit: cover; background-color:white" alt="Image">
                                                                    <?php } ?> 
                                                                </div>
                                                                <div class="col-9">
                                                                    <strong><?php echo $ul->ulasan_ipesanan; ?></strong>
                                                                    <br>
                                                                    <small><?php echo $ul->tanggal_ulasan_ipesanan; ?></small>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-8">
                                                            <p>
                                                                <?php 
                                                                $aa = $ul->rating_ipesanan;
                                                                if($aa == "" ){
                                                                    echo "- Belum ada ulasan -";                    
                                                                }
                                                                else{
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
                                                                }
                                                                ?>
                                                            </p>
                                                            <p>
                                                                <?php echo $ul->ulasan_ipesanan;?>
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <?php }} ?>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>


                                <div class="tab-pane fade" id="nav-pengiriman" role="tabpanel" aria-labelledby="nav-pengiriman-tab">
                                    <div class="card-body">
                                        <table>
                                            <tr>
                                                <td style="width: 1%; text-align:left"><i class="bx bx-fw bx-map"></i></td>
                                                <td style="width: 99%; text-align:left">Alamat pengirim <b>Jalaksana kab. Kuningan, Jawa Barat</b></td>
                                            </tr>
                                            <?php if($this->session->userdata('ses_id_konsumen') != null){ ?>
                                            <tr>
                                                <td><i class="bx bx-fw bx-home"></i></td>
                                                <td>Alamat penerima <b><?php $alamat_konsumen = explode("-",$data_konsumen['alamat_konsumen']); echo $alamat_konsumen[0]." RT ".$alamat_konsumen[1]." RW ".$alamat_konsumen[2].", Desa ".$data_konsumen['nama_desa'].", Kec. ".$data_konsumen['nama_kecamatan'].", Kab. ".$data_konsumen['nama_kabupaten']." ".$data_konsumen['nama_provinsi'];?></b></td>
                                            </tr>
                                            <?php } ?>
                                            <tr>
                                                <td><i class="bx bx-fw bxs-truck"></i></td>
                                                <td>Kurir yang tersedia</td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td>JNE</td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td>TIKI</td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td>POS Indonesia</td>
                                            </tr>
                                        </table>
                                    </div>
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
        $("#produk").addClass("active");
        $("#topbar").removeClass("topbar-transparent");
        $("#header").removeClass("header-transparent");
    });
</script>

<!-----------------------PILIH UKURAN----------------------->
<script type="text/javascript">

    $(document).ready(function() {   
        pilih_ukuran();
    });

    function myFunction(event) {
        pilih_ukuran();

    }

    function pilih_ukuran(){
        var myArray = $('input[name=btn_ukuran]:checked').val().split("|");
        $('#kode_ukuran').val(myArray[0]);
        $('#volume_ukuran').val(myArray[1]);
        $('#irisan_ukuran').val(myArray[2]);
        $('#berat_ukuran').val(myArray[3]);
        $('#harga_ukuran').val(myArray[4]);
        $('#potongan_ipromo').val(myArray[5]);
        $('#harga_promo').val(myArray[6]);
        
        var kode_ukuran = myArray[0];
        var volume_ukuran = myArray[1];
        var irisan_ukuran = myArray[2];
        var berat_ukuran = myArray[3];
        var harga_ukuran = myArray[4];
        var potongan_ipromo = myArray[5];
        var harga_promo = myArray[6];

        if(potongan_ipromo != 0 ){
            $("div#potongan").show(500);
            $("div#tanpa_potongan").hide(500);
            $('#text_berat_ukuran').text(new Number(berat_ukuran).toLocaleString("id-ID"));
            $('#text_harga_ukuran1').text(new Number(harga_ukuran).toLocaleString("id-ID"));
            $('#text_potongan_ipromo').text(new Number(potongan_ipromo).toLocaleString("id-ID"));
            $('#text_harga_promo').text(new Number(harga_promo).toLocaleString("id-ID"));
            $('#hitung_harga').val(harga_promo);
        }else{
            $("div#potongan").hide(500);
            $("div#tanpa_potongan").show(500);
            $('#text_harga_ukuran2').text(new Number(harga_ukuran).toLocaleString("id-ID"));
            $('#hitung_harga').val(harga_ukuran);
        }

        $('#text_volume_ukuran1').text(volume_ukuran);
        $('#text_volume_ukuran2').text(volume_ukuran);
        $('#text_irisan_ukuran').text(irisan_ukuran);
        $('#text_berat_ukuran').text(berat_ukuran);


        var harga_jual_produk = $('#hitung_harga').val();
        var jumlah_ipemesanan = $('#jumlah_ipemesanan').val();

        var subtotal_ipemesanan = harga_jual_produk * jumlah_ipemesanan;

        $('#subtotal_ipemesanan_text').val(subtotal_ipemesanan);        
        $('#subtotal_ipemesanan_text').text(new Number(subtotal_ipemesanan).toLocaleString("id-ID"));
        $('#jumlah').text(jumlah_ipemesanan);
    }
</script>

<!-----------------------PILIH JUMLAH PEMBELIAN----------------------->
<script type="text/javascript">

    function incerment() {
        document.getElementById('jumlah_ipemesanan').stepUp();
        hitung_subtotal();
    }

    function decrement() {
        document.getElementById('jumlah_ipemesanan').stepDown();
        hitung_subtotal();
    }

    $("#jumlah_ipemesanan").on("keyup change", function(e) {
        hitung_subtotal();
    })
    
    function hitung_subtotal(){

        var harga_jual_produk = $('#hitung_harga').val();
        var jumlah_ipemesanan = $('#jumlah_ipemesanan').val();

        var subtotal_ipemesanan = harga_jual_produk * jumlah_ipemesanan;

        $('#subtotal_ipemesanan_text').val(subtotal_ipemesanan);        
        $('#subtotal_ipemesanan_text').text(new Number(subtotal_ipemesanan).toLocaleString("id-ID"));
        $('#jumlah').text(jumlah_ipemesanan);
    }

    $('#btn_tambah_keranjang').on("click",function(){
        $('#form_keranjang').validate({
            rules: {
                jumlah_ipemesanan: {
                    required: '0',
                },
            },
            messages: {
                jumlah_ipemesanan: {
                    required: "Jumlah harus diisi",
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
                    url : '<?php echo base_url('home/tambah_keranjang'); ?>',
                    method: 'POST',
                    data: $('#form_keranjang').serialize(),
                    success: function(response){
                        if(response==1){
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: 'Produk telah masuk daftar belanja',
                                showConfirmButton: true,
                                confirmButtonColor: '#007bff',
                                timer: 3000
                            }).then(function(){
                                $('#modal_belanja_lagi').modal('show');
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: response,
                                showConfirmButton: true,
                                confirmButtonColor: '#007bff',
                                timer: 3000
                            });
                            $('#daftar').prop("disabled",false);
                        }
                    }
                });   
            }
        });
    });

    $('.close').click(function() {
        location.reload();
    });
   
</script>