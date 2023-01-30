<?php $this->load->view('frontend/partials/head.php') ?>

<?php 
    $link_detail = "transaksi/detail/"; 

    $total_ulasan_pemesanan = 0;
    $total_ulasan_produk = 0;
    foreach($data_pemesanan as $data){
        if($data->status_pemesanan == 6 && $data->ulasan_pemesanan == ''){
            $total_ulasan_pemesanan = $total_ulasan_pemesanan + 1;
        }
    }

    foreach($data_produk as $data){
        if($data->status_ipemesanan == 3){
            $total_ulasan_produk = $total_ulasan_produk + 1;
        }
    }
    $total_ulasan = $total_ulasan_pemesanan + $total_ulasan_produk;

    $rating_5 = "<span class='fa fa-star checked'></span>
        <span class='fa fa-star checked'></span>
        <span class='fa fa-star checked'></span>
        <span class='fa fa-star checked'></span>
        <span class='fa fa-star checked'></span>";
    $rating_4 = "<span class='fa fa-star checked'></span>
        <span class='fa fa-star checked'></span>
        <span class='fa fa-star checked'></span>
        <span class='fa fa-star checked'></span>
        <span class='fa fa-star'></span>";
    $rating_3 = "<span class='fa fa-star checked'></span>
        <span class='fa fa-star checked'></span>
        <span class='fa fa-star checked'></span>
        <span class='fa fa-star'></span>
        <span class='fa fa-star'></span>";
    $rating_2 = "<span class='fa fa-star checked'></span>
        <span class='fa fa-star checked'></span>
        <span class='fa fa-star'></span>
        <span class='fa fa-star'></span>
        <span class='fa fa-star'></span>";
    $rating_1 = "<span class='fa fa-star checked'></span>
        <span class='fa fa-star'></span>
        <span class='fa fa-star'></span>
        <span class='fa fa-star'></span>
        <span class='fa fa-star'></span>";

?>
<main id="main">

    <section id="breadcrumbs" class="breadcrumbs" style="margin-top: 80px">

    </section>

    <section id="menu" class="menu">
    <div class="container">
        <div class="section-title">
            <h2>Ulasan</h2>
            <p>"Masukan kritik saran dan penilaian anda adalah kebutuhan kami untuk terus meningkatkan layanan dan produk."</p>                                     
        </div>
        <div class="row">
            <div class="col-lg-12 d-flex justify-content-center">
                <ul id="menu-flters">
                    <li data-filter="*" class="position-relative filter-active">
                        Semua Ulasan
                    </li>
                    <li data-filter=".filter_menunggu_ulasan" class="position-relative">
                        Menunggu Ulasan
                        <?php if($total_ulasan != 0){ ?>
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="margin-bottom: -10px;">
                                <?php echo $total_ulasan; ?>
                            </span>
                        <?php } ?>
                    </li>
                    <li data-filter=".filter_sudah_diulas" class="position-relative">
                        Selesai Diulas 
                    </li>
                </ul>
            </div>
        </div>


        <div class="card">
            <div class="card-body">
                <div class="row menu-container">
                    <div class="col-lg-12 menu-item filter_menunggu_ulasan filter-active">
                        <div style="overflow-x:auto;">
                            <table style="width:100%" class="table table-borderless">       
                                <tbody>
                                    <?php 
                                        foreach($data_pemesanan as $row1) {
                                            $jumlah_blm_diulas = 0;
                                            $jumlah_sdh_diulas = 0;
                                            foreach($data_produk as $row2){
                                                if($row2->kode_pemesanan == $row1->kode_pemesanan ){ 
                                                    if($row2->status_ipemesanan == 3){
                                                        $jumlah_blm_diulas = $jumlah_blm_diulas + 1;
                                                    }
                                                    if($row2->status_ipemesanan == 4){
                                                        $jumlah_sdh_diulas = $jumlah_sdh_diulas + 1;
                                                    }
                                                }
                                            }
    
                                            if($row1->status_pemesanan == 6 && $row1->ulasan_pemesanan == "" || $jumlah_blm_diulas != 0){
                                    ?>
                                        <thead class="border">
                                            <tr>
                                                <td style="text-align: left; vertical-align: top; width: 40%">
                                                    <span class="text-bold"><?php echo $row1->tanggal_pemesanan." ".$row1->kode_pemesanan;?></span>
                                                    <br>
                                                    <br>
                                                    <span>Bagaimana pengalaman berbelanja Anda dengan NUR CAKE & BAKERY?</span>
                                                    <br>
                                                    <br>
                                                    <?php if($row1->status_pemesanan == 6 && $row1->ulasan_pemesanan == ""){ ?>
                                                        <a class='btn btn-outline-warning btn-sm btn-rounded rounded-pill btn_modal_ulasan_pemesanan' kode_pemesanan = <?php echo $row1->kode_pemesanan;?>>Tulis Ulasan</a>
                                                    <?php 
                                                        } else { 
                                                            if($row1->rating_pemesanan  >= 5){
                                                                echo $rating_5;
                                                            } elseif($row1->rating_pemesanan  >= 4){
                                                                echo $rating_4;
                                                            } elseif($row1->rating_pemesanan  >= 3){
                                                                echo $rating_3;
                                                            } elseif($row1->rating_pemesanan  >= 2){
                                                                echo $rating_2;
                                                            } else if($row1->rating_pemesanan  >= 1){
                                                                echo $rating_1;
                                                            } 
                                                        ?>
                                                        <br>
                                                        <small class=""><?php echo $row1->tanggal_ulasan_pemesanan; ?></small>
                                                        <br>
                                                        <small class=""><?php echo $row1->ulasan_pemesanan; ?></small>
                                                    <?php }  ?>
                                                </td>
                                                <td style="text-align: left; vertical-align: top; width: 60%; border-left: 2px solid #dee2e6">
                                                    <span class="text-bold">Daftar Produk</span>
                                                    <table style="width:100%" id="table" class="table ">
                                                        <tbody>
                                                            <?php 
                                                                $no = 1;
                                                                foreach($data_produk as $row2){
                                                                    if($row2->kode_pemesanan == $row1->kode_pemesanan ){ 
                                                                        if($row2->diskon_ipemesanan == ""){
                                                                            $subtotal_harga = $row2->harga_ipemesanan;
                                                                        }else{
                                                                            $subtotal_harga = $row2->harga_ipemesanan - (($row2->diskon_ipemesanan * $row2->harga_ipemesanan) / 100);
                                                                        }
                                                            ?> 
                                                            <tr>
                                                                <td class="pt-4 pb-4" style="text-align: center; vertical-align: middle; width:15%">
                                                                    <a href="<?php echo base_url('home/detail_produk/').$row2->hahaha;?>" style="color: black;"> 
                                                                        <div class="" style="text-align: center;">
                                                                            <?php if($row2->gambar_produk != ""){ ?>
                                                                                <img src="<?php echo base_url('assets/img/produk/').$row2->gambar_produk; ?>" alt="" style="border-radius: 10px; width: 70px; height: 70px;  object-fit: cover; ">
                                                                            <?php }else{ ?>
                                                                                <img src="<?php echo base_url('assets/img/banner/logo.png'); ?>" alt="" style="border-radius: 10px; width: 70px; height: 70px;  object-fit: cover; ">
                                                                            <?php } ?>
                                                                        </div>
                                                                    </a>
                                                                </td>
                                                                <td class="pt-4 pb-4" style="text-align: left; vertical-align: middle; width:45%">
                                                                    <a href="<?php echo base_url('home/detail_produk/').$row2->hahaha;?>" style="color: black;"> 
                                                                        <span class="fs-6 text-bold"><?php echo $row2->nama_produk; ?></span>
                                                                        <br> 
                                                                        <small><?php echo number_format($row2->qty_ipemesanan, 0, ".", ".")." Item" ; ?></small> x 
                                                                        <small>Rp. <?php echo number_format($subtotal_harga, 0, ".", "."); ?></small>
                                                                    </a>
                                                                    <br>
                                                                </td>
                                                                <?php if($row2->status_ipemesanan == 3){ ?>
                                                                    <td class="pt-4 pb-4" style="text-align: right; vertical-align: middle; width:30%">
                                                                        <a class='btn btn-outline-warning btn-sm btn-rounded rounded-pill btn_modal_ulasan_produk' kode_ipemesanan = <?php echo $row2->kode_ipemesanan;?>>Tulis Ulasan</a>
                                                                    </td>
                                                                <?php } elseif($row2->status_ipemesanan == 4) { ?>
                                                                    <td class="pt-4 pb-4" style="text-align: right; vertical-align: middle;">
                                                                        <?php 
                                                                            if($row2->rating_ipemesanan  >= 5){
                                                                                echo $rating_5;
                                                                            } elseif($row2->rating_ipemesanan  >= 4){
                                                                                echo $rating_4;
                                                                            } elseif($row2->rating_ipemesanan  >= 3){
                                                                                echo $rating_3;
                                                                            } elseif($row2->rating_ipemesanan  >= 2){
                                                                                echo $rating_2;
                                                                            } else if($row2->rating_ipemesanan  >= 1){
                                                                                echo $rating_1;
                                                                            } 
                                                                        ?>
                                                                        <br>
                                                                        <small class=""><?php echo $row2->tanggal_ulasan_ipemesanan; ?></small>
                                                                        <br>
                                                                        <small class=""><?php echo $row2->ulasan_ipemesanan; ?></small>
                                                                    </td>
                                                                <?php }  ?>
                                                            </tr>
                                                            <?php     
                                                                $no++;
                                                                    } 
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


                    <div class="col-lg-12 menu-item filter_sudah_diulas">
                         <div style="overflow-x:auto;">
                            <table style="width:100%" class="table table-borderless">       
                                <tbody>
                                    <?php 
                                        foreach($data_pemesanan as $row1) {
                                            $jumlah_blm_diulas = 0;
                                            $jumlah_sdh_diulas = 0;
                                            foreach($data_produk as $row2){
                                                if($row2->kode_pemesanan == $row1->kode_pemesanan ){ 
                                                    if($row2->status_ipemesanan == 3){
                                                        $jumlah_blm_diulas = $jumlah_blm_diulas + 1;
                                                    }
                                                    if($row2->status_ipemesanan == 4){
                                                        $jumlah_sdh_diulas = $jumlah_sdh_diulas + 1;
                                                    }
                                                }
                                            }

                                            if($row1->status_pemesanan == 6 && $row1->ulasan_pemesanan != "" && $jumlah_blm_diulas == 0){
                                    ?>
                                        <thead class="border">
                                            <tr>
                                                <td style="text-align: left; vertical-align: top; width: 40%">
                                                    <span class="text-bold"><?php echo $row1->tanggal_pemesanan." ".$row1->kode_pemesanan;?></span>
                                                    <br>
                                                    <br>
                                                    <?php 
                                                        if($row1->rating_pemesanan  >= 5){
                                                            echo $rating_5;
                                                        } elseif($row1->rating_pemesanan  >= 4){
                                                            echo $rating_4;
                                                        } elseif($row1->rating_pemesanan  >= 3){
                                                            echo $rating_3;
                                                        } elseif($row1->rating_pemesanan  >= 2){
                                                            echo $rating_2;
                                                        } else if($row1->rating_pemesanan  >= 1){
                                                            echo $rating_1;
                                                        } 
                                                    ?>
                                                    <br>
                                                    <small class=""><?php echo $row1->tanggal_ulasan_pemesanan; ?></small>
                                                    <br>
                                                    <span class=""><?php echo $row1->ulasan_pemesanan; ?></span>
                                                </td>
                                                <td style="text-align: left; vertical-align: top; width: 60%; border-left: 2px solid #dee2e6">
                                                    <span class="text-bold">Daftar Produk</span>
                                                    <table style="width:100%" id="table" class="table ">
                                                        <tbody>
                                                            <?php 
                                                                $no = 1;
                                                                foreach($data_produk as $row2){
                                                                    if($row2->kode_pemesanan == $row1->kode_pemesanan ){ 
                                                                        if($row2->diskon_ipemesanan == ""){
                                                                            $subtotal_harga = $row2->harga_ipemesanan;
                                                                        }else{
                                                                            $subtotal_harga = $row2->harga_ipemesanan - (($row2->diskon_ipemesanan * $row2->harga_ipemesanan) / 100);
                                                                        }
                                                            ?> 
                                                            <tr>
                                                                <td class="pt-4 pb-4" style="text-align: center; vertical-align: middle; width:15%">
                                                                    <a href="<?php echo base_url('home/detail_produk/').$row2->hahaha;?>" style="color: black;"> 
                                                                        <div class="" style="text-align: center;">
                                                                            <?php if($row2->gambar_produk != ""){ ?>
                                                                                <img src="<?php echo base_url('assets/img/produk/').$row2->gambar_produk; ?>" alt="" style="border-radius: 10px; width: 70px; height: 70px;  object-fit: cover; ">
                                                                            <?php }else{ ?>
                                                                                <img src="<?php echo base_url('assets/img/banner/logo.png'); ?>" alt="" style="border-radius: 10px; width: 70px; height: 70px;  object-fit: cover; ">
                                                                            <?php } ?>
                                                                        </div>
                                                                    </a>
                                                                </td>
                                                                <td class="pt-4 pb-4" style="text-align: left; vertical-align: middle; width:45%">
                                                                    <a href="<?php echo base_url('home/detail_produk/').$row2->hahaha;?>" style="color: black;"> 
                                                                        <span class="fs-6 text-bold"><?php echo $row2->nama_produk; ?></span>
                                                                        <br> 
                                                                        <small><?php echo number_format($row2->qty_ipemesanan, 0, ".", ".")." Item" ; ?></small> x 
                                                                        <small>Rp. <?php echo number_format($subtotal_harga, 0, ".", "."); ?></small>
                                                                    </a>
                                                                    <br>
                                                                </td>
                                                                <td class="pt-4 pb-4" style="text-align: right; vertical-align: middle;">
                                                                    <?php 
                                                                        if($row2->rating_ipemesanan  >= 5){
                                                                            echo $rating_5;
                                                                        } elseif($row2->rating_ipemesanan  >= 4){
                                                                            echo $rating_4;
                                                                        } elseif($row2->rating_ipemesanan  >= 3){
                                                                            echo $rating_3;
                                                                        } elseif($row2->rating_ipemesanan  >= 2){
                                                                            echo $rating_2;
                                                                        } else if($row2->rating_ipemesanan  >= 1){
                                                                            echo $rating_1;
                                                                        } 
                                                                    ?>
                                                                    <br>
                                                                    <small class=""><?php echo $row2->tanggal_ulasan_ipemesanan; ?></small>
                                                                    <br>
                                                                    <small class=""><?php echo $row2->ulasan_ipemesanan; ?></small>
                                                                </td>
                                                            </tr>
                                                            <?php     
                                                                $no++;
                                                                    } 
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
    </section>
</main>


<div id="modal_ulasan_pemesanan" class="modal animated pulse" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border: 2px solid #ffc107; border-radius: 20px">
            <div class="modal-body">
                <form id="form_ulasan_pemesanan" method="post" aria-label="">
                    <div class="modal-header">
                        <h4>Beri Ulasan Pemesanan</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group mb-3">
                            <input type="hidden" class="kode_pemesanan" id="kode_pemesanan">
                            <label class="form-label">Rating</label>
                            <br>
                            <span class="star-rating star-5">
                                <input type="radio" name="rating_pemesanan" value="1"><i></i>
                                <input type="radio" name="rating_pemesanan" value="2"><i></i>
                                <input type="radio" name="rating_pemesanan" value="3"><i></i>
                                <input type="radio" name="rating_pemesanan" value="4"><i></i>
                                <input type="radio" name="rating_pemesanan" value="5"><i></i>
                            </span>
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label">Ulasan</label>
                            <textarea class="form-control" name="ulasan_pemesanan" id="ulasan_pemesanan" style="height: 200px;" placeholder="Beri ulasan transaksi ini. Dilihat dari sisi pelayanan toko, kecepatan transaksi, packing produk atau yang lainnya"></textarea>
                        </div>
                        </br>
                        <div class="form-group">
                            <button type="submit" id="btn_simpan_ulasan_pemesanan" class="btn btn-warning rounded-pill" style="width:100%">Simpan</button>  
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="modal_ulasan_produk" class="modal animated pulse" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border: 2px solid #ffc107; border-radius: 20px">
            <div class="modal-body">
                <form id="form_ulasan_produk" method="post" aria-label="">
                    <div class="modal-header">
                        <h4>Beri Ulasan Produk</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group mb-3">
                            <input type="hidden" class="kode_ipemesanan" id="kode_ipemesanan">
                            <label class="form-label">Rating</label>
                            <br>
                            <span class="star-rating star-5">
                                <input type="radio" name="rating_ipemesanan" value="1"><i></i>
                                <input type="radio" name="rating_ipemesanan" value="2"><i></i>
                                <input type="radio" name="rating_ipemesanan" value="3"><i></i>
                                <input type="radio" name="rating_ipemesanan" value="4"><i></i>
                                <input type="radio" name="rating_ipemesanan" value="5"><i></i>
                            </span>
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label">Ulasan</label>
                            <textarea class="form-control" name="ulasan_ipemesanan" id="ulasan_ipemesanan" placeholder="Beri ulasan produk yang telah dibeli"></textarea>
                        </div>
                        </br>
                        <div class="form-group">
                            <button type="submit" id="btn_simpan_ulasan_produk" class="btn btn-warning rounded-pill" style="width:100%">Simpan</button>  
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
        $("#profil_konsumen").addClass("active");
        $("#topbar").removeClass("topbar-transparent");
        $("#header").removeClass("header-transparent");
    });
</script>


<!-----------------------ULASAN PEMESANAN----------------------->
<script>
    $('.btn_modal_ulasan_pemesanan').on("click",function(){
        $('#modal_ulasan_pemesanan').modal('show');
        var text = $(this).attr("kode_pemesanan")
        $('.kode_pemesanan').val(text);
    });

    
    $(document).ready(function() {
    $('#btn_simpan_ulasan_pemesanan').on("click",function(){
            $("#form_ulasan_pemesanan").valid();
        });

        $('#form_ulasan_pemesanan').validate({
            rules: {
                ulasan_pemesanan: {
                    required: true
                },
            },
            messages: {
                ulasan_pemesanan: {
                    required: "Ulasan harus diisi",
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
                
                var kode_pemesanan = $('#kode_pemesanan').val();
                var rating_pemesanan = $("input[name='rating_pemesanan']:checked").val();
                var ulasan_pemesanan = $('#ulasan_pemesanan').val();
                $.ajax({
                    url : '<?php echo base_url('home/update_ulasan_pemesanan'); ?>',
                    method: 'POST',
                    data: {
                        kode_pemesanan:kode_pemesanan,
                        rating_pemesanan:rating_pemesanan,
                        ulasan_pemesanan:ulasan_pemesanan
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
                        }     
                    }
                })   
            }
        });
    }); 
</script>

<!-----------------------ULASAN PRODUK----------------------->
<script>
    $('.btn_modal_ulasan_produk').on("click",function(){
        $('#modal_ulasan_produk').modal('show');
        var text = $(this).attr("kode_ipemesanan")
        $('.kode_ipemesanan').val(text);
    });

    
    $(document).ready(function() {
    $('#btn_simpan_ulasan').on("click",function(){
            $("#form_ulasan_produk").valid();
        });

        $('#form_ulasan_produk').validate({
            rules: {
                ulasan_ipemesanan: {
                    required: true
                },
            },
            messages: {
                ulasan_ipemesanan: {
                    required: "Password harus diisi",
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
                
                var kode_ipemesanan = $('#kode_ipemesanan').val();
                var rating_ipemesanan = $("input[name='rating_ipemesanan']:checked").val();
                var ulasan_ipemesanan = $('#ulasan_ipemesanan').val();
                $.ajax({
                    url : '<?php echo base_url('home/update_ulasan_produk'); ?>',
                    method: 'POST',
                    data: {
                        kode_ipemesanan:kode_ipemesanan,
                        rating_ipemesanan:rating_ipemesanan,
                        ulasan_ipemesanan:ulasan_ipemesanan
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
                        }     
                    }
                })   
            }
        });
    }); 
</script>