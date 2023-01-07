<?php $this->load->view('frontend/partials/head.php') ?>

<main id="main">
    <section id="breadcrumbs" class="breadcrumbs" style="margin-top: 80px">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                
            </div>
        </div>
    </section>  

    <section class="inner-page">
        <div class="container">
            <div class="section-title">
                <h2>Pendaftaran Berhasil</h2>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-5 d-flex align-items-stretch">
                    <div class="info">
                        <h5 class="text-justify;">
                            <div class="text-center">
                                <img style="width: 150px" src="<?php echo base_url('assets/img/banner/bx-check-circle.svg');?>">
                            </div>
                            </br>
                            </br>
                            Akun berhasil didaftarkan, dan akun langsung aktif..
                            </br>
                            </br>
                            Nikmati belanja dengan mudah dan murah disistem kami, dan dapatkan potongan harga dari kami.
                            </br>
                            </br>
                        </h5>
                        <small>
                            *Syarat dan Ketentuan Berlaku
                        </small>
                        </br>
                        <a href="<?php echo base_url('home'); ?>" style="color:white" class="btn btn-primary btn-sm btn-rounded"><span class="fa fa-arrow-left"></span> Kembali</a>
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
        $("#berhasil").addClass("active");
        $("#topbar").removeClass("topbar-transparent");
        $("#header").removeClass("header-transparent");
    });
</script>