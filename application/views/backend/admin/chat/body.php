<?php $this->load->view('backend/partials/head.php') ?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="m-1 text-dark"><span class="nav-icon bx bx-fw bxs-chat"></span>Chat</h1>
                </div>
                <div class="col-sm-6 float-sm-right">
                    <ol class="breadcrumb float-sm-right m-2">
                        <span class="breadcrumb-item"><a href="<?php echo base_url('admin/dashboard'); ?>">Dashboard</a></span>
                        <span class="breadcrumb-item active">Konsumen</span>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    

    <section class="content">
        <div class="container-fluid">
            <div class="row">   
                <div class="col-lg-4 col-12">
                    <div class="card card-outline direct-chat direct-chat-warning" >
                        <div class="card-body">
                            <div id="content_kontak">
                            
                            </div>
                        </div> 
                    </div>
                </div>
                <div class="col-lg-8 col-12">
                    <div class="card card-outline direct-chat direct-chat-warning" >
                        <div id="content_chat">
                            <div class="text-center" style="padding: 20px;">
                                <br>
                                <span class="nav-icon bx bx-md bxs-chat"></span>
                                <br>
                                <h3>Pilih kontak untuk membalas chat.</h3>
                                <br>
                            </div>
                        </div>
                    </div>  
                </div> 
            </div>
        </div>
    </section>   
</div> 

<?php $this->load->view('backend/partials/footer.php') ?>
<?php $this->load->view('backend/partials/script.php') ?>


<script language="JavaScript">

var url = '<?php echo base_url('admin/chat'); ?>';
    $('ul.nav-sidebar a').filter(function() {
        return this.href == url;
    }).addClass('active ');
    $('ul.nav-treeview a').filter(function() {
        return this.href == url;
    }).parentsUntil(".nav-sidebar > .nav-treeview").addClass('menu-open').prev('a').addClass('active');

    loadKontak();
    function loadKontak(){
        $.ajax({
            method : "GET",
            url : "<?php echo base_url('admin/chat/load_kontak'); ?>",
            beforeSend : function(){
                $('#content_kontak').html('<div style="text-align:center"><i class="fa fa-refresh fa-3x fa-spin"  style="margin-top: 30px; margin-bottom: 30px;" aria-hidden="true"></i></div>');
            },
            success : function(response){
                $('#content_kontak').html(response);
            }
        });
    }

    $(document).on('click', '#btn_kontak', function(e) {
        var id_konsumen=$(this).attr("id_konsumen");
        var nama_chat=$(this).attr("nama_chat");
        var kontak_chat=$(this).attr("kontak_chat");
        var foto_konsumen=$(this).attr("foto_konsumen");

        $.ajax({
            method : "POST",
            url : "<?php echo base_url('admin/chat/load_chat'); ?>",
            data : {
                id_konsumen:id_konsumen,
                nama_chat:nama_chat,
                kontak_chat:kontak_chat,
                foto_konsumen:foto_konsumen
            },
            beforeSend : function(){
                $('#content_chat').html('<div style="text-align:center"><i class="fa fa-refresh fa-3x fa-spin"  style="margin-top: 30px; margin-bottom: 30px;" aria-hidden="true"></i></div>');
            },
            success : function(response){
                $('#content_chat').html(response);
            }
        });
    });

    $(document).on('click', '#btn_kirim_pesan', function(e) {
        var id_konsumen = $('#id_konsumen').val();
        var chat = $('#chat').val();
        var nama_chat = $('#nama_chat').val();
        var kontak_chat = $('#kontak_chat').val();
        var foto_konsumen = $('#foto_konsumen').val();

         $.ajax({
            url : '<?php echo base_url('admin/chat/kirim_pesan'); ?>',
            method: 'POST',
            data: {
                id_konsumen:id_konsumen,
                chat:chat,
                nama_chat:nama_chat,
                kontak_chat:kontak_chat,
            },
            success: function(response){
                if(response==1){ 
                    loadKontak();
                    $("#chat").val("");

                    $.ajax({
                        method : "POST",
                        url : "<?php echo base_url('admin/chat/load_chat'); ?>",
                        data : {
                            id_konsumen:id_konsumen,
                            nama_chat:nama_chat,
                            kontak_chat:kontak_chat,
                            foto_konsumen:foto_konsumen
                        },
                        beforeSend : function(){
                            $('#content_chat').html('<div style="text-align:center"><i class="fa fa-refresh fa-3x fa-spin" style="padding: 20px;" aria-hidden="true"></i></div>');
                        },
                        success : function(response){
                            $('#content_chat').html(response);
                        }
                    });

                } else if(response==2){
                    Swal.fire({
                        icon: 'error',
                        title: 'Pesan harus diisi!',
                        showConfirmButton: true,
                        timer: 3000
                    })
                }
            }
        });
    }); 

</script>

</body>
</html>

