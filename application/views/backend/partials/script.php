<aside class="control-sidebar control-sidebar-dark"></aside>
</div>

<!-----------------------VENDOR JS FILES----------------------->
<script src="<?php echo base_url(); ?>assets/plugins/jquery/jquery.min.js"></script>

<script src="<?php echo base_url(); ?>assets/plugins/bootstrap-4/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/chart.js/Chart.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/chart.js/Chart.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/chart.js/Chart.bundle.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/chart.js/Chart.bundle.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datetimepicker/build/jquery.datetimepicker.full.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/dropzone/dropzone.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/jquery-knob/jquery.knob.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/moment/moment.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/select2/js/select2.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/sparklines/sparkline.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/sweetalert2/sweetalert2.all.min.js"></script>

<script src="<?php echo base_url(); ?>assets/dist/backend/js/adminlte.js"></script>

<!-----------------------LAPORAN TRANSAKSI----------------------->
<script type="text/javascript">

    $(document).ready(function(){   
        $('#tanggal_awal').datetimepicker({
            //inline:true,
            autoclose: true,
            timepicker:false,
            format:'Y-m-d'
        });
    });

    $(document).ready(function(){   
        $('#tanggal_akhir').datetimepicker({
            //inline:true,
            autoclose: true,
            timepicker:false,
            format:'Y-m-d'
        });
    });

    $(document).ready(function() {
        $('.print_laporan').on("click",function(){
            $("#form_laporan").valid();
        });

        $('#form_laporan').validate({
            rules: {
                metode_pengiriman_pemesanan: {
                    required: true,
                },
                status_pemesanan: {
                    required: true,
                },
                tanggal_awal: {
                    required: true,
                },
                tanggal_akhir: {
                    required: true,
                },
            },
            messages: {
                metode_pengiriman_pemesanan: {
                    required: "Harus diisi",
                },
                status_pemesanan: {
                    required: "Harus diisi",
                },
                tanggal_awal: {
                    required: "Harus diisi",
                },
                tanggal_akhir: {
                    required: "Harus diisi",
                },
            },
            errorElement: 'span',
            errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            },
            submitHandler: function() {
                var metode_pengiriman_pemesanan = $('#metode_pengiriman_pemesanan').val();
                var status_pemesanan = $('#status_pemesanan').val();
                var tanggal_awal = $('#tanggal_awal').val();
                var tanggal_akhir = $('#tanggal_akhir').val();

                $.ajax({
                    url : "<?php echo base_url('admin/transaksi/laporan_data_pemesanan'); ?>",
                    method: 'POST',
                    data: {
                        metode_pengiriman_pemesanan:metode_pengiriman_pemesanan,
                        status_pemesanan:status_pemesanan,
                        tanggal_awal:tanggal_awal,
                        tanggal_akhir:tanggal_akhir
                    },
                    success: function(response){ 
                        Swal.fire({
                            icon: 'success',
                            title: 'Data telah disimpan!',
                            text: 'Folder Penyimpanan C://xampp/htdocs/nur_bakery_cake/assets/berkas',
                            showConfirmButton: true,
                            confirmButtonColor: '#ffc107',
                        }).then(function(){
                            window.open("file:///C:/");
                        })
                    }
                }); 
            }
        });
    });
</script>