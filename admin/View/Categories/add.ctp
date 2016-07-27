<?php
	$options = array();
	$options[0] = 'Root';
  	$res = $this->Category->find_all_category();
  	foreach ($res as $r) {
		foreach ($r as $categories => $category) {
			$options[$category['id']] = $category['name']; 
		}
  	}
?>
 <section class="container contentMain">
	<div class="categoryManager">
		<div class="title">
			<h2>Thêm danh muc</h2>
		</div>
		<div class="categoryBlock">
		<?php echo $this->Form->create('Category', ['url' => ['action' => 'add']]); ?>
			<?php  echo $this->Form->input('id',array('label' => false,'type'=>'hidden','name'=>'id','class' => 'hidden')); ?>
			<?php  echo $this->Form->input('created_date',array('label' => false,'type'=>'hidden','value'=> date("Y/m/d h:i:s"),'name'=>'created_date','class' => 'hidden')); ?>
			<table class="table">
				<col class="width20"/>
				<col />
				<col class="width30"/>
				<tr>
					<td>Tên danh mục <em>※</em></td>
					<td><?php  echo $this->Form->input('name',array('label' => false,'name'=>'name','class' => 'required input')); ?></td>
					<td>※ Tối đa XX kí tự</td>
				</tr>
				<tr>
					<td>Tiêu đề</td>
					<td><?php  echo $this->Form->input('title',array('label' => false,'name'=>'title','class' => 'input')); ?></td>
					<td>※ Tối đa XX kí tự</td>
				</tr>
				<tr>
					<td>Từ khóa</td>
					<td><?php  echo $this->Form->input('keyword',array('label' => false,'name'=>'keyword','class' => 'input')); ?></td>
					<td>※ Tối đa XX kí tự, phân biệt dấu ","</td>
				</tr>
				<tr>
					<td>Category cha</td>
					<td><?php echo $this->Form->input('parent_id', array('label' => false,'options'=>$options,'name'=>'parent_id','class' => 'input')); ?>	
            		</td>
				</tr>
				<tr>
					<td>Trạng thái</td>
					<td><?php echo $this->Form->input('display', 
						array('label' => false,
							'options'=>array('1'=>'Hiện','0'=>'Ẩn'),
							'name'=>'display',
							'class' => 'input')); ?>
            		</td>
				</tr>
				<tr>
					<td>Mô tả</td>
					<td><textarea name="description" value="" class="input width100" rows="10" ></textarea></td>
					<td>※ Tối đa XX kí tự</td>
				</tr>
			</table>
			<p class="aCenter">
				<input type="submit" value="Lưu danh mục" class="button" id="btnAdd">
				<input type="button" value="Hủy" class="button" id="btnCancel" onclick="window.location.href='<?php echo $this->webroot.'categories'; ?>'">
			</p>
		<?php echo $this->Form->end(); ?>
		
		</div>
	</div>
</section>