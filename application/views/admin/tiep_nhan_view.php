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
    <h3 class="page-header marTop"><i class="fa fa-files-o"></i> Hồ sơ đã nhận</h3>
    <div class="panel-body">
        <div class="row">
            <table id="table" class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th>Mã hồ sơ</th>
                    <th>Tên</th>
                    <th>CMND</th>
                    <th>Xử lý</th>
                </tr>
                </thead>
                <tbody>
                
            <?php
                $lista="0";
                $listq=$this->db->where('level',21)->get('user'); 
                foreach ($listq->result() as $row1){
                $lista= $lista.'/'.$row1->id;
                }
                $listb="0";
                $listqq=$this->db->where('level',22)->get('user'); 
                foreach ($listqq->result() as $row2){
                $listb= $listb.'/'.$row2->id;
                }
                $num_count1=$this->db->where('status',1)->where('type', 0)->count_all_results('ho_so')+1;
                $num_count2=$this->db->where('status',1)->where('type', 1)->count_all_results('ho_so')+1;
                echo '<input type="hidden" id="list_sent_tp" value="'.$lista.'" />';
                echo '<input type="hidden" id="list_sent_dd" value="'.$listb.'" />';
                echo '<input type="hidden" id="num_count1" value="'.$num_count1.'" />';
                echo '<input type="hidden" id="num_count2" value="'.$num_count2.'" />';
                foreach ($query->result() as $row){

                echo '<tr>
              <td><a href="'.base_url().'admin/xem_ho_so/details/'.$row->id.'">
                <h5 class="truncate">'.$row->mshs.' </h5></a></td>
              <td> '.$row->name.'</td>
              <td>'.$row->cmnd.'</td>';
                if(($row->status==0)&&($row->type==0))
                echo' <td>
                  <button type="button" class="btn btn-warning"
                    onclick=location.href="'.base_url().'admin/admin_tiep_nhan/edit/'.$row->id.'">Chỉnh sửa</button>&nbsp;
                    <button class="btn btn-danger sent_noti_tp"
                  onclick=location.href="'.base_url().'admin/admin_tiep_nhan/edit_stt/'.$row->id.'/'.$row->cmnd.'">Chuyển phòng ban</button>
                  </td></tr>';
                if(($row->status==0)&&($row->type==1))
                echo' <td>
                  <button type="button" class="btn btn-warning"
                    onclick=location.href="'.base_url().'admin/admin_tiep_nhan/edit/'.$row->id.'">Chỉnh sửa</button>&nbsp;
                    <button class="btn btn-danger sent_noti_dd"
                  onclick=location.href="'.base_url().'admin/admin_tiep_nhan/edit_stt/'.$row->id.'/'.$row->cmnd.'">Chuyển phòng ban</button>
                  </td></tr>';
                if($row->status==1)
                echo '
                  <td>Đang chờ chuyển hồ sơ</td>
                  </tr>';
                    }
                    ?>
                </tbody> 
            </table>
        </div>
        <!--?php echo $this->pagination->create_links(); ?-->
    </div>
</div><!-- /.col-lg-12 -->
