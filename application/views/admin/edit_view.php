<div class="col-xs-9 col-md-10" id="chi_tietttt">
	<div class="container theme-showcase" role="main">



		<?php
		echo form_open(''.base_url('admin/edit/edit_thu_tuc/'.$id_node.'').'');?>
		<div>
			<label for="publication_id" >Tên</label>

			<?php echo html_escape($node_map->node_name); ?>
		</div>

		<div class="input-group col-sm-8">

			<?php
			$data1 = array(
				'name'=>"trinh_tu",'type'=>"text" ,'value'=> $trinh_tu_data,
				'cols' => "60",'rows' => '5','class'=>"form-control"
			);
			$data2 = array(
				'name' =>"thoi_gian",'type'=>"text" ,'value' => $thoi_gian_data,
				'cols'=> "60",'rows' => '5','class'=>"form-control"
			);
			$data3 = array(
				'name' =>"cach_thuc",'type'=>"text" ,'value' => $cach_thuc_data,
				'cols'=> "60",'rows' => '2','class'=>"form-control"
			);
			$data4 = array(
				'name' =>"thanh_phan",'type'=>"text" ,'value' => $thanh_phan_data,
				'cols'=> "60",'rows' => '5','class'=>"form-control"
			);
			$data5 = array(
				'name' =>"thanh_phan_note",'type'=>"text" ,'value' => $thanh_phan_data_1,
				'cols'=> "60",'rows' => '1','class'=>"form-control"
			);
			$data6 = array(
				'name' =>"giai_quyet",'type'=>"text" ,'value' => $giai_quyet_data,
				'cols'=> "60",'rows' => '3','class'=>"form-control"
			);
			$data7 = array(
				'name' =>"doi_tuong",'type'=>"text" ,'value' => $doi_tuong_data,
				'cols'=> "60",'rows' => '1','class'=>"form-control"
			);
			$data8 = array(
				'name' =>"co_quan",'type'=>"text" ,'value' => $co_quan_data,
				'cols'=> "60",'rows' => '1','class'=>"form-control"
			);
			$data9 = array(
				'name' =>"ket_qua",'type'=>"text" ,'value' => $ket_qua_data,
				'cols'=> "60",'rows' => '1','class'=>"form-control"
			);
			$data10 = array(
				'name' =>"le_phi",'type'=>"text" ,'value' => $le_phi_data,
				'cols'=> "60",'rows' => '3','class'=>"form-control"
			);
			$data11 = array(
				'name' =>"mau_don",'type'=>"text" ,'value' => $mau_don_data,
				'cols'=> "60",'rows' => '3','class'=>"form-control"
			);
			$data12 = array(
				'name' =>"yeu_cau",'type'=>"text" ,'value' => $yeu_cau_data,
				'cols'=> "60",'rows' => '6','class'=>"form-control"
			);
			$data13 = array(
				'name' =>"can_cu",'type'=>"text" ,'value' => $can_cu_data,
				'cols'=> "60",'rows' => '8','class'=>"form-control"
			);



			echo form_label('Trình tự ','name');
			?><br><?php
			echo form_textarea($data1);?>
		</div>
		<div class="input-group col-sm-8">
			<?php echo form_label('Thời gian ','name');
			?><br><?php
			echo form_textarea($data2);?>
		</div>

		<div class="input-group col-sm-8">
			<?php echo form_label('Thời gian ','name');
			?><br><?php
			echo form_textarea($data3);?>

		</div>
		<div class="input-group col-sm-8">
			<?php echo form_label('Thành phần hồ sơ','name');
			?><br><?php
			echo form_textarea($data4);?>
		</div>

		<div class="input-group col-sm-8">
			<?php echo form_label('Số lượng hồ sơ','name');
			?><br><?php
			echo form_textarea($data5);?>
		</div>
		<div class="input-group col-sm-8">
			<?php echo form_label('Thời hạn giải quyết','name');
			?><br><?php
			echo form_textarea($data6);?>
		</div>
		<div class="input-group col-sm-8">
			<?php echo form_label('Đối tượng thực hiện thủ tục hành chính','name');
			?><br><?php
			echo form_textarea($data7);?>
		</div>
		<div class="input-group col-sm-8">
			<?php echo form_label('Cơ quan thực hiện thủ tục hành chính ','name');
			?><br><?php
			echo form_textarea($data8);?>
		</div>
		<div class="input-group col-sm-8">
			<?php echo form_label('Kết quả thực hiện thủ tục hành chính','name');
			?><br><?php
			echo form_textarea($data9);?>
		</div>
		<div class="input-group col-sm-8">
			<?php echo form_label('Phí, lệ phí','name');
			?><br><?php
			echo form_textarea($data10);?>
		</div>

		<div class="input-group col-sm-8">

			<?php echo form_label('Tên mẫu đơn, mẫu tờ khai','name');
			?><br><?php
			echo form_textarea($data11);?>
		</div>
		<div class="input-group col-sm-8">
			<?php echo form_label('Yêu cầu ','name');
			?><br><?php
			echo form_textarea($data12);?>
		</div>
		<div class="input-group col-sm-8">
			<?php echo form_label('Căn cứ pháp lý của thủ tục hành chính','name');
			?><br><?php
			echo form_textarea($data13);?>
		</div>
		<div>
			<?php
			echo form_submit('submit','Lưu lại',"btn btn-default");?>

			<?php
			echo form_close('');?>
			<?php echo validation_errors(); ?>

		</div>

		</form>
	</div>
</div>