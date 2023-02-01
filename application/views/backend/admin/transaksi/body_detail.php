<?php $this->load->view('backend/partials/head.php') ?>

<div class="content-wrapper">
    <?php
        $status_pemesanan = $data_detail['status_pemesanan'];
        $metode_pengiriman_pemesanan = $data_detail['metode_pengiriman_pemesanan'];
        $bukti_pby_pemesanan = $data_detail['bukti_pby_pemesanan'];
        $status_pby_pemesanan = $data_detail['status_pby_pemesanan'];
        $keterangan_pemesanan = $data_detail['keterangan_pemesanan'];

        if($status_pby_pemesanan == "Belum Dibayarkan"){
            $badge_status_pby_pemesanan = "<span class='badge bg-danger text-lg'>Belum Dibayarkan</span>";
        } elseif($status_pby_pemesanan == "Sudah Ditransfer"){
            $badge_status_pby_pemesanan = "<span class='badge bg-warning text-lg'>Sudah Ditransfer</span>";
        } elseif($status_pby_pemesanan == "Lunas"){
            $badge_status_pby_pemesanan = "<span class='badge bg-success text-lg'>Lunas</span>";
        } elseif($status_pby_pemesanan == "Dana Dikembalikan"){
            $badge_status_pby_pemesanan = "<span class='badge bg-secondary text-lg'>Dana Dikembalikan</span>";
        } elseif($status_pby_pemesanan == "Cash on Delivery"){
            $badge_status_pby_pemesanan = "<span class='badge bg-primary text-lg'>Cash on Delivery</span>";
        }

        $badge_menunggu_transfer = "<span class='badge badge-pill badge-secondary text-sm p-2' style='width:100%'>Menunggu Transfer</span>";
        $badge_validasi_pembayaran = "<span class='badge badge-pill badge-secondary text-sm p-2' style='width:100%'>Validasi Pembayaran</span>";
        $badge_proses_pembuatan = "<span class='badge badge-pill badge-secondary text-sm p-2' style='width:100%'>Proses Pembuatan</span>";
        $badge_pengiriman =  "<span class='badge badge-pill badge-secondary text-sm p-2' style='width:100%'>Produk Dikirim</span>";
        $badge_pengambilan =  "<span class='badge badge-pill badge-secondary text-sm p-2' style='width:100%'>Produk Siap Ambil</span>";
        $badge_selesai = "<span class='badge badge-pill badge-success text-sm p-2' style='width:100%'>Selesai</span>";
        $badge_batal = "<span class='badge badge-pill badge-danger text-sm p-2' style='width:100%'>Batal</span>";
    ?>
    <input type="hidden" id="id_konsumen" value="<?php echo $data_detail['id_konsumen']; ?>">
    <input type="hidden" id="kode_pemesanan" value="<?php echo $data_detail['kode_pemesanan']; ?>">
    <input type="hidden" id="metode_pengiriman_pemesanan" value="<?php echo $data_detail['metode_pengiriman_pemesanan']; ?>">
    <input type="hidden" id="status_pemesanan" value="<?php echo $data_detail['status_pemesanan']; ?>">
    <input type="hidden" id="status_pby_pemesanan" value="<?php echo $data_detail['status_pby_pemesanan']; ?>">

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"><span class="nav-icon bx bx-fw bxs-book"></span>Detail Transaksi</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    </ol>
                </div><!-- /.col -->
                <div class="m-2 breadcrumb">
                    <span class="breadcrumb-item"><a href="<?php echo base_url('admin/dashboard'); ?>">Dashboard</a></span>
                    <span class="breadcrumb-item"><a href="<?php echo base_url('admin/transaksi'); ?>">Transaksi</a></span>
                    <span class="breadcrumb-item active">Detail Transaksi</span>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="card card-outline">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="col-8">
                            <div class="row" data-aos="fade-right">  
                                <a href="<?php echo base_url('transaksi/invoice/').$data_detail['kode_pemesanan'];?>" class="btn btn-outline-warning ml-2 mr-3" target="_blank"><span class="bx bx-fw bxs-printer"></span>Cetak</a>
                                <?php if($status_pemesanan == 1) { ?>  
                                    <button type="button" class="btn btn-outline-danger mr-3" id="btn_batalkan_transaksi"><span class="fa fa-times"></span> Batalkan Transaksi</button>
                                <?php } else if($status_pemesanan > 1){ ?> 
                                    <button type="button" class="btn btn-outline-success btn_bukti_pembayaran mr-3"><span class="bx bx-fw bx-money"></span>Bukti Pembayaran</button>
                                <?php } if($status_pemesanan == 3 && $metode_pengiriman_pemesanan == "Ekspedisi"){ ?> 
                                    <button type="button" class="btn btn-outline-success mr-3" id="btn_verifikasi_ekspedisi"><span class="fa fa-check"></span> Produk Kirim</button>
                                    <button type="button" class="btn btn-outline-danger mr-3" id="btn_batalkan_transaksi"><span class="fa fa-times"></span> Batal Kirim</button>
                                <?php }elseif($status_pemesanan == 3 && $metode_pengiriman_pemesanan == "Antar Cepat"){ ?>
                                    <button type="button" class="btn btn-outline-success mr-3" id="btn_antar_cepat"><span class="fa fa-check"></span> Produk Kirim</button>
                                    <button type="button" class="btn btn-outline-danger mr-3" id="btn_batalkan_transaksi"><span class="fa fa-times"></span> Batal Kirim</button>
                                <?php } elseif($status_pemesanan == 3 && $metode_pengiriman_pemesanan == "Ambil Sendiri"){ ?>
                                    <button type="button" class="btn btn-outline-success mr-3" id="btn_ambil_sendiri"><span class="fa fa-check"></span> Siap Diambil Konsumen</button>
                                    <button type="button" class="btn btn-outline-danger mr-3" id="btn_batalkan_transaksi"><span class="fa fa-times"></span> Batal Produksi</button>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="float-right" data-aos="fade-left">
                                <?php
                                    if($status_pemesanan == 1){
                                        echo $badge_menunggu_transfer;
                                    } elseif($status_pemesanan == 2){
                                        echo $badge_validasi_pembayaran;
                                    } elseif($status_pemesanan == 3){
                                        echo $badge_proses_pembuatan;
                                    } elseif($status_pemesanan == 4){
                                        echo $badge_pengiriman;
                                    } elseif($status_pemesanan == 5){
                                        echo $badge_pengambilan;
                                    } elseif($status_pemesanan == 6){
                                        echo $badge_selesai;
                                    } elseif($status_pemesanan == 7){
                                        echo $badge_batal;
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-12">
                        <div class="row"> 
                            <div class="col-md-6 col-sm-12 col-12"> 
                                </br>
                                <h4>Data Pemesanan</h4>
                                </br>
                                <div class="form-group">
                                    <table style="width: 100%;">
                                        <caption></caption>
                                        <tr>
                                            <th id="" style="width: 35%;"><span class="text-md">Invoice</span></th>
                                            <td style="width: 5%;"><span> : </b></td>
                                            <td style="width: 60%;"><span class="text-md"><?php echo $data_detail['kode_pemesanan']; ?></span></td>
                                        </tr>
                                        <tr>
                                            <th id="" style="width: 35%;"><span class="text-md">Tanggal</span></th>
                                            <td style="width: 5%;"><span> : </b></td>
                                            <td style="width: 60%;"><span class="text-md"><?php echo $data_detail['tanggal_pemesanan']; ?></span></td>
                                        </tr>
                                        <tr>
                                            <th id="" style="width: 35%;"><span class="text-md">Metode Pembelian</span></th>
                                            <td style="width: 5%;"><span> : </b></td>
                                            <td style="width: 60%;"><span class="text-md"><?php echo $data_detail['metode_pengiriman_pemesanan']; ?></span></td>
                                        </tr>
                                        <?php if($status_pemesanan == 6){ ?> 
                                            <tr>
                                                <th id="" style="width: 35%;"><span class="text-md">Keterangan Pembatalan</span></th>
                                                <td style="width: 5%;"><span> : </b></td>
                                                <td style="width: 60%;"><span class="text-md"><?php echo $data_detail['keterangan_pemesanan']; ?></span></td>
                                            </tr>
                                        <?php } ?>
                                    </table>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12 col-12"> 
                                </br>
                                <h4>Data Pembeli</h4>
                                </br>
                                <div class="form-group">
                                    <table style="width: 100%;">
                                    <caption></caption>
                                        <tr>
                                            <th id="" style="width: 35%;"><span class="text-md">Nama</span></th>
                                            <td style="width: 5%;"><span class="text-md"> : </span></td>
                                            <td style="width: 60%;"><span class="text-md"><?php echo $data_detail['tanggal_pemesanan']; ?></span></td>
                                        </tr>
                                        <tr>
                                            <th id="" style="width: 35%;"><span class="text-md">Alamat</span></th>
                                            <td style="width: 5%;"><span class="text-md"> : </span></td>
                                            <td style="width: 60%;"><span class="text-md"><?php $alamat_konsumen = explode("-",$data_detail['alamat_konsumen']); echo $alamat_konsumen[0]." RT ".$alamat_konsumen[1]." RW ".$alamat_konsumen[2].", Desa/Kel. ".$data_detail['nama_desa']. " Kec. ".$data_detail['nama_kecamatan']." ".$data_detail['nama_kabupaten']." Provinsi ".$data_detail['nama_provinsi'] ;?></span></td>
                                        </tr>
                                        <tr>
                                            <th id="" style="width: 35%;"><span class="text-md">Kontak</span></th>
                                            <td style="width: 5%;"><span class="text-md"> : </span></td>
                                            <td style="width: 60%;"><span class="text-md"><?php echo $data_detail['kontak_konsumen']; ?></span></td>
                                        </tr>
                                        <tr>
                                            <th id="" style="width: 35%;"><span class="text-md">Email</span></th>
                                            <td style="width: 5%;"><span class="text-md"> : </span></td>
                                            <td style="width: 60%;"><span class="text-md"><?php echo $data_detail['email_konsumen']; ?></span></td>
                                        </tr>
                                    </table>  
                                    </br>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12 col-12">
                            <div class="row"> 
                                <div class="col-md-6 col-sm-12 col-12"> 
                                    </br>
                                    <h4>Data Pembayaran</h4>
                                    </br>
                                    <div class="form-group">
                                        <table style="width: 100%;">
                                            <caption></caption>
                                            <tr>
                                                <th id="" style="width: 35%;"><span class="text-md">Transfer</span></th>
                                                <td style="width: 5%;"><span> : </b></td>
                                                <td style="width: 60%;"><span class="text-md"><?php echo $data_detail['rekening_pemesanan']; ?></span></td>
                                            </tr>
                                            <tr>
                                                <th id="" style="width: 35%;"><span class="text-md">Total Pembayaran</span></th>
                                                <td style="width: 5%;"><span> : </b></td>
                                                <td style="width: 60%;"><span class="text-md"><?php echo "Rp. ".number_format($data_detail['total_belanja_pemesanan'], 0, ".", ".") ?></span></td>
                                            </tr>
                                            <tr>
                                                <th id="" style="width: 35%;"><span class="text-md">Status Pembayaran</span></th>
                                                <td style="width: 5%;"><span> : </b></td>
                                                <td style="width: 60%;">
                                                    <span class="text-md"><?php echo  $badge_status_pby_pemesanan; ?></span>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12 col-12">
                                    </br>
                                    <?php if($metode_pengiriman_pemesanan == "Ambil Sendiri"){  echo "<h4>Data Pengambilan</h4>"; } else { echo "<h4>Data Pengiriman</h4>"; } ?>
                                    </br>
                                    <div class="form-group">
                                        <table style="width: 100%;">
                                        <caption></caption>
                                            <tr>
                                                <th id="" style="width: 35%;"><span class="text-md">Kurir</span></th>
                                                <td style="width: 5%;">:</td>
                                                <td style="width: 60%;"><span class="text-md"><?php $kurir = explode("|",$data_detail['kurir_pemesanan']); echo $kurir[0]." - ".$kurir[1]." (".$kurir[2]." Hari)"; ?></span></td>
                                            </tr>
                                            <tr>
                                                <th id="" style="width: 35%;"><span class="text-md">Ongkos Kirim</span></th>
                                                <td style="width: 5%;">:</td>
                                                <td style="width: 60%;"><span class="text-md"><?php echo  "Rp. ".number_format($kurir[3], 0, ".", "."); ?></span></td>
                                            </tr>
                                            <?php 
                                                if($metode_pengiriman_pemesanan == "Ekspedisi"){    
                                                    $url = "antar_ekspedisi"; 
                                            ?>
                                                <tr>
                                                    <th id="" style="width: 25%; vertical-align: top;"><span class="text-md">No. Resi</span></th>
                                                    <td style="width: 5%; vertical-align: top;"><span> : </b></td>
                                                    <td style="width: 60%; vertical-align: top;"><span class="text-md"><?php if($data_detail['noresi_pemesanan'] != ""){ echo $data_detail['noresi_pemesanan']; ?></span> <a href="<?php echo "https://parcelsapp.com/id/tracking/".$data_detail['noresi_pemesanan']; ?>" class="btn btn-sm btn-outline-primary" target="_blank"><span class="bx bx-fw bx-search"></span>Lacak</a> <?php }else{ echo "-";} ?></td>
                                                </tr>
                                            <?php  
                                                } elseif($metode_pengiriman_pemesanan == "Antar Cepat"){    
                                                    $url = "antar_cepat"; 
                                            ?>
                                                <tr>
                                                    <th id="" style="width: 25%; vertical-align: top;"><span class="text-md">Pramuniaga</span></th>
                                                    <td style="width: 5%; vertical-align: top;"><span> : </b></td>
                                                    <td style="width: 60%; vertical-align: top;"><span class="text-md"><?php echo $data_detail['nama_karyawan']; ?></td>
                                                </tr>
                                            <?php  
                                                } elseif($metode_pengiriman_pemesanan == "Ambil Sendiri"){    
                                                    $url = "ambil_sendiri"; 
                                            ?>
                                                <tr>
                                                    <th id="" style="width: 25%; vertical-align: top;"><span class="text-md">Prosedur Ambil</span></th>
                                                    <td style="width: 5%; vertical-align: top;"><span> : </b></td>
                                                    <td style="width: 60%; vertical-align: top;">Konsumen dapat malakukan pengambilan produk setelah, proses produksi produk telah selesai.</td>
                                                </tr>
                                            <?php } ?>
                                        </table>  
                                    </div>
                                </div>
                        </div>
                    </div>





                    </br>
                    <hr>
                    </br>
                    <div class="col-md-12 col-sm-12 col-12">
                        </br>
                        <h4>Daftar Produk</h4>
                        </br>
                        <table style="width:100%" id="datatable_satuan" class="table table-bordered table-striped">
                            <caption></caption>
                            <thead>
                                <tr>
                                    <th id="" style="text-align: center; vertical-align: middle; ">No.</th>
                                    <th id="" style="text-align: center; vertical-align: middle; ">Gambar</th>
                                    <th id="" style="text-align: center; vertical-align: middle; ">Kode Produk</th>
                                    <th id="" style="text-align: center; vertical-align: middle; ">Nama Produk</th>
                                    <th id="" style="text-align: center; vertical-align: middle; ">Harga Produk (Rp.)</th>
                                    <th id="" style="text-align: center; vertical-align: middle; ">Potongan Harga (%)</th>
                                    <th id="" style="text-align: center; vertical-align: middle; ">Qty</th>
                                    <th id="" style="text-align: center; vertical-align: middle; ">Subtotal (Rp.)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $no = 1;
                                    $total_belanja_pemesanan = 0;
                                    foreach($list_produk as $item){
                                        if($item->status_ipemesanan > 1){
                                ?>      
                                <tr>
                                    <td style="text-align: center; vertical-align: middle;"><?php echo $no; ?></td>
                                    <td style="text-align: center; vertical-align: middle;">
                                        <?php if($item->gambar_produk != "") { ?>
                                            <div class="d-flex justify-content-center">
                                                <div class="elevation-1" style="width: 80px; height: 80px; border:1px solid #ced4da;">
                                                    <img src="<?php echo base_url('assets/img/produk/'.$item->gambar_produk);?>" alt="Image" class=elevation-1" style="width:80px; height:80px; object-fit:cover; background:white;">
                                                </div>
                                            </div>
                                        <?php }else{ ?>
                                            <div class="d-flex justify-content-center">
                                                <div class="elevation-1" style="width: 80px; height: 80px; border:1px solid #ced4da;">
                                                    <img src="<?php echo base_url('assets/img/banner/package_regular.png');?>" alt="Image" alt="Image" style="width:60px; height:60px; margin-top: 9px; object-fit:cover;">
                                                </div>
                                            </div>
                                        <?php } ?>
                                    </td>
                                    <td style="text-align: left; vertical-align: middle;"><?php echo $item->xxx; ?></td>
                                    <td style="text-align: left; vertical-align: middle;"><?php echo $item->nama_produk; ?></td>
                                    <td style="text-align: right; vertical-align: middle;"><?php echo number_format($item->harga_ipemesanan, 0, ".", "."); ?></td>
                                    <td style="text-align: center; vertical-align: middle;"><?php echo $item->diskon_ipemesanan; ?></td>
                                    <td style="text-align: center; vertical-align: middle;"><?php echo number_format($item->qty_ipemesanan, 0, ".", "."); ?></td>
                                    <td style="text-align: right; vertical-align: middle;">
                                        <?php 
                                            if($item->diskon_ipemesanan != 0){
                                                $harga_promo = $item->harga_ipemesanan - (($item->diskon_ipemesanan * $item->harga_ipemesanan) / 100);
                                                echo number_format($harga_promo * $item->qty_ipemesanan, 0, ".", ".");
                                            } else {  
                                                echo number_format($item->harga_ipemesanan * $item->qty_ipemesanan, 0, ".", ".");
                                            } 
                                        ?>
                                    </td>
                                </tr>
                                <?php } } ?>
                            </tbody>
                        </table>
                    </div>

                    

                    <?php if($data_detail['status_pemesanan'] == 5 && $data_detail['ulasan_pemesanan'] != ""){ ?> 
                    </br>
                    <hr>
                    </br>
                    <div class="col-md-12 col-sm-12 col-12">
                        <h4>Ulasan Pemesanan</h4>
                        </br> 
                        <div class="d-flex justify-content-center">
                            <div class="col-md-6 col-12">
                            <?php
                                $rating = $data_detail['rating_pemesanan'];
                                if($rating == 1){
                                    echo "<span class='fa fa-star checked'></span>
                                    <span class='fa fa-star'></span>
                                    <span class='fa fa-star'></span>
                                    <span class='fa fa-star'></span>
                                    <span class='fa fa-star'></span>";
                                } elseif($rating == 2){
                                    echo "<span class='fa fa-star checked'></span>
                                    <span class='fa fa-star checked'></span>
                                    <span class='fa fa-star'></span>
                                    <span class='fa fa-star'></span>
                                    <span class='fa fa-star'></span>";
                                } elseif($rating == 3){
                                    echo "<span class='fa fa-star checked'></span>
                                    <span class='fa fa-star checked'></span>
                                    <span class='fa fa-star checked'></span>
                                    <span class='fa fa-star'></span>
                                    <span class='fa fa-star'></span>";
                                } elseif($rating == 4){
                                    echo "<span class='fa fa-star checked'></span>
                                    <span class='fa fa-star checked'></span>
                                    <span class='fa fa-star checked'></span>
                                    <span class='fa fa-star checked'></span>
                                    <span class='fa fa-star'></span>";
                                } elseif($rating == 5){
                                    echo "<span class='fa fa-star checked'></span>
                                    <span class='fa fa-star checked'></span>
                                    <span class='fa fa-star checked'></span>
                                    <span class='fa fa-star checked'></span>
                                    <span class='fa fa-star checked'></span>";
                                }
                            ?>
                                <br>
                                <span><?php echo $data_detail['tanggal_ulasan_pemesanan']; ?></span>
                                <textarea class="form-control" readonly style="height: 200px;"><?php echo $data_detail['ulasan_pemesanan']; ?></textarea>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </section>
</div>

<form role="form" id="form_komplain_ipemesanan" method="post">
    <div id="modal_komplain_ipemesanan" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <strong><span class="modal-title text-lg" id="myModalLabel"></span></strong>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Produk</label>
                        <input type="text" class="form-control" name="nama_produk" id="nama_produk" readonly/>
                        <input type="hidden" class="form-control" name="kode_ipemesanan" id="kode_ipemesanan" readonly/>
                    </div>         
                    <div class="form-group" id="status">
                        <label>Status</label>
                        <select class="form-control" name="status_penerimaan_ipemesanan" id="status_penerimaan_ipemesanan">
                            <option value="Komplain">Proses</option>
                            <option value="Proses">Selesai</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" style="width:80px">Batal</button>
                    <button type="submit" id="btn_simpan_ipemesanan_retur" class="btn btn-primary" style="width:80px">Simpan</button>
                </div>
            </div>
        </div>
    </div>
</form>

<form role="form" id="form_upload_pembayaran" method="post">
    <div id="modal_pembayaran" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <strong><span class="modal-title text-lg" id="myModalLabel"></span></strong>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div style="text-align: center;">
                        <?php 
                            $arr_str = explode(".",$bukti_pby_pemesanan);
                            
                            $string_buntut = end($arr_str);
                            if($string_buntut == "pdf"){
                        ?>
                            <object data="<?php echo base_url('assets/img/pemesanan/'.$bukti_pby_pemesanan);?>" type="application/pdf" width="100%" height="600px" style=" display:inline-block;"></object>
                        <?php
                            }else{
                            ?>
                            <div style="border-radius:5px; border:1px solid #ced4da; width:100%; padding:5%;">
                                <img alt="bukti pembayaran" src="<?php echo base_url('assets/img/pemesanan/'.$bukti_pby_pemesanan); ?>" style="max-width:400px">
                            </div>
                        <?php } ?>
                    </div>
                    </br>
                </div>
                <div class="modal-footer">
                <?php if($status_pemesanan == 2){ ?>
                    <button type="button" class="btn btn-outline-success" id="btn_validasi_pembayaran" style="margin-left: 10px;"><span class="fa fa-check"></span> Validasi Pembayaran</button>
                    <button type="button" class="btn btn-outline-danger" id="btn_batalkan_transaksi" style="margin-left: 10px;"><span class="fa fa-times"></span> Tolak Pembayaran</button>
                <?php } else { ?>
                    <span class='badge bg-success text-lg'><?php echo $badge_status_pby_pemesanan; ?></span>
                <?php } ?>
                    </div>
            </div>
        </div>
    </div>
</form>

<?php $this->load->view('backend/partials/footer.php') ?>
<?php $this->load->view('backend/partials/script.php') ?>

<!-----------------------FUNGSI----------------------->
<script>
    var url = '<?php echo base_url('admin/transaksi/').$url; ?>' ;
    $('ul.nav-sidebar a').filter(function() {
        return this.href == url;
    }).addClass('active ');
    $('ul.nav-treeview a').filter(function() {
        return this.href == url;
    }).parentsUntil(".nav-sidebar > .nav-treeview").addClass('menu-open').prev('a').addClass('active');
    
    $(document).on('click', '.btn_bukti_pembayaran', function() {
        $('#modal_pembayaran').modal('show');
        $('.modal-title').text('Lihat Pembayaran');
    }); 

</script> 

<!-----------------------PROSES TRANSAKSI----------------------->
<script>
    var url_global = '<?php echo base_url('admin/transaksi/proses_transaksi'); ?>';
    
    $('#btn_validasi_pembayaran').on("click",function(){
        var kode_pemesanan = $('#kode_pemesanan').val();
        var metode_pengiriman_pemesanan = $('#metode_pengiriman_pemesanan').val();
        var status_pby_pemesanan = "Lunas";
        var status_pemesanan = "3";

        Swal.fire({
            title: 'Validasi Pembayaran',
            type: 'warning',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ffc107',
            cancelButtonColor: '#dc3545',
            confirmButtonText: 'Simpan',
            cancelButtonText: "Tidak",
            showLoaderOnConfirm: true,

            preConfirm: (response) => {       
                $.ajax({
                    url: url_global,
                    method: 'POST',
                    data: {
                        kode_pemesanan:kode_pemesanan,
                        status_pby_pemesanan:status_pby_pemesanan,
                        status_pemesanan:status_pemesanan
                    },   
                    success: function(response){ 
                        if(response==1){
                            Swal.fire({
                                icon: 'success',
                                title: 'Data telah diupdate!',
                                showConfirmButton: true,
                                confirmButtonColor: '#ffc107',
                                timer: 3000
                            }).then(function(){
                                window.location.reload();
                            })
                        }     
                    }
                })
            },
        });
    });

    $('#btn_verifikasi_ekspedisi').on("click",function(){
        var kode_pemesanan = $('#kode_pemesanan').val();
        var metode_pengiriman_pemesanan = $('#metode_pengiriman_pemesanan').val();
        var status_pby_pemesanan = $('#status_pby_pemesanan').val();
        var status_pemesanan = "4";

        Swal.fire({
            title: 'Verifikasi Pengiriman Ekspedisi',
            type: 'warning',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ffc107',
            cancelButtonColor: '#dc3545',
            confirmButtonText: 'Simpan',
            cancelButtonText: "Tidak",
            showLoaderOnConfirm: true,
            html: '<input class="swal2-input" name="noresi_pemesanan" id="noresi_pemesanan" placeholder="No. Resi">',
            preConfirm: (response) => {                 
                const noresi_pemesanan = Swal.getPopup().querySelector('#noresi_pemesanan').value
                if(response==1){
                    if (!noresi_pemesanan) {
                        Swal.showValidationMessage('Harus diisi')
                    }else{      
                        $.ajax({
                            url: url_global,
                            method: 'POST',
                            data: {
                                kode_pemesanan:kode_pemesanan,
                                noresi_pemesanan:noresi_pemesanan,
                                metode_pengiriman_pemesanan:metode_pengiriman_pemesanan,
                                status_pby_pemesanan:status_pby_pemesanan,
                                status_pemesanan:status_pemesanan
                            },   
                            success: function(response){ 
                                if(response==1){
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Data telah diupdate!',
                                        showConfirmButton: true,
                                        confirmButtonColor: '#ffc107',
                                        timer: 3000
                                    }).then(function(){
                                        window.location.reload();
                                    })
                                }else {
                                    Swal.fire({
                                        icon: 'warning',
                                        title: response,
                                        showConfirmButton: true,
                                        confirmButtonColor: '#ffc107',
                                        timer: 3000
                                    })
                                }
                            }
                        })
                    }
                }
            }
        });
    });

    $('#btn_antar_cepat').on("click",function(){
        var kode_pemesanan = $('#kode_pemesanan').val();
        var metode_pengiriman_pemesanan = $('#metode_pengiriman_pemesanan').val();
        var status_pby_pemesanan = $('#status_pby_pemesanan').val();
        var status_pemesanan = "4";

        Swal.fire({
            title: 'Verifikasi Antar Cepat',
            type: 'warning',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ffc107',
            cancelButtonColor: '#dc3545',
            confirmButtonText: 'Simpan',
            cancelButtonText: "Tidak",
            showLoaderOnConfirm: true,
            html: '<select class="swal2-input" name="id_karyawan" id="id_karyawan">'+
                        ` <option value="">Pilih Petugas</option>`+
                        `<?php 
                            foreach($data_karyawan as $row){
                                if($row->level_karyawan == "Petugas" && $row->status_karyawan == "Ada"){
                                    echo "<option value='".$row->id_karyawan."'>".$row->nama_karyawan."</option>";
                                }
                            }
                        ?>`+
                    ` </select>`,
            preConfirm: (response) => {                 
                const id_karyawan = Swal.getPopup().querySelector('#id_karyawan').value
                if(response==1){
                    if (!id_karyawan) {
                        Swal.showValidationMessage('Petugas tidak boleh kosong')
                    }else{      
                        $.ajax({
                            url: url_global,
                            method: 'POST',
                            data: {
                                id_karyawan:id_karyawan,
                                kode_pemesanan:kode_pemesanan,
                                metode_pengiriman_pemesanan:metode_pengiriman_pemesanan,
                                status_pby_pemesanan:status_pby_pemesanan,
                                status_pemesanan:status_pemesanan
                            },   
                            success: function(response){ 
                                if(response==1){
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Data telah diupdate!',
                                        showConfirmButton: true,
                                        confirmButtonColor: '#ffc107',
                                        timer: 3000
                                    }).then(function(){
                                        window.location.reload();
                                    })
                                }else {
                                    Swal.fire({
                                        icon: 'warning',
                                        title: response,
                                        showConfirmButton: true,
                                        confirmButtonColor: '#ffc107',
                                        timer: 3000
                                    })
                                }
                            }
                        })
                    }
                }
            }
        });
    });
    
    $('#btn_ambil_sendiri').on("click",function(){
        var kode_pemesanan = $('#kode_pemesanan').val();
        var metode_pengiriman_pemesanan = $('#metode_pengiriman_pemesanan').val();
        var status_pby_pemesanan = $('#status_pby_pemesanan').val();
        var status_pemesanan = "5";

        Swal.fire({
            title: 'Validasi Ambil Sendiri',
            type: 'warning',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ffc107',
            cancelButtonColor: '#dc3545',
            confirmButtonText: 'Simpan',
            cancelButtonText: "Tidak",
            showLoaderOnConfirm: true,

            preConfirm: (response) => {       
                $.ajax({
                    url: url_global,
                    method: 'POST',
                    data: {
                        kode_pemesanan:kode_pemesanan,
                        status_pby_pemesanan:status_pby_pemesanan,
                        status_pemesanan:status_pemesanan
                    },   
                    success: function(response){ 
                        if(response==1){
                            Swal.fire({
                                icon: 'success',
                                title: 'Data telah diupdate!',
                                showConfirmButton: true,
                                confirmButtonColor: '#ffc107',
                                timer: 3000
                            }).then(function(){
                                window.location.reload();
                            })
                        }     
                    }
                })
            },
        });
    });

    $('#btn_batalkan_transaksi').on("click",function(){
        var kode_pemesanan = $('#kode_pemesanan').val();
        var metode_pengiriman_pemesanan = $('#metode_pengiriman_pemesanan').val();
        var status_pby_pemesanan = "Dana Dikembalikan";
        var status_pemesanan = "7";

        Swal.fire({
            title: 'Pembatalan Transaksi',
            type: 'warning',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ffc107',
            cancelButtonColor: '#dc3545',
            confirmButtonText: 'Simpan',
            cancelButtonText: "Tidak",
            showLoaderOnConfirm: true,
            html: `<textarea type="text" id="keterangan_pemesanan" class="swal2-input" placeholder="Keterangan" style="height:100px"></textarea>`,

            preConfirm: (response) => {                 
                const keterangan_pemesanan = Swal.getPopup().querySelector('#keterangan_pemesanan').value
                if(response==1){
                    if (!keterangan_pemesanan) {
                        Swal.showValidationMessage('Keterangan tidak boleh kosong')
                    }else{
                        $.ajax({
                            url: url_global,
                            method: 'POST',
                            data: {
                                kode_pemesanan:kode_pemesanan,
                                metode_pengiriman_pemesanan:metode_pengiriman_pemesanan,
                                status_pby_pemesanan:status_pby_pemesanan,
                                status_pemesanan:status_pemesanan,
                                keterangan_pemesanan:keterangan_pemesanan
                            },   
                            success: function(response){ 
                                if(response==1){
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Data telah diupdate!',
                                        showConfirmButton: true,
                                        confirmButtonColor: '#ffc107',
                                        timer: 3000
                                    }).then(function(){
                                        window.location.reload();
                                    })
                                }else {
                                    Swal.fire({
                                        icon: 'warning',
                                        title: response,
                                        showConfirmButton: true,
                                        confirmButtonColor: '#ffc107',
                                        timer: 3000
                                    })
                                }   
                            }
                        })
                    }
                }
            }
        })
    });
</script>

</body>
</html>