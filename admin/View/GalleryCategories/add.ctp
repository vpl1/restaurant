<?php
	$userId = AuthComponent::user('id');
?>

<section class="container contentMain">
	<div class="categoryManager">
		<div class="title">
			<h2>Thêm mới Gallery Category</h2>
		</div>
		<div class="categoryBlock">
		<?php echo $this->Form->create('gallerycategories', ['url' => ['action' => 'add']]); ?>
			<?php  echo $this->Form->input('id',array('label' => false,'type'=>'hidden','name'=>'id','class' => 'hidden')); ?>
			<?php  echo $this->Form->input('created_date',array('label' => false,'type'=>'hidden','value'=> date("Y/m/d h:i:s"),'name'=>'created_date','class' => 'hidden')); ?>
			<?php  echo $this->Form->input('user_id',array('label' => false,'type'=>'hidden','value'=> $userId,'name'=>'user_id','class' => 'hidden')); ?>
			<table class="table">
				<col class="width20"/>
				<col />
				<col class="width30"/>
				<tr>
					<td>Tiêu đề</td>
					<td><?php  echo $this->Form->input('title',array('label' => false,'name'=>'title','class' => 'input form-control')); ?></td>
					<td>※ Tối đa XX kí tự</td>
				</tr>
				<tr>
					<td>Mô tả</td>
					<td><textarea name="description" value="" class="input width100 form-control" rows="10" ></textarea></td>
					<td>※ Tối đa XX kí tự</td>
				</tr>
			</table>
			<p class="aCenter">
				<input type="submit" value="Lưu danh mục" class="button btn btn-success" id="btnAdd">
				<input type="button" value="Hủy" class="button btn btn-success" id="btnCancel " onclick="window.location.href='<?php echo $this->webroot.'gallerycategories'; ?>'">
			</p>
		<?php echo $this->Form->end(); ?>
		</div>
	</div>
</section>
