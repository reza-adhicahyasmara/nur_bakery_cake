<?php $this->load->view('frontend/partials/head.php') ?>

<main id="main"> 
    <section class="breadcrumbs">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <h2><img src="<?php echo base_url('assets/img/banner/undraw_city_life.svg')?>" style="height: 300px; object-fit: cover;"></h2>
                <ol>
                    <li><h1>Tentang Nur Bakery & Cake</h1></li>
                </ol>
            </div>
        </div>
    </section>
    
    <section class="inner-page">
        <div class="container">
            <div class="section-title">
                <h2>Flash Gallery Parfume</h2>
            </div>
            <div class="content" style="text-align: justify">
            Nur Bakery & Cake merupakan perusahaan home industri yang beralamat di Kampung Tarikolot Rt 02 Rw 01 Desa Babakanmulya Kec. Jalaksana Kab. Kuningan, Jawa Barat, 45554. Bergerak dalam bidang pengolahan makanan Roti dan Kue yang dibentuk tanggal 1 Agustus 2008. Nur Bakery & Cake menyediakan berbagai macam roti dan kue yang enak dan lezat yang dikerjakan dengan yang ahli di bidangnya.
            </div>
        </div>
        <div class="container mb-5 mt-5">
            <div class="section-title">
                <h2>Visi</h2>
            </div>
            <div class="content" style="text-align: justify">
                Menjadikan Nur Bakery & Cake sebagai perusahaan yang maju, inspiratif dan produktif.
            </div>
        </div>
        <div class="container mt-5">
            <div class="section-title">
                <h2>Misi</h2>
            </div>
            <div class="content" style="text-align: justify">
                <ul>
                    <li>Mampu bersaing dengan banyak pesaing.</li>
                    <li>Menciptakan berbagai inovasi baru berbagai macam olahan roti dan kue.</li>
                    <li>Menghadirkan kualitas mewah dengan harga yang ramah.</li>
                    <li>Membuka lapangan pekerjaan.</li>
                </ul>
            </div>
        </div>
    </section>
</main>

<?php $this->load->view('frontend/partials/footer.php') ?>
<?php $this->load->view('frontend/partials/script.php') ?>

<!-----------------------FUNGSI----------------------->
<script>
    $(document).ready(function() {  
        $("#tentang").addClass("active");
        $("#topbar").removeClass("topbar-transparent");
        $("#header").removeClass("header-transparent");
    });
</script>
