<?php $this->load->view('frontend/partials/head.php') ?>

<main id="main">  
    <section id="breadcrumbs" class="breadcrumbs" style="margin-top: 80px">

    </section>


    <section id="why-us" class="why-us">
        <div class="container">
            <?php 
                $delay = 100;
                foreach($data_diskon as $row){
                    if(date("Y-m-d") <= $row->tanggal_akhir_diskon){
            ?>
                <a href="<?php echo base_url('home/detail_acara_diskon/').$row->kode_diskon;?>">
                    <div class="col-lg-12 mt-4">
                        <div class="box card">
                            <img alt="Gambar diskon" src="<?php echo base_url('assets/img/diskon/').$row->gambar_diskon;?>" style="width:100%; height: 400px; object-fit: cover;">
                            <span class="fs-4 text-bol" style="color: #850523;"> <?php echo $row->nama_diskon; ?></span>
                            <span class="fs-6"><i class="bx bx-fw bx-calendar"></i><?php echo $row->tanggal_awal_diskon." s.d ".$row->tanggal_akhir_diskon;?></span>
                            <p>
                                <?php echo $row->deskripsi_diskon; ?>
                            </p>
                        </div>
                    </div>
                </a>
            <?php }else{ ?>
                <div class="col-lg-12 mt-4">
                    <div class="card">
                        <div class="card-body">
                        <div class="card-body">
                            <img alt="Gambar diskon" src="<?php echo base_url('assets/img/diskon/').$row->gambar_diskon;?>" style="width:100%; height: 400px; object-fit: cover; filter: grayscale(100%);">
                            <span class="fs-4 text-bold"><?php echo $row->nama_diskon; ?></span>
                            <br>
                            <span class="fs-6"><i class="bx bx-fw bx-calendar"></i><?php echo $row->tanggal_awal_diskon." s.d ".$row->tanggal_akhir_diskon;?></span>
                            <p>
                                <?php echo $row->deskripsi_diskon; ?>
                            </p>
                        </div>
                        </div>
                    </div>
                </div>
            <?php } } ?>
        </div>
    </section>
</main>

<?php $this->load->view('frontend/partials/footer.php') ?>
<?php $this->load->view('frontend/partials/script.php') ?>

<!-----------------------FUNGSI----------------------->
<script>
    $(document).ready(function() {  
        $("#acara_diskon").addClass("active");
        $("#topbar").removeClass("topbar-transparent");
        $("#header").removeClass("header-transparent");
    });
</script>