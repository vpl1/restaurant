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
<?php $userId = AuthComponent::user('id'); ?>
<?php echo $this->Flash->render(); ?>
<section class="container contentMain">
	<div class="categoryManager">
		<div class="title">
			<h2>Quản lý danh mục Gallery Categories</h2>
		</div>
		<p class="mb20"><a href="<?php echo $this->webroot ?>gallerycategories/add" class="button" id="btnAdd">Thêm danh mục</a></p>
		<div class="categoryBlock categoryList">
			<?php
			  $treeArray = $this->GalleryCategory->CreateMenu('',0,$userId);
			  if($treeArray!=""){
			  	foreach ($treeArray as $line) {
					echo  $line;
			  	}	
			  } else 
			  	echo __("No Menu Selected");
			?>
		</div>
	</div>
</section>

<script type="text/javascript">

</script>

