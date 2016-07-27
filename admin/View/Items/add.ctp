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
				<col class="width30"/>
				<col />
				<tr>
					<td>Tên sản phẩm <em>※</em></td>
					<td><?php  echo $this->Form->input('name',array('label' => false,'name'=>'name','class' => 'required input')); ?></td>
				</tr>
				<tr>
					<td>Mã sản phẩm (SKU)</td>
					<td><?php  echo $this->Form->input('item_no',array('label' => false,'name'=>'item_no','class' => 'input')); ?></td>
				</tr>
				<tr>
					<td>Danh mục sản phẩm</td>
					<td><?php  echo $this->Form->input('category_id',array('label' => false,'name'=>'category_id','class' => 'input')); ?></td>
				</tr>
				<tr>
					<td>Đơn vị</td>
					<td><?php echo $this->Form->input('item_unit', array('label' => false,'name'=>'item_unit','class' => 'input')); ?>	
            		</td>
				</tr>
				<tr>
					<td>Giá tiền</td>
					<td><?php echo $this->Form->input('price', array('label' => false,'name'=>'price','class' => 'input')); ?>	
            		</td>
				</tr>
				<tr>
					<td>Giá giảm</td>
					<td><?php echo $this->Form->input('sale_price', array('label' => false,'name'=>'sale_price','class' => 'input')); ?>	
            		</td>
				</tr>
				<tr>
					<td>Point có được</td>
					<td><?php echo $this->Form->input('point', array('label' => false,'name'=>'point','class' => 'input')); ?>	
            		</td>
				</tr>
				<tr>
					<td>Mô tả ngắn</td>
					<td><textarea name="short_description" value="" class="input width100" rows="10" ></textarea></td>
				</tr>
				<tr>
					<td>Mô tả</td>
					<td><textarea name="description" value="" class="input width100" rows="10" ></textarea></td>
				</tr>
				<tr>
					<td>Tồn kho</td>
					<td><?php echo $this->Form->input('total_stock', array('label' => false,'name'=>'total_stock','class' => 'input')); ?>
				</tr>
				<tr>
					<td>Trạng thái</td>
					<td><?php echo $this->Form->input('order_stock', array('label' => false,'name'=>'order_stock')); ?>
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