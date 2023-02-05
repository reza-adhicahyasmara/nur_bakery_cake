<table style="width:100%" id="dataTable2" class="table table-bordered table-striped">
    <caption></caption>
    <thead>
        <tr>
            <th id="" style="text-align: center; vertical-align: middle; width:3%">No.</th>
            <th id="" style="text-align: center; vertical-align: middle; ">Gambar</th>
            <th id="" style="text-align: center; vertical-align: middle; ">Durasi </th>
            <th id="" style="text-align: center; vertical-align: middle; ">Judul Event</th>
            <th id="" style="text-align: center; vertical-align: middle; ">Deskripsi</th>
            <th id="" style="text-align: center; vertical-align: middle; ">Daftar Produk</th>
        </tr>
    </thead>
    <tbody>
        <?php 
            $no1 = 1;
            foreach($diskon->result() as $row) {
        ?>
        <tr>
            <td style="text-align: center; vertical-align: middle;"><?php echo $no1;?></td>
            <td style="text-align: center; vertical-align: middle;">
                <?php if($row->gambar_diskon != "") { ?>
                    <div class="d-flex justify-content-center">
                        <div class="elevation-1" style="width: 160px; height: 80px; border:1px solid #ced4da;">
                            <img src="<?php echo base_url('assets/img/diskon/'.$row->gambar_diskon);?>" alt="Image" class="elevation-1" style="width: 160px;; height:80px; object-fit:cover; background:white;">
                        </div>
                    </div>
                <?php }else{ ?>
                    <div class="d-flex justify-content-center">
                        <div class="elevation-1" style="width: 160px; height: 80px; border:1px solid #ced4da;">
                            <img src="<?php echo base_url('assets/img/banner/image_alt.svg');?>" alt="Image" alt="Image" style="width:160px; height:60px; margin-top: 9px; object-fit:cover;">
                        </div>
                    </div>
                <?php } ?> 
            </td>
            <td style="text-align: left; vertical-align: middle;"><?php echo $row->tanggal_awal_diskon." - ".$row->tanggal_akhir_diskon?></td>
            <td style="text-align: left; vertical-align: middle;"><?php echo $row->nama_diskon;?></td>
            <td style="text-align: left; vertical-align: middle;"><?php echo $row->deskripsi_diskon?></td>
            <td style="text-align: left; vertical-align: middle;">
            <?php 
                $no = 1;
                foreach($idiskon->result() as $row1) {
                    if($row1->kode_diskon == $row->kode_diskon){
                        echo $no.". ".$row1->nama_produk." (".$row1->potongan_idiskon."%)<br>";
                        $no++;
                    } 
                }
            ?>
            </td>
        </tr>
        <?php
            $no1++;
            } 
        ?>
    </tbody>
</table>

<script>
    $(function () {
        $("#dataTable2").DataTable({
        "responsive": true,
        "autoWidth": false,
        });
    });
</script>