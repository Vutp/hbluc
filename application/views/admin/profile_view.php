<div class="col-lg-12">
    <ol class="breadcrumb">
        <li class="cursor back">
            <i class="fa fa-arrow-left"></i>
        </li>
        <li>
            <a href="<?php echo base_url('trang_chu'); ?>"><i class="fa fa-home"></i> Trang chủ</a>
        </li>
    </ol>
    <h3 class="page-header marTop"><i class="fa fa-user"></i> Trang cá nhân</h3>
</div>
<div class="panel-body">
    <div class="row">
        <div class="col-md-12 col-md-3 col-lg-3 " align="center" >
        <?php 
        echo'<img alt="User Pic" src="'. base_url('upload/'.$query->row(1)->avatar.'').'" 
        class="img-circle img-responsive"> ';
     
        echo form_open_multipart(''.base_url('admin/Profile/check_upload').'');

        echo '<input type="file" name="userfile" size="20"  />';
        echo '<input type="submit" value="Đổi ảnh đại điện" />';
       ?>
       </form>
        </div>
            <div class="col-md-12 col-md-9 col-lg-9 ">
                <div class="table-responsive">
                    <table class="table table-border">
                        <tbody>


                        <?php
                        foreach ($query->result() as $row){
                            if ($row->level==11)$vitri='Tiếp nhận Hồ sơ';
                            else if ($row->level==12)$vitri='Tiếp nhận và trả Hồ sơ';
                            else if ($row->level==13)$vitri='Trả Hồ sơ';
                            else if ($row->level==21)$vitri='Phòng ban Tư Pháp';
                            else if ($row->level==22)$vitri='Phòng ban Đất đai';
                            else   $vitri='Quản trị';
                            echo '<tr><td>Họ và tên</td>
                                <td>'.$row->hoten.'</td>
                                <td><button type="button" class="btn btn-info" data-toggle="modal"
                                                data-target="#changeName"><span class="glyphicon glyphicon-pencil"></span>Thay đổi</button> </td>
                                </tr>

                                <tr><td>Tên đăng nhập</td>
                                <td>'.$row->name.'</td>
                                <td><button type="button" class="btn btn-info" data-toggle="modal"
                                                data-target="#doiname"><span class="glyphicon glyphicon-pencil"></span>Thay đổi</button> </td>
                                </tr>

								<tr><td>Mật khẩu </td>
                                <td>****** </td>
                                <td><button type="button" class="btn btn-info" data-toggle="modal"
                                                data-target="#doipass"><span class="glyphicon glyphicon-pencil"></span>Thay đổi</button> </td>
                                </tr>

                                <tr><td ><span class="glyphicon glyphicon-penci"></span>Sinh nhật</td>
                                <td>'.$row->ngay_sinh.'</td>
                                <td><button type="button" class="btn btn-info" data-toggle="modal"data-target="#changeBirthdate"><span class="glyphicon glyphicon-pencil"></span>Thay đổi</button> </td>
                                </tr>

                                <tr><td>CMND</td>
                                <td>'.$row->cmnd.'</td>
                                <td> </button> </td>
                                </tr>

                               <tr><td>Địa chỉ</td>
                                <td>'.$row->dia_chi.'</td>
                                <td><button type="button" class="btn btn-info" data-toggle="modal"
                                                data-target="#changeAddress"><span class="glyphicon glyphicon-pencil"></span>Thay đổi</button> </td>
                                </tr>
                               <tr><td>Số điện thoại</td>
                                <td>'.$row->Sdt.'</td>
                                <td><button type="button" class="btn btn-info" data-toggle="modal"
                                                data-target="#changePhoneNo "><span class="glyphicon glyphicon-pencil"></span>Thay đổi</button> </td>
                                </tr>
                                <tr><td>Vị trí</td>
                                <td>'.$vitri.'</td>
                                <td></td>
                                </tr>';
                        }?>

                       <?php
                        if (isset($error)){
                            echo '<tr><div class="alert alert-danger" role="alert">'.$error.'</div></tr>';


                        }?>

                        </tbody>
                    </table>
                </div>

            </div>
        </div>
</div>

    <!-- Modal -->
    <div class="modal fade" id="doipass" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Đổi mật khẩu</h4>
                </div>
                <div class="modal-body">
                    <?php echo form_open(''.base_url('admin/profile/change_pass').'');?>
                    <table class="table">
                        <?php
                        $data1 = array(
                            'name'=>"old",'type'=>"password" ,
                            'size'  => '38','placeholder'=>"Nhập mật khẩu cũ");
                        $data2 = array(
                            'name'=>"new",'type'=>"password" ,
                            'size'  => '38','placeholder'=>"Nhập mật khẩu mới");
                        $data3 = array(
                            'name'=>"renew",'type'=>"password" ,
                            'size'  => '38','placeholder'=>"Nhập lại mật khẩu");
                        $data = array(
                            'error'=>'sai',
                            'error'=>'sai',

                        );

                        echo form_hidden($data);
                        ?>

                        <tr>
                            <td>Mật khẩu cũ</td>
                            <td><?php echo
                                form_password($data1);?></td>

                        </tr>
                        <tr>
                            <td>Mật khẩu mới</td>
                            <td><?php echo
                                form_password($data2);?></td>

                        </tr>
                        <tr>
                            <td>Nhập lại mật khẩu mới</td>
                            <td><?php echo
                                form_password($data3);?></td>

                        </tr>
                        <tr>
                            <td></td>
                            <td><?php echo
                                form_submit('submit','Đổi mật khẩu','class="btn btn-primary"');?></td>
                        </tr>
                    </table>
                    <?php
                    echo form_close('');?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="changeBirthdate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Đổi ngày sinh </h4>
                </div>
                <div class="modal-body">
                    <?php echo form_open(''.base_url('admin/profile/change_info_birthdate').'');?>
                    <table class="table">
                        <?php
                        $data1 = array(
                            'name'=>'ngay_sinh','type'=>"text" ,
                            'size'  => '38','placeholder'=>"Nhập ngày sinh  mới");
                        ?>

                        <tr>
                            <td>Nhập ngày  mới</td>
                            <td><?php echo
                                form_input($data1);?></td>

                        </tr>

                        <tr>
                            <td></td>
                            <td><?php echo
                                form_submit('submit','Đổi ngày sinh','class="btn btn-primary"');?></td>
                        </tr>
                    </table>
                    <?php
                    echo form_close('');?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="changePhoneNo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Đổi số điện  thoại </h4>
                </div>
                <div class="modal-body">
                    <?php echo form_open(''.base_url('admin/profile/change_info_phoneno').'');?>
                    <table class="table">
                        <?php
                        $data1 = array(
                            'name'=>'Sdt','type'=>"text" ,
                            'size'  => '38','placeholder'=>"Nhập số điện thoại   mới");
                        ?>
                        <tr>
                            <td>Nhập số điện thoại mới</td>
                            <td><?php echo
                               form_input($data1);?></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><?php echo
                                form_submit('submit','Đổi số điện thoại ','class="btn btn-primary"');?></td>
                        </tr>
                    </table>
                    <?php
                    echo form_close('');?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="changeName" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Đổi Tên</h4>
                </div>
                <div class="modal-body">
                    <?php echo form_open(''.base_url('admin/profile/change_info_name').'');?>
                    <table class="table">
                        <?php
                        $data1 = array(
                            'name'=>'hoten','type'=>"text" ,
                            'size'  => '38','placeholder'=>"Nhập tên mới");
                        ?>

                        <tr>
                            <td>Nhập tên mới</td>
                            <td><?php echo
                                form_input($data1);?></td>

                        </tr>

                        <tr>
                            <td></td>
                            <td><?php echo
                                form_submit('submit','Đổi tên','class="btn btn-primary"');?></td>
                        </tr>
                    </table>
                    <?php
                    echo form_close('');?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="doiname" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Đổi tên đăng nhập </h4>
                </div>
                <div class="modal-body">
                    <?php echo form_open(''.base_url('admin/profile/change_name').'');?>
                    <table class="table">
                        <?php
                        $data1 = array(
                            'name'=>"namenew",'type'=>"text" ,
                            'size'  => '38','placeholder'=>"Nhập tên mới");
                        ?>

                        <tr>
                            <td>Nhập tên mới</td>
                            <td><?php echo
                                form_input($data1);?></td>

                        </tr>

                        <tr>
                            <td></td>
                            <td><?php echo
                                form_submit('submit','Đổi tên đăng nhập','class="btn btn-primary"');?></td>
                        </tr>
                    </table>
                    <?php
                    echo form_close('');?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="changeBirthday" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Đổi Tên</h4>
                </div>
                <div class="modal-body">
                    <?php echo form_open(''.base_url('admin/profile/changeBirthday').'');?>
                    <table class="table">
                        <?php
                        $data1 = array(
                            'name'=>"newBirthday",'type'=>"text" ,
                            'size'  => '38','placeholder'=>"Nhập ngày sinh   mới");
                        ?>

                        <tr>
                            <td>Nhập địa chỉ  mới</td>
                            <td><?php echo
                                form_input($data1);?></td>

                        </tr>

                        <tr>
                            <td></td>
                            <td><?php echo
                                form_submit('submit','Đổi ngày sinh ','class="btn btn-primary"');?></td>
                        </tr>
                    </table>
                    <?php
                    echo form_close('');?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="changeAddress" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Đổi địa chỉ</h4>
                </div>
                <div class="modal-body">
                    <?php echo form_open(''.base_url('admin/profile/change_info_address').'');?>
                    <table class="table">
                        <?php
                        $data1 = array(
                            'name'=>"dia_chi",'type'=>"text" ,
                            'size'  => '38','placeholder'=>"Nhập địa chỉ  mới");
                        ?>

                        <tr>
                            <td>Nhập địa chỉ  mới</td>
                            <td><?php echo
                                form_input($data1);?></td>

                        </tr>

                        <tr>
                            <td></td>
                            <td><?php echo
                                form_submit('submit','Đổi địa chỉ ','class="btn btn-primary"');?></td>
                        </tr>
                    </table>
                    <?php
                    echo form_close('');?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="doithongtin" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Thay đổi thông tin  </h4>
                </div>
                <div class="modal-body">
                    <?php echo form_open(''.base_url('admin/profile/change_info').'');?>
                    <table class="table">
                        <?php
                        $data1 = array(
                            'name'=>"hoten",'type'=>"text" ,
                            'size'  => '38','placeholder'=>"Nhập họ và tên mới(bắt buộc)");
                        $data2 = array(
                            'name'=>"ngay_sinh",'type'=>"text" ,
                            'size'  => '38','placeholder'=>"Nhập ngày tháng năm sinh mới(bắt buộc) ");
                        $data3 = array(
                            'name'=>"dia_chi",'type'=>"text" ,
                            'size'  => '38','placeholder'=>"Nhập địa chỉ mới(bắt buộc)");
                        $data4 = array(
                            'name'=>"Sdt",'type'=>"text" ,
                            'size'  => '38','placeholder'=>"Nhập số điện thoại mới(bắt buộc) ");
                        $data = array(
                            'error'=>'sai',
                            'error'=>'sai',

                        );

                        echo form_hidden($data);
                        ?>

                        <tr>
                            <td>Họ và tên </td>
                            <td><?php echo
                                form_input($data1);?></td>

                        </tr>
                        <tr>
                            <td>Sinh nhật </td>
                            <td><?php echo
                                form_input($data2);?></td>

                        </tr>
                        <tr>
                            <td>Địa chỉ </td>
                            <td><?php echo
                                form_input($data3);?></td>

                        </tr>

                        <tr>
                            <td>Số điện thoại </td>
                            <td><?php echo
                                form_input($data4);?></td>

                        </tr>

                        <tr>
                            <td></td>
                            <td><?php echo
                                form_submit('submit','Thay đổi thông tin','class="btn btn-danger"');?></td>
                        </tr>
                    </table>
                    <?php
                    echo form_close('');?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                </div>
            </div>
        </div>
    </div>



