<script>
jQuery(document).ready(function(){
    jQuery('.treeNodeCt').hide();
    jQuery('.treePlus').click(function(){
        jQuery(this).parents('.treeNode:first').find('.treeNodeCt:first').toggle();
        jQuery(this).toggleClass('treeMinus treePlus');
    });
    jQuery('.treeEndPlus').click(function(){
        jQuery(this).parents('.treeNode:first').find('.treeNodeCt:first').toggle();
        jQuery(this).toggleClass('treeEndMinus treeEndPlus');
    });
});
</script>
<?php echo $this->Flash->render(); ?>
<section class="container contentMain">
	<div class="categoryManager">
		<div class="title">
			<h2>Quản lý danh muc</h2>
		</div>
		<p class="mb20"><a href="<?php echo $this->webroot ?>categories/add" class="button" id="btnAdd">Thêm danh mục</a></p>
		<div class="categoryBlock">
			<div class="controls">
				<div class="flL width80">
					<input type="submit" value="Thay đổi" class="button" id="btnEdit">
					<input type="submit" value="Xóa" class="button ml20" id="btnDelete">
					<input type="submit" value="Hiện/Ẩn" class="button ml20" id="btnEnable">
					<input type="submit" value="Review" class="button ml20" id="btnReview">
				</div>
				<div class="flR width20 aRight">
					<input type="submit" value="Lưu" class="button" id="btnSave">
				</div>
				<div class="clearFix"></div>
			</div>
		</div>
		<div class="categoryBlock categoryList">
			<?php
			  $res = $this->Category->create_category(0,'',0);
			  foreach ($res as $r) {
				echo  $r;
			  }
			?>
		</div>
	</div>
</section>

