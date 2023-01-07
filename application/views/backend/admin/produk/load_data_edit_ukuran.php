<table style="width:100%" id="dataTable2" class="table table-bordered table-striped">
    <caption></caption>
    <thead>
        <tr>
            <th id="" style="text-align: center; vertical-align: middle; width:3%">No.</th>
            <th id="" style="text-align: center; vertical-align: middle; ">Volume (cm)</th>
            <th id="" style="text-align: center; vertical-align: middle; ">Irisan</th>
            <th id="" style="text-align: center; vertical-align: middle; ">Berat (kg)</th>
            <th id="" style="text-align: center; vertical-align: middle; ">Harga Jual (Rp)</th>
            <th id="" style="text-align: center; vertical-align: middle; width:20%">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php 
            $no = 1;
            foreach($ukuran->result() as $row) {
                if($row->kode_produk == $kode_produk){
        ?>
        <tr>
            <td style="text-align: center; vertical-align: middle;"><?php echo $no;?></td>
            <td style="text-align: right; vertical-align: middle;"><?php echo $row->volume_ukuran;?></td>
            <td style="text-align: right; vertical-align: middle;"><?php echo $row->irisan_ukuran;?></td>
            <td style="text-align: left; vertical-align: middle;"><?php echo number_format($row->berat_ukuran, 0, ".", ".");?></td>
            <td style="text-align: left; vertical-align: middle;"><?php echo number_format($row->harga_ukuran, 0, ".", ".");?></td>
            <td style="text-align: center; vertical-align: middle;" >
                <a class='btn btn-info btn-sm btn-rounded btn_edit_ukuran'
                    kode_ukuran="<?php echo $row->kode_ukuran; ?>"
                    volume_ukuran="<?php echo $row->volume_ukuran; ?>"
                    irisan_ukuran="<?php echo $row->irisan_ukuran; ?>"
                    berat_ukuran="<?php echo $row->berat_ukuran; ?>"
                    harga_ukuran="<?php echo $row->harga_ukuran; ?>"
                    ><span class="bx bx-fw bxs-pencil"></span></a>
                <a class='btn btn-danger btn-sm btn-rounded btn_hapus_ukuran' kode_ukuran="<?php echo $row->kode_ukuran; ?>"><span class="bx bx-fw bxs-trash"></span></a>
            </td>
        </tr>
        <?php
                $no++;
                }
            } 
        ?>
    </tbody>
</table>



<script type="text/javascript">
    $('.btn_edit_ukuran').on("click",function(e){
        $('#kode_ukuran').val($(this).attr("kode_ukuran"));
        $('#volume_ukuran').val($(this).attr("volume_ukuran"));
        $('#irisan_ukuran').val($(this).attr("irisan_ukuran"));
        $('#berat_ukuran').val($(this).attr("berat_ukuran"));
        $('#harga_ukuran').val($(this).attr("harga_ukuran"));
    });
</script>
