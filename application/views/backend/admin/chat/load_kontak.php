<div class=" contacts-list nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
    <?php
        foreach($chat->result() as $row) { 
        $status_chat = $row->status_chat;
    ?>      
    <a class="nav-link" id="btn_kontak" data-toggle="pill" href="#vert-tabs-home" role="tab" aria-controls="vert-tabs-home" aria-selected="true"  id_konsumen = "<?php echo $row->id_konsumen; ?>" nama_chat = "<?php echo $row->nama_chat; ?>" kontak_chat = "<?php echo $row->kontak_chat; ?>" foto_konsumen = "<?php echo $row->foto_konsumen; ?>" >

        <?php if($row->foto_konsumen != "") { ?>
            <img class="contacts-list-img" alt="image" src="<?php echo base_url('assets/img/konsumen/'.$row->foto_konsumen);?>" style="width:40px; height:40px; object-fit: cover;">
        <?php }else{ ?>
            <img class="contacts-list-img" alt="image" src="<?php echo base_url('assets/img/banner/user.svg.');?>" style="width:40px; height:40px; object-fit: cover; background-color:white; border:1px solid #ced4da;">
        <?php } ?> 
        <div class="contacts-list-info">
            <span class="contacts-list-name <?php if($status_chat == 1){ echo 'text-danger'; } else { echo 'text-dark'; }?>">
                <?php echo $row->nama_chat;
                    if($row->id_konsumen != "") { 
                        echo '<span class="badge badge-primary">Konsumen</span>';
                    }
                ?>
                <small class="contacts-list-date float-right <?php if($status_chat == 1){ echo 'text-danger'; } else { echo 'text-dark'; }?>" ><?php echo $row->tanggal_chat;?></small><br>
                <?php 
                    if($status_chat == 1){
                        echo '<span class="badge badge-danger float-right"> B </span>';
                    } 
                ?>
            </span>
            <span class="contacts-list-msg <?php if($status_chat == 1){ echo 'text-danger'; } else { echo 'text-dark'; }?>"><?php echo mb_strimwidth($row->chat, 0, 30, "...")?></span>
        
        </div>
    </a>
    <?php } ?>
</div>