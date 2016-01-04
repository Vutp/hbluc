<div class="col-lg-12">
    <ol class="breadcrumb">
        <li class="cursor back">
            <i class="fa fa-arrow-left"></i>
        </li>
        <li>
            <a href="<?php echo base_url('trang_chu'); ?>"><i class="fa fa-home"></i> Trang chủ</a>
        </li>
    </ol>
    <h3 class="page-header marTop"><i class="fa fa-user"></i></i> <?php
            echo 'Thông tin cá nhân '.$query->row(1)->name.'';?></h3>
</div>
<div class="panel-body">
    <div class="row">
        <div class="col-md-12 col-md-3 col-lg-3 " align="center" >
        <?php
        echo'<img alt="User Pic" src="'. base_url('upload/'.$query->row(1)->avatar.'').'"
        class="img-circle img-responsive"> ';
       ?>
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
                                </tr>

                                <tr><td>Tên đăng nhập</td>
                                <td>'.$row->name.'</td>
                                </tr>

								<tr><td>Mật khẩu </td>
                                <td>****** </td>
                                </tr>

                                <tr><td ><span class="glyphicon glyphicon-penci"></span>Sinh nhật</td>
                                <td>'.$row->ngay_sinh.'</td>
                                </tr>

                                <tr><td>CMND</td>
                                <td>'.$row->cmnd.'</td>
                                <td> </button> </td>
                                </tr>

                               <tr><td>Địa chỉ</td>
                                <td>'.$row->dia_chi.'</td>

                                </tr>
                               <tr><td>Số điện thoại</td>
                                <td>'.$row->Sdt.'</td>

                                </tr>
                                <tr><td>Vị trí</td>
                                <td>'.$vitri.'</td>
                                <td></td>
                                </tr>';
                        }?>

                        </tbody>
                    </table>
                </div>

            </div>
        </div>
</div>
