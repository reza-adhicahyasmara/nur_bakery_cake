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
                Awal mula jualan parfum refil yaitu meneruskan usaha milik kakak yang memiliki toko parfum di winduhaji akan tetapi tidak diteruskan karena karyawannya tidak ada. Kemudian dibeli oleh pemilik yang sekarang dari mulai tokonya sampai dengan isinya pada tahun 2012. Pada tahun 2013 toko flash gallery sudah pindah ke kuningan tepatnya di jalan siliwangi depan bank BCA. Lalu, pada tahun 2015 pemilik toko mulai berjualan parfum laundry untuk kebutuhan laundry. Dan juga untuk menambah varian barang yang dijual di toko flash gallery. Parfum laundry yang pertama dibuat itu merek snappy, utuk bahannya lihat di google kemudian dimodifikasi sendiri. Setelah adanya snappy dan mulai dipasarkan kepada masyarakat dan masyarakatpun tertarik, maka dibuat lagi varian lainnya seperti downy black dan ocean fresh. Jadi awalnya jualan parfum laundry hanya ada 3 varian yaitu snappy, downy black dan ocean fresh. Untuk pemasarannya melalui media sosial seperti facebook, Instagram dan whatsapp. Kemudian pasarnya nambah ramai pemilik toko menambah lagi varian sakura dan akasia. Lalu nambah lagi varian maura dan terakhir varian violet. Untuk parfum laundry yang best seller yaitu akasia disusul violet. Awal bikin cuman beberapa botol saja perbulan tapi sekarang sudah berjalan lama bisa membuat sekitar 200 liter perbulan. Kemudian untuk sekarang karena kondisi sedang pandemi maka toko yang di kuningan tidak diteruskan lagi dan sekarang pindah ke toko yang di winduhaji yang beralamat di Gang Kebudayaan RT 06 RW06 Kel. Winduhaji, Kec. Kuningan, Kab. Kuningan.
            </div>
        </div>
        <div class="container mb-5 mt-5">
            <div class="section-title">
                <h2>Visi</h2>
            </div>
            <div class="content" style="text-align: justify">
                Menjadi Toko Parfum Laundry yang senantiasa mampu bersaing dan tumbuh berkembang dengan sehat di kota Kuningan.
            </div>
        </div>
        <div class="container mt-5">
            <div class="section-title">
                <h2>Misi</h2>
            </div>
            <div class="content" style="text-align: justify">
                Mengenalkan parfum laundry pada semua lapisan masyarakat dengan membuat produk yang berkualitas dengan harga yang terjangkau untuk semua kalangan masyarakat
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
