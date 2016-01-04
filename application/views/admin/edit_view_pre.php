<div class="col-xs-9 col-md-10" > 
<div class="container theme-showcase" role="main">
<form method="post" class="form-horizontal" action="<?php echo base_url('admin/edit/begin_edit');?>">
	<div class="input-group col-sm-8">
		<label for="name_select" class="col-sm-10">Tên mục cần sửa</label>
		<select name= "name_select" class="bg-primary col-sm-10">
			<?php foreach ($com as $id => $name) {
					echo '<option value="'.html_escape($id).'">'.html_escape($name).'</option>';
			}
			?>
		</select>
	</div>
	<div>
		<input type="submit" class="btn btn-default" value="Sửa"/>
	</div>

</form>
</div>
</div>