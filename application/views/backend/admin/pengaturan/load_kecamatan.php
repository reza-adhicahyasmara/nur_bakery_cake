<table style="width:100%" id="datatable_kecamatan" class="table table-bordered table-striped">
    <caption></caption>
    <thead>
        <tr>
            <th id="" style="text-align: center; vertical-align: middle; width:3%">No.</th>
            <th id="" style="text-align: center; vertical-align: middle; width:9%">Aksi</th>
            <th id="" style="text-align: center; vertical-align: middle; ">Kecamatan</th>
            <th id="" style="text-align: center; vertical-align: middle; ">Ongkos Kirim (Rp.)</th>
        </tr>
    </thead>
    <tbody>
        <?php 
            $no = 1;
            foreach($data_kecamatan->result() as $row) {
        ?>
        <tr>
            <td style="text-align: center; vertical-align: middle;"><?php echo $no;?></td>
            <td style="text-align: center; vertical-align: middle;" >
                <a class='btn btn-info btn-sm btn-rounded btn_edit_kecamatan' kode_kecamatan="<?php echo $row->kode_kecamatan; ?>"  nama_kecamatan="<?php echo $row->nama_kecamatan; ?>" ongkos_kecamatan="<?php echo $row->ongkos_kecamatan; ?>"><span class="bx bx-fw bx-pencil"></span></a>
            </td>
            <td style="text-align: left; vertical-align: middle;"><?php echo $row->nama_kecamatan;?></td>
            <td style="text-align: right; vertical-align: middle;"><?php echo number_format($row->ongkos_kecamatan, 0, ".", ".");?></td>
        </tr>
        <?php
                $no++;
            } 
        ?>
    </tbody>
</table>

<script>
    $(document).ready(function() {
        var table = $('#datatable_kecamatan').DataTable( {
            responsive: true
        });
    });
</script>