<?php
	$userId = AuthComponent::user('id');
	if($data["GalleryCategory"]["user_id"] != $userId){
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
						<input type="button" value="Xóa" class="button btn btn-success" id="btnCancel" onclick="window.location.href='<?php echo $this->webroot.'gallerycategories/delete/'.$data['GalleryCategory']['id'].''; ?>'">
					</div>
					<div class="clearFix"></div>
				</div>
			</div>
			<div class="categoryBlock">
			<?php echo $this->Form->create('gallerycategories', ['url' => ['action' => 'save']]); ?>
				<?php  echo $this->Form->input('id',array('label' => false,'type'=>'hidden','value'=>$data['GalleryCategory']['id'],'name'=>'id','class' => 'hidden')); ?>
				<?php  echo $this->Form->input('modified_date',array('label' => false,'type'=>'hidden','value'=> date("Y/m/d h:i:s"),'name'=>'modified_date','class' => 'hidden')); ?>
				<?php  echo $this->Form->input('user_id',array('label' => false,'type'=>'hidden','value'=> $userId,'name'=>'user_id','class' => 'hidden')); ?>
				<table class="table">
					<col class="width20"/>
					<col />
					<col class="width30"/>
					<tr>
						<td>Tiêu đề</td>
						<td><?php  echo $this->Form->input('title',array('label' => false,'value'=>$data['GalleryCategory']['title'],'name'=>'title','class' => 'input form-control')); ?></td>
						<td>※ Tối đa XX kí tự</td>
					</tr>
					<tr>
						<td>Mô tả</td>
						<td><textarea name="description" value="<?php echo $data['GalleryCategory']['description'] ?>" class="input width100 form-control" rows="10" ><?php echo $data['GalleryCategory']['description'] ?></textarea></td>
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
<?php } ?>