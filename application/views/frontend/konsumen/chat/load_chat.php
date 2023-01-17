
        <div class="direct-chat-messages">
            <?php 
                foreach($chat as $row) { 
                    if($row->pengirim_chat == "admin"){
            ?>
                <div class="direct-chat-msg">
                    <div class="direct-chat-infos clearfix">
                        <span class="direct-chat-name float-right"><?php if($row->nama_karyawan == ""){echo "Customer Service";} else { echo $row->nama_karyawan; };?></span>
                        <span class="direct-chat-timestamp float-left"><?php echo $row->tanggal_chat;?></span>
                    </div>
                    <?php if($row->foto_karyawan == '') { ?>
                        <img class="direct-chat-img" src="<?php echo base_url('assets/img/banner/user.svg');?>" alt="Message User Image">
                    <?php } else { ?>
                        <img class="direct-chat-img" src="<?php echo base_url('assets/img/karyawan/').$row->foto_karyawan;?>" alt="Message User Image" style="object-fit: cover;">
                    <?php } ?>
                    <div class="direct-chat-text"><?php echo nl2br($row->chat);?></div>
                </div>
            <?php }elseif($row->pengirim_chat == "konsumen"){ ?>
                <div class="direct-chat-msg right">
                    <div class="direct-chat-infos clearfix">
                        <span class="direct-chat-name float-right"><?php if($row->nama_konsumen == '') { echo $row->nama_chat; } else { echo $row->nama_konsumen; }?></span>
                        <span class="direct-chat-timestamp float-left"><?php echo $row->tanggal_chat;?></span>
                    </div>
                    <?php if($row->foto_konsumen == '') { ?>
                        <img class="direct-chat-img" src="<?php echo base_url('assets/img/banner/user.svg');?>" alt="Message User Image">
                    <?php } else { ?>
                        <img class="direct-chat-img" src="<?php echo base_url('assets/img/konsumen/').$row->foto_konsumen;?>" alt="Message User Image"  style="object-fit: cover;">
                    <?php } ?>
                    <div class="direct-chat-text"><?php echo nl2br($row->chat);?></div>
                </div>
            <?php 
                    }
                }
            ?>
        </div>  
        <div class="card-footer">
            <form action="#" method="post">
                <div class="input-group">
                    <textarea id="chat" placeholder="Ketik pesan ..." class="form-control" required></textarea>
                    <span class="input-group-append">
                    <button type="button" class="btn btn-warning" id="btn_kirim_pesan">Kirim</button>
                    </span>
                </div>
            </form>
        </div>