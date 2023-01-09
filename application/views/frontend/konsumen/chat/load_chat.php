<!-- TAMPIL CHATING KONSUMEN -->

<div class="direct-chat direct-chat-warning">
    <div class="box-body">
        <div class="direct-chat-messages">
            <?php 
                foreach($chat as $row) { 
                    if($row->pengirim_chat == "admin"){
            ?>
                <div class="direct-chat-info clearfix">
                    <span class="direct-chat-name pull-left"><?php if($row->nama_karyawan == ""){echo "Customer Service";} else { echo $row->nama_karyawan; };?></span>
                    <span class="direct-chat-timestamp pull-right"><?php echo $row->tanggal_chat;?></span>
                </div>
                <?php if($row->foto_karyawan == '') { ?>
                    <img class="direct-chat-img" src="<?php echo base_url('assets/img/banner/user.svg');?>" alt="Message User Image">
                <?php } else { ?>
                    <img class="direct-chat-img" src="<?php echo base_url('assets/img/karyawan/').$row->foto_karyawan;?>" alt="Message User Image" style="object-fit: cover;">
                <?php } ?>
                <div class="direct-chat-text"><?php echo $row->chat;?></div>
            
            
            <?php }elseif($row->pengirim_chat == "konsumen"){ ?>
            <div class="direct-chat-msg right">
                <div class="direct-chat-info clearfix">
                    <?php if($row->nama_konsumen == '') { ?>
                        <span class="direct-chat-name pull-right"><?php echo $row->nama_chat;?></span>
                    <?php } else { ?>
                        <span class="direct-chat-name pull-right"><?php echo $row->nama_konsumen;?></span>
                    <?php } ?>
                    <span class="direct-chat-timestamp pull-left"><?php echo $row->tanggal_chat;?></span>
                </div>
                <?php if($row->foto_konsumen == '') { ?>
                    <img class="direct-chat-img" src="<?php echo base_url('assets/img/banner/user.svg');?>" alt="Message User Image">
                <?php } else { ?>
                    <img class="direct-chat-img" src="<?php echo base_url('assets/img/konsumen/').$row->foto_konsumen;?>" alt="Message User Image"  style="object-fit: cover;">
                <?php } ?>
                <div class="direct-chat-text"><?php echo $row->chat;?></div>

            </div>
        <?php 
                    }
                }
    ?>
    </div>
    <form action="#" method="post">
        <div class="input-group">
            <textarea id="chat" placeholder="Ketik pesan" class="form-control" required></textarea>
            <span class="input-group-btn">
            <a type="button" href="#" class="btn btn-warning" id="btn_kirim_pesan">Kirim</a>
            </span>
        </div>
    </form>
</div>