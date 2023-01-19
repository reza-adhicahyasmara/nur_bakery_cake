<?php 
    $notifikasi = 0;
    $data_karyawan = $this->Mod_karyawan->get_karyawan($this->session->userdata('ses_id_karyawan'))->row_array();
    if($data_karyawan['level_karyawan'] == "Admin") { 

        $chat = 0;
        foreach($this->Mod_master->get_all_kontak()->result() as $data){
            if($data->status_chat == "1"){
                $chat = $chat + 1;
            }
        }

        $konsumen_baru = 0;
        foreach($this->Mod_konsumen->get_all_konsumen()->result() as $row) {
            if($row->status_konsumen == "Baru"){
                $konsumen_baru += 1;
            }
        }

        $menunggu_pembayaran_tf = 0;
        $verifikasi_pembayaran_tf = 0;
        $proses_packing_tf = 0;
        $proses_pengiriman_tf = 0;

        $menunggu_verifikasi_cod = 0;
        $proses_packing_cod = 0;
        $proses_pengiriman_cod = 0;

        $transfer = "Transfer";
        $cod = "Cash on Delivery";

        foreach($this->Mod_pemesanan->get_all_pemesanan()->result() as $data){
            if($data->metode_pby_pemesanan == $transfer){
                if($data->status_pemesanan == '1'){
                    $menunggu_pembayaran_tf = $menunggu_pembayaran_tf + 1;
                }
                if($data->status_pemesanan == '2'){
                    $verifikasi_pembayaran_tf = $verifikasi_pembayaran_tf + 1;
                }
                if($data->status_pemesanan == '3'){
                    $proses_packing_tf = $proses_packing_tf + 1;
                }
                if($data->status_pemesanan == '4'){
                    $proses_pengiriman_tf = $proses_pengiriman_tf + 1;
                }
            }else if($data->metode_pby_pemesanan == $cod){
                if($data->status_pemesanan == '1'){
                    $menunggu_verifikasi_cod = $menunggu_verifikasi_cod + 1;
                }
                if($data->status_pemesanan == '3'){
                    $proses_packing_cod = $proses_packing_cod + 1;
                }
                if($data->status_pemesanan == '4'){
                    $proses_pengiriman_cod = $proses_pengiriman_cod + 1;
                }
            }
        }
        $total_pemesanan_tf = $menunggu_pembayaran_tf + $verifikasi_pembayaran_tf + $proses_packing_tf + $proses_pengiriman_tf;
        $total_pemesanan_cod = $menunggu_verifikasi_cod + $proses_packing_cod + $proses_pengiriman_cod;
        
        $stok_limit_adm = 0; 
        // foreach($this->Mod_master->get_all_produk()->result() as $row) {
        //     if($row->stok_gudang_produk <= $row->stok_limit_produk){
        //         $stok_limit_adm += 1;
        //     }
        // }

        $notifikasi = $total_pemesanan_tf + $total_pemesanan_cod + $stok_limit_adm;

    }
    $url_foto_karyawan = base_url('assets/img/karyawan/'.$data_karyawan['foto_karyawan']);
    $url_gambar_profil = base_url('assets/img/banner/user.svg');
?>  


<!DOCTYPE html>
<html lang="en">
<!--   
                                                                           
                                                                            
            ////////////   //   ////        //   ////////////        //          888   888              /////////           //        //             /////////     //          //
           //             //   // //       //        //            ////        888888 8    8           //       //        ////       //           //              //          //
          //             //   //  //      //        //           //  //       8888888*      8         //        //      //  //      //          //               //          //     
         //             //   //   //     //        //          //    //       88888888*     8        //       //      //    //     //           //              //          //
        //             //   //    //    //        //         //      //        88888*      8        /////////       //      //    //             ///////       //          // 
       //             //   //     //   //        //        ////////////         8888*     8        //             ////////////   //                    //     //          //
      //             //   //      //  //        //        //        //            888*  8         //             //        //   //                      //   //          //
     //             //   //       // //        //        //        //              88*8          //             //        //   //                     //    //          //
    ////////////   //   //        ////        //        //        //                 *          //             //        //   ////////////   /////////     //////////////

by projekindong
-->
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <link rel="shortcut icon" href="<?php echo base_url('assets/img/banner/bx-cake.svg'); ?>" color="#000000"></link>
    <title><?php if($notifikasi != 0){echo "(".$notifikasi.") ";} echo $pageTitle; ?></title>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/boxicons/css/boxicons.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/chart.js/Chart.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/datetimepicker/jquery.datetimepicker.css"/>
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/dropzone/dropzone.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/floating-labels/floating-labels.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/fullcalendar/fullcalendar.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/jqvmap/jqvmap.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/lightbox/src/css/lightbox.css"> 
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/sweetalert2/sweetalert2.min.css">
    
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/backend/css/adminlte.min.css">



    <!-- Rating Star -->
    <style>
        .star-rating {
            font-size: 0;
            white-space: nowrap;
            display: inline-block;
            /* width: 250px; remove this */
            height: 50px;
            overflow: hidden;
            position: relative;
            background: url('data:image/svg+xml;base64,PHN2ZyB2ZXJzaW9uPSIxLjEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHg9IjBweCIgeT0iMHB4IiB3aWR0aD0iMjBweCIgaGVpZ2h0PSIyMHB4IiB2aWV3Qm94PSIwIDAgMjAgMjAiIGVuYWJsZS1iYWNrZ3JvdW5kPSJuZXcgMCAwIDIwIDIwIiB4bWw6c3BhY2U9InByZXNlcnZlIj48cG9seWdvbiBmaWxsPSIjREREREREIiBwb2ludHM9IjEwLDAgMTMuMDksNi41ODMgMjAsNy42MzkgMTUsMTIuNzY0IDE2LjE4LDIwIDEwLDE2LjU4MyAzLjgyLDIwIDUsMTIuNzY0IDAsNy42MzkgNi45MSw2LjU4MyAiLz48L3N2Zz4=');
            background-size: contain;
        }
        .star-rating i {
            opacity: 0;
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            /* width: 20%; remove this */
            z-index: 1;
            background: url('data:image/svg+xml;base64,PHN2ZyB2ZXJzaW9uPSIxLjEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHg9IjBweCIgeT0iMHB4IiB3aWR0aD0iMjBweCIgaGVpZ2h0PSIyMHB4IiB2aWV3Qm94PSIwIDAgMjAgMjAiIGVuYWJsZS1iYWNrZ3JvdW5kPSJuZXcgMCAwIDIwIDIwIiB4bWw6c3BhY2U9InByZXNlcnZlIj48cG9seWdvbiBmaWxsPSIjRkZERjg4IiBwb2ludHM9IjEwLDAgMTMuMDksNi41ODMgMjAsNy42MzkgMTUsMTIuNzY0IDE2LjE4LDIwIDEwLDE2LjU4MyAzLjgyLDIwIDUsMTIuNzY0IDAsNy42MzkgNi45MSw2LjU4MyAiLz48L3N2Zz4=');
            background-size: contain;
        }
        .star-rating input {
            -moz-appearance: none;
            -webkit-appearance: none;
            opacity: 0;
            display: inline-block;
            /* width: 20%; remove this */
            height: 100%;
            margin: 0;
            padding: 0;
            z-index: 2;
            position: relative;
        }
        .star-rating input:hover + i,
        .star-rating input:checked + i {
            opacity: 1;
        }
        .star-rating i ~ i {
            width: 40%;
        }
        .star-rating i ~ i ~ i {
            width: 60%;
        }
        .star-rating i ~ i ~ i ~ i {
            width: 80%;
        }
        .star-rating i ~ i ~ i ~ i ~ i {
            width: 100%;
        }
        /* *::after,
        *::before {
            height: 100%;
            padding: 0;
            margin: 0;
            box-sizing: border-box;
            text-align: center;
            vertical-align: middle;
        } */

        .star-rating.star-5 {width: 250px;}
        .star-rating.star-5 input,
        .star-rating.star-5 i {width: 20%;}
        .star-rating.star-5 i ~ i {width: 40%;}
        .star-rating.star-5 i ~ i ~ i {width: 60%;}
        .star-rating.star-5 i ~ i ~ i ~ i {width: 80%;}
        .star-rating.star-5 i ~ i ~ i ~ i ~i {width: 100%;}

        .checked {
            color: orange;
        }

        
        /* Chrome, Safari, Edge, Opera */
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
        }

        /* Firefox */
        input[type=number] {
        -moz-appearance: textfield;
        }
    </style>
  
    <style>
        input#warna_produk {
            transform: scale(2);
        }
    </style>

    
    <style>
        /* COLOR CUSTOM */
        .page-item.active .page-link {
            z-index: 3;
            color: #fff;
            background-color: #ffc107;
            border-color: #ffc107;
        }
        .page-link {
            position: relative;
            display: block;
            padding: .5rem .75rem;
            margin-left: -1px;
            line-height: 1.25;
            color: #ffc107;
            background-color: #fff;
            border: 1px solid #dee2e6;
        }
        a {
            color: #ffc107;
            text-decoration: none;
            background-color: transparent;
        }
    </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed text-sm">
    <div class="preloader flex-column justify-content-center align-items-center bg-warning">
        <img class="animation__shake" src="<?php echo base_url('assets/img/banner/bx-cake.svg'); ?>" alt="AdminLTELogo" height="80" width="80">
    </div>
    <div class="wrapper">
        <nav class="main-header navbar navbar-expand navbar-warning navbar-light text-sm" aria-label="">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><span class="bx bx-fw bx-sm bx-menu"></span></a>
                </li>
            </ul>
        </nav>
        
        <aside class="main-sidebar sidebar-light-warning elevation-4 text-sm">
            <a href="" class="brand-link">
                <img src="<?php echo base_url('assets/img/banner/bx-cake.svg'); ?>" class="brand-image" style="opacity: .8" alt="Image" style="width: 50px;">
                <span class="brand-text font-weight"><strong class="text-md">Nur bakery & Cake</strong></span>
            </a>
            <div class="sidebar">
                <nav class="mt-2" aria-label="">
                    <ul class="nav nav-pills nav-sidebar nav-compact flex-column nav-child-indent" data-widget="treeview" role="menu">
                        <?php if($data_karyawan['level_karyawan'] =='Admin'){?>
                            <li class="nav-item has-treeview"> 
                                <a href="#" class="nav-link">
                                    <?php if($data_karyawan['foto_karyawan'] != "") { ?>
                                        <img src="<?php echo $url_foto_karyawan; ?>" class="img-circle elevation-1" style="margin-left: -4px; width:37px; height:37px; object-fit: cover;" alt="Image">
                                    <?php }else{ ?>
                                        <img src="<?php echo $url_gambar_profil; ?>" class="img-circle elevation-1" style="margin-left: -4px; width:37px; height:37px; object-fit: cover; background-color:white; border:1px solid #ced4da;" alt="Image">
                                    <?php } ?> 
                                    <p class="text-md" style="margin-left:10px; vertical-align: middle;"><?php echo $data_karyawan['nama_karyawan']; ?></p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item"><a href="<?php echo base_url('profil_karyawan'); ?>" class="nav-link"><i class="nav-icon bx bx-fw bxs-user"></i><p>Profil</p></a></li>
                                    <li class="nav-item"><a href="<?php echo base_url('profil_karyawan/ubah_password'); ?>" class="nav-link"><i class="nav-icon bx bx-fw bxs-lock"></i><p>Ubah Password</p></a></li>
                                </ul>
                            </li>
                            <li class="nav-item"><hr style="margin-top: 0.4rem"></li>
                            <li class="nav-item"><a href="<?php echo base_url('admin/dashboard'); ?>" class="nav-link"><i class="nav-icon bx bx-fw bxs-grid-alt"></i><p>Dashboard</p></a></li>
                            <li class="nav-item"><a href="<?php echo base_url('admin/konsumen'); ?>" class="nav-link"><i class="nav-icon bx bx-fw bxs-group"></i><p>Konsumen </p></a></li>
                            <li class="nav-item"><a href="<?php echo base_url('admin/chat'); ?>" class="nav-link"><i class="nav-icon bx bx-fw bxs-chat"></i><p>Chat <?php if($chat != 0){ ?><span class="badge badge-danger right"> <?php echo $chat; ?></span><?php } ?></p></a></li>
                            <li class="nav-item"><a href="<?php echo base_url('admin/transaksi/ambil'); ?>" class="nav-link"><i class="nav-icon bx bx-fw bxs-book"></i><p>Transaksi Ambil<?php if($total_pemesanan_tf != 0){ ?><span class="badge badge-danger right"> <?php echo $total_pemesanan_tf; ?></span><?php } ?></p></a></li>
                            <li class="nav-item"><a href="<?php echo base_url('admin/transaksi/antar'); ?>" class="nav-link"><i class="nav-icon bx bx-fw bxs-book"></i><p>Transaksi Antar<?php if($total_pemesanan_cod != 0){ ?><span class="badge badge-danger right"> <?php echo $total_pemesanan_cod; ?></span><?php } ?></p></a></li>
                            <li class="nav-item has-treeview"><a href="#" class="nav-link"><i class="nav-icon bx bx-fw bxs-data"></i><p>Master Data  <?php if($stok_limit_adm != 0){ ?><span class="badge badge-danger right"> <?php echo $stok_limit_adm; ?></span><?php } ?><i class="bx bx-fw bx-chevron-left right"></i></p></a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item"><a href="<?php echo base_url('admin/produk'); ?>" class="nav-link"><i class="nav-icon bx bx-fw bxs-cake nav-icon"></i><p>Produk <?php if($stok_limit_adm != 0){ ?><span class="badge badge-danger right"> <?php echo $stok_limit_adm; ?></span><?php } ?></p></a></li>
                                    <li class="nav-item"><a href="<?php echo base_url('admin/kategori_produk'); ?>" class="nav-link"><i class="nav-icon bx bx-fw bxs-bookmark"></i><p>Kategori Produk</p></a></li>
                                    <li class="nav-item"><a href="<?php echo base_url('admin/diskon'); ?>" class="nav-link"><i class="nav-icon bx bx-fw bxs-offer"></i><p>Diskon</p></a></li>
                                    <li class="nav-item"><a href="<?php echo base_url('admin/pengaturan'); ?>" class="nav-link"><i class="nav-icon bx bx-fw bxs-cog"></i><p>Pengaturan</p></a></li>
                                </ul>
                            </li>
                            <li class="nav-item has-treeview"><a href="#" class="nav-link"><i class="nav-icon bx bx-fw bxs-file"></i><p>Laporan <i class="bx bx-fw bx-chevron-left right"></i></p></a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item"><a href="<?php echo base_url('admin/laporan/data_pemesanan_transfer'); ?>" class="nav-link"><i class="nav-icon bx bx-fw bxs-file"></i><p>Data Transaksi Transfer</p></a></li>
                                    <li class="nav-item"><a href="<?php echo base_url('admin/laporan/data_pemesanan_cod'); ?>" class="nav-link"><i class="nav-icon bx bx-fw bxs-file"></i><p>Data Transaksi COD</p></a></li>
                                </ul>
                            </li>



                        <?php }elseif($data_karyawan['level_karyawan'] =='Pimpinan'){?>
                            <li class="nav-item has-treeview"> 
                                <a href="#" class="nav-link">
                                    <?php if($data_karyawan['foto_karyawan'] != "") { ?>
                                        <img src="<?php echo $url_foto_karyawan; ?>" class="img-circle elevation-1" style="margin-left: -4px; width:37px; height:37px; object-fit: cover;" alt="Image">
                                    <?php }else{ ?>
                                        <img src="<?php echo $url_gambar_profil; ?>" class="img-circle elevation-1" style="margin-left: -4px; width:37px; height:37px; object-fit: cover; background-color:white; border:1px solid #ced4da;" alt="Image">
                                    <?php } ?> 
                                    <p class="text-md" style="margin-left:10px; vertical-align: middle;"><?php echo $data_karyawan['nama_karyawan']; ?></p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item"><a href="<?php echo base_url('profil_karyawan'); ?>" class="nav-link"><i class="nav-icon bx bx-fw bxs-user"></i><p>Profil</p></a></li>
                                    <li class="nav-item"><a href="<?php echo base_url('profil_karyawan/ubah_password'); ?>" class="nav-link"><i class="nav-icon bx bx-fw bxs-lock"></i><p>Ubah Password</p></a></li>
                                </ul>
                            </li>
                            <li class="nav-item"><hr style="margin-top: 0.4rem"></li>
                            <li class="nav-item"><a href="<?php echo base_url('pimpinan/dashboard'); ?>" class="nav-link"><i class="nav-icon bx bx-fw bxs-grid-alt"></i><p>Dashboard</p></a></li>
                            <li class="nav-item"><a href="<?php echo base_url('pimpinan/konsumen'); ?>" class="nav-link"><i class="nav-icon bx bx-fw bxs-group"></i><p>Konsumen</p></a></li>
                            <li class="nav-item"><a href="<?php echo base_url('pimpinan/produk'); ?>" class="nav-link"><i class="nav-icon bx bx-fw bxs-package"></i><p>Produk</p></a></li>
                            <li class="nav-item"><a href="<?php echo base_url('pimpinan/diskon'); ?>" class="nav-link"><i class="nav-icon bx bx-fw bxs-offer"></i><p>Diskon</p></a></li>
                            <li class="nav-item"><a href="<?php echo base_url('pimpinan/karyawan'); ?>" class="nav-link"><i class="nav-icon bx bx-fw bxs-user"></i><p>Karyawan</p></a></li>
                        <?php } ?> 
                    </ul>
                    <ul class="nav nav-pills nav-sidebar nav-compact flex-column nav-child-indent" style="position: absolute; bottom: 10px;">
                        <li class="nav-item"><a href="<?php echo base_url('login/logout'); ?>" class="nav-link bg-danger"><i class="nav-icon bx bx-fw bx-log-out"></i><p>Logout</p></a></li>
                    </ul>
                </nav>
            </div>
        </aside>