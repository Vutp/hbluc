<div class="col-lg-12">
    <ol class="breadcrumb">
        <li class="cursor back">
            <i class="fa fa-arrow-left"></i>
        </li>
        <li>
            <a href="<?php echo base_url('trang_chu');?>">
                <i class="fa fa-home"></i> Trang chủ
            </a>
        </li>
    </ol><?php
   echo ' <h3 class="page-header marTop"><i class="fa fa-wechat"></i> Chat với '.$namevs.'</h3>';?>
</div><!-- /.col-lg-12 -->
<div class="col-md-9 col-lg-9 col-xs-12">
    <div class="chat-panel panel panel-default">
        <!-- /.panel-heading -->
        <div class="panel-body">
            <p class="text-center"><input type="submit" id="load_more" value="Tin nhắn cũ hơn"class="btn btn-info"></p>

            <div class="chat" id="messages_load_more"></div>
            <div class="chat"id="messages">
          <?php    
          $date_chat=date("Y-m-d", strtotime(' +7 day'));
          foreach ($query->result() as $row){
            if ($date_chat!=$row->date){
                $date_chat=$row->date;
                
                echo '<div class="dw"><span class="dt">'.$date_chat.'</span></div><br>';

                }
            if ($_SESSION['name_user']==$row->name) {
            echo' <div class="col-xs-12 col-md-12 col-lg-12 pad">
                    <div class="bubble you ">'.$row->message.'</div>
                </div>';
                        }else
             echo '<div class="col-xs-12 col-md-12 col-lg-12 pad"><span class="chat-img pull-left">
                <img src="'.base_url('upload/'.$avatarvs.'').'" 
                alt="User Avatar" class="img-circle size" /></span>
            <div class="bubble me">'.$row->message.'</div>
            </div>';
            }
        ?>
        </div>
        <div class="chat" id="messages_new"></div>
        
        </div>
        <div class="panel-footer">
        <form class="input-group" id="messageForm">
        <input id="messageInput" onClick="chatViewed();" type="text" class="form-control input-sm" placeHolder="Gõ tin nhắn ở đây" />
        <?php 

        $date_now = date("Y-m-d", strtotime(' -7 day'));
       // $week_now=$date_now->format('W');
        echo '<input type="hidden" id="week_back" value="'.$date_now.'">';
        echo '<input type="hidden" id="name_user" value="'.$_SESSION['name_user'].'" />';
        echo '<input type="hidden" id="vs" value="'.$vs.'" />'; 
        echo '<input type="hidden" id="avatar" value="'.$avatar.'" />';
        echo '<input type="hidden" id="chat_vs" value="'.$vs_data.'" />';
        echo '<input type="hidden" id="id_user" value="'.$_SESSION['id'].'" />';?>
        <span class="input-group-btn">
        <button class="btn btn-warning btn-sm" id="btn_send_mess"type="submit">
                             Gửi tin nhắn</button></span>
        </form>
        </div>
    </div>

        


</div>
    

