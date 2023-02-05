<?php $this->load->view('backend/partials/head.php') ?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="m-1 text-dark"><span class="nav-icon bx bx-fw bxs-offer"></span>Diskon</h1>
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
            <div class="card">
                <div class="card-body">
                    <div id="content_diskon">
                        <!--LOAD DATA-->
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php $this->load->view('backend/partials/footer.php') ?>
<?php $this->load->view('backend/partials/script.php') ?>

<!-----------------------FUNGSI----------------------->
<script type="text/javascript">
    var url_diskon =  "<?php echo base_url('pimpinan/diskon'); ?>";
    var url = url_diskon ;
    $('ul.nav-sidebar a').filter(function() {
        return this.href == url;
    }).addClass('active ');
    $('ul.nav-treeview a').filter(function() {
        return this.href == url;
    }).parentsUntil(".nav-sidebar > .nav-treeview").addClass('menu-open').prev('a').addClass('active');
</script>


<script type="text/javascript">
    load_data_diskon();
	function load_data_diskon(){
		$.ajax({
			method : "GET",
			url : '<?php echo base_url('pimpinan/diskon/load_data_diskon'); ?>',
			beforeSend : function(){
				$('#content_diskon').html('<div style="text-align:center"><i class="bx bx-loader-alt bx-md bx-spin" style="margin-top: 30px; margin-bottom: 30px;" aria-hidden="true"></i></div>');
			},
			success : function(response){
				$('#content_diskon').html(response);
			}
		});
    };
</script>

</body>
</html>