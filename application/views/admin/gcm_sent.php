<div class="col-lg-12">
    <ol class="breadcrumb">
        <li class="cursor back">
            <i class="fa fa-arrow-left"></i>
        </li>
        <li class="active">
            <i class="fa fa-home"></i> Trang chủ
        </li>
    </ol>
    <h3 class="page-header marTop"><i class="fa fa-file-o"></i> Thủ tục</h3>
</div><!-- /.col-lg-12 -->
<div class="col-lg-9">
    <div class="row">
        <div class="masonry">
            <div class="col-xs-6 col-md-6 thumbnail">
        <?php 
			$attributes = array('class'=>'form-signin');
			echo form_open(''.base_url().'admin/Gcm/xu_ly_noti', $attributes);?>
           
            <select name= "name_select" class="bg-primary col-sm-10">
            <?php  
            foreach ($query->result() as $row) {
                    echo '<option value="'.$row->cmnd.'">'.$row->cmnd.'</option>';
            }?>
            </select>
            <input class="form-control" placeholder="Mật khẩu" name="message" type="textarea" value="">
            <input name="submit" value="Đăng nhập" class="btn btn-lg btn-success btn-block" type="submit">
            <?php echo form_close('');?>
            </div> 
        </div>
    </div>
</div>