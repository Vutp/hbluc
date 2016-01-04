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
	<h3 class="page-header marTop"><i class="fa fa-files-o"></i> Hồ sơ trả dân</h3>

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
				$array_status='0';
				foreach ($query->result() as $row){
					echo '<tr>
						<td><a href="'.base_url('admin/xem_ho_so/details/'.$row->id.'').'">
                  		<h5>'.$row->mshs.' </h5></a></td>
						<td> '.$row->name.'</td>
						<td> '.$row->cmnd.'</td>';
					if ($row->status==3)
						echo '<td><button type="button" class="btn btn-primary"
							onclick=location.href="'.base_url('admin/admin_tra_ho_so/edit/'.$row->id.'').'">Nhận hồ sơ</button></td>
							</tr>';
					if ($row->status==4){
						echo '<td><button type="button btn-warning" class="btn btn-warning" data-toggle="modal" data-target="#Modal_view_money_'.$row->id.'" class="btn btn-danger" >Trả hồ sơ</button></td>
							</tr>';
						echo 	
						'<div id="Modal_view_money_'.$row->id.'" class="modal fade" role="dialog"  >
						<div class="modal-dialog">
			
							<div class="modal-content">
								<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h4 class="modal-title">Xác nhận trả hồ sơ </h4>
								</div>
								<div class="modal-body">Lệ phí cần thu là '.$row->tien_thu.'</div>
								<div class="modal-footer">
								<button type="button "  class="btn btn-info" onclick=location.href="'.base_url('admin/admin_tra_ho_so/edit_stt/'.$row->id.'').'">Xác nhận trả </buton>
                    			<button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                			</div>
							</div>

						</div>
						</div>';

						}
					$val="";
					if($row->status==6)
						echo '<td>
							<button type="button"  class="btn btn-info" onclick=location.href="'.base_url('admin/admin_tra_ho_so/edit_error/'.$row->id.'').'">Nhận hồ sơ lỗi </buton></td>
							</tr>';
					if($row->status==7){
						$da_thu = str_replace('.','', $row->error);
						$da_thu=explode('-', $da_thu);
						$a_da_thu=explode('+', $da_thu[0]);
						if($a_da_thu[1]!='')
						$val=$a_da_thu[0].' <b>bị lỗi '.$a_da_thu[1].'</b>';
						for ($i = 2;$i<count($a_da_thu)-1;$i++ ) {
							if($a_da_thu[$i+1]!='')
							$val= $val.' <br>'. $a_da_thu[$i].' <b>bị lỗi '.$a_da_thu[$i+1].'</b>';
							$i++;
						}
						$val=$val.'<br>Kết quả: <b>'.$da_thu[1].'</b>';
						echo '<td><button type="button" data-toggle="modal" data-target="#Modal_view_error_'.$row->id.'" class="btn btn-danger" >Trả hồ sơ lỗi</button>&nbsp';
						echo 	
						'<div id="Modal_view_error_'.$row->id.'" class="modal fade" role="dialog"  >
						<div class="modal-dialog">
			
							<div class="modal-content">
								<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h4 class="modal-title">Xác nhận trả hồ sơ lỗi</h4>
								</div>
								<div class="modal-body">';
							echo $val;
							echo'
							</div>
						<div class="modal-footer">
						<button type="button"  class="btn btn-info" onclick=location.href="'.base_url('admin/admin_tra_ho_so/edit_stt_error/'.$row->id.'').'">Xác nhận trả </buton>
                    	<button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                		</div>
						</div>

						</div>
						</div>';
					}


				}?>
				</tbody>
			</table>

		</div>
	</div><!-- /.panel-body -->

</div><!-- /.col-lg-12 -->