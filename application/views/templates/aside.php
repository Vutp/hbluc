<div class="navmenu navbar-default sidebar navmenu-fixed-left offcanvas-sm">
    <a class="navmenu-brand sidebar-nav visible-md visible-lg center" href="<?php echo base_url(); ?>">
        <img src="<?php echo base_url('img/logo.ico') ;?>" alt="">
        <p class="brand">UBND HUYỆN BẾN LỨC</p>
    </a>
    <ul class="nav navmenu-nav" id="side-menu">
        <li class="sidebar-search">
            <form  role="search" method="post"action="<?php echo base_url();?>phan_muc/8">
            <div class="input-group custom-search-form">
                <input type="text" class="form-control"name ="key_search" placeholder="Gõ tên giấy tờ">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="button">
                            <i class="fa fa-search"></i>
                        </button>
                    </span>
            </div><!-- /input-group -->
            </form>
        </li>
        <li class="sidebar-search">
            <form role="search" method="post"action="<?php echo base_url();?>admin/xem_ho_so">
            <div class="input-group custom-search-form">
                <input type="text" class="form-control"name ="num_search" placeholder="Gõ mã hồ sơ">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="button">
                            <i class="fa fa-search"></i>
                        </button>
                    </span>
            </div><!-- /input-group -->
            </form>
        </li>
        <li>
            <a href="<?php echo base_url('tu_phap'); ?>"><i class="fa fa-files-o fa-fw"></i> Hành chính tư pháp<span class="fa arrow"></span></a>
            <ul class="nav nav-second-level">
                <li>
                    <a href="<?php echo base_url('phan_muc/1');?>"><i class="fa fa-file-o fa-fw"></i> Chứng thực</a>
                </li>
                <li>
                    <a href="<?php echo base_url('phan_muc/2');?>"><i class="fa fa-file-o fa-fw"></i> Khai sinh</a>
                </li>
                <li>
                    <a href="<?php echo base_url('phan_muc/3');?>"><i class="fa fa-file-o fa-fw"></i> Khai tử</a>
                </li>
                <li>
                    <a href="<?php echo base_url('phan_muc/4');?>"><i class="fa fa-file-o fa-fw"></i> Kết hôn</a>
                </li>
                <li>
                    <a href="<?php echo base_url('phan_muc/5');?>"><i class="fa fa-file-o fa-fw"></i> Giám hộ</a>
                </li>
                <li>
                    <a href="<?php echo base_url('phan_muc/6');?>"><i class="fa fa-file-o fa-fw"></i> Hộ tịch</a>
                </li>
                <li>
                    <a href="<?php echo base_url('phan_muc/7');?>"><i class="fa fa-file-o fa-fw"></i> Các thủ tục còn lại</a>
                </li>
            </ul><!-- /.nav-second-level -->
        </li>
        <li>
            <a href="<?php echo base_url('dat_dai'); ?>"><i class="fa fa-files-o fa-fw"></i> Hành chính đất đai</a>
        </li>
        <?php 
        if (!isset($_SESSION['name_user'])){

        echo'
        <li>
            <a href="'. base_url('admin/admin').'"><i class="fa fa-user fa-fw"></i> Đăng nhập</a>
        </li>';}
        /*For badge*/



        if((isset($_SESSION['name_user']))&&
            (($_SESSION['level']==11)||($_SESSION['level']==12))){
            $mcb = $_SESSION['ma_can_bo'];
            $where1 = " ma_can_bo_nhan = '$mcb' AND status = 1 ";
            $where2 = " ma_can_bo_nhan = '$mcb' AND status = 2 ";
            $where = "$where1 OR $where2";
            echo '<li><a href="'.base_url('admin/admin_tiep_nhan').'">
                  <i class="fa fa-files-o fa-fw"></i> Hồ sơ đã nhận <span class="badge right">'.$this->db->where('status',0)->where('mcb',($_SESSION['ma_can_bo']))->count_all_results('ho_so').'</span></a></li>';
            if($_SESSION['level']==11){
                echo '<li><a href="'.base_url('admin/nhan_viec').'">
                  <i class="fa fa-list-ol fa-fw"></i> Công việc được giao<span class="badge right">'.$this->db->where($where)->count_all_results('calendar').'</span></a></li>';
                echo '<li><a href="'.base_url('admin/phan_cong').'">
                  <i class="fa fa-calendar fa-fw"></i> Lịch của tôi</a></li>';
            }

        }
        if((isset($_SESSION['name_user']))&&($_SESSION['level']==21)){
            $mcb = $_SESSION['ma_can_bo'];
            $where1 = " ma_can_bo_nhan = '$mcb' AND status = 1 ";
            $where2 = " ma_can_bo_nhan = '$mcb' AND status = 2 ";
            $where = "$where1 OR $where2";
            echo '<li><a href="'.base_url('admin/admin_phong_ban').'">
                  <i class="fa fa-files-o fa-fw"></i> Hồ sơ xử lý <span class="badge right">'.$this->db->where('status',1)->where('type', 0)->or_where('status', 2)
                 ->where('mcb',($_SESSION['ma_can_bo']))->count_all_results('ho_so').'</span></a></li>';
            echo '<li><a href="'.base_url('admin/giao_viec').'">
                  <i class="fa fa-tasks fa-fw"></i> Giao công việc</a></li>';
            echo '<li><a href="'.base_url('admin/viec_da_giao').'">
                  <i class="fa fa-tasks fa-fw"></i> Công việc đã giao<span class="badge right">'.$this->db->where('ma_can_bo_giao',$_SESSION['ma_can_bo'])->count_all_results('calendar').'</span></a></li>';
            echo '<li><a href="'.base_url('admin/nhan_viec').'">
                  <i class="fa fa-list-ol fa-fw"></i> Công việc được giao<span class="badge right">'.$this->db->where($where)->count_all_results('calendar').'</span>  </a></li>';
            echo '<li><a href="'.base_url('admin/phan_cong').'">
                  <i class="fa fa-calendar fa-fw"></i> Lịch của tôi</a></li>';
            echo '<li><a href="'.base_url('admin/thong_ke').'">
                  <i class="fa fa-bar-chart-o  fa-fw"></i> Thống kê</a></li>';
        }
        if((isset($_SESSION['name_user']))&&($_SESSION['level']==22)){
            $mcb = $_SESSION['ma_can_bo'];
            $where1 = " ma_can_bo_nhan = '$mcb' AND status = 1 ";
            $where2 = " ma_can_bo_nhan = '$mcb' AND status = 2 ";
            $where = "$where1 OR $where2";
            echo '<li><a href="'.base_url('admin/admin_phong_ban').'">
                  <i class="fa fa-files-o fa-fw"></i> Hồ sơ xử lý<span class="badge right">'.$this->db->where('status',1)->where('type', 1)->or_where('status', 2)
                 ->where('mcb',($_SESSION['ma_can_bo']))->count_all_results('ho_so').'</span></a></li>';
            echo '<li><a href="'.base_url('admin/giao_viec').'">
                  <i class="fa fa-tasks fa-fw"></i> Giao công việc</a></li>';
            echo '<li><a href="'.base_url('admin/viec_da_giao').'">
                  <i class="fa fa-tasks fa-fw"></i> Công việc đã giao<span class="badge right">'.$this->db->where('ma_can_bo_giao',$_SESSION['ma_can_bo'])->count_all_results('calendar').'</span></a></li>';
            echo '<li><a href="'.base_url('admin/nhan_viec').'">
                  <i class="fa fa-list-ol fa-fw"></i> Công việc được giao<span class="badge right">'.$this->db->where($where)->count_all_results('calendar').'</span></a></li>';
            echo '<li><a href="'.base_url('admin/phan_cong').'">
                  <i class="fa fa-calendar fa-fw"></i> Lịch của tôi</a></li>';
            echo '<li><a href="'.base_url('admin/thong_ke').'">
                  <i class="fa fa-bar-chart-o  fa-fw"></i> Thống kê</a></li>';
        }


        if((isset($_SESSION['name_user']))&&
            (($_SESSION['level']==13)||($_SESSION['level']==12))){
            $mcb = $_SESSION['ma_can_bo'];
            $where1 = " ma_can_bo_nhan = '$mcb' AND status = 1 ";
            $where2 = " ma_can_bo_nhan = '$mcb' AND status = 2 ";
            $where = "$where1 OR $where2";
            echo '<li><a href="'.base_url('admin/admin_tra_ho_so').'">
                  <i class="fa fa-files-o fa-fw"></i> Hồ sơ trả dân<span class="badge right">'.$this->db->where('status',3)->or_where('status',4)->or_where('status',6)->or_where('status',7)->where('mcb',($_SESSION['ma_can_bo']))->count_all_results('ho_so').'</span></a></li>';
            echo '<li><a href="'.base_url('admin/nhan_viec').'">
                  <i class="fa fa-list-ol fa-fw"></i> Công việc được giao<span class="badge right">'.$this->db->where($where)->count_all_results('calendar').'</span></a></li>';
            echo '<li><a href="'.base_url('admin/phan_cong').'">
                  <i class="fa fa-calendar fa-fw"></i> Lịch của tôi</a></li>';
            echo '<li><a href="'.base_url('admin/thong_ke').'">
                  <i class="fa fa-bar-chart-o fa-fw"></i> Thống kê</a></li>';
        }
        if((isset($_SESSION['name_user']))&&
            ($_SESSION['level']==4)){
            echo '<li><a href="'.base_url('admin/add').'">
                  <i class="fa fa-plus fa-fw"></i> THÊM MỤC</a></li>';
            echo ' <li><a href="'.base_url('admin/edit').'">
                     <i class="fa fa-pencil fa-fw"></i> SỬA MỤC</a></li>';
        }
        if((isset($_SESSION['name_user']))&&
            ($_SESSION['level']==100))
        {
            echo '<li><a href="'.base_url('admin/quan_ly_nhan_su').'">
                  <i class="fa fa-users fa-fw"></i> Quản lý nhân sự</a></li>';
            echo '<li><a href="'.base_url('admin/giao_viec').'">
                  <i class="fa fa-tasks fa-fw"></i> Giao công việc</a></li>';
            echo '<li><a href="'.base_url('admin/viec_da_giao').'">
                  <i class="fa fa-tasks fa-fw"></i> Công việc đã giao<span class="badge right">'.$this->db->where('ma_can_bo_giao',$_SESSION['ma_can_bo'])->count_all_results('calendar').'</span></a></li>';
            echo '<li><a href="'.base_url('admin/giai_quyet_ho_so').'">
                  <i class="fa fa-tasks fa-fw"></i> Tình hình giải quyết hồ sơ</a></li>';
            echo '<li><a href="'.base_url('admin/thong_ke').'">
                  <i class="fa fa-bar-chart-o fa-fw"></i> Thống kê</a></li>';
        }
        if (isset($_SESSION['name_user']))
        {
            echo '
            <li>
                <a href="#"><i class="fa fa-user fa-fw"></i>
                '.$_SESSION['name_user'].'<span class="fa arrow"></span>
                </a>
            <ul class="nav nav-second-level">
                <li><a href="'.base_url('admin/profile').'"><i class="fa fa-user fa-fw"></i> Trang cá nhân</a>
                <li><a href="'.base_url('admin/admin/logout').'"><i class="fa fa-sign-out fa-fw"></i> Thoát</a>
                </li>
            </ul>
            </li>
                      ';
        }
        ?>

    </ul>
</div>
