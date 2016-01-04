<div class="col-lg-12">
	<ol class="breadcrumb">
		<li class="cursor back">
			<i class="fa fa-arrow-left"></i>
		</li>
		<li>
			<a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Trang chủ</a>
		</li>
		<li class="active">
			<i class="fa fa-file-o"></i> Hồ sơ chi tiết
		</li>
	</ol>
	<?php echo '<h3 class="page-header marTop"><i class="fa fa-file-o"></i> '.$node_map[(int)substr($details->mshs, 16,2)]->node_name.'</h3>';

	if($details->status==0) $arr='Đang ở bàn tiếp nhận';
	if($details->status==1)  $arr='Đang chờ xử lý';
	if($details->status==2)  $arr='Đang xử lý';
	if($details->status==3)  $arr='Đã xử lý';
	if($details->status==4)  $arr='Đang ở bàn trả dân';
	if($details->status==5)  $arr='Hồ sơ hoàn tất';
	if($details->status==6)  $arr='Hồ sơ có lỗi';
	if($details->status==7)  $arr='Hồ sơ có lỗi chờ trả dân';
	if($details->status==8)  $arr='Hồ sơ có lỗi đã trả dân';
	?>

	<div class="row">
		<div class="col-xs-6 col-md-2">
			<p><strong>Họ và tên:</strong></p>
			<p><strong>CMND:</strong></p>
			<p><strong>Tình trạng hồ sơ:</strong></p>
		</div>
		<div class="col-xs-6 col-md-4">
			<p class="bold"><?php echo $details->name;?></p>
			<p class="bold"><?php echo $details->cmnd;?></p>
			<p class="bold"><?php echo $arr;?></p>
		</div>
		<div class="col-xs-6 col-md-2">
			<p><strong>Mã số hồ sơ:</strong></p>
			<p><strong>Ngày nhận:</strong></p>
			<?php if (($details->status!=5)||($details->status!=8))
				echo '<p><strong>Ngày trả dự kiến:</strong></p>';
			else
				echo '<p><strong>Ngày trả:</strong></p>';?>
		</div>
		<div class="col-xs-6 col-md-3">
			<p class="bold mshs"><?php echo $details->mshs ;?></p>
			<p class="bold"><?php echo $ngay_nhan  ;?> </p>
			<?php if (($details->status!=5)||($details->status!=8))
				echo '<p class="bold">'.$ngay_tra .'</p>';
			else
				echo '<p class="bold">'.$details->ngay_tra .'</p>';?>
		</div>

		<div class="col-xs-12 col-md-12">
			<?php
			$thong_tin_ho_so_da_thu=explode('+', $details->tt_giay_to_da_thu);
			if(count($thong_tin_ho_so_da_thu) > 1){
				echo '<div class="panel panel-info marTop">
				<table class="table table-hover ">
				<thead>
					<tr class="ying">
						<th style="text-align: center">Giấy tờ đã nhận </th>
						<th style="text-align: center">Số lượng </th>
					</tr>
				</thead>
					<tbody>';
				$thong_tin_ho_so_da_thu=explode('+', $details->tt_giay_to_da_thu);
				for ($i = 0;$i<count($thong_tin_ho_so_da_thu)-1;$i++ ) {
					echo '<tr class="active">
							<td style="text-align: left">'.$thong_tin_ho_so_da_thu[$i].'</td>
							<td style="text-align: center">'.$thong_tin_ho_so_da_thu[$i+1].'</td>
						</tr>';
					$i++;
				}
				echo'</tbody>
				</table></div>';

				function get_string_between_ref($string, $start, $end){
					$string = ' ' . $string;
					$ini = strpos($string, $start);
					if ($ini == 0) return '';
					$ini += strlen($start);
					$len = strpos($string, $end, $ini) - $ini;
					return substr($string, $ini, $len);
				}


				if($details->status==6 || $details->status==7 || $details->status==8){

					echo '<p  style="background-color: yellow; font-size: 16px; line-height: 4.5; text-align: center ">Thông tin về lỗi hồ sơ</p>';
					$danhsachloi = $details->error;

					$myArraySoLanLoi = explode("parent",$danhsachloi);
					array_shift($myArraySoLanLoi);

					for($j = 0; $j < count($myArraySoLanLoi);$j++){
						echo '<div class="panel panel-info marTop">
				<table class="table table-hover ">
				<thead>
					<tr  class="ying">
						<th style="background-color: rgb(242,242,242);" class="text-center error" colspan="3" >Lỗi lần thứ '.($j+1).'</th>
					</tr>
					<tr class="ying">
						<th class="col-xs-2 text-center" >Stt </th>
						<th class="col-xs-5 text-center">Tên giấy tờ   </th>
						<th class="col-xs-5 text-center">Tên lỗi </th>
					</tr>
				</thead>
					<tbody>';
						$ThanhPhan = explode("*part*",$myArraySoLanLoi[$j]);
						array_shift($ThanhPhan);

						for($i = 0; $i<count($ThanhPhan);$i++){
							$myString = get_string_between_ref($ThanhPhan[$i],'@start@','@end@');

							echo '<tr><td class="text-center">'.($i+1).'</td>';
							echo '<td class="setWidth concat"><div>'.get_string_between_ref($myString,'#name#','#endname#').'</div></td>';
							echo '<td class="setWidth concat"><div>'.get_string_between_ref($myString,'#error#','#enderror#').'</div></td></tr>';
						}
						echo '<tr  ><td class="error" style="font-weight: bold;">Lỗi chung</td><td class="setWidth concat" colspan="2"><div>'.get_string_between_ref($myArraySoLanLoi[$j],'*loirieng*','@endloirieng@').'</div></td></tr>';

						echo'</tbody>
				</table></div>';
					}
				}
			}else
				echo '<h4><ins>Giấy tờ đã nhận:</ins></h4><p>Không</p>';?>

		</div>
		<div class="col-xs-12 col-md-12">
			<?php if  ($details->note!='')
				echo'<h4><ins>Ghi chú:</ins></h4><p>'.$details->note .'</p>';
			else
				echo'<h4><ins>Ghi chú:</ins></h4><p>Không</p>';?>
		</div>

		<div class="col-xs-12 col-md-12">
			<?php
			if ((isset($_SESSION['name_user']))&&($details->status==8)&&
					(($_SESSION['level']==11)||($_SESSION['level']==12)))
				echo '<div class="setTop"><button type="button" class="Ying col-xs-12 btn btn-primary btn-xlarge"
				onclick=location.href="'.base_url('admin/Admin_tiep_nhan/nhan_lai/'.$details->id.'').'">Nhận lại hồ sơ lỗi
				</button></div>';
			?>
		</div>

	</div>
</div><!-- /.col-lg-12 -->
