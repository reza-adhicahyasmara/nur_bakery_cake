<?php $this->load->view('backend/partials/head.php') ?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="m-1 text-dark"><span class="nav-icon bx bx-fw bxs-group"></span>Konsumen</h1>
                </div>
                <div class="col-sm-6 float-sm-right">
                    <ol class="breadcrumb float-sm-right m-2">
                        
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="card card-secondary">
                <div class="card-body">
                    <div id="content_konsumen">
                        <!--LOAD DATA-->
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<form role="form" id="form_konsumen" method="post">
    <div id="modal_konsumen" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header">
                    <strong><span class="modal-title text-lg" id="myModalLabel"></span></strong>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- FORM -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><span class="bx bx-fw bx-x"></span> Batal</button>
                    <button type="submit" id="btn_simpan_konsumen" class="btn bg-warning"><span class="bx bx-fw bx-save"></span> Simpan</button>
                </div>
            </div>
        </div>
    </div>
</form>

<?php $this->load->view('backend/partials/footer.php') ?>
<?php $this->load->view('backend/partials/script.php') ?>

<!-----------------------FUNGSI----------------------->
<script type="text/javascript">
    var url_konsumen =  "<?php echo base_url('pimpinan/konsumen'); ?>";
    var url = url_konsumen ;
    $('ul.nav-sidebar a').filter(function() {
        return this.href == url;
    }).addClass('active ');
    $('ul.nav-treeview a').filter(function() {
        return this.href == url;
    }).parentsUntil(".nav-sidebar > .nav-treeview").addClass('menu-open').prev('a').addClass('active');
</script>


<script type="text/javascript">
    load_data_konsumen();
	function load_data_konsumen(){
		$.ajax({
			method : "GET",
			url : "<?php echo base_url('pimpinan/konsumen/load_data_konsumen'); ?>",
			beforeSend : function(){
				$('#content_konsumen').html('<div style="text-align:center"><i class="bx bx-loader-alt bx-md bx-spin" style="margin-top: 30px; margin-bottom: 30px;" aria-hidden="true"></i></div>');
			},
			success : function(response){
				$('#content_konsumen').html(response);
			}
		});
    };

</script>

</body>
</html>