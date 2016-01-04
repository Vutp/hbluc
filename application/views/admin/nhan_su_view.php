<div class="col-lg-12">
    <ol class="breadcrumb">
        <li class="cursor back">
            <i class="fa fa-arrow-left"></i>
        </li>
        <li>
            <a href="<?php echo base_url('trang_chu'); ?>"><i class="fa fa-home"></i> Trang chủ</a>
        </li>
    </ol>
    <h3 class="page-header marTop"><i class="fa fa-file-o"></i> Quản lý nhân sự</h3>


<?php 
    echo form_open(''.base_url('admin/quan_ly_nhan_su/add_nhan_su').'');?>
        <div class="panel panel-info">
        <div class="panel-heading">
        <h3 class="panel-title">Thêm nhân sự</h3>
        </div>
        <div class="panel-body">
<table class="table">
    <tr>    
        <td>Họ và Tên</td>
        <td><?php 
        $data1 = array(
              'name'=>"hoten",'type'=>"text" ,
              'cols' => "40",'rows' => '1','placeholder'=>"Nhập họ tên");
        $data2 = array(
              'name'=>"name",'type'=>"text" ,
              'cols' => "40",'rows' => '1','placeholder'=>"Nhập tên đăng nhập");
        $data3 = array(
              'name'=>"mcb",'type'=>"text" ,
              'cols' => "40",'rows' => '1','placeholder'=>"Nhập mã cán bộ");        
        echo form_textarea($data1);?></td>
        <td><?php echo form_error('hoten'); ?></td>
    </tr>   
    <tr>    
        <td>Tên đăng nhập</td>
        <td><?php echo
        form_textarea($data2);?></td> 
        <td><?php echo form_error('name'); ?></td>

    </tr>
    <tr>    
        <td>Mật khẩu</td>
        <td>mypass</td> 


    </tr>
    <tr>    
        <td>Nhập mã cán bộ</td>
        <td><?php echo
        form_textarea($data3);?></td>
        <td><?php echo form_error('mcb'); ?></td>
    </tr>
    <tr>    
    <td>Vị trí</td>  
    <td> <select name= "vitri"id="testselectset"class="bg-primary"style="font-size:15px;">
      <?php  $d = array(
             '11'=>'Tiếp nhận Hồ sơ',
             '12'=>'Tiếp nhận và trả Hồ sơ',
             '13'=>'Trả Hồ sơ',
             '21'=>'Phòng ban Tư Pháp',
             '22'=>'Phòng ban Đất đai',

            );
      foreach ($d as $stt =>$id) {
          echo '<option class="testselectset" value="'.html_escape($stt).'">'.html_escape($id).'</option>';


      }
      ?></td></tr>
    </select>
    <tr>    
        <td></td>
        <td><?php 
        $data = array(
             'node_id'=>'',
             'p_id'=>''

            );

        echo form_hidden($data);
 
        echo form_submit('submit','Thêm nhân sự','class="btn btn-success"');?></td>
        <td></td>
    </tr>
</table>
</div></div>
<?php if (isset($error))
    echo "<div class='alert alert-danger' role='alert'>$error</div>";
    echo form_close('');?>

       <?php     
          $this->user->view($query,'Tiếp nhận Hồ sơ');
          $this->user->view($query,'Tiếp nhận và trả Hồ sơ');
          $this->user->view($query,'Trả Hồ sơ');
          $this->user->view($query,'Phòng ban Tư Pháp');
          $this->user->view($query,'Phòng ban Đất đai');
            if (isset($error)){
              echo '<tr><td></td><td class="error">'.$error.'</td></tr>';
                    }
            ?>




            </div>
        </div>
    </div>        
</div>
