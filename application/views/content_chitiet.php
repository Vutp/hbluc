<div class="col-lg-12">
    <ol class="breadcrumb">
        <li class="cursor back">
            <i class="fa fa-arrow-left"></i>
        </li>
        <li>
            <a href="<?php echo base_url('trang_chu'); ?>"><i class="fa fa-home"></i> Trang chủ</a>
        </li>
        <li>
            <a href="<?php echo base_url('tu_phap'); ?>"><i class="fa fa-files-o"></i> Hành chính tư pháp</a>
        </li>
        <li>
            <?php
            $dataname=array('Chứng thực','Khai sinh','Khai tử','Kết hôn','Giám hộ','Hộ tịch','Các thủ tục còn lại','Tìm kiếm');
            if (($name<1)||($name>8))$name=7;
            echo '
            <a href="'.base_url('phan_muc/'.$name.'').'">
                <i class="fa fa-file-o"></i> '.$dataname[$name-1].'
            </a>
            ';?>
        </li>
    </ol>
    <h3 class="page-header marTop"><i class="fa fa-file-o"></i> <?php echo html_escape($node_map->node_name); ?></h3>

    <div class="panel panel-info">
        <div class="panel-heading">
            <h3 class="panel-title"><?php echo $data['h1']; ?></h3>
        </div>
        <div class="panel-body">
            <p><?php echo $trinh_tu_data; ?></p>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-md-12">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title"><?php echo $data['h2']; ?></h3>
                </div>
                <div class="panel-body">
                    <p><?php echo $thoi_gian_data; ?></p>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-md-12">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title"><?php echo $data['h3']; ?></h3>
                </div>
                <div class="panel-body">
                    <p><?php echo $cach_thuc_data; ?></p>
                </div>
            </div>
        </div>
    </div>
    <div class="panel panel-info">
        <div class="panel-heading">
            <h3 class="panel-title"><?php echo $data['h4']; ?></h3>
        </div>
        <div class="panel-body">

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><?php echo  $data['h4_1']; ?></h3>
                </div>
                <div class="panel-body">
                    <p><?php echo $thanh_phan_data; ?></p>
                </div>
            </div>

            <div class="panel panel-default marBot2">
                <div class="panel-heading">
                    <h3 class="panel-title"><?php echo $data['h4_2']; ?></h3>
                </div>
                <div class="panel-body">
                    <p><?php echo $thanh_phan_data_1; ?></p>
                </div>
            </div>

        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-md-12">
            <div class="panel panel-info ">
                <div class="panel-heading">
                    <h3 class="panel-title"><?php echo $data['h5']; ?></h3>
                </div>
                <div class="panel-body">
                    <p><?php echo $giai_quyet_data; ?></p>
                </div>
            </div>
        </div>

        <div class="col-xs-12 col-md-12">
            <div class="panel panel-info ">
                <div class="panel-heading">
                    <h3 class="panel-title"><?php echo $data['h6']; ?></h3>
                </div>
                <div class="panel-body">
                    <p><?php echo $doi_tuong_data; ?></p>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-md-12">
            <div class="panel panel-info ">
                <div class="panel-heading">
                    <h3 class="panel-title"><?php echo $data['h7']; ?></h3>
                </div>
                <div class="panel-body">
                    <p><?php echo $co_quan_data; ?></p>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-md-12">
            <div class="panel panel-info ">
                <div class="panel-heading">
                    <h3 class="panel-title"><?php echo $data['h8']; ?></h3>
                </div>
                <div class="panel-body">
                    <p><?php echo $ket_qua_data; ?></p>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-md-12">
            <div class="panel panel-info ">
                <div class="panel-heading">
                    <h3 class="panel-title"><?php echo $data['h9']; ?></h3>
                </div>
                <div class="panel-body">
                    <p><?php echo $le_phi_data; ?></p>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-md-12">
            <div class="panel panel-info ">
                <div class="panel-heading">
                    <h3 class="panel-title"><?php echo $data['h10']; ?></h3>
                </div>
                <div class="panel-body">
                    <p><?php

                        if(count($mau_don_array)==1){
                            if((strlen($mau_don_array[0])>7))
                            {
                                $mau_don_array[0] = trim(strip_tags($mau_don_array[0]));
                                $mau_don=str_replace("/","",$mau_don_array[0]);

                                $mau_don=str_replace(":","",$mau_don);
                                echo'+ <a href="'.base_url().'read/read_file/'.$mau_don.'"
                        target="_blank">'.$mau_don_array[0].'</a>';
                            }else{
                                echo $mau_don_array[0];
                            }
                        }else{
                            for ($i=1;$i<count($mau_don_array);$i++){
                                $mau_don_array[$i] = trim(strip_tags($mau_don_array[$i]));
                                $mau_don=str_replace("/","",$mau_don_array[$i]);

                                $mau_don=str_replace(":","",$mau_don);
                                echo'+ <a href="'.base_url().'read/read_file/'.$mau_don.'"
                        target="_blank">'.$mau_don_array[$i].'</a>';
                                if ($i+1!=count($mau_don_array) )echo '<br>';
                            }
                        }

                        ?></p>
                </div>
            </div>
        </div>
    </div>

    <div class="panel panel-info">
        <div class="panel-heading">
            <h3 class="panel-title"><?php echo $data['h11']; ?></h3>
        </div>
        <div class="panel-body">
            <p><?php echo $yeu_cau_data; ?></p>
        </div>
    </div>

    <div class="panel panel-info">
        <div class="panel-heading">
            <h3 class="panel-title"><?php echo $data['h12']; ?></h3>
        </div>
        <div class="panel-body">
            <p><?php echo $can_cu_data; ?></p>
        </div>
    </div>
</div><!-- /.col-lg-12 -->

