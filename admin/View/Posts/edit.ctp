	<!-- File: /app/View/Posts/add.ctp -->
	<?php echo $this->Html->script('ckeditor/ckeditor'); ?>
	<h1>Edit Post</h1>
	<?php echo $this->Form->create('Post'); ?>
	<?php echo $this->Form->input('title', array('class'=>'form-control')); ?>
	<br>
	<span> Contents</span>
	<?php echo $this->Form->textarea('body',array('class'=>'ckeditor')); ?>
	<br>
	<?php echo $this->Form->button('Save posts',array('class'=>'btn btn-lg btn-success')); ?>
	<a style="margin-left: 5px" href="<?php echo $this->Html->Url(array('controller'=>'posts', 'action'=>'index'));?>" class="btn btn-lg btn-danger mr10">
	    Cancel
	</a>
	<?php echo $this->Form->end();?>
