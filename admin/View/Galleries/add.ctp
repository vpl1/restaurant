<?php
	$UserId = AuthComponent::user("id");
	$option = array();
	$resources = $this->GalleryCategory->FindAllCategory($UserId);
	foreach ($resources as $r) {
		foreach ($r as $gallerycategories => $gallery_categories) {
			$options[$gallery_categories['id']] = $gallery_categories['title']; 
		}
  	}
?>

<section class="container contentMain">
	<div class="categoryManager">
		<div class="title">
			<h2>Thêm mới Gallery</h2>
		</div>
		<div class="categoryBlock">
		<?php echo $this->Form->create('galleries', ['url' => ['action' => 'add']]); ?>
			<?php  echo $this->Form->input('id',array('label' => false,'type'=>'hidden','name'=>'id','class' => 'hidden')); ?>
			<?php  echo $this->Form->input('created_date',array('label' => false,'type'=>'hidden','value'=> date("Y/m/d h:i:s"),'name'=>'created_date','class' => 'hidden')); ?>
			<?php  echo $this->Form->input('user_id',array('label' => false,'type'=>'hidden','value'=> $UserId,'name'=>'user_id','class' => 'hidden')); ?>
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
					<td>Gallery Categories</td>
					<td><?php  echo $this->Form->input('gallery_categories_id',array('label' => false,'options'=>$options,'name'=>'gallery_categories_id','class' => 'input form-control')); ?></td>
				</tr>
			</table>
			<p class="aCenter">
				<input type="submit" value="Lưu danh mục" class="button btn btn-success" id="btnAdd">
				<input type="button" value="Hủy" class="button btn btn-success" id="btnCancel " onclick="window.location.href='<?php echo $this->webroot.'galleries'; ?>'">
			</p>
		<?php echo $this->Form->end(); ?>
		</div>
	</div>
</section>