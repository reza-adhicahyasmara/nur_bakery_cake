<div class="direct-chat-messages" style="height: 100%;">
    <div class="box-body">
        <ul class="contacts-list">
            <li>
                <div class="row">
                    <div class="p-2"> 
                        <?php if($foto_konsumen != "") { ?>
                            <img class="contacts-list-img" alt="image" src="<?php echo base_url('assets/img/konsumen/'.$foto_konsumen);?>" style="width:70px; height:70px; object-fit: cover;">
                        <?php }else{ ?>
                            <img class="contacts-list-img" alt="image" src="<?php echo base_url('assets/img/banner/user.svg');?>" style="width:70px; height:70px; object-fit: cover; background-color:white; border:1px solid #ced4da;">
                        <?php } ?> 
                    </div>
                    <div class="p-2"> 
                        <span class="text-dark text-lg"><?php echo $nama_chat;?></span>
                        <br>
                        <span class="text-dark text-md"><?php echo $kontak_chat;?></span>
                    </div>

                </div>
            </li>
        </ul>
        <hr>

        <?php 
            foreach($chat as $row) { 
                if($row->pengirim_chat == "admin"){
        ?>
            <div class="direct-chat-msg right">
                <div class="direct-chat-text text-right float-right" style="margin-right: 1px;">
                    <div class="row">
                        <div class="ml-2 mr-2">
                            <span><?php echo nl2br($row->chat);?></span>
                        </div>
                        <div class="mt-1 ml-2">
                            <small><?php echo $row->tanggal_chat;?></small>
                        </div>
                    </div>
                </div>
            </div>
        <?php }elseif($row->pengirim_chat == "konsumen"){ ?>
            <div class="direct-chat-msg">
                <div class="direct-chat-text text-left float-left" style="margin-left: 1px;">
                    <div class="row">
                        <div class="ml-2 mr-2">
                            <span><?php echo nl2br($row->chat);?></span>
                        </div>
                        <div class="mt-1 ml-2">
                            <small><?php echo $row->tanggal_chat;?></small>
                        </div>
                    </div>
                </div>
            </div>
        <?php 
                    }
                }
        ?>
    </div>
</div>
<form action="#" method="post">
    <div class="input-group">
        <input type="hidden" class="id_konsumen" id="id_konsumen" value="<?php echo $id_konsumen;?>" />
        <input type="hidden" class="nama_chat" id="nama_chat" value="<?php echo $nama_chat;?>" />
        <input type="hidden" class="kontak_chat" id="kontak_chat" value="<?php echo $kontak_chat;?>" />
        <input type="hidden" class="foto_konsumen" id="foto_konsumen" value="<?php echo $foto_konsumen;?>" />
        <textarea  class="form-control" id="chat" placeholder="Ketik pesan" require style="height: 50px"></textarea>
        <span class="input-group-btn">
            <a type="button" href="#" class="btn btn-warning" id="btn_kirim_pesan" style="height: 50px">Kirim</a>
        </span>
    </div>
</form>
