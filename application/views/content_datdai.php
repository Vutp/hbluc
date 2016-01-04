<div class="col-lg-12">
    <ol class="breadcrumb">
        <li class="cursor back">
            <i class="fa fa-arrow-left"></i>
        </li>
        <li>
            <a href="<?php echo base_url('trang_chu'); ?>"><i class="fa fa-home"></i> Trang chủ</a>
        </li>
    </ol>
    <h3 class="page-header marTop"><i class="fa fa-files-o"></i> Hành chính trong lĩnh vực đất đai</h3>
</div><!-- /.col-lg-12 -->
<div class="col-lg-9">
    <div class="row">
        <div class="masonry">
            <?php foreach ($com as $stt =>$id) {
                echo ' <div class="col-md-6 col-xs-6 marBot">
                        <a href="'.base_url('dat_dai_chi_tiet/'.html_escape($stt).'').'" data-toggle="tooltip" data-placement="top" title="'.html_escape($id).'">
                            <button type="button" class="btn btn-outline btn-primary btn-block custom">
                                <h5 class="truncate">'.html_escape($id).'</h5>
                            </button>
                        </a>
                    </div> ';
            }  ?>
        </div>
    </div>
</div>