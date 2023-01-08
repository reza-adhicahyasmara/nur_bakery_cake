<table style="width:100%" id="datatable_admin" class="table table-bordered table-striped">
    <caption></caption>
    <thead>
        <tr>
            <th id="" style="text-align: center; vertical-align: middle; width:3%">No.</th>
            <th id="" style="text-align: center; vertical-align: middle; ">Aksi</th>
            <th id="" style="text-align: center; vertical-align: middle; ">Foto</th>
            <th id="" style="text-align: center; vertical-align: middle; ">Nama</th>
            <th id="" style="text-align: center; vertical-align: middle; ">Alamat</th>
            <th id="" style="text-align: center; vertical-align: middle; ">No. Telp / HP</th>
            <th id="" style="text-align: center; vertical-align: middle; ">Email</th>
            <th id="" style="text-align: center; vertical-align: middle; ">Tanggal Daftar</th>
            <th id="" style="text-align: center; vertical-align: middle; ">Status</th>
        </tr>
    </thead>
    <tbody>
        <?php 
            $no = 1;
            foreach($konsumen->result() as $row) {
        ?>
        <tr>
            <td style="text-align: center; vertical-align: middle;"><?php echo $no;?></td>
            <td style="text-align: center; vertical-align: middle;" >
                <a class='btn btn-info btn-sm btn-rounded btn_edit_konsumen' id_konsumen="<?php echo $row->id_konsumen; ?>"><span class="bx bx-fw bx-pencil"></span></a>
                <a class='btn btn-danger btn-sm btn-rounded btn_hapus_konsumen' nama_konsumen="<?php echo $row->nama_konsumen; ?>" id_konsumen="<?php echo $row->id_konsumen; ?>" foto_konsumen="<?php echo $row->foto_konsumen;?>"><span class="bx bx-fw bxs-trash"></span></a>
            </td>
            <td style="text-align: center; vertical-align: middle;">
                <?php if($row->foto_konsumen != "") { ?>
                    <div class="d-flex justify-content-center">
                        <div class=" img-circle elevation-1" style="width: 80px; height: 80px; border:1px solid #ced4da;">
                            <img src="<?php echo base_url('assets/img/konsumen/'.$row->foto_konsumen);?>" alt="Image" class="img-circle elevation-1" style="width:80px; height:80px; object-fit:cover; background:white;">
                        </div>
                    </div>
                <?php }else{ ?>
                    <div class="d-flex justify-content-center">
                        <div class=" img-circle elevation-1" style="width: 80px; height: 80px; border:1px solid #ced4da;">
                            <img src="<?php echo base_url('assets/img/banner/user.svg');?>" alt="Image" alt="Image" style="width:60px; height:60px; margin-top: 9px; object-fit:cover;">
                        </div>
                    </div>
                <?php } ?>
            </td>
            <td style="text-align: left; vertical-align: middle;"><?php echo $row->nama_konsumen;?></td>
            <td style="text-align: left; vertical-align: middle;">
                <?php 
                    $alamat = explode("-",$row->alamat_konsumen);
                    echo $alamat[0].", RT ".$alamat[1]." RW ".$alamat[2]." desa/kel. ".$row->nama_desa." kec. ".$row->nama_kecamatan." kab./kota. ".$row->nama_kabupaten." provinsi ".$row->nama_provinsi;
                ?>
            </td>
            <td style="text-align: left; vertical-align: middle;"><?php echo $row->kontak_konsumen;?></td>
            <td style="text-align: left; vertical-align: middle;"><?php echo $row->email_konsumen;?></td>
            <td style="text-align: left; vertical-align: middle;"><?php echo $row->daftar_konsumen;?></td>
            <td style="text-align: center; vertical-align: middle;">
                <?php 
                    if($row->status_konsumen == 'Baru'){
                        echo "<span class='badge bg-danger text-xs'>Verifikasi Email</span>";
                    } elseif($row->status_konsumen == 'Tidak Aktif'){
                        echo "<span class='badge bg-danger text-xs'>Tidak Aktif</span>";
                    } elseif($row->status_konsumen == 'Aktif'){
                        echo "<span class='badge bg-success text-xs'>Aktif</span>";    
                    }
                ?>
            </td>
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