 <?php
	$options = array();
	$options[0] = 'Root';
	$user_id = AuthComponent::user('id');
	if($data['error']){
	  	$res = $this->Menu->find_menu_edit($data['id'],$user_id);
	  	foreach ($res as $r) {
			foreach ($r as $categories => $category) {
				$options[$category['id']] = $category['name']; 
			}
	  	}
 	}
?>
<section class="container contentMain">
	<?php if($data['error']){ ?>
	<div class="categoryManager">
		<div class="title">
			<h2><?php echo __('Edit Menu') ?></h2>
		</div>
		<div class="categoryBlock">
			<div class="controls">
				<div class="flR width20 aRight">
					<input type="button" value="Xóa" class="button btn btn-success" id="btnCancel" onclick="window.location.href='<?php echo $this->webroot.'menus/delete/'.$data['id'].''; ?>'">
				</div>
				<div class="clearFix"></div>
			</div>
		</div>
		<div class="categoryBlock">
		
		<?php echo $this->Form->create('Menu', ['url' => ['action' => 'save']]); ?>
			<?php  echo $this->Form->input('id',array('label' => false,'type'=>'hidden','value'=>$data['id'],'name'=>'id','class' => 'hidden')); ?>
			<?php  echo $this->Form->input('modified_date',array('label' => false,'type'=>'hidden','value'=> date("Y/m/d h:i:s"),'name'=>'modified_date','class' => 'hidden')); ?>
			<?php  echo $this->Form->input('user_id',array('label' => false,'type'=>'hidden','value'=> AuthComponent::user('id'),'name'=>'user_id','class' => 'hidden')); ?>
			<table class="table">
				<col class="width20"/>
				<col />
				<col class="width30"/>
				<tr>
					<td>Tên danh mục <em>※</em></td>
					<td><?php  echo $this->Form->input('name',array('label' => false,'value'=>$data['name'],'name'=>'name','class' => 'required form-control')); ?></td>
					<td>※ Tối đa XX kí tự</td>
				</tr>
				<tr>
					<td>Tiêu đề</td>
					<td><?php  echo $this->Form->input('title',array('label' => false,'value'=>$data['title'],'name'=>'title','class' => 'input form-control')); ?></td>
					<td>※ Tối đa XX kí tự</td>
				</tr>
				<tr>
					<td>Từ khóa</td>
					<td><?php  echo $this->Form->input('keyword',array('label' => false,'value'=>$data['keyword'],'name'=>'keyword','class' => 'input form-control')); ?></td>
					<td>※ Tối đa XX kí tự, phân biệt dấu ","</td>
				</tr>
				<tr>
					<td>Danh mục cha</td>
					<td><?php echo $this->Form->input('parent_id', array('label' => false,'options'=>$options,'value'=>$data['parent_id'],'name'=>'parent_id','class' => 'input form-control')); ?>	
            		</td>
				</tr>
				<tr>
					<td>Trạng thái</td>
					<td><?php echo $this->Form->input('display', 
						array('label' => false,
							'options'=>array('1'=>'Hiện','0'=>'Ẩn'),
							'value'=>$data['display'],
							'name'=>'display',
							'class' => 'input form-control')); ?>
            		</td>
				</tr>
				<tr>
					<td>Mô tả</td>
					<td><textarea name="description" value="<?php echo $data['description'] ?>" class="input width100 form-control" rows="10" ><?php echo $data['description'] ?></textarea></td>
					<td>※ Tối đa XX kí tự</td>
				</tr>
			</table>
			<p class="aCenter">
				<input type="submit" value="Lưu danh mục" class="button btn btn-success" id="btnAdd">
				<input type="button" value="Hủy" class="button btn btn-success" id="btnCancel " onclick="window.location.href='<?php echo $this->webroot.'menus'; ?>'">
			</p>
		<?php echo $this->Form->end(); ?>
		
		</div>
	</div>
	<?php } else { ?>
		<div class="alert alert-danger" role="alert">
	        <strong>Oh snap!</strong> Không có thông tin Menu
	  	</div>
	<?php } ?>
</section>