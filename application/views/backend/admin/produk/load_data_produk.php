<table style="width:100%" id="datatable_admin" class="table table-bordered table-striped">
    <caption></caption>
    <thead>
        <tr>
            <th id="" style="text-align: center; vertical-align: middle; width:3%">No.</th>
            <th id="" style="text-align: center; vertical-align: middle; ">Aksi</th>
            <th id="" style="text-align: center; vertical-align: middle; ">Gambar</th>
            <th id="" style="text-align: center; vertical-align: middle; ">Kode</th>
            <th id="" style="text-align: center; vertical-align: middle; ">Nama</th>
            <th id="" style="text-align: center; vertical-align: middle; ">Kategori</th>
            <th id="" style="text-align: center; vertical-align: middle; ">Penyajian</th>
            <th id="" style="text-align: center; vertical-align: middle; ">Penyimpanan</th>
            <th id="" style="text-align: center; vertical-align: middle; ">Pengemasan</th>
            <th id="" style="text-align: center; vertical-align: middle; ">Aksesoris</th>
            <th id="" style="text-align: center; vertical-align: middle; ">Bentuk</th>
            <th id="" style="text-align: center; vertical-align: middle; ">Volume</th>
            <th id="" style="text-align: center; vertical-align: middle; ">Irisan</th>
            <th id="" style="text-align: center; vertical-align: middle; ">Berat</th>
            <th id="" style="text-align: center; vertical-align: middle; ">Harga</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        
            $no = 1;
            foreach($produk->result() as $row1) {
                $baris = 1;
                foreach($ukuran->result() as $row2) {   
                    if($row1->hahaha == $row2->kode_produk){
                        $baris += 1;
                    }
                }
        ?>
        <tr>
            <td rowspan="<?php echo $baris;?>" class="text-sm" style="text-align: center; vertical-align: middle;"><?php echo $no;?></td>
            <td rowspan="<?php echo $baris;?>" class="text-sm" style="text-align: center; vertical-align: middle;" >
                <a class='btn btn-info btn-sm btn-rounded btn_edit_produk' kode_produk="<?php echo $row1->hahaha; ?>"><span class="bx bx-fw bx-pencil"></span></a>
                <br>
                <a class='btn btn-danger btn-sm btn-rounded btn_hapus_produk' nama_produk="<?php echo $row1->nama_produk; ?>" kode_produk="<?php echo $row1->hahaha; ?>" gambar_produk="<?php echo $row1->gambar_produk;?>"><span class="bx bx-fw bxs-trash"></span></a>
            </td>
            <td rowspan="<?php echo $baris;?>" class="text-sm" style="text-align: center; vertical-align: middle;">
                <?php if($row1->gambar_produk != "") { ?>
                    <div class="d-flex justify-content-center">
                        <div class="elevation-1" style="width: 80px; height: 80px; border:1px solid #ced4da;">
                            <img src="<?php echo base_url('assets/img/produk/'.$row1->gambar_produk);?>" alt="Image" class="elevation-1" style="width:80px; height:80px; object-fit:cover; background:white;">
                        </div>
                    </div>
                <?php }else{ ?>
                    <div class="d-flex justify-content-center">
                        <div class="elevation-1" style="width: 80px; height: 80px; border:1px solid #ced4da;">
                            <img src="<?php echo base_url('assets/img/banner/bx-cake.svg');?>" alt="Image" alt="Image" style="width:60px; height:60px; margin-top: 9px; object-fit:cover;">
                        </div>
                    </div>
                <?php } ?>
            </td>
            <td rowspan="<?php echo $baris;?>" class="text-sm" style="text-align: left; vertical-align: middle;"><?php echo $row1->hahaha;?></td>
            <td rowspan="<?php echo $baris;?>" class="text-sm" style="text-align: left; vertical-align: middle;"><?php echo $row1->nama_produk;?></td>
            <td rowspan="<?php echo $baris;?>" class="text-sm" style="text-align: left; vertical-align: middle;"><?php echo $row1->nama_kategori;?></td>
            <td rowspan="<?php echo $baris;?>" class="text-sm" style="text-align: left; vertical-align: middle;"><?php echo $row1->penyajian_produk;?></td>
            <td rowspan="<?php echo $baris;?>" class="text-sm" style="text-align: left; vertical-align: middle;"><?php echo $row1->penyimpanan_produk;?></td>
            <td rowspan="<?php echo $baris;?>" class="text-sm" style="text-align: left; vertical-align: middle;"><?php echo $row1->pengemasan_produk;?></td>
            <td rowspan="<?php echo $baris;?>" class="text-sm" style="text-align: left; vertical-align: middle;"><?php echo $row1->aksesoris_produk;?></td> 
            <td rowspan="<?php echo $baris;?>" class="text-sm" style="text-align: left; vertical-align: middle;"><?php echo $row1->bentuk_produk;?></td>
            <?php
                foreach($ukuran->result() as $row2) {   
                    if($row1->hahaha == $row2->kode_produk){?> 
                        <tr>
                            <td class="text-sm" style="text-align: center; vertical-align: middle;"><?php echo $row2->volume_ukuran;?></td>
                            <td class="text-sm" style="text-align: center; vertical-align: middle;"><?php echo $row2->irisan_ukuran;?></td>
                            <td class="text-sm" style="text-align: right; vertical-align: middle;"><?php echo number_format($row2->berat_ukuran, 0, ".", ".");?></td>
                            <td class="text-sm" style="text-align: right; vertical-align: middle;"><?php echo number_format($row2->harga_ukuran, 0, ".", ".");?></td>
                        </tr>
            <?php } } ?>
        </tr>
        <?php        
                $no++; 
            } 
        ?>
    </tbody>
</table>
 
<script src="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datetimepicker/build/jquery.datetimepicker.full.js"></script>
<script>
    $(document).ready(function() {
        var table = $('#datatable_admin').DataTable( {
            responsive: true
        });
    });
</script>