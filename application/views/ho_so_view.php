<div class="col-lg-12">
    <ol class="breadcrumb">
        <li class="cursor back">
            <i class="fa fa-arrow-left"></i>
        </li>
        <li>
            <a href="<?php echo base_url('trang_chu'); ?>">
                <i class="fa fa-home"></i> Trang chủ
            </a>
        </li>
    </ol>
    <h3 class="page-header marTop"><i class="fa fa-search"></i> Tìm kiếm hồ sơ</h3>
    <div class="panel-body">
        <div class="row">
            <table id="table" class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th>Mã hồ sơ</th>
                    <th>Tên</th>
                    <th>CMND</th>
                    <th>Trạng thái</th>
                </tr>
                </thead>
                <tbody>
                
            <?php
                foreach ($query->result() as $row){
  if($row->status==0) $arr='Đang ở bàn tiếp nhận';
  if($row->status==1)  $arr='Đang chờ xử lý';
  if($row->status==2)  $arr='Đang xử lý';
  if($row->status==3)  $arr='Đã xử lý';
  if($row->status==4)  $arr='Đang ở bàn trả dân';
  if($row->status==5)  $arr='Hồ sơ hoàn tất';
  if($row->status==6)  $arr='Hồ sơ có lỗi';
  if($row->status==7)  $arr='Hồ sơ có lỗi chờ trả dân';
  if($row->status==8)  $arr='Hồ sơ có lỗi đã trả dân';
                echo '<tr>
              <td><a href="'.base_url().'admin/xem_ho_so/details/'.$row->id.'">
                <h5 class="truncate">'.$row->mshs.' </h5></a></td>
              <td> '.$row->name.'</td>
              <td>'.$row->cmnd.'</td>
                  <td>'.$arr.'</td>
                  </tr>';
                    }
                    ?>
                </tbody> 
            </table>
        </div>
        <!--?php echo $this->pagination->create_links(); ?-->
    </div>
</div><!-- /.col-lg-12 -->