<table style="width:100%" id="dataTable2" class="table table-bordered table-striped">
    <caption></caption>
    <thead>
        <tr>
            <th id="" style="text-align: center; vertical-align: middle; width:3%">No.</th>
            <th id="" style="text-align: center; vertical-align: middle; ">Volume (cm)</th>
            <th id="" style="text-align: center; vertical-align: middle; ">Irisan</th>
            <th id="" style="text-align: center; vertical-align: middle; ">Berat (kg)</th>
            <th id="" style="text-align: center; vertical-align: middle; ">Harga Jual (Rp)</th>
            <th id="" style="text-align: center; vertical-align: middle; width:7%">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php 
            $no = 1;
            foreach($ukuran->result() as $row) {
                if($row->kode_produk == ""){
        ?>
        <tr>
            <td style="text-align: center; vertical-align: middle;"><?php echo $no;?></td>
            <td style="text-align: right; vertical-align: middle;"><?php echo $row->volume_ukuran;?></td>
            <td style="text-align: right; vertical-align: middle;"><?php echo $row->irisan_ukuran;?></td>
            <td style="text-align: left; vertical-align: middle;"><?php echo number_format($row->berat_ukuran, 0, ".", ".");?></td>
            <td style="text-align: left; vertical-align: middle;"><?php echo number_format($row->harga_ukuran, 0, ".", ".");?></td>
            <td style="text-align: center; vertical-align: middle;" >
                <a class='btn btn-danger btn-sm btn-rounded btn_hapus_ukuran' kode_ukuran="<?php echo $row->kode_ukuran; ?>"><span class="bx bx-fw bxs-trash"></span></a>
            </td>
        </tr>
        <?php
                }
            } 
        ?>
    </tbody>
</table>
