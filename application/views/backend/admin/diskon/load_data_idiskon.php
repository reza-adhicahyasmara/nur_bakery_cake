<table style="width:100%" id="dataTable2" class="table table-bordered table-striped">
    <caption></caption>
    <thead>
        <tr>
            <th id="" style="text-align: center; vertical-align: middle; width:3%">No.</th>
            <th id="" style="text-align: center; vertical-align: middle; ">Kode Produk</th>
            <th id="" style="text-align: center; vertical-align: middle; ">Nama Produk</th>
            <th id="" style="text-align: center; vertical-align: middle; ">Ukuran</th>
            <th id="" style="text-align: center; vertical-align: middle; ">Diskon (%)</th>
            <th id="" style="text-align: center; vertical-align: middle; width:7%">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php 
            $no = 1;
            foreach($idiskon->result() as $row) {
        ?>
        <tr>
            <td style="text-align: center; vertical-align: middle;"><?php echo $no;?></td>
            <td style="text-align: left; vertical-align: middle;"><?php echo $row->kode_produk;?></td>
            <td style="text-align: left; vertical-align: middle;"><?php echo $row->nama_produk;?></td>
            <td style="text-align: left; vertical-align: middle;"><?php echo $row->volume_ukuran;?></td>
            <td style="text-align: center; vertical-align: middle;"><?php echo number_format($row->potongan_idiskon, 0, ".", ".");?></td>
            <td style="text-align: center; vertical-align: middle;" >
                <a class='btn btn-danger btn-sm btn-rounded btn_hapus_idiskon' kode_idiskon="<?php echo $row->kode_idiskon; ?>"><span class="bx bx-fw bxs-trash"></span></a>
            </td>
        </tr>
        <?php
            } 
        ?>
    </tbody>
</table>
