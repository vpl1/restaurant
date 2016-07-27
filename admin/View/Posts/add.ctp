	<!-- File: /app/View/Posts/add.ctp -->

	<?php echo $this->Html->script('ckeditor/ckeditor'); ?>

	<h1>Add Post</h1>

	<?php echo $this->Form->create('Post'); ?>
	<?php echo $this->Form->input('title', array('class'=>'form-control')); ?>
	"<br>
	<span> <b>Contents</b></span>
	<?php echo $this->Form->textarea('body',array('class'=>'ckeditor')); ?>
	<br>
	<?php
		echo $this->Form->button('Save posts', 
						array('formaction' => Router::url(array('controller' => 'Posts','action' => 'add')),
						'class'=>'btn btn-lg btn-success'));
	 ?>
	<a href="<?php echo $this->Html->Url(array('controller'=>'posts', 'action'=>'index'));?>" class="btn btn-lg btn-danger mr10">Cancel</a>

	<?php echo $this->Form->end(); ?>
