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
<?php $user_id = AuthComponent::user('id'); ?>
<?php echo '<div class="alert alert-success" role="alert">'.$this->Flash->render().'</div>'; ?>
<!-- Content Header (Page header) -->
<section class="content-header">
	<!-- page title -->
	<h1>Quản lý danh mục</h1>
	<!-- /.page title -->
	<ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
		<li class="active">Menu</li>
	</ol>
</section>
<section class="container contentMain content">
	<div class="categoryManager">
		<p class="mb20"><a href="<?php echo $this->webroot ?>menus/add" class="button" id="btnAdd">Thêm danh mục</a></p>
		<div class="categoryBlock">
			<!--<div class="controls">
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
			</div>-->
		</div>
		<div class="categoryBlock categoryList">
			<?php
			  $res = $this->Menu->create_menu(0,'',0,$user_id);
			  if($res!=""){
			  	foreach ($res as $r) {
					echo  $r;
			  	}	
			  } else 
			  echo __("No Menu Selected");
			?>
		</div>
	</div>
</section>

