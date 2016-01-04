<div class="col-lg-12">
<ol class="breadcrumb">
    <li class="cursor back">
        <i class="fa fa-arrow-left"></i>
    </li>
    <li>
        <a href="<?php echo base_url(); ?>">
            <i class="fa fa-home"></i> Trang chủ
        </a>
    </li>
</ol>
<h3 class="page-header marTop"><i class="fa fa-file-o"></i> Tình hình giải quyết hồ sơ</h3>
<div class="Ying main-box no-header clearfix">
    <div class="main-box-body clearfix">
        <div class="table-responsive">
            <table class="Ying table user-list">
                <thead>
                <tr >
                    <th ><span>Cán bộ</span></th>
                    <th>Số lần xử lý hồ sơ</th>
                    <th>Số lần xử lý thành công</th>
                    <th>Số lần lỗi</th>
                    <th>Tỉ lệ giải quyết hồ sơ thành công</th>
                </tr>
                </thead>
                <tbody>
                <?php

                for($i = 0; $i<count($relatedAdminData); $i++){
                    if($canbo[$i]->so_lan_sai+$canbo[$i]->so_lan_dung!=0){
                        $tiLePhanTram = 100*$canbo[$i]->so_lan_dung/($canbo[$i]->so_lan_sai+$canbo[$i]->so_lan_dung);
                    }else{
                        $tiLePhanTram ="---";
                    }

                    echo '<tr>
                    <td>
                        <img src="'.base_url('upload/'.$relatedAdminData[$i]->avatar).'" alt="">
                        '.$relatedAdminData[$i]->hoten.'
                        <span class="user-link user-subhead" >'.$my_phong_ban[$i].'</span>
                    </td>
                    <td class="text-center" style="font-weight:bold;">'.$canbo[$i]->so_lan_giai_quyet.'</td>
                    <td class="text-center" style="font-weight:bold;">'.$canbo[$i]->so_lan_dung.'</td>
                    <td class="text-center" style="font-weight:bold;">'.$canbo[$i]->so_lan_sai.'</td>
                    <td class="text-center" style="font-weight:bold;">'.$tiLePhanTram.'%'.'</td>

                </tr>';
                }

                ?>

                </tbody>
            </table>
        </div>
    </div>
</div>
</div>
<script type="text/javascript">

    
</script>
