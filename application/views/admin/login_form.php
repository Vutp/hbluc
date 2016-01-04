<div class="col-lg-12">
	<ol class="breadcrumb">
		<li class="cursor back">
			<i class="fa fa-arrow-left"></i>
		</li>
		<li>
			<a href="<?php echo base_url('trang_chu'); ?>"><i class="fa fa-home"></i> Trang chủ</a>
		</li>
	</ol>
	<h3 class="page-header marTop"><i class="fa fa-user"></i> Đăng nhập</h3>
</div>
<div class="col-xs-0 col-md-3 col-lg-3">
</div>
<div class="col-xs-12 col-md-6 col-lg-6">
		

		<?php
		if (isset($error)){
			echo "<div class='alert alert-danger' role='alert'>$error</div>";
		}?>
		<div class="panel panel-default">
			<div class="panel-body">
			<?php 
			$attributes = array('class'=>'form-signin');
			echo form_open(''.base_url().'admin/admin', $attributes);?>
				<fieldset>
					<div class="form-group">
					<input class="form-control" placeholder="Tên" name="name" type="text" autofocus>
					</div>
					<?php echo form_error('name'); ?>
					<div class="form-group">
					<input class="form-control" placeholder="Mật khẩu" name="pass" type="password" value="">
					</div>
					<?php echo form_error('pass'); ?>
					<input name="submit" value="Đăng nhập" class="btn btn-lg btn-success btn-block" type="submit">
				</fieldset>

				<?php echo form_close('');?>
			</div>
		</div>
</div>
<div class="col-xs-0 col-md-3 col-lg-3">
</div>
