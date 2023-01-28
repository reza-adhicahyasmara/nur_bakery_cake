<?php 
    $this->load->view('backend/partials/head.php');

    $link_detail = "admin/transaksi/detail/"; 

    $menunggu_pembayaran_as = 0;
    $verifikasi_pembayaran_as = 0;
    $proses_pembuatan_as = 0;
    $proses_pengiriman_as = 0;
    
    $as = "Ambil Sendiri";

    foreach($data_pemesanan as $data){
        if($data->status_pemesanan == '1' && $data->metode_pengiriman_pemesanan == $as){
            $menunggu_pembayaran_as = $menunggu_pembayaran_as + 1;
        }
        if($data->status_pemesanan == '2' && $data->metode_pengiriman_pemesanan == $as){
            $verifikasi_pembayaran_as = $verifikasi_pembayaran_as + 1;
        }
        if($data->status_pemesanan == '3' && $data->metode_pengiriman_pemesanan == $as){
            $proses_pembuatan_as = $proses_pembuatan_as + 1;
        }
        if($data->status_pemesanan == '5' && $data->metode_pengiriman_pemesanan == $as){
            $proses_pengiriman_as = $proses_pengiriman_as + 1;
        }
    }
?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"><span class="nav-icon bx bx-fw bxs-book"></span>Transaksi Ambil Sendiri</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        
                    </ol>
                </div><!-- /.col -->
                <div class="m-2 breadcrumb">
                    <span class="breadcrumb-item"><a href="<?php echo base_url('admin/dashboard'); ?>">Dashboard</a></span>
                    <span class="breadcrumb-item active">Transaksi Ambil Sendiri</span>
                </div>
            </div>
        </div>
    </div>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-sm-12">
                <div class="card card-warning card-outline card-outline-tabs ">
                    <div class="card-header p-0 border-bottom-0">
                        <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="menu" data-toggle="pill" href="#menunggu_pembayaran_as" role="tab" aria-controls="menunggu_pembayaran_as" aria-selected="true">Menunggu Transfer <?php if($menunggu_pembayaran_as != 0){ ?><span class="badge badge-danger right"> <?php echo $menunggu_pembayaran_as; ?></span><?php } ?></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="custom-tabs-one-messages-tab" data-toggle="pill" href="#verifikasi_pembayaran_as" role="tab" aria-controls="verifikasi_pembayaran_as" aria-selected="false">Transfer Masuk <?php if($verifikasi_pembayaran_as != 0){ ?><span class="badge badge-danger right"> <?php echo $verifikasi_pembayaran_as; ?></span><?php } ?></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="custom-tabs-one-messages-tab" data-toggle="pill" href="#proses_pembuatan_as" role="tab" aria-controls="proses_pembuatan_as" aria-selected="false">Proses Pembuatan <?php if($proses_pembuatan_as != 0){ ?><span class="badge badge-danger right"> <?php echo $proses_pembuatan_as; ?></span><?php } ?></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="custom-tabs-one-messages-tab" data-toggle="pill" href="#proses_pengiriman_as" role="tab" aria-controls="proses_pengiriman_as" aria-selected="false">Menunggu Pengambilan <?php if($proses_pengiriman_as != 0){ ?><span class="badge badge-danger right"> <?php echo $proses_pengiriman_as;?></span><?php } ?></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="custom-tabs-one-messages-tab" data-toggle="pill" href="#selesai" role="tab" aria-controls="selesai" aria-selected="false">Selesai </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="custom-tabs-one-messages-tab" data-toggle="pill" href="#batal" role="tab" aria-controls="batal" aria-selected="false">Batal </a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="custom-tabs-one-tabContent">
                            <div class="tab-pane fade show active" id="menunggu_pembayaran_as" role="tabpanel" aria-labelledby="custom-tabs-one-messages-tab">    
                                <table style="width:100%" id="dataTable1" class="table table-bordered table-striped">
                                    <caption></caption>
                                    <thead>
                                        <tr>
                                            <th id="" style="text-align: center; vertical-align: middle; ">No.</th>
                                            <th id="" style="text-align: center; vertical-align: middle; ">Aksi</th>
                                            <th id="" style="text-align: center; vertical-align: middle; ">Tanggal</th>
                                            <th id="" style="text-align: center; vertical-align: middle; ">Nama Customer</th>
                                            <th id="" style="text-align: center; vertical-align: middle; ">No. Kontak</th>
                                            <th id="" style="text-align: center; vertical-align: middle; ">Alamat</th>
                                            <th id="" style="text-align: center; vertical-align: middle; ">Transfer</th>
                                            <th id="" style="text-align: center; vertical-align: middle; ">Total Belanja</th>
                                            <th id="" style="text-align: center; vertical-align: middle; ">Kurir</th>
                                            <th id="" style="text-align: center; vertical-align: middle; ">Status Pby</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $no = 1;
                                            foreach($data_pemesanan as $row) {
                                                if($row->status_pemesanan == 1 && $row->metode_pengiriman_pemesanan == $as){
                                                    ?>
                                                <tr>
                                                    <td style="text-align: center; vertical-align: middle;"><?php echo $no;?></td>
                                                    <td style="text-align: center; vertical-align: middle;" >
                                                        <a class='btn btn-info btn-sm btn-rounded' href="<?php echo base_url($link_detail).$row->kode_pemesanan; ?>" style="margin:3px"><span class="bx bx-fw bx-info-square"></span></a>
                                                    </td>
                                                    <td style="text-align: left; vertical-align: middle;"><?php echo $row->tanggal_pemesanan;?></td>
                                                    <td style="text-align: left; vertical-align: middle;"><?php echo $row->nama_konsumen;?></td>
                                                    <td style="text-align: left; vertical-align: middle;"><?php echo $row->kontak_konsumen;?></td>
                                                    <td style="text-align: left; vertical-align: middle;"><?php $alamat_konsumen = explode("-",$row->alamat_konsumen); echo $alamat_konsumen[0]." RT ".$alamat_konsumen[1]." RW ".$alamat_konsumen[2].", Desa/Kel. ".$row->nama_desa. " Kec. ".$row->nama_kecamatan." ".$row->nama_kabupaten." Provinsi ".$row->nama_provinsi ;?></td>
                                                    <td style="text-align: left; vertical-align: middle;"><?php echo $row->rekening_pemesanan;?></td>
                                                    <td style="text-align: right; vertical-align: middle;"><?php echo "Rp. ".number_format($row->total_tagihan_pemesanan, 0, ".", ".");?></td>
                                                    <td style="text-align: left; vertical-align: middle;"><?php $kurir = explode("|",$row->kurir_pemesanan); echo $kurir[0]." - ".$kurir[1]." (".$kurir[2]." Hari)";?></td>
                                                    <td style="text-align: left; vertical-align: middle;"><?php echo $row->status_pby_pemesanan;?></td>
                                                </tr>
                                                    <?php 
                                                    $no++;
                                                }
                                            } 
                                        ?>
                                    </tbody>
                                </table>
                            </div>



                            <div class="tab-pane fade" id="verifikasi_pembayaran_as" role="tabpanel" aria-labelledby="custom-tabs-one-messages-tab">
                                <table style="width:100%" id="dataTable2" class="table table-bordered table-striped">
                                    <caption></caption>
                                    <thead>
                                        <tr>
                                            <th id="" style="text-align: center; vertical-align: middle; ">No.</th>
                                            <th id="" style="text-align: center; vertical-align: middle; ">Aksi</th>
                                            <th id="" style="text-align: center; vertical-align: middle; ">Tanggal</th>
                                            <th id="" style="text-align: center; vertical-align: middle; ">Nama Customer</th>
                                            <th id="" style="text-align: center; vertical-align: middle; ">No. Kontak</th>
                                            <th id="" style="text-align: center; vertical-align: middle; ">Alamat</th>
                                            <th id="" style="text-align: center; vertical-align: middle; ">Transfer</th>
                                            <th id="" style="text-align: center; vertical-align: middle; ">Total Belanja</th>
                                            <th id="" style="text-align: center; vertical-align: middle; ">Kurir</th>
                                            <th id="" style="text-align: center; vertical-align: middle; ">Status Pby</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $no = 1;
                                            foreach($data_pemesanan as $row) {
                                                if($row->status_pemesanan == 2 && $row->metode_pengiriman_pemesanan == $as){
                                                    ?>
                                                <tr>
                                                    <td style="text-align: center; vertical-align: middle;"><?php echo $no;?></td>
                                                    <td style="text-align: center; vertical-align: middle;" >
                                                        <a class='btn btn-info btn-sm btn-rounded' href="<?php echo base_url($link_detail).$row->kode_pemesanan; ?>" style="margin:3px"><span class="bx bx-fw bx-info-square"></span></a>
                                                    </td>
                                                    <td style="text-align: left; vertical-align: middle;"><?php echo $row->tanggal_pemesanan;?></td>
                                                    <td style="text-align: left; vertical-align: middle;"><?php echo $row->nama_konsumen;?></td>
                                                    <td style="text-align: left; vertical-align: middle;"><?php echo $row->kontak_konsumen;?></td>
                                                    <td style="text-align: left; vertical-align: middle;"><?php $alamat_konsumen = explode("-",$row->alamat_konsumen); echo $alamat_konsumen[0]." RT ".$alamat_konsumen[1]." RW ".$alamat_konsumen[2].", Desa/Kel. ".$row->nama_desa. " Kec. ".$row->nama_kecamatan." ".$row->nama_kabupaten." Provinsi ".$row->nama_provinsi ;?></td>
                                                    <td style="text-align: left; vertical-align: middle;"><?php echo $row->rekening_pemesanan;?></td>
                                                    <td style="text-align: right; vertical-align: middle;"><?php echo "Rp. ".number_format($row->total_tagihan_pemesanan, 0, ".", ".");?></td>
                                                    <td style="text-align: left; vertical-align: middle;"><?php $kurir = explode("|",$row->kurir_pemesanan); echo $kurir[0]." - ".$kurir[1]." (".$kurir[2]." Hari)";?></td>
                                                    <td style="text-align: left; vertical-align: middle;"><?php echo $row->status_pby_pemesanan;?></td>
                                                </tr>
                                                    <?php 
                                                    $no++;
                                                }
                                            } 
                                        ?>
                                    </tbody>
                                </table>
                            </div>



                            <div class="tab-pane fade" id="proses_pembuatan_as" role="tabpanel" aria-labelledby="custom-tabs-one-messages-tab">
                                <table style="width:100%" id="dataTable3" class="table table-bordered table-striped">
                                    <caption></caption>
                                    <thead>
                                        <tr>
                                            <th id="" style="text-align: center; vertical-align: middle; ">No.</th>
                                            <th id="" style="text-align: center; vertical-align: middle; ">Aksi</th>
                                            <th id="" style="text-align: center; vertical-align: middle; ">Tanggal</th>
                                            <th id="" style="text-align: center; vertical-align: middle; ">Nama Customer</th>
                                            <th id="" style="text-align: center; vertical-align: middle; ">No. Kontak</th>
                                            <th id="" style="text-align: center; vertical-align: middle; ">Alamat</th>
                                            <th id="" style="text-align: center; vertical-align: middle; ">Transfer</th>
                                            <th id="" style="text-align: center; vertical-align: middle; ">Total Belanja</th>
                                            <th id="" style="text-align: center; vertical-align: middle; ">Kurir</th>
                                            <th id="" style="text-align: center; vertical-align: middle; ">Status Pby</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $no = 1;
                                            foreach($data_pemesanan as $row) {
                                                if($row->status_pemesanan == 3 && $row->metode_pengiriman_pemesanan == $as){
                                                    ?>
                                                <tr>
                                                    <td style="text-align: center; vertical-align: middle;"><?php echo $no;?></td>
                                                    <td style="text-align: center; vertical-align: middle;" >
                                                        <a class='btn btn-info btn-sm btn-rounded' href="<?php echo base_url($link_detail).$row->kode_pemesanan; ?>" style="margin:3px"><span class="bx bx-fw bx-info-square"></span></a>
                                                    </td>
                                                    <td style="text-align: left; vertical-align: middle;"><?php echo $row->tanggal_pemesanan;?></td>
                                                    <td style="text-align: left; vertical-align: middle;"><?php echo $row->nama_konsumen;?></td>
                                                    <td style="text-align: left; vertical-align: middle;"><?php echo $row->kontak_konsumen;?></td>
                                                    <td style="text-align: left; vertical-align: middle;"><?php $alamat_konsumen = explode("-",$row->alamat_konsumen); echo $alamat_konsumen[0]." RT ".$alamat_konsumen[1]." RW ".$alamat_konsumen[2].", Desa/Kel. ".$row->nama_desa. " Kec. ".$row->nama_kecamatan." ".$row->nama_kabupaten." Provinsi ".$row->nama_provinsi ;?></td>
                                                    <td style="text-align: left; vertical-align: middle;"><?php echo $row->rekening_pemesanan;?></td>
                                                    <td style="text-align: right; vertical-align: middle;"><?php echo "Rp. ".number_format($row->total_tagihan_pemesanan, 0, ".", ".");?></td>
                                                    <td style="text-align: left; vertical-align: middle;"><?php $kurir = explode("|",$row->kurir_pemesanan); echo $kurir[0]." - ".$kurir[1]." (".$kurir[2]." Hari)";?></td>
                                                    <td style="text-align: left; vertical-align: middle;"><?php echo $row->status_pby_pemesanan;?></td>
                                                </tr>
                                                    <?php 
                                                    $no++;
                                                }
                                            } 
                                        ?>
                                    </tbody>
                                </table>
                            </div>



                            <div class="tab-pane fade" id="proses_pengiriman_as" role="tabpanel" aria-labelledby="custom-tabs-one-messages-tab">
                                <table style="width:100%" id="dataTable4" class="table table-bordered table-striped">
                                    <caption></caption>
                                    <thead>
                                        <tr>
                                            <th id="" style="text-align: center; vertical-align: middle; ">No.</th>
                                            <th id="" style="text-align: center; vertical-align: middle; ">Aksi</th>
                                            <th id="" style="text-align: center; vertical-align: middle; ">Tanggal</th>
                                            <th id="" style="text-align: center; vertical-align: middle; ">Nama Customer</th>
                                            <th id="" style="text-align: center; vertical-align: middle; ">No. Kontak</th>
                                            <th id="" style="text-align: center; vertical-align: middle; ">Alamat</th>
                                            <th id="" style="text-align: center; vertical-align: middle; ">Transfer</th>
                                            <th id="" style="text-align: center; vertical-align: middle; ">Total Belanja</th>
                                            <th id="" style="text-align: center; vertical-align: middle; ">Kurir</th>
                                            <th id="" style="text-align: center; vertical-align: middle; ">Status Pby</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $no = 1;
                                            foreach($data_pemesanan as $row) {
                                                if($row->status_pemesanan == 5 && $row->metode_pengiriman_pemesanan == $as){
                                                    ?>
                                                <tr>
                                                    <td style="text-align: center; vertical-align: middle;"><?php echo $no;?></td>
                                                    <td style="text-align: center; vertical-align: middle;" >
                                                        <a class='btn btn-info btn-sm btn-rounded' href="<?php echo base_url($link_detail).$row->kode_pemesanan; ?>" style="margin:3px"><span class="bx bx-fw bx-info-square"></span></a>
                                                    </td>
                                                    <td style="text-align: left; vertical-align: middle;"><?php echo $row->tanggal_pemesanan;?></td>
                                                    <td style="text-align: left; vertical-align: middle;"><?php echo $row->nama_konsumen;?></td>
                                                    <td style="text-align: left; vertical-align: middle;"><?php echo $row->kontak_konsumen;?></td>
                                                    <td style="text-align: left; vertical-align: middle;"><?php $alamat_konsumen = explode("-",$row->alamat_konsumen); echo $alamat_konsumen[0]." RT ".$alamat_konsumen[1]." RW ".$alamat_konsumen[2].", Desa/Kel. ".$row->nama_desa. " Kec. ".$row->nama_kecamatan." ".$row->nama_kabupaten." Provinsi ".$row->nama_provinsi ;?></td>
                                                    <td style="text-align: left; vertical-align: middle;"><?php echo $row->rekening_pemesanan;?></td>
                                                    <td style="text-align: right; vertical-align: middle;"><?php echo "Rp. ".number_format($row->total_tagihan_pemesanan, 0, ".", ".");?></td>
                                                    <td style="text-align: left; vertical-align: middle;"><?php $kurir = explode("|",$row->kurir_pemesanan); echo $kurir[0]." - ".$kurir[1]." (".$kurir[2]." Hari)";?></td>
                                                    <td style="text-align: left; vertical-align: middle;"><?php echo $row->status_pby_pemesanan;?></td>
                                                </tr>
                                                    <?php 
                                                    $no++;
                                                }
                                            } 
                                        ?>
                                    </tbody>
                                </table>
                            </div>



                            <div class="tab-pane fade" id="selesai" role="tabpanel" aria-labelledby="custom-tabs-one-messages-tab">
                                <table style="width:100%" id="dataTable7" class="table table-bordered table-striped">
                                    <caption></caption>
                                    <thead>
                                        <tr>
                                            <th id="" style="text-align: center; vertical-align: middle; ">No.</th>
                                            <th id="" style="text-align: center; vertical-align: middle; ">Aksi</th>
                                            <th id="" style="text-align: center; vertical-align: middle; ">Tanggal</th>
                                            <th id="" style="text-align: center; vertical-align: middle; ">Nama Customer</th>
                                            <th id="" style="text-align: center; vertical-align: middle; ">No. Kontak</th>
                                            <th id="" style="text-align: center; vertical-align: middle; ">Alamat</th>
                                            <th id="" style="text-align: center; vertical-align: middle; ">Transfer</th>
                                            <th id="" style="text-align: center; vertical-align: middle; ">Total Belanja</th>
                                            <th id="" style="text-align: center; vertical-align: middle; ">Kurir</th>
                                            <th id="" style="text-align: center; vertical-align: middle; ">Status Pby</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $no = 1;
                                            foreach($data_pemesanan as $row) {
                                                if($row->status_pemesanan == 6 && $row->metode_pengiriman_pemesanan == $as){
                                                    ?>
                                                <tr>
                                                    <td style="text-align: center; vertical-align: middle;"><?php echo $no;?></td>
                                                    <td style="text-align: center; vertical-align: middle;" >
                                                        <a class='btn btn-info btn-sm btn-rounded' href="<?php echo base_url($link_detail).$row->kode_pemesanan; ?>" style="margin:3px"><span class="bx bx-fw bx-info-square"></span></a>
                                                    </td>
                                                    <td style="text-align: left; vertical-align: middle;"><?php echo $row->tanggal_pemesanan;?></td>
                                                    <td style="text-align: left; vertical-align: middle;"><?php echo $row->nama_konsumen;?></td>
                                                    <td style="text-align: left; vertical-align: middle;"><?php echo $row->kontak_konsumen;?></td>
                                                    <td style="text-align: left; vertical-align: middle;"><?php $alamat_konsumen = explode("-",$row->alamat_konsumen); echo $alamat_konsumen[0]." RT ".$alamat_konsumen[1]." RW ".$alamat_konsumen[2].", Desa/Kel. ".$row->nama_desa. " Kec. ".$row->nama_kecamatan." ".$row->nama_kabupaten." Provinsi ".$row->nama_provinsi ;?></td>
                                                    <td style="text-align: left; vertical-align: middle;"><?php echo $row->rekening_pemesanan;?></td>
                                                    <td style="text-align: right; vertical-align: middle;"><?php echo "Rp. ".number_format($row->total_tagihan_pemesanan, 0, ".", ".");?></td>
                                                    <td style="text-align: left; vertical-align: middle;"><?php $kurir = explode("|",$row->kurir_pemesanan); echo $kurir[0]." - ".$kurir[1]." (".$kurir[2]." Hari)";?></td>
                                                    <td style="text-align: left; vertical-align: middle;"><?php echo $row->status_pby_pemesanan;?></td>
                                                </tr>
                                                    <?php 
                                                    $no++;
                                                }
                                            } 
                                        ?>
                                    </tbody>
                                </table>
                            </div>



                            <div class="tab-pane fade" id="batal" role="tabpanel" aria-labelledby="custom-tabs-one-messages-tab">
                                <table style="width:100%" id="dataTable8" class="table table-bordered table-striped">
                                    <caption></caption>
                                    <thead>
                                        <tr>
                                            <th id="" style="text-align: center; vertical-align: middle; ">No.</th>
                                            <th id="" style="text-align: center; vertical-align: middle; ">Aksi</th>
                                            <th id="" style="text-align: center; vertical-align: middle; ">Tanggal</th>
                                            <th id="" style="text-align: center; vertical-align: middle; ">Nama Customer</th>
                                            <th id="" style="text-align: center; vertical-align: middle; ">No. Kontak</th>
                                            <th id="" style="text-align: center; vertical-align: middle; ">Alamat</th>
                                            <th id="" style="text-align: center; vertical-align: middle; ">Transfer</th>
                                            <th id="" style="text-align: center; vertical-align: middle; ">Total Belanja</th>
                                            <th id="" style="text-align: center; vertical-align: middle; ">Kurir</th>
                                            <th id="" style="text-align: center; vertical-align: middle; ">Status Pby</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $no = 1;
                                            foreach($data_pemesanan as $row) {
                                                if($row->status_pemesanan == 7 && $row->metode_pengiriman_pemesanan == $as){
                                                    ?>
                                                <tr>
                                                    <td style="text-align: center; vertical-align: middle;"><?php echo $no;?></td>
                                                    <td style="text-align: center; vertical-align: middle;" >
                                                        <a class='btn btn-info btn-sm btn-rounded' href="<?php echo base_url($link_detail).$row->kode_pemesanan; ?>" style="margin:3px"><span class="bx bx-fw bx-info-square"></span></a>
                                                    </td>
                                                    <td style="text-align: left; vertical-align: middle;"><?php echo $row->tanggal_pemesanan;?></td>
                                                    <td style="text-align: left; vertical-align: middle;"><?php echo $row->nama_konsumen;?></td>
                                                    <td style="text-align: left; vertical-align: middle;"><?php echo $row->kontak_konsumen;?></td>
                                                    <td style="text-align: left; vertical-align: middle;"><?php $alamat_konsumen = explode("-",$row->alamat_konsumen); echo $alamat_konsumen[0]." RT ".$alamat_konsumen[1]." RW ".$alamat_konsumen[2].", Desa/Kel. ".$row->nama_desa. " Kec. ".$row->nama_kecamatan." ".$row->nama_kabupaten." Provinsi ".$row->nama_provinsi ;?></td>
                                                    <td style="text-align: left; vertical-align: middle;"><?php echo $row->rekening_pemesanan;?></td>
                                                    <td style="text-align: right; vertical-align: middle;"><?php echo "Rp. ".number_format($row->total_tagihan_pemesanan, 0, ".", ".");?></td>
                                                    <td style="text-align: left; vertical-align: middle;"><?php $kurir = explode("|",$row->kurir_pemesanan); echo $kurir[0]." - ".$kurir[1]." (".$kurir[2]." Hari)";?></td>
                                                    <td style="text-align: left; vertical-align: middle;"><?php echo $row->status_pby_pemesanan;?></td>
                                                </tr>
                                                    <?php 
                                                    $no++;
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
        </div>
    </div>
</section>
</div>

<?php $this->load->view('backend/partials/footer.php') ?>
<?php $this->load->view('backend/partials/script.php') ?>

<!-----------------------FUNGSI----------------------->
<script>
    var url = '<?php echo base_url('admin/transaksi/ambil_sendiri'); ?>' ;
    $('ul.nav-sidebar a').filter(function() {
        return this.href == url;
    }).addClass('active ');
    $('ul.nav-treeview a').filter(function() {
        return this.href == url;
    }).parentsUntil(".nav-sidebar > .nav-treeview").addClass('menu-open').prev('a').addClass('active');
    
    
    $(function () {
        $("#dataTable1").DataTable({
        "responsive": true,
        "autoWidth": false
        });
    });

    $(function () {
        $("#dataTable2").DataTable({
        "responsive": true,
        "autoWidth": false
        });
    });

    $(function () {
        $("#dataTable3").DataTable({
        "responsive": true,
        "autoWidth": false
        });
    });

    $(function () {
        $("#dataTable4").DataTable({
        "responsive": true,
        "autoWidth": false
        });
    });

    $(function () {
        $("#dataTable5").DataTable({
        "responsive": true,
        "autoWidth": false
        });
    });

    $(function () {
        $("#dataTable6").DataTable({
        "responsive": true,
        "autoWidth": false
        });
    });

    $(function () {
        $("#dataTable7").DataTable({
        "responsive": true,
        "autoWidth": false
        });
    });

    $(function () {
        $("#dataTable8").DataTable({
        "responsive": true,
        "autoWidth": false
        });
    });

    $(function () {
        $("#dataTable9").DataTable({
        "responsive": true,
        "autoWidth": false
        });
    });

    $(function () {
        $("#dataTable10").DataTable({
        "responsive": true,
        "autoWidth": false
        });
    });

</script>