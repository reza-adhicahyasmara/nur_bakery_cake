<?php $this->load->view('backend/partials/head.php') ?>

<?php 

    $jumlah_konsumen = 0;
    foreach($this->Mod_konsumen->get_all_konsumen()->result() as $row) {
        if($row->status_konsumen == "Aktif"){
            $jumlah_konsumen += 1;
        }
    }

    
    $jumlah_produk = 0;
    foreach($this->Mod_master->get_all_produk()->result() as $row) {
        $jumlah_produk += 1;
    }

    $jumlah_ongkos = 0;
    $jumlah_pendapatan = 0;
    $ongkir = 0;
    foreach($this->Mod_pemesanan->get_all_pemesanan()->result() as $row) {
        if($row->status_pemesanan == 6 ){
            if($row->metode_pengiriman_pemesanan == "Antar Cepat"){
                $kurir = explode("|",$row->kurir_pemesanan);
                $jumlah_ongkos += $kurir[3];
            }
            $jumlah_pendapatan += $row->total_belanja_pemesanan;
        }
    }
?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"><span class="nav-icon bx bx-fw bxs-grid-alt"></span>Dashboard</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                       
                    </ol>
                </div>
            </div>
        </div>
    </div>
    
    <section class="content">
        <div class="container-fluid">
            <div class="row">        
                <div class="col-md-3 col-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-info elevation-1"><i class="bx bx-fw bxs-group"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Konsumen</span>
                            <h5 class="info-box-number"><?php echo number_format($jumlah_konsumen, 0, ".", "."); ?></span>
                        </div>
                    </div>
                </div>  
                <div class="col-md-3 col-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-warning elevation-1"><i class="bx bx-fw bxs-cake"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Produk</span>
                            <h5 class="info-box-number"><?php echo number_format($jumlah_konsumen, 0, ".", "."); ?></span>
                        </div>
                    </div>
                </div>    
                <div class="col-md-3 col-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-primary elevation-1"><i class="bx bx-fw bx-coin"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Ongkos Antar Cepat</span>
                            <h5 class="info-box-number"><?php echo number_format($jumlah_ongkos, 0, ".", "."); ?></span>
                        </div>
                    </div>
                </div>   
                <div class="col-md-3 col-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-success elevation-1"><i class="bx bx-fw bx-money"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Penjualan</span>
                            <h5 class="info-box-number"><?php echo number_format($jumlah_pendapatan, 0, ".", "."); ?></span>
                        </div>
                    </div>
                </div>                       
            </div> 
            <div class="row">
                <div class="col-lg-12 col-12">
                    <div class="card bg-gradient">
                        <div class="card-header border-0">
                            <h3 class="card-title">
                            <i class="bx bx-fw bx-transfer mr-1"></i>
                                Transaksi (<?php echo date("Y"); ?>)
                            </h3>
                        </div>
                        <div class="card-body">
                            <div class="chart" style="min-height: 400px; height: 400px; max-height: 400px; max-width: 100%;">
                                <canvas id="chart_transaksi"></canvas>       
                            </div>    
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 col-12">
                    <div class="card bg-gradient">
                        <div class="card-header border-0">
                            <h3 class="card-title">
                            <i class="bx bx-fw bxs-heart mr-1"></i>
                                Kepuasan Pelanggan (<?php echo date("Y"); ?>)
                            </h3>
                        </div>
                        <div class="card-body">
                            <div class="chart" style="min-height: 400px; height: 400px; max-height: 400px; max-width: 100%;">
                                <canvas id="chart_kepuasan"></canvas>       
                            </div>    
                        </div>
                    </div>
                </div>
            </div>
          
        </div>
    </section>  
</div> 

<?php $this->load->view('backend/partials/footer.php') ?>
<?php $this->load->view('backend/partials/script.php') ?>

<script language="JavaScript">

    var url = window.location;
    $('ul.nav-sidebar a').filter(function() {
        return this.href == url;
    }).addClass('active ');
    $('ul.nav-treeview a').filter(function() {
        return this.href == url;
    }).parentsUntil(".nav-sidebar > .nav-treeview").addClass('menu-open').prev('a').addClass('active');
</script>

<script>
    var ctx = document.getElementById("chart_transaksi").getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: <?php echo $bulan_tahun; ?>, 
            datasets: [
                {
                    label               : 'Antar Cepat',
                    borderColor         : 'rgba(108, 117, 125, 1)',
                    pointRadius         : 3,
                    fill                : false,
                    data                : <?php echo $jumlah_antar_cepat; ?>
                },
                {
                    label               : 'Antar Ekspedisi',
                    borderColor         : 'rgba(0, 123, 255, 0.8)',
                    pointRadius         : 3,
                    fill                : false,
                    data                : <?php echo $jumlah_antar_ekspedisi; ?>
                },
                {
                    label               : 'Ambil Sendiri',
                    borderColor         : 'rgba(253, 126, 20, 1)',
                    pointRadius         : 3,
                    fill                : false,
                    data                : <?php echo $jumlah_ambil_sendiri; ?>
                },
            ],
        },
        options: {
            maintainAspectRatio : false,
            responsive : true,
            legend: {
                position: "bottom"
            },
            scales: {
                xAxes: [{
                    gridLines : {
                        display : true,
                    },
                }],
                yAxes: [{
                    gridLines : {
                        display : false,
                    },
                    
                    ticks: {
                        beginAtZero: true,
                        stepSize: 500000,

                        // Return an empty string to draw the tick line but hide the tick label
                        // Return `null` or `undefined` to hide the tick line entirely
                        userCallback: function(value, index, values) {
                            // Convert the number to a string and splite the string every 3 charaters from the end
                            value = value.toString();
                            value = value.split(/(?=(?:...)*$)/);

                            // Convert the array to a string and format the output
                            value = value.join('.');
                            return 'Rp' + value;
                        }
                    }
                }]
            }                                    
        }
    });
</script>

<script>
    var ctx = document.getElementById("chart_kepuasan").getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: <?php echo $bulan_tahun; ?>, 
            datasets: [
                {
                    label               : 'Rating 0',
                    borderColor         : 'rgba(220, 53, 69, 0.8)',
                    pointRadius         : 3,
                    fill                : false,
                    data                : <?php echo $jumlah_rating_0; ?>
                },
                {
                    label               : 'Rating 1',
                    borderColor         : 'rgba(253, 126, 20, 0.8)',
                    pointRadius         : 3,
                    fill                : false,
                    data                : <?php echo $jumlah_rating_1; ?>
                },
                {
                    label               : 'Rating 2',
                    borderColor         : 'rgba(255, 193, 7, 0.8)',
                    pointRadius         : 3,
                    fill                : false,
                    data                : <?php echo $jumlah_rating_2; ?>
                },
                {
                    label               : 'Rating 3',
                    borderColor         : 'rgba(216, 255, 8, 0.8)',
                    pointRadius         : 3,
                    fill                : false,
                    data                : <?php echo $jumlah_rating_3; ?>
                },
                {
                    label               : 'Rating 4',
                    borderColor         : 'rgba(175, 255, 8, 0.8)',
                    pointRadius         : 3,
                    fill                : false,
                    data                : <?php echo $jumlah_rating_4; ?>
                },
                {
                    label               : 'Rating 5',
                    borderColor         : 'rgba(40, 167, 69, 0.8)',
                    pointRadius         : 3,
                    fill                : false,
                    data                : <?php echo $jumlah_rating_5; ?>
                },
            ],
        },
        options: {
            maintainAspectRatio : false,
            responsive : true,
            legend: {
                position: "bottom"
            },
            scales: {
                xAxes: [{
                    gridLines : {
                        display : true,
                    }
                }],
                yAxes: [{
                    gridLines : {
                        display : false,
                    }
                }]
            }                                    
        }
    });
</script>

</body>
</html>