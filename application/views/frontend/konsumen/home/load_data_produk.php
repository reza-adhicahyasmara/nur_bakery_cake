<div class="row row-cols-1 row-cols-md-3 g-4">

    <?php if(empty($list_produk)) { ?>
        <div class="col-12" style="text-align:center">
            <br>
            <br>
            <h5>Tidak ada data</h5>
        </div>
    <?php 
        } else {
            $delay = 100;
            foreach($list_produk as $row){
    ?>  
           <a href="<?php echo base_url('home/detail_produk/').$row->hahaha;?>" style="color: black;"> 
                <div class="col">
                    <div class="card cards" style="border-radius: 5%;">
                        <?php if($row->gambar_produk != "") { ?>
                            <img class="card-img-top" src="<?php echo base_url('assets/img/produk/'.$row->gambar_produk);?>" alt="Image" style="border-top-left-radius: 5%; border-top-right-radius: 5%;">
                        <?php }else{ ?>
                            <img class="card-img-top" src="<?php echo base_url('assets/img/banner/package_regular.png');?>" alt="Image" style="border-top-left-radius: 5%; border-top-right-radius: 5%;">
                        <?php } ?>
                        <div class="card-body">
                            <strong class="card-title fs-5" style="color: #ffc107"><?php echo $row->merek_produk." ".$row->varian_produk; ?></strong>
                            <p class="card-text">
                                <?php 
                                    if($this->session->userdata('ses_akses') == NULL && $row->status_promo_produk == "on" || date("Y-m-d") <= date("Y-m-d", strtotime("+1 month", strtotime($member['daftar_member']))) && $row->status_promo_produk == "on"){
                                        $promo_produk = $row->promo_produk;
                                        $harga_jual_produk = $row->harga_jual_produk;
                                        $harga_promo = $harga_jual_produk - (($promo_produk * $harga_jual_produk) / 100);
                                ?>
                                    <span class="badge bg-success"><?php echo $promo_produk; ?>%</span>
                                    <del>Rp. <?php echo number_format($harga_jual_produk, 0, ".", "."); ?></del></li>
                                    <br>
                                    <strong>Rp. <?php echo number_format($harga_promo, 0, ".", "."); ?></strong>
                                <?php }else{ ?>
                                    <strong>Rp. <?php echo number_format($row->harga_jual_produk, 0, ".", "."); ?></strong>
                                    <br>
                                <?php } ?>
                                <?php
                                    $total1 = 0;
                                    $count1 = 0;
                                    $average1 = 0;
                                    foreach($ulasan_produk as $rat){ 
                                        if($rat->kode == $row->hahaha && $rat->status_ipesanan == 4){ 
                                            $total1 += $rat->rating_ipesanan;
                                            $count1 += 1;
                                        }
                                    }
                                    if($total1 == 0 || $total1 == null){
                                        $angka_format1 = 0;
                                    }else if($total1 != 0 || $total1 != null){
                                        $average1 = $total1/$count1;
                                        $angka_format1 = number_format($average1,1);
                                    }
                                ?>
                                <br>
                                <i class="fa fa-star checked"> <?php echo $angka_format1; ?></i> | Stok <?php echo number_format($row->stok_gudang_produk, 0, ".", "."); ?>
                            </p>
                        </div>
                    </div>
                </div>
            </a>
    <?php  
        }
    }
    ?>
</div>