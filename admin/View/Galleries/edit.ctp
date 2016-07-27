<?php
	$userId = AuthComponent::user('id');
	$option = array();
	$resources = $this->GalleryCategory->FindAllCategory($userId);
	foreach ($resources as $r) {
		foreach ($r as $gallerycategories => $gallery_categories) {
			$options[$gallery_categories['id']] = $gallery_categories['title']; 
		}
  	}
	if($data["Gallery"]["user_id"] != $userId){
?>
	<section class="container contentMain">
		<div class="categoryManager">
			<div class="title">
				<h2>Bạn không được quyền chỉnh sửa Gallery Category này</h2>
			</div>
		</div>
	</section>

<?php		
	}else{
?>
<section class="container contentMain">
		<div class="categoryManager">
			<div class="title">
				<h2>Chỉnh sửa Gallery Category</h2>
			</div>
			<div class="categoryBlock">
				<div class="controls">
					<div class="flR width20 aRight">
						<input type="button" value="Xóa" class="button btn btn-success" id="btnCancel" onclick="window.location.href='<?php echo $this->Html->Url(array('controller'=>'galleries', 'action'=>'delete')).'/'.$data['Gallery']['id'].''; ?>'">
					</div>
					<div class="clearFix"></div>
				</div>
			</div>
			<div class="categoryBlock">
			<?php echo $this->Form->create('galleries', ['url' => ['action' => 'save']]); ?>
				<?php  echo $this->Form->input('id',array('label' => false,'type'=>'hidden','value'=>$data['Gallery']['id'],'name'=>'id','class' => 'hidden')); ?>
				<?php  echo $this->Form->input('modified_date',array('label' => false,'type'=>'hidden','value'=> date("Y/m/d h:i:s"),'name'=>'modified_date','class' => 'hidden')); ?>
				<?php  echo $this->Form->input('user_id',array('label' => false,'type'=>'hidden','value'=> $userId,'name'=>'user_id','class' => 'hidden')); ?>
				<table class="table">
					<col class="width20"/>
					<col />
					<col class="width30"/>
					<tr>
						<td>Tiêu đề</td>
						<td><?php  echo $this->Form->input('title',array('label' => false,'value'=>$data['Gallery']['title'],'name'=>'title','class' => 'input form-control')); ?></td>
						<td>※ Tối đa XX kí tự</td>
					</tr>
					<tr>
						<td>Gallery Categories</td>
						<td><?php  echo $this->Form->input('gallery_categories_id',array('label' => false,'options'=>$options,'value'=>$data["Gallery"]["gallery_categories_id"],'name'=>'gallery_categories_id','class' => 'input form-control')); ?></td>
					</tr>
				</table>

				<!-- Layer Part-->
				<div class="container">
				  <div class="panel panel-default col-md-10">
				    <div class="panel-heading">Layer Part</div>
				    <div class="panel-body">Panel Content</div>
				  </div>
				</div>
				<!-- End Layer Part-->
				<p class="aCenter">
					<input type="submit" value="Lưu danh mục" class="button btn btn-success" id="btnAdd">
					<input type="button" value="Hủy" class="button btn btn-success" id="btnCancel " onclick="window.location.href='<?php echo $this->Html->Url(array('controller'=>'galleries', 'action'=>'index')); ?>'">
				</p>
			<?php echo $this->Form->end(); ?>
			</div>
		</div>
	</section>
<?php } ?>