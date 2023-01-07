<?php 
    $this->load->model('Mod_karyawan');
    $this->load->model('Mod_master');
    $this->load->model('Mod_konsumen');
    $this->load->model('Mod_pemesanan');

    $notifikasi = 0;
    
    $data_konsumen = $this->Mod_konsumen->get_konsumen($this->session->userdata('ses_id_konsumen'))->row_array();
    $data_keranjang = $this->Mod_pemesanan->get_all_ipemesanan_konsumen($this->session->userdata('ses_id_konsumen'))->result();
    $data_pemesanan = $this->Mod_pemesanan->get_pemesanan($this->session->userdata('ses_id_konsumen'))->result();
    
    if($this->session->userdata('ses_id_konsumen') != null && $this->session->userdata('ses_akses') == 'Konsumen'){



        $menunggu_pembayaran = 0;
        $verfikasi_pemabayaran = 0;
        $proses_packing = 0;
        $sedang_dikirim = 0;
        $menunggu_pengambilan = 0;
        $komplain = 0;
        $total_ulasan_pemesanan = 0;
        
        foreach($data_pemesanan as $data){
            if($data->status_pemesanan == '1'){
                $menunggu_pembayaran = $menunggu_pembayaran + 1;
            }
            if($data->status_pemesanan == '2'){
                $verfikasi_pemabayaran = $verfikasi_pemabayaran + 1;
            }
            if($data->status_pemesanan == '3'){
                $proses_packing = $proses_packing + 1;
            }
            if($data->status_pemesanan == '4'){
                $sedang_dikirim = $sedang_dikirim + 1;
            }
            if($data->status_pemesanan == '5'){
                $menunggu_pengambilan = $menunggu_pengambilan + 1;
            }
            if($data->status_pemesanan == '6'){
                $komplain = $komplain + 1;
            }
            
        }

        $total_transaksi = $menunggu_pembayaran + $verfikasi_pemabayaran + $proses_packing + $sedang_dikirim + $menunggu_pengambilan + $komplain;
        


        $keranjang = 0;
        $menunggu_ulasan = 0;
        foreach($data_keranjang as $data){
            if($data->status_ipemesanan == '1'){
                $keranjang = $keranjang + 1;
            }
            if($data->status_ipemesanan == '3'){
                $menunggu_ulasan = $menunggu_ulasan + 1;
            }
        }

        $total = $total_transaksi + $menunggu_ulasan;

        $notifikasi = $total_transaksi + $total;
    }
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
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title><?php if($notifikasi != 0){echo "(".$notifikasi.") ";} echo $pageTitle; ?></title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <link rel="icon" href="<?php echo base_url(); ?>assets/img/banner/bx-cake.svg" >
  <link href="https://fonts.googleapis.com/css?family=Poppins:300,300i,400,400i,600,600i,700,700i|Satisfy|Comic+Neue:300,300i,400,400i,700,700i" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/animate.css/animate.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/aos/aos.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/bootstrap-5/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/bootstrap-5/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/boxicons/css/boxicons.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/datetimepicker/jquery.datetimepicker.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/fullcalendar/fullcalendar.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/glightbox/css/glightbox.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/lightslider/src/css/lightslider.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/remixicon/remixicon.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/swiper/swiper-bundle.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/sweetalert2/sweetalert2.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/frontend/css/style.css">
    
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


    <!-- Button -->
    <style>
        .btn-chat {
            position: fixed;
            visibility: hidden;
            opacity: 0;
            right: 15px;
            bottom: 70px;
            z-index: 996;
            background: #ffc107;
            width: 40px;
            height: 40px;
            border-radius: 50px;
            transition: all 0.4s;
        }

        .btn-chat i {
            font-size: 22px;
            color: #fff;
            line-height: 0;
            padding-top: 12px;
            padding-left: 3px
        }

        .btn-chat:hover {
            background: #ffc107;
            color: #fff;
        }

        .btn-chat.active {
            visibility: visible;
            opacity: 1;
        }
    </style>


    <!-- Button -->
    <style>
        .modal.right .modal-dialog {
            position: fixed;
            margin: auto;
            width: 100%;
            -webkit-transform: translate3d(0%, 0, 0);
                -ms-transform: translate3d(0%, 0, 0);
                -o-transform: translate3d(0%, 0, 0);
                    transform: translate3d(0%, 0, 0);
        }

        .modal.right .modal-content {
            overflow-y: auto;
        }
        
        .modal.right .modal-body {
            padding: 15px 15px 15px;
        }


    /*Right*/
        .modal.right.fade .modal-dialog {
            right: 1px;
            -webkit-transition: opacity 0.3s linear, right 0.3s ease-out;
            -moz-transition: opacity 0.3s linear, right 0.3s ease-out;
                -o-transition: opacity 0.3s linear, right 0.3s ease-out;
                    transition: opacity 0.3s linear, right 0.3s ease-out;
        }
        
        .modal.right.fade.in .modal-dialog {
            right: 0;
        }

    </style>


    <!-- Card Hover -->
    <style>
        .cards{
            transition: all 0.2s ease;
            cursor: pointer;
        }

        .cards:hover{
            box-shadow: 5px 6px 6px 2px #e9ecef;
            transform: scale(1.1);
        }
    </style>

</head>

<body>
    <section id="topbar" class="d-flex align-items-center fixed-top topbar-transparent">
        <div class="container-fluid container-xl d-flex align-items-center justify-content-center justify-content-lg-start">
            <i class="bi bi-phone d-flex align-items-center"><span>+1 5589 55488 55</span></i>
            <i class="bi bi-clock ms-4 d-none d-lg-flex align-items-center"><span>Setiap Hari: 08:00 - 21:00</span></i>
        </div>
    </section>

<?php $cari_produk = NULL ;?>
    <header id="header" class="fixed-top d-flex align-items-center header-transparent">
        <div class="container-fluid container-xl d-flex align-items-center justify-content-between">

        <div class="logo me-auto pt-2">
            <a id="logo-text" href="<?php echo base_url('home');?>" style="color:#fff; "><h4>NurBakery&Cake</h4></a>
        </div>


            <nav aria-label="" id="navbar" class="navbar order-last order-lg-0">
                <ul>
                    <li class="dropdown">
                        <a href="#"><i class="bx bx-search bx-sm"></i></a>
                        <ul class="p-1">
                            <form role="form" action="<?php echo base_url('home/cari_produk');?>" id="form_cari_produk" method="post" aria-label="">
                                <div class="input-group"style="width:400px">
                                    <input type="search" class="form-control rounded" id="cari_produk" name="cari_produk" placeholder="Cari Produk" aria-label="Search" aria-describedby="search-addon" />
                                    <button  type="submit" class="btn btn-warning btn_cari_produk"><i class="fa fa-search"></i></button>
                                </div>
                            </form>
                        </ul>
                    </li>
                    <li><a class="nav-link scrollto" id="pedoman_berbelanja" href="<?php echo base_url('home/pedoman_berbelanja');?>">Pedoman Berbelanja</a></li>
                    <li><a class="nav-link scrollto" id="tentang" href="<?php echo base_url('home/tentang');?>">Tentang</a></li>
                    <?php if($this->session->userdata('ses_id_konsumen') == null && $this->session->userdata('ses_akses') != 'Konsumen'){?>
                        <li><a class="nav-link scrollto" id="daftar" href="<?php echo base_url('home/daftar');?>"><strong>Daftar</strong></a></li>
                        <li><a class="scrollto btn_modal_login"><strong>Login</strong></a></li>
                    <?php 
                        }else{
                            if($data_konsumen['status_konsumen'] == "Aktif"){
                    ?>
                        <li>
                            <a class="nav-link scrollto" id="keranjang" href="<?php echo base_url('home/keranjang') ?>"><i class="bx bx-cart bx-md" style="font-size: 1.5rem;" ></i>
                                <?php if($keranjang != 0){ ?>
                                    <span class="top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                        <?php echo $keranjang; ?>
                                    <span class="visually-hidden">unread messages</span>
                                <?php } ?>
                            </a>
                        </li>
                    <?php } ?>
                    <li class="dropdown">
                        <a href="#">
                            <?php echo $data_konsumen['nama_konsumen']; 
                                if($data_konsumen['foto_konsumen'] == '') { ?>
                                    <img src="<?php echo base_url('assets/img/banner/profile.jpg');?>" style="width:30px; height:30px; object-fit: cover; border-radius: 30px; margin-right:5px" alt="User Image">
                                <?php }else{ ?>
                                    <img src="<?php echo base_url('assets/img/konsumen/').$data_konsumen['foto_konsumen'];?>" style="width:30px; height:30px; object-fit: cover; border-radius: 30px; margin-right:5px" alt="User Image">
                                <?php } ?>
                                <?php if($total != 0){ ?>
                                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                        <?php echo $total; ?>
                                    </span>
                            <?php } ?>
                        </a>
                        <ul>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-8">
                                        <?php echo $data_konsumen['nama_konsumen']; ?>
                                    </div>
                                    <div class="col-4">
                                        <?php 
                                            if($data_konsumen['status_konsumen'] == 'Baru'){
                                                echo "<div style='float:right'><span class='badge bg-danger text-xs'>Verifikasi Email</span></div>";
                                            } elseif($data_konsumen['status_konsumen'] == 'Tidak Aktif'){
                                                echo "<div style='float:right'><span class='badge bg-danger text-xs'>Tidak Aktif</span></div>";
                                            } elseif($data_konsumen['status_konsumen'] == 'Aktif'){
                                                echo "<div style='float:right'><span class='badge bg-success text-xs'>Aktif</span></div>";    
                                            }
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <li><hr class="dropdown-divider"></li>
                            <?php if($data_konsumen['status_konsumen'] == 'Aktif'){ ?>
                                    <li>
                                        <a class="dropdown-item" href="<?php echo base_url('transaksi') ?>"> Transaksi
                                            <?php if($total_transaksi != 0){ ?>
                                                <span class="badge bg-danger text-xs" style="width:20px; height:20px; border-radius: 50%;"><?php echo $total_transaksi; ?></span>
                                            <?php } ?>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="<?php echo base_url('ulasan') ?>"> Ulasan
                                            <?php if($menunggu_ulasan + $total_ulasan_pemesanan!= 0){ ?>
                                                <span class="badge bg-danger text-xs" style="width:20px; height:20px; border-radius: 50%;"><?php echo $menunggu_ulasan + $total_ulasan_pemesanan; ?></span>
                                            <?php } ?>
                                        </a>
                                    </li>
                                <?php } ?>
                            <li><a class="dropdown-item" href="<?php echo base_url('home/profil') ?>"> Profil</a></li>
                            <li><a class="dropdown-item" href="#" id="btn_modal_reset_password"> Ubah Password</a></li>
                            <li><a class="dropdown-item" href="#" id="btn_modal_logout"></i> Logout</a></li>
                        </ul>    
                    </li>
                    <?php } ?>
                </ul>
                <span class="bi bi-list mobile-nav-toggle"></span>
            </nav>
            <?php if($this->session->userdata('ses_akses') == 'Konsumen'){?>
                <nav id="navbar" class="navbar" aria-label=""></nav>
            <?php } ?>
        </div>
    </header>

    <div id="modal_login" class="modal animated pulse" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border: 2px solid #ffc107; border-radius: 20px">
                <div class="modal-body">
                    <form role="form" id="form_login" method="post" aria-label="">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-10">
                                    <h3>Login</h3>
                                </div>
                                <div class="col-2" style="text-align: right;">
                                    <button type="button" class="btn-close float-sm-right" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                            </div>
                            <br>
                            <div id="alert_login"></div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="email_hp_login" id="email_hp_login" placeholder="Email / No. Handphone">
                                <label for="email_hp_login">Email / No. Handphone</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="password" class="form-control" name="password_login" id="password_login" placeholder="Password">
                                <label for="password_login">Password</label>
                            </div>
                            </br>
                            <div class="col-12">
                                <button type="submit" id="btn_login" class="btn btn-warning rounded-pill" style="width:100%">Login</button>  
                            </div>
                            </br>
                            <div class="col-12">
                                <small>Anda tidak memiliki akun? Klik <a id="daftar" href="<?php echo base_url('home/daftar');?>"><b>DISINI</b></a> untuk mendaftar.</small>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div id="modal_logout" class="modal animated pulse" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border: 2px solid #ffc107; border-radius: 20px">
                <div class="modal-body">
                    <div class="modal-body">  
                        <div class="row">
                            <div class="col-10">
                                <h3>Logout</h3>
                            </div>
                            <div class="col-2" style="text-align: right;">
                                <button type="button" class="btn-close float-sm-right" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                        </div>
                        <br>                      
                        </br>                        
                        </br>
                        <h4 class="form-label" style="text-align:center">Apakah anda yakin akan logut?</h4>                        
                        </br>                        
                        </br>
                        <div class="col-12">
                            <button type="submit" id="btn_logout" class="btn btn-danger rounded-pill" style="width:100%">Logout</button>  
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="moda_reset_password" class="modal animated pulse" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border: 2px solid #ffc107; border-radius: 20px">
                <div class="modal-body">
                    <form role="form" id="form_reset_password" method="post" aria-label="">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-10">
                                    <h3>Ubah Password</h3>
                                </div>
                                <div class="col-2" style="text-align: right;">
                                    <button type="button" class="btn-close float-sm-right" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                            </div>
                            <br>
                            <div id="alert_reset_password"></div>
                            <div class="form-group mb-3">
                                <input type="hidden" name="id_konsumen" id="id_konsumen" value="<?php echo $this->session->userdata('ses_id_konsumen'); ?>"/>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="password" class="form-control" name="reset_password_konsumen" id="reset_password_konsumen" placeholder="Password Lama">
                                <label for="reset_password_konsumen">Password Lama</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="password" class="form-control" name="password1" id="password1" placeholder="Password Baru">
                                <label for="password1">Password Baru</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="password" class="form-control" name="password2" id="password2" placeholder="Ketik Ulang Password Baru">
                                <label for="password2">Ketik Ulang Password Baru</label>
                            </div>
                            </br>
                            <div class="col-12">
                                <button type="submit" id="btn_reset_password" class="btn btn-warning rounded-pill" style="width:100%" style="width:100%">Simpan</button>  
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div id="modal_chat_konsumen" class="modal right fade in" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border: 2px solid #ffc107; border-radius: 20px">
                <div class="modal-body">
                    <div class="modal-header">
                        <h4>Layanan Chat</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="direct-chat direct-chat-primary">
                            <div class="card-body">
                                <div id="content_chat">

                                </div>
                            </div>  
                        </div>  
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="modal_chat_nonkonsumen" class="modal right fade in animated pulse" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content"style="border: 2px solid ##ffc107; border-radius: 20px">
                <div class="modal-body">
                    <div class="modal-header">
                        <h4>Layanan Chat</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="card-body card-outline direct-chat-primary">
                            <div id="content_chat2" >
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="nonkonsumen_nama_chat" placeholder="Nama">
                                    <label for="nonkonsumen_nama_chat">Nama</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="nonkonsumen_kontak_chat" placeholder="No Kontak">
                                    <label for="nonkonsumen_kontak_chat">No. Kontak</label>
                                </div>
                                <br>
                                <div class="col-12">
                                    <button type="button" id="btn_mulai_chat" class="btn btn-warning rounded-pill" style="width:100%">Mulai Chat</button>  
                                </div>    
                                <br>   
                                <small>Untuk melanjutkan obrolan gunakan no kontak yang sebelumnya sudah dimasukan.</small>
                            </div>
                        </div>  
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div id="preloader"></div>
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center "><i class="bi bi-arrow-up-short"></i></a>
    <?php if($this->session->userdata('ses_akses') =='Konsumen'){?>
        <a href="#" class="active btn-chat d-flex align-items-center justify-content-center" id="btn-chat-konsumen">
            <i class="bx bx-fw bxs-chat"></i>
            <?php foreach($this->Mod_master->get_all_kontak()->result() as $data){
                if($data->status_chat == '2' && $data->id_konsumen == $this->session->userdata('ses_id_konsumen')){
                    echo '<span class="translate-middle badge rounded-pill bg-danger" style="margin-right: -25px;">N';
                }
            } ?>
        </a>
    <?php } elseif($this->session->userdata('ses_akses') =='Nonkonsumen'){?>
        <a href="#" class="active btn-chat d-flex align-items-center justify-content-center" id="btn-chat-konsumen">
            <i class="bx bx-fw bxs-chat"></i>
            <?php foreach($this->Mod_master->get_all_kontak()->result() as $data){
                if($data->status_chat == '2' && $data->nonkonsumen_kontak_chat == $this->session->userdata('ses_nonkonsumen_kontak_chat')){
                    echo '<span class="translate-middle badge rounded-pill bg-danger" style="margin-right: -25px;">N';
                }
            } ?>
        </a>
    <?php } else { ?>
        <a href="#" class="active btn-chat d-flex align-items-center justify-content-center" id="btn-chat-non-konsumen"><i class="bx bx-fw bxs-chat"></i></a>
    <?php } ?>

