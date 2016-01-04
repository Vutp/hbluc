<div class="col-lg-12">
    <ol class="breadcrumb">
        <li class="cursor back">
            <i class="fa fa-arrow-left"></i>
        </li>
        <li>
            <a href="<?php echo base_url('trang_chu'); ?>"><i class="fa fa-home"></i> Trang chủ</a>
        </li>
        <li>
            <a href="<?php echo base_url('dat_dai'); ?>"><i class="fa fa-files-o"></i> Hành chính trong lĩnh vực đất đai</a>
        </li>
    </ol>
    <h3 class="page-header marTop"><i class="fa fa-file-o"></i> <?php echo html_escape($node_map->node_name); ?></h3>
    <div class="panel panel-info">
        <div class="panel-heading">
            <h3 class="panel-title">Thành phần hồ sơ bao gồm:</h3>
        </div>
        <div class="panel-body">
            <p><?php echo  $thanh_phan_data; ?></p>
        </div>
    </div>
</div><!-- /.col-lg-12 -->